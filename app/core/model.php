<?php

class Model extends Database
{
  protected $table = "";

  private function remove_unwanted_cols($data)
  {
    // Remove unwanted cols
    if (!empty($this->allowedCols)) {
      foreach ($data as $key => $value) {
        if (!in_array($key, $this->allowedCols)) {
          unset($data[$key]);
        }
      }
    }
    return $data;
  }
  public function insert($data)
  {
    $data = $this->remove_unwanted_cols($data);

    $keys = array_keys($data);
    // $values = array_values($data);

    $query = "INSERT INTO " . $this->table;
    $query .= "(" . implode(",", $keys) . ") VALUES (:" . implode(", :", $keys) . ")";

    $this->query($query, $data);
  }

  public function update($id, $data)
  {
    $data = $this->remove_unwanted_cols($data);

    $keys = array_keys($data);
    $query = "UPDATE " . $this->table . " SET ";

    foreach ($keys as $key) {
      $query .= $key . "=:" . $key . ",";
    }
    $query = trim($query, ",");
    $query .= " WHERE id = :id";

    $data['id'] = $id;

    $this->query($query, $data);
  }

  // $get '' by default which returns multiple records
  // if $get is 'one' then one record is retrieved
  public function where($data, $order = 'DESC', $get = '')
  {
    $keys = array_keys($data);
    $query = "SELECT * FROM " . $this->table . " where ";

    // add the keys to build the wuery
    foreach ($keys as $key) {
      $query .= $key . "=:" . $key . " && ";
    }
    $query = trim($query, "&& ");

    // if one record is required then limit it
    if ($get === 'one') {
      $query .= " ORDER BY id $order LIMIT 1";
    } else {
      $query .= " ORDER BY id $order ";
    }
    // result of query
    $res = $this->query($query, $data);

    // if it is an array process it
    if (is_array($res)) {

      // Calls the protected functions in the course model
      // run afterSelect functions
      if (property_exists($this, 'afterSelect')) {
        foreach ($this->afterSelect as $func) {
          $res = $this->$func($res);
        }
      }

      // if one record is needed then return first in array
      return $get === 'one' ? $res[0] : $res;
    }

    return false;
  }

  public function findAll($order = 'ASC')
  {
    $query = "SELECT * FROM " . $this->table . " ORDER BY ID " . $order;
    $res = $this->query($query);

    if (is_array($res)) {

      // Calls the protected functions in the course model
      // run afterSelect functions
      if (property_exists($this, 'afterSelect')) {
        foreach ($this->afterSelect as $func) {
          $res = $this->$func($res);
        }
      }
      return $res;
    }
    return false;
  }
}
