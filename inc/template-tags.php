<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

if ( ! function_exists( 'spaces_site_logo' ) ) :
	/**
	 * Output an <img> tag of the site logo.
	 */
	function spaces_site_logo() {

		do_action( 'spaces_before_site_logo' );

		if ( has_custom_logo() ) {
			echo '<div class="site-logo" itemscope itemtype="http://schema.org/Organization">';
				the_custom_logo();
			echo '</div>';
		} else {
			printf( '<h1 class="site-title logo_text" itemscope itemtype="http://schema.org/Organization"><a href="%1$s" rel="home" itemprop="url">%2$s</a></h1>', esc_url( home_url( '/' ) ), esc_html( get_bloginfo( 'name' ) ) );
		}

		do_action( 'spaces_after_site_logo' );
	}

endif;
