<?php
/**
 * The file is for displaying the single portfolio media
 * It is called via single-portfolio.php
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

// PORTFOLIO TYPES
$portfolio_type_audio = get_post_meta( $post->ID, '_bean_portfolio_type_audio', true );
$portfolio_type_video = get_post_meta( $post->ID, '_bean_portfolio_type_video', true );

// AUDIO META
$audio_poster = get_post_meta( $post->ID, '_bean_audio_poster_url', true );
$audio_mp3    = get_post_meta( $post->ID, '_bean_audio_mp3', true );
if ( $audio_poster == '' ) {
	$audio_poster_class = 'audio-no-feat'; }

// VIDEO META
$embed  = get_post_meta( $post->ID, '_bean_portfolio_embed_code', true );
$embed2 = get_post_meta( $post->ID, '_bean_portfolio_embed_code_2', true );
$embed3 = get_post_meta( $post->ID, '_bean_portfolio_embed_code_3', true );
$embed4 = get_post_meta( $post->ID, '_bean_portfolio_embed_code_4', true );

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


if ( ! post_password_required() ) { // START PASSWORD PROTECTED

	if ( $portfolio_type_audio == 'on' ) {

		if ( $portfolio_layout == 'std' ) {
			echo '<li class="masonry-item portfolio-content">';
		} else {
			echo '<li>';}

		if ( $audio_poster ) { ?>

				<div class="audio-feat">
					<img src="<?php echo esc_url( $audio_poster ); ?>" class="wp-post-image"/>
					<?php bean_audio( $post->ID ); ?>
				</div><!-- END .audio-no-feat -->

			<?php
		} else {

			if ( $audio_mp3 ) {
				?>

					<div class="audio-no-feat">
						<?php bean_audio( $post->ID ); ?>
					</div><!-- END .audio-no-feat -->

				<?php
			}//END if ( $audio_mp3 )
		} //END else ( $audio_poster )

		echo '</li>';

	} // END if ( $portfolio_type_audio == 'on')

	if ( $portfolio_type_video == 'on' ) {
		if ( $embed ) {
			if ( $portfolio_layout == 'std' ) {
				echo '<li class="masonry-item portfolio-content">';
			} else {
				echo '<li>';}
				echo '<div class="video-frame">';
					echo stripslashes( htmlspecialchars_decode( $embed ) );
				echo '</div>';
			echo '</li>';

		} //END if($embed)

		if ( $embed2 ) {
			if ( $portfolio_layout == 'std' ) {
				echo '<li class="masonry-item portfolio-content">';
			} else {
				echo '<li>';}
				echo '<div class="video-frame">';
					echo stripslashes( htmlspecialchars_decode( $embed2 ) );
				echo '</div>';
			echo '</li>';

		} //END if($embed2)

		if ( $embed3 ) {
			if ( $portfolio_layout == 'std' ) {
				echo '<li class="masonry-item portfolio-content">';
			} else {
				echo '<li>';}
				echo '<div class="video-frame">';
					echo stripslashes( htmlspecialchars_decode( $embed3 ) );
				echo '</div>';
			echo '</li>';

		} //END if($embed3)

		if ( $embed4 ) {
			if ( $portfolio_layout == 'std' ) {
				echo '<li class="masonry-item portfolio-content">';
			} else {
				echo '<li>';}
				echo '<div class="video-frame">';
					echo stripslashes( htmlspecialchars_decode( $embed4 ) );
				echo '</div>';
			echo '</li>';

		} //END if($embed4)
	} // END if ( $portfolio_type_video == 'on')
} //END if ( !post_password_required() )
