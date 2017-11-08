<?php
/*
* Add-on Name: Advanced Image
* Add-on URI: http://nexarthemes.com/plugins/nexarthemes-extender/
* Since: 1.0
* Author: Eugen Petcu
*/
if(!class_exists('NXR_VC_ADVIMAGE')) {
	class NXR_VC_ADVIMAGE extends WPBakeryShortCode {

		function __construct() {
			add_action('admin_init', array($this, 'nxr_advimage_init'));
			add_shortcode( 'nxr_advimage', array($this, 'nxr_advimage') );
		}
		
		/*
			Visual Composer mapping function
			Public API
			Refference:	http://kb.wpbakery.com/index.php?title=Vc_map
			Example:	http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
		*/
		function nxr_advimage_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"				=>	__("NXR Advanced Image", "nxrextender"),
					   "holder"				=>	"div",
					   "base"				=>	"nxr_advimage",
					   "class"				=>	"",
					   "icon"				=>	"nxr_advimage",
					   "description"		=>	__("Image with advanced parameters", "nxrextender"),
					   "category"			=>	__("NexarThemes Extender", "nxrextender"),
					   "content_element"	=>	true,
					   "params"				=>	array(
					   		array(
								"type"			=>	"attach_image",
								"class"			=>	"",
								"heading"		=>	__("Image Upload", "nxrextender"),
								"param_name"	=>	"nxr_advimage_image",
								"admin_label"	=>	true,
								"value"			=>	"",
								"description"	=>	__("Upload or select image to use", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Element height:", "nxrextender"),
								"description"	=>	__("Element height. Numeric values only, in pixels. Width will be 100% of column.", "nxrextender"),
								"param_name"	=>	"nxr_advimage_height",
								"value"			=>	"250",
								"save_always" 	=>	true,
							),
							array(
								 "type"			=>	"textarea",
								 "class"		=>	"",
								 "heading"		=>	__("Title:","nxrextender"),
								 "param_name"	=>	"nxr_advimage_title",
								 "value"		=>	"",
								 "description"	=>	__("Element title is always displayed over the image.","nxrextender"),
								 "save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Title bottom padding:", "nxrextender"),
								"description"	=>	__("Use it to lift title into element.", "nxrextender"),
								"param_name"	=>	"nxr_advimage_title_padding",
								"value"			=>	"250",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("HTML tag tor title:", "nxrextender"),
								"param_name"	=>	"nxr_advimage_title_h",
								"value"			=>	array(
										"H1"	=>	"h1",
										"H2"	=>	"h2",
										"H3"	=>	"h3",
										"H4"	=>	"h4",
										"H5"	=>	"h5",
										"H6"	=>	"h6",
									),
								"std"			=>	"h2",
								"save_always" 	=>	true,
							),
							array(
								 "type"			=>	"textarea_html",
								 "class"		=>	"",
								 "heading"		=>	__("Description:","nxrextender"),
								 "param_name"	=>	"content",
								 "value"		=>	__( "<p>I am test text block. Click edit button to change this text.</p>", "nxrextender" ),
								 "description"	=>	__("Insert the content to be displayed on image hover.","nxrextender"),
								 "save_always" 	=>	true,
							),
							
							// Normal state
						   array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Title color (normal state):", "nxrextender"),
								"param_name"	=>	"nxr_advimage_title_color",
								"value"			=>	"",
								"description"	=>	__("Select title color for normal state.", "nxrextender"),
								"save_always" 	=>	true,					
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Description color:", "nxrextender"),
								"param_name"	=>	"nxr_advimage_description_color",
								"value"			=>	"",
								"description"	=>	__("Select description color.", "nxrextender"),
								"save_always" 	=>	true,					
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Overlay color (normal state):", "nxrextender"),
								"param_name"	=>	"nxr_advimage_overlay_color",
								"value"			=>	"",
								"description"	=>	__("Select overlay color (normal state)", "nxrextender"),
								"save_always" 	=>	true,					
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Border width (normal state):", "nxrextender"),
								"description"	=>	__("Numeric values only, in pixels.", "nxrextender"),
								"param_name"	=>	"nxr_advimage_border_width",
								"value"			=>	"10",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Border color (normal state):", "nxrextender"),
								"param_name"	=>	"nxr_advimage_border_color",
								"value"			=>	"",
								"description"	=>	__("Select border color (normal state)", "nxrextender"),
								"save_always" 	=>	true,					
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Border radius (normal state):", "nxrextender"),
								"description"	=>	__("Numeric values only, in pixels.", "nxrextender"),
								"param_name"	=>	"nxr_advimage_border_radius",
								"value"			=>	"0",
								"save_always" 	=>	true,
							),
							// Hover state
						   array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Title color (hover state):", "nxrextender"),
								"param_name"	=>	"nxr_advimage_title_color_hover",
								"value"			=>	"",
								"description"	=>	__("Select title color for hover state.", "nxrextender"),
								"save_always" 	=>	true,					
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Overlay color (hover state):", "nxrextender"),
								"param_name"	=>	"nxr_advimage_overlay_color_hover",
								"value"			=>	"",
								"description"	=>	__("Select overlay color (hover state)", "nxrextender"),
								"save_always" 	=>	true,					
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Border width (hover state):", "nxrextender"),
								"description"	=>	__("Numeric values only, in pixels.", "nxrextender"),
								"param_name"	=>	"nxr_advimage_border_width_hover",
								"value"			=>	"10",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Border color (hover state):", "nxrextender"),
								"param_name"	=>	"nxr_advimage_border_color_hover",
								"value"			=>	"",
								"description"	=>	__("Select border color (hover state)", "nxrextender"),
								"save_always" 	=>	true,					
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Border radius (hover state):", "nxrextender"),
								"description"	=>	__("Numeric values only, in pixels.", "nxrextender"),
								"param_name"	=>	"nxr_advimage_border_radius_hover",
								"value"			=>	"0",
								"save_always" 	=>	true,
							),
							array(
								'type' => 'css_editor',
								'heading' => __( 'Css', 'nxrextender' ),
								'param_name' => 'css',
								'group' => __( 'Design options', 'nxrextender' ),
							),
					   )
					) 
				);
			}
		}
		
		function nxr_advimage ($atts, $content = null) {
			/*
				Include required JS and CSS files
			*/
			//wp_enqueue_script('nxr-vc-hoverdir');
			wp_enqueue_script('nxr-advimage');
			
			/*
				 Empty vars declaration
			*/
			$output = $nxr_advimage_image = $nxr_advimage_height = $nxr_advimage_title = $nxr_advimage_title_padding = $nxr_advimage_title_h = $nxr_advimage_title_color = $nxr_advimage_overlay_color = $nxr_advimage_border_width = $nxr_advimage_border_color = $nxr_advimage_border_radius = $nxr_advimage_title_color_hover = $nxr_advimage_description_color = $nxr_advimage_overlay_color_hover = $nxr_advimage_border_width_hover = $nxr_advimage_border_color_hover = $nxr_advimage_border_radius_hover = $css = '';
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'nxr_advimage_image'					=>	'',
				'nxr_advimage_height'					=>	'250',
				'nxr_advimage_title'					=>	'#999',
				'nxr_advimage_title_padding'			=>	'20',
				'nxr_advimage_title_h'					=>	'h2',
				'nxr_advimage_title_color'				=>	'#999',
				'nxr_advimage_overlay_color'			=>	'#fff',
				'nxr_advimage_border_width'				=>	'10',
				'nxr_advimage_border_color'				=>	'#fff',
				'nxr_advimage_border_radius'			=>	'0',
				'nxr_advimage_title_color_hover'		=>	'#fff',
				'nxr_advimage_description_color'		=>	'#fff',
				'nxr_advimage_overlay_color_hover'		=>	'#fff',
				'nxr_advimage_border_width_hover'		=>	'10',
				'nxr_advimage_border_color_hover'		=>	'#fff',
				'nxr_advimage_border_radius_hover'		=>	'0',
				'css'									=>	''
			), $atts));
			
			$src = wp_get_attachment_image_src( $nxr_advimage_image, array( 5600,1000 ), false, '' );
			// Use: $src[0]
			
			/*
			* CSS - Design tab
			*/
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			$uniqueID = "nxr_advImage_".mt_rand(999, 9999999);
			
			$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
			
			$output .='
				<style>
				#'.$uniqueID.'.nxr_advimage{
					border: '.$nxr_advimage_border_width.'px solid '.$nxr_advimage_border_color.';
					border-radius: '.$nxr_advimage_border_radius.'px;
					width:100%;
					height:'.$nxr_advimage_height.'px;
					overflow:hidden;
					-webkit-background-size: cover;
					-moz-background-size: cover;
					-o-background-size: cover;
					background-size: cover;
					box-sizing: border-box;
				}
				#'.$uniqueID.'.nxr_advimage:hover{
					border: '.$nxr_advimage_border_width_hover.'px solid '.$nxr_advimage_border_color_hover.';
					border-radius: '.$nxr_advimage_border_radius_hover.'px;
				}
				
				#'.$uniqueID.'.nxr_advimage div.nxr_advimage_overlay{
					background-color: '.$nxr_advimage_overlay_color.';
					transition: background-color 0.5s ease;
					box-sizing: border-box;
					width:100%;
					height:'.$nxr_advimage_height.'px;
				}
				#'.$uniqueID.'.nxr_advimage:hover > div.nxr_advimage_overlay{
					background-color: '.$nxr_advimage_overlay_color_hover.';
				}
				
				#'.$uniqueID.'.nxr_advimage div.nxr_advimage_overlay .nxr_advimage_elements_container{
					transform:translateY( calc('.$nxr_advimage_height.'px) );
					box-sizing: border-box;
					transition: transform 0.2s ease;
					width:100%;
					height:auto;
				}
				
				
				
				#'.$uniqueID.'.nxr_advimage .nxr-advimage-title{
					box-sizing: border-box;
					padding-bottom:'.$nxr_advimage_title_padding.'px;
					color: '.$nxr_advimage_title_color.'!important;
					transition: color 0.2s ease;
					margin:0;
					line-height:1;
				}
				#'.$uniqueID.' .nxr_advimage_overlay:hover .nxr_advimage_elements_container > .nxr-advimage-title{
					color: '.$nxr_advimage_title_color_hover.'!important;
				}
				
				#'.$uniqueID.' .nxr-advimage-description{
					color: '.$nxr_advimage_description_color.'!important;
				}
				#'.$uniqueID.' .nxr_advimage_overlay:hover .nxr_advimage_elements_container > .nxr-advimage-description{
					color: '.$nxr_advimage_description_color.'!important;
				}
				
				
				
				
				</style>
			';
			
			$output	.=	'<div id="'.$uniqueID.'" class="nxr_advimage" style="background:url('.$src[0].') no-repeat center center;">';
			$output .=	'<div class="nxr_advimage_overlay">';
				$output .=	'<div class="nxr_advimage_elements_container ' . esc_attr( $css_class ) . '">';
					$output .=	'<'.$nxr_advimage_title_h.' class="nxr-advimage-title">'.$nxr_advimage_title.'</'.$nxr_advimage_title_h.'>';
					$output .=	'<span class="nxr-advimage-description">'.$content.'</span>';
				$output .=	'</div>';
			$output .=	'</div>';
			$output	.=	'</div>';
						
			return $output;
		}
	}
	new NXR_VC_ADVIMAGE;
}