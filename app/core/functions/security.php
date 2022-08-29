<?php

use Model\Auth;

function csrf(): void
{
  $code = md5(time());
  $_SESSION['csrf_code'] = $code;
  echo "<input id='js-csrf_code' name='csrf_code' type='hidden' value='$code' />";
}

function user_can(string $permission): bool
{
  $role = Auth::getRole();
  $permission = strtolower($permission);

  if (Auth::is_admin()) {
    return true;
  }



  if (Auth::is_logged_in()) {
    $roles['user'] = ['edit_categories'];
    $roles['admin'] = ['add_categories', 'edit_categories', 'delete_categories'];


    if (in_array($permission, $roles[$role])) {
      return true;
    }
  }

  return false;
}
