<?= $this->extend('layout/admin/header'); ?>

<?= $this->section('content'); ?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Login History</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Traffic</li>
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

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Login History Pengguna</h3>
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
                                        <th class="text-center" width="5%" rowspan="2" style="vertical-align : middle;text-align:center;">NO</th>
                                        <th class="text-center" width="12%" rowspan="2" style="vertical-align : middle;text-align:center;">USER ID</th>
                                        <th class="text-center" width="15%" rowspan="2" style="vertical-align : middle;text-align:center;">USERNAME</th>
                                        <th class="text-center" width="22%" rowspan="2" style="vertical-align : middle;text-align:center;">NAMA LENGKAP</th>
                                        <th class="text-center" width="20%" rowspan="2" style="vertical-align : middle;text-align:center;">EMAIL</th>
                                        <th class="text-center" width="26%" colspan="2">LOGIN</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center" width="11%">TANGGAL</th>
                                        <th class="text-center" width="11%">WAKTU</th>
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

                                    foreach ($traffic as $t) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-left"><?= $t['user_id']; ?></td>
                                            <td class="text-center"><?= $t['username']; ?></td>
                                            <td class="text-left"><?= $t['nama_lengkap']; ?></td>
                                            <td class="text-left"><?= $t['email']; ?></td>
                                            <td class="text-center"><?= $t['tanggal']; ?></td>
                                            <td class="text-center"><?= $t['waktu']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="float-left" style="margin-top: 10px;">
                                <i>Showing <?= empty($traffic) ? 0 : 1 + (8 * ($page - 1)); ?> to <?= $no - 1; ?> of <?= $pager->getTotal(); ?> entries</i>
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