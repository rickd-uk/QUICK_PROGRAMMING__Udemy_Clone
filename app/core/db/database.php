<?php


class Database
{
  private function connect()
  {
    $str = DB_DRIVER . ":hostname=" . DB_HOST . ";dbname=" . DB_NAME;
    return new PDO($str, DB_USER, DB_PW);
  }

  public function query($query, $data = [], $type = 'obj')
  {
    $con = $this->connect();
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stm = $con->prepare($query);

    if ($stm) {

      try {
        $stm->execute($data);
        if ($type == 'obj') {
          $type = PDO::FETCH_OBJ;
        } else if ($type == 'arr') {
          $type = PDO::FETCH_ASSOC;
        }
        $result = $stm->fetchAll($type);

        if (is_array($result) && count($result) > 0) {

          // Calls the protected functions in the course model
          // run afterSelect functions
          if (property_exists($this, 'afterSelect')) {

            foreach ($this->afterSelect as $func) {

              $result = $this->$func($result);
            }
          }

          return $result;
        }
      } catch (PDOException $e) {
        return false;
        //echo "Error: " . $e;
      }
    }
    #TODO:  changed from false
    return [];
  }
}
