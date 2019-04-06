<?php
/**
 * The content for the carousel portfolio template.
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

// PULL PAGINATION FROM READING SETTINGS
$paged = 1;
if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
}
if ( get_query_var( 'page' ) ) {
	$paged = get_query_var( 'page' );
}

// GET THE LOOP ORDERBY & META_KAY VARIABLES VIA THEME CUSTOMIZER
$orderby = get_theme_mod( 'portfolio_loop_orderby' );

// LOOP ORDERBY VARIABLE
if ( $orderby != '' ) {
	switch ( $orderby ) {
		case 'date':
			$order    = 'DSC';
			$orderby  = 'date';
			$meta_key = '';
			break;
		case 'rand':
			$order    = 'DSC';
			$orderby  = 'rand';
			$meta_key = '';
			break;
		case 'menu_order':
			$order    = 'ASC';
			$orderby  = 'menu_order';
			$meta_key = '';
			break;
		case 'view_count':
			$order    = 'DSC';
			$orderby  = 'meta_value_num';
			$meta_key = 'post_views_count';
			break;
	}
} ?>

<div class="row carousel portfolio fullscreen ">

	<div class="carousel-wrap fadein">

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
				if ( is_tax() ) {
					global $query_string;
					query_posts( "{$query_string}&posts_per_page=-1" );
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
											?>

												<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>

							<article class="crsl-item">
								<a title="<?php printf( esc_html__( 'Permanent Link to %s', 'spaces' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'grid-feat', array( 'class' => 'wide-image' ) ); ?>
									<div class="overlay"><h5><?php the_title(); ?></h5></div>
								</a>
							</article>

						<?php } //END if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) ?>

					<?php
					endwhile;
endif;
					wp_reset_postdata();

				} else {

					$args = array(
						'post_type'      => 'portfolio',
						'order'          => $order,
						'orderby'        => $orderby,
						'paged'          => $paged,
						'meta_key'       => $meta_key,
						'posts_per_page' => -1,
					);

					$wp_query = new WP_Query( $args );

					if ( $wp_query->have_posts() ) :
						while ( $wp_query->have_posts() ) :
							$wp_query->the_post();
											?>

												<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>

							<article class="crsl-item">
								<a title="<?php printf( esc_html__( 'Permanent Link to %s', 'spaces' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'grid-feat', array( 'class' => 'wide-image' ) ); ?>
									<div class="overlay"><h5><?php the_title(); ?></h5></div>
								</a>
							</article>

						<?php } //END if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) ?>

					<?php
					endwhile;
endif;

				} //END else
				?>

			</div><!-- END .crsl-wrap -->

			<nav id="carousel-nav" class="crsl-nav">
				<a href="#" class="next"><?php _e( 'Next', 'spaces' ); ?></a>
				<a href="#" class="previous"><?php _e( 'Previous', 'spaces' ); ?></a>
			</nav><!-- END .slides-navigation -->

		</div><!-- END .crsl-items -->

	</div><!-- END .carousel-wrap -->

</div><!-- END .row.carousel.portfolio.fullscreen -->

<ul class="home-slider-mobile fadein">

	<?php
	if ( $wp_query->have_posts() ) :
		while ( $wp_query->have_posts() ) :
			$wp_query->the_post();
?>

				<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) { ?>
			<li>
				<a class="entry-link" title="<?php printf( esc_html__( 'Permanent Link to %s', 'spaces' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>"></a>
				<?php the_post_thumbnail( 'port-feat' ); ?>
				<div class="overlay"><h3><?php the_title(); ?></h3></div>
			</li>
		<?php } //END if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) ?>

			<?php
	endwhile;
endif;
?>

</ul><!-- END .home-slider-mobile -->

