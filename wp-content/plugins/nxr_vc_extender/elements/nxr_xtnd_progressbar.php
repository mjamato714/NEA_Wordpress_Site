<?php
/*
* Add-on Name: NXR Progress Bar
* Add-on URI: http://nexarthemes.com/plugins/nexarthemes-extender/
* Based on Bootstrap
* Since: 1.0
* Author: Eugen Petcu
*/
if(!class_exists('NXR_VC_PROGRESSBAR')) {
	class NXR_VC_PROGRESSBAR extends WPBakeryShortCode {

		function __construct() {
			add_action('admin_init', array($this, 'nxr_progressbar_init'));
			
			add_shortcode( 'nxr_progressbar', array($this, 'nxr_progressbar') );
			
			
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
		function nxr_progressbar_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"				=>	__("NXR Progress Bar", "nxrextender"),
					   "holder"			=>	"div",
					   "base"				=>	"nxr_progressbar",
					   "class"				=>	"",
					   "icon"				=>	"nxr_progressbar",
					   "description"		=>	__("Progress bar with advanced parameters", "nxrextender"),
					   "category"			=>	__("NexarThemes Extender", "nxrextender"),
					   "content_element"	=>	true,
					   "params"				=>	array(
						   array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon Type:", "nxrextender"),
								"param_name"	=>	"nxr_progressbar_icontype",
								"value"			=>	array(
										__( 'Font Icon Browser', 'nxrextender' )	=> 'selector',
										__( 'Custom Image Icon', 'nxrextender' )	=> 'custom',
									),
								"save_always" 	=> true,
								"description"	=>	__("Use an existing font icon or upload a custom image.", "nxrextender"),
							),
							array(
								"type"			=>	 "icon_browser",
								"class"			=>	"",
								"heading"		=>	__("Select Icon:", "nxrextender"),
								"param_name"	=>	"nxr_progressbar_icon",
								"value"			=>	"icon",
								"description"	=>	__("Click on an icon to select it.", "nxrextender"),
								"dependency"	=>	array(
										"element"		=>	"nxr_progressbar_icontype",
										"value"			=>	array( "selector" ),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Icon Size:", "nxrextender"),
								"param_name"	=>	"nxr_progressbar_icnsize",
								"value"			=>	25,
								"min"			=>	12,
								"max"			=>	72,
								"suffix"		=>	"px",
								"description"	=>	__("Select icon size.", "nxrextender"),
								"dependency"	=>	array(
										"element"		=>	"nxr_progressbar_icontype",
										"value"			=>	array( "selector" ),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon Color:", "nxrextender"),
								"param_name"	=>	"nxr_progressbar_icncolor",
								"value"			=>	"#222222",
								"description"	=>	__("Select prefered color for your icon.", "nxrextender"),
								"dependency"	=>	array(
										"element"	=>	"nxr_progressbar_icontype",
										"value"		=>	array( "selector" ),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"attach_image",
								"class"			=>	"",
								"heading"		=>	__("Upload Image Icon:", "nxrextender"),
								"param_name"	=>	"nxr_progressbar_img",
								"admin_label"	=>	true,
								"value"			=>	"",
								"description"	=>	__("Upload the custom image icon.", "nxrextender"),
								"dependency"	=>	array(
										"element"	=>	"nxr_progressbar_icontype",
										"value"		=>	array( "custom" ),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Image Icon Width:", "nxrextender"),
								"param_name"	=>	"nxr_progressbar_imgwidth",
								"value"			=>	48,
								"min"			=>	16,
								"max"			=>	512,
								"suffix"		=>	"px",
								"description"	=>	__("Provide image width.", "nxrextender"),
								"dependency"	=>	array(
										"element"	=>	"nxr_progressbar_icontype",
										"value"		=>	array( "custom" ),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Progress Bar Title:", "nxrextender"),
								"param_name"	=>	"nxr_progressbar_title",
								"value"			=>	"Awesome Progress Bar",
								"description"	=>	__("Title for progress bar.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Title HTML Format", "nxrextender"),
								"param_name"	=>	"nxr_progressbar_title_format",
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
								"heading"		=>	__("Progress Bar Title Color:", "nxrextender"),
								"param_name"	=>	"nxr_progressbar_title_color",
								"value"			=>	"#808080",
								"description"	=>	__("Select color for progress bar title.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Progress Bar Base Color:", "nxrextender"),
								"param_name"	=>	"nxr_progressbar_basecolor",
								"value"			=>	"#808080",
								"description"	=>	__("Bar background color.", "nxrextender"),	
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Progress Bar Fill Color:", "nxrextender"),
								"param_name"	=>	"nxr_progressbar_color",
								"value"			=>	"#F9464A",
								"description"	=>	__("Bar fill color.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Progress Bar Value:", "nxrextender"),
								"param_name"	=>	"nxr_progressbar_value",
								"value"			=>	50,
								"min"			=>	0,
								"max"			=>	100,
								"suffix"		=>	"%",
								"description"	=>	__("Progress bar filling value %.", "nxrextender"),	
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Progress Bar Filling Time:", "nxrextender"),
								"param_name"	=>	"nxr_progressbar_filltime",
								"value"			=>	1,
								"min"			=>	1,
								"max"			=>	15,
								"suffix" 		=>	"seconds",							
								"description"	=>	__("Filling duration measured in seconds.", "nxrextender"),	
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Progress Bar Weight:", "nxrextender"),
								"param_name"	=>	"nxr_progressbar_weight",
								"value"			=>	3,
								"min"			=>	1,
								"max"			=>	30,
								"suffix"		=>	"px",
								"description"	=>	__("The bar weight in pixels.", "nxrextender"),	
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Progress Bar Style:", "nxrextender"),
								"param_name"	=>	"nxr_progressbar_type",
								"value"			=>	array(
										__( 'Simple', 'nxrextender' )					=> '',
										__( 'With Stripes', 'nxrextender' )				=> 'nxr_striped',
										__( 'With Animated Stripes', 'nxrextender' )	=> 'nxr_striped nxr_animated_striped',
									),
								"save_always" 	=> true,
								"description"	=>	__("Select progress bar style from the dropdown.", "nxrextender"),
							),
							array(
								"type"			=>	"checkbox",
								"heading"		=>	__("Hide progress bar value marker:", "nxrextender"),
								"param_name"	=>	"nxr_progressbar_marker",
								"description"	=>	__("If checked this will hide value marker.", "nxrextender"),
								"value"			=>	array( esc_html__("Yes, please", "nxrextender") => "yes" ),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Extra Class:", "nxrextender"),
								"param_name"	=>	"nxr_progressbar_extraclass",
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
		
		function nxr_progressbar ($atts) {
			
		/*
			Include required scripts
		*/
		wp_enqueue_script('nxr-vc-jquery-appear');
		wp_enqueue_script('nxr-vc-progressbar');
		
		
		/*
			Empty vars declaration
		*/
		$output = $do_icon = $nxr_progressbar_title = $nxr_progressbar_title_format = $nxr_progressbar_title_color = $nxr_progressbar_basecolor = $nxr_progressbar_color = 
		$nxr_progressbar_value = $nxr_progressbar_filltime = $nxr_progressbar_weight = $nxr_progressbar_type = $nxr_progressbar_icontype = 
		$nxr_progressbar_icon = $nxr_progressbar_img = $nxr_progressbar_imgwidth = $nxr_progressbar_icnsize = $nxr_progressbar_icncolor = 
		$nxr_progressbar_marker = $nxr_progressbar_extraclass = $css = '';
		
		
		/*
			WordPress function to extract shortcodes attributes
			Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
		*/
		extract(shortcode_atts(array(
			'nxr_progressbar_title'		=> '',
			'nxr_progressbar_title_format'=> '',
			'nxr_progressbar_title_color'=> '',
			'nxr_progressbar_basecolor'	=> '',
			'nxr_progressbar_color'		=> '',
			'nxr_progressbar_value'		=> '',
			'nxr_progressbar_filltime'	=> '',
			'nxr_progressbar_weight'	=> '',
			'nxr_progressbar_type'		=> '',
			'nxr_progressbar_icontype'	=> '',
			'nxr_progressbar_icon'		=> '',
			'nxr_progressbar_img'		=> '',
			'nxr_progressbar_imgwidth'	=> '',
			'nxr_progressbar_icnsize'	=> '',
			'nxr_progressbar_icncolor'	=> '',
			'nxr_progressbar_marker'	=> '',
			'nxr_progressbar_extraclass'=> '',
			'css'						=>	''
		), $atts));
		
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
		
		$bar_id = 'nxr_progressbar_'.uniqid();
		
		/*
			Do the icon
			Font icon or image icon...
		*/
		if( $nxr_progressbar_icontype == 'selector' && !empty($nxr_progressbar_icon) ) {
			$do_icon = '<div class="nxr-progb-icon" style="padding-right:'.$nxr_progressbar_icnsize / 2 .'px; width:'.$nxr_progressbar_icnsize.'px; height:'.$nxr_progressbar_icnsize.'px;">'.do_shortcode('[icon name="'.$nxr_progressbar_icon.'" size="'.$nxr_progressbar_icnsize.'px" height="'.$nxr_progressbar_icnsize.'px" color="'.$nxr_progressbar_icncolor.'"]').'</div>';
		}
		/* Image icon */
		elseif($nxr_progressbar_icontype == 'custom' && !empty($nxr_progressbar_img)){
			$nxr_progressbar_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $nxr_progressbar_img, 'thumb_size' => 'full', 'class' => "nxr_progressbar_imgicon" ) );
			$do_icon = '<div class="nxr-progb-icon" style="padding-right:'.$nxr_progressbar_imgwidth / 2 .'px; width:'.$nxr_progressbar_imgwidth.'px;"><div style="width:'.$nxr_progressbar_imgwidth.'px;">'.$nxr_progressbar_img_array['thumbnail'].'</div></div>';
		}
		
		$output .='<div id="#'.$bar_id.'" class="nxr_progressbar '.$nxr_progressbar_extraclass.' ' . esc_attr( $css_class ) . '">';
			$output .= '<div class="nxr-progb-icontext">';
				$output .= $do_icon;
				$output .= '<div class="nxr-progb-text"><'.$nxr_progressbar_title_format.' style="color:'.$nxr_progressbar_title_color.';">'.$nxr_progressbar_title.'</'.$nxr_progressbar_title_format.'></div>';
			$output .= '</div>';
			$output .= '<div class="nxr_progressbarfull" style="height:'.$nxr_progressbar_weight.'px; background-color: '.$nxr_progressbar_basecolor.';">';
				$output .= '<div class="nxr_progressbarfill '.$nxr_progressbar_type.'" style="height: '.$nxr_progressbar_weight.'px; background-color: '.$nxr_progressbar_color.';" data-value="'.$nxr_progressbar_value.'" data-time="'.($nxr_progressbar_filltime*1000).'">';
					if($nxr_progressbar_marker !== 'yes') {
						$output .= '<span class="nxr_progressbarmarker">'.$nxr_progressbar_value.'%</span>';
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
	new NXR_VC_PROGRESSBAR;
}
