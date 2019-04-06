<?php
/**
 * The template for displaying the portfolio singular page.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

get_header(); ?>

<div class="row">

	<section id="post-<?php the_ID(); ?>" <?php post_class( 'fadein' ); ?>>

		<div class="entry-content-media">
			<?php $image_info = getimagesize( $post->guid ); ?>
			<img src="<?php echo esc_url( $post->guid ); ?>" alt="<?php esc_attr( the_title() ); ?>" title="<?php esc_attr( the_title() ); ?>" <?php echo esc_attr( $image_info[3] ); ?> />
		</div><!-- END .entry-content-media-->

		<div class="entry-content">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<p class="subtext"><?php esc_html_e( 'Uploaded', 'spaces' ); ?> <?php the_time( get_option( 'date_format' ) ); ?></p>
		</div><!-- END .entry-content-->

	</section><!-- END #post-<?php the_ID(); ?> -->

</div><!-- END .row -->

<?php
get_footer();
