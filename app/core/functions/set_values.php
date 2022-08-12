<?php


function set_value($key, $default = '')
{
  if (!empty($_POST[$key])) {
    return $_POST[$key];
  } else 
  if (!empty($default)) {
    return $default;
  }
  return '';
}
