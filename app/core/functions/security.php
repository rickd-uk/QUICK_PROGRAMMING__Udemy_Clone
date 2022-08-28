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
  $permission = strtolower($permission);

  if (Auth::is_logged_in()) {
  }
  $roles['user'] = ['edit_categories'];
  $roles['admin'] = ['edit_categories', 'add_categories'];

  $role = Auth::getRole();
  if (in_array($permission, $roles[$role])) {
    return true;
  }


  return false;
}
