<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

if ( ! defined( 'SPACES_DEBUG' ) ) :
	/**
	 * Check to see if development mode is active.
	 * If set to false, the theme will load un-minified assets.
	 */
	define( 'SPACES_DEBUG', true );
endif;

if ( ! defined( 'SPACES_ASSET_SUFFIX' ) ) :
	/**
	 * If not set to true, let's serve minified .css and .js assets.
	 * Don't modify this, unless you know what you're doing!
	 */
	if ( ! defined( 'SPACES_DEBUG' ) || true === SPACES_DEBUG ) {
		define( 'SPACES_ASSET_SUFFIX', null );
	} else {
		define( 'SPACES_ASSET_SUFFIX', '.min' );
	}
endif;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function spaces_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Tabor, use a find and replace
	 * to change 'spaces' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'spaces', get_parent_theme_file_path( '/languages' ) );

	/*
	 * Add default posts and comments RSS feed links to head.
	 */
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Filter Tabor's custom-background support argument.
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 * }
	 */
	$args = array(
		'default-color' => 'ffffff',
	);
	add_theme_support( 'custom-background', $args );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size( 140, 140 );

	add_image_size( 'sml-thumbnail', 50, 50, true );
	add_image_size( 'post-feat', 755, 9999, false );
	add_image_size( 'port-full', 1540, 9999, false );

	add_image_size( 'grid-feat', 500, 500, array( 'center', 'top' ) );
	add_image_size( 'masonry-std', 400, 620, false );
	add_image_size( 'masonry-std2', 400, 400, false );
	add_image_size( 'shop-grid', 500, 9999, false );
	add_image_size( 'shop-feat', 950, 9999, false );
	add_image_size( 'testimonial-feat', 128, 128, array( 'center', 'top' ) );

	// Set the content width in pixels, based on the theme's design and stylesheet.
	$GLOBALS['content_width'] = apply_filters( 'tabor_content_width', 700 );

	/*
	 * This theme uses wp_nav_menu() in the following locations.
	 */
	register_nav_menus(
		array(
			'primary-menu'   => esc_html__( 'Primary Menu', 'spaces' ),
			'secondary-menu' => esc_html__( 'Footer Menu', 'spaces' ),
			'mobile-menu'    => esc_html__( 'Mobile Menu', 'spaces' ),
		)
	);

	/*
	 * Switch default core taborup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support(
		'post-formats', array(
			'aside',
			'audio',
			'image',
			'gallery',
			'link',
			'quote',
			'video',
		)
	);

	/*
	 * This theme styles the visual editor to resemble the theme style.
	 */
	add_editor_style( array( 'assets/css/editor' . SPACES_ASSET_SUFFIX . '.css' ) );

	/*
	 * Enable support for Customizer Selective Refresh.
	 * See: https://make.wordpress.org/core/2016/02/16/selective-refresh-in-the-customizer/
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Enable support for the WordPress default Theme Logo
	 * See: https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo', array(
			'flex-width' => true,
		)
	);

	/*
	 * Enable support for WooCommerce
	 */
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
}
add_action( 'after_setup_theme', 'spaces_setup' );

