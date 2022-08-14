<?php
function get_date()
{
  return date("Y-m-d H:i:s");
}

function format_date($date)
{
  return date("jS M, Y", strtotime($date));
}
