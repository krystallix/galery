<?= $this->extend('layout/admin/header'); ?>

<?= $this->section('content'); ?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Data Pengguna</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="/admin/pengguna">Pengguna</a></li>
                        <li class="breadcrumb-item active">Tambah Data Pengguna</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <!-- left column -->
                <div class="col-md-6 mx-auto">
                    <!-- general form elements -->
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Data Pengguna</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="/admin/savePengguna" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="card-body">
                                <!-- <div class="input-pengguna form-group">
                                    <label>User ID</label>
                                    <input type="text" class="form-control" id="userId" name="user_id" placeholder="Masukkan User ID pengguna" autofocus value="">
                                </div> -->
                                <div class="input-pengguna add-profile-pengguna form-group">
                                    <div>
                                        <label>Foto Profile</label>
                                    </div>
                                    <img src="<?php echo base_url('assets') ?>/img/defaultProfile.jpg" class="img-preview card-img" alt="gambar" height="100%">
                                    <label for="foto">
                                        <div class="ganti-foto">
                                            <span aria-hidden="true" class="ganti">Pilih Foto Profile</span>
                                        </div>
                                        <input type="file" id="foto" name="foto" style="display:none" onchange="previewImg()" accept="image/*">
                                    </label>
                                </div>
                                <div class="input-pengguna form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" placeholder="Masukkan username pengguna" value="<?= old('username'); ?>">
                                    <?php if (session('validation') && session('validation')->hasError('username')) : ?>
                                        <div id="username" class="invalid-feedback">
                                            <?= session('validation')->getError('username'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="input-pengguna form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap pengguna" value="<?= old('nama_lengkap'); ?>">
                                    <?php if (session('validation') && session('validation')->hasError('nama_lengkap')) : ?>
                                        <div id="nama_lengkap" class="invalid-feedback">
                                            <?= session('validation')->getError('nama_lengkap'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="input-pengguna form-group">
                                    <label>Deskripsi Profile</label>
                                    <textarea class="form-control <?= (session('validation') && session('validation')->hasError('desc_profile')) ? 'is-invalid' : ''; ?>" id="desc_profile" name="desc_profile" placeholder="Masukkan deskripsi profile pengguna" cols="30" rows="3"><?= htmlspecialchars(old('desc_profile')); ?></textarea>
                                    <?php if (session('validation') && session('validation')->hasError('desc_profile')) : ?>
                                        <div id="desc_profile" class="invalid-feedback">
                                            <?= session('validation')->getError('desc_profile'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="input-pengguna form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Masukkan email pengguna" value="<?= old('email'); ?>">
                                    <?php if (session('validation') && session('validation')->hasError('email')) : ?>
                                        <div id="email" class="invalid-feedback">
                                            <?= session('validation')->getError('email'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="input-pengguna form-group">
                                    <label>Password</label>
                                    <div class="password-show-hide">
                                        <input type="password" class="form-control <?= (session('validation') && session('validation')->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Masukkan password pengguna" value="<?= old('password'); ?>">
                                        <div class="icon-eye">
                                            <i class="bi bi-eye-slash h5" id="togglePassword"></i>
                                        </div>
                                        <?php if (session('validation') && session('validation')->hasError('password')) : ?>
                                            <div id="password" class="invalid-feedback">
                                                <?= session('validation')->getError('password'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="hidden" class="form-control" name="level" value="pengguna">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection(); ?>