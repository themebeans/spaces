<?php
/**
 * The file is for creating the team post type meta.
 * Meta output is defined on the team single editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Spaces
 * @link        https://themebeans.com/themes/spaces
 */

add_action( 'add_meta_boxes', 'bean_metabox_team' );
function bean_metabox_team() {

	$prefix = '_bean_';

	/*
	===================================================================*/
	/*
	  TEAM META SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'          => 'portfolio-meta',
		'title'       => esc_html__( 'Team Member Settings', 'spaces' ),
		'description' => esc_html__( '', 'spaces' ),
		'page'        => 'team',
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'name' => esc_html__( 'Role:', 'spaces' ),
				'desc' => esc_html__( 'Display this team member&#39;s position.', 'spaces' ),
				'id'   => $prefix . 'team_role',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Quote:', 'spaces' ),
				'desc' => esc_html__( 'Display a small quote on image hover.', 'spaces' ),
				'id'   => $prefix . 'team_quote',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'External URL:', 'spaces' ),
				'desc' => esc_html__( 'Insert a URL to link this team member to.', 'spaces' ),
				'id'   => $prefix . 'team_url',
				'type' => 'text',
				'std'  => '',
			),
		),
	);
	bean_add_meta_box( $meta_box );

} // END function bean_metabox_team()
