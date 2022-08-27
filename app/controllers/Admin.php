<?php

namespace Controller;

if (!defined('ROOT')) die('direct script access denied');

use \Model\Auth;
use \Model\Slider;
use \Core\Utility;

/**
 * admin class
 */
class Admin extends Controller
{
  protected $destination = '';

  protected $img_filename = '';

  protected $updated_image = false;

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
    $data['row'] = $row = $user->where(['id' => $id],  'first');

    // if profile updated & data retrieved from db
    if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {


      if ($user->edit_validate($_POST, $id)) {

        if (array_key_exists('image', $_FILES)) {

          // Saves profile image
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

    // Get ul dir using the current function name
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

          $row = $course->where(['user_id' => $user_id, 'published' => 0], 'first');

          display_message("Your course was successfully created");

          if ($row) {
            redirect('admin/courses/edit/' . $row->id);
          } else {
            redirect('admin/courses');
          }
        }
        $data['errors'] = $course->errors;
      }
    } elseif ($action == 'delete') {
      $categories = $category->findAll('ASC');
      $languages = $language->findAll('ASC');
      $levels = $level->findAll('ASC');
      $prices = $price->findAll('ASC');
      $currencies = $currency->findAll('ASC');

      // get course info
      $data['row'] = $row = $course->where(['user_id' => $user_id, 'id' => $id], 'first');

      if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {
        $course->delete($row->id);
        display_message('Course delete successfully');
        redirect('admin/courses');
      }
    } elseif ($action == 'edit') {

      $categories = $category->findAll('ASC');
      $languages = $language->findAll('ASC');
      $levels = $level->findAll('ASC');
      $prices = $price->findAll('ASC');
      $currencies = $currency->findAll('ASC');


      // get course info
      $data['row'] = $row = $course->where(['user_id' => $user_id, 'id' => $id], 'first');



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
            Admin::upload_course_image($id, $row, $course, $img_dir);
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

  private static function check_for_img($row)
  {
    //Checks whether there is an image already in the db
    if (empty($row->image)) return true;
    return false;
  }

  public function slider_images()
  {
    Auth::login_to_view();

    // get id from url or logged in user
    $id = Auth::getId() ?? 0;

    $slider = new Slider();
    $data['rows'] = [];
    $rows = $slider->where(['disabled' => 0]);

    if ($rows) {
      foreach ($rows as $key => $obj) {
        $num = $obj->id;
        $data['rows'][$num] = $obj;
      }
    }

    $id = $_POST['id'] ?? 0;

    $row = $slider->where(['id' => $id], 'first');

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      $allowed = ['image/jpeg', 'image/png', 'image/webp'];
      $filename = '';

      if (!empty($_FILES['image']['name'])) {
        $filename = time() . $_FILES['image']['name'];

        // If there is no problem with the image
        if ($_FILES['image']['error'] == 0) {
          // And image is of allowed type
          if (in_array($_FILES['image']['type'], $allowed)) {
            // Add image file name to the global POST -> to be inserted into db
            $_POST['image'] = $filename;
          } else {
            // Image type outside of allowed type
            $slider->errors['image'] = "This file type is not allowed";
          }
        } else {
          // Some undefined problem with image
          $slider->errors['image'] = "Could not upload image";
        }
      }

      $img_empty = Admin::check_for_img($row);


      if ($slider->validate($_POST, $id, $img_empty)) {
        // $path is slider dir & filename

        // If there is a filename
        if (!empty($filename)) {
          $img_path = SLIDER_IMG_UL_DIR . $filename;
          // Move file from temp to previosly set dir
          move_uploaded_file($_FILES['image']['tmp_name'], $img_path);

          // Resize image based on file extension
          resize_image($img_path);

          // if there is a previous image in dir then delete it
          $row && $img_path_db = SLIDER_IMG_UL_DIR . $row->image;

          if (file_exists($img_path_db)) {
            unlink($img_path_db);
          }
        }

        if ($row) {
          unset($_POST['id']);

          $slider->update($id, $_POST);
        } else {

          $slider->insert($_POST);
        }
      }


      if (empty($slider->errors)) {
        $arr['message'] = "Image saved successfully";
      } else {
        $arr['message'] = "Please correct these errors";
        $arr['errors'] = $slider->errors;
      }

      echo json_encode($arr);

      die;
    }

    $data['title'] = "Slider images";
    $data['errors'] = $slider->errors;
    $this->view('admin/slider-images', $data);
  }
  public function categories($action = null, $id = null)
  {
    Auth::login_to_view();

    $user_id = Auth::getId() ?? null;
    $course = new \Model\Course();
    $category = new \Model\Category();
    $language = new \Model\Language();
    $level = new \Model\Level();
    $price = new \Model\Price();
    $currency = new \Model\Currency();

    $data = [];
    $data['errors'] = [];
    $data['action'] = $action;
    $data['id'] = $id;

    // Is the user adding a course
    if ($action == 'add') {

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if ($category->validate($_POST)) {

          $_POST['slug'] = str_to_url($_POST['category']);
          $category->insert($_POST);

          display_message("Your category was successfully created");
          redirect('admin/categories');
        }
        $data['errors'] = $category->errors;
        ss($_POST);
      }
    } elseif ($action == 'delete') {
      // Get category info
      $data['row'] = $row = $category->where(['id' => $id], 'first');

      if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {
        $category->delete($row->id);
        display_message("Your category was successfully deleted");
        redirect('admin/categories');
      }
      $data['errors'] = $category->errors;
    } elseif ($action == 'edit') {
      // Get category info
      $data['row'] = $row = $category->where(['id' => $id], 'first');

      if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {
        if ($category->validate($_POST)) {
          $category->update($row->id, $_POST);

          display_message("Your category was successfully edited");
          redirect('admin/categories');
        }
        $data['errors'] = $category->errors;
      }
    } else {
      // category view
      $data['rows'] = $category->findAll();
    }
    $this->view('admin/categories', $data);
  }
}
