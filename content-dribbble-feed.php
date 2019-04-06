<?php
/**
 * The content for grid template files.
 * The following files use the get_template_part function to pull this file:
 * template-dribbble.php
 * template-dribbble-fullwidth.php
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

// TEMPLATE VARIABLES
$full = false;
if ( is_page_template( 'template-dribbble-fullwidth.php' ) ) {
	$full = true; }

// COLUMN SIZE
$portfolio_column_width = get_theme_mod( 'portfolio_column_width' );

// CHECK FOR DRIBBBLE PLUGIN
require_once ABSPATH . 'wp-admin/includes/plugin.php';
if ( is_plugin_active( 'bean-dribbble/bean-dribbble.php' ) ) { ?>

	<div class="row fadein dribbble portfolio
	<?php
	if ( $full == true ) {
		echo ' fullscreen';}
?>
">

		<ul id="portfolio-grid" class="grid
		<?php
		if ( $full == true ) {
			echo ' fullscreen';
		} echo esc_attr( $portfolio_column_width );
?>
">

			<?php
			$dribbble_plugin_settings = get_option( 'bean-dribbble' );

			$dribbble_shots = spaces_get_dribbble_feed(
				$dribbble_plugin_settings['account_name'],
				$dribbble_plugin_settings['access_token']
			);

			$list_item_classes = array(
				'item',
				'grid-item',
				'type-portfolio',
				'masonry-std',
			);

			foreach ( $dribbble_shots as $dribbble_shot ) :
				?>

				<li id="portfolio-<?php echo esc_attr( $dribbble_shot->id ); ?>" class="<?php echo implode( ' ', $list_item_classes ); ?>">

					<div id="post-<?php echo esc_attr( $dribbble_shot->id ); ?>" class="portfolio">

						<a class="entry-link" title="<?php printf( esc_html__( 'Permanent Link to %s', 'spaces' ), $dribbble_shot->title ); ?>" href="<?php echo $dribbble_shot->html_url; ?>" target="_blank"></a>

							<?php
							$image_src = isset( $dribbble_shot->images->hdpi ) &&
							! empty( $dribbble_shot->images->hdpi )
							?
							$dribbble_shot->images->hdpi
							:
							$dribbble_shot->images->normal;
							?>

						<img width="<?php echo esc_attr( $dribbble_shot->width ); ?>" height="<?php echo esc_attr( $dribbble_shot->height ); ?>" src="<?php echo esc_url( $image_src ); ?>">
					</div>
				</li>

			<?php endforeach; ?>

		</ul>

	</div>

<?php } else { // END if (is_plugin_active('bean-dribbble/bean-dribbble.php')) ?>

	<div class="row dribbble-alert">
		<p class="contact-alert"><a href="<?php echo BEAN_DRIBBBLE_PLUGIN_URL; ?>"><?php _e( 'Download and install the Bean Dribbble Plugin, to display your Dribbble feed', 'spaces' ); ?></a></p>
	</div>

<?php
}

