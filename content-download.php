<?php
/**
 * The template for displaying the default downloads archive and template views for EDD.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

get_header();

// TEMPLATE VARIABLES
if ( is_page_template( 'template-downloads-fullwidth.php' ) ) {
	$full = true;
} else {
	$full = false;
} ?>

<div class="row portfolio fadein
<?php
if ( $full == true ) {
	echo ' fullscreen';}
?>
">

	<ul id="masonry-container" class="downloads grid
	<?php
	if ( $full == true ) {
		echo ' fullscreen';}
?>
	<?php echo get_theme_mod( 'portfolio_column_width' ); ?>">

		<?php
		if ( is_tax() ) {

			global $query_string;
			query_posts( "{$query_string}&posts_per_page=-1" );

			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'loop-download' );
			endwhile;
endif;
			wp_reset_postdata();

		} else {

			// LOAD PORTFOLIO QUERY
			$args = array(
				'post_type'      => 'download',
				'order'          => 'DSC',
				'orderby'        => 'menu_order',
				'posts_per_page' => '-1',
			);

			$wp_query = new WP_Query( $args );

			if ( $wp_query->have_posts() ) :
				while ( $wp_query->have_posts() ) :
					$wp_query->the_post();
					get_template_part( 'loop-download' );
			endwhile;
endif;

			wp_reset_postdata();

		} //END else is_tax()
		?>

	</ul><!-- END #masonry-container.main -->

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			var container = document.querySelector('#masonry-container');
			 var msnry;
			 imagesLoaded( container, function() {
				msnry = new Masonry( container, {
					itemSelector: '.masonry-item'
				});
			 });
		});
	</script>

</div><!-- END .row.portfolio -->

<?php
get_footer();
