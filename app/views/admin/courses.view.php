<?php Controller::view_static('admin/header', $data); ?>

<?php if ($action == 'add') : ?>

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
	<div class="card">
		<div class="card-body">
			<h3 class="card-title">Edit Course</h3>
			<?php if (!empty($row)) : ?>
				<h5 class="card-title"><?= esc($row->title) ?></h5>
				<!-- Default Tabs -->
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link active" id="intended-learners-tab" data-bs-toggle="tab" data-bs-target="#intended-learners" type="button" role="tab" aria-controls="intended-learners" aria-selected="true">Intended Learners</button>
					</li>
					<li class="nav-item" role="presentation">
						<button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab" aria-controls="curriculum" aria-selected="false" tabindex="-1">Curriculum</button>
					</li>
					<li class="nav-item" role="presentation">
						<button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" id="course-landing-page-tab" data-bs-toggle="tab" data-bs-target="#course-landing-page" type="button" role="tab" aria-controls="course-landing-page" aria-selected="false" tabindex="-1">Course Landing Page</button>
					</li>
					<li class="nav-item" role="presentation">
						<button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" id="promotions-tab" data-bs-toggle="tab" data-bs-target="#promotions" type="button" role="tab" aria-controls="promotions" aria-selected="false" tabindex="-1">Promotions</button>
					</li>
					<li class="nav-item" role="presentation">
						<button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" id="course-meetings-tab" data-bs-toggle="tab" data-bs-target="#course-meetings" type="button" role="tab" aria-controls="course-meetings" aria-selected="false" tabindex="-1">Course Messages</button>
					</li>
				</ul>
				<div class="tab-content pt-2" id="myTabContent">
					<div class="tab-pane fade show active" id="intended-learners" role="tabpanel" aria-labelledby="intended-learners-tab">
						Intended learners
					</div>
					<div class="tab-pane fade" id="curriculum" role="tabpanel" aria-labelledby="curriculum-tab">
						Curriculum
					</div>
					<div class="tab-pane fade" id="course-landing-page" role="tabpanel" aria-labelledby="course-landing-page-tab">
						course-landing-page
					</div>
					<div class="tab-pane fade" id="promotions" role="tabpanel" aria-labelledby="promotions-tab">
						promotions
					</div>
					<div class="tab-pane fade" id="course-meetings" role="tabpanel" aria-labelledby="course-meetings-tab">
						course-meetings
					</div>
				</div><!-- End Default Tabs -->
				<div class="my-5">
					<a href="<?= ROOT ?>/admin/courses">
						<button class="btn btn-primary float-start">Back</button>
					</a>
					<button class="btn btn-success float-end">Save</button>
				</div>
			<?php else : ?>
				<div>That course was not found</div>
			<?php endif; ?>
		</div>
	</div>
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
								<td><?= esc($row->user_row->name ?? 'Unknown') ?></td>
								<td><?= esc($row->category_row->category ?? 'Unknown') ?></td>
								<td><?= esc($row->price_row->name ?? 'Unknown') ?></td>
								<td><?= esc($row->primary_subject) ?></td>
								<td><?= format_date(esc($row->date)) ?></td>
								<td>
									<a href="<?= ROOT ?>/admin/courses/edit/<?= $row->id ?>">
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

<script>
	var tab = sessionStorage.getItem('tab') ? sessionStorage.getItem('tab') : '#intended-learners'
</script>

<?php Controller::view_static('admin/footer') ?>