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

		$(".home-hero__image").slick({

		    autoplay: false,
		    dots: true,
		    arrows: false,
		    customPaging : function(slider, i) {
		        return '<a>'+i+'</a>';
		    },
		    appendDots: $(".home-hero__arrows"),

		    responsive: [{ 
		        breakpoint: 500,
		        settings: {
		            dots: false,
		            arrows: false,
		            infinite: false,
		            slidesToShow: 2,
		            slidesToScroll: 2
		        } 
		    }]
		});

		function bookingForms() {

			var btn = $('.booking-tabs__item');

			btn.on('click', function() {

				var form = $(this).data('form');

				btn.removeClass('active');
				$(this).addClass('active');

				$('.booking-forms__item').removeClass('active');
				$('#'+form).addClass('active');

				console.log(btn, form);
			});

		} bookingForms();

	});

}