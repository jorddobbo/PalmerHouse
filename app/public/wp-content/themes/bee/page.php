<?php get_header() ?>

<div class="page-wrap">

	<div class="page-title">
		<div class="page-title__container container">
			<h1 class="page-title__title"><?php the_title(); ?></h1>
		</div>
	</div>

	<div class="page-wrap__container container">

		<?php while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>

	</div>

</div>

<?php get_footer() ?>