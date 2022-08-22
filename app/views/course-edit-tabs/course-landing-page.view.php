<form>
  <div class="col-md-8 mx-auto" style="padding-top: 40px">
    <?php csrf() ?>
    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1">Course Title</span>
      <input name="title" type="text" value="<?= $row->title ?>" class="form-control">
      <small class="error error-title w-100 text-danger"></small>
    </div>

    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1">Course Subtitle</span>
      <input name="subtitle" type="text" value="<?= $row->subtitle ?>" class="form-control">
      <small class="error error-subtitle w-100 text-danger"></small>
    </div>

    <div class="input-group my-3">
      <span class="input-group-text" id="basic-addon1">Primary Sub</span>
      <input name="primary_subject" type="text" value="<?= $row->primary_subject ?>" class="form-control">
      <small class="error error-primary_subject w-100 text-danger"></small>
    </div>

    <div class="row mb-1">
      <label for="inputPassword" class="col-sm-2 col-form-label" style="min-width:200px"><b>Description</b></label>
      <div class="col-sm-12">
        <textarea name="description" class="form-control" style="height: 200px; resize:none"><?= $row->description ?></textarea>
      </div>
      <small class="error error-description w-100 text-danger"></small>
    </div>


    <div class="row">
      <div class="col-md-6 my-1">
        <label class="mt-2 mb-1"><b>Language</b></label>
        <select name="language_id" class=" form-select">
          <option value="">Select Language</option>
          <?php if (!empty($languages)) : ?>

            <!-- language_id is SET to 21 (English) by default -->
            <?php foreach ($languages as $lang) : ?>
              <option value="<?= $lang->id ?>" <?= set_selected('language_id', $lang->id, $row->language_id ?? 21); ?>><?= esc($lang->language) ?></option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
        <small class="error error-language_id w-100 text-danger"></small>
      </div>

      <div class="col-md-6 my-1">
        <label class="mt-2 mb-1"><b>Level</b></label>
        <select name="level_id" class="form-select">
          <option value="">Select Level</option>
          <?php if (!empty($levels)) : ?>
            <?php foreach ($levels as $lev) : ?>
              <option value="<?= $lev->id ?>" <?= set_selected('level_id', $lev->id, $row->level_id); ?>><?= esc($lev->level) ?></option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
        <small class="error error-level_id w-100 text-danger"></small>
      </div>
      <div class="col-md-6 my-1">
        <label class="mt-2 mb-1"><b>Category</b></label>
        <select name="category_id" class=" form-select">
          <option value="">Select Category</option>
          <?php if (!empty($categories)) : ?>
            <?php foreach ($categories as $cat) : ?>
              <option value="<?= $cat->id ?>" <?= set_selected('category_id', $cat->id, $row->category_id); ?>><?= esc($cat->category) ?></option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
        <small class="error error-category_id w-100 text-danger"></small>
      </div>
      <div class="col-md-6 my-1">
        <label class="mt-2 mb-1"><b>Sub-Category</b></label>
        <select name="_id" class=" form-select">
          <option value="">Select Sub-Category</option>
        </select>
        <small class="error error-sub_category_id w-100 text-danger"></small>
      </div>

      <label class="mt-2"><b>Pricing:</b></label>
      <div class="input-group d-flex justify-content-between">
        <div class="col-md-5 my-2">

          <!-- currency_id is SET to 1 ($) by default -->
          <select name="currency_id" class=" form-select">
            <option value="">Select Currency</option>
            <?php if (!empty($currencies)) : ?>
              <?php foreach ($currencies as $curr) : ?>
                <option value="<?= $curr->id ?>" <?= set_selected('currency_id', $curr->id, $row->currency_id ?? 1); ?>><?= esc($curr->currency . "($curr->symbol)") ?></option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
          <small class="error error-currency_id w-100 text-danger"></small>
        </div>
        <div class="col-md-6 my-2">

          <select name="price_id" class=" form-select">
            <option value="">Select Price</option>
            <?php if (!empty($prices)) : ?>
              <?php foreach ($prices as $pri) : ?>
                <option value="<?= $pri->id ?>" <?= set_selected('price_id', $pri->id, $row->price_id); ?>><?= esc($pri->name . " ($pri->price)") ?></option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
          <small class="error error-price_id w-100 text-danger"></small>
        </div>
      </div>
    </div>



    <div class="my-4 row">
      <div class="col-md-4">
        <img id="js-img-ul-preview" src="<?= get_image($row->course_image, 'courses') ?>" style="max-width: 100%; height: 200px; object-fit: contain;" alt="">
      </div>
      <div class="col-sm-8">
        <div class="h5"><b>Course Image</b></div>
        Upload your course image here. It must meet our course image quality standards to be accepted.

        <br><br>
        <input onchange="upload_course_image(this.files[0])" id="js-img-ul-input" type="file" accept="image/png, image/jpg, image/jpeg">
        <div class="progress my-4">
          <div id="progress-bar-image" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <course_image_tmpjs-image></course_image_tmpjs-image>
        <div id="js-img-ul-info" class="hide"></div>
        <button type="button" onclick="ajax_course_img_ul_cancel()" id="js-img-ul-cancel-btn" class="btn btn-warning btn-sm text-white hide">Cancel Upload</button>
      </div>

    </div>
    <div class="my-4 row">
      <div class="col-md-4">
        <video id="js-vid-ul-preview" controls style="width: 100%;">
          <source src="<?= get_video($row->course_promo_video) ?>" type="video/mp4">
        </video>

      </div>
      <div class="col-sm-8">
        <div class="h5"><b>Course Video</b></div>
        Upload your course video here. It must meet our course image quality standards to be accepted.

        <br><br>
        <input onchange="upload_course_video(this.files[0])" id="js-vid-ul-input" type="file">
        <div class="progress my-4">
          <div id="progress-bar-vid" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div id="js-vid-ul-info" class="hide"></div>
        <button type="button" onclick="ajax_course_vid_ul_cancel()" id="js-vid-ul-cancel-btn" class="btn btn-warning btn-sm text-white hide">Cancel Upload</button>
      </div>
    </div>
  </div>
</form>