<?php
/*
* Add-on Name: CountDown
* Add-on URI: http://nexarthemes.com/plugins/nexarthemes-extender/
* Since: 2.2
* Author: Eugen Petcu
* Update & Bug fixes: Eugen Petcu
* Inspired from: http://keith-wood.name/countdown.html (MIT License)
*/
if(!class_exists('NXR_VC_COUNTDOWN') && class_exists('WPBakeryShortCode') ) {
	class NXR_VC_COUNTDOWN extends WPBakeryShortCode {
		
		function __construct() {
			add_action('admin_init', array($this, 'nxr_countdown_init'));
			
			add_shortcode( 'nxr_countdown', array($this, 'nxr_countdown') );
		}
		
		/*
			Visual Composer mapping function
			Public API
			Refference:	http://kb.wpbakery.com/index.php?title=Vc_map
			Example:	http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
		*/
		function nxr_countdown_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"				=>	__("NXR CountDown", "nxrextender"),
					   "holder"				=>	"div",
					   "base"				=>	"nxr_countdown",
					   "class"				=>	"",
					   "icon"				=>	"nxr_countdown",
					   "description"		=>	__("Countdown to a given date", "nxrextender"),
					   "category"			=>	__("NexarThemes Extender", "nxrextender"),
					   "content_element"	=>	true,
					   "params"				=>	array(
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Day:", "nxrextender"),
								"param_name"	=>	"countdown_day",
								"value"			=>	array(
										"01"		=>	"01",
										"02"		=>	"02",
										"03"		=>	"03",
										"04"		=>	"04",
										"05"		=>	"05",
										"06"		=>	"06",
										"07"		=>	"07",
										"08"		=>	"08",
										"09"		=>	"09",
										"10"		=>	"10",
										"11"		=>	"11",
										"12"		=>	"12",
										"13"		=>	"13",
										"14"		=>	"14",
										"15"		=>	"15",
										"16"		=>	"16",
										"17"		=>	"17",
										"18"		=>	"18",
										"19"		=>	"19",
										"20"		=>	"20",
										"21"		=>	"21",
										"22"		=>	"22",
										"23"		=>	"23",
										"24"		=>	"24",
										"25"		=>	"25",
										"26"		=>	"26",
										"27"		=>	"27",
										"28"		=>	"28",
										"29"		=>	"29",
										"30"		=>	"30",
										"31"		=>	"31",
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Month:", "nxrextender"),
								"param_name"	=>	"countdown_month",
								"value"			=>	array(
										"January"	=>	"January",
										"February"	=>	"February",
										"March"		=>	"March",
										"April"		=>	"April",
										"May"		=>	"May",
										"June"		=>	"June",
										"July"		=>	"July",
										"August"	=>	"August",
										"September"	=>	"September",
										"October"	=>	"October",
										"November"	=>	"November",
										"December"	=>	"December",
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Year:", "nxrextender"),
								"param_name"	=>	"countdown_year",
								"value"			=>	array(
										"2015"		=>	"2015",
										"2016"		=>	"2016",
										"2017"		=>	"2017",
										"2018"		=>	"2018",
										"2019"		=>	"2019",
										"2020"		=>	"2020",
										"2021"		=>	"2021",
										"2022"		=>	"2022",
										"2023"		=>	"2023",
										"2024"		=>	"2024",
										"2025"		=>	"2025",
										"2026"		=>	"2026",
										"2027"		=>	"2027",
										"2028"		=>	"2028",
										"2029"		=>	"2029",
										"2030"		=>	"2030",
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Hour:", "nxrextender"),
								"param_name"	=>	"countdown_hour",
								"value"			=>	array(
										"01"		=>	"01",
										"02"		=>	"02",
										"03"		=>	"03",
										"04"		=>	"04",
										"05"		=>	"05",
										"06"		=>	"06",
										"07"		=>	"07",
										"08"		=>	"08",
										"09"		=>	"09",
										"10"		=>	"10",
										"11"		=>	"11",
										"12"		=>	"12",
										"13"		=>	"13",
										"14"		=>	"14",
										"15"		=>	"15",
										"16"		=>	"16",
										"17"		=>	"17",
										"18"		=>	"18",
										"19"		=>	"19",
										"20"		=>	"20",
										"21"		=>	"21",
										"22"		=>	"22",
										"23"		=>	"23",
										"24"		=>	"24",
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Minute:", "nxrextender"),
								"param_name"	=>	"countdown_minute",
								"value"			=>	array(
										"01"		=>	"01",
										"02"		=>	"02",
										"03"		=>	"03",
										"04"		=>	"04",
										"05"		=>	"05",
										"06"		=>	"06",
										"07"		=>	"07",
										"08"		=>	"08",
										"09"		=>	"09",
										"10"		=>	"10",
										"11"		=>	"11",
										"12"		=>	"12",
										"13"		=>	"13",
										"14"		=>	"14",
										"15"		=>	"15",
										"16"		=>	"16",
										"17"		=>	"17",
										"18"		=>	"18",
										"19"		=>	"19",
										"20"		=>	"20",
										"21"		=>	"21",
										"22"		=>	"22",
										"23"		=>	"23",
										"24"		=>	"24",
										"25"		=>	"25",
										"26"		=>	"26",
										"27"		=>	"27",
										"28"		=>	"28",
										"29"		=>	"29",
										"30"		=>	"30",
										"31"		=>	"31",
										"32"		=>	"32",
										"33"		=>	"33",
										"34"		=>	"34",
										"35"		=>	"35",
										"36"		=>	"36",
										"37"		=>	"37",
										"38"		=>	"38",
										"39"		=>	"39",
										"40"		=>	"40",
										"41"		=>	"41",
										"42"		=>	"42",
										"43"		=>	"43",
										"44"		=>	"44",
										"45"		=>	"45",
										"46"		=>	"46",
										"47"		=>	"47",
										"48"		=>	"48",
										"49"		=>	"49",
										"50"		=>	"50",
										"51"		=>	"51",
										"52"		=>	"52",
										"53"		=>	"53",
										"54"		=>	"54",
										"55"		=>	"55",
										"56"		=>	"56",
										"57"		=>	"57",
										"58"		=>	"58",
										"59"		=>	"59",
										"60"		=>	"60",
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Counter font tag:", "nxrextender"),
								"param_name"	=>	"counter_font_tag",
								"value"			=>	array(
										"H1"	=>	"h1",
										"H2"	=>	"h2",
										"H3"	=>	"h3",
										"H4"	=>	"h4",
										"H5"	=>	"h5",
										"H6"	=>	"h6",
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Counter font color:", "nxrextender"),
								"param_name"	=>	"counter_font_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a color for your counter font.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Label font tag:", "nxrextender"),
								"param_name"	=>	"label_font_tag",
								"value"			=>	array(
										"H1"	=>	"h1",
										"H2"	=>	"h2",
										"H3"	=>	"h3",
										"H4"	=>	"h4",
										"H5"	=>	"h5",
										"H6"	=>	"h6",
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Label font color:", "nxrextender"),
								"param_name"	=>	"label_font_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a color for your label font.", "nxrextender"),
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
								'type'			=>	'css_editor',
								'heading'		=>	__( 'Css', 'nxrextender' ),
								'param_name'	=>	'css',
								'group'			=>	__( 'Design options', 'nxrextender' ),
							),
					   )
					) 
				);
			}
		}
		
		function nxr_countdown ($atts) {
			/*
				Include required JS and CSS files
			*/
			wp_enqueue_script('nxr-countdown_plugin');
			wp_enqueue_script('nxr-countdown');
			
			/*
				 Empty vars declaration
			*/
			$output = $countdown_day = $countdown_month = $countdown_year = $countdown_hour = $countdown_minute = $counter_font_tag = $counter_font_color = $label_font_tag = $label_font_color = $extra_class = $css = '';
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'countdown_day'		=>	'01',
				'countdown_month'	=>	'January',
				'countdown_year'	=>	'2016',
				'countdown_hour'	=>	'10',
				'countdown_minute'	=>	'10',
				'counter_font_tag'	=>	'h4',
				'counter_font_color'=>	'#ff0000',
				'label_font_tag'	=>	'h3',
				'label_font_color'	=>	'#ff0000',
				'extra_class'		=>	'',
				'css'				=>	'',
			), $atts));
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			$layout = '<div class=\"vc_row wpb_row vc_row-fluid\"><div class=\"wpb_column vc_column_container vc_col-sm-3\"><div class=\"wpb_wrapper\"><'.$counter_font_tag.' style=\"color:'.$counter_font_color.'\">{dn}</'.$counter_font_tag.'> <'.$label_font_tag.' style=\"color:'.$label_font_color.'\">{dl}</'.$label_font_tag.'></div></div><div class=\"wpb_column vc_column_container vc_col-sm-3\"><div class=\"wpb_wrapper\"><'.$counter_font_tag.' style=\"color:'.$counter_font_color.'\">{hn}</'.$counter_font_tag.'> <'.$label_font_tag.' style=\"color:'.$label_font_color.'\">{hl}</'.$label_font_tag.'></div></div><div class=\"wpb_column vc_column_container vc_col-sm-3\"><div class=\"wpb_wrapper\"><'.$counter_font_tag.' style=\"color:'.$counter_font_color.'\">{mn}</'.$counter_font_tag.'> <'.$label_font_tag.' style=\"color:'.$label_font_color.'\">{ml}</'.$label_font_tag.'></div></div><div class=\"wpb_column vc_column_container vc_col-sm-3\"><div class=\"wpb_wrapper\"><'.$counter_font_tag.' style=\"color:'.$counter_font_color.'\">{sn}</'.$counter_font_tag.'> <'.$label_font_tag.' style=\"color:'.$label_font_color.'\">{sl}</'.$label_font_tag.'></div></div></div>';
			
			$output .=	'<script>
			jQuery(function ($) {
				var austDay = new Date("'.$countdown_month.' '.$countdown_day.', '.$countdown_year.' '.$countdown_hour.':'.$countdown_minute.':00");
				$("#defaultCountdown").countdown({until: austDay, format: "DHMS", layout: "'.$layout.'"});
				$("#year").text(austDay.getFullYear());
			});
			</script>';
			
			$output	.=	'<div class="nxr_countdown '.esc_attr( $css_class ).' '.$extra_class.'" style="text-align:center;">';
			$output	.=	'<div id="defaultCountdown"></div>';
			$output	.=	'</div>';
						
			return $output;
		}
	}
	new NXR_VC_COUNTDOWN;
}