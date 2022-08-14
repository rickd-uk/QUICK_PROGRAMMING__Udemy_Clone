<?php

/**
 * admin class
 */
class Admin extends Controller
{
  private $destination = '';
  private $updated_image = false;

  private function login_to_view()
  {
    if (!Auth::is_logged_in()) {
      display_message('Please login to view the admin section');
      redirect('login');
    }
  }

  public function index()
  {
    if (!Auth::is_logged_in()) {
      display_message('Please login to view the admin section');
      redirect('login');
    }

    $data['title'] = "Dashboard";

    $this->view('admin/dashboard', $data);
  }

  private function save_image($row, $user)
  {
    $dir = "uploads/images/";
    if (!file_exists($dir)) {
      mkdir($dir, 0777, true);
      file_put_contents($dir . "index.php", "");
      file_put_contents("uploads/index.php", "");
    }
    $allowed_images = ['image/jpeg', 'image/png'];
    $image = $_FILES['image'];

    if (!empty($image['name'])) {
      if ($image['error'] == 0) {
        if (in_array($image['type'], $allowed_images)) {
          // passed validation
          $destination = $dir . time() . "_" . $image['name'];
          move_uploaded_file($image['tmp_name'], $destination);
          $this->destination = $destination;

          resize_image($destination);


          if (file_exists($row->image)) {
            unlink($row->image);
          }
          $this->updated_image = true;
        } else {
          $user->errors['image'] = "This file type is not allowed";
        }
      } else {
        $user->errors['image'] = "Could not upload image";
      }
    } else {
      $this->updated_image = false;
    }
  }

  public function profile($id = null)
  {

    $this->login_to_view();

    // get id from url or logged in user
    $id = $id == null ? Auth::getId() : $id;

    $user = new User();
    // get profile data for selected / logged in user
    $data['row'] = $row = $user->where(['id' => $id], 'one');


    // if profile updated & data retrieved from db
    if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {

      if ($user->edit_validate($_POST, $id)) {

        if (array_key_exists('image', $_FILES)) {
          $this->save_image($row, $user);
          if ($this->updated_image) {
            $_POST['image'] = $this->destination;
          }
        }

        $user->update($id, $_POST);


        //display_message("Profile saved successfully");
        //redirect('admin/profile/' . $id);
      }
      if (empty($user->errors)) {
        $arr['message'] = "Profile saved successfully";
      } else {
        $arr['message'] = "Please correct these errors";
        $arr['errors'] = $user->errors;
      }

      echo json_encode($arr);

      die;
    }

    $data['title'] = "Profile";
    $data['errors'] = $user->errors;
    $this->view('admin/profile', $data);
  }

  public function courses($action = null, $id = null)
  {

    $this->login_to_view();

    $data = [];
    $data['errors'] = [];
    $data['action'] = $action;
    $data['id'] = $id;


    if ($action == 'add') {
      $category = new Category_model();
      $course = new Course_model();

      $data['categories'] = $category->findAll('ASC');


      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($course->validate($_POST)) {

          // added ?? '' to stop vscode warning 'use of unassigned variable'
          $user_id = Auth::getId() ?? '';

          $_POST['date'] = get_date();
          $_POST['user_id'] = $user_id;

          $course->insert($_POST);

          $row = $course->where(['user_id' => $user_id, 'published' => 0], 'DESC', 'one');

          display_message("Your course was successfully created");

          if ($row) {
            redirect('admin/courses/edit/' . $row->id);
          } else {
            redirect('admin/courses');
          }
        }
        $data['errors'] = $course->errors;
      }
    }

    $this->view('admin/courses', $data);
  }
}
