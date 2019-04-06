<?php
/**
 * The template for displaying all single posts.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

get_header();

spaces_set_post_views( get_the_ID() );

$format = get_post_format();

$fullwidth_media = get_post_meta( $post->ID, '_bean_fullwidth_media', true );
$fullwidth_image = get_post_meta( $post->ID, '_bean_fullwidth_image', true );
$link            = get_post_meta( $post->ID, '_bean_link_url', true );
$quote           = get_post_meta( $post->ID, '_bean_quote', true );
$quote_source    = get_post_meta( $post->ID, '_bean_quote_source', true );
$embed           = get_post_meta( $post->ID, '_bean_video_embed', true );
$orderby         = get_post_meta( $post->ID, '_bean_post_randomize', true );
$orderby         = ( $orderby == 'off' ) ? 'post__in' : 'rand';

if ( get_theme_mod( 'reveal_content' ) == true ) {
	$reveal_content = 'reveal';
} else {
	$reveal_content = ''; }
?>

<div class="row">

	<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
?>

			<?php
			$format = get_post_format();
			if ( false === $format ) {
				$format = 'standard'; }

			if ( $fullwidth_media == 'on' ) {
				get_template_part( 'inc/post-formats/content', $format );
			}
			?>

			<div class="two columns meta">
				<?php get_template_part( 'content', 'post-meta' ); ?>
			</div><!-- END .two.columns -->

			<div class="six columns sidebar-right <?php echo esc_attr( $reveal_content ); ?>">

				<article class="entry-content">

					<?php if ( ! $fullwidth_image && $format != 'video' && $format != 'gallery' ) { ?>
						<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>
							<?php the_post_thumbnail( 'post-feat' ); ?>
						<?php } //END  if(has_post_thumbnail) ?>
					<?php } //END (!$fullwidth_image) ?>

					<h1 class="entry-title"><?php the_title(); ?></h1>

					<?php if ( $format == 'gallery' ) { ?>

						<?php if ( has_excerpt() ) { ?>
							<div class="excerpt">
								<?php the_excerpt(); ?>
							</div><!-- END .excerpt -->
						<?php } ?>

						<?php spaces_gallery( $post->ID, '', 'slider', $orderby, true ); ?>

					<?php } //END  if( $format == 'gallery' ) ?>

					<?php if ( $format == 'video' && $fullwidth_media == 'on' && $fullwidth_image or $fullwidth_media == 'off' ) { ?>

						<?php if ( has_excerpt() ) { ?>
							<div class="excerpt">
								<?php the_excerpt(); ?>
							</div><!-- END .excerpt -->
						<?php } ?>

						<?php
						if ( ! empty( $embed ) ) {
							echo "<div class='video-frame'>";
								echo stripslashes( htmlspecialchars_decode( $embed ) );
							echo '</div>';
						}
						?>

					<?php } //END  if( $format == 'video' ) ?>

								<?php if ( $format == 'audio' && $fullwidth_media == 'off' ) { ?>

						<div class="entry-content-audio">

							<?php bean_audio( $post->ID ); ?>

						</div><!-- END .entry-content-audio -->

					<?php } //END  if( $format == 'audio' ) ?>

								<?php if ( $format == 'link' && $fullwidth_media == 'off' ) { ?>

						<a class="a-link subtext" target="blank" href="<?php echo esc_url( $link ); ?>"><?php echo stripslashes( esc_html( $link ) ); ?></a>

					<?php } //END  if( $format == 'link' ) ?>

								<?php if ( $format == 'quote' && $fullwidth_media == 'off' ) { ?>

						<div class="entry-content-quote">
							<h4 class="p-quote"><?php echo stripslashes( esc_html( $quote ) ); ?></h4>
							<span class="subtext"><?php echo stripslashes( esc_html( $quote_source ) ); ?></span>
						</div><!-- END .entry-content-quote -->

					<?php } //END  if( $format == 'quote' ) ?>

								<?php if ( $format == 'image' && $fullwidth_media == 'off' ) { ?>

						<div class="entry-content-media lb-feat">

							<?php spaces_gallery( $post->ID, '', 'post-lightbox', $orderby, true ); ?>

						</div><!-- END .entry-content-media -->

					<?php } //END  if( $format == 'audio' ) ?>

								<?php the_content(); ?>

								<?php if ( get_theme_mod( 'post_sharing' ) == true ) { ?>
						<?php get_template_part( 'content', 'portfolio-social' ); ?>
					<?php } ?>

							</article><!-- END .entry-content -->

							<?php
							// PAGE LINK
							wp_link_pages(
								array(
									'before'         => '<p><strong>' . esc_html__( 'Pages:', 'spaces' ) . '</strong> ',
									'after'          => '</p>',
									'next_or_number' => 'number',
								)
							);
							?>

							<?php
							if ( ! post_password_required() ) {
								if ( get_theme_mod( 'reveal_content' ) == true ) {
								?>
									<div class="after-post">

										<?php if ( get_theme_mod( 'about_author' ) == true ) { ?>
								<div class="btn author-btn"><span class="icon"></span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'display_name' ); ?></a></div>
							<?php } ?>

							<?php
							if ( get_comments_number() != 0 ) {
?>
<div class="btn comments-btn"><span class="icon"></span><a href="<?php comments_link(); ?>"><?php _e( 'View Comments', 'spaces' ); ?></a></div><?php } ?>
						</div><!-- END .after-post -->
					<?php } ?>

					<?php if ( get_theme_mod( 'about_author' ) == true ) { ?>

						<div id="author-wrapper">

							<h6><?php _e( 'Author', 'spaces' ); ?></h6>

							<div class="fadein">

								<?php echo get_avatar( get_the_author_meta( 'user_email' ), '80', '' ); ?>

								<h3 class="title"><?php _e( 'About the Author', 'spaces' ); ?></h3>
								<p>
									<?php
									if ( get_the_author_meta( 'description' ) ) {
										the_author_meta( 'description' ); } else {
?>

																			<?php
																			_e( 'This author has not added a biography just yet. Meanwhile ', 'spaces' );
																			the_author_meta( 'display_name' );
																			_e( ' has contributed ', 'spaces' );
																			the_author_posts();
																			_e( ' posts. ', 'spaces' );
?>
<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php _e( 'Click here', 'spaces' ); ?></a><?php _e( ' to view them.', 'spaces' ); ?>

									<?php } // END if get_the_author_meta('description') ?>
								</p>

							</div><!-- END .fadein-->

						</div><!-- END .about-author -->

					<?php
}

	comments_template( '', true );
							}
							?>

						</div>

					<?php
		endwhile;
endif;
?>

		<?php
		$theme_style = get_theme_mod( 'theme_style' );
		if ( $theme_style == 'theme_style_2' ) {
			$theme_style = 'dark'; } else {
			$theme_style = ''; }
		?>

		<div class="four columns <?php echo esc_attr( $theme_style ); ?> sidebar">

			<?php dynamic_sidebar( 'internal-sidebar' ); ?>

		</div><!-- END .four.columns.sidebar -->

	</section><!-- END #post-<?php the_ID(); ?> -->

</div><!-- END .row -->

<?php
get_footer();
