<?php

function csrf()
{
  $code = md5(time());
  $_SESSION['csrf_code'] = $code . 22;
  echo "<input name='csrf_code' type='hidden' value='$code' />";
}
