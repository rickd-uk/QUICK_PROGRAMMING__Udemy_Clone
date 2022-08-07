<?php

class Database
{
  private function connect()
  {
    $str = DB_DRIVER . ":hostname=" . DB_HOST . "dbname=" . DB_NAME;
    return new PDO($str, DB_USER, DB_PW);
  }
  public function query()
  {
    $con = $this->connect();
  }
}
