<?php

namespace Controller;

if (!defined('ROOT')) die('direct script access denied');
/**
 * single course class
 */

class Course extends Controller
{
  public function index()
  {
    $data['title'] = "Home";

    $course = new \Model\Course();
    // Read all courses
    //TODO: Was set to 'DESC' before
    $data['rows'] = $course->where(['approved' => 0]);

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
      // ss($data['rows']);
    }

    $this->view('home', $data);
  }
}
