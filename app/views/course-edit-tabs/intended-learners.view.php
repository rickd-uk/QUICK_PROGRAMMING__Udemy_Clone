<form>
  <?php csrf() ?>
  <div class="col-md-10 mx-auto" style="padding-top: 20px">
    <div class="row mb-3">
      <label for="inputPassword" class="col-12 col-form-label"><b>What will learners learn in your course?</b></label>
      <small>You must enter at least 4 learning objectives or outcomes that learners can expect to achieve after completing it.</small>

      <div class="col-sm-10 pt-2 js-students-learn">

      </div>
      <small class="error error-welcome_message w-100 text-danger"></small>
    </div>
    <button type="button" onclick="add_new('js-students-learn')" class=" btn btn-primary">+ Add More</button>
  </div>
</form>
