<?php
/**
 * The file is for creating the product post type meta.
 * Meta output is defined on the page editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

add_action( 'add_meta_boxes', 'bean_metabox_download' );
function bean_metabox_download() {

	$prefix = '_bean_';

	/*
	===================================================================*/
	/*
	  PAGE META SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'download-meta',
		'title'    => esc_html__( 'Download Meta', 'spaces' ),
		'page'     => 'download',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Download Excerpt:', 'spaces' ),
				'desc' => esc_html__( 'A mini description of your download, to be displayed on the downloads page.', 'spaces' ),
				'id'   => $prefix . 'download_excerpt',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Download Grid Image:', 'spaces' ),
				'desc' => 'Upload an image to deploy on the downloads pages.',
				'id'   => $prefix . 'download_grid_image',
				'type' => 'file',
				'std'  => '',
			),
		),
	);
	bean_add_meta_box( $meta_box );

} // END function bean_metabox_page()
