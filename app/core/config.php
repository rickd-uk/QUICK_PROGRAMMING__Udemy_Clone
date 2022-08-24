<?php
// App Info
define('APP_NAME', 'Udemy+');
define('APP_DESC', 'Free and paid tuts.');

if ($_SERVER['SERVER_NAME'] == 'localhost') {

  // db config for localhost
  define('DB_HOST', 'localhost');
  define('DB_NAME', 'udemy');
  define('DB_USER', 'rick');
  define('DB_PW', '123456');
  define('DB_DRIVER', 'mysql');

  // root path 
  define('ROOT', 'http://localhost:8895/udemy/public');

  // image dirs
  define('UL_DIR', 'uploads/');
  define('UL_IMG', '/uploads/images/');
  define('IMG_ASSETS', '/assets/images/');
  define('IMG_PLACEHOLDER', 'image_placeholder.jpg');
  define('USERS_UL_DIR', 'uploads/users/');
  define('COURSES_UL_DIR', 'uploads/courses/');
  define('SLIDER_IMG_UL_DIR', 'uploads/slider_images/');
} else {

  // db config for web host
  define('DB_HOST', 'localhost');
  define('DB_NAME', 'udemy');
  define('DB_USER', 'rick');
  define('DB_PW', '123456');
  define('DB_DRIVER', 'mysql');

  // root path 
  define('ROOT', 'https://www.website.com');
}
