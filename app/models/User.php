<?php

/**
 * users class
 */
class User
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
    if (empty($data['email'])) {
      $this->errors['email'] = "An email is required";
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

  public function insert($data)
  {
    // Remove unwanted cols
    if (!empty($this->allowedCols)) {
      foreach ($data as $key => $value) {
        if (!in_array($key, $this->allowedCols)) {
          unset($data[$key]);
        }
      }
    }
    $keys = array_keys($data);
    // $values = array_values($data);

    $query = "INSERT INTO users ";
    $query .= "(" . implode(",", $keys) . ") VALUES (:" . implode(", :", $keys) . ")";

    $db = new Database();
    show($query);
    show($data);
    $db->query($query, $data);
  }
}
