<?php
/**
 * Admin Options Page.
 *
 * @package CommerceGurus Toolkit
 * @since 1.6
 * @access private
 * @return void
 */

/**
 * Get all settings.
 *
 * @return arran An array containing settings.
 */
function cgtk_get_settings() {
	$settings = get_option( 'cgtk_options' );

	if ( empty( $settings ) ) {
		$general_settings = is_array( get_option( 'cgtk_settings_general' ) ) ? get_option( 'cgtk_settings_general' ) : array();
		$social_settings  = is_array( get_option( 'cgtk_settings_social' ) ) ? get_option( 'cgtk_settings_social' ) : array();

		$settings = array_merge( $general_settings, $social_settings );

		update_option( 'cgtk_options', $settings );
	}

	return apply_filters( 'cgtk_get_settings', $settings );
}

function cgtk_options_page() {
	$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';

	ob_start(); ?>

	<div class="wrap">
		<h2 class="nav-tab-wrapper">
		</h2>

		<div id="tab_container">
			<form method="post" action="options.php">
				<table class="form-table">
				<?php

				if ( 'commercegurustoolkit' == $_GET['page'] && isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) {
					flush_rewrite_rules();
				}

				settings_fields( 'cgtk_options' );
				do_settings_fields( 'cgtk_settings_' . $active_tab, 'cgtk_settings_' . $active_tab );
				?>
				</table>
				<?php submit_button(); ?>
			</form>
		</div><!-- #tab_container -->
	</div><!-- .wrap -->

	<?php
	echo ob_get_clean();
}

/**
 * Get settings tabs.
 *
 * @return array An array containing tab names.
 */
function cgtk_get_settings_tabs() {
	$tabs              = array();
	$tabs['general']   = __( 'General', 'commercegurus-toolkit' );
	$tabs['social']    = __( 'Social', 'commercegurus-toolkit' );

	return apply_filters( 'cgtk_settings_tabs', $tabs );
}

/**
 * Validate user inputs upon save.
 *
 * @param  array  $input An array containing values to filter
 * @return array         Filtered values array
 */
function cgtk_settings_sanitize( $input = array() ) {
	global $cgtk_options;

	parse_str( $_POST['_wp_http_referer'], $referrer );

	$output    = array();
	$settings  = cgtk_get_registered_settings();
	$tab       = isset( $referrer['tab'] ) ? $referrer['tab'] : 'general';
	$post_data = isset( $_POST[ 'cgtk_settings_' . $tab ] ) ? $_POST[ 'cgtk_settings_' . $tab ] : array();

	$input = apply_filters( 'cgtk_settings_' . $tab . '_sanitize', $post_data );

	// Loop through each setting being saved and pass it through a sanitization filter
	foreach ( $input as $key => $value ) {
		// Get the setting type (checkbox, select, etc)
		$type = isset( $settings[ $key ][ 'type' ] ) ? $settings[ $key ][ 'type' ] : false;

		if ( $type ) {
			// Field type specific filter
			$output[ $key ] = apply_filters( 'cgtk_settings_sanitize_' . $type, $value, $key );
		}

		// General filter
		$output[ $key ] = apply_filters( 'cgtk_settings_sanitize', $value, $key );
	}

	// Loop through the whitelist and unset any that are empty for the tab being saved
	if ( ! empty( $settings[ $tab ] ) ) {
		foreach ( $settings[ $tab ] as $key => $value ) {

			// settings used to have numeric keys, now they have keys that match the option ID. This ensures both methods work
			if ( is_numeric( $key ) ) {
				$key = $value['id'];
			}

			if ( empty( $_POST[ 'cgtk_settings_' . $tab ][ $key ] ) ) {
				unset( $cgtk_options[ $key ] );
			}
		}
	}

	// Merge our new settings with the existing
	$output = array_merge( $cgtk_options, $output );

	add_settings_error( 'cgtk-notices', '', __( 'Settings Updated', 'commercegurus-toolkit' ), 'updated' );

	return $output;
}

/**
 * Register settings fields.
 *
 * Fires upon admin_init.
 *
 * @return void
 */
