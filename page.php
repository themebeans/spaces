<?php
/**
 *  The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

get_header();
spaces_sidebar_loader();

$theme_style       = get_theme_mod( 'theme_style' );
$page_title        = get_post_meta( $post->ID, '_bean_page_title', true );
$fullwidth_media   = get_post_meta( $post->ID, '_bean_fullwidth_media', true );
$fullwidth_image   = get_post_meta( $post->ID, '_bean_fullwidth_image', true );
$fullwidth_caption = get_post_meta( $post->ID, '_bean_fullwidth_caption', true );


if ( 'on' === $fullwidth_media && $fullwidth_image ) {
	$image = 'full-img';
} else {
	$image = '';
} ?>

<div class="row">

	<section id="post-<?php the_ID(); ?>" <?php post_class( 'fadein' ); ?>>

		<?php if ( 'on' === $fullwidth_media && $fullwidth_image ) { ?>

			<div class="entry-content-media">
				<?php echo '<img src=' . esc_url( $fullwidth_image ) . '>'; ?>
				<?php if ( $fullwidth_caption ) { ?>
					<span class="bean-image-caption"><?php echo esc_html( $fullwidth_caption ); ?></span>
				<?php } ?>
			</div>

		<?php } ?>

		<div class="<?php echo esc_attr( $bean_content_class ); ?> <?php echo esc_attr( $image ); ?>">

			<div class="entry-content">

				<?php
				if ( 'on' === $page_title ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
				}

				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;

				wp_link_pages(
					array(
						'before' => '<div class="page-link"><span>' . esc_html__( 'Pages:', 'spaces' ) . '</span>',
						'after'  => '</div>',
					)
				);
				?>

			</div>

		</div>

		<?php
		if ( 'right' === $bean_sidebar_location ) {

			if ( 'theme_style_2' === $theme_style ) {
				$theme_style = 'dark'; } else {
				$theme_style = ''; }
			?>

			<div class="<?php echo esc_attr( $bean_sidebar_class ); ?> <?php echo esc_attr( $theme_style ); ?>">
				<?php dynamic_sidebar( 'internal-sidebar' ); ?>
			</div>
		<?php } ?>

	</section>

</div>

<?php
get_footer();
