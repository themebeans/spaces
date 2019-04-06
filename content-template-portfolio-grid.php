<?php
/**
 * The content for grid template files.
 * The following files use the get_template_part function to pull this file:
 * template-portfolio-grid.php
 * template-portfolio-grid-lightbox.php
 * template-portfolio-grid-fullwidth.php
 * template-portfolio-grid-fullwidth-lightbox.php
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */


// TEMPLATE VARIABLES
if ( is_page_template( 'template-portfolio-grid-fullwidth.php' ) ) {
	$full     = true;
	$lightbox = false;
	$masonry  = false;
	$loop     = 'loop-portfolio-grid';
} elseif ( is_page_template( 'template-portfolio-grid-fullwidth-lightbox.php' ) ) {
	$full     = true;
	$lightbox = true;
	$masonry  = false;
	$loop     = 'loop-portfolio-grid-lightbox';
} elseif ( is_page_template( 'template-portfolio-grid-lightbox.php' ) ) {
	$full     = false;
	$lightbox = true;
	$masonry  = false;
	$loop     = 'loop-portfolio-grid-lightbox';
} elseif ( is_page_template( 'template-portfolio-masonry.php' ) ) {
	$full     = false;
	$lightbox = false;
	$masonry  = true;
	$loop     = '';
} elseif ( is_page_template( 'template-portfolio-masonry-fullwidth.php' ) ) {
	$full     = true;
	$lightbox = false;
	$masonry  = true;
	$loop     = '';
} elseif ( is_page_template( 'template-portfolio-masonry-lightbox.php' ) ) {
	$full     = false;
	$lightbox = true;
	$masonry  = true;
	$loop     = '';
} elseif ( is_page_template( 'template-portfolio-masonry-fullwidth-lightbox.php' ) ) {
	$full     = true;
	$lightbox = true;
	$masonry  = true;
	$loop     = '';
} else {
	$full     = false;
	$lightbox = false;
	$masonry  = false;
	$loop     = 'loop-portfolio-grid';
}

// LAYOUT SWITCHER
$theme_version = get_theme_mod( 'theme_version' );

if ( $theme_version == 'theme_version_masonry' && ! is_page_template( 'template-portfolio-masonry-lightbox.php' ) ) {
	$full     = false;
	$lightbox = false;
	$masonry  = true;
	$loop     = '';
}

if ( $theme_version == 'theme_version_masonry_full' && ! is_page_template( 'template-portfolio-masonry-fullwidth-lightbox.php' ) ) {
	$full     = true;
	$lightbox = false;
	$masonry  = true;
	$loop     = '';
}

// PULL PAGINATION FROM CUSTOMIZATION
$portfolio_posts_count = get_theme_mod( 'portfolio_posts_count' );

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
}

// SET PORTFOLIO LOOP
$args = array(
	'post_type'      => 'portfolio',
	'order'          => $order,
	'orderby'        => $orderby,
	'paged'          => $paged,
	'meta_key'       => $meta_key,
	'posts_per_page' => $portfolio_posts_count,
);

$portfolios = new WP_Query( $args );
?>

<div class="row fadein portfolio
<?php
if ( $full == true ) {
	echo ' fullscreen';}
?>
">

	<?php if ( $masonry == true ) { ?>
		<ul id="masonry-container" class="grid
		<?php
		if ( $full == true ) {
			echo ' fullscreen';}
?>
	<?php echo get_theme_mod( 'portfolio_column_width' ); ?>">
	<?php } else { ?>
		<ul id="portfolio-grid" class="grid hfeed
		<?php
		if ( $full == true ) {
			echo ' fullscreen';}
?>
	<?php echo get_theme_mod( 'portfolio_column_width' ); ?>">
	<?php
}

		$i = 1;
if ( is_tax() ) {
	global $query_string;
	query_posts( "{$query_string}&posts_per_page=-1" );
} else {
	query_posts( $args );
}

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		// GENERATE TERMS FOR FILTER PORTFOLIO TEMPLATE
		$terms     = get_the_terms( $post->ID, 'portfolio_category' );
		$term_list = null;
		if ( is_array( $terms ) ) {
			foreach ( $terms as $term ) {
				$term_list .= $term->term_id;
				$term_list .= ' '; }
		}

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

			// WE ARE PULLING THE MASONRY PORTFOLIO LOOP HERE SO THAT THE $1 VALUE WILL PULL MULTIPLE LOOPS
		if ( $masonry == true ) {
			if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) {
				?>

				 <li id="portfolio-<?php the_ID(); ?>" class="item masonry-item grid-masonry type-portfolio <?php echo esc_attr( $thumbnail ); ?> <?php echo esc_attr( $term_list ); ?>">

					  <div id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio' ); ?>>

							<?php
							if ( $lightbox == true ) {
								spaces_gallery( $post->ID, '', 'port-masonry-lightbox', 'post__in', true );
							} else {
								?>
								<a class="entry-link" title="<?php printf( esc_html__( 'Permanent Link to %s', 'spaces' ), get_the_title() ); ?>" href="<?php the_permalink(); ?>"></a>
								<?php
								the_post_thumbnail( $thumbnail );
							}
							?>

						  <div class="overlay"><h5><?php the_title(); ?></h5></div>

						  </div>

						 </li>

				<?php
			} //END if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) )
		} else {

			get_template_part( $loop );

		} //END if ( $masonry == true )

			$i++;
