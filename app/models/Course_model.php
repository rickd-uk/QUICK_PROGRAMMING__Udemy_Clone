<?php

/**
 * course_model class
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
    'description',
    'user_id',
    'category_id',
    'sub_category_id',
    'level_id',
    'language_id',
    'price_id',
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

  public function validate($data)
  {
    $this->errors = [];

    if (empty($data['title'])) {
      $this->errors['title'] = "Enter course title";
    } else
    if (!preg_match("/^[a-zA-Z_]+$/", trim($data['title']))) {
      $this->errors['title'] = "First name can only have letters, spaces and '_'";
    }

    if (empty($data['category_id'])) {
      $this->errors['category_id'] = "Enter category";
    }

    if (empty($this->errors)) {
      return true;
    }
    return false;
  }

  public function edit_validate($data, $id)
  {
    $this->errors = [];

    if (empty($data['firstname'])) {
      $this->errors['firstname'] = "Enter first name";
    } else
    if (!preg_match("/^[a-zA-Z]+$/", trim($data['firstname']))) {
      $this->errors['firstname'] = "First name can only have letters (no spaces)";
    }

    if (empty($data['lastname'])) {
      $this->errors['lastname'] = "Enter last name";
    } else
    if (!preg_match("/^[a-zA-Z]+$/", trim($data['lastname']))) {
      $this->errors['lastname'] = "Last name can only have letters (no spaces)";
    }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
      $this->errors['email'] = "Email is incorrect";
    } else {
      // check email
      if ($results = $this->where(['email' => $data['email']])) {

        foreach ($results as $result) {
          if ($id !=  $result->id) {
            $this->errors['email'] = "Email already exists";
          }
        }
      }
    }

    if (!empty($data['phone'])) {
      if (!preg_match("/^(09|[0-9]{3})[0-9]{6}$/", trim($data['phone']))) {
        $this->errors['phone'] = "Phone number not valid";
      }
    }



    if (!empty($data['facebook_link'])) {
      if (!filter_var($data['facebook_link'], FILTER_VALIDATE_URL)) {
        $this->errors['facebook_link'] = "Facebook link is not valid";
      }
    }
    if (!empty($data['instagram_link'])) {
      if (!filter_var($data['instagram_link'], FILTER_VALIDATE_URL)) {
        $this->errors['instagram_link'] = "Instagram link is not valid";
      }
    }
    if (!empty($data['twitter_link'])) {
      if (!filter_var($data['twitter_link'], FILTER_VALIDATE_URL)) {
        $this->errors['twitter_link'] = "Twitter link is not valid";
      }
    }
    if (!empty($data['linkedin_link'])) {
      if (!filter_var($data['linkedin_link'], FILTER_VALIDATE_URL)) {
        $this->errors['linkedin_link'] = "Linkedin link is not valid";
      }
    }




    if (empty($this->errors)) {
      return true;
    }

    return false;
  }


  // Created a system to add function to a model. They are very specific
  // depending on the needs of the model
  protected function get_category($rows)
  {
    return $rows;
  }
  protected function get_sub_category($rows)
  {
    return $rows;
  }
  protected function get_user($rows)
  {
    return $rows;
  }
  protected function get_price($rows)
  {
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
