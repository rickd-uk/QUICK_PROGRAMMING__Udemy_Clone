<?php

/**
 * signup class
 */
class Signup extends Controller
{
  public function index()
  {
    $data['title'] = "Signup";

    $this->view('signup', $data);
  }
}
