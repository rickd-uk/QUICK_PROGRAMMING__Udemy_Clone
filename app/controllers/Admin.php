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
    $id = $id == null ? Auth::getId() : $id;

    $user = new User();
    $data['row'] = $user->where(['id' => $id], 'one');

    $data['title'] = "Profile";

    $this->view('admin/profile', $data);
  }
}
