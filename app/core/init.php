<?php

spl_autoload_register(function ($class_name) {
  $parts = explode("\\", $class_name);
  // array_pop and end equivalent
  $class_name = end($parts);
  require_once "../app/models/" . $class_name . ".php";
});

require 'config.php';
require 'db/database.php';
require 'model.php';
require 'functions/index.php';
require 'utility.php';
require 'controller.php';
require 'app.php';
