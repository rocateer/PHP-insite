
(function ($) {
	$.fn.loading = function () {
		var DEFAULTS = {
			backgroundColor: '#f7f7f7',
			progressColor: '#5b84c1',
			percent: 100
		};

		$(this).each(function () {
			var $target  = $(this);

			var opts = {
			backgroundColor: $target.data('color') ? $target.data('color').split(',')[0] : DEFAULTS.backgroundColor,
			progressColor: $target.data('color') ? $target.data('color').split(',')[1] : DEFAULTS.progressColor,
			percent: $target.data('percent') ? $target.data('percent') : DEFAULTS.percent
			};
			//console.log(opts);

			$target.append('<div class="background"></div><div class="rotate"></div><div class="left"></div><div class="right"></div><div class=""> <span>진행중<br> <span><strong>' + opts.percent + '</strong>%</span></span></div>');

			$target.find('.background').css('background-color', opts.backgroundColor);
			$target.find('.left').css('background-color', opts.backgroundColor);
			$target.find('.rotate').css('background-color', opts.progressColor);
			$target.find('.right').css('background-color', opts.progressColor);

			var $rotate = $target.find('.rotate');

			$rotate.css({
				'transform': 'rotate(' + opts.percent * 3.6 + 'deg)'
			});

			if (opts.percent > 50) {
				$target.find('.right').css({
					opacity: 1
				});
				$target.find('.left').css({
					opacity: 0
				});
			}
		});
	};
})(jQuery);
