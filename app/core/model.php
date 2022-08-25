<?php

namespace Model;

use \Database;

class Model extends Database
{
  public $order = 'DESC';
  public $limit = 10;
  public $offset = 0;
  protected $table = "";

  protected $errors = [];

  protected function validate_empty($data, $field, $err_message = null)
  {

    if (empty($data[$field])) {
      // Use first part of field name in string  e.g. currency_id required => currency required
      if (empty($err_message)) {
        $err_message = explode("_", $field)[0] . ' required';
      }
      $this->errors[$field] = $err_message;

      return true;
    }
    return false;
  }

  protected function validate_text($data, $field, $regex, $err_msg)
  {
    if (!preg_match($regex, trim($data[$field]))) {
      $this->errors[$field] = $err_msg;
    }
  }

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
    // ss($id, $data);
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
  // if $get is 'first' then one record is retrieved
  public function where($data, $get = '')
  {
    $keys = array_keys($data);
    $query = "SELECT * FROM " . $this->table . " where ";


    // add the keys to build the wuery
    foreach ($keys as $key) {
      $query .= $key . "=:" . $key . " && ";
    }
    $query = trim($query, "&& ");



    // if one record is required then limit it
    if ($get === 'first') {
      $query .= " ORDER BY id $this->order LIMIT 1";
    } else {
      $query .= " ORDER BY id $this->order LIMIT $this->limit OFFSET $this->offset";
    }

    // result of query
    $res = $this->query($query, $data);


    // if it is an array process it
    if (is_array($res) && !empty($res)) {

      // Calls the protected functions in the course model
      // run afterSelect functions
      if (property_exists($this, 'afterSelect')) {
        foreach ($this->afterSelect as $func) {
          $res = $this->$func($res);
        }
      }
      // $get === 'first' ? ss('$res[0]') : ss('$res');



      // if first record is needed then return first in array
      return $get === 'first' ? $res[0] : $res;
    }

    return false;
  }

  public function findAll()
  {
    $query = "SELECT * FROM " . $this->table . " ORDER BY ID " . $this->order . " LIMIT " . $this->limit . " OFFSET " . $this->offset;
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
