<?php

/**
 * admin class
 */
class Admin extends Controller
{
  public function index()
  {
    // $db = new Database();
    // $db->create_tables();

    $data['title'] = "Admin";

    $this->view('admin/dashboard', $data);
  }
}
