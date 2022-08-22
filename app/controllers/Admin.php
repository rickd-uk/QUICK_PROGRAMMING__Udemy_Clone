<?php

/**
 * admin class
 */
class Admin extends Controller
{
  private $destination = '';

  private $img_filename = '';

  private $updated_image = false;


  // Check whether a particular data type exists
  private function is_data_type($post, $data_type)
  {

    if (!empty($post['data_type']) && $post['data_type'] == $data_type) {
      return true;
    }
    return false;
  }

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
    $dir = "uploads/users/";
    if (!file_exists($dir)) {
      mkdir($dir, 0777, true);
      // add index.php for security in root & uploads dir
      file_put_contents($dir . "index.php", "");
      file_put_contents("uploads/index.php", "");
    }
    $allowed_images = ['image/jpeg', 'image/png'];
    $image = $_FILES['image'];

    if (!empty($image['name'])) {
      if ($image['error'] == 0) {
        if (in_array($image['type'], $allowed_images)) {
          // passed validation

          $this->img_filename = time() . "_" . $image['name'];

          $destination = $dir . $this->img_filename;
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
    $data['row'] = $row = $user->where(['id' => $id], 'ASC', 'one');

    // if profile updated & data retrieved from db
    if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {

      if ($user->edit_validate($_POST, $id)) {

        if (array_key_exists('image', $_FILES)) {
          $this->save_image($row, $user);
          if ($this->updated_image) {
            $_POST['image'] = $this->img_filename;
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

    $user_id = Auth::getId() ?? null;
    $course = new Course_model();
    $category = new Category_model();
    $language = new Language_model();
    $level = new Level_model();
    $price = new Price_model();
    $currency = new Currency_model();

    $data = [];
    $data['errors'] = [];
    $data['action'] = $action;
    $data['id'] = $id;

    // Is the user adding a course
    if ($action == 'add') {
      $category = new Category_model();

      $data['categories'] = $category->findAll('ASC');


      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tab_name = $_POST['tab_name'] ?? '';
        if ($course->validate($_POST)) {

          // added ?? '' to stop vscode warning 'use of unassigned variable'
          $user_id = Auth::getId() ?? '';

          // DEFAULT data for Categories
          // Set current date time as default
          $_POST['date'] = get_date();
          $_POST['user_id'] = $user_id;
          // Set price at Free as default
          $_POST['price_id'] = 1;


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
    } elseif ($action == 'edit') {
      $categories = $category->findAll('ASC');
      $languages = $language->findAll('ASC');
      $levels = $level->findAll('ASC');
      $prices = $price->findAll('ASC');
      $currencies = $currency->findAll('ASC');

      // get course info
      $data['row'] = $row = $course->where(['user_id' => $user_id, 'id' => $id], '', 'one');

      if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {
        $tab_name = $_POST['tab_name'];

        if ($this->is_data_type($_POST, 'read')) {
          if ($tab_name == "course-landing-page") {
            // Return course landing page data
            include views_path("course-edit-tabs/course-landing-page");
          } else if ($tab_name == "course-messages") {
            // Return course landing page data
            include views_path("course-edit-tabs/course-messages");
          }
        } else
          // Save course landing page data
          if ($this->is_data_type($_POST, 'save')) {
            // Check if form is valid
            if ($_SESSION['csrf_code'] == $_POST['csrf_code']) {

              if ($course->edit_validate($_POST, $id, $_POST['tab_name'])) {

                // check if a temp image exists and csrf of form & post match
                $tmp_img = $row->course_image_tmp;
                if ($tmp_img != '' && file_exists($tmp_img) && $row->csrf_code == $_POST['csrf_code']) {
                  // delete current course image
                  if (file_exists($row->course_image)) {
                    unlink($row->course_image);
                  }

                  // if it exists remove variable for image temp
                  $_POST['course_image'] = $tmp_img;
                  $_POST['course_image_tmp'] = '';
                }

                $course->update($id, $_POST);
                $info['data'] = "Course saved successfully";

                // Saved successfully
                #TODO: Redirect To add page    
                // redirect('admin/courses/add');
              } else {
                $info['errors'] = $course->errors;
                $info['data'] = "There are some problems";
              }
            } else {
              $info['errors'] = ['key' => 'value'];
              $info['data'] = 'This form is not valid';
              $info['data_type'] = $_POST['data_type'];
            } // csrf_codes DO NOT MATCH!

            $info['data_type'] = "save";
            echo json_encode($info);
          }
          // Upload Course Image
          else
          if ($this->is_data_type($_POST, 'upload_course_image')) {

            $dir = 'uploads/courses/';

            if (!file_exists($dir)) {
              // true refers to creating nested dir, equivalent to:   mkdir -p $dir
              mkdir($dir, 0777, true);
            }
            $errors = [];
            if (!empty($_FILES['image']['name'])) {
              $destination = $dir . time() . $_FILES['image']['name'];
              move_uploaded_file($_FILES['image']['tmp_name'], $destination);

              // Delete old temp file
              if (file_exists($row->course_image_tmp)) {
                unlink($row->course_image_tmp);
              }

              $course->update($id, ['course_image_tmp' => $destination, 'csrf_code' => $_POST['csrf_code']]);
            }
          }
        die;
      }
    } else {
      // courses view
      $data['rows'] = $course->where(['user_id' => $user_id]);
    }
    $this->view('admin/courses', $data);
  }
}
