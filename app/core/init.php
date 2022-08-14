<?php

spl_autoload_register(function ($class_name) {
  require "../app/models/" . $class_name . ".php";
});


require 'config.php';
require 'db/database.php';
require 'model.php';
require 'functions/index.php';
require 'controller.php';
require 'app.php';
