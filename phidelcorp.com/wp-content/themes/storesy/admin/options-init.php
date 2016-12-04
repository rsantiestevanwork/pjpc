<?php

/**
 * ReduxFramework Config
 * */
if ( !class_exists( 'Cg_Redux_Framework_config' ) ) {

	class Cg_Redux_Framework_config {

		public $args	 = array();
		public $sections = array();
		public $theme;
		public $ReduxFramework;

		public function __construct() {

			if ( !class_exists( 'ReduxFramework' ) ) {
				return;
			}

			// This is needed. Bah WordPress bugs.  ;)
			if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
				$this->initSettings();
			} else {
				add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
			}
		}

		public function initSettings() {

			// Just for demo purposes. Not needed per say.
			$this->theme = wp_get_theme();

			// Set the default arguments
			$this->setArguments();

			// Set a few help tabs so you can see how it's done
			$this->setHelpTabs();

			// Create the sections and fields
			$this->setSections();

			if ( !isset( $this->args['opt_name'] ) ) { // No errors please
				return;
			}

			// If Redux is running as a plugin, this will remove the demo notice and links
			add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

			// Function to test the compiler hook and demo CSS output.
			// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
			//add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);
			// Change the arguments after they've been declared, but before the panel is created
			//add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
			// Change the default value of a field after it's been set, but before it's been useds
			//add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
			// Dynamically add a section. Can be also used to modify sections/fields
			//add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

			$this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
		}

		/**
		 * This is a test function that will let you see when the compiler hook occurs.
		 * It only runs if a field   set with compiler=>true is changed.
		 * */
		function compiler_action( $options, $css ) {
			//echo '<h1>The compiler hook has run!';
			//print_r($options); //Option values
			//print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

			/*
			  // Demo of how to use the dynamic CSS and write your own static CSS file
			  $filename = dirname(__FILE__) . '/style' . '.css';
			  global $wp_filesystem;
			  if( empty( $wp_filesystem ) ) {
			  require_once( ABSPATH .'/wp-admin/includes/file.php' );
			  WP_Filesystem();
			  }

			  if( $wp_filesystem ) {
			  $wp_filesystem->put_contents(
			  $filename,
			  $css,
			  FS_CHMOD_FILE // predefined mode settings for WP files
			  );
			  }
			 */
		}

		/**
		 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
		 * Simply include this function in the child themes functions.php file.
		 * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
		 * so you must use get_template_directory_uri() if you want to use any of the built in icons
		 * */
		function dynamic_section( $sections ) {
			//$sections = array();
			$sections[] = array(
				'title'	 => __( 'Section via hook', 'redux-framework-demo' ),
				'desc'	 => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
				'icon'	 => 'el-icon-paper-clip',
				// Leave this as a blank section, no options just some intro text set above.
				'fields' => array()
			);

			return $sections;
		}

		/**
		 * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
		 * */
		function change_arguments( $args ) {
			//$args['dev_mode'] = true;

			return $args;
		}

		/**
		 * Filter hook for filtering the default value of any given field. Very useful in development mode.
		 * */
		function change_defaults( $defaults ) {
			$defaults['str_replace'] = 'Testing filter hook!';

			return $defaults;
		}

		// Remove the demo link and the notice of integrated demo from the redux-framework plugin
		function remove_demo() {

			// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
			if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
				remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::instance(), 'plugin_metalinks' ), null, 2 );

				// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
				remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
			}
		}

		public function setSections() {

			/**
			 * Theme Options sections
			 * */
			$this->sections[] = array(
				'title'	 => __( 'Global Settings', 'storesy' ),
				'desc'	 => __( 'Changes to major global elements.', 'storesy' ),
				'icon'	 => 'el-icon-home',
				'fields' => array(
					array(
						'desc'		 => __( 'Select a container layout style', 'storesy' ),
						'id'		 => 'container_style',
						'type'		 => 'select',
						'options'	 => array(
							'full-width' => __( 'Full Width Layout', 'storesy' ),
							'boxed'		 => __( 'Boxed Layout', 'storesy' ),
						),
						'title'		 => __( 'Container layout style', 'storesy' ),
						'default'	 => 'full-width',
					),
					array(
						'desc'		 => __( 'Enable or disable responsiveness on smartphones', 'storesy' ),
						'id'		 => 'cg_responsive',
						'type'		 => 'select',
						'options'	 => array(
							'enabled'	 => __( 'Enabled', 'storesy' ),
							'disabled'	 => __( 'Disabled', 'storesy' ),
						),
						'title'		 => __( 'Responsive', 'storesy' ),
						'default'	 => 'enabled',
					),
					array(
						'desc'		 => __( 'Display comments on pages?', 'storesy' ),
						'id'		 => 'cg_page_comments',
						'type'		 => 'select',
						'options'	 => array(
							'yes'	 => __( 'Yes', 'storesy' ),
							'no'	 => __( 'No', 'storesy' ),
						),
						'title'		 => __( 'Comments on pages?', 'storesy' ),
						'default'	 => 'no',
					),
					array(
						'id'					 => 'cg_background',
						'type'					 => 'background',
						'title'					 => __( 'Body Background - Color and image', 'storesy' ),
						'subtitle'				 => __( 'Configure your theme background.', 'storesy' ),
						'background-position'	 => false,
						'background-size'		 => false,
						'background-attachment'	 => false,
						'default'				 => array(
							'background-color' => '#f8f8f8',
						),
					),
					array(
						'id'					 => 'cg_pattern_background',
						'type'					 => 'background',
						'title'					 => __( 'Body Background - Pattern', 'storesy' ),
						'subtitle'				 => __( 'Use this option if you want to use a repeating pattern for your background. Note: Do not try to use both a pattern background and a full size image background! ', 'storesy' ),
						'background-position'	 => false,
						'background-size'		 => false,
						'background-attachment'	 => false,
						'default'				 => array(
							'background-color' => '#efefef',
						),
					),
					array(
						'id'		 => 'cg_page_wrapper_color',
						'type'		 => 'color',
						'title'		 => __( 'Main body wrapper color', 'storesy' ),
						'subtitle'	 => __( 'Configure your theme wrapper.', 'storesy' ),
						'default'	 => '#ffffff',
					),
				),
			);

			$this->sections[] = array(
				'title'	 => __( 'Colors', 'storesy' ),
				'desc'	 => __( 'Customize your theme color palette.', 'storesy' ),
				'icon'	 => 'el-icon-tint',
				'fields' => array(
					array(
						'desc'		 => __( 'Select from one of the predefined color skins, or have your own colors by selecting "No Skin" and choosing colors below.', 'storesy' ),
						'id'		 => 'cg_skin_color',
						'type'		 => 'select',
						'options'	 => array(
							'none'		 => __( 'No skin - use custom', 'storesy' ),
							'#d54800'	 => __( 'Red', 'storesy' ),
							'#1e73be'	 => __( 'Blue', 'storesy' ),
							'#519d42'	 => __( 'Green', 'storesy' ),
							'#9b3b85'	 => __( 'Purple', 'storesy' ),
						),
						'title'		 => __( 'Color Skin', 'storesy' ),
						'default'	 => 'none',
					),
					array(
						'id'		 => 'cg_primary_color',
						'type'		 => 'color',
						'title'		 => __( 'Primary theme color', 'storesy' ),
						'subtitle'	 => __( 'This should be something unique about your site.', 'storesy' ),
						'default'	 => '#7aa93c',
					),
					array(
						'id'		 => 'link-colors-start',
						'type'		 => 'section',
						'title'		 => __( 'Link Colors', 'storesy' ),
						'subtitle'	 => __( 'Define your link colors.', 'storesy' ),
						'indent'	 => true
					),
					array(
						'id'		 => 'cg_active_link_color',
						'type'		 => 'color',
						'title'		 => __( 'Active link color', 'storesy' ),
						'subtitle'	 => __( 'The color of active links.', 'storesy' ),
						'default'	 => '#7aa93c',
					),
					array(
						'id'		 => 'cg_link_hover_color',
						'type'		 => 'color',
						'title'		 => __( 'Link hover color', 'storesy' ),
						'subtitle'	 => __( 'The color of your links in the hover state.', 'storesy' ),
						'default'	 => '#000000',
					),
					array(
						'id'	 => 'link-colors-end',
						'type'	 => 'section',
						'indent' => false,
					),
					array(
						'id'		 => 'header-colors-start',
						'type'		 => 'section',
						'title'		 => __( 'Header Colors', 'storesy' ),
						'subtitle'	 => __( 'Define your header colors. Note: not all color options apply to all header styles.', 'storesy' ),
						'indent'	 => true
					),
					array(
						'id'		 => 'cg_header_bg_color',
						'type'		 => 'color_rgba',
						'title'		 => __( 'Header Background Color', 'storesy' ),
						'indent'	 => true,
						'subtitle'	 => __( 'The Color of the Header Background.', 'storesy' ),
						'default'	 => array(
							'color'	 => '#ffffff',
							'alpha'	 => 0.92
						),
						'output'	 => array( 'background-color' => '.cg-transparent-header, .cg-logo-center, .cg-logo-left, .cg-primary-menu-center, .cg-primary-menu-left' )
					),
					array(
						'id'		 => 'cg_header_text_color',
						'type'		 => 'color',
						'title'		 => __( 'Header Text Color', 'storesy' ),
						'subtitle'	 => __( 'The color of the Header Text.', 'storesy' ),
						'default'	 => '#222222',
					),
					array(
						'id'		 => 'cg_header_fixed_bg_color',
						'type'		 => 'color_rgba',
						'title'		 => __( 'Sticky Header Background Color', 'storesy' ),
						'subtitle'	 => __( 'The Color of the Sticky Header Background.', 'storesy' ),
						'default'	 => array(
							'color'	 => '#ffffff',
							'alpha'	 => 0.95
						),
						'output'	 => array( 'background-color' => '.scroller, body.transparent-light .scroller, body.transparent-dark .scroller' )
					),
					array(
						'id'		 => 'cg_header_fixed_text_color',
						'type'		 => 'color',
						'title'		 => __( 'Sticky Header Text Color', 'storesy' ),
						'subtitle'	 => __( 'The color of the Sticky Header Text.', 'storesy' ),
						'default'	 => '#222222',
					),
					array(
						'id'		 => 'cg_mobile_header_bg_color',
						'type'		 => 'color',
						'title'		 => __( 'Mobile Header Background Color', 'storesy' ),
						'subtitle'	 => __( 'The color of the Mobile Header Background.', 'storesy' ),
						'default'	 => '#f9f9f7',
					),
					array(
						'id'	 => 'header-colors-end',
						'type'	 => 'section',
						'indent' => false,
					),
					array(
						'id'		 => 'below-body-colors-start',
						'type'		 => 'section',
						'title'		 => __( 'Below Body Colors', 'storesy' ),
						'subtitle'	 => __( 'Define your below body colors. These only apply if you use the "below body" widget area.', 'storesy' ),
						'indent'	 => true
					),
					array(
						'id'		 => 'cg_below_body_bg',
						'type'		 => 'color',
						'title'		 => __( 'Below body background color', 'storesy' ),
						'subtitle'	 => __( 'The background color of the below body widget area', 'storesy' ),
						'default'	 => '#b4e5c6',
					),
					array(
						'id'		 => 'cg_below_body_text',
						'type'		 => 'color',
						'title'		 => __( 'Below body text color', 'storesy' ),
						'subtitle'	 => __( 'The text color of the below body widget area', 'storesy' ),
						'default'	 => '#107837',
					),
					array(
						'id'	 => 'below-body-colors-end',
						'type'	 => 'section',
						'indent' => false,
					),
					array(
						'id'		 => 'footer-colors-start',
						'type'		 => 'section',
						'title'		 => __( 'Footer Colors', 'storesy' ),
						'subtitle'	 => __( 'Define your footer colors.', 'storesy' ),
						'indent'	 => true
					),
					array(
						'id'		 => 'cg_first_footer_bg',
						'type'		 => 'color',
						'title'		 => __( 'First footer background color', 'storesy' ),
						'subtitle'	 => __( 'The background color of the first (top) footer.', 'storesy' ),
						'default'	 => '#f7f7f7',
					),
					array(
						'id'		 => 'cg_first_footer_text',
						'type'		 => 'color',
						'title'		 => __( 'First footer text color', 'storesy' ),
						'subtitle'	 => __( 'The text color of the first (top) footer.', 'storesy' ),
						'default'	 => '#222222',
					),
					array(
						'id'		 => 'cg_second_footer_bg',
						'type'		 => 'color',
						'title'		 => __( 'Second footer background color', 'storesy' ),
						'subtitle'	 => __( 'The background color of the second (bottom) footer.', 'storesy' ),
						'default'	 => '#111111',
					),
					array(
						'id'		 => 'cg_second_footer_text',
						'type'		 => 'color',
						'title'		 => __( 'Second footer text color', 'storesy' ),
						'subtitle'	 => __( 'The text color of the second (bottom) footer.', 'storesy' ),
						'default'	 => '#fff',
					),
					array(
						'id'		 => 'cg_last_footer_bg',
						'type'		 => 'color',
						'title'		 => __( 'Last footer background color', 'storesy' ),
						'subtitle'	 => __( 'The background color of the last footer (where the copyright notice normally appears).', 'storesy' ),
						'default'	 => '#222222',
					),
					array(
						'id'		 => 'cg_last_footer_text',
						'type'		 => 'color',
						'title'		 => __( 'Last footer text color', 'storesy' ),
						'subtitle'	 => __( 'The text color of the last footer (where the copyright notice normally appears).', 'storesy' ),
						'default'	 => '#777777',
					),
					array(
						'id'	 => 'footer-colors-end',
						'type'	 => 'section',
						'indent' => false,
					),
				),
			);

			$this->sections[] = array(
				'title'	 => __( 'Logos and Favicons', 'storesy' ),
				'desc'	 => __( 'Update your Logos and Favicons.', 'storesy' ),
				'icon'	 => 'el-icon-photo',
				'fields' => array(
					array(
						'id'		 => 'standard-logo-start',
						'type'		 => 'section',
						'title'		 => __( 'Logos', 'storesy' ),
						'subtitle'	 => __( 'Set your Logo', 'storesy' ),
						'indent'	 => true
					),
					array(
						'desc'	 => __( 'Upload your Logo.', 'storesy' ),
						'id'	 => 'site_logo',
						'type'	 => 'media',
						'title'	 => __( 'Logo', 'storesy' ),
						'url'	 => true,
					),
					array(
						'desc'	 => __( 'Upload your Transpaent - Light Logo.', 'storesy' ),
						'id'	 => 'trans_site_logo_light',
						'type'	 => 'media',
						'title'	 => __( 'Transparent - Light Logo', 'storesy' ),
						'url'	 => true,
					),
					array(
						'desc'	 => __( 'Upload your Transpaent - Dark Logo.', 'storesy' ),
						'id'	 => 'trans_site_logo_dark',
						'type'	 => 'media',
						'title'	 => __( 'Transparent - Dark Logo', 'storesy' ),
						'url'	 => true,
					),
					array(
						'title'			 => __( 'Logo Height', 'storesy' ),
						'subtitle'		 => __( 'Set your Logo Height in pixels', 'storesy' ),
						'id'			 => 'cg_logo_height',
						'type'			 => 'slider',
						"default"		 => 32,
						"min"			 => 0,
						"step"			 => 1,
						"max"			 => 100,
						'display_value'	 => 'text',
					),
					array(
						'title'			 => __( 'Padding above Logo', 'storesy' ),
						'subtitle'		 => __( 'Set some padding above your logo', 'storesy' ),
						'id'			 => 'cg_padding_above_logo',
						'type'			 => 'slider',
						"default"		 => 50,
						"min"			 => 0,
						"step"			 => 1,
						"max"			 => 100,
						'display_value'	 => 'text',
					),
					array(
						'title'			 => __( 'Padding below Logo', 'storesy' ),
						'subtitle'		 => __( 'Set some padding below your logo', 'storesy' ),
						'id'			 => 'cg_padding_below_logo',
						'type'			 => 'slider',
						"default"		 => 25,
						"min"			 => 0,
						"step"			 => 1,
						"max"			 => 100,
						'display_value'	 => 'text',
					),
					array(
						'id'	 => 'standard-logo-end',
						'type'	 => 'section',
						'indent' => false,
					),
					array(
						'id'		 => 'sticky-logo-start',
						'type'		 => 'section',
						'title'		 => __( 'Sticky Logo', 'storesy' ),
						'subtitle'	 => __( 'Set your Sticky Logo', 'storesy' ),
						'indent'	 => true
					),
					array(
						'desc'	 => __( 'Upload a Logo which appears within a Sticky Header.', 'storesy' ),
						'id'	 => 'cg_alt_site_logo',
						'type'	 => 'media',
						'title'	 => __( 'Sticky Logo (optional)', 'storesy' ),
						'url'	 => true,
					),
					array(
						'title'			 => __( 'Sticky Logo Height', 'storesy' ),
						'subtitle'		 => __( 'Set your Sticky Logo Height in pixels', 'storesy' ),
						'id'			 => 'cg_sticky_logo_height',
						'type'			 => 'slider',
						"default"		 => 32,
						"min"			 => 0,
						"step"			 => 1,
						"max"			 => 100,
						'display_value'	 => 'text',
					),
					array(
						'title'			 => __( 'Padding above Sticky Logo', 'storesy' ),
						'subtitle'		 => __( 'Set some padding above your sticky logo', 'storesy' ),
						'id'			 => 'cg_padding_above_sticky_logo',
						'type'			 => 'slider',
						"default"		 => 20,
						"min"			 => 0,
						"step"			 => 1,
						"max"			 => 100,
						'display_value'	 => 'text',
					),
					array(
						'title'			 => __( 'Padding below Sticky Logo', 'storesy' ),
						'subtitle'		 => __( 'Set some padding below your sticky logo', 'storesy' ),
						'id'			 => 'cg_padding_below_sticky_logo',
						'type'			 => 'slider',
						"default"		 => 20,
						"min"			 => 0,
						"step"			 => 1,
						"max"			 => 100,
						'display_value'	 => 'text',
					),
					array(
						'id'	 => 'sticky-logo-end',
						'type'	 => 'section',
						'indent' => false,
					),
					array(
						'id'		 => 'favicon-start',
						'type'		 => 'section',
						'title'		 => __( 'Favicon', 'storesy' ),
						'subtitle'	 => __( 'Set your favicons', 'storesy' ),
						'indent'	 => true
					),
					array(
						'desc'	 => __( 'Add your custom Favicon image. 16x16px .ico or .png.', 'storesy' ),
						'id'	 => 'cg_favicon',
						'type'	 => 'media',
						'title'	 => __( 'Favicon', 'storesy' ),
						'url'	 => true,
					),
					array(
						'desc'	 => __( 'The Retina/iOS version of your Favicon. 144x144px .png.', 'storesy' ),
						'id'	 => 'cg_retina_favicon',
						'type'	 => 'media',
						'title'	 => __( 'Favicon retina', 'storesy' ),
						'url'	 => true,
					),
					array(
						'id'	 => 'favicon-end',
						'type'	 => 'section',
						'indent' => false,
					),
				),
			);

			$this->sections[] = array(
				'title'	 => __( 'Header Settings', 'storesy' ),
				'desc'	 => __( 'Manage your header.', 'storesy' ),
				'icon'	 => 'el-icon-hand-up',
				'fields' => array(
					array(
						'id'		 => 'cg_logo_position',
						'type'		 => 'image_select',
						'compiler'	 => true,
						'title'		 => __( 'Header Layout', 'storesy' ),
						'subtitle'	 => __( '<em>Select the Header Layout.</em>', 'storesy' ),
						'options'	 => array(
							'beside'					 => array(
								'alt'	 => 'Layout 1',
								'img'	 => get_template_directory_uri() . '/images/theme_options/header_1.png'
							),
							'right'						 => array(
								'alt'	 => 'Layout 2',
								'img'	 => get_template_directory_uri() . '/images/theme_options/header_2.png'
							),
							'center-logo-center-menu'	 => array(
								'alt'	 => 'Layout 3',
								'img'	 => get_template_directory_uri() . '/images/theme_options/header_3.png'
							),
							'left'						 => array(
								'alt'	 => 'Layout 4',
								'img'	 => get_template_directory_uri() . '/images/theme_options/header_4.png'
							),
						),
						'default'	 => 'beside'
					),
					array(
						'desc'		 => __( 'This header layout supports transparency! Select a header transparency style. Note: this can also be overridden on a specific page.', 'storesy' ),
						'id'		 => 'global_trans_header_style',
						'type'		 => 'select',
						'required'	 => array( 'cg_logo_position', '=', array( 'beside', 'right' ) ),
						'options'	 => array(
							'header-default'	 => __( 'Default - Not transparent', 'storesy' ),
							'transparent-light'	 => __( 'Transparent - Light Text', 'storesy' ),
							'transparent-dark'	 => __( 'Transparent - Dark Text', 'storesy' ),
						),
						'title'		 => __( 'Header Transparency', 'storesy' ),
						'default'	 => 'header-default',
					),
					array(
						'id'		 => 'cg_topbar',
						'type'		 => 'switch',
						'title'		 => __( 'Top Bar', 'storesy' ),
						'subtitle'	 => __( '<em>Enable the Top Bar?</em>', 'storesy' ),
						'on'		 => __( 'Enable', 'storesy' ),
						'off'		 => __( 'Disable', 'storesy' ),
						'default'	 => 1,
					),
					array(
						'title'		 => __( 'Sticky Menu', 'storesy' ),
						'desc'		 => __( 'A sticky menu is a menu which fixes itself to the top as you scroll.', 'storesy' ),
						'id'		 => 'cg_sticky_menu',
						'type'		 => 'switch',
						'subtitle'	 => __( '<em>Enable Sticky Menu?</em>', 'storesy' ),
						'on'		 => __( 'Enable', 'storesy' ),
						'off'		 => __( 'Disable', 'storesy' ),
						'default'	 => 1,
					),
					array(
						'id'		 => 'cg_show_cart',
						'type'		 => 'switch',
						'title'		 => __( 'Cart', 'storesy' ),
						'subtitle'	 => __( '<em>Enable the Cart?</em>', 'storesy' ),
						'on'		 => __( 'Enable', 'storesy' ),
						'off'		 => __( 'Disable', 'storesy' ),
						'default'	 => 1,
					),
					array(
						'id'		 => 'cg_show_search',
						'type'		 => 'switch',
						'title'		 => __( 'Search', 'storesy' ),
						'subtitle'	 => __( '<em>Enable the Search Overlay?</em>', 'storesy' ),
						'on'		 => __( 'Enable', 'storesy' ),
						'off'		 => __( 'Disable', 'storesy' ),
						'default'	 => 1,
					),
					array(
						'desc'		 => __( '(Note: It will still need to be assigned within Appearance > Menus)', 'storesy' ),
						'id'		 => 'cg_show_offcanvas',
						'type'		 => 'switch',
						'title'		 => __( 'Offcanvas Menu', 'storesy' ),
						'subtitle'	 => __( '<em>Enable the Offcanvas Menu?</em>', 'storesy' ),
						'on'		 => __( 'Enable', 'storesy' ),
						'off'		 => __( 'Disable', 'storesy' ),
						'default'	 => 1,
					),
					array(
						'desc'		 => __( 'Edit these within the "Announcements" section. If it is set to be disabled you can use the "Top Left" widget area instead to show static text.', 'storesy' ),
						'id'		 => 'cg_shop_announcements',
						'type'		 => 'switch',
						'title'		 => __( 'Announcements', 'storesy' ),
						'subtitle'	 => __( '<em>Enable Announcements above your Header.</em>', 'storesy' ),
						'on'		 => __( 'Enable', 'storesy' ),
						'off'		 => __( 'Disable', 'storesy' ),
						'default'	 => 1,
					),
					array(
						'id'		 => 'cg_announcements_bg',
						'type'		 => 'color',
						'title'		 => __( 'Top Bar Background Color', 'storesy' ),
						'subtitle'	 => __( '<em>The color of the Top Bar background.</em>', 'storesy' ),
						'default'	 => '#000000',
					),
					array(
						'id'		 => 'cg_announcements_text',
						'type'		 => 'color',
						'title'		 => __( 'Top Bar Text Color', 'storesy' ),
						'subtitle'	 => __( '<em>The color of the Top Bar text.</em>', 'storesy' ),
						'default'	 => '#ffffff',
					),
				),
			);

			$this->sections[] = array(
				'title'	 => __( 'Main Menu Settings', 'storesy' ),
				'desc'	 => __( 'Manage your main menu.', 'storesy' ),
				'icon'	 => 'el-icon-cog-alt',
				'fields' => array(
					array(
						'id'			 => 'cg_level1_font',
						'type'			 => 'typography',
						'title'			 => __( 'Level 1 Typeface', 'storesy' ),
						'text-transform' => true,
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'line-height'	 => false,
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( '.cg-primary-menu .menu > li > a', '.rightnav .cart_subtotal' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => __( 'Each property can be called individually.', 'storesy' ),
						'default'		 => array(
							'font-weight'	 => '400',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '16px',
						),
					),
					array(
						'id'			 => 'cg_level2_heading_font',
						'type'			 => 'typography',
						'title'			 => __( 'Level 2 Heading Typeface', 'storesy' ),
						'text-transform' => true,
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'line-height'	 => false,
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( '.cg-header-fixed .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li > a, .cg-primary-menu .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li > a, .menu-full-width .cg-menu-title, .cg-header-fixed .menu > li.menu-full-width .cg-submenu-ddown .container > ul .menu-item-has-children > a, .cg-primary-menu .menu > li .cg-submenu-ddown ul li.image-item-title a, .cg-primary-menu .menu > li .cg-submenu-ddown ul li.image-item-title ul a,
.cg-primary-menu .menu > li.menu-full-width .cg-submenu-ddown .container > ul .menu-item-has-children > a, .cg-header-fixed .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li .cg-submenu ul li.title a, .cg-primary-menu .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li .cg-submenu ul li.title a' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => __( 'Typography option with each property can be called individually.', 'storesy' ),
						'default'		 => array(
							'color'			 => '#111',
							'font-weight'	 => '500',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '14px',
						),
					),
					array(
						'id'			 => 'cg_level2_font',
						'type'			 => 'typography',
						'title'			 => __( 'Level 2 Typeface', 'storesy' ),
						'text-transform' => true,
						//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
						//'subsets'       => false, // Only appears if google is true and subsets not set to false
						//'font-size'     => false,
						'line-height'	 => false,
						//'word-spacing'  => true,  // Defaults to false
						'letter-spacing' => true, // Defaults to false
						//'color'         => false,
						//'preview'       => false, // Disable the previewer
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( '.cg-primary-menu .menu > li .cg-submenu-ddown .container > ul > li a, .cg-submenu-ddown .container > ul > li > a, .cg-header-fixed .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li .cg-submenu ul li ul li a, .cg-primary-menu .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li .cg-submenu ul li ul li a' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => __( 'Typography option with each property can be called individually.', 'storesy' ),
						'default'		 => array(
							'color'			 => '#333333',
							'font-weight'	 => '400',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '13px',
							'text-transform' => 'none',
						),
					),
					array(
						'id'		 => 'cg_main_menu_dropdown_bg',
						'type'		 => 'color_rgba',
						'title'		 => __( 'Dropdown menu background color.', 'storesy' ),
						'default'	 => array(
							'color'	 => '#ffffff',
							'alpha'	 => '1.0',
						),
						'output'	 => array(
							'.cg-header-fixed .menu > li .cg-submenu-ddown, .cg-primary-menu .menu > li .cg-submenu-ddown, .cg-header-fixed .menu > li.menu-full-width .cg-submenu-ddown, .cg-primary-menu .menu > li.menu-full-width .cg-submenu-ddown, .cg-header-fixed .menu > li .cg-submenu-ddown .container > ul .menu-item-has-children .cg-submenu li, .cg-primary-menu .menu > li .cg-submenu-ddown .container > ul .menu-item-has-children .cg-submenu li,.cg-header-fixed .menu > li.menu-full-width .cg-submenu-ddown,.cg-primary-menu .menu > li.menu-full-width .cg-submenu-ddown'
						),
						'mode'		 => 'background',
					),
				),
			);

			// End Main/Primary menu image uploads
			$this->sections[] = array(
				'title'	 => __( 'Footer Settings', 'storesy' ),
				'desc'	 => __( 'Manage your footer.', 'storesy' ),
				'icon'	 => 'el-icon-hand-down',
				'fields' => array(
					array(
						'id'		 => 'cg_footer_message',
						'type'		 => 'text',
						'title'		 => __( 'Left Side Footer text', 'storesy' ),
						'default'	 => __( '<p>&copy; 2015 MADE WITH <i class="fa fa-heart"></i> BY COMMERCEGURUS - BUILD SOMETHING BEAUTIFUL</p>', 'storesy' ),
					),
					array(
						'id'		 => 'cg_footer_social',
						'desc'		 => __( 'The Social Icons are from fontawesome - a full list is available here: http://fortawesome.github.io/Font-Awesome/icons/', 'storesy' ),
						'type'		 => 'textarea',
						'title'		 => __( 'Right Side Footer text', 'storesy' ),
						'default'	 => __( '
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-linkedin"></i></a>
						<a href="#"><i class="fa fa-google-plus"></i></a>
						<a href="#"><i class="fa fa-instagram"></i></a>
						<a href="#"><i class="fa fa-pinterest-p"></i></a>
						<a href="#"><i class="fa fa-youtube-play"></i></a>
						<a href="#"><i class="fa fa-vine"></i></a>
						<a href="#"><i class="fa fa-rss"></i></a>', 'storesy' ),
					),
					array(
						'desc'		 => __( 'Show widget area just under body (and just before the footer?', 'storesy' ),
						'id'		 => 'cg_below_body_widget',
						'type'		 => 'select',
						'title'		 => __( 'Show widget below body?', 'storesy' ),
						'options'	 => array(
							'yes'	 => __( 'Yes', 'storesy' ),
							'no'	 => __( 'No', 'storesy' ),
						),
						'default'	 => 'yes',
					),
					array(
						'desc'		 => __( 'Show top footer?', 'storesy' ),
						'id'		 => 'cg_footer_top_active',
						'type'		 => 'select',
						'title'		 => __( 'Show top footer', 'storesy' ),
						'options'	 => array(
							'yes'	 => __( 'Yes', 'storesy' ),
							'no'	 => __( 'No', 'storesy' ),
						),
						'default'	 => 'no',
					),
					array(
						'desc'		 => __( 'Show bottom footer?', 'storesy' ),
						'id'		 => 'cg_footer_bottom_active',
						'type'		 => 'select',
						'title'		 => __( 'Show bottom footer', 'storesy' ),
						'options'	 => array(
							'yes'	 => __( 'Yes', 'storesy' ),
							'no'	 => __( 'No', 'storesy' ),
						),
						'default'	 => 'yes',
					),
					array(
						'desc'		 => __( 'Show back to top?', 'storesy' ),
						'id'		 => 'cg_back_to_top',
						'type'		 => 'select',
						'title'		 => __( 'Show back to top?', 'storesy' ),
						'options'	 => array(
							'yes'	 => __( 'Yes', 'storesy' ),
							'no'	 => __( 'No', 'storesy' ),
						),
						'default'	 => 'yes',
					),
				),
			);

			$this->sections[] = array(
				'title'	 => __( 'Typography', 'storesy' ),
				'desc'	 => __( 'Manage your fonts and typefaces.', 'storesy' ),
				'icon'	 => 'el-icon-fontsize',
				'fields' => array(
					array(
						'id'			 => 'opt-typography-body',
						'type'			 => 'typography',
						'title'			 => __( 'Body/Main text font', 'storesy' ),
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( 'body', 'select', 'input', 'textarea', 'button', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => __( 'Each property can be called individually.', 'storesy' ),
						'default'		 => array(
							'color'			 => '#222',
							'font-weight'	 => '400',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '15px',
							'line-height'	 => '22px'
						),
					),
					array(
						'id'			 => 'opt-typography-secondary',
						'type'			 => 'typography',
						'title'			 => __( 'Secondary font', 'storesy' ),
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array(
							'.content-area blockquote p',
							'body.single-post .content-area .entry-content span.first-letter',
							'.content-area .entry-content blockquote p',
						),
						'compiler'		 => array( 'h2.site-description-compiler' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => __( 'Each property can be called individually.', 'storesy' ),
						'default'		 => array(
							'font-weight'	 => '400',
							'font-family'	 => 'Lora',
							'google'		 => true,
						),
					),
					array(
						'id'			 => 'opt-typography-p',
						'type'			 => 'typography',
						'title'			 => __( 'Paragraph Style', 'storesy' ),
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'text-transform' => true,
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( '.content-area .entry-content p', '.authordescription p', 'body.page-template-template-home-default .wpb_text_column p' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => __( 'Typography option with each property can be called individually.', 'storesy' ),
						'default'		 => array(
							'color'			 => '#444',
							'font-weight'	 => '400',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '17px',
							'line-height'	 => '26px',
						),
					),
					array(
						'id'			 => 'opt-typography-h1',
						'type'			 => 'typography',
						'title'			 => __( 'Heading 1 Style', 'storesy' ),
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'text-transform' => true,
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( '.content-area h1', 'h1.cg-page-title', ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => __( 'Typography option with each property can be called individually.', 'storesy' ),
						'default'		 => array(
							'color'			 => '#111',
							'font-weight'	 => '400',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '40px',
							'line-height'	 => '50px',
						),
					),
					array(
						'id'			 => 'opt-typography-h2',
						'type'			 => 'typography',
						'title'			 => __( 'Heading 2 Style', 'storesy' ),
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'text-transform' => true,
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( 'h2', '.content-area h2' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => __( 'Each property can be called individually.', 'storesy' ),
						'default'		 => array(
							'color'			 => '#222',
							'font-weight'	 => '400',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '32px',
							'line-height'	 => '46px'
						),
					),
					array(
						'id'			 => 'opt-typography-h3',
						'type'			 => 'typography',
						'title'			 => __( 'Heading 3 Style', 'storesy' ),
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'text-transform' => true,
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( 'h3', '.content-area h3' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => __( 'Each property can be called individually.', 'storesy' ),
						'default'		 => array(
							'color'			 => '#222',
							'font-weight'	 => '400',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '24px',
							'line-height'	 => '34px'
						),
					),
					array(
						'id'			 => 'opt-typography-h4',
						'type'			 => 'typography',
						'title'			 => __( 'Heading 4 Style', 'storesy' ),
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'text-transform' => true,
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( 'h4', '.content-area h4', 'body .vc_separator h4' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => __( 'Each property can be called individually.', 'storesy' ),
						'default'		 => array(
							'color'			 => '#222',
							'font-weight'	 => '400',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '19px',
							'line-height'	 => '30px'
						),
					),
					array(
						'id'			 => 'opt-typography-h5',
						'type'			 => 'typography',
						'title'			 => __( 'Heading 5 Style', 'storesy' ),
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'text-transform' => true,
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( 'h5', '.content-area h5' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => __( 'Each property can be called individually.', 'storesy' ),
						'default'		 => array(
							'color'			 => '#222',
							'font-weight'	 => '400',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '16px',
							'line-height'	 => '22px',
							'letter-spacing' => '2px',
						),
					),
					array(
						'id'			 => 'opt-typography-h6',
						'type'			 => 'typography',
						'title'			 => __( 'Heading 6 Style', 'storesy' ),
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'text-transform' => true,
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( 'h6', '.content-area h6' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px',
						'subtitle'		 => __( 'Each property can be called individually.', 'storesy' ),
						'default'		 => array(
							'color'			 => '#1b1b1b',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '16px',
							'line-height'	 => '22px'
						),
					),
					array(
						'id'			 => 'cg-type-widget-title',
						'type'			 => 'typography',
						'title'			 => __( 'Widget Title Typeface', 'storesy' ),
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'text-transform' => true,
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( 'h4.widget-title', '.subfooter h4', ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px',
						'subtitle'		 => __( 'Each property can be called individually.', 'storesy' ),
						'default'		 => array(
							'color'			 => '#222',
							'font-weight'	 => '500',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '14px',
							'line-height'	 => '20px',
							'text-transform' => 'uppercase',
						),
					),
				),
			);

			$this->sections[] = array(
				'title'	 => __( 'Blog Settings', 'storesy' ),
				'desc'	 => __( 'Manage your blog settings.', 'storesy' ),
				'icon'	 => 'el-icon-file-edit',
				'fields' => array(
					array(
						'id'		 => 'cg_blog_page_title',
						'type'		 => 'text',
						'title'		 => __( 'Blog Page Title', 'storesy' ),
						'default'	 => __( 'Blog', 'storesy' ),
					),
					array(
						'desc'		 => __( 'Blog thumbnails', 'storesy' ),
						'id'		 => 'cg_blog_images',
						'type'		 => 'select',
						'options'	 => array(
							'default'	 => __( 'Default - above blog post', 'storesy' ),
							'right'		 => __( 'Right Thumbnail', 'storesy' ),
							'left'		 => __( 'Left Thumbnail', 'storesy' ),
						),
						'title'		 => __( 'Which layout would like for your blog thumbnails?', 'storesy' ),
						'default'	 => 'default',
					),
					array(
						'desc'		 => __( 'Blog sidebar', 'storesy' ),
						'id'		 => 'cg_blog_sidebar',
						'type'		 => 'select',
						'options'	 => array(
							'default'	 => __( 'Left sidebar', 'storesy' ),
							'right'		 => __( 'Right sidebar', 'storesy' ),
							'none'		 => __( 'No sidebar', 'storesy' ),
						),
						'title'		 => __( 'Where would you like your blog sidebar to appear?', 'storesy' ),
						'default'	 => 'right',
					),
				),
			);

			$this->sections[] = array(
				'title'	 => __( 'WooCommerce General Settings', 'storesy' ),
				'desc'	 => __( 'Global shop settings.', 'storesy' ),
				'icon'	 => ' el-icon-shopping-cart',
				'fields' => array(
					array(
						'title'		 => __( 'Catalog Mode', 'storesy' ),
						'desc'		 => __( 'Enabling catalog mode will hide the shopping cart and add to cart options.', 'storesy' ),
						'id'		 => 'cg_catalog_mode',
						'type'		 => 'select',
						'options'	 => array(
							'enabled'	 => __( 'Enable', 'storesy' ),
							'disabled'	 => __( 'Disable', 'storesy' ),
						),
						'default'	 => 'disabled',
					),
					array(
						'title'		 => __( 'Hide Prices?', 'storesy' ),
						'desc'		 => __( 'Select if you would like to hide prices? Note: Catalog mode must also be enabled if you wish to hide prices.', 'storesy' ),
						'id'		 => 'cg_hide_prices',
						'type'		 => 'select',
						'options'	 => array(
							'yes'	 => __( 'Yes', 'storesy' ),
							'no'	 => __( 'No', 'storesy' ),
						),
						'default'	 => 'no',
					),
					array(
						'title'		 => __( 'Hide Categories?', 'storesy' ),
						'desc'		 => __( 'Select if you would like to hide categories from the main product display loop?', 'storesy' ),
						'id'		 => 'cg_hide_categories',
						'type'		 => 'select',
						'options'	 => array(
							'yes'	 => __( 'Yes', 'storesy' ),
							'no'	 => __( 'No', 'storesy' ),
						),
						'default'	 => 'yes',
					),
					array(
						'id'		 => 'cg_woo_sale_label_bg_color',
						'type'		 => 'color',
						'title'		 => __( 'Sale label background color', 'storesy' ),
						'subtitle'	 => __( 'Select the color for your Sale label background color.', 'storesy' ),
						'default'	 => '#49880f',
					),
				),
			);

			$this->sections[] = array(
				'title'	 => __( 'WooCommerce Product Details', 'storesy' ),
				'desc'	 => __( 'Manage product details page settings.', 'storesy' ),
				'icon'	 => ' el-icon-shopping-cart-sign',
				'fields' => array(
					array(
						'id'		 => 'upsell_title',
						'type'		 => 'text',
						'title'		 => __( 'Up-sell title', 'storesy' ),
						'default'	 => __( 'Also Consider', 'storesy' ),
					),
					array(
						'id'		 => 'wc_product_sidebar',
						'type'		 => 'select',
						'options'	 => array(
							'wc_product_no_sidebar'		 => __( 'None', 'storesy' ),
							'wc_product_left_sidebar'	 => __( 'Sidebar on the left', 'storesy' ),
							'wc_product_right_sidebar'	 => __( 'Sidebar on the right', 'storesy' ),
						),
						'title'		 => __( 'Product Sidebar Position', 'storesy' ),
						'default'	 => 'wc_product_no_sidebar',
					),
					array(
						'id'		 => 'cg_owl_thumbs',
						'type'		 => 'select',
						'options'	 => array(
							'yes'	 => __( 'Yes', 'storesy' ),
							'no'	 => __( 'No', 'storesy' ),
						),
						'title'		 => __( 'Display product thumbnails in carousel?', 'storesy' ),
						'default'	 => 'yes',
					),
					array(
						'id'		 => 'wc_product_sku',
						'type'		 => 'select',
						'options'	 => array(
							'yes'	 => __( 'Yes', 'storesy' ),
							'no'	 => __( 'No', 'storesy' ),
						),
						'title'		 => __( 'Display the Product SKU?', 'storesy' ),
						'default'	 => 'no',
					),
					array(
						'id'	 => 'product_size_guide_title',
						'type'	 => 'text',
						'title'	 => __( 'Size Guide Title', 'storesy' ),
					),
					array(
						'desc'	 => __( 'Upload your size guide images here.', 'storesy' ),
						'id'	 => 'product_size_guide',
						'type'	 => 'media',
						'title'	 => __( 'Size Guide', 'storesy' ),
						'url'	 => true,
					),
					array(
						'id'		 => 'product_share_icons',
						'type'		 => 'select',
						'options'	 => array(
							'yes'	 => __( 'Yes', 'storesy' ),
							'no'	 => __( 'No', 'storesy' ),
						),
						'title'		 => __( 'Display social sharing icons?', 'storesy' ),
						'default'	 => 'yes',
					),
					array(
						'id'		 => 'returns_tab_title',
						'type'		 => 'text',
						'title'		 => __( 'Delivery tab title', 'storesy' ),
						'default'	 => __( 'Delivery', 'storesy' ),
					),
					array(
						'id'		 => 'returns_tab_content',
						'type'		 => 'textarea',
						'desc'		 => __( 'Add your delivery content here.', 'storesy' ),
						'title'		 => __( 'Delivery tab content', 'storesy' ),
						'default'	 => __( 'Delivery content description. Edit in Theme Options > WooCommerce Product Details', 'storesy' ),
					),
					array(
						'id'		 => 'cg_product_next_prev',
						'type'		 => 'select',
						'options'	 => array(
							'yes'	 => __( 'Yes', 'storesy' ),
							'no'	 => __( 'No', 'storesy' ),
						),
						'title'		 => __( 'Display next/prev buttons?', 'storesy' ),
						'default'	 => 'yes',
					),
				),
			);

			$this->sections[] = array(
				'title'	 => __( 'WooCommerce Product Listings', 'storesy' ),
				'desc'	 => __( 'Manage product listing page settings.', 'storesy' ),
				'icon'	 => '  el-icon-list-alt',
				'fields' => array(
					array(
						'desc'		 => __( 'Select sidebar position for product listing pages.', 'storesy' ),
						'id'		 => 'product_listing_sidebar',
						'type'		 => 'select',
						'options'	 => array(
							'none'			 => __( 'No sidebar', 'storesy' ),
							'left-sidebar'	 => __( 'Sidebar on the left', 'storesy' ),
							'right-sidebar'	 => __( 'Sidebar on the right', 'storesy' ),
						),
						'title'		 => __( 'Product listing sidebar position', 'storesy' ),
						'default'	 => 'left-sidebar',
					),
					array(
						'desc'		 => __( 'Select product loop', 'storesy' ),
						'id'		 => 'cg_product_loop_type',
						'type'		 => 'select',
						'options'	 => array(
							'storesy'		=> __( 'Storesy product loop', 'storesy' ),
							'default'		=> __( 'Default WooCommerce product loop', 'storesy' ),
						),
						'title'		 => __( 'Product listing product loop', 'storesy' ),
						'default'	 => 'storesy',
					),

					array(
						'desc'		 => __( 'Select which type of layout you prefer for your product listings.', 'storesy' ),
						'id'		 => 'product_layout',
						'type'		 => 'select',
						'options'	 => array(
							'grid-layout'	 => __( 'Grid Layout', 'storesy' ),
							'list-layout'	 => __( 'List Layout', 'storesy' ),
						),
						'title'		 => __( 'Grid or List Layout', 'storesy' ),
						'default'	 => 'grid-layout',
					),
					array(
						'desc'		 => __( 'Change the number of products per row for product listing pages.', 'storesy' ),
						'id'		 => 'product_grid_count',
						'type'		 => 'select',
						'options'	 => array(
							2	 => '2',
							3	 => '3',
							4	 => '4',
							5	 => '5',
							6	 => '6',
							7	 => '7',
							8	 => '8',
							9	 => '9',
						),
						'title'		 => __( 'Number of products per row', 'storesy' ),
						'default'	 => '3',
					),
					array(
						'id'		 => 'products_page_count',
						'desc'		 => __( 'Number of products per page on product listings pages.', 'storesy' ),
						'type'		 => 'text',
						'title'		 => __( 'Products per page', 'storesy' ),
						'default'	 => '12',
					),
					array(
						'desc'		 => __( 'Enable or disable product thumbnail flip.', 'storesy' ),
						'id'		 => 'cg_product_thumb_flip',
						'type'		 => 'select',
						'options'	 => array(
							'enabled'	 => __( 'Enabled', 'storesy' ),
							'disabled'	 => __( 'Disabled', 'storesy' ),
						),
						'title'		 => __( 'Product Thumbnail Flip', 'storesy' ),
						'default'	 => 'enabled',
					),
					array(
						'desc'		 => __( 'Enable or disable product quick view.', 'storesy' ),
						'id'		 => 'cg_product_quick_view',
						'type'		 => 'select',
						'options'	 => array(
							'enabled'	 => __( 'Enabled', 'storesy' ),
							'disabled'	 => __( 'Disabled', 'storesy' ),
						),
						'title'		 => __( 'Product Quick View', 'storesy' ),
						'default'	 => 'enabled',
					),
					array(
						'id'			 => 'cg_product_loop_price_font',
						'type'			 => 'typography',
						'title'			 => __( 'Price Typeface', 'storesy' ),
						'text-transform' => true,
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'line-height'	 => false,
						'color'			 => false,
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( '.cg-product-info .amount' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => __( 'Typography option with each property can be called individually.', 'storesy' ),
						'default'		 => array(
							'font-weight'	 => '400',
							'google'		 => true,
							'font-size'		 => '15px',
							'text-transform' => 'uppercase',
						),
					),
					array(
						'id'			 => 'cg_product_loop_price_sale_font',
						'type'			 => 'typography',
						'title'			 => __( 'Price Sale Typeface', 'storesy' ),
						'text-transform' => true,
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'line-height'	 => false,
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( '.cg-product-info .price del span.amount', '.cg-product-info .price del' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => __( 'Typography option with each property can be called individually.', 'storesy' ),
						'default'		 => array(
							'color'			 => '#999999',
							'font-weight'	 => '400',
							'google'		 => true,
							'font-size'		 => '13px',
							'text-transform' => 'uppercase',
						),
					),
					array(
						'id'		 => 'cg_product_loop_cart_button_color',
						'type'		 => 'color',
						'title'		 => __( 'Add to cart button color', 'storesy' ),
						'subtitle'	 => __( 'Select the color for your Add to Cart button.', 'storesy' ),
						'default'	 => '#FFFFFF',
					),
					array(
						'id'		 => 'cg_product_loop_cart_button_text_color',
						'type'		 => 'color',
						'title'		 => __( 'Add to cart button text color', 'storesy' ),
						'subtitle'	 => __( 'Select the color for your Add to Cart button text.', 'storesy' ),
						'default'	 => '#111111',
					),
				),
			);

			$this->sections[] = array(
				'title'	 => __( 'Custom Code', 'storesy' ),
				'desc'	 => __( 'Add some custom code.', 'storesy' ),
				'fields' => array(
					array(
						'title'	 => __( 'Custom CSS', 'storesy' ),
						'desc'	 => __( 'Add some custom css to your site?', 'storesy' ),
						'id'	 => 'cg_custom_css',
						'type'	 => 'ace_editor',
						'mode'	 => 'css',
						'theme'	 => 'chrome'
					),
				),
			);
		}

		public function setHelpTabs() {

			// Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
			$this->args['help_tabs'][] = array(
				'id'		 => 'redux-help-tab-1',
				'title'		 => __( 'Theme Information 1', 'redux-framework-demo' ),
				'content'	 => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
			);

			$this->args['help_tabs'][] = array(
				'id'		 => 'redux-help-tab-2',
				'title'		 => __( 'Theme Information 2', 'redux-framework-demo' ),
				'content'	 => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
			);

			// Set the help sidebar
			$this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
		}

		/**
		 * Redux config
		 * */
		public function setArguments() {

			$theme = wp_get_theme(); // For use with some settings. Not necessary.

			$this->args = array(
				// TYPICAL -> Change these values as you need/desire

				'opt_name'				 => 'cg_reduxopt', // This is where your data is stored in the database and also becomes your global variable name.
				'display_name'			 => $theme->get( 'Name' ), // Name that appears at the top of your panel
				'display_version'		 => $theme->get( 'Version' ), // Version that appears at the top of your panel
				'menu_type'				 => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
				'allow_sub_menu'		 => true, // Show the sections below the admin menu item or not
				'menu_title'			 => __( 'Theme Options', 'storesy' ),
				'page_title'			 => __( 'Theme Options', 'storesy' ),
				// You will need to generate a Google API key to use this feature.
				// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
				'google_api_key'		 => 'AIzaSyB9TDy0IOriQpR8gt2TmoaZ070oWgIhvcs', // Must be defined to add google fonts to the typography module
				'google_update_weekly'	 => true,
				'async_typography'		 => false, // Use a asynchronous font on the front end or font string
				'admin_bar'				 => true, // Show the panel pages on the admin bar
				'global_variable'		 => 'cg_options', // Set a different name for your global variable other than the opt_name
				'dev_mode'				 => false, // Show the time the page took to load, etc
				'customizer'			 => true, // Enable basic customizer support
				//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
				//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
				// OPTIONAL -> Give you extra features
				'page_priority'			 => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
				'page_parent'			 => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
				'page_permissions'		 => 'manage_options', // Permissions needed to access the options panel.
				'menu_icon'				 => '', // Specify a custom URL to an icon
				'last_tab'				 => '', // Force your panel to always open to a specific tab (by id)
				'page_icon'				 => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
				'page_slug'				 => 'cg_reduxopt', // Page slug used to denote the panel
				'save_defaults'			 => true, // On load save the defaults to DB before user clicks save or not
				'default_show'			 => false, // If true, shows the default value next to each field that is not the default value.
				'default_mark'			 => '*', // What to print by the field's title if the value shown is default. Suggested: *
				'show_import_export'	 => true, // Shows the Import/Export panel when not used as a field.
				// CAREFUL -> These options are for advanced use only
				'transient_time'		 => 60 * MINUTE_IN_SECONDS,
				'output'				 => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
				'output_tag'			 => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
				'footer_credit'			 => false, // Disable the footer credit of Redux. Please leave if you can help it.
				// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
				'database'				 => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
				'system_info'			 => false, // REMOVE
				// HINTS
				'hints'					 => array(
					'icon'			 => 'icon-question-sign',
					'icon_position'	 => 'right',
					'icon_color'	 => 'lightgray',
					'icon_size'		 => 'normal',
					'tip_style'		 => array(
						'color'		 => 'light',
						'shadow'	 => true,
						'rounded'	 => false,
						'style'		 => '',
					),
					'tip_position'	 => array(
						'my' => 'top left',
						'at' => 'bottom right',
					),
					'tip_effect'	 => array(
						'show'	 => array(
							'effect'	 => 'slide',
							'duration'	 => '500',
							'event'		 => 'mouseover',
						),
						'hide'	 => array(
							'effect'	 => 'slide',
							'duration'	 => '500',
							'event'		 => 'click mouseleave',
						),
					),
				)
			);


			// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
			//$this->args[ 'share_icons' ][] = array(
			//    'url' => 'https://github.com/ReduxFramework/ReduxFramework',
			//    'title' => 'Visit us on GitHub',
			//    'icon' => 'el-icon-github'
			//    //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
			//);
			//$this->args[ 'share_icons' ][] = array(
			//    'url' => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
			//    'title' => 'Like us on Facebook',
			//    'icon' => 'el-icon-facebook'
			//);
			$this->args['share_icons'][] = array(
				'url'	 => esc_html__( 'http://twitter.com/commercegurus', 'storesy' ),
				'title'	 => esc_html__( 'Follow us on Twitter', 'storesy' ),
				'icon'	 => 'el-icon-twitter'
			);
			//$this->args[ 'share_icons' ][] = array(
			//    'url' => 'http://www.linkedin.com/company/redux-framework',
			//    'title' => 'Find us on LinkedIn',
			//    'icon' => 'el-icon-linkedin'
			//);
			// Panel Intro text -> before the form
			if ( !isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
				if ( !empty( $this->args['global_variable'] ) ) {
					$v = $this->args['global_variable'];
				} else {
					$v = str_replace( '-', '_', $this->args['opt_name'] );
				}
				//$this->args[ 'intro_text' ] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo' ), $v );
			} else {
				//$this->args[ 'intro_text' ] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo' );
			}

			// Add content after the form.
			//$this->args[ 'footer_text' ] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo' );
		}

	}

	global $reduxConfig;
	$reduxConfig = new Cg_Redux_Framework_config();
}

/**
 * Custom function for the callback referenced above
 */
if ( !function_exists( 'redux_theme_my_custom_field' ) ):

	function redux_theme_my_custom_field( $field, $value ) {
		print_r( $field );
		echo '<br/>';
		print_r( $value );
	}

endif;

/**
 * Custom function for the callback validation referenced above
 * */
if ( !function_exists( 'redux_theme_validate_callback_function' ) ):

	function redux_theme_validate_callback_function( $field, $value, $existing_value ) {
		$error	 = false;
		$value	 = 'just testing';

		/*
		  do your validation

		  if(something) {
		  $value = $value;
		  } elseif(something else) {
		  $error = true;
		  $value = $existing_value;
		  $field['msg'] = 'your custom error message';
		  }
		 */

		$return['value'] = $value;
		if ( $error == true ) {
			$return['error'] = $field;
		}
		return $return;
	}











endif;