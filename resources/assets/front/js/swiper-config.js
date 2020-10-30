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
const swiperConfigShow = new Swiper('.swiper-container.page-show', {
    // default values
    slidesPerView: 3,
    spaceBetween: 50,
    centeredSlides: true,
    freeMode: false,
    loop: true,
    pagination: {
        el: '.swiper-pagination.page-show',
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
        568: {
            slidesPerView: 1,
            spaceBetween: 10
        }
    }
});