<form>
  <div class="col-md-6 mx-auto" style="padding-top: 40px">
    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1">Course Title</span>
      <input type="text" class="form-control">
    </div>

    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1">Course Subtitle</span>
      <input type="text" class="form-control">
    </div>


    <div class="row mb-3">
      <label for="inputPassword" class="col-sm-2 col-form-label" style="min-width:200px">Description</label>
      <div class="col-sm-12">
        <textarea class="form-control" style="height: 100px"></textarea>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 my-2">
        <select class=" form-select">
          <option value="">Select Language</option>
        </select>
      </div>
      <div class="col-md-6 my-2">
        <select class="form-select">
          <option value="">Select Level</option>
        </select>
      </div>
      <div class="col-md-6 my-2">
        <select class=" form-select">
          <option value="">Select Category</option>
        </select>
      </div>
      <div class="col-md-6 my-2">
        <select class=" form-select">
          <option value="">Select Sub-Category</option>
        </select>
      </div>
    </div>

    <div class="input-group my-3">
      <span class="input-group-text" id="basic-addon1">Primary Sub</span>
      <input type="text" class="form-control">
    </div>

    <div class="my-4 row">
      <div class="col-md-4">
        <img src="<?= ROOT ?>/assets/images/image_placeholder.jpg" style="width: 100%;" alt="">
      </div>
      <div class="col-sm-8">
        <div class="h5 font-weight-bold">Course Image</div>
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
        <div class="h5 font-weight-bold">Course Video</div>
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