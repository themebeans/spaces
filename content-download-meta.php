<?php
/**
 * The file is for displaying the blog post meta.
 * This has it's own content file because we call it among various post formats.
 * If you edit this file, its output will be edited on all post formats.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

$feat_image      = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
$twitter_profile = get_theme_mod( 'twitter_profile' )
?>

<ul class="entry-meta download-meta subtext">

	<?php $terms = get_the_terms( $post->ID, 'download_category' ); ?>
	<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
		<li class="tax"><span><?php echo esc_html__( 'Categories: ', 'spaces' ); ?></span><?php the_terms( $post->ID, 'download_category', '', ', ', '' ); ?></li>
	<?php endif; ?>

	<li><span class="icon permalink"></span> <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'spaces' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo esc_html__( 'Permalink', 'spaces' ); ?></a></li>

	<?php if ( true === get_theme_mod( 'post_likes' ) ) { ?>
		<li><?php spaces_print_likes( $post->ID ); ?></li>
	<?php } ?>

</ul>
