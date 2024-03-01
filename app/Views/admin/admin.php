<?= $this->extend('layout/admin/header'); ?>

<?= $this->section('content'); ?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li style="margin-right: 20px;">
                            <div>
                                <form action="" method="post" autocomplete="off">
                                    <?= csrf_field(); ?>
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
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <main id="main" data-aos="fade" data-aos-delay="1500">

                <!-- ======= Gallery Section ======= -->
                <section id="gallery" class="gallery">
                    <div class="container-fluid">
                        <?php if (session()->getFlashdata('pesan_delete')) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('pesan_delete'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <div class="induk row gy-4">
                            <?php
                            foreach ($foto as $f) : ?>
                                <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                    <div class="gallery-item h-100">
                                        <img src="<?php echo base_url('assets') ?>/img/gallery/<?= $f->photo; ?>" class="img-fluid" alt="">
                                        <div class="gallery-links d-flex align-items-center justify-content-center">
                                            <a href="/admin/detail/<?= $f->id_photo; ?>" title="Detail" class="preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                            <!-- <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a> -->
                                        </div>
                                    </div>
                                </div><!-- End Gallery Item -->
                            <?php endforeach; ?>
                            <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                <div class="gallery-item">
                                    <img src="assets/img/gallery/gallery-2.jpg" class="img-fluid" alt="">
                                    <div class="gallery-links d-flex align-items-center justify-content-center">
                                        <a href="assets/img/gallery/gallery-2.jpg" title="Gallery 2" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                        <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div><!-- End Gallery Item -->
                            <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                <div class="gallery-item h-100">
                                    <img src="assets/img/gallery/gallery-3.jpg" class="img-fluid" alt="">
                                    <div class="gallery-links d-flex align-items-center justify-content-center">
                                        <a href="assets/img/gallery/gallery-3.jpg" title="Gallery 3" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                        <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div><!-- End Gallery Item -->
                            <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                <div class="gallery-item h-100">
                                    <img src="assets/img/gallery/gallery-4.jpg" class="img-fluid" alt="">
                                    <div class="gallery-links d-flex align-items-center justify-content-center">
                                        <a href="assets/img/gallery/gallery-4.jpg" title="Gallery 4" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                        <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div><!-- End Gallery Item -->
                            <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                <div class="gallery-item h-100">
                                    <img src="assets/img/gallery/gallery-5.jpg" class="img-fluid" alt="">
                                    <div class="gallery-links d-flex align-items-center justify-content-center">
                                        <a href="assets/img/gallery/gallery-5.jpg" title="Gallery 5" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                        <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div><!-- End Gallery Item -->
                            <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                <div class="gallery-item h-100">
                                    <img src="assets/img/gallery/gallery-6.jpg" class="img-fluid" alt="">
                                    <div class="gallery-links d-flex align-items-center justify-content-center">
                                        <a href="assets/img/gallery/gallery-6.jpg" title="Gallery 6" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                        <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div><!-- End Gallery Item -->
                            <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                <div class="gallery-item h-100">
                                    <img src="assets/img/gallery/gallery-7.jpg" class="img-fluid" alt="">
                                    <div class="gallery-links d-flex align-items-center justify-content-center">
                                        <a href="assets/img/gallery/gallery-7.jpg" title="Gallery 7" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                        <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div><!-- End Gallery Item -->
                            <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                <div class="gallery-item h-100">
                                    <img src="assets/img/gallery/gallery-8.jpg" class="img-fluid" alt="">
                                    <div class="gallery-links d-flex align-items-center justify-content-center">
                                        <a href="assets/img/gallery/gallery-8.jpg" title="Gallery 8" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                        <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div><!-- End Gallery Item -->
                            <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                <div class="gallery-item h-100">
                                    <img src="assets/img/gallery/gallery-9.jpg" class="img-fluid" alt="">
                                    <div class="gallery-links d-flex align-items-center justify-content-center">
                                        <a href="assets/img/gallery/gallery-9.jpg" title="Gallery 9" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                        <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div><!-- End Gallery Item -->
                            <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                <div class="gallery-item h-100">
                                    <img src="assets/img/gallery/gallery-10.jpg" class="img-fluid" alt="">
                                    <div class="gallery-links d-flex align-items-center justify-content-center">
                                        <a href="assets/img/gallery/gallery-10.jpg" title="Gallery 10" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                        <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div><!-- End Gallery Item -->
                            <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                <div class="gallery-item h-100">
                                    <img src="assets/img/gallery/gallery-11.jpg" class="img-fluid" alt="">
                                    <div class="gallery-links d-flex align-items-center justify-content-center">
                                        <a href="assets/img/gallery/gallery-11.jpg" title="Gallery 11" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                        <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div><!-- End Gallery Item -->
                            <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                <div class="gallery-item h-100">
                                    <img src="assets/img/gallery/gallery-12.jpg" class="img-fluid" alt="">
                                    <div class="gallery-links d-flex align-items-center justify-content-center">
                                        <a href="assets/img/gallery/gallery-12.jpg" title="Gallery 12" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                        <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div><!-- End Gallery Item -->
                            <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                <div class="gallery-item h-100">
                                    <img src="assets/img/gallery/gallery-13.jpg" class="img-fluid" alt="">
                                    <div class="gallery-links d-flex align-items-center justify-content-center">
                                        <a href="assets/img/gallery/gallery-13.jpg" title="Gallery 13" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                        <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div><!-- End Gallery Item -->
                            <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                <div class="gallery-item h-100">
                                    <img src="assets/img/gallery/gallery-14.jpg" class="img-fluid" alt="">
                                    <div class="gallery-links d-flex align-items-center justify-content-center">
                                        <a href="assets/img/gallery/gallery-14.jpg" title="Gallery 14" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                        <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div><!-- End Gallery Item -->
                            <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                <div class="gallery-item h-100">
                                    <img src="assets/img/gallery/gallery-15.jpg" class="img-fluid" alt="">
                                    <div class="gallery-links d-flex align-items-center justify-content-center">
                                        <a href="assets/img/gallery/gallery-15.jpg" title="Gallery 15" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                                        <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div><!-- End Gallery Item -->
                            <div class="gambar col-xl-3 col-lg-4 col-md-6">
                                <div class="gallery-item h-100">
                                    <img src="assets/img/gallery/gallery-16.jpg" class="img-fluid" alt="">
                                    <div class="gallery-links d-flex align-items-center justify-content-center">
                                        <a href="assets/img/gallery/gallery-16.jpg" title="Gallery 16" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
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