<?php
function show_error_msg($errors, $field)
{
  if (!empty($errors[$field])) : ?>
    <small class="text-danger"><?= $errors[$field] ?></small>
<?php endif;
} ?>