<?php

namespace Model;

/**
 * role mole
 */
class Role extends Model
{
  public $errors = [];
  protected $table = "roles";
  protected $afterSelect = [

    //TODO:
    // 'get_permissions'
  ];
  protected $allowedCols = [
    'role', 'disabled'
  ];

  public function validate($data)
  {
    $this->errors = [];

    $this->validate_empty($data, 'role', 'Enter role')
      || $this->validate_text($data, 'role', "/^[a-zA-Z ']+$/", "Role can only have letters, spaces and '_'");

    if (empty($this->errors)) {
      return true;
    }
    return false;
  }
}
