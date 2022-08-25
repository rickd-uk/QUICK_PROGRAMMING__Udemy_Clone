
<?php

use \Model\Category;

function str_to_url($url)
{
  $url = str_replace("'", "", $url);
  $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
  $url = trim($url, "-");
  $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
  $url = strtolower($url);
  $url = preg_replace('~[^-a-z0-9_]+~', '', $url);

  return $url;
}

function make_slug_for_categories()
{
  $categories = get_categories();
  $category = new Category();

  foreach ($categories as $row) {
    $slug = str_to_url($row->category);
    $category->update($row->id, ['slug' => $slug]);
  }
}
