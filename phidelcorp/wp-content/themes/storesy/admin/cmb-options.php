<?php

global $cg_options;

$cg_logo_position = '';

if ( isset( $cg_options['cg_logo_position'] ) ) {
	$cg_logo_position = $cg_options['cg_logo_position'];
}

if ( ( $cg_logo_position == 'beside' ) || ( $cg_logo_position == 'right' ) ) {
	add_action( 'cmb2_init', 'cg_register_page_options' );
}

/**
 * CMB2 options CommerceGurus themes - engage!
 */
function cg_register_page_options() {

	// Start with an underscore to hide fields from custom fields list
	$cg_prefix = '_cgcmb_';

	/**
	 * Page Settings
	 */
	$cg_page_setting_box = new_cmb2_box( array(
		'id'			 => $cg_prefix . 'metabox',
		'title'			 => __( 'Page Settings', 'storesy' ),
		'object_types'	 => array( 'page', ), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		'context'		 => 'side',
		'priority'		 => 'high',
	) );

	$cg_page_setting_box->add_field( array(
		'name'				 => __( 'Header Transparency Style', 'storesy' ),
		'desc'				 => __( 'Default value is set via Theme Options -> Header Settings -> Header Transparency', 'storesy' ),
		'id'				 => $cg_prefix . 'header_style',
		'type'				 => 'select',
		'show_option_none'	 => false,
		'options'			 => array(
			'header-globaloption'	 => __( 'Set in theme options', 'storesy' ),
			'header-default'		 => __( 'No transparency', 'storesy' ),
			'transparent-light'		 => __( 'Transparent - Light text', 'storesy' ),
			'transparent-dark'		 => __( 'Transparent - Dark text', 'storesy' ),
		),
		'default'			 => 'header-globaloption',
	) );
}
