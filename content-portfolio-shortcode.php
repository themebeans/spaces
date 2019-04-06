<?php
/**
 * The file for displaying the portfolio shortcode.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

// GET THE LOOP ORDERBY & META_KAY VARIABLES VIA THEME CUSTOMIZER
$orderby = get_theme_mod( 'portfolio_loop_orderby' );

// PULL PAGINATION FROM CUSTOMIZATION
$portfolio_posts_count = get_theme_mod( 'portfolio_posts_count' );

// LOOP ORDERBY VARIABLE
if ( $orderby != '' ) {
	switch ( $orderby ) {
		case 'date':
			$order    = 'DSC';
			$orderby  = 'date';
			$meta_key = '';
			break;
		case 'rand':
			$order    = 'DSC';
			$orderby  = 'rand';
			$meta_key = '';
			break;
		case 'menu_order':
			$order    = 'ASC';
			$orderby  = 'menu_order';
			$meta_key = '';
			break;
		case 'view_count':
			$order    = 'DSC';
			$orderby  = 'meta_value_num';
			$meta_key = 'post_views_count';
			break;
	}
}

// SET PORTFOLIO LOOP
$args = array(
	'post_type'      => 'portfolio',
	'order'          => $order,
	'orderby'        => $orderby,
	'meta_key'       => $meta_key,
	'posts_per_page' => $portfolio_posts_count,
);

$portfolios = new WP_Query( $args ); ?>


<ul id="masonry-container" class="port-shortcode grid">

	<?php
	$i      = 1;
	query_posts( $args );
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();

			// GENERATE TERMS FOR FILTER PORTFOLIO TEMPLATE
			$terms     = get_the_terms( $post->ID, 'portfolio_category' );
			$term_list = null;
			if ( is_array( $terms ) ) {
				foreach ( $terms as $term ) {
					$term_list .= $term->term_id;
					$term_list .= ' '; }
			}

			$thumbnail = (
			$i == 1 ||
			$i == 3 ||
			$i == 5 ||
			$i == 7 ||
			$i == 9 ||
			$i == 11 ||
			$i == 13 ||
			$i == 15 ||
			$i == 17 ||
			$i == 19 ||
			$i == 21 ||
			$i == 23 ||
			$i == 25 ||
			$i == 27 ||
			$i == 29 ||
			$i == 31 ||
			$i == 33 ||
			$i == 35 ||
			$i == 37 ||
			$i == 39 ||
			$i == 41 ||
			$i == 43 ||
			$i == 45 ||
			$i == 47 ||
			$i == 49 ) ? 'masonry-std' : 'masonry-std2';

			if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) {
		?>

			 <li id="portfolio-<?php the_ID(); ?>" class="item masonry-item grid-masonry type-portfolio <?php echo esc_attr( $thumbnail ); ?> <?php echo esc_attr( $term_list ); ?>">

				  <div id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio' ); ?>>

					<a class="entry-link" title="<?php printf( esc_html__( 'Permanent Link to %s', 'spaces' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>"></a>
					<?php the_post_thumbnail( $thumbnail ); ?>

					  <div class="overlay"><h5><?php the_title(); ?></h5></div>

				  </div>

			 </li>

		<?php
			} $i++;
	endwhile;
endif;
	wp_reset_query();
?>

</ul><!-- END .hfeed -->

<script type="text/javascript">
	jQuery(document).ready(function($) {
		//MASONRY
		var container = document.querySelector('#masonry-container');
		var msnry;
		imagesLoaded( container, function() {
			msnry = new Masonry( container, {
				itemSelector: '.masonry-item'
			});
		});
	});
</script>
