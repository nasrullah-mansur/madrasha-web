$(document).ready(function() {
    $('.banner-slider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        autoplay: true,
    });


    $('.gallery-page ul li').on('click', function() {
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
    })
})