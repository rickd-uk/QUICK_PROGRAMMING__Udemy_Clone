<?php

namespace Model;

/**
 * categories class
 */
class Category extends Model
{
  public $errors = [];
  protected $table = "categories";

  protected $allowedCols = [
    'category', 'disabled', 'slug'
  ];

  public function validate($data)
  {
    $this->errors = [];

    if (empty($data['category'])) {
      $this->errors['category'] = "Enter category";
    } else
    if (!preg_match("/^[a-zA-Z ]+$/", trim($data['category']))) {
      $this->errors['category'] = "Category can only have letters and spaces";
    }
    if (empty($this->errors)) {
      return true;
    }
    return false;
  }
}