endwhile;
endif;

		// OUTPUT THE LOAD MORE POSTS FEATURE FOR THE GRID PORTFOLIOS
if ( $masonry != true ) {
	if ( $wp_query->max_num_pages > 1 ) {

		$portfolio_items_container = '#post-loader';
		$loop_template             = $loop;
				?>

				<div id="post-loader" class="item"></div>

				<li id="load-more" class="item masonry-item grid-masonry">
					<div class="portfolio">
						<a href="#" class="entry-link" id="load-posts" data-posts-container="<?php echo esc_attr( $portfolio_items_container ); ?>" data-load-more-action="spaces_load_more_portfolio" data-loop-template="<?php echo $loop_template; ?>" data-order="<?php echo $order; ?>" data-orderby="<?php echo $orderby; ?>" data-metakey="<?php echo $meta_key; ?>" data-posts-count="<?php echo $portfolio_posts_count; ?>">
							<span class="loading">
								<div class="spinner">
									<div class="spinner-container container1">
										<div class="circle1"></div>
										<div class="circle2"></div>
										<div class="circle3"></div>
										<div class="circle4"></div>
									</div>
									<div class="spinner-container container2">
										<div class="circle1"></div>
										<div class="circle2"></div>
										<div class="circle3"></div>
										<div class="circle4"></div>
									</div>
									<div class="spinner-container container3">
										<div class="circle1"></div>
										<div class="circle2"></div>
										<div class="circle3"></div>
										<div class="circle4"></div>
									</div>
								</div>
							</span>
						</a>

						<?php if ( get_theme_mod( 'theme_style' ) == 'theme_style_2' ) { ?>
							<img src="
							<?php
							echo get_template_directory_uri();
							echo '/assets/styles/style-2/images/placeholder.png';
?>
">
						<?php } else { ?>
							<img src="
							<?php
							echo get_template_directory_uri();
							echo '/assets/images/placeholder.png';
?>
">
						<?php } ?>

						<div class="overlay">
							<h5 class="load-more"><?php echo '<span>' . esc_html__( 'Load More', 'spaces' ) . '</span>'; ?></h5>
							<h5 class="load-finished"><?php echo '<span>' . esc_html__( 'Done Loading', 'spaces' ) . '</span>'; ?></h5>
						</div>
					</div>
				</li>

			<?php
	} //END if( $wp_query->max_num_pages > 1 )
} //END if ( $masonry != true )
		?>

	</ul><!-- END .hfeed -->

</div><!-- END.row -->

<script type="text/javascript">
jQuery(document).ready(function($) {

	<?php if ( $masonry == true ) { ?>

		//MASONRY
		var container = document.querySelector('#masonry-container');
		 var msnry;
		 imagesLoaded( container, function() {
			msnry = new Masonry( container, {
				itemSelector: '.masonry-item'
			});
		 });

	<?php } else { ?>

		//LOAD MORE
		var load_more = $('#load-posts')
		var load_more_item = $('#load-more')
		  page = 1;

		  load_more.click(function() {

			  if (load_more.hasClass('loading')) return false;

			  load_more.addClass('loading');
			  load_more_item.addClass('loading');

			var $container = $($(this).data('posts-container'));
			var isIsotope = $(this).data('is-isotope') == true;

			  page++;

			  $.post(bean.ajaxurl, { action: $(this).data("load-more-action"), data: $(this).data(), nonce:bean.nonce, page:page}, function(data)
			  {
				  var content = $(data.content);
				  $(content).imagesLoaded(function()
				  {
					   $container.preContentAppendHeight = $container.height();
					  $container.append(content);

						//ADD A CLASS TO THE NEWLY APPENNDED POSTS
						content.addClass("fadein");

						// MANUALLY ANIMATE HEIGHT
						$container.postContentAppendHeight = $container.height();
						$container.height($container.preContentAppendHeight);

					  //DONE LOADING ACTIONS
					  setTimeout(function() {
						  load_more.removeClass('loading');
						  load_more_item.removeClass('loading');
					  }, 500);

					  //CHECK IF NO PAGES ARE LEFT TO LOAD - DO THESE ACTIONS
					  if(page >= data.pages) {
						  setTimeout(function() {
							  load_more.addClass('load-more-out');
							  load_more_item.addClass('load-more-out');
							  $('#load-more .overlay h5.load-finished').addClass('visible');
							  $('#load-more .overlay h5.load-more').addClass('hidden');
						  }, 500);
					  }
				  });

			  }, 'json');

			  return false;
		 });

	<?php } //END if ( $masonry == true ) ?>
});
</script>

<?php
get_footer();
