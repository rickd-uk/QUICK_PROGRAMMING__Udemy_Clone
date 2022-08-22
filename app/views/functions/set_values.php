<?php


function set_value($key, $default = '')
{
  ss('set_value');
  ss($_POST[$key]);
  if (!empty($_POST[$key])) {

    return $_POST[$key];
  } else 
  if (!empty($default)) {
    return $default;
  }
  return '';
}
