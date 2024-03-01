<?= $this->extend('layout/admin/header'); ?>

<?= $this->section('content'); ?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="/admin/profile">My Profile</a></li>
                        <li class="breadcrumb-item active">Edit Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="edit-profile-admin  card">
                        <div class="card-header">
                            Form Edit Profile
                            <div class="float-right">
                                <a href="/my-profile" class="btn btn-warning btn-sm"><i class="bi bi-arrow-left-short"></i> Back</a>
                            </div>
                        </div>
                        <!-- <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div> -->

                        <form action="/admin/update-profile/<?= $profile->user_id; ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="card-body">
                                <!-- <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a> -->

                                <div class="foto-profile form-group">
                                    <img src="<?php echo base_url('assets') ?>/img/profile/<?= $profile->photo_profile; ?>" class="img-preview card-img" alt="gambar" height="100%">
                                    <label for="foto">
                                        <div class="ganti-foto">
                                            <span aria-hidden="true" class="ganti">Ganti Foto</span>
                                        </div>
                                        <input type="file" id="foto" name="foto" style="display:none" onchange="previewImg()" accept="image/*">
                                    </label>
                                </div>
                                <div class="input-profile form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="hidden" name="user_id" value="<?= userLogin()->user_id; ?>">
                                    <input type="hidden" name="profile_id" value="<?= userProfileLogin()->profile_id; ?>">
                                    <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" id="namaLengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap" value="<?= (old('nama_lengkap')) ? old('nama_lengkap') : $user->nama_lengkap; ?>">
                                    <?php if (session('validation') && session('validation')->hasError('nama_lengkap')) : ?>
                                        <div id="namaLengkap" class="invalid-feedback">
                                            <?= session('validation')->getError('nama_lengkap'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="input-profile form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('username')) ? 'is-invalid' : ''; ?>" id="userName" name="username" placeholder="Masukkan username" value="<?= (old('username')) ? old('username') : $user->username; ?>">
                                    <?php if (session('validation') && session('validation')->hasError('username')) : ?>
                                        <div id="userName" class="invalid-feedback">
                                            <?= session('validation')->getError('username'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="input-profile form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control <?= (session('validation') && session('validation')->hasError('deskripsi_profile')) ? 'is-invalid' : ''; ?>" id="deskripsiProfile" name="deskripsi_profile" cols="30" rows="4" placeholder="Masukkan deskripsi profile"><?= htmlspecialchars((old('deskripsi_profile')) ? old('deskripsi_profile') : $profile->describe_profile); ?></textarea>
                                    <?php if (session('validation') && session('validation')->hasError('deskripsi_profile')) : ?>
                                        <div id="deskripsi_profile" class="invalid-feedback">
                                            <?= session('validation')->getError('deskripsi_profile'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="input-profile form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Masukkan email" value="<?= (old('email')) ? old('email') : $user->email; ?>">
                                    <?php if (session('validation') && session('validation')->hasError('email')) : ?>
                                        <div id="email" class="invalid-feedback">
                                            <?= session('validation')->getError('email'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="input-profile form-group">
                                    <label>Password</label>
                                    <div class="ganti-password" id="ganti-password">
                                        <span aria-hidden="true" class="ganti">Ganti Password</span>
                                    </div>
                                    <div class="batal-ganti" id="batal-ganti">
                                        <span aria-hidden="true" class="ganti">Batal</span>
                                    </div>
                                    <div class="input-password" style="margin-top: 8px;" id="input-password">
                                        <input type="hidden" value="<?= $password; ?>" id="password-lama">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
                                        <div class="icon-eye">
                                            <i class="bi bi-eye-slash h5" id="togglePassword"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection(); ?>