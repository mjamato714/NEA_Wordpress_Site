<?php
/*
 * @package Nexx WordPress Theme by NexarThemes
 * @since version 1.0
 */
 
 // Add multilanguage support
load_theme_textdomain( 'nexx', get_template_directory() . '/nexarthemes/languages' );
 
 // Enqueue CSS and JS script to frontend header and footer
 if( !function_exists('nexx_enqueue') ) {
	function nexx_enqueue() {
		$nxr_options = get_option( 'redux_options' );
		
		// CSS
		wp_enqueue_style( 'nexx_icons', 					
			trailingslashit( get_template_directory_uri() ) . 'nexarthemes/css/icons.css', 
			'', 
			''
		);
		
		wp_enqueue_style( 'font-awesome', 			
			trailingslashit( get_template_directory_uri() ) . 'nexarthemes/css/font-awesome.min.css', 
			'', 
			''
		);
		wp_enqueue_style( 'nexx_css_component', 				
			trailingslashit( get_template_directory_uri() ) . 'nexarthemes/css/component.css', 
			'', 
			''
		);
		
		wp_enqueue_style( 'venobox', 				
			trailingslashit( get_template_directory_uri() ) . 'nexarthemes/css/venobox.css', 
			'', 
			''
		);		
		
		wp_enqueue_style( 'nexx_style', get_stylesheet_uri() );
		
				
		// JS		
		wp_enqueue_script( 'imagesloaded',			
			trailingslashit( get_template_directory_uri() ) . 'nexarthemes/js/imagesloaded.js', 
			array(), 
			'',
			true 
		);
		
		wp_enqueue_script( 'isotope' ); 					// registered and included from VC
		wp_enqueue_script( 'waypoints' ); 				// registered and included from VC
		
		wp_enqueue_script( 'nexx_modernizr_custom',		
			trailingslashit( get_template_directory_uri() ) . 'nexarthemes/js/modernizr.custom.js', 
			array(), 
			'',
			false 
		);
		
		wp_enqueue_script( 'html5shiv',		
			trailingslashit( get_template_directory_uri() ) . 'nexarthemes/js/html5shiv.js', 
			array(), 
			'',
			false 
		);
		
		wp_enqueue_script( 'respond',		
			trailingslashit( get_template_directory_uri() ) . 'nexarthemes/js/respond.min.js', 
			array(), 
			'',
			false 
		);
		
		wp_enqueue_script( 'venobox',				
			trailingslashit( get_template_directory_uri() ) . 'nexarthemes/js/venobox.min.js', 
			array(), 
			'',
			true 
		);
		
		wp_enqueue_script( 'nexx_colors',					
			trailingslashit( get_template_directory_uri() ) . 'nexarthemes/js/jquery.animate-colors-min.js', 
			array(), 
			'', 
			true 
		);
		
		wp_enqueue_script( 'nexx_velocity', 
			trailingslashit( get_template_directory_uri() ) . 'nexarthemes/js/velocity.min.js', 
			array(), 
			'', 
			true 
		); 
		
		wp_enqueue_script(	'jquery-cookie', 
			trailingslashit( get_template_directory_uri() ) . 'nexarthemes/js/jcookie.js', 
			array(), 
			'', 
			true 
		);
		
		if( is_array($nxr_options) && isset( $nxr_options['enable_smooth_scroll'] ) && esc_attr( $nxr_options['enable_smooth_scroll'] ) == 1 ) {
			wp_enqueue_script(	'nexx_smoothscroll', 
				trailingslashit( get_template_directory_uri() ) . 'nexarthemes/js/smoothscroll.js', 
				array(), 
				'', 
				true 
			);
		}
		
		wp_register_script(	'nexx_js', 
			trailingslashit( get_template_directory_uri() ) . 'nexarthemes/js/app.js', 
			array(), 
			'', 
			true 
		);
		
		
		// PHP variables to javascript
		$php_variables_array = array(
			'home_url' 					=> esc_url( home_url("/") ),
			'template_directory_uri'	=> esc_url( get_template_directory_uri() ),
			'retina_logo_url'			=> ( !empty( $nxr_options['retina_logo']['url'] ) ? esc_url( $nxr_options['retina_logo']['url'] ) : '' ),
			'menu_style'					=> ( !empty( $nxr_options['header_floating']) ? esc_attr( $nxr_options['header_floating'] ) : '' ),
			'is_front_page'				=> ( is_front_page() ? 'true' : 'false' ),
			'custom_js'					=> ( isset( $nxr_options['enable_js-code'] ) && $nxr_options['enable_js-code'] == 'custom_js_on' ? json_encode( $nxr_options['js-code'] ) : "''" )
		);
		
		wp_localize_script( 'nexx_js', 'php_variables', $php_variables_array );
		
		wp_enqueue_script( 'nexx_js' );
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		
		// Visual composer - move styles to head
		wp_enqueue_style( 'js_composer_front' );
		wp_enqueue_style( 'js_composer_custom_css' );

	}
 }
 add_action( 'wp_enqueue_scripts', 'nexx_enqueue' );
 
 
add_action( 'admin_enqueue_scripts', 'nexx_admin_enqueue' );
function nexx_admin_enqueue() {
 
    if( is_admin() ) { 
     
        // Add the color picker css file       
        wp_enqueue_style( 'wp-color-picker' ); 
         
        // Include our custom jQuery file with WordPress Color Picker dependency
        wp_enqueue_script( 'custom-script-handle', trailingslashit( get_template_directory_uri() ) . 'nexarthemes/js/backend.js', array( 'wp-color-picker' ), false, true ); 
    }
}
 
/*
* Add necessary body classes
*/
add_filter( 'body_class', 'nexx_add_bodyClass' );
function nexx_add_bodyClass( $classes ) {
	$detect = new Mobile_Detect;
    $classes[] = ( $detect->isMobile() ? ' isMobile ' : ' notMobile ' );
	$classes[] = ( $detect->isTablet() ? ' isTablet ' : ' isDesktop ');
    return $classes;
}
 

 // REQUIRED
 // Setup $content_width
 if ( ! isset( $content_width ) ) {$content_width = 1180;}
 
 
	
 // Custom pagination for posts
 if( !function_exists('nexx_pagination') ) {
	function nexx_pagination( $args = '' ) {
		$defaults = array(
			'before' => '<p id="post-pagination">' . esc_html__( 'Pages:', 'nexx' ), 
			'after' => '</p>',
			'text_before' => '',
			'text_after' => '',
			'next_or_number' => 'number', 
			'nextpagelink' => esc_html__( 'Next page', 'nexx' ),
			'previouspagelink' => esc_html__( 'Previous page', 'nexx' ),
			'pagelink' => '%',
			'echo' => 0
		);
	
		$r = wp_parse_args( $args, $defaults );
		$r = apply_filters( 'wp_link_pages_args', $r );
		extract( $r, EXTR_SKIP );
	
		global $page, $numpages, $multipage, $more, $pagenow;
	
		$output = '';
		if ( $multipage ) {
			if ( 'number' == $next_or_number ) {
				$output .= $before;
				for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
					$j = str_replace( '%', $i, $pagelink );
					$output .= ' ';
					if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) ) {
						$output .= '<li>';
						$output .= _wp_link_page( $i );
					}
					else {
						$output .= '<li class="active">';
						$output .= _wp_link_page( $i );
					}
	
					$output .= $j;
					if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) ) {
						$output .= '</a>';
						$output .= '</li>';
					}
					else {
						$output .= '</a>';
						$output .= '</li>';
					}
				}
				$output .= $after;
			} else {
				if ( $more ) {
					$output .= $before;
					$i = $page - 1;
					if ( $i && $more ) {
						$output .= _wp_link_page( $i );
						$output .= $text_before . $previouspagelink . $text_after . '</a>';
					}
					$i = $page + 1;
					if ( $i <= $numpages && $more ) {
						$output .= _wp_link_page( $i );
						$output .= $text_before . $nextpagelink . $text_after . '</a>';
					}
					$output .= $after;
				}
			}
		}
		if ( $echo )
			echo esc_html($output);
		return $output;
	}
 }
 
 
 // Include Mobile detect class
 require_once( trailingslashit( get_template_directory() ) . 'nexarthemes/Mobile_Detect.php' );
 
 
/*
*	Custom hooks
*/
function nexx_after_body_open(){ do_action( 'nexx_after_body_open' ); }
function nexx_before_footer_open(){ do_action( 'nexx_before_footer_open' ); }
 
// Include the TGM_Plugin_Activation class
require_once( trailingslashit( get_template_directory() ) . 'nexarthemes/plugins/class-tgm-plugin-activation.php' );
add_action( 'tgmpa_register', 'nexx_register_required_plugins' );


// Register the required / recommended plugins for theme
if( !function_exists('nexx_register_required_plugins') ) {
	 
	 function nexx_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// Visual Composer
 		array(
			'name'     				=> esc_html__( 'WPBakery Visual Composer', 'nexx' ), // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> trailingslashit( get_template_directory() ) . 'nexarthemes/plugins/js_composer.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			'is_callable'       		=> '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		// Revolution Slider
		array(
			'name'     				=> esc_html__( 'Revolution Slider', 'nexx'),
			'slug'     				=> 'revslider',
			'source'   				=> trailingslashit( get_template_directory() ) . 'nexarthemes/plugins/revslider.zip',
			'required' 				=> false,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
			'external_url' 			=> '',
			'is_callable'       		=> '',
		),
		// Essential Grid
		array(
			'name'     				=> esc_html__( 'Essential Grid', 'nexx'),
			'slug'     				=> 'essential-grid',
			'source'   				=> trailingslashit( get_template_directory() ) . 'nexarthemes/plugins/essential-grid.zip',
			'required' 				=> false,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
			'external_url' 			=> '',
			'is_callable'       		=> '',
		),
		// NexarThemes Extender for Visual Composer
		array(
			'name'     				=> esc_html__( 'NXR Extender for Visual Composer', 'nexx'),
			'slug'     				=> 'nxr_vc_extender',
			'source'   				=> trailingslashit( get_template_directory() ) . 'nexarthemes/plugins/nxr_vc_extender.zip',
			'required' 				=> false,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
			'external_url' 			=> '',
			'is_callable'       		=> '',
		),
		// NXR Custom Post Types
		array(
			'name'     				=> esc_html__( 'NXR Essentials', 'nexx'),
			'slug'     				=> 'nxr_essentials',
			'source'   				=> trailingslashit( get_template_directory() ) . 'nexarthemes/plugins/nxr_essentials.zip',
			'required' 				=> false,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
			'external_url' 			=> '',
			'is_callable'       		=> '',
		),
		// NXR MegaMenu
		array(
			'name'     				=> esc_html__( 'NXR MegaMenu', 'nexx'),
			'slug'     				=> 'nxr_megamenu',
			'source'   				=> trailingslashit( get_template_directory() ) . 'nexarthemes/plugins/nxr_megamenu.zip',
			'required' 				=> false,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
			'external_url' 			=> '',
			'is_callable'       		=> '',
		),
		// NXR MegaFooter
		array(
			'name'     				=> esc_html__( 'NXR MegaFooter', 'nexx'),
			'slug'     				=> 'nxr_megafooter',
			'source'   				=> trailingslashit( get_template_directory() ) . 'nexarthemes/plugins/nxr_megafooter.zip',
			'required' 				=> false,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
			'external_url' 			=> '',
			'is_callable'       		=> '',
		),
		
		// Contact Form 7
		array(
			'name' 		=> esc_html__( 'Contact Form 7', 'nexx'),
			'slug' 		=> 'contact-form-7',
			'required'	=> false,
		),
		
		// Widget Importer & Exporter
		array(
			'name' 		=> esc_html__( 'Widget Importer & Exporter', 'nexx'),
			'slug' 		=> 'widget-importer-exporter',
			'required'	=> false,
		),

		

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'nexx',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
	}
}
 


function nexx_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'nexx_add_editor_styles' );
 
 
 // Some basic setup after theme setup
 add_action( 'after_setup_theme', 'nexx_theme_setup' );
 function nexx_theme_setup(){
	// Add theme support for featured image, menus, etc
	if ( function_exists( 'add_theme_support' ) ) { 
			$nxr_defaults = array(
				'default-image'          => '',
				'random-default'         => false,
				'width'                  => 2560,
				'height'                 => 1440,
				'flex-height'            => true,
				'flex-width'             => true,
				'default-text-color'     => '#fff',
				'header-text'            => false,
				'uploads'                => true,
				'wp-head-callback'       => '',
				'admin-head-callback'    => '',
				'admin-preview-callback' => '',
			);
		add_theme_support( 'custom-header', $nxr_defaults );
		
		$args = array(
			'default-color'          => '',
			'default-image'          => '',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => ''
		);
		
		add_theme_support( "custom-background", $args );
		
		// Add theme support for featured image
		add_theme_support( 'post-thumbnails', array( 'post','nxr_portfolio','nxr_testimonials' ) );
		
		// Add theme support for feed links
		add_theme_support( 'automatic-feed-links' );
		
		add_theme_support( 'title-tag' );
		
	
		
		// Add theme support for menus
		if ( function_exists( 'register_nav_menus' ) ) {
			register_nav_menus(
				array(
				  'header-menu'	=> esc_html__( 'Main Menu (Also used for Right Menu)', 'nexx' ),
				  'left-menu'	=> esc_html__( 'Top Left Menu', 'nexx' ),
				  //'right-menu'	=> esc_html__( 'Top Right Menu', 'nexx' ),
				  'sidebar-menu'	=> esc_html__( 'SideBar Menu', 'nexx' ),
				)
			);
		}

	 }
	 
	// Disable Visual Composer front end editor
	if( function_exists('vc_disable_frontend') ) {
		vc_disable_frontend();
	}
	
	
	 function nexx_widgets_init() {
		if ( function_exists('register_sidebar') ) {
			register_sidebar(array(	'name'			=>	esc_html__( 'Blog', 'nexx'),
									'id'			=>	'blog-widgets',
									'description'	=>	esc_html__( 'Widgets in this area will be shown into the blog sidebar.', 'nexx'),
									'before_widget' =>	'<div class="col-md-12 blog_widget">',
									'after_widget'	=>	'</div>',
									'before_title'	=>	'<h4>',
									'after_title'	=>	'</h4>',
								)
						);
			register_sidebar(array(	'name'			=>	esc_html__( 'Pages Sidebar', 'nexx'),
									'id'			=>	'page-widgets',
									'description'	=>	esc_html__( 'Widgets in this area will be shown into the pages left or right sidebar.', 'nexx'),
									'before_widget' =>	'<div class="col-md-12 page_widget">',
									'after_widget'	=>	'</div>',
									'before_title'	=>	'<h4>',
									'after_title'	=>	'</h4>',
								)
						);
			register_sidebar(array(	'name'			=>	esc_html__( 'Shop Sidebar', 'nexx'),
									'id'			=>	'shop-widgets',
									'description'	=>	esc_html__( 'Widgets in this area will be shown into the shop left or right sidebar.', 'nexx'),
									'before_widget' =>	'<div class="col-md-12 shop_widget">',
									'after_widget'	=>	'</div>',
									'before_title'	=>	'<h4>',
									'after_title'	=>	'</h4>',
								)
						);
		}
	 }
	 add_action( 'widgets_init', 'nexx_widgets_init' );
	 
	 
	$nxr_options = get_option( 'redux_options' );
	if( $nxr_options && !is_array($nxr_options) ){
		delete_option('redux_options');
	}
 }
 
 
 // Some basic setup after theme change
