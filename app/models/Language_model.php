<?php

/**
 * language class
 */
class Language_model extends Model
{
  public $errors = [];
  protected $table = "languages";

  protected $allowedCols = [
    'symbol', 'language', 'disabled'
  ];

  public function validate($data)
  {
    $this->errors = [];

    if (empty($data['language'])) {
      $this->errors['language'] = "Enter language";
    } else
    if (empty($data['symbol'])) {
      $this->errors['symbol'] = "A language code is required";
    }
    if (empty($this->errors)) {
      return true;
    }
    return false;
  }
}
