<?php

class Database
{
  private function connect()
  {
    $str = DB_DRIVER . ":hostname=" . DB_HOST . "dbname=" . DB_NAME;
    return new PDO($str, DB_USER, DB_PW);
  }

  public function query($query, $data = [], $type = 'obj')
  {
    $con = $this->connect();

    $stm = $con->prepare($query);
    if ($stm) {
      $check = $stm->execute($data);
      if ($check) {
        $type = PDO::FETCH_OBJ;
        if ($type != 'obj') {
          $type = PDO::FETCH_ASSOC;
        }
        $result = $stm->fetchAll($type);

        if (is_array($result) && count($result) > 0) {
          return $result;
        }
      }
    }
    return false;
  }
}
