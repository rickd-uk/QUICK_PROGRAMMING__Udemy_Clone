<?php

namespace Model;

/**
 * currency class
 */
class Currency extends Model
{
  public $errors = [];
  protected $table = "currencies";

  protected $allowedCols = [
    'symbol', 'currency', 'disabled'
  ];

  public function validate($data)
  {
    $this->errors = [];

    if (empty($data['currency'])) {
      $this->errors['currency'] = "Enter currency";
    } else
    if (empty($data['symbol'])) {
      $this->errors['symbol'] = "A symbol is required";
    }
    if (empty($this->errors)) {
      return true;
    }
    return false;
  }
}
