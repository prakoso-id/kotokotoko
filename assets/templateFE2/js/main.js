/*  ---------------------------------------------------
    Template Name: Male Fashion
    Description: Male Fashion - ecommerce teplate
    Author: Colorib
    Author URI: https://www.colorib.com/
    Version: 1.0
    Created: Colorib
---------------------------------------------------------  */

'use strict';

(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");

        /*------------------
            Gallery filter
        --------------------*/
        $('.filter__controls li').on('click', function () {
            $('.filter__controls li').removeClass('active');
            $(this).addClass('active');
        });
        if ($('.product__filter').length > 0) {
            var containerEl = document.querySelector('.product__filter');
            var mixer = mixitup(containerEl);
        }
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    //Search Switch
    $('.search-switch').on('click', function () {
        $('.search-model').fadeIn(400);
    });

    $('.search-close-switch').on('click', function () {
        $('.search-model').fadeOut(400, function () {
            $('#search-input').val('');
        });
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*------------------
        Accordin Active
    --------------------*/
    $('.collapse').on('shown.bs.collapse', function () {
        $(this).prev().addClass('active');
    });

    $('.collapse').on('hidden.bs.collapse', function () {
        $(this).prev().removeClass('active');
    });

    //Canvas Menu
    $(".canvas__open").on('click', function () {
        $(".offcanvas-menu-wrapper").addClass("active");
        $(".offcanvas-menu-overlay").addClass("active");
    });

    $(".offcanvas-menu-overlay").on('click', function () {
        $(".offcanvas-menu-wrapper").removeClass("active");
        $(".offcanvas-menu-overlay").removeClass("active");
    });

    /*-----------------------
        Hero Slider
    ------------------------*/

    $('.js-click-product').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.js-product-slider',
        dots: false,
        focusOnSelect: true,
        infinite: true,
        arrows: false,
        vertical: true,
        responsive: [

            {
                breakpoint: 1367,
                settings: {
                    vertical: false
                }
            }
        ]
    });
    $('.js-product-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        asNavFor: '.js-click-product'
    });
    $(".hero__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<span class='arrow_left'><span/>", "<span class='arrow_right'><span/>"],
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: false
    });

    // owl category
    $('.js-owl-cate').owlCarousel({
        margin: 30,
        autoplay: false,
        autoplayTimeout: 3000,
        loop: true,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'></span>", "<span class='fa fa-angle-right'></span>"],
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 2
            },
            1024: {
                items: 3,

            },
            1200: {
                items: 4,
                nav: false,
                dots:true
            },
            1600: {
                items: 4,
                margin: 40,
                nav: false,
                dots:true
            }
        }
    });
    $('.js-owl-team').owlCarousel({
        margin: 30,
        autoplay: false,
        autoplayTimeout: 3000,
        loop: true,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'></span>", "<span class='fa fa-angle-right'></span>"],
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 2
            },
            1024: {
                items: 3
            },
            1200: {
                items: 4,
                margin: 40
            }
        }
    });
    $('.js-owl-cate2').owlCarousel({
        margin: 30,
        autoplay: false,
        autoplayTimeout: 3000,
        loop: true,
        dots: true,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 2
            },
            1024: {
                items: 3
            },
            1200: {
                items: 3
            },
            1600: {
                items: 3,
                margin: 40
            }
        }
    });


    // owl brand
    $('.js-owl-brand').owlCarousel({
        margin: 30,
        autoplay: false,
        autoplayTimeout: 3000,
        loop: true,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'></span>", "<span class='fa fa-angle-right'></span>"],
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 3
            },
            1024: {
                items: 5
            },
            1200: {
                items: 7
            }
        }
    });
    $('.js-owl-brand2').owlCarousel({
        margin: 30,
        autoplay: false,
        autoplayTimeout: 3000,
        loop: true,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'></span>", "<span class='fa fa-angle-right'></span>"],
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 3
            },
            1024: {
                items: 4
            },
            1200: {
                items: 6
            }
        }
    });
    $(".js-owl-brand2 .owl-nav > div").on("click", function() {
        $(this).addClass('active').siblings().removeClass('active');
    });
    // product carousel
    $('.js-owl-product').owlCarousel({
        margin: 30,
        autoplay: true,
        autoplayTimeout: 3000,
        loop: true,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'></span>", "<span class='fa fa-angle-right'></span>"],
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 2
            },
            1024: {
                items: 2
            },
            1200: {
                items: 3
            }
        }
    });
    $('.js-owl-product2').owlCarousel({

        margin: 30,
        autoplay: false,
        autoplayTimeout: 3000,
        loop: true,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'></span>", "<span class='fa fa-angle-right'></span>"],
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 2
            },
            1200: {
                items: 3
            },
            1600: {
                items: 3,
                margin: 40
            }
        }
    });
    $(".js-owl-product2 .owl-nav > div").on("click", function() {
        $(this).addClass('active').siblings().removeClass('active');
    });
    $('.js-owl-blog').owlCarousel({

        margin: 30,
        autoplay: false,
        autoplayTimeout: 3000,
        loop: true,
        dots: true,
        nav: true,
        navText: ["<span class='fa fa-angle-left'></span>", "<span class='fa fa-angle-right'></span>"],
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 2
            },
            1200: {
                items: 3
            },
            1600: {
                items: 3,
                margin: 40
            }
        }
    });
    $(".js-owl-blog .owl-nav > div").on("click", function() {
        $(this).addClass('active').siblings().removeClass('active');
    });
    $(".js-quickview-slide  .slick-arrow").on("click", function() {
        $(this).addClass('active');
    });
    $('.js-owl-post').owlCarousel({
        nav: true,
        navText: ["<span class='fa fa-angle-left'></span>", "<span class='fa fa-angle-right'></span>"],
        items: 1,
        dots: false
    });
    $('.js-owl-quote').owlCarousel({
        nav: false,
        items: 1,
        dots: true,
        singleItem: true,
    });
    $('.js-oneitem').owlCarousel({
        nav: false,
        items: 1,
        dots: true,
        singleItem: true,
    });
    $('.js-oneitem2').owlCarousel({
        nav: false,
        items: 1,
        singleItem: true,
        dots         : true,
    });
    // Instagram carousel
    $('.js-owl-instagram').owlCarousel({
        margin: 0,
        autoplay: true,
        autoplayTimeout: 3000,
        loop: true,
        nav: false,
        navText: ["", ""],
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 2
            },
            1000: {
                items: 5
            }
        }
    });

    $('.js-multiple-row2').slick({
        dots: true,
        arrows: false,
        slidesPerRow: 4,
        rows: 2,
        responsive: [{
                breakpoint: 1025,
                settings: {
                    slidesPerRow: 3,
                }
            },
            {
                breakpoint: 813,
                settings: {
                    slidesPerRow: 2,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: true,
                    prevArrow: '<span class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
                    nextArrow: '<span class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></span>',
                    infinite: true,
                    dots: false,
                    slidesPerRow: 1,
                    rows: 1,
                }
            }
        ]
    });

    $('.js-multiple-row').slick({
        dots: true,
        arrows: false,
        slidesPerRow: 3,
        rows: 2,
        responsive: [{
                breakpoint: 1025,
                settings: {
                    slidesPerRow: 3,
                }
            },
            {
                breakpoint: 813,
                settings: {
                    slidesPerRow: 2,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: true,
                    prevArrow: '<span class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
                    nextArrow: '<span class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></span>',
                    infinite: true,
                    dots: false,
                    slidesPerRow: 1,
                    rows: 1,
                }
            }
        ]
    });
    $('.js-multiple-row3').slick({
        dots: true,
        arrows: false,
        slidesPerRow: 2,
        rows: 2,
        responsive: [{
                breakpoint: 1025,
                settings: {
                    slidesPerRow: 2,
                }
            },
            {
                breakpoint: 813,
                settings: {
                    slidesPerRow: 1,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: true,
                    prevArrow: '<span class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
                    nextArrow: '<span class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></span>',
                    infinite: true,
                    dots: false,
                    slidesPerRow: 1,
                    rows: 1,
                }
            }
        ]
    });

    /*--------------------------
        Select
    ----------------------------*/
    // $("select").niceSelect();

    /*-------------------
		Radio Btn
	--------------------- */
    $(".product__color__select label, .shop__sidebar__size label, .product__details__option__size label").on('click', function () {
        $(".product__color__select label, .shop__sidebar__size label, .product__details__option__size label").removeClass('active');
        $(this).addClass('active');
    });

    /*-------------------
		Scroll
	--------------------- */
    $(".nice-scroll").niceScroll({
        cursorcolor: "#0d0d0d",
        cursorwidth: "5px",
        background: "#e5e5e5",
        cursorborder: "",
        autohidemode: true,
        horizrailenabled: false
    });

    /*------------------
        CountDown
    --------------------*/
    // For demo preview start
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    if(mm == 12) {
        mm = '01';
        yyyy = yyyy + 1;
    } else {
        mm = parseInt(mm) + 1;
        mm = String(mm).padStart(2, '0');
    }
    var timerdate = mm + '/' + dd + '/' + yyyy;
    // For demo preview end


    // Uncomment below and use your date //

    /* var timerdate = "2020/12/30" */

    $("#countdown").countdown(timerdate, function (event) {
        $(this).html(event.strftime("<div class='cd-item'><span>%D</span> <p>Days</p> </div>" + "<div class='cd-item'><span>%H</span> <p>Hours</p> </div>" + "<div class='cd-item'><span>%M</span> <p>Minutes</p> </div>" + "<div class='cd-item'><span>%S</span> <p>Seconds</p> </div>"));
    });

    /*------------------
		Magnific
	--------------------*/
    $('.video-popup').magnificPopup({
        type: 'iframe'
    });

    /*-------------------
		Quantity change
	--------------------- */
    var proQty = $('.pro-qty');
    proQty.prepend('<span class="fa fa-angle-up dec qtybtn"></span>');
    proQty.append('<span class="fa fa-angle-down inc qtybtn"></span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });

    var proQty = $('.pro-qty-2');
    proQty.prepend('<span class="fa fa-angle-left dec qtybtn"></span>');
    proQty.append('<span class="fa fa-angle-right inc qtybtn"></span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });

    /*------------------
        Achieve Counter
    --------------------*/
    $('.cn_num').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 4000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });

})(jQuery);