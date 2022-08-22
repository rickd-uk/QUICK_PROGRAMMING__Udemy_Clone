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
    $data['rows'] = $course->where(['approved' => 0], 'DESC', '', 7);

    if ($data['rows']) {
      $data['first_r'] = $data['rows'][0];

      $total_rows = count($data['rows']);
      $half_rows = round($total_rows / 2);

      $data['rows1'] = array_splice($data['rows'], 0, $half_rows);
      $data['rows2'] = array_splice($data['rows'], $half_rows, $total_rows);

      show($total_rows);
    }



    $this->view('home', $data);
  }
}
