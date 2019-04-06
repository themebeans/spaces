<?php
/**
 * The template for displaying the post template/grid loop.
 *
 * @package WordPress
 * @subpackage Spaces
 * @author ThemeBeans
 * @since Spaces 1.0
 */

// GENERATE TERMS FOR FILTER
$terms     = get_the_terms( $post->ID, 'category' );
$term_list = null;
if ( is_array( $terms ) ) {
	foreach ( $terms as $term ) {
		$term_list .= $term->slug;
		$term_list .= ' '; }
}

// USE FEATURED IMAGE OR BACKGROUND COLOR FOR LINK AND QUOTE
$feat_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
if ( $feat_image == true ) {
	$style           = 'background-image: url(' . $feat_image . ');';
	$height_fallback = '';
} else {
	$style           = 'background-color: #282828;';
	$height_fallback = 'style="height: 480px;"'; // IF NO IMAGE IS UPLOADED USE THIS HEIGHT INSTEAD
}?>

<li id="post-<?php the_ID(); ?>" <?php post_class( "$term_list grid-item" ); ?>>

	<div class="post-thumb" <?php echo esc_attr( $height_fallback ); ?>>

		<?php
		$format = get_post_format();
		if ( false === $format ) {
			$format = 'standard'; }
			get_template_part( 'inc/post-formats/content', $format );
		?>

	</div><!-- END .post-thumb -->
	<?php

	if ( $format != 'aside' ) { // DONT SHOW THIS ON ASIDE POST FORMAT

			?>
		 <div class="post-content"
			<?php
			if ( $format != 'gallery' ) {
				echo esc_attr( $height_fallback ); }
?>
>

			<div class="post-inner">
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'spaces' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h2><!-- END .entry-title -->

				<?php if ( ! post_password_required() ) { ?>
					<p class="entry-excerpt">
						<?php if ( ! is_search() ) { ?>
							<?php if ( ! has_excerpt() ) { ?>
								<?php echo wp_trim_words( strip_shortcodes( get_the_content() ), 16 ); ?>
							<?php } else { ?>
								<?php echo wp_trim_words( get_the_excerpt(), 16 ); ?>
							<?php } ?>
						<?php } else { ?>
							<?php if ( ! has_excerpt() ) { ?>
								<?php echo wp_trim_words( strip_shortcodes( get_the_content() ), 40 ); ?>
							<?php } else { ?>
								<?php echo wp_trim_words( get_the_excerpt(), 40 ); ?>
							<?php } ?>
						<?php } ?>
					</p><!-- END .entry-excerpt -->
				<?php } else { ?>
					<?php echo get_the_content(); ?>
				<?php } ?>

				<ul class="entry-meta subtext">

					<li><?php the_time( get_option( 'date_format' ) ); ?></li>

					<?php if ( ! is_search() ) { ?>
						<?php if ( ! post_password_required() ) { ?>
							<?php if ( comments_open() ) { ?>
								<li><?php comments_popup_link( __( '0 Comments', 'spaces' ), __( '1 Comment', 'spaces' ), __( '% Comments', 'spaces' ) ); ?></li>
							<?php } ?>
						<?php } else { ?>
							<li><?php _e( 'Protected', 'spaces' ); ?></li>
						<?php } ?>

						<?php if ( get_theme_mod( 'post_likes' ) == true ) { ?>
							<li><?php spaces_print_likes( $post->ID ); ?></li>
						<?php } //END if get_theme_mod( 'post_likes' ) ?>
					<?php } //END !is_search() ?>

					<li><?php edit_post_link( __( '[Edit]', 'spaces' ), '', '' ); ?></li>

				</ul><!-- END .entry-meta -->

			</div><!-- END .post-inner -->

		</div><!-- END .post-content -->

	<?php } //END if( !$format == 'aside' ) { ?>

</li><!-- END #post-<?php the_ID(); ?> -->
