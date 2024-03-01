<?= $this->extend('layout/pengguna/header'); ?>

<?= $this->section('content_pengguna'); ?>

<main id="main" data-aos="fade" data-aos-delay="1500">

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
        <!-- <div class="container-fluid">
            <div class="row gy-4 justify-content-center">
                <div class="card mb-3" style="max-width: 1000px; height: 750px">
                    <div class="row g-0">
                        <div class="detail-foto col-md-6">
                            <img src="assets/img/gallery/gallery-1.jpg" class="img-fluid rounded-start" alt="">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                <div class="profile-pengguna">
                                    <img src="assets/img/gallery/gallery-2.jpg" alt="">
                                    <span>username</span>
                                </div>
                                <div class="comment">

                                </div>
                                <div class="divider"></div>

                                <div class="input-comment">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <?php if (session()->getFlashdata('pesan_insert')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?= session()->getFlashdata('pesan_insert'); ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <div class="card-detail card mb-3">
                        <div class="row no-gutters">
                            <?php
                            foreach ($detail_foto as $d) : ?>
                                <div class="col-md-6">
                                    <div class="container">
                                        <div class="blur">
                                            <img src="<?php echo base_url('assets') ?>/img/gallery/<?= $d->photo; ?>" class="card-img" alt="gambar" height="100%">
                                        </div>
                                        <div class="foto">
                                            <img src="<?php echo base_url('assets') ?>/img/gallery/<?= $d->photo; ?>" class="card-img" alt="gambar" height="100%">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <!-- <h5 class="card-title">Card title</h5>
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                        <div class="profile-pengguna">
                                            <a href="/profile-user">
                                                <img src="<?php echo base_url('assets') ?>/img/profile/<?= $d->photo_profile; ?>" alt="">
                                                <span class="username-pengguna"><?= $d->username; ?></span>
                                            </a>
                                            <span class="float-end"><i class="bi bi-x-octagon h5"></i></span>
                                        </div>
                                        <div class="deskripsi">
                                            <div class="judul-foto">
                                                <p><?= $d->judul_foto; ?></p>
                                            </div>
                                            <div class="deskripsi-foto">
                                                <p><?= $d->describe_photo; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="aksi">
                                            <div class="like">
                                                <button type="button" class="btn-sm btn-like" id="likeBtn" onclick="window.location='<?php echo site_url('Pengguna/index'); ?>'">
                                                    <div class="icon-like">
                                                        <i class="bi bi-heart h5"></i>
                                                    </div>
                                                </button>
                                                <!-- <div class="icon-like">
                                                    <i class="bi bi-heart h5"></i>
                                                </div> -->
                                                <div class="jumlah-like">
                                                    1.000 likes
                                                </div>
                                            </div>
                                            <div class="share">
                                                <input type="hidden" value="<?= $uri; ?>" id="copyLink">
                                                <button type="button" class="btn-sm btn-share" id="copyBtn">
                                                    <div class="icon-share">
                                                        <i class="bi bi-share-fill h5"></i>
                                                    </div>
                                                </button>
                                                <!-- <div class="icon-share">
                                                    <i class="bi bi-share-fill h5"></i>
                                                </div> -->
                                                <div class="text-share">
                                                    Share
                                                </div>
                                            </div>

                                            <div class="copied" id="copied">
                                                Link tersalin!
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="comment">
                                            <?php
                                            foreach ($comment as $c) : ?>
                                                <div class="comment-output">
                                                    <div class="profile-commentator">
                                                        <a href="/profile-user">
                                                            <img src="<?php echo base_url('assets') ?>/img/profile/<?= $c->photo_profile; ?>" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="detail-comment">
                                                        <a href="/profile-user">
                                                            <div class="username-commentator">
                                                                <?= $c->username; ?>
                                                            </div>
                                                        </a>
                                                        <div class="isi-comment">
                                                            <?= $c->comment; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            <div class="comment-output">
                                                <div class="profile-commentator">
                                                    <a href="/profile-user">
                                                        <img src="assets/img/gallery/gallery-4.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="detail-comment">
                                                    <a href="/profile-user">
                                                        <div class="username-commentator">
                                                            username
                                                        </div>
                                                    </a>
                                                    <div class="isi-comment">
                                                        This is a wider card.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="comment-output">
                                                <div class="profile-commentator">
                                                    <a href="/profile-user">
                                                        <img src="assets/img/gallery/gallery-4.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="detail-comment">
                                                    <a href="/profile-user">
                                                        <div class="username-commentator">
                                                            username
                                                        </div>
                                                    </a>
                                                    <div class="isi-comment">
                                                        This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="comment-output">
                                                <div class="profile-commentator">
                                                    <a href="/profile-user">
                                                        <img src="assets/img/gallery/gallery-4.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="detail-comment">
                                                    <a href="/profile-user">
                                                        <div class="username-commentator">
                                                            username
                                                        </div>
                                                    </a>
                                                    <div class="isi-comment">
                                                        This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>







                                        <!-- <div class="komentar">
                                        <div class="komentar-pengguna">
                                            <div class="comment-output">
                                                <img src="assets/img/gallery/gallery-4.jpg" alt="">
                                                <span class="username">username</span>
                                                <span class="komen">
                                                    <p>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="komentar-pengguna">
                                            <div class="comment-output">
                                                <img src="assets/img/gallery/gallery-4.jpg" alt="">
                                                <span class="username">username</span>
                                                <span class="komen">
                                                    <p>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="komentar-pengguna">
                                            <div class="comment-output">
                                                <img src="assets/img/gallery/gallery-4.jpg" alt="">
                                                <span class="username">username</span>
                                                <span class="komen">
                                                    <p>This is a wider card.</p>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="komentar-pengguna">
                                            <div class="comment-output">
                                                <img src="assets/img/gallery/gallery-4.jpg" alt="">
                                                <span class="username">username</span>
                                                <span class="komen">
                                                    <p>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="komentar-pengguna">
                                            <div class="comment-output">
                                                <img src="assets/img/gallery/gallery-4.jpg" alt="">
                                                <span class="username">username</span>
                                                <span class="komen">
                                                    <p>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                </span>
                                            </div>
                                        </div>
                                    </div> -->
                                        <!-- <hr> -->
                                        <!-- <div class="detail-aksi">
                                        <ul>
                                            <li class="like"><i class="bi bi-heart h5"></i></li>
                                            <li>
                                                <h5>|</h5>
                                            </li>
                                            <li class="share"><i class="bi bi-share-fill h5"></i></li>
                                        </ul>
                                        <ul class="keterangan">
                                            <li class="jml-like">1.000 likes</li>
                                            <li class="garis">
                                                |
                                            </li>
                                            <li class="text-share">Share</li>
                                        </ul>
                                    </div> -->

                                        <!-- <div class="detail-aksi">
                                        <ul class="aksi">
                                            <li>
                                                <ul class="like"><i class="bi bi-heart h5"></i></ul>
                                                <ul class="jml-like">1.000 likes</ul>
                                            </li>
                                            <li>
                                                <ul>
                                                    <h5>|</h5>
                                                </ul>
                                                <ul class="garis">|</ul>
                                            </li>
                                            <li>
                                                <ul class="share"><i class="bi bi-share-fill h5"></i></ul>
                                                <ul class="text-share">Share</ul>
                                            </li>
                                        </ul>
                                    </div> -->
                                        <div class="input-comment">
                                            <hr>
                                            <div class="comment-profile">
                                                <img src="<?php echo base_url('assets') ?>/img/profile/<?= userProfileLogin()->photo_profile; ?>" alt="">
                                            </div>
                                            <div class="add-comment">
                                                <form action="/komentar/<?= $d->id_photo; ?>/<?= userLogin()->user_id; ?>" method="post">
                                                    <?= csrf_field(); ?>
                                                    <div class="form-group">
                                                        <input class="form-control <?= (session('validation') && session('validation')->hasError('comment')) ? 'is-invalid' : ''; ?>" id="comment" name="comment" type="text" placeholder="Tambahkan komentar" value="<?= old('comment'); ?>">
                                                        <?php if (session('validation') && session('validation')->hasError('comment')) : ?>
                                                            <div id="comment" class="invalid-feedback">
                                                                <?= session('validation')->getError('comment'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        <button type="submit" class="btn-send"><i class="icon-send bi bi-send-fill h4"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- <div class="input-comment">
                                        <div class="detail-input">
                                            <form action="">
                                                <div class="comment-profile">
                                                    <img src="assets/img/gallery/gallery-3.jpg" alt="">
                                                </div>
                                                <div class="add-comment">
                                                    <input class="form-control" type="text" placeholder="Tambahkan komentar">
                                                </div>
                                                <div class="submit">
                                                    <button type="submit"><i class="icon-send bi bi-send-fill h4"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <form action="">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Tambahkan komentar">
                                            <button type="submit"><i class="btn-send bi bi-send-fill h4"></i></button>
                                        </div>
                                    </form> -->

                                        <!-- <div class="input-comment">
                                        <div class="input-group">
                                            <div class="profile">
                                                <img src="assets/img/gallery/gallery-3.jpg" alt="">
                                            </div>
                                            <div class="comment">
                                                <input class="form-control" type="text" placeholder="Tambahkan komentar">
                                            </div>
                                            <div class="send">
                                                <button type="submit"><i class="icon-send bi bi-send-fill h4"></i></button>
                                            </div>
                                        </div>
                                    </div> -->
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="card mb-3" style="max-width: 1000px; max-height: 1000px">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <img src="assets/img/gallery/1.jpg" class="card-img" alt="gambar" height="100%">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </section><!-- End Gallery Section -->

</main><!-- End #main -->

<?= $this->endSection(); ?>