function cgtk_register_settings() {
	if ( false == get_option( 'cgtk_options' ) ) {
		add_option( 'cgtk_options' );
	}

	foreach ( cgtk_get_registered_settings() as $tab => $settings ) {
		add_settings_section(
			'cgtk_settings_' . $tab,
			__return_null(),
			'__return_false',
			'cgtk_settings_' . $tab
		);

		foreach ( $settings as $option ) {

			add_settings_field(
				'cgtk_settings[' . $option['id'] . ']',
				'<label for="cgtk_settings_' . $tab . '[' . $option['id'] . ']">'. $option['name'] .'</label>',
				function_exists( 'cgtk_' . $option['type'] . '_callback' ) ? 'cgtk_' . $option['type'] . '_callback' : 'cgtk_missing_callback',
				'cgtk_settings_' . $tab,
				'cgtk_settings_' . $tab,
				array(
					'id'      => $option['id'],
					'desc'    => ! empty( $option['desc'] ) ? $option['desc'] : '',
					'name'    => $option['name'],
					'section' => $tab,
					'size'    => isset( $option['size'] ) ? $option['size'] : null,
					'options' => isset( $option['options'] ) ? $option['options'] : '',
					'std'     => isset( $option['std'] ) ? $option['std'] : '',
				)
			);
		}
	}

	register_setting( 'cgtk_options', 'cgtk_options', 'cgtk_settings_sanitize' );
}
add_action( 'admin_init', 'cgtk_register_settings' );

/**
 * Register all settings.
 *
 * @return array An array containing all settings.
 */
function cgtk_get_registered_settings() {
	$cgtk_settings = array(
		'general' => apply_filters( 'cgtk_general_settings',
			array(
				'gmaps_settings' => array(
					'id'   => 'gmaps_settings',
					'name' => '<strong>' . __( 'Google Maps Settings', 'commercegurus-toolkit' ) . '</strong>',
					'desc' => __( 'Configure your Google Maps settings', 'commercegurus-toolkit' ),
					'type' => 'header',
				),
				'consumer_key' => array(
					'id'   => 'gmaps_key',
					'name' => __( 'Google Maps API Key', 'commercegurus-toolkit' ),
					'desc' => __( 'Enter your Google Maps API Key. <a href="https://goo.gl/VdRiaS">How do generate a Google Maps API Key</a>', 'commercegurus-toolkit' ),
					'type' => 'text',
				)
			)
		) 
	);

	return $cgtk_settings;
}


function cgtk_missing_callback( $args ) {
	printf( __( 'The callback function used for the <strong>%s</strong> setting is missing.', 'commercegurus-toolkit' ), $args['id'] );
}

/**
 * Text callback.
 *
 * Renders text fields.
 *
 * @param  array $args Arguments passed by the setting
 * @global $cgtk_options Array of all CommerceGurus Toolkit options
 * @return void
 */
function cgtk_text_callback( $args ) {
	global $cgtk_options;

	if ( isset( $cgtk_options[ $args['id'] ] ) )
		$value = $cgtk_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';

	$size = isset( $args['size'] ) && ! is_null( $args['size'] ) ? $args['size'] : 'regular';

	$html = '<input type="text" class="' . $size . '-text" id="cgtk_settings_' . $args['section'] . '[' . $args['id'] . ']" name="cgtk_settings_' . $args['section'] . '[' . $args['id'] . ']" value="' . esc_attr( $value ) . '"/>';
	$html .= '<p class="description">'  . $args['desc'] . '</p>';

	echo $html;
}

/**
 * URL callback.
 *
 * Renders URL fields.
 *
 * @param  array $args Arguments passed by the setting
 * @global $cgtk_options Array of all CommerceGurus Toolkit options
 * @return void
 */
function cgtk_url_callback( $args ) {
	global $cgtk_options;

	if ( isset( $cgtk_options[ $args['id'] ] ) )
		$value = $cgtk_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';

	$size = isset( $args['size'] ) && ! is_null( $args['size'] ) ? $args['size'] : 'regular';

	$html = '<input type="text" class="' . $size . '-text" id="cgtk_settings_' . $args['section'] . '[' . $args['id'] . ']" name="cgtk_settings_' . $args['section'] . '[' . $args['id'] . ']" value="' . esc_url( $value ) . '"/>';
	$html .= '<p class="description">'  . $args['desc'] . '</p>';

	echo $html;
}

/**
 * Select callback.
 *
 * Renders select fields.
 *
 * @param  array $args Arguments passed by the setting
 * @global $cgtk_options Array of all CommerceGurus Toolkit options
 * @return void
 */
function cgtk_select_callback( $args ) {
	global $cgtk_options;

	if ( isset( $cgtk_options[ $args['id'] ] ) )
		$value = $cgtk_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';

	$html = '<select id="cgtk_settings_' . $args['section'] . '[' . $args['id'] . ']" name="cgtk_settings_' . $args['section'] . '[' . $args['id'] . ']"/>';

	foreach ( $args['options'] as $option => $name ) :
		$selected = selected( $option, $value, false );
		$html .= '<option value="' . $option . '" ' . $selected . '>' . $name . '</option>';
	endforeach;

	$html .= '</select>';
	$html .= '<p class="description">'  . $args['desc'] . '</p>';

	echo $html;
}

/**
 * Header callback.
 *
 * Renders the header.
 *
 * @param  array $args Arguments passed by the setting
 * @return void
 */
function cgtk_header_callback( $args ) {
	echo '';
}
