<?php

/**
 * category class
 */
class Category_model extends Model
{
  public $errors = [];
  protected $table = "categories";

  protected $allowedCols = [
    'category', 'disabled',
  ];

  public function validate($data)
  {
    $this->errors = [];

    if (empty($data['category'])) {
      $this->errors['category'] = "Enter category";
    } else
    if (!preg_match("/^[a-zA-Z ]+$/", trim($data['firstname']))) {
      $this->errors['firstname'] = "Category can only have letters and spaces";
    }
    if (empty($this->errors)) {
      return true;
    }
    return false;
  }
}
