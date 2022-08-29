<?php

namespace Controller;

/**
 * controller class
 */

use \Core\Utility;

class Controller extends Utility
{
  public function view($view, $data = [])
  {
    extract($data);
    $filename = "../app/views/" . $view . ".view.php";

    if (file_exists($filename)) {
      require $filename;
    } else {
      echo "could not find view file: " . $filename;
    }
  }
  public static function view_static($view, $data = ['', ''])
  {
    extract($data);
    $filename = "../app/views/" . $view . ".view.php";

    if (file_exists($filename)) {
      require $filename;
    } else {
      echo "could not find view file: " . $filename;
    }
  }

  public static function view_breadcrumbs($view, $menu_item)
  {
    $filename = "../app/views/" . $view . ".view.php";
    if (file_exists($filename)) {
      require $filename;
    } else {
      echo "could not find view file: " . $filename;
    }
  }
}
