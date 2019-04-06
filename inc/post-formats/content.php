<?php
/**
 * The template for displaying posts in the standard post format.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

$fullwidth_image   = get_post_meta( $post->ID, '_bean_fullwidth_image', true );
$fullwidth_caption = get_post_meta( $post->ID, '_bean_fullwidth_caption', true );

if ( is_singular() ) { ?>

	<?php if ( $fullwidth_image ) { ?>

		<div class="entry-content-media fadein">
			<?php echo '<img src=' . $fullwidth_image . '>'; ?>
			<?php if ( $fullwidth_caption ) { ?>
				<span class="bean-image-caption"><?php echo $fullwidth_caption; ?></span>
			<?php } ?>
		</div><!-- END .entry-content-media -->

	<?php } //END  if ($fullwidth_image) ?>

<?php } else { ?>

	<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>
		<a title="<?php printf( esc_html__( 'Permanent Link to %s', 'spaces' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'post-feat' ); ?>
		</a>
	<?php } ?>

<?php
}
