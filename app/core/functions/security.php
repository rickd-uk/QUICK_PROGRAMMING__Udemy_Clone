<?php

function csrf()
{
  $code = md5(time());
  $_SESSION['csrf_code'] = $code;
  echo "<input id='js-csrf_code' name='csrf_code' type='hidden' value='$code' />";
}
