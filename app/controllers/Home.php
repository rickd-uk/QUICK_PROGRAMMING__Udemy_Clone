<?php

if (!defined('ROOT')) die('direct script access denied');
/**
 * home class
 */
class Home extends Controller
{
  public function index()
  {

    // $add_data = new Add_Data();
    // $add_data->languages();
    // $db = new Create_Tables();
    // $db->user_table();

    $data['title'] = "Home";

    $this->view('home', $data);
  }
}
