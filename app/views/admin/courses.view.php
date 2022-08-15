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
			<h5 class="card-title">Edit Course</h5>

			<?php if (!empty($row)) : ?>


				<h5 class="card-title"><?= esc($row->title) ?></h5>


				<!-- Default Tabs -->
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Profile</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false" tabindex="-1">Contact</button>
					</li>
				</ul>
				<div class="tab-content pt-2" id="myTabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.
					</div>
					<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						Nesciunt totam et. Consequuntur magnam aliquid eos nulla dolor iure eos quia. Accusantium distinctio omnis et atque fugiat. Itaque doloremque aliquid sint quasi quia distinctio similique. Voluptate nihil recusandae mollitia dolores. Ut laboriosam voluptatum dicta.
					</div>
					<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
						Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque. Accusantium quibusdam perspiciatis qui qui omnis magnam. Officiis accusamus impedit molestias nostrum veniam. Qui amet ipsum iure. Dignissimos fuga tempore dolor.
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

<?php Controller::view_static('admin/footer') ?>