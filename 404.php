<?php
/**
 * The template for displaying the 404 error page
 * This page is set automatically, not through the use of a template
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

get_header(); ?>

<div class="row">

	<div class="entry-content">

		<div class="error-logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( bloginfo( 'name' ) ); ?>" rel="home">
			<?php if ( get_theme_mod( '404-img-upload' ) ) { ?>
				<img src="<?php echo esc_url( get_theme_mod( '404-img-upload' ) ); ?>"/>
			<?php } else { ?>
				<img src="<?php echo esc_url( get_template_directory_uri( '/assets/images/404.png' ) ); ?>">
			<?php } ?>
			</a>
		</div>

		<p class="title"><?php echo esc_html( get_theme_mod( 'error_text' ) ); ?></p>

		<p>&larr; <a href="javascript:javascript:history.go(-1)"><?php esc_html_e( 'Go Back', 'spaces' ); ?></a><?php esc_html_e( ' or ', 'spaces' ); ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go Home', 'spaces' ); ?></a> &rarr;</p>

	</div>

</div>

<?php
get_footer();
