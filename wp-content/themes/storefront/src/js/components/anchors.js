import {WIN, STIKY, BODY} from '../_const';

const anchor = $('.js-anchors');

function anchorStiky() {
  let positionAnchor = anchor.offset().top;

  WIN.on('scroll', (e) => {
    let scroll = WIN.scrollTop();
    if (scroll > positionAnchor) {
      anchor.addClass(STIKY);
      $('.out').addClass(STIKY);
    } else {
      anchor.removeClass(STIKY);
      $('.out').removeClass(STIKY);
    }
  });
}

if (anchor.length) anchorStiky();
