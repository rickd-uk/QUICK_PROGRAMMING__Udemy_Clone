<form>
  <?= $_POST['course_id'] ?>
  <div class="col-md-6 mx-auto" style="padding-top: 40px">
    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1">Course Title</span>
      <input name="title" type="text" class="form-control">
    </div>

    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1">Course Subtitle</span>
      <input name="subtitle" type="text" class="form-control">
    </div>

    <div class="row mb-3">
      <label for="inputPassword" class="col-sm-2 col-form-label" style="min-width:200px">Description</label>
      <div class="col-sm-12">
        <textarea name="description" class="form-control" style="height: 100px"></textarea>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 my-2">
        <select name="language_id" class=" form-select">
          <option value="">Select Language</option>
        </select>
      </div>
      <div class="col-md-6 my-2">
        <select name="level_id" class="form-select">
          <option value="">Select Level</option>
        </select>
      </div>
      <div class="col-md-6 my-2">
        <select name="category_id" class=" form-select">
          <option value="">Select Category</option>
        </select>
      </div>
      <div class="col-md-6 my-2">
        <select name="_id" class=" form-select">
          <option value="">Select Sub-Category</option>
        </select>
      </div>



      <label class="mt-2"><b>Pricing:</b></label>
      <div class="input-group d-flex justify-content-between">
        <div class="col-md-5 my-3">

          <select name="currency_id" class=" form-select">
            <option value="">Select Currency</option>
          </select>
        </div>
        <div class="col-md-6 my-3">

          <select name="price_id" class=" form-select">
            <option value="">Select Price</option>
          </select>
        </div>
      </div>

    </div>



    <div class="input-group my-3">
      <span class="input-group-text" id="basic-addon1">Primary Sub</span>
      <input name="primary_subject" type="text" class="form-control">
    </div>

    <div class="my-4 row">
      <div class="col-md-4">
        <img src="<?= ROOT ?>/assets/images/image_placeholder.jpg" style="width: 100%;" alt="">
      </div>
      <div class="col-sm-8">
        <div class="h5"><b>Course Image</b></div>
        Upload your course image here. It must meet our course image quality standards to be accepted.

        <br><br>
        <input type="file">
        <div class="progress my-4">
          <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>

    </div>
    <div class="my-4 row">
      <div class="col-md-4">
        <img src="<?= ROOT ?>/assets/images/image_placeholder.jpg" style="width: 100%;" alt="">
      </div>
      <div class="col-sm-8">
        <div class="h5"><b>Course Video</b></div>
        Upload your course video here. It must meet our course image quality standards to be accepted.

        <br><br>
        <input type="file">
        <div class="progress my-4">
          <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>
</form>