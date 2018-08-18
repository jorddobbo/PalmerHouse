<?php get_header() ?>

<?php while (have_posts()) : the_post(); ?>
    
<section class="portfolio-hero">
    <div class="portfolio-hero__container container">
        <div class="portfolio-hero__content">
            <h2 class="portfolio-hero__title"><?php the_title(); ?></h2>
        </div>
    </div>
    <div class="portfolio-hero__bg"></div>
</section>

<section class="portfolio-information">
	<div class="portfolio-information__container container">
		<h2 class="portfolio-information__title">Project</h2>
		<div class="portfolio-information__wrapper">
			<div class="portfolio-information__column"><p class="portfolio-information__paragraph">Our back ground is within Construction and Retail store design. Delivering stylish living and working spaces is what we do best. We are driven by great design and</p></div>
			<div class="portfolio-information__column"><p class="portfolio-information__paragraph">Our back ground is within Construction and Retail store design. Delivering stylish living and working spaces is what we do best. We are driven by great design and</p></div>
		</div>
	</div>
</section>

<?php endwhile; ?>
<?php get_footer() ?>