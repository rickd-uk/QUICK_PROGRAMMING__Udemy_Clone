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

    // $ct = new Create_Table();
    // $db->user();

    $data['title'] = "Home";

    $this->view('home', $data);
  }
}
