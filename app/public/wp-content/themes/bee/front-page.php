<?php get_header() ?>

<section class="home-hero">
	<div class="home-hero__container container">
		<div class="home-hero__content">
			<h2 class="home-hero__title"><?php echo the_field('hero_main', 75); ?></h2>
			<div class="home-hero__sub-title"><?php echo the_field('hero_sub', 75); ?></div>
		</div>
	</div>

	<div class="home-hero__image">
		<div class="home-hero__img" style="background-image: url('<?= get_template_directory_uri(); ?>/assets/img/home/home-one.jpg');"></div>
	</div>
</section>

<section class="home-intro">
	<div class="home-intro__container container">
		<div class="home-intro__top">
			<p class="home-intro__paragraph"><?php echo the_field('intro_summary', 75); ?></p>
		</div>
	</div>
</section>

<section class="home-detail">
	<div class="home-detail__container container">
		<div class="home-detail__col-left">
			<div class="home-detail__image-left">
				<img src="<?= get_template_directory_uri(); ?>/assets/img/home/intro_img3.jpg" alt="">
			</div>
			<div class="home-detail__paragraph">
				<span class="home-detail__highlight"><?php echo the_field('intro_description_bold', 75); ?></span>

				<?php echo the_field('intro_description', 75); ?>
			</div>
		</div>
		<div class="home-detail__col-right">
			<div class="home-detail__room-number">
				<h2>8 rooms</h2>
			</div>
			<div class="home-detail__image-right">
				<img src="<?= get_template_directory_uri(); ?>/assets/img/home/intro_img2.jpg" alt="">
			</div>
		</div>
	</div>
</section>

<section id="anchor_rates" class="home-rates">
	<div class="home-rates__container container">
		<img class="home-rates__badge" src="<?= get_template_directory_uri(); ?>/assets/img/home/logo_badge.svg" alt="">
		<h2 class="home-rates__title">Rooms & Rates</h2>
		<p class="home-rates__paragraph"><?php echo the_field('rates_summary', 75); ?></p>

	<?php 

		$rates = get_field('rates');	

	?>

		<div class="home-rates__info">
			<div class="home-rates__hourly">
				<div class="home-rates__info-indicator">1</div>
				<p class="home-rates__info-sub-title"><?php echo $rates['hourly_label']; ?></p>
				<h2 class="home-rates__info-title"><?php echo $rates['hourly_rate']; ?></h2>
			</div>
			<div class="home-rates__daily">
				<div class="home-rates__info-indicator">2</div>
				<p class="home-rates__info-sub-title"><?php echo $rates['daily_label']; ?></p>
				<h2 class="home-rates__info-title"><?php echo $rates['hourly_rate']; ?></h2>
			</div>
			<div class="home-rates__times">
				<div class="home-rates__info-indicator">3</div>
				<div class="home-rates__times-inner">
					<div class="home-rates__times-single">
						<p class="home-rates__info-sub-title"><?php echo $rates['block_one']; ?></p>
						<h2 class="home-rates__info-title"><?php echo $rates['block_one_rate']; ?></h2>
					</div>
					<div class="home-rates__times-single">
						<p class="home-rates__info-sub-title"><?php echo $rates['block_two']; ?></p>
						<h2 class="home-rates__info-title"><?php echo $rates['block_two_rate']; ?></h2>
					</div>
					<div class="home-rates__times-single">
						<p class="home-rates__info-sub-title"><?php echo $rates['block_three']; ?></p>
						<h2 class="home-rates__info-title"><?php echo $rates['block_three_rate']; ?></h2>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="home-rooms">
	<div class="home-rooms__container container">
		<div class="home-rooms__inner">
			<div class="home-rooms__item">
				<img src="<?= get_template_directory_uri(); ?>/assets/img/home/room-1.jpg" alt="">
				<h3 class="home-rooms__item-title">Room .01</h3>
				<!--<p class="home-rooms__item-paragraph">We offer attractive and affordable rooms for hire to counsellors and therapists. If you are a practitioner in the therapy world and are.</p>-->
			</div>
			<div class="home-rooms__item">
				<img src="<?= get_template_directory_uri(); ?>/assets/img/home/room-2.jpg" alt="">
				<h3 class="home-rooms__item-title">Room .02</h3>
				<!--<p class="home-rooms__item-paragraph">We offer attractive and affordable rooms for hire to counsellors and therapists. If you are a practitioner in the therapy world and are.</p>-->
			</div>
			<div class="home-rooms__item">
				<img src="<?= get_template_directory_uri(); ?>/assets/img/home/room-3.jpg" alt="">
				<h3 class="home-rooms__item-title">Room .03</h3>
				<!--<p class="home-rooms__item-paragraph">We offer attractive and affordable rooms for hire to counsellors and therapists. If you are a practitioner in the therapy world and are.</p>-->
			</div>
			<div class="home-rooms__item">
				<img src="<?= get_template_directory_uri(); ?>/assets/img/home/room-4.jpg" alt="">
				<h3 class="home-rooms__item-title">Room .04</h3>
				<!--<p class="home-rooms__item-paragraph">We offer attractive and affordable rooms for hire to counsellors and therapists. If you are a practitioner in the therapy world and are.</p>-->
			</div>
			<div class="home-rooms__item">
				<img src="<?= get_template_directory_uri(); ?>/assets/img/home/room-5.jpg" alt="">
				<h3 class="home-rooms__item-title">Room .05</h3>
				<!--<p class="home-rooms__item-paragraph">We offer attractive and affordable rooms for hire to counsellors and therapists. If you are a practitioner in the therapy world and are.</p>-->
			</div>
			<div class="home-rooms__item">
				<img src="<?= get_template_directory_uri(); ?>/assets/img/home/room-6.jpg" alt="">
				<h3 class="home-rooms__item-title">Room .06</h3>
				<!--<p class="home-rooms__item-paragraph">We offer attractive and affordable rooms for hire to counsellors and therapists. If you are a practitioner in the therapy world and are.</p>-->
			</div>
			<div class="home-rooms__item">
				<img src="<?= get_template_directory_uri(); ?>/assets/img/home/room-7.jpg" alt="">
				<h3 class="home-rooms__item-title">Room .07</h3>
				<!--<p class="home-rooms__item-paragraph">We offer attractive and affordable rooms for hire to counsellors and therapists. If you are a practitioner in the therapy world and are.</p>-->
			</div>
			<div class="home-rooms__item">
				<img src="<?= get_template_directory_uri(); ?>/assets/img/home/room-8.jpg" alt="">
				<h3 class="home-rooms__item-title">Room .08</h3>
				<!--<p class="home-rooms__item-paragraph">We offer attractive and affordable rooms for hire to counsellors and therapists. If you are a practitioner in the therapy world and are.</p>-->
			</div>
		</div>
	</div>
