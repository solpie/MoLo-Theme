<?php
/**
 * @package MuLo
 */
?>

<div <?php post_class( 'item' ); ?>>

	<h2 class="itemtitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

	<div class="itemdate"><a href="<?php the_permalink(); ?>"><?php mulo_posted_on() ?></a></div>
</div><!--End Post -->