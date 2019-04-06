<?php
/**
 * The sidebar containing the hidden sidebar widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

$theme_style = get_theme_mod( 'theme_style' );
if ( $theme_style == 'theme_style_2' ) {
	$theme_style = ''; } else {
	$theme_style = 'dark'; }
?>

<div class="hidden-sidebar <?php echo esc_attr( $theme_style ); ?> sidebar">

	<div class="hidden-sidebar-inner">

		<?php dynamic_sidebar( 'hidden-sidebar' ); ?>

	</div><!-- END .hidden-sidebar-inner -->

</div><!-- END .hidden-sidebar -->
