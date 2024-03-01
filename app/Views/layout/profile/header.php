<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- <title>PhotoFolio Bootstrap Template - Index</title> -->
    <title><?= $title; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?php echo base_url('assets') ?>/img/favicon.png" rel="icon">
    <link href="<?php echo base_url('assets') ?>/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url('assets') ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/vendor/snackbar/snackbar.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/vendor/aos/aos.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?php echo base_url('assets') ?>/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: PhotoFolio
  * Updated: Jan 09 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center  me-auto me-lg-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <i class="bi bi-camera"></i>
                <h1>PhotoFolio</h1>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <!-- <li><a href="/" class="active">Home</a></li> -->
                    <li><a class="upload-photo" style="cursor: pointer">Upload</a></li>
                    <!-- <li><a href="about.html">About</a></li>
                    <li class="dropdown"><a href="#"><span>Gallery</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <li><a href="gallery.html">Nature</a></li>
                            <li><a href="gallery.html">People</a></li>
                            <li><a href="gallery.html">Architecture</a></li>
                            <li><a href="gallery.html">Animals</a></li>
                            <li><a href="gallery.html">Sports</a></li>
                            <li><a href="gallery.html">Travel</a></li>
                            <li class="dropdown"><a href="#"><span>Sub Menu</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                                <ul>
                                    <li><a href="#">Sub Menu 1</a></li>
                                    <li><a href="#">Sub Menu 2</a></li>
                                    <li><a href="#">Sub Menu 3</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="contact.html">Contact</a></li> -->
                </ul>

                <!-- <span class="divider"></span>
                <div class="profile">
                    <img src="assets/img/gallery/gallery-5.jpg" alt="">
                    <ul class="profile-link">
                        <li><a href="#"><i class='bx bxs-user-circle icon'></i> Profile</a></li>
                        <li><a href="#"><i class='bx bxs-cog'></i> Settings</a></li>
                        <li><a href="#"><i class='bx bxs-log-out-circle'></i> Logout</a></li>
                    </ul>
                </div> -->
            </nav><!-- .navbar -->

            <!-- <div>
                <form action="" method="post">
                    <div class="input-group input-group-sm col-12" style="width: 290px;">
                        <input type="text" name="keyword" class="search form-control" placeholder="Search">

                        <div class="button-search input-group-append">
                            <button type="submit" class="btn white">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div> -->

            <!-- <span class="divider"></span> -->
            <div class="my-profile d-flex">
                <div class="search">
                    <form action="" method="post">
                        <div class="input-group input-group-sm col-12">
                            <input type="text" name="keyword" class="input-search form-control" placeholder="Search">

                            <div class="button-search input-group-append">
                                <button type="submit" class="btn white">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div>

                    <?php
                    $profileUser = userProfileLogin()->photo_profile;
                    ?>

                    <img src="<?php echo base_url('assets') ?>/img/profile/<?= $profileUser; ?>" alt="">
                    <ul class="profile-option">
                        <li><a href="/my-profile"><i class="bi bi-person-circle"></i> Profile</a></li>
                        <li onclick="return confirm('Apakah yakin logout?');"><a href="/logout"><i class="bi bi-arrow-left-circle-fill"></i> Logout</a></li>
                    </ul>
                </div>
            </div>

            <!-- <div class="header-social-links">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
            </div> -->
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

        </div>
    </header><!-- End Header -->

    <?= $this->renderSection('content_pengguna'); ?>

    <?= $this->include('layout/profile/footer'); ?>