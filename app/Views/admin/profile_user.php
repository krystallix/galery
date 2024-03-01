<?= $this->extend('layout/admin/header'); ?>

<?= $this->section('content'); ?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li style="margin-right: 20px;">
                            <div>
                                <form action="/admin" method="post" autocomplete="off">
                                    <div class="input-group input-group-sm col-12" style="width: 300px;">
                                        <?php $request = \Config\Services::request(); ?>
                                        <input type="text" name="keyword" value="<?= $request->getVar('keyword') ?>" class="form-control float-right" placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profile User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="col-md-12 mx-auto">

                <div class="profile-admin card card-widget widget-user shadow">
                    <?php foreach ($user as $u) { ?>
                        <div class="widget-user-header">
                            <div class="widget-user-username"><?= $u->nama_lengkap; ?></div>
                            <div class="widget-user-desc">User <?= $u->user_id; ?></div>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="<?php echo base_url('assets') ?>/dist/img/user1-128x128.jpg" alt="User Avatar">
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-center">
                                <div class="username-admin">
                                    <?= $u->username; ?>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="deskripsi-admin">
                                    <?= $u->describe_profile; ?>
                                </div>
                            </div>
                            <!-- <div class="row justify-content-center">
                            <div class="button-edit-profile">
                                <a href="/admin/editProfile" class="btn btn-warning">Edit Profile</a>
                            </div>
                        </div> -->
                            <!-- <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">3,200</h5>
                                    <span class="description-text">SALES</span>
                                </div>

                            </div>

                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">13,000</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>

                            </div>

                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">35</h5>
                                    <span class="description-text">PRODUCTS</span>
                                </div>

                            </div>

                        </div> -->

                        </div>
                    <?php } ?>
                </div>

            </div>

            <div class="garis"></div>

            <main id="main" data-aos="fade" data-aos-delay="1500">

                <!-- ======= Gallery Section ======= -->
                <section id="gallery" class="gallery">
                    <div class="container-fluid">

                        <div class="induk row gy-4">
                            <?php foreach ($foto as $f) { ?>
                                <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                    <div class="gallery-item h-100">
                                        <img src="<?php echo base_url('assets') ?>/img/gallery/<?= $f->photo; ?>" class="img-fluid" alt="">
                                        <div class="gallery-links d-flex align-items-center justify-content-center">
                                            <a href="/admin/detail" title="Detail" class="preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                        </div>
                                    </div>
                                </div><!-- End Gallery Item -->
                            <?php } ?>
                            <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                <div class="gallery-item">
                                    <img src="<?php echo base_url('assets') ?>/img/gallery/gallery-2.jpg" class="img-fluid" alt="">
                                    <div class="gallery-links d-flex align-items-center justify-content-center">
                                        <a href="<?php echo base_url('assets') ?>/img/gallery/gallery-2.jpg" title="Gallery 2" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                        <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div><!-- End Gallery Item -->
                            <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                <div class="gallery-item h-100">
                                    <img src="<?php echo base_url('assets') ?>/img/gallery/gallery-3.jpg" class="img-fluid" alt="">
                                    <div class="gallery-links d-flex align-items-center justify-content-center">
                                        <a href="<?php echo base_url('assets') ?>/img/gallery/gallery-3.jpg" title="Gallery 3" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                        <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div><!-- End Gallery Item -->
                            <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                <div class="gallery-item h-100">
                                    <img src="<?php echo base_url('assets') ?>/img/gallery/gallery-4.jpg" class="img-fluid" alt="">
                                    <div class="gallery-links d-flex align-items-center justify-content-center">
                                        <a href="<?php echo base_url('assets') ?>/img/gallery/gallery-4.jpg" title="Gallery 4" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                        <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div><!-- End Gallery Item -->
                            <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                <div class="gallery-item h-100">
                                    <img src="<?php echo base_url('assets') ?>/img/gallery/gallery-5.jpg" class="img-fluid" alt="">
                                    <div class="gallery-links d-flex align-items-center justify-content-center">
                                        <a href="<?php echo base_url('assets') ?>/img/gallery/gallery-5.jpg" title="Gallery 5" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                        <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div><!-- End Gallery Item -->
                            <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                <div class="gallery-item h-100">
                                    <img src="<?php echo base_url('assets') ?>/img/gallery/gallery-6.jpg" class="img-fluid" alt="">
                                    <div class="gallery-links d-flex align-items-center justify-content-center">
                                        <a href="<?php echo base_url('assets') ?>/img/gallery/gallery-6.jpg" title="Gallery 6" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                        <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div><!-- End Gallery Item -->
                            <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                <div class="gallery-item h-100">
                                    <img src="<?php echo base_url('assets') ?>/img/gallery/gallery-7.jpg" class="img-fluid" alt="">
                                    <div class="gallery-links d-flex align-items-center justify-content-center">
                                        <a href="<?php echo base_url('assets') ?>/img/gallery/gallery-7.jpg" title="Gallery 7" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                        <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div><!-- End Gallery Item -->

                        </div>

                    </div>
                </section><!-- End Gallery Section -->

            </main><!-- End #main -->

        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection(); ?>