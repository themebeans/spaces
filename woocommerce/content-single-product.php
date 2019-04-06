<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>

<div class="row fadein">

	<div class="eight columns sidebar-right">

		<div class="entry-content-media">
			<?php woocommerce_show_product_sale_flash(); ?>
			<?php woocommerce_show_product_images(); ?>
		</div><!-- END .entry-content-media -->

		<?php
		if ( post_password_required() ) {
				 echo get_the_password_form();
				 return;
		}
		?>

		<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="four columns meta hide">

				<?php woocommerce_template_single_add_to_cart(); ?>

				<?php
				/**
				 * woocommerce_before_single_product hook
				 *
				 * @hooked wc_print_notices - 10
				 */
				 do_action( 'woocommerce_before_single_product' );
					?>

			</div><!-- END .four.columns -->

			<div class="eight columns">

				<?php woocommerce_template_single_title(); ?>
				<?php woocommerce_template_single_price(); ?>
				<?php woocommerce_template_single_excerpt(); ?>
				<?php woocommerce_template_single_meta(); ?>
				<?php woocommerce_output_product_data_tabs(); ?>

				<div class="mobile-cart">
					<?php woocommerce_template_single_add_to_cart(); ?>
				</div><!-- END .mobile.cart -->

			</div><!-- END .eight.columns -->


			<?php
				/**
				 * woocommerce_before_single_product_summary hook
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				// do_action( 'woocommerce_before_single_product_summary' );
			?>


			<?php
				/**
				 * woocommerce_after_single_product_summary hook
				 *
				 * @hooked woocommerce_output_product_data_tabs - 10
				 * @hooked woocommerce_output_related_products - 20
				 */
				// do_action( 'woocommerce_after_single_product_summary' );
			?>



			<meta itemprop="url" content="<?php the_permalink(); ?>" />

		</div><!-- #product-<?php the_ID(); ?> -->

		<?php do_action( 'woocommerce_after_single_product' ); ?>

	</div><!-- END .eight.columns.sidebar-right -->


	<?php
	$theme_style = get_theme_mod( 'theme_style' );
	if ( $theme_style == 'theme_style_2' ) {
		$theme_style = 'dark'; } else {
		$theme_style = ''; }
	?>

	<?php if ( is_active_sidebar( 'wc-sidebar' ) ) { ?>

		<div class="four columns <?php echo esc_attr( $theme_style ); ?> sidebar">

			<?php dynamic_sidebar( 'wc-sidebar' ); ?>

		</div><!-- END .four.columns.sidebar -->

	<?php } ?>

</div><!-- END .row -->

</div>

<?php woocommerce_related_products(); ?>
