<?php
/**
 * The content for the displaying on both the testimonials template & the testimonials shortcode.
 * The shortcode ouput is [testimonials]
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */
	?>

<ul class="avatar-list">

	<?php
	$i    = 1;
	$args = array(
		'post_type'      => 'testimonial',
		'posts_per_page' => '20',
		'order'          => 'ASC',
		'orderby'        => 'menu_order',
	);
	query_posts( $args );
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();

			$class     = ( $i == 10 || $i == 20 || $i == 30 ) ? 'last' : ''; // ADDS A LAST CLASS TO THE LAST AVATAR IN EACH ROW
			$first     = ( $i == 1 ) ? 'active' : ''; // ADDS AN ACTIVE CLASS TO THE FIRST AVATAR
			$mobile900 = ( $i == 7 || $i == 14 || $i == 21 ) ? ' mobile-900' : '';
			$mobile768 = ( $i == 5 || $i == 10 || $i == 15 || $i == 20 || $i == 25 || $i == 30 ) ? ' mobile-768' : '';
			$mobile400 = ( $i == 4 || $i == 8 || $i == 12 || $i == 16 || $i == 20 || $i == 24 || $i == 28 || $i == 32 ) ? ' mobile-400' : '';

			if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) {
	?>
				<li><a href="#testimonial-<?php the_ID(); ?>" class="testimonial-img
															<?php
															echo esc_attr( $class );
															echo esc_attr( $first );
															echo esc_attr( $mobile900 );
															echo esc_attr( $mobile768 );
															echo esc_attr( $mobile400 );
?>
"><?php the_post_thumbnail( 'testimonial-feat' ); ?><span class="testimonial-icon"></span></a></li>
			<?php
			}

			$i++;
	endwhile;
endif;
	?>

</ul><!-- END .avatar-list -->

<ul class="testimonial-list">
	<?php
	$args  = array(
		'post_type'      => 'testimonial',
		'posts_per_page' => '20',
		'order'          => 'ASC',
		'orderby'        => 'menu_order',
	);
	$count = 1;
	query_posts( $args );
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			$class = ( $count == 1 ) ? ' active' : '';

			if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) {
	?>
				<li id="testimonial-<?php the_ID(); ?>" class="testimonial <?php echo esc_attr( $class ); ?>">
					<h1><?php the_content(); ?></h1>
					<span class="subtext"><?php the_title(); ?></span>
				</li>
			<?php
			}

			$count++;
	endwhile;
endif;
	wp_reset_query();
	?>

</ul><!-- END .testimonial-list -->

<script type="text/javascript">
	jQuery(document).ready(function($) {
		//TESTIMONIALS
		if($('.testimonials').length){
			  $('.testimonials .avatar-list a').hover(function(){
				  $('.testimonials .avatar-list a.testimonial-link, .testimonials .testimonial, .testimonial-img').removeClass('active');
				  $(this).addClass('active');
				  $($(this).attr('href')).addClass('active');
			  });
			  $('.testimonials .avatar-list a').click(function(){ return false; });
		}
	});
</script>
