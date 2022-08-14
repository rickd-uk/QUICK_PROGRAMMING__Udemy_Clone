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

  public function create_courses_table()
  {
    $query = "
    CREATE TABLE `courses` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `title` varchar(150) NOT NULL,
      `description` text,
      `user_id` int(11) NOT NULL,
      `category_id` int(11) NOT NULL,
      `sub_category_id` int(11) DEFAULT NULL,
      `level_id` int(11) DEFAULT NULL,
      `language_id` int(11) DEFAULT NULL,
      `price_id` int(11) DEFAULT NULL,
      `promo_link` varchar(1024) DEFAULT NULL,
      `welcome_message` varchar(2048) DEFAULT NULL,
      `congratulations_message` varchar(2048) DEFAULT NULL,
      `primary_subject` varchar(100) DEFAULT NULL,
      `course_promo_video` varchar(1024) DEFAULT NULL,
      `course_image` varchar(1024) DEFAULT NULL,
      `date` datetime DEFAULT NULL,
      `tags` varchar(2048) DEFAULT NULL,
      `approved` tinyint(1) NOT NULL DEFAULT '0',
      `published` tinyint(1) NOT NULL DEFAULT '0',
      PRIMARY KEY (`id`),
      KEY `title` (`title`),
      KEY `user_id` (`user_id`),
      KEY `category_id` (`category_id`),
      KEY `sub_category_id` (`sub_category_id`),
      KEY `level_id` (`level_id`),
      KEY `language_id` (`language_id`),
      KEY `price_id` (`price_id`),
      KEY `primary_subject` (`primary_subject`),
      KEY `date` (`date`),
      KEY `approved` (`approved`),
      KEY `published` (`published`)
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8
    ";
  }
}
