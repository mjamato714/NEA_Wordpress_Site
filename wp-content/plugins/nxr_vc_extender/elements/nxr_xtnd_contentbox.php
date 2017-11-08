<?php
/*
* Add-on Name: Content Box
* Add-on URI: http://nexarthemes.com/plugins/nexarthemes-extender/
* Since: 1.0
* Add-on Author: Bogdan COSTESCU
*/
if(!class_exists('NXR_VC_CONTENTBOX')) {
	class NXR_VC_CONTENTBOX extends WPBakeryShortCode {
		
		function __construct() {
			add_action('admin_init', array($this, 'nxr_contentbox_init'));
			
			add_shortcode('nxr_content_box', array($this, 'nxr_contentbox') );
			
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
		function nxr_contentbox_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"			=>	__("NXR ContentBox", "nxrextender"),
					   "base"			=>	"nxr_content_box",
					   "class"			=>	"",
					   "icon"			=>	"nxr_content_box",
					   "category"		=>	__("NexarThemes Extender", "nxrextender"),
					   "description"	=>	__("ContentBox with advanced settings", "nxrextender"),
					   "params"			=>	array(
							/*
								Icon section configuration
							*/
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Display icon:","nxrextender"),
								"param_name"	=>	"icon_type",
								"value"			=>	array(
									__( 'Font Icon Browser', 'nxrextender' ) => 'selector',
									__( 'Custom Image Icon', 'nxrextender' ) => 'custom',
								),
								"save_always"	=>	true,
								"description"	=>	__("Use an existing font icon or upload a custom image.", "nxrextender"),
							),
							array(
								"type"			=>	"icon_browser",
								"class"			=>	"",
								"heading"		=>	__("Select Icon ","nxrextender"),
								"param_name"	=>	"icon",
								"value"			=>	"",
								"description"	=>	__("Click on an icon to select it.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"icon_type",
									"value"		=>	array( "selector" ),
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
								"description"	=>	__("Provide image width", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"icon_type",
									"value"		=>	array( "custom" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Size of Icon", "nxrextender"),
								"param_name"	=>	"icon_size",
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
								"type"			=>"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon Color on normal state", "nxrextender"),
								"param_name"	=>	"icon_color",
								"value"			=>	"#222222",
								"description"	=>	__("Select prefered color on normal state.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"icon_type",
									"value"		=>	array( "selector" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon Color on hover state", "nxrextender"),
								"param_name"	=>	"icon_color_hover",
								"value"			=>	"#FFFFFF",
								"description"	=>	__("Select prefered color on hover state.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"icon_type",
									"value"		=>	array( "selector" ),
								),
								"save_always" 	=>	true,
							),
							/*
								Text and color configuration
							*/
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Title text","nxrextender"),
								 "param_name"	=>	"title_normal",
								 "value"		=>	"Fast customization",
								 "description"	=>	__("Insert title text here.","nxrextender"),
								 "save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Title color on normal state", "nxrextender"),
								"param_name"	=>	"normal_title_color",
								"value"			=>	"#222222",
								"description"	=>	__("Color of title text in normal state.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Title color on hover state", "nxrextender"),
								"param_name"	=>	"hover_title_color",
								"value"			=>	"#ffffff",
								"description"	=>	__("Color of title text in hover state.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Description text","nxrextender"),
								 "param_name"	=>	"desc_normal",
								 "value"		=>	"Using the visual editor has never been easier.",
								 "description"	=>	__("Insert description here.","nxrextender"),
								 "save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Description color on normal state", "nxrextender"),
								"param_name"	=>	"normal_desc_color",
								"value"			=>	"#8d8d8d",
								"description"	=>	__("Color of description text in normal state.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Description color on hover state", "nxrextender"),
								"param_name"	=>	"hover_desc_color",
								"value"			=>	"#85cee0",
								"description"	=>	__("Color of description text in hover state.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Background type on normal state", "nxrextender"),
								"param_name"	=>	"normal_background_type",
								"value"			=>	array(
									__( 'Select color', 'nxrextender' )	=> 'custom-normal-color',
									__( 'None', 'nxrextender' )			=> 'none',
								),
								"save_always"	=>	true,
								"description"	=>	__("Select background type in normal state.", "nxrextender"),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Background color on normal state", "nxrextender"),
								"param_name"	=>	"normal_background_color",
								"value"			=>	"#ffffff",
								"description"	=>	__("Pick a background color for normal state.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"normal_background_type",
									"value"		=>	array( "custom-normal-color" )
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Border type on normal state", "nxrextender"),
								"param_name"	=>	"normal_border_type",
								"value"			=>	array(
									__( 'None', 'nxrextender' ) => 'none',
									__( 'Select color', 'nxrextender' ) => 'custom-normal-border',
								),
								"save_always"	=>	true,
								"description"	=>	__("Select border type in normal state.", "nxrextender"),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Border width on normal state", "nxrextender"),
								"param_name"	=>	"normal_border_width",
								"value"			=>	2,
								"min"			=>	1,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"normal_border_type",
									"value"		=>	array( "custom-normal-border" )
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Border color on normal state", "nxrextender"),
								"param_name"	=>	"normal_border_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a border color for normal state box.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"normal_border_type",
									"value"		=>	array( "custom-normal-border" )
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Background type on hover state", "nxrextender"),
								"param_name"	=>	"hover_background_type",
								"value"			=>	array(
									__( 'Select color', 'nxrextender' ) => 'custom-hover-color',
									__( 'None', 'nxrextender' ) => 'none',
								),
								"save_always"	=>	true,
								"description"	=>	__("Select background type in hover state.", "nxrextender"),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Background color on hover state", "nxrextender"),
								"param_name"	=>	"hover_background_color",
								"value"			=>	"#0484c9",
								"description"	=>	__("Pick a background color for hover state.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"hover_background_type",
									"value"		=>	array( "custom-hover-color" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Border type on hover state", "nxrextender"),
								"param_name"	=>	"hover_border_type",
								"value"			=>	array(
									__( 'None', 'nxrextender' ) => 'none',
									__( 'Select color', 'nxrextender' ) => 'custom-hover-border',
								),
								"save_always"	=>	true,
								"description"	=>	__("Select border type in hover state.", "nxrextender"),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Border width on hover state", "nxrextender"),
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
								"heading"		=>	__("Border color on hover state", "nxrextender"),
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
								"heading"		=>	__("Box Border Roundness:", "nxrextender"),
								"param_name"	=>	"nh_border_roundness",
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
									__( 'No Link', 'nxrextender' ) => '#',
									__( 'Add custom link to box', 'nxrextender' ) => '1',
								),
								"save_always"	=>	true,
								"description"	=>	__("You can add / remove custom link", "nxrextender")
							),
							array(
								 "type"			=>	"vc_link",
								 "class"		=>	"",
								 "heading"		=>	__("Link ","nxrextender"),
								 "param_name"	=>	"contentbox_link",
								 "value"		=>	"",
								 "description"	=>	__("You can add or remove the existing link from here.", "nxrextender"),
								 "dependency"	=>	array(
								 	"element"	=>	"custom_link",
									"value"		=>	array( "1" )
								),
								"save_always" 	=>	true,
							),
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Extra class","nxrextender"),
								 "param_name"	=>	"cb_extra_class",
								 "value"		=>	"",
								 "description"	=>	__("Add extra class name. You can use this class for your css/js customizations.", "nxrextender"),
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
		
		function nxr_contentbox($atts) {
		
			/*
				 Empty vars declaration
			*/
			$output = $normal_style = $normal_bg = $normal_bd = $hover_bg = $hover_bd = $border_roundness = $nxr_contbox_id = $icon_type = $icon = $icon_img = $img_width = $icon_size = $icon_color = $icon_color_hover = $title_normal = $normal_title_color = $hover_title_color = $desc_normal = $normal_desc_color = $hover_desc_color = $normal_background_type = $normal_background_color = $normal_border_type = $normal_border_width = $normal_border_color = $hover_background_type = $hover_background_color = $hover_border_type = $hover_border_width = $hover_border_color = $nh_border_roundness = $custom_link = $contentbox_link = $cb_extra_class = $css = '';
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts( array(
				'icon_type'					=>	'', 
				'icon'						=>	'', 
				'icon_img'					=>	'', 
				'img_width'					=>	'', 
				'icon_size'					=>	'', 
				'icon_color'					=>	'', 
				'icon_color_hover'			=>	'', 
				'title_normal'				=>	'', 
				'normal_title_color'		=>	'', 
				'hover_title_color'			=>	'', 
				'desc_normal'				=>	'', 
				'normal_desc_color'			=>	'', 
				'hover_desc_color'			=>	'', 
				'normal_background_type'	=>	'', 
				'normal_background_color'	=>	'', 
				'normal_border_type'		=>	'', 
				'normal_border_width'		=>	'', 
				'normal_border_color'		=>	'', 
				'hover_background_type'		=>	'', 
				'hover_background_color'	=>	'', 
				'hover_border_type'			=>	'', 
				'hover_border_width'		=>	'', 
				'hover_border_color'		=>	'', 
				'nh_border_roundness'		=>	'', 
				'custom_link'				=>	'', 
				'contentbox_link'			=>	'', 
				'cb_extra_class'			=>	'', 
				'css'						=>	'', 
			),$atts));
			
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

			
			if ( $nh_border_roundness !== '0') {
			$border_roundness .= 'style="border-radius:'.$nh_border_roundness.'px;-moz-border-radius:'.$nh_border_roundness.'px;-webkit-border-radius:'.$nh_border_roundness.'px;-o-border-radius:'.$nh_border_roundness.'px;"';
			}
			
			if( $icon_type == 'selector' && !empty($icon) ) {
				$content_icon = do_shortcode('[icon name="icon '.$icon.' normal-icon-cb" size="'.$icon_size.'px"]');
			}
			elseif($icon_type == 'custom' && !empty($icon_img)){
				$nxr_contentbox_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $icon_img, 'thumb_size' => 'full', 'class' => "" ) );
				$content_icon = '<div class="nxr-contbox-customimg" style="width:'.$img_width.'px;">'.$nxr_contentbox_img_array['thumbnail'].'</div>';
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
					$normal_bd = '0px';
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
			
			$nxr_contbox_id = "nxr-contbox-".uniqid();
			
			$output .='<script type="text/javascript">
						jQuery(document).ready(function() {
							jQuery(".'.$nxr_contbox_id.'").css("background","'.$normal_bg.'").css("border","'.$normal_bd.'");
							jQuery(".'.$nxr_contbox_id.' .normal-icon-cb").css("color","'.$icon_color.'");
							jQuery(".'.$nxr_contbox_id.' h4").css("color","'.$normal_title_color.'");
							jQuery(".'.$nxr_contbox_id.' p").css("color","'.$normal_desc_color.'");
							
							
							jQuery(".'.$nxr_contbox_id.'").mouseenter(function() {
								jQuery(this).css("background","'.$hover_bg.'").css("border","'.$hover_bd.'");
							}).mouseleave(function() {
								jQuery(this).css("background","'.$normal_bg.'").css("border","'.$normal_bd.'");
							});
							
							jQuery(".'.$nxr_contbox_id.'").mouseenter(function(){
								jQuery(this).find(".normal-icon-cb").css("color","'.$icon_color_hover.'");
							}).mouseleave(function(){
								jQuery(this).find(".normal-icon-cb").css("color","'.$icon_color.'");
							});
							
							jQuery(".'.$nxr_contbox_id.'").mouseenter(function(){
								jQuery(this).find("h4").css("color","'.$hover_title_color.'");
								
							}).mouseleave(function(){
								jQuery(this).find("h4").css("color","'.$normal_title_color.'");
							});
							
							jQuery(".'.$nxr_contbox_id.'").mouseenter(function(){
								jQuery(this).find("p").css("color","'.$hover_desc_color.'");
								
							}).mouseleave(function(){
								jQuery(this).find("p").css("color","'.$normal_desc_color.'");
							});
						});
				</script>';
			
			$output .= '<div class="nxr-content-box '.$nxr_contbox_id.' '.$cb_extra_class.'" '.$border_roundness.' ' . esc_attr( $css_class ) . '>';
				if($custom_link == '1'){
					$href = vc_build_link($contentbox_link);
					if($href['url'] !== '') {
						$link_target = (isset($href['target'])) ? ' target="'.$href['target'].'"' : '';
						$link_title = (isset($href['title'])) ? ' title="'.$href['title'].'"' : '';
					}
					$output .= '<a href="'.$href['url'].'"'.$link_target.''.$link_title.'>';
						if($icon !== '' || $icon_img !== '') {
							$output .= $content_icon;
						}
						if(!empty($title_normal)) {
							$output .='<h4>'.$title_normal.'</h4>';
						}
						if(!empty($desc_normal)) {
							$output .='<p>'.$desc_normal.'</p>';
						}
					$output .= '</a>';
				} elseif ($custom_link == '#') {
					$output .= '<span>';
						if($icon !== '' || $icon_img !== '') {
							$output .= $content_icon;
						}
						if(!empty($title_normal)) {
							$output .='<h4>'.$title_normal.'</h4>';
						}
						if(!empty($desc_normal)) {
							$output .='<p>'.$desc_normal.'</p>';
						}
					$output .= '</span>';
				}
			$output .= '<div class="clear"></div> </div>';
			
			/*
				Return the output
			*/
			return $output;		
		}
	}
	new NXR_VC_CONTENTBOX;
}