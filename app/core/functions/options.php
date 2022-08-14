<?php

function keep_selected($index, $post)
{
  $category_id = $post['category_id'] ?? null;
  if (isset($category_id) && $index == $category_id)
    return 'selected';
  return '';
}
