<?= $this->extend('layout/admin/header'); ?>

<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Foto</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Detail Foto</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="col-12 col-sm-12">
                <?php if (session()->getFlashdata('pesan_delete')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_delete'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('pesan_insert')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_insert'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Foto</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Komentar</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Messages</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Settings</a>
                            </li> -->
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                <!-- Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur. -->
                                <!-- <img src="<?php echo base_url('assets') ?>/img/gallery/gallery-4.jpg" class="img-fluid" alt=""> -->
                                <?php foreach ($detail_foto as $d) : ?>
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="card card-widget" style="background-color: #343A40;">
                                                <div class="card-header">
                                                    <div class="user-block">
                                                        <img class="img-circle" src="<?php echo base_url('assets') ?>/img/profile/<?= $d->photo_profile; ?>" alt="User Image">
                                                        <span class="username"><a href="/admin/profileUser/<?= $d->user_id; ?>"><?= $d->username; ?></a></span>
                                                        <span class="description">Diposting pada <?= $d->time_upload; ?></span>
                                                    </div>

                                                    <div class="card-tools d-flex" style="gap: 5px;">
                                                        <form action="/delete-foto-pengguna/<?= $d->id_photo; ?>" method="post">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class="btn btn-danger" title="Hapus" onclick="return confirm('Apakah ingin hapus foto?');">
                                                                <i class="bi bi-trash3 h5"></i>
                                                            </button>
                                                        </form>
                                                        <!-- <button type="button" class="btn btn-secondary" title="Share">
                                                            <i class="bi bi-share-fill h5"></i>
                                                        </button> -->
                                                        <div>
                                                            <input type="hidden" value="<?= $uri; ?>" id="copyLink">
                                                            <button type="button" class="btn btn-secondary" title="Share" id="copyBtn">
                                                                <i class="bi bi-share-fill h5"></i>
                                                            </button>
                                                        </div>
                                                        <div class="copied" id="copied">
                                                            Link tersalin!
                                                        </div>
                                                        <!-- <button type="button" class="btn btn-tool" title="Mark as read">
                                                        <i class="far fa-circle"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                        <i class="fas fa-times"></i>
                                                    </button> -->
                                                    </div>

                                                </div>

                                                <div class="card-body">
                                                    <img class="img-fluid pad" src="<?php echo base_url('assets') ?>/img/gallery/<?= $d->photo; ?>" alt="Photo">
                                                    <p class="deskripsi-detail"><?= $d->judul_foto; ?></p>
                                                    <p class="deskripsi-detail"><?= $d->describe_photo; ?></p>
                                                    <!-- <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
                                                <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button> -->
                                                    <!-- <span class="float-right text-muted">127 likes - 3 comments</span> -->
                                                    <?php foreach ($jumlah_like as $l) { ?>
                                                        <?php foreach ($jumlah_comment as $j) { ?>
                                                            <span class="text-muted"><?= $l->user_id; ?> likes - <?= $j->comment; ?> komentar</span>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>

                                                <!-- <div class="card-footer card-comments">
                                                <div class="card-comment">

                                                    <img class="img-circle img-sm" src="../dist/img/user3-128x128.jpg" alt="User Image">
                                                    <div class="comment-text">
                                                        <span class="username">
                                                            Maria Gonzales
                                                            <span class="text-muted float-right">8:03 PM Today</span>
                                                        </span>
                                                        It is a long established fact that a reader will be distracted
                                                        by the readable content of a page when looking at its layout.
                                                    </div>

                                                </div>

                                                <div class="card-comment">

                                                    <img class="img-circle img-sm" src="../dist/img/user4-128x128.jpg" alt="User Image">
                                                    <div class="comment-text">
                                                        <span class="username">
                                                            Luna Stark
                                                            <span class="text-muted float-right">8:03 PM Today</span>
                                                        </span>
                                                        It is a long established fact that a reader will be distracted
                                                        by the readable content of a page when looking at its layout.
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="card-footer">
                                                <form action="#" method="post">
                                                    <img class="img-fluid img-circle img-sm" src="../dist/img/user4-128x128.jpg" alt="Alt Text">

                                                    <div class="img-push">
                                                        <input type="text" class="form-control form-control-sm" placeholder="Press enter to post comment">
                                                    </div>
                                                </form>
                                            </div> -->

                                            </div>

                                        </div>

                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                <!-- Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam. -->
                                <div class="card" style="background-color: #343A40;">
                                    <div class="card-header">
                                        <?php foreach ($jumlah_comment as $j) { ?>
                                            <?= $j->comment; ?> Komentar
                                        <?php } ?>
                                    </div>
                                    <div class="card-body">
                                        <!-- <h5 class="card-title">Special title treatment</h5>
                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                        <a href="#" class="btn btn-primary">Go somewhere</a> -->

                                        <div class="comment">
                                            <?php foreach ($comment as $c) { ?>
                                                <div class="comment-output">
                                                    <div class="profile-commentator">
                                                        <a href="/admin/profileUser">
                                                            <img src="<?php echo base_url('assets') ?>/img/profile/<?= $c->photo_profile; ?>" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="detail-comment">
                                                        <a href="/admin/profileUser">
                                                            <div class="username-commentator">
                                                                <?= $c->username; ?>
                                                            </div>
                                                        </a>
                                                        <div class="isi-comment">
                                                            <?= $c->comment; ?>
                                                        </div>
                                                    </div>
                                                    <div class="hapus-comment">
                                                        <form action="/delete-comment/<?= $c->id_photo; ?>/<?= $c->user_id; ?>" method="post">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class="btn btn-danger" title="Hapus" onclick="return confirm('Apakah ingin hapus komentar?');"><i class="bi bi-trash3 h4"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="comment-output">
                                                <div class="profile-commentator">
                                                    <a href="/admin/profileUser">
                                                        <img src="<?php echo base_url('assets') ?>/img/gallery/gallery-4.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="detail-comment">
                                                    <a href="/admin/profileUser">
                                                        <div class="username-commentator">
                                                            username
                                                        </div>
                                                    </a>
                                                    <div class="isi-comment">
                                                        This is a wider card.
                                                    </div>
                                                </div>
                                                <div class="hapus-comment">
                                                    <button type="button" class="btn btn-danger" title="Hapus"><i class="bi bi-trash3 h4"></i></button>
                                                </div>
                                            </div>
                                            <div class="comment-output">
                                                <div class="profile-commentator">
                                                    <a href="/admin/profileUser">
                                                        <img src="<?php echo base_url('assets') ?>/img/gallery/gallery-4.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="detail-comment">
                                                    <a href="/admin/profileUser">
                                                        <div class="username-commentator">
                                                            username
                                                        </div>
                                                    </a>
                                                    <div class="isi-comment">
                                                        This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                                                    </div>
                                                </div>
                                                <div class="hapus-comment">
                                                    <button type="button" class="btn btn-danger" title="Hapus"><i class="bi bi-trash3 h4"></i></button>
                                                </div>
                                            </div>
                                            <div class="comment-output">
                                                <div class="profile-commentator">
                                                    <a href="/admin/profileUser">
                                                        <img src="<?php echo base_url('assets') ?>/img/gallery/gallery-4.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="detail-comment">
                                                    <a href="/admin/profileUser">
                                                        <div class="username-commentator">
                                                            username
                                                        </div>
                                                    </a>
                                                    <div class="isi-comment">
                                                        This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                                                    </div>
                                                </div>
                                                <div class="hapus-comment">
                                                    <button type="button" class="btn btn-danger" title="Hapus"><i class="bi bi-trash3 h4"></i></button>
                                                </div>
                                            </div>
                                            <div class="comment-output">
                                                <div class="profile-commentator">
                                                    <a href="/admin/profileUser">
                                                        <img src="<?php echo base_url('assets') ?>/img/gallery/gallery-4.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="detail-comment">
                                                    <a href="/admin/profileUser">
                                                        <div class="username-commentator">
                                                            username
                                                        </div>
                                                    </a>
                                                    <div class="isi-comment">
                                                        This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                                                    </div>
                                                </div>
                                                <div class="hapus-comment">
                                                    <button type="button" class="btn btn-danger" title="Hapus"><i class="bi bi-trash3 h4"></i></button>
                                                </div>
                                            </div>
                                            <div class="comment-output">
                                                <div class="profile-commentator">
                                                    <a href="/admin/profileUser">
                                                        <img src="<?php echo base_url('assets') ?>/img/gallery/gallery-4.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="detail-comment">
                                                    <a href="/admin/profileUser">
                                                        <div class="username-commentator">
                                                            username
                                                        </div>
                                                    </a>
                                                    <div class="isi-comment">
                                                        This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.
                                                    </div>
                                                </div>
                                                <div class="hapus-comment">
                                                    <button type="button" class="btn btn-danger" title="Hapus"><i class="bi bi-trash3 h4"></i></button>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                                Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                                Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


</div><!--/. container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection(); ?>