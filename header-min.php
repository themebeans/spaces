<?php
/**
 * The header for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}
	?>
	<?php
	$theme_style = get_theme_mod( 'theme_style' );
	$theme_style = ( 'theme_style_2' === $theme_style ) ? 'dark_style' : null;
	?>

	<div id="theme-wrapper" class="<?php echo esc_attr( $theme_style ); ?>">

		<nav id="mobile-nav" class="show-for-small">

			<?php
			if ( function_exists( 'wp_nav_menu' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'mobile-menu',
					)
				);
			}
			?>

		</nav>

		<div class="row">

			<header id="header" class="min">
				<?php spaces_site_logo(); ?>
			</header>

		</div>
