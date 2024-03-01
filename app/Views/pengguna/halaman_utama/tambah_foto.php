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
                            Form Post Foto
                            <div class="float-end">
                                <a href="/" class="btn btn-warning btn-sm"><i class="bi bi-arrow-left-short"></i> Back</a>
                            </div>
                        </div>
                        <form action="/postFoto" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="card-body">
                                <div class="row no-gutters">
                                    <div class="col-md-6">
                                        <div>
                                            <img src="assets/img/defaultFoto.jpg" class="img-preview card-img" alt="gambar" height="100%">
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
                                                    <input type="file" class="form-control <?= (session('validation') && session('validation')->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" onchange="previewImg()" accept="image/*" value="<?= old('foto'); ?>">
                                                    <?php if (session('validation') && session('validation')->hasError('foto')) : ?>
                                                        <div id="foto" class="invalid-feedback">
                                                            <?= session('validation')->getError('foto'); ?>
                                                        </div>
                                                    <?php endif; ?>
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
                                                <textarea class="form-control <?= (session('validation') && session('validation')->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" id="deskripsi" name="deskripsi" cols="30" rows="10" placeholder="Masukkan deskripsi foto"><?= htmlspecialchars(old('deskripsi')); ?></textarea>
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
        </div>
    </section><!-- End Gallery Section -->

</main><!-- End #main -->

<?= $this->endSection(); ?>