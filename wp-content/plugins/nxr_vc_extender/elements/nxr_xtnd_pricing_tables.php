<?php
/*
* Add-on Name: Pricing Tables
* Add-on URI: http://nexarthemes.com/plugins/nexarthemes-extender/
* Since: 1.0
* Author: Eugen Petcu
*/
if(!class_exists('NXR_VC_PRICINGTABLES')) {
	class NXR_VC_PRICINGTABLES extends WPBakeryShortCodesContainer {
		var $team_nav_color;
		var $team_nav_min_height;

		function __construct() {
			add_action('admin_init', array($this, 'add_pricingtable'));
			
			add_shortcode( 'nxr_pricing_tables', array($this,'nxr_pricing_tables') );
			
			add_shortcode( 'nxr_pricing_table', array($this,'nxr_pricing_table') );
			
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
		function add_pricingtable() {
			if(function_exists('vc_map')) {
				/*
					Parent element
				*/
				vc_map(
					array(
					   "name"						=>	__("Pricing Tables", "nxrextender"),
					   "base"						=>	"nxr_pricing_tables",
					   "class"						=>	"",
					   "icon"						=>	"nxr_pricing_tables",
					   "category"					=>	__("NexarThemes Extender", "nxrextender"),
					   "as_parent"					=>	array( "only" => "nxr_pricing_table" ),
					   "description"				=>	__("Pricing Tables block", "nxrextender"),
					   "content_element"			=>	true,
					   "show_settings_on_create"	=>	true,
					   "deprecated"					=>	'4.5',
					   "params"						=>	array(
							array(
								"type"				=>	"colorpicker",
								"class"				=>	"",
								"heading"			=>	__("Pricing table header text color:", "nxrextender"),
								"param_name"		=>	"pt_header_text_color",
								"value"				=>	"#7e7e7e",
								"dependency"		=>	array(
									"not_empty"		=>	true
								),
								"save_always" 		=>	true,
							),
							array(
								"type"				=>	"colorpicker",
								"class"				=>	"",
								"heading"			=>	__("Pricing table body text color:", "nxrextender"),
								"param_name"		=>	"pt_body_text_color",
								"value"				=>	"#7e7e7e",
								"dependency"		=>	array(
									"not_empty"		=>	true
								),
								"save_always" 		=>	true,
							),
							array(
								"type"				=>	"textfield",
								"class"				=>	"",
								"heading"			=>	__("Extra class", "nxrextender"),
								"param_name"		=>	"extra_class",
								"value"				=>	"",
								"save_always" 		=>	true,
							),
							array(
								"type"				=>	"heading",
								"sub_heading"		=>	"This is a global setting page for the whole \"Pricing Tables\" block. Add some \"Tables\" in the container row to make it complete.",
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
					   "name"					=>	__("Pricing Table", "nxrextender"),
					   "holder"				=>	"div",
					   "base"					=>	"nxr_pricing_table",
					   "class"					=>	"",
					   "icon"					=>	"",
					   "content_element"		=>	true,
					   "as_child"				=>	array( "only" => "nxr_pricing_tables" ),
					   "params"					=>	array(
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Package name", "nxrextender"),
								"param_name"	=>	"package_name",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Recommended package", "nxrextender"),
								"param_name"	=>	"recommended_package",
								"value"			=>	array(
									__( 'No', 'nxrextender' )	=> 'false',
									__( 'Yes', 'nxrextender' )	=> 'true',
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Package short text", "nxrextender"),
								"param_name"	=>	"package_short_text",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Package price", "nxrextender"),
								"param_name"	=>	"package_price",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Cost is per:", "nxrextender"),
								"param_name"	=>	"cost_is_per",
								"value"			=>	array(
									__( 'Day', 'nxrextender' )		=> 'day',
									__( 'Week', 'nxrextender' )		=> 'week',
									__( 'Month', 'nxrextender' )	=> 'mo',
									__( 'Year', 'nxrextender' )		=> 'year',
									__( 'Custom', 'nxrextender' )	=> 'custom',
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Custom cost per:", "nxrextender"),
								"param_name"	=>	"custom_per_cost",
								"value"			=>	"item",
								"description"	=>	__("Set cost per item, package etc.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"cost_is_per",
									"value"		=>	array( "custom" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Currency:", "nxrextender"),
								"param_name"	=>	"pt_currency",
								"value"			=>	array(
									__( 'Dollar', 'nxrextender' )	=> '$',
									__( 'Euro', 'nxrextender' )		=> '&euro;',
									__( 'Custom', 'nxrextender' )	=> 'custom',
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Custom currency", "nxrextender"),
								"param_name"	=>	"custom_currency",
								"value"			=>	"",
								"dependency"	=>	array(
									"element"	=>	"pt_currency",
									"value"		=>	array( "custom" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Price color", "nxrextender"),
								"param_name"	=>	"price_color",
								"value"			=>	"#fff",
								"description"	=>	__("If empty, white will be used", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Header background color", "nxrextender"),
								"param_name"	=>	"header_color",
								"value"			=>	"#dff0d8",
								"description"	=>	__("If empty, a default color will be used", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Header background second color", "nxrextender"),
								"param_name"	=>	"header_sec_color",
								"value"			=>	"#eef4ea",
								"description"	=>	__("If empty, a default color will be used", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Second background color", "nxrextender"),
								"param_name"	=>	"body_bg_color",
								"value"			=>	"",
								"description"	=>	__("This is background color for price area. If empty, white will be used", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Package content background color", "nxrextender"),
								"param_name"	=>	"package_bg_color",
								"value"			=>	"",
								"description"	=>	__("This is background color for package content area. If empty, white will be used", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textarea_html",
								"class"			=>	"",
								"heading"		=>	__("Table body content", "nxrextender"),
								"param_name"	=>	"content",
								"value"			=>	"",
								"description"	=>	__("Add a unordered list (ul) with package elements", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Buy button text", "nxrextender"),
								"param_name"	=>	"buy_btn_text",
								"value"			=>	"",
								"description"	=>	__("Buy Now! or Start Now! or whatever you want... ", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Button action URL", "nxrextender"),
								"param_name"	=>	"btn_url",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Buy button position", "nxrextender"),
								"param_name"	=>	"buy_btn_position",
								"value"			=>	array(
									__( 'In header', 'nxrextender' )	=> 'header',
									__( 'In footer', 'nxrextender' )	=> 'footer',
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Buy button color", "nxrextender"),
								"param_name"	=>	"buy_btn_color",
								"value"			=>	"",
								"description"	=>	__("If empty, a transparent backgroung button will be rendered.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Buy button border color", "nxrextender"),
								"param_name"	=>	"buy_btn_border_color",
								"value"			=>	"",
								"description"	=>	__("If empty, no border will be rendered", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Button border thickness", "nxrextender"),
								"param_name"	=>	"buy_btn_border_width",
								"value"			=>	"",
								"min"			=>	1,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Thickness of the border (1-10).", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Button roundness", "nxrextender"),
								"param_name"	=>	"buy_btn_border_roundness",
								"value"			=>	'',
								"min"			=>	1,
								"max"			=>	6,
								"suffix"		=>	"px",
								"description"	=>	__("Button corners roundness (1-6).", "nxrextender"),
								"dependency"	=>	array(
									"element"		=>	"buy_btn_border_width",
									"not_empty"	=>	true
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Button size", "nxrextender"),
								"param_name"	=>	"buy_btn_size",
								"value"			=>	array(
									__( 'Default', 'nxrextender' )		=> 'default-size',
									__( 'Large', 'nxrextender' )		=> 'btn-lg',
									__( 'Small', 'nxrextender' )		=> 'btn-sm',
									__( 'Extra small', 'nxrextender' )	=> 'btn-xs',
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Table side margins (left & right)", "nxrextender"),
								"param_name"	=>	"table_margins",
								"description"	=>	__("Add a margin to left and right of the table, in pixles", "nxrextender"),
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Table border thickness", "nxrextender"),
								"param_name"	=>	"table_border_thickness",
								"description"	=>	__("Add a border the table, in pixles", "nxrextender"),
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Table border color", "nxrextender"),
								"param_name"	=>	"table_border_color",
								"value"			=>	"",
								"dependency"	=>	array(
									"element"	=>	"table_border_thickness",
									"not_empty"	=>	true
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Table extra class", "nxrextender"),
								"param_name"	=>	"table_extra_class",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							
					   )
					) 
				);
			}
		}
		
		function nxr_pricing_tables($atts, $content = null ) {
			
			/*
				Empty vars declaration
			*/
			$output = $pt_header_text_color = $pt_body_text_color = $extra_class = $css = '';
			
			/*
				How many tables do we have?!
			*/
			$number_of_tables = substr_count($content,'[nxr_pricing_table');
			
			/*
				Set table width
			*/
			$table_width = 99 / $number_of_tables;
			
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'pt_header_text_color'		=>	'#7e7e7e',
				'pt_body_text_color'		=>	'#7e7e7e', 
				'extra_class'				=>	'',
				'css'						=>	''
			), $atts));
			
			$GLOBALS['nxr_pricing_table_width'] = $table_width;
			$GLOBALS['nxr_pricing_table_ptbtc'] = $pt_body_text_color;
			$GLOBALS['nxr_pricing_table_pthtc'] = $pt_header_text_color;
			
			$output .='<script type="text/javascript">
						jQuery(document).ready(function() {
							jQuery(".nxr_pricing_table ul").each(function() {
								jQuery(this).addClass("nxr_price-group");
							});
							jQuery(".nxr_pricing_table li").each(function() {
								jQuery(this).addClass("nxr_price-group-item");
							});
						});
				</script>';
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			$output .= '<div class="nxr_pricing_table_pack ' . esc_attr( $css_class ) . ' '.(!empty($extra_class) ? $extra_class : '').'">';
				$output .= do_shortcode($content);
			$output .= '</div>';
			
			/*
				Return the output
			*/	
			return $output;
		}
		
		function nxr_pricing_table($atts, $content = null) {
		
		/*
			Empty vars declaration
		*/
		$output = $package_name = $recommended_package = $package_short_text = $package_price = $cost_is_per = $cost_per = 
		$table_border = $custom_per_cost = $pt_currency = $custom_currency = $price_color = $header_color = $header_sec_color = 
		$body_bg_color = $package_bg_color = $pt_content = $buy_btn_text = $btn_url = $buy_btn_position = $buy_btn_color = 
		$buy_btn_border_color = $buy_btn_border_width = $buy_btn_border_roundness = $buy_btn_size = $table_margins = 
		$table_border_thickness = $table_border_color = $table_extra_class = '';
		
		
		
		/*
			WordPress function to extract shortcodes attributes
			Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
		*/
		extract(shortcode_atts(array(
			'package_name'					=>	'',
			'recommended_package'			=>	'',
			'package_short_text'			=>	'',
			'package_price'					=>	'',
			'cost_is_per'					=>	'',
			'custom_per_cost'				=>	'',
			'pt_currency'					=>	'',
			'custom_currency'				=>	'',
			'price_color'					=>	'',
			'header_color'					=>	'',
			'header_sec_color'				=>	'',
			'body_bg_color'					=>	'',
			'package_bg_color'				=>	'',
			'pt_content'						=>	'',
			'buy_btn_text'					=>	'',
			'btn_url'						=>	'',
			'buy_btn_position'				=>	'',
			'buy_btn_color'					=>	'',
			'buy_btn_border_color'			=>	'',
			'buy_btn_border_width'			=>	'',
			'buy_btn_border_roundness'		=>	'',
			'buy_btn_size'					=>	'',
			'table_margins'					=>	'',
			'table_border_thickness'		=>	'',
			'table_border_color'			=>	'',
			'table_extra_class'				=>	'',
		), $atts));
		
		/*
			Button color styles
		*/
		
		$output .='<script type="text/javascript">
					jQuery(document).ready(function() {
						jQuery(".btn-nxr").css("color","'.$GLOBALS['nxr_pricing_table_pthtc'].'");
						
						jQuery(".btn-nxr").mouseenter(function() {
							jQuery(this).css("color","'.$GLOBALS['nxr_pricing_table_ptbtc'].'");
						}).mouseleave(function() {
							jQuery(this).css("color","'.$GLOBALS['nxr_pricing_table_pthtc'].'");
						});
					});
			</script>';
		
		/*
			End Button color styles
		*/
		
		if($pt_currency == 'custom') {$pt_currency = $custom_currency;}
		
		if($cost_is_per == 'custom') {
			$cost_per .= $custom_per_cost;
		}
		else {
			$cost_per .= $cost_is_per;
		}
		
		/*
			Does the table have margins?
		*/
		if(!empty($table_margins)){
			//$GLOBALS['nxr_pricing_table_width'] = $GLOBALS['nxr_pricing_table_width'] - $table_margins;
			$table_margins = ' margin-left:'.$table_margins.'px; margin-right:'.$table_margins.'px; ';
		}
		
		/*
			Does the table has border?
		*/
		if(!empty($table_border_thickness) && !empty($table_border_color) ){
			$table_border = ' border:'.$table_border_thickness.'px solid '.$table_border_color.'; ';
		}
		
		/*
			Does the table has background color?
		*/
		if(!empty($package_bg_color) ){
			$package_bg_color = ' background-color:'.$package_bg_color.'; ';
		}

		$output .= '<div class="nxr_pricing_table '.(!empty($table_extra_class) ? $table_extra_class : '').'" style="width:'.$GLOBALS['nxr_pricing_table_width'].'%; '.$table_margins.' '.$table_border.' '.$package_bg_color.'">';
			$output .= '<div class="panel-heading" style="background-color:'.$header_color.';"><h4 style="color:'.$GLOBALS['nxr_pricing_table_pthtc'].';">'.$package_name.'</h4></div>';
			$output .= '<div class="panel-body" style="background-color:'.$body_bg_color.';">';
			$output .= ($recommended_package == "true" ? '<div class="recommended"></div>' : '');
			$output .= '<h1 style="color:'.$price_color.';"><sup>'.$pt_currency.'</sup><span class="nxr_package_price">'.$package_price.'</span><sub>/'.$cost_per.'</sub></h1>';
			$output .= '<p style="color:'.$GLOBALS['nxr_pricing_table_ptbtc'].';">'.$package_short_text.'</p>';
			// header buy button
			if( $buy_btn_position == 'header' ){ $output .='<a href="'.$btn_url.'" class="nxr_buy_btn"><span class="btn btn-nxr '.$buy_btn_size.'" style="
																									'.(!empty($buy_btn_border_width) ? 'border:'.$buy_btn_border_width.'px solid '.$buy_btn_border_color.';' : 'border:none;' ).' 
																									'.(!empty($buy_btn_color) ? 'background-color:'.$buy_btn_color.';' : 'background-color:transparent;' ).'
																									'.(!empty($buy_btn_border_roundness) ? 'border-radius:'.$buy_btn_border_roundness.'px;' : 'border-radius:0;' ).'">'.$buy_btn_text.'</span></a>'; }
			$output .= '</div>';
				//$output .= $pt_content;
				$output .= wpb_js_remove_wpautop($content, true);
			// footer buy button
			if( $buy_btn_position == 'footer' ){ $output .='<div class="panel-footer" style="'.(!empty($buy_btn_border_roundness) ? ' border-bottom-right-radius:'.$buy_btn_border_roundness.'px;border-bottom-left-radius:'.$buy_btn_border_roundness.'px;' : 'border-radius:0;' ).
																									' background-color:'.$header_sec_color.';border:none;">
																									<a href="'.$btn_url.'" class="nxr_buy_btn">
																									<span class="btn btn-nxr '.$buy_btn_size.'" style="
																									'.(!empty($buy_btn_border_width) ? 'border:'.$buy_btn_border_width.'px solid '.$buy_btn_border_color.';' : 'border:none;' ).' 
																									'.(!empty($buy_btn_color) ? 'background-color:'.$buy_btn_color.';' : 'background-color:transparent;' ).'
																									'.(!empty($buy_btn_border_roundness) ? 'border-radius:'.$buy_btn_border_roundness.'px;' : 'border-radius:0;' ).'">'.$buy_btn_text.'</span>
																									</a></div>'; }
		$output .= '</div>';
		
		
		
		/*
			Return the output
		*/
		return $output;
	}
	}
	new NXR_VC_PRICINGTABLES;
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_nxr_pricing_tables extends WPBakeryShortCodesContainer {
	}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_nxr_pricing_table extends WPBakeryShortCode {
	}
}