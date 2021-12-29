//toggle dark mode
$(document).ready(function() {
    $(document).on('click', '.toggle-dark-mode', function() {
        $('.toggle-dark-mode').toggleClass('active-mode');
        $('body').toggleClass('dark_theme_body');
        $('.header-section').toggleClass('header-section-dark');

        if ($('.toggle-dark-mode').hasClass('active-mode')) {
            $('body').addClass('dark_theme_body');
            localStorage.setItem("mode", "dark");
            $('.header-section').addClass('header-section-dark');
        } else {
            localStorage.setItem("mode", "light");
            $('body').removeClass('dark_theme_body');
            $('.header-section').removeClass('header-section-dark');
        }

    });

    if (localStorage.mode == "dark") {
        $("body").addClass('dark_theme_body');
        $(".toggle-dark-mode").addClass('active-mode')
        $('.header-section').addClass('header-section-dark');
    };

});
// sidebar menu toggle

$(document).on('click', '#sidebar_toggler', function() {
    $('#sidebar_toggler').hide();
    $('.sidebar-wrapper').addClass('sidebar-show');
    $('.mob-overlay').addClass('active');
    $('body').addClass('overflow_hidden');
});

$(document).on('click', '#burgerBtn', function() {
    $('.sidebar-wrapper').removeClass('sidebar-show');
    $('.mob-overlay').removeClass('active');
    $('#sidebar_toggler').show();
    $('body').removeClass('overflow_hidden');
});

$(document).on('click', '.mob-overlay', function() {
    if ($(window).width() < 993) {
        $('#sidebar_toggler').show();
    }
    $('.sidebar-wrapper').removeClass('sidebar-show');
    $('.mob-overlay').removeClass('active');
    $('body').removeClass('overflow_hidden');
    $('.cart_sidebar').removeClass('cart_sidebar_show');
});



$(document).on('click', '.has_sub_menu', function(e) {
    e.preventDefault();
    $(this).siblings('.sub_menu').addClass('active_sub_menu');
});

$(document).on('click', '.back_btn', function(e) {
    e.preventDefault();
    $(this).closest('.sub_menu').removeClass('active_sub_menu');
});


// loader

$(function() {
    var animation = bodymovin.loadAnimation({
        container: document.getElementById('car-loading'),
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: 'car-1.json'
    });

    $('.loader-container').fadeOut();
})


// header section

$(function() {

    var is_rtl = $("html[lang='ar']").length > 0;

    $('.one_item_carousel').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        rtl: is_rtl,
        dots: false,
        arrows: true,
        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-arrow-left"></i></button>',
        prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-arrow-right"></i></button>',
        loop: true,
        autoplay: true,
        autoplaySpeed: 4000
    });
});

// services section

$(function() {

    var is_rtl = $("html[lang='ar']").length > 0;

    $('.three_items_carousel').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        rtl: is_rtl,
        dots: false,
        arrows: true,
        loop: true,
        autoplay: true,
        autoplaySpeed: 4000,
        responsive: [{

            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
                infinite: true
            }

        }, {

            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                dots: true
            }

        }, {

            breakpoint: 400,
            settings: {
                slidesToShow: 1,
                dots: true
            }

        }]
    });
});

//partners section
$(function() {

    var is_rtl = $("html[lang='ar']").length > 0;

    $('.five_items_carousel').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-left"></i></button>',
        prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-right"></i></button>',
        rtl: is_rtl,
        dots: false,
        arrows: true,
        loop: true,
        autoplay: true,
        autoplaySpeed: 4000,
        responsive: [{

            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
                infinite: true
            }

        }, {

            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                dots: true
            }

        }, {

            breakpoint: 576,
            settings: {
                slidesToShow: 1,
                dots: true
            }

        }]
    });
});

// scroll top button
$(function() {

    var scrollButton = $('.go-top');

    $(window).scroll(function() {

        if ($(window).scrollTop() >= 500) {
            scrollButton.show();
        } else {
            scrollButton.hide();
        }
    });

    scrollButton.click(function() {
        $('html, body').animate({ scrollTop: 0 });
    })
});

// toggle call us section

$(document).on('click', '.toggle-call-list', function() {
    $('.toggle-call-list .fa').toggleClass('fa-commenting-o').toggleClass('fa-times').css('transform', 'rotate(360deg)');
    $('.call-list').fadeToggle();
});

//footer links collapse

if ($(window).width() < 992) {
    $(document).on('click', '.footer-title', function() {
        $(this).siblings('ul.menu').slideToggle();
        $(this).children('.fa').toggleClass('rotate_180');
        $(this).parents().siblings().children('ul.menu').slideUp();
    });

    $(document).on('focus', '.form-control', function() {
        $('.bottom-nav').css('display', 'none');
    });
    $(document).on('blur', '.form-control', function() {
        $('.bottom-nav').css('display', 'flex');
    });
}



var $window = $(window);

$window.on('load', function() {
    if ($window.width() < 992) {
        $('ul.menu').slideUp();
    }
})


