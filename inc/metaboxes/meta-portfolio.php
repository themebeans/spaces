<?php
/**
 * The file is for creating the portfolio post type meta.
 * Meta output is defined on the portfolio single editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

add_action( 'add_meta_boxes', 'bean_metabox_portfolio' );
function bean_metabox_portfolio() {

	$prefix = '_bean_';

	/*
	===================================================================*/
	/*
	  PORTFOLIO FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'          => 'portfolio-type',
		'title'       => esc_html__( 'Portfolio Format', 'spaces' ),
		'description' => esc_html__( '', 'spaces' ),
		'page'        => 'portfolio',
		'context'     => 'side',
		'priority'    => 'core',
		'fields'      => array(
			array(
				'name' => esc_html__( 'Gallery', 'spaces' ),
				'desc' => esc_html__( '', 'spaces' ),
				'id'   => $prefix . 'portfolio_type_gallery',
				'type' => 'checkbox',
				'std'  => true,
			),
			array(
				'name' => esc_html__( 'Audio', 'spaces' ),
				'desc' => esc_html__( '', 'spaces' ),
				'id'   => $prefix . 'portfolio_type_audio',
				'type' => 'checkbox',
				'std'  => false,
			),
			array(
				'name' => esc_html__( 'Video', 'spaces' ),
				'desc' => esc_html__( '', 'spaces' ),
				'id'   => $prefix . 'portfolio_type_video',
				'type' => 'checkbox',
				'std'  => false,
			),
		),
	);
	bean_add_meta_box( $meta_box );

	/*
	===================================================================*/
	/*
	  PORTFOLIO META SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'          => 'portfolio-meta',
		'title'       => esc_html__( 'Portfolio Settings', 'spaces' ),
		'description' => esc_html__( '', 'spaces' ),
		'page'        => 'portfolio',
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'name'    => esc_html__( 'Portfolio Layout:', 'spaces' ),
				'desc'    => esc_html__( 'Choose the layout for this portfolio post.', 'spaces' ),
				'id'      => $prefix . 'portfolio_layout',
				'type'    => 'select',
				'std'     => 'default',
				'options' => array(
					'default'    => esc_html__( 'Default', 'spaces' ),
					'carousel'   => esc_html__( 'Carousel', 'spaces' ),
					'fullwidth'  => esc_html__( 'Fullwidth', 'spaces' ),
					'fullscreen' => esc_html__( 'Fullscreen', 'spaces' ),
					'grid'       => esc_html__( 'Gallery Grid', 'spaces' ),
					'masonry'    => esc_html__( 'Masonry', 'spaces' ),
					'edge'       => esc_html__( 'Edge to Edge', 'spaces' ),
					'std'        => esc_html__( 'Standard', 'spaces' ),
				),
			),
			array(
				'name' => esc_html__( 'Portfolio Client:', 'spaces' ),
				'desc' => esc_html__( 'Display the client meta.', 'spaces' ),
				'id'   => $prefix . 'portfolio_client',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Portfolio URL:', 'spaces' ),
				'desc' => esc_html__( 'Insert a URL to link your post to.', 'spaces' ),
				'id'   => $prefix . 'portfolio_url',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Display Content:', 'spaces' ),
				'id'   => $prefix . 'portfolio_content_display',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Display the portfolio content on this post.', 'spaces' ),
				'std'  => true,
			),
			array(
				'name' => esc_html__( 'Display Custom Meta:', 'spaces' ),
				'id'   => $prefix . 'portfolio_custom_meta',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Display any custom meta fields.', 'spaces' ),
				'std'  => false,
			),
			array(
				'name' => esc_html__( 'Display Date:', 'spaces' ),
				'id'   => $prefix . 'portfolio_date',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Can be modified in your Dashboard General Settings.', 'spaces' ),
				'std'  => true,
			),
			array(
				'name' => esc_html__( 'Display Categories:', 'spaces' ),
				'id'   => $prefix . 'portfolio_cats',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Select to display the portfolio categories.', 'spaces' ),
				'std'  => true,
			),
			array(
				'name' => esc_html__( 'Display Views:', 'spaces' ),
				'id'   => $prefix . 'portfolio_views',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Select to display the view counter.', 'spaces' ),
				'std'  => true,
			),
			array(
				'name' => esc_html__( 'Display Tags:', 'spaces' ),
				'id'   => $prefix . 'portfolio_tags',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Select to display the portfolio tags.', 'spaces' ),
				'std'  => false,
			),
			array(
				'name' => esc_html__( 'Display More Posts:', 'spaces' ),
				'id'   => $prefix . 'portfolio_more',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Display a portfolio grid below your post.', 'spaces' ),
				'std'  => true,
			),
			array(
				'name' => esc_html__( 'Portfolio Review:', 'spaces' ),
				'desc' => esc_html__( 'Add a review section to your standard or fullwidth layout post.', 'spaces' ),
				'id'   => $prefix . 'portfolio_review',
				'type' => 'textarea',
				'std'  => '',
			),
		),
	);
	bean_add_meta_box( $meta_box );

	/*
	===================================================================*/
	/*
	  GALLERY POST FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'bean-meta-box-portfolio-images',
		'title'    => esc_html__( 'Gallery Settings', 'spaces' ),
		'page'     => 'portfolio',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name'    => esc_html__( 'Gallery Layout:', 'spaces' ),
				'desc'    => esc_html__( 'Choose which layout to display for this portfolio post.', 'spaces' ),
				'id'      => $prefix . 'gallery_layout',
				'type'    => 'select',
				'std'     => 'stacked',
				'options' => array(
					'stacked'            => esc_html__( 'Standard', 'spaces' ),
					'portfolio-lightbox' => esc_html__( 'Lightbox Viewer', 'spaces' ),
				),
			),
			array(
				'name' => esc_html__( 'Gallery Images:', 'spaces' ),
				'desc' => esc_html__( 'Upload images here for your gallery post. Once uploaded, drag & drop to reorder.', 'spaces' ),
				'id'   => $prefix . 'portfolio_upload_images',
				'type' => 'images',
				'std'  => esc_html__( 'Browse & Upload', 'spaces' ),
			),
			array(
				'name' => esc_html__( 'Randomize Gallery:', 'spaces' ),
				'id'   => $prefix . 'portfolio_randomize',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Randomize the gallery on page load.', 'spaces' ),
				'std'  => false,
			),
			array(
				'name' => esc_html__( 'Fullscreen Image:', 'spaces' ),
				'desc' => esc_html__( 'Upload an image to deploy on the Fullscreen & Fullwidth Portfolio Templates.', 'spaces' ),
				'id'   => $prefix . 'home_slider_image',
				'type' => 'file',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Feature in Home Slider:', 'spaces' ),
				'id'   => $prefix . 'portfolio_feature',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Feature this post on the Fullscreen Portfolio Template.', 'spaces' ),
				'std'  => true,
			),
		),
	);
	bean_add_meta_box( $meta_box );

	/*
	===================================================================*/
	/*
	  SLIDESHOW SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'bean-meta-box-portfolio-slideshow',
		'title'    => esc_html__( 'Fullscreen Slideshow Settings', 'spaces' ),
		'page'     => 'portfolio',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name'    => esc_html__( 'Slideshow Animation', 'spaces' ),
				'desc'    => esc_html__( 'Select the animation style for this post.', 'spaces' ),
				'id'      => $prefix . 'fullscreen_animation',
				'type'    => 'select',
				'std'     => 'slide',
				'options' => array(
					'slide' => esc_html__( 'Slide', 'spaces' ),
					'fade'  => esc_html__( 'Fade', 'spaces' ),
				),
			),
			array(
				'name' => esc_html__( 'Display Pagination:', 'spaces' ),
				'id'   => $prefix . 'fullscreen_pagination',
				'desc' => esc_html__( 'Select to display the slide pagination.', 'spaces' ),
				'type' => 'checkbox',
				'std'  => false,
			),
			array(
				'name' => esc_html__( 'Autoplay Slideshow', 'spaces' ),
				'id'   => $prefix . 'fullscreen_autoplay',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Select to autoplay the fullscreen slideshow.', 'spaces' ),
				'std'  => false,
			),
			array(
				'name' => esc_html__( 'Autoplay Time:', 'spaces' ),
				'id'   => $prefix . 'fullscreen_autoplay_time',
				'desc' => esc_html__( 'The time in milliseconds for the slideshow to animate.', 'spaces' ),
				'type' => 'text',
				'std'  => '5000',
			),
		),
	);
	bean_add_meta_box( $meta_box );

	/*
	===================================================================*/
	/*
	  AUDIO POST FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'bean-meta-box-portfolio-audio',
		'title'    => esc_html__( 'Audio Post Format Settings', 'spaces' ),
		'page'     => 'portfolio',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => esc_html__( 'MP3 File URL:', 'spaces' ),
				'desc' => esc_html__( '', 'spaces' ),
				'id'   => $prefix . 'audio_mp3',
				'type' => 'file',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Poster Image:', 'spaces' ),
				'desc' => esc_html__( 'The preview image for this audio track', 'spaces' ),
				'id'   => $prefix . 'audio_poster_url',
				'type' => 'file',
				'std'  => '',
			),
		),
	);
	bean_add_meta_box( $meta_box );

	/*
	===================================================================*/
	/*
	  VIDEO POST FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'bean-meta-box-portfolio-video',
		'title'    => esc_html__( 'Video Post Format Settings', 'spaces' ),
		'page'     => 'portfolio',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Embed 1:', 'spaces' ),
				'desc' => esc_html__( 'Insert your embeded code here.', 'spaces' ),
				'id'   => $prefix . 'portfolio_embed_code',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Embed 2:', 'spaces' ),
				'desc' => esc_html__( 'Insert your embeded code here.', 'spaces' ),
				'id'   => $prefix . 'portfolio_embed_code_2',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Embed 2:', 'spaces' ),
				'desc' => esc_html__( 'Insert your embeded code here.', 'spaces' ),
				'id'   => $prefix . 'portfolio_embed_code_3',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Embed 3:', 'spaces' ),
				'desc' => esc_html__( 'Insert your embeded code here.', 'spaces' ),
				'id'   => $prefix . 'portfolio_embed_code_4',
				'type' => 'textarea',
				'std'  => '',
			),
		),

	);
	bean_add_meta_box( $meta_box );
} // END function bean_metabox_portfolio()
