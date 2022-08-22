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

    $course = new Course_model();
    // read all courses
    $data['rows'] = $course->where(['approved' => 0]);

    $this->view('home', $data);
  }
}
