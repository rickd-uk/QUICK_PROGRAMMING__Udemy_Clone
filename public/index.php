<?php

function show($stuff)
{
  echo "<pre>";
  print_r($stuff);
  echo "</pre>";
}

class App
{

  protected $controller = '_404';
  protected $method = 'index';

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
      unset($arr[0]);
    } else {
      require "../app/controllers/" . $this->controller . ".php";
    }

    $mycontroller = new $this->controller();
    $mymethod = $arr[1];

    if (!empty($mymethod)) {
      if (method_exists($mycontroller, $mymethod)) {
        $this->method = $mymethod;
        unset($arr[1]);
      }
    }

    $arr = array_values($arr);
    call_user_func_array([$mycontroller, $this->method], $arr);
  }

  private function getURL()
  {
    $url = $_GET['url'] ?? 'home';

    // filter out any unwanted chars
    $url = filter_var($url, FILTER_SANITIZE_URL);

    // Split url params into array
    $arr = explode("/", $url);

    $arr[1] =  $arr[1] ? strtolower($arr[1]) : $arr[1];

    return $arr;
  }
}

$app = new App('main');
