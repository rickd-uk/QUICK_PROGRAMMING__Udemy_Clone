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
    'get_permissions'
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

  protected function get_permissions($data)
  {

    if (!empty($data[0]->id) && !empty($data[0]->role)) {

      foreach ($data as $key => $row) {
        $query = "SELECT permission FROM permissions_map WHERE role_id = :role_id && disabled = 0 ";
        $res = $this->query($query, ['role_id' => $row->id]);


        if ($res) {
          $data[$key]->permissions = array_column($res, 'permission');
        }
      }
    }
    return $data;
  }
}
