<?= $this->extend('layout/profile/header'); ?>


<?= $this->section('content_pengguna'); ?>
<?php
$user_id = userProfileLogin()->user_id;
?>
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="delete-modalLabel">Hapus Foto</h5>
                <button type="button" class="close" style="background: transparent; border: 0;" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark" id="delete-text">
                Apakah Kamu Ingin Menghapus foto ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="close btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="delete-button" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- edit photo -->
<div class="modal fade" id="EditPhotoModal" tabindex="-1" role="dialog" aria-labelledby="EditPhotoModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card-detail card">
                <div class="card-header">
                    Form Edit Foto
                    <div class="float-end">
                        <i class="bi bi-close"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row no-gutters">
                        <div class="col-md-6">
                            <div>
                                <img src="" class="img-preview card-img" id="edit-img" alt="gambar" height="100%">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <form id="editPhotoForm">
                                    <input type="hidden" name="id_photo" id="photo-id">
                                    <input type="hidden" name="user_id" id="userid-edit">
                                    <!-- <div class="foto form-group">
<label>Foto</label>
<div>
<input type="file" class="form-control" id="foto" name="foto"
onchange="previewImg()" accept="image/*" value="">
</div>
</div> -->
                                    <div class="judul form-group">
                                        <label>Judul</label>
                                        <input type="text" class="form-control" id="edit-judul" name="judul_foto"
                                            placeholder="Masukkan judul foto" value="">
                                    </div>
                                    <div class="deskripsi form-group">
                                        <label>Deskripsi</label>
                                        <textarea class="form-control" id="edit-deskripsi" name="deskripsi" cols="30"
                                            rows="10" placeholder="Masukkan deskripsi foto"></textarea>
                                    </div>
                                    <div class="mt-2">
                                        <button type="reset" id="reset-edit-btn"
                                            class="btn btn-secondary">Reset</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
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

<!-- post foto  -->
<div class="modal fade" id="postFotoModal" tabindex="-1" role="dialog" aria-labelledby="postFotoModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card-detail card" style="padding: 0; border:0;">
                <div class="card-header">
                    Form Post Foto
                    <div class="float-end">
                        <button type="button" class="close" style="background: transparent; border: 0;"
                            data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <?= csrf_field(); ?>
                <div class="card-body">
                    <div class="row no-gutters">
                        <div class="col-md-6">
                            <div>
                                <img src="assets/img/defaultFoto.jpg" class="img-preview card-img" id="preview-upload" alt="gambar"
                                    height="100%">
                            </div>
                            <!-- <div>
                                            <input type="file" class="form-control">
                                        </div> -->
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <div class="foto form-group mb-3">
                                    <label>Foto</label>
                                    <div>
                                        <input type="file"
                                            class="form-control"
                                            id="photo-upload" name="foto" accept="image/*"
                                            value="">
                                    </div>
                                </div>
                                <div class="judul form-group mb-3">
                                    <label>Judul</label>
                                    <input type="text"
                                        class="form-control"
                                        id="judul" name="judul_foto" placeholder="Masukkan judul foto"
                                        value="">
                                </div>
                                <div class="deskripsi form-group mb-3">
                                    <label>Deskripsi</label>
                                    <textarea
                                        class="form-control"
                                        id="deskripsi" name="deskripsi" cols="30" rows="10"
                                        placeholder="Masukkan deskripsi foto"></textarea>
                                    
                                </div>
                                <div >
                                    <button type="submit" class="btn btn-primary">Post</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- edit profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card-detail card" style="padding: 0; border:0;">
                <div class="card-body" style="padding: 0; border:0;">
                    <form enctype="multipart/form-data" id="edit-photo-form">
                        <div class="profile" style="height: 25vh; min-height: 25vh;">
                            <div class="profile-avatar">
                                <img src="assets/img/profile/<?= userProfileLogin()->photo_profile; ?>" alt=""
                                    class="profile-img" id="preview-profile">
                                <div class="circle-edit-profile">
                                    <label for="photo-profile-edit">
                                        <i class="bi bi-pencil-fill icon-edit-profile"></i>
                                    </label>
                                    <input type="file" name="foto" id="photo-profile-edit" accept="image/*"
                                        class="d-none">
                                    <input type="hidden" name="user_id" id="userid_input">
                                    <input type="hidden" name="profile_id"
                                        value="<?= userProfileLogin()->profile_id; ?>">
                                </div>
                                <div>
                                    <div class="d-flex align-items-center">
                                        <div class="profile-name ms-0"><?= userLogin()->nama_lengkap; ?></div>
                                        <div class="profile-username px-2">@<?= userLogin()->username; ?></div>
                                    </div>

                                    <div class="profile-desc ms-0" style="margin-bottom: -55px">
                                        <?= userProfileLogin()->describe_profile; ?></div>
                                </div>
                            </div>
                            <img src="assets/img/background-cover.jpg" alt="" class="profile-cover">
                        </div>
                        <div class="px-3 py-4">
                            <div class="mb-3">
                                <label for="namaLengkap_input" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="namaLengkap_input" name="nama_lengkap"
                                    placeholder="Masukkan nama lengkap">
                            </div>
                            <div class="mb-3">
                                <label for="username_input" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username_input" name="username"
                                    placeholder="Masukkan username">
                            </div>
                            <div class="mb-3">
                                <label for="email_input" class="form-label">E-mail</label>
                                <input type="text" class="form-control" id="email_input" name="email"
                                    placeholder="Masukkan email">
                            </div>
                            <div class="mb-3">
                                <label for="bio_input" class="form-label">Deskripsi Profile</label>
                                <textarea class="form-control" id="bio_input" name="deskripsi_profile" cols="30"
                                    rows="3"></textarea>
                            </div>
                            <div class="input-profile form-group mb-3">
                                <label class="form-label">Password</label>
                                <div class="d-flex align-items-end">
                                    <div class="ganti-password" id="ganti-password">
                                        <span aria-hidden="true" class="ganti">Ganti Password</span>
                                    </div>
                                    <div class="batal-ganti" id="batal-ganti">
                                        <span aria-hidden="true" class="ganti">Batal</span>
                                    </div>
                                </div>
                                <div class="input-group mb-3 input-password" style="margin-top: 8px; display: none;"
                                    id="input-password">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Masukkan password">
                                    <div class="input-group-append">
                                        <button class="btn" type="button"
                                            style="background-color: transparent; border:0;"><i
                                                class="bi bi-eye-slash h5" id="togglePassword"></i></button>

                                    </div>
                                </div>

                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-secondary mx-2">Reset</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalPhoto" tabindex="-1" role="dialog" aria-labelledby="ModalPhotoTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card-detail card">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <div class="container">
                            <div class="blur">
                                <img id="img-blur" src="" class="card-img" alt="gambar" height="100%">
                            </div>
                            <div class="foto">
                                <img id="img-main" src="" class="card-img" alt="gambar" height="100%">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="profile-pengguna">
                                <a href="/profile-user">
                                    <img src="" id="profile-user" alt="">
                                    <span class="username-pengguna" id="profile-modal">
                                    </span>
                                </a>
                                <span id="close-modal" class="close float-end" style="cursor: pointer;"><i
                                        class="bi bi-x-octagon h5"></i></span>
                            </div>
                            <div class="deskripsi">
                                <div class="judul-foto" id="judul-foto-modal">

                                </div>
                                <div class="deskripsi-foto" id="deskripsi-foto-modal">
                                </div>
                            </div>
                            <hr>
                            <div class="aksi">
                                <div class="like">
                                    <button type="button" class="btn-sm btn-like" id="likeBtn">
                                        <form id="likes-form" method="post">
                                            <input type="hidden" class="photo-data" name="id_photo" value="">
                                            <input type="hidden" id="user-id" name="user_id" value="<?= $user_id; ?>">

                                        </form>
                                        <div class="icon-like">
                                            <i id="icon-like-status" class="bi bi-heart h5"></i>
                                        </div>
                                    </button>



                                    <div class="jumlah-like" id="total-like">

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
                                <div class="comment-output" id="comment-section">

                                </div>

                            </div>
                            <div class="input-comment">
                                <hr>
                                <div class="comment-profile">
                                    <img id="img-comment-profile" src="" alt="">
                                </div>
                                <div class="add-comment">
                                    <form method="post" id="add-comment-form">
                                        <?= csrf_field(); ?>
                                        <div class="form-group">
                                            <input type="hidden" class="photo-data" name="id_photo" value="">
                                            <input type="hidden" id="user-data" name="user_id" value="<?= $user_id; ?>">
                                            <input class="form-control" id="comment" name="comment" type="text"
                                                placeholder="Tambahkan komentar" value="">
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

