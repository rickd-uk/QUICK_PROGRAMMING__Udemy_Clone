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

    $stm = $con->prepare($query);
    if ($stm) {
      $check = $stm->execute($data);
      if ($check) {

        if ($type == 'obj') {
          $type = PDO::FETCH_OBJ;
        } else if ($type == 'arr') {
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

  public function create_tables()
  {
    $query = "
    CREATE TABLE IF NOT EXISTS `users` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `firstname` varchar(30) NOT NULL,
      `lastname` varchar(30) NOT NULL,
      `email` varchar(100) NOT NULL,
      `password` varchar(255) NOT NULL,
      `date` date DEFAULT NULL,
      PRIMARY KEY (`id`),
      KEY `firstname` (`firstname`),
      KEY `lastname` (`lastname`),
      KEY `date` (`date`),
      KEY `email` (`email`)
     ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8
    ";

    $this->query($query);
  }
}
