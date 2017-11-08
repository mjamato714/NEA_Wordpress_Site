<?php
/*
	Plugin Name: NXR Extender for Visual Composer
	Plugin URI: http://nexarthemes.com/
	Author: NexarThemes
	Author URI: https://nexarthemes.com
	Version: 3.2
	Description: Custom made extender for Visual Composer
	Text Domain: nxrextender
*/

/*
	If accesed directly, exit
*/
if (!defined('ABSPATH')) exit;

if(!class_exists('NXR_XTND')) {
	
	add_action('admin_init','initiate_nxr_extender');
	function initiate_nxr_extender() {
		/**
		 * Check if Visual Composer is installed and activated
		*/
		$vc_check = nxr_vc_dependency_check();
		if($vc_check) { echo $vc_check; }
	}
	
	
	
	
	
	
	/**
	 * Function to check if Visual Composer is installed 
	 * and activated and has the minimum required version
	*/
	if(!function_exists('nxr_vc_dependency_check')){
		function nxr_vc_dependency_check() {
			if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
				/*
					Minimum Visual composer version check
				*/
				if( version_compare( '5.0', WPB_VC_VERSION, '>' ) ) {
					/*
						Deactivate the plugin as the conditions are not met
					*/
					if ( is_plugin_active('nxr_vc_extender/nxr_xtnd.php') ) {
						deactivate_plugins( '/nxr_vc_extender/nxr_xtnd.php', true );
					}
					return vc_installed_min_version_notice();
				}
			} else {
				/*
					Deactivate the plugin as the conditions are not met
				*/
				if ( is_plugin_active('nxr_vc_extender/nxr_xtnd.php') ) {
					deactivate_plugins( '/nxr_vc_extender/nxr_xtnd.php', true );
				}
				return vc_installed_min_version_notice();
			}
			return false;
		 }
	}
	
	
	
	
	function vc_installed_min_version_notice() {
		return '<div class="nxr_notice nxr_notice_error"><p><strong>NexarThemes Extender is a add-on for Visual Composer plugin</strong>, therefore before activation of NexarThemes Extender please install and activate Visual Composer - <strong>minimum version: 5.0</strong></p></div>';
	}
	
	
	
	/**
	 * Install function
	 * @since 1.0.2
	 */
	register_activation_hook( __FILE__, 'nxr_xtnd_install' );
	function nxr_xtnd_install(){
		update_option('nxr_xtnd_version', '3.2' );
	}
	
	
	/**
	 * Custom function SVG icon upload
	 * @since 1.0.3.9
	 */
	function nxr_svg_upload( $mimes ){
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
	add_filter( 'upload_mimes', 'nxr_svg_upload' );


	class NXR_XTND{
		var $elements_dir;
		//var $shortcodes_dir;
		var $js_dir;
		var $css_dir;
		var $value;
		
		function __construct(){
			$this->elements_dir		=	plugin_dir_path( __FILE__ ).'elements/';
			//$this->shortcodes_dir	=	plugin_dir_path( __FILE__ ).'shortcodes/';
			$this->js_dir			=	plugins_url('includes/js/',__FILE__);
			$this->css_dir			=	plugins_url('includes/css/',__FILE__);
			
			add_action( 'plugins_loaded', array($this,'nxr_xtnd_load_textdomain') );
			
			add_action('init',array($this,'nxr_xtnd_init'));
			add_action('admin_enqueue_scripts',array($this,'nxr_xtnd_admin_scripts'));
			add_action('wp_enqueue_scripts',array($this,'nxr_xtnd_front_scripts'));
			
			add_shortcode( 'icon', array($this,'nxr_icons_shortcode') );
			
			/*
				Param type "range"
				To include this param in one element, include the below lines in element construct function
			*/ 
			
			/*if ( function_exists('vc_add_shortcode_param')){
				vc_add_shortcode_param('range' , array(NXR_XTND, 'make_range_input' ) );
			}*/
			
			
			/*
				Param type "number"
				To include this param in one element, include the below lines in element construct function
			*/ 
			
			/*if ( function_exists('vc_add_shortcode_param')){
				vc_add_shortcode_param('number' , array(NXR_XTND, 'make_number_input' ) );
			}*/
			
			
			
			/*
				Param type "icon_browser"
				To include this param in one element, include the below lines in element construct function
			*/ 
			/*if(function_exists('vc_add_shortcode_param')){
				vc_add_shortcode_param('icon_browser', array(NXR_XTND, 'icon_browser') );
			}*/
		}		
		
		
		/**
		 * Load plugin textdomain.
		 *
		 * @since 1.0.2
		 */
		function nxr_xtnd_load_textdomain() {
		  load_plugin_textdomain( 'nxrextender', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
		}
		
		
		
		function nxr_xtnd_init() {
			/* 
				Walk trough the elements and add them to addon
			*/
			foreach(glob($this->elements_dir."/*.php") as $element) {
				require_once($element);
			}
			
			/* 
				Walk trough the shortcodes and add them to addon
			*/
			//foreach(glob($this->shortcodes_dir."/*.php") as $shortcode) {
			//	require_once($shortcode);
			//}
		}
		
		
		
		
		
		/*
			Icon schortcode
		*/
		function nxr_icons_shortcode( $content = null ) {
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract( shortcode_atts( array(
						'name'		=>	'default',
						'color'		=>	'',
						'size'		=>	'',
						'height'	=>	'',
					), $content ) );
			
			if( !empty($color) ) {
				$addColor=' color:' . $color . '; ';
			}
			
			$addColor	=	( !empty($color) ? ' color:' . $color . '; ' : '' );
			$addSize	=	( !empty($size) ? ' font-size:' . $size . '!important; ' : '' );
			$addHeight	=	( !empty($height) ? ' line-height:' . $height . '!important; ' : '' );
			
			/*
				Output return
			*/
			return '<i class="icon ' . $name . '" style="'. $addColor . $addSize . $addHeight.'"></i>';
		}
		
		
				
		
		
		/*
			Generate range input fild
			Note: type="range" is not supported in Internet Explorer 9 and earlier versions.
			Visual Composer docs: http://kb.wpbakery.com/index.php?title=Visual_Composer_Tutorial_Create_New_Param
		*/ 
		public static function make_range_input($settings, $value){
			
			// Calculate dependencies
			if( function_exists('vc_generate_dependencies_attributes') ) {
				$dependency = vc_generate_dependencies_attributes($settings);
			} else { 
				$dependency = '';
			}
			
			if( isset($settings['param_name']) ){
				$param_name = $settings['param_name'];
			} else {
				$param_name = '';
			}
			
			if( isset($settings['type']) ){
				$type = $settings['type'];
			} else {
				$type = '';
			}
			
			if( isset($settings['min']) ){
				$min = $settings['min'];
			} else {
				$min = '0';
			}
			
			if( isset($settings['max']) ){
				$max = $settings['max'];
			} else {
				$max = '999999';
			}
			
			if( isset($settings['prefix']) ){
				$prefix = $settings['prefix'];
			} else {
				$prefix = 'pixels';
			}
			
			if( isset($settings['class']) ){
				$class = $settings['class'];
			} else {
				$class = '';
			}
			
			/*
				All vars are ok, build the output
			*/
			$output = '<span class="nxr_selected_value">Current value: <span class="selectedNewValue">'.$value.'</span> '.$prefix.'</span><br> '.$min.'<input type="'.$type.'" min="'.$min.'" max="'.$max.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" style="max-width:100px; margin-right: 10px;" ' . $dependency . ' />'.$max;
			
			/*
				Output return
			*/
			return $output;
		}
		
		
		
		
		/*
			Generate number input fild
			Note: type="number" is not supported in Internet Explorer 9 and earlier versions.
			Visual Composer docs: http://kb.wpbakery.com/index.php?title=Visual_Composer_Tutorial_Create_New_Param
		*/ 
		public static function make_number_input($settings, $value){
			// Calculate dependencies
			if( function_exists('vc_generate_dependencies_attributes') ) {
				$dependency = vc_generate_dependencies_attributes($settings);
			} else { 
				$dependency = '';
			}
			
			if( isset($settings['param_name']) ){
				$param_name = $settings['param_name'];
			} else {
				$param_name = '';
			}
			
			if( isset($settings['type']) ){
				$type = $settings['type'];
			} else {
				$type = '';
			}
			
			if( isset($settings['min']) ){
				$min = $settings['min'];
			} else {
				$min = '0';
			}
			
			if( isset($settings['max']) ){
				$max = $settings['max'];
			} else {
				$max = '999999';
			}
			
			if( isset($settings['suffix']) ){
				$suffix = $settings['suffix'];
			} else {
				$suffix = '';
			}
			
			if( isset($settings['class']) ){
				$class = $settings['class'];
			} else {
				$class = '';
			}
			
			/*
				All vars are ok, build the output
			*/
			$output = '<input type="number" min="'.$min.'" max="'.$max.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" style="max-width:100px; margin-right: 10px;" />'.$suffix;
			
			/*
				Output return
			*/
			return $output;
		}
		
		
		
		
		
		
		/*
			Time elapsed function
		*/
		public function nxr_xtnd_tes($datetime, $full = false) {
			$now = new DateTime;
			$ago = new DateTime($datetime);
			$diff = $now->diff($ago);
		
			$diff->w = floor($diff->d / 7);
			$diff->d -= $diff->w * 7;
		
			$string = array(
				'y' => esc_html__('year','nxrextender'),
				'm' => esc_html__('month','nxrextender'),
				'w' => esc_html__('week','nxrextender'),
				'd' => esc_html__('day','nxrextender'),
				'h' => esc_html__('hour','nxrextender'),
				'i' => esc_html__('minute','nxrextender'),
				's' => esc_html__('second','nxrextender'),
			);
			foreach ($string as $k => &$v) {
				if ($diff->$k) {
					$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
				} else {
					unset($string[$k]);
				}
			}
		
			if (!$full) $string = array_slice($string, 0, 1);
			/*
				Output return
			*/
			return $string ? '<abbr title="'.$datetime.'">'.implode(', ', $string) . esc_html__(' ago ','nxrextender') . '</abbr>' : esc_html__(' just now ','nxrextender');
		}
		
		
		
		
		
		public function make_links_clickable($text, $color){
			return preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1" target="_blank" style="color:'.$color.';">$1</a>', $text);
		}
		
		
		
		/*
			Custom function for getting post content
		*/
		public function nxr_xtnd_getPostContent() {
			global $more; $more = 0;
			
			if ( ! has_excerpt() ) {
				  return str_replace(']]>', ']]&gt;', apply_filters('the_content', get_the_content('[...]')));
			} else { 
				  return get_the_excerpt();
			}
		}
		
		
		
		
		
		
		/*
			Custom function for getting post excerpt
		*/
		public function nxr_xtnd_getPostExcerpt() {
			$content = apply_filters('the_excerpt', get_the_excerpt());
			/*
				Output return
			*/
			return $content;
		}
		
		
		
		/*
			Icon Browser function
		*/
		public static function icon_browser($settings, $value=null) {
			
			// Visual Composer function to get dependencies
			$dependency = ( function_exists('vc_generate_dependencies_attributes') ? vc_generate_dependencies_attributes($settings) : '' );
			
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			
			$output = '<div class="nxr_param_'.$param_name.'">'
					 .'<input name="'.$param_name.'"
					  class="wpb_vc_param_value wpb-textinput '.$param_name.' 
					  '.$type.'_field" type="hidden" 
					  value="'.$value.'" ' . $dependency . '/>'
					 .'</div>';
			$output .= '<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".iconpreview").html("<i class=\''.$value.'\'></i> <span>'.$value.'</span>");
					jQuery("div.listyle[data-icon=\''.$value.'\']").addClass("selected");
				});
				
				jQuery(".icons-display-screen div.listyle").click(function() {
					  jQuery(this).addClass("selected").siblings().removeClass("selected");
                    var icon = jQuery(this).attr("data-icon");
                    jQuery("input[name=\''.$param_name.'\']").val(icon);
                    jQuery(".iconpreview").html("<i class=\'"+icon+"\'></i> <span>"+icon+"</span>");
                });
				
				jQuery(".filterSets").on("change", function() {
                    var selectedSet = jQuery(this).find(":selected").val();
					  if(selectedSet == "showAllSets") {
						  jQuery("div.icons-display-screen").fadeIn();
					  } else {
					  	jQuery("div.icons-display-screen").fadeOut();
                    	jQuery("#"+selectedSet).fadeIn();
					  }
                });
				</script>';
			
			
			
			/*
				Include icons list
			*/
			@include(plugin_dir_path( __FILE__ ).'includes/fonts/icons.php');
			
			$output .= '<p><div class="iconpreview"><i class=""></i></div><input class="searchicon" type="text" placeholder="Search for the perfect icon..." />';
			
			$output .='<select class="filterSets"><option value="showAllSets">Show all icons sets</option>';
			foreach($icons_set as $icon_set => $icons) {
				switch($icon_set){
					case 'fa': $fontSetName = 'FontAwesome';
					break;
					case 'outline': $fontSetName = 'Outline';
					break;
					default: $fontSetName = $icon_set;
				}
				$output .='<option value="iconslist_'.$icon_set.'">'.$fontSetName.'</option>';
			}
			$output .='</select>';
			
			$output .='</p>';
			
			$output .= '<div id="nxr_xtnd_iconsearch">';
				foreach($icons_set as $icon_set => $icons) {
					$output .= '<div class="icons-display-screen" id="iconslist_'.$icon_set.'">';
						foreach($icons as $icon => $icondata){
							$output .= '<div class="listyle" title="'.$icon.'" data-icon="'.$icondata['class'].' '.$icon.'" data-icon-tag="'.$icondata['tags'].'">';
							$output .= '<i class="'.$icondata['class'].' '.$icon.'"></i></div>';
						}
					$output .='</div>';
				}

			$output .= '<script type="text/javascript">
					jQuery(document).ready(function(){
						jQuery(".searchicon").keyup(function(){
							// Get the input field text
							var searchVal = jQuery(this).val();
							// Loop through the icon list
							jQuery(".icons-display-screen .listyle").each(function(){
								// If the list item does not contain the text phrase fade it out
								if (jQuery(this).attr("data-icon-tag").search(new RegExp(searchVal, "i")) < 0) {
									jQuery(this).fadeOut();
								} else {
									jQuery("div.icons-display-screen").fadeIn();
									jQuery(this).show();
								}
							});
						});
					});
			</script>';
			$output .= '</div>';
			
			/*
				Output return
			*/
			return $output;
		}
		
		
		/*
			Register necessary js and css files on frontend
		*/
		function nxr_xtnd_front_scripts(){
			wp_register_script('nxr-vc-countto',$this->js_dir.'countto.js', array('jquery'));
			wp_register_script('nxr-vc-jquery-appear',$this->js_dir.'jquery.appear.js', array('jquery'));
			wp_register_script('nxr-vc-jquery-easing',$this->js_dir.'jquery.easing.min.js', array('jquery'));
			wp_register_script('nxr-vc-jquery-easypiechart',$this->js_dir.'jquery.easypiechart.min.js', array('jquery'));
			wp_register_script('nxr-vc-blogposts',$this->js_dir.'nxrblogposts.js',array('jquery'));
			wp_register_script('nxr-vc-carouFredSel',$this->js_dir.'jquery.carouFredSel-6.2.1.js',array('jquery'));
			wp_register_script('nxr-vc-tooltip',$this->js_dir.'tooltip.js',array('jquery'));
			wp_register_script('nxr-vc-mousewheel',$this->js_dir.'jquery.mousewheel.min.js',array('jquery'));
			wp_register_script('nxr-vc-touchSwipe',$this->js_dir.'jquery.touchSwipe.min.js',array('jquery'));
			wp_register_script('nxr-vc-transit',$this->js_dir.'jquery.transit.min.js',array('jquery'));
			wp_register_script('nxr-vc-throttle-debounce',$this->js_dir.'jquery.ba-throttle-debounce.min.js',array('jquery'));
			wp_register_script('nxr-vc-modernizr',$this->js_dir.'modernizr.custom.js',array('jquery'));
			// NXR Progress bar
			wp_register_script('nxr-vc-progressbar',$this->js_dir.'nxr_progressbar.js',array('jquery'));
			// NXR TweetFeed
			wp_register_script('nxr-vc-tweetfeed',$this->js_dir.'nxr_tweetfeed.js',array('jquery'));
			// Plugin js
			wp_register_script('nxr-vc-app',$this->js_dir.'nxrvcapp.js',array('jquery'));
			// NXR LogoCarousel
			wp_register_script('nxr-vc-logocarousel',$this->js_dir.'owl.carousel.min.js',array('jquery'));
			// NXR Mouse Hover Direction
			wp_register_script('nxr-vc-hoverdir',$this->js_dir.'jquery.hoverdir.js',array('jquery'));
			wp_register_script('nxr-advimage',$this->js_dir.'nxr-advimage.js',array('jquery'));
			// NXR Minimal Form
			wp_register_script('nxr-vc-classie',$this->js_dir.'classie.js');
			wp_register_script('nxr-vc-stepsform',$this->js_dir.'stepsForm.js');
			// enqueue css files on frontend
			wp_enqueue_style('nxr-vc-fa-icons',$this->css_dir.'font-awesome.min.css');
			wp_enqueue_style('nxr-vc-outline-icons',$this->css_dir.'outline.min.css');
			// enqueue global css file for elements on frontend
			wp_register_style('nxr-vc-extender-style',$this->css_dir.'nxr-vc-extender-elements.min.css');
			wp_enqueue_style('nxr-vc-extender-style');
			// Morph Button
			wp_register_style('nxr-vc-morphbtn-general-css',$this->css_dir.'nxr_morphbtn_general.css');
			wp_register_style('nxr-vc-morphbtn-info-css',$this->css_dir.'nxr_morphbtn_info.css');
			//NXR CountDown
			wp_register_script('nxr-countdown_plugin',$this->js_dir.'countdown/jquery.plugin.min.js',array('jquery'));
			wp_register_script('nxr-countdown',$this->js_dir.'countdown/jquery.countdown.js',array('nxr-countdown_plugin'));
		}
		
		
		/*
			Register necessary js and css files on back-end
		*/
		function nxr_xtnd_admin_scripts(){
			wp_enqueue_style('nxr-xtnd-backend',$this->css_dir.'nxr_xtnd_backend.min.css');
			wp_enqueue_style('nxr-vc-fa-icons',$this->css_dir.'font-awesome.min.css');
			wp_enqueue_style('nxr-vc-outline-icons',$this->css_dir.'outline.min.css');
			wp_enqueue_script('media-upload');
			wp_enqueue_media();
		}
	}
	
	/*
		All good, fire up the plugin :)
	*/
	new NXR_XTND;
}