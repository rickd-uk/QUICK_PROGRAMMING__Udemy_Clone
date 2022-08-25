<?php

namespace Controller;

use Core\Add_Data;
use Create_Table;
use Model\Slider;

if (!defined("ROOT")) die("direct script access denied");

/**
 * home class
 */

class Home extends Controller
{
  public function index()
  {
    $ct = new Create_Table();
    $ct->for('test');

    $ad = new Add_Data();
    $ad->to('test');

    // $add_data = new Add_Data();
    // $add_data->languages();

    // $ct = new Create_Table();
    // $db->user();

    $data['title'] = "Home";

    $course = new \Model\Course();
    // Read all courses
    //TODO: Was set to 'DESC' before
    $data['rows'] = $course->where(['approved' => 0], 7);

    // Read all courses, order by trending value
    $query = "SELECT * FROM courses WHERE approved = 0 ORDER BY trending DESC LIMIT  5";
    $data['trending'] = $course->query($query);

    if ($data['rows']) {
      $data['first_row'] = $data['rows'][0];
      // Remove first post so it won't be repeated
      unset($data['rows'][0]);

      $total_rows = count($data['rows']);
      $half_rows = round($total_rows / 2);



      $data['rows1'] = array_splice($data['rows'], 0, $half_rows);
      $data['rows2'] = $data['rows'];
    }

    // Load slider images
    $slider = new Slider();
    $slider->order = 'ASC';
    $data['images'] = $slider->where(['disabled' => 0]);



    $this->view('home', $data);
  }
}
