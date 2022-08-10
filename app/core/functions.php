<?php

function show($stuff)
{
  echo "<pre>";
  print_r($stuff);
  echo "</pre>";
}

function show_stop($stuff)
{
  show($stuff);
  die();
}

function print_var_name($var)
{
  foreach ($GLOBALS as $var_name => $value) {
    if ($value === $var) {
      return $var_name;
    }
  }
  return false;
}

function set_value($key)
{
  if (!empty($_POST[$key])) {
    return $_POST[$key];
  }
  return '';
}
