<?php
/**
 * The file for displaying the related portfolio loop below the portfolio single.
 * It is called via the single-portfolio.php.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

// RELATED QUERY
$related_items_count = 9;
$related             = spaces_get_related_posts( $post->ID, 'download_category', array( 'posts_per_page' => $related_items_count ) );
$i                   = 1;
?>

<div class="row fadein more portfolio">

	 <div class="related downloads">

		  <ul id="masonry-container" class="downloads grid more <?php echo get_theme_mod( 'portfolio_column_width' ); ?>">
				<?php
				while ( $related->have_posts() ) :
					$related->the_post();

					get_template_part( 'loop', 'download' );

					$i++;
endwhile;
				wp_reset_postdata();
				?>

		  </ul><!-- END #masonry-container -->

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

	 </div><!-- END .row -->

</div><!-- END .related downloads -->
