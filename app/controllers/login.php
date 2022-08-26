<?php

namespace Controller;

/**
 * login class
 */

use \Model\Auth;
use \Model\User;

class Login extends Controller
{
  public function index()
  {
    $data['title'] = "Login";
    $data['errors'] = [];
    $user = new User();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      // validate
      $row = $user->where(([
        'email' => $_POST['email']
      ]), 'first');

      if ($row) {

        if (password_verify($_POST['password'], $row->password)) {
          //authenticate
          Auth::authenticate($row);
          unset($row->password);

          $_SESSION['USER_DATA']->image = $row->image;

          redirect('home');
        }
      }
      $data['errors']['email'] = "Wrong email or password";
    }

    $this->view('login', $data);
  }
}
