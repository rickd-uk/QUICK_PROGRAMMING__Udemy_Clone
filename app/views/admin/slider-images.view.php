<?php

use \Controller\Controller;

Controller::view_static('admin/header', $data);
Controller::view_breadcrumbs('admin/breadcrumbs', 'Slider Images') ?>



<section class="section slider-images">
  <div class="row">

    <div class="col-xl-8">

      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
              <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link active" data-bs-toggle="tab" data-bs-target="#slider-images-overview" id="slider-images-overview-tab">Slider 1</button>
            </li>
            <li class="nav-item">
              <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" data-bs-toggle="tab" data-bs-target="#slider-images-edit" id="slider-images-edit-tab">Slider 2</button>
            </li>
            <li class="nav-item">
              <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" data-bs-toggle="tab" data-bs-target="#slider-images-settings" id="slider-images-settings-tab">Slider 3</button>
            </li>
            <li class="nav-item">
              <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" data-bs-toggle="tab" data-bs-target="#slider-images-change-password" id="slider-images-change-password-tab">Slider 4</button>
            </li>
          </ul>

          <div class="tab-content pt-2">
            <div class="tab-pane fade show active slider-images-overview" id="slider-images-overview">
              <form method="POST" enctype="multipart/form-data">
                <!-- slider-images Edit Form -->
                <div class="row mb-3">
                  <label for="slider-imagesImage" class="col-md-4 col-lg-3 col-form-label">Image</label>
                  <div class="col-md-8 col-lg-9">
                    <div class="d-flex ">

                      <img id="slider-img-1" class="js-image-preview" src="<?= get_image($rows[1]->image ?? '', 'slider_images')  ?>" alt="slider-images" style="min-width: 100%; height: 300px; object-fit: cover background-color: red;" />
                      <div class="js-filename m-2"></div>
                    </div>


                    <div class="pt-2">
                      <label href="#" class="btn btn-primary btn-sm" title="Upload new slider-images image">
                        <i class="text-white bi bi-upload"></i>
                        <input class="js-slider-images-img-input" onchange="load_image(event, this.files[0])" type="file" name="image" style="display: none;" accept="image/jpeg, image/png, image/jpeg, image/webp" />
                      </label>
                      <?php show_error_msg($errors, 'image'); ?>
                      <small class="js-error-image text-danger"></small>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="title" class="col-md-4 col-lg-3 col-form-label">Title</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="title" type="text" class="form-control" id="title" value="<?= set_value('title', $rows[1]->title ?? '') ?>" required>
                  </div>
                  <?php show_error_msg($errors, 'title'); ?>
                  <small class="js-error-title text-danger"></small>
                </div>



                <div class="row mb-3">
                  <label for="description" class="col-md-4 col-lg-3 col-form-label">Description</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="description" class="form-control" id="description" style="height: 100px"><?= set_value('description', $rows[1]->description ?? '') ?></textarea>
                  </div>
                  <?php show_error_msg($errors, 'description'); ?>
                  <small class="js-error-description text-danger"></small>
                </div>

                <div class="js-progress progress my-4 hide" style="display: none;">
                  <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Saving</div>
                </div>
                <div class="text-center">
                  <a href="<?= ROOT ?>/admin">
                    <button type="button" class="btn btn-primary float-start">Back</button>
                  </a>

                  <button type="button" onclick="save_slider_images(event, 1, img[0])" class="btn btn-danger float-end">Save Changes</button>
                </div>
              </form><!-- End slider-images Edit Form -->

            </div>
            <div class="tab-pane fade slider-images-edit pt-3" id="slider-images-edit">

              <form method="POST" enctype="multipart/form-data">
                <!-- slider-images Edit Form -->
                <div class="row mb-3">
                  <label for="slider-imagesImage" class="col-md-4 col-lg-3 col-form-label">Image</label>
                  <div class="col-md-8 col-lg-9">
                    <div class="d-flex ">

                      <img id="slider-img-2" class="js-image-preview" src="<?= get_image($rows[2]->image ?? '', 'slider_images') ?>" alt="slider-images" style="min-width: 100%; height: 300px; object-fit: cover" />
                      <div class="js-filename m-2"></div>
                    </div>


                    <div class="pt-2">
                      <label href="#" class="btn btn-primary btn-sm" title="Upload new slider-images image">
                        <i class="text-white bi bi-upload"></i>
                        <input class="js-slider-images-img-input" onchange="load_image(event, this.files[0])" type="file" name="image" style="display: none;" accept="image/jpeg, image/png,  image/jpeg, image/webp" />
                      </label>
                      <?php show_error_msg($errors, 'image'); ?>
                      <small class="js-error-image text-danger"></small>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="title" class="col-md-4 col-lg-3 col-form-label">Title</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="title" type="text" class="form-control" id="title" value="<?= set_value('title', $rows[2]->title ?? '') ?>" required>
                  </div>
                  <?php show_error_msg($errors, 'title'); ?>
                  <small class="js-error-title text-danger"></small>
                </div>



                <div class="row mb-3">
                  <label for="description" class="col-md-4 col-lg-3 col-form-label">Description</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="description" class="form-control" id="description" style="height: 100px"><?= set_value('description', $rows[2]->description ?? '') ?></textarea>
                  </div>
                  <?php show_error_msg($errors, 'description'); ?>
                  <small class="js-error-description text-danger"></small>
                </div>

                <div class="js-progress progress my-4 hide" style="display: none;">
                  <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Saving</div>
                </div>
                <div class="text-center">
                  <a href="<?= ROOT ?>/admin">
                    <button type="button" class="btn btn-primary float-start">Back</button>
                  </a>

                  <button type="button" onclick="save_slider_images(event, 2, img[1])" class="btn btn-danger float-end">Save Changes</button>
                </div>
              </form><!-- End slider-images Edit Form -->

            </div>
            <div class="tab-pane fade pt-3" id="slider-images-settings">
              <form method="POST" enctype="multipart/form-data">
                <!-- slider-images Edit Form -->
                <div class="row mb-3">
                  <label for="slider-imagesImage" class="col-md-4 col-lg-3 col-form-label">Image</label>
                  <div class="col-md-8 col-lg-9">
                    <div class="d-flex ">

                      <img id="slider-img-3" class="js-image-preview" src="<?= get_image($rows[3]->image ?? '', 'slider_images') ?>" alt="slider-images" style="min-width: 100%; height: 300px; object-fit: cover" />
                      <div class="js-filename m-2"></div>
                    </div>


                    <div class="pt-2">
                      <label href="#" class="btn btn-primary btn-sm" title="Upload new slider-images image">
                        <i class="text-white bi bi-upload"></i>
                        <input class="js-slider-images-img-input" onchange="load_image(event, this.files[0])" type="file" name="image" style="display: none;" accept="image/jpeg, image/png, image/jpeg , image/webp" />
                      </label>
                      <?php show_error_msg($errors, 'image'); ?>
                      <small class="js-error-image text-danger"></small>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="title" class="col-md-4 col-lg-3 col-form-label">Title</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="title" type="text" class="form-control" id="title" value="<?= set_value('title', $rows[3]->title ?? '') ?>" required>
                  </div>
                  <?php show_error_msg($errors, 'title'); ?>
                  <small class="js-error-title text-danger"></small>
                </div>



                <div class="row mb-3">
                  <label for="description" class="col-md-4 col-lg-3 col-form-label">Description</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="description" class="form-control" id="description" style="height: 100px"><?= set_value('description', $rows[3]->description ?? '') ?></textarea>
                  </div>
                  <?php show_error_msg($errors, 'description'); ?>
                  <small class="js-error-description text-danger"></small>
                </div>

                <div class="js-progress progress my-4 hide" style="display: none;">
                  <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Saving</div>
                </div>
                <div class="text-center">
                  <a href="<?= ROOT ?>/admin">
                    <button type="button" class="btn btn-primary float-start">Back</button>
                  </a>

                  <button type="button" onclick="save_slider_images(event, 3, img[2])" class="btn btn-danger float-end">Save Changes</button>
                </div>
              </form><!-- End slider-images Edit Form -->

            </div>
            <div class="tab-pane fade pt-3" id="slider-images-change-password">
              <form method="POST" enctype="multipart/form-data">
                <!-- slider-images Edit Form -->
                <div class="row mb-3">
                  <label for="slider-imagesImage" class="col-md-4 col-lg-3 col-form-label">Image</label>
                  <div class="col-md-8 col-lg-9">
                    <div class="d-flex ">

                      <img id="slider-img-4" class="js-image-preview" src="<?= get_image($rows[4]->image ?? '', 'slider_images') ?>" alt="slider-images" style="min-width: 100%; height: 300px; object-fit: cover" />
                      <div class="js-filename m-2"></div>
                    </div>


                    <div class="pt-2">
                      <label href="#" class="btn btn-primary btn-sm" title="Upload new slider-images image">
                        <i class="text-white bi bi-upload"></i>
                        <input class="js-slider-images-img-input" onchange="load_image(event, this.files[0])" type="file" name="image" style="display: none;" accept="image/jpeg, image/png, image/jpeg, image/webp" />
                      </label>
                      <?php show_error_msg($errors, 'image'); ?>
                      <small class="js-error-image text-danger"></small>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="title" class="col-md-4 col-lg-3 col-form-label">Title</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="title" type="text" class="form-control" id="title" value="<?= set_value('title', $rows[4]->title ?? '') ?>" required>
                  </div>
                  <?php show_error_msg($errors, 'title'); ?>
                  <small class="js-error-title text-danger"></small>
                </div>



                <div class="row mb-3">
                  <label for="description" class="col-md-4 col-lg-3 col-form-label">Description</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="description" class="form-control" id="description" style="height: 100px"><?= set_value('description', $rows[4]->description ?? '') ?></textarea>
                  </div>
                  <?php show_error_msg($errors, 'description'); ?>
                  <small class="js-error-description text-danger"></small>
                </div>

                <div class="js-progress progress my-4 hide" style="display: none;">
                  <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Saving</div>
                </div>
                <div class="text-center">
                  <a href="<?= ROOT ?>/admin">
                    <button type="button" class="btn btn-primary float-start">Back</button>
                  </a>

                  <button type="button" onclick="save_slider_images(event, 4, img[3])" class="btn btn-danger float-end">Save Changes</button>
                </div>
              </form><!-- End slider-images Edit Form -->

            </div>

          </div><!-- End Bordered Tabs -->


        </div>
      </div>

    </div>
  </div>
</section>

<script src="<?= ROOT ?>/assets/js/slider-images.js"></script>
<script src="<?= ROOT ?>/assets/js/ajax.js"></script>




</main><!-- End #main -->


<?php Controller::view_static('admin/footer') ?>