add_action('after_switch_theme', 'nexx_theme_change');
function nexx_theme_change () {
	
	$nxr_options = get_option( 'redux_options' );
	if( $nxr_options && !is_array($nxr_options) ){
		delete_option('redux_options');
	}
	
	
	if ( class_exists( 'Redux' ) ) {
        
		$json_content = '{"last_tab":"","website_model":"website_full_width","enable_smooth_scroll":"0","enable_boxed_shadow":"0","website-background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"enable_full_screen_search":"1","enable_fssearch_onlu_for_products":"0","enable_top_info_bar":"0","top_info_btn_font":{"font-family":"Roboto","font-options":"","google":"1","font-backup":"","font-weight":"","font-style":"400","subsets":"","text-align":"center","text-transform":"","font-size":"14px","line-height":"14px","word-spacing":"","letter-spacing":""},"top_info_content_font":{"font-family":"Roboto","font-options":"","google":"1","font-backup":"","font-weight":"","font-style":"400","subsets":"","text-align":"left","font-size":"14px","line-height":"24px","word-spacing":"","letter-spacing":"","color":"#000"},"top_info_bar_padding":{"padding-top":"","padding-right":"","padding-bottom":"","padding-left":"","units":"px"},"body_border":"body_border_off","body_border_dimensions":{"width":"15px","units":"px"},"body_border_color":{"color":"#dd9933","alpha":"1.0","rgba":"rgba(221,153,51,1)"},"custom_error_page":"","back_to_top_button":"0","back_to_top_button_bg_color":{"color":"#dd9933","alpha":"1.0","rgba":"rgba(221,153,51,1)"},"back_to_top_button_dimensions":{"width":"30px","units":"px"},"mediaquery_screen_xs":"480","mediaquery_screen_s":"640","mediaquery_screen_m":"768","mediaquery_screen_l":"980","mediaquery_screen_xl":"1280","mediaquery_screen_xxl":"1280","container_xs":{"width":"300px","units":"px"},"container_s":{"width":"440px","units":"px"},"container_m":{"width":"600px","units":"px"},"container_l":{"width":"720px","units":"px"},"container_xl":{"width":"920px","units":"px"},"container_xxl":{"width":"1200px","units":"px"},"logo":{"url":"http://nexarthemes.com/nexx/business/wp-content/uploads/sites/15/2017/05/logo.png","id":"250","height":"60","width":"174","thumbnail":"http://nexarthemes.com/nexx/business/wp-content/uploads/sites/15/2017/05/logo.png"},"retina_logo":{"url":"http://nexarthemes.com/nexx/business/wp-content/uploads/sites/15/2017/05/logo@2x.png","id":"249","height":"120","width":"348","thumbnail":"http://nexarthemes.com/nexx/business/wp-content/uploads/sites/15/2017/05/logo@2x.png"},"favicon":{"url":"http://nexarthemes.com/nexx/business/wp-content/uploads/sites/15/2017/05/favicon.png","id":"248","height":"16","width":"16","thumbnail":"http://nexarthemes.com/nexx/business/wp-content/uploads/sites/15/2017/05/favicon.png"},"retina_favicon":{"url":"http://nexarthemes.com/nexx/business/wp-content/uploads/sites/15/2017/05/favicon@2x.png","id":"247","height":"32","width":"32","thumbnail":"http://nexarthemes.com/nexx/business/wp-content/uploads/sites/15/2017/05/favicon@2x.png"},"iphone_icon":{"url":"http://nexarthemes.com/nexx/business/wp-content/uploads/sites/15/2017/05/iphone-favicon.png","id":"246","height":"60","width":"60","thumbnail":"http://nexarthemes.com/nexx/business/wp-content/uploads/sites/15/2017/05/iphone-favicon.png"},"retina_iphone_icon":{"url":"http://nexarthemes.com/nexx/business/wp-content/uploads/sites/15/2017/05/iphone-favicon@2x.png","id":"245","height":"120","width":"120","thumbnail":"http://nexarthemes.com/nexx/business/wp-content/uploads/sites/15/2017/05/iphone-favicon@2x.png"},"ipad_icon":{"url":"http://nexarthemes.com/nexx/business/wp-content/uploads/sites/15/2017/05/ipad-favicon.png","id":"244","height":"76","width":"76","thumbnail":"http://nexarthemes.com/nexx/business/wp-content/uploads/sites/15/2017/05/ipad-favicon.png"},"ipad_retina_icon":{"url":"http://nexarthemes.com/nexx/business/wp-content/uploads/sites/15/2017/05/ipad-favicon@2x.png","id":"243","height":"152","width":"152","thumbnail":"http://nexarthemes.com/nexx/business/wp-content/uploads/sites/15/2017/05/ipad-favicon@2x.png"},"bg_color":"#666666","theme_dominant_color":"#d60274","ds_text_color":"#ffffff","h1_color":"#ffffff","h2_color":"#ffffff","h3_color":"#ffffff","h4_color":"#ffffff","h5_color":"#ffffff","h6_color":"#ffffff","ahref_color":{"regular":"#f9f9f9","hover":"#d60274"},"ls_text_color":"#9b9b9b","light_h1_color":"#333333","light_h2_color":"#2a2a2a","light_h3_color":"#2a2a2a","light_h4_color":"#2a2a2a","light_h5_color":"#333333","light_h6_color":"#848484","light_ahref_color":{"regular":"#333333","hover":"#d60274"},"body-font":{"font-family":"Poppins","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"16px","line-height":"24px","letter-spacing":""},"h1-font":{"font-family":"Poppins","font-options":"","google":"1","font-weight":"600","font-style":"","subsets":"latin","text-align":"","text-transform":"","font-size":"52px","line-height":"58px","letter-spacing":"-1px"},"h2-font":{"font-family":"Poppins","font-options":"","google":"1","font-weight":"700","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"34px","line-height":"42px","letter-spacing":""},"h3-font":{"font-family":"Poppins","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"latin","text-align":"","text-transform":"","font-size":"24px","line-height":"36px","letter-spacing":""},"h4-font":{"font-family":"Poppins","font-options":"","google":"1","font-weight":"","font-style":"","subsets":"latin","text-align":"","text-transform":"uppercase","font-size":"14px","line-height":"16px","letter-spacing":""},"h5-font":{"font-family":"Poppins","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"20px","line-height":"28px","letter-spacing":"-1px"},"h6-font":{"font-family":"Poppins","font-options":"","google":"1","font-weight":"300","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"12px","line-height":"18px","letter-spacing":""},"enable_page_title":"1","page_title_h1":{"font-family":"Poppins","font-options":"","google":"1","font-weight":"700","font-style":"","subsets":"latin","text-align":"center","text-transform":"","font-size":"40px","line-height":"52px","letter-spacing":"-1px","color":"#2a2a2a"},"page_title_padding":{"padding-top":"150px","padding-right":"0","padding-bottom":"150px","padding-left":"0","units":"px"},"menu_bar_width":"menu_full_width","menu-font":{"font-family":"Poppins","font-options":"","google":"1","font-weight":"500","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"14px","line-height":"60px","letter-spacing":""},"menu-font-hover-color":{"regular":"#333333","hover":"#d60274"},"identity_padding":{"padding-top":"5px","padding-right":"0","padding-bottom":"5px","padding-left":"30px","units":"px"},"top_menu_padding":{"padding-top":"5px","padding-right":"0","padding-bottom":"5px","padding-left":"0","units":"px"},"top_middle_bar_right_side_padding":{"padding-top":"","padding-right":"","padding-bottom":"","padding-left":"200px","units":"px"},"header_floating":"1","header_floating_display_after":{"height":"180px","units":"px"},"header_floating_hide_after":{"height":"200px","units":"px"},"header_shrink_after_scroll":{"height":"200px","units":"px"},"menu_bar_initial_height":{"height":"150px","units":"px"},"menu_bar_final_height":{"height":"100px","units":"px"},"header_transparent_display_after":{"height":"200px","units":"px"},"header_transp_bg_opacity_after_scroll":"1","header_background_type":"1","header_background_rgba":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"header_transparent_bg_rgba":{"color":"#ffffff","alpha":"1.0","rgba":"rgba(255,255,255,1)"},"header_background_image":{"background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"header_opacity_change_after_scroll":"1","header_background_opacity_change_after_amount":{"height":"200px","units":"px"},"header_background_opacity_after_scroll":"1.0","header_border":{"border-top":"","border-right":"","border-bottom":"","border-left":"","border-style":"solid","border-color":"#cecece"},"header_margins":{"margin-top":"0","margin-right":"0","margin-bottom":"0","margin-left":"0","units":"px"},"menu_bar_padding":{"padding-top":"0","padding-right":"30px","padding-bottom":"0","padding-left":"0","units":"px"},"page_top_offset":{"height":"-30px","units":"px"},"fixed_menu-font_top_bar":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"12px","line-height":"36px","letter-spacing":"","color":"#ffffff"},"fixed_menu-font-hover-color_top_bar":{"regular":"#2be2ff","hover":"#ffffff"},"top_bar_background_rgba":{"color":"#2a2a2a","alpha":"1","rgba":"rgba(42,42,42,1)"},"top_bar_left_column":"<li class=\"fa fa-map-marker\" style=\"font-size:14px\"></li> 51 Brandywine Drive, Ridgecrest, CA 93555. Locate us on the <a href=\"http://nexarthemes.com/cast/main-demo/contact/\">map</a>.","top_bar_padding":{"padding-top":"","padding-right":"","padding-bottom":"","padding-left":"","units":"px"},"fixed_menu-font_middle_bar":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"14px","line-height":"18px","letter-spacing":"","color":"#2a2a2a"},"fixed_menu-font-hover-color_middle_bar":{"regular":"#000000","hover":"#dd9933"},"middle_bar_background_rgba":{"color":"#ffffff","alpha":"1.0","rgba":"rgba(255,255,255,1)"},"middle_bar_first_column":"<p>+1-202-555-0170</br>\r\n<strong><li class=\"fa fa-phone\" style=\"font-size:14px\"></li> Toll Free Call</strong></p>","middle_bar_second_column":"<p>office@cast.com<br>\r\n<strong><li class=\"fa fa-envelope\" style=\"font-size:14px\"></li> Office Email</strong></p>","middle_bar_third_column":"<p>M - F: 10:00 - 18:00<br>\r\n<strong><li class=\"fa fa-clock-o\" style=\"font-size:14px\"></li> Office Hours</strong></p>","middle_bar_padding":{"padding-top":"15px","padding-right":"0","padding-bottom":"15px","padding-left":"0","units":"px"},"fixed_menu-font":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"500","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"14px","line-height":"60px","letter-spacing":""},"fixed_menu-font-hover-color":{"regular":"#2a2a2a","hover":"#ffffff"},"bottom_bar_background_rgba":{"color":"#2be2ff","alpha":"1","rgba":"rgba(43,226,255,1)"},"bottom_bar_padding":{"padding-top":"10px","padding-right":"0","padding-bottom":"10px","padding-left":"0","units":"px"},"mobile-menu-font":{"font-family":"Poppins","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"24px","line-height":"30px","letter-spacing":""},"mobile-menu-font-hover-color":{"regular":"#ffffff","hover":"#d60274"},"mobile_menu_background_rgba":{"color":"#000000","alpha":"0.9","rgba":"rgba(0,0,0,0.9)"},"footer-bgcolor":"#222222","footer_color_scheme":"dark_scheme","footer-copyright":"Copyright 2017 <p>NexarThemes</p>. All rights reserved.","cf_label_font":{"font-family":"Poppins","font-options":"","google":"1","font-weight":"700","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"12px","line-height":"30px","color":"#666666"},"cf_input_font":{"font-family":"Poppins","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"12px","line-height":"12px","color":"#8b8b8b"},"cf_input_field_bg":{"alpha":"1","rgba":"0,0,0"},"cf_input_field_roundness":{"padding-top":"5px","padding-right":"5px","padding-bottom":"5px","padding-left":"5px","units":"px"},"cf_input_padding":{"padding-top":"10px","padding-right":"10px","padding-bottom":"10px","padding-left":"10px","units":"px"},"cf_input_margin":{"margin-top":"0","margin-right":"0","margin-bottom":"16px","margin-left":"0","units":"px"},"cf_input_border":{"border-top":"2px","border-right":"2px","border-bottom":"2px","border-left":"2px","border-style":"solid","border-color":"#f2f2f2"},"cf_input_submit_height":{"height":"40px","units":"px"},"cf_input_submit_bg":{"color":"#d60274","alpha":"1","rgba":"rgba(214,2,116,1)"},"cf_input_submit_hover_bg":{"color":"#aa005c","alpha":"1","rgba":"rgba(170,0,92,1)"},"cf_input_submit_clr":{"regular":"#ffffff","hover":"#ffffff"},"woo_support":"1","products_per_row":"2","shop_body_font":{"font-family":"Roboto","font-options":"","google":"true","font-weight":"400","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"12px","line-height":"18px","color":"#9b9b9b"},"shop_h3_font":{"font-family":"Roboto","font-options":"","google":"true","font-weight":"500","font-style":"","subsets":"","text-align":"left","text-transform":"","font-size":"36px","line-height":"40px","color":"#2a2a2a"},"shop_price_font":{"font-family":"Roboto","font-options":"","google":"true","font-weight":"500","font-style":"","subsets":"","text-align":"left","text-transform":"","font-size":"14px","line-height":"18px","color":"#010101"},"shop_h1_font":{"font-family":"Roboto","font-options":"","google":"true","font-weight":"700","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"60px","line-height":"60px","color":"#2a2a2a"},"shop_single_price_font":{"font-family":"Roboto","font-options":"","google":"true","font-weight":"500","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"36px","line-height":"40px","color":"#d60274"},"shop_h4_font":{"font-family":"Roboto","font-options":"","google":"true","font-weight":"500","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"14px","line-height":"18px","color":"#2a2a2a"},"shop_ahref_color":{"regular":"#2a2a2a","hover":"#d60274"},"shop_bg_color":"#ffffff","shop_minicart_icon_color":"#2a2a2a","woo_bubble_color":{"regular":"#3f3f3f","hover":"#0a0a0a"},"shop_minicart_bubble_color":"#ffffff","qcv_bg_color":{"color":"#f9f8f6","alpha":"1.0","rgba":"rgba(249,248,246,1)"},"qcv_border":{"border-top":"2px","border-right":"2px","border-bottom":"2px","border-left":"2px","border-style":"solid","border-color":"#cecece"},"qcv_itemTitle":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"14px","line-height":"30px","color":"#000000"},"qcv_itemSubTotal":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"700","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"14px","line-height":"14px","color":"#000000"},"qcv_allSubTotal":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"700","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"14px","line-height":"30px","color":"#000000"},"qcv_gtc_btn_bg_color":{"regular":"#d8d8d8","hover":"#c4c4c4"},"qcv_chk_btn_bg_color":{"regular":"#d60274","hover":"#93015e"},"qcv_btns":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"700","font-style":"","subsets":"","text-align":"center","text-transform":"","font-size":"14px","line-height":"30px","color":"#ffffff"},"custom_empty_cart":"","blog_body_font":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"14px","line-height":"24px","color":"#9b9b9b"},"blog_h1_font":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"500","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"36px","line-height":"48px","color":"#2a2a2a"},"blog_h2_font":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"500","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"24px","line-height":"36px","color":"#2a2a2a"},"blog_h3_font":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"300","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"24px","line-height":"36px","color":"#2a2a2a"},"blog_h4_font":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"500","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"18px","line-height":"36px","color":"#2a2a2a"},"blog_h5_font":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"300","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"16px","line-height":"24px","color":"#2a2a2a"},"blog_h6_font":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"300","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"12px","line-height":"24px","color":"#2a2a2a"},"blog_ahref_color":{"regular":"#2a2a2a","hover":"#d60274"},"blog_bg_color":"#ffffff","enable_css-code":"custom_css_on","css-code":".image-hover {\r\n   -webkit-transition: all 0.3s ease-in-out;\r\n   -moz-transition: all 0.3s ease-in-out;\r\n   -o-transition: all 0.3s ease-in-out;\r\n   -ms-transition: all 0.3s ease-out;\r\n   transition: all 0.3s ease-in-out;\r\n   opacity:0.3;\r\n}\r\n.image-hover:hover {\r\n   opacity:1;\r\n}\r\n.image-color {\r\n       -webkit-transition: all 0.3s ease-in-out;\r\n   -moz-transition: all 0.3s ease-in-out;\r\n   -o-transition: all 0.3s ease-in-out;\r\n   -ms-transition: all 0.3s ease-out;\r\n   transition: all 0.3s ease-in-out;\r\n   opacity:1;\r\n}\r\n.image-color:hover {\r\n  opacity:0.5;\r\n}\r\n.vc_btn3 {\r\n    font-weight:500 !important;\r\n}\r\n.theme-default .nivoSlider {\r\n    box-shadow:none !important;\r\n}\r\n.nivo-controlNav{\r\n    display:none !important;\r\n}\r\n.wpcf7-submit {\r\n    margin-top: 25px!important;\r\n    width: 16%!important;\r\n    margin-right: 43%!important;\r\n    border-radius: 5px!important;\r\n    float:right!important;\r\n}\r\n.wpcf7 input[type=text], .wpcf7 input[type=email] {\r\n    width: 47%!important;\r\n    float:left;\r\n    margin-right:2%!important;\r\n      \r\n}\r\n.wpcf7-textarea{\r\n    width: 96%!important;\r\n    height: 100px;\r\n}\r\n.cd-primary-nav {\r\n    text-align: center!important;\r\n}","enable_js-code":"custom_js_off","js-code":"jQuery(document).ready(function(){\r\n\r\n});","redux-backup":1,"top_info_bar":"","top_info_bar_select":"","section_bk_to_top_btn":"","section_media_queries":"","section_containers":"","dark-scheme-info":"","light-scheme-info":"","section_page_title":"","section_menu_style":"","section_header_margins_paddings":"","section_header_style_one":"","section_complex_header_style":"","section_complex_header_style_top_bar":"","section_complex_header_style_middle_bar":"","section_complex_header_style_bottom_bar":"","footer_fallback":"","nxr_megafooter_select":"","redux_import_export":""}';
				
		update_option( 'redux_options', json_decode($json_content, true), '', 'yes' );
    }
}


