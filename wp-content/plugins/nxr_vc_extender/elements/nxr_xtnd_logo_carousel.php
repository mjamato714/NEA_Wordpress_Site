<?php
/*
* Add-on Name: Logo Carousel
* Add-on URI: http://nexarthemes.com/plugins/nexarthemes-extender/
* Based on: www.owlgraphic.com/owlcarousel/
* Since: 1.0
* Author: Bogdan Costescu
*/
if(!class_exists('NXR_VC_LOGOCAROUSEL')) {
	class NXR_VC_LOGOCAROUSEL extends WPBakeryShortCodesContainer {

		function __construct() {
			add_action('admin_init', array($this, 'add_logocarousel'));
			
			add_shortcode( 'nxr_logocarousel', array($this, 'nxr_logocarousel') );
			
			add_shortcode( 'nxr_logocarousel_item', array($this, 'nxr_logocarousel_item') );
			
			/*
				Param type "number"
			*/ 
			if ( function_exists('vc_add_shortcode_param')){
				vc_add_shortcode_param('number' , array('NXR_XTND', 'make_number_input' ) );
			}
		}
		
		
		/*
			Visual Composer mapping function
			Public API
			Refference:	http://kb.wpbakery.com/index.php?title=Vc_map
			Example:		http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
		*/
		function add_logocarousel() {
			if(function_exists('vc_map')) {
				
				/*
					Parent element
				*/
				vc_map(
					array(
					   "name"						=>	__("NXR LogoCarousel", "nxrextender"),
					   "base"						=>	"nxr_logocarousel",
					   "class"						=>	"",
					   "icon"						=>	"nxr_logocarousel",
					   "category"					=>	__("NexarThemes Extender", "nxrextender"),
					   "as_parent"					=>	array( 'only' => 'nxr_logocarousel_item' ),
					   "description"				=>	__("Carousel block", "nxrextender"),
					   "content_element"			=>	true,
					   "show_settings_on_create"	=>	true,
					   "params"					=>	array(
							array(
								"type"				=>	"number",
								"class"				=>	"",
								"heading"			=>	__("Numer of logos displayed at a time with the widest browser width:", "nxrextender"),
								"param_name"		=>	"carousel_items_number_max",
								"value"				=>	5,
								"min"				=>	1,
								"max"				=>	50,
								"description"		=>	__("Logos displayed at a time with the widest browser width.", "nxrextender"),
								"save_always" 		=>	true,
							),
							array(
								"type"				=>	"number",
								"class"				=>	"",
								"heading"			=>	__("Number of logos displayed for desktop window size (< 1200px):", "nxrextender"),
								"param_name"		=>	"carousel_items_number_desktop",
								"value"				=>	4,
								"min"				=>	1,
								"max"				=>	40,
								"description"		=>	__("Logos displayed at a time for desktop window size.", "nxrextender"),
								"save_always" 		=>	true,
							),
							array(
								"type"				=>	"number",
								"class"				=>	"",
								"heading"			=>	__("Number of logos displayed for desktop small window size (< 980px):", "nxrextender"),
								"param_name"		=>	"carousel_items_number_desktop_small",
								"value"				=>	3,
								"min"				=>	1,
								"max"				=>	30,
								"description"		=>	__("Logos displayed at a time for desktop small window size.", "nxrextender"),
								"save_always" 		=>	true,
							),
							array(
								"type"				=>	"number",
								"class"				=>	"",
								"heading"			=>	__("Number of logos displayed for tablet window size (< 769px):", "nxrextender"),
								"param_name"		=>	"carousel_items_number_tablet",
								"value"				=>	2,
								"min"				=>	1,
								"max"				=>	20,
								"description"		=>	__("Logos displayed at a time for desktop small window size.", "nxrextender"),
								"save_always" 		=>	true,
							),
							array(
								"type"				=>	"checkbox",
								"heading"			=>	__("Auto play scrooling:", "nxrextender"),
								"param_name"		=>	"carousel_autoplay",
								"description"		=>	__("If checked this will set the carousel to scroll every 5 seconds.", "nxrextender"),
								"value"				=>	array( esc_html__("Yes, please", "nxrextender") => 'yes' ),
								"save_always" 		=>	true,
							),
							array(
								"type"				=>	"checkbox",
								"class"				=>	"",
								"heading"			=>	__("Display pagination dots:", "nxrextender"),
								"param_name"		=>	"display_pagination",
								"value"				=>	array( esc_html__("Yes, please", "nxrextender") => 'yes' ),
								"save_always" 		=> true,
								"description"		=>	__("Would you like to display pagination dots?", "nxrextender"),
							),
							array(
								 "type"				=>	"textfield",
								 "class"			=>	"",
								 "heading"			=>	__("Extra class:", "nxrextender"),
								 "param_name"		=>	"carousel_extra_class",
								 "value"			=>	"",
								 "description"		=>	__("Add extra class name. You can use this class for your customizations.", "nxrextender"),
								 "save_always" 		=>	true,
							),
							array(
								"type"				=>	"heading",
								"sub_heading"		=>	"This is a global setting page for the whole \"Carousel\" block. Add some \"Carousel Items\" in the container row to make it complete.",
								"param_name"		=>	"notification",
							),
							array(
								'type' => 'css_editor',
								'heading' => __( 'Css', 'nxrextender' ),
								'param_name' => 'css',
								'group' => __( 'Design options', 'nxrextender' ),
							),
						),
						"js_view" => 'VcColumnView'
				));
					
				/*
					Child element
				*/
				vc_map(
					array(
					   "name"						=>	__("Carousel item", "nxrextender"),
					   "holder"						=>	"div",
					   "base"						=>	"nxr_logocarousel_item",
					   "class"						=>	"",
					   "icon"						=>	"",
					   "content_element"			=>	true,
					   "as_child"					=>	array(
					   			"only"				=>	"nxr_logocarousel"
							),
					   "params"						=>	array(
							array(
								"type"				=>	"attach_image",
								"class"				=>	"",
								"heading"			=>	__("Logo image:", "nxrextender"),
								"param_name"		=>	"item_image",
								"admin_label"		=>	true,
								"value"				=>	"",
								"description"		=>	__("Upload carousel item logo image.", "nxrextender"),
								"save_always" 		=>	true,
							),
							array(
								"type"				=>	"dropdown",
								"class"				=>	"",
								"heading"			=>	__("Link text settings:", "nxrextender"),
								"param_name"		=>	"item_link_settings",
								"value"				=>	array(
										__( 'No Link', 'nxrextender' )	=> 'link-off',
										__( 'Add link', 'nxrextender' )	=> 'link-on',
									),
								"save_always" 		=> true,
								"description"		=>	__("You can add / remove custom link for logo image.", "nxrextender"),
							),
							array(
								"type"				=>	"vc_link",
								"class"				=>	"",
								"heading"			=>	__("Link to:","nxrextender"),
								"param_name"		=>	"item_link",
								"value"				=>	"",
								"description"		=>	__("Set a link to this logo image.","nxrextender"),
								"dependency"		=>	array(
										"element"	=>	"item_link_settings",
										"value"		=>	array( "link-on" ),
									),
								"save_always" 		=>	true,
							),
					    )
					) 
				);
			}
		}
		
		function nxr_logocarousel($atts, $content = null ) {
		wp_enqueue_script('nxr-vc-logocarousel');
		
		/*
			 Empty vars declaration
		*/
		$output = $carousel_items_number_max = $carousel_items_number_desktop = $display_pagination = $carousel_items_number_desktop_small = 
		$carousel_items_number_tablet = $carousel_autoplay = $carousel_extra_class = $carousel_ap = $css = '';
		
		
		/*
			WordPress function to extract shortcodes attributes
			Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
		*/
		extract(shortcode_atts(array(
			'carousel_items_number_max'				=> '',
			'carousel_items_number_desktop'			=> '', 
			'carousel_items_number_desktop_small'	=> '',
			'carousel_items_number_tablet'			=> '',
			'carousel_autoplay'						=> '',
			'display_pagination'					=> '',
			'carousel_extra_class'					=> '',
			'css'									=> ''
		), $atts));
		
		//$GLOBALS['logcarid_unique_id'] = $carousel_unique_id;
		
		$carousel_unique_id = 'nxr-logocarousel_'.mt_rand(999, 9999999);
		
		
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
		
		
		/*
			Auto-play or not?!
		*/
		$carousel_ap = 'false';
		if($carousel_autoplay == 'yes') {
			$carousel_ap = 'true';
		}
		
		$dots = 'false';
		if($display_pagination == 'yes') {
			$dots = 'true';
		}
		
		$output .= '<script>
			jQuery(document).ready(function() {

				var nxr_logocarousel = jQuery("#'.$carousel_unique_id.'");
			 
				nxr_logocarousel.owlCarousel({
					items : '.$carousel_items_number_max.',
					itemsDesktop : [1199,'.$carousel_items_number_desktop.'],
					itemsDesktopSmall : [979,'.$carousel_items_number_desktop_small.'],
					itemsTablet: [768,'.$carousel_items_number_tablet.'],
					itemsMobile : [479,1],
					
					//Autoplay
					autoPlay : '.$carousel_ap.',
					stopOnHover : true,
					pagination: '.$dots.'
				});
		 
			});
		</script>';
		
		$output .= '<div id="'.$carousel_unique_id.'" class="owl-carousel '.$carousel_extra_class.' ' . esc_attr( $css_class ) . '">';
			$output .= do_shortcode($content);
		$output .= '</div>';
		
		/*
			Return the output
		*/
		return $output;
	}
	
		function nxr_logocarousel_item($atts,$content = null) {
		
		/*
			 Empty vars declaration
		*/
		$output = $item_image = $item_link_settings = $item_link = '';
		
		
		/*
			WordPress function to extract shortcodes attributes
			Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
		*/
		extract(shortcode_atts(array(
			'item_image'			=>	'',
			'item_link_settings'	=>	'', 
			'item_link'			=>	'',
		), $atts));
		
		/*
			Get the image...
		*/
		$logocarousel_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $item_image, 'thumb_size' => 'full', 'class' => "" ) );

		$output .= '<div class="nxr_carousel_item" style="text-align:center;">';
		switch($item_link_settings){
			case 'link-off':
				$output .= $logocarousel_img_array['thumbnail'];
			break;
			
			case 'link-on':
				$href = vc_build_link($item_link);
				if($href['url'] !== '') {
					$link_target = (isset($href['target'])) ? ' target="'.$href['target'].'"' : '';
					$link_title = (isset($href['title'])) ? ' title="'.$href['title'].'"' : '';
				}
				$output .= '<a href="'.$href['url'].'"'.$link_target.''.$link_title.' class="hoverzoom">';
				$output .= $logocarousel_img_array['thumbnail'];
				$output .= '</a>';
			break;
		}
		$output .= '</div>';
		
		/*
			Return the output
		*/
		return $output;
	}
	}
	
	new NXR_VC_LOGOCAROUSEL;
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_nxr_logocarousel extends WPBakeryShortCodesContainer {
	}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_nxr_logocarousel_item extends WPBakeryShortCode {
	}
}