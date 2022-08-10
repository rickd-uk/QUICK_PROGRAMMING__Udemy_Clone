<?php

class Model extends Database
{
  protected $table = "";
  public function insert($data)
  {
    // Remove unwanted cols
    if (!empty($this->allowedCols)) {
      foreach ($data as $key => $value) {
        if (!in_array($key, $this->allowedCols)) {
          unset($data[$key]);
        }
      }
    }
    $keys = array_keys($data);
    // $values = array_values($data);

    $query = "INSERT INTO " . $this->table;
    $query .= "(" . implode(",", $keys) . ") VALUES (:" . implode(", :", $keys) . ")";

    $this->query($query, $data);
  }

  // $get '' by default which returns multiple records
  // if $get is 'one' then one record is retrieved
  public function where($data, $get = '')
  {
    $keys = array_keys($data);
    $query = "SELECT * FROM " . $this->table . " where ";

    foreach ($keys as $key) {
      $query .= $key . "=:" . $key . " && ";
    }
    $query = trim($query, "&& ");

    // if one record is required then limit it
    if ($get === 'one') {
      $query .= " ORDER BY id DESC LIMIT 1";
    }
    $res = $this->query($query, $data);

    if (is_array($res)) {

      // if one record is needed then return first in array
      return $get === 'one' ? $res[0] : $res;
    }

    return false;
  }
}