add_action('switch_theme', 'nexx_theme_deactivated');
function nexx_theme_deactivated () {
  delete_option('redux_options');
}

	
 // Portfolio Metaboxes	
	function nexx_portfoliometaboxes() {
    	$screens = array( 'nxr_testimonials' );
    	foreach ( $screens as $screen ) {
       		add_meta_box(
           	'nxr_testimetaboxid',
            	esc_html__( 'Testimonial details', 'nexx' ),
            	'nexx_testi_custom_box',
            	$screen
        	);
    	}
	}
	add_action( 'add_meta_boxes', 'nexx_portfoliometaboxes' );
	function nexx_testi_custom_box($post) {
		// Add an nonce field so we can check for it later
		wp_nonce_field( 'nexx_testi_custom_box', 'nexx_testi_custom_box_nonce' );

		// Get metaboxes values from database
		$nxr_testi_author			=	esc_attr( get_post_meta( $post->ID, '_nxr_testi_author', true ) );
		$nxr_testi_role				=	esc_attr( get_post_meta( $post->ID, '_nxr_testi_role', true ) );
		
		// Construct the metaboxes and print out
		
		// Testimonial author name
		echo '<div class="settBlock"><label for="testi_author">';
		   esc_html_e( "Testimonial author", 'nexx' );
		echo '</label> ';
		echo '<input type="text" id="testi_author" name="testi_author" value="' . esc_attr( $nxr_testi_author ) . '" size="25" placeholder="' . esc_html__( "Jon Doe", "nexx" ) . '" /></div>';
	  
	  	// Testimonial author company and job
	  	echo '<div class="settBlock"><label for="testi_role">';
		   esc_html_e( "Company and Position", 'nexx' );
		echo '</label> ';
	  	echo '<input type="text" id="testi_role" name="testi_role" value="' . esc_attr( $nxr_testi_role ) . '" size="25" /></div>';
	}
	function nexx_save_testidata( $post_id ) {
		
		// Check the user's permissions.
		if ( isset($_POST['post_type']) && $_POST['post_type'] == 'nxr_testimonials' ) {
		
			if ( ! current_user_can( 'edit_post', $post_id ) || ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
			
			// Verify that the nonce is set and valid
			if ( !isset( $_POST['nexx_testi_custom_box_nonce'] ) && ! wp_verify_nonce( $_POST['nexx_testi_custom_box_nonce'] ) ) {
				return;
			}
	
			// If this is an autosave, our form has not been submitted, so we don't want to do anything
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}
			
			
			// OK to save data
			// Update the meta field in the database		
			if ( empty( $_POST['testi_author'] ) ) {
				if ( get_post_meta( $post_id, '_nxr_testi_author', true ) ) {
					delete_post_meta( $post_id, '_nxr_testi_author' );
				}
			} else {
				update_post_meta( $post_id, '_nxr_testi_author', sanitize_text_field( $_POST['testi_author'] ) );
			}
			
			if ( empty( $_POST['testi_role'] ) ) {
				if ( get_post_meta( $post_id, '_nxr_testi_role', true ) ) {
					delete_post_meta( $post_id, '_nxr_testi_role' );
				}
			} else {
				update_post_meta( $post_id, '_nxr_testi_role', sanitize_text_field( $_POST['testi_role'] ) );
			}
		}
	}
	add_action( 'save_post', 'nexx_save_testidata' );
	



