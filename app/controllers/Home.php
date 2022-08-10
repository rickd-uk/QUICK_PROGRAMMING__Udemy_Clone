<?php

/**
 * home class
 */
class Home extends Controller
{
  public function index()
  {
    $db = new DB_Tasks();
    // $db->create_tables();
    $db->create_user_table();

    $data['title'] = "Home";

    $this->view('home', $data);
  }
}
