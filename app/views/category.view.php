<?php

/**
 * @var \Controller\Home $this
 */
$this->view('includes/header', $data);
$this->view('includes/nav', $data);


?>


<?php if (!empty($first_row)) :  ?>
  <!-- ======= Post Grid Section ======= -->
  <section id="posts" class="posts">
    <div class="container" data-aos="fade-up">

      <div class="section-header d-flex justify-content-between align-items-center mb-5">
        <h2><?= $first_row->category ?></h2>
      </div>


      <div class="row g-5">
        <div class="col-lg-4">
          <div class="post-entry-1 lg">
            <a href="single-post.html"><img src="<?= get_image($first_row->course_image ?? 'Unknown', 'courses')  ?>" alt="" class="img-fluid" style="object-fit:cover"></a>
            <div class="post-meta"><span class="date"><?= esc($first_row->category_row->category  ?? 'Unknown') ?></span> <span class="mx-1">&bullet;</span> <span><?= get_date($first_row->date) ?></span></div>
            <h2><a href="single-post.html"><?= esc($first_row->title) ?></a></h2>
            <p class="mb-4 d-block"><?= esc($first_row->description)  ?></p>

            <?php if (!empty($first_row->user_row)) : ?>
              <div class="d-flex align-items-center author">
                <div class="photo"><img src="<?= get_image($first_row->user_row->image) ?>" alt="" class="img-fluid"></div>
                <div class="name">
                  <h3 class="m-0 p-0"><?= $first_row->user_row->firstname ?? 'Unknown' ?> <?= $first_row->user_row->lastname ?? 'Unknown'  ?></h3>
                </div>
              </div>
            <?php endif; ?>
          </div>

        </div>

        <div class="col-lg-8">
          <div class="row g-5">
            <div class="col-lg-4 border-start custom-border">
              <?php if (!empty($rows1)) : ?>
                <?php foreach ($rows1 as $row) : ?>
                  <div class="post-entry-1">
                    <a href="single-post.html"><img src="<?= get_image($row->course_image, 'courses') ?>" alt="" class="img-fluid"></a>
                    <div class="post-meta"><span class="date"><?= esc($row->category_row->category ?? 'Unknown') ?></span> <span class="mx-1">&bullet;</span> <span><?= get_date($row->date) ?? 'No date' ?></span></div>
                    <h2><a href="single-post.html"><?= esc(ucfirst($row->title)) ?></a></h2>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>

            <div class="col-lg-4 border-start custom-border">
              <?php if (!empty($rows2)) : ?>
                <?php foreach ($rows2 as $row) : ?>
                  <div class="post-entry-1">
                    <a href="single-post.html"><img src="<?= get_image($row->course_image, 'courses') ?>" alt="" class="img-fluid"></a>
                    <div class="post-meta"><span class="date"><?= esc($row->category_row->category ?? 'Unknown') ?></span> <span class="mx-1">&bullet;</span> <span><?= get_date($row->date) ?? 'No date' ?></span></div>
                    <h2><a href="single-post.html"><?= esc(ucfirst($row->title)) ?></a></h2>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>


            </div>


          </div>
        </div>

      </div> <!-- End .row -->
    </div>
  </section> <!-- End Post Grid Section -->

<?php else : ?>
  <div class="container p-3">
    <div class="alert alert-primary d-flex  align-items-center justify-content-center" style="height: 200px;">
      <p style="font-size: 1.5rem;">No records were found</p>
    </div>
  </div>

<?php endif; ?>



<?php $this->view('includes/footer', $data) ?>