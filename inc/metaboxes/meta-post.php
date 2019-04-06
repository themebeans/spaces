<?php
/**
 * The file is for creating the blog post type meta.
 * Meta output is defined on the page editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

add_action( 'add_meta_boxes', 'bean_metabox_post' );
function bean_metabox_post() {

	$prefix = '_bean_';

	/*
	===================================================================*/
	/*
	  PAGE META SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'page-meta',
		'title'    => esc_html__( 'Page Meta Settings', 'spaces' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Display Fullwidth Media:', 'spaces' ),
				'id'   => $prefix . 'fullwidth_media',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Display the fullwidth media container.', 'spaces' ),
				'std'  => true,
			),
			array(
				'name' => esc_html__( 'Fullwidth Image URL:', 'spaces' ),
				'desc' => esc_html__( 'Upload an image for the standard fullwidth media. ', 'spaces' ),
				'id'   => $prefix . 'fullwidth_image',
				'type' => 'file',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Fullwidth Image Caption:', 'spaces' ),
				'desc' => esc_html__( 'A caption for your fullwidth image', 'spaces' ),
				'id'   => $prefix . 'fullwidth_caption',
				'type' => 'text',
				'std'  => '',
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
		'id'       => 'bean-meta-box-audio',
		'title'    => esc_html__( 'Audio Post Format Settings', 'spaces' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => esc_html__( 'MP3 File URL:', 'spaces' ),
				'desc' => esc_html__( 'Upload or link to an MP3 file.', 'spaces' ),
				'id'   => $prefix . 'audio_mp3',
				'type' => 'file',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Poster Image:', 'spaces' ),
				'desc' => esc_html__( 'Upload or link a poster image.', 'spaces' ),
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
	  GALLERY POST FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'bean-meta-box-gallery',
		'title'    => esc_html__( 'Image/Gallery Post Format Settings', 'spaces' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => 'Gallery Images:',
				'desc' => 'Upload images here for your gallery post. Once uploaded, drag & drop to reorder.',
				'id'   => $prefix . 'post_upload_images',
				'type' => 'images',
				'std'  => esc_html__( 'Browse & Upload', 'spaces' ),
			),
			array(
				'name' => esc_html__( 'Randomize Gallery:', 'spaces' ),
				'id'   => $prefix . 'post_randomize',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Randomize the gallery on page load.', 'spaces' ),
				'std'  => false,
			),
		),
	);
	bean_add_meta_box( $meta_box );

	/*
	===================================================================*/
	/*
	  LINK POST FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'bean-meta-box-link',
		'title'    => esc_html__( 'Link Post Format Settings', 'spaces' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Link Title:', 'spaces' ),
				'desc' => esc_html__( 'The title for your link.', 'spaces' ),
				'id'   => $prefix . 'link_title',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Link URL:', 'spaces' ),
				'desc' => esc_html__( 'ex: http://themebeans.com', 'spaces' ),
				'id'   => $prefix . 'link_url',
				'type' => 'text',
				'std'  => 'http://',
			),
		),

	);
	bean_add_meta_box( $meta_box );

	/*
	===================================================================*/
	/*
	  QUOTE POST FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'bean-meta-box-quote',
		'title'    => esc_html__( 'Quote Post Format Settings', 'spaces' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Quote Text:', 'spaces' ),
				'desc' => esc_html__( 'Insert your quote into this textarea.', 'spaces' ),
				'id'   => $prefix . 'quote',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Quote Source:', 'spaces' ),
				'desc' => esc_html__( 'Who said the quote above?', 'spaces' ),
				'id'   => $prefix . 'quote_source',
				'type' => 'text',
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
		'id'       => 'bean-meta-box-video',
		'title'    => esc_html__( 'Video Post Format Settings', 'spaces' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Embeded Code:', 'spaces' ),
				'desc' => esc_html__( 'Include your video embed code here.', 'spaces' ),
				'id'   => $prefix . 'video_embed',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Embeded Video URL:', 'spaces' ),
				'desc' => esc_html__( 'The direct URL to your embedded video.', 'spaces' ),
				'id'   => $prefix . 'video_embed_url',
				'type' => 'text',
				'std'  => 'http://player.vimeo.com/video/42411918',
			),
		),
	);
	bean_add_meta_box( $meta_box );
} // END function bean_metabox_post()
