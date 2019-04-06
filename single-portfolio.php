<?php
/**
 * The template for displaying the portfolio singular page.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

get_header();

spaces_set_post_views( get_the_ID() );

$portfolio_content_display = get_post_meta( $post->ID, '_bean_portfolio_content_display', true );
$gallery_layout            = get_post_meta( $post->ID, '_bean_gallery_layout', true );
$portfolio_date            = get_post_meta( $post->ID, '_bean_portfolio_date', true );
$portfolio_url             = get_post_meta( $post->ID, '_bean_portfolio_url', true );
$portfolio_views           = get_post_meta( $post->ID, '_bean_portfolio_views', true );
$portfolio_client          = get_post_meta( $post->ID, '_bean_portfolio_client', true );
$portfolio_cats            = get_post_meta( $post->ID, '_bean_portfolio_cats', true );
$portfolio_tags            = get_post_meta( $post->ID, '_bean_portfolio_tags', true );
$portfolio_review          = get_post_meta( $post->ID, '_bean_portfolio_review', true );
$portfolio_page            = get_theme_mod( 'portfolio_page_selector' );
$orderby                   = get_post_meta( $post->ID, '_bean_portfolio_randomize', true );
$orderby                   = ( $orderby == 'off' ) ? 'post__in' : 'rand';

$portfolio_layout = get_post_meta( $post->ID, '_bean_portfolio_layout', true );
if ( $portfolio_layout == 'default' ) {
	if ( get_theme_mod( 'theme_version' ) == 'theme_version_fullscreen' ) {
		$portfolio_layout = 'fullscreen'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_fullwidth' ) {
		$portfolio_layout = 'fullwidth'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_edge' ) {
			$portfolio_layout = 'edge'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_carousel' ) {
			$portfolio_layout = 'carousel'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_grid' ) {
				$portfolio_layout = 'grid'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_masonry' ) {
				$portfolio_layout = 'masonry'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_masonry_full' ) {
					$portfolio_layout = 'masonry'; } else {
					$portfolio_layout = 'std'; }
}

if ( $portfolio_layout != 'fullscreen' ) {  ?>

	<div class="row fadein
	<?php
	if ( $portfolio_layout == 'std' ) {
		echo ' portfolio';
	} if ( $portfolio_layout == 'edge' ) {
		echo ' edge fullscreen';}
?>
">

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
?>

					<?php if ( $portfolio_layout == 'std' ) { ?>

			<ul id="masonry-container" class="grid
			<?php
			if ( $gallery_layout == 'portfolio-lightbox' ) {
				echo ' lb-layout';}
?>
">

				<?php if ( $portfolio_content_display == 'on' ) { ?>
					<?php
					echo '<li class="masonry-item portfolio-content">';
					get_template_part( 'content', 'portfolio-meta' );
					echo '</li>';
?>
				<?php } ?>

				<?php if ( ! post_password_required() ) { // START PASSWORD PROTECTED ?>

					<?php get_template_part( 'content', 'portfolio-media' ); ?>

						<?php spaces_gallery( $post->ID, 'post-feat', $gallery_layout, $orderby, true ); ?>

					<?php
					if ( $portfolio_review ) {
						echo '<li class="masonry-item portfolio-content portfolio-review">';
							echo '<div class="portfolio-wrap"><span class="quote-icon"></span>';
								echo esc_html( $portfolio_review );
							echo '</div>';
						echo '</li>';
					}
					?>

					<?php if ( get_theme_mod( 'show_portfolio_sharing' ) == true ) { ?>
						<?php
						echo '<li class="masonry-item portfolio-content social">';
						get_template_part( 'content', 'portfolio-social' );
						echo '</li>';
?>
					<?php } ?>

				<?php } //END if ( !post_password_required() ) ?>

			</ul><!-- END #masonry-container -->

			<script type="text/javascript">
				jQuery(document).ready(function($) {
					//MASONRY
					var container = document.querySelector('#masonry-container');
					 var msnry;
					 imagesLoaded( container, function() {
						msnry = new Masonry( container, {
							itemSelector: '.masonry-item'
						});
					 });

				});
			</script>

		<?php } //END if ($portfolio_layout == 'std') ?>

					<?php if ( $portfolio_layout == 'fullwidth' or $portfolio_layout == 'edge' ) { ?>

			<ul class="stacked
			<?php
			if ( $gallery_layout == 'portfolio-lightbox' ) {
				echo ' lb-layout';
			} if ( $portfolio_content_display == 'off' ) {
				echo ' no-content';}
?>
">

				<li><?php get_template_part( 'content', 'portfolio-media' ); ?></li>

				<?php if ( ! post_password_required() ) { // START PASSWORD PROTECTED ?>

					<?php spaces_gallery( $post->ID, 'port-full', $gallery_layout, $orderby, true ); ?>

					<?php if ( $portfolio_review ) { ?>
						<li class="portfolio-content fullwidth-review portfolio-review">
							<div class="portfolio-wrap">
								<span class="quote-icon"></span>
								<?php echo esc_html( $portfolio_review ); ?>
							</div>
						</li>
					<?php } ?>

				<?php } //END if ( !post_password_required() ) ?>

			</ul><!-- END .stacked -->

		<?php } //END if ($portfolio_layout == 'fullwidth') ?>

					<?php
					if ( $portfolio_layout == 'fullwidth' ) {
						get_template_part( 'content', 'portfolio-meta' );
					}
					?>

					<?php if ( $portfolio_layout == 'edge' ) { ?>
			<div class="row">
				<?php get_template_part( 'content', 'portfolio-meta' ); ?>
			</div><!-- END .row -->
		<?php } ?>

		<?php
		endwhile;
endif;
		wp_reset_postdata();
?>

	</div><!-- END .row -->

<?php
} //END if ($portfolio_layout == 'std' OR $portfolio_layout == 'fullwidth' )



// FULLSCREEN SINGLE PORTFOLIO OUTPUT
if ( $portfolio_layout == 'fullscreen' ) {
?>

	<?php if ( ! post_password_required() ) { // START PASSWORD PROTECTED ?>

		<?php spaces_gallery( $post->ID, 'port-full', 'fullscreen', $orderby, true ); ?>

	<?php } //END if ( !post_password_required() ) ?>

	<div class="row">
		<?php get_template_part( 'content', 'portfolio-meta' ); ?>
	</div><!-- END .row -->

<?php
} //END if ($portfolio_layout == 'fullscreen')



// CAROUSEL SINGLE PORTFOLIO OUTPUT
if ( $portfolio_layout == 'carousel' ) {
?>

	<?php if ( ! post_password_required() ) { // START PASSWORD PROTECTED ?>

		<div class="row carousel portfolio fullscreen
		<?php
		if ( $portfolio_content_display == 'off' ) {
			echo 'no-content'; }
?>
">

			<?php spaces_gallery( $post->ID, 'grid-feat', 'port-single-crsl', $orderby, true ); ?>

		</div><!-- END .row.carousel.portfolio.fullscreen -->

	<?php } //END if ( !post_password_required() ) ?>

	<div class="row">
		<?php get_template_part( 'content', 'portfolio-meta' ); ?>
	</div><!-- END .row -->

<?php
} //END if ($portfolio_layout == 'carousel')



// GALLERY GRID SINGLE PORTFOLIO OUTPUT
if ( $portfolio_layout == 'grid' ) {
?>

	<div class="row portfolio fadein">

		<?php if ( ! post_password_required() ) { // START PASSWORD PROTECTED ?>

			<ul id="portfolio-grid" class="hfeed grid gallery-grid <?php echo get_theme_mod( 'portfolio_column_width' ); ?>">
				<?php spaces_gallery( $post->ID, 'port-grid-lightbox', 'grid-gallery', $orderby, true ); ?>

				<?php if ( get_theme_mod( 'show_portfolio_loop_single' ) == false ) { ?>
					<?php if ( $portfolio_page ) { ?>
						   <li id="load-more">
								<div class="portfolio">
								<a class="entry-link" href="<?php echo get_page_link( $portfolio_page ); ?>"></a>
										<?php if ( get_theme_mod( 'theme_style' ) == 'theme_style_2' ) { ?>
										  <img src="
											<?php
											echo get_template_directory_uri();
											echo '/assets/styles/style-2/images/placeholder.png';
?>
">
										<?php } else { ?>
										  <img src="
											<?php
											echo get_template_directory_uri();
											echo '/assets/images/placeholder.png';
?>
">
										<?php } ?>
									 <div class="overlay">
										  <h5><?php echo esc_html__( 'Portfolio &rarr;', 'spaces' ); ?></h5>
									 </div><!-- END .overlay -->
								</div><!-- END .portfolio -->
						   </li><!-- END #load-more -->
						<?php } //END  if ($portfolio_page) ?>
				<?php } //END if ( get_theme_mod( 'show_portfolio_loop_single' ) == true ) ?>

			</ul><!-- END #portfolio-grid -->

		<?php } //END if ( !post_password_required() ) ?>

		<?php if ( $portfolio_content_display == 'on' ) { ?>
			<div class="row portfolio">
				<?php get_template_part( 'content', 'portfolio-meta' ); ?>
			</div><!-- END .row -->
		<?php } ?>

	</div><!-- END .row -->

<?php
} //END if ($portfolio_layout == 'grid')



// MASONRY SINGLE PORTFOLIO OUTPUT
if ( $portfolio_layout == 'masonry' ) {

	if ( get_theme_mod( 'theme_version' ) == 'theme_version_masonry_full' ) {
		$full = true;
	} else {
		$full = false;
	}
?>

	<div class="row portfolio fadein
	<?php
	if ( $full == true ) {
		echo ' fullscreen';}
?>
">

		<?php if ( ! post_password_required() ) { // START PASSWORD PROTECTED ?>

			<ul id="masonry-container" class="grid
			<?php
			if ( $full == true ) {
				echo ' fullscreen';}
?>
	<?php echo get_theme_mod( 'portfolio_column_width' ); ?>">

				<?php spaces_gallery( $post->ID, 'port-grid-lightbox', 'single-port-masonry-lightbox', $orderby, true ); ?>

			</ul><!-- END #masonry-container -->

		<?php } //END if ( !post_password_required() ) ?>

		<?php if ( $portfolio_content_display == 'on' ) { ?>
			<div class="row portfolio">
				<?php get_template_part( 'content', 'portfolio-meta' ); ?>
			</div><!-- END .row -->
		<?php } ?>

	</div><!-- END .row.portfolio -->

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			//MASONRY
			var container = document.querySelector('#masonry-container');
			var msnry;
			imagesLoaded( container, function() {
				msnry = new Masonry( container, {
					itemSelector: '.masonry-item'
				});
			});
		});
	</script>

<?php
} //END if ($portfolio_layout == 'masonry')



// MORE LOOP PULL
$portfolio_more = get_post_meta( $post->ID, '_bean_portfolio_more', true );
if ( $portfolio_more == 'on' and get_theme_mod( 'show_portfolio_loop_single' ) == true ) {

	// SWITCHER FOR MORE OR RELATED LOOP
	$more_loop = get_theme_mod( 'portfolio_more_loop' );
	if ( $more_loop != '' ) {
		switch ( $more_loop ) {
			case 'related':
				$terms = get_the_terms( $post->ID, 'portfolio_category' );
				if ( $terms && ! is_wp_error( $terms ) ) :
					get_template_part( 'content', 'portfolio-related' );
				endif;

				break;
			case 'more':
				get_template_part( 'content', 'portfolio-more' );

				break;
		}
	}
} //END if ( get_theme_mod( 'show_portfolio_loop_single' ) == true )
?>

<?php
get_footer();
