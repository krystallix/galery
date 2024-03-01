
<?= $this->extend('layout/pengguna/header'); ?>

<?= $this->section('content_pengguna'); ?>

<!-- Modal -->
<div class="modal fade" id="ModalPhoto" tabindex="-1" role="dialog" aria-labelledby="ModalPhotoTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card-detail card">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <div class="container">
                            <div class="blur">
                                <img id="img-blur" src=""
                                    class="card-img" alt="gambar" height="100%">
                            </div>
                            <div class="foto">
                                <img id="img-main" src=""
                                    class="card-img" alt="gambar" height="100%">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="profile-pengguna" >
                                <a href="/profile-user">
                                    <img id="profile-user" src=""
                                        alt="">
                                    <span class="username-pengguna" id="profile-modal">
                                    </span>
                                </a>
                                <span id="close-modal" class="float-end"><i class="bi bi-x-octagon h5"></i></span>
                            </div>
                            <div class="deskripsi">
                                <div class="judul-foto" id="judul-foto-modal">
                                   
                                </div>
                                <div class="deskripsi-foto"  id="deskripsi-foto-modal">
                                </div>
                            </div>
                            <hr>
                            <?php
                                $user_id = userProfileLogin()->user_id;
                                ?>
                            <div class="aksi">
                                <div class="like">
                                    <button type="button" class="btn-sm btn-like" id="likeBtn">
                                    <form id="likes-form" method="post">                                                
                                            <input type="hidden" class="photo-data" name="id_photo" value="">
                                            <input type="hidden" id="user-data" name="user_id" value="<?= $user_id; ?>">

                                        </form>
                                        <div class="icon-like">
                                            <i id="icon-like-status" class="bi bi-heart h5"></i>
                                        </div>
                                    </button>
                                  
                                    
                              
                                <div class="jumlah-like" id="total-like" >
                                      
                                    </div>
                                </div>
                                <div class="share">
                                    <button type="button" class="btn-sm btn-share" id="copyBtn">
                                        <div class="icon-share" photo-data="">
                                            <i class="bi bi-share-fill h5"></i>
                                        </div>
                                    </button>
                                    
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
                                <div class="comment-output" id="comment-section" >
                                    
                                </div>
                               
                            </div>
                            <div class="input-comment">
                                <hr>
                                <div class="comment-profile">
                                    <img id="img-comment-profile" src=""
                                        alt="">
                                </div>
                                <div class="add-comment">
                                    <form method="post" id="add-comment-form">
                                        <?= csrf_field(); ?>
                                        <div class="form-group">
                                        <input type="hidden" class="photo-data" name="id_photo" value="">
                                            <input type="hidden" id="user-data" name="user_id" value="<?= $user_id; ?>">
                                            <input
                                                class="form-control"
                                                id="comment" name="comment" type="text" placeholder="Tambahkan komentar"
                                                value="">
                                            <button type="submit" class="btn-send"><i
                                                    class="icon-send bi bi-send-fill h4"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<main id="main" data-aos="fade" data-aos-delay="1500">

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
        <div class="container-fluid">

            <div class="galeri-main gy-4" id="galeri-section">
            
            </div>

        </div>
    </section><!-- End Gallery Section -->

</main><!-- End #main -->



<?= $this->endSection(); ?>