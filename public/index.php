<?php

class App
{

  protected $controller = '_404';

  function __construct()
  {

    $arr = $this->getURL();

    // ucfirst: capitalizes the first letter
    $filename = "../app/controllers/" . ucfirst($arr[0]) . ".php";
    if (file_exists($filename)) {
      // require: if not found will shut down program
      // include if not found will continue
      require $filename;
      $this->controller = $arr[0];
    } else {
      require "../app/controllers/" . $this->controller . ".php";
    }
    $mycontroller = new $this->controller();
  }

  private function getURL()
  {
    $url = $_GET['url'] ?? 'home';

    // filter out any unwanted chars
    $url = filter_var($url, FILTER_SANITIZE_URL);

    // Split url params into array
    $arr = explode("/", $url);

    return $arr;
  }
}

$app = new App('main');
