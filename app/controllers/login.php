<?php

/**
 * login class
 */
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
      ]), 'one');

      if ($row) {

        if (password_verify($_POST['password'], $row->password)) {
          //authenticate
          Auth::authenticate($row);

          redirect('home');
        }
      }
      $data['errors']['email'] = "Wrong email or password";
    }

    $this->view('login', $data);
  }
}
