<?php
/**
 * Custom fonts.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

/**
 * Clean fonts.
 *
 * @param  string|string $font  The font.
 */
function spaces_font_family( $font ) {
	$family = str_replace( ' ', '+', $font );
	return $family;
}

/**
 * Enqueue fonts.
 */
function bean_enqueue_fonts() {

	$default = array(
		'arial',
		'Arial',
		'courier',
		'Courier',
		'default',
		'Default',
		'georgia',
		'Georgia',
		'helvetica',
		'Helvetica',
		'tahoma',
		'Tahoma',
		'times',
		'Times',
		'trebuchet',
		'Trebuchet',
		'verdana',
		'Verdana',
	);

	$fonts = array();

	$type_select_primary_headings   = get_theme_mod( 'type_select_primary_headings' );
	$type_select_secondary_headings = get_theme_mod( 'type_select_secondary_headings' );
	$type_select_body               = get_theme_mod( 'type_select_body' );
	$type_select_logo               = get_theme_mod( 'type_select_logo' );

	if ( $type_select_primary_headings ) {
		$fonts[] = $type_select_primary_headings;
	}
	if ( $type_select_secondary_headings ) {
		$fonts[] = $type_select_secondary_headings;
	}
	if ( $type_select_body ) {
		$fonts[] = $type_select_body;
	}
	if ( $type_select_logo ) {
		$fonts[] = $type_select_logo;
	}

	$fonts = array_unique( $fonts );

	foreach ( $fonts as $font ) {
		if ( ! in_array( $font, $default, true ) ) {
			spaces_enqueue_google_fonts( $font );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'bean_enqueue_fonts' );

/**
 * Enqueue the font.
 *
 * @param  string|string $font  The font.
 */
function spaces_enqueue_google_fonts( $font ) {
	$font = explode( ',', $font );
	$font = $font[0];

	if ( 'Open Sans' === $font ) {
		$font = 'Open Sans:400,600';
	} else {
		$font = $font . ':400,500,700';
	}

	$font = str_replace( ' ', '+', $font );

	wp_enqueue_style( "spaces-google-$font", "https://fonts.googleapis.com/css?family=$font", false, null, 'all' );
}
