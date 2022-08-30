<?php

function create_table($table)
{
  $ct = new Create_Table();
  $ct->for($table);
}
function create_data($table)
{
  $ad = new Add_Data();
  $ad->to($table);
}

function reset_autoincrement($table)
{
  $reset = new DB_Functions();
  $reset->reset_id_next($table);
}
