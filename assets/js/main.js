/*
::
:: Theme Name: Decision - Lawyer & Attorney HTML Template
:: Email: Nourramadan144@gmail.com
:: Author URI: https://themeforest.net/user/ar-coder
:: Author: ar-coder
:: Version: 1.0
:: 
*/

(function () {
    'use strict';

    // :: Loading
    $(window).on('load', function () {
        $('.loading').fadeOut();
    });

    // :: Height Header Section
    $('.header, .header .table-cell').height($(window).height() + $('header.navs').height() + 100);
    $('.header-2, .header-2 .table-cell').height($(window).height() + $('header.navs').height() + 40);

    // :: Add Class Active For ('.nav-bar')
    $(window).on('scroll', function () {
        if ($(window).scrollTop() > $('header.navs').height() + 30) {
            $('header.navs, .nav-bar').addClass('active');
        } else {
            $('header.navs, .nav-bar').removeClass('active');
        }
    });

    // :: Varables Navbar
    var headerBar = $('.nav-bar'),
        $navbarMenu = $('#open-nav-bar-menu'),
        $menuLink = $('.open-nav-bar'),
        $menuTriggerLink = $('.has-menu > a');

    // :: Add Class Active For $menuLink And $navbarMenu
    $menuLink.on('click', function (e) {
        e.preventDefault();
        $menuLink.toggleClass('active');
        $navbarMenu.toggleClass('active');
    });

    // :: Add Class Active For $menuTriggerLink
    $menuTriggerLink.on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        $this.toggleClass('active').next('ul').toggleClass('active');
    });

    // :: Scroll Smooth To Go Section
    $('.move-section').on('click', function (e) {
        e.preventDefault();
        var anchorLink = $(this);
        $('html, body').stop().animate({
            scrollTop: $(anchorLink.attr('href')).offset().top + 1
        }, 1000);
    });

    // :: Add Class Active To Search Box
    $('.open-search-box').on('click', function () {
        $('.search-box').fadeIn();
    });
    $('.search-box, .close-search').on('click', function () {
        $('.search-box').fadeOut();
    });
    $('.search-box form').on('click', function (e) {
        e.stopPropagation();
    });

    // :: Open And Close Menu
    $('.open-menu').on('click', function () {
        $('.menu-box').fadeIn().addClass('active');
    });
    $('.menu-box').on('click', function () {
        $(this).fadeOut().removeClass('active');
    });
    $('.exit-menu-box').on('click', function () {
        $('.menu-box').fadeOut().removeClass('active');
    });
    $('.menu-box .inner-menu').on('click', function (e) {
        e.stopPropagation();
    });

    // :: OWL Carousel Js Header Hero
    $('.header-owl').owlCarousel({
        loop: true,
        nav: true,
        margin: 0,
        autoplay: true,
        autoplayTimeout: 4000,
        smartSpeed: 1000,
        autoplayHoverPause: true,
        mouseDrag: true,
        touchDrag: true,
        navText: ['<i class="flaticon-left-arrow"></i>', '<i class="flaticon-right-arrow"></i>'],
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            991: {
                items: 1
            }
        }
    });

    // :: Animation Header
    $('.header-owl').on('translate.owl.carousel', function () {
        $('.header-owl .banner').removeClass('animated fadeOut').css('opacity', '0');
        $('.header .banner .headline-top').removeClass('animated fadeInUp').css('opacity', '0');
        $('.header .banner .handline').removeClass('animated fadeInUp').css('opacity', '0');
        $('.header .banner .about-website').removeClass('animated fadeInDown').css('opacity', '0');
        $('.header-hero.header-1 .head-info .buttons').removeClass('animated fadeInDown').css('opacity', '0');
    });
    $('.header-owl').on('translated.owl.carousel', function () {
        $('.header-owl .banner').removeClass('animated fadeIn').css('opacity', '1');
        $('.header .banner .headline-top').addClass('animated fadeInUp').css('opacity', '1');
        $('.header .banner .handline').addClass('animated fadeInUp').css('opacity', '1');
        $('.header .banner .about-website').addClass('animated fadeInDown').css('opacity', '1');
        $('.header .banner .btn-1').addClass('animated fadeInDown').css('opacity', '1');
    });

    // :: Owl Carousel Plugin
    $('.history-line').owlCarousel({
        loop: true,
        margin: 0,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 3
            },
            991: {
                items: 5
            }
        }
    });

    // :: OWL Carousel Js Case Study
    $('.owl-case-study').owlCarousel({
        loop: true,
        margin: 30,
        smartSpeed: 1000,
        autoplay: 2000,
        nav: true,
        autoplayHoverPause: true,
        mouseDrag: true,
        touchDrag: true,
        navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            991: {
                items: 3
            }
        }
    });

    // :: NiceSelect Plugin
    $('select').niceSelect();

    // :: OWL Carousel Js Sponsors Carousel
    $('.sponsors-box').owlCarousel({
        loop: true,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 4000,
        smartSpeed: 1000,
        margin: 30,
        autoplayHoverPause: true,
        mouseDrag: true,
        touchDrag: true,
        responsive: {
            0: {
                items: 2
            },
            575: {
                items: 3
            },
            768: {
                items: 4
            },
            991: {
                items: 6
            }
        }
    });

    // :: OWL Carousel Js Statistic
    $('.statistic-owl').owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        smartSpeed: 1500,
        margin: 0,
        autoplayHoverPause: true,
        mouseDrag: true,
        touchDrag: true,
        responsive: {
            0: {
                items: 1
            },
            991: {
                items: 1
            }
        }
    });

    // :: OWL Carousel Js Testimonial
    $('.owl-testimonial').owlCarousel({
        loop: true,
        nav: true,
        autoplay: true,
        center: true,
        autoplayTimeout: 4000,
        smartSpeed: 1000,
        autoplayHoverPause: true,
        URLhashListener: true,
        startPosition: 'URLHash',
        mouseDrag: true,
        touchDrag: true,
        navText: ['<i class="flaticon-left-arrow"></i>', '<i class="flaticon-right-arrow"></i>'],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            991: {
                items: 1
            }
        }
    });

    // :: OWL Carousel Js Testimonials Carousel
    $('.owl-testimonial-1').owlCarousel({
        loop: true,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 4000,
        smartSpeed: 1000,
        margin: 10,
        center: true,
        autoplayHoverPause: true,
        mouseDrag: true,
        touchDrag: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            991: {
                items: 1
            }
        }
    });
    $('.owl-testimonial-3').owlCarousel({
        loop: true,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 4000,
        smartSpeed: 1000,
        margin: 10,
        center: true,
        autoplayHoverPause: true,
        mouseDrag: true,
        touchDrag: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            991: {
                items: 3
            }
        }
    });

    // :: Add Class Active On Go To Header
    $(window).on('scroll', function () {
        if ($(window).scrollTop() > 400) {
            $('.scroll-up').addClass('active');
        } else {
            $('.scroll-up').removeClass('active');
        }
    });
    
    // :: Skills Data Value
    $(window).on('scroll', function () {
        $('.skills .skill-box .skill-line .line').each(function () {
            var toQuestionsAndSkills =
                $(this).offset().top + $(this).outerHeight();
            var goToBottom =
                $(window).scrollTop() + $(window).height();
            var widthValue = $(this).attr('data-value');
            if (goToBottom > toQuestionsAndSkills) {
                $(this).css({
                    width: widthValue,
                    transition: 'all 2s ease'
                });
            }
        });
    });

    // :: Counter Up Js
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });
    
    // :: Add Dark Mode
    $('.dark-mode-decision').on('click', function () {
        $('body').toggleClass('active-dark-mode-decision');
    });
    
}());

