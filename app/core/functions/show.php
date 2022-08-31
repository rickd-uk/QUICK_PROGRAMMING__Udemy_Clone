<?php

function show($stuff)
{
  echo "<pre>";
  print_r($stuff);
  echo "</pre>";
}

function ss($stuff)
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


function esc($str)
{
  return nl2br(htmlspecialchars($str));
}

function display($row, $field)
{
  return esc($row->$field);
}

function display_img($row, $field)
{
  if (!empty($row->$field)) {
    return (esc(ROOT . '/' . USERS_UL_DIR . $row->$field));
  }
  return esc(ROOT . DEFAULT_PROFILE_IMG);
}

function display_img_from_session()
{
  $img = get_session_data('image');
  if ($img) {
    return esc(USERS_UL_DIR . $img ?? DEFAULT_PROFILE_IMG);
  }
  return DEFAULT_PROFILE_IMG;
}


function show_error_msg($errors, $field)
{
  if (!empty($errors[$field])) : ?>
    <small class="text-danger"><?= $errors[$field] ?></small>
<?php endif;
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
