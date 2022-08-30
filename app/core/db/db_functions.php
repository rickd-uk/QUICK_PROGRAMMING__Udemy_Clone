<?php

class DB_Functions extends Database
{
  public function reset_id_on_empty_table($table)
  {
    //  Get count of items in a table (Array Form)
    $query = "SELECT COUNT(*) FROM $table LIMIT 1";
    $res = $this->query($query);
    // Get the number
    $count = current((array)$res[0]);
    // If the count is 0 it means table is empty, if so, we
    // can set the autoincrement
    if ($count == 0) {
      $query = "ALTER TABLE " . $table . " AUTO_INCREMENT = 1";
      $res = $this->query($query);
      if (empty($res)) {
        // say something
      }
    }
  }

  public function reset_id_next($table)
  {
    $query = "ALTER TABLE " . $table . " AUTO_INCREMENT = 1";
    echo $query;
    $res = $this->query($query);
    if (empty($res)) {
      // say something
      echo 'RESET SUCCESSFUL';
    }
  }
}
