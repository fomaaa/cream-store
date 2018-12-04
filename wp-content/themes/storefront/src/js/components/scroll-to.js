function scrollTo(windowW) {

  $('.js-scroll-to-link').on('click', function(e) {
    e.preventDefault();
    let $this = $(this);
    let target = $this.attr('data-sroll-target');
    let targetElem = $(`[data-scroll="${target}"]`);
    let anchorsH = $('.js-anchors').height();
    $('html, body').animate({
      scrollTop: targetElem.offset().top - anchorsH
    }, 500);
    if(windowW < 1023) {
      let menu = $('.js-anchors-mob-drop');
      menu.toggleClass('is-open');
      menu.find('.js-anchors-mob-content').slideToggle(300);
    }
  });

}


module.exports = scrollTo;