/**
 * LESS PHP
 *
 * @link http://leafo.net/lessphp/
 */
 
 function nexx_do_less($debug = false){
	 
	 wp_enqueue_style(
		'nexx_custom-styles',
		get_template_directory_uri() . '/custom-styles.css'
	);
	
	require_once( trailingslashit( get_template_directory() ) . 'nexarthemes/lessc.inc.php' );
	$nxr_options = get_option( 'redux_options' );
	$less		=	new lessc;
	if($debug == false ) { $less->setFormatter("compressed"); };
	if($debug == true ) { $less->setPreserveComments(true); };
	$options		=	'';
	
	switch( esc_attr( $nxr_options['header_floating'] ) ){
		
		case '2': $bkaTopmenuPosition = "fixed";
		break;
		
		case '3': $bkaTopmenuPosition = "fixed";
		break;
		
		case '4': $bkaTopmenuPosition = "fixed";
		break;
		
		case '5': 
			$bkaTopmenuPosition =	"absolute";
		break;
		
		case '6': 
			$bkaTopmenuPosition =	"fixed";
		break;
		
		default: $bkaTopmenuPosition = "fixed";
		break;
	}
	
	// Theme dominant color
	$theme_dominant_color = ( isset($nxr_options['theme_dominant_color']) && !empty($nxr_options['theme_dominant_color']) ? esc_attr( $nxr_options['theme_dominant_color'] ) : '#999');
	
	// Fixed menu hover color
	$fixed_menu_hover_color = ( isset($nxr_options['fixed_menu-font-hover-color']['hover']) && !empty($nxr_options['fixed_menu-font-hover-color']['hover']) ? esc_attr( $nxr_options['fixed_menu-font-hover-color']['hover'] ) : '#999');
		
	
	//var_dump($nxr_options);
	$less->setVariables(array(
	  "mediaquery_screen_xs"	=>	esc_attr( $nxr_options['mediaquery_screen_xs'] ).'px',	// Default: 480
	  "mediaquery_screen_s"		=>	esc_attr( $nxr_options['mediaquery_screen_s'] ).'px', 	// Default: 640
	  "mediaquery_screen_m"		=>	esc_attr( $nxr_options['mediaquery_screen_m'] ).'px',	// Default: 768
	  "mediaquery_screen_l"		=>	esc_attr( $nxr_options['mediaquery_screen_l'] ).'px',	// Default: 980
	  "mediaquery_screen_xl"	=>	esc_attr( $nxr_options['mediaquery_screen_xl'] ).'px',	// Default: 1280
	  "mediaquery_screen_xxl"	=>	esc_attr( $nxr_options['mediaquery_screen_xxl'] ).'px',	// Default: 1280
	  
	  "container_xs"			=>	esc_attr( $nxr_options['container_xs']['width'] ),		// Default: 300
	  "container_s"				=>	esc_attr( $nxr_options['container_s']['width'] ),		// Default: 440
	  "container_m"				=>	esc_attr( $nxr_options['container_m']['width'] ), 		// Default: 600
	  "container_l"				=>	esc_attr( $nxr_options['container_l']['width'] ),		// Default: 720
	  "container_xl"			=>	esc_attr( $nxr_options['container_xl']['width'] ),		// Default: 920
	  "container_xxl"			=>	esc_attr( $nxr_options['container_xxl']['width'] ),		// Default: 1200
	  
	  "header_height"			=>	( isset($nxr_options['header_height']['height']) && !empty($nxr_options['header_height']['height']) ? esc_attr( $nxr_options['header_height']['height'] ) : '0'),
	  "header_top_padding"		=>	( isset($nxr_options['header_padding']['padding-top']) && !empty($nxr_options['header_padding']['padding-top']) ? esc_attr( $nxr_options['header_padding']['padding-top'] ) : '0'),
	  
	  // Only available for 4th case of header type: shrink after scroll
	  "menu_bar_initial_height"	=>	( isset($nxr_options['menu_bar_initial_height']['height']) && !empty($nxr_options['menu_bar_initial_height']['height']) ? esc_attr( $nxr_options['menu_bar_initial_height']['height'] ) : '80'),
	  "menu_bar_final_height"	=>	( isset($nxr_options['menu_bar_final_height']['height']) && !empty($nxr_options['menu_bar_final_height']['height']) ? esc_attr( $nxr_options['menu_bar_final_height']['height'] ) : '60'),
	  
	  // Contact Form 7
	  "cf_input_field_roundness"=>	( isset($nxr_options['cf_input_field_roundness']['padding-top']) && !empty($nxr_options['cf_input_field_roundness']['padding-top']) ? esc_attr( $nxr_options['cf_input_field_roundness']['padding-top'] ) : '0'),
	  
	  "bkaTopmenuPosition"		=>	$bkaTopmenuPosition,
	  
	  
	  "blog_ahref_color_regular"			=>	esc_attr( $nxr_options['blog_ahref_color']['regular'] ),
	  "blog_ahref_color_hover"				=>	esc_attr( $nxr_options['blog_ahref_color']['hover'] ),
	  
	  // Body border
	  "body_border_width"					=>	( isset($nxr_options['body_border_dimensions']['width']) && !empty($nxr_options['body_border_dimensions']['width']) ? esc_attr( $nxr_options['body_border_dimensions']['width'] ) : '0'),
	  
	  // back to top button
	  "back_to_top_button_width"			=>	( isset($nxr_options['back_to_top_button_dimensions']['width']) && !empty($nxr_options['back_to_top_button_dimensions']['width']) ? esc_attr( $nxr_options['back_to_top_button_dimensions']['width'] ) : '30px'),
	  
	));
	
	
	
	
	$options .="
	.clearfix() {
	  &:before,
	  &:after {
		content: \" \";
		display: table;
	  }
	  &:after {
		clear: both;
	  }
	}
	
	#website_boxed{
		margin: auto;
		overflow: hidden;
		width:100vw;
		max-width:100%;
	}
	@media screen and (max-width: 800px) {
		#wpadminbar {
		    position: fixed;
		}
	}
	#nxr_top_navbar_container {
		position: @bkaTopmenuPosition;
	}
	
	/*#main_navbar_container ul.dropdown-menu,
	#main_navbar_container_left ul.dropdown-menu {
		top:60px!important;
	}*/
	
	.noPaddingTopBottom{
		padding-top:0!important;
		padding-bottom:0!important;
	}
	
	#nxr_top_navbar_container .container{
		-webkit-transition: all .5s;
		-moz-transition: all .5s;
		-ms-transition: all .5s;
		-o-transition: all .5s;
		transition: all .5s;
	}
	
	img.responsiveLogo{
		max-width:100%;
		max-height:100%;
		vertical-align:unset!important;
	}
	.nxr_identity a{
		max-width:100%;
		max-height:100%;
	}
	
	
	a.underline.after.first:after {
	  border-bottom: 2px solid ".$theme_dominant_color.";
	}
	
	.loader {
	  font-size: 5px;
	  margin: auto;
	  text-indent: -9999em;
	  width: 11em;
	  height: 11em;
	  border-radius: 50%;
	  background: ".$theme_dominant_color.";
	  background: -moz-linear-gradient(left, ".$theme_dominant_color." 10%, rgba(255, 255, 255, 0) 42%);
	  background: -webkit-linear-gradient(left, ".$theme_dominant_color." 10%, rgba(255, 255, 255, 0) 42%);
	  background: -o-linear-gradient(left, ".$theme_dominant_color." 10%, rgba(255, 255, 255, 0) 42%);
	  background: -ms-linear-gradient(left, ".$theme_dominant_color." 10%, rgba(255, 255, 255, 0) 42%);
	  background: linear-gradient(to right, ".$theme_dominant_color." 10%, rgba(255, 255, 255, 0) 42%);
	  position: relative;
	  -webkit-animation: load3 1.4s infinite linear;
	  animation: load3 1.4s infinite linear;
	  -webkit-transform: translateZ(0);
	  -ms-transform: translateZ(0);
	  transform: translateZ(0);
	}
	.loader:before {
	  width: 50%;
	  height: 50%;
	  background: ".$theme_dominant_color.";
	  border-radius: 100% 0 0 0;
	  position: absolute;
	  top: 0;
	  left: 0;
	  content: '';
	}
	
	
	
	
	a.link-curtain::before {
		border-top: 2px solid rgba(".Redux_Helpers::hex2rgba($theme_dominant_color)." , 0.3);
	}
	a.link-curtain::after {
		background: rgba(".Redux_Helpers::hex2rgba($theme_dominant_color)." , 0.1);
	}
	
	#nxr_top_navbar_container .dropdown-menu li a:hover{
		background-color: rgba(".Redux_Helpers::hex2rgba($theme_dominant_color)." , 0.10);
	}
	
	#fixed_navbar .dropdown-menu li a:hover{
		background-color: rgba(".Redux_Helpers::hex2rgba($fixed_menu_hover_color)." , 0.15);
	}
	
	#nxr_top_navbar_container .dropdown-menu {
		border-top: 2px solid ".$theme_dominant_color." !important;
	}
	
	#fixed_navbar .dropdown-menu {
		border-top: 2px solid ".$fixed_menu_hover_color." !important;
	}
	
	/* Left and Right Page Sidebar */
	.page-template-page-leftsidebar .vc_col-sm-3 ul li,
	.page-template-page-rightsidebar .vc_col-sm-3 ul li,
	.page-template-page-leftsidebar .vc_col-sm-3 ul.children li,
	.page-template-page-rightsidebar .vc_col-sm-3 ul.children li,
	.shop_widget ul li {
		border-left: solid 6px rgba(".Redux_Helpers::hex2rgba($theme_dominant_color)." , 0.3);
		
	}
	
	.page-template-page-leftsidebar .vc_col-sm-3  ul li:hover,
	.page-template-page-rightsidebar .vc_col-sm-3 ul li:hover,
	.shop_widget ul li:hover {
		border-left: solid 6px ".$theme_dominant_color.";
		background-color: rgba(".Redux_Helpers::hex2rgba($theme_dominant_color)." , 0.05);
	}
	
	.page-template-page-leftsidebar #wp-calendar caption,
	.page-template-page-rightsidebar #wp-calendar caption {
		color: ".$theme_dominant_color.";
	}
	
	.page-template-page-leftsidebar #wp-calendar thead, 
	.page-template-page-rightsidebar #wp-calendar thead {
		background: rgba(".Redux_Helpers::hex2rgba($theme_dominant_color)." , 0.05);
	}
	.page-template-page-leftsidebar #wp-calendar tbody td:hover,
	.page-template-page-rightsidebar #wp-calendar tbody td:hover {
		background: rgba(".Redux_Helpers::hex2rgba($theme_dominant_color)." , 0.08);
	}
	
	
	.price_slider_wrapper .ui-slider-horizontal {
		background-color: rgba(".Redux_Helpers::hex2rgba($theme_dominant_color)." , 0.2);
	}
	.price_slider_wrapper .ui-slider .ui-slider-range,
	.price_slider_wrapper .ui-slider .ui-slider-handle {
		background: rgba(".Redux_Helpers::hex2rgba($theme_dominant_color)." , 1);
	}
	
	
	
	.wpcf7 input[type=text], 
	.wpcf7 input[type=email], 
	.wpcf7 textarea, 
	.wpcf7 input[type=submit] {
		border-radius: @cf_input_field_roundness;
	}
	
	
	/* BLOG COMMENTS BTN */
	#comments-form input[type=submit], #commentform input[type=submit] {
		background-color: @blog_ahref_color_regular;
	}
	#comments-form input[type=submit]:hover, #commentform input[type=submit]:hover {
		background-color: @blog_ahref_color_hover;
	}
	
	".( isset($nxr_options['body_border']) && $nxr_options['body_border'] == 'body_border_on' ? 
	"
	#nxr_left, #nxr_right {width: @body_border_width;} 
	#nxr_top, #nxr_bottom {height: @body_border_width;}
	body {margin-top: @body_border_width !important;}
	.bka_footer{margin-bottom: @body_border_width !important;}
	"
	: '')."
	
	
	".( isset($nxr_options['back_to_top_button']) && $nxr_options['back_to_top_button'] == '1' ? 
	"
	.back-to-top {
		width:@back_to_top_button_width;
		height:@back_to_top_button_width;
		line-height:@back_to_top_button_width;
	}
	"
	: '')."
	
	

	
	/*==========  START MEDIA QUERIES  ==========*/
	
	/* 
		Extra Small Screen
		Over:		0
		Under:		mediaquery_screen_xs
		Default:	480px
		Container:	container_xs
		Media:		(max-width: 480px)
	*/
	@media (max-width: @mediaquery_screen_xs - 1) {
		
		.fixed_menu,
		.main_navbar_container{
			display:none;
		}
		.container, #container{
			max-width: @container_xs;
			.clearfix;
			.horizontal_padding;
		}
		.megamenu {width:@container_xs;}
		
		.standAlonePage .page_title_container .container {
			margin-top: 60px;
		}
		
		
		// Desktop nav hidden on small screens
		#main_navbar_container,
		#main_navbar_container_left {
			display:none;
		}
		
		// Identity float left for small screns
		.central_logo .nxr_identity{
			float:left;
			margin:0;
			text-align:left;
		}
		
		
		#website_boxed{
			.clearfix;
		}
		".( isset($nxr_options['website_model']) && $nxr_options['website_model'] === 'website_boxed' ? 
		' #masthead, #website_boxed, #nxr_top_navbar_container {width: @container_xs!important;} ' : ' #website_boxed{width: 100vw;max-width:100%;} ')."
		".( isset($nxr_options['enable_boxed_shadow']) && $nxr_options['enable_boxed_shadow'] == '1' ? 
		' #website_boxed  {-webkit-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);-moz-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);} ' : '')."
		
		

		
		#fssearch_container #searchform input[type=text] {
			font-size: 50px!important;
			height: 100px !important;
		}
		
		/* MAILCHIP COLLECTOR */
		#nxr_mc_name, #nxr_mc_lastname, #nxr_mc_email, .nxr_mc_btn{
			width: 100%!important;
			margin-bottom:10px!important;
		}
		
		#comments .depth-2, #comments .depth-3, #comments .depth-4, #comments .depth-5, #comments .depth-6, #comments .depth-7, #comments .depth-8, #comments .depth-9, #comments .depth-10 {
			margin-left: 0;
		}
		
		
		
		
	}
	
	
	
	/* 
		Small Screen
		Over:		mediaquery_screen_xs
		Under:		mediaquery_screen_s
		Default:	640px
		Container:	container_s
		Media:		(min-width: 481px) and (max-width: 640px)
	*/
	@media (min-width: @mediaquery_screen_xs ) and (max-width: @mediaquery_screen_s - 1) {
		
		.fixed_menu,
		.main_navbar_container{
			display:none;
		}
		
		.container, #container{
			max-width: @container_s;
			.clearfix;
			.horizontal_padding;
		}
		.megamenu {width:@container_s;}
	
		#website_boxed{
			.clearfix;
		}
		
		
		// Desktop nav hidden on small screens
		#main_navbar_container,
		#main_navbar_container_left {
			display:none;
		}
		
		// Identity float left for small screns
		.central_logo .nxr_identity{
			float:left;
			margin:0;
			text-align:left;
		}
		
		".( isset($nxr_options['website_model']) && $nxr_options['website_model'] === 'website_boxed' ? 
		' #masthead, #website_boxed, #nxr_top_navbar_container {width: @container_s!important;} ' : ' #website_boxed{width: 100vw;max-width:100%;} ')."
		
		".( isset($nxr_options['enable_boxed_shadow']) && $nxr_options['enable_boxed_shadow'] == '1' ? 
		' #website_boxed  {-webkit-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);-moz-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);} ' : '')."
		
		
		#fssearch_container #searchform input[type=text] {
			font-size: 50px!important;
			height: 100px !important;
		}
		
		/* MAILCHIP COLLECTOR */
		#nxr_mc_name, #nxr_mc_lastname, #nxr_mc_email, .nxr_mc_btn{
			width: 100%!important;
			margin-bottom:10px!important;
		}
		
		#comments .depth-2, #comments .depth-3, #comments .depth-4, #comments .depth-5, #comments .depth-6, #comments .depth-7, #comments .depth-8, #comments .depth-9, #comments .depth-10 {
			margin-left: 0;
		}
		
		
	}
	
	
		
	/* 
		Medium Screen
		Over:		mediaquery_screen_s
		Under:		mediaquery_screen_m
		Default:	768px
		Container:	container_m
		Media:		(min-width: 641px) and (max-width: 768px)
	*/
	@media (min-width: @mediaquery_screen_s) and (max-width: @mediaquery_screen_m - 1) {
		.fixed_menu,
		.main_navbar_container{
			display:none;
		}
		
		.container, #container{
			max-width: @container_m;
			.clearfix;
			.horizontal_padding;
		}
		.megamenu {width:@container_m;}
		#website_boxed{
			.clearfix;
		}
		
		
		// Desktop nav hidden on small screens
		#main_navbar_container,
		#main_navbar_container_left,
		.fixed_menu {
			display:none;
		}
		
		// Identity float left for small screns
		.central_logo .nxr_identity{
			float:left;
			margin:0;
			text-align:left;
		}
	
		".( isset($nxr_options['website_model']) && $nxr_options['website_model'] === 'website_boxed' ? 
		' #masthead, #website_boxed, #nxr_top_navbar_container {width: @container_m!important;} ' : ' #website_boxed{width: 100vw;max-width:100%;} ')."
		
		".( isset($nxr_options['enable_boxed_shadow']) && $nxr_options['enable_boxed_shadow'] == '1' ? 
		' #website_boxed  {-webkit-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);-moz-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);} ' : '')."
		
		.initialHeaderSize{
			height: @menu_bar_initial_height;
		}
		.finalHeaderSize{
			height: @menu_bar_final_height!important;
		}
		
		#fssearch_container #searchform input[type=text] {
			font-size: 50px!important;
			height: 100px !important;
		}
		
		#comments .depth-2, #comments .depth-3, #comments .depth-4, #comments .depth-5, #comments .depth-6, #comments .depth-7, #comments .depth-8, #comments .depth-9, #comments .depth-10 {
			margin-left: 0;
		}
		
		
		
			
	}
	
	
	
	/* 
		Large Screen
		Over:		mediaquery_screen_m
		Under:		mediaquery_screen_l
		Default:	980px
		Container:	container_l
		Media:		(min-width: 769px) and (max-width: 980px)
	*/
	@media (min-width: @mediaquery_screen_m) and (max-width: @mediaquery_screen_l - 1) {
		
		.fixed_menu,
		.main_navbar_container{
			/*display:none;*/
		}
		
		.standAlonePage .page_title_container .container {
			margin-top: 60px;
		}
		
		.container, #container{
			max-width: @container_l;
		}
		.megamenu {
			width:@container_l;
		}
		ul.primary_menu{
			margin-top:@header_height;
		}
		
		
		// Desktop nav hidden on small screens
		#main_navbar_container,
		#main_navbar_container_left,
		.fixed_menu {
			display:none;
		}
		
		// Identity float left for small screns
		.central_logo .nxr_identity{
			float:left;
			margin:0;
			text-align:left;
		}
		
		
		".( isset($nxr_options['website_model']) && $nxr_options['website_model'] === 'website_boxed' ? 
		' #masthead, #website_boxed, #nxr_top_navbar_container {width: @container_l!important;} ' : ' #website_boxed{width: 100vw;max-width:100%;} ')."
		".( isset($nxr_options['enable_boxed_shadow']) && $nxr_options['enable_boxed_shadow'] == '1' ? 
		' #website_boxed  {-webkit-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);-moz-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);} ' : '')."
		
		.initialHeaderSize{
			height: @menu_bar_initial_height;
		}
		.finalHeaderSize{
			height: @menu_bar_final_height!important;
		}
		
		".( isset($nxr_options['header_floating']) && $nxr_options['header_floating'] === '6' ? ' 
		
		/*#nxr_top_navbar_container {
			-moz-transform: translateY(-100%);
			-o-transform: translateY(-100%);
			-ms-transform: translateY(-100%);
			-webkit-transform: translateY(-100%);
			transform: translateY(-100%);
		} */
		
		' : '' ) . "
		
		/*#nxr_top_navbar_container.headerappear{
			-moz-transform: translateY(0);
			-o-transform: translateY(0);
			-ms-transform: translateY(0);
			-webkit-transform: translateY(0);
			transform: translateY(0);
			-webkit-transition: transform .33s ease-in-out;
			-moz-transition: transform .33s ease-in-out;
			transition: transform .33s ease-in-out;	
		}
		#nxr_top_navbar_container.headerhidden{
			-moz-transform: translateY(-100%);
			-o-transform: translateY(-100%);
			-ms-transform: translateY(-100%);
			-webkit-transform: translateY(-100%);
			transform: translateY(-100%);
			-webkit-transition: transform .33s ease-in-out;
			-moz-transition: transform .33s ease-in-out;
			transition: transform .33s ease-in-out;	
		}*/
		
		
		
	}	
	
	
	
	/* 
		Extra Large Screen
		Over:		mediaquery_screen_l
		Under:		mediaquery_screen_xl
		Default:	1280px
		Container:	container_xl
		Media:		(min-width: 981px) and (max-width: 1280px)
	*/
	@media (min-width: @mediaquery_screen_l) and (max-width: @mediaquery_screen_xl - 1)  {
		
		.container, #container{
			max-width: @container_xl;
		}
		.megamenu {width:@container_xl;}
		ul.primary_menu{
			line-height:@header_height;
		}
		ul.sub-menu{
			line-height:24px;
			top:@header_height - @header_top_padding - 1;
		}
		
		
		// Desktop nav hidden on small screens
		#main_navbar_container,
		#main_navbar_container_left,
		.fixed_menu {
			display:none;
		}
		
		// Identity float left for small screns
		.central_logo .nxr_identity{
			float:left;
			margin:0;
			text-align:left;
		}
		
		
		".( isset($nxr_options['website_model']) && $nxr_options['website_model'] === 'website_boxed' ? 
		' #masthead, #website_boxed, #nxr_top_navbar_container {width: @container_xl!important;} ' : ' #website_boxed{width: 100vw;max-width:100%;} ')."
		".( isset($nxr_options['enable_boxed_shadow']) && $nxr_options['enable_boxed_shadow'] == '1' ? 
		' #website_boxed  {-webkit-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);-moz-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);} ' : '')."
		
		.initialHeaderSize{
			height: @menu_bar_initial_height;
		}
		.finalHeaderSize{
			height: @menu_bar_final_height!important;
		}
		
		".( isset($nxr_options['header_floating']) && $nxr_options['header_floating'] === '6' ? ' 
		
		
		
		' : '' ) . "
		
		/*.isDesktop.notMobile #nxr_top_navbar_container.headerappear{
			-moz-transform: translateY(0);
			-o-transform: translateY(0);
			-ms-transform: translateY(0);
			-webkit-transform: translateY(0);
			transform: translateY(0);
			-webkit-transition: transform .33s ease-in-out;
			-moz-transition: transform .33s ease-in-out;
			transition: transform .33s ease-in-out;	
		}
		.isDesktop.notMobile #nxr_top_navbar_container.headerhidden{
			-moz-transform: translateY(-100%);
			-o-transform: translateY(-100%);
			-ms-transform: translateY(-100%);
			-webkit-transform: translateY(-100%);
			transform: translateY(-100%);
			-webkit-transition: transform .33s ease-in-out;
			-moz-transition: transform .33s ease-in-out;
			transition: transform .33s ease-in-out;	
		}*/
		
		
		
	}
	
	
	
	/* 
		XXL Screen
		Over:		mediaquery_screen_xl
		Under:		none
		Default:	over 1280px
		Container:	container_xxl
		Media:		min-width: 1281px
	*/
	@media (min-width: @mediaquery_screen_xl) {
		.container, #container{
			max-width: @container_xxl;
		}
		
		// Mobile parts hidden on large screens
		.cd-primary-nav-trigger,
		#mainNavUl {
			display:none;
		}
		
		.megamenu {width:@container_xxl;}
	
		ul.primary_menu{
			line-height:@header_height;
		}
		ul.sub-menu{
			line-height:24px;
			top:@header_height - @header_top_padding - 1;
		}
	
		".( isset($nxr_options['website_model']) && $nxr_options['website_model'] === 'website_boxed' ? 
		' #masthead, #website_boxed, #nxr_top_navbar_container {width: @container_xxl!important;} ' : ' #website_boxed{width: 100vw;max-width:100%;} ')."
		".( isset($nxr_options['enable_boxed_shadow']) && $nxr_options['enable_boxed_shadow'] == '1' ? 
		' #website_boxed  {-webkit-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);-moz-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);} ' : '')."
		
		
		.initialHeaderSize{
			height: @menu_bar_initial_height;
		}
		.finalHeaderSize{
			height: @menu_bar_final_height!important;
		}
		
		".( isset($nxr_options['header_floating']) && $nxr_options['header_floating'] === '6' ? ' 
		
		.isDesktop.notMobile #nxr_top_navbar_container {
			-moz-transform: translateY(-100%);
			-o-transform: translateY(-100%);
			-ms-transform: translateY(-100%);
			-webkit-transform: translateY(-100%);
			transform: translateY(-100%);
		} 
		
		' : '' ) . "
		
		.isDesktop.notMobile #nxr_top_navbar_container.headerappear{
			-moz-transform: translateY(0);
			-o-transform: translateY(0);
			-ms-transform: translateY(0);
			-webkit-transform: translateY(0);
			transform: translateY(0);
			-webkit-transition: transform .33s ease-in-out;
			-moz-transition: transform .33s ease-in-out;
			transition: transform .33s ease-in-out;	
		}
		.isDesktop.notMobile #nxr_top_navbar_container.headerhidden{
			-moz-transform: translateY(-100%);
			-o-transform: translateY(-100%);
			-ms-transform: translateY(-100%);
			-webkit-transform: translateY(-100%);
			transform: translateY(-100%);
			-webkit-transition: transform .33s ease-in-out;
			-moz-transition: transform .33s ease-in-out;
			transition: transform .33s ease-in-out;	
		}
		
		
		
	}
	
	";
	
	wp_add_inline_style( 'nexx_custom-styles', esc_html($less->compile($options)) );
 }
 add_action( 'wp_enqueue_scripts', 'nexx_do_less' );
 


