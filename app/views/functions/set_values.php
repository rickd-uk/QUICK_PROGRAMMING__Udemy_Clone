<?php


function set_value($key, $default = '')
{
  show_stop('set_value');
  show_stop($_POST[$key]);
  if (!empty($_POST[$key])) {

    return $_POST[$key];
  } else 
  if (!empty($default)) {
    return $default;
  }
  return '';
}
