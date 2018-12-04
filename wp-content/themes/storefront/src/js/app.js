// require('@fancyapps/fancybox');

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

  });
})(jQuery);




