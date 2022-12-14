<?php

namespace Model;



if (!defined('ROOT')) die('direct script access denied');

/**
 *
 * authentication class
 */
class Auth
{
  public static function authenticate($row)
  {
    if (is_object($row)) {
      $_SESSION['USER_DATA'] = $row;
    }
  }

  public static function login_to_view()
  {
    if (!Auth::is_logged_in()) {
      display_message('Please login to view the admin section');
      redirect('login');
    }
  }


  public static function logout()
  {
    if (!empty($_SESSION['USER_DATA'])) {
      unset($_SESSION['USER_DATA']);

      // CAUTION! these methods will clear all session data for user
      // it will affect other data which may be needed, like shopping cart
      // session_unset();
      // session_regenerate_id();
    }
  }

  private static function session_data_exists()
  {
    return !empty($_SESSION['USER_DATA']) ? true : false;
  }

  private static function get_session_data()
  {
    return self::session_data_exists() ? $_SESSION['USER_DATA'] : false;
  }

  public static function is_logged_in()
  {
    return self::session_data_exists();
  }
  public static function is_admin()
  {
    if (self::session_data_exists()) {
      $user_data = $_SESSION['USER_DATA'];
      if (!empty($user_data->role_name)) {
        if (strtolower($user_data->role_name) == 'admin') {
          return true;
        }
      }
    }
    return false;
  }

  public static function __callStatic($funcname, $arg)
  {
    $key = str_replace("get", "", strtolower($funcname));
    if (self::session_data_exists()) {
      return self::get_session_data()->$key;
    }
    return '';
  }
  private static function getfirstname()
  {
  }
  private static function getlastname()
  {
  }
  private static function getid()
  {
  }
  // private static function getRole_ID()
  // {
  // }
}
