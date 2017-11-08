<?php
/*
* Add-on Name: Minimal Form
* Add-on URI: http://nexarthemes.com/plugins/nexarthemes-extender/
* Since: 1.1
* Add-on Author: Bogdan COSTESCU
*/
if(!class_exists('NXR_VC_MINIMALFORM')) {
	class NXR_VC_MINIMALFORM extends WPBakeryShortCodesContainer {
		
		function __construct() {
		add_action('admin_init', array($this, 'nxr_minimalform_init'));
		
		add_shortcode( 'nxr_minimal_form', array($this, 'nxr_minimal_form'));
		
		add_shortcode( 'nxr_minimal_input', array($this, 'nxr_minimal_input'));
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
		function nxr_minimalform_init() {
			if(function_exists('vc_map')) {
				/*
					parent element
				*/
				vc_map(
					array(
					   "name"						=>	__("NXR MinimalForm", "nxrextender"),
					   "base"						=>	"nxr_minimal_form",
					   "class"						=>	"",
					   "icon"						=>	"nxr_minimal_form",
					   "category"					=>	__("NexarThemes Extender", "nxrextender"),
					   "as_parent"					=>	array("only" =>	"nxr_minimal_input"),
					   "description"				=>	__("Minimal Form with advanced settings", "nxrextender"),
					   "content_element"			=>	true,
					   "show_settings_on_create"	=>	true,
					   "params"					=>	array(
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Form size settings:", "nxrextender"),
								"param_name"	=>	"form_size",
								"value"			=>	array(
										"Large"				=>	"large",
										"Medium"			=>	"medium",
										"Small"			 	=>	"small",
									),
								"description"	=>	__("Choose from our 3 preset values.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Form style settings:", "nxrextender"),
								"param_name"	=>	"form_style",
								"value"			=>	array(
										"Standard"				=>	"standard",
										"Advanced"				=>	"advanced",
									),
								"description"	=>	__("Choose customization settings.", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Label text size:", "nxrextender"),
								"param_name"	=>	"label_text_size",
								"value"			=>	'',
								"min"			=>	8,
								"max"			=>	80,
								"suffix"		=>	"px",
								"description"	=>	__("Set label text size in pixels.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"form_style",
									"value"		=>	array( "advanced" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Label text color:", "nxrextender"),
								"param_name"	=>	"label_text_color",
								"value"			=>	"",
								"description"	=>	__("Set label text color.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"form_style",
									"value"		=>	array( "advanced" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Input text color:", "nxrextender"),
								"param_name"	=>	"input_text_color",
								"value"			=>	"",
								"description"	=>	__("Set input text color.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"form_style",
									"value"		=>	array( "advanced" )
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Next icon color:", "nxrextender"),
								"param_name"	=>	"next_icon_color",
								"value"			=>	"",
								"description"	=>	__("Set next icon color.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"form_style",
									"value"		=>	array( "advanced" ),
								),
								"save_always" 	=>	true,
							),
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Confirmation text:","nxrextender"),
								 "param_name"	=>	"confirmation_text",
								 "value"		=>	"Form has been submitted. Thank you for your time!",
								 "description"	=>	__("Thank you message after the form is submitted.","nxrextender"),
								 "save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Confirmation text size:", "nxrextender"),
								"param_name"	=>	"confirmation_text_size",
								"value"			=>	'',
								"min"			=>	8,
								"max"			=>	80,
								"suffix"		=>	"px",
								"description"	=>	__("Set confirmation text size in pixels.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"form_style",
									"value"		=>	array( "advanced" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Confirmation text color:", "nxrextender"),
								"param_name"	=>	"confirmation_text_color",
								"value"			=>	"",
								"description"	=>	__("Set confirmation text color.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"form_style",
									"value"		=>	array( "advanced" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Steps text color:", "nxrextender"),
								"param_name"	=>	"steps_text_color",
								"value"			=>	"",
								"description"	=>	__("Set steps text color.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"form_style",
									"value"		=>	array( "advanced" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Form input background color:", "nxrextender"),
								"param_name"	=>	"form_input_color",
								"value"			=>	"",
								"description"	=>	__("Set color for input background.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"form_style",
									"value"		=>	array( "advanced" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Progress bar background color:", "nxrextender"),
								"param_name"	=>	"progress_bar_bgcolor",
								"value"			=>	"",
								"description"	=>	__("Set the background color for progress bar.", "nxrextender"),
								"dependency"	=>	array(
									"element"	=>	"form_style",
									"value"		=>	array( "advanced" ),
								),
								"save_always" 	=>	true,
							),
							array(
								'type' => 'css_editor',
								'heading' => __( 'Css', 'nxrextender' ),
								'param_name' => 'css',
								'group' => __( 'Design options', 'nxrextender' ),
							),
						),
					"js_view"	=>	"VcColumnView"
				));
				
				
				/*
					Child element
				*/
				vc_map(
					array(
					   "name"				=>	__("Input field", "nxrextender"),
					   "holder"			=>	"div",
					   "base"				=>	"nxr_minimal_input",
					   "class"				=>	"",
					   "icon"				=>	"",
					   "content_element"	=>	true,
					   "as_child"			=>	array("only" =>	"nxr_minimal_form"),
					   "params"			=>	array(
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Label text:", "nxrextender"),
								"param_name"	=>	"label_text",
								"admin_label" 	=> 	true,
								"value"			=>	"",
								"description"	=>	__("Set a label text (eg. First name, Address, Telephone).", "nxrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Input type","nxrextender"),
								"param_name"	=>	"input_type",
								"value"			=>	array(
										"Text"		=>	"text",
										"E-mail"	=>	"e-mail",
										"Telephone"	=>	"telephone",
									),
								"description"	=>	__("Select input type. This will verify submitted data.", "nxrextender"),
								"save_always" 	=>	true,
							),
					   )
					) 
				);
			}
		}
		
		function send_AJAX_mail_before_submit() {
			//$email_param = WPBMap::getParam('nxr_minimal_form', 'email_form');
			
			$to = get_option('admin_email');
			$form_fields = $_POST['whatever'];
			
			$subject = 'E-mail sent through Minimal Form on '.get_site_url();
			$message = 'Got this response from a visitor through Minimal Form on your site:'."\r\n \r\n";
			
			foreach($form_fields as $key => $value){
				$message .= $key.': '.$value."\r\n";
			}
			
			check_ajax_referer('my_email_ajax_nonce');
			if (isset($_POST['action']) && $_POST['action'] == "mail_before_submit") {
				// send email  
				wp_mail( $to, $subject, $message, $headers, $attachments );
			}
		}
		
		function nxr_minimal_form($atts, $content = null ) {
			
			/*
				Include required scripts
			*/
			wp_enqueue_script('nxr-vc-modernizr');
			wp_enqueue_script('nxr-vc-classie');
			wp_enqueue_script('nxr-vc-stepsform');
			
			
			/*
				Empty vars declaration
			*/
			$output = $form_size = $form_style = $form_size_class = $label_text_size = $label_text_color = $input_text_color = $next_icon_color = $confirmation_text = $confirmation_text_size = $confirmation_text_color = $steps_text_color = $form_input_color = $progress_bar_bgcolor = $email_form = $confirmation_text_style = $progress_bar_style = $steps_text_style = $next_icon_style = $label_text_style = $input_text_style = $form_input_style = $nxr_minimal_sendmail = $css = '';
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'form_size'						=>	'',
				'form_style'						=>	'',
				'label_text_size'				=>	'',
				'label_text_color'				=>	'',
				'input_text_color'				=>	'',
				'next_icon_color'				=>	'',
				'confirmation_text'				=>	'',
				'confirmation_text_size'		=>	'',
				'confirmation_text_color'		=>	'',
				'steps_text_color'				=>	'',
				'form_input_color'				=>	'',
				'progress_bar_bgcolor'			=>	'',
				'email_form'						=>	'',
				'css'							=>	'',
			), $atts));
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			switch($form_size){
				case 'large':
					$form_size_class = 'simform-large';
				break;
				
				case 'medium':
					$form_size_class = 'simform-medium';
				break;
				
				case 'small':
					$form_size_class = 'simform-small';
				break;
			}
			
			switch($form_style){
				case 'standard':
					$confirmation_text_style = '';
					$progress_bar_style = '';
					$steps_text_style = '';
					$next_icon_style = '';
					$label_text_style = '';
					$input_text_style = '';
					$form_input_style = 'rgba(0,0,0,0.1)';
				break;
				
				case 'advanced':					
					$confirmation_text_style = 'style="'.($confirmation_text_size !== '' ? 'font-size:'.$confirmation_text_size.'px;' : '').''.($confirmation_text_color !== '' ? 'color:'.$confirmation_text_color.';' : '').'"';
					$progress_bar_style = 'style="'.($progress_bar_bgcolor !== '' ? 'background:'.$progress_bar_bgcolor : '').'"';
					$steps_text_style = 'style="'.($steps_text_color !== '' ? 'color:'.$steps_text_color : '').'"';
					$next_icon_style = 'style="'.($next_icon_color !== '' ? 'color:'.$next_icon_color : '').'"';
					$label_text_style = 'style="'.($label_text_size !== '' ? 'font-size:'.$label_text_size.'px;' : '').''.($label_text_color !== '' ? 'color:'.$label_text_color.';' : '').'"';
					$input_text_style = 'style="'.($input_text_color !== '' ? 'color:'.$input_text_color : '').'"';
					$form_input_style = ($form_input_color !== '' ? $form_input_color : 'rgba(0,0,0,0.1)');
				break;
			}
			
			
			
			$GLOBALS['nxr_label_style'] = $label_text_style;
			$GLOBALS['nxr_input_text_style'] = $input_text_style;
			$GLOBALS['nxr_minimal_sendmail'] = $email_form;
			
			
			
			$output .= '<script>
				jQuery( document ).ready(function() {
					//Add form size class
					jQuery("#theForm").addClass("'.$form_size_class.'");
					
					//Add form background color
					jQuery("head").append("<style>.nxr-minimal-form .simform ol:before{background:'.$form_input_style.';}</style>");
					
					var theForm = document.getElementById( "theForm" );
					new stepsForm( theForm, {
						onSubmit : function( form ) {
							classie.addClass( theForm.querySelector( ".simform-inner" ), "hide" );
							var messageEl = theForm.querySelector( ".final-message" );
							messageEl.innerHTML = "'.$confirmation_text.'";
							classie.addClass( messageEl, "show" );
						}
					} );
					
					// Submits the form
					stepsForm.prototype._submit = function() {
						// get all the inputs into an array.
						var $inputs = jQuery("#theForm :input");

						var values = {};
						$inputs.each(function() {
							if( jQuery(this).val() != "" ) {
								values[jQuery(this).attr("data-question")] = jQuery(this).val();
							}
						});

						// send email
						var data = {
							action: "mail_before_submit",
							whatever: values,
							_ajax_nonce: "'.wp_create_nonce( "my_email_ajax_nonce" ).'"
						};

						jQuery.post("'. get_bloginfo("url").'/wp-admin/admin-ajax.php", data);
						
						// show confirmation text
						this.options.onSubmit( this.el );
					}
				});
			</script>';
			
				$output .= '<div class="nxr-minimal-form ' . esc_attr( $css_class ) . '">';
					$output .= '<form id="theForm" class="simform" autocomplete="off">';
						$output .= '<div class="simform-inner">';
							$output .= '<ol class="questions">';
								$output .= do_shortcode($content);
							$output .= '</ol><!-- /questions -->';
							$output .= '<button class="submit" type="submit">Send answers</button>';
							$output .= '<div class="controls" '.$progress_bar_style.'>';
								$output .= '<button class="nxr-next-button" '.$next_icon_style.'></button>';
								$output .= '<div class="progress"></div>';
								$output .= '<span class="number" '.$steps_text_style.'>';
									$output .= '<span class="number-current"></span>';
									$output .= '<span class="number-total"></span>';
								$output .= '</span>';
								$output .= '<span class="error-message"></span>';
							$output .= '</div><!-- / controls -->';
						$output .= '</div><!-- /simform-inner -->';
						$output .= '<span class="final-message" '.$confirmation_text_style.'></span>';
					$output .= '</form><!-- /simform -->';
				$output .= '</div>';
			
			/*
				Return the output
			*/
			return $output;
		}
		
		function nxr_minimal_input($atts,$content = null) {
			
			
			/*
				Empty vars declaration
			*/
			$output = $label_text = $input_type = $input_type_front = $nxr_question_id = $input_validate = '';
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'label_text'			=>	'',
				'input_type'			=>	''
			), $atts));
			
			/*
				Shortcode content output
			*/
			switch($input_type){
				case 'text':
					$input_type_front = 'text';
					$input_validate = 'data-validate="none"';
				break;
				
				case 'e-mail':
					$input_type_front = 'email';
					$input_validate = 'data-validate="email"';
				break;
				
				case 'telephone':
					$input_type_front = 'tel';
					$input_validate = 'data-validate="none"';
				break;
			}
			
			$nxr_question_id = "q-".uniqid();

			$output .= '<li>';
				$output .= '<span><label for="'.$nxr_question_id.'"><h2 '.$GLOBALS["nxr_label_style"].'>'.$label_text.'</h2></label></span>';
				$output .= '<input id="'.$nxr_question_id.'" name="'.$nxr_question_id.'" type="'.$input_type_front.'" '.$GLOBALS["nxr_input_text_style"].' '.$input_validate.' data-question="'.$label_text.'"/>';
			$output .= '</li>';
			
			/*
				Return the output
			*/
			return $output;
		}
	}
	new NXR_VC_MINIMALFORM;
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_nxr_minimal_form extends WPBakeryShortCodesContainer {
	}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_nxr_minimal_input extends WPBakeryShortCode {
	}
}