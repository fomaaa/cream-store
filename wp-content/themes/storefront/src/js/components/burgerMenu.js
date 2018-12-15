import {DOC, ACTIVE, BODY, WIN, HIDDEN} from '../_const';

const burger = '.js-burger';
const submenu = $('.js-submenu');

DOC.on('click', burger, (e) => {

  let that = $(e.currentTarget);
  if(WIN.width() < 1023) {
  	that.toggleClass(ACTIVE);
  	submenu.toggleClass(ACTIVE);
    BODY.toggleClass(HIDDEN);
  } else {
    that.toggleClass(ACTIVE);
    submenu.toggleClass(ACTIVE);
  }

});

BODY.click((e) => {
  
  if (!$(e.target).closest('.js-submenu').length && !$(e.target).closest('.js-burger').length ) {
    if(WIN.width() < 1023) {
      if($(e.target).parents('.js-popup-link')) return;
      BODY.removeClass(HIDDEN);
    };
    submenu.removeClass(ACTIVE);
    $(burger).removeClass(ACTIVE);
   
  }
});
