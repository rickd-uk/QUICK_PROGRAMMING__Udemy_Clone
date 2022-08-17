<?php


function set_selected($key, $value, $default = '')
{

  if (!empty($_POST[$key])) {
    if ($value == $_POST[$key]) {
      return ' selected ';
    }
  } else
	if (!empty($default)) {
    if ($value == $default) {
      return ' selected ';
    }
  }

  return '';
}

function keep_selected($index, $post)
{
  $category_id = $post['category_id'] ?? null;
  if (isset($category_id) && $index == $category_id)
    return 'selected';
  return '';
}
