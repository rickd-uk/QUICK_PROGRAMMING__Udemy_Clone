<?php

namespace Controller;


if (!defined("ROOT")) die("direct script access denied");

/**
 * category class
 */


class Category extends Controller
{
  public function index()
  {
    // $ad = new Add_Data();
    // $ad->to('test');
    $data['title'] = "Category";

    $category = new \Model\Category();

    $data['rows'] = $category->query("SELECT c.*, category, cat.slug as cat_slug FROM `courses` AS c JOIN categories AS cat ON cat.id = c.category_id WHERE cat.slug = 'it-software'");


    // if ($data['rows']) {
    //   $data['first_row'] = $data['rows'][0];
    //   // Remove first post so it won't be repeated
    //   unset($data['rows'][0]);

    //   $total_rows = count($data['rows']);
    //   $half_rows = round($total_rows / 2);

    //   $data['rows1'] = array_splice($data['rows'], 0, $half_rows);
    //   $data['rows2'] = $data['rows'];
    // }


    $this->view('category', $data);
  }
}
