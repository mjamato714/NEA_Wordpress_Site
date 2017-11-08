<?php
/*
* Add-on Name: NXR Button
* Add-on URI: http://nexarthemes.com/plugins/nexarthemes-extender/
* Since: 1.0
* Author: Eugen Petcu
*/
if(!class_exists('NXR_VC_BUTTON')) {
	class NXR_VC_BUTTON extends WPBakeryShortCode {

		function __construct() {
			add_action('admin_init', array($this, 'nxr_button_init'));
			
			add_shortcode( 'nxr_button', array($this, 'nxr_button') );
		}
		
		/*
			Visual Composer mapping function
			Public API
			Refference:	http://kb.wpbakery.com/index.php?title=Vc_map
			Example:		http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
		*/
		function nxr_button_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"				=>	__("NXR Button", "nxrextender"),
					   "holder"			=>	"div",
					   "base"				=>	"nxr_button",
					   "class"				=>	"",
					   "icon"				=>	"nxr_button",
					   "description"		=>	__("Very configurable button", "nxrextender"),
					   "category"			=>	__("NexarThemes Extender", "nxrextender"),
					   "content_element"	=>	true,
					   "params"	=>	array(
						   array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Text on the button", "nxrextender"),
								"param_name"	=>	"nxr_buttontext",
								"value"			=>	__("Buy now!", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Text size (pixels)", "nxrextender"),
								"param_name"	=>	"nxr_buttontextsize",
								"value"			=>	"14",
								"save_always" 	=>	true,
							),
							array(
								 "type"			=>	"vc_link",
								 "class"		=>	"",
								 "heading"		=>	__("Button action URL","nxrextender"),
								 "param_name"	=>	"nxr_buttonurl",
								 "value"		=>	"",
								 "description"	=>	__("Set button link here.", "nxrextender"),
								 "save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Button alignment", "nxrextender"),
								"param_name"	=>	"nxr_btn_alignment",
								"value"			=>	array(	
									__( 'Left', 'nxrextender' )	=> 'left',
									__( 'Center', 'nxrextender' )	=> 'none',
									__( 'Right', 'nxrextender' )		=> 'right',
								),
								"save_always" 	=> true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Button text color", "nxrextender"),
								"param_name"	=>	"nxr_buttontextcolor",
								"value"			=>	"#808080",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Button text color on hover", "nxrextender"),
								"param_name"	=>	"nxr_buttontexthovercolor",
								"value"			=>	"#808080",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Button color", "nxrextender"),
								"param_name"	=>	"nxr_buttoncolor",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Button color on hover", "nxrextender"),
								"param_name"	=>	"nxr_buttoncolorhover",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Button width", "nxrextender"),
								"description"	=>	__("Insert only numeric values",'nxrextender'),
								"param_name"	=>	"nxr_buttonwidth",
								"value"			=>	"100",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Button width units", "nxrextender"),
								"param_name"	=>	"nxr_buttonwidthunits",
								"value"			=>	array(	
									__( 'Pixels', 'nxrextender' )	=> 'px',
									__( 'Percent', 'nxrextender' )	=> '%',
									__( 'Ems', 'nxrextender' )		=> 'em',
								),
								"save_always" 	=> true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Button height", "nxrextender"),
								"description"	=>	__("Insert only numeric values",'nxrextender'),
								"param_name"	=>	"nxr_buttonheight",
								"value"			=>	"60",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Button height units", "nxrextender"),
								"param_name"	=>	"nxr_buttonheightunits",
								"value"			=>	array(
									__( 'Pixels', 'nxrextender' ) 	=> 'px',
									__( 'Percent', 'nxrextender' )	=> '%',
									__( 'Ems', 'nxrextender' )		=> 'em',
								),
								"save_always" 	=> true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Button border weight", "nxrextender"),
								"description"	=>	__("Insert only numeric values. Pixels will be used.",'nxrextender'),
								"param_name"	=>	"nxr_buttonborderweight",
								"value"			=>	"1",	
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Button border color", "nxrextender"),
								"param_name"	=>	"nxr_buttonbodercolor",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Button border color on hover", "nxrextender"),
								"param_name"	=>	"nxr_buttonbordercolorhover",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Button roundness", "nxrextender"),
								"description"	=>	__("Insert only numeric values",'nxrextender'),
								"param_name"	=>	"nxr_buttonroundness",
								"value"			=>	"4",	
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon", "nxrextender"),
								"param_name"	=>	"nxr_hasicon",
								"value"			=>	array(
									__( 'No icon', 'nxrextender' ) 	=> 'noicon',
									__( 'Use icon', 'nxrextender' )	=> 'withicon',
								),
								"save_always" 	=> true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon position", "nxrextender"),
								"param_name"	=>	"nxr_iconposition",
								"value"			=>	array(
									__( 'Left', 'nxrextender' ) 	=> 'left',
									__( 'Right', 'nxrextender' )	=> 'right',
								),
								"save_always" 	=>	true,
								"dependency"	=>	array(
									"element"	=>	"nxr_hasicon",
									"value"		=>	array( "withicon")
								),
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon type", "nxrextender"),
								"param_name"	=>	"nxr_button_icontype",
								"value"			=>	array(
									__( 'Font Icon Browser', 'nxrextender' ) 	=> 'selector',
									__( 'Custom Image Icon', 'nxrextender' )	=> 'custom',
								),
								"save_always" 	=>	true,
								"description"	=>	__("Use an existing font icon or upload a custom image.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"nxr_hasicon",
									"value"		=>	array( "withicon" )
								),
							),
							array(
								"type"			=>	"icon_browser",
								"class"			=>	"",
								"heading"		=>	__("Select Icon ","nxrextender"),
								"param_name"	=>	"nxr_button_icon",
								"value"			=>	"icon",
								"description"	=>	__("Click on an icon to select it.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"nxr_button_icontype",
									"value"		=>	array( "selector" )
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"attach_image",
								"class"			=>	"",
								"heading"		=>	__("Upload Image Icon:", "nxrextender"),
								"param_name"	=>	"nxr_button_img",
								"admin_label"	=>	true,
								"value"			=>	"",
								"description"	=>	__("Upload the custom image icon.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"nxr_button_icontype",
									"value"		=>	array( "custom" )
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Icon size", "nxrextender"),
								"param_name"	=>	"nxr_button_iconsize",
								"value"			=>	"",
								"description"	=>	__("Enter value in pixels, example: 24", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"nxr_hasicon",
									"value"		=>	array( "withicon" )
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Extra class", "nxrextender"),
								"param_name"	=>	"nxr_button_extraclass",
								"value"			=>	"",
								"description"	=>	__("Enter a extra css class for this element, if you wish to override default css settings", "nxrextender"),
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
		
		function nxr_button ($atts) {
			/*
				 Include necessary JS and CSS
			*/
			wp_enqueue_script('nxr-vc-jquery-appear');
			
			/*
				 Empty vars declaration
			*/
			$output = $do_icon = $nxr_buttontext = $nxr_buttontextsize = $nxr_buttontextcolor = $nxr_buttontexthovercolor = 
			$nxr_buttoncolor = $nxr_btn_alignment = $nxr_buttoncolorhover = $nxr_buttonwidth = $nxr_buttonwidthunits = $nxr_buttonheight = 
			$nxr_buttonheightunits = $nxr_buttonborderweight = $nxr_buttonbodercolor = $nxr_buttonbordercolorhover = 
			$nxr_buttonroundness = $nxr_buttonurl = $nxr_hasicon = $nxr_iconposition = $nxr_button_icontype = 
			$nxr_button_icon = $nxr_button_img = $nxr_button_iconsize = 
			$nxr_button_extraclass = $link_target = $link_title = $nxr_button_id = $css = '';
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'nxr_buttontext'				=> '',
				'nxr_buttontextsize'			=> '',
				'nxr_buttontextcolor'			=> '',
				'nxr_buttontexthovercolor'		=> '',
				'nxr_buttoncolor'				=> '',
				'nxr_btn_alignment'				=> 'none',
				'nxr_buttoncolorhover'			=> '',
				'nxr_buttonwidth'				=> '',
				'nxr_buttonwidthunits'			=> '',
				'nxr_buttonheight'				=> '',
				'nxr_buttonheightunits'			=> '',
				'nxr_buttonborderweight'		=> '',
				'nxr_buttonbodercolor'			=> '',
				'nxr_buttonbordercolorhover'	=> '',
				'nxr_buttonroundness'			=> '',
				'nxr_buttonurl'					=> '',
				'nxr_hasicon'					=> '',
				'nxr_iconposition'				=> '',
				'nxr_button_icontype'			=> '',
				'nxr_button_icon'				=> '',
				'nxr_button_img'				=> '',
				'nxr_button_iconsize'			=> '',
				'nxr_button_extraclass'			=> '',
				'css'							=> ''
			), $atts));
			
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			/*
				Font icon or image icon?
			*/
			if( $nxr_button_icontype == 'selector' && !empty($nxr_button_icon) ) {
				$do_icon = do_shortcode('[icon name="'.$nxr_button_icon.'" size="'.$nxr_button_iconsize.'px" ]');
			}
			elseif($nxr_button_icontype == 'custom' && !empty($nxr_button_img)){
				// image icon...
				$nxr_button_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $nxr_button_img, 'thumb_size' => 'full', 'class' => "nxr_button_imgicon" ) );
				$do_icon = $nxr_button_img_array['thumbnail'];
			}
			
			$nxr_button_style = 'width:'.$nxr_buttonwidth.$nxr_buttonwidthunits.';height:'.$nxr_buttonheight.$nxr_buttonheightunits.';line-height:'.$nxr_buttonheight.$nxr_buttonheightunits.';';
			

			/*
				Font size...
			*/
			if( !empty($nxr_buttontextsize) && $nxr_buttontextsize > 0 ){
				$nxr_button_style .= 'font-size:'.$nxr_buttontextsize.'px;';
			}
			/*
				Rounded corners?
			*/
			if( !empty($nxr_buttonroundness) && $nxr_buttonroundness > 0 ){
				$nxr_button_style .= 'border-radius:'.$nxr_buttonroundness.'px; -moz-border-radius:'.$nxr_buttonroundness.'px; -webkit-border-radius:'.$nxr_buttonroundness.'px;';
			}
			
			$nxr_button_id = "nxr-button-".uniqid();
			
			
				$output .='<script type="text/javascript">
						jQuery(document).ready(function() { ';
							$output .= 'jQuery(".'.$nxr_button_id.'.nxr_button").css("background-color","'.$nxr_buttoncolor.'").css("display","block").css("margin-right","auto").css("margin-left","auto").css("float","'.$nxr_btn_alignment.'");';
							$output .= 'jQuery(".'.$nxr_button_id.'.nxr_button").css("color","'.$nxr_buttontextcolor.'");';
							if( !empty($nxr_buttonborderweight) && $nxr_buttonborderweight > 0 ) {
								$output .= 'jQuery(".'.$nxr_button_id.'.nxr_button").css("border","'.$nxr_buttonborderweight.'px solid '.$nxr_buttonbodercolor.'");';
							}
							$output .='jQuery(".'.$nxr_button_id.'.nxr_button").mouseenter(function() {';
								
								
								// Button border on hover
								if($nxr_buttonborderweight>0){
									$output .='jQuery(this).css("border","'.$nxr_buttonborderweight.'px solid '.$nxr_buttonbordercolorhover.'");';
								}
								// Button BG color on hover
								$output .='jQuery(this).css("background-color","'.$nxr_buttoncolorhover.'");';
								
								// Text color on hover
								$output .='jQuery(this).css("color","'.$nxr_buttontexthovercolor.'");';
								
								$output .='}).mouseleave(function() {';
									
									// Button BG color on normal state
									$output .='jQuery(this).css("background-color","'.$nxr_buttoncolor.'");';
									
									// Text color normal state
									$output .='jQuery(this).css("color","'.$nxr_buttontextcolor.'");';
									
									
									if( !empty($nxr_buttonborderweight) && $nxr_buttonborderweight > 0 ) {
								$output .= 'jQuery(this).css("border","'.$nxr_buttonborderweight.'px solid '.$nxr_buttonbodercolor.'");';
							}
									$output .='});';
				$output .='});</script>';
			
			$href = vc_build_link($nxr_buttonurl);
				if($href['url'] !== '') {
					$link_target = ( strlen( $href['target'] ) ? ' target="'.$href['target'].'" ' : '' );
					$link_title = ( strlen( $href['title'] ) ? ' title="'.$href['title'].'" ' : '' );
				}
			$output .= '<a href="'.$href['url'].'" '.$link_target.' '.$link_title.' class="nxr_button ' . esc_attr( $css_class ) . ' '.$nxr_button_id.' '.$nxr_button_extraclass.'" style="'.$nxr_button_style.'">';
				// NO ICON
				if( $nxr_hasicon == 'noicon' ){
					$output .= $nxr_buttontext;
				} else {
					// LEFT ICON
					if( $nxr_iconposition == 'left' ){
						$output .= $do_icon.' &nbsp;&nbsp; '.$nxr_buttontext;
					}
					// RIGHT ICON
					elseif( $nxr_iconposition == 'right' ){
						$output .= $nxr_buttontext.' &nbsp;&nbsp; '.$do_icon;
					}
				}		
			$output .='</a>';
			
			/*
				Return the output
			*/		
			return $output;
		}
	}
	new NXR_VC_BUTTON;
}