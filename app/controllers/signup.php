<?php

/**
 * signup class
 */
class Signup extends Controller
{
  public function index()
  {

    show($_POST);
    $data['title'] = "Signup";

    $this->view('signup', $data);
  }
}


// $db = new Database();
// $db->create_tables();
