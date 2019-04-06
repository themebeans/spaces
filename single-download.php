<?php
/**
 * The template for displaying the single download page for EDD.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

get_header();

spaces_set_post_views( get_the_ID() );

$format          = get_post_format();
$fullwidth_media = get_post_meta( $post->ID, '_bean_fullwidth_media', true );
$fullwidth_image = get_post_meta( $post->ID, '_bean_fullwidth_image', true );
$link            = get_post_meta( $post->ID, '_bean_link_url', true );
$quote           = get_post_meta( $post->ID, '_bean_quote', true );
$quote_source    = get_post_meta( $post->ID, '_bean_quote_source', true );
$embed           = get_post_meta( $post->ID, '_bean_video_embed', true );
$orderby         = get_post_meta( $post->ID, '_bean_post_randomize', true );
$orderby         = ( 'off' === $orderby ) ? 'post__in' : 'rand';
$theme_style     = get_theme_mod( 'theme_style' );
?>

<div class="row">

	<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="eight columns sidebar-right">

			<?php
			if ( have_posts() ) :

				while ( have_posts() ) :

					the_post();
					?>

					<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>
						<div class="entry-content-media">
							<?php the_post_thumbnail( 'shop-feat' ); ?>
						</div>
					<?php } ?>

					<div class="four columns meta hide">

						<?php echo do_shortcode( '[purchase_link]' ); ?>

					</div>

					<div class="eight columns">

						<div class="subtext">
							<?php edd_price( $post->ID ); ?>
						</div>

						<article class="entry-content">

							<h1 class="entry-title"><?php the_title(); ?></h1>

							<?php the_content(); ?>

							<?php get_template_part( 'content', 'download-meta' ); ?>

						</article><!-- END .entry-content -->

						<div class="mobile-cart">
							<?php echo do_shortcode( '[purchase_link]' ); ?>
						</div><!-- END .mobile.cart -->

					</div>

				<?php
				endwhile;
			endif;
			?>

		</div>

		<?php
		if ( 'theme_style_2' === $theme_style ) {
			$theme_style = 'dark'; } else {
			$theme_style = ''; }
		?>

		<div class="four columns <?php echo esc_attr( $theme_style ); ?> sidebar">

			<?php dynamic_sidebar( 'edd-sidebar' ); ?>

		</div>

	</section>

</div>

<?php
$terms = get_the_terms( $post->ID, 'download_category' );
if ( $terms && ! is_wp_error( $terms ) ) :
	get_template_part( 'content', 'downloads-related' );
endif;

get_footer();
