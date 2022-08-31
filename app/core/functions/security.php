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
  $role = Auth::getRole_ID();
  $permission = strtolower($permission);

  if (Auth::is_admin()) {
    return true;
  }

  $db = new Database();

  if (Auth::is_logged_in()) {

    $query = "SELECT permission FROM permissions_map WHERE disabled = 0 &&  role_id = :role_id";


    $myroles = $db->query($query, ['role' => $role]);

    if ($myroles) {

      $myroles = array_column($myroles, 'permission');
    } else {
      $myroles = [];
    }

    if (in_array($permission, $myroles)) {
      return true;
    }
  }

  return false;
}
