<?php
/**
 * This file contains the media functions for the theme (Gallery, Audio, Video).
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

if ( ! function_exists( 'spaces_gallery' ) ) {
	function spaces_gallery( $postid, $imagesize = '', $layout = '', $orderby = '', $single = false ) {
		$thumb_ID      = get_post_thumbnail_id( $postid );
		$image_ids_raw = get_post_meta( $postid, '_bean_image_ids', true );

		// LAYOUT
		// WE ARE USING THE GLOBAL THEME CUSTOMIZER VALUE AS PRIORITY HERE, BUT IF THE PORTFOLIO LAYOUT
		// FROM THE PORTFOLIO POST META IS NOT "DEFAULT", THEN WE PULL THAT.
		$portfolio_layout = get_post_meta( $postid, '_bean_portfolio_layout', true );
		if ( $portfolio_layout == 'default' ) {
			if ( get_theme_mod( 'theme_version' ) == 'theme_version_fullscreen' ) {
				$portfolio_layout = 'fullscreen'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_fullwidth' ) {
				$portfolio_layout = 'fullwidth'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_edge' ) {
					$portfolio_layout = 'edge'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_carousel' ) {
					$portfolio_layout = 'carousel'; } elseif ( get_theme_mod( 'theme_version' ) == 'theme_version_grid' ) {
						$portfolio_layout = 'grid'; } else {
						$portfolio_layout = 'std'; }
		}

		// DISPLAYING THE CONTENT?
		$portfolio_content_display = get_post_meta( $postid, '_bean_portfolio_content_display', true );

		if ( $image_ids_raw != '' ) {
			$image_ids   = explode( ',', $image_ids_raw );
			$post_parent = null;
		} else {
			$image_ids   = '';
			$post_parent = $postid;
		}

		// PULL THE IMAGE ATTACHMENTS
		$args        = array(
			'exclude'        => $thumb_ID,
			'include'        => $image_ids,
			'numberposts'    => -1,
			'orderby'        => $orderby,
			'order'          => 'ASC',
			'post_type'      => 'attachment',
			'post_parent'    => $post_parent,
			'post_mime_type' => 'image',
			'post_status'    => null,
		);
		$attachments = get_posts( $args );

		// IF THE FUNCTION'S LAYOUT IS CALLING FOR THE SLIDER
		if ( $layout == 'slider' ) {
			// TRANSFER RANDO META FOR TRUE/FALSE SLIDE RANDOMIZE
			if ( $orderby == 'rand' ) {
				$orderby_slides = 'true';
			} else {
				$orderby_slides = 'false';
			}
			?>

			<script type="text/javascript">
				jQuery(document).ready(function($){
					jQuery('#slider-<?php echo esc_js( $postid ); ?>').flexslider({
						namespace: "bean-",
						animation: "fade",
						slideshow: false,
						animationLoop: true,
						randomize: <?php echo esc_js( $orderby_slides ); ?>,
						directionNav: false,
						controlNav: true,
						touch: true,
						prevText: "",
						nextText: "",
						start: function (slider) {
							if (typeof slider.container === 'object') {
								slider.container.click(function (e) {
									if (!slider.animating) {
										slider.flexAnimate(slider.getTarget('next'));
									}
								});
							}
						}
					});
				});
			</script>

			<div class="post-slider">
				<div id="slider-<?php echo esc_attr( $postid ); ?>" class="flexslider">
					<ul class="slides">
						<?php
						if ( ! empty( $attachments ) ) {
							$i = 0;
							foreach ( $attachments as $attachment ) {
								$src     = wp_get_attachment_image_src( $attachment->ID, $imagesize );
								$caption = $attachment->post_excerpt;
								$caption = ( $caption ) ? "<div class='bean-image-caption subtext'>$caption</div>" : '';
								$alt     = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
								echo "<li>$caption<img height='$src[2]' src='$src[0]' alt='$alt'/></li>";
							}
						} // END if( !empty($attachments) )
					?>
				</ul><!-- END .slides -->
			</div><!-- END #slider-$postid -->
		</div><!-- END .post-slider -->

		<?php
		} // END if( $layout == 'slider' )

		// IF THE FUNCTION'S LAYOUT IS CALLING FOR THE STANDARD PORTFOLIO SINGLE
		if ( $layout == 'stacked' ) {
			if ( ! empty( $attachments ) ) {
				foreach ( $attachments as $attachment ) {
					// EVEN & ODD CLASSES
					global $current_class;
					   $classes[]     = $current_class;
					   $current_class = ( $current_class == 'odd' ) ? 'even' : 'odd';

					$caption = $attachment->post_excerpt;
					$caption = ( $caption ) ? "<div class='bean-image-caption subtext'>$caption</div>" : '';
					$alt     = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;

					if ( $portfolio_layout == 'std' ) {

						$src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
							?>

							<li class="masonry-item <?php echo $current_class; ?>">
								<?php echo "$caption<img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />"; ?>
							</li>

							<?php
					} //END if( $portfolio_layout == 'std' )

					if ( $portfolio_layout == 'fullwidth' or $portfolio_layout == 'edge' ) {

						$src = wp_get_attachment_image_src( $attachment->ID, 'port-full' );
							?>

							<li><?php echo "$caption<img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />"; ?></li>

						<?php
					} //END if( $portfolio_layout == 'fullwidth' )
				} //END foreach( $attachments as $attachment )
			} // END if( !empty($attachments) )
		} // END if( $layout == 'std-portfolio-single' )

		 // IF THE FUNCTION'S LAYOUT IS CALLING FOR THE STANDARD PORTFOLIO SINGLE
		if ( $layout == 'portfolio-lightbox' ) {
			if ( ! empty( $attachments ) ) {
				$i = 1;

				foreach ( $attachments as $attachment ) {

					$hidden = ( $i != 1 ) ? ' hidden' : '';

					$src           = wp_get_attachment_image_src( $attachment->ID, $imagesize );
					$src_lrg       = wp_get_attachment_image_src( $attachment->ID, 'port-full' );
					$caption       = $attachment->post_excerpt;
					$caption_front = ( $caption ) ? "<div class='bean-image-caption subtext'>$caption</div>" : '';
					$alt           = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;

					if ( $portfolio_layout == 'std' ) {
						?>

						<li class="masonry-item">
							<?php echo '' . $caption_front . '<a href="' . $src_lrg[0] . '" class="lightbox ' . $hidden . '" title="' . htmlspecialchars( $caption ) . '" rel="' . $postid . '" alt="' . $alt . '"><img src="' . $src[0] . '"/></a>'; ?>
						</li>

						<?php
					} //END if( $portfolio_layout == 'std' )

					if ( $portfolio_layout == 'fullwidth' or $portfolio_layout == 'edge' ) {

						$src = wp_get_attachment_image_src( $attachment->ID, 'port-full' );
						?>

						<li><?php echo '' . $caption_front . '<a href="' . $src[0] . '" class="lightbox ' . $hidden . '" title="' . htmlspecialchars( $caption ) . '" rel="' . $postid . '" alt="' . $alt . '"><img src="' . $src[0] . '"/></a>'; ?></li>

						<?php
					} //END if( $portfolio_layout == 'fullwidth' )
				} //END foreach( $attachments as $attachment )
			} // END if( !empty($attachments) )
		} // END if( $layout == 'portfolio-lightbox' )

		 // IF THE FUNCTION'S LAYOUT IS CALLING FOR THE FULLSCREEN PORTFOLIO VIEW
		if ( $layout == 'fullscreen' ) {
			?>
			<div id="slider-<?php echo esc_attr( $postid ); ?>" class="home-slider fadein
										<?php
										if ( $portfolio_content_display == 'off' ) {
											echo ' no-content'; }
?>
">

				<?php
				// SLIDER META
				$animation     = get_post_meta( $postid, '_bean_fullscreen_animation', true );
				$animation     = ( $animation == 'slide' ) ? "'slide'" : "'fade'";
				$autoplay      = get_post_meta( $postid, '_bean_fullscreen_autoplay', true );
				$autoplay_time = get_post_meta( $postid, '_bean_fullscreen_autoplay_time', true );
				$pagination    = get_post_meta( $postid, '_bean_fullscreen_pagination', true );

				// LIGHTBOX
				$lightbox = get_post_meta( $postid, '_bean_gallery_layout', true );
				?>

				<script type="text/javascript">
				   jQuery(document).ready(function($){
					   $('#slider-<?php echo esc_js( $postid ); ?>').superslides({
						   animation: <?php echo $animation; ?>,
						   pagination:
							<?php
							if ( $pagination == 'on' ) {
								echo esc_js( 'true' );
							} else {
								echo esc_js( 'false' ); }
?>
,
							<?php
							if ( $autoplay == 'on' ) {
								echo esc_js( 'play: ' . $autoplay_time . ' ' ); }
?>
					   });
				   });
				</script>

				<ul class="slides-container">

					<?php
					if ( ! empty( $attachments ) ) {
						foreach ( $attachments as $attachment ) {
							$caption    = $attachment->post_excerpt;
							$caption    = ( $caption ) ? "<div class='bean-image-caption subtext fadein'>$caption</div>" : '';
							$alt        = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
							$src        = wp_get_attachment_image_src( $attachment->ID, $imagesize );
							$caption_lb = $attachment->post_excerpt;
							?>

							<li>
								<?php if ( $lightbox == 'portfolio-lightbox' ) { ?>
									<?php echo '' . $caption . '<a href="' . $src[0] . '" class="lightbox " title="' . htmlspecialchars( $caption_lb ) . '" rel="' . $postid . '" alt="' . $alt . '"><img height=' . $src[2] . ' width=' . $src[1] . ' src=' . $src[0] . ' alt=' . $alt . ' /></a>'; ?>
								<?php } else { ?>
									<?php echo "$caption<img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />"; ?>
								<?php } ?>
							</li>

							<?php
						} //END foreach( $attachments as $attachment )
					} // END if( !empty($attachments) )
					?>

				</ul><!-- END .slides -->

				<nav class="slides-navigation">
					<a href="#" class="next"><?php _e( 'Next', 'spaces' ); ?></a>
					<a href="#" class="prev"><?php _e( 'Previous', 'spaces' ); ?></a>
				</nav>

			</div><!-- END #slider-$postid -->

			<ul class="home-slider-mobile
			<?php
			if ( $portfolio_content_display == 'off' ) {
				echo ' no-content';
			} if ( $lightbox == ' portfolio-lightbox' ) {
				echo ' lb-layout'; }
?>
">

				<?php
				if ( ! empty( $attachments ) ) {
					foreach ( $attachments as $attachment ) {
						$caption = $attachment->post_excerpt;
						$caption = ( $caption ) ? "<div class='bean-image-caption subtext fadein'>$caption</div>" : '';
						$alt     = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
						$src     = wp_get_attachment_image_src( $attachment->ID, 'port-full' );
						?>

						<li>
							<?php if ( $lightbox == 'portfolio-lightbox' ) { ?>
									<?php echo '<a href="' . $src[0] . '" class="lightbox " title="' . htmlspecialchars( $caption ) . '" rel="' . $postid . '" alt="' . $alt . '"><img height=' . $src[2] . ' width=' . $src[1] . ' src=' . $src[0] . ' alt=' . $alt . ' /></a>' . $caption . ''; ?>
							<?php } else { ?>
									<?php echo "<img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />$caption"; ?>
							<?php } ?>
						</li>

						<?php
					} //END foreach( $attachments as $attachment )
				} // END if( !empty($attachments) )
				?>

			</ul><!-- END .home-slider-mobile -->
		<?php
		} // END if( $layout == 'fullscreen' )

		 // IF THE FUNCTION'S LAYOUT IS CALLING FOR THE FULLSCREEN PORTFOLIO VIEW
		if ( $layout == 'port-single-crsl' ) {
			?>
			<div class="carousel-wrap fadein">

				<?php
				// LIGHTBOX
				$lightbox = get_post_meta( $postid, '_bean_gallery_layout', true );
				?>

				<script type="text/javascript">
				   jQuery(document).ready(function($){
					   $('.crsl-items').carousel({
						   overflow: true,
						   visible: 2,
						   itemMinWidth: 250,
						   itemMargin: 30,
						   itemEqualHeight:false,
						   speed: 400,
					   });
				   });
				</script>

				<div class="crsl-items" data-navigation="carousel-nav">

				   <div class="crsl-wrap">

						<?php
						if ( ! empty( $attachments ) ) {
							foreach ( $attachments as $attachment ) {
								$caption    = $attachment->post_excerpt;
								$caption    = ( $caption ) ? "<div class='bean-image-caption subtext fadein'>$caption</div>" : '';
								$alt        = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
								$src        = wp_get_attachment_image_src( $attachment->ID, $imagesize );
								$src_lrg    = wp_get_attachment_image_src( $attachment->ID, 'port-full' );
								$caption_lb = $attachment->post_excerpt;
								?>

								<article class="crsl-item
								<?php
								if ( $lightbox == 'portfolio-lightbox' ) {
									echo 'lb';}
?>
">
									<?php if ( $lightbox == 'portfolio-lightbox' ) { ?>
										<?php echo '' . $caption . '<a href="' . $src_lrg[0] . '" class="lightbox " title="' . htmlspecialchars( $caption_lb ) . '" rel="' . $postid . '" alt="' . $alt . '"><img height=' . $src[2] . ' width=' . $src[1] . ' src=' . $src[0] . ' alt=' . $alt . ' /></a>'; ?>
									<?php } else { ?>
										<?php echo "$caption<img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />"; ?>
									<?php } ?>
							   </article>

							<?php
							} //END foreach( $attachments as $attachment )
						} // END if( !empty($attachments) )
						?>

					</div><!-- END .crsl-wrap -->

					<nav id="carousel-nav" class="crsl-nav">
						<a href="#" class="next"><?php _e( 'Next', 'spaces' ); ?></a>
						<a href="#" class="previous"><?php _e( 'Previous', 'spaces' ); ?></a>
					</nav><!-- END .slides-navigation -->

				</div><!-- END .crsl-items -->

			</div><!-- END .carousel-wrap -->

			<ul class="home-slider-mobile fadein
			<?php
			if ( $portfolio_content_display == 'off' ) {
				echo ' no-content';
			} if ( $lightbox == ' portfolio-lightbox' ) {
				echo ' lb-layout'; }
?>
">

				<?php
				if ( ! empty( $attachments ) ) {
					foreach ( $attachments as $attachment ) {
						$caption = $attachment->post_excerpt;
						$caption = ( $caption ) ? "<div class='bean-image-caption subtext fadein'>$caption</div>" : '';
						$alt     = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
						$src     = wp_get_attachment_image_src( $attachment->ID, 'port-full' );
						?>

						<li>
							<?php if ( $lightbox == 'portfolio-lightbox' ) { ?>
									<?php echo '<a href="' . $src[0] . '" class="lightbox " title="' . htmlspecialchars( $caption ) . '" rel="' . $postid . '" alt="' . $alt . '"><img height=' . $src[2] . ' width=' . $src[1] . ' src=' . $src[0] . ' alt=' . $alt . ' /></a>' . $caption . ''; ?>
							<?php } else { ?>
									<?php echo "<img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />$caption"; ?>
							<?php } ?>
						</li>

						<?php
					} //END foreach( $attachments as $attachment )
				} // END if( !empty($attachments) )
				?>

			</ul><!-- END .home-slider-mobile -->
		<?php
		} // END if( $layout == 'fullscreen' )

		// IF THE FUNCTION'S LAYOUT IS CALLING FOR LIGHTBOX
		if ( $layout == 'post-lightbox' ) {

			$fullwidth_media = get_post_meta( $postid, '_bean_fullwidth_media', true );

			if ( ! empty( $attachments ) ) {
				$i = 1;

				foreach ( $attachments as $attachment ) {

					$hidden = ( $i != 1 ) ? ' hidden' : '';

					$feat_image_url  = wp_get_attachment_url( get_post_thumbnail_id( $postid ) );
					$fullwidth_image = get_post_meta( $postid, '_bean_fullwidth_image', true );
					$src             = wp_get_attachment_image_src( $attachment->ID, $imagesize );
					$caption         = $attachment->post_excerpt;

					if ( ! is_singular() ) {
						echo "<a class='lightbox $hidden' rel='$postid' href='$src[0]' title=" . htmlspecialchars( $caption ) . '>';
							echo "<img src='$feat_image_url' />";
						echo '</a>';

						$i++;

					} else {

						if ( $fullwidth_media == 'on' ) {

								echo "<a class='lightbox $hidden' rel='$postid' href='$src[0]' title=" . htmlspecialchars( $caption ) . '>';
							if ( $fullwidth_image ) {
								echo "<img src='$fullwidth_image' />";
							} else {
								echo "<img src='$feat_image_url' />";
							}
								echo '</a>';

						} else {
							echo "<a class='lightbox $hidden' rel='$postid' href='$src[0]' title=" . htmlspecialchars( $caption ) . '>';
								echo "<img src='$feat_image_url' />";
							echo '</a>';
						}

							$i++;
					}
				}
			} // END if( !empty($attachments) )
		} // END if( $layout == 'post-lightbox' )

		// IF THE FUNCTION'S LAYOUT IS CALLING FOR LIGHTBOX
		if ( $layout == 'port-grid-lightbox' ) {
			if ( ! empty( $attachments ) ) {
				$i = 1;

				foreach ( $attachments as $attachment ) {

					$hidden = ( $i != 1 ) ? ' hidden' : '';

					$src         = wp_get_attachment_image_src( $attachment->ID, $imagesize );
					$caption     = $attachment->post_excerpt;
					$lb_feat_img = wp_get_attachment_image( get_post_thumbnail_id( $postid ), 'grid-feat', false, array( 'class' => $hidden ) );

					echo '<a class="lightbox ' . $hidden . ' entry-link" rel="' . $postid . '" href="' . $src[0] . '" title="' . htmlspecialchars( $caption ) . '"></a>';
					echo $lb_feat_img;

					$i++;
				}
			} // END if( !empty($attachments) )
		} // END if( $layout == 'port-grid-lightbox' )

		// IF THE FUNCTION'S LAYOUT IS CALLING FOR LIGHTBOX
		if ( $layout == 'port-masonry-lightbox' ) {
			if ( ! empty( $attachments ) ) {
					$i = 1;

				foreach ( $attachments as $attachment ) {
					$second = ( $i == 2 ) ? ' second' : '';

					$thumbnail = (
					$i == 1 ||
					$i == 3 ||
					$i == 5 ||
					$i == 7 ||
					$i == 9 ||
					$i == 11 ||
					$i == 13 ||
					$i == 15 ||
					$i == 17 ||
					$i == 19 ||
					$i == 21 ||
					$i == 23 ||
					$i == 25 ||
					$i == 27 ||
					$i == 29 ||
					$i == 31 ||
					$i == 33 ||
					$i == 35 ||
					$i == 37 ||
					$i == 39 ||
					$i == 41 ||
					$i == 43 ||
					$i == 45 ||
					$i == 47 ||
					$i == 49 ) ? 'masonry-std' : 'masonry-std2';

					$hidden = ( $i != 1 ) ? ' hidden' : 'first';

					if ( count( $attachments ) == 1 ) {
						$one_attachment = ' one-attachment';
						$thumbnail      = 'masonry-std2';

					} else {
							$one_attachment = '';
					}

					$src         = wp_get_attachment_image_src( $attachment->ID, $imagesize );
					$caption     = $attachment->post_excerpt;
					$lb_feat_img = wp_get_attachment_image( get_post_thumbnail_id( $postid ), $thumbnail, false, array( 'class' => $hidden . $second . $one_attachment ) );

					echo '<a class="' . $one_attachment . ' ' . $thumbnail . ' ' . $second . ' ' . $hidden . ' entry-link lightbox" rel="' . $postid . '" href="' . $src[0] . '" title="' . htmlspecialchars( $caption ) . '"></a>';
					echo $lb_feat_img;

					$i++;

				} //END foreach( $attachments as $attachment )
			} // END if( !empty($attachments) )
		} // END if( $layout == 'port-grid-lightbox' )

		// IF THE FUNCTION'S LAYOUT IS CALLING FOR THE GRID GALLERY
		if ( $layout == 'grid-gallery' ) {
			if ( ! empty( $attachments ) ) {
				$i = 1;

				foreach ( $attachments as $attachment ) {

					$caption  = $attachment->post_excerpt;
					 $caption = ( $caption ) ? "<div class='subtext fadein'>$caption</div>" : '';
					 $alt     = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
					$src      = wp_get_attachment_image_src( $attachment->ID, 'grid-feat' );
					$src2     = wp_get_attachment_image_src( $attachment->ID, 'portf-full' );

					// LIGHTBOX
					$lightbox = get_post_meta( $postid, '_bean_gallery_layout', true );
					?>

					<li class="item gallery-grid
					<?php
					if ( $lightbox != 'portfolio-lightbox' ) {
						echo 'no-lb';
					} else {
						echo 'lb'; }
?>
">
					<div class="portfolio">
						<?php if ( $lightbox == 'portfolio-lightbox' ) { ?>
									<?php echo '<a href="' . $src2[0] . '" class="lightbox " title="' . htmlspecialchars( $caption ) . '" rel="' . $postid . '" alt="' . $alt . '"><img height=' . $src[2] . ' width=' . $src[1] . ' src=' . $src[0] . ' alt=' . $alt . ' /></a>'; ?>
							<?php } else { ?>
									<?php echo "<img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />"; ?>
							<?php } ?>
					</div>
					</li>
				<?php
				}
			} // END if( !empty($attachments) )
		} // END if( $layout == 'gallery-grid' )

		// IF THE FUNCTION'S LAYOUT IS CALLING FOR THE GRID GALLERY
		if ( $layout == 'single-port-masonry-lightbox' ) {
			if ( ! empty( $attachments ) ) {
				$i = 1;

				foreach ( $attachments as $attachment ) {

					$second = ( $i == 2 ) ? ' second' : '';

					$thumbnail = (
					$i == 1 ||
					$i == 3 ||
					$i == 5 ||
					$i == 7 ||
					$i == 9 ||
					$i == 11 ||
					$i == 13 ||
					$i == 15 ||
					$i == 17 ||
					$i == 19 ||
					$i == 21 ||
					$i == 23 ||
					$i == 25 ||
					$i == 27 ||
					$i == 29 ||
					$i == 31 ||
					$i == 33 ||
					$i == 35 ||
					$i == 37 ||
					$i == 39 ||
					$i == 41 ||
					$i == 43 ||
					$i == 45 ||
					$i == 47 ||
					$i == 49 ) ? 'masonry-std' : 'masonry-std2';

					$hidden = ( $i != 1 ) ? ' hidden' : 'first';

					$caption = $attachment->post_excerpt;
					$caption = ( $caption ) ? "<div class='subtext fadein'>$caption</div>" : '';
					$alt     = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
					$src2    = wp_get_attachment_image_src( $attachment->ID, 'port-full' );

					// ARRAY TO RANDOM OUTPUT MASONRY
					$first  = wp_get_attachment_image_src( $attachment->ID, 'masonry-std' );
					$second = wp_get_attachment_image_src( $attachment->ID, 'masonry-std2' );
					$array  = array( $first, $second );

					$masonry_rdm = $array[ rand( 0, count( $array ) - 1 ) ];

					// LIGHTBOX
					$lightbox = get_post_meta( $postid, '_bean_gallery_layout', true );
				?>

				<li class="masonry-item grid-masonry
				<?php
				if ( $lightbox != 'portfolio-lightbox' ) {
					echo 'no-lb';
				} else {
					echo 'lb'; }
?>
">
					<div class="portfolio">
						<?php if ( $lightbox == 'portfolio-lightbox' ) { ?>
									<?php echo '<a href="' . $src2[0] . '" class="' . $hidden . ' lightbox " title="' . htmlspecialchars( $caption ) . '" rel="' . $postid . '" alt="' . $alt . '"><img height=' . $masonry_rdm[2] . ' width=' . $masonry_rdm[1] . ' src=' . $masonry_rdm[0] . ' alt=' . $alt . ' /></a>'; ?>
							<?php } else { ?>
									<?php echo "<img height='$masonry_rdm[2]' width='$masonry_rdm[1]' src='$masonry_rdm[0]' alt='$alt' />"; ?>
							<?php } ?>
					</div>
					</li>
				<?php
				}
			} // END if( !empty($attachments) )
		} // END if( $layout == 'gallery-grid' )

	} // END function spaces_gallery
} // END if ( !function_exists( 'spaces_gallery' ) )

if ( ! function_exists( 'bean_audio' ) ) {
	function bean_audio( $postid ) {
		// MP3 FROM POST/PORTFOLIO
		$mp3 = get_post_meta( $postid, '_bean_audio_mp3', true );
		?>

		<div id="jp_container_<?php echo esc_attr( $postid ); ?>" class="jp-audio fullwidth" data-file="<?php echo esc_url( $mp3 ); ?>">
			<div id="jquery_jplayer_<?php echo esc_attr( $postid ); ?>" class="jp-jplayer">
			</div><!-- END .jquery_jplayer_<?php echo esc_attr( $postid ); ?> -->
			<div class="jp-interface" style="display: none;">
				<ul class="jp-controls">
					<li><a href="javascript:;" class="jp-play" tabindex="1" title="Play"><span><?php _e( 'Play', 'spaces' ); ?></span></a></li>
					<li><a href="javascript:;" class="jp-pause" tabindex="1" title="Pause"><span><?php _e( 'Pause', 'spaces' ); ?></span></a></li>
				</ul><!-- END .jp-controls -->
				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div><!-- END .jp-seek-bar -->
				</div><!-- END .jp-progress -->
			</div><!-- END .jp-interface -->
		</div><!-- END #jp_container_<?php echo esc_attr( $postid ); ?> -->

		<?php
	} // END function bean_audio($postid)
} // END if ( !function_exists( 'bean_audio' ) )
