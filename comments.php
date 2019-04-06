<?php
/**
 * The template for displaying comments.
 * The area of the page that contains comments and the comment form.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

if ( ! post_password_required() ) {


	if ( post_password_required() ) {
		return;
	}

	if ( have_comments() ) :
	?>

	<div id="comments">

	<?php
	if ( ! empty( $comments_by_type['comment'] ) ) {
		?>

			<h6 class="comments-title"><?php comments_number( esc_html__( '0 Comments', 'spaces' ), esc_html__( '1 Comment', 'spaces' ), esc_html__( '% Comments', 'spaces' ) ); ?></h6>

			<div id="comments-list" class="comments">

				<?php
				$total_pages = get_comment_pages_count();
				if ( $total_pages > 1 ) {
				?>
					<div id="comments-nav-above" class="comments-navigation">
						<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
					</div>
				<?php } ?>

					<ol class="commentlist block">
					<?php wp_list_comments( 'type=comment&callback=spaces_comment' ); ?>
					</ol>

				<?php
				$total_pages = get_comment_pages_count();
				if ( $total_pages > 1 ) {
				?>
					<div id="comments-nav-below" class="comments-navigation">
						<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
					</div>
				<?php } ?>

			</div>

		<?php
	}

	if ( ! empty( $comments_by_type['pings'] ) ) {
		?>

			<div id="comments-list" class="comments">
				<h6 class="comments-title"><?php esc_html__( 'Trackbacks.', 'spaces' ); ?></h6>

				<ol class="pinglist">
					<?php wp_list_comments( 'type=pings&callback=spaces_ping' ); ?>
				</ol>
			</div>

		<?php } ?>

	</div>

	<?php
	endif;

	if ( comments_open() ) :
		comment_form();
	endif;

	if ( ! comments_open() && have_comments() && ! is_page() ) :
	?>
		<div id="respond">
			<h6><?php esc_html__( 'Comments have been disabled', 'spaces' ); ?></h6>
		</div>

	<?php
	endif;
}
