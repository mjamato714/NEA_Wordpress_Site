<?php
/*
	* Add-on Name: Rollover Panel
	* Add-on URI: http://nexarthemes.com/plugins/nexarthemes-extender/
	* Since: 1.0.3.8
	* Add-on Author: Bogdan Costescu
*/
if(!class_exists('NXR_VC_ROLLOVERPANEL')) {
	class NXR_VC_ROLLOVERPANEL extends WPBakeryShortCode {
		function __construct() {
			add_action('admin_init', array($this, 'nxr_rolloverpanel'));
			
			add_shortcode('nxr_rollover_panel', array($this, 'nxr_rolloverpanel_shortcode') );
			
			/*
				Param type "number"
			*/ 
			if ( function_exists('vc_add_shortcode_param')){
				vc_add_shortcode_param('number' , array('NXR_XTND', 'make_number_input' ) );
			}
			/*
				Param type "icon_browser"
			*/ 
			if(function_exists('vc_add_shortcode_param')){
				vc_add_shortcode_param('icon_browser', array('NXR_XTND','icon_browser'));
			}
		}
		
		/*
			Visual Composer mapping function
			Public API
			Refference:	http://kb.wpbakery.com/index.php?title=Vc_map
			Example:		http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
		*/
		function nxr_rolloverpanel() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"			=>	__("NXR Rollover Panel","nxrextender"),
					   "base"			=>	"nxr_rollover_panel",
					   "class"			=>	"",
					   "icon"			=>	"nxr_rolloverpanel",
					   "category"		=>	__("NexarThemes Extender", "nxrextender"),
					   "description"	=>	__("Rollover Panel with advanced settings", "nxrextender"),
					   "params"			=>	array(
							/*
								=== Front panel settings ===
							*/
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon to display on front side:", "nxrextender"),
								"param_name"	=>	"icon_type",
								"value"			=>	array(
									__( 'Font Icon Browser', 'nxrextender' ) => 'selector',
									__( 'Custom Image Icon', 'nxrextender' ) => 'custom-icon',
								),
								"save_always" 	=>	true,
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
									"value"		=>	array( "selector" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"nxr_range_class",
								"heading"		=>	__("Size of icon on front side:", "nxrextender"),
								"param_name"	=>	"icon_size",
								"value"			=>	32,
								"min"			=>	12,
								"max"			=>	120,
								"suffix"		=>	"px",
								"description"	=>	__("Set the icon size on front panel.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"icon_type",
									"value"		=>	array( "selector" )
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Color of icon on front side:", "nxrextender"),
								"param_name"	=>	"icon_color",
								"value"			=>	"#333333",
								"description"	=>	__("Pick your desired icon color.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"icon_type",
									"value"		=>	array( "selector" ),
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
							/*
								Front side title settings
							*/
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Front side title text:","nxrextender"),
								"param_name"	=>	"title_front",
								"value"			=>	"Fast customization",
								"description"	=>	__("Title for the front panel.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Front side title size:", "nxrextender"),
								"param_name"	=>	"title_front_size",
								"value"			=>	14,
								"min"			=>	8,
								"max"			=>	30,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Front side title color:", "nxrextender"),
								"param_name"	=>	"title_front_color",
								"value"			=>	"#333333",
								"description"	=>	__("Pick a color for the front side title.", "nxrextender"),
								"save_always" 	=>	true,
							),
							/*
								Front side background settings
							*/
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Front side background type:", "nxrextender"),
								"param_name"	=>	"front_background_type",
								"value"			=>	array(
									__( 'None', 'nxrextender' ) 		=> 'none',
									__( 'Select color', 'nxrextender' )	=> 'custom-front-color',
								),
								"save_always" 	=>	true,
								"description"	=>	__("Choose between transparent or color background.", "nxrextender"),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading" 		=>	__("Front side background color:", "nxrextender"),
								"param_name"	=>	"front_background_color",
								"value"			=>	"#333333",
								"description"	=>	__("Pick a background color for front panel.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"front_background_type",
									"value"		=>	array("custom-front-color"),
								),
								"save_always" 	=>	true,
							),
							/*
								Front side border settings
							*/
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Front side border type:", "nxrextender"),
								"param_name"	=>	"front_border_type",
								"value"			=>	array(
									__( 'None', 'nxrextender' ) 		=> 'none',
									__( 'Custom border settings', 'nxrextender' )	=> 'custom-front-border',
								),
								"save_always" 	=>	true,
								"description"	=>	__("Add border to front side panel.", "nxrextender"),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Front border width:", "nxrextender"),
								"param_name"	=>	"front_border_width",
								"value"			=>	1,
								"min"			=>	1,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"front_border_type",
									"value"		=>	array( "custom-front-border" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Front border color:", "nxrextender"),
								"param_name"	=>	"front_border_color",
								"value"			=>	"#333333",
								"description"	=>	__("Pick a color for front side border.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"front_border_type",
									"value"		=>	array( "custom-front-border" ),
								),
								"save_always" 	=>	true,
							),
							/*
								=== Back panel settings ===
							*/
							/*
								Back side title settings
							*/
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Back side title text:","nxrextender"),
								"param_name"	=>	"title_back",
								"value"			=>	"Fast customization",
								"description"	=>	__("Title for the back panel.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Back side title size:", "nxrextender"),
								"param_name"	=>	"title_back_size",
								"value"			=>	14,
								"min"			=>	8,
								"max"			=>	30,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Back side title color:", "nxrextender"),
								"param_name"	=>	"title_back_color",
								"value"			=>	"#333333",
								"description"	=>	__("Pick a color for the back side title.", "nxrextender"),	
								"save_always" 	=>	true,
							),
							/*
								Back side description settings
							*/
							array(
								"type"			=>	"textfield",
								"class"		=>	"",
								"heading"		=>	__("Back side description text:","nxrextender"),
								"param_name"	=>	"description_back",
								"value"		=>	"",
								"description"	=>	__("Description for the back panel.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Back side description text size:", "nxrextender"),
								"param_name"	=>	"description_back_size",
								"value"			=>	14,
								"min"			=>	8,
								"max"			=>	30,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Back side description text color:", "nxrextender"),
								"param_name"	=>	"description_back_color",
								"value"			=>	"#333333",
								"description"	=>	__("Pick a color for the back side description.", "nxrextender"),
								"save_always" 	=>	true,
							),
							/*
								Back side background settings
							*/
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Back side background type:", "nxrextender"),
								"param_name"	=>	"back_background_type",
								"value"			=>	array(
									__( 'None', 'nxrextender' ) 		=> 'none',
									__( 'Select color', 'nxrextender' )	=> 'custom-back-color',
								),
								"save_always" 	=>	true,
								"description"	=>	__("Choose between transparent or color background.", "nxrextender"),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading" 		=>	__("Back side background color:", "nxrextender"),
								"param_name"	=>	"back_background_color",
								"value"			=>	"#333333",
								"description"	=>	__("Pick a background color for back panel.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"back_background_type",
									"value"		=>	array("custom-back-color"),
								),
								"save_always" 	=>	true,
							),
							/*
								Back side border settings
							*/
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Back side border type:", "nxrextender"),
								"param_name"	=>	"back_border_type",
								"value"			=>	array(
									__( 'None', 'nxrextender' ) 					=> 'none',
									__( 'Custom border settings', 'nxrextender' )	=> 'custom-back-border',
								),
								"save_always" 	=>	true,
								"description"	=>	__("Add border to back side panel.", "nxrextender"),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Back border width:", "nxrextender"),
								"param_name"	=>	"back_border_width",
								"value"			=>	1,
								"min"			=>	1,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"back_border_type",
									"value"		=>	array( "custom-back-border" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Back border color:", "nxrextender"),
								"param_name"	=>	"back_border_color",
								"value"			=>	"#333333",
								"description"	=>	__("Pick a color for back side border.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"back_border_type",
									"value"		=>	array( "custom-back-border" ),
								),
								"save_always" 	=>	true,
							),
							/*
								Back side link settings
							*/
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Back side link settings:", "nxrextender"),
								"param_name"	=>	"custom_link_back",
								"value"			=>	array(
									__( 'No link', 'nxrextender' ) 			=> '',
									__( 'Add custom link', 'nxrextender' )	=> 'yes',
								),
								"save_always" 	=> true,
								"description"	=>	__("You can add/remove custom link.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Back side link text:","nxrextender"),
								"param_name"	=>	"link_text",
								"value"			=>	"Read more",
								"description"	=>	__("Choose a text for your link.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"custom_link_back",
									"not_empty"	=>	true,
									"value"		=>	array("yes"),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"vc_link",
								"class"			=>	"",
								"heading"		=>	__("Link to URL:", "nxrextender"),
								"param_name"	=>	"link_url",
								"value"			=>	"",
								"description"	=>	__("Select URL to link.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"custom_link_back",
									"not_empty"	=>	true,
									"value"		=>	array("yes"),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Link text size:", "nxrextender"),
								"param_name"	=>	"link_size",
								"value"			=>	14,
								"min"			=>	8,
								"max"			=>	30,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"custom_link_back",
									"not_empty"	=>	true,
									"value"		=>	array("yes"),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Link text color:", "nxrextender"),
								"param_name"	=>	"link_color",
								"value"			=>	"#333333",
								"description"	=>	__("Pick a color for the link text.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"custom_link_back",
									"not_empty"	=>	true,
									"value"		=>	array("yes"),
								),
								"save_always" 	=>	true,
							),
							/*
								General panel settings
							*/
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Box rounded corners:", "nxrextender"),
								"param_name"	=>	"box_roundness",
								"value"			=>	0,
								"min"			=>	0,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels, example: 0 for square, or 5 for rounded corners. Roundness will be applied to both sides.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	'checkbox',
								"heading"		=>	__("Enable panel reflection:", "nxrextender"),
								"param_name"	=>	"box_reflection",
								"description"	=>	__("Check box to apply reflection. Reflection works best on square boxes.", "nxrextender"),
								"value"			=>	array( esc_html__("Yes, please", "nxrextender") => 'yes' ),
								"save_always" 	=>	true,
						    ),
							/*
								Box height settings
							*/
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Set box height:", "nxrextender"),
								"param_name"	=>	"height_type",
								"value"			=>	array(
									__( 'Auto', 'nxrextender' ) 	=> 'auto',
									__( 'Custom', 'nxrextender' )	=> 'custom',
								),
								"save_always" 	=>	true,
								"description"	=>	__("Select height option for this box.", "nxrextender"),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Box height:", "nxrextender"),
								"param_name"	=>	"box_height",
								"value"			=>	300,
								"min"			=>	200,
								"max"			=>	1200,
								"suffix"		=>	"px",
								"description"	=>	__("Provide box height.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"height_type",
									"value"		=>	array( "custom" ),
								),
								"save_always" 	=>	true,
							),
							/*
								Item extra class
							*/
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Extra class:", "nxrextender"),
								 "param_name"	=>	"box_extra_class",
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
		
		function nxr_rolloverpanel_shortcode($atts) {
			/*
				 Empty vars declaration
			*/
			$output = $nxr_rollover_id = $front_bg = $front_bd = $back_bg = $back_bd = $height = $border_roundness = $rollover_icon = $link_prefix = $link_sufix = $link_style = $icon_type = $icon = $icon_size = $icon_color = $icon_img = $img_width = $nxr_rollover_img_array = $title_front = $title_front_size = $title_front_color = $front_background_type = $front_background_color = $front_border_type = $front_border_width = $front_border_color = $title_back = $title_back_size = $title_back_color = $description_back = $description_back_size = $description_back_color = $back_background_type = $back_background_color = $back_border_type = $back_border_width = $back_border_color = $custom_link_back = $link_text = $link_url = $link_size = $link_color = $box_roundness = $box_reflection = $height_type = $box_height = $box_extra_class = $css = '';
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts( array(
				'icon_type'							=>	'',
				'icon'								=>	'',
				'icon_size'							=>	'',
				'icon_color'							=>	'',
				'icon_img'							=>	'',
				'img_width'							=>	'',
				'title_front'						=>	'',
				'title_front_size'					=>	'',
				'title_front_color'					=>	'',
				'front_background_type'				=>	'',
				'front_background_color'			=>	'',
				'front_border_type'					=>	'',
				'front_border_width'				=>	'',
				'front_border_color'				=>	'',
				'title_back'							=>	'',
				'title_back_size'					=>	'',
				'title_back_color'					=>	'',
				'description_back'					=>	'',
				'description_back_size'				=>	'',
				'description_back_color'			=>	'',
				'back_background_type'				=>	'',
				'back_background_color'				=>	'',
				'back_border_type'					=>	'',
				'back_border_width'					=>	'',
				'back_border_color'					=>	'',
				'custom_link_back'					=>	'',
				'link_text'							=>	'',
				'link_url'							=>	'',
				'link_size'							=>	'',
				'link_color'							=>	'',
				'box_roundness'						=>	'',
				'box_reflection'					=>	'',
				'height_type'						=>	'',
				'box_height'							=>	'',
				'box_extra_class'					=>	'',
				'css'								=>	''
			),$atts));
			
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			$nxr_rollover_id = "nxr-rollover-".uniqid();
			
			
			/*
				Icon shortcode exec
			*/
			if( $icon_type == 'selector' && !empty($icon) ) {
				$rollover_icon = '<div class="front-side-icon" style="color:'.$icon_color.'">'.do_shortcode('[icon name="icon '.$icon.'" size="'.$icon_size.'px"]').'</div>';
			}
			elseif($icon_type == 'custom-icon' && !empty($icon_img)){
				$nxr_rollover_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $icon_img, 'thumb_size' => 'full', 'class' => "" ) );
				$rollover_icon = '<div class="rollover-tab"><div class="rollover-cel"><div class="nxr-rollover-customimg" style="width:'.$img_width.'px;">'.$nxr_rollover_img_array['thumbnail'].'</div></div></div>';
			}
			
			
			
			if ( $box_roundness !== '0') {
			$border_roundness .= 'border-radius:'.$box_roundness.'px;-moz-border-radius:'.$box_roundness.'px;-webkit-border-radius:'.$box_roundness.'px;-o-border-radius:'.$box_roundness.'px;';
			}
			
			switch($front_background_type){
				case 'none':
					$front_bg = 'none';
				break;
				
				case 'custom-front-color':
					$front_bg = $front_background_color;
				break;
			}
			
			switch($front_border_type){
				case 'none':
					$front_bd = '0px';
				break;
				
				case 'custom-front-border':
					$front_bd = $front_border_width.'px solid '.$front_border_color;
				break;
			}
			
			switch($back_background_type){
				case 'none':
					$back_bg = 'none';
				break;
				
				case 'custom-back-color':
					$back_bg = $back_background_color;
				break;
			}
			
			switch($back_border_type){
				case 'none':
					$back_bd = '0px';
				break;
				
				case 'custom-back-border':
					$back_bd = $back_border_width.'px solid '.$back_border_color;
				break;
			}
			
			if($height_type == "custom") {
				$height = 'height:'.$box_height.'px;';
			}
			
			$output .='<script type="text/javascript">
						jQuery(document).ready(function() {
							jQuery("#'.$nxr_rollover_id.'").find(".front-side").css("background","'.$front_bg.'").css("border","'.$front_bd.'");
							jQuery("#'.$nxr_rollover_id.'").mouseenter(function() {
								jQuery(this).find(".front-side").css("background","'.$back_bg.'");
								jQuery(this).addClass("nxr-scale-fix");
							}).mouseleave(function() {
								jQuery(this).find(".front-side").css("background","'.$front_bg.'");
								jQuery(this).removeClass("nxr-scale-fix");
							});
							jQuery("#'.$nxr_rollover_id.'").bind({
								click: function() {
									jQuery(this).find(".front-side").addClass("rollclick");
									jQuery(this).find(".back-side").addClass("rollclick");
								},
								mouseleave: function() {
									jQuery(this).find(".front-side").removeClass("rollclick");
									jQuery(this).find(".back-side").removeClass("rollclick");
								}
							});
						});
					</script>';
			
			$output .= '<div id="'.$nxr_rollover_id.'" class="nxr-rollover-panel '.$box_extra_class.' ' . esc_attr( $css_class ) . '">';
				$output .= '<div class="rollover-container" style="'.$height.'">';
					$output .= '<div class="front-side" style="'.$border_roundness.'">';
						if($box_reflection == 'yes') {
							$output .= '<div class="reflection"></div>';
						}
						if(!empty($title_front)) {
							$output .='<span class="front-side-title" style="font-size:'.$title_front_size.'px;color:'.$title_front_color.';">'.$title_front.'</span>';
						}
						$output .= $rollover_icon;
					$output .= '</div>';
					$output .= '<div class="back-side" style="background:'.$back_bg.'; border:'.$back_bd.';'.$border_roundness.'">';
						if($box_reflection == 'yes') {
							$output .= '<div class="reflection"></div>';
						}
						if(!empty($title_back)) {
							$output .= '<span class="rollover-back-title" style="font-size:'.$title_back_size.'px;color:'.$title_back_color.';">'.$title_back.'</span>';
							$output .= '<span class="rollover-back-bar"></span>';
						}
						if(!empty($description_back)) {
							$output .='<span class="rollover-back-description" style="font-size:'.$description_back_size.'px;color:'.$description_back_color.';">'.$description_back.'</span>';
						}
						if($link_url !== '' && $custom_link_back !== ''){
							$link_prefix = '<span class="rollover-back-link">';
								if($link_size !== '' && $link_color !== '')
									$link_style = 'style="font-size:'.$link_size.'px; color:'.$link_color.';"';
										if($link_url !== ''){								
											$href = vc_build_link($link_url);
												if($href['url'] !== "") {
													$link_target = (isset($href['target'])) ? ' target="'.$href['target'].'"' : '';
													$link_title = (isset($href['title'])) ? ' title="'.$href['title'].'"' : '';
												}
											$link_prefix .= '<a href = "'.$href['url'].'"'.$link_target.$link_title.' '.$link_style.'>';
											$link_sufix .= '</a>';
										}
							$link_sufix .= '</span>';
							$output .= $link_prefix.'&raquo;'.$link_text.$link_sufix;
						}
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
			
			/*
				Return the output
			*/
			return $output;		
		}
	}
	new NXR_VC_ROLLOVERPANEL;
}