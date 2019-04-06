<?php
/**
 * Functions for post/portfolio likes feature.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */


function spaces_like_this( $post_id, $action = 'get' ) {
	if ( ! is_numeric( $post_id ) ) {
		error_log( 'Error: Value submitted for post_id was not numeric' );
		return;
	}

	switch ( $action ) {
		case 'get':
			$data = get_post_meta( $post_id, '_likes' );

			if ( ! is_numeric( $data[0] ) ) {
				$data[0] = 0;
				add_post_meta( $post_id, '_likes', '0', true );
			}

			return $data[0];
		break;
		case 'update':
			if ( isset( $_COOKIE[ 'like_' + $post_id ] ) ) {
				return;
			}

			$currentValue = get_post_meta( $post_id, '_likes' );

			if ( ! is_numeric( $currentValue[0] ) ) {
				$currentValue[0] = 0;
				add_post_meta( $post_id, '_likes', '1', true );
			}

			$currentValue[0]++;
			update_post_meta( $post_id, '_likes', $currentValue[0] );

			setcookie( 'like_' + $post_id, $post_id, time() * 20, '/' );
			break;

	}
}

function spaces_print_likes( $post_id ) {
	$likes = spaces_like_this( $post_id );

	$likeword = ' Likes ';
	$who      = ' people like ';

	if ( $likes == 1 ) {
		$who      = ' person likes ';
		$likeword = ' Like ';
	}

	if ( isset( $_COOKIE[ 'like_' + $post_id ] ) ) {
		print '<a href="#" class="bean-likes active" id="like-' . $post_id . '">' . $likes . '</a>';
			return;
	}
		print '<a href="#" class="bean-likes" id="like-' . $post_id . '">' . $likes . '</a>';
}

function spaces_set_up_post_likes( $post_id ) {
	if ( ! is_numeric( $post_id ) ) {
		error_log( 'Error: Value submitted for post_id was not numeric' );
		return;
	}
	add_post_meta( $post_id, '_likes', '0', true );
}

function spaces_check_headers() {
	if ( isset( $_POST['likepost'] ) ) {
		spaces_like_this( $_POST['likepost'], 'update' );
	}
}
add_action( 'publish_post', 'spaces_set_up_post_likes' );
add_action( 'init', 'spaces_check_headers' );
