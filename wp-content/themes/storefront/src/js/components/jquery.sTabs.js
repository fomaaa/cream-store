import {ACTIVE} from '../_const';

$.fn.sTabs = function(scroll) {
  this.each(function() {
    let $wrapTab = $(this),
      $tabs = $wrapTab.find('.tabsList a'),
      $tabsBtnNext = $wrapTab.find('.js-tab-next'),
      $tabsBtnPrev = $wrapTab.find('.js-tab-prev'),
      $wrapCont = $wrapTab.find('.tabsBox'),
      $tab_cont = $wrapCont.children('div');

    if (scroll) {
    }

    $tabs.on('click', function() {
      let tab_id = $(this).attr('class').split(' ');

      if ($(this).data('redirect') === true) {
        return;
      }

      $tabs.removeClass(ACTIVE);
      $(this).addClass(ACTIVE);
      $tab_cont.removeClass(ACTIVE);
      $wrapCont.children('.tabs__con_' + tab_id[0]).addClass(ACTIVE);
      $(window).resize();

      if (tab_id[0] === 'tab1') {
        $('.tabsBox > .cart__right').hide();
      } else {
        $('.tabsBox > .cart__right').show();
      }

      return false;
    });

    let hash = window.location.hash.slice(1);

    if ($('.tabsCart').length && hash !== '') {

      $tabs.removeClass(ACTIVE);
      $(`.${hash}`).addClass(ACTIVE);
      $tab_cont.removeClass(ACTIVE);
      $wrapCont.children('.tabs__con_' + hash).addClass(ACTIVE);
      $(window).resize();
    }

    $tabsBtnNext.on('click', function() {
      let nextTab = $wrapCont.find('.tabs__con.is-active').next();

      $tabs.removeClass(ACTIVE);

      $tab_cont.removeClass(ACTIVE);
      nextTab.addClass('is-active');

      $('.tabsBox > .cart__right').show();

      $(window).resize();
      return false;
    });

    $tabsBtnPrev.on('click', function() {
      let prevTab = $wrapCont.find('.tabs__con.is-active').prev();

      $tabs.removeClass(ACTIVE);

      $tab_cont.removeClass(ACTIVE);
      prevTab.addClass('is-active');

      if (prevTab.index() === 0) {
        $('.tabsBox > .cart__right').hide();
      } else {
        $('.tabsBox > .cart__right').show();
      }



      $(window).resize();
      return false;
    });
  });
};
