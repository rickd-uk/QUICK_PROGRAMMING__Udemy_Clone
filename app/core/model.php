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


  public function where($data)
  {
    $keys = array_keys($data);


    $query = "SELECT * FROM " . $this->table . " where ";

    foreach ($keys as $key) {
      $query .= $key . "=:" . $key . " && ";
    }
    $query = trim($query, "&& ");

    $res = $this->query($query, $data);

    if (is_array($res)) {
      return $res;
    }
    return false;
  }
}
