<?php
/**
 * The template for displaying the default searchform whenever it is called in the theme.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

?>

<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>/">
	<input type="text" name="s" id="s" value="<?php _e( 'Click to search...', 'spaces' ); ?>" onfocus="if(this.value=='<?php _e( 'Click to search...', 'spaces' ); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e( 'Click to search...', 'spaces' ); ?>';" />
</form><!-- END #searchform -->
