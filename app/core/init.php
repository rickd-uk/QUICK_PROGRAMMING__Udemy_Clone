<?php

spl_autoload_register(function ($class_name) {
  require "../app/models/" . $class_name . ".php";
});


require 'config.php';
require 'database.php';
require 'functions.php';
require 'controller.php';
require 'app.php';
