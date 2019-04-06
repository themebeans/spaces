<?php
/**
 * Template Name: Post Archives
 * The template for displaying the post archives template.
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
				<?php echo '<img src=' . esc_url( $fullwidth_image ) . '>'; ?>
				<?php if ( $fullwidth_caption ) { ?>
					<span class="bean-image-caption"><?php echo esc_html( $fullwidth_caption ); ?></span>
				<?php } ?>
			</div><!-- END .entry-content-media -->

		<?php } //END $fullwidth_media == 'on' && $fullwidth_image ?>

		<div class="<?php echo esc_attr( $bean_content_class ); ?>  <?php echo esc_attr( $image ); ?>">

			<div class="entry-content">

				<?php
				if ( $page_title == 'on' ) {
				?>
				<h1 class="entry-title"><?php the_title( '' ); ?></h1><?php } ?>

				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
				?>

				<div class="archives-list">

					<h6><?php _e( 'Last 30 Posts', 'spaces' ); ?></h6>

					<ul>
						<?php
						$archive_30 = get_posts( 'numberposts=30' );
						foreach ( $archive_30 as $post ) :
						?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						<?php endforeach; ?>
					</ul>

					<h6><?php _e( 'Archives by Month', 'spaces' ); ?></h6>

					<ul><?php wp_get_archives( 'type=monthly' ); ?></ul>

					<h6><?php _e( 'Archives by Category ', 'spaces' ); ?></h6>

					<ul><?php wp_list_categories( 'title_li=' ); ?></ul>

				</div><!-- END .archives-list -->

				<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-link"><span>' . esc_html__( 'Pages:', 'spaces' ) . '</span>',
						'after'  => '</div>',
					)
				);

				wp_reset_query();
				?>

				<?php comments_template( '', true ); ?>

			</div>

		</div>

		<?php
		if ( $bean_sidebar_location === 'right' ) {
			// SIDEBAR STYLE
			$theme_style = get_theme_mod( 'theme_style' );
			if ( $theme_style == 'theme_style_2' ) {
				$theme_style = 'dark'; } else {
				$theme_style = ''; }
			?>

			<div class="<?php echo esc_attr( $bean_sidebar_class ); ?> <?php echo esc_attr( $theme_style ); ?>">
				<?php dynamic_sidebar( 'internal-sidebar' ); ?>
			</div><!-- END $bean_sidebar_class -->
		<?php } // END $bean_sidebar_location === 'right' ?>

	</section>

</div><!-- END .row -->

<?php
get_footer();
