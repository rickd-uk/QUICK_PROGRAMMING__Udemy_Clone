<?php


function resize_image($filename, $max_size = 700)
{
  // $ext = explode(".", $filename);
  // $ext = strtolower(end($ext));
  $jpg_quality = 90;

  $type = mime_content_type($filename);

  if (file_exists($filename)) {




    switch ($type) {
      case 'image/webp':
        $image = imagecreatefromwebp($filename);
        break;
      case 'image/png':
        $image = imagecreatefrompng($filename);
        break;
      case 'image/gif':
        $image = imagecreatefromgif($filename);
        break;
      case 'image/jpeg':
        $image = imagecreatefromjpeg($filename);
        break;
      default:
        $image = imagecreatefromjpeg($filename);
        break;
    }
    $src_w = imagesx($image);
    $src_h = imagesy($image);

    if ($src_w > $src_h) {

      if ($src_w > $max_size) {
        $max_size = $src_w;
      }
      $dst_w = $max_size;
      $dst_h = ($src_h / $src_w) * $max_size;
    } else {
      if ($src_h < $max_size) {
        $max_size = $src_h;
      }
      $dst_h = $max_size;
      $dst_w = ($src_w / $src_h) * $max_size;
    }

    $dst_img = imagecreatetruecolor($dst_w, $dst_h);
    // imagealphablending($dst_img, false);
    // imagesavealpha($dst_img, true);

    // destination img, source img, distance x, distance y, source x, source y, 
    // destination width, destination height
    imagecopyresampled($dst_img, $image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);

    imagedestroy($image);

    switch ($type) {
      case 'image/webp':
        imagewebp($dst_img, $filename);
        break;
      case 'image/png':
        imagealphablending($dst_img, false);
        imagesavealpha($dst_img, true);
        imagepng($dst_img, $filename);
        break;
      case 'image/gif':
        imagegif($dst_img, $filename);
        break;
      case 'image/jpeg':
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


  if (!empty($file) && file_exists($file_path)) {
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
