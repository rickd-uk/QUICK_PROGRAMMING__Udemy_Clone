<?php

if (!defined('ROOT')) die('direct script access denied');
/**
 * ajax class
 */
class Ajax extends Controller
{
  public function index()
  {

    $data['title'] = "Ajax";

    // $this->view('ajax', $data);
  }

  public function course_edit($user_id = null, $id = null)
  {
    $course = new Course_model();
    $category = new Category_model();
    $language = new Language_model();
    $level = new Level_model();
    $price = new Price_model();
    $currency = new Currency_model();

    $data['categories'] = $category->findAll('ASC');
    $data['languages'] = $language->findAll('ASC');
    $data['levels'] = $level->findAll('ASC');
    $data['prices'] = $price->findAll('ASC');
    $data['currencies'] = $currency->findAll('ASC');

    $data['title'] = "Ajax";
    $data['row'] = $row = $course->where(['user_id' => $user_id, 'id' => $id], '', 'one');
    $this->view("course-edit-tabs/course-landing-page", $data);
  }
}
