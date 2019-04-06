<?php
/**
 * The template for displaying the footer
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

	// DONT SHOW THE FOOTER ON 404, COMING SOON AND UNDER CONSTRUCTION
if ( ! is_404() && ! is_page_template( 'template-comingsoon.php' ) && ! is_page_template( 'template-underconstruction.php' ) ) {

	// LAYOUT
	// WE ARE USING THE GLOBAL THEME CUSTOMIZER VALUE AS PRIORITY HERE, BUT IF THE PORTFOLIO LAYOUT
	// FROM THE PORTFOLIO POST META IS NOT "DEFAULT", THEN WE PULL THAT.
	$theme_version    = get_theme_mod( 'theme_version' );
	$portfolio_layout = get_post_meta( $post->ID, '_bean_portfolio_layout', true );
	if ( $portfolio_layout == 'default' ) {
		if ( get_theme_mod( 'theme_version' ) == 'theme_version_fullscreen' ) {
			$portfolio_layout = 'fullscreen'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_fullwidth' ) {
			$portfolio_layout = 'fullwidth'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_edge' ) {
				$portfolio_layout = 'edge'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_carousel' ) {
				$portfolio_layout = 'carousel'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_grid' ) {
					$portfolio_layout = 'grid'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_masonry' ) {
					$portfolio_layout = 'grid'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_masonry_full' ) {
						$portfolio_layout = 'grid'; } else {
						$portfolio_layout = 'std'; }
	}

	// HEADER LAYOUT
	$header_style = get_theme_mod( 'header_style' );
	if ( $header_style == 'header_style_2' ) {
		$header_style = 'layout-centered'; } else {
		$header_style = ''; }
	?>

	<div class="row
	<?php
	if ( $theme_version == 'theme_version_fullscreen' ) {
		echo 'fullscreen footer';
	} if ( $portfolio_layout != 'fullscreen' && is_singular( 'portfolio' ) ) {
		echo ' single'; }
?>
">

		<footer id="footer" class="<?php echo esc_attr( $header_style ); ?>">

			<p>&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( $name ); ?></a><br/>

			<?php
			if ( get_theme_mod( 'footer_copyright' ) ) {
				echo get_theme_mod( 'footer_copyright' );
			} else {
				echo 'Design by <a href="http://themebeans.com">ThemeBeans</a> - a WordPress studio.';
			}
				?>

				</p>

				<?php if ( has_nav_menu( 'secondary-menu' ) ) : ?>

					<nav class="secondary subtext hide-for-small">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'secondary-menu',
								'container'      => '',
								'depth'          => '1',
								'menu_id'        => 'secondary-menu',
								'menu_class'     => 'sf-menu main-menu',
							)
						);
						?>
					</nav>

				<?php endif; ?>

			</footer><!-- END #footer-->

		</div><!-- END .row -->

		<?php if ( is_singular( 'post' ) or is_singular( 'portfolio' ) or is_singular( 'product' ) && ! is_singular( 'page' ) ) { ?>

			<div class="pagination slidein" role="navigation">

				<span class="page-next"><?php next_post_link( esc_html__( '%link', 'spaces' ), esc_html__( '', 'spaces' ) ); ?></span>

					<?php $portfolio_page = get_theme_mod( 'portfolio_page_selector' ); ?>

					<?php if ( is_singular( 'portfolio' ) && $portfolio_page ) { ?>
						<span class="page-portfolio"><a href="<?php echo get_page_link( $portfolio_page ); ?>" rel="home"></a></span>
					<?php } ?>

				<span class="page-prev"><?php previous_post_link( esc_html__( '%link', 'spaces' ), esc_html__( '', 'spaces' ) ); ?></span>

			</div><!-- END .pagination -->

		<?php } else { // END if ( is_singular('post').. ?>

			<div class="pagination slidein" role="navigation">
					<?php
					global $wp_query;
					$big = 9999999999;

					echo paginate_links(
						array(
							'base'      => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
							'format'    => '?paged=%#%',
							'current'   => max( 1, get_query_var( 'paged' ) ),
							'total'     => $wp_query->max_num_pages,
							'prev_text' => esc_html__( 'Prev Page', 'spaces' ),
							'next_text' => esc_html__( 'Next Page', 'spaces' ),
						)
					);
					?>
			</div><!-- END .pagination -->

		<?php } ?>

		</div><!-- END #theme-wrapper -->

		<?php
		if ( get_theme_mod( 'hidden_sidebar' ) == true ) {
			get_template_part( 'content', 'hidden-sidebar' ); // GET CONTENT-HIDDEN-SIDEBAR.PHP
		}
		?>

	<?php
	// END if ( !is_404()...
}
	?>

<?php wp_footer(); ?>

</body>
</html>
