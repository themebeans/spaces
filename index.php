<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

get_header(); ?>

<div class="row fadein">

	<ul id="grid-container" class="grid">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'loop-post' );
			endwhile;
		endif;
		?>
	</ul>

</div>

<?php
get_footer();
