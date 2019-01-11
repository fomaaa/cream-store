$.fn.bgSiazeCover = function(options) {
  var settings = $.extend(true, {
    onPlayReady: $.noop,
    wrapperClass: ''
  }, options);

  if (this.length === 0) return;
  var $element = this,
    elementClass = settings.wrapperClass || $element.attr('class').split(' ')[0] + 'Wrapper',
    $parent = $element.parent();

  $element.wrap('<div class="coverBgWrapper ' + elementClass + '" />');

  if ($element.get(0).nodeName === 'VIDEO') {
    $element.get(0).play();
    $element.on('canplaythrough', function() {
      this.play();
      settings.onPlayReady();
    });
  }

  var $wrapper = $element.closest('.coverBgWrapper').css({
      position: 'absolute',
      width: $parent.outerWidth(),
      height: $parent.outerHeight()
    }),
    minWidth = 300,
    videoWidth_orig = parseInt($element.attr('width')),
    videoHeight_orig = parseInt($element.attr('height')),
    $window = $(window),
    resizeToCover = function() {
      var wrapperWidth = $parent.outerWidth(),
        wrapperHeight = $parent.outerHeight();

      $wrapper.css({
        'width': wrapperWidth,
        'height': wrapperHeight
      });

      // use largest scale factor of horizontal/vertical
      var scaleH = wrapperWidth / videoWidth_orig,
        scaleV = wrapperHeight / videoHeight_orig,
        scale = scaleH > scaleV ? scaleH : scaleV;

      // don't allow scaled width < minimum video width
      if (scale * videoWidth_orig < minWidth) {
        scale = minWidth / videoWidth_orig;
      }
      ;

      // now scale the video
      $element.width(scale * videoWidth_orig);
      $element.height(scale * videoHeight_orig);

      // and center it by scrolling the video viewport
      $wrapper.css('left', (wrapperWidth - $element.width()) / 2);
      $wrapper.css('top', (wrapperHeight - $element.height()) / 2);
      setTimeout(function() {
        $element.css('visibility', 'visible');
      }, 100);
    };

  resizeToCover();
  $window.on('resize', resizeToCover);
};
