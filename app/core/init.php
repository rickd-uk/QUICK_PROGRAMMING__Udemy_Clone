<?php

spl_autoload_register(function ($class_name) {
  $parts = explode("\\", $class_name);
  // array_pop and end equivalent
  $class_name = end($parts);
  if ($class_name != 'Create_Table' || $class_name != 'Add_Data') {
    require_once "../app/models/" . $class_name . ".php";
  }
});

require 'config.php';
require 'roles.php';
require 'autoload.php';
require 'db/database.php';
require 'db/db_functions.php';
require 'model.php';
require 'functions/index.php';
require 'utility.php';
require 'controller.php';
require 'app.php';
