<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>PhotoFolio</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
</footer><!-- End Footer -->

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<div id="preloader">
    <div class="line"></div>
</div>

<!-- Vendor JS Files -->
<script src="<?php echo base_url('assets') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url('assets') ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets') ?>/vendor/jquery/serializeObject.js"></script>
<script src="<?php echo base_url('assets') ?>/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?php echo base_url('assets') ?>/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?php echo base_url('assets') ?>/vendor/aos/aos.js"></script>
<script src="<?php echo base_url('assets') ?>/vendor/php-email-form/validate.js"></script>
<script src="<?php echo base_url('assets') ?>/vendor/snackbar/snackbar.min.js"></script>

<!-- Template Main JS File -->
<script src="<?php echo base_url('assets') ?>/js/main.js"></script>
<script src="<?php echo base_url('assets') ?>/js/getPhoto.js"></script>
<script src="<?php echo base_url('assets') ?>/js/function.js"></script>


<!--using sweetalert via CDN -->
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
<script>
    const copyBtn = document.getElementById('copyBtn')
    const copyLink = document.getElementById('copyLink')

    copyBtn.onclick = () => {
        copyLink.select(); // Selects the text inside the input
        document.execCommand('copy'); // Simply copies the selected text to clipboard 

        document.getElementById('copied').style.display = "flex";

        setTimeout(function() {
            document.getElementById('copied').style.display = "none";
        }, 1000);
        // Swal.fire({ //displays a pop up with sweetalert
        //     icon: 'success',
        //     title: 'Text copied to clipboard',
        //     showConfirmButton: false,
        //     timer: 1000
        // });
    }
</script>

<script>


</script>

</body>

</html>