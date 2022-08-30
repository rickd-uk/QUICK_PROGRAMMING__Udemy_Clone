<?php


function set_value($key, $default = '')
{
  if (!empty($_POST[$key])) {
    return $_POST[$key];
  } else
  if (!empty($default)) {
    return $default;
  }
  return '';
}

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

//TODO:  set_selected & set_checked should be a SINGLE function
function set_checked($key, $value, $default = '')
{
  if (!empty($_POST[$key])) {
    if ($value == $_POST[$key]) {
      return ' checked ';
    }
  } else
	if (!empty($default)) {

    if ($value == $default) {
      return ' checked ';
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
