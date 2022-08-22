<?php


function resize_image($filename, $max_size = 700)
{
  $ext = explode(".", $filename);
  $ext = strtolower(end($ext));
  $jpg_quality = 90;

  if (file_exists($filename)) {
    switch ($ext) {
      case 'png':
        $image = imagecreatefrompng($filename);
        break;
      case 'gif':
        $image = imagecreatefromgif($filename);
        break;
      case 'jpg':
      case 'jpeg':
        $image = imagecreatefromjpeg($filename);
        break;
      default:
        $image = imagecreatefromjpeg($filename);
        break;
    }
    $src_w = imagesx($image);
    $src_h = imagesy($image);

    if ($src_w > $src_h) {
      $dst_w = $max_size;
      $dst_h = ($src_h / $src_w) * $max_size;
    } else {
      $dst_h = $max_size;
      $dst_w = ($src_w / $src_h) * $max_size;
    }

    $dst_img = imagecreatetruecolor($dst_w, $dst_h);

    // destination img, source img, distance x, distance y, source x, source y, 
    // destination width, destination height
    imagecopyresampled($dst_img, $image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);

    imagedestroy($image);

    switch ($ext) {
      case 'png':
        imagepng($dst_img, $filename);
        break;
      case 'gif':
        imagegif($dst_img, $filename);
        break;
      case 'jpg':
      case 'jpeg':
        imagejpeg($dst_img, $filename, $jpg_quality);
        break;
      default:
        imagejpeg($dst_img, $filename, $jpg_quality);
        break;
    }
    imagedestroy($dst_img);
  }
}

function get_image($file, $db = 'users')
{
  $file_path = UL_DIR . $db . '/' . $file;

  if (file_exists($file_path)) {
    return ROOT . '/' . $file_path;
  }
  return ROOT . IMG_ASSETS . IMG_PLACEHOLDER;
}

function get_video($file_path)
{
  $file_path;
  if (file_exists($file_path)) {
    return ROOT . '/' . $file_path;
  }
  return ROOT . IMG_ASSETS . IMG_PLACEHOLDER;
}
