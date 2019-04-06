<?php
/**
 * The template for displaying posts in the Quote post format.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

// POST META
$fullwidth_image = get_post_meta( $post->ID, '_bean_fullwidth_image', true );
$link            = get_post_meta( $post->ID, '_bean_link_url', true );
$link_title      = get_post_meta( $post->ID, '_bean_link_title', true );

// USE FEATURED IMAGE OR BACKGROUND COLOR FOR LINK AND QUOTE
$feat_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );

// FALLBACK TO USE THE POST FEATURED IMAGE, IF THERE'S NO FULLWIDTH IMAGE ASSIGNED
if ( $fullwidth_image ) {
	$feat_image = $fullwidth_image;
} else {
	$feat_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
}

if ( $feat_image == true ) {
	$style = 'background-image: url(' . $feat_image . ');';
} else {
	$style = 'background-color: #282828;';
}?>

<div class="entry-content-media fadein">

	<a target="blank" href="<?php echo esc_url( $link ); ?>">
		<div class="vert-align" style='<?php echo $style; ?>'>
			<h2 class="entry-title"><?php echo stripslashes( esc_html( $link_title ) ); ?></h2>
			<span class="subtext"><?php echo stripslashes( esc_html( $link ) ); ?></span>
		</div><!-- END .vert-align -->
	</a>

</div><!-- END .entry-content-media -->

