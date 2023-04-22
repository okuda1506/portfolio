$('.slider').slick({
    autoplay: true,
    infinite: true,
    speed: 500,
    slidesToShow: 3,
    slidesToScroll: 1,
    prevArrow: '<div class="slick-prev"></div>',
    nextArrow: '<div class="slick-next"></div>',
    centerMode: true,
    variableWidth: true,
    dots: true,
    responsive: [
        {
            breakpoint: 767,
            settings: {
                arrows: false
            }
        }
    ]
});