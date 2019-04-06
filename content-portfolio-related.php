<?php
/**
 * The file for displaying the related portfolio loop below the portfolio single.
 * It is called via the single-portfolio.php.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

// LAYOUT
// WE ARE USING THE GLOBAL THEME CUSTOMIZER VALUE AS PRIORITY HERE, BUT IF THE PORTFOLIO LAYOUT
// FROM THE PORTFOLIO POST META IS NOT "DEFAULT", THEN WE PULL THAT.
$portfolio_layout = get_post_meta( $post->ID, '_bean_portfolio_layout', true );
if ( $portfolio_layout == 'default' ) {
	if ( get_theme_mod( 'theme_version' ) == 'theme_version_fullscreen' ) {
		$portfolio_layout = 'fullscreen'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_fullwidth' ) {
		$portfolio_layout = 'fullwidth'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_edge' ) {
			$portfolio_layout = 'fullwidth'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_carousel' ) {
			$portfolio_layout = 'carousel'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_grid' ) {
				$portfolio_layout = 'grid'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_masonry' ) {
				$portfolio_layout = 'grid'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_masonry_full' ) {
					$portfolio_layout = 'grid'; } else {
					$portfolio_layout = 'std'; }
}

$portfolio_page            = get_theme_mod( 'portfolio_page_selector' );
$portfolio_content_display = get_post_meta( $post->ID, '_bean_portfolio_content_display', true );

// RELATED QUERY
$related_items_count = 9;
$related             = spaces_get_related_posts( $post->ID, 'portfolio_category', array( 'posts_per_page' => $related_items_count ) );
$i                   = 1;
?>

<div class="row fadein more portfolio
<?php
if ( $portfolio_layout == 'fullscreen' or $portfolio_layout == 'carousel' ) {
	echo 'fullscreen';
}  if ( $portfolio_layout == 'carousel' ) {
	echo ' crsl';
} if ( $portfolio_content_display == 'off' ) {
	echo ' no-content'; }
?>
">

	 <ul id="portfolio-grid" class="more
		<?php
		if ( $portfolio_layout == 'std' ) {
			echo 'std-layout';
		} if ( $portfolio_layout == 'fullscreen' or $portfolio_layout == 'carousel' ) {
			echo 'fullscreen'; }
?>
	<?php echo get_theme_mod( 'portfolio_column_width' ); ?>">
			<?php
			while ( $related->have_posts() ) :
				$related->the_post();

				if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) {
			?>
					 <li id="portfolio-<?php the_ID(); ?>">
						  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							   <a class="entry-link" title="<?php printf( esc_html__( 'Permanent Link to %s', 'spaces' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>"></a>
								<?php the_post_thumbnail( 'grid-feat' ); ?>
							   <div class="overlay"><h5><?php the_title(); ?></h5></div>
						  </div>
					 </li>
				<?php
				}

				$i++;
endwhile;
			wp_reset_postdata();
			?>

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

	 </ul><!-- END .portfolio-grid -->

</div><!-- END .row -->