// WooCommerce
// Change number or products per row to a custom number
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		$nxr_options = get_option( 'redux_options' );
		return ( isset($nxr_options['products_per_row']) ? $nxr_options['products_per_row'] : 3 ); // defaults to 3 products per row
	}
}


/*
*	Force Visual Composer to initialize as "built into the theme". 
*	This will hide certain tabs under the Settings->Visual Composer page
*/
	if(function_exists('vc_set_as_theme')){
	add_action( 'vc_before_init', 'nxr_vcSetAsTheme' );
	function nxr_vcSetAsTheme() {
    	vc_set_as_theme();
	}
 }

	


/*
* Do the custom page layout
*/
function nexx_get_layout( $page_type = 'page' ){
	$nxr_options = get_option( 'redux_options' );
	
	// Blog Specific
	if( isset($nxr_options['blog_layout']) && $page_type == 'blog') {
		require_once( trailingslashit( get_template_directory() ) . 'layouts/' . $page_type . '/' . esc_attr( $nxr_options['blog_layout'] ) . '.php' );
	}
	elseif( isset($nxr_options['content_layout']) ) {
		require_once( trailingslashit( get_template_directory() ) . 'layouts/' . $page_type . '/' . esc_attr( $nxr_options['content_layout'] ) . '.php' );
	} else {
		require_once( trailingslashit( get_template_directory() ) . 'layouts/' . $page_type . '/nosidebar.php' );
	}
}



