<?php
/*
* Add-on Name: Zoom Box
* Add-on URI: http://nexarthemes.com/plugins/nexarthemes-extender/
* Since: 1.0
* Add-on Author: Bogdan Costescu
*/
if(!class_exists('NXR_VC_ZOOMBOX')) {
	class NXR_VC_ZOOMBOX extends WPBakeryShortCode {

		function __construct() {
			add_action('admin_init', array($this, 'nxr_zoombox_init'));
			
			add_shortcode('nxr_zoom_box', array($this, 'nxr_zoombox') );
			
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
		function nxr_zoombox_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
						"name"			=>	__("NXR ZoomBox", "nxrextender"),
						"base"			=>	"nxr_zoom_box",
						"class"			=>	"",
						"icon"			=>	"nxr_zoom_box",
						"category"		=>	__("NexarThemes Extender", "nxrextender"),
						"description"	=>	__("ZoomBox - two sided box", "nxrextender"),
						"params"		=>	array(
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Display icon:","nxrextender"),
								"param_name"	=>	"icon_type",
								"value"			=>	array(
									__( 'Font Icon Browser', 'nxrextender' )	=> 'selector',
									__( 'Custom Image Icon', 'nxrextender' )	=> 'custom-icon',
									__( 'None', 'nxrextender' ) 				=> 'none',
								),
								"save_always" 	=>	true,
								"description"	=>	__("Select icon source.", "nxrextender")
							),
							array(
								"type"			=>	"icon_browser",
								"class"			=>	"",
								"heading"		=>	__("Select Icon:","nxrextender"),
								"param_name"	=>	"icon",
								"value"			=>	"",
								"description"	=>	__("Click on an icon to select it.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"icon_type",
									"value"		=>	array("selector"),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Icon Size:", "nxrextender"),
								"param_name"	=>	"icon_size",
								"value"			=>	32,
								"min"			=>	12,
								"max"			=>	72,
								"suffix"		=>	"px",
								"description"	=>	__("Set the icon size.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"icon_type",
									"value"		=>	array("selector"),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon Color:", "nxrextender"),
								"param_name"	=>	"icon_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a color for your icon.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"icon_type",
									"value"		=>	array("selector"),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"attach_image",
								"class"			=>	"",
								"heading"		=>	__("Upload image icon:", "nxrextender"),
								"param_name"	=>	"icon_img",
								"admin_label"	=>	true,
								"value"			=>	"",
								"description"	=>	__("Upload the custom image icon.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"icon_type",
									"value"		=>	array( "custom-icon" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Image width:", "nxrextender"),
								"param_name"	=>	"img_width",
								"value"			=>	48,
								"min"			=>	16,
								"max"			=>	512,
								"suffix"		=>	"px",
								"description"	=>	__("Provide image width.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"icon_type",
									"value"		=>	array( "custom-icon" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Front Title text:", "nxrextender"),
								"param_name"	=>	"front_title",
								"value"			=>	"Fast customization",
								"description"	=>	__("Title for the front view.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Front Title color:", "nxrextender"),
								"param_name"	=>	"front_title_color",
								"value"			=>	"#222222",
								"description"	=>	__("Color of front title text.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Front Description text:","nxrextender"),
								 "param_name"	=>	"front_desc",
								 "value"		=>	"Using the visual editor has never been easier.",
								 "description"	=>	__("Insert front description here.", "nxrextender"),
								 "save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Front Description color:", "nxrextender"),
								"param_name"	=>	"front_desc_color",
								"value"			=>	"#8d8d8d",
								"description"	=>	__("Color of front description text.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Front Background type:", "nxrextender"),
								"param_name"	=>	"front_background_type",
								"value"			=>	array(
									__( 'Custom settings', 'nxrextender' )	=> 'custom-front-background',
									__( 'None', 'nxrextender' )				=> 'none',
								),
								"save_always" 	=>	true,
								"description"	=>	__("Select background type for front panel.","nxrextender"),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Front Background color:", "nxrextender"),
								"param_name"	=>	"front_background_color",
								"value"			=>	"#ffffff",
								"description"	=>	__("Pick a background color for front panel.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"front_background_type",
									"value"		=>	array("custom-front-background"),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Front Background opacity:", "nxrextender"),
								"param_name"	=>	"front_background_opacity",
								"value"			=>	1,
								"min"			=>	0.1,
								"max"			=>	1,
								"description"	=>	__("Front panel background opacity. Min value 0.1, max value 1.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"front_background_type",
									"value"		=>	array("custom-front-background"),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Front Border type:", "nxrextender"),
								"param_name"	=>	"front_border_type",
								"value"			=>	array(
									__( 'None', 'nxrextender' )				=> 'none',
									__( 'Custom settings', 'nxrextender' )	=> 'custom-front-border',
								),
								"save_always" 	=>	true,
								"description"	=>	__("Select border type for front panel.", "nxrextender"),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Front Border width:", "nxrextender"),
								"param_name"	=>	"front_border_width",
								"value"			=>	2,
								"min"			=>	1,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "nxrextender"),
								"dependency"	=>	array(
									"element"		=>	"front_border_type",
									"value"			=>	array("custom-front-border"),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Front Border color:", "nxrextender"),
								"param_name"	=>	"front_border_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a border color for front panel.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"front_border_type",
									"value"		=>	array("custom-front-border"),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Zoom Panel Title text:", "nxrextender"),
								"param_name"	=>	"zoom_title",
								"value"			=>	"Unlimited options",
								"description"	=>	__("Insert zoom panel title text here.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Zoom Panel Title color:", "nxrextender"),
								"param_name"	=>	"zoom_title_color",
								"value"			=>	"#222222",
								"description"	=>	__("Color of zoom panel title text.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Zoom Panel Description text:", "nxrextender"),
								 "param_name"	=>	"zoom_desc",
								 "value"		=>	"Extensive editing options, no coding required.",
								 "description"	=>	__("Insert zoom panel description here.", "nxrextender"),
								 "save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Zoom Panel Description color:", "nxrextender"),
								"param_name"	=>	"zoom_desc_color",
								"value"			=>	"#8d8d8d",
								"description"	=>	__("Color of zoom panel description text.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Zoom Panel Background type:", "nxrextender"),
								"param_name"	=>	"zoom_background_type",
								"value"			=>	array(
									__( 'Select color', 'nxrextender' )	=> 'custom-zoom-color',
									__( 'None', 'nxrextender' )			=> 'none',
								),
								"save_always" 	=>	true,
								"description"	=>	__("Select background type for zoom panel.", "nxrextender"),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Zoom Panel Background color:", "nxrextender"),
								"param_name"	=>	"zoom_background_color",
								"value"			=>	"#ffffff",
								"description"	=>	__("Pick a background color for zoom panel.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"zoom_background_type",
									"value"		=>	array("custom-zoom-color"),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Zoom Panel Border type:", "nxrextender"),
								"param_name"	=>	"zoom_border_type",
								"value"			=>	array(
									__( 'None', 'nxrextender' )				=> 'none',
									__( 'Custom settings', 'nxrextender' )	=> 'custom-zoom-border',
								),
								"save_always" 	=>	true,
								"description"	=>	__("Select border type for zoom panel.", "nxrextender"),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Zoom Panel Border width:", "nxrextender"),
								"param_name"	=>	"zoom_border_width",
								"value"			=>	2,
								"min"			=>	1,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"zoom_border_type",
									"value"		=>	array("custom-zoom-border"),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Zoom Panel Border color:", "nxrextender"),
								"param_name"	=>	"zoom_border_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a border color for zoom panel.", "nxrextender"),
								"dependency"	=>	array(
										"element"		=>	"zoom_border_type",
										"value"			=>	array("custom-zoom-border"),
									),						
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Box Border Roundness:", "nxrextender"),
								"param_name"	=>	"zb_border_roundness",
								"value"			=>	0,
								"min"			=>	0,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels, example: 0 for square, or 5 for rounded corners.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"		=>	"",
								"heading"		=>	__("Link","nxrextender"),
								"param_name"	=>	"custom_link",
								"value"			=>	array(
									__( 'No Link', 'nxrextender' )					=> 'no-link',
									__( 'Add custom link to box', 'nxrextender' )	=> 'set-link',
								),
								"save_always" 	=>	true,
								"description"	=>	__("You can add/remove custom link.", "nxrextender"),
							),
							array(
								 "type"			=>	"vc_link",
								 "class"		=>	"",
								 "heading"		=>	__("Box Link:","nxrextender"),
								 "param_name"	=>	"zoombox_link",
								 "value"		=>	"",
								 "description"	=>	__("You can add or remove the existing link from here.", "nxrextender"),
								 "dependency"	=>	array(
								 	"element"	=>	"custom_link",
									"value"		=>	array( "set-link" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Extra class","nxrextender"),
								"param_name"	=>	"zb_extra_class",
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
							
						),
					)
				);
			}
		}
		
		function nxr_zoombox($atts) {
		
			/*
				Empty vars declaration
			*/
			$output = $icon_type = $icon = $icon_size = $icon_color = $icon_img = $img_width = $front_title = $front_title_color = $front_desc = 
			$front_desc_color = $front_background_type = $front_background_color = $front_background_opacity = 
			$front_border_type = $front_border_width = $front_border_color = $zoom_title = $zoom_title_color = $zoom_desc = 
			$zoom_desc_color = $zoom_background_type = $zoom_background_color = $zoom_border_type = $zoom_border_width = 
			$zoom_border_color = $zb_border_roundness = $custom_link = $zoombox_link = $zb_extra_class = $front_style = $front_bg = $front_bd = $zoom_style = 
			$zoom_bg = $zoom_bd = $border_roundness = $front_zoombox_icon = $nxr_zoombox_img_array = $css = '';
			
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts( array(
				'icon_type'						=>	'',
				'icon'							=>	'',
				'icon_size'						=>	'',
				'icon_color'					=>	'',
				'icon_img'						=>	'',
				'img_width'						=>	'',
				'front_title'					=>	'',
				'front_title_color'				=>	'',
				'front_desc'					=>	'',
				'front_desc_color'				=>	'',
				'front_background_type'			=>	'',
				'front_background_color'		=>	'',
				'front_background_opacity'		=>	'',
				'front_border_type'				=>	'',
				'front_border_width'			=>	'',
				'front_border_color'			=>	'',
				'zoom_title'					=>	'',
				'zoom_title_color'				=>	'',
				'zoom_desc'						=>	'',
				'zoom_desc_color'				=>	'',
				'zoom_background_type'			=>	'',
				'zoom_background_color'			=>	'',
				'zoom_border_type'				=>	'',
				'zoom_border_width'				=>	'',
				'zoom_border_color'				=>	'',
				'zb_border_roundness'			=>	'',
				'custom_link'					=>	'',
				'zoombox_link'					=>	'',
				'zb_extra_class'				=>	'',
				'css'							=>	''
			),$atts));
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			
			/*
				Do the icon
			*/
			if( $icon_type == 'selector' && !empty($icon) ) {
				$front_zoombox_icon = '<div style="color:'.$icon_color.'">'.do_shortcode('[icon name="'.$icon.' front-icon-zb" size="'.$icon_size.'px"]').'</div>';
			}
			elseif($icon_type == 'custom-icon' && !empty($icon_img)){
				$nxr_zoombox_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $icon_img, 'thumb_size' => 'full', 'class' => "" ) );
				$front_zoombox_icon = '<div class="nxr-zoombox-customimg" style="width:'.$img_width.'px;">'.$nxr_zoombox_img_array['thumbnail'].'</div>';
			}
			
			if ($zb_border_roundness !== '0') {
				$border_roundness .= 'border-radius:'.$zb_border_roundness.'px;-moz-border-radius:'.$zb_border_roundness.'px;-webkit-border-radius:'.$zb_border_roundness.'px;-o-border-radius:'.$zb_border_roundness.'px;';
			}
			
			switch($front_background_type){
				case 'none':
					$front_bg = 'background: none;';
				break;
				
				case 'custom-front-background':
					$front_bg = 'background-color:'.$front_background_color.'; opacity:'.$front_background_opacity.';';
				break;
			}
			
			switch($front_border_type){
				case 'none':
					$front_bd = 'border: 0px;';
				break;
				
				case 'custom-front-border':
					$front_bd = 'border:'.$front_border_width.'px solid '.$front_border_color.';';
				break;
			}
			
			$front_style .= $front_bg.$front_bd;
			
			switch($zoom_background_type){
				case 'none':
					$zoom_bg = 'background:none;';
				break;
				
				case 'custom-zoom-color':
					$zoom_bg = 'background-color:'.$zoom_background_color.';';
				break;
			}
			
			switch($zoom_border_type){
				case 'none':
					$zoom_bd = 'border:0px;';
				break;
				
				case 'custom-zoom-border':
					$zoom_bd = 'border:'.$zoom_border_width.'px solid '.$zoom_border_color.';';
				break;
			}
			
			$zoom_style .= $zoom_bg.$zoom_bd;
			
			$zoombox_icon = do_shortcode('[icon icon_type="'.$icon_type.'" name="icon '.$icon.'" size="'.$icon_size.'px" color="'.$icon_color.'"]');
			
			$output .= '<div class="nxr-zoombox '.$zb_extra_class.' ' . esc_attr( $css_class ) . '">';
				$output .= '<div class="zoom-hover">';
					$output .= '<div class="nxr-zoom-front">';
						if($icon_type !== 'none') {
							$output .= $front_zoombox_icon;
						}
						if(!empty($front_title)) {
							$output .='<h4 style="color:'.$front_title_color.'">'.$front_title.'</h4>';
						}
						if(!empty($front_desc)) {
							$output .='<p style="color:'.$front_desc_color.'">'.$front_desc.'</p>';
						}
					$output .= '</div>';
					$output .= '<div class="nxr-zoom-front-mask" style="'.$front_style.$border_roundness.'"></div>';
					$output .= '<div class="nxr-zoom-back" style="'.$zoom_style.$border_roundness.'">';
						$output .= '<div class="nxr-zoom-back-middle">';
						if ($custom_link == 'no-link') {
							$output .= '<span>';
								if(!empty($zoom_title)) {
									$output .='<h4 style="color:'.$zoom_title_color.'">'.$zoom_title.'</h4>';
								}
								if(!empty($zoom_desc)) {
									$output .='<p style="color:'.$zoom_desc_color.'">'.$zoom_desc.'</p>';
								}
							$output .= '</span>';
						} elseif ($custom_link == 'set-link' && $zoombox_link !== '') {
							$href = vc_build_link($zoombox_link);
							if($href['url'] !== "") {
								$link_target = (isset($href['target'])) ? ' target="'.$href['target'].'"' : '';
								$link_title = (isset($href['title'])) ? ' title="'.$href['title'].'"' : '';
							}
							$output .= '<a href="'.$href['url'].'"'.$link_target.''.$link_title.'>';
								if(!empty($zoom_title)) {
									$output .='<h4 style="color:'.$zoom_title_color.'">'.$zoom_title.'</h4>';
								}
								if(!empty($zoom_desc)) {
									$output .='<p style="color:'.$zoom_desc_color.'">'.$zoom_desc.'</p>';
								}
							$output .= '</a>';
						}

						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
			
			/*
				Return the output
			*/
			return $output;		
		}
	}
	new NXR_VC_ZOOMBOX;
}