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

    $data['title'] = "Dashboard";

    $this->view('admin/dashboard', $data);
  }

  public function profile($id = null)
  {
    $data['title'] = "Profile";

    $this->view('admin/profile', $data);
  }

  public function header()
  {
    $data['title'] = "header";

    $this->view('admin/header', $data);
  }
}
