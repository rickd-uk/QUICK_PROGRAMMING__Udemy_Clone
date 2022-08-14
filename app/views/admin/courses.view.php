<?php Controller::view_static('admin/header', $data) ?>


<?php if ($action = 'add') : ?>
	<div class="card col-md-5 mx-auto">
		<div class="card-body">
			<h5 class="card-title">New Course</h5>

			<?php isset($_POST['category_id']) &&  show($_POST['category_id']) ?>
			<!-- No Labels Form -->
			<form method="POST" class="row g-3">
				<div class="col-md-12">
					<input name="title" type="text" value="<?= set_value('title'); ?>" class="form-control <?= !empty($errors['title']) ? 'border-danger' : ''; ?>" placeholder="Course title">
					<?php show_error_msg($errors, 'title'); ?>
				</div>


				<div class="col-md-12">
					<select name="category_id" id="inputState" class="form-select <?= !empty($errors['category_id']) ? 'border-danger' : ''; ?>">

						<option value="">Course Category...</option>
						<?php if (!empty($categories)) : ?>
							<?php foreach ($categories as $cat) : ?>
								<option value="<?= $cat->id ?>" <?= keep_selected($cat->id, $_POST); ?>><?= esc($cat->category) ?></option>
							<?php endforeach; ?>
						<?php endif; ?>

					</select>

					<?php show_error_msg($errors, 'category_id'); ?>
				</div>

				<div class="text-center">

					<button type="submit" class="btn btn-primary float-left">Save</button>

					<a href="<?= ROOT ?>/admin/courses">
						<button type="button" class="btn btn-secondary">Cancel</button>
					</a>


				</div>
			</form><!-- End No Labels Form -->

		</div>
	</div>

<?php elseif ($action == 'edit') : ?>

<?php else : ?>

	<div class="card">
		<div class="card-body">
			<h5 class="card-title">My Courses

				<a href="<?= ROOT ?>/admin/courses/add"></a>
				<button class="btn btn-primary float-end"><i class="bi bi-camera-video-fill"></i>
					New Course</button>
				</a>
			</h5>
			<!-- Table with stripped rows -->
			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Title</th>
						<th scope="col">Category</th>
						<th scope="col">Price</th>
						<th scope="col">Primary Subject</th>
						<th scope="col">Date</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">1</th>
						<td>Brandon Jacob</td>
						<td>Designer</td>
						<td>28</td>
						<td>2016-05-25</td>
						<td>2016-05-25</td>
						<td>
							<i class="bi bi-pencil-square"></i>
							&nbsp;&nbsp;&nbsp;
							<i class="bi bi-trash-fill"></i>
						</td>
					</tr>

				</tbody>
			</table>
			<!-- End Table with stripped rows -->
		</div>
	</div>

<?php endif; ?>

<?php Controller::view_static('admin/footer') ?>