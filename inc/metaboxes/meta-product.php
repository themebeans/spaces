<?php
/**
 * The file is for creating the product post type meta.
 * Meta output is defined on the page editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

add_action( 'add_meta_boxes', 'bean_metabox_product' );
function bean_metabox_product() {

	$prefix = '_bean_';

	/*
	===================================================================*/
	/*
	  PAGE META SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'product-meta',
		'title'    => esc_html__( 'Product Meta', 'spaces' ),
		'page'     => 'product',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Product Excerpt:', 'spaces' ),
				'desc' => esc_html__( 'A mini description of your product, to be displayed on the shop page.', 'spaces' ),
				'id'   => $prefix . 'product_excerpt',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Product Grid Image:', 'spaces' ),
				'desc' => 'Upload an image to deploy on the shop pages.',
				'id'   => $prefix . 'product_grid_image',
				'type' => 'file',
				'std'  => '',
			),
		),
	);
	bean_add_meta_box( $meta_box );

} // END function bean_metabox_page()
