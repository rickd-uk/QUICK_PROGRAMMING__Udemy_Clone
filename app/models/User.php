<?php

/**
 * users class
 */
class User extends Model
{
  public $errors = [];
  protected $table = "users";

  protected $allowedCols = ['email', 'firstname', 'lastname', 'password', 'role', 'date'];

  public function validate($data)
  {

    $this->errors = [];

    if (empty($data['firstname'])) {
      $this->errors['firstname'] = "A first name is required";
    }
    if (empty($data['lastname'])) {
      $this->errors['lastname'] = "A last name is required";
    }
    $query = "SELECT * FROM users WHERE email = :email limit 1";
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
      $this->errors['email'] = "An email is not valid";
    } else {
      // check email
      if ($this->query($query, ['email' => $data['email']])) {
        $this->errors['email'] = "Email already exists";
      }
    }
    if (empty($data['password'])) {
      $this->errors['password'] = "A password is required";
    } else   if ($data['password'] !== $data['retype_password']) {
      $this->errors['password'] = "Passwords must match";
    }
    if (empty($data['terms'])) {
      $this->errors['terms'] = "Please accept the terms & conditions";
    }

    if (empty($this->errors)) {
      return true;
    }

    return false;
  }
}
