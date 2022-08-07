<?php

// 404 page not found page
class _404 extends Controller
{
  public function index()
  {
    $data['title'] = "404";
    $this->view('404', $data);
  }
}
