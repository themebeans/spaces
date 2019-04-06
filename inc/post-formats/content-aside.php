<?php
/**
 * The default template for displaying content for the standard post.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

// POST META
$fullwidth_image   = get_post_meta( $post->ID, '_bean_fullwidth_image', true );
$fullwidth_caption = get_post_meta( $post->ID, '_bean_fullwidth_caption', true );

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
} ?>

<div class="entry-content-media fadein">

	<?php if ( ! is_singular() ) { ?>
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'spaces' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
	<?php } ?>

		<div class="vert-align" style='<?php echo $style; ?>'>
			<?php the_content(); ?>
		</div><!-- END .vert-align -->

		<?php if ( $fullwidth_caption ) { ?>
			<span class="bean-image-caption"><?php echo $fullwidth_caption; ?></span>
		<?php } ?>

	<?php
	if ( ! is_singular() ) {
		echo '</a>'; }
?>

</div><!-- END .entry-content-media -->
