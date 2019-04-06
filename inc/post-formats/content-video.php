<?php
/**
 * The template for displaying posts in the Video post format.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

$embed             = get_post_meta( $post->ID, '_bean_video_embed', true );
$video_embed_url   = get_post_meta( $post->ID, '_bean_video_embed_url', true );
$fullwidth_image   = get_post_meta( $post->ID, '_bean_fullwidth_image', true );
$fullwidth_caption = get_post_meta( $post->ID, '_bean_fullwidth_caption', true );

$feat_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
?>

<?php if ( is_singular() ) { ?>

	<div class="entry-content-media fadein">

		<?php if ( $fullwidth_image ) { ?>

			<div class="entry-content-media">
				<?php echo '<img src=' . $fullwidth_image . '>'; ?>
				<?php if ( $fullwidth_caption ) { ?>
					<span class="bean-image-caption"><?php echo $fullwidth_caption; ?></span>
				<?php } ?>
			</div><!-- END .entry-content-media -->

		<?php
} else { // END  if ($fullwidth_image)

	if ( ! empty( $embed ) ) {
		echo "<div class='video-frame'>";
			echo stripslashes( htmlspecialchars_decode( $embed ) );
		echo '</div>';
	}
}
		?>

	</div><!-- END .entry-content-media -->

<?php } else {

	echo '<div class="entry-content-media">';
		echo '<a class="lightbox fancybox.iframe" href="' . $video_embed_url . '">';
			echo '<span class="lightbox-play"></span>';
			echo '<img src=' . $feat_image . '>';
		echo '</a>';
	echo '</div>';

} ?>
