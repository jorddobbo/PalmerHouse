import $ from 'jquery';
//import inView from './inview';

export default function() {

	$(document).ready(function($) {

		$(".title-split").each(function(i, v) {
			var title = $(this);
			var listHTML = $(this).html();
			var listItems = listHTML.split("<br>");
			$(this).html("");

			$.each(listItems, function(i, v) {
			  var item =
			    '<div class="title-split__mask"><span class="title-split__line">' + v + "</span></div>";
			  title.append(item);
			});
		});

		$('.fadeUp').on('inview', function(event, isInView) {
			var $el = $(this);
				if (typeof $el.data('delay') !== 'undefined') {
					var $delay = $el.data('delay');
				} else {
					var $delay = 0;
				}

			if (isInView) {
				setTimeout(function() {
					$el.addClass('inview');
				}, $delay);
			} else {
				
			}
		});

		$('.reveal').on('inview', function(event, isInView) {
			var $el = $(this);
				if (typeof $el.data('delay') !== 'undefined') {
					var $delay = $el.data('delay');
				} else {
					var $delay = 0;
				}

			if (isInView) {
				setTimeout(function() {
					$el.addClass('inview');
				}, $delay);
			} else {
				
			}
		});

		$('.fadeIn').on('inview', function(event, isInView) {
			var $el = $(this);
				if (typeof $el.data('delay') !== 'undefined') {
					var $delay = $el.data('delay');
				} else {
					var $delay = 0;
				}

			if (isInView) {
				setTimeout(function() {
					$el.addClass('inview');
				}, $delay);
			} else {
				
			}
		});

		$('.title-split__line').on('inview', function(event, isInView) {
			var $el = $(this);
				if (typeof $el.closest('.title-split').data('delay') !== 'undefined') {
					var $delay = $el.closest('.title-split').data('delay');
				} else {
					var $delay = 0;
				}

			if (isInView) {
				setTimeout(function() {
					$el.addClass('inview');
				}, $delay);
			} else {
				
			}
		});
	});
}