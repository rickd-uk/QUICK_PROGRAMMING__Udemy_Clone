<?php

/**
 * signup class
 */
class Signup extends Controller
{
  public function index()
  {
    $data['errors'] = [];

    $user = new User();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      if ($user->validate($_POST)) {

        $_POST['role'] = 'user';
        $_POST['date'] = date("Y-m-d H:i:s");

        $user->insert($_POST);

        display_message("Your profile was successfully created");
        redirect('login');
      }
    }


    $data['errors'] = $user->errors;
    $data['title'] = "Signup";

    $this->view('signup', $data);
  }
}


// $db = new Database();
// $db->create_tables();
