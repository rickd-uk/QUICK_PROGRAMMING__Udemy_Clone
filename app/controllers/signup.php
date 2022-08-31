<?php

namespace Controller;

/**
 * signup class
 */
class Signup extends Controller
{
  public function index()
  {
    $data['errors'] = [];

    $user = new \Model\User();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      if ($user->validate($_POST)) {

        $_POST['role_id'] = 1;
        $_POST['date'] = get_date();
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $res = $user->insert($_POST);


        if ($res) {
          display_message("Your profile was successfully created");
        } else {
          display_message("There was a problem creating your account");
        }
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
