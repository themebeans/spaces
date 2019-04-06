/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. This javascript will grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */

( function( $ ) {

	//LIVE HTML
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '.logo_text' ).html( newval );
		} );
	} );

	wp.customize( 'footer_alt_text', function( value ) {
		value.bind( function( newval ) {
			$( '.alt-text p' ).html( newval );
		} );
	} );

	wp.customize( 'contact_button_text', function( value ) {
		value.bind( function( newval ) {
			$( '.bean-contactform li.submit .button' ).html( newval );
		} );
	} );

	wp.customize( 'custom_logo_max_width', function( value ) {
		value.bind( function( newval ) {
			var style, el;
			style = '<style class="custom_logo_max_width">@media screen and (min-width: 769px) { body.logged-in .custom-logo-link img.custom-logo { width:' + newval + 'px; } }</style>';

			el =  $( '.custom_logo_max_width' );

			if ( el.length ) {
				el.replaceWith( style ); // style element already exists, so replace it
			} else {
				$( 'head' ).append( style ); // style element doesn't exist so add it
			}
		} );
	} );

	wp.customize( 'custom_logo_mobile_max_width', function( value ) {
		value.bind( function( newval ) {
			var style, el;
			style = '<style class="custom_logo_mobile_max_width">@media screen and (max-width: 768px) { body.logged-in .custom-logo-link img.custom-logo { width:' + newval + 'px; } }</style>';

			el =  $( '.custom_logo_mobile_max_width' );

			if ( el.length ) {
				el.replaceWith( style ); // style element already exists, so replace it
			} else {
				$( 'head' ).append( style ); // style element doesn't exist so add it
			}
		} );
	} );

} )( jQuery );
