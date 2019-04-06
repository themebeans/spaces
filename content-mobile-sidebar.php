<?php
/**
 * The output for the mobile sidebar.
 * This content is pulled on every page via the footer.php file.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

?>

<div class="mobile-sidebar mobile-sidebar-right">

	 <form id="mobile-search" class="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		  <div class="clearfix default_searchform">
			   <input type="text" name="s" class="s" placeholder="Search..." />
			   <input type="submit" value="" class="button">
		  </div><!-- END .clearfix defaul_searchform -->
	 </form><!-- END #searchform -->

	 <nav id="mobile-nav">
			<?php
			if ( function_exists( 'wp_nav_menu' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'mobile-menu',
					)
				);
			}
			?>
	 </nav>
</div>
