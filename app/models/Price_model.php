<?php

/**
 * price class
 */
class Price_model extends Model
{
  public $errors = [];
  protected $table = "prices";

  protected $allowedCols = [
    'name', 'price', 'disabled'
  ];

  public function validate($data)
  {
    $this->errors = [];

    if (empty($data['name'])) {
      $this->errors['name'] = "Enter name";
    } else
    if (empty($data['price'])) {
      $this->errors['price'] = "A  name is required";
    }
    if (empty($this->errors)) {
      return true;
    }
    return false;
  }
}
