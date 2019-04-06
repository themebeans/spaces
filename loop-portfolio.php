<?php
/**
 * The template for displaying the portfolio loop.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

// GENERATE TERMS FOR FILTER PORTFOLIO TEMPLATE
$terms     = get_the_terms( $post->ID, 'portfolio_category' );
$term_list = null;
if ( is_array( $terms ) ) {
	foreach ( $terms as $term ) {
		$term_list .= $term->term_id;
		$term_list .= ' '; }
}
?>

<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>

	<li id="post-<?php the_ID(); ?>" <?php post_class( "$term_list masonry-item filtered" ); ?>>

		<div class="wrap">

			<a class="masonry-link" title="<?php printf( esc_html__( 'Permanent Link to %s', 'spaces' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>"></a>

			<div class="post-thumb">

				<?php the_post_thumbnail( 'post-feat' ); ?>

				<span class="overlay-arrow"></span>

			</div><!-- END .post-thumb -->

			<div class="overlay">

				<div class="post-inner">

					<h1 class="entry-title">
						<a title="<?php printf( esc_html__( 'Permanent Link to %s', 'spaces' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h1>

					<a title="<?php printf( esc_html__( 'Permanent Link to %s', 'spaces' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>">
						<?php
						if ( has_excerpt() ) {
							the_excerpt();
						} else {
												?>
													<p>
													<?php
													$content         = get_the_content();
													$trimmed_content = wp_trim_words( $content, 16, '...' );
													echo esc_html( $trimmed_content );
?>
</p>
						<?php } ?>
					</a>

					<ul class="entry-meta subtext">

						<?php $terms = get_the_terms( $post->ID, 'portfolio_category' ); ?>
						<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
							<li><?php the_terms( $post->ID, 'portfolio_category', '', ', ', '' ); ?></li>
						<?php endif; ?>

						<?php if ( get_theme_mod( 'portfolio_likes' ) == true ) { ?>
							<li><?php spaces_print_likes( $post->ID ); ?></li>
						<?php } //END if get_theme_mod( 'portfolio_likes' ) ?>

						<li><?php edit_post_link( esc_html__( '[Edit]', 'spaces' ), '', '' ); ?></li>

					</ul><!-- END .entry-meta -->

				</div><!-- END .post-inner -->

			</div><!-- END .overlay -->

			<a class="intrinsic-link" href="<?php the_permalink(); ?>"></a>

		</div><!-- END .wrap -->

	</li>

<?php } //END if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) ?>
