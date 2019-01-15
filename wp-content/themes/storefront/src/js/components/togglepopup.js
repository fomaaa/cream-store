$('[data-popup]').on('click', function(event) {
  event.preventDefault();
  let idPopup = $(this).attr('data-popup');
  $(idPopup).addClass('is-active');
  $('body').addClass('no-scroll');
});

$('.modal').on('click', function(event) {
  let self = $(this);
  if ($(event.target).is('.modal-close') || $(event.target).is('.modal-container')) {
    event.preventDefault();
    self.removeClass('is-active');
    $('body').removeClass('no-scroll');
  }
});
