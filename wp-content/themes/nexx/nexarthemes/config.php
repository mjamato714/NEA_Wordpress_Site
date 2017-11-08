<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "redux_options";

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'nexx' ),
        'page_title'           => esc_html__( 'Theme Options', 'nexx' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => 'theme_options',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => false,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '0',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => 'theme_options',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => false,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => true,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
		
		'network_sites'        => true,
        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = '';
    } else {
        $args['intro_text'] = '';
    }

    // Add content after the form.
    $args['footer_text'] = '';

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'nexx' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'nexx' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'nexx' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'nexx' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'nexx' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    // ACTUAL DECLARATION OF SECTIONS ****************************************** //
	// GENERAL SETTINGS SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'nxr_general',
		'icon'		=>	'el-icon-eye-open',
		'title'		=>	esc_html__('General Settings', 'nexx'),
		'desc'		=>	esc_html__('General settings for your website', 'nexx'),
        'fields'     => array(
					array(
                        'id'        => 'website_model',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Full-Width or Boxed?', 'nexx'),
                        'subtitle'  => esc_html__('Is your website Full-Width or Boxed?', 'nexx'),
                        'options'   => array(
                            'website_full_width'=> esc_html__('Full Width', 'nexx'), 
                            'website_boxed'		=> esc_html__('Boxed', 'nexx'), 
                        ), 
                        'default'   => 'website_full_width'
                    ),
					array(
                        'id'        => 'enable_smooth_scroll',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Smooth Scroll?', 'nexx'),
                        'subtitle'  => esc_html__('Enable / Disable smooth scrolling feature.', 'nexx'),
                        'default'   => 0,
                        'on'        => esc_html__('Enabled', 'nexx'),
                        'off'       => esc_html__('Disabled', 'nexx'),
                    ),
					array(
                        'id'        => 'enable_boxed_shadow',
                        'type'      => 'switch',
						'required'	=> array('website_model', '=', 'website_boxed'),
                        'title'     => esc_html__('Enable lateral shadow?', 'nexx'),
                        'subtitle'  => esc_html__('Enable or Disable website lateral shadow.', 'nexx'),
                        'default'   => 0,
                        'on'        => esc_html__('Enabled', 'nexx'),
                        'off'       => esc_html__('Disabled', 'nexx'),
                    ),
					array(
						'id'				=>	'website-background',
						'type'				=>	'background',
						'required'			=>	array('website_model', '=', 'website_boxed'),
						'compiler'			=>	array('body'),
						'output'			=>	array('body'),
						'title'				=>	esc_html__('Body Background', 'nexx'),
						'subtitle'			=>	esc_html__('Body background image (optional).', 'nexx'),
						'preview_height'	=>	'60px',
						'background-color'	=>	true,
					),
					array(
                        'id'        => 'enable_full_screen_search',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Full Screen Search into Menu Bar?', 'nexx'),
                        'subtitle'  => esc_html__('Enable or Disable Full Screen Search button into Menu Bar.', 'nexx'),
                        'default'   => 0,
                        'on'        => esc_html__('Enabled', 'nexx'),
                        'off'       => esc_html__('Disabled', 'nexx'),
                    ),
					array(
                        'id'        => 'enable_top_info_bar',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Info Bar?', 'nexx'),
                        'subtitle'  => esc_html__('Show / Hide Info Bar', 'nexx'),
                        'default'   => 0,
                        'on'        => esc_html__('Enabled', 'nexx'),
                        'off'       => esc_html__('Disabled', 'nexx'),
                    ),
					!class_exists( 'NXR_INFOBARS' ) ?
					array(
						'id'    => 'top_info_bar',
						'type'  => 'info',
						'style' => 'critical',
						'title' => esc_html__( 'Info Bar Error', 'nexx' ),
						'desc'  => sprintf( esc_html__( '<b>NexarThemes Info Bars Add-On</b> is not active. Please activate <a href="%s">here</a>', 'nexx' ), plugins_url() ),
						'required'	=> array('enable_top_info_bar', '=', '1'),
					) : NULL,
					array(
						'id'		=> 'top_info_bar_select',
						'type'		=> 'select',
						'required'	=> array('enable_top_info_bar', '=', '1'),
						'data'		=> 'posts',
						'args'		=> array('post_type' => 'nxr_info_bars'),
						'title'		=> esc_html__( 'Displayed Info Bar', 'nexx' ),
						'subtitle'	=> esc_html__( 'Select the info bar to be displayed.', 'nexx' ),
						'desc'		=> esc_html__( 'Info Bars are a special custom post type that allows you to display some info into your website.', 'nexx' ),
					),
					array(
                        'id'            => 'top_info_btn_font',
                        'type'          => 'typography',
						'required'		=> array('enable_top_info_bar', '=', '1'),
                        'title'         => esc_html__('Info Bar Button Font', 'nexx'),
                        'google'        => true,
                        'font-backup'   => true,
                        'font-style'    => true,	
                        'subsets'       => true,	
                        'font-size'     => true,
                        'line-height'   => true,
                        'word-spacing'  => true,
                        'letter-spacing'=> true,
                        'color'         => false,
						'text-transform'=> true,
                        'preview'       => true,	
                        'all_styles'    => true,	
                        'output'        => array('div.top_info_bar_btn'),
                        'units'         => array('px','em'),
                        'default'       => array(
                            //'color'         => '#000',
                            'font-style'    => '400',
                            'font-family'   => 'Roboto',
                            'google'        => true,
                            'font-size'     => '14px',
                            'line-height'   => '14px',
							'text-align'	=> 'center',
						),
                        'preview' => array('text' => 'ooga booga'),
                    ),
					array(
                        'id'            => 'top_info_content_font',
                        'type'          => 'typography',
						'required'		=> array('enable_top_info_bar', '=', '1'),
                        'title'         => esc_html__('Info Bar Content Font', 'nexx'),
                        'google'        => true,
                        'font-backup'   => true,
                        'font-style'    => true,	
                        'subsets'       => true,	
                        'font-size'     => true,
                        'line-height'   => true,
                        'word-spacing'  => true,
                        'letter-spacing'=> true,
                        'color'         => true,
                        'preview'       => true,	
                        'all_styles'    => true,	
                        'output'        => array('div.top_info_bar_content'),
                        'units'         => array('px','em'),
                        'default'       => array(
                            'color'         => '#000',
                            'font-style'    => '400',
                            'font-family'   => 'Roboto',
                            'google'        => true,
                            'font-size'     => '14px',
                            'line-height'   => '24px',
							'text-align'	=>	'left',
						),
                        'preview' => array('text' => 'ooga booga'),
                    ),
					array(
                        'id'            => 'top_info_bar_padding',
                        'type'          => 'spacing',
						'required'		=> array('enable_top_info_bar', '=', '1'),
                        'output'        => array('.top_info_bar'),
                        'mode'          => 'padding',
                        'all'           => false, 
                        'units'         => array('px','em'),
                        'units_extended'=> 'true',
                        'display_units' => 'true',
                        'title'         => esc_html__('Top Info Bar Padding', 'nexx'),
                        'subtitle'      => esc_html__('Choose the padding you want for your info bar.', 'nexx'),
                        'default'       => array(
                            'margin-top'    => '10', 
                            'margin-right'  => '30', 
                            'margin-bottom' => '10', 
                            'margin-left'   => '30'
                        )
                    ),
					array(
                        'id'        => 'body_border',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Enable body border?', 'nexx'),
                        'subtitle'  => esc_html__('Do you want do display a body border?', 'nexx'),
                        'options'   => array(
                            'body_border_on'	=> esc_html__('Enabled', 'nexx'), 
                            'body_border_off'	=> esc_html__('Disabled', 'nexx'), 
                        ), 
                        'default'   => 'body_border_off'
                    ),
					array(
						'id'		=> 'body_border_dimensions',
						'type'		=> 'dimensions',
						'title'		=> esc_html__('Body border width', 'nexx'),
						'subtitle'	=> esc_html__('This must be numeric only.', 'nexx'),
						'desc'		=> esc_html__('Enter value in pixels, NUMBERS ONLY', 'nexx'),
						'width'		=> true,
						'height'	=> false,
						'output'	=> false,
						'units'		=> array('px'),
						'default'	=> array(
							'width'	=> 15, 
						),
						'required'  => array('body_border', '=', 'body_border_on'),
					),
					array(
                        'id'        => 'body_border_color',
                        'type'      => 'color_rgba',
                        'title'     => esc_html__('Body border color', 'nexx'),
                        'subtitle'  => esc_html__('Style your body border color', 'nexx'),
                        'default'   => array('color' => '#dd9933', 'alpha' => '1.0'),
                        'output'    => array('#nxr_top, #nxr_bottom, #nxr_left, #nxr_right'),
						'compiler'  => array('#nxr_top, #nxr_bottom, #nxr_left, #nxr_right'),
                        'mode'      => 'background',
                        'validate'  => 'colorrgba',
						'required'  => array('body_border', '=', 'body_border_on'),
                    ),
					array(
						'id'		=> 'custom_error_page',
						'type'		=> 'select',
						'data'		=> 'posts',
						'args'		=> array('post_type' => 'page', 'nopaging' => true),
						'title'		=> esc_html__( 'Custom 404 page', 'nexx' ),
						'subtitle'	=> esc_html__( 'Select your custom 404 page.', 'nexx' ),
						'desc'		=> esc_html__( 'Go to pages and create your custom 404 page. After this, you can select it from here.', 'nexx' ),
					),
					array(
                        'id'        => 'section_bk_to_top_btn',
                        'type'      => 'section',
                        'title'     => esc_html__('Back to top button', 'nexx'),
                        'subtitle'  => esc_html__('Style your "Back To Top" button.', 'nexx'),
                        'indent'    => true // Indent all options below until the next 'section' option is set.
                    ),
					array(
                        'id'        => 'back_to_top_button',
                        'type'      => 'switch',
                        'title'     => esc_html__('Back To Top Button', 'nexx'),
                        'subtitle'  => esc_html__('Show / Hide "Back to top" button', 'nexx'),
                        'default'   => 1,
                        'on'        => esc_html__('Enabled', 'nexx'),
                        'off'       => esc_html__('Disabled', 'nexx'),
                    ),
					array(
                        'id'        => 'back_to_top_button_bg_color',
                        'type'      => 'color_rgba',
                        'title'     => esc_html__('Back to top button background color', 'nexx'),
                        'subtitle'  => esc_html__('Style your back to top button just the way you want.', 'nexx'),
                        'default'   => array('color' => '#dd9933', 'alpha' => '1.0'),
                        'output'    => array('.back-to-top'),
						'compiler'  => array('.back-to-top'),
                        'mode'      => 'background',
                        'validate'  => 'colorrgba',
						'required'  => array('back_to_top_button', '=', '1'),
                    ),
					array(
						'id'		=> 'back_to_top_button_dimensions',
						'type'		=> 'dimensions',
						'title'		=> esc_html__('Back to top button dimensions', 'nexx'),
						'subtitle'	=> esc_html__('This must be numeric only.', 'nexx'),
						'desc'		=> esc_html__('Enter value in pixels, NUMBERS ONLY', 'nexx'),
						'width'		=> true,
						'height'	=> false,
						'output'    => false,
						'units'		=> array('px'),
						'default'	=> array(
							'width'	=> '30px', 
						),
						'required'  => array('back_to_top_button', '=', '1'),
					),
		)
    ) );
	
	
	// DEVICE SETTINGS
	Redux::setSection( $opt_name, array(
        'id'			=> 'nxr_device',
		'icon'		=>	'el-icon-screen',
		'title'		=>	esc_html__('Device Specs', 'nexx'),
		'desc'		=>	esc_html__('Responsiveness and mobile specific settings are below. Use them so your website gets the perfect look, feel and functionality on any device.', 'nexx'),
        'fields'     => array(
			array(
				'id'        => 'section_media_queries',
				'type'      => 'section',
				'title'     => esc_html__('Media queries breakpoints', 'nexx'),
				'subtitle'  => esc_html__('Define the breakpoints at which your layout will change, adapting to different screen sizes.', 'nexx'),
				'indent'    => true,
			),
			array(
				'id'        => 'mediaquery_screen_xs',
				'type'      => 'text',
				'title'     => esc_html__('Extra Small Screen', 'nexx'),
				'subtitle'  => esc_html__('Extra small devices, like phones (<480px)', 'nexx'),
				'desc'      => esc_html__('Enter value in pixels, NUMBERS ONLY', 'nexx'),
				'validate'  => 'numeric',
				'default'   => '480',
			),
			array(
				'id'        => 'mediaquery_screen_s',
				'type'      => 'text',
				'title'     => esc_html__('Small Screen', 'nexx'),
				'subtitle'  => esc_html__('Small devices, like tablets (>=480px)', 'nexx'),
				'desc'      => esc_html__('Enter value in pixels, NUMBERS ONLY', 'nexx'),
				'validate'  => 'numeric',
				'default'   => '640',
			),
			array(
				'id'        => 'mediaquery_screen_m',
				'type'      => 'text',
				'title'     => esc_html__('Medium Screen', 'nexx'),
				'subtitle'  => esc_html__('Medium devices Desktops (<=768px)', 'nexx'),
				'desc'      => esc_html__('Enter value in pixels, NUMBERS ONLY', 'nexx'),
				'validate'  => 'numeric',
				'default'   => '768',
			),
			array(
				'id'        => 'mediaquery_screen_l',
				'type'      => 'text',
				'title'     => esc_html__('Large Screen', 'nexx'),
				'subtitle'  => esc_html__('Large devices Desktops (<=980px)', 'nexx'),
				'desc'      => esc_html__('Enter value in pixels, NUMBERS ONLY', 'nexx'),
				'validate'  => 'numeric',
				'default'   => '980',
			),
			array(
				'id'        => 'mediaquery_screen_xl',
				'type'      => 'text',
				'title'     => esc_html__('Extra Large Screen', 'nexx'),
				'subtitle'  => esc_html__('Extra Large devices Desktops (<=1280px)', 'nexx'),
				'desc'      => esc_html__('Enter value in pixels, NUMBERS ONLY', 'nexx'),
				'validate'  => 'numeric',
				'default'   => '1280',
			),
			array(
				'id'        => 'mediaquery_screen_xxl',
				'type'      => 'text',
				'title'     => esc_html__('XXL Screen', 'nexx'),
				'subtitle'  => esc_html__('XXL devices Desktops (>1280px)', 'nexx'),
				'desc'      => esc_html__('Enter value in pixels, NUMBERS ONLY', 'nexx'),
				'validate'  => 'numeric',
				'default'   => '1280',
			),
			array(
				'id'        => 'section_containers',
				'type'      => 'section',
				'title'     => esc_html__('Container sizes', 'nexx'),
				'subtitle'  => esc_html__('Define the maximum width of .container for different screen sizes.', 'nexx'),
				'indent'    => true,
			),
			array(
				'id'			=> 'container_xs',
				'type'		=> 'dimensions',
				'title'     => esc_html__('Extra Small Screen Container', 'nexx'),
				'subtitle'  => esc_html__('This must be numeric only.', 'nexx'),
				'desc'      => esc_html__('Enter value in pixels, NUMBERS ONLY', 'nexx'),
				'width'		=> true,
				'height'		=> false,
				'output'		=> array('.container_xs'),
				'units'		=> array('px'),
				'default'	=> array(
					'width'	=> '300px', 
				),
			),
			array(
				'id'			=> 'container_s',
				'type'		=> 'dimensions',
				'title'     => esc_html__('Small Screen Container', 'nexx'),
				'subtitle'  => esc_html__('This must be numeric only.', 'nexx'),
				'desc'      => esc_html__('Enter value in pixels, NUMBERS ONLY', 'nexx'),
				'width'		=> true,
				'height'		=> false,
				'output'		=> array('.container_s'),
				'units'		=> array('px'),
				'default'	=> array(
					'width'	=> '440px', 
				),
			),
			array(
				'id'			=> 'container_m',
				'type'		=> 'dimensions',
				'title'     => esc_html__('Medium Screen Container', 'nexx'),
				'subtitle'  => esc_html__('This must be numeric only.', 'nexx'),
				'desc'      => esc_html__('Enter value in pixels, NUMBERS ONLY', 'nexx'),
				'width'		=> true,
				'height'		=> false,
				'output'		=> array('.container_m'),
				'units'		=> array('px'),
				'default'	=> array(
					'width'	=> '600px', 
				),
			),
			array(
				'id'			=> 'container_l',
				'type'		=> 'dimensions',
				'title'		=> esc_html__('Large Screen Container', 'nexx'),
				'subtitle'	=> esc_html__('This must be numeric only.', 'nexx'),
				'desc'		=> esc_html__('Enter value in pixels, NUMBERS ONLY', 'nexx'),
				'width'		=> true,
				'height'		=> false,
				'output'		=> array('.container_l'),
				'units'		=> array('px'),
				'default'	=> array(
					'width'	=> '720px', 
				),
			),
			array(
				'id'			=> 'container_xl',
				'type'		=> 'dimensions',
				'title'		=> esc_html__('Extra Large Screen Container', 'nexx'),
				'subtitle'	=> esc_html__('This must be numeric only.', 'nexx'),
				'desc'		=> esc_html__('Enter value in pixels, NUMBERS ONLY', 'nexx'),
				'width'		=> true,
				'height'		=> false,
				'output'		=> array('.container_xl'),
				'units'		=> array('px'),
				'default'	=> array(
					'width'	=> '920px', 
				),
			),
			array(
				'id'			=> 'container_xxl',
				'type'		=> 'dimensions',
				'title'		=> esc_html__('XXL Screen Container', 'nexx'),
				'subtitle'	=> esc_html__('This must be numeric only.', 'nexx'),
				'desc'		=> esc_html__('Enter value in pixels, NUMBERS ONLY', 'nexx'),
				'width'		=> true,
				'height'		=> false,
				'output'		=> array('.container_xxl'),
				'units'		=> array('px'),
				'default'	=> array(
					'width'	=> '1200px', 
				),
			),
			
		)
	) );
	// BRANDING SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'nxr_branding',
		'icon'		=> 'el-icon-globe',
		'title'		=>	esc_html__('Branding', 'nexx'),
        'fields'		=> array(
			array(
				'id'				=>	'logo',
				'type'			=>	'media',
				'title'			=>	esc_html__('Regular logo', 'nexx'),
				'subtitle'		=>	esc_html__('Upload your logo. <br>Recomended: 174px x 60px transparent .png', 'nexx'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array( 'url'=>get_template_directory_uri().'/nexarthemes/images/logo.png', 'width'=>'174', 'height'=>'60' ),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
			array(
				'id'				=>	'retina_logo',
				'type'			=>	'media',
				'title'			=>	esc_html__('Retina Logo @2x', 'nexx'),
				'subtitle'		=>	esc_html__('Upload your retina logo. <br>Recomended: 348px x 120px transparent .png', 'nexx'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array( 'url'=>get_template_directory_uri().'/nexarthemes/images/logo@2x.png','width'=>'174', 'height'=>'60' ),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
			array(
				'id'				=>	'favicon',
				'type'			=>	'media',
				'title'			=>	esc_html__('Regular Favicon', 'nexx'),
				'subtitle'		=>	esc_html__('Upload your favicon. <br>Recomended: 16px x 16px transparent .png file', 'nexx'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array('url'=>get_template_directory_uri().'/nexarthemes/images/favicon.png'),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
			array(
				'id'				=>	'retina_favicon',
				'type'			=>	'media',
				'title'			=>	esc_html__('Retina Favicon @2x', 'nexx'),
				'subtitle'		=>	esc_html__('Upload your retina favicon. <br>Recomended: 32px x 32px transparent .png file', 'nexx'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array('url'=>get_template_directory_uri().'/nexarthemes/images/favicon@2x.png'),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
			array(
				'id'				=>	'iphone_icon',
				'type'			=>	'media',
				'title'			=>	esc_html__('Apple iPhone Icon', 'nexx'),
				'subtitle'		=>	esc_html__('Upload your Apple iPhone icon. <br>Recomended: 60px x 60px transparent .png file', 'nexx'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array('url'=>get_template_directory_uri().'/nexarthemes/images/iphone-favicon.png'),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
			array(
				'id'				=>	'retina_iphone_icon',
				'type'			=>	'media',
				'title'			=>	esc_html__('Apple iPhone Retina Icon @2x', 'nexx'),
				'subtitle'		=>	esc_html__('Upload your Apple iPhone Retina icon. <br>Recomended: 120px x 120px transparent .png file', 'nexx'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array('url'=>get_template_directory_uri().'/nexarthemes/images/iphone-favicon@2x.png'),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
			array(
				'id'				=>	'ipad_icon',
				'type'			=>	'media',
				'title'			=>	esc_html__('Apple iPad Icon', 'nexx'),
				'subtitle'		=>	esc_html__('Upload your Apple iPad icon. <br>Recomended: 76px x 76px transparent .png file', 'nexx'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array('url'=>get_template_directory_uri().'/nexarthemes/images/ipad-favicon.png'),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
			array(
				'id'				=>	'ipad_retina_icon',
				'type'			=>	'media',
				'title'			=>	esc_html__('Apple iPad Retina Icon @2x', 'nexx'),
				'subtitle'		=>	esc_html__('Upload your Apple iPad Retina icon. <br>Recomended: 152px x 152px transparent .png file', 'nexx'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array('url'=>get_template_directory_uri().'/nexarthemes/images/ipad-favicon@2x.png'),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
		)
    ) );
	
	// COLORS SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'nxr_colors',
		'icon'		=>	'el-icon-eye-open',
		'title'		=>	esc_html__('Colors', 'nexx'),
		'desc'		=>	esc_html__('You can setup two color schemes: dark and light', 'nexx'),
        'fields'     => array(
			array(
				'id'				=>	'bg_color',
				'type'			=>	'color',
				'validate'		=>	'color',
				'compiler'		=>	array('body'),
				'output'			=>	array('body'),
				'title'			=>	esc_html__('Body Background Color', 'nexx'), 
				'subtitle'		=>	esc_html__('Pick a background color for the theme.', 'nexx'),
				'default'		=>	'#666666',
			),
			array(
				'id'				=>	'theme_dominant_color',
				'type'			=>	'color',
				'validate'		=>	'color',
				'compiler'		=>	array('.theme_dominant_color'),
				'output'			=>	array('.theme_dominant_color'),
				'title'			=>	esc_html__('Theme dominant color', 'nexx'), 
				'subtitle'		=>	esc_html__('Pick a dominant color for the theme.', 'nexx'),
				'hint'			=>	array(
					'content'	=>	'Theme dominant color its used on certain elements, for witch you do not have a specific option to define a color.',
				),
				'default'		=>	'#dd9933',
			),
		)
    ) );
	
	// COLORS SECTION - Dark Color Scheme
    Redux::setSection( $opt_name, array(
        'title'		=>	esc_html__('Dark Color Scheme', 'nexx'),
        'id'         => 'nxr_dark_colors',
		'subsection' => true,
        'fields'     => array(
			array(
				'id'			=>	'dark-scheme-info',
				'type'		=>	'info',
				'desc'		=>	esc_html__('Color options settings for "dark" color scheme (website sections that feature a dark image or background color; a light text color is recommended for these sections).', 'nexx'),
			),
			array(
				'id'			=>	'ds_text_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.dark_scheme, .dark_scheme.nxr_megafooter'),
				'output'		=>	array('.dark_scheme, .dark_scheme.nxr_megafooter'),
				'title'		=>	esc_html__('Text color', 'nexx'), 
				'subtitle'	=>	esc_html__('Pick a color for text.', 'nexx'),
				'default'	=>	'#e0e0e0',
			),
			array(
				'id'			=>	'h1_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.dark_scheme h1, .dark_scheme.nxr_megafooter h1'),
				'output'		=>	array('.dark_scheme h1, .dark_scheme.nxr_megafooter h1'),
				'title'		=>	esc_html__('H1 Color', 'nexx'), 
				'subtitle'	=>	esc_html__('Pick a color for H1 tags.', 'nexx'),
				'default'	=>	'#ffffff',
			),
			array(
				'id'			=>	'h2_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.dark_scheme h2, .dark_scheme.nxr_megafooter h2'),
				'output'		=>	array('.dark_scheme h2, .dark_scheme.nxr_megafooter h2'),
				'title'		=>	esc_html__('H2 Color', 'nexx'), 
				'subtitle'	=>	esc_html__('Pick a color for H2 tags.', 'nexx'),
				'default'	=>	'#ffffff',
			),
			array(
				'id'			=>	'h3_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.dark_scheme h3, .dark_scheme.nxr_megafooter h3'),
				'output'		=>	array('.dark_scheme h3, .dark_scheme.nxr_megafooter h3'),
				'title'		=>	esc_html__('H3 Color', 'nexx'), 
				'subtitle'	=>	esc_html__('Pick a color for H3 tags.', 'nexx'),
				'default'	=>	'#e0e0e0',
			),
			array(
				'id'			=>	'h4_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.dark_scheme h4, .dark_scheme.nxr_megafooter h4'),
				'output'		=>	array('.dark_scheme h4, .dark_scheme.nxr_megafooter h4'),
				'title'		=>	esc_html__('H4 Color', 'nexx'), 
				'subtitle'	=>	esc_html__('Pick a color for H4 tags.', 'nexx'),
				'default'	=>	'#ffffff',
			),
			array(
				'id'			=>	'h5_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.dark_scheme h5, .dark_scheme.nxr_megafooter h5'),
				'output'		=>	array('.dark_scheme h5, .dark_scheme.nxr_megafooter h5'),
				'title'		=>	esc_html__('H5 Color', 'nexx'), 
				'subtitle'	=>	esc_html__('Pick a color for H5 tags.', 'nexx'),
				'default'	=>	'#ffffff',
			),
			array(
				'id'			=>	'h6_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.dark_scheme h6, .dark_scheme.nxr_megafooter h6'),
				'output'		=>	array('.dark_scheme h6, .dark_scheme.nxr_megafooter h6'),
				'title'		=>	esc_html__('H6 Color', 'nexx'), 
				'subtitle'	=>	esc_html__('Pick a color for H6 tags.', 'nexx'),
				'default'	=>	'#ffffff',
			),
			array(
				'id'        	=>	'ahref_color',
				'type'      	=>	'link_color',
				'compiler'	=>	array('.dark_scheme a, .dark_scheme.nxr_megafooter a'),
				'output'		=>	array('.dark_scheme a, .dark_scheme.nxr_megafooter a'),
				'title'		=>	esc_html__('Links Color', 'nexx'), 
				'subtitle'	=>	esc_html__('Pick a color for links.', 'nexx'),
				'desc'      	=>	esc_html__('Setup links color on regular and hovered state.', 'nexx'),
				'regular'   	=>	true,	// Enable / Disable Regular Color
				'hover'     	=>	true,	// Enable / Disable Hover Color
				'active'    	=>	false,	// Enable / Disable Active Color
				'visited'   	=>	false,	// Enable / Disable Visited Color
				'default'   	=>	array(
					'regular'	=>	'#e0e0e0',
					'hover'		=>	'#dd9933',
				)
			),
		)
    ) );
	
	// COLORS SECTION - Light Color Scheme
    Redux::setSection( $opt_name, array(
        'title'		=>	esc_html__('Light Color Scheme', 'nexx'),
        'id'         => 'nxr_light_colors',
		'subsection' => true,
        'fields'     => array(
			array(
				'id'			=>	'light-scheme-info',
				'type'		=>	'info',
				'desc'		=>	esc_html__('Color options settings for "light" color scheme (website sections that feature a light image or background color; a dark text color is recommended for these sections).', 'nexx'),
			),
			array(
				'id'			=>	'ls_text_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.light_scheme'),
				'output'		=>	array('.light_scheme'),
				'title'		=>	esc_html__('Text color', 'nexx'), 
				'subtitle'	=>	esc_html__('Pick a color for text.', 'nexx'),
				'default'	=>	'#848484',
			),
			array(
				'id'			=>	'light_h1_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.light_scheme h1'),
				'output'		=>	array('.light_scheme h1'),
				'title'		=>	esc_html__('H1 Color', 'nexx'), 
				'subtitle'	=>	esc_html__('Pick a color for H1 tags.', 'nexx'),
				'default'	=>	'#222222',
			),
			array(
				'id'			=>	'light_h2_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.light_scheme h2'),
				'output'		=>	array('.light_scheme h2'),
				'title'		=>	esc_html__('H2 Color', 'nexx'), 
				'subtitle'	=>	esc_html__('Pick a color for H2 tags.', 'nexx'),
				'default'	=>	'#222222',
			),
			array(
				'id'			=>	'light_h3_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.light_scheme h3'),
				'output'		=>	array('.light_scheme h3'),
				'title'		=>	esc_html__('H3 Color', 'nexx'), 
				'subtitle'	=>	esc_html__('Pick a color for H3 tags.', 'nexx'),
				'default'	=>	'#666666',
			),
			array(
				'id'			=>	'light_h4_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.light_scheme h4'),
				'output'		=>	array('.light_scheme h4'),
				'title'		=>	esc_html__('H4 Color', 'nexx'), 
				'subtitle'	=>	esc_html__('Pick a color for H4 tags.', 'nexx'),
				'default'	=>	'#222222',
			),
			array(
				'id'			=>	'light_h5_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.light_scheme h5'),
				'output'		=>	array('.light_scheme h5'),
				'title'		=>	esc_html__('H5 Color', 'nexx'), 
				'subtitle'	=>	esc_html__('Pick a color for H5 tags.', 'nexx'),
				'default'	=>	'#222222',
			),
			array(
				'id'			=>	'light_h6_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.light_scheme h6'),
				'output'		=>	array('.light_scheme h6'),
				'title'		=>	esc_html__('H6 Color', 'nexx'), 
				'subtitle'	=>	esc_html__('Pick a color for H6 tags.', 'nexx'),
				'default'	=>	'#848484',
			),
			array(
				'id'        	=>	'light_ahref_color',
				'type'      	=>	'link_color',
				'compiler'	=>	array('.light_scheme a'),
				'output'		=>	array('.light_scheme a'),
				'title'		=>	esc_html__('Links Color', 'nexx'), 
				'subtitle'	=>	esc_html__('Pick a color for links.', 'nexx'),
				'desc'      	=>	esc_html__('Setup links color on regular and hovered state.', 'nexx'),
				'regular'   	=>	true,	// Enable / Disable Regular Color
				'hover'     	=>	true,	// Enable / Disable Hover Color
				'active'    	=>	false,	// Enable / Disable Active Color
				'visited'   	=>	false,	// Enable / Disable Visited Color
				'default'   	=>	array(
					'regular'	=>	'#848484',
					'hover'		=>	'#dd9933',
				)
			),
		)
    ) );
	
	// TYPOGRAPHY SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'nxr_typography',
		'icon'      => 'el-icon-fontsize',
		'title'		=>	esc_html__('Typography', 'nexx'),
		'desc'		=>	esc_html__('Setup the fonts that will be used in your theme. You can choose from Standard Fonts and Google Web Fonts.', 'nexx'),
        'fields'     => array(
			array(
				'id'					=>	'body-font',
				'type'				=>	'typography',
				'title'				=>	esc_html__('Body Font', 'nexx'),
				'subtitle' 			=>	esc_html__('Specify the body font properties.', 'nexx'),
				'compiler'			=>	array('body, .megamenu'),
				'output'				=>	array('body, .megamenu'),
				'google'				=>	true,
				'color'				=>	false,
				'text-transform'	=>	true,
				'letter-spacing'	=>	true,
				'default'			=>	array(
					'font-size'			=>	'14px',
					'line-height'		=>	'28px',
					'font-family'		=>	'Roboto',
					'font-weight'		=>	'400',
				),
			),
			array(
				'id'					=>	'h1-font',
				'type'				=>	'typography',
				'title'				=>	esc_html__('H1 Font', 'nexx'),
				'subtitle'			=>	esc_html__('Specify the H1 font properties.', 'nexx'),
				'compiler'			=>	array('h1, .megamenu h1'),
				'output'				=>	array('h1, .megamenu h1'),
				'google'				=>	true,
				'color'				=>	false,
				'text-transform'	=>	true,
				'letter-spacing'	=>	true,
				'default'			=>	array(
					'font-size'			=>	'60px',
					'line-height'		=>	'72px',
					'font-family'		=>	'Roboto Slab',
					'font-weight'		=>	'300',
				),
			),
			array(
				'id'					=>	'h2-font',
				'type'				=>	'typography',
				'title'				=>	esc_html__('H2 Font', 'nexx'),
				'subtitle'			=>	esc_html__('Specify the H2 font properties.', 'nexx'),
				'compiler'			=>	array('h2, .megamenu h2'),
				'output'				=>	array('h2, .megamenu h2'),
				'google'				=>	true,
				'color'				=>	false,
				'text-transform'	=>	true,
				'letter-spacing'	=>	true,
				'default'			=>	array(
					'font-size'			=>	'36px',
					'line-height'		=>	'40px',
					'font-family'		=>	'Roboto Slab',
					'font-weight'		=>	'300',
				),
			),
			array(
				'id'					=>	'h3-font',
				'type'				=>	'typography',
				'title'				=>	esc_html__('H3 Font', 'nexx'),
				'subtitle'			=>	esc_html__('Specify the H3 font properties.', 'nexx'),
				'compiler'			=>	array('h3, .megamenu h3'),
				'output'				=>	array('h3, .megamenu h3'),
				'google'				=>	true,
				'color'				=>	false,
				'text-transform'	=>	true,
				'letter-spacing'	=>	true,
				'default'			=>	array(
					'font-size'			=>	'48px',
					'line-height'		=>	'56px',
					'font-family'		=>	'Dancing Script',
					'font-weight'		=>	'',
				),
			),
			array(
				'id'					=>	'h4-font',
				'type'				=>	'typography',
				'title'				=>	esc_html__('H4 Font', 'nexx'),
				'subtitle'			=>	esc_html__('Specify the H4 font properties.', 'nexx'),
				'compiler'			=>	array('h4, .megamenu h4'),
				'output'				=>	array('h4, .megamenu h4'),
				'google'				=>	true,
				'color'				=>	false,
				'text-transform'	=>	true,
				'letter-spacing'	=>	true,
				'default'			=>	array(
					'font-size'			=>	'18px',
					'line-height'		=>	'30px',
					'font-family'		=>	'Roboto Slab',
					'font-weight'		=>	'400',
				),
			),
			array(
				'id'					=>	'h5-font',
				'type'				=>	'typography',
				'title'				=>	esc_html__('H5 Font', 'nexx'),
				'subtitle'			=>	esc_html__('Specify the H5 font properties.', 'nexx'),
				'compiler'			=>	array('h5, .megamenu h5'),
				'output'				=>	array('h5, .megamenu h5'),
				'google'				=>	true,
				'color'				=>	false,
				'text-transform'	=>	true,
				'letter-spacing'	=>	true,
				'default'			=> array(
					'font-size'			=>	'14px',
					'line-height'		=>	'24px',
					'font-family'		=>	'Roboto Condensed',
					'font-weight'		=>	'700',
				),
			),
			array(
				'id'					=>	'h6-font',
				'type'				=>	'typography',
				'title'				=> 	esc_html__('H6 Font', 'nexx'),
				'subtitle'			=> 	esc_html__('Specify the H6 font properties.', 'nexx'),
				'compiler'			=> 	array('h6, .megamenu h6'),
				'output'				=> 	array('h6, .megamenu h6'),
				'google'				=>	true,
				'color'				=>	false,
				'text-transform'	=>	true,
				'letter-spacing'	=>	true,
				'default'			=>	array(
					'font-size'			=>	'12px',
					'line-height'		=>	'18px',
					'font-family'		=>	'Source Sans Pro',
					'font-weight'		=>	'300',
				),
			),
			// PAGE TITLES
			array(
				'id'        => 'section_page_title',
				'type'      => 'section',
				'title'     => esc_html__('Page Title', 'nexx'),
				'subtitle'  => esc_html__('Customize your page title.', 'nexx'),
				'indent'    => true, // Indent all options below until the next 'section' option is set.
			),
			array(
				'id'        => 'enable_page_title',
				'type'      => 'switch',
				'title'     => esc_html__('Enable Page Title?', 'nexx'),
				'subtitle'  => esc_html__('Enable / Disable page title feature.', 'nexx'),
				'default'   => 0,
				'on'        => esc_html__('Enabled', 'nexx'),
				'off'       => esc_html__('Disabled', 'nexx'),
			),
			array(
				'id'					=>	'page_title_h1',
				'type'				=>	'typography',
				'title'				=>	esc_html__('Page Title', 'nexx'),
				'subtitle'			=>	esc_html__('Specify the font properties for pages title.', 'nexx'),
				'compiler'			=>	array('.page_title_container h1'),
				'output'				=>	array('.page_title_container h1'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'letter-spacing'	=>	true,
				'default'			=>	array(
					'color'				=>	'#666666',
					'font-size'			=>	'60px',
					'line-height'		=>	'72px',
					'font-family'		=>	'Roboto Slab',
					'font-weight'		=>	'300',
				),
				'required'  			=> array('enable_page_title', '=', '1'),
			),
			array(
				'id'            => 'page_title_padding',
				'type'          => 'spacing',
				'mode'          => 'padding',
				'all'           => false, 
				'units'         => array('px','em'),
				'units_extended'=> 'true',
				'display_units' => 'true',
				'title'         => esc_html__('Page title padding', 'nexx'),
				'default'       => array(
					'margin-top'    => '80px', 
					'margin-right'  => '0px', 
					'margin-bottom' => '80px', 
					'margin-left'   => '0px'
				),
				'required'  		=> array('enable_page_title', '=', '1'),
			),
			
		)
    ) );
	
	// HEADER & MENU SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'nxr_menu',
		'icon'		=> 'el-icon-website',
		'title'		=>	esc_html__('Header & Menu', 'nexx'),
        'fields'		=> array(
			/* HEADER STYLE */
			array(
				'id'        => 'section_menu_style',
				'type'      => 'section',
				'title'     => esc_html__('Menu Styling', 'nexx'),
				'subtitle'  => esc_html__('Customize your menu.', 'nexx'),
				'indent'    => true, // Indent all options below until the next 'section' option is set.
			),
			array(
				'id'        => 'menu_bar_width',
				'type'      => 'button_set',
				'title'     => esc_html__('Full-Width or Boxed?', 'nexx'),
				'subtitle'  => esc_html__('Do you want your menu bar to expand full width or to be contained?', 'nexx'),
				'options'   => array(
					'menu_full_width'	=> esc_html__('Full Width', 'nexx'), 
					'menu_contained'	=> esc_html__('Contained', 'nexx'), 
				), 
				'default'   => 'menu_contained'
			),
			
			array(
				'id'				=>	'menu-font',
				'type'			=>	'typography',
				'title'			=>	esc_html__('Menu Font', 'nexx'),
				'subtitle'		=>	esc_html__('Specify the menu font properties.', 'nexx'),
				'compiler'		=>	array('#nxr_top_navbar_container, #nxr_top_navbar_container #main_navbar>li>a, #nxr_top_navbar_container #main_navbar_left>li>a, .dropdown-menu > li > a'),
				'output'			=>	array('#nxr_top_navbar_container, #nxr_top_navbar_container #main_navbar>li>a, #nxr_top_navbar_container #main_navbar_left>li>a, .dropdown-menu > li > a'),
				'google'			=>	true,
				'letter-spacing'=>	true,
				'text-transform'=>	true,
				'color'			=>	false,
				'default'		=>	array(
					'font-size'			=>	'14px',
					'line-height'		=>	'60px',
					'font-family'		=>	'Roboto',
					'font-weight'		=>	'400',
					'letter-spacing'	=>	'',
				),
			),
			array(
				'id'        	=>	'menu-font-hover-color',
				'type'      	=>	'link_color',
				'compiler'	=>	array('#nxr_top_navbar_container #main_navbar>li>a, #nxr_top_navbar_container #main_navbar_left>li>a, .dropdown-menu>li>a, a.mobileFsSearch, .blog a.mobileFsSearch, a.cd-primary-nav-trigger, .blog a.cd-primary-nav-trigger, a.nxr_minicart, a.nxr_minicart .icon'),
				'output'		=>	array('#nxr_top_navbar_container #main_navbar>li>a, #nxr_top_navbar_container #main_navbar_left>li>a, .dropdown-menu>li>a, a.mobileFsSearch, .blog a.mobileFsSearch, a.cd-primary-nav-trigger, .blog a.cd-primary-nav-trigger, a.nxr_minicart, a.nxr_minicart .icon'),
				'title'		=>	esc_html__('Menu Font Color', 'nexx'),
				'subtitle'	=>	esc_html__('Specify the menu font color.', 'nexx'),
				'regular'   	=>	true,	// Enable / Disable Regular Color
				'hover'     	=>	true,	// Enable / Disable Hover Color
				'active'    	=>	false,	// Enable / Disable Active Color
				'visited'   	=>	false,	// Enable / Disable Visited Color
				'default'   	=>	array(
					'regular'	=>	'#000000',
					'hover'		=>	'#dd9933',
				)
			),
			
			/* Header Margins and paddings */
			array(
				'id'        => 'section_header_margins_paddings',
				'type'      => 'section',
				'title'     => esc_html__('Header Margins and paddings', 'nexx'),
				'indent'    => true, // Indent all options below until the next 'section' option is set.
			),
			array(
				'id'            => 'identity_padding',
				'type'          => 'spacing',
				'output'        => array('.nxr_identity'),
				'mode'          => 'padding',
				'all'           => false, 
				'units'         => array('px','em'),
				'units_extended'=> 'true',
				'display_units' => 'true',
				'title'         => esc_html__('Logo paddings', 'nexx'),
				'subtitle'      => esc_html__('Choose the padding you want for your logo.', 'nexx'),
				'default'       => array(
					'margin-top'    => '0', 
					'margin-right'  => '0', 
					'margin-bottom' => '0', 
					'margin-left'   => '0'
				)
			),
			array(
				'id'            => 'top_menu_padding',
				'type'          => 'spacing',
				'output'        => array('.main_navbar_container, .left_menu_container'),
				'mode'          => 'padding',
				'all'           => false, 
				'units'         => array('px','em'),
				'units_extended'=> 'true',
				'display_units' => 'true',
				'title'         => esc_html__('Top menu paddings', 'nexx'),
				'subtitle'      => esc_html__('Choose the padding you want for your top menu.', 'nexx'),
				'default'       => array(
					'margin-top'    => '0', 
					'margin-right'  => '0', 
					'margin-bottom' => '0', 
					'margin-left'   => '0'
				)
			),
			array(
				'id'            => 'top_middle_bar_right_side_padding',
				'type'          => 'spacing',
				'output'        => array('.fixed_menu_middle_bar_right_side, .fixed_menu_middle_bar_middle_side, .fixed_menu_middle_bar_left_side'),
				'mode'          => 'padding',
				'all'           => false, 
				'units'         => array('px','em'),
				'units_extended'=> 'true',
				'display_units' => 'true',
				'title'         => esc_html__('Top-Middle Bar right side paddings', 'nexx'),
				'default'       => array(
					'margin-top'    => '0', 
					'margin-right'  => '0', 
					'margin-bottom' => '0', 
					'margin-left'   => '0'
				),
				'required'  			=> array('header_floating', '=', '6'),
			),
			
			/* HEADER STYLE */
			array(
				'id'        => 'section_header_style_one',
				'type'      => 'section',
				'title'     => esc_html__('Header Styling', 'nexx'),
				'subtitle'  => esc_html__('Customize your header.', 'nexx'),
				'indent'    => true, // Indent all options below until the next 'section' option is set.
			),
			array(
				'id'			=>	'header_floating',
				'type'		=>	'select',
				'title'     => esc_html__('Header bar display', 'nexx'),
				//'subtitle'  => esc_html__('Do you want to display "Header" as fixed or to float as scrolling?', 'nexx'),
				'options'   => array(
					'1' => esc_html__('Fixed Header (Left Logo)', 'nexx'), 
					'2' => esc_html__('Appears after scrolling (Left Logo)', 'nexx'),
					'3' => esc_html__('Dissapears after scrolling (Left Logo)', 'nexx'), 
					'4' => esc_html__('Shrinks after scrolling (Left Logo)', 'nexx'),
					'5' => esc_html__('Transparent before scrolling (Left Logo)', 'nexx'), 
					'6' => esc_html__('Complex header (Left Logo)', 'nexx'),
					'7' => esc_html__('Fixed Header (Central Logo)', 'nexx'),
					'8' => esc_html__('Appears after scrolling (Central Logo)', 'nexx'),
					'9' => esc_html__('Dissapears after scrolling (Central Logo)', 'nexx'), 
					'10' => esc_html__('Shrinks after scrolling (Central Logo)', 'nexx'),
					'11' => esc_html__('Transparent before scrolling (Central Logo)', 'nexx'), 
				),
				'default'	=>	'1',
				'hint'		=>	array(
					'content'	=>	'<strong>Fixed Header:</strong> header is fixed, and stays there no matter if you scroll.<br><br>
									<strong>Appears after scrolling:</strong> This is hidden when page loads, and after a certain amount of scrolling (settings below) it appears.<br><br>
									<strong>Disappears after scrolling:</strong> This is displayed when page loads, and after a certain amount of scrolling (settings below) it disappears. As you start to scroll back to top it appears.<br><br>
									<strong>Shrinks after scrolling:</strong> Initially displayed as a large header. The initial height is set by adding padding (settings below). After a certain amount of scrolling (settings below) it shrinks. Shrinked dimensions are set below by modifying the paddings to a lower value.<br><br>
									<strong>Transparent before scrolling:</strong> Initially displayed as a transparent header. It scrolls with the page, and, after a certain amount of scrolling (settings below) it appears as transparent or with a background color (settings below).<br><br>
									<strong>Complex header:</strong> It displays a fixed menu that scrolls with the page and a fall down menu after scrolling a certain amount of pixels.<br><br>
									<strong>NOTE</strong> Some specific settings (ex: necessary pixels to scroll) are displayed only if specific header type selected.
								',
				)
			),
			
			// Hidden, display after scroll
			array(
				'id'                => 'header_floating_display_after',
				'type'              => 'dimensions',
				'width'          	=> false,
				'units'             => array('px'),   // You can specify a unit value. Possible: px, em, %
				'units_extended'    => 'false',  // Allow users to select any type of unit
				'title'             => esc_html__('Display header after scrolling:', 'nexx'),
				'output'    			=> false,
				'default'           => array('height' => '200'),
				'required'  			=> array('header_floating', '=', array('2','6','8')),
				'hint'				=>	array(
					'content'	=>	'<p>Define the scroll amount necesarry for header bar to be displayed. <br><strong>Leave blank for window screen height</strong>.</p>',
				)
			),
			
			
			// Displayed, hidden after scroll
			array(
				'id'                => 'header_floating_hide_after',
				'type'              => 'dimensions',
				'width'          	=> false,
				'units'             => array('px'),
				'units_extended'    => 'false',
				'title'             => esc_html__('Hide header after scrolling:', 'nexx'),
				'output'    			=> false,
				'default'           => array('height' => '200'),
				'required'  			=> array('header_floating', '=', array('3','9') ),
				'hint'				=>	array(
					'content'	=>	'<p>Define the scroll amount necesarry for header bar to be hidden. <br><strong>Leave blank for window screen height</strong>.</p>',
				)
			),
			
			// SHRINKING SETTINGS
			array(
				'id'                => 'header_shrink_after_scroll',
				'type'              => 'dimensions',
				'width'          	=> false,
				'units'             => array('px'),
				'units_extended'    => 'false',
				'title'             => esc_html__('Shrink header after scrolling:', 'nexx'),
				'output'    			=> false,
				'default'           => array('height' => '200'),
				'required'  			=> array('header_floating', '=', array('4','10')),
				'hint'				=>	array(
					'content'	=>	'<p>Define the scroll amount necesarry for header bar to shrink. <br><strong>Leave blank for window screen height</strong>.<br> Use padding settings below to setup height of the header bar, before and after scroll.</p>',
				)
			),
			array(
				'id'            => 'menu_bar_initial_height',
				'type'          => 'dimensions',
				'width'         => false,
				'units'         => array('px','em'),
				'units_extended'=> 'true',
				'display_units' => 'true',
				'title'         => esc_html__('Initial Header Height', 'nexx'),
				'default'       => array('height' => '150'),
				'required'  		=> array('header_floating', '=', array('4','10')),
				'hint'			=>	array(
					'content'	=>	'<p>The initial height of the header. Here you can setup the initial value (large header).</p>',
				)
			),
			array(
				'id'            => 'menu_bar_final_height',
				'type'          => 'dimensions',
				'width'         => false,
				'units'         => array('px','em'),
				'units_extended'=> 'false',
				'title'         => esc_html__('Final Header Height', 'nexx'),
				'default'       => array('height' => '100'),
				'required'  		=> array('header_floating', '=', array('4','10')),
				'hint'			=>	array(
					'content'	=>	'<p>For the shriking effect, here we setup smaller value for header bar. Give it a smaller value that above.</p>',
				)
			),
			
			// TRANSPARENT SETTINGS
			array(
				'id'                => 'header_transparent_display_after',
				'type'              => 'dimensions',
				'width'          	=> false,
				'units'             => array('px'),   // You can specify a unit value. Possible: px, em, %
				'units_extended'    => 'false',  // Allow users to select any type of unit
				'title'             => esc_html__('Slide down after:', 'nexx'),
				'subtitle'          => esc_html__('Header bar is scrolling up with the page. After this amount of scrolling it floats down and remains fixed to page top.', 'nexx'),
				'output'    			=> false,
				'default'           => array('height' => '200'),
				'required'  			=> array('header_floating', '=', array('5','11') ),
				'hint'				=>	array(
					'content'	=>	esc_html__('Define the scroll amount necesarry for header bar to be displayed. Leave blank for window screen height.', 'nexx'),
				)
			),
			array(
				'id'            => 'header_transp_bg_opacity_after_scroll',
				'type'          => 'slider',
				'title'     => esc_html__('Header Background Opacity After Scroll', 'nexx'),
				'subtitle'  => esc_html__('0 = Transparent, 1 - Opaque', 'nexx'),
				'default'       => 1,
				'min'           => 0,
				'step'          => .1,
				'max'           => 1,
				'resolution'    => 0.1,
				'display_value' => 'text',
				'required'  => array('header_floating', '=', array('5','11') ),
			),
			
			
			array(
				'id'        => 'header_background_type',
				'type'      => 'button_set',
				'title'     => esc_html__('Header background type:', 'nexx'),
				'options'   => array(
					'1' => esc_html__('Color', 'nexx'), 
					'2' => esc_html__('Image', 'nexx'), 
				),
				'default'   => '1',
				'hint'			=>	array(
					'content'	=>	esc_html__('What kind of background you wanna use for your header? You can have solid color, semi-transparent color, full transparent header, OR, you can use a image or a pattern.', 'nexx'),
				)
			),
			
			
			// FIXED SETTINGS
			array(
				'id'        => 'header_background_rgba',
				'type'      => 'color_rgba',
				'title'     => esc_html__('Header Background color', 'nexx'),
				'default'   => array('color' => '#ffffff', 'alpha' => '1.0'),
				'output'    => array('#nxr_top_navbar_container, #main_navbar .dropdown-menu, #main_navbar_left .dropdown-menu, #mainNavUlLeft .dropdown-menu, #mainNavUlRight .dropdown-menu'),
				'mode'      => 'background',
				'validate'  => 'colorrgba',
				'required'  => array('header_background_type', '=', array('1','7') ),
				'hint'			=>	array(
					'content'	=>	esc_html__('Gives you the RGBA color for header background. Also, this is where you set up the transparency grade.', 'nexx'),
				)
				
			),
			
			
			// Header BG color for TRANSPARENT
			array(
				'id'        => 'header_transparent_bg_rgba',
				'type'      => 'color_rgba',
				'title'     => esc_html__('Header Background color', 'nexx'),
				'subtitle'  => esc_html__('Gives you the RGBA color for background.', 'nexx'),
				'default'   => array('color' => '#ffffff', 'alpha' => '1.0'),
				'mode'      => 'background',
				'validate'  => 'colorrgba',
				'required'  => array('header_background_type', '=', array('5','11') ),
			),
			array(
				'id'        			=> 'header_background_image',
				'type'      			=> 'background',
				'output'   			=> array('#nxr_top_navbar_container, #main_navbar .dropdown-menu,, #main_navbar_left .dropdown-menu'),
				'title'    			=> esc_html__('Header Background Image or Pattern', 'nexx'),
				'subtitle'  			=> esc_html__('Pick a background image or pattern for the header.', 'nexx'),
				'default'   			=> '',
				'background-color'	=> false,
				'required' 			=> array('header_background_type', '=', array('2','8') ),
			),
			
			
			
			
			// GERERAL SETTINGS
			array(
				'id'        => 'header_opacity_change_after_scroll',
				'type'      => 'button_set',
				'title'     => esc_html__('Do you want header to change opacity after scroll?', 'nexx'),
				'options'   => array(
					'1' => esc_html__('Yes', 'nexx'), 
					'2' => esc_html__('No', 'nexx'), 
				),
				'default'   => '1',
				'required'  => array('header_floating', '=', array('1','7') ),
			),
			array(
				'id'                => 'header_background_opacity_change_after_amount',
				'type'              => 'dimensions',
				'width'          	=> false,
				'units'             => array('px'),   // You can specify a unit value. Possible: px, em, %
				'units_extended'    => 'false',  // Allow users to select any type of unit
				'title'             => esc_html__('Change opacity after scrolling X pixels', 'nexx'),
				'subtitle'          => esc_html__('Define the scroll amount necesarry for menu to change opacity.  Insert -1 for window screen height.', 'nexx'),
				'output'    		=> false,
				'default'           => array('height' => '200'),
				'required'  => array('header_opacity_change_after_scroll', '=', array('1','7') ),
			),
			array(
				'id'            => 'header_background_opacity_after_scroll',
				'type'          => 'slider',
				'title'     => esc_html__('Header Background Opacity After Scroll', 'nexx'),
				'subtitle'  => esc_html__('0 = Transparent, 1 - Opaque', 'nexx'),
				'default'       => 1,
				'min'           => 0,
				'step'          => .1,
				'max'           => 1,
				'resolution'    => 0.1,
				'display_value' => 'text',
				'required'  => array('header_opacity_change_after_scroll', '=', array('1','7') ),
			),
			array(
				'id'        => 'header_border',
				'type'      => 'border',
				'title'     => esc_html__('Header Border', 'nexx'),
				'compiler'	=> array('#nxr_top_navbar_container'),
				'output'    => array('#nxr_top_navbar_container'),
				'desc'      => esc_html__('Setup header border, in pixels (top, right, bottom, left).', 'nexx'),
				'all'       => false,
				'default'   => array(
					'border-color'  => '#cecece', 
					'border-style'  => 'solid', 
					'border-top'    => '0px', 
					'border-right'  => '0px', 
					'border-bottom' => '0px', 
					'border-left'   => '0px',
				)
			),
	
			array(
				'id'            => 'header_margins',
				'type'          => 'spacing',
				'output'        => array('#nxr_top_navbar_container'), // An array of CSS selectors to apply this font style to
				'mode'          => 'margin',    // absolute, padding, margin, defaults to padding
				'all'           => false,        // Have one field that applies to all
				'units'         => array('px','em'), // You can specify a unit value. Possible: px, em, %
				'units_extended'=> 'true',    // Allow users to select any type of unit
				'display_units' => 'true',   // Set to false to hide the units if the units are specified
				'title'         => esc_html__('Header Margins', 'nexx'),
				'subtitle'      => esc_html__('Choose the margin you want for your header.', 'nexx'),
				'default'       => array(
					'margin-top'    => '0', 
					'margin-right'  => '0', 
					'margin-bottom' => '0', 
					'margin-left'   => '0'
				)
			),
			array(
				'id'            => 'menu_bar_padding',
				'type'          => 'spacing',
				'output'        => array('#nxr_top_navbar_container'),
				'mode'          => 'padding',
				'all'           => false, 
				'units'         => array('px','em'),
				'units_extended'=> 'true',
				'display_units' => 'true',
				'title'         => esc_html__('Header Padding', 'nexx'),
				'subtitle'      => esc_html__('Choose the padding you want for your header.', 'nexx'),
				'default'       => array(
					'margin-top'    => '0', 
					'margin-right'  => '0', 
					'margin-bottom' => '0', 
					'margin-left'   => '0'
				),
				'required'  		=> array('header_floating', '!=', array('4','10') ),
			),
			array(
				'id'                => 'page_top_offset',
				'type'              => 'dimensions',
				'width'          	=> false,
				'units'             => array('px'),   // You can specify a unit value. Possible: px, em, %
				'units_extended'    => 'false',  // Allow users to select any type of unit
				'title'             => esc_html__('Page top offset', 'nexx'),
				'output'    			=> false,
				'default'           => array('height' => '-30'),
				'required'  			=> array('header_floating', '=', '6'),
				'hint'				=>	array(
					'content'	=>	'<p>Use this setting to offset the top of the page.</p>',
				)
			),
			
			/* Complex Header Styling */
			array(
				'id'        => 'section_complex_header_style',
				'type'      => 'section',
				'title'     => esc_html__('Complex Header Styling', 'nexx'),
				'subtitle'  => esc_html__('The sections below are available only for "Header bar display: Complex Header" chosen above. Complex header consists in 3 bars (rows) each containing different information and formating. Please style each row with the settings below.', 'nexx'),
				'indent'    => true, // Indent all options below until the next 'section' option is set.
				'required'  	=> array('header_floating', '=', '6'),
			),
			
			// TOP BAR
			array(
				'id'        => 'section_complex_header_style_top_bar',
				'type'      => 'section',
				'title'     => esc_html__('Top Bar', 'nexx'),
				'indent'    => true, // Indent all options below until the next 'section' option is set.
				'required'  	=> array('header_floating', '=', '6'),
			),
				array(
						'id'			=>	'fixed_menu-font_top_bar',
						'type'			=>	'typography',
						'title'			=>	esc_html__('Font', 'nexx'),
						'subtitle'		=>	esc_html__('Specify the menu font properties for top bar.', 'nexx'),
						'compiler'		=>	array('#nxr_fixed_menu .fixed_menu_top_bar'),
						'output'		=>	array('#nxr_fixed_menu .fixed_menu_top_bar'),
						'google'		=>	true,
						'letter-spacing'=>	true,
						'text-transform'=>	true,
						'color'			=>	true,
						'default'		=>	array(
							'font-size'			=>	'14px',
							'line-height'		=>	'60px',
							'font-family'		=>	'Roboto',
							'font-weight'		=>	'400',
							'letter-spacing'	=>	'',
							'color'				=>	'#ffffff'
						),
					),
					array(
						'id'        	=>	'fixed_menu-font-hover-color_top_bar',
						'type'      	=>	'link_color',
						'compiler'		=>	array('#nxr_fixed_menu .fixed_menu_top_bar a'),
						'output'		=>	array('#nxr_fixed_menu .fixed_menu_top_bar a'),
						'title'			=>	esc_html__('Links Color', 'nexx'),
						'subtitle'		=>	esc_html__('Specify the links color for top bar.', 'nexx'),
						'regular'   	=>	true,	// Enable / Disable Regular Color
						'hover'     	=>	true,	// Enable / Disable Hover Color
						'active'    	=>	false,	// Enable / Disable Active Color
						'visited'   	=>	false,	// Enable / Disable Visited Color
						'default'   	=>	array(
							'regular'	=>	'#000000',
							'hover'		=>	'#dd9933',
						)
					),
					array(
						'id'        => 'top_bar_background_rgba',
						'type'      => 'color_rgba',
						'title'     => esc_html__('Top Bar Background color', 'nexx'),
						'default'   => array('color' => '#ffffff', 'alpha' => '1.0'),
						'output'    => array('#nxr_fixed_menu .fixed_menu_top_bar'),
						'mode'      => 'background',
						'validate'  => 'colorrgba',
						'hint'			=>	array(
							'content'	=>	esc_html__('Gives you the RGBA color for top bar background. Also, this is where you set up the transparency grade.', 'nexx'),
						)
					),
					array(
						'id'		=>	'top_bar_left_column',
						'type'		=>	'textarea',
						'validate'	=>	'html',
						'title'		=>	esc_html__('Top bar, left side content', 'nexx'), 
						'subtitle'	=>	esc_html__('If empty, this section will be hidden.', 'nexx'),
						'desc'		=>	esc_html__('HTML is permited', 'nexx'),
						'default'	=>	'HOT Offers Get a quote <a href="#">NOW!</a>'
					),
					array(
						'id'            => 'top_bar_padding',
						'type'          => 'spacing',
						'mode'          => 'padding',
						'all'           => false, 
						'units'         => array('px','em'),
						'units_extended'=> 'true',
						'compiler'		=>	array('#nxr_fixed_menu .fixed_menu_top_bar'),
						'output'		=>	array('#nxr_fixed_menu .fixed_menu_top_bar'),
						'display_units' => 'true',
						'title'         => esc_html__('Top Bar Padding', 'nexx'),
						'default'       => array(
							'margin-top'    => '5px', 
							'margin-right'  => '5px', 
							'margin-bottom' => '5px', 
							'margin-left'   => '5px'
						),
					),
			
			// MIDDLE BAR
			array(
				'id'        => 'section_complex_header_style_middle_bar',
				'type'      => 'section',
				'title'     => esc_html__('Middle Bar', 'nexx'),
				'indent'    => true, // Indent all options below until the next 'section' option is set.
				'required'  	=> array('header_floating', '=', '6'),
			),
					array(
						'id'			=>	'fixed_menu-font_middle_bar',
						'type'			=>	'typography',
						'title'			=>	esc_html__('Font', 'nexx'),
						'subtitle'		=>	esc_html__('Specify the menu font properties for middle bar.', 'nexx'),
						'compiler'		=>	array('#nxr_fixed_menu .fixed_menu_middle_bar_left_side, #nxr_fixed_menu .fixed_menu_middle_bar_middle_side, #nxr_fixed_menu .fixed_menu_middle_bar_right_side'),
						'output'		=>	array('#nxr_fixed_menu .fixed_menu_middle_bar_left_side, #nxr_fixed_menu .fixed_menu_middle_bar_middle_side, #nxr_fixed_menu .fixed_menu_middle_bar_right_side'),
						'google'		=>	true,
						'letter-spacing'=>	true,
						'text-transform'=>	true,
						'color'			=>	true,
						'default'		=>	array(
							'font-size'			=>	'14px',
							'line-height'		=>	'60px',
							'font-family'		=>	'Roboto',
							'font-weight'		=>	'400',
							'letter-spacing'	=>	'',
							'color'				=>	'#ffffff'
						),
					),
					array(
						'id'        	=>	'fixed_menu-font-hover-color_middle_bar',
						'type'      	=>	'link_color',
						'compiler'		=>	array('#nxr_fixed_menu .fixed_menu_middle_bar_left_side a, #nxr_fixed_menu .fixed_menu_middle_bar_middle_side a, #nxr_fixed_menu .fixed_menu_middle_bar_right_side a'),
						'output'		=>	array('#nxr_fixed_menu .fixed_menu_middle_bar_left_side a, #nxr_fixed_menu .fixed_menu_middle_bar_middle_side a, #nxr_fixed_menu .fixed_menu_middle_bar_right_side a'),
						'title'			=>	esc_html__('Links Color', 'nexx'),
						'subtitle'		=>	esc_html__('Specify the links color for middle bar.', 'nexx'),
						'regular'   	=>	true,	// Enable / Disable Regular Color
						'hover'     	=>	true,	// Enable / Disable Hover Color
						'active'    	=>	false,	// Enable / Disable Active Color
						'visited'   	=>	false,	// Enable / Disable Visited Color
						'default'   	=>	array(
							'regular'	=>	'#000000',
							'hover'		=>	'#dd9933',
						)
					),
					array(
						'id'        => 'middle_bar_background_rgba',
						'type'      => 'color_rgba',
						'title'     => esc_html__('Middle Bar Background color', 'nexx'),
						'default'   => array('color' => '#ffffff', 'alpha' => '1.0'),
						'output'    => array('#nxr_fixed_menu .fixed_menu_middle_bar'),
						'mode'      => 'background',
						'validate'  => 'colorrgba',
						'hint'			=>	array(
							'content'	=>	esc_html__('Gives you the RGBA color for middle bar background. Also, this is where you set up the transparency grade.', 'nexx'),
						)
					),
					array(
						'id'		=>	'middle_bar_first_column',
						'type'		=>	'textarea',
						'validate'	=>	'html',
						'title'		=>	esc_html__('First column content', 'nexx'), 
						'subtitle'	=>	esc_html__('If empty, this section will be hidden.', 'nexx'),
						'desc'		=>	esc_html__('HTML is permited', 'nexx'),
						'default'	=>	'HOT Offers<br>Get a quote NOW!'
					),
					array(
						'id'		=>	'middle_bar_second_column',
						'type'		=>	'textarea',
						'validate'	=>	'html',
						'title'		=>	esc_html__('Second column content', 'nexx'), 
						'subtitle'	=>	esc_html__('If empty, this section will be hidden.', 'nexx'),
						'desc'		=>	esc_html__('HTML is permited', 'nexx'),
						'default'	=>	'HOT Offers<br>Get a quote NOW!'
					),
					array(
						'id'		=>	'middle_bar_third_column',
						'type'		=>	'textarea',
						'validate'	=>	'html',
						'title'		=>	esc_html__('Third column content', 'nexx'), 
						'subtitle'	=>	esc_html__('If empty, this section will be hidden.', 'nexx'),
						'desc'		=>	esc_html__('HTML is permited', 'nexx'),
						'default'	=>	'HOT Offers<br>Get a quote NOW!'
					),
					array(
						'id'            => 'middle_bar_padding',
						'type'          => 'spacing',
						'mode'          => 'padding',
						'all'           => false, 
						'units'         => array('px','em'),
						'units_extended'=> 'true',
						'compiler'		=>	array('#nxr_fixed_menu .fixed_menu_middle_bar'),
						'output'		=>	array('#nxr_fixed_menu .fixed_menu_middle_bar'),
						'display_units' => 'true',
						'title'         => esc_html__('Middle Bar Padding', 'nexx'),
						'default'       => array(
							'margin-top'    => '20px', 
							'margin-right'  => '0px', 
							'margin-bottom' => '20px', 
							'margin-left'   => '0px'
						),
					),
			
			// BOTTOM BAR
			array(
				'id'        => 'section_complex_header_style_bottom_bar',
				'type'      => 'section',
				'title'     => esc_html__('Bottom Bar', 'nexx'),
				'indent'    => true, // Indent all options below until the next 'section' option is set.
				'required'  	=> array('header_floating', '=', '6'),
			),
					array(
						'id'			=>	'fixed_menu-font',
						'type'			=>	'typography',
						'title'			=>	esc_html__('Menu Font', 'nexx'),
						'subtitle'		=>	esc_html__('Specify the menu font properties.', 'nexx'),
						'compiler'		=>	array('#nxr_fixed_menu .fixed_menu_bottom_bar, #nxr_fixed_menu .fixed_menu_bottom_bar .fixed_navbar_container .fixed_navbar>li>a, #nxr_fixed_menu .fixed_menu_bottom_bar .dropdown-menu > li > a'),
						'output'		=>	array('#nxr_fixed_menu .fixed_menu_bottom_bar, #nxr_fixed_menu .fixed_menu_bottom_bar .fixed_navbar_container .fixed_navbar>li>a, #nxr_fixed_menu .fixed_menu_bottom_bar .dropdown-menu > li > a'),
						'google'		=>	true,
						'letter-spacing'=>	true,
						'text-transform'=>	true,
						'color'			=>	false,
						'default'		=>	array(
							'font-size'			=>	'14px',
							'line-height'		=>	'60px',
							'font-family'		=>	'Roboto',
							'font-weight'		=>	'400',
							'letter-spacing'	=>	'',
						),
					),
					array(
						'id'        	=>	'fixed_menu-font-hover-color',
						'type'      	=>	'link_color',
						'compiler'		=>	array('#nxr_fixed_menu .fixed_menu_bottom_bar .fixed_navbar_container .fixed_navbar>li>a, #nxr_fixed_menu .fixed_menu_bottom_bar .dropdown-menu>li>a'),
						'output'		=>	array('#nxr_fixed_menu .fixed_menu_bottom_bar .fixed_navbar_container .fixed_navbar>li>a, #nxr_fixed_menu .fixed_menu_bottom_bar .dropdown-menu>li>a'),
						'title'			=>	esc_html__('Menu Font Color', 'nexx'),
						'subtitle'		=>	esc_html__('Specify the menu font color.', 'nexx'),
						'regular'   	=>	true,	// Enable / Disable Regular Color
						'hover'     	=>	true,	// Enable / Disable Hover Color
						'active'    	=>	false,	// Enable / Disable Active Color
						'visited'   	=>	false,	// Enable / Disable Visited Color
						'default'   	=>	array(
							'regular'	=>	'#000000',
							'hover'		=>	'#dd9933',
						)
					),
					array(
						'id'        => 'bottom_bar_background_rgba',
						'type'      => 'color_rgba',
						'title'     => esc_html__('Bottom Bar Background color', 'nexx'),
						'default'   => array('color' => '#ffffff', 'alpha' => '1.0'),
						'output'    => array('#nxr_fixed_menu .fixed_menu_bottom_bar, #fixed_navbar .dropdown-menu'),
						'mode'      => 'background',
						'validate'  => 'colorrgba',
						'hint'			=>	array(
							'content'	=>	esc_html__('Gives you the RGBA color for bottom bar background. Also, this is where you set up the transparency grade.', 'nexx'),
						)
					),
					array(
						'id'            => 'bottom_bar_padding',
						'type'          => 'spacing',
						'mode'          => 'padding',
						'all'           => false, 
						'units'         => array('px','em'),
						'units_extended'=> 'true',
						'compiler'		=>	array('#nxr_fixed_menu .fixed_menu_bottom_bar'),
						'output'		=>	array('#nxr_fixed_menu .fixed_menu_bottom_bar'),
						'display_units' => 'true',
						'title'         => esc_html__('Bottom Bar Padding', 'nexx'),
						'default'       => array(
							'margin-top'    => '5px', 
							'margin-right'  => '5px', 
							'margin-bottom' => '5px', 
							'margin-left'   => '5px'
						),
					),
					
		)
    ) );
	// Mobile Menu
	Redux::setSection( $opt_name, array(
        'id'			=> 'nxr_mobilemenu',
		'icon'		=> '',
		'title'		=>	esc_html__('Mobile Menu', 'nexx'),
		'subsection'=> true,
        'fields'		=> array(
			array(
				'id'				=>	'mobile-menu-font',
				'type'			=>	'typography',
				'title'			=>	esc_html__('Mobile Menu Font', 'nexx'),
				'subtitle'		=>	esc_html__('Specify the mobile menu font properties.', 'nexx'),
				'compiler'		=>	array('.cd-primary-nav a, .blog .cd-primary-nav a,  #mainNavUl .dropdown-menu.multi-level li a'),
				'output'			=>	array('.cd-primary-nav a, .blog .cd-primary-nav a,  #mainNavUl .dropdown-menu.multi-level li a'),
				'google'			=>	true,
				'letter-spacing'=>	true,
				'text-transform'=>	true,
				'color'			=>	false,
				'default'		=>	array(
					'font-size'			=>	'14px',
					'line-height'		=>	'60px',
					'font-family'		=>	'Roboto',
					'font-weight'		=>	'400',
					'letter-spacing'	=>	'',
				),
			),
			array(
				'id'        	=>	'mobile-menu-font-hover-color',
				'type'      	=>	'link_color',
				'compiler'	=>	array('.cd-primary-nav a, .blog .cd-primary-nav a, #mainNavUl .dropdown-menu.multi-level li a, a.mobilemenuopen'),
				'output'		=>	array('.cd-primary-nav a, .blog .cd-primary-nav a, #mainNavUl .dropdown-menu.multi-level li a, a.mobilemenuopen'),
				'title'		=>	esc_html__('Mobile Menu Font Color', 'nexx'),
				'subtitle'	=>	esc_html__('Specify the mobile menu font color.', 'nexx'),
				'regular'   	=>	true,	// Enable / Disable Regular Color
				'hover'     	=>	true,	// Enable / Disable Hover Color
				'active'    	=>	false,	// Enable / Disable Active Color
				'visited'   	=>	false,	// Enable / Disable Visited Color
				'default'   	=>	array(
					'regular'	=>	'#000000',
					'hover'		=>	'#dd9933',
				)
			),
			array(
				'id'        => 'mobile_menu_background_rgba',
				'type'      => 'color_rgba',
				'title'     => esc_html__('Mobile Menu Background color', 'nexx'),
				'default'   => array('color' => '#000000', 'alpha' => '0.9'),
				'output'    => array('.cd-primary-nav'),
				'mode'      => 'background',
				'validate'  => 'colorrgba',
				'hint'			=>	array(
					'content'	=>	esc_html__('Gives you the RGBA color for mobile menu background. Also, this is where you set up the transparency grade.', 'nexx'),
				)
				
			),
		)
    ) );
		
	
	// FOOTER SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'nxr_footer',
		'icon'		=> 'el-icon-hand-down',
		'title'		=>	esc_html__('Footer', 'nexx'),
        'fields'		=> array(
			array(
				'id'        => 'footer_fallback',
				'type'      => 'section',
				'title'     => esc_html__('Footer Fallback', 'nexx'),
				'indent'    => true, // Indent all options below until the next 'section' option is set.
			),
			array(
				'id'		=> 'footer-bgcolor',
				'type'		=> 'color',
				'title'		=>	esc_html__('Footer background color', 'nexx'), 
				'subtitle'	=>	esc_html__('Set the background color for footer', 'nexx'),
				'default'	=> '#222222',
				'validate'	=> 'color',
			),
			array(
				'id'		=>	'footer_color_scheme',
				'type'		=>	'select',
				'title'		=>	esc_html__('Color scheme to use on footer', 'nexx'), 
				'options'	=>	array('dark_scheme' => 'Dark scheme','light_scheme' => 'Light scheme'),
				'default'	=>	'dark_scheme'
			),
			array(
				'id'		=>	'footer-copyright',
				'type'		=>	'textarea',
				'validate'	=>	'html',
				'title'		=>	esc_html__('Footer copyright text', 'nexx'), 
				'subtitle'	=>	esc_html__('If empty, this section will be hidden.', 'nexx'),
				'desc'		=>	esc_html__('HTML is permited', 'nexx'),
				'default'	=>	sprintf( '%s <a href="%s">%s</a> %s', esc_html__('Copyright 2017', 'nexx'), esc_url( home_url() ), esc_attr( get_bloginfo('name') ), esc_html__('All rights reserved.', 'nexx') ),
			),
		)
    ) );
	// MEGA FOOTER SECTION
    Redux::setSection( $opt_name, array(
        'id'		=> 'nxr_megafooter',
		'icon'		=> 'el-icon-hand-down',
		'title'		=>	esc_html__('NXR MegaFooter', 'nexx'),
		'subsection'=> true,
        'fields'	=> array(
			
			!class_exists('NXR_MEGAFOOTER') ?  
			array(
						'id'    => 'nxr_megafooter_support_info',
						'type'  => 'info',
						'style' => 'warning',
						'title' => esc_html__( 'NXR MegaFooter Warning', 'nexx' ),
						'desc'  => sprintf( '%s <a href="%s">NXR MegaFooter</a> %s', esc_html__('Please first install and activate', 'nexx'), admin_url('plugins.php'), esc_html__('otherwise the "Footer Fallback" settings will be used.', 'nexx') ),
			)
			: NULL,
			array(
				'id'		=> 'nxr_megafooter_select',
				'type'		=> 'select',
				'data'		=> 'posts',
				'args'		=> array('post_type' => 'nxr_megafooter'),
				'title'		=> esc_html__( 'Default MegaFooter', 'nexx' ),
				'subtitle'	=> esc_html__( 'Select the default MegaFooter to be displayed on all pages.', 'nexx' ),
				'desc'		=> esc_html__( 'You can opt for a specific MegaFooter on a specific page when you edit that page. Otherwise, the default MegaFooter will be used on all pages across entire website', 'nexx' ),
			),
		)
    ) );
		
	
	// CONTACT FORM SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'nxr_contactform',
		'icon'		=>	'el el-brush',
		'title'		=>	esc_html__('Contact Form', 'nexx'),
		'desc'		=>	esc_html__('Style your Contact Form', 'nexx'),
        'fields'     => array(
			
			!class_exists('WPCF7') ?  
			array(
						'id'    => 'cf_support_info',
						'type'  => 'info',
						'style' => 'critical',
						'title' => esc_html__( 'Contact Form 7 Error', 'nexx' ),
						'desc'  => sprintf( '%s <a href="%s">here</a> %s', esc_html__('Please first activate Contact Form 7', 'nexx'), admin_url('plugins.php'), esc_html__(', otherwise the settings below will be ignored.', 'nexx') ),
			)
			: NULL,
			array(
				'id'					=> 'cf_label_font',
				'type'				=> 'typography',
				'compiler'			=>	array('.wpcf7 p'),
				'output'				=>	array('.wpcf7 p'),
				'title'				=>	esc_html__('Label Font', 'nexx'),
				'subtitle'			=>	esc_html__('Specify the labels font properties.', 'nexx'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#666666',
					'font-size'		=>	'12px',
					'line-height'	=>	'30px',
					'font-family'	=>	'Roboto',
					'font-weight'	=>	'700',
				),
			),
			array(
				'id'					=> 'cf_input_font',
				'type'				=> 'typography',
				'compiler'			=>	array('.wpcf7 input[type=text], .wpcf7 input[type=email], .wpcf7 textarea'),
				'output'				=>	array('.wpcf7 input[type=text], .wpcf7 input[type=email], .wpcf7 textarea'),
				'title'				=>	esc_html__('Input Font', 'nexx'),
				'subtitle'			=>	esc_html__('Specify the input font properties.', 'nexx'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#8e8e8e',
					'font-size'		=>	'12px',
					'line-height'	=>	'12px',
					'font-family'	=>	'Roboto',
					'font-weight'	=>	'400',
				),
			),
			array(
				'id'        =>	'cf_input_field_bg',
				'type'      =>	'color_rgba',
				'title'		=>	esc_html__('Input fields Background Color', 'nexx'),
				'default'   =>	array('color' => '', 'alpha' => ''),
				'compiler'	=>	array('.wpcf7 input[type=text], .wpcf7 input[type=email], .wpcf7 textarea'),
				'output'		=>	array('.wpcf7 input[type=text], .wpcf7 input[type=email], .wpcf7 textarea'),
				'mode'      =>	'background',
				'validate'  =>	'colorrgba',
			),
			array(
				'id'            => 'cf_input_field_roundness',
				'type'          => 'spacing',
				'mode'          => 'padding',
				'all'           => true, 
				'units'         => array('px'),
				'units_extended'=> 'true',
				'display_units' => 'true',
				'title'    		=> esc_html__('Input fields and button roundness', 'nexx'),
				'desc'      		=> esc_html__('Enter value in pixels, NUMBERS ONLY', 'nexx'),
				'default'       => array(
					'margin-top'    => '0', 
					'margin-right'  => '0', 
					'margin-bottom' => '0', 
					'margin-left'   => '0'
				)
			),
			array(
				'id'            => 'cf_input_padding',
				'type'          => 'spacing',
				'compiler'		=>	array('.wpcf7 input[type=text], .wpcf7 input[type=email], .wpcf7 textarea'),
				'output'			=>	array('.wpcf7 input[type=text], .wpcf7 input[type=email], .wpcf7 textarea'),
				'mode'          => 'padding',
				'all'           => false, 
				'units'         => array('px','em'),
				'units_extended'=> 'true',
				'display_units' => 'true',
				'title'         => esc_html__('Input fields Padding', 'nexx'),
				'subtitle'      => esc_html__('Choose the padding you want for your input fields.', 'nexx'),
				'default'       => array(
					'margin-top'    => '15', 
					'margin-right'  => '15', 
					'margin-bottom' => '15', 
					'margin-left'   => '15'
				)
			),
			array(
				'id'            => 'cf_input_margin',
				'type'          => 'spacing',
				'compiler'		=>	array('.wpcf7 input[type=text], .wpcf7 input[type=email], .wpcf7 textarea, .wpcf7 input[type=submit]'),
				'output'			=>	array('.wpcf7 input[type=text], .wpcf7 input[type=email], .wpcf7 textarea, .wpcf7 input[type=submit]'),
				'mode'          => 'margin',
				'all'           => false, 
				'units'         => array('px','em'),
				'units_extended'=> 'true',
				'display_units' => 'true',
				'title'         => esc_html__('Input fields Margin', 'nexx'),
				'subtitle'      => esc_html__('Choose the margin you want for your input fields.', 'nexx'),
				'default'       => array(
					'margin-top'    => '0', 
					'margin-right'  => '0', 
					'margin-bottom' => '12', 
					'margin-left'   => '0'
				)
			),
			array(
				'id'        => 'cf_input_border',
				'type'      => 'border',
				'title'     => esc_html__('Inputs Border', 'nexx'),
				'compiler'	=> array('.wpcf7 input[type=text], .wpcf7 input[type=email], .wpcf7 textarea'),
				'output'    => array('.wpcf7 input[type=text], .wpcf7 input[type=email], .wpcf7 textarea'),
				'desc'      => esc_html__('Setup input fields border, in pixels (top, right, bottom, left).', 'nexx'),
				'all'       => false,
				'default'   => array(
					'border-color'  => '#cecece', 
					'border-style'  => 'dotted', 
					'border-top'    => '1px', 
					'border-right'  => '1px', 
					'border-bottom' => '1px', 
					'border-left'   => '1px',
				)
			),
			array(
				'id'			=> 'cf_input_submit_height',
				'type'		=> 'dimensions',
				'title'     => esc_html__('Submit Button Height', 'nexx'),
				'subtitle'  => esc_html__('This must be numeric only.', 'nexx'),
				'desc'      => esc_html__('Enter value in pixels, NUMBERS ONLY', 'nexx'),
				'width'		=> false,
				'height'		=> true,
				'compiler'	=>	array('.wpcf7 input[type=submit]'),
				'output'		=>	array('.wpcf7 input[type=submit]'),
				'units'		=> array('px'),
				'default'	=> array(
					'height'=> 50, 
				),
			),
			array(
				'id'        => 'cf_input_submit_bg',
				'type'      => 'color_rgba',
				'title'		=>	esc_html__('Submit Button Background Color', 'nexx'),
				'subtitle'	=>	esc_html__('Regular state color.', 'nexx'),
				'default'   => array('color' => '#dd9933', 'alpha' => '1.0'),
				'compiler'	=>	array('.wpcf7 input[type=submit]'),
				'output'		=>	array('.wpcf7 input[type=submit]'),
				'mode'      => 'background',
				'validate'  => 'colorrgba',
			),
			array(
				'id'        => 'cf_input_submit_hover_bg',
				'type'      => 'color_rgba',
				'title'		=>	esc_html__('Submit Button Background Color', 'nexx'),
				'subtitle'	=>	esc_html__('Hover state color.', 'nexx'),
				'default'   => array('color' => '#be8124', 'alpha' => '1.0'),
				'compiler'	=>	array('.wpcf7 input[type=submit]:hover'),
				'output'		=>	array('.wpcf7 input[type=submit]:hover'),
				'mode'      => 'background',
				'validate'  => 'colorrgba',
			),
			array(
				'id'        	=>	'cf_input_submit_clr',
				'type'      	=>	'link_color',
				'compiler'	=>	array('.wpcf7 input[type=submit]'),
				'output'		=>	array('.wpcf7 input[type=submit]'),
				'title'		=>	esc_html__('Submit Button Text Color', 'nexx'), 
				'desc'      	=>	esc_html__('Setup button text color on regular and hovered state.', 'nexx'),
				'regular'   	=>	true,	// Enable / Disable Regular Color
				'hover'     	=>	true,	// Enable / Disable Hover Color
				'active'    	=>	false,	// Enable / Disable Active Color
				'visited'   	=>	false,	// Enable / Disable Visited Color
				'default'   	=>	array(
					'regular'	=>	'#ffffff',
					'hover'		=>	'#ffffff',
				)
			),
	
		)
    ) );
	
	
	
	// BLOG SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'nxr_blog',
		'icon'		=> 'el-icon-screen',
		'title'		=>	esc_html__('Blog', 'nexx'),
        'fields'		=> array(
			array(
				'id'					=> 'blog_body_font',
				'type'				=> 'typography',
				'compiler'			=>	array('body.blog, body.single-post, body.search, body.archive'),
				'output'				=>	array('body.blog, body.single-post, body.search, body.archive'),
				'title'				=>	esc_html__('Body Font for blog', 'nexx'),
				'subtitle'			=>	esc_html__('Specify the body font properties.', 'nexx'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#666666',
					'font-size'		=>	'12px',
					'line-height'	=>	'28px',
					'font-family'	=>	'Roboto',
					'font-weight'	=>	'400',
				),
			),
			array(
				'id'					=> 'blog_h1_font',
				'type'				=> 'typography',
				'compiler'			=>	array('.blog h1, body.single-post h1, .archive h1'),
				'output'				=>	array('.blog h1, body.single-post h1'),
				'title'				=>	esc_html__('H1 Font', 'nexx'),
				'subtitle'			=>	esc_html__('Specify the H1 font properties.', 'nexx'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#000000',
					'font-size'		=>	'36px',
					'line-height'	=>	'50px',
					'font-family'	=>	'Roboto Slab',
					'font-weight'	=>	'400',
				),
			),
			array(
				'id'					=> 'blog_h2_font',
				'type'				=> 'typography',
				'compiler'			=>	array('.blog h2, body.single-post h2'),
				'output'				=>	array('.blog h2, body.single-post h2'),
				'title'				=>	esc_html__('H2 Font', 'nexx'),
				'subtitle'			=>	esc_html__('Specify the H2 font properties.', 'nexx'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#000000',
					'font-size'		=>	'14px',
					'line-height'	=>	'24px',
					'font-family'	=>	'Roboto Condensed',
					'font-weight'	=>	'400',
				),
			),
			array(
				'id'					=> 'blog_h3_font',
				'type'				=> 'typography',
				'compiler'			=>	array('.blog h3, body.single-post h3'),
				'output'				=>	array('.blog h3, body.single-post h3'),
				'title'				=>	esc_html__('H3 Font', 'nexx'),
				'subtitle'			=>	esc_html__('Specify the H3 font properties.', 'nexx'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#646464',
					'font-size'		=>	'22px',
					'line-height'	=>	'38px',
					'font-family'	=>	'Georgia, serif',
					'font-weight'	=>	'400',
				),
			),
			array(
				'id'					=> 'blog_h4_font',
				'type'				=> 'typography',
				'compiler'			=>	array('.blog h4, body.single-post h4'),
				'output'				=>	array('.blog h4, body.single-post h4'),
				'title'				=>	esc_html__('H4 Font', 'nexx'),
				'subtitle'			=>	esc_html__('Specify the H4 font properties.', 'nexx'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#000000',
					'font-size'		=>	'18px',
					'line-height'	=>	'30px',
					'font-family'	=>	'Roboto Slab',
					'font-weight'	=>	'400',
				),
			),
			array(
				'id'					=> 'blog_h5_font',
				'type'				=> 'typography',
				'compiler'			=>	array('.blog h5, body.single-post h5'),
				'output'				=>	array('.blog h5, body.single-post h5'),
				'title'				=>	esc_html__('H5 Font', 'nexx'),
				'subtitle'			=>	esc_html__('Specify the H5 font properties.', 'nexx'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#646464',
					'font-size'		=>	'46px',
					'line-height'	=>	'50px',
					'font-family'	=>	'Open Sans',
					'font-weight'	=>	'600',
				),
			),
			array(
				'id'					=> 'blog_h6_font',
				'type'				=> 'typography',
				'compiler'			=>	array('.blog h6, body.single-post h6'),
				'output'				=>	array('.blog h6, body.single-post h6'),
				'title'				=>	esc_html__('H6 Font', 'nexx'),
				'subtitle'			=>	esc_html__('Specify the H6 font properties.', 'nexx'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#646464',
					'font-size'		=>	'16px',
					'line-height'	=>	'24px',
					'font-family'	=>	'Source Sans Pro',
					'font-weight'	=>	'300',
				),
			),
			array(
				'id'        	=>	'blog_ahref_color',
				'type'      	=>	'link_color',
				'compiler'	=>	array('.blog a, .megamenu a'),
				'output'		=>	array('.blog a, .megamenu a'),
				'title'		=>	esc_html__('Links Color', 'nexx'), 
				'subtitle'	=>	esc_html__('Pick a color for links.', 'nexx'),
				'desc'      	=>	esc_html__('Setup links color on regular and hovered state.', 'nexx'),
				'regular'   	=>	true,	// Enable / Disable Regular Color
				'hover'     	=>	true,	// Enable / Disable Hover Color
				'active'    	=>	false,	// Enable / Disable Active Color
				'visited'   	=>	false,	// Enable / Disable Visited Color
				'default'   	=>	array(
					'regular'	=>	'#000000',
					'hover'		=>	'#dd9933',
				)
			),
			array(
				'id'			=> 'blog_bg_color',
				'type'		=> 'color',
				'title'		=>	esc_html__('Body Background Color', 'nexx'), 
				'subtitle'	=>	esc_html__('Pick a background color for blog.', 'nexx'),
				'default'	=> '#ffffff',
				'validate'	=> 'color',
			),
		)
    ) );
	
	// CUSTOM CODE SECTION
    Redux::setSection( $opt_name, array(
        'title'		=>	esc_html__('Custom Code', 'nexx'),
        'id'         => 'nxr_custom_code',
        'fields'     => array(
			array(
				'id'        => 'enable_css-code',
				'type'      => 'button_set',
				'title'     => esc_html__('Enable Custom CSS?', 'nexx'),
				'subtitle'  => esc_html__('Do you want to enable custom css?', 'nexx'),
				'options'   => array(
					'custom_css_on'		=> esc_html__('Enabled', 'nexx'), 
					'custom_css_off'	=> esc_html__('Disabled', 'nexx'), 
				), 
				'default'   => 'custom_css_off'
			),
			array(
				'id'        => 'css-code',
				'type'      => 'ace_editor',
				'title'     => esc_html__('CSS Code', 'nexx'),
				'subtitle'  => esc_html__('Paste your CSS code here.', 'nexx'),
				'mode'      => 'css',
				'theme'     => 'monokai',
				'default'   => "",
				'required'  => array('enable_css-code', '=', 'custom_css_on'),
			),
			array(
				'id'        => 'enable_js-code',
				'type'      => 'button_set',
				'title'     => esc_html__('Enable Custom JS?', 'nexx'),
				'subtitle'  => esc_html__('Do you want to enable custom js?', 'nexx'),
				'options'   => array(
					'custom_js_on'		=> esc_html__('Enabled', 'nexx'), 
					'custom_js_off'	=> esc_html__('Disabled', 'nexx'), 
				), 
				'default'   => 'custom_js_off'
			),
			array(
				'id'        => 'js-code',
				'type'      => 'ace_editor',
				'title'     => esc_html__('JS Code', 'nexx'),
				'subtitle'  => esc_html__('Paste your JS code here.', 'nexx'),
				'mode'      => 'javascript',
				'theme'     => 'chrome',
				'default'   => "jQuery(document).ready(function(){\n\n});",
				'required'  => array('enable_js-code', '=', 'custom_js_on'),
			),
		)
    ) );
	
	
	/*
     * <--- END SECTIONS
     */




    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'nexx' ),
                'desc'   => '<p class="description">'.esc_html__('This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.','nexx').'</p>',
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }
