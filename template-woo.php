<?php
/**
 * Template Name: Woo Default
 * The template for displaying the WooCommerce templates.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

get_header();
spaces_sidebar_loader();

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

<div class="row">

	<section id="post-<?php the_ID(); ?>" <?php post_class( 'fadein' ); ?>>

		<?php if ( $fullwidth_media == 'on' && $fullwidth_image ) { ?>

			<div class="entry-content-media">
				<?php echo '<img src=' . $fullwidth_image . '>'; ?>
				<?php if ( $fullwidth_caption ) { ?>
					<span class="bean-image-caption"><?php echo $fullwidth_caption; ?></span>
				<?php } ?>
			</div><!-- END .entry-content-media -->

		<?php } //END $fullwidth_media == 'on' && $fullwidth_image ?>

		<div class="<?php echo esc_attr( $bean_content_class ); ?> <?php echo esc_attr( $image ); ?>">

			<?php
			if ( $page_title == 'on' ) {
?>
<h1 class="entry-title"><?php the_title( '' ); ?></h1><?php } ?>

			<div class="entry-content">

				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
endwhile; // THE LOOP
?>

				<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-link"><span>' . esc_html__( 'Pages:', 'spaces' ) . '</span>',
						'after'  => '</div>',
					)
				);
?>

			</div><!-- END .entry-content -->

		</div><!-- END <?php echo esc_attr( $bean_content_class ); ?> -->

		<?php
		if ( $bean_sidebar_location === 'right' ) {
			// SIDEBAR STYLE
			$theme_style = get_theme_mod( 'theme_style' );
			if ( $theme_style == 'theme_style_2' ) {
				$theme_style = 'dark'; } else {
				$theme_style = ''; }
			?>

			<div class="<?php echo esc_attr( $bean_sidebar_class ); ?> <?php echo esc_attr( $theme_style ); ?>">
				<?php dynamic_sidebar( 'wc-sidebar' ); ?>
			</div><!-- END $bean_sidebar_class -->
		<?php } // END $bean_sidebar_location === 'right' ?>

	</section><!-- END #post-<?php the_ID(); ?> -->

</div><!-- END .row -->

<?php
get_footer();
