//Side Menu Settings
const DomElements = {
    navBarBtn: document.querySelector('.navbar-toggler'),
    sideMenuClose: document.querySelector('.side-menu .close-menu button')
};

function menuOpen() {
    // $('#sideMenu').css();
    $('#sideMenu')
        .css('display', 'block')
        .animate({
            right: '0'
        }, 400);
    $('body').css('overflow', 'hidden');
}

function menuClose() {
    $(this).parents('.side-menu').animate({
        right: '-100vw'
    }, 400).delay(400).queue(function (next) {
        $('.side-menu').css('display', 'none');
        $('body').css('overflow', 'hidden');
        next();
    });
}

DomElements.navBarBtn.addEventListener('click', menuOpen);
DomElements.sideMenuClose.addEventListener('click', menuClose);

$('.input-group-append').on('click', function () {
    if ($(this).siblings().attr('type') === 'password') {
        $(this).siblings().prop('type', 'text');
    } else if ($(this).siblings().attr('type') === 'text') {
        $(this).siblings().prop('type', 'password');
    }
    $(this).find('i')
        .toggleClass('fa-eye')
        .toggleClass('fa-eye-slash');
});

if (window.location.href.indexOf('home') > -1) {
    $('.bottom-nav .fa-home').parent('.nav-link')
        .addClass('active')
        .siblings().removeClass('active');
} else if (window.location.href.indexOf('search') > -1) {
    $('.bottom-nav .fa-search').parent('.nav-link')
        .addClass('active')
        .siblings().removeClass('active');
} else if (window.location.href.indexOf('group') > -1) {
    $('.bottom-nav .fa-users').parent('.nav-link')
        .addClass('active')
        .siblings().removeClass('active');
} else if (window.location.href.indexOf('profile') > -1) {
    $('.bottom-nav .fa-user').parent('.nav-link')
        .addClass('active')
        .siblings().removeClass('active');
} else {
    $('.bottom-nav .fa-user').parent('.nav-link').siblings().removeClass('active');
}
$('span.expand').on('click', function () {
    if ($('.search-form').hasClass('small-search')) {
        showSearch();
    } else {
        $('.search-form')
            .addClass('small-search')
            .css({
                overflow: 'hidden'
            })
            .animate({
                height: '174px'
            })
            .children('span').css({
                transform: 'rotateX(0)'
            });
    }
});
const showSearch = function () {
    $('.search-form')
        .removeClass('small-search')
        .css({
            overflow: 'visible'
        })
        .animate({
            height: '408px'
        })
        .children('span').css({
            transform: 'rotateX(180deg)'
        });
};
$('.owl-carousel').owlCarousel({
    rtl: true,
    loop: false,
    margin: -20,
    stagePadding: 40,
    nav: true,
    dots: false,
    items: 6,
    navText: ['<i class="fas fa-chevron-right">', '<i class="fas fa-chevron-left">'],
    responsive: {
        // breakpoint from 0 up
        0: {
            items: 3,
        },
        // breakpoint from 480 up
        480: {
            items: 5,
        },
        // breakpoint from 768 up
        768: {
            items: 6,
        }
    }
});

$('.data-head').on('click', function () {
    $('.data-edit').slideToggle(400);
});