<!-- ======= Hero Section ======= -->
<!-- <section id="hero" class="hero d-flex flex-column justify-content-center align-items-center" data-aos="fade"
data-aos-delay="1500" style="padding-bottom: 1px">
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-6 text-center">
<img src="assets/img/profile/<?= userProfileLogin()->photo_profile; ?>" alt="">
<div class="row">
<div class="d-flex d-inline justify-content-center align-items-center   ">
<h2><?= userLogin()->nama_lengkap; ?></h2>&nbsp;
<i class="bi fs-6 bi-pencil-fill icon-edit" style=""></i>
</div>
</div>
<div class="row">
<span class="username">@<?= userLogin()->username; ?></span>
</div>
<div class="row">
<span class="deskripsi-profile"><?= userProfileLogin()->describe_profile; ?></span>
</div>

</div>
</div>
</div>
</section> -->
<!-- End Hero Section -->

<div class="">
    <div class="profile">
        <div class="profile-avatar">
            <img src="assets/img/profile/<?= userProfileLogin()->photo_profile; ?>" alt="" class="profile-img">
            <div>
                <div class="d-flex align-items-center">
                    <div class="profile-name"><?= userLogin()->nama_lengkap; ?></div>
                    <div class="profile-username px-2">@<?= userLogin()->username; ?></div>
                </div>

                <div class="profile-desc"><?= userProfileLogin()->describe_profile; ?></div>
            </div>

        </div>
        <img src="assets/img/background-cover.jpg" alt="" class="profile-cover">
        <div class="profile-menu">
            <button type="button" data-user="<?= $user_id; ?>" class="btn btn-lg btn-edit-profile"
                id="edit-profile-btn">Edit Profile</button>
        </div>
    </div>
</div>

<!-- <div class="garis"></div> -->

<main id="main" data-aos="fade" data-aos-delay="1500">

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery-myprofile">
        <div class="container-fluid">

            <div class="galeri-main gy-4" id="galeri-profile-section">

            </div>

        </div>
    </section><!-- End Gallery Section -->

</main><!-- End #main -->

<?= $this->endSection(); ?>