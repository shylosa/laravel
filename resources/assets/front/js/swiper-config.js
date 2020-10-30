// Slider for main page
const swiperConfig = new Swiper('.swiper-container', {
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    autoplay: {
        delay: 6000,
        disableOnInteraction: true,
    },
});
//Slider for show page
const swiperConfigShow = new Swiper('.swiper-container__show', {
    // default values
    slidesPerView: 1,
    spaceBetween: 10,
    centeredSlides: true,
    freeMode: false,
    loop: true,
    zoom:true,
    pagination: {
        el: '.swiper-pagination__show',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    autoplay: {
        delay: 10000,
        disableOnInteraction: true,
    },
    breakpoints: {
        // when window width is >= 568px
        568: {
            slidesPerView: 2,
            spaceBetween: 25
        },
        999: {
            slidesPerView: 3,
            spaceBetween: 50
        }
    }
});