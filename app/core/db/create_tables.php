<?php

/**
 * db_tasks class
 */
class DB_Tasks extends Database
{
  public function create_user_table()
  {
    $query = "
    CREATE TABLE IF NOT EXISTS `users` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `firstname` varchar(30) NOT NULL,
      `lastname` varchar(30) NOT NULL,
      `email` varchar(100) NOT NULL,
      `password` varchar(255) NOT NULL,
      `role` varchar(20) NOT NULL,
      `date` date DEFAULT NULL,
      `about` varchar(2048) DEFAULT NULL,
      `company` varchar(50) DEFAULT NULL,
      `job` varchar(30) DEFAULT NULL,
      `country` varchar(30) DEFAULT NULL,
      `address` varchar(1024) DEFAULT NULL,
      `phone` varchar(10) DEFAULT NULL,
      `slug` varchar(100) NOT NULL,
      PRIMARY KEY (`id`),
      KEY `firstname` (`firstname`),
      KEY `lastname` (`lastname`),
      KEY `date` (`date`),
      KEY `email` (`email`),
      KEY `slug` (`slug`)
     ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8
    ";

    $this->query($query);
  }
}
