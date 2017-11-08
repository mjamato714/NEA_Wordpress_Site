<?php
/*
* Add-on Name: Google Maps
* Add-on URI: http://nexarthemes.com/plugins/nexarthemes-extender/
* Since: 1.0
* Add-on Author: Bogdan Costescu
*/

if(!class_exists('NXR_VC_GMAP')) {
	class NXR_VC_GMAP extends WPBakeryShortCode {
			
		function __construct() {
			add_action('admin_init', array($this, 'nxr_gmap_init'));
			
			add_shortcode('nxr_gmap', array( $this, 'nxr_g_map') );
			
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
		function nxr_gmap_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"				=>	__("NXR Google Map", "nxrextender"),
					   "base"				=>	"nxr_gmap",
					   "class"				=>	"",
					   "icon"				=>	"nxr_gmap",
					   "category"			=>	__("NexarThemes Extender", "nxrextender"),
					   "description"		=>	__("Google Map","nxrextender"),
					   "params" => array(
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Map name:", "nxrextender"),
								"param_name"	=>	"gmap_name",
								"value"			=>	"Sydney",
								"description"	=>	__("*Insert map name here. Make sure this map name is unique.", "nxrextender"),
								"save_always"	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Google Maps API Key:", "nxrextender"),
								"param_name"	=>	"google_maps_apikey",
								"value"			=>	"",
								"description"	=>	__("Get you own API key here: https://console.developers.google.com/apis/", "nxrextender"),
								"save_always"	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Latitude:", "nxrextender"),
								"param_name"	=>	"gmap_latitude",
								"value"			=>	"-33.8814454",
								"description"	=>	__("Insert latitude coordinate here.", "nxrextender"),
								"save_always"	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Longitude:", "nxrextender"),
								"param_name"	=>	"gmap_longitude",
								"value"			=>	"151.2226494",
								"description"	=>	__("Insert longitude coordinate here.", "nxrextender"),
								"save_always"	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Zoom Level:","nxrextender"),
								"param_name"	=>	"gmap_zoom",
								"value"			=>	18,
								"min"			=>	0,
								"max"			=>	20,
								"description"	=>	__("Zoom on location. Min value 0 (whole world), max value 20.", "nxrextender"),
								"save_always"	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Map Style:", "nxrextender"),
								"param_name"	=>	"gmap_style",
								"value"			=>	array(
										__( 'Google preset colors', 'nxrextender' )	=> 'gmap_style_normal',
										__( 'Greyscale', 'nxrextender' ) 			=> 'gmap_style_greyscale',
									),
								"description"	=>	__("Choose map style that suits your design.", "nxrextender"),
								"save_always"	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Marker Settings:", "nxrextender"),
								"param_name"	=>	"gmap_marker_settings",
								"value"			=>	array(
										__( 'Google default', 'nxrextender' )	=> 'gmap_marker_default',
										__( 'Plugin default', 'nxrextender' ) 	=> 'gmap_marker_plugin',
										__( 'Upload your own', 'nxrextender' ) 	=> 'gmap_marker_custom',
									),
								"description"	=>	__("Marker style settings.", "nxrextender"),
								"save_always"	=>	true,
							),
							array(
								"type"			=>	"attach_image",
								"class"			=>	"",
								"heading"		=>	__("Upload Marker Image:", "nxrextender"),
								"param_name"	=>	"marker_image",
								"value"			=>	"",
								"description"	=>	__("Upload marker custom image.", "nxrextender"),
								"dependency"	=>	array(
										"element"	=>	"gmap_marker_settings",
										"value"		=>	array( "gmap_marker_custom" ),
									),
								"save_always"	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Map Width:", "nxrextender"),
								"param_name"	=>	"gmap_width",
								"value"			=>	"640px",
								"description"	=>	__("Enter value in pixels. You can set also % values.", "nxrextender"),
								"save_always"	=>	true,
							),
							
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Map Height:", "nxrextender"),
								"param_name"	=>	"gmap_height",
								"value"			=>	"400px",
								"description"	=>	__("Enter value in pixels. You can set also % values.", "nxrextender"),
								"save_always"	=>	true,
							),
							array(
								"type"			=>	'checkbox',
								"heading"		=>	__("Disable zoom on mouse over scroll:", "nxrextender"),
								"param_name"	=>	"gmap_disablezoom",
								"description"	=>	__("If checked this will disable map zooming when scrolling over.", "nxrextender"),
								"value"			=>	array( esc_html__("Yes, please", "nxrextender") => 'yes' ),
								"save_always"	=>	true,
						    ),
							array(
								"type"			=>	'checkbox',
								"heading"		=>	__("Disable draggable map on mobile:", "nxrextender"),
								"param_name"	=>	"gmap_disabledraggable",
								"description"	=>	__("If checked this will disable dragging map on mobile.", "nxrextender"),
								"value"			=>	array( esc_html__("Yes, please", "nxrextender") => 'yes' ),
								"save_always"	=>	true,
						    ),
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Extra class", "nxrextender"),
								 "param_name"	=>	"gmap_extra_class",
								 "value"		=>	"",
								 "description"	=>	__("Add extra class name. You can use this class for your customizations.", "nxrextender"),
								 "save_always"	=>	true,
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
		
		function nxr_g_map($atts) {
			
			/*
				 Empty vars declaration
			*/
			$output = $gmap_name = $google_maps_apikey = $gmap_latitude = $gmap_longitude = $gmap_zoom = $gmap_style = $gmap_width = $gmap_height = $gmap_disabledraggable = $gmap_disablezoom = $scrollwheel = $gmap_extra_class = $gmap_style_var = $marker_url = $marker_img = $css = '';
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts( array(
				'gmap_name'				=>	'',
				'google_maps_apikey'	=>	'',
				'gmap_latitude'			=>	'',
				'gmap_longitude'		=>	'',
				'gmap_zoom'				=>	'',
				'gmap_width'				=>	'',
				'gmap_height'			=>	'',
				'gmap_disabledraggable'	=>	'',
				'gmap_disablezoom'		=>	'',
				'gmap_extra_class'		=>	'',
				'gmap_style'				=>	'',
				'gmap_marker_settings'	=>	'',
				'marker_image'			=>	'',
				'css'					=>	'',
			),$atts));
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			switch($gmap_style){
				case 'gmap_style_greyscale':
					$gmap_style_var = 'var featureOpts = [
											{
											  stylers: [
												{ "visibility": "on" },
												{ "weight": 1 },
												{ "saturation": -100 },
												{ "lightness": -8 },
												{ "gamma": 1.18 }
											  ]
											}
										];';
				break;
				
				case 'gmap_style_normal':
					$gmap_style_var = 'var featureOpts = [
											{
											  stylers: [
												{ "visibility": "on" },
												{ "weight": 1.1 },
												{ "saturation": 1 },
												{ "lightness": 1 },
												{ "gamma": 1 }
											  ]
											}
										];';
				break;
			}
			
			if($gmap_marker_settings == "gmap_marker_plugin"){
				$marker_url = plugins_url("../includes/gfx/elements-images/gmap-marker-nxr.png",__FILE__);
			} elseif($gmap_marker_settings == "gmap_marker_default"){
				$marker_url = "";
			} elseif($gmap_marker_settings == "gmap_marker_custom") {
				$marker_img = wp_get_attachment_image_src( $marker_image, 'large');
				$marker_url = $marker_img[0];
			}
			
			if($gmap_disablezoom == 'yes')
			{
				$scrollwheel = 'false';
			}
			elseif($gmap_disablezoom !== 'yes')
			{
				$scrollwheel = 'true';
			}
			
			if($gmap_disabledraggable == 'yes')
			{
				$draggable_var = 'var isDraggable = document.body.clientWidth > 480 ? true : false; // If document (your website) is wider than 480px, isDraggable = true, else isDraggable = false';
			}
			elseif($gmap_disabledraggable !== 'yes')
			{
				$draggable_var = 'var isDraggable = document.body.clientWidth > 480 ? true : true; // If document (your website) is wider than 480px, isDraggable = true, else isDraggable = false';
			}
			
			$id = "nxr".uniqid();
			$output .= ' <script>
							function initMap() {								
							'. $draggable_var .'
							var map_'.$id.';
							var gmap_location_'.$id.' = new google.maps.LatLng('.$gmap_latitude.', '.$gmap_longitude.');
							var GMAP_MODULE_'.$id.' = "custom_style";
								'.$gmap_style_var.'
								var mapOptions = {
									zoom: '.$gmap_zoom.',
									scrollwheel: '.$scrollwheel.',
									draggable: isDraggable,
									center: gmap_location_'.$id.',
									mapTypeControlOptions: {
										mapTypeIds: [google.maps.MapTypeId.ROADMAP, GMAP_MODULE_'.$id.']
									},
									mapTypeId: GMAP_MODULE_'.$id.'
								};
								map_'.$id.' = new google.maps.Map(document.getElementById("'.$id.'"), mapOptions);
								marker_'.$id.' = new google.maps.Marker({
									map: map_'.$id.',
									draggable: false,
									animation: google.maps.Animation.DROP,
									position: gmap_location_'.$id.',
									icon: "'.$marker_url.'"
								  });
								google.maps.event.addListener(marker_'.$id.', "click", function() {
									if (marker_'.$id.'.getAnimation() != null) {
										marker_'.$id.'.setAnimation(null);
									} else {
										marker_'.$id.'.setAnimation(google.maps.Animation.BOUNCE);
									}
								});
								var styledMapOptions = {
									name: "'.$gmap_name.'"
								};
								var customMapType_'.$id.' = new google.maps.StyledMapType(featureOpts, styledMapOptions);
								map_'.$id.'.mapTypes.set(GMAP_MODULE_'.$id.', customMapType_'.$id.');
							}

						</script><script async defer src="https://maps.googleapis.com/maps/api/js?v=3&key='.$google_maps_apikey.'&callback=initMap"
  type="text/javascript"></script>';

			$output .= '<div id="'.$id.'" class="nxr-map-canvas '.$gmap_extra_class.' ' . esc_attr( $css_class ) . '" style="width:'.$gmap_width.';height:'.$gmap_height.';"></div>';
			
			/*
				Return the output
			*/
			return $output;		
		}
	}
	new NXR_VC_GMAP;
}