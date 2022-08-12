<?php

function redirect($link)
{
  header('Location: ' . ROOT . '/' . $link);
  die();
}
