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
		<h2 class="portfolio-information__title">Projects</h2>
		<div class="portfolio-information__wrapper">
			<div class="portfolio-information__column"><p class="portfolio-information__paragraph">Our back ground is within Construction and Retail store design. Delivering stylish living and working spaces is what we do best. We are driven by great design and</p></div>
			<div class="portfolio-information__column"><p class="portfolio-information__paragraph">Our back ground is within Construction and Retail store design. Delivering stylish living and working spaces is what we do best. We are driven by great design and</p></div>
		</div>
	</div>
</section>

<?php

// check if the flexible content field has rows of data
if( have_rows('page_builder') ): ?>

	<div class="portfolio-content">

    <?php // loop through the rows of data
    while ( have_rows('page_builder') ) : the_row();

        if( get_row_layout() == 'full_width_image' ):?>

        	<?php 

        	$img = get_sub_field('full_width_image');
        	$url = $img['url'];
        	$caption = $img['caption'];

        	?>

       		<section class="portfolio-full">

       			<div class="portfolio-full__container container">
       				<img src="<?php echo $url ?>" />
       				<?php if( $caption ): ?>
						<div class="portfolio-full__caption">
							<?php echo $caption ?>
						</div>
					<?php endif; ?>
       			</div>
       			
       		</section>

        <?php elseif( get_row_layout() == 'split_width_image' ): ?>

        	<?php 

        	$img1 = get_sub_field('split_width_image');
        	$url1 = $img1['image_left']['url'];
        	$caption1 = $img1['image_left']['caption'];

        	$img2 = get_sub_field('split_width_image');
        	$url2 = $img2['image_right']['url'];
        	$caption2 = $img2['image_right']['caption'];

        	?>

        	<section class="portfolio-split">

        		<div class="portfolio-split__inner">

	       			<div class="portfolio-split__container container">
	       				<div class="portfolio-split__column portfolio-split__column--left">
		       				<img src="<?php echo $url1 ?>" />
		       				<?php if( $caption1 ): ?>
								<div class="portfolio-split__caption">
									<?php echo $caption1 ?>
								</div>
							<?php endif; ?>
						</div>
						<div class="portfolio-split__column portfolio-split__column--right">
		       				<img src="<?php echo $url2 ?>" />
		       				<?php if( $caption2 ): ?>
								<div class="portfolio-split__caption">
									<?php echo $caption2 ?>
								</div>
							<?php endif; ?>
						</div>
	       			</div>
	       		</div>
       			
       		</section>

        <?php elseif( get_row_layout() == 'quote' ): ?>

        	<?php

        	$quote = get_sub_field('quote');

        	?>

        	<section class="portfolio-quote">
        		<div class="portfolio-quote__container">
        			<div class="portfolio-quote__icon">
        				<img src="<?php echo get_template_directory_uri() ?>/assets/img/portfolio/quote_icon.svg" />
        			</div>
        			<div class="portfolio-quote__content"><?php echo $quote['quote_content'] ?></div>
        			<div class="portfolio-quote__author"><?php echo $quote['quote_author'] ?></div>
        		</div>
        	</section>

        <?php elseif( get_row_layout() == 'text_area' ): ?>

        	Text Area

        <?php endif;

    endwhile; ?>

	</div>

<?php else :

    // no layouts found

endif;

?>

<?php endwhile; ?>
<?php get_footer() ?>