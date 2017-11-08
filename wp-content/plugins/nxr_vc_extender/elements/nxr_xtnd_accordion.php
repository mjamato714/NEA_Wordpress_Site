<?php
/*
* Add-on Name: NXR Accordion
* Add-on URI: http://nexarthemes.com/plugins/nexarthemes-extender/
* Since: 1.0
* Author: Eugen Petcu
* Update & Bug fixes: Bogdan Costescu
*/
if(!class_exists('NXR_VC_ACCORDION')) {
	class NXR_VC_ACCORDION extends WPBakeryShortCodesContainer {
		
		function __construct() {
			add_action('admin_init', array($this, 'add_nxr_accordion'));
			
			add_shortcode( 'nxr_accordion', array($this, 'nxr_accordion_master') );
			add_shortcode( 'nxr_accordion_element', array($this, 'nxr_accordion_element') );
		}
		
		/*
			Visual Composer mapping function
			Public API
			Refference:	http://kb.wpbakery.com/index.php?title=Vc_map
			Example:		http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
		*/
		function add_nxr_accordion() {
			if(function_exists('vc_map')) {
				/*
					Accordion: Parent element
				*/
				vc_map( array(
					   "name"						=>	__("NXR Accordion","nxrextender"),
					   "base"						=>	"nxr_accordion",
					   "class"						=>	"",
					   "icon"						=>	"nxr_accordion",
					   "category"					=>	__("NexarThemes Extender","nxrextender"),
					   "as_parent"					=>	array( 'only'	=>	'nxr_accordion_element' ),
					   "description"				=>	__("Accordion block","nxrextender"),
					   "content_element"			=>	true,
					   "show_settings_on_create"	=>	true,
					   "params" => array(
							array(
								"type" 			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Panels header background color:", "nxrextender"),
								"param_name"	=>	"acc_panel_color",
								"value"			=>	"#fff",
								"dependency"	=>	array( "not_empty" => true ),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Panels body background color:", "nxrextender"),
								"param_name"	=>	"acc_panelbody_color",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Panels header text color:", "nxrextender"),
								"param_name"	=>	"acc_panelheader_textcolor",
								"value"			=>	"#000",
								"dependency"	=>	array( "not_empty"	=>	true ),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Panels body text color:", "nxrextender"),
								"param_name"	=>	"acc_panelbody_textcolor",
								"value"			=>	"#000",
								"dependency"	=>	array( "not_empty" => true ),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Panel header height","nxrextender"),
								"param_name"	=>	"acc_panel_header_height",
								"value"			=>	"30",
								"description"	=>	__("Panel header height in pixels","nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Panel header roundness","nxrextender"),
								"param_name"	=>	"acc_panel_header_roundness",
								"value"			=>	"",
								"description"	=>	__("Panel header roundness in pixels. Example: 4","nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Extra class","nxrextender"),
								"param_name"	=>	"extra_class",
								"value"			=>	"",
								"description"	=>	__("Optional extra CSS class","nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Unique ID for this accordion","nxrextender"),
								"param_name"	=>	"acc_unique_id",
								"value"			=>	'accid'.mt_rand(999, 9999999),
								"description"	=>	__("Unique ID for this accordion, useful for extra CSS or JS customnization. This is auto-generated or you can enter your own.","nxrextender"),
								"dependency"	=>	array( "not_empty" => true ),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"heading",
								"sub_heading"	=>	__("This is a global setting page for the whole \"Accordion\" block. Add some \"Accordion elements (tabs)\" in the container row to make it complete.", "nxrextender"),
								"param_name"	=>	"notification",
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
					Accordion: Child element
				*/
				vc_map( array(
					   "name"				=>	__("Accordion element","nxrextender"),
					   "holder"				=>	"div",
					   "base"				=>	"nxr_accordion_element",
					   "class"				=>	"",
					   "icon"				=>	"",
					   "content_element"	=>	true,
					   "as_child"			=>	array( "only"	=>	"nxr_accordion" ),
					   "params"			=>	array(
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon type", "nxrextender"),
								"param_name"	=>	"nxr_accordion_icontype",
								"value"			=>	array(
										__( 'Font Icon Browser', 'nxrextender' ) 	=> 'selector',
										__( 'Custom Image Icon', 'nxrextender' )	=> 'custom',
									),
								"save_always" 	=> true,
								"description"	=>	__("Use an existing font icon or upload a custom image.", "nxrextender")
							),
							array(
								"type"			=>	"icon_browser",
								"class"			=>	"",
								"heading"		=>	__("Select Icon ","nxrextender"),
								"param_name"	=>	"nxr_accordion_icon",
								"value"			=>	"icon",
								"description"	=>	__("Click on an icon to select it.", "nxrextender"),
								"dependency"	=>	array(
									"element"		=>	"nxr_accordion_icontype",
									"value"			=>	array("selector")
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon color:", "nxrextender"),
								"description"	=>	__("Icon color","nxrextender"),
								"param_name"	=>	"acc_icon_color",
								"value"			=>	"#80c8ac",
								"dependency"	=>	array(
									"not_empty"	=>	true,
									"element"		=>	"nxr_accordion_icontype",
									"value"			=>	array( "selector" )
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Icon size", "nxrextender"),
								"param_name"	=>	"nxr_accordion_icnsize",
								"value"			=>	"",
								"description"	=>	__("Enter value in pixels, example: 30", "nxrextender"),
								"dependency"	=>	array(
									"element"		=>	"nxr_accordion_icontype",
									"value"			=>	array( "selector" )
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"attach_image",
								"class"			=>	"",
								"heading"		=>	__("Upload Image Icon:", "nxrextender"),
								"param_name"	=>	"nxr_accordion_img",
								"admin_label"	=>	true,
								"value"			=>	"",
								"description"	=>	__("Upload the custom image icon.", "nxrextender"),
								"dependency"	=>	array(
									"element"		=>	"nxr_accordion_icontype",
									"value"			=>	array( "custom" )
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Panel Title","nxrextender"),
								"param_name"	=>	"panel_title",
								"value"			=>	"Panel Title",
								"description"	=>	__("Provide a unique title for this panel","nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textarea_html",
								"class"			=>	"",
								"heading"		=>	__("Panel content","nxrextender"),
								"param_name"	=>	"content",
								"value"			=>	"Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
								"description"	=>	__("Content to be visible when proper tab is selected","nxrextender"),
								"save_always" 	=>	true,
							),
					   )
					) 
				);
			}
		}
		
		
		function nxr_accordion_master($atts, $content = null ) {
			/*
				Include required JS and CSS files
			*/
			wp_enqueue_script('jquery-ui-accordion');
			
			/*
				 Empty vars declaration
			*/
			$output = $acc_panelheader_textcolor = $acc_panel_color = $acc_panelbody_color = $acc_panelbody_textcolor = $acc_panel_header_height = $acc_panel_header_roundness = $acc_unique_id = $extra_class = $css = '';
			$navs=array();
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'acc_panelheader_textcolor'		=>	'#80c8ac',
				'acc_panel_color'				=>	'',
				'acc_panelbody_color'			=>	'transparent',
				'acc_panelbody_textcolor'		=>	'',
				'acc_panel_header_height'		=>	'',
				'acc_panel_header_roundness'	=>	'0',
				'acc_unique_id'					=>	'accid'.mt_rand(999, 9999999),
				'extra_class'					=>	'',
				'css'							=>	'',
					
			), $atts));
			
			$GLOBALS['acc_unique_id'] = $acc_unique_id;
			
			/*
			* CSS - Design tab
			*/
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			
			$output .='<script type="text/javascript">
						jQuery(document).ready(function() {
							
							// activate first tab
							jQuery("'.(!empty($acc_unique_id) ? '#'.$acc_unique_id : '.nxr_accordion').' .nxracc-title").first().find(".fa-plus").removeClass("fa-plus").addClass("fa-minus");
							
							// style the panel
							jQuery("'.(!empty($acc_unique_id) ? '#'.$acc_unique_id : '.nxr_accordion').' .panel").css("border-radius","'.$acc_panel_header_roundness.'").css("background-color","'.$acc_panelbody_color.'");
							
							// style the panel header
							jQuery("'.(!empty($acc_unique_id) ? '#'.$acc_unique_id : '.nxr_accordion').' .nxracc-title").css("border-top-right-radius","'.$acc_panel_header_roundness.'").css("border-top-left-radius","'.$acc_panel_header_roundness.'");
							jQuery("'.(!empty($acc_unique_id) ? '#'.$acc_unique_id : '.nxr_accordion').' .nxracc-title").css("background-color","'.$acc_panel_color.'").css("height","'.$acc_panel_header_height.'");
							jQuery("'.(!empty($acc_unique_id) ? '#'.$acc_unique_id : '.nxr_accordion').' .nxracc-title").css("padding-top","0px").css("padding-bottom","0px");
							jQuery("'.(!empty($acc_unique_id) ? '#'.$acc_unique_id : '.nxr_accordion').' .nxracc-title a").css("color","'.$acc_panelheader_textcolor.'");
							
							// style the panel title
							jQuery("'.(!empty($acc_unique_id) ? '#'.$acc_unique_id : '.nxr_accordion').' .nxracc-title").css("line-height","'.$acc_panel_header_height.'px");
							jQuery("'.(!empty($acc_unique_id) ? '#'.$acc_unique_id : '.nxr_accordion').' .nxracc-title a").css("display","block");
							
							// style the panel title icon
							jQuery("'.(!empty($acc_unique_id) ? '#'.$acc_unique_id : '.nxr_accordion').' .nxracc-title .icon").css("margin-right","20px").css("line-height","inherit");
							
							// style the panel body
							jQuery("'.(!empty($acc_unique_id) ? '#'.$acc_unique_id : '.nxr_accordion').' .nxracc-body").css("background-color","'.$acc_panelbody_color.'").css("color","'.$acc_panelbody_textcolor.'");
							
							jQuery( "'.(!empty($acc_unique_id) ? '#'.$acc_unique_id : '.nxr_accordion').'" ).accordion();

						});
						</script>';
			
			$output .= '<div class="nxr_accordion '.(!empty($extra_class) ? $extra_class : '').' ' . esc_attr( $css_class ) . '" id="'.(!empty($acc_unique_id) ? $acc_unique_id : '').'">';
				$output .= do_shortcode($content);
			$output .= '</div>';
						
			return $output;
		}
		
		function nxr_accordion_element($atts, $content = null) {
			$output = $nxr_accordion_icontype = $nxr_accordion_icon = $acc_icon_color = $nxr_accordion_icnsize = $nxr_accordion_img = $panel_title = $panel_body = '';
		
			extract(shortcode_atts(array(
				'nxr_accordion_icontype'=>	'',
				'nxr_accordion_icon'	=>	'',
				'acc_icon_color'		=>	'',
				'nxr_accordion_icnsize'	=>	'',
				'nxr_accordion_img'		=>	'',
				'panel_title'			=>	'',
				'panel_body'				=>	'',
				
			), $atts));
			
			
			if( $nxr_accordion_icontype == 'selector' && !empty($nxr_accordion_icon) ) {
				$do_icon = do_shortcode('[icon name="'.$nxr_accordion_icon.'" size="'.$nxr_accordion_icnsize.'px" height="'.$nxr_accordion_icnsize.'px" color="'.$acc_icon_color.'"]');
			}
			elseif($nxr_accordion_icontype == 'custom' && !empty($nxr_accordion_img)){
				// image type icon TO DO
				$nxr_accordion_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $nxr_accordion_img, 'thumb_size' => 'full', 'class' => "nxr_accordion_imgicon" ) );
				$do_icon = $nxr_accordion_img_array['thumbnail'];
			}else{
				$do_icon = '';
			}

			$output .='<h4 class="nxracc-title">
							<a data-toggle="collapse" data-parent="#'.$GLOBALS['acc_unique_id'].'" href="#tabid'.strtolower(md5($panel_title)).'">'.$do_icon.$panel_title.'</a>
						  </h4>
					<div class="nxracc-body">'.wpb_js_remove_wpautop($content, true).'</div>';
			
			return $output;
		}
	}
	new NXR_VC_ACCORDION;
}


if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_nxr_accordion extends WPBakeryShortCodesContainer {
	}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_nxr_accordion_element extends WPBakeryShortCode {
	}
}