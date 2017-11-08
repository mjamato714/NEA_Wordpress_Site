<?php
/*
* Add-on Name: Counter
* Add-on URI: http://nexarthemes.com/plugins/nexarthemes-extender/
* Since: 1.0
* Author: Eugen Petcu
* Update & Bug fixes: Bogdan Costescu
*/
if(!class_exists('NXR_VC_COUNTER')) {
	class NXR_VC_COUNTER extends WPBakeryShortCode {
		
		function __construct() {
			add_action('admin_init', array($this, 'nxr_counter_init'));
			
			add_shortcode( 'nxr_counter', array($this, 'nxr_counter') );
			
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
		function nxr_counter_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"				=>	__("NXR Counter", "nxrextender"),
					   "holder"				=>	"div",
					   "base"				=>	"nxr_counter",
					   "class"				=>	"",
					   "icon"				=>	"nxr_counter",
					   "description"		=>	__("Animated counters", "nxrextender"),
					   "category"			=>	__("NexarThemes Extender", "nxrextender"),
					   "content_element"	=>	true,
					   "params"				=>	array(
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon to display:", "nxrextender"),
								"description"	=>	__("Use an existing font icon or upload a custom image.", "nxrextender"),
								"param_name"	=>	"icon_type",
								"value"			=>	array(
										__( 'Font Icon Browser', 'nxrextender' ) => 'selector',
										__( 'Custom Image Icon', 'nxrextender' ) => 'custom',
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"icon_browser",
								"class"			=>	"",
								"heading"		=>	__("Select Icon ","nxrextender"),
								"param_name"	=>	"icon",
								"value"			=>	"",
								"dependency"	=>	array(
										"element"	=>	"icon_type",
										"value"		=>	array( "selector" )
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"attach_image",
								"class"			=>	"",
								"heading"		=>	__("Upload Image Icon:", "nxrextender"),
								"param_name"	=>	"icon_img",
								"admin_label"	=>	true,
								"value"			=>	"",
								"description"	=>	__("Upload the custom image icon.", "nxrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_type",
										"value"		=>	array( "custom" ),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Image Width", "nxrextender"),
								"param_name"	=>	"img_width",
								"value"			=>	48,
								"min"			=>	16,
								"max"			=>	512,
								"suffix"		=>	"px",
								"description"	=>	__("Provide image width.", "nxrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_type",
										"value"		=>	array( "custom" ),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Icon Size:","nxrextender"),
								"param_name"	=>	"counter_icon_size",
								"value"			=>	32,
								"min"			=>	12,
								"max"			=>	72,
								"suffix"		=>	"px",
								"description"	=>	__("Set the icon size.", "nxrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_type",
										"value"		=>	array( "selector" ),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon Color:", "nxrextender"),
								"param_name"	=>	"counter_icon_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a color for your icon.", "nxrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_type",
										"value"		=>	array( "selector" ),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon position:", "nxrextender"),
								"description"	=>	__("Select icon position.","nxrextender"),
								"param_name"	=>	"counter_icon_position",
								"value"			=>	array(
										"Left"			=>	"icon-left",
										"Top"			=>	"icon-top",
										"Right"			=>	"icon-right",
										"Bottom"		=>	"icon-bottom",
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Counter Number:","nxrextender"),
								"description"	=>	__("Count from 1 to this number.", "nxrextender"),
								"param_name"	=>	"counter_number",
								"value"			=>	100,
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Counter Number HTML Format", "nxrextender"),
								"param_name"	=>	"counter_number_format",
								"value"			=>	array(
									__( 'H1', 'nxrextender' ) => 'h1',
									__( 'H2', 'nxrextender' ) => 'h2',
									__( 'H3', 'nxrextender' ) => 'h3',
									__( 'H4', 'nxrextender' ) => 'h4',
									__( 'H5', 'nxrextender' ) => 'h5',
									__( 'H6', 'nxrextender' ) => 'h6',
								),
								"std"			=>	"h2",
								"save_always"	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Counter Number Color:", "nxrextender"),
								"param_name"	=>	"counter_number_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a color.", "nxrextender"),	
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Counter Units:","nxrextender"),
								"param_name"	=>	"counter_units",
								"value"			=>	"",
								"description"	=>	__("Ex: cups, lines of code, projects.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Counter Units Color:", "nxrextender"),
								"param_name"	=>	"counter_units_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a color.", "nxrextender"),	
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Counter Text:","nxrextender"),
								"param_name"	=>	"counter_text",
								"value"			=>	"",
								"description"	=>	__("Ex: of coffee (cups), written (lines of code), delivered (projects).", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Counter text HTML Format", "nxrextender"),
								"param_name"	=>	"counter_text_format",
								"value"			=>	array(
									__( 'H1', 'nxrextender' ) => 'h1',
									__( 'H2', 'nxrextender' ) => 'h2',
									__( 'H3', 'nxrextender' ) => 'h3',
									__( 'H4', 'nxrextender' ) => 'h4',
									__( 'H5', 'nxrextender' ) => 'h5',
									__( 'H6', 'nxrextender' ) => 'h6',
								),
								"std"			=>	"h3",
								"save_always"	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Counter Text Color:", "nxrextender"),
								"param_name"	=>	"counter_text_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a color.", "nxrextender"),	
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Counter Speed:","nxrextender"),
								"param_name"	=>	"counter_speed",
								"value"			=>	5,
								"min"			=>	1,
								"max"			=>	10,
								"suffix"		=>	__("seconds", "nxrextender"),
								"description"	=>	__("Set counter speed. Default is 5 seconds.", "nxrextender"),
								"save_always" 	=>	true,
							),						
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Background Settings:", "nxrextender"),
								"param_name"	=>	"counter_background_settings",
								"value"			=>	array(
										"None"			=>	"none",
										"Select color"	=>	"custom-counter-background",
									),
								"description"	=>	__("Select background type.","nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Background Color:", "nxrextender"),
								"param_name"	=>	"counter_background_color",
								"value"			=>	"#0484c9",
								"description"	=>	__("Pick a background color.", "nxrextender"),
								"dependency"	=>	array(
										"element"	=>	"counter_background_settings",
										"value"		=>	array( "custom-counter-background" ),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Border Settings:", "nxrextender"),
								"param_name"	=>	"counter_border_settings",
								"value"			=>	array(
									"None"			=>	"none",
									"Custom border"	=>	"custom-counter-border",
								),
								"description"	=>	__("Select border type.","nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Border Width:", "nxrextender"),
								"param_name"	=>	"counter_border_width",
								"value"			=>	1,
								"min"			=>	1,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"counter_border_settings",
									"value"		=>	array( "custom-counter-border" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Border Color:", "nxrextender"),
								"param_name"	=>	"counter_border_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a border color.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"counter_border_settings",
									"value"		=>	array("custom-counter-border"),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Box Border Roundness:", "nxrextender"),
								"param_name"	=>	"counter_border_corner",
								"value"			=>	0,
								"min"			=>	0,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels, example: 0 for square, or 5 for rounded corners.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Extra class name","nxrextender"),
								"param_name"	=>	"extra_class",
								"value"			=>	"",
								"description"	=>	__("Add extra class name. You can use this class for your customizations.", "nxrextender"),
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
		
		function nxr_counter ($atts, $content = null) {
			/*
				Include required JS and CSS files
			*/
			wp_enqueue_script('nxr-vc-jquery-appear');
			wp_enqueue_script('nxr-vc-countto');
			
			/*
				 Empty vars declaration
			*/
			$output = $counter_id = $counter_bg = $counter_bd = $counter_number_format = $counter_text_format = $border_roundness = $nxr_counter_img_array = $icon_type = $icon = $icon_img = 
			$img_width = $counter_icon_size = $counter_icon_color = $counter_number = $counter_number_color = $counter_units = $counter_units_color = 
			$counter_speed = $counter_text = $counter_text_color = $counter_background_settings = $counter_background_color = $counter_border_settings = 
			$counter_border_width = $counter_border_color = $counter_border_corner = $extra_class = $do_icon = $css = '';
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'icon_type'							=>	'',
				'icon'								=>	'',
				'icon_img'							=>	'',
				'img_width'							=>	'',
				'counter_icon_size'					=>	'',
				'counter_icon_color'				=>	'',
				'counter_icon_position'				=>	'',
				'counter_number'					=>	'',
				'counter_number_format'				=>	'',
				'counter_text_format'				=>	'',
				'counter_number_color'				=>	'',
				'counter_units'						=>	'',
				'counter_units_color'				=>	'',
				'counter_speed'						=>	'',
				'counter_text'						=>	'',
				'counter_text_color'				=>	'',
				'counter_background_settings'		=>	'',
				'counter_background_color'			=>	'',
				'counter_border_settings'			=>	'',
				'counter_border_width'				=>	'',
				'counter_border_color'				=>	'',
				'counter_border_corner'				=>	'',
				'extra_class'						=>	'',
				'css'								=>	'',
			), $atts));
			
			
			
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			
			
			/*
				Font icon or Image icon?
			*/
			if( $icon_type == 'selector' && !empty($icon) ) {
				
				$do_icon = do_shortcode('[icon name="icon '.$icon.'" color="'.$counter_icon_color.'" size="'.$counter_icon_size.'px"]');
			}
			/*
				Image icon
			*/
			elseif($icon_type == 'custom' && !empty($icon_img)){
				$nxr_counter_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $icon_img, 'thumb_size' => 'full', 'class' => "" ) );
				$do_icon = '<div style="width:'.$img_width.'px;margin:auto;">'.$nxr_counter_img_array['thumbnail'].'</div>';
			}
			
			/*
				Border radius?
			*/
			if ( $counter_border_corner !== '0') {
			$border_roundness .= 'border-radius:'.$counter_border_corner.'px;-moz-border-radius:'.$counter_border_corner.'px;-webkit-border-radius:'.$counter_border_corner.'px;-o-border-radius:'.$counter_border_corner.'px;';
			}
			
			switch($counter_background_settings){
				case 'none':
					$counter_bg = 'background:none;';
				break;
				
				case 'custom-counter-background':
					$counter_bg = 'background-color:'.$counter_background_color.';';
				break;
				
				default:
			}
			
			switch($counter_border_settings){
				case 'none':
					$counter_bd = 'border:0px;';
				break;
				
				case 'custom-counter-border':
					$counter_bd = 'border:'.$counter_border_width.'px solid '.$counter_border_color.';';
				break;
				
				default:
			}
			
			$counter_id .= 'nxr-counter-'.uniqid();
			
			$js = '<script type="text/javascript">
						jQuery(document).ready(function() {
							jQuery(function($) {
								
								$(".'.$counter_id.'").appear(function() {
									$(this).countTo();
								});
							});
						});
					</script>';
				
			$output .= $js;
			
			switch($counter_icon_position){
			
				// Icon position left
				case 'icon-left':
					$output .= '<div class="nxr_counter ' . esc_attr( $css_class ) . ' '.(!empty($extra_class) ? $extra_class : '').'" style="'.$counter_bg.$counter_bd.$border_roundness.'">';
						$output .= '<div class="nxr_counter_row">';
							if(!empty($do_icon)) { 
								$output .= '<div class="nxr_counter_icon">';
								$output .= $do_icon; 
								$output .= '</div>';
							}
							$output .= '<div class="nxr_counter_content">';
								$output .= '<'.$counter_number_format.' class="nxr_counter_number">';
								$output .= '<span class="nxr_number_string '.$counter_id.'" style="color:'.$counter_number_color.'" data-from="0" data-to="'.$counter_number.'" data-speed="'.($counter_speed*1000).'" data-refresh-interval="50">0</span> <span class="nxr_counter_units" style="color:'.$counter_units_color.'">'.$counter_units.'</span>';
								$output .= '</'.$counter_number_format.'>';
								$output .= '<div class="nxr_counter_text"> <'.$counter_text_format.' style="color:'.$counter_text_color.'">'.$counter_text.'</'.$counter_text_format.'> </div>';
							$output .= '</div>';
						$output .= '</div> <!-- END .nxr_counter_row -->';
					$output .= '</div>';
				break;
				
				// Icon position top
				case 'icon-top':
					$output .= '<div class="nxr_counter ' . esc_attr( $css_class ) . ' '.(!empty($extra_class) ? $extra_class : '').'" style="'.$counter_bg.$counter_bd.$border_roundness.'">';
						if(!empty($do_icon)) { 
							$output .= '<div class="nxr_counter_icon" style="padding-bottom:2em;">';
							$output .= $do_icon; 
							$output .= '</div>';
						}
						$output .= '<div class="nxr_counter_content">';
							$output .= '<'.$counter_number_format.' class="nxr_counter_number">';
							$output .= '<span class="nxr_number_string '.$counter_id.'" style="color:'.$counter_number_color.'" data-from="0" data-to="'.$counter_number.'" data-speed="'.($counter_speed*1000).'" data-refresh-interval="50">0</span> <span class="nxr_counter_units" style="color:'.$counter_units_color.'">'.$counter_units.'</span>';
							$output .= '</'.$counter_number_format.'>';
							$output .= '<div class="nxr_counter_text"> <'.$counter_text_format.'  style="color:'.$counter_text_color.'">'.$counter_text.'</'.$counter_text_format.'> </div>';
						$output .= '</div>';
					$output .= '</div>';
				break;
				
				// Icon position right
				case 'icon-right':
					$output .= '<div class="nxr_counter ' . esc_attr( $css_class ) . ' '.(!empty($extra_class) ? $extra_class : '').'" style="'.$counter_bg.$counter_bd.$border_roundness.'">';
						$output .= '<div class="nxr_counter_row">';
							$output .= '<div class="nxr_counter_content">';
								$output .= '<'.$counter_number_format.' class="nxr_counter_number">';
								$output .= '<span class="nxr_number_string '.$counter_id.'" style="color:'.$counter_number_color.'" data-from="0" data-to="'.$counter_number.'" data-speed="'.($counter_speed*1000).'" data-refresh-interval="50">0</span> <span class="nxr_counter_units" style="color:'.$counter_units_color.'">'.$counter_units.'</span>';
								$output .= '</'.$counter_number_format.'>';
								$output .= '<div class="nxr_counter_text"> <'.$counter_text_format.' style="color:'.$counter_text_color.'">'.$counter_text.'</'.$counter_text_format.'> </div>';
							$output .= '</div>';
							if(!empty($do_icon)) { 
								$output .= '<div class="nxr_counter_icon">';
								$output .= $do_icon; 
								$output .= '</div>';
							}
						$output .= '</div> <!-- END .nxr_counter_row -->';
					$output .= '</div>';
				break;
				
				// Icon position bottom
				case 'icon-bottom':
					$output .= '<div class="nxr_counter ' . esc_attr( $css_class ) . ' '.(!empty($extra_class) ? $extra_class : '').'" style="'.$counter_bg.$counter_bd.$border_roundness.'">';
						$output .= '<div class="nxr_counter_content">';
							$output .= '<'.$counter_number_format.' class="nxr_counter_number">';
							$output .= '<span class="nxr_number_string '.$counter_id.'" style="color:'.$counter_number_color.'" data-from="0" data-to="'.$counter_number.'" data-speed="'.($counter_speed*1000).'" data-refresh-interval="50">0</span> <span class="nxr_counter_units" style="color:'.$counter_units_color.'">'.$counter_units.'</span>';
							$output .= '</'.$counter_number_format.'>';
							$output .= '<div class="nxr_counter_text"> <'.$counter_text_format.' style="color:'.$counter_text_color.'">'.$counter_text.'</'.$counter_text_format.'> </div>';
						$output .= '</div>';
						if(!empty($icon)) { 
							$output .= '<div class="nxr_counter_icon" style="padding-top:2em;">';
							$output .= $do_icon; 
							$output .= '</div>';
						}
					$output .= '</div>';
				break;
				
				default:
				$output .= '<div class="nxr_counter ' . esc_attr( $css_class ) . ' '.(!empty($extra_class) ? $extra_class : '').'" style="'.$counter_bg.$counter_bd.$border_roundness.'">';
					$output .= '<div class="nxr_counter_row">';
						if(!empty($do_icon)) { 
							$output .= '<div class="nxr_counter_icon">';
							$output .= $do_icon; 
							$output .= '</div>';
						}
						$output .= '<div class="nxr_counter_content">';
							$output .= '<'.$counter_number_format.' class="nxr_counter_number">';
							$output .= '<span class="nxr_number_string '.$counter_id.'" style="color:'.$counter_number_color.'" data-from="0" data-to="'.$counter_number.'" data-speed="'.($counter_speed*1000).'" data-refresh-interval="50">0</span> <span class="nxr_counter_units" style="color:'.$counter_units_color.'">'.$counter_units.'</span>';
							$output .= '</'.$counter_number_format.'>';
							$output .= '<div class="nxr_counter_text"> <'.$counter_text_format.' style="color:'.$counter_text_color.'">'.$counter_text.'</'.$counter_text_format.'> </div>';
						$output .= '</div>';
					$output .= '</div> <!-- END .nxr_counter_row -->';
				$output .= '</div>';
			}
			
			/*
				Return the output
			*/
			return $output;
		}
	}
	new NXR_VC_COUNTER;
}