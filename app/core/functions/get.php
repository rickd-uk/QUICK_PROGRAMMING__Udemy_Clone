<?php

use \Model\Category;

function get_categories($id = null)
{
  $category = new Category();

  if ($id) {
    $category->limit = 1;
    return $data['categories'] = $category->where(['disabled' => 0, 'id' => $id]);
  }
  $category->order = 'ASC';
  $category->limit = 20;
  return $data['categories'] = $category->where(['disabled' => 0]);
}

function get_session_data($index, $root = 'USER_DATA')
{
  return $_SESSION[$root]->$index;
}
