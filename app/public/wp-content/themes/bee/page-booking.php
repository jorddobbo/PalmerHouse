<?php get_header() ?>

<div class="page-wrap">

	<div class="page-title">
		<div class="page-title__container container">
			<h1 class="page-title__title"><?php the_title(); ?></h1>
		</div>
	</div>

	<section class="home-rates booking-rates">
		<div class="home-rates__container container">
			<p class="home-rates__paragraph">Most of the rooms can be adapted to suit a variety of therapies and we have flexible arrangements. So, if you are a counsellor/psychotherapist/ life coach this could work for you. One room has a sink and is well suited to art therapy.</p>
			<div class="home-rates__info">
				<div class="home-rates__hourly">
					<div class="home-rates__info-indicator">1</div>
					<p class="home-rates__info-sub-title">Hourly</p>
					<h2 class="home-rates__info-title">£12</h2>
				</div>
				<div class="home-rates__daily">
					<div class="home-rates__info-indicator">2</div>
					<p class="home-rates__info-sub-title">Daily</p>
					<h2 class="home-rates__info-title">£60</h2>
				</div>
				<div class="home-rates__times">
					<div class="home-rates__info-indicator">3</div>
					<div class="home-rates__times-inner">
						<div class="home-rates__times-single">
							<p class="home-rates__info-sub-title">9:00 - 12:00</p>
							<h2 class="home-rates__info-title">£25</h2>
						</div>
						<div class="home-rates__times-single">
							<p class="home-rates__info-sub-title">13:00 - 16:00</p>
							<h2 class="home-rates__info-title">£25</h2>
						</div>
						<div class="home-rates__times-single">
							<p class="home-rates__info-sub-title">17:00 - 20:00</p>
							<h2 class="home-rates__info-title">£30</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="booking-tabs">
		<div class="booking-tabs__container container">
			<h2 class="booking-tabs__main-title">Select Your Room</h2>
			<div class="booking-tabs__list">
				<div data-form="form_room-1" class="booking-tabs__item booking-tabs__room-1 active">
					<div class="booking-tabs__image" style="background-image: url('<?= get_template_directory_uri(); ?>/assets/img/home/room-1.jpg');"></div>
					<h3 class="booking-tabs__title">Room .01</h3>
				</div>
				<div data-form="form_room-2" class="booking-tabs__item booking-tabs__room-2">
					<div class="booking-tabs__image" style="background-image: url('<?= get_template_directory_uri(); ?>/assets/img/home/room-2.jpg');"></div>
					<h3 class="booking-tabs__title">Room .02</h3>
				</div>
				<div data-form="form_room-3" class="booking-tabs__item booking-tabs__room-3">
					<div class="booking-tabs__image" style="background-image: url('<?= get_template_directory_uri(); ?>/assets/img/home/room-3.jpg');"></div>
					<h3 class="booking-tabs__title">Room .03</h3>
				</div>
				<div data-form="form_room-4" class="booking-tabs__item booking-tabs__room-4">
					<div class="booking-tabs__image" style="background-image: url('<?= get_template_directory_uri(); ?>/assets/img/home/room-4.jpg');"></div>
					<h3 class="booking-tabs__title">Room .04</h3>
				</div>
				<div data-form="form_room-5" class="booking-tabs__item booking-tabs__room-5">
					<div class="booking-tabs__image" style="background-image: url('<?= get_template_directory_uri(); ?>/assets/img/home/room-5.jpg');"></div>
					<h3 class="booking-tabs__title">Room .05</h3>
				</div>
				<div data-form="form_room-6" class="booking-tabs__item booking-tabs__room-6">
					<div class="booking-tabs__image" style="background-image: url('<?= get_template_directory_uri(); ?>/assets/img/home/room-6.jpg');"></div>
					<h3 class="booking-tabs__title">Room .06</h3>
				</div>
				<div data-form="form_room-7" class="booking-tabs__item booking-tabs__room-7">
					<div class="booking-tabs__image" style="background-image: url('<?= get_template_directory_uri(); ?>/assets/img/home/room-7.jpg');"></div>
					<h3 class="booking-tabs__title">Room .07</h3>
				</div>
				<div data-form="form_room-8" class="booking-tabs__item booking-tabs__room-8">
					<div class="booking-tabs__image" style="background-image: url('<?= get_template_directory_uri(); ?>/assets/img/home/room-8.jpg');"></div>
					<h3 class="booking-tabs__title">Room .08</h3>
				</div>
			</div>
		</div>
	</div>

	<div class="page-wrap__container container">

		<?php while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>

	</div>

</div>

<?php get_footer() ?>