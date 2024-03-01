<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/dist/css/adminlte.min.css?v=3.2.0">

    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <link href="<?php echo base_url('assets') ?>/css/regis.css" rel="stylesheet">
    <script nonce="5face979-d35a-4953-ba92-3b03fb6ae77f">
        try {
            (function(w, d) {
                ! function(j, k, l, m) {
                    j[l] = j[l] || {};
                    j[l].executed = [];
                    j.zaraz = {
                        deferred: [],
                        listeners: []
                    };
                    j.zaraz.q = [];
                    j.zaraz._f = function(n) {
                        return async function() {
                            var o = Array.prototype.slice.call(arguments);
                            j.zaraz.q.push({
                                m: n,
                                a: o
                            })
                        }
                    };
                    for (const p of ["track", "set", "debug"]) j.zaraz[p] = j.zaraz._f(p);
                    j.zaraz.init = () => {
                        var q = k.getElementsByTagName(m)[0],
                            r = k.createElement(m),
                            s = k.getElementsByTagName("title")[0];
                        s && (j[l].t = k.getElementsByTagName("title")[0].text);
                        j[l].x = Math.random();
                        j[l].w = j.screen.width;
                        j[l].h = j.screen.height;
                        j[l].j = j.innerHeight;
                        j[l].e = j.innerWidth;
                        j[l].l = j.location.href;
                        j[l].r = k.referrer;
                        j[l].k = j.screen.colorDepth;
                        j[l].n = k.characterSet;
                        j[l].o = (new Date).getTimezoneOffset();
                        if (j.dataLayer)
                            for (const w of Object.entries(Object.entries(dataLayer).reduce(((x, y) => ({
                                    ...x[1],
                                    ...y[1]
                                })), {}))) zaraz.set(w[0], w[1], {
                                scope: "page"
                            });
                        j[l].q = [];
                        for (; j.zaraz.q.length;) {
                            const z = j.zaraz.q.shift();
                            j[l].q.push(z)
                        }
                        r.defer = !0;
                        for (const A of [localStorage, sessionStorage]) Object.keys(A || {}).filter((C => C.startsWith("_zaraz_"))).forEach((B => {
                            try {
                                j[l]["z_" + B.slice(7)] = JSON.parse(A.getItem(B))
                            } catch {
                                j[l]["z_" + B.slice(7)] = A.getItem(B)
                            }
                        }));
                        r.referrerPolicy = "origin";
                        r.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(j[l])));
                        q.parentNode.insertBefore(r, q)
                    };
                    ["complete", "interactive"].includes(k.readyState) ? zaraz.init() : j.addEventListener("DOMContentLoaded", zaraz.init)
                }(w, d, "zarazData", "script");
            })(window, document)
        } catch (e) {
            throw fetch("/cdn-cgi/zaraz/t"), e;
        };
    </script>
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Registrasi</p>
                <form action="/registrasiProses" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="input-group mb-3 profile">
                        <img src="<?php echo base_url('assets') ?>/img/defaultProfile.jpg" class="img-preview card-img" alt="gambar" height="100%">
                        <label for="foto">
                            <div class="ganti-foto">
                                <span aria-hidden="true" class="ganti">Pilih Foto Profile</span>
                            </div>
                            <input type="file" id="foto" name="foto" style="display:none" onchange="previewImg()" accept="image/*">
                        </label>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" placeholder="Username" autofocus value="<?= old('username'); ?>">
                        <?php if (session('validation') && session('validation')->hasError('username')) : ?>
                            <div id="username" class="invalid-feedback">
                                <?= session('validation')->getError('username'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" value="<?= old('nama_lengkap'); ?>">
                        <?php if (session('validation') && session('validation')->hasError('nama_lengkap')) : ?>
                            <div id="nama_lengkap" class="invalid-feedback">
                                <?= session('validation')->getError('nama_lengkap'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <textarea name="desc_profile" id="desc_profile" class="form-control <?= (session('validation') && session('validation')->hasError('desc_profile')) ? 'is-invalid' : ''; ?>" id="desc_profile" name="desc_profile" placeholder="Deskripsi Profile" cols="30" rows="4"><?= htmlspecialchars(old('desc_profile')); ?></textarea>
                        <?php if (session('validation') && session('validation')->hasError('desc_profile')) : ?>
                            <div id="desc_profile" class="invalid-feedback">
                                <?= session('validation')->getError('desc_profile'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control <?= (session('validation') && session('validation')->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Email" value="<?= old('email'); ?>">
                        <?php if (session('validation') && session('validation')->hasError('email')) : ?>
                            <div id="email" class="invalid-feedback">
                                <?= session('validation')->getError('email'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="input-password mb-3">
                        <input type="password" class="form-control <?= (session('validation') && session('validation')->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password" value="<?= old('password'); ?>">
                        <?php if (session('validation') && session('validation')->hasError('password')) : ?>
                            <div id="password" class="invalid-feedback">
                                <?= session('validation')->getError('password'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="icon-eye">
                            <i class="bi bi-eye-slash h5" id="togglePassword"></i>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="level" value="pengguna">
                    </div>
                    <!-- <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div> -->
                    <div class="row">
                        <!-- <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div> -->

                        <div class="col-12 mx-auto">
                            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                        </div>

                    </div>
                </form>
                <!-- <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i>
                        Sign up using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i>
                        Sign up using Google+
                    </a>
                </div> -->
                <div class="mt-2">
                    <a href="/login" class="text-center">Saya sudah punya akun</a>
                </div>
            </div>

        </div>
    </div>

    <script>
        function previewImg() {
            const foto = document.querySelector('#foto');
            const imgPreview = document.querySelector('.img-preview');

            const fileFoto = new FileReader();
            fileFoto.readAsDataURL(foto.files[0]);

            fileFoto.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener("click", function() {
            //toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            //toggle the icon
            this.classList.toggle("bi-eye");
        });
    </script>

    <script src="<?php echo base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>

    <script src="<?php echo base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?php echo base_url('assets') ?>/dist/js/adminlte.min.js?v=3.2.0"></script>
</body>

</html>