<?php

class App
{

  function __construct($str = 'default')
  {
    print_r($this->getURL());
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
