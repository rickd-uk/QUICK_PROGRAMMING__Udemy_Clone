<?php

namespace Core;

use \Model\Admin;

class Utility
{

  protected static function is_data_type($post, $data_type)
  {
    // Check whether a particular data type exists
    if (!empty($post['data_type']) && $post['data_type'] == $data_type) {
      return true;
    }
    return false;
  }

  protected static function mkdir($dir)
  {
    if (!file_exists($dir)) {
      mkdir($dir, 0777, true);
    }
  }

  protected static function del_file($row)
  {
    if (file_exists($row->course_image_tmp)) {
      unlink($row->course_image_tmp);
    }
  }

  protected function save_image($row, $user)
  {
    $dir = USERS_UL_DIR;
    if (!file_exists($dir)) {
      mkdir($dir, 0777, true);
      // add index.php for security in root & uploads dir
      file_put_contents($dir . "index.php", "");
      file_put_contents("uploads/index.php", "");
    }
    $allowed_images = ['image/jpeg', 'image/png', 'image/webp'];
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

  function upload_course_image($id, $row, $course, $img_dir)
  {
    mkdir($img_dir);

    if (!empty($_FILES['image']['name'])) {

      $file_name = time() . $_FILES['image']['name'];
      $file_path = $img_dir . $file_name;

      move_uploaded_file($_FILES['image']['tmp_name'], $file_path);

      //delete old temp file
      Utility::del_file($row);

      $course->update($id, ['course_image_tmp' => $file_name, 'csrf_code' => $_POST['csrf_code']]);
    }
  }

  protected static function make_dir_add_index($dir)
  {
    $root_dir = explode('/', $dir)[1];
    if (!file_exists($dir)) {
      mkdir($dir, 0777, true);
      file_put_contents($dir . "index.php", "<?php //silence");
      $root_dir && file_put_contents("$root_dir/index.php", "<?php //silence");
    }
  }
}
