// Slider for main page
// eslint-disable-next-line camelcase,no-unused-vars,no-undef
const swiper__main = new Swiper('.swiper-container__main', {
  slidesPerView: 1,
  spaceBetween: 0,
  loop: true,
  pagination: {
    el: '.swiper-pagination__main',
    clickable: true,
  },
  navigation: {
    nextEl: '.swiper-button-next__main',
    prevEl: '.swiper-button-prev__main',
  },
  autoplay: {
    delay: 6000,
    disableOnInteraction: true,
  },
});
// Slider for show page
// eslint-disable-next-line camelcase,no-unused-vars,no-undef
const swiper__show = new Swiper('.swiper-container__page-show', {
  // default values
  slidesPerView: 1,
  spaceBetween: 10,
  centeredSlides: true,
  freeMode: false,
  loop: true,
  pagination: {
    el: '.swiper-pagination__page-show',
    clickable: true,
  },
  navigation: {
    nextEl: '.swiper-button-next__page-show',
    prevEl: '.swiper-button-prev__page-show',
  },
  autoplay: {
    delay: 10000,
    disableOnInteraction: true,
  },
  breakpoints: {
    // For screen >= 567px
    567: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    // For screen >= 768px
    768: {
      slidesPerView: 3,
      spaceBetween: 50,
    },

  },
});
