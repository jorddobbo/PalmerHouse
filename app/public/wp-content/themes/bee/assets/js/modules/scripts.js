export default function() {

	jQuery(document).ready(function($) {

		$('header').on('click', '.header__menu-toggle', function(event) {
			var header = $('header');

			event.preventDefault();
			header.find('.header__menu').toggleClass('show');
			$('.header__overlay').toggleClass('show');

		});

		$('body').on('click', '.header__overlay', function(event) {
			var header = $('header');

			event.preventDefault();
			$(this).toggleClass('show');
			header.find('.nav-primary').toggleClass('show');
		});

		$(".home-gallery__inner").slick({

		    autoplay: false,
		    dots: true,
		    arrows: true,
		    centerMode: true,
		    variableWidth: true,
		    accessibility: false,
		    customPaging : function(slider, i) {
		        return '<a>•</a>';
		    },
		    appendArrows: $(".home-hero__arrows"),
		    prevArrow: $('.home-hero__arrows-prev'),
			nextArrow: $('.home-hero__arrows-next'),
		    appendDots: $(".home-hero__dots-inner"),
		    

		    responsive: [
		    	{ 
			        breakpoint: 1200,
			        settings: {
			            variableWidth: false,
			        }
		        }
		    ]
		});

		function bookingForms() {

			var btn = $('.booking-tabs__item');

			btn.on('click', function() {

				var form = $(this).data('form');

				btn.removeClass('active');
				$(this).addClass('active');

				$('.booking-forms__item').removeClass('active');
				$('#'+form).addClass('active');

				console.log();
			});

		} bookingForms();

	});

}