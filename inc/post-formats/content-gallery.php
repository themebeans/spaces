<?php
/**
 * The template for displaying posts in the gallery post format.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

$fullwidth_image   = get_post_meta( $post->ID, '_bean_fullwidth_image', true );
$fullwidth_caption = get_post_meta( $post->ID, '_bean_fullwidth_caption', true );
$orderby           = get_post_meta( $post->ID, '_bean_post_randomize', true );
$orderby           = ( 'off' === $orderby ) ? 'post__in' : 'rand';

if ( is_singular() ) {

	if ( $fullwidth_image ) {
	?>

		<div class="entry-content-media fadein">

			<?php echo '<img src=' . esc_url( $fullwidth_image ) . '>'; ?>

			<?php if ( $fullwidth_caption ) { ?>
				<span class="bean-image-caption"><?php echo esc_html( $fullwidth_caption ); ?></span>
			<?php } ?>

		</div>

	<?php
	}
} else {

	spaces_gallery( $post->ID, '', 'slider', $orderby, true );

}
