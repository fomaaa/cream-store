import Swiper from 'swiper/dist/js/swiper.js';


new Swiper('.bannerSlider', {
  loop: true,
  navigation: {
    nextEl: '.bannerSlider .swiper-button-next'
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true
  }
});


let $goodMain = $('.goodSlider--main .swiper-container'),
  $goodThumbs = $('.goodSlider--thumbs .swiper-container'),
  $thumbsSlides = $goodThumbs.find('.swiper-slide');

let goodThumbs = new Swiper($goodThumbs, {
  observer: true,
  observeParents: true,
  direction: 'vertical',
  slidesPerView: 4,
  spaceBetween: 30,
  slideToClickedSlide: true,
  // centeredSlides: true,
  touchRatio: 0.2,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev'
  },
  breakpoints: {
    1025: {
      slidesPerView: 3
    }
  }
});

let goodMain = new Swiper($goodMain, {
  observer: true,
  observeParents: true,
  slidesPerView: 1,
  on: {
    init: function() {
      $thumbsSlides.eq(this.activeIndex).addClass('is-active');
    },
    slideChange: function() {
      goodThumbs.slideTo(goodMain.activeIndex);
      $goodThumbs.find('.swiper-slide').removeClass('is-active');
      $thumbsSlides.eq(goodMain.activeIndex).addClass('is-active');
    }
  }
});

$thumbsSlides.on('click', function() {
  var $thumbsSlide = $(this),
    index = $thumbsSlides.index($thumbsSlide);
  goodMain.slideTo(index);
});
