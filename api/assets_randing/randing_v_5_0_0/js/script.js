// JavaScript Document

$(function() {

	var $navLink = $('#accordion').find('.trigger');

	$navLink.on('click', function() {
		var panelToShow = $(this).data('panel-id');
		var $activeLink = $('#accordion').find('.active');
		var $activeIcon = $('span.active');

		// show new panel
		// .stop is used to prevent the animation from repeating if you keep clicking the same link
		$('.' + panelToShow).stop().slideDown();
		$('.' + panelToShow).addClass('active');
		$('.arrow').addClass('active');

		// hide the previous panel
		$activeLink.stop().slideUp()
		.removeClass('active');
		$activeIcon.stop().removeClass('active');

	});

});