// header section scroll
$(function() {
    const AllBullets = document.querySelectorAll(".header-section .header-bullet");

    function scrollToSomeWhere(elements) {
        elements.forEach(ele => {
            ele.addEventListener("click", (e) => {
                e.preventDefault();
                document.querySelector(e.target.dataset.section).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    }
    scrollToSomeWhere(AllBullets);
});


// toggle password input

$(document).on('click', '.fa-eye', function() {
    var password_field = $(this).prev('input');
    $(this).toggleClass('fa-eye-slash');
    password_field.toggleClass('show-password');
    if (password_field.hasClass('show-password')) {
        password_field.attr('type', 'text');
    } else {
        password_field.attr('type', 'password');
    }
});

// verfication code numbers only

function isNumberKey(event) {
    var charCode = (event.which) ? event.which : event.keyCode
    return !(charCode > 31 && (charCode < 48 || charCode > 57));
}

$(document).on('keypress', '.code_inputs input', function() {
    return isNumberKey(event);
});

$(".code_inputs input").keyup(function() {
    if (this.value.length == this.maxLength) {
        $(this).parent().next().children('.code_inputs input').focus();
    }
});

// category nice select

$(document).ready(function() {
    $('select.nice-select').niceSelect();
});

//add to favourite category
$(document).on('click', '.add_fav_btn', function() {
    $(this).toggleClass('fa-heart');
    $(this).toggleClass('fa-heart-o');
    $(this).toggleClass('product_added');
});

// toggle table provider details

$(document).on('click', '.toggle-table', function() {
    $(this).parent('.work-row').siblings('.work-row').toggle();
});


//cart  plus and minus
var numberSpinner = (function() {
    $('.number-spinner>.ns-btn>a').click(function() {
        var btn = $(this),
            oldValue = btn.closest('.number-spinner').find('input').val().trim(),
            newVal = 0;

        if (btn.attr('data-dir') === 'up') {
            newVal = parseInt(oldValue) + 1;
        } else {
            if (oldValue > 1) {
                newVal = parseInt(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        btn.closest('.number-spinner').find('input').val(newVal);
    });

})();


// payment method

$(document).on('click', '.payment-visa input[type=radio]', function() {
    $(this).siblings('.visa-check').addClass('checked-radio').parent().siblings().children('.visa-check').removeClass('checked-radio');
});

// remove address

$(document).on('click', '.user-table .remove_address', function() {
    $(this).parent('.user-table').hide().parents('.shipping_to_wrapper').hide();
});

// accept order special order page

$(document).on('click', '.accept_order', function() {
    $(this).parent('.provider_btn').hide();
    $('.cancel_order').css('display', 'none');;
    $('.complete_order').css('display', 'flex');
});

// provider rate modal

$(function() {
    $('.rate_wrapper .star-one').click(function() {
        $(this).addClass('rated-star').prevAll().addClass('rated-star');
        $(this).nextAll().removeClass('rated-star');
        $('#rate-numbers').val(1);
    });
    $('.rate_wrapper .star-two').click(function() {
        $(this).addClass('rated-star').prevAll().addClass('rated-star');
        $(this).nextAll().removeClass('rated-star');
        $('#rate-numbers').val(2);
    });
    $('.rate_wrapper .star-three').click(function() {
        $(this).addClass('rated-star').prevAll().addClass('rated-star');
        $(this).nextAll().removeClass('rated-star');
        $('#rate-numbers').val(3);

    });
    $('.rate_wrapper .star-four').click(function() {
        $(this).addClass('rated-star').prevAll().addClass('rated-star');
        $(this).nextAll().removeClass('rated-star');
        $('#rate-numbers').val(4);
    });
    $('.rate_wrapper .star-five').click(function() {
        $(this).addClass('rated-star').prevAll().addClass('rated-star');
        $(this).nextAll().removeClass('rated-star');
        $('#rate-numbers').val(5);
    });

});

// provider time repeater

$(document).on('click', '.time-form-group .hidden_input', function() {
    $(this).css('opacity', '1');
});


$(document).on('click', '.repeater-add-btn', function() {

    $('.provider_items').append(`
    <div class="provider_time_row">
        <input type="text" name="time[day][]" class="day_input provider_input" placeholder="ادخل اليوم">
        <div class="time-form-group">
            <input type="time" name="time[from][]" class="time_input hidden_input">
            <input type="text" class="time_input provider_input" placeholder="من">
            <i class="fa fa-clock-o"></i>
        </div>
        <div class="time-form-group time_input">
            <input type="time" name="time[to][]" class="time_input hidden_input">
            <input type="text" class="time_input provider_input" placeholder="الي">
            <i class="fa fa-clock-o"></i>
        </div>
                    <label class="close_label mb-0">
                        <input  id="1" type="radio" class="close_checkbox" value="1"   name="time[closed][]">
                        مغلق
                    </label>
                    <label class="close_label mb-0">
                        <input  id="1" type="radio" class="close_checkbox" value="0"   name="time[closed2][]">
                        مفتوح
                    </label>
  
        <div class="repeater-remove-btn">
            <button type="button" class="btn btn-danger repeater-remove-btn">
                <i class="fa fa-times"></i>
            </button>
        </div>
  </div>
`);

});

$(document).on('click', '.repeater-remove-btn', function() {
    $(this).parent('.provider_time_row').remove();
});