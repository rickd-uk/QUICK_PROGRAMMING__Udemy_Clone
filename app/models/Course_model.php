<?php

/**
 * courses class
 */
class Course_model extends Model
{
  public $errors = [];
  protected $table = "courses";

  protected $afterSelect = [
    'get_category', 'get_sub_category', 'get_user', 'get_price', 'get_level', 'get_language'
  ];
  protected $beforeUpdate = [];


  protected $allowedCols = [
    'title',
    'subtitle',
    'description',
    'user_id',
    'category_id',
    'sub_category_id',
    'level_id',
    'language_id',
    'price_id',
    'currency_id',
    'promo_link',
    'welcome_message',
    'congratulations_message',
    'primary_subject',
    'course_promo_video',
    'course_image',
    'date',
    'tags',
    'approved',
    'published',
  ];

  #1 TODO:
  private function validate_field()
  {
    if (empty($data['title'])) {
      $this->errors['title'] = "Enter course title";
    }
  }

  public function validate($data)
  {
    $this->errors = [];

    if (empty($data['title'])) {
      $this->errors['title'] = "Enter course title";
    } else
    if (!preg_match("/^[a-zA-Z_ ]+$/", trim($data['title']))) {
      $this->errors['title'] = "Course titles can only have letters, spaces and '_'";
    }

    if (empty($data['primary_subject'])) {
      $this->errors['primary_subject'] = "Enter a primary subject";
    } else
    if (!preg_match("/^[a-zA-Z_ ]+$/", trim($data['primary_subject']))) {
      $this->errors['primary_subject'] = "Primary subjects can only have letters, spaces and '_'";
    }

    if (empty($data['category_id'])) {
      $this->errors['category_id'] = "Category is required";
    }

    if (empty($this->errors)) {
      return true;
    }
    return false;
  }

  public function edit_validate($data, $id = null)
  {
    $this->errors = [];

    $this->validate($data);



    if (empty($this->errors)) {
      return true;
    }

    return false;
  }

  // Created a system to add function to a model. They are very specific
  // depending on the needs of the model
  protected function get_category($rows)
  {
    $db = new Database();
    if (!empty($rows[0]->category_id)) {
      foreach ($rows as $key => $row) {
        $query = "SELECT * FROM categories WHERE id = :id LIMIT 1";
        $cat = $db->query($query, ['id'  => $row->category_id]);
        if (!empty($cat)) {
          $rows[$key]->category_row = $cat[0];
        }
      }
    }
    return $rows;
  }
  protected function get_sub_category($rows)
  {
    return $rows;
  }
  protected function get_user($rows)
  {
    $db = new Database();
    if (!empty($rows[0]->user_id)) {

      foreach ($rows as $key => $row) {
        $query = "SELECT firstname, lastname, role FROM users WHERE id = :id LIMIT 1";
        $user = $db->query($query, ['id'  => $row->user_id]);
        if (!empty($user)) {

          $user[0]->name = $user[0]->firstname . ' ' . $user[0]->lastname;
          $rows[$key]->user_row = $user[0];
        }
      }
    }
    return $rows;
  }
  protected function get_price($rows)
  {
    $db = new Database();
    if (!empty($rows[0]->price_id)) {

      foreach ($rows as $key => $row) {
        $query = "SELECT * FROM prices WHERE id = :id LIMIT 1";
        $price = $db->query($query, ['id'  => $row->price_id]);
        if (!empty($price)) {

          $price[0]->name = $price[0]->name . ' ($' . $price[0]->price . ')';
          $rows[$key]->price_row = $price[0];
        }
      }
    }
    return $rows;
  }
  protected function get_level($rows)
  {
    return $rows;
  }
  protected function get_language($rows)
  {
    return $rows;
  }
}
