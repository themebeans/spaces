<?php
/**
 * Template Name: EDD Profile Editor Form
 * The template for displaying the EDD profile editor shortcode.
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

			<?php echo do_shortcode( '[edd_profile_editor]' ); ?>

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
