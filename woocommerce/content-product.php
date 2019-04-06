<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class(); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

		<div class="portfolio">

			<a class="entry-link" title="<?php printf( esc_html__( 'Permanent Link to %s', 'spaces' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>"></a>

			<?php

			// SALE BADGE
			wc_get_template( 'loop/sale-flash.php' );

			// GRID IMAGE
			$product_grid_image = get_post_meta( $post->ID, '_bean_product_grid_image', true );
			?>

			<?php if ( $product_grid_image ) { ?>
				<img src="<?php echo $product_grid_image; ?>" />
			<?php } else { ?>
				<?php the_post_thumbnail( 'shop-grid' ); ?>
			<?php } ?>

			<div class="overlay">
				<h5><?php _e( 'View More', 'spaces' ); ?></h5>
			</div>

		</div><!-- END .portfolio -->

		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			// do_action( 'woocommerce_before_shop_loop_item_title' );
		?>

	<div class="product-content">

		<h2><a title="<?php printf( esc_html__( 'Permanent Link to %s', 'spaces' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

		<?php
		$product_excerpt = get_post_meta( $post->ID, '_bean_product_excerpt', true );

		if ( $product_excerpt ) {
			echo '<p> ' . $product_excerpt . '</p>'; }
		?>

		<div class="subtext">
			<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_rating - 5
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?>

		</div><!-- END .subtext -->

		<div class="product-btn">
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
		</div><!-- END .product-btn -->

	</div><!-- END .product-content -->

</li>
