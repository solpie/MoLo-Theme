<?php
/**
 * @package MuLo
 */
?>

<div <?php post_class( 'inside item' ); ?>>
	<h2 class="itemtitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

	<div class="itemdate"><a href="<?php the_permalink(); ?>"><?php mulo_posted_on(); ?></a></div>
	<div class="itemcat">
		<?php
		$categories = get_the_category();
		if ( !empty( $categories ) ) {
			foreach ( $categories as $index => $category ) {
				echo '<a href="' . get_category_link( $category ) . '">' . $category->name . '</a>' . ( $index !== count( $categories ) - 1 ? ' / ' : '' );
			}
		}
		?>
	</div>
	<div id="content">
		<?php
			wp_link_pages();
			the_content();
			posts_nav_link( ' &#183; ', 'previous page', 'next page' );
			edit_post_link( __( 'Edit', 'MuLo' ), '<span class="edit-link">', '</span>' );
		?>
		<div id="bottommeta">
			<?php the_tags( __( 'Tags: ', 'MuLo' ), '  ', '' ); ?>
		</div>
	</div>