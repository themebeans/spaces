<?php
/**
 * Template Name: EDD Login Form
 * The template for displaying the EDD login shortcode.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

get_header( 'min' );
?>

<div class="row">

	<div class="min-wrap">

			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
			?>

			<?php echo do_shortcode( '[edd_login]' ); ?>

			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$('#edd_login_form input#edd_user_login').attr('placeholder', '<?php _e( 'Username', 'spaces' ); ?>');
					$('#edd_login_form input#edd_user_pass').attr('placeholder', '<?php _e( 'Password', 'spaces' ); ?>');
				});
			</script>

	</div><!-- END .min-wrap -->

</div><!-- END .row -->

<?php
get_footer( 'min' );
