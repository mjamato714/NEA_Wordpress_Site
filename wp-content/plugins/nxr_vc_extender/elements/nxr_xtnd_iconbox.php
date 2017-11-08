<?php
/*
* Add-on Name: Icon Box
* Add-on URI: http://nexarthemes.com/plugins/nexarthemes-extender/
* Since: 1.0
* Add-on Author: Bogdan Costescu
*/
if(!class_exists('NXR_VC_ICONBOX')) {
	class NXR_VC_ICONBOX extends WPBakeryShortCode {

		function __construct() {
			add_action('admin_init', array($this, 'nxr_iconbox_init'));
			
			add_shortcode('nxr_icon_box', array($this, 'nxr_iconbox') );
			
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
		function nxr_iconbox_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"			=>	__("NXR IconBox", "nxrextender"),
					   "base"			=>	"nxr_icon_box",
					   "class"			=>	"",
					   "icon"			=>	"nxr_icon_box",
					   "category"		=>	__("NexarThemes Extender", "nxrextender"),
					   "description"	=>	__("IconBox - invert colors on hover", "nxrextender"),
					   "params"			=>	array(
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Display icon:","nxrextender"),
								"param_name"	=>	"icon_type",
								"value"			=>	array(
									__( 'Font Icon Browser', 'nxrextender' ) => 'selector',
									__( 'Custom Image Icon', 'nxrextender' ) => 'custom',
									__( 'No icon', 'nxrextender' ) => 'no-icon',
								),
								"save_always"	=>	true,
								"description"	=>	__("Select icon source.", "nxrextender"),
							),
							array(
								"type"			=>	"icon_browser",
								"class"			=>	"",
								"heading"		=>	__("Select icon:", "nxrextender"),
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
								"heading"		=>	__("Icon size:", "nxrextender"),
								"param_name"	=>	"icon_size",
								"value"			=>	32,
								"min"			=>	12,
								"max"			=>	72,
								"suffix"		=>	"px",
								"description"	=>	__("Set the icon size", "nxrextender"),
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
									"element"		=>	"icon_type",
									"value"			=>	array("custom"),
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
								"description"	=>	__("Provide image width", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"icon_type",
									"value"		=>	array("custom"),
								),
								"save_always" 	=>	true,
							),
							array(
								 "type"				=>	"textfield",
								 "class"			=>	"",
								 "heading"			=>	__("Title text:","nxrextender"),
								 "param_name"		=>	"title_text",
								 "value"			=>	"Featured items",
								 "description"		=>	__("Insert title text here.", "nxrextender"),
								 "save_always" 		=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Front side Title HTML Format", "nxrextender"),
								"param_name"	=>	"title_text_format",
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
								 "type"				=>	"textfield",
								 "class"			=>	"",
								 "heading"			=>	__("Subheading text:","nxrextender"),
								 "param_name"		=>	"subheading_text",
								 "value"			=>	"View all",
								 "description"		=>	__("This will be visible on hover.", "nxrextender"),
								 "save_always" 		=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Subheading Text HTML Format", "nxrextender"),
								"param_name"	=>	"subheading_text_format",
								"value"			=>	array(
									__( 'P', 'nxrextender' ) => 'p',
									__( 'H1', 'nxrextender' ) => 'h1',
									__( 'H2', 'nxrextender' ) => 'h2',
									__( 'H3', 'nxrextender' ) => 'h3',
									__( 'H4', 'nxrextender' ) => 'h4',
									__( 'H5', 'nxrextender' ) => 'h5',
									__( 'H6', 'nxrextender' ) => 'h6',
								),
								"std"			=>	"p",
								"save_always"	=>	true,
							),
							array(
								"type"				=>	"colorpicker",
								"class"				=>	"",
								"heading"			=>	__("Icon, title and subheading color on normal state:", "nxrextender"),
								"param_name"		=>	"its_normal_color",
								"value"				=>	"#47a3da",
								"description"		=>	__("Color of icon, title text and subheading text in normal state.", "nxrextender"),
								"save_always" 		=>	true,
							),
							array(
								"type"				=>	"dropdown",
								"class"				=>	"",
								"heading"			=>	__("Background type on normal state:", "nxrextender"),
								"param_name"		=>	"normal_background_type",
								"value"				=>	array(
									__( 'None', 'nxrextender' ) 		=> 'none',
									__( 'Select color', 'nxrextender' )	=> 'custom-normal-color',
								),
								"save_always"		=>	true,
								"description"		=>	__("Select background type in normal state.", "nxrextender"),
							),
							array(
								"type"				=>	"colorpicker",
								"class"				=>	"",
								"heading"			=>	__("Background color on normal state:", "nxrextender"),
								"param_name"		=>	"normal_background_color",
								"value"				=>	"#ffffff",
								"description"		=>	__("Pick a background color for normal state.", "nxrextender"),
								"dependency"		=>	array(
									"element"		=> "normal_background_type",
									"value"			=>	array( "custom-normal-color" ),
								),
								"save_always" 		=>	true,
							),
							array(
								"type"				=>	"dropdown",
								"class"				=>	"",
								"heading"			=>	__("Border type on normal state:", "nxrextender"),
								"param_name"		=>	"normal_border_type",
								"value"				=>	array(
									__( 'None', 'nxrextender' ) 		=> 'none',
									__( 'Select color', 'nxrextender' )	=> 'custom-normal-border',
								),
								"save_always"		=>	true,
								"description"		=>	__("Select border type in normal state.", "nxrextender"),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Border thickness on normal state:", "nxrextender"),
								"param_name"	=>	"normal_border_width",
								"value"			=>	2,
								"min"			=>	1,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"normal_border_type",
									"value"		=>	array( "custom-normal-border" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Border color on normal state:", "nxrextender"),
								"param_name"	=>	"normal_border_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a border color for normal state box.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"normal_border_type",
									"value"		=>	array( "custom-normal-border" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"				=>	"colorpicker",
								"class"				=>	"",
								"heading"			=>	__("Icon, title and subheading color on hover state:", "nxrextender"),
								"param_name"		=>	"its_hover_color",
								"value"				=>	"#ffffff",
								"description"		=>	__("Color of icon, title text and subheading text in hover state.", "nxrextender"),
								"save_always" 		=>	true,
							),
							array(
								"type"				=>	"dropdown",
								"class"				=>	"",
								"heading"			=>	__("Background type on hover state", "nxrextender"),
								"param_name"		=>	"hover_background_type",
								"value"				=>	array(
									__( 'None', 'nxrextender' ) 		=> 'none',
									__( 'Select color', 'nxrextender' )	=> 'custom-hover-color',
								),
								"save_always" 		=> true,
								"description"		=>	__("Select background type in hover state.", "nxrextender"),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Background color on hover state:", "nxrextender"),
								"param_name"	=>	"hover_background_color",
								"value"			=>	"#47a3da",
								"description"	=>	__("Pick a background color for hover state.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"hover_background_type",
									"value"		=>	array( "custom-hover-color" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"				=>	"dropdown",
								"class"				=>	"",
								"heading"			=>	__("Border type on hover state:", "nxrextender"),
								"param_name"		=>	"hover_border_type",
								"value"				=>	array(
									__( 'None', 'nxrextender' ) 		=> 'none',
									__( 'Select color', 'nxrextender' )	=> 'custom-hover-border',
								),
								"save_always" 		=>	true,
								"description"		=>	__("Select border type in hover state.", "nxrextender"),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Border width on hover state:", "nxrextender"),
								"param_name"	=>	"hover_border_width",
								"value"			=>	2,
								"min"			=>	1,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"hover_border_type",
									"value"		=>	array( "custom-hover-border" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Border color on hover state:", "nxrextender"),
								"param_name"	=>	"hover_border_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a border color for hover state box.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"hover_border_type",
									"value"		=>	array( "custom-hover-border" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Box border roundness:", "nxrextender"),
								"param_name"	=>	"ib_border_roundness",
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
								 "heading"		=>	__("Link type:", "nxrextender"),
								 "param_name"	=>	"custom_link",
								 "value"		=>	array(
									__( 'No link', 'nxrextender' ) 					=> '#',
									__( 'Add custom link to box', 'nxrextender' )	=> '1',
								),
								"save_always" 	=>	true,
								"description"	=>	__("You can add / remove custom link", "nxrextender"),
							),
							array(
								 "type"			=>	"vc_link",
								 "class"		=>	"",
								 "heading"		=>	__("Link settings:", "nxrextender"),
								 "param_name"	=>	"iconbox_link",
								 "value"			=>	"",
								 "description"	=>	__("You can add or remove the existing link from here.", "nxrextender"),
								 "dependency"	=>	array(
									"element"	=>	"custom_link",
									"value"		=>	array( "1" ),
								),
								"save_always" 	=>	true,
							),
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Extra class:", "nxrextender"),
								 "param_name"	=>	"ib_extra_class",
								 "value"		=>	"",
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
		
		function nxr_iconbox($atts) {
		
			/*
				 Empty vars declaration
			*/
			$output = $normal_style = $normal_bg = $normal_bd = $hover_bg = $hover_bd = $title_text_format = $subheading_text_format = $border_roundness =$icon_type = $icon = $icon_size = $icon_img = $img_width = $title_text = $subheading_text = $its_normal_color = $normal_background_type = $normal_background_color = $normal_border_type = $normal_border_width = $normal_border_color = $its_hover_color = $hover_background_type = $hover_background_color = $hover_border_type = $hover_border_width = $hover_border_color = $ib_border_roundness = $custom_link = $iconbox_link = $ib_extra_class = $nxr_iconbox_img_array = $css = '';
			
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts( array(
				'icon_type'					=>	'',
				'icon'						=>	'',
				'icon_size'					=>	'',
				'icon_img'					=>	'',
				'img_width'					=>	'',
				'title_text'					=>	'',
				'title_text_format'			=>	'h2',
				'subheading_text_format'	=>	'p',
				'subheading_text'			=>	'',
				'its_normal_color'			=>	'',
				'normal_background_type'	=>	'',
				'normal_background_color'	=>	'',
				'normal_border_type'		=>	'',
				'normal_border_width'		=>	'',
				'normal_border_color'		=>	'',
				'its_hover_color'			=>	'',
				'hover_background_type'		=>	'',
				'hover_background_color'	=>	'',
				'hover_border_type'			=>	'',
				'hover_border_width'		=>	'',
				'hover_border_color'		=>	'',
				'ib_border_roundness'		=>	'',
				'custom_link'				=>	'',
				'iconbox_link'				=>	'',
				'ib_extra_class'			=>	'',
				'css'						=>	'',
			),$atts));
			
			
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			
			
			/*
				Do the icon
			*/
			
			if( $icon_type == 'selector' && !empty($icon) ) {
				$content_icon = do_shortcode('[icon name="icon '.$icon.'" size="'.$icon_size.'px"]');
			}
			elseif($icon_type == 'custom' && !empty($icon_img)){
				$nxr_iconbox_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $icon_img, 'thumb_size' => 'full', 'class' => "" ) );
				$content_icon = '<div class="nxr-iconbox-customimg" style="width:'.$img_width.'px;margin:auto;">'.$nxr_iconbox_img_array['thumbnail'].'</div>';
			}
			
			if ($ib_border_roundness !== '0') {
				$border_roundness .= 'style="border-radius:'.$ib_border_roundness.'px;-moz-border-radius:'.$ib_border_roundness.'px;-webkit-border-radius:'.$ib_border_roundness.'px;-o-border-radius:'.$ib_border_roundness.'px;"';
			}
			
			switch($normal_background_type){
				case 'none':
					$normal_bg = 'none';
				break;
				
				case 'custom-normal-color':
					$normal_bg = $normal_background_color;
				break;
				
				default:
			}
			
			switch($normal_border_type){
				case 'none':
					$normal_bd = '0px;';
				break;
				
				case 'custom-normal-border':
					$normal_bd = $normal_border_width.'px solid '.$normal_border_color;
				break;
				
				default:
			}
			
			switch($hover_background_type){
				case 'none':
					$hover_bg = 'none';
				break;
				
				case 'custom-hover-color':
					$hover_bg = $hover_background_color;
				break;
				
				default:
			}
			
			switch($hover_border_type){
				case 'none':
					$hover_bd = '0px';
				break;
				
				case 'custom-hover-border':
					$hover_bd = $hover_border_width.'px solid '.$hover_border_color;
				break;
				
				default:
			}
			
			$iconbox_id = "nxr-icnbox-".uniqid();
			
			$output .='<script type="text/javascript">
						jQuery(document).ready(function() {
							jQuery(".'.$iconbox_id.'").css("background","'.$normal_bg.'").css("border","'.$normal_bd.'");
							jQuery(".'.$iconbox_id.' a").css("color","'.$its_normal_color.'");
							jQuery(".'.$iconbox_id.' span").css("color","'.$its_normal_color.'");
							jQuery(".'.$iconbox_id.' .nxr-iconbox-title").css("color","'.$its_normal_color.'");
							jQuery(".'.$iconbox_id.' .nxr-iconbox-bar").css("background","'.$its_normal_color.'");
							
							
							jQuery(".'.$iconbox_id.'").mouseenter(function() {
								jQuery(this).css("background","'.$hover_bg.'").css("border","'.$hover_bd.'");
								jQuery(this).find("a").css("color","'.$its_hover_color.'");
								jQuery(this).find("span").css("color","'.$its_hover_color.'");
								jQuery(this).find(".nxr-iconbox-title").css("color","'.$its_hover_color.'");
								jQuery(this).find(".nxr-iconbox-bar").css("background","'.$its_hover_color.'");
							}).mouseleave(function() {
								jQuery(this).css("background","'.$normal_bg.'").css("border","'.$normal_bd.'");
								jQuery(this).find("a").css("color","'.$its_normal_color.'");
								jQuery(this).find("span").css("color","'.$its_normal_color.'");
								jQuery(this).find(".nxr-iconbox-title").css("color","'.$its_normal_color.'");
								jQuery(this).find(".nxr-iconbox-bar").css("background","'.$its_normal_color.'");
							});
						});
				</script>';
			
			$output .= '<div class="nxr-iconbox ' . esc_attr( $css_class ) . ' '.$iconbox_id.' '.$ib_extra_class.'" '.$border_roundness.'>';
				if($custom_link !== '#'){
					$href = vc_build_link($iconbox_link);
					if($href['url'] !== "") {
						$link_target = (isset($href['target'])) ? ' target="'.$href['target'].'"' : '';
						$link_title = (isset($href['title'])) ? ' title="'.$href['title'].'"' : '';
					}
					$output .= '<a href="'.$href['url'].'"'.$link_target.''.$link_title.'>';
					if($icon !== '' || $icon_img !== '') {
						$output .='<div class="normal-icon-ib">'.$content_icon.'</div>';
					}
					$output .= '<span class="nxr-iconbox-bar"></span>';
					if(!empty($title_text)) {
						$output .='<'.$title_text_format.' class="nxr-iconbox-title">'.$title_text.'</'.$title_text_format.'>';
					}
					if(!empty($subheading_text)) {
						$output .='<'.$subheading_text_format.' class="nxr-iconbox-subheading">'.$subheading_text.'</'.$subheading_text_format.'>';
					}
					$output .='</a>';
				}
				else {
					$output .= '<span>';
					if($icon !== '' || $icon_img !== '') {
						$output .='<div class="normal-icon-ib">'.$content_icon.'</div>';
					}
					$output .= '<span class="nxr-iconbox-bar"></span>';
					if(!empty($title_text)) {
						$output .='<'.$title_text_format.' class="nxr-iconbox-title">'.$title_text.'</'.$title_text_format.'>';
					}
					if(!empty($subheading_text)) {
						$output .='<'.$subheading_text_format.' class="nxr-iconbox-subheading">'.$subheading_text.'</'.$subheading_text_format.'>';
					}
					$output .= '</span>';
				}
				
				
			$output .= '</div>';
			
			/*
				Return the output
			*/
			return $output;		
		}
	}
	new NXR_VC_ICONBOX;
}