<?php

use \Controller\Controller;

Controller::view_static('admin/header', $data);
Controller::view_breadcrumbs('admin/breadcrumbs', 'My Courses');
?>


<?php if ($action == 'add') : ?>
	<div class="card col-md-5 mx-auto">
		<div class="card-body">
			<h5 class="card-title">New Course</h5>

			<?php isset($_POST['category_id']) &&  show($_POST['category_id']) ?>
			<!-- No Labels Form -->
			<form method="POST" class="row g-3">
				<?php csrf() ?>
				<?php $_POST['tab_name'] = 'course-landing-page' ?>

				<div class="col-md-12">
					<input name="title" type="text" value="<?= set_value('title'); ?>" class="form-control <?= !empty($errors['title']) ? 'border-danger' : ''; ?>" placeholder="Course title">
					<?php show_error_msg($errors, 'title'); ?>
				</div>

				<div class="col-md-12">
					<input name="primary_subject" type="text" value="<?= set_value('primary_subject'); ?>" class="form-control <?= !empty($errors['primary_subject']) ? 'border-danger' : ''; ?>" placeholder="Primary Subject e.g.  Photography, Blogging, etc.">
					<?php show_error_msg($errors, 'primary_subject'); ?>
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

				<div class="text-center d-flex justify-content-between pt-2">



					<a href="<?= ROOT ?>/admin/courses">
						<button type="button" class="btn btn-secondary">Cancel</button>
					</a>
					<button type="submit" class="btn btn-primary ">Save</button>


				</div>
			</form><!-- End No Labels Form -->

		</div>
	</div>

<?php elseif ($action == 'delete') : ?>
	<div class="card">
		<div class="card-body">
			<h3 class="card-title">Delete Course</h3>
			<h5 class="alert alert-danger text-center">Are you sure you want to delete?</h5>

			<h5 class="">Course Title: <?= esc($row->title) ?></h5>
			<h5 class="">Primary Subject: <?= esc($row->primary_subject) ?></h5>
			<h5 class="">Category: <?= esc($row->category_row->category) ?></h5>
			<h5 class="">Date: <?= format_date($row->date) ?></h5>

			<?php if (!empty($row)) : ?>
				<a href="<?= ROOT ?>/admin/courses">
					<button class=" btn btn-primary float-start">Back</button>
				</a>
				<form method="POST">

					<button class=" btn btn-danger float-end">Delete</button>
		</div>
		</form>
		<div class="my-5">

		<?php else : ?>
			<div>That course was not found</div>
		<?php endif; ?>
		</div>
	</div>


<?php elseif ($action == 'edit') : ?>

	<link href="<?= ROOT ?>/assets/css/courses.css?<?= get_date() ?>" rel="stylesheet">
	<div class="card">
		<div class="card-body">
			<h3 class="card-title">Edit Course</h3>
			<?php if (!empty($row)) : ?>
				<h5 class="card-title"><?= esc($row->title) ?></h5>
				<!-- Tabs -->
				<div class="tabs-holder">
					<div onclick="set_courses_tab(this)" id="intended-learners" class="my-tab active-tab">Intended Learners</div>
					<div onclick="set_courses_tab(this)" id="curriculum" class="my-tab">Curriculum</div>
					<div onclick="set_courses_tab(this)" id="course-landing-page" class="my-tab">Course Landing Page</div>
					<div onclick="set_courses_tab(this)" id="promotions" class="my-tab">Promotions</div>
					<div onclick="set_courses_tab(this)" id="course-messages" class="my-tab">Course Messages</div>
				</div>
				<!-- end tabs -->
				<div oninput="something_changed(event)">
					<div id="tabs-content">
						<!-- <img class="loader" src="<?= ROOT ?>/assets/images/loader.gif"> -->
					</div>
				</div>

				<div class="my-5">
					<a href="<?= ROOT ?>/admin/courses">
						<button class=" btn btn-primary float-start">Back</button>
					</a>
					<button onclick="save_content()" class="js-save-btn btn btn-success float-end disabled">Save</button>
				</div>
			<?php else : ?>
				<div>That course was not found</div>
			<?php endif; ?>
		</div>
	</div>

	<script src="<?= ROOT ?>/assets/js/tabs.js?<?= time() ?>"></script>
	<script src="<?= ROOT ?>/assets/js/save.js?<?= time() ?>"></script>
	<script src="<?= ROOT ?>/assets/js/intended-learners.js?<?= time() ?>"></script>

<?php else : ?>

	<div class="card">
		<div class="card-body">
			<h5 class="card-title">My Courses
				<a href="<?= ROOT ?>/admin/courses/add">
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
						<th scope="col">Image</th>
						<th scope="col">Instructor</th>
						<th scope="col">Category</th>
						<th scope="col">Price</th>
						<th scope="col">Primary Subject</th>
						<th scope="col">Date</th>
						<th scope="col">Action</th>
					</tr>
				</thead>

				<?php if (!empty($rows)) : ?>
					<tbody>
						<?php foreach ($rows as $row) : ?>
							<tr>
								<th scope="row"><?= esc($row->id) ?></th>
								<td><?= esc($row->title) ?></td>
								<td><img src="<?= get_image($row->course_image, 'courses') ?>" style="width: 100px; height: 100px; object-fit: cover;" /></td>
								<td><?= esc($row->user_row->name ?? 'Unknown') ?></td>
								<td><?= esc($row->category_row->category ?? 'Unknown') ?></td>
								<td><?= esc($row->price_row->name ?? 'Unknown') ?></td>
								<td><?= esc($row->primary_subject) ?></td>
								<td><?= format_date(esc($row->date)) ?></td>
								<td>
									<a onClick="set_tab('course-landing-page')" href="<?= ROOT ?>/admin/courses/edit/<?= $row->id ?>">
										<i class="bi bi-pencil-square text-primary"></i>
									</a>
									&nbsp;&nbsp;
									<a href="<?= ROOT ?>/admin/courses/delete/<?= $row->id ?>">
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
		</div>
	</div>

<?php endif; ?>


<script src="<?= ROOT ?>/assets/js/video_ul.js?<?= time() ?>"></script>
<script src="<?= ROOT ?>/assets/js/modal.js?<?= time() ?>"></script>

<link href="<?= ROOT ?>/assets/css/modal.css?<?= time() ?>" rel="stylesheet">

<?php Controller::view_static('admin/footer') ?>
