//	Start Side Menu Settings
const DomElements = {
    navBarBtn: document.querySelector('.navbar-toggler'),
    sideMenuClose: document.querySelector('.side-menu .close-menu button')
};

function menuOpen() {
    $('#sideMenu')
        .css('display', 'block')
        .animate({
            right: '0'
        }, 400);
    $('body').css('overflow', 'hidden');
}

function menuClose() {
    $('.side-menu').animate({
        right: '-100vw'
    }, 400).delay(400).queue(function (next) {
        $('.side-menu').css('display', 'none');
        $('body').css('overflow', 'auto');
        next();
    });
}

DomElements.navBarBtn.addEventListener('click', menuOpen);
DomElements.sideMenuClose.addEventListener('click', menuClose);
//	End Side Menu Settings

//	Start Password Input Visible
// $('.input-group-append').on('click', function () {
// 	if ($(this).siblings().attr('type') === 'password') {
// 		$(this).siblings().prop('type', 'text');
// 	} else if ($(this).siblings().attr('type') === 'text') {
// 		$(this).siblings().prop('type', 'password');
// 	}
// 	$(this).find('i')
// 		.toggleClass('fa-eye')
// 		.toggleClass('fa-eye-slash');
// });
//	End Password Input Visible


//	Start Search Toggle Expand
$('span.expand').on('click', function () {
    if ($('.search-form').hasClass('small-search')) {
        showSearch();
    } else {
        hideSearch();
    }
});
const showSearch = function () {
    $('.search-form')
        .removeClass('small-search')
        .css({
            overflow: 'visible'
        })
        .animate({
            height: '440px'
        })
        .children('span').css({
            transform: 'rotateX(180deg)'
        });
};

const hideSearch = function () {
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
};
//	End Search Toggle Expand


//	Start profile Data Edit
$('.data-head').on('click', function () {
    $('.data-edit').slideToggle(400);
});
//	End profile Data Edit

//	Start Friends List Hide / Show
$('#listToggle').on('click', function () {
    friendsShow();
});

const friendsShow = function () {
    $('.contacts').slideToggle(400);
    $('#listToggle').toggleClass('opened', 400);
    if ($('#listToggle').hasClass('opened')) {
        $('#listToggle span').css({
            transform: 'rotateX(180deg)'
        });
    } else {
        $('#listToggle span').css({
            transform: 'rotateX(0)'
        });
    }
};
//	End Friends List Hide / Show


// Add another Question when create the group
$('.btn-create-question').click(function (e) {
    e.preventDefault();

    // Get Teaxtarea Container
    const textAreaSection = $(this).parent().find('section');

    // Get the first textarea
    const textArea = textAreaSection.find('textarea.first:first');

    if (textAreaSection.find('textarea').length > 3) {
        return;
    }
    // Clone it, and insert it in the last
    var tx = textArea.clone().insertAfter(textAreaSection.find('textarea:last')).val('');


});

// Show Uploaded image under file input
$('.imageUpload').change(function (event) {

    let input = event.target.files[0];
    const inputName = $(this).data('id');

    if (input) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#' + inputName).removeClass('d-none').attr('src', e.target.result);
        }
        reader.readAsDataURL(input);
    }

});