/**
*	Header function  
*/
function nexx_do_header() {
	$nxr_options = get_option( 'redux_options' );
	
	$header_type = esc_attr( $nxr_options['header_floating'] );
	/*
		$header_type values:
		1 - Fixed - DEFAULT
		2 - Apear after scrolling down
		3 - Dissapear after scrolling down
		4 - Shrink after scrolling down
		5 - Transparent, scrolls with page and then falls down after scrolling
		6 - Complex. Fixed menu and another appear after scroll menu
	*/
	$output = '';
	
	$original_header_type = $header_type;
	
	$specialHeader = false;
	if( is_single() ) {
		$specialHeader = true;
	}
	elseif( is_category() ) {
		$specialHeader = true;
	}
	elseif( is_author() ) {
		$specialHeader = true;
	}
	elseif( is_archive() ) {
		$specialHeader = true;
	}
	elseif( is_home() ){
		$specialHeader = true;
	}
	
	if( class_exists( 'WooCommerce' ) ) {
		if( is_shop() ) {
			$specialHeader = false;
		}
		if( is_product() ) {
			$specialHeader = true;
		}
		elseif( is_product_category() ) {
			$specialHeader = false;
		}
		elseif( is_cart() ) {
			$specialHeader = true;
		}
	}
	
	
	
	// If on mobile, header is always fixed.
	// If other page than home, header is always fixed
	$detect = new Mobile_Detect;
	
	
	/*if( $detect->isMobile() || !is_front_page() ){
		$header_type = '1';
	}*/
	
	if( $detect->isMobile() ){
		$header_type = '1';
	}
	
	if( !$detect->isMobile() && $original_header_type == 6 ) {
		$header_type = $original_header_type;
	}
	
	
	
	switch($header_type){
		case '2': // Apear after scrolling down
			$scroll_amount = esc_attr( ( isset($nxr_options['header_floating_display_after']['height']) && 
									$nxr_options['header_floating_display_after']['height'] != 'px' ? 
									$nxr_options['header_floating_display_after']['height']*1 : '$(window).height()') );
			
			$output = 'jQuery(document).ready(function($) {
					"use strict";
					
					$("#nxr_top_navbar_extras .nxr_woo_minicart, #nxr_top_navbar_extras, #nxr_top_navbar_extras a").height($( "#nxr_top_navbar_container").outerHeight(true) );
					$(".fixed_menu_bottom_bar .nxr_woo_minicart").height($( ".fixed_menu_bottom_bar").outerHeight(true) );
					$("#nxr_top_navbar_extras a").css( "line-height", $("#nxr_top_navbar_container").outerHeight() + "px" );
					
					if($(window).height() < $("body").prop("scrollHeight")) {
					
						$("#nxr_top_navbar_container").removeClass("displayed").addClass("hidden");
						$(window).bind("scroll", function() {
								if ($(window).scrollTop() > '.$scroll_amount.') {
									$("#nxr_top_navbar_container").slideDown(200);
									$("#nxr_top_navbar_container").removeClass("hidden").addClass("displayed");
									
									$("#nxr_top_navbar_extras .nxr_woo_minicart, #nxr_top_navbar_extras, #nxr_top_navbar_extras a").height($( "#nxr_top_navbar_container").outerHeight(true) );
									$("#nxr_top_navbar_extras a").css( "line-height", $("#nxr_top_navbar_container").outerHeight() + "px" );
								}
								if ($(window).scrollTop() < '.$scroll_amount.') {
									$("#nxr_top_navbar_container").slideUp(200, function() {
										$("#nxr_top_navbar_container").removeClass("displayed").addClass("hidden");
									});
								}
							});
					}
				});';
		break;
		
		case '3': // DISAPPEAR AFTER SCROLL - LEFT LOGO
			$scroll_amount = esc_attr( ( isset($nxr_options['header_floating_hide_after']['height']) && 
									$nxr_options['header_floating_hide_after']['height'] != 'px' ? 
									$nxr_options['header_floating_hide_after']['height']*1 : '$(window).height()') );
			
			if( isset(	$nxr_options['header_opacity_change_after_scroll']) && 
									$nxr_options['header_opacity_change_after_scroll'] == 1) {
							$scroll_amount_change_color = ( isset (
								$nxr_options['header_background_opacity_change_after_amount']['height']) && 
								$nxr_options['header_background_opacity_change_after_amount']['height'] != 'px' ? 
								esc_attr( $nxr_options['header_background_opacity_change_after_amount']['height'] * 1 ) : '$(window).height()');
													
							$initialOpacity		=	$nxr_options['header_background_rgba']['alpha'];
							$afterScrollOpacity =	$nxr_options['header_background_opacity_after_scroll'];
			}
			
			$output = 'jQuery(document).ready(function($) {
						"use strict";
						var header_height = $("#nxr_top_navbar_container").outerHeight(true);
						var lastScrollTop = 0;						
						$("#nxr_top_navbar_extras .nxr_woo_minicart, #nxr_top_navbar_extras, #nxr_top_navbar_extras a").height($( "#nxr_top_navbar_container").outerHeight(true) );
						$(".fixed_menu_bottom_bar .nxr_woo_minicart").height($( ".fixed_menu_bottom_bar").outerHeight(true) );
						$("#nxr_top_navbar_extras a").css( "line-height", $("#nxr_top_navbar_container").outerHeight() + "px" );';
						
						// If header opacity is 1 we scroll down page with the height of header
							if( $initialOpacity == 1 ) {
								$output .='$(".header_spacer").height( $("#nxr_top_navbar_container").outerHeight() );';
							}
						
				$output .= '$(window).scroll(function(event){
						   var st = $(this).scrollTop();
						   if (st > lastScrollTop){
							   // downscroll code
							   if ($(window).scrollTop() > '.$scroll_amount.') {
									$("#nxr_top_navbar_container").slideUp(200, function() {
										$("#nxr_top_navbar_container").removeClass("displayed").addClass("hidden");
									});
								}
						   } else {
							  // upscroll code
							  $("#nxr_top_navbar_container").slideDown(200);
							  $("#nxr_top_navbar_container").removeClass("hidden").addClass("displayed");
						   }
						   lastScrollTop = st;
						});
					});';
		break;
		
		case '4': // SHRINK AFTER SCROLL - LEFT LOGO
			$scroll_amount = ( isset($nxr_options['header_shrink_after_scroll']['height']) && 
									$nxr_options['header_shrink_after_scroll']['height'] != 'px' ? 
									$nxr_options['header_shrink_after_scroll']['height']*1 : '$(window).height()');
			
			$menu_bar_initial_height	=	( isset($nxr_options['menu_bar_initial_height']['height']) && !empty($nxr_options['menu_bar_initial_height']['height']) ? $nxr_options['menu_bar_initial_height']['height'] : '80');
	  		$menu_bar_final_height		=	( isset($nxr_options['menu_bar_final_height']['height']) && !empty($nxr_options['menu_bar_final_height']['height']) ? $nxr_options['menu_bar_final_height']['height'] : '60');
			
			$initialHeaderHalfHeight	=	str_replace("px","",$menu_bar_initial_height) / 2;
			$finalHeaderHalfHeight		=	str_replace("px","",$menu_bar_final_height) / 2;
			
			$responsiveLogoMaxHeight	=	$menu_bar_initial_height - ($initialHeaderHalfHeight / 2);
			
			// Header Opacity Settings
			if( isset(	$nxr_options['header_opacity_change_after_scroll']) && 
									$nxr_options['header_opacity_change_after_scroll'] == 1) {
							$scroll_amount_change_color = ( isset (
								$nxr_options['header_background_opacity_change_after_amount']['height']) && 
								$nxr_options['header_background_opacity_change_after_amount']['height'] != 'px' ? 
								$nxr_options['header_background_opacity_change_after_amount']['height']*1 : '$(window).height()');
													
							$initialOpacity		=	$nxr_options['header_background_rgba']['alpha'];
							$afterScrollOpacity =	$nxr_options['header_background_opacity_after_scroll'];
			}
			
			$output = 'jQuery(document).ready(function($) {
						"use strict";
						var header_height = $("#nxr_top_navbar_container").outerHeight(true);
						var lastScrollTop = 0;
						
						var calculatedInitialHeight = ('.str_replace("px","",$menu_bar_initial_height).' * 0.8 );
						var calculatedFinalHeight = ('.str_replace("px","",$menu_bar_final_height).' * 0.8 );
						
						var calculatedInitialMargins = ('.str_replace("px","",$menu_bar_initial_height).' * 0.1 );
						var calculatedFinalMargins = ('.str_replace("px","",$menu_bar_final_height).' * 0.1 );
						
						var initialNavBarMargin		=	( calculatedInitialHeight - $("#main_navbar").outerHeight() ) / 2 ;
						var finalNavBarMargin		=	( calculatedFinalHeight - $("#main_navbar").outerHeight() ) / 2 ;
						
						// Set the initial and maxim header bar height
						$("#nxr_top_navbar_container").height("'.$menu_bar_initial_height.'").css("max-height", "'.$menu_bar_initial_height.'");
						
						// Set initial header bar container  and logo height
						$("#nxr_top_navbar_container .container, .nxr_identity a").height( calculatedInitialHeight );
						
						// Minicart height setting
						$("#nxr_top_navbar_extras .nxr_woo_minicart").height( calculatedInitialHeight ).css("line-height", calculatedInitialHeight + "px");
						//$(".fixed_menu_bottom_bar .nxr_woo_minicart").height( "'.$menu_bar_initial_height.'" );
						
						// Apply initial margins on container
						$("#nxr_top_navbar_container .container").css("margin-top", calculatedInitialMargins ).css("margin-bottom", calculatedInitialMargins );
						
						// Remove top-bottom paddings foe logo and navbar
						$("#nxr_top_navbar_container .nxr_identity, #nxr_top_navbar_container #main_navbar_container").addClass("noPaddingTopBottom");
						
						// Add initial navbar paddings
						$("#main_navbar").css("margin-top", initialNavBarMargin ).css("margin-bottom", initialNavBarMargin );
						
						$("#nxr_top_navbar_extras, #nxr_top_navbar_extras a").height( calculatedInitialHeight );
						$("#nxr_top_navbar_extras a").css( "line-height", calculatedInitialHeight + "px" );';
						
						// If header opacity is 1 we scroll down page with the height of header
						if( $initialOpacity == 1 ) {
							$output .='$(".header_spacer").height( $("#nxr_top_navbar_container").outerHeight() );';
						}
						
						
						
						$output .= '$(window).scroll(function(event){
						   var st = $(this).scrollTop();
						   if (st > lastScrollTop){
							   // downscroll code
							   if ($(window).scrollTop() > '.$scroll_amount.') {									
									// Set the final header bar height
									$("#nxr_top_navbar_container").height("'.$menu_bar_final_height.'").css("max-height", "'.$menu_bar_final_height.'");
									
									// Set initial header bar container  and logo height
									$("#nxr_top_navbar_container .container, .nxr_identity a").height( calculatedFinalHeight );
									
									// Apply final margins on container
									$("#nxr_top_navbar_container .container").css("margin-top", calculatedFinalMargins ).css("margin-bottom", calculatedFinalMargins );
									
									// Add final navbar paddings
									$("#main_navbar").css("margin-top", finalNavBarMargin ).css("margin-bottom", finalNavBarMargin );
									
									// Minicart height setting
									$("#nxr_top_navbar_extras .nxr_woo_minicart").height( calculatedFinalHeight ).css("line-height", calculatedFinalHeight + "px");
									
									// Extras div settings
									$("#nxr_top_navbar_extras, #nxr_top_navbar_extras a").height( calculatedFinalHeight );
									$("#nxr_top_navbar_extras a").css( "line-height", calculatedFinalHeight + "px" );
								}
						   } else if ($(window).scrollTop() < '.$scroll_amount.') {
							  // upscroll code
							  	// Set the initial and maxim header bar height
								$("#nxr_top_navbar_container").height("'.$menu_bar_initial_height.'").css("max-height", "'.$menu_bar_initial_height.'");
								
								// Set initial header bar container  and logo height
								$("#nxr_top_navbar_container .container, .nxr_identity a").height( calculatedInitialHeight );
								
								// Apply initial margins on container
								$("#nxr_top_navbar_container .container").css("margin-top", calculatedInitialMargins ).css("margin-bottom", calculatedInitialMargins );
								
								// Add initial navbar paddings
								$("#main_navbar").css("margin-top", initialNavBarMargin ).css("margin-bottom", initialNavBarMargin );
								
								// Minicart height setting
								$("#nxr_top_navbar_extras .nxr_woo_minicart").height( calculatedInitialHeight ).css("line-height", calculatedInitialHeight + "px");
								
								// Extras div settings
								$("#nxr_top_navbar_extras, #nxr_top_navbar_extras a").height( calculatedInitialHeight );
								$("#nxr_top_navbar_extras a").css( "line-height", calculatedInitialHeight + "px" );
						   }
						   lastScrollTop = st;
						});
					});';
		break;
		
		case '5': // Transparent, scrolls with page and then falls down after scrolling
		
			$scroll_amount = ( isset($nxr_options['header_transparent_display_after']['height']) && 
									$nxr_options['header_transparent_display_after']['height'] != 'px' ? 
									$nxr_options['header_transparent_display_after']['height']*1 : '$(window).height()');
			
			$afterScrollOpacity =	$nxr_options['header_transp_bg_opacity_after_scroll'];
			
			//$header_size_before_scroll = $nxr_options['header_size_before_scroll']['height'];
			$header_top_padding_after_scroll = ( isset($nxr_options['menu_bar_padding_end']['margin-top']) ? $nxr_options['menu_bar_padding_end']['margin-top'] : '0');
			
			$output = 'jQuery(document).ready(function($) {
					"use strict";
					var header_height = $("#nxr_top_navbar_container").outerHeight(true);
					var hasBeenTrigged = false;
					
					$("#nxr_top_navbar_extras .nxr_woo_minicart, #nxr_top_navbar_extras, #nxr_top_navbar_extras a").height($( "#nxr_top_navbar_container").outerHeight(true) );
					$(".fixed_menu_bottom_bar .nxr_woo_minicart").height($( ".fixed_menu_bottom_bar").outerHeight(true) );
					$("#nxr_top_navbar_extras a").css( "line-height", $("#nxr_top_navbar_container").outerHeight() + "px" );';
					
					if( !$specialHeader ) {
						$output .= '$("#nxr_top_navbar_container").css("background-color","rgba('.Redux_Helpers::hex2rgba($nxr_options['header_background_rgba']['color']).' , 0)");';
					}
					
			$output .= '
					function doTheStickyHeader() {
						// Do we have the admin bar on?
							var adminBarHeight = ( $("body").hasClass("admin-bar") ) ? "32px" : 0;
						
						// Window scroll position Y
							var winYval = $(window).scrollTop();
						
						// Do the tricks
						if ( winYval > '.$scroll_amount.'  && !hasBeenTrigged ) {
							$("#nxr_top_navbar_container").css("top",-header_height);
							$("#nxr_top_navbar_container").addClass("stickyHeader").css("background-color","rgba('.Redux_Helpers::hex2rgba($nxr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')").animate({
								"top": adminBarHeight
							},300);
							hasBeenTrigged = true;
							
						}
						if( winYval < '.$scroll_amount.' && $("#nxr_top_navbar_container").hasClass("stickyHeader")  && hasBeenTrigged ){
							$("#nxr_top_navbar_container").animate({"top": -header_height}, 300, function() {
								$("#nxr_top_navbar_container").css("top",adminBarHeight).removeClass("stickyHeader").css("display","block").css("background-color","rgba('.Redux_Helpers::hex2rgba($nxr_options['header_background_rgba']['color']).' , 0)");
							  });
							hasBeenTrigged = false;
						}
						
					}';
					if( !$specialHeader ) {
						$output .='$(window).scroll(function(){
										// Do the sticky header
										doTheStickyHeader();
									});';
					}
					
				$output .='});';
		break;
		
		
		case '6': // Complex: Fixed one + another one apear after scrolling down
			$scroll_amount = ( isset($nxr_options['header_floating_display_after']['height']) && 
									$nxr_options['header_floating_display_after']['height'] != 'px' ? 
									$nxr_options['header_floating_display_after']['height']*1 : '$(window).height()');
			
			$output = 'jQuery(document).ready(function($) {
					"use strict";
					$("#nxr_top_navbar_extras .nxr_woo_minicart, #nxr_top_navbar_extras, #nxr_top_navbar_extras a").height($( "#nxr_top_navbar_container").height() );
					$(".fixed_menu_bottom_bar .nxr_woo_minicart").height($( ".fixed_menu_bottom_bar").outerHeight(true) );
					$(".fixed_menu_bottom_bar .woo_bubble").css("top", -$( ".fixed_menu_bottom_bar").outerHeight(true) / 2);
					
					$("#nxr_top_navbar_extras a").css( "line-height", $("#nxr_top_navbar_container").outerHeight() + "px" );

					if($(window).height() < $("body").prop("scrollHeight")) {
						//$("#nxr_top_navbar_container").css("display","block").css("transform", "translateY(-100%)");
					}
							
					$(window).bind("scroll", function() {
							if ($(window).scrollTop() > '.$scroll_amount.') {
								$("#nxr_top_navbar_container").removeClass("headerhidden").addClass("headerappear");
							}
							if ($(window).scrollTop() < '.$scroll_amount.') {
								$("#nxr_top_navbar_container").removeClass("headerappear").addClass("headerhidden");
							}
						});
					
				});';
		break;
		
		case '7': // FIXED HEADER CENTRAL LOGO
			$output = ' jQuery(document).ready(function($) {
						"use strict";
						var hasBeenTrigged = false;
						var header_height = $("#nxr_top_navbar_container").outerHeight(true);
						$("#nxr_top_navbar_extras .nxr_woo_minicart, #nxr_top_navbar_extras, #nxr_top_navbar_extras a").height( $("#nxr_top_navbar_container").outerHeight() );
						$("#nxr_top_navbar_extras a").css( "line-height", $("#nxr_top_navbar_container").outerHeight() + "px" );
						//$(".fixed_menu_bottom_bar .nxr_woo_minicart").height($( ".fixed_menu_bottom_bar").outerHeight(true) );
						';
						
						
						if( $original_header_type != 1 && $header_type == 1 ) {
							$output .= '$("#nxr_top_navbar_container").addClass("finalHeaderSize").css("position", "fixed").css("display", "block");';
						}
						
	
						if( isset(	$nxr_options['header_opacity_change_after_scroll']) && 
									$nxr_options['header_opacity_change_after_scroll'] == 1) {
							$scroll_amount_change_color = ( isset (
								$nxr_options['header_background_opacity_change_after_amount']['height']) && 
								$nxr_options['header_background_opacity_change_after_amount']['height'] != 'px' ? 
								$nxr_options['header_background_opacity_change_after_amount']['height']*1 : '$(window).height()');
													
							$initialOpacity		=	$nxr_options['header_background_rgba']['alpha'];
							$afterScrollOpacity =	$nxr_options['header_background_opacity_after_scroll'];
							
												
							$output .= '$("#nxr_top_navbar_container .dropdown-menu").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($nxr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);
										if ($(window).scrollTop() > '.$scroll_amount_change_color.' ) {
										$("#nxr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($nxr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);
										
										}';
							
							// If header opacity is 1 we scroll down page with the height of header
							if( $initialOpacity == 1 ) {
								$output .='$(".header_spacer").height( $("#nxr_top_navbar_container").outerHeight() );';
							} else {
								// daca opacitatea este alta decat 1
								// modificam alpha initial al headerului
								$output .='$("#nxr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($nxr_options['header_background_rgba']['color']).' , '.$initialOpacity.')"}, 1);';
							}
							
							
							if( $original_header_type != 1 && $header_type == 1 || !is_front_page() ) {
								
								if( $detect->isMobile() ) {
									// If not FIXED by settings, and mobile, fixed and with background
									$output .= '$("#nxr_top_navbar_container").removeClass("finalHeaderSize").css("position", "fixed").css("padding-top", "0px").css("padding-bottom", "0px").css("padding-left", "20px").css("padding-right", "20px");';
									$output .= '$("#nxr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($nxr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);';
								} else {
									$output .= '$("#nxr_top_navbar_container").addClass("finalHeaderSize").css("position", "fixed");';
									$output .= '$("#nxr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($nxr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);';
								}
							} 
							// If mobile, fixed and with background
							else if( $detect->isMobile() ) {
								
								//$output .= '$("#nxr_top_navbar_container").addClass("finalHeaderSize").css("position", "fixed");';
								$output .= '$("#nxr_top_navbar_container").removeClass("finalHeaderSize").css("position", "fixed").css("padding-top", "0px").css("padding-bottom", "0px").css("padding-top", "0px").css("padding-bottom", "0px").css("padding-left", "20px").css("padding-right", "20px");';
								$output .= '$("#nxr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($nxr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);';
							}
							else {
								$output .= '$(window).bind("scroll", function() {
									
									if ($(window).scrollTop() > '.$scroll_amount_change_color.' && !hasBeenTrigged ) {
										$("#nxr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($nxr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);
										hasBeenTrigged = true;
										
									}
									if ($(window).scrollTop() < '.$scroll_amount_change_color.' && hasBeenTrigged ) {
										$("#nxr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($nxr_options['header_background_rgba']['color']).' , '.$initialOpacity.')"}, 500);
										hasBeenTrigged = false;
										
									}
								});';
							}
								
					
						}
			
			$output .=' });';
		break;
		
		
		case '8': // APPEAR AFTER SCROLL - CENTRAL LOGO
			$scroll_amount = ( isset($nxr_options['header_floating_display_after']['height']) && 
									$nxr_options['header_floating_display_after']['height'] != 'px' ? 
									$nxr_options['header_floating_display_after']['height']*1 : '$(window).height()');
			
			$output = 'jQuery(document).ready(function($) {
					"use strict";
					
					$("#nxr_top_navbar_extras .nxr_woo_minicart, #nxr_top_navbar_extras, #nxr_top_navbar_extras a").height($( "#nxr_top_navbar_container").outerHeight(true) );
					$(".fixed_menu_bottom_bar .nxr_woo_minicart").height($( ".fixed_menu_bottom_bar").outerHeight(true) );
					$("#nxr_top_navbar_extras a").css( "line-height", $("#nxr_top_navbar_container").outerHeight() + "px" );
					
					if($(window).height() < $("body").prop("scrollHeight")) {
					
						$("#nxr_top_navbar_container").removeClass("displayed").addClass("hidden");
						$(window).bind("scroll", function() {
								if ($(window).scrollTop() > '.$scroll_amount.') {
									$("#nxr_top_navbar_container").slideDown(200);
									$("#nxr_top_navbar_container").removeClass("hidden").addClass("displayed");
									
									$("#nxr_top_navbar_extras .nxr_woo_minicart, #nxr_top_navbar_extras, #nxr_top_navbar_extras a").height($( "#nxr_top_navbar_container").outerHeight(true) );
									$("#nxr_top_navbar_extras a").css( "line-height", $("#nxr_top_navbar_container").outerHeight() + "px" );
								}
								if ($(window).scrollTop() < '.$scroll_amount.') {
									$("#nxr_top_navbar_container").slideUp(200, function() {
										$("#nxr_top_navbar_container").removeClass("displayed").addClass("hidden");
									});
								}
							});
					}
				});';
		break;
		
		case '9': // DISAPPEAR AFTER SCROLL - CENTRAL LOGO
			$scroll_amount = ( isset($nxr_options['header_floating_hide_after']['height']) && 
									$nxr_options['header_floating_hide_after']['height'] != 'px' ? 
									$nxr_options['header_floating_hide_after']['height']*1 : '$(window).height()');
									
			if( isset(	$nxr_options['header_opacity_change_after_scroll']) && 
									$nxr_options['header_opacity_change_after_scroll'] == 1) {
							$scroll_amount_change_color = ( isset (
								$nxr_options['header_background_opacity_change_after_amount']['height']) && 
								$nxr_options['header_background_opacity_change_after_amount']['height'] != 'px' ? 
								$nxr_options['header_background_opacity_change_after_amount']['height']*1 : '$(window).height()');
													
							$initialOpacity		=	$nxr_options['header_background_rgba']['alpha'];
							$afterScrollOpacity =	$nxr_options['header_background_opacity_after_scroll'];
			}
			
			$output = 'jQuery(document).ready(function($) {
						"use strict";
						var header_height = $("#nxr_top_navbar_container").outerHeight(true);
						var lastScrollTop = 0;						
						$("#nxr_top_navbar_extras .nxr_woo_minicart, #nxr_top_navbar_extras, #nxr_top_navbar_extras a").height($( "#nxr_top_navbar_container").outerHeight(true) );
						$(".fixed_menu_bottom_bar .nxr_woo_minicart").height($( ".fixed_menu_bottom_bar").outerHeight(true) );
						$("#nxr_top_navbar_extras a").css( "line-height", $("#nxr_top_navbar_container").outerHeight() + "px" );';
						
						// If header opacity is 1 we scroll down page with the height of header
						if( $initialOpacity == 1 ) {
							$output .='$(".header_spacer").height( $("#nxr_top_navbar_container").outerHeight() );';
						}
						
				$output .= '$(window).scroll(function(event){
						   var st = $(this).scrollTop();
						   if (st > lastScrollTop){
							   // downscroll code
							   if ($(window).scrollTop() > '.$scroll_amount.') {
									$("#nxr_top_navbar_container").slideUp(200, function() {
										$("#nxr_top_navbar_container").removeClass("displayed").addClass("hidden");
									});
								}
						   } else {
							  // upscroll code
							  $("#nxr_top_navbar_container").slideDown(200);
							  $("#nxr_top_navbar_container").removeClass("hidden").addClass("displayed");
						   }
						   lastScrollTop = st;
						});
					});';
		break;
		
		case '10': // SHRINK AFTER SCROLL - CENTRAL LOGO
			$scroll_amount = ( isset($nxr_options['header_shrink_after_scroll']['height']) && 
									$nxr_options['header_shrink_after_scroll']['height'] != 'px' ? 
									$nxr_options['header_shrink_after_scroll']['height']*1 : '$(window).height()');
			
			$menu_bar_initial_height	=	( isset($nxr_options['menu_bar_initial_height']['height']) && !empty($nxr_options['menu_bar_initial_height']['height']) ? $nxr_options['menu_bar_initial_height']['height'] : '80');
	  		$menu_bar_final_height		=	( isset($nxr_options['menu_bar_final_height']['height']) && !empty($nxr_options['menu_bar_final_height']['height']) ? $nxr_options['menu_bar_final_height']['height'] : '60');
			
			$initialHeaderHalfHeight	=	str_replace("px","",$menu_bar_initial_height) / 2;
			$finalHeaderHalfHeight		=	str_replace("px","",$menu_bar_final_height) / 2;
			
			$responsiveLogoMaxHeight	=	$menu_bar_initial_height - ($initialHeaderHalfHeight / 2);
			
			if( isset(	$nxr_options['header_opacity_change_after_scroll']) && 
									$nxr_options['header_opacity_change_after_scroll'] == 1) {
							$scroll_amount_change_color = ( isset (
								$nxr_options['header_background_opacity_change_after_amount']['height']) && 
								$nxr_options['header_background_opacity_change_after_amount']['height'] != 'px' ? 
								$nxr_options['header_background_opacity_change_after_amount']['height']*1 : '$(window).height()');
													
							$initialOpacity		=	$nxr_options['header_background_rgba']['alpha'];
							$afterScrollOpacity =	$nxr_options['header_background_opacity_after_scroll'];
			}
			
			$output = 'jQuery(document).ready(function($) {
						"use strict";
						var header_height = $("#nxr_top_navbar_container").outerHeight(true);
						var lastScrollTop = 0;
						
						var calculatedInitialHeight = ('.str_replace("px","",$menu_bar_initial_height).' * 0.8 );
						var calculatedFinalHeight = ('.str_replace("px","",$menu_bar_final_height).' * 0.8 );
						
						var calculatedInitialMargins = ('.str_replace("px","",$menu_bar_initial_height).' * 0.1 );
						var calculatedFinalMargins = ('.str_replace("px","",$menu_bar_final_height).' * 0.1 );
						
						var initialNavBarMargin		=	( calculatedInitialHeight - $("#main_navbar").outerHeight() ) / 2 ;
						var finalNavBarMargin		=	( calculatedFinalHeight - $("#main_navbar").outerHeight() ) / 2 ;
						
						// Set the initial and maxim header bar height
						$("#nxr_top_navbar_container").height("'.$menu_bar_initial_height.'").css("max-height", "'.$menu_bar_initial_height.'");
						
						// Set initial header bar container  and logo height
						$("#nxr_top_navbar_container .container, .nxr_identity a").height( calculatedInitialHeight );
						
						// Minicart height setting
						//$("#nxr_top_navbar_extras .nxr_woo_minicart").height( calculatedInitialHeight ).css("line-height", calculatedInitialHeight + "px");
						//$(".fixed_menu_bottom_bar .nxr_woo_minicart").height( "'.$menu_bar_initial_height.'" );
						
						// Apply initial margins on container
						$("#nxr_top_navbar_container .container").css("margin-top", calculatedInitialMargins ).css("margin-bottom", calculatedInitialMargins );
						
						// Remove top-bottom paddings for logo and navbar
						$("#nxr_top_navbar_container .nxr_identity, #nxr_top_navbar_container #main_navbar_container, #nxr_top_navbar_container #main_navbar_container_left").addClass("noPaddingTopBottom");
						
						// Add initial navbar paddings
						$("#main_navbar, #main_navbar_left").css("margin-top", initialNavBarMargin ).css("margin-bottom", initialNavBarMargin );
						
						$("#nxr_top_navbar_extras, #nxr_top_navbar_extras a").height( calculatedInitialHeight );
						$("#nxr_top_navbar_extras a").css( "line-height", calculatedInitialHeight + "px" );';
					
					// If header opacity is 1 we scroll down page with the height of header
					if( $initialOpacity == 1 ) {
						$output .='$(".header_spacer").height( $("#nxr_top_navbar_container").outerHeight() );';
					}
					
						
						
					$output .= '$(window).scroll(function(event){
						   var st = $(this).scrollTop();
						   if (st > lastScrollTop){
							   // downscroll code
							   if ($(window).scrollTop() > '.$scroll_amount.') {									
									// Set the final header bar height
									$("#nxr_top_navbar_container").height("'.$menu_bar_final_height.'").css("max-height", "'.$menu_bar_final_height.'");
									
									// Set initial header bar container  and logo height
									$("#nxr_top_navbar_container .container, .nxr_identity a").height( calculatedFinalHeight );
									
									// Apply final margins on container
									$("#nxr_top_navbar_container .container").css("margin-top", calculatedFinalMargins ).css("margin-bottom", calculatedFinalMargins );
									
									// Add final navbar paddings
									$("#main_navbar, #main_navbar_left").css("margin-top", finalNavBarMargin ).css("margin-bottom", finalNavBarMargin );
									
									// Minicart height setting
									$("#nxr_top_navbar_extras .nxr_woo_minicart").height( calculatedFinalHeight ).css("line-height", calculatedFinalHeight + "px");
									
									// Extras div settings
									$("#nxr_top_navbar_extras, #nxr_top_navbar_extras a").height( calculatedFinalHeight );
									$("#nxr_top_navbar_extras a").css( "line-height", calculatedFinalHeight + "px" );
								}
						   } else if ($(window).scrollTop() < '.$scroll_amount.') {
							  // upscroll code
							  	// Set the initial and maxim header bar height
								$("#nxr_top_navbar_container").height("'.$menu_bar_initial_height.'").css("max-height", "'.$menu_bar_initial_height.'");
								
								// Set initial header bar container  and logo height
								$("#nxr_top_navbar_container .container, .nxr_identity a").height( calculatedInitialHeight );
								
								// Apply initial margins on container
								$("#nxr_top_navbar_container .container").css("margin-top", calculatedInitialMargins ).css("margin-bottom", calculatedInitialMargins );
								
								// Add initial navbar paddings
								$("#main_navbar, #main_navbar_left").css("margin-top", initialNavBarMargin ).css("margin-bottom", initialNavBarMargin );
								
								// Minicart height setting
								$("#nxr_top_navbar_extras .nxr_woo_minicart").height( calculatedInitialHeight ).css("line-height", calculatedInitialHeight + "px");
								
								// Extras div settings
								$("#nxr_top_navbar_extras, #nxr_top_navbar_extras a").height( calculatedInitialHeight );
								$("#nxr_top_navbar_extras a").css( "line-height", calculatedInitialHeight + "px" );
						   }
						   lastScrollTop = st;
						});
					});';
		break;
		
		case '11':	// TRANSPARENT BEFORE SCROLL - CENTRAL LOGO 
					// Scrolls with page and then falls down after scrolling
		
			$scroll_amount = ( isset($nxr_options['header_transparent_display_after']['height']) && 
									$nxr_options['header_transparent_display_after']['height'] != 'px' ? 
									$nxr_options['header_transparent_display_after']['height']*1 : '$(window).height()');
			
			$afterScrollOpacity =	$nxr_options['header_transp_bg_opacity_after_scroll'];
			
			//$header_size_before_scroll = $nxr_options['header_size_before_scroll']['height'];
			$header_top_padding_after_scroll = ( isset($nxr_options['menu_bar_padding_end']['margin-top']) ? $nxr_options['menu_bar_padding_end']['margin-top'] : '0');
			
			$output = 'jQuery(document).ready(function($) {
					"use strict";
					var header_height = $("#nxr_top_navbar_container").outerHeight(true);
					var hasBeenTrigged = false;
					
					$("#nxr_top_navbar_extras .nxr_woo_minicart, #nxr_top_navbar_extras, #nxr_top_navbar_extras a").height($( "#nxr_top_navbar_container").outerHeight(true) );
					$(".fixed_menu_bottom_bar .nxr_woo_minicart").height($( ".fixed_menu_bottom_bar").outerHeight(true) );
					$("#nxr_top_navbar_extras a").css( "line-height", $("#nxr_top_navbar_container").outerHeight() + "px" );
					  
					
					// Set transparency and position for header
						$("#nxr_top_navbar_container").css("background-color","rgba('.Redux_Helpers::hex2rgba($nxr_options['header_background_rgba']['color']).' , 0)");
					
					function doTheStickyHeader() {
						// Do we have the admin bar on?
							var adminBarHeight = ( $("body").hasClass("admin-bar") ) ? "32px" : 0;
						
						// Window scroll position Y
							var winYval = $(window).scrollTop();
						
						// Do the tricks
						if ( winYval > '.$scroll_amount.'  && !hasBeenTrigged ) {
							$("#nxr_top_navbar_container").css("top",-header_height);
							$("#nxr_top_navbar_container").addClass("stickyHeader").css("background-color","rgba('.Redux_Helpers::hex2rgba($nxr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')").animate({
								"top": adminBarHeight
							},300);
							hasBeenTrigged = true;
							
						}
						if( winYval < '.$scroll_amount.' && $("#nxr_top_navbar_container").hasClass("stickyHeader")  && hasBeenTrigged ){
							$("#nxr_top_navbar_container").animate({"top": -header_height}, 300, function() {
								$("#nxr_top_navbar_container").css("top",0).removeClass("stickyHeader").css("display","block").css("background-color","rgba('.Redux_Helpers::hex2rgba($nxr_options['header_background_rgba']['color']).' , 0)");
							  });
							hasBeenTrigged = false;
						}
						
					}
					$(window).scroll(function(){
						// Do the sticky header
						doTheStickyHeader();
					});
				});';
		break;
		
		default: // Fixed - DEFAULT
		
			$output = ' jQuery(document).ready(function($) {
						"use strict";
						var hasBeenTrigged = false;
						var header_height = $("#nxr_top_navbar_container").outerHeight(true);
						
						$("#nxr_top_navbar_extras .nxr_woo_minicart, #nxr_top_navbar_extras, #nxr_top_navbar_extras a").height( $("#nxr_top_navbar_container").outerHeight() );
						$(".fixed_menu_bottom_bar .nxr_woo_minicart").height($( ".fixed_menu_bottom_bar").outerHeight(true) );				
						$("#nxr_top_navbar_extras a").css( "line-height", $("#nxr_top_navbar_container").outerHeight() + "px" );
						';
						
						
						if( $original_header_type != 1 && $header_type == 1 ) {
							$output .= '$("#nxr_top_navbar_container").addClass("finalHeaderSize").css("position", "fixed").css("display", "block");';
						}
						
	
						if( isset(	$nxr_options['header_opacity_change_after_scroll']) && 
									$nxr_options['header_opacity_change_after_scroll'] == 1) {
							$scroll_amount_change_color = ( isset (
								$nxr_options['header_background_opacity_change_after_amount']['height']) && 
								$nxr_options['header_background_opacity_change_after_amount']['height'] != 'px' ? 
								$nxr_options['header_background_opacity_change_after_amount']['height']*1 : '$(window).height()');
													
							$initialOpacity		=	$nxr_options['header_background_rgba']['alpha'];
							$afterScrollOpacity =	$nxr_options['header_background_opacity_after_scroll'];
							
												
							$output .= '$("#nxr_top_navbar_container .dropdown-menu").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($nxr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);
										if ($(window).scrollTop() > '.$scroll_amount_change_color.' ) {
										$("#nxr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($nxr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);
										
										}';
							
							// If header opacity is 1 we scroll down page with the height of header
							if( $initialOpacity == 1 ) {
								$output .='$(".header_spacer").height( $("#nxr_top_navbar_container").outerHeight() );';
							}
							
							
							if( $detect->isMobile() ) {
								
								//$output .= '$("#nxr_top_navbar_container").addClass("finalHeaderSize").css("position", "fixed");';
								$output .= '$("#nxr_top_navbar_container").removeClass("finalHeaderSize").css("position", "fixed").css("padding-top", "0px").css("padding-bottom", "0px").css("padding-top", "0px").css("padding-bottom", "0px").css("padding-left", "20px").css("padding-right", "20px");';
								$output .= '$("#nxr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($nxr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);';
							}
							else {
								$output .= '$(window).bind("scroll", function() {
									
									if ($(window).scrollTop() > '.$scroll_amount_change_color.' && !hasBeenTrigged ) {
										$("#nxr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($nxr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);
										hasBeenTrigged = true;
										
									}
									if ($(window).scrollTop() < '.$scroll_amount_change_color.' && hasBeenTrigged ) {
										$("#nxr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($nxr_options['header_background_rgba']['color']).' , '.$initialOpacity.')"}, 500);
										hasBeenTrigged = false;
										
									}
								});';
							}
								
					
						}
			
			$output .=' });';
		break;
	}
	wp_add_inline_script( 'nexx_js', $output, 'after' );
	
	}
	add_action( 'wp_enqueue_scripts', 'nexx_do_header' );


 // Custom search form
 function nexx_search_form( $form ) {
    $form = '<form method="get" id="searchform" class="searchform" action="' . esc_url( home_url( '/' ) ) . '" >
    <div>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'. esc_html__( 'Search','nexx' ) .'" />
    <input type="submit" id="searchsubmit" value="'. esc_html__( 'Search','nexx' ) .'" />
    </div>
    </form>';

    return $form;
 }
 add_filter( 'get_search_form', 'nexx_search_form' );

 
 
  
 
 // Include the Redux Framework
	if ( !class_exists( 'ReduxFramework' ) && file_exists( trailingslashit( get_template_directory() ) . 'nexarthemes/framework/framework.php' ) ) {
		require_once( trailingslashit( get_template_directory() ) . 'nexarthemes/framework/framework.php' );
	}
	if ( file_exists( trailingslashit( get_template_directory() ) . 'nexarthemes/config.php' ) ) {
		require_once( trailingslashit( get_template_directory() ) . 'nexarthemes/config.php' );
	}

