<?= $this->extend('layout/pengguna/header'); ?>

<?= $this->section('content_pengguna'); ?>

<main id="main" data-aos="fade" data-aos-delay="1500">

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="tambah card">
                        <div class="card-header">
                            Form Edit Foto
                            <div class="float-end">
                                <a href="/my-profile" class="btn btn-warning btn-sm"><i class="bi bi-arrow-left-short"></i> Back</a>
                            </div>
                        </div>
                        <?php foreach ($edit_foto as $e) { ?>
                            <form action="/update/<?= $e->id_photo; ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="card-body">
                                    <div class="row no-gutters">
                                        <div class="col-md-6">
                                            <div>
                                                <img src="<?php echo base_url('assets') ?>/img/gallery/<?= $e->photo; ?>" class="img-preview card-img" alt="gambar" height="100%">
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
                                                        <input type="hidden" name="id_photo" value="<?= $e->id_photo; ?>">
                                                        <input type="file" class="form-control" id="foto" name="foto" onchange="previewImg()" accept="image/*" value="<?= (old('foto')) ? old('foto') : $e->photo; ?>">
                                                    </div>
                                                </div>
                                                <div class="judul form-group">
                                                    <label>Judul</label>
                                                    <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('judul_foto')) ? 'is-invalid' : ''; ?>" id="judul" name="judul_foto" placeholder="Masukkan judul foto" value="<?= (old('judul_foto')) ? old('judul_foto') : $e->judul_foto; ?>">
                                                    <?php if (session('validation') && session('validation')->hasError('judul_foto')) : ?>
                                                        <div id="judul" class="invalid-feedback">
                                                            <?= session('validation')->getError('judul_foto'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <?php
                                                $value = $e->describe_photo;
                                                ?>
                                                <div class="deskripsi form-group">
                                                    <label>Deskripsi</label>
                                                    <textarea class="form-control <?= (session('validation') && session('validation')->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" id="deskripsi" name="deskripsi" cols="30" rows="10" placeholder="Masukkan deskripsi foto"><?= htmlspecialchars((old('deskripsi')) ? old('deskripsi') : $e->describe_photo); ?></textarea>
                                                    <?php if (session('validation') && session('validation')->hasError('deskripsi')) : ?>
                                                        <div id="deskripsi" class="invalid-feedback">
                                                            <?= session('validation')->getError('deskripsi'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div>
                                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="card-footer text-body-secondary">
                                <button type="submit" class="btn btn-primary">Post</button>
                            </div> -->
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Gallery Section -->

</main><!-- End #main -->

<?= $this->endSection(); ?>