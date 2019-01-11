// require('@fancyapps/fancybox');
import vhCheck from 'vh-check';
import svg4everybody from 'svg4everybody';
import StickySidebar from './components/sticky-head';
import './components/jquery.sTabs';
import './components/jquery.splitter';
import './components/sliders';

import $ from 'jquery';

window.$ = $;

svg4everybody();

(function($) {
  $(function() {

    $(document).on('change', '[name="payment_method"]', function() {
      if (this.value === 'applePayMethod') {
        $('.form__apply-pay').addClass('is-active');
      } else {
        $('.form__apply-pay').removeClass('is-active');
      }
    });

    if (!window.ApplePaySession) {
      $('.applePay').remove();
      $('.form__apply-pay').remove();
    }

    $('.btn--burger').on('click', function(e) {
      e.preventDefault();

      $('body').toggleClass('is-fixed show-menu');
    });

    vhCheck('browser-address-bar');
    $('.category .close').on('click', function(e) {
      e.preventDefault();

      $(this).closest('.category').removeClass('is-active');
    });


    $('.category__head').on('click', function(e) {
      e.preventDefault();
      $(this).parent().addClass('is-active');
    });

    if ($(window).width() > 1024) {
      $('.category__body ul').splitter({
        columns: 3
      });
    } else {
      $('.category:not(.category--black) .category__body ul').splitter({
        columns: 3
      });
    }

    $('.tabsCart').sTabs();

    if ($('.js-sticky').length && $(window).width() > 1024) {
      $('.js-sticky').each(function() {
        new StickySidebar(this, {
          topSpacing: 20,
          resizeSensor: true,
          bottomSpacing: 20
        });
      });
    }

    $('.accordion__head').on('click', function() {
      $(this).next().slideToggle(400);
    });

    $(document).on('click', '.goodNotification__close', function(e) {
      e.preventDefault();

      $(this).closest('.goodNotification').slideUp(400);
    });

    $(document).on('blur, focus', '.js-enter-text', function() {
      $('.goodSlider--main .swiper-container').get(0).swiper.slideTo(0);
    });

    $(document).on('keyup', '.js-enter-text', function() {
      $('.js-area-text').text(this.value);
    });

    let oldClassColor = '';

    $(document).on('change', '.js-text-color', function() {

      $('.js-area-text').removeClass(oldClassColor);
      $('.js-area-text').addClass(this.value);
      $('.js-area-text').css('background', `-webkit-linear-gradient(transparent, transparent),url(${$(this).data('text-gradient')}) repeat`);

      oldClassColor = this.value;
    });

  });
})(jQuery);




