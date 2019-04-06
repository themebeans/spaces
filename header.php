<?php
/**
 * The header for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}
	?>
	<?php
	if ( ! is_404() && ! is_page_template( 'template-comingsoon.php' ) && ! is_page_template( 'template-underconstruction.php' ) ) {

		$theme_style  = get_theme_mod( 'theme_style' );
		$header_style = get_theme_mod( 'header_style' );
		$theme_style  = ( 'theme_style_2' === $theme_style ) ? 'dark_style' : null;
		$header_style = ( 'header_style_2' === $header_style ) ? ' layout-centered' : null;
		?>

		<div id="theme-wrapper" class="<?php echo esc_attr( $theme_style ); ?> <?php echo esc_attr( $header_style ); ?>">

			<nav id="mobile-nav" class="show-for-small">

				<?php
				if ( function_exists( 'wp_nav_menu' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'mobile-menu',
						)
					);
				}
				?>

			</nav><!-- END #mobile-nav -->

			<?php if ( get_theme_mod( 'hidden_sidebar' ) ) { ?>
				<a class="sidebar-btn" href="javascript:void(0);"><span class="menu-icon slidein-right"></span></a>
				<div class="nav-overlay"></div>
			<?php } ?>

			<div class="row row-header">

				<header id="header">

					<?php spaces_site_logo(); ?>

					<?php $header_intro        = get_theme_mod( 'header_intro' ); ?>

					<?php
					$portfolio_content_display = get_post_meta( $post->ID, '_bean_portfolio_content_display', true );

					if (
					is_page_template( 'template-team.php' ) ||
					is_page_template( 'template-dribbble.php' ) ||
					is_page_template( 'template-portfolio.php' ) ||
					is_page_template( 'template-testimonials.php' ) ||
					is_page_template( 'template-portfolio-grid.php' ) ||
					is_page_template( 'template-portfolio-masonry.php' ) ||
					is_page_template( 'template-dribbble-fullwidth.php' ) ||
					is_page_template( 'template-portfolio-carousel.php' ) ||
					is_page_template( 'template-portfolio-fullwidth.php' ) ||
					is_page_template( 'template-portfolio-fullscreen.php' ) ||
					is_page_template( 'template-portfolio-grid-lightbox.php' ) ||
					is_page_template( 'template-portfolio-grid-fullwidth.php' ) ||
					is_page_template( 'template-portfolio-masonry-lightbox.php' ) ||
					is_page_template( 'template-portfolio-grid-fullwidth-lightbox.php' ) ||
					is_page_template( 'template-portfolio-masonry-fullwidth-lightbox.php' ) ||
					is_page_template( 'template-portfolio-masonry-fullwidth.php' ) ||
					is_singular( 'portfolio' ) && 'off' === $portfolio_content_display
					) {

						$content = $post->post_content;

						if ( $content ) {

							while ( have_posts() ) :
								the_post();
								the_content();
							endwhile;

							if ( is_singular( 'portfolio' ) && true === get_theme_mod( 'show_portfolio_sharing' ) ) {
								?>
									<?php get_template_part( 'content', 'portfolio-social' ); ?>
								<?php
							}
						} else {
							if ( $header_intro ) {
							?>
								<div class="site-description">
									<p><?php echo esc_html( $header_intro ); ?></p>
								</div>
							<?php
							}
						}
					} elseif ( is_archive( 'portfolio_category' ) || is_archive( 'portfolio_tag' ) ) {

						$content = category_description();

						if ( $content ) {
							echo category_description();
						} else {
							if ( $header_intro ) {
							?>
								<div class="site-description">
									<p><?php echo esc_html( $header_intro ); ?></p>
								</div>
							<?php
							}
						}
					} else {
						if ( $header_intro ) {
						?>
							<div class="site-description">
								<p><?php echo esc_html( $header_intro ); ?></p>
							</div>
						<?php
						}
					}
					?>

					<nav class="primary subtext hide-for-small clearfix">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary-menu',
								'container'      => '',
								'menu_id'        => 'primary-menu',
								'menu_class'     => 'sf-menu main-menu',
							)
						);
						?>

						<?php
						if ( true === get_theme_mod( 'portfolio_filter' ) ) {

							if (
							is_page_template( 'template-portfolio.php' ) ||
							is_page_template( 'template-portfolio-grid.php' ) ||
							is_page_template( 'template-portfolio-masonry.php' ) ||
							is_page_template( 'template-portfolio-carousel.php' ) ||
							is_page_template( 'template-portfolio-fullwidth.php' ) ||
							is_page_template( 'template-portfolio-fullscreen.php' ) ||
							is_page_template( 'template-portfolio-grid-lightbox.php' ) ||
							is_page_template( 'template-portfolio-grid-fullwidth.php' ) ||
							is_page_template( 'template-portfolio-masonry-lightbox.php' ) ||
							is_page_template( 'template-portfolio-grid-fullwidth-lightbox.php' ) ||
							is_page_template( 'template-portfolio-masonry-fullwidth-lightbox.php' ) ||
							is_page_template( 'template-portfolio-masonry-fullwidth.php' ) ) {
								get_template_part( 'content', 'portfolio-filter' );
							}
						}
						?>

						<?php if ( true === get_theme_mod( 'header_search' ) ) { ?>
							<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>/">
								<fieldset>
									<input type="text" name="s" id="s" class="search subtext">
								</fieldset>
							</form>
						<?php } ?>

					</nav>

				</header>

			</div>

		<?php
	}
