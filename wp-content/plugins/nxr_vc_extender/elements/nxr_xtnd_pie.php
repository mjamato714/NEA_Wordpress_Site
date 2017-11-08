<?php
/*
* Add-on Name: Pie Chart
* Add-on URI: http://nexarthemes.com/plugins/nexarthemes-extender/
* Based on Rendro Easy Pie Chart: https://github.com/rendro/easy-pie-chart
* Since: 1.0
* Author: Eugen Petcu
*/
if(!class_exists('NXR_VC_PIE')) {
	class NXR_VC_PIE extends WPBakeryShortCode {

		function __construct() {
			add_action('admin_init', array($this, 'nxr_pie_init'));
			
			add_shortcode( 'nxr_pie_chart', array($this, 'nxr_pie') );
		}
		
		
		/*
			Visual Composer mapping function
			Public API
			Refference:	http://kb.wpbakery.com/index.php?title=Vc_map
			Example:		http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
		*/	
		function nxr_pie_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"				=>	__("NXR Pie Chart", "nxrextender"),
					   "holder"			=>	"div",
					   "base"				=>	"nxr_pie_chart",
					   "class"				=>	"",
					   "icon"				=>	"nxr_pie_chart",
					   "category"			=>	__("NexarThemes Extender", "nxrextender"),
					   "description"		=>	__("Animated pie chart", "nxrextender"),
					   "front_enqueue_js"	=>	"",
					   "content_element"	=>	true,
					   "params"			=>	array(
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Pie title", "nxrextender"),
								"param_name"	=>	"pie_title",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textarea_html",
								"class"			=>	"",
								"heading"		=>	__("Pie text", "nxrextender"),
								"param_name"	=>	"content",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								 "type"			=>	"vc_link",
								 "class"		=>	"",
								 "heading"		=>	__("Pie link to","nxrextender"),
								 "param_name"	=>	"gotourl",
								 "value"		=>	"",
								 "description"	=>	__("Link pie text to URL.", "nxrextender"),
								 "save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Pie size", "nxrextender"),
								"param_name"	=>	"pie_size",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Bar width", "nxrextender"),
								"param_name"	=>	"bar_width",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Pie percent", "nxrextender"),
								"param_name"	=>	"pie_percent",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Pie percent font size", "nxrextender"),
								"param_name"	=>	"nxr_pie_percent_size",
								"value"			=>	"30",
								"description"	=>	__("Enter value in pixels, example: 30", "nxrextender")	,
								"save_always" 	=>	true,		
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Back line color:", "nxrextender"),
								"param_name"	=>	"back_line_color",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Front line color:", "nxrextender"),
								"param_name"	=>	"front_line_color",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Scale color:", "nxrextender"),
								"param_name"	=>	"scale_color",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon to display:", "nxrextender"),
								"param_name"	=>	"icon_type",
								"value"			=>	array(
										__( 'Font Icon Browser', 'nxrextender' ) => 'selector',
										__( 'Custom Image Icon', 'nxrextender' ) => 'custom',
									),
								"save_always"	=> true,
							),
							array(
								"type"			=>	"icon_browser",
								"class"			=>	"",
								"heading"		=>	__("Select Icon", "nxrextender"),
								"param_name"	=>	"icon",
								"value"			=>	"",
								"dependency"	=>	array(
										"element"		=>	"icon_type",
										"value"			=>	array("selector"),
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
										"element"		=>	"icon_type",
										"value"			=>	array("custom"),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon color:", "nxrextender"),
								"param_name"	=>	"icon_color",
								"value"			=>	"#808080",
								"dependency"	=>	array(
										"element"		=>	"icon_type",
										"value"			=>	array("selector"),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Icon size", "nxrextender"),
								"param_name"	=>	"nxr_pie_icnsize",
								"value"			=>	"",
								"description"	=>	__("Enter value in pixels, example: 30", "nxrextender")	,
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Extra class", "nxrextender"),
								"param_name"	=>	"nxr_pie_extraclass",
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
		
		function nxr_pie( $atts, $content = null ) {
			/*
				Include required JS on front-end
			*/
			wp_enqueue_script('nxr-vc-jquery-appear');
			wp_enqueue_script('nxr-vc-jquery-easing');
			wp_enqueue_script('nxr-vc-jquery-easypiechart');
			
			/*
				Empty vars declaration
			*/
			$output = $pie_title = $gotourl = $pie_percent = $scale_color = $pie_size = $nxr_pie_percent_size = $bar_width = 
			$back_style = $icon_color = $back_line_color = $front_line_color = $icon_type = $icon = $icon_img = $nxr_pie_icnsize = $nxr_pie_extraclass = $css = '';
			
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'pie_title'					=>	'',
				'gotourl'					=>	'', 
				'pie_percent'				=>	'80', // %
				'nxr_pie_percent_size'		=>	'',
				'scale_color'				=>	'#808080',
				'pie_size'					=>	'80', // px
				'bar_width'					=>	'4', //px
				'back_style'					=>	'dashed',
				'back_line_color'			=>	'#e2e1dc',
				'front_line_color'			=>	'#80c8ac',
				'icon_type'					=>	'',
				'icon'						=>	'',
				'icon_img'					=>	'',
				'icon_color'					=>	'',
				'nxr_pie_icnsize'			=>	'',
				'nxr_pie_extraclass'		=>	'',
				'css'						=>	''
			), $atts));
			
			$uniqueID = "nxr_piechart_".mt_rand(999, 9999999);
			
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
			
			/*
				Do the icon, font or custom image
			*/
			if( $icon_type == 'selector' && !empty($icon) ) {
				$do_icon = do_shortcode('[icon name="'.$icon.'" size="'.$nxr_pie_icnsize.'px" height="'.$nxr_pie_icnsize.'px" color="'.$icon_color.'"]');
			}
			elseif($icon_type == 'custom' && !empty($icon_img)){
				/* Image icon... */
				$nxr_piechart_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $icon_img, 'thumb_size' => 'full', 'class' => "nxr_piechart_imgicon" ) );
				$do_icon = $nxr_piechart_img_array['thumbnail'];
			}
			
			$output .='<script type="text/javascript">
						jQuery(document).ready(function() {
							
							jQuery("#'.$uniqueID.(!empty($nxr_pie_extraclass) ? '.'.$nxr_pie_extraclass : '').'.nxr_pie_chart i").css("color","'.$icon_color.'");
							jQuery("#'.$uniqueID.(!empty($nxr_pie_extraclass) ? '.'.$nxr_pie_extraclass : '').'.nxr_pie_chart span.percent").css("font-size","'.$nxr_pie_percent_size.'px");
							
							jQuery("#'.$uniqueID.(!empty($nxr_pie_extraclass) ? '.'.$nxr_pie_extraclass : '').'.nxr_pie_chart").appear(function() {
							  jQuery("#'.$uniqueID.(!empty($nxr_pie_extraclass) ? '.'.$nxr_pie_extraclass : '').'.nxr_pie_chart .chart").easyPieChart({
									easing: "easeOutBounce",
									barColor:"'.$front_line_color.'",
									trackColor:"'.$back_line_color.'",
									scaleColor:"'.$scale_color.'",
									animate: 3500,
									size:"'.$pie_size.'",
									lineWidth:"'.$bar_width.'",
									onStep: function(from, to, percent) {
										jQuery(this.el).find(".percent").text(Math.round(percent));
									}
								});
								var chart = window.chart = jQuery("#'.$uniqueID.(!empty($nxr_pie_extraclass) ? '.'.$nxr_pie_extraclass : '').'.nxr_pie_chart .chart").data("easyPieChart");
							});
						});
				</script>';
			
			$output .= '<div id="'.$uniqueID.'" class="nxr_pie_chart '.$nxr_pie_extraclass.' ' . esc_attr( $css_class ) . '">';
				$output .='<span class="chart" data-percent="'.$pie_percent.'">';
					if(!empty($icon)) { $output .= '<span style="color:'.$back_line_color.'">'.$do_icon.'</span>'; } else { $output .= '<span>&nbsp;</span>'; }
					$output .='<span class="percent" style="color:'.$front_line_color.'"></span>';
				$output .='</span>';
				if(!empty($content)) { $output .= $content; }
				if(!empty($pie_text)) { $output .='<p>'.$pie_text.'</p>'; }
				$href = vc_build_link($gotourl);
				if($href['url'] !== '') {
					$link_target = (isset($href['target'])) ? 'target="'.$href['target'].'"' : '';
					$link_title = (isset($href['title'])) ? 'title="'.$href['title'].'"' : '';
				}
				if(!empty($href['url'])) { $output .='<p><a href="'.$href['url'].'" '.$link_target.' '.$link_title.' class="morelink-white">READ MORE</a></p>'; }
			$output .= '</div>';
			
			/*
				Return the output
			*/	
			return $output;
		}
	}
	new NXR_VC_PIE;
}