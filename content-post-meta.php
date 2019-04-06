<?php
/**
 * The file is for displaying the blog post meta.
 * This has it's own content file because we call it among various post formats.
 * If you edit this file, its output will be edited on all post formats.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

// SHARING
$feat_image      = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
$twitter_profile = get_theme_mod( 'twitter_profile' )
?>

<ul class="entry-meta subtext">

	<li><span><?php _e( 'By', 'spaces' ); ?></span> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></li>

	<li><span><?php _e( 'On', 'spaces' ); ?></span> <?php the_time( get_option( 'date_format' ) ); ?></li>

	<li><span><?php _e( 'In', 'spaces' ); ?></span> <?php the_category( ', ' ); ?></li>

	<?php if ( comments_open() ) { ?>
		<li><span><?php _e( 'With', 'spaces' ); ?></span> <a href="<?php comments_link(); ?>"><?php comments_number( esc_html__( '0 Comments', 'spaces' ), esc_html__( '1 Comment', 'spaces' ), esc_html__( '% Comments', 'spaces' ) ); ?></a></li>
	<?php } ?>

	<li><span class="icon permalink"></span> <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'spaces' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e( 'Permalink', 'spaces' ); ?></a></li>

	<?php if ( get_theme_mod( 'post_likes' ) == true ) { ?>
		<li><?php spaces_print_likes( $post->ID ); ?></li>
	<?php } ?>

</ul><!-- END .entry-meta.subtext -->
