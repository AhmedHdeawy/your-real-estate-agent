$('.unit > .unit-images-carousel').owlCarousel({
    loop: true,
    nav: false,
    rtl: true,
    items: 1,
});

$('.unit-images-gallery > .owl-carousel').owlCarousel({
    loop: false,
    nav: true,
    dots: false,
    margin: 30,
    rtl: true,
    items: 4,
    navText: [
        '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>',
        '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/></svg>'
    ],
    responsive: {
        // breakpoint from 0 up
        0: {
            items: 2,
        },
        // breakpoint from 480 up
        480: {
            items: 3,
        },
        // breakpoint from 768 up
        768: {
            items: 4,
        }
    }
});


const bigImage = document.querySelector('.big-image-con img');
const smImage = document.querySelectorAll('.unit-images-gallery .image-con img');

smImage.forEach(el => {
    el.addEventListener('click', () => {
        if (el.getAttribute('data-target') !== null) {
            bigImage.setAttribute('src', el.getAttribute('data-target'));
        } else {
            bigImage.setAttribute('src', el.getAttribute('src'));
        }
    });
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
