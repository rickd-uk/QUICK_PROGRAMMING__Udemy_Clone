<?php

$cat = $data[0];
$href = ROOT . "/admin/" . $cat . "'";
$back_btn = "<a href='" . $href . ">
    <button type='button' class='btn btn-primary'>Back</button>
     </a>";
if ($data[1] && $data[1] === 'no_back_btn') $back_btn = '';

$msg = <<< EOD
       <div class="alert alert-danger text-center">You do not have permission!</div>
           <div class="text-center d-flex justify-content-between pt-2">
       </div>
       EOD;
echo $msg . $back_btn;
