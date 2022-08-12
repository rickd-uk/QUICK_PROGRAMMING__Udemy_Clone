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

function redirect($link)
{
  header('Location: ' . ROOT . '/' . $link);
  die();
}

function display_message($msg = '', $erase = false)
{
  if (!empty($msg)) {
    $_SESSION['message'] = $msg;
  } else {
    if (!empty($_SESSION['message'])) {
      $msg = $_SESSION['message'];
      if ($erase) {
        unset($_SESSION['message']);
      }
      return $msg;
    }
  }
  return false;
}

function esc($str)
{
  return nl2br(htmlspecialchars($str));
}

function display($row, $field)
{
  return esc($row->$field);
}


function str_to_url($url)
{
  $url = str_replace("'", "", $url);
  $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
  $url = trim($url, "-");
  $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
  $url = strtolower($url);
  $url = preg_replace('~[^-a-z0-9_]+~', '', $url);

  return $url;
}



function show_error_msg2($errors, $field)
{
  if (!empty($errors[$field])) : ?>
    <small class="text-danger"><?= $errors[$field] ?></small>
<?php endif;
}
