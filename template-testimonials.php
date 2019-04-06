<?php
/**
 * Template Name: Testimonial Grid
 * The template for displaying the testimonials template.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

get_header();

// PAGE META
$page_title        = get_post_meta( $post->ID, '_bean_page_title', true );
$fullwidth_media   = get_post_meta( $post->ID, '_bean_fullwidth_media', true );
$fullwidth_image   = get_post_meta( $post->ID, '_bean_fullwidth_image', true );
$fullwidth_caption = get_post_meta( $post->ID, '_bean_fullwidth_caption', true );

// ADD CLASS IF NO IMAGE IS UPLOADED
if ( $fullwidth_media == 'on' && $fullwidth_image ) {
	$image = 'full-img';
} else {
	$image = '';
} ?>

<?php if ( $fullwidth_media == 'on' && $fullwidth_image ) { ?>

	<div class="row">

		<section id="post-<?php the_ID(); ?>" <?php post_class( 'fadein' ); ?>>

			<div class="entry-content-media">
				<?php echo '<img src=' . $fullwidth_image . '>'; ?>
				<?php if ( $fullwidth_caption ) { ?>
					<span class="bean-image-caption"><?php echo $fullwidth_caption; ?></span>
				<?php } ?>
			</div><!-- END .entry-content-media -->

		</section><!-- END #post-<?php the_ID(); ?> -->

	</div><!-- END .row -->

<?php
} //END $fullwidth_media == 'on' && $fullwidth_image


// CHECK IF THE BEAN-TESTIMONIALS PLUGIN IS ACTIVE
require_once ABSPATH . 'wp-admin/includes/plugin.php';

if ( is_plugin_active( 'bean-testimonials/bean-testimonials.php' ) ) {
?>

	<div class="row testimonials fadein">

		<?php get_template_part( 'content', 'testimonials' ); ?>

	</div><!-- END .row.testimonials.fadin -->

<?php } else { // IF IT'S NOT, SHOW THIS NOTIFICATION ?>

	<?php if ( is_user_logged_in() ) { ?>
		<h1 class="text-centered"><?php _e( 'Plugin Not Found', 'spaces' ); ?></h1>
		<p class="text-centered"><?php _e( 'It looks like you have not installed or activated the Bean Testimonials plugin.', 'spaces' ); ?></p>
		<p class="text-centered"><?php _e( 'Head to your ', 'spaces' ); ?><a href="<?php echo home_url( '/wp-admin/themes.php?page=install-required-plugins' ); ?>"><?php _e( 'Dashboard', 'spaces' ); ?></a><?php _e( ' to fix this.', 'spaces' ); ?></p>
	<?php } ?>

<?php
}

get_footer();
