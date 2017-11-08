<?php
/*
* Add-on Name: NXR MailChimp Collector
* Add-on URI: http://nexarthemes.com/plugins/nexarthemes-extender/
* Based on MailChimp API, version 1.3
* Since: 1.0
* Author: Eugen Petcu
*/
if(!class_exists('NXR_VC_MCHIMP_COLLECTOR')) {
	class NXR_VC_MCHIMP_COLLECTOR extends WPBakeryShortCode {
		
		function __construct() {
			add_action('admin_init', array($this, 'nxr_mchimp_collector_init'));
			
			add_shortcode( 'nxr_mailchimpcollector', array($this, 'nxr_mchimp_collector') );
		}
		
		
		/*
			Visual Composer mapping function
			Public API
			Refference:	http://kb.wpbakery.com/index.php?title=Vc_map
			Example:		http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
		*/
		function nxr_mchimp_collector_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"				=>	__("NXR MailChimp Collector", "nxrextender"),
					   "holder"			=>	"div",
					   "base"				=>	"nxr_mailchimpcollector",
					   "class"				=>	"",
					   "icon"				=>	"nxr_mailchimpcollector",
					   "category"			=>	__("NexarThemes Extender", "nxrextender"),
					   "description"		=>	__("Collect email addresses to your MailChimp list.", "nxrextender"),
					   "content_element"	=>	true,
					   "params"			=>	array(
							array(
								"type"				=>	"textfield",
								"class"				=>	"",
								"heading"			=>	__("MailChimp API Key", "nxrextender"),
								"param_name"		=>	"nxr_mc_apikey",
								"value"				=>	"",
								"description"		=>	__('Your MailChimp API Key. Grab an API Key from <a href="http://admin.mailchimp.com/account/api/" target="_blank">http://admin.mailchimp.com/account/api/</a>.', "nxrextender"),
								"save_always" 		=>	true,		
							),
							array(
								"type"				=>	"textfield",
								"class"				=>	"",
								"heading"			=>	__("MailChimp List ID", "nxrextender"),
								"param_name"		=>	"nxr_mc_listid",
								"value"				=>	"",
								"save_always" 		=>	true,	
							),
							array(
								"type"				=>	"checkbox",
								"heading"			=>	__("Enable anti-spam disclaimer", "nxrextender"),
								"param_name"		=>	"nxr_mc_enable_disclaimer",
								"description"		=>	__("If checked, 'We'll never spam or give this address away' will be displayed.", "nxrextender"),
								"value"				=>	array( esc_html__("Yes, please", "nxrextender") => "yes" ),
								"save_always" 		=>	true,
						    ),
							array(
								"type"				=>	"checkbox",
								"heading"			=>	__("Collect name too", "nxrextender"),
								"param_name"		=>	"nxr_mc_collect_name",
								"description"		=>	__("If checked, 'Name' will be required too.", "nxrextender"),
								"value"				=>	array( esc_html__("Yes, please", "nxrextender") => "yes" ),
								"save_always" 		=>	true,
						    ),
							array(
								"type"				=>	"checkbox",
								"heading"			=>	__("Collect last name too", "nxrextender"),
								"param_name"		=>	"nxr_mc_collect_lastname",
								"description"		=>	__("If checked, 'Lastname' will be required too.", "nxrextender"),
								"value"				=>	array(	__( "Yes, please", "nxrextender") => "yes" ),
								"save_always" 		=>	true,
						    ),
							array(
								"type"				=>	"colorpicker",
								"class"				=>	"",
								"heading"			=>	__("Background color of inputs", "nxrextender"),
								"param_name"		=>	"nxr_mc_collect_inputbgcolor",
								"value"				=>	"#333333",
								"description"		=>	__("Use the color picker.", "nxrextender"),	
								"save_always" 		=>	true,				
							),
							array(
								"type"				=>	"colorpicker",
								"class"				=>	"",
								"heading"			=>	__("Text color of inputs", "nxrextender"),
								"param_name"		=>	"nxr_mc_collect_inputstextcolor",
								"value"				=>	"#333333",
								"description"		=>	__("Color of the text inside the inputs", "nxrextender"),
								"save_always" 		=>	true,				
							),
							array(
								"type"				=>	"colorpicker",
								"class"				=>	"",
								"heading"			=>	__("Background color of button", "nxrextender"),
								"param_name"		=>	"nxr_mc_collect_btnbgcolor",
								"value"				=>	"#333333",
								"description"		=>	__("Use the color picker.", "nxrextender"),	
								"save_always" 		=>	true,
							),
							array(
								"type"				=>	"colorpicker",
								"class"				=>	"",
								"heading"			=>	__("Text color of button", "nxrextender"),
								"param_name"		=>	"nxr_mc_collect_btntextcolor",
								"value"				=>	"#333333",
								"description"		=>	__("Color of the text inside the button", "nxrextender"),
								"save_always" 		=>	true,
							),
							array(
								"type"				=>	"colorpicker",
								"class"				=>	"",
								"heading"			=>	__("NO-SPAM & response text color", "nxrextender"),
								"param_name"		=>	"nxr_mc_collect_nstextcolor",
								"value"				=>	"#333333",
								"description"		=>	__("Color of the NO-SPAM text", "nxrextender"),	
								"save_always" 		=>	true,
							),
							array(
								"type"				=>	"textfield",
								"class"				=>	"",
								"heading"			=>	__("Extra class", "nxrextender"),
								"param_name"		=>	"extra_class",
								"value"				=>	"",
								"description"		=>	__("Extra CSS class for custom CSS", "nxrextender")	,
								"save_always" 		=>	true,
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
		
		function nxr_mchimp_collector ($atts) {
			/*
				Incldue the MC API
			*/
			require_once( plugin_dir_path( dirname(__FILE__) ).'includes/apis/MCAPI.class.php');
			// plugins_url('../includes/gfx/',__FILE__);
			
			
			/*
				Empty vars declaration
			*/
			$output = $nxr_mc_apikey = $nxr_mc_listid = $nxr_mc_enable_disclaimer = $nxr_mc_collect_name = $nxr_mc_collect_lastname = 
			$nxr_mc_collect_inputbgcolor = $nxr_mc_collect_inputstextcolor = $nxr_mc_collect_btnbgcolor = $nxr_mc_collect_btntextcolor = 
			$nxr_mc_collect_nstextcolor = $extra_class = $inputs_style = $submit_style = $texts_style = $css = '';

			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'nxr_mc_apikey'						=>	'',
				'nxr_mc_listid'						=>	'',
				'nxr_mc_enable_disclaimer'			=>	'',
				'nxr_mc_collect_name'				=>	'',
				'nxr_mc_collect_lastname'			=>	'',
				'nxr_mc_collect_inputbgcolor'		=>	'',
				'nxr_mc_collect_inputstextcolor'	=>	'',
				'nxr_mc_collect_btnbgcolor'			=>	'',
				'nxr_mc_collect_btntextcolor'		=>	'',
				'nxr_mc_collect_nstextcolor'		=>	'',
				'extra_class'						=>	'',
				'css'								=>	'',
			), $atts));
			
			if( empty($nxr_mc_apikey) ) {return 'Please insert your MailChimp API Key!';}	
			if( empty($nxr_mc_listid) ) {return 'Please insert your MailChimp list ID!';}
			
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			/*
				Text inputs color & background color
			*/
			if(!empty($nxr_mc_collect_inputbgcolor)) {
				$inputs_style .= ' background-color:'.$nxr_mc_collect_inputbgcolor.'; ';
			}
			if(!empty($nxr_mc_collect_inputstextcolor)) {
				$inputs_style .= ' color:'.$nxr_mc_collect_inputstextcolor.'; ';
			}
			/*
				Submit btn color and text color
			*/
			if(!empty($nxr_mc_collect_btnbgcolor)) {
				$submit_style .= ' background-color:'.$nxr_mc_collect_btnbgcolor.'; ';
			}
			if(!empty($nxr_mc_collect_btntextcolor)) {
				$submit_style .= ' color:'.$nxr_mc_collect_btntextcolor.'; ';
			}
			/*
				No-spam and response text color
			*/
			if(!empty($nxr_mc_collect_nstextcolor)) {
				$texts_style .= ' color:'.$nxr_mc_collect_nstextcolor.'; ';
			}
			
			if(isset($_GET['submit'])) {
				
				$nxr_mc_name = ( isset($_GET['nxr_mc_name']) && !empty($_GET['nxr_mc_name']) ? strip_tags($_GET['nxr_mc_name']) : 'No name');
				$nxr_mc_lastname = ( isset($_GET['nxr_mc_lastname']) && !empty($_GET['nxr_mc_lastname']) ? strip_tags($_GET['nxr_mc_lastname']) : 'No last name');
			
				$mc_response = $this->storeAddress($nxr_mc_apikey, $nxr_mc_listid, $nxr_mc_name, $nxr_mc_lastname );
				
				
			
				$output .= '<!-- Begin MailChimp Signup Form -->
					<div class="nxr_mc_collector '.$extra_class.' ' . esc_attr( $css_class ) . '">
						<form id="nxr_mc_signup_'.$nxr_mc_listid.'" action="#" method="get">	  
							<span id="nxr_mc_response" class="nxr_mc_response" style="'.$texts_style.'">'.$mc_response.'</span>
							'.($nxr_mc_collect_name == 'yes' ? '<input type="text" name="nxr_mc_name" id="nxr_mc_name" class="nxr_mc_name" placeholder="'.__("Your name", 'nxrextender').'" style="'.$inputs_style.'" />' : '<input type="hidden" name="nxr_mc_name" id="nxr_mc_name" class="nxr_mc_name" value="" style="'.$inputs_style.'" />').'
							'.($nxr_mc_collect_lastname == 'yes' ? '<input type="text" name="nxr_mc_lastname" id="nxr_mc_lastname" class="nxr_mc_lastname" placeholder="'.__("Your last name", 'nxrextender').'" style="'.$inputs_style.'" />' : '<input type="hidden" name="nxr_mc_lastname" id="nxr_mc_lastname" class="nxr_mc_lastname" value="" />').'
							<input type="text" name="nxr_mc_email" id="nxr_mc_email" class="nxr_mc_email" placeholder="'.__("Email Address", 'nxrextender').'" style="'.$inputs_style.'" />
							<input type="submit" name="submit" value="'.__("Join",'nxrextender').'" class="nxr_mc_btn" style="'.$submit_style.'" />
							'.($nxr_mc_enable_disclaimer == 'yes' ? '<div class="nxr_mc_no_spam" style="'.$texts_style.'">'.__('We\'ll never spam or give this address away','nxrextender').'</div>' :'').'
						</form>
					</div>
					<!--End mc_embed_signup-->';
			}
			else{
				$output .= '<!-- Begin MailChimp Signup Form -->
				<div class="nxr_mc_collector '.$extra_class.' ' . esc_attr( $css_class ) . '">
					<form id="nxr_mc_signup_'.$nxr_mc_listid.'" action="#" method="get">	  
						'.($nxr_mc_collect_name == 'yes' ? '<input type="text" name="nxr_mc_name" id="nxr_mc_name" class="nxr_mc_name" placeholder="'.__("Your name", 'nxrextender').'" style="'.$inputs_style.'" />' : '<input type="hidden" name="nxr_mc_name" id="nxr_mc_name" class="nxr_mc_name" value="" style="'.$inputs_style.'" />').'
						'.($nxr_mc_collect_lastname == 'yes' ? '<input type="text" name="nxr_mc_lastname" id="nxr_mc_lastname" class="nxr_mc_lastname" placeholder="'.__("Your last name", 'nxrextender').'" style="'.$inputs_style.'" />' : '<input type="hidden" name="nxr_mc_lastname" id="nxr_mc_lastname" class="nxr_mc_lastname" value="" />').'
						<input type="text" name="nxr_mc_email" id="nxr_mc_email" class="nxr_mc_email" placeholder="'.__("Email Address", 'nxrextender').'" style="'.$inputs_style.'" />
						<input type="submit" name="submit" value="'.__("Join",'nxrextender').'" class="nxr_mc_btn" style="'.$submit_style.'" />
						'.($nxr_mc_enable_disclaimer == 'yes' ? '<div class="nxr_mc_no_spam" style="'.$texts_style.'">'.__('We\'ll never spam or give this address away','nxrextender').'</div>' :'').'
					</form>
				</div>
				<!--End mc_embed_signup-->';
			}
			return $output;
		}
		
		function storeAddress($your_apikey, $my_list_unique_id, $name, $surname){
		
		/*
			Validation
		*/
		if( !isset($_GET['nxr_mc_email']) ){ return "No email address provided"; } 
	
		if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $_GET['nxr_mc_email'])) {
			return "Email address is invalid"; 
		}
	
		/*
			Grab an API Key from http://admin.mailchimp.com/account/api/
		*/
		$api = new MCAPI($your_apikey);
		
		/*
			Grab your List's Unique Id by going to http://admin.mailchimp.com/lists/
			Click the "settings" link for the list - the Unique Id is at the bottom of that page.
		*/ 
		
		$merge_vars = array('FNAME'=>$name, 'LNAME'=>$surname);
		
		/*
			Return the succes or error message
		*/
		if($api->listSubscribe($my_list_unique_id, strip_tags($_GET['nxr_mc_email']), $merge_vars) === true) {
			/*
				It worked!
			*/
			return esc_html__("Success! Check your email to confirm sign up.", "nxrextender");
		}else{
			/*
				An error ocurred, return error message	
			*/
			return esc_html__("Error: %s", $api->errorMessage, "nxrextender");
		}
		
	}
	}
	new NXR_VC_MCHIMP_COLLECTOR;
}