<?= $this->extend('layout/admin/header'); ?>

<?= $this->section('content'); ?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pengguna</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="/admin/pengguna">Pengguna</a></li>
                        <li class="breadcrumb-item active">Detail Data</li>
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
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Detail Data Pengguna</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="" class="table table-bordered table-hover">
                                <?php foreach ($pengguna as $p) { ?>
                                    <tr>
                                        <th width="40%">User ID</th>
                                        <td><?= $p->user_id; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Foto Profile</th>
                                        <td class="profile-detail-pengguna"><img src="<?php echo base_url('assets') ?>/img/profile/<?= $p->photo_profile; ?>" alt=""></td>
                                    </tr>
                                    <tr>
                                        <th>Username</th>
                                        <td><?= $p->username; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <td><?= $p->nama_lengkap; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi Profile</th>
                                        <td><?= $p->describe_profile; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?= $p->email; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Post</th>
                                        <?php foreach ($jumlahPost as $jp) { ?>
                                            <td><?= $jp; ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Komentar</th>
                                        <?php foreach ($jumlahComment as $jc) { ?>
                                            <td><?= $jc; ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Like</th>
                                        <?php foreach ($jumlahLike as $jl) { ?>
                                            <td><?= $jl; ?></td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <!-- /.card-body -->
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