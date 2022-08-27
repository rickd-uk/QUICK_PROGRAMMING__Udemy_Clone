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

    $this->validate_empty($data, 'category', 'Enter course title')
      || $this->validate_text($data, 'category', "/^[a-zA-Z ']+$/", "Course titles can only have letters, spaces and '_'");

    if (empty($this->errors)) {
      return true;
    }
    return false;
  }
}
