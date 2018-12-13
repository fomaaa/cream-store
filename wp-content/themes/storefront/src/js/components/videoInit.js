if (typeof videoEl != 'undefined' && $(window).width() > 900) {
	var $video = $('<video />').attr(videoEl.attr);

	$.each(videoEl.sources, function(index, el) {
		$video.append('<source />').find('source:last').attr(el);
	});
	$mainBg.prepend($video);
	$video.bgSiazeCover({
		onPlayReady: function() {
			$('.out').addClass('coverHide');
		}
	});
}