// :: Setup mouseenter On Case Study
$(document).ready(function () {
    $('.case-study-item').on('mouseenter', function (e) {
        x = e.pageX - $(this).offset().left,
            y = e.pageY - $(this).offset().top;
        $(this).find('span').css({
            top: y,
            left: x
        });
    });
    $('.case-study-item').on('mouseout', function (e) {
        x = e.pageX - $(this).offset().left,
            y = e.pageY - $(this).offset().top;
        $(this).find('span').css({
            top: y,
            left: x
        });
    });
});







$(document).ready(function() {
    $('.popupGallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'ajaxPopup',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
        },

    });
});
$(function() {
    $(".rslides").responsiveSlides();
});


function booking_sub_con() {
    if ((document.booking_form_con.name.value == "") || document.booking_form_con.name.value == "Name") {
        alert("Please Enter Your Name");
        document.booking_form_con.name.focus();
        return false;
    }

    if ((document.booking_form_con.emailid.value == "") || document.booking_form_con.emailid.value == "Email") {
        alert("Please Enter Email address ");
        document.booking_form_con.emailid.focus();
        return false;
    } else if (!(/^([a-zA-Z0-9\.\_\-\&]+)@[a-zA-Z0-9]+\.[a-zA-Z]{2,3}(\.[a-zA-Z]{2})?$/.test(document.booking_form_con.emailid.value))) {
        alert("This is not a valid Email address.");
        document.booking_form_con.emailid.focus();
        return false;
    }

    if ((document.booking_form_con.mobile.value == "")) {
        alert("Please Enter Your Mobile");
        document.booking_form_con.mobile.focus();
        return false;
    } else {
        if (/\D/g.test($('#mobile').val())) {
            alert('Please enter 10 digit mobile number');
            $('#mobile').focus();
            return false;
        } else {
            if (document.booking_form_con.mobile.value.length != 10) {
                alert('Please enter 10 digit mobile number');
                $('#mobile').focus();
                return false;
            }
        }
    }


    /*if((document.booking_form_con.city.value == "") || document.booking_form_con.city.value == "City")
    {
    alert("Please Enter Your City");
    document.booking_form_con.city.focus();
    return false;
    }*/

    if ((document.booking_form_con.usr_leasing.value == "") || document.booking_form_con.usr_leasing.value == "Project i am interested") {
        alert("Please select Your Project");
        document.booking_form_con.city.focus();
        return false;
    }

    $('.submit').val('Please wait..').attr('type', 'button');

    grecaptcha.ready(function() {
        // do request for recaptcha token
        // response is promise with passed token
        grecaptcha.execute('6LeA4KgUAAAAAAXh1Ny24zP0e5tAm5tDn_xnzFUe', {
            action: 'create_comment'
        }).then(function(token) {
            // add token to form
            $('#booking_form_con').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
            document.getElementById('booking_form_con').submit();

        });
    });


    return false;
}

