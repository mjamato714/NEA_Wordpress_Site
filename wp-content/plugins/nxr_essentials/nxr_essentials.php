<?php
/*
	Plugin Name: NXR Essentials
	Plugin URI: http://nexarthemes.com/
	Author: NexarThemes
	Author URI: https://nexarthemes.com
	Version: 1.3.1
	Description: Essential features and goodies for NexarThemes Themes. Activating NXR Essentials will register two new post types (Portfolio & Testimonials) and will enable Full-Screen Search feature.
	Text Domain: nxressentials
*/

/*
*	If accesed directly, exit
*/
if (!defined('ABSPATH')) exit;

if(!class_exists('NXR_ESSENTIALS')) {
	
	class NXR_ESSENTIALS {
		
		var $js_dir;
		var $css_dir;
		var $gfx_dir;
		
		/**
		*	Constructor function
		*	@since 1.0.0
		*/
		public function __construct(){
			// Activation hook
			register_activation_hook( __FILE__, array($this, 'nxr_install' ));
			
			// Admin notices
			add_action('admin_notices', array($this,'nxr_admin_notices'));
			
			// Add language option
			add_action( 'plugins_loaded', array($this,'nxr_load_textdomain') );

			add_action( 'add_meta_boxes', array($this,'nexx_metaboxes') );
			add_action( 'save_post', array($this, 'nexx_save_postdata') );
			
			// WP-Admin Menu
			//	DEPRECATED
			//add_action('admin_menu', array($this,'nxr_essentials_menu'));
			
			// CSS and JS for back-end and front-end
			$this->js_dir	=	plugins_url('js/',__FILE__);
			$this->css_dir	=	plugins_url('css/',__FILE__);
			$this->gfx_dir	=	plugins_url('gfx/',__FILE__);
			
			// Enqueue required frontend scripts & styles
			add_action('wp_enqueue_scripts',array($this,'nxr_front_scripts'));
			
			// Register required post types
			add_action('init',array($this,'nxr_post_types'));
			
			// Register required taxonomies
			add_action('init',array($this,'nxr_taxonomies'));
			
			// Visual Composer Elements
			add_action('admin_init', array($this, 'nxr_testimonials_init'));
			
			// Required shortcodes
			add_shortcode( 'nxr_testimonials', array($this,'nxr_testimonials_shortcode') );
			add_shortcode( 'woocommerce_shop_page', array($this,'woo_shop_page_shortcode') );
			
			// Required MetaBoxes
			add_action( 'add_meta_boxes', array($this,'nxr_testimonials_metaboxes') );
			add_action( 'save_post', array($this,'nxr_save_testimonial_data') );
			
			/*add_action( 'add_meta_boxes', array($this,'nxr_parent_metabox') );
			add_action( 'save_post', array($this,'nxr_save_parent_metabox_data') );*/
		}
		
		
		/**
		*	Load plugin textdomain.
		*	@since 1.0.0
		*/
		function nxr_load_textdomain() {
		  load_plugin_textdomain( 'nxressentials', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
		}
		
		
		/**
		*	Function to check if theme is installed and activated
		*	@since 1.0.0
		*/
		public function nxr_theme_dependency_check() {
			return true;
		 }
		 
		 
		 /**
		*	Function to display admin notices
		*	@since 1.0.0
		*/
		function nxr_admin_notices() {
		  if ($notices= get_option('nxr_admin_notices')) {
			foreach ($notices as $notice) {
			  echo "<div class='updated notice is-dismissible'><p>$notice</p></div>";
			}
			delete_option('nxr_admin_notices');
		  }
		}
		 
		
		/**
		*	Install function
		*	@since 1.0.0
		*/
		function nxr_install(){
			update_option('nxr_essentials_version', '1.3.1' );
			/**
			*	Get notices array and update them
			*/
			$notices	=	get_option( 'nxr_admin_notices', array() );
			$theme		=	wp_get_theme();
			/**
			*	Check if theme is installed and activated
			*/
			if( !$this->nxr_theme_dependency_check() ) {
				$notices[]	=	__("NXR Essentials its only available with <b>".$theme->name."</b> theme. You are not allowed to use this outside <b>".$theme->name."</b> theme.", "nxressentials");
			} else {
				$notices[]	=	__("NXR Essentials its activated now! Thank you for using <b>".$theme->name."</b> Theme.", "nxressentials");
			}
			update_option('nxr_admin_notices', $notices);
		}
		
		
		/**
		*	WP-Admin menu function
		*	@since 1.0.0
		*	add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
		*	DEPRECATED
		*/
		function nxr_essentials_menu() {
			add_menu_page( 'NXR Essentials', 'NXR Essentials', 'manage_options', 'nxr_essentials/nxr_essentials.php', array($this,'nxr_essentials'), $this->gfx_dir.'menu_icon.png', 63 );
		}
		
		
		/**
		*	Main Function for WP-Admin area
		*	@since 1.0.0
		*	DEPRECATED
		*/
		function nxr_essentials(){
			$output = '<div class="wrap">';
				$output .= '<h2>';
				$output .= esc_html__( "NXR Essentials", 'nxressentials' );
				$output .= '</h2>';
				
				$output .= '<p>';
					$output .= esc_html__( "NXR Essentials is a collection of plugins specially created for our theme. They are required in order for this theme to work.", 'nxressentials' );
				$output .= '</p>';
				
				$output .= '<h3>';
					$output .= esc_html__( "NXR Testimonials", 'nxressentials' );
				$output .= '</h3>';
				$output .= '<p>';
					$output .= esc_html__( "This plugin adds a custom post type, so you can add and display testimonials from your customers.", 'nxressentials' );
				$output .= '</p>';
				
				$output .= '<h3>';
					$output .= esc_html__( "NXR Portfolio", 'nxressentials' );
				$output .= '</h3>';
				$output .= '<p>';
					$output .= esc_html__( "Do you want a quick and clean way to display some portfolio items? You got it with NXR Portfolio.", 'nxressentials' );
				$output .= '</p>';
				
				$output .= '<h3>';
					$output .= esc_html__( "NXR FullScreen Search", 'nxressentials' );
				$output .= '</h3>';
				$output .= '<p>';
					$output .= esc_html__( "This one adds a full-screen in-site search feature for your visitors", 'nxressentials' );
				$output .= '</p>';
				
				$output .= '<h3>';
					$output .= esc_html__( "NXR Super Search", 'nxressentials' );
				$output .= '</h3>';
				$output .= '<p>';
					$output .= esc_html__( "NXR Super Search adds a neat search feature for in-site search. Try it, you and your visitors will love it.", 'nxressentials' );
				$output .= '</p>';
			
				
				
			$output .= '</div><!-- .wrap-->';
			
			echo $output;
		}
		
		
		/**
		*	Create required post types
		*	@since 1.0.0
		*/
		function nxr_post_types() {
			// Testimonial post type
			register_post_type( 'nxr_testimonials',
				array(
					'labels' => array(
						'name'               => esc_html__( 'Testimonials', 'nxressentials' ),
						'singular_name'      => esc_html__( 'Testimonial', 'nxressentials' ),
						'menu_name'          => esc_html__( 'Testimonials', 'nxressentials' ),
						'name_admin_bar'     => esc_html__( 'Testimonial', 'nxressentials' ),
						'add_new'            => esc_html__( 'Add New', 'info bar', 'nxressentials' ),
						'add_new_item'       => esc_html__( 'Add New Testimonial', 'nxressentials' ),
						'new_item'           => esc_html__( 'New Testimonial', 'nxressentials' ),
						'edit_item'          => esc_html__( 'Edit Testimonial', 'nxressentials' ),
						'view_item'          => esc_html__( 'View Testimonial', 'nxressentials' ),
						'all_items'          => esc_html__( 'All Testimonials', 'nxressentials' ),
						'search_items'       => esc_html__( 'Search Testimonials', 'nxressentials' ),
						'not_found'          => esc_html__( 'No testimonial found.', 'nxressentials' ),
						'not_found_in_trash' => esc_html__( 'No testimonial found in Trash.', 'nxressentials' ),
					),
				'public' => true,
				'menu_icon'=>'dashicons-editor-quote',
				'has_archive' => true,
				'rewrite' => array('slug' => 'testimonials'),
				'supports' => array('title', 'editor', 'thumbnail'),
				)
			);
			
			// Portfolio post type
			register_post_type( 'nxr_portfolio',
				array(
					'labels' => array(
						'name'               => esc_html__( 'Portfolio', 'nxressentials' ),
						'singular_name'      => esc_html__( 'Portfolio', 'nxressentials' ),
						'menu_name'          => esc_html__( 'Portfolio', 'nxressentials' ),
						'name_admin_bar'     => esc_html__( 'Portfolio', 'nxressentials' ),
						'add_new'            => esc_html__( 'Add New', 'info bar', 'nxressentials' ),
						'add_new_item'       => esc_html__( 'Add New Portfolio Item', 'nxressentials' ),
						'new_item'           => esc_html__( 'New Portfolio Item', 'nxressentials' ),
						'edit_item'          => esc_html__( 'Edit Portfolio Item', 'nxressentials' ),
						'view_item'          => esc_html__( 'View Portfolio Item', 'nxressentials' ),
						'all_items'          => esc_html__( 'All Portfolio', 'nxressentials' ),
						'search_items'       => esc_html__( 'Search Portfolio', 'nxressentials' ),
						'not_found'          => esc_html__( 'No portfolio item found.', 'nxressentials' ),
						'not_found_in_trash' => esc_html__( 'No portfolio item found in Trash.', 'nxressentials' ),
					),
					'public'		=>	true,
					'menu_icon'		=>	'dashicons-format-image',
					'has_archive'	=>	true,
					'rewrite'		=>	array('slug' => 'portfolio'),
					'supports'		=>	array(
						'title',
						'editor',
						'author',
						'thumbnail',
						'excerpt',
						'comments',
					),
					'taxonomies'	=>	array(
						'post_tag',
						'portfolio-category',
					)
				)
			);
		}
		
		
		/**
		*	Register required taxonomies
		*	@since 1.0.0
		*/
		function nxr_taxonomies() {
			register_taxonomy(
				'portfolio-category',
				array('nxr_portfolio'),
				array(
					'hierarchical'	=>	true,
					'label'			=>	__( 'Categories','nxressentials' ),
					'rewrite'		=>	array( 'slug' => 'portfolio-category' ),
				)
			);
		}
		
		
		/**
		*	nxr_testimonials shortcode function
		*	@since 1.0.0
		*/
		function nxr_testimonials_shortcode ($atts) {
			/*
				 Empty vars declaration
			*/
			$output = 
			$carousel_content = 
			$all_testimonials_content = 
			$carousel_testimonials_number = 
			$carousel_bg_color = 
			$carousel_bottom_bar_color = 
			$testimonial_text_color = 
			$testimonial_name_color = 
			$testimonial_company_position_color = 
			$testimonial_viewall_bg_color = 
			$extra_class = '';
			
			$validPosts = array();
			$this_post = array();
			$id_pot = array();
			$i = 1;
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'carousel_testimonials_number'			=>	'3', 
				'carousel_bg_color'						=>	'#dd6a6a',
				'carousel_bottom_bar_color'				=>	'#dd3333',
				'testimonial_text_color'				=>	'#ffffff',
				'testimonial_name_color'				=>	'#262626',
				'testimonial_company_position_color'	=>	'#777777',
				'testimonial_viewall_bg_color'			=>	'#dd3333',
				'extra_class'							=>	'',
			), $atts));
			
			$args = array(
				   'post_type'			=>	'nxr_testimonials',
				   'posts_per_page'		=>	get_option('posts_per_page'),
				 );
			$nxr_query = new WP_Query($args);

			if( $nxr_query->have_posts() ) {
				/*
					We add JS only if there are some posts to display
				*/
				wp_enqueue_script( 'theshop-masonry' );
				wp_enqueue_script( 'theshop-flexslider' );
				wp_enqueue_script( 'theshop-testimonials' );
				wp_enqueue_style( 'theshop-testimonials-style' );
				
				$output .='<style>
				.cd-testimonials-all p {background: '.$testimonial_viewall_bg_color.';}
				.cd-testimonials-all p {color:'.$testimonial_text_color.';}
				.cd-testimonials-all p::after {border: 8px solid transparent; border-top-color: '.$testimonial_viewall_bg_color.';}
				</style>';
				
				while ( $nxr_query->have_posts() ) {
						$nxr_query->the_post();
						
						$src				=	wp_get_attachment_image_src( get_post_thumbnail_id(), array( 5600,1000 ), false, '' );
						$nxr_testi_author	=	get_post_meta( get_the_ID(), '_nxr_testi_author', true );
						$nxr_testi_position	=	get_post_meta( get_the_ID(), '_nxr_testi_role', true );
						
						if( $i <= $carousel_testimonials_number ) {
							$carousel_content .='<li>
										'.NXR_XTND::nxr_xtnd_getPostContent().'
										<div class="cd-author">
											<img src="'.$src[0].'" alt="'.get_the_title().'">
											<ul class="cd-author-info">
												<li style="color:'.$testimonial_name_color.'">'.$nxr_testi_author	.'</li>
												<li style="color:'.$testimonial_company_position_color.'">'.$nxr_testi_position.'</li>
											</ul>
										</div>
									</li>';
							$i++;
						}
						
						
						$all_testimonials_content .='<li class="cd-testimonials-item">
								'.NXR_XTND::nxr_xtnd_getPostContent().'
								<div class="cd-author">
									<img src="'.$src[0].'" alt="'.get_the_title().'">
									<ul class="cd-author-info">
										<li>'.$nxr_testi_author	.'</li>
										<li>'.$nxr_testi_position.'</li>
									</ul>
								</div> <!-- cd-author -->
							</li>';
				}
				wp_reset_postdata();	
				
				$output .='<div class="cd-testimonials-wrapper cd-container" style="background-color:'.$carousel_bg_color.'">
							<ul class="cd-testimonials" style="color:'.$testimonial_text_color.'">';
				$output .= $carousel_content;
				$output .='</ul> <!-- cd-testimonials -->
						<a href="#0" class="cd-see-all" style="background-color:'.$carousel_bottom_bar_color.'; color:'.$testimonial_text_color.'">See all</a>
					</div> <!-- cd-testimonials-wrapper -->';
					
				$output .='<div class="cd-testimonials-all">
					<div class="cd-testimonials-all-wrapper">
						<ul>';
				$output .= $all_testimonials_content;
				$output .='</ul>
					</div>	<!-- cd-testimonials-all-wrapper -->
				
					<a href="#0" class="close-btn">Close</a>
				</div> <!-- cd-testimonials-all -->';
				
			} else {
				$output .=	'<div class="nxr_testimonials" data-fetch="'.$carousel_testimonials_number.'">';
				$output .=	'<p>'.__('No testimonials to display. Please add some testimonials!', 'nxressentials').'</p>';
				$output .=	'</div>';
			}
								
			return $output;
		}
		
		
		/*
		*	Visual Composer mapping function
		*	Public API
		*	Refference:	http://kb.wpbakery.com/index.php?title=Vc_map
		*	Example:	http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
		*	@since 1.0.0
		*/
		function nxr_testimonials_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"				=>	__("NXR Testimonials",'nxressentials'),
					   "holder"				=>	"div",
					   "base"				=>	"nxr_testimonials",
					   "class"				=>	"",
					   "icon"				=>	"nxr_testimonials",
					   "category"			=>	__("NexarThemes Extender",'nxressentials'),
					   "description"		=>	__("Testimonials displayed as carousel with a modal view-all option.","nxressentials"),
					   "content_element"	=>	true,
					   "params"				=>	array(
								array(
									"type"			=>	"textfield",
									"class"			=>	"",
									"heading"		=>	__("How many testimonials to display in carousel?", "nxressentials"),
									"param_name"	=>	"carousel_testimonials_number",
									"value"			=>	"",
									"description"	=>	__("Enter the desired number of testimonials to display in carousel. Recomended: 6", "nxressentials"),
									"save_always" 	=>	true,				
								),
								array(
									"type"			=>	"colorpicker",
									"class"			=>	"",
									"heading"		=>	__("Carousel background color", "nxressentials"),
									"param_name"	=>	"carousel_bg_color",
									"value"			=>	"",
									"save_always" 	=>	true,			
								),
								array(
									"type"			=>	"colorpicker",
									"class"			=>	"",
									"heading"		=>	__("Carousel bottom bar color", "nxressentials"),
									"param_name"	=>	"carousel_bottom_bar_color",
									"value"			=>	"",
									"save_always" 	=>	true,		
								),
								array(
									"type"			=>	"colorpicker",
									"class"			=>	"",
									"heading"		=>	__("Testimonial text color", "nxressentials"),
									"param_name"	=>	"testimonial_text_color",
									"value"			=>	"",
									"save_always" 	=>	true,
								),
								array(
									"type"			=>	"colorpicker",
									"class"			=>	"",
									"heading"		=>	__("Testimonial name color", "nxressentials"),
									"param_name"	=>	"testimonial_name_color",
									"value"			=>	"",
									"save_always" 	=>	true,
								),
								array(
									"type"			=>	"colorpicker",
									"class"			=>	"",
									"heading"		=>	__("Testimonial company & position color", "nxressentials"),
									"param_name"	=>	"testimonial_company_position_color",
									"value"			=>	"",
									"save_always" 	=>	true,
								),
								array(
									"type"			=>	"colorpicker",
									"class"			=>	"",
									"heading"		=>	__("Testimonial background color on view all page", "nxressentials"),
									"param_name"	=>	"testimonial_viewall_bg_color",
									"value"			=>	"",
									"save_always" 	=>	true,
								),
								array(
									"type"			=>	"textfield",
									"class"			=>	"",
									"heading"		=>	__("Extra class", "nxressentials"),
									"param_name"	=>	"extra_class",
									"value"			=>	"",
									"description"	=>	__("Extra CSS class for custom CSS", "nxressentials")	,
									"save_always" 	=>	true,		
								),
					   )
					) 
				);
			}
		}
		
		
		/**
		*	Add testimonials metaboxes function
		*	@since 1.0.0
		*/	
		function nxr_testimonials_metaboxes() {
				add_meta_box(
					'nxr_testimetaboxid',
					__( 'Testimonial details', 'nxressentials' ),
					array($this,'nxr_testimonial_custom_box'),
					'nxr_testimonials'
				);
		}
		function nxr_testimonial_custom_box( $post ) {
			// Add an nonce field so we can check for it later
			wp_nonce_field( 'sage_testi_custom_box', 'sage_testi_custom_box_nonce' );
	
			// Get metaboxes values from database
			$nxr_testi_author			=	get_post_meta( $post->ID, '_nxr_testi_author', true );
			$nxr_testi_role				=	get_post_meta( $post->ID, '_nxr_testi_role', true );
			
			// Construct the metaboxes and print out
			
			// Testimonial author name
			echo '<div class="settBlock" style="margin-bottom:15px"><label for="testi_author" style="width:170px;display:inline-block;height:30px;">';
			   esc_html_e( "Testimonial author", 'nxressentials' );
			echo '</label> ';
			echo '<input type="text" id="testi_author" name="testi_author" value="' . esc_attr( $nxr_testi_author ) . '" size="25" placeholder="Jon Doe" /></div>';
		  
			// Testimonial author company and job
			echo '<div class="settBlock" style="margin-bottom:15px"><label for="testi_role" style="width:170px;display:inline-block;height:30px;">';
			   esc_html_e( "Company and Position", 'nxressentials' );
			echo '</label> ';
			echo '<input type="text" id="testi_role" name="testi_role" value="' . esc_attr( $nxr_testi_role ) . '" size="25" /></div>';
		}
		function nxr_save_testimonial_data( $post_id ) {
			// Check if our nonce is set.
			if ( ! isset( $_POST['sage_testi_custom_box_nonce'] ) ) {
				return $post_id;
			}
	
			$nonce = $_POST['sage_testi_custom_box_nonce'];
	
			// Verify that the nonce is valid
			if ( ! wp_verify_nonce( $nonce, 'sage_testi_custom_box' ) ) {
				return $post_id;
			}
	
			// If this is an autosave, our form has not been submitted, so we don't want to do anything
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return $post_id;
			}
	
			// Check the user's permissions.
			if ( 'nxr_testimonials' == $_POST['post_type'] ) {
				if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
			} else {
				if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
			}
			
			// OK to save data
			// Sanitize user input
			$nxr_testi_author	= sanitize_text_field( $_POST['testi_author'] );
			$nxr_testi_role		= sanitize_text_field( $_POST['testi_role'] );
	
			
			// Update the meta field in the database
			update_post_meta( $post_id, '_nxr_testi_author',		$nxr_testi_author );
			update_post_meta( $post_id, '_nxr_testi_role',	$nxr_testi_role );
		}
		
		
		
		
		/**
		*	woo_shop_page shortcode function
		*	@since 1.3.0
		*/
		function woo_shop_page_shortcode ($atts ) {
			/*
				 Empty vars declaration
			*/
			$output = '';
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'link_text'	=>	__('Go to shop', 'nxressentials'), 
				'class'		=>	'', 
				'color'		=>	'', 
			), $atts));
			
			if( empty($color) ) {
				$style = "";
			} else {
				$style = " style=\"color:".$color.";\" ";
			}
			
			if( class_exists("WooCommerce") ) {
				return '<a href="'.esc_url(get_permalink( woocommerce_get_page_id( 'shop' ) )).'" title="'.$link_text.'" class="'.$class.'" '.$style.'>'.$link_text.'</a>';
			} else {
				return '<a href="'.esc_url( home_url( '/' ) ).'" title="'.$link_text.'" class="'.$class.'" '.$style.'>'.$link_text.'</a>';
			}
		}
		
		
		

		// Pages Metaboxes
		// Generate the metabox
		function nexx_metaboxes() {
	    	$screens = array( 'page', 'nxr_portfolio', 'nxr_megafooter' );
	    	foreach ( $screens as $screen ) {
	       		add_meta_box(
	           	'nxr_metaboxid',
	            	esc_html__( 'Page settings', 'nexx' ),
	            	array($this,'nexx_inner_custom_box'),
	            	$screen
	        	);
	    	}
		}

		// Print the box content
		function nexx_inner_custom_box($post) {
			// Add an nonce field so we can check for it later
			wp_nonce_field( 'nexx_inner_custom_box', 'nexx_inner_custom_box_nonce' );

			// Get metaboxes values from database
			$nxr_page_bgcolor			=	esc_attr( get_post_meta( $post->ID, '_nxr_page_bgcolor', true ) );
			$nxr_page_top_padding		=	esc_attr( get_post_meta( $post->ID, '_nxr_page_top_padding', true ) );
			$nxr_page_btm_padding		=	esc_attr( get_post_meta( $post->ID, '_nxr_page_btm_padding', true ) );
			$nxr_page_color_scheme		=	esc_attr( get_post_meta( $post->ID, '_nxr_page_color_scheme', true ) );
			$nxr_page_height			=	esc_attr( get_post_meta( $post->ID, '_nxr_page_height', true ) );
			$nxr_page_title				=	esc_attr( get_post_meta( $post->ID, '_nxr_page_title', true ) );
			$nxr_page_title_color		=	esc_attr( get_post_meta( $post->ID, '_nxr_page_title_color', true ) );
			
			// Construct the metaboxes and print out
			// Page color scheme
			echo '<div class="settBlock"><label for="page_color_scheme">';
			   esc_html_e( "Page color scheme", 'nexx' );
			echo '</label> ';
			if($nxr_page_color_scheme == 'dark_scheme'){
				echo '<select name="page_color_scheme" id="page_color_scheme"><option value="dark_scheme" name="dark_scheme" selected="selected">'.esc_html__('Dark scheme', 'nexx').'</option><option value="light_scheme" name="light_scheme">'.esc_html__('Light scheme', 'nexx').'</option></select></div>';
			}
			elseif($nxr_page_color_scheme == 'light_scheme'){
				echo '<select name="page_color_scheme" id="page_color_scheme"><option value="dark_scheme" name="dark_scheme">'.esc_html__('Dark scheme', 'nexx').'</option><option value="light_scheme" name="light_scheme" selected="selected">'.esc_html__('Light scheme', 'nexx').'</option></select></div>';
			}
			else{
				echo '<select name="page_color_scheme" id="page_color_scheme"><option value="light_scheme" name="light_scheme" selected="selected">'.esc_html__('Light scheme', 'nexx').'</option><option value="dark_scheme" name="dark_scheme">'.esc_html__('Dark scheme', 'nexx').'</option></select></div>';
			}
			
			// Page background color
			echo '<div class="settBlock"><label for="page_bgcolor">';
			   esc_html_e( "Page background color", 'nexx' );
			echo '</label> ';
			echo '<input type="text" id="page_bgcolor" name="page_bgcolor" class="color-field" value="' . $nxr_page_bgcolor . '" /></div>';
		  
		  	// Page top padding
		  	echo '<div class="settBlock"><label for="page_top_padding">';
			   esc_html_e( "Page top padding", 'nexx' );
			echo '</label> ';
		  	echo '<input type="text" id="page_top_padding" name="page_top_padding" value="' . $nxr_page_top_padding . '" size="25" /> <em>pixels</em></div>';
		  
		  	// Page bottom padding
		  	echo '<div class="settBlock"><label for="page_btm_padding">';
			   esc_html_e( "Page bottom padding", 'nexx' );
		  	echo '</label> ';
		  	echo '<input type="text" id="page_btm_padding" name="page_btm_padding" value="' . $nxr_page_btm_padding . '" size="25" /> <em>pixels</em></div>';
			
			// Page height
		  	echo '<div class="settBlock"><label for="page_height">';
			   esc_html_e( "Page height", 'nexx' );
		  	echo '</label> ';
		  	echo '<input type="text" id="page_height" name="page_height" value="' . $nxr_page_height . '" size="25" /> <em>'.esc_html__('pixels. If not set, auto-height is set.', 'nexx').'</em></div>';
			
			// Page title
		  	echo '<div class="settBlock"><label for="page_title">';
			   esc_html_e( "Disable page title", 'nexx' );
		  	echo '</label> ';
		  	echo '<input type="checkbox" id="page_title" name="page_title" value="1" '.checked( $nxr_page_title, 1, false ).' /></div>';
			
			// Page title override color
			echo '<div class="settBlock"><label for="page_title_color">';
			   esc_html_e( "Page title color", 'nexx' );
			echo '</label> ';
			echo '<input type="text" id="page_title_color" name="page_title_color" class="color-field" value="' . $nxr_page_title_color . '" /> <em>'.esc_html__('Overrides the one set in Theme Options', 'nexx').'</em></div>';
		}


		// Save the metabox data to database
		function nexx_save_postdata( $post_id ) {
			
			if( isset($_POST['post_type']) /*&& $_POST['post_type'] == 'page'*/ ) {
			
				// If this is an autosave, our form has not been submitted, so we don't want to do anything
				if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
					return;
				}
				
				
				
		
				// Check the user's permissions.
				if ( ! current_user_can( 'edit_page', $post_id ) ) {
					return;
				} else {
					if ( ! current_user_can( 'edit_post', $post_id ) )
					return;
				}
				
				// OK to save data
				if ( empty( $_POST['page_bgcolor'] ) ) {
					if ( get_post_meta( $post_id, '_nxr_page_bgcolor', true ) ) {
						delete_post_meta( $post_id, '_nxr_page_bgcolor' );
					}
				} else {
					update_post_meta( $post_id, '_nxr_page_bgcolor', sanitize_text_field( $_POST['page_bgcolor'] ) );
				}
				
				if ( empty( $_POST['page_top_padding'] ) ) {
					if ( get_post_meta( $post_id, '_nxr_page_top_padding', true ) ) {
						delete_post_meta( $post_id, '_nxr_page_top_padding' );
					}
				} else {
					update_post_meta( $post_id, '_nxr_page_top_padding', sanitize_text_field( $_POST['page_top_padding'] ) );
				}
				
				if ( empty( $_POST['page_btm_padding'] ) ) {
					if ( get_post_meta( $post_id, '_nxr_page_btm_padding', true ) ) {
						delete_post_meta( $post_id, '_nxr_page_btm_padding' );
					}
				} else {
					update_post_meta( $post_id, '_nxr_page_btm_padding', sanitize_text_field( $_POST['page_btm_padding'] ) );
				}
				
				if ( empty( $_POST['page_color_scheme'] ) ) {
					if ( get_post_meta( $post_id, '_nxr_page_color_scheme', true ) ) {
						delete_post_meta( $post_id, '_nxr_page_color_scheme' );
					}
				} else {
					update_post_meta( $post_id, '_nxr_page_color_scheme', sanitize_text_field( $_POST['page_color_scheme'] ) );
				}
				
				if ( empty( $_POST['page_height'] ) ) {
					if ( get_post_meta( $post_id, '_nxr_page_height', true ) ) {
						delete_post_meta( $post_id, '_nxr_page_height' );
					}
				} else {
					update_post_meta( $post_id, '_nxr_page_height', sanitize_text_field( $_POST['page_height'] ) );
				}
				
				if ( empty( $_POST['page_title'] ) ) {
					if ( get_post_meta( $post_id, '_nxr_page_title', true ) ) {
						delete_post_meta( $post_id, '_nxr_page_title' );
					}
				} else {
					update_post_meta( $post_id, '_nxr_page_title', sanitize_text_field( $_POST['page_title'] ) );
				}
				
				if ( empty( $_POST['page_title_color'] ) ) {
					if ( get_post_meta( $post_id, '_nxr_page_title_color', true ) ) {
						delete_post_meta( $post_id, '_nxr_page_title_color' );
					}
				} else {
					update_post_meta( $post_id, '_nxr_page_title_color', sanitize_text_field( $_POST['page_title_color'] ) );
				}
			}
		}

		
		
		
		/*
		*	Register necessary js and css files on frontend
		*/
		function nxr_front_scripts(){
			
			// Testimonials files
			wp_register_script('theshop-masonry',$this->js_dir.'masonry.pkgd.min.js', array('jquery'), '' );
			wp_register_script('theshop-flexslider',$this->js_dir.'jquery.flexslider-min.js', array('jquery'), '');
			wp_register_script('theshop-testimonials',$this->js_dir.'testimonials.js', array('jquery'), '');
			wp_register_style('theshop-testimonials-style',$this->css_dir.'testimonials.css', '', '' );
			// NXR Essentials
			/*wp_register_script('theshop-nxr-essentials',$this->js_dir.'nxr_essentials.js', array('jquery'), '', true);
			wp_enqueue_script( 'theshop-nxr-essentials' );
			wp_register_style('theshop-essentials-style',$this->css_dir.'nxr_essentials.css', '', '' );
			wp_enqueue_style( 'theshop-essentials-style' );*/
		}
	}	
	/*
	*	All good, fire up the plugin :)
	*/
	new NXR_ESSENTIALS;
}