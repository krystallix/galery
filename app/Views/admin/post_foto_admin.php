<?= $this->extend('layout/admin/header'); ?>

<?= $this->section('content'); ?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Post Foto</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Post Foto</li>
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
                <div class="col-md-6">
                    <div class="tambah_foto_admin card">
                        <div class="card-header">
                            Form Post Foto
                        </div>
                        <form action="/admin/saveFoto" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="card-body">
                                <div class="row no-gutters">
                                    <div class="col-md-6">
                                        <div class="preview-foto">
                                            <img src="<?php echo base_url('assets') ?>/img/defaultFoto.jpg" class="img-preview card-img" alt="gambar" height="100%">
                                        </div>
                                        <!-- <div>
                                            <input type="file" class="form-control">
                                        </div> -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <div class="foto form-group">
                                                <label>Foto</label>
                                                <div>
                                                    <input type="file" class="form-control" id="foto" name="foto" onchange="previewImg()" accept="image/*" style="height:100%;">
                                                </div>
                                            </div>
                                            <div class="judul form-group">
                                                <label>Judul</label>
                                                <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('judul_foto')) ? 'is-invalid' : ''; ?>" id="judul" name="judul_foto" placeholder="Masukkan judul foto" value="<?= old('judul_foto'); ?>">
                                                <?php if (session('validation') && session('validation')->hasError('judul_foto')) : ?>
                                                    <div id="judul" class="invalid-feedback">
                                                        <?= session('validation')->getError('judul_foto'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="deskripsi form-group">
                                                <label>Deskripsi</label>
                                                <textarea class="form-control <?= (session('validation') && session('validation')->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" id="deskripsi" name="deskripsi" cols="30" rows="6" placeholder="Masukkan deskripsi foto"><?= htmlspecialchars(old('deskripsi')); ?></textarea>
                                                <?php if (session('validation') && session('validation')->hasError('deskripsi')) : ?>
                                                    <div id="deskripsi" class="invalid-feedback">
                                                        <?= session('validation')->getError('deskripsi'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary">Post</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="card-footer text-body-secondary">
                                <button type="submit" class="btn btn-primary">Post</button>
                            </div> -->
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