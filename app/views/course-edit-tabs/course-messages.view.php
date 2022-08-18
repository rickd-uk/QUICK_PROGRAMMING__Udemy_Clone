<form>
  <div class="col-md-10 mx-auto" style="padding-top: 20px">
    <div class="row mb-3">
      <label for="inputPassword" class="col-sm-3 col-form-label"><b>Welcome Message</b></label>
      <div class="col-sm-9">
        <textarea name="welcome_message" class="form-control" style="height: 100px; resize:none"><?= $row->welcome_message ?></textarea>
      </div>
      <small class="error error-welcome_message w-100 text-danger"></small>
    </div>

    <div class="row mb-3">
      <label for="inputPassword" class="col-sm-3 col-form-label"><b>Congratulations Message</b></label>
      <div class="col-sm-9">
        <textarea name="congratulations_message" class="form-control" style="height: 100px; resize:none"><?= $row->congratulations_message ?></textarea>
      </div>
      <small class="error error-congratulations_message w-100 text-danger"></small>
    </div>
  </div>
</form>