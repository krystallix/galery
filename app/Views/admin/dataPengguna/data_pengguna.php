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
                        <li class="breadcrumb-item active">Data Pengguna</li>
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
                <div class="col-12">
                    <div class="form-group">
                        <a class="btn btn-primary" href="/admin/tambahPengguna"><i class="fas fa-plus"></i> Tambah Data Pengguna</a>
                    </div>
                    <?php if (session()->getFlashdata('pesan_insert')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('pesan_insert'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('pesan_delete')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('pesan_delete'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('pesan_edit')) : ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('pesan_edit'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Pengguna</h3>
                            <div class="card-tools">
                                <form action="" method="post" autocomplete="off">
                                    <div class="input-group input-group-sm col-12" style="width: 300px;">
                                        <?php $request = \Config\Services::request(); ?>
                                        <input type="text" name="keyword" value="<?= $request->getVar('keyword') ?>" class="form-control float-right" placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">NO</th>
                                        <th class="text-center" width="14%">USER ID</th>
                                        <th class="text-center" width="17%">USERNAME</th>
                                        <th class="text-center" width="23%">NAMA LENGKAP</th>
                                        <th class="text-center" width="21%">EMAIL</th>
                                        <th class="text-center" width="20%" colspan="4">AKSI</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if (empty($keyword)) {
                                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                    } else {
                                        $page = 1;
                                    }

                                    $no = 1 + (8 * ($page - 1));

                                    foreach ($pengguna as $p) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-left"><?= $p['user_id']; ?></td>
                                            <td class="text-center"><?= $p['username']; ?></td>
                                            <td class="text-left"><?= $p['nama_lengkap']; ?></td>
                                            <td class="text-left"><?= $p['email']; ?></td>
                                            <td class="text-center">
                                                <a href="/admin/login-history-pengguna/<?= $p['user_id']; ?>" class="btn btn-secondary btn-sm" title="Login History"><i class="bi bi-clock-history h6"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <a href="/admin/detailPengguna/<?= $p['user_id']; ?>" class="btn btn-info btn-sm" title="Detail"><i class="bi bi-zoom-in h6"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <a href="/admin/editPengguna/<?= $p['user_id']; ?>" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil-square h6"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <form action="/admin/deletePengguna/<?= $p['user_id']; ?>" method="post">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah yakin hapus?');"><i class="bi bi-trash3 h6"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="float-left" style="margin-top: 10px;">
                                <i>Showing <?= empty($pengguna) ? 0 : 1 + (8 * ($page - 1)); ?> to <?= $no - 1; ?> of <?= $pager->getTotal(); ?> entries</i>
                            </div>
                            <div class="float-right" style="margin-top: 10px;">
                                <?= $pager->links('default', 'pagination') ?>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection(); ?>