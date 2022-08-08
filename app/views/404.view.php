<?php

/**
@var Home $this
 */
$this->view('includes/header', $data);
$this->view('includes/nav', $data);
?>
<div class="container-fluid p-4 text-center">
  <h1>Page Not Found</h1>
</div>


<?php $this->view('includes/footer', $data) ?>