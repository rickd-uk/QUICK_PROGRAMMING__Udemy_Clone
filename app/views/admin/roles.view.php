<?php

use \Controller\Controller;

Controller::view_static('admin/header', $data);
Controller::view_breadcrumbs('admin/breadcrumbs', 'roles');
?>
<?php if ($action == 'add') : ?>
  <div class="card col-md-5 mx-auto">
    <div class="card-body">
      <h5 class="card-title">New Role</h5>

      <?php if (user_can('add_permissions')) : ?>
        <form method="POST" class="row g-3">
          <div class="col-md-12">
            <input name="role" type="text" value="<?= set_value('role'); ?>" class="form-control <?= !empty($errors['role']) ? 'border-danger' : ''; ?>" placeholder="role">
            <?php show_error_msg($errors, 'role'); ?>
          </div>

          <div class="col-md-12">
            <select name="disabled" class="form-select">
              <option value="0" selected="">Yes</option>
              <option value="1">No</option>
            </select>
          </div>
          <div class="text-center d-flex justify-content-between pt-2">
            <a href="<?= ROOT ?>/admin/roles">
              <button type="button" class="btn btn-secondary">Cancel</button>
            </a>
            <button type="submit" class="btn btn-primary ">Save</button>
          </div>
        </form><!-- End No Labels Form -->
      <?php else : ?>
        <?php Controller::view_static('admin/includes/no-permission', ['roles', '']) ?>
      <?php endif; ?>

    </div>
  </div>

<?php elseif ($action == 'delete') : ?>
  <div class="card">
    <div class="card-body">
      <h3 class="card-title">Delete role</h3>

      <?php if (user_can('delete_categories')) : ?>
        <h5 class="alert alert-danger text-center">Are you sure you want to delete?</h5>

        <?php if (!empty($row)) : ?>
          <form method="POST" class="row g-3">
            <div class="col-md-12">
              <b>Role: </b><?= set_value('role', $row->role); ?>
            </div>
            <div class="col-md-12">
              <b>Active:</b> <?= set_value('disabled', $row->disabled ? 'No' : 'Yes') ?>
            </div>

            <div class="text-center d-flex justify-content-between pt-2">
              <a href="<?= ROOT ?>/admin/roles">
                <button type="button" class="btn btn-primary">Back</button>
              </a>
              <button type="submit" class="btn btn-danger ">Delete</button>
            </div>
          </form><!-- End No Labels Form -->
        <?php else : ?>
          <div>That course was not found</div>
        <?php endif; ?>

      <?php else : ?>
        <?php Controller::view_static('admin/includes/no-permission', ['roles', '']) ?>
      <?php endif; ?>
    </div>
  </div>


<?php elseif ($action == 'edit') : ?>
  <link href="<?= ROOT ?>/assets/css/courses.css?<?= get_date() ?>" rel="stylesheet">

  <div class="card">
    <div class="card-body">
      <h3 class="card-title">Edit Course</h3>

      <?php if (!empty($row)) : ?>
        <?php if (user_can('edit_permissions')) : ?>

          <form method="POST" class="row g-3">
            <div class="col-md-12">
              <input name="role" type="text" value="<?= set_value('role', $row->role); ?>" class="form-control <?= !empty($errors['role']) ? 'border-danger' : ''; ?>" placeholder="role">
              <?php show_error_msg($errors, 'role'); ?>
            </div>

            <div class="col-md-12">
              <select name="disabled" class="form-select">
                <option <?= set_selected('disabled', '0', $row->disabled) ?>value="0" selected="">Yes</option>
                <option <?= set_selected('disabled', '1', $row->disabled) ?>value="1">No</option>
              </select>
            </div>
            <div class="text-center d-flex justify-content-between pt-2">

              <a href="<?= ROOT ?>/admin/roles">
                <button type="button" class="btn btn-secondary">Cancel</button>
              </a>
              <button type="submit" class="btn btn-primary ">Save</button>
            </div>
          </form><!-- End No Labels Form -->

        <?php else : ?>
          <?php Controller::view_static('admin/includes/no-permission', ['roles', '']) ?>
        <?php endif; ?>

      <?php else : ?>
        <div>That course was not found</div>
      <?php endif; ?>
    </div>
  </div>

<?php else : ?>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">My Roles
        <a href="<?= ROOT ?>/admin/roles/add">
          <button class="btn btn-primary float-end"><i class="bi bi-camera-video-fill"></i>
            New Roles</button>
        </a>
      </h5>
      <?php if (user_can('view_categories')) : ?>
        <!-- Table with stripped rows -->
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Role</th>
              <th scope="col">Active</th>
              <th scope="col">Permissions</th>
              <th scope="col">Action</th>
            </tr>
          </thead>

          <?php if (!empty($rows)) : ?>
            <tbody>
              <?php foreach ($rows as $row) : ?>
                <tr>
                  <th scope="row"><?= esc($row->id) ?></th>
                  <td><?= esc($row->role) ?></td>
                  <td><?= esc($row->disabled ? 'No' : 'Yes') ?></td>
                  <td></td>

                  <td>
                    <a href="<?= ROOT ?>/admin/roles/edit/<?= $row->id ?>">
                      <i class="bi bi-pencil-square text-primary"></i>
                    </a>
                    &nbsp;&nbsp;
                    <a href="<?= ROOT ?>/admin/roles/delete/<?= $row->id ?>">
                      <i class="bi bi-trash-fill text-danger"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>

            </tbody>
          <?php else : ?>
            <tr>
              <td colspan="10">No records found!</td>
            </tr>
          <?php endif; ?>
        </table>
        <!-- End Table with stripped rows -->

      <?php else : ?>
        <?php Controller::view_static('admin/includes/no-permission', ['roles', 'no_back_btn',]) ?>
      <?php endif; ?>

    </div>
  </div>

<?php endif; ?>



<?php Controller::view_static('admin/footer') ?>