function otp_sub_con() {
    if (document.booking_form_con.notp.value == "") {
        alert("Please enter OTP");
        document.booking_form_con.notp.focus();
        return false;
    }

}
$(".open-form").click(function() {
    $(".callback").show();
    $(".closeit").show();
    $(".open-form").hide();
});
$(".closeit").click(function() {
    $(".callback").hide();
    $(".open-form").show();
    $(".closeit").hide();
});
setTimeout(function() {
    $(".callBackForm").slideDown('slow');
}, 9000);


//OTP Form bottom right
$(".callBackForm .closeBtn").click(function() {
    $(".callBackForm").slideUp('easeInQuad', function() {
        $(".enquireNow").slideDown('easeInQuad');
    });
});
$(".img-responsive").click(function() {
    $(".enquireNow").slideUp('easeInQuad', function() {
        $(".callBackForm").slideDown('easeInQuad')
    });
});
$(".enquireNow").click(function() {
    $(".enquireNow").slideUp('easeInQuad', function() {
        $(".callBackForm").slideDown('easeInQuad')
    });
});
 
$("#callBackForm").submit(function() {

    if ($(this).isValid()) {
        $(this).addClass("d-none");
        $(".loader").removeClass("d-none");
        $.ajax({
            type: "POST",
            url: "sendmail.php",
            async: true,
            headers: {
                "cache-control": "no-cache"
            },
            data: $(this).serialize(),
            success: function(data) {
                gtag_form_conversion();
                $(".loader").addClass("d-none");
                $(".successMsg").removeClass("d-none").html(data);

            }
        });
    };
});

document.addEventListener("DOMContentLoaded", function() {
    var faqQuestions = document.getElementsByClassName("faq-question");
  
    for (var i = 0; i < faqQuestions.length; i++) {
      faqQuestions[i].addEventListener("click", function() {
        var answer = this.nextElementSibling;
  
        if (answer.style.display === "none") {
          answer.style.display = "block";
        } else {
          answer.style.display = "none";
        }
      });
    }
  });
  
// counter 

// Counter function
// Counter function
function counter(element, start, end, duration) {
    let current = start;
    const range = end - start;
    const increment = end > start ? 1 : -1;
    const stepTime = Math.abs(Math.floor(duration / range));
    let timer = null;
  
    timer = setInterval(() => {
      current += increment;
      element.innerText = current;
      if (current === end) {
        clearInterval(timer);
      }
    }, stepTime);
  }
  
  // Wait for DOM content to load completely
  document.addEventListener("DOMContentLoaded", () => {
    // Find all elements with the 'counter' class
    const counterElements = document.querySelectorAll('.counter');
  
    // Iterate over each counter element
    counterElements.forEach((counterElement) => {
      const start = parseInt(counterElement.dataset.start);
      const end = counterElement.dataset.end; // Store the original end value
      const duration = parseInt(counterElement.dataset.duration);
  
      if (end.toLowerCase() === 'infinity') { // Handle special value 'infinity'
        counterElement.innerText = end;
      } else if (end.toLowerCase() === '-infinity') { // Handle special value '-infinity'
        counterElement.innerText = end;
      } else if (end.toLowerCase() === 'nan') { // Handle special value 'nan'
        counterElement.innerText = end;
      } else {
        const parsedEnd = parseFloat(end); // Use parseFloat for numeric values
        if (!isNaN(parsedEnd)) { // Proceed with the counter only if the end value is a valid number
          counter(counterElement, start, parsedEnd, duration);
  
          // Update end value if it changes in the HTML
          const observer = new MutationObserver((mutationsList) => {
            for (let mutation of mutationsList) {
              if (mutation.attributeName === 'data-end') {
                const updatedEnd = counterElement.dataset.end;
                const parsedUpdatedEnd = parseFloat(updatedEnd);
                if (!isNaN(parsedUpdatedEnd)) { // Proceed with the counter only if the updated end value is a valid number
                  counter(counterElement, start, parsedUpdatedEnd, duration);
                }
                break;
              }
            }
          });
          observer.observe(counterElement, { attributes: true });
        } else {
          counterElement.innerText = end; // Display the original end value if it cannot be parsed
        }
      }
    });
  });
  



//   team 

 