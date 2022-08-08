<?php

/**
 * users class
 */
class User
{
  public $errors = [];
  protected $table = "users";
  public function validate($data)
  {
    $this->errors = [];

    if (empty($data['firstname'])) {
      $this->errors['firstname'] = "A first name is required";
    }
    if (empty($data['lastname'])) {
      $this->errors['lastname'] = "A last name is required";
    }
    if (empty($data['email'])) {
      $this->errors['email'] = "An email is required";
    }
    if (empty($data['password'])) {
      $this->errors['password'] = "A password is required";
    }
    if ($data['password'] !== $data['retype_password']) {
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
