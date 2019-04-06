<?php
/**
 * Enqueues front-end CSS for Customizer options.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

/**
 * Set the Custom CSS via Customizer options.
 */
function spaces_customizer_css() {

	$wrapper_background_color       = get_theme_mod( 'wrapper_background_color', '#FFF' );
	$theme_accent_color             = get_theme_mod( 'theme_accent_color', '#1AA8D8' );
	$type_select_logo               = get_theme_mod( 'type_select_logo' );
	$logo_size                      = get_theme_mod( 'type_slider_logo_size' );
	$logo_lineheight                = get_theme_mod( 'type_slider_logo_lineheight' );
	$logo_letterspacing             = get_theme_mod( 'type_slider_logo_letterspacing' );
	$type_select_primary_headings   = get_theme_mod( 'type_select_primary_headings' );
	$type_select_secondary_headings = get_theme_mod( 'type_select_secondary_headings' );
	$type_select_body               = get_theme_mod( 'type_select_body' );
	$type_select_body_sec           = get_theme_mod( 'type_select_body_sec' );
	$logo_maxwidth                  = get_theme_mod( 'custom_logo_max_width', 50 );
	$logo_mobilemaxwidth            = get_theme_mod( 'custom_logo_mobile_max_width', 50 );
	?>
<style>
<?php
$customizations                     =
'

@media screen and (max-width: 768px) {
    body .custom-logo-link img.custom-logo {
        width: ' . esc_attr( $logo_mobilemaxwidth ) . 'px;
    }
}

@media screen and (min-width: 769px) {
    body .custom-logo-link img.custom-logo {
        width: ' . esc_attr( $logo_maxwidth ) . 'px;
    }
}

body,
#theme-wrapper { background-color:' . $wrapper_background_color . '!important; }

a { color:' . $theme_accent_color . '; }
.cats,
p a:hover,
h1 a:hover,
blockquote,
.author-tag,
.reset_variations:hover,
.a-link:hover,
.widget a:hover,
.logo a h1:hover,
.widget li a:hover,
#filter li a.active,
#filter li a.hover,
.entry-meta a:hover,
.pagination a:hover,
header ul li a:hover,
footer ul li a:hover,
.single-price .price,
.entry-title a:hover,
.comment-meta a:hover,
h2.entry-title a:hover,
.single-download .edd_price,
li.current-menu-item a,
.comment-author a:hover,
.products li h2 a:hover,
.entry-link a.link:hover,
.team-content h3 a:hover,
.archives-list li a:hover,
.site-description a:hover,
.bean-tabs > li.active > a,
.bean-panel-title > a:hover,
.grid-item .entry-meta a:hover,
.bean-tabs > li.active > a:hover,
.bean-tabs > li.active > a:focus,
#cancel-comment-reply-link:hover,
.shipping-calculator-button:hover,
.single-product ul.tabs li a:hover,
.grid-item.post .entry-meta a:hover,
.single-product ul.tabs li.active a,
.single-portfolio .sidebar-right a.url,
.grid-item.portfolio .entry-meta a:hover,
.portfolio.grid-item span.subtext a:hover,
.sidebar .widget_bean_tweets .button:hover,
.entry-content .portfolio-social li a:hover,
header ul > .sfHover > a.sf-with-ul,
.product-content h2 a:hover,
.single-portfolio .portfolio-social .bean-likes:hover,
.hidden-sidebar.dark .widget_bean_tweets .button:hover,
.entry-content .wp-playlist-dark .wp-playlist-playing .wp-playlist-caption,
.entry-content .wp-playlist-light .wp-playlist-playing .wp-playlist-caption,
.entry-content .wp-playlist-dark .wp-playlist-playing .wp-playlist-item-title,
.entry-content .wp-playlist-light .wp-playlist-playing .wp-playlist-item-title { color:' . $theme_accent_color . '!important; }

.onsale,
.new-tag,
.bean-btn,
.bean-shot,
.type-team,
.btn:hover,
#place_order,
.button:hover,
nav a h1:hover,
div.jp-play-bar,
.tagcloud a:hover,
.bean-image-caption,
.pagination a:hover,
.flickr_badge_image,
.after-post h6:hover,
.edd_checkout a:hover,
#fancybox-loading div,
div.jp-volume-bar-value,
.edd-submit.button:hover,
.avatar-list li a.active,
.edd-submit.button:hover,
.dark_style .pagination a,
.btn[type="submit"]:hover,
input[type="reset"]:hover,
input[type="button"]:hover,
#edd-purchase-button:hover,
input[type="submit"]:hover,
.button[type="submit"]:hover,
#load-more:hover .overlay h5,
.sidebar-btn .menu-icon:hover,
.pagination .page-portfolio a,
#theme-wrapper .edd-submit.button,
.widget .buttons .checkout.button,
.side-menu .sidebar-btn .menu-icon,
.dark_style .sidebar-btn .menu-icon,
input[type=submit].edd-submit.button,
.comment-form-rating p.stars a.active,
.dark_style .masonry-item .overlay-arrow,
.hidden-sidebar.sidebar.dark .tagcloud a,
.comment-form-rating p.stars a.active:hover,
table.cart td.actions .checkout-button.button,
#edd_checkout_wrap #edd_purchase_submit .edd-submit.button,
.entry-content .mejs-controls .mejs-time-rail span.mejs-time-current { background-color:' . $theme_accent_color . '; }

.entry-content .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current { background:' . $theme_accent_color . '; }

textarea:focus,
.pagination a:hover,
input[type="tel"]:focus,
input[type="url"]:focus,
input[type="text"]:focus,
input[type="date"]:focus,
input[type="time"]:focus,
input[type="email"]:focus,
input[type="number"]:focus,
input[type="search"]:focus,
input[type="password"]:focus,
input[type="datetime"]:focus,
.single-product .price ins,
.single-product ul.tabs li.active a { border-color:' . $theme_accent_color . '!important; }

.bean-btn { border: 1px solid ' . $theme_accent_color . '!important; }

.bean-quote,
.instagram_badge_image,
.bean500px_badge_image,
.products li a.added_to_cart,
.single_add_to_cart_button.button,
.dark_style.side-menu .sidebar-btn .menu-icon:hover { background-color:' . $theme_accent_color . '!important; }
';

$css_filter_style = get_theme_mod( 'portfolio_css_filter' );
if ( $css_filter_style != '' ) {
	switch ( $css_filter_style ) {
		case 'none':
			// DO NOTHING
			break;
		case 'grayscale':
			echo '.page-template #masonry-container li img, .page-template #portfolio-grid li img, #portfolio-grid.more li img { filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); filter:gray; -webkit-filter:grayscale(100%);-moz-filter: grayscale(100%);-o-filter: grayscale(100%);}';
			break;
		case 'sepia':
			echo '.page-template #masonry-container li img, .page-template #portfolio-grid li img, #portfolio-grid.more li img { -webkit-filter: sepia(50%); }';
			break;
		case 'saturation':
			 echo '.page-template #masonry-container li img, .page-template #portfolio-grid li img, #portfolio-grid.more li img { -webkit-filter: saturate(150%); }';
			break;
	}
}

$page_text_align = get_post_meta( get_the_ID(), '_bean_page_text_align', true );
if ( $page_text_align ) {
	echo '.entry-content {text-align:' . $page_text_align . '!important;}';
}

include_once ABSPATH . 'wp-admin/includes/plugin.php'; if ( is_plugin_active( 'bean-pricingtables/bean-pricingtables.php' ) ) {
	echo '.bean-pricing-table .pricing-column li span {color:' . $theme_accent_color . '!important;}#powerTip,.bean-pricing-table .pricing-highlighted{background-color:' . $theme_accent_color . '!important;}#powerTip:after {border-color:' . $theme_accent_color . ' transparent!important; }';
}

if ( $type_select_primary_headings != 'default' ) {

	$headings_output = 'h1, h5 { font-family: ' . $type_select_primary_headings . '!important; }';

} else {
	$headings_output = ''; }

if ( $type_select_secondary_headings != 'default' ) {

	$headings_sec_output = '
		.onsale,
		.tagcloud a,
		.bean-tabs a,
		h3#reply-title,
		.products li h5,
		h6.widget-title,
		.testimonial h1 p,
		h6.comments-title,
		.archives-list h6,
		#author-wrapper h6,
		.bean-image-caption,
		.woocommerce table th,
		.bean-panel-title > a,
		.type-team .overlay h4,
		.crsl-item .overlay h5,
		#load-more .overlay h5,
		.bean-coming-soon .count,
		.bean-tabs > li.active > a,
		.slides-container .overlay h1,
		#portfolio-grid li .overlay h5,
		.home-slider-mobile li .overlay h3,
		.home-portfolio-fullwidth .overlay h1,
		.masonry-item .overlay .post-inner h1,
		.widget_bean_portfolio li .overlay h5,
		li.masonry-item.grid-masonry .overlay h5,
		.bean-pricing-table .table-mast h5.title { font-family: ' . $type_select_secondary_headings . '!important; }';

} else {
	$headings_sec_output = '';
}

if ( 'default' !== $type_select_body ) {

	$body_output =
	'p,
		body,
		.btn,
		h1, h5,
		.button,
		textarea,
		.rss-date,
		.viewer .caption,
		input[type="tel"],
		input[type="url"],
		input[type="text"],
		input[type="date"],
		input[type="time"],
		input[type="email"],
		.btn[type="submit"],
		input[type="reset"],
		input[type="number"],
		.comment-author span,
		.comment-author cite,
		#wp-calendar caption,
		input[type="search"],
		input[type="button"],
		input[type="submit"],
		input[type="password"],
		input[type="datetime"],
		.button[type="submit"],
		.reveal h3#reply-title,
		.reveal h6.comments-title,
		.reveal #author-wrapper h6,
		#cancel-comment-reply-link,
		.home-slide a.post-edit-link,
		.single-portfolio .edge .bean-image-caption,
		.entry-content .wp-playlist-item-length,
		.widget_bean_tweets a.twitter-time-stamp,
		.bean-pricing-table .table-mast h5.title,
		#edd_checkout_form_wrap select.edd-select,
		.bean-pricing-table .table-mast h6.price,
		.bean-pricing-table, .bean-pricing-table .table-mast p { font-family: ' . $type_select_body . '!important; }';
} else {
	$body_output = '';
}

$custom_fonts_output = 'h1.logo_text { font-size: ' . $logo_size . 'px!important; line-height: ' . $logo_lineheight . 'px!important; letter-spacing: ' . $logo_letterspacing . 'px!important; } ';

if ( 'default' !== $type_select_logo ) {
	$logo_output = 'h1.logo_text { font-family: ' . $type_select_logo . '!important; }';
} else {
	$logo_output = '';
}

$customfonts = $logo_output . $custom_fonts_output . $body_output . $headings_sec_output . $headings_output;

$customizer_final_output = $customfonts . $customizations;

$final_output = preg_replace( '#/\*.*?\*/#s', '', $customizer_final_output );
$final_output = preg_replace( '/\s*([{}|:;,])\s+/', '$1', $final_output );
$final_output = preg_replace( '/\s\s+(.*)/', '$1', $final_output );

echo $final_output;
?>
</style>
<?php
}
add_action( 'wp_head', 'spaces_customizer_css', 1 );