// Custom CSS for NexarThemes Framework admin panel
	function nexx_addAndOverridePanelCSS() {
	  wp_dequeue_style( 'redux-css' );
	  wp_register_style(
		'nexarthemes-css',
		get_template_directory_uri().'/nexarthemes/css/framework.css',
		array(),
		time(),
		'all'
	  );    
	  wp_enqueue_style('nexarthemes-css');
	}
	add_action( 'redux/page/nxr_options/enqueue', 'nexx_addAndOverridePanelCSS' );
	
	add_action('admin_head', 'nexx_custom_meta_css');
	function nexx_custom_meta_css() {
	  $custom_meta_css =  '
		#nxr_metaboxid label {
		  display: inline-block;
		  min-width:170px;
		} 
		#nxr_metaboxid .settBlock {
		  display: block;
		  margin-bottom:5px;
		} 
		#nxr_metaboxid input[type="text"], #nxr_metaboxid select {
		  width: 120px;
		}
		.wp-picker-container{
			vertical-align:middle;
		}
	  ';
		wp_add_inline_style( 'nexx_custom-styles', esc_attr($custom_meta_css) );
	}
	
	function nexx_get_post_meta_by_key() {
		global $wpdb;
		$vc_styles = '';
		$key = '_wpb_shortcodes_custom_css';
		
		$sql		=	$wpdb->prepare( "SELECT DISTINCT `meta_value` FROM $wpdb->postmeta WHERE `meta_key` = %s", $key );
		$meta		=	$wpdb->get_results( $sql );

		if ( !empty($meta) ) {
			foreach($meta as $custom_style){
				$vc_styles .= $custom_style->meta_value;
			}
			wp_add_inline_style( 'nexx_custom-styles', esc_attr($vc_styles) );
		}
		return false;
	}
	add_action( 'wp_enqueue_scripts', 'nexx_get_post_meta_by_key' );
	
	
	function nexx_get_custom_css() {
		$nxr_options = get_option( 'redux_options' );
		if ( isset($nxr_options['enable_css-code']) && $nxr_options['enable_css-code'] == 'custom_css_on') {
			if( !empty($nxr_options['css-code']) ){
				wp_add_inline_style( 'nexx_custom-styles', esc_attr($nxr_options['css-code']) );			 
			}
		}
		return false;
	}
	add_action( 'wp_enqueue_scripts', 'nexx_get_custom_css' );
	

	

