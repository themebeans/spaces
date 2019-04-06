<?php
/**
 * The content loop file for download loop.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>

	 <li class="item masonry-item grid-masonry <?php echo esc_attr( $term_list ); ?>">

		  <div id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio' ); ?>>

			   <a class="entry-link" title="<?php printf( esc_html__( 'Permanent Link to Download', 'spaces' ) ); ?>" href="<?php the_permalink(); ?>"></a>

				<?php
				// GRID IMAGE
				$download_grid_image = get_post_meta( $post->ID, '_bean_download_grid_image', true );
				?>

				<?php if ( $download_grid_image ) { ?>
					<img src="<?php echo esc_url( $download_grid_image ); ?>" />
				<?php } else { ?>
					<?php the_post_thumbnail( 'shop-grid' ); ?>
				<?php } ?>

			   <div class="overlay"><h5><?php _e( 'View More', 'spaces' ); ?></h5></div>

		  </div><!-- END .portfolio -->

		  <div class="product-content">

			   <h2><a title="<?php printf( esc_html__( 'Permanent Link to Download', 'spaces' ) ); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

				<?php
				$download_excerpt = get_post_meta( $post->ID, '_bean_download_excerpt', true );

				if ( $download_excerpt ) {
					echo '<p> ' . $download_excerpt . '</p>'; }
				?>

			   <div class="subtext">
					<?php edd_price( $post->ID ); ?>
			   </div><!-- END .subtext -->

			   <div class="product-btn">
					<?php echo do_shortcode( '[purchase_link]' ); ?>
			   </div><!-- END .product-btn -->

		  </div><!-- END .product-content -->

	 </li>

<?php
} //END if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) )
