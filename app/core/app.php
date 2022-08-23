<?php
class App
{
  protected $controller = '_404';
  protected $method = 'index';

  public static $page = "_404";

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
      self::$page = ucfirst($arr[0]);
      unset($arr[0]);
    } else {
      require "../app/controllers/" . $this->controller . ".php";
    }

    // Changed
    $mycontroller = new ("Controller\\" . $this->controller)();
    $mymethod = $arr[1] ?? $arr[0];
    $mymethod = str_replace('-', '_', $mymethod);


    if (!empty($mymethod)) {
      if (method_exists($mycontroller, strtolower($mymethod))) {
        $this->method = strtolower($mymethod);
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

    // mb_substr() for utf-8
    if (substr($url, -1) != '/') $url = $url . '/';

    // Split url params into array
    $arr = explode("/", $url);

    return $arr;
  }
}
