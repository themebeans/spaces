<?php
/**
 * The content loop file for portfolio grid ligthbox templates.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

$terms     = get_the_terms( $post->ID, 'portfolio_category' );
$term_list = null;
if ( is_array( $terms ) ) {
	foreach ( $terms as $term ) {
		$term_list .= $term->term_id;
		$term_list .= ' '; }
}
?>

<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>

	<li id="portfolio-<?php the_ID(); ?>" <?php post_class( "$term_list item" ); ?>>

		<div id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio' ); ?>>

			<?php spaces_gallery( $post->ID, '', 'port-grid-lightbox', '', true ); ?>

			<div class="overlay"><h5><?php the_title(); ?></h5></div>

		</div>

	</li>

<?php
}
