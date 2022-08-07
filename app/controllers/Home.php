<?php

class Home extends Controller
{
  public function index()
  {
    $db = new Database;
    $db->query();

    $data['title'] = "Home";

    $this->view('home', $data);
  }
}
