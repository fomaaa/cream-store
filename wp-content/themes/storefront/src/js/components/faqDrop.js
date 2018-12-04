
function faqDrop(windowW) {

  // $head = drop.find('.js-faq-drop-head'),
  // $content = drop.find('.js-faq-drop-content');

  if(windowW < 1024) return;
  $('.js-faq-drop-head').on('click', function() {
  	let $drops = $('.js-faq-drop');
  	let $content = $('.js-faq-drop-content');
  	let $thisparent = $(this).parents('.js-faq-drop');
  	let $thisContent = $thisparent.find('.js-faq-drop-content');

  	$drops.not($thisparent).removeClass('is-open');
  	$drops.not($thisparent).find($content).slideUp(300);

  	$thisparent.toggleClass('is-open');
  	$thisContent.slideToggle(300);
  });


  $('.js-faq-drop-btn-close').on('click', function(e) {
  	e.preventDefault();
  	let $parent = $(this).parents('.js-faq-drop');
  	$parent.removeClass('is-open');
  	$parent.find('.js-faq-drop-content').slideUp(300);

  });
};
module.exports = faqDrop;
