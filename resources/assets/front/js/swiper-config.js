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
const swiperConfigShow = new Swiper('.swiper-container-show', {
    slidesPerView: 3,
    spaceBetween: 50,
    freeMode: false,
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
        delay: 10000,
        disableOnInteraction: true,
    },
    breakpoints: {
        // when window width is <= 499px
        499: {
            slidesPerView: 1,
            spaceBetweenSlides: 30
        },
        // when window width is <= 999px
        999: {
            slidesPerView: 2,
            spaceBetweenSlides: 40
        }
    }
});