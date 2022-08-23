<?php

use \Controller\Controller;

Controller::view_static('admin/header', $data);
Controller::view_breadcrumbs('admin/breadcrumbs', 'Slider Images') ?>


<?php if (!empty($row)) : ?>
  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <img src="<?= ROOT ?>/<?= USERS_UL_DIR . display($row, 'image') ?>" style="" alt="Profile" class="profile-image rounded-circle">
            <h2><?= display($row, 'firstname') . ' ' . display($row, 'lastname') ?></h2>
            <h3><?= display($row, 'role') ?></h3>
            <div class="social-links mt-2">
              <a href="#" class="facebook"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview" id="profile-overview-tab">Slider 1</button>
              </li>

              <li class="nav-item">
                <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" id="profile-edit-tab">Slider 2</button>
              </li>

              <li class="nav-item">
                <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings" id="profile-settings-tab">Slider 3</button>
              </li>

              <li class="nav-item">
                <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password" id="profile-change-password-tab">Slider 4</button>
              </li>

            </ul>



            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">Slider 1</h5>



              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form method="POST" enctype="multipart/form-data">
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Image</label>
                    <div class="col-md-8 col-lg-9">
                      <div class="d-flex ">
                        <img class="js-image-preview" src="<?= ROOT ?>/<?= USERS_UL_DIR . display($row, 'image') ?>" alt="Profile" style="min-width: 100%; height: 300px; object-fit: cover">
                        <!-- <div class="js-filename m-2">Selected File: None</div> -->
                      </div>

                      <div class="pt-2">
                        <label href="#" class="btn btn-primary btn-sm" title="Upload new profile image">
                          <i class="text-white bi bi-upload"></i>
                          <input class="js-profile-img-input" onchange="load_image(this.files[0])" type="file" name="image" style="display: none;" accept="image/jpeg, image/png, image/webp, image/jpeg" />
                        </label>
                        <?php show_error_msg($errors, 'image'); ?>
                        <small class="js-error-image text-danger"></small>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="firstname" class="col-md-4 col-lg-3 col-form-label">Title</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="firstname" type="text" class="form-control" id="firstname" value="<?= set_value('firstname', $row->firstname) ?>" required>
                    </div>
                    <?php show_error_msg($errors, 'firstname'); ?>
                    <small class="js-error-firstname text-danger"></small>
                  </div>



                  <div class="row mb-3">
                    <label for="about" class="col-md-4 col-lg-3 col-form-label">Description</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="about" class="form-control" id="about" style="height: 100px"><?= set_value('about', $row->about) ?></textarea>
                    </div>
                  </div>


                  <div class="text-center">
                    <a href="<?= ROOT ?>/admin">
                      <button type="button" class="btn btn-primary float-start">Back</button>
                    </a>

                    <button type="button" onclick="save_profile(event)" class="btn btn-danger float-end">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-settings">


              </div>

              <div class="tab-pane fade pt-3" id="profile-change-password">


              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>

  <script src="<?= ROOT ?>/assets/js/profile.js"></script>
  <script src="<?= ROOT ?>/assets/js/ajax.js" />

<?php else : ?>

  <div class="alert alert-danger alert-dimissible fade show" role="alert">
    Profile not found!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

</main><!-- End #main -->


<?php Controller::view_static('admin/footer') ?>