</section>

<section id="anchor_gallery" class="home-gallery">
	<div class="home-gallery__inner">
		<img class="home-gallery__img" src="<?= get_template_directory_uri(); ?>/assets/img/home/gallery/one.jpg" alt="">
		<img class="home-gallery__img" src="<?= get_template_directory_uri(); ?>/assets/img/home/gallery/two.jpg" alt="">
		<img class="home-gallery__img" src="<?= get_template_directory_uri(); ?>/assets/img/home/gallery/three.jpg" alt="">
		<img class="home-gallery__img" src="<?= get_template_directory_uri(); ?>/assets/img/home/gallery/four.jpg" alt="">
		<img class="home-gallery__img" src="<?= get_template_directory_uri(); ?>/assets/img/home/gallery/five.jpg" alt="">
		<img class="home-gallery__img" src="<?= get_template_directory_uri(); ?>/assets/img/home/gallery/six.jpg" alt="">
		<img class="home-gallery__img" src="<?= get_template_directory_uri(); ?>/assets/img/home/gallery/seven.jpg" alt="">
		<img class="home-gallery__img" src="<?= get_template_directory_uri(); ?>/assets/img/home/gallery/eight.jpg" alt="">
		<img class="home-gallery__img" src="<?= get_template_directory_uri(); ?>/assets/img/home/gallery/nine.jpg" alt="">
		<img class="home-gallery__img" src="<?= get_template_directory_uri(); ?>/assets/img/home/gallery/ten.jpg" alt="">
		<img class="home-gallery__img" src="<?= get_template_directory_uri(); ?>/assets/img/home/gallery/eleven.jpg" alt="">
		<img class="home-gallery__img" src="<?= get_template_directory_uri(); ?>/assets/img/home/gallery/twelve.jpg" alt="">
		<img class="home-gallery__img" src="<?= get_template_directory_uri(); ?>/assets/img/home/gallery/thirteen.jpg" alt="">
		<img class="home-gallery__img" src="<?= get_template_directory_uri(); ?>/assets/img/home/gallery/fourteen.jpg" alt="">
		<img class="home-gallery__img" src="<?= get_template_directory_uri(); ?>/assets/img/home/gallery/fifteen.jpg" alt="">
		<img class="home-gallery__img" src="<?= get_template_directory_uri(); ?>/assets/img/home/gallery/sixteen.jpg" alt="">
		<img class="home-gallery__img" src="<?= get_template_directory_uri(); ?>/assets/img/home/gallery/seventeen.jpg" alt="">
		<img class="home-gallery__img" src="<?= get_template_directory_uri(); ?>/assets/img/home/gallery/eighteen.jpg" alt="">
		<img class="home-gallery__img" src="<?= get_template_directory_uri(); ?>/assets/img/home/gallery/nineteen.jpg" alt="">
		<img class="home-gallery__img" src="<?= get_template_directory_uri(); ?>/assets/img/home/gallery/twenty.jpg" alt="">
	</div>
	<div class="home-hero__arrows">
		<div class="home-hero__arrows-prev"><img src="<?= get_template_directory_uri(); ?>/assets/img/svg/arrow-light-right.svg" alt=""></div>
		<div class="home-hero__arrows-next"><img src="<?= get_template_directory_uri(); ?>/assets/img/svg/arrow-light-right.svg" alt=""></div>
	</div>
	<div class="home-hero__dots">
		<div class="home-hero__dots-inner"></div>
	</div>
</section>

<section id="anchor_location" class="home-location">
	<div class="home-location__inner">
		<div class="home-location__col-left">
			<div class="home-location__info">
				<h2 class="home-location__info-title"><?php echo the_field('location_title'); ?></h2>
				<p class="home-location__info-paragraph"><?php echo the_field('location'); ?></p>
				<a target="_blank" href="https://www.google.co.uk/maps/place/pelham+court,+2+Pelham+Rd,+Nottingham+NG5+1AP/data=!4m2!3m1!1s0x4879c19e9bd584e1:0x3cf5c548f95871e2?sa=X&ved=2ahUKEwi3-ePNh4ndAhUlKsAKHZ0uDpcQ8gEwAHoECAUQAQ" class="button button--outline home-location__button">View on map <span>&rarr;</span></a>
			</div>
		</div>
		<div class="home-location__col-right">
			<div class="home-location__map" id="map"></div>
		</div>
	</div>
</section>

<?php get_footer() ?>