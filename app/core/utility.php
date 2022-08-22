<?php

namespace Core;

class Utility
{
  protected static function mkdir($dir)
  {
    if (!file_exists($dir)) {
      mkdir($dir, 0777, true);
    }
  }
}
