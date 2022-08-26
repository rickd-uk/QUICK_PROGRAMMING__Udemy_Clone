<?php

namespace Model;

/**
 * slider class
 */
class Slider extends Model
{
  public $errors = [];
  protected $table = "slider_images";

  protected $allowedCols = [
    'id', 'image', 'title', 'description', 'disabled'
  ];

  public function validate($data, $id, $img_empty)
  {
    $this->errors = [];

    $this->validate_empty($data, 'title');
    $this->validate_empty($data, 'description');
    $img_empty && $this->validate_empty($data, 'image');

    if (empty($this->errors)) {
      return true;
    }
    return false;
  }
}
