<?php

namespace Model;

/**
 * level class
 */
class Level extends Model
{
  public $errors = [];
  protected $table = "course_levels";

  protected $allowedCols = [
    'level', 'disabled'
  ];

  public function validate($data)
  {
    $this->errors = [];

    if (empty($data['level'])) {
      $this->errors['level'] = "Enter level";
    } else
  
    if (empty($this->errors)) {
      return true;
    }
    return false;
  }
}
