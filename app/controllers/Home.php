<?php

class Home
{
  public function index()
  {
    echo "Home";
  }

  public function edit($id = null)
  {
    echo "edit " . $id;
  }

  public function delete($id = null)
  {
    echo "del " . $id;
  }
}
