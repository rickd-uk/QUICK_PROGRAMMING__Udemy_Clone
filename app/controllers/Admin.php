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

    if (!Auth::is_logged_in()) {
      display_message('Please login to view the admin section');
      redirect('login');
    }

    $data['title'] = "Dashboard";

    $this->view('admin/dashboard', $data);
  }

  public function profile($id = null)
  {
    if (!Auth::is_logged_in()) {
      display_message('Please login to view the admin section');
      redirect('login');
    }
    $id = $id == null ? Auth::getId() : $id;

    $user = new User();
    $data['row'] = $row = $user->where(['id' => $id], 'one');

    if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
      $user->update($id, $_POST);
      redirect('admin/profile/' . $id);
    }

    $data['title'] = "Profile";

    $this->view('admin/profile', $data);
  }
}
