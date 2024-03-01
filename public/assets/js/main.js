$(document).ready(function(){
  var base_url = window.location.origin;

  var userId = $("#user-data").val();
  data = { "user_id": userId }
  $.ajax({
    url: "/getCurrentUser",
    type: "post",
    data: data,
    success: function(response) {
      $(".comment-profile img").attr("src", base_url + `/assets/img/profile/${response.data[0].photo_profile}`)
    }
  });
});

$(document).ready(function() {
  // Preloader
  const preloader = $('#preloader');
  if (preloader.length) {
    window.addEventListener('load', function () {
      setTimeout(function () {
        preloader.addClass('loaded');
      }, 1000);
      setTimeout(function () {
        preloader.remove();
      }, 2000);
    });
  }

  // Mobile nav toggle
  const mobileNavShow = $('.mobile-nav-show');
  const mobileNavHide = $('.mobile-nav-hide');

  $('.mobile-nav-toggle').on('click', function (event) {
    event.preventDefault();
    mobileNavToogle();
  });

  function mobileNavToogle() {
    $('body').toggleClass('mobile-nav-active');
    mobileNavShow.toggleClass('d-none');
    mobileNavHide.toggleClass('d-none');
  }

  // Hide mobile nav on same-page/hash links
  $('#navbar a').each(function() {
    if (!this.hash) return;
    let section = $(this.hash);
    if (!section.length) return;

    $(this).on('click', function () {
      if ($('.mobile-nav-active').length) {
        mobileNavToogle();
      }
    });
  });

  // Toggle mobile nav dropdowns
  const navDropdowns = $('.navbar .dropdown > a');

  navDropdowns.each(function () {
    $(this).on('click', function (event) {
      if ($('.mobile-nav-active').length) {
        event.preventDefault();
        $(this).toggleClass('active');
        $(this).next().toggleClass('dropdown-active');

        let dropDownIndicator = $(this).find('.dropdown-indicator');
        dropDownIndicator.toggleClass('bi-chevron-up bi-chevron-down');
      }
    });
  });

  // Scroll top button
  const scrollTop = $('.scroll-top');
  if (scrollTop.length) {
    const toggleScrollTop = function () {
      window.scrollY > 100 ? scrollTop.addClass('active') : scrollTop.removeClass('active');
    }
    window.addEventListener('load', toggleScrollTop);
    $(document).on('scroll', toggleScrollTop);
    scrollTop.on('click', function () {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }

  // Initiate glightbox
  const glightbox = GLightbox({
    selector: '.glightbox'
  });

  // Init swiper slider with 1 slide at once in desktop view
  new Swiper('.slides-1', {
    speed: 600,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false
    },
    slidesPerView: 'auto',
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    }
  });

  // Init swiper slider with 3 slides at once in desktop view
  new Swiper('.slides-3', {
    speed: 600,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false
    },
    slidesPerView: 'auto',
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 40
      },
      1200: {
        slidesPerView: 3,
      }
    }
  });

  // Animation on scroll function and init
  function aos_init() {
    AOS.init({
      duration: 1000,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
  }
  window.addEventListener('load', function () {
    aos_init();
  });
});

/*------------------------------
# TAMBAH FOTO === PREVIEW IMG SEBELUM UPLOAD
------------------------------*/
function previewImg() {
  const foto = $('#foto')[0];
  const imgPreview = $('.img-preview')[0];

  const fileFoto = new FileReader();
  fileFoto.readAsDataURL(foto.files[0]);

  fileFoto.onload = function (e) {
    imgPreview.src = e.target.result;
  }
}

/*------------------------------
# PROFILE ADMIN
------------------------------*/
const profile = $('.header .my-profile');
const imgProfile = profile.find('img');
const dropdownProfile = profile.find('.profile-option');

imgProfile.on('click', function () {
  dropdownProfile.toggleClass('show');
});

$(window).on('click', function (e) {
  if (e.target !== imgProfile[0]) {
    if (e.target !== dropdownProfile[0]) {
      if (dropdownProfile.hasClass('show')) {
        dropdownProfile.removeClass('show');
      }
    }
  }
});

/*------------------------------
# SHOW HIDE PASSWORD
------------------------------*/
const togglePassword = $('#togglePassword');
const password = $('#password');

togglePassword.on("click", function () {
  const type = password.attr("type") === "password" ? "text" : "password";
  password.attr("type", type);
  $(this).toggleClass("bi-eye");
});

/*------------------------------
# GANTI PASSWORD
------------------------------*/
const gantiPassword = $('#ganti-password');
const inputPassword = $('#input-password');
const batalGanti = $('#batal-ganti');

gantiPassword.on('click', function () {
  inputPassword.css('display', 'flex');
  batalGanti.css('display', 'flex');
  batalGanti.css('justify-content', 'center');
});

batalGanti.on('click', function () {
  inputPassword.css('display', 'none');
  batalGanti.css('display', 'none');
  batalGanti.css('justify-content', 'center');
});
