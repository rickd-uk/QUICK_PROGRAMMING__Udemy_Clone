<?php

/**
 * signup class
 */
class Signup extends Controller
{
  public function index()
  {
    $user = new User();
    $result = $user->validate($_POST);

    var_dump($result);
    show($user->errors);
    $data['title'] = "Signup";

    $this->view('signup', $data);
  }
}


// $db = new Database();
// $db->create_tables();
