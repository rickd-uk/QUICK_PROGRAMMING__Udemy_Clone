<?php

namespace Controller;

if (!defined('ROOT')) die('direct script access denied');

use \Model\Auth;

/**
 * admin class
 */
class Admin extends Controller
{
  private $destination = '';

  private $img_filename = '';

  private $updated_image = false;



  public function index()
  {
    if (!Auth::is_logged_in()) {
      display_message('Please login to view the admin section');
      redirect('login');
    }

    $data['title'] = "Dashboard";

    $this->view('admin/dashboard', $data);
  }


  public function profile($id = null)
  {
    Auth::login_to_view();

    // get id from url or logged in user
    $id = $id == null ? Auth::getId() : $id;

    $user = new \Model\User();
    // get profile data for selected / logged in user
    $data['row'] = $row = $user->where(['id' => $id], 'ASC', 'one');

    // if profile updated & data retrieved from db
    if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {

      if ($user->edit_validate($_POST, $id)) {

        if (array_key_exists('image', $_FILES)) {

          // Saves course image
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
    Auth::login_to_view();
    // Get name of current function
    $cur_function = __FUNCTION__;

    $user_id = Auth::getId() ?? null;
    $course = new \Model\Course();
    $category = new \Model\Category();
    $language = new \Model\Language();
    $level = new \Model\Level();
    $price = new \Model\Price();
    $currency = new \Model\Currency();

    $img_dir = UL_DIR . $cur_function . '/';

    $data = [];
    $data['errors'] = [];
    $data['action'] = $action;
    $data['id'] = $id;

    // Is the user adding a course
    if ($action == 'add') {
      $category = new \Model\Category();
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

        if (Admin::is_data_type($_POST, 'read')) {
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
                $tmp_img_path = $img_dir . $tmp_img;
                $course_img_path = $img_dir . $row->course_image;


                // Check there is temp image, that the path exists and CSRF codes match (i.e. legitimate request)
                if ($tmp_img != '' && file_exists($tmp_img_path) && $row->csrf_code == $_POST['csrf_code']) {
                  // Remove course image if it exists
                  if ($row->course_image && file_exists($course_img_path)) {
                    unlink($course_img_path);
                  }

                  // Set course image and remove ref to temp image, effectively tmp_img -> course_img transfer
                  $_POST['course_image'] = $tmp_img;
                  $_POST['course_image_tmp'] = '';
                }

                // Update the course info

                $course->update($id, $_POST);
                $info['data'] = "Course saved successfully";
                #TODO: Redirect To add page    
                //redirect('admin/courses');
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
            $this->upload_course_image($id, $row, $course, $img_dir);
            $course;
          }
        die;
      }
    } else {
      // courses view
      $data['rows'] = $course->where(['user_id' => $user_id]);
    }
    $this->view('admin/courses', $data);
  }






  function upload_course_image($id, $row, $course, $img_dir)
  {
    Admin::mkdir($img_dir);

    if (!empty($_FILES['image']['name'])) {

      $file_name = time() . $_FILES['image']['name'];
      $file_path = $img_dir . $file_name;

      move_uploaded_file($_FILES['image']['tmp_name'], $file_path);

      //delete old temp file
      if (file_exists($row->course_image_tmp)) {
        unlink($row->course_image_tmp);
      }

      $course->update($id, ['course_image_tmp' => $file_name, 'csrf_code' => $_POST['csrf_code']]);
    }
  }
}
