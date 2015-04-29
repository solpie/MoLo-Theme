<?php
/**
 * The template for displaying all single posts.
 *
 * @package MuLo
 */

get_header(); ?>
	<div class="masonryinside">
		<div class="wrapper">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

			<?php endwhile; // end of the loop. ?>
		</div>
	</div>
<?php get_footer(); ?>