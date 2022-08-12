<?php

/**
 * users class
 */
class User extends Model
{
  public $errors = [];
  protected $table = "users";

  protected $allowedCols = [
    'email', 'firstname', 'lastname', 'password', 'role', 'date',
    'about', 'company', 'job', 'country', 'address', 'phone', 'slug', 'image',
    'facebook_link', 'instagram_link', 'twitter_link', 'linkedin_link'

  ];

  private function check_field($data, $name, $err_msg, $filter = null)
  {
    $allowed_filters = [FILTER_VALIDATE_EMAIL];
    if ($filter == '') {
      if (empty($data[$name])) {
        $this->errors[$name] = $err_msg;
      } else {
        if (!filter_var($data['email'], $filter)) {
          $this->errors['email'] = "Email is incorrect";
        }
      }
    }
  }

  public function validate($data)
  {
    $this->errors = [];

    // $this->check_field($data, 'firstname', 'Enter first name');

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
      if ($this->where(['email' => $data['email']])) {
        $this->errors['email'] = "Email already exists";
      }
    }
    if (empty($data['password'])) {
      $this->errors['password'] = "A password is required";
    } else   if ($data['password'] !== $data['retype_password']) {
      $this->errors['password'] = "Passwords must match";
    }
    if (empty($data['terms'])) {
      $this->errors['terms'] = "Please accept the terms & conditions";
    }

    if (empty($this->errors)) {
      return true;
    }

    return false;
  }


  public function edit_validate($data)
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
      if ($this->where(['email' => $data['email']])) {
        $this->errors['email'] = "Email already exists";
      }
    }

    if (!preg_match("/^(09|\+[0-9]{3})[0-9]{6}$/", trim($data['phone']))) {
      if (!filter_var($data['phone'], FILTER_VALIDATE_URL)) {
        $this->errors['phone'] = "";
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


    // show_stop($this->errors);

    if (empty($this->errors)) {
      return true;
    }

    return false;
  }
}
