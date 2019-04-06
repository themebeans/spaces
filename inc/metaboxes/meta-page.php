<?php
/**
 * The file is for creating the page post type meta.
 * Meta output is defined on the page editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

add_action( 'add_meta_boxes', 'bean_metabox_page' );
function bean_metabox_page() {

	$prefix = '_bean_';

	$meta_box = array(
		'id'       => 'page-meta',
		'title'    => esc_html__( 'Page Meta Settings', 'spaces' ),
		'page'     => 'page',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => 'Display Page Title:',
				'id'   => $prefix . 'page_title',
				'type' => 'checkbox',
				'desc' => 'Select to display the page title above the main entry content.',
				'std'  => true,
			),

			array(
				'name' => esc_html__( 'Display Fullwidth Media:', 'spaces' ),
				'id'   => $prefix . 'fullwidth_media',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Display the fullwidth media container.', 'spaces' ),
				'std'  => false,
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
			array(
				'name'    => esc_html__( 'Page Layout:', 'spaces' ),
				'desc'    => esc_html__( 'Select your page layout.', 'spaces' ),
				'id'      => $prefix . 'page_layout',
				'type'    => 'radio',
				'std'     => 'right',
				'options' => array(
					'std'   => esc_html__( 'Standard', 'spaces' ),
					'none'  => esc_html__( 'Fullwidth', 'spaces' ),
					'right' => esc_html__( 'Right Sidebar', 'spaces' ),
				),
			),
			array(
				'name'    => esc_html__( 'Text Alignment:', 'spaces' ),
				'desc'    => esc_html__( 'Select the text alignment style.', 'spaces' ),
				'id'      => $prefix . 'page_text_align',
				'type'    => 'radio',
				'std'     => 'left',
				'options' => array(
					'left'   => esc_html__( 'Left', 'spaces' ),
					'center' => esc_html__( 'Center', 'spaces' ),
					'right'  => esc_html__( 'Right', 'spaces' ),
				),
			),

		),
	);
	bean_add_meta_box( $meta_box );

} // END function bean_metabox_page()