/**
 * Register widget areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function spaces_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Internal Sidebar', 'spaces' ),
			'id'            => 'internal-sidebar',
			'description'   => esc_html__( 'Widget area for the primary sidebar.', 'spaces' ),
			'before_widget' => '<div class="widget %2$s clearfix">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="widget-title">',
			'after_title'   => '</h6>',
		)
	);

	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Shop Sidebar', 'spaces' ),
				'id'            => 'wc-sidebar',
				'description'   => esc_html__( 'Widget area for the shop pages.', 'spaces' ),
				'before_widget' => '<div class="widget %2$s clearfix">',
				'after_widget'  => '</div>',
				'before_title'  => '<h6 class="widget-title">',
				'after_title'   => '</h6>',
			)
		);
	}

	if ( class_exists( 'Easy_Digital_Downloads' ) ) {
		register_sidebar(
			array(
				'name'          => esc_html__( 'EDD Shop Sidebar', 'spaces' ),
				'id'            => 'edd-sidebar',
				'description'   => esc_html__( 'Widget area for the EDD shop pages.', 'spaces' ),
				'before_widget' => '<div class="widget %2$s clearfix">',
				'after_widget'  => '</div>',
				'before_title'  => '<h6 class="widget-title">',
				'after_title'   => '</h6>',
			)
		);
	}

	if ( true === get_theme_mod( 'hidden_sidebar' ) ) {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Hidden Sidebar', 'spaces' ),
				'id'            => 'hidden-sidebar',
				'description'   => esc_html__( 'Widget area for the hidden sidebar.', 'spaces' ),
				'before_widget' => '<div class="widget %2$s clearfix">',
				'after_widget'  => '</div>',
				'before_title'  => '<h6 class="widget-title">',
				'after_title'   => '</h6>',
			)
		);
	}

}
add_action( 'widgets_init', 'spaces_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function spaces_scripts() {

	// Load theme styles.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'spaces-style', get_parent_theme_file_uri( '/style' . SPACES_ASSET_SUFFIX . '.css' ) );
		wp_enqueue_style( 'spaces-child-style', get_theme_file_uri( '/style.css' ), false, '@@pkg.version', 'all' );
	} else {
		wp_enqueue_style( 'spaces-style', get_theme_file_uri( '/style' . SPACES_ASSET_SUFFIX . '.css' ) );
	}

	// Load custom theme styles.
	$theme_style = get_theme_mod( 'theme_style' );

	if ( 'theme_style_2' === $theme_style ) {
		wp_enqueue_style( 'spaces-style-2', get_theme_file_uri( '/assets/styles/style-2/style-2.css' ) );
	}
	if ( 'theme_style_3' === $theme_style ) {
		wp_enqueue_style( 'spaces-style-2', get_theme_file_uri( '/assets/styles/style-3/style-3.css' ) );
		wp_enqueue_style( 'roboto', 'https://fonts.googleapis.com/css?family=Roboto:400,500,700' );
	}
	if ( 'theme_style_4' === $theme_style ) {
		wp_enqueue_style( 'spaces-style-2', get_theme_file_uri( '/assets/styles/style-4/style-4.css' ) );
	}

	// Load Easy Digital Download styles.
	if ( class_exists( 'Easy_Digital_Downloads' ) ) {
		wp_enqueue_style( 'spaces-edd', get_theme_file_uri( '/assets/css/edd.css' ) );
	}

	// Load WooCommerce styles.
	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_style( 'spaces-woocommerce', get_theme_file_uri( '/assets/css/woocommerce.css' ) );
	}

	/**
	 * Now let's check the same for the scripts.
	 */
	if ( SPACES_DEBUG ) {

		// Vendor scripts.
		wp_enqueue_script( 'responsive-carousel', get_theme_file_uri( '/assets/js/vendors/responsiveCarousel.min.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'spaces-libraries', get_theme_file_uri( '/assets/js/vendors/custom-libraries.js' ), array( 'jquery' ), '@@pkg.version', true );

		// Custom scripts.
		wp_enqueue_script( 'spaces-coming-soon', get_theme_file_uri( '/assets/js/custom/coming-soon.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'spaces-global', get_theme_file_uri( '/assets/js/custom/global.js' ), array( 'jquery' ), '@@pkg.version', true );

		$translation_handle = 'spaces-global'; // Variable for wp_localize_script.

	} else {
		wp_enqueue_script( 'spaces-vendors-min', get_theme_file_uri( '/assets/js/vendors.min.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'spaces-custom-min', get_theme_file_uri( '/assets/js/custom.min.js' ), array( 'jquery' ), '@@pkg.version', true );

		$translation_handle = 'spaces-custom-min'; // Variable for wp_localize_script for minified javascript.
	}

	// Enqueue validation script.
	if ( is_page_template( 'template-contact.php' ) || is_singular( 'post' ) || is_singular( 'portfolio' ) ) {
		wp_enqueue_script( 'validation', 'https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', 'jquery', '1.9', true );
	}

	// Load the standard WordPress comments reply javascript.
	if ( is_singular( 'post' ) && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Enqueue masonry.
	wp_enqueue_script( 'masonry' );

	// Localization.
	$spaces_l10n['name']    = esc_html__( 'Name', 'spaces' );
	$spaces_l10n['email']   = esc_html__( 'Email', 'spaces' );
	$spaces_l10n['message'] = esc_html__( 'Message', 'spaces' );

	wp_localize_script( $translation_handle, 'spacesScreenReaderText', $spaces_l10n );
	wp_localize_script( $translation_handle, 'WP_TEMPLATE_DIRECTORY_URI', array( 0 => get_template_directory_uri() ) );
	wp_localize_script(
		$translation_handle, 'bean', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'bean-ajax' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'spaces_scripts' );

if ( ! function_exists( 'spaces_oddeven_post_class' ) ) {
	function spaces_oddeven_post_class( $classes ) {
		global $current_class;
		$classes[]     = $current_class;
		$current_class = ( $current_class == 'odd' ) ? 'even' : 'odd';
		return $classes;
	}
	add_filter( 'post_class', 'spaces_oddeven_post_class' );

	global $current_class;
	$current_class = 'odd';
}

if ( ! function_exists( 'spaces_sidebar_loader' ) ) {
	function spaces_sidebar_loader() {
		global $post, $bean_sidebar_location, $bean_sidebar_class, $bean_content_class;

		$bean_sidebar_location = get_post_meta( $post->ID, '_bean_page_layout', true );
		$bean_sidebar_class    = '';
		$bean_content_class    = '';

		if ( $bean_sidebar_location === 'right' ) {
			$bean_sidebar_class = 'four columns sidebar';
			$bean_content_class = 'eight columns sidebar-right';

		} elseif ( $bean_sidebar_location === 'std' ) {
			$bean_content_class = 'six columns centered mobile-four';
		} else {
			$bean_content_class = 'twelve columns content';
		}
	}
} //END if ( !function_exists( 'spaces_sidebar_loader' ) )

function spaces_get_post_views( $postID ) {
	$count_key = 'post_views_count';
	$count     = get_post_meta( $postID, $count_key, true );

	if ( $count == '' ) {
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
		return '0';
	}

	 return $count;
}

function spaces_set_post_views( $postID ) {
	$count_key = 'post_views_count';
	$count     = get_post_meta( $postID, $count_key, true );

	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
	} else {
		$count++;
		update_post_meta( $postID, $count_key, $count );
	}

}

function spaces_get_related_posts( $post_id, $taxonomy, $args = array() ) {
	$terms = wp_get_object_terms( $post_id, $taxonomy );

	if ( count( $terms ) ) {
		$post      = get_post( $post_id );
		$our_terms = array();
		foreach ( $terms as $term ) {
			$our_terms[] = $term->slug;
		}

		$args  = wp_parse_args(
			$args, array(
				'post_type'    => $post->post_type,
				'post__not_in' => array( $post_id ),
				'tax_query'    => array(
					array(
						'taxonomy' => $taxonomy,
						'terms'    => $our_terms,
						'field'    => 'slug',
						'operator' => 'IN',
					),
				),
				'orderby'      => 'rand',
			)
		);
		$query = new WP_Query( $args );
		return $query;
	} else {
		return false;
	}
}

function spaces_portfolio_masonry() {
	if ( ! is_404() ) {
		global $post;
		$postid           = $post->ID;
		$portfolio_layout = get_post_meta( $postid, '_bean_portfolio_layout', true );
		$theme_version    = get_theme_mod( 'theme_version' );

		if ( is_page_template( 'template-portfolio.php' ) && 'theme_version_std' === $theme_version ) { ?>

			<script type="text/javascript">
				jQuery(document).ready(function($) {
					//MASONRY
					var container = document.querySelector('#masonry-container');
					var msnry;
					imagesLoaded( container, function() {
						msnry = new Masonry( container, {
							itemSelector: '.masonry-item'
						});
					} );

				});
			</script>

		<?php
		}
	}
}
add_action( 'wp_footer', 'spaces_portfolio_masonry' );

function spaces_load_more_portfolio() {
	if ( ! wp_verify_nonce( $_POST['nonce'], 'bean-ajax' ) ) {
		die( 'Invalid nonce' );
	}
	if ( ! is_numeric( $_POST['page'] ) || $_POST['page'] < 0 ) {
		die( 'Invalid page' );
	}

	$load_more_data = $_POST['data'];
	$loop_template  = $load_more_data['loopTemplate'];
	$order          = $load_more_data['order'];
	$orderby        = $load_more_data['orderby'];
	$meta_key       = $load_more_data['metakey'];
	$posts_per_page = $load_more_data['postsCount'];

	$query_args = '';
	if ( isset( $_POST['archive'] ) && $_POST['archive'] ) {
		$query_args = $_POST['archive'] . '&';
	}
	$query_args .= 'post_type=portfolio&post_status=publish&posts_per_page=' . $posts_per_page . '&paged=' . $_POST['page'] . '&order=' . $order . '&orderby=' . $orderby . '&meta_key=' . $meta_key;

	// THE LOOP
	ob_start();

	$query = new WP_Query( $query_args );
	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) :
			$query->the_post();
			get_template_part( $loop_template );
	endwhile;
endif;
	wp_reset_postdata();

	$content = ob_get_contents();
	ob_end_clean();
	echo json_encode(
		array(
			'pages'   => $query->max_num_pages,
			'content' => $content,
		)
	);
	exit;
}
add_action( 'wp_ajax_spaces_load_more_portfolio', 'spaces_load_more_portfolio' );
add_action( 'wp_ajax_nopriv_spaces_load_more_portfolio', 'spaces_load_more_portfolio' );

function spaces_no_single_cpt_redirect() {
	$queried_post_type = get_query_var( 'post_type' );
	if ( is_single() && 'team' == $queried_post_type ) {
		wp_redirect( home_url( '/' ), 301 );
		exit;
	}

	if ( is_single() && 'testimonial' == $queried_post_type ) {
		wp_redirect( home_url( '/' ), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'spaces_no_single_cpt_redirect' );


function spaces_team_shortcode( $attr, $content ) {
	echo "<div class='row portfolio'>";
		get_template_part( 'content', 'team' );
	echo '</div>';
}
add_shortcode( 'team', 'spaces_team_shortcode' );

function spaces_testimonials_shortcode( $attr, $content ) {
	ob_start();

	echo "<div class='testimonials'>";
		get_template_part( 'content', 'testimonials' );
	echo '</div>';

	$ret = ob_get_contents();
	ob_end_clean();
	return $ret;
}
add_shortcode( 'testimonials', 'spaces_testimonials_shortcode' );

function spaces_portfolio_shortcode( $attr, $content ) {
	ob_start();

	echo "<div class='row portfolio'>";
		get_template_part( 'content', 'portfolio-shortcode' );
	echo '</div>';

	$ret = ob_get_contents();
	ob_end_clean();
	return $ret;
}
add_shortcode( 'portfolio', 'spaces_portfolio_shortcode' );

function spaces_comment( $comment, $args, $depth ) {
	$isByAuthor = false;

	if ( $comment->comment_author_email == get_the_author_meta( 'email' ) ) {
		$isByAuthor = true;
	}

	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">

			<div class="comment-author vcard">
					<?php echo get_avatar( $comment, $size = '45' ); ?>
				<?php printf( __( '<cite class="fn">%s</cite> ', 'spaces' ), get_comment_author_link() ); ?> <?php
				if ( $isByAuthor ) {
?>
<span class="author-tag"><?php _e( '(Author)', 'spaces' ); ?></span><?php } ?>
			</div><!-- END .comment-author.vcard -->

			<div class="comment-meta commentmetadata subtext">
				<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( esc_html__( '%1$s at %2$s', 'spaces' ), get_comment_date(), get_comment_time() ); ?></a><?php edit_comment_link( esc_html__( 'Edit', 'spaces' ), ' &middot; ', '' ); ?>   &middot;
									<?php
									comment_reply_link(
										array_merge(
											$args, array(
												'depth' => $depth,
												'max_depth' => $args['max_depth'],
											)
										)
									);
?>
			</div><!-- END .comment-meta.commentmetadata.subtext -->

			<div class="comment-body">
				<?php if ( $comment->comment_approved == '0' ) : ?>
						<span class="moderation"><?php _e( 'Awaiting Moderation', 'spaces' ); ?></span>
					<?php endif; ?>
			<?php comment_text(); ?>
			</div><!-- END .comment-body -->

		</div><!-- END #comment-<?php comment_ID(); ?> -->
	</li>
<?php
}

function spaces_ping( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>

	<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>

	<?php
}

function spaces_custom_form_filters( $args = array(), $post_id = null ) {
	global $id;

	if ( null === $post_id ) {
		$post_id = $id;
	} else {
		$id = $post_id;
	}

	$commenter     = wp_get_current_commenter();
	$user          = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$fields = array(
		'author' => '
			<div class="comment-form-author clearfix">
				<label for="author" class="subtext">' . esc_html__( 'Name', 'spaces' ) . ( '<span class="required">*</span>' ) . '</label>
				<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required/>
			</div>',

		'email'  => '
			<div class="comment-form-email clearfix">
			<label for="email" class="subtext">' . esc_html__( 'Email', 'spaces' ) . ( '<span class="required">*</span>' ) . '</label>
				<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" required/>
			</div>',

		'url'    => '
			<div class="comment-form-url">
				<label for="url" class="subtext">' . esc_html__( 'Website', 'spaces' ) . '</label>
				<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30"/>
			</div>',
	);

	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<div class="comment-form-message clearfix"><label for="comment" class="subtext">' . esc_html__( 'Comment', 'spaces' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8"  required></textarea></div>',
		'',
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'spaces' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as subtext">' . sprintf( __( 'Currently logged in as <a href="%1$s">%2$s</a> / <a href="%3$s" title="Log out of this account">Logout</a>', 'spaces' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => null,
		'comment_notes_after'  => null,
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'class_submit'         => 'submit',
		'name_submit'          => 'submit',
		'submit_field'         => '<p class="form-submit">%1$s %2$s</a>',
		'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
		'title_reply'          => sprintf( esc_html__( 'Leave a Comment', 'spaces' ) ),
		'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'spaces' ),
		'cancel_reply_link'    => esc_html__( 'Cancel', 'spaces' ),
		'label_submit'         => esc_html__( 'Submit Comment', 'spaces' ),
	);

	return $defaults;
}
add_filter( 'comment_form_defaults', 'spaces_custom_form_filters' );

/**
 * Change carousel options on single product page
 *
 * @param array
 * @return array
 */
function spaces_product_carousel_options( $options ) {
	$options['smoothHeight'] = true;

	return $options;
}
add_filter( 'woocommerce_single_product_carousel_options', 'spaces_product_carousel_options' );

if ( ! function_exists( 'spaces_pingback_header' ) ) :
	/**
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 */
	function spaces_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
		}
	}
	add_action( 'wp_head', 'spaces_pingback_header' );
endif;

/**
 * Custom template tags for this theme.
 */
require get_theme_file_path( '/inc/template-tags.php' );

/**
 * Customizer additions.
 */
require get_theme_file_path( '/inc/customizer/customizer.php' );
require get_theme_file_path( '/inc/customizer/customizer-css.php' );
require get_theme_file_path( '/inc/customizer/fonts.php' );
require get_theme_file_path( '/inc/customizer/font-library.php' );

/**
 * Metaboxes.
 */
require get_theme_file_path( '/inc/metaboxes/metaboxes.php' );
require get_theme_file_path( '/inc/metaboxes/meta-page.php' );
require get_theme_file_path( '/inc/metaboxes/meta-post.php' );
require get_theme_file_path( '/inc/metaboxes/meta-portfolio.php' );
require get_theme_file_path( '/inc/metaboxes/meta-team.php' );
require get_theme_file_path( '/inc/metaboxes/meta-product.php' );
require get_theme_file_path( '/inc/metaboxes/meta-download.php' );

/**
 * Media.
 */
require get_theme_file_path( '/inc/media.php' );

/**
 * Likes.
 */
require get_theme_file_path( '/inc/likes.php' );

/**
 * Widgets.
 */
require get_theme_file_path( '/inc/widgets/widget-flickr.php' );
require get_theme_file_path( '/inc/widgets/widget-portfolio.php' );
require get_theme_file_path( '/inc/widgets/widget-portfolio-filter.php' );
require get_theme_file_path( '/inc/widgets/widget-portfolio-menu.php' );
require get_theme_file_path( '/inc/widgets/widget-portfolio-taxonomy.php' );

/**
 * Admin specific functions.
 */
require get_parent_theme_file_path( '/inc/admin/init.php' );

/**
 * Disable Merlin WP.
 */
function themebeans_merlin() {}

/**
 * Disable Dashboard Doc.
 */
function themebeans_guide() {}
