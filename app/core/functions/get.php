<?php

use \Model\Category;

function get_categories($id = null)
{
  $category = new Category();

  if ($id) {
    $category->limit = 1;
    return $data['categories'] = $category->where(['disabled' => 0, 'id' => $id]);
  }
  $category->limit = 20;
  return $data['categories'] = $category->where(['disabled' => 0]);
}