/*
* NXR Menu Fallback
*/
function nexx_menu_fallback(){
	echo '<ul id="mainNavUl" class="nav navbar-nav navbar-right"><li class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-480 current_page_item"><a href="' . esc_url( home_url( '/' ) ) . '">'. esc_html__( 'Home','nexx' ) .'</a></li></ul>';
}



/*
*	OneClick Install DEMO
*/
require_once( trailingslashit( get_template_directory() ) . 'nexarthemes/nxr_oci/nxr_oci.php' );




/** remove redux menu under the tools **/
add_action( 'admin_menu', 'nexx_remove_redux_menu',12 );
function nexx_remove_redux_menu() {
    remove_submenu_page('tools.php','redux-about');
}

add_action( 'admin_bar_menu', 'nexx_remove_element_from_adminbar', 999 );
function nexx_remove_element_from_adminbar( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'theme_options' );
}


/*
*	Full Screen Search
*	Hooked into wp_footer (see constructor function above)
*	@since 1.0.0
*/
// Hook FS Search into footer
add_action('wp_footer', 'do_fssearch' );
function do_fssearch(){
	
	$nxr_options = get_option( 'redux_options' );
	
	
		
	$output = '<div id="fssearch_container" class="hidden">';
		$output .= '<a class="close-btn" href="#0">Close</a><span class="fssearch_tip">'.esc_attr( "Type and hit enter", 'nxressentials' ).'</span>';
		$output .= '<form role="search" method="get" id="searchform" class="searchform" action="'.esc_url( home_url( '/' ) ).'">
					<div>
						<input type="text" value="'.get_search_query().'" name="s" id="s" class="fssearch_input" autocomplete="off" spellcheck="false" />
						<input type="submit" id="searchsubmit" value="Search" class="fssearch_submit" />
					</div>
				</form>';
	$output .= '</div><!-- fssearch_container END -->';
	echo ($output);
}
		

/*
*	Dinamic Styles based on Theme options
*/
 function nexx_styles(){
 	$nxr_options = get_option( 'redux_options' );
	$output = '';
	$output .= '
		.wpb_btn-success, #itemcontainer-controller {
			background-color: '.$nxr_options['theme_dominant_color'].'!important;
		}
		.hoveredIcon {
			color:'.$nxr_options['theme_dominant_color'].'>!important;
		}
		
		.topborder h3 a {
			border-top: 1px solid '.$nxr_options['theme_dominant_color'].';
		}
		ul.nav a.active {
			color: '.$nxr_options['theme_dominant_color'].' !important;
		}
		.testimonial_text{
			margin-bottom:60px;
		}';
	 
	wp_add_inline_style( 'nexx_custom-styles', esc_attr($output) );
 }
 add_action( 'wp_enqueue_scripts', 'nexx_styles' );

 // Register Custom Navigation Walker
 require_once( trailingslashit( get_template_directory() ) . 'nexarthemes/nxr_navwalker.php');
