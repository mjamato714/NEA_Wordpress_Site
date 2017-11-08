<?php
/*
	Plugin Name: NXR MegaFooter
	Plugin URI: http://nexarthemes.com/
	Author: NexarThemes
	Author URI: https://nexarthemes.com
	Version: 1.0.0
	Description: Visual Composer based MegaFooter for NexarThemes Themes.
	Text Domain: nxrmegafooter
*/

/*
	If accesed directly, exit
*/
if (!defined('ABSPATH')) exit;


if(!class_exists('NXR_MEGAFOOTER')) {

	class NXR_MEGAFOOTER {
		
		/**
		* Constructor function
		* @since 1.0.0
		*/
		public function __construct(){
			
			// Add language option
			add_action( 'plugins_loaded', array($this,'nxr_megafooter_load_textdomain') );
			
			// Add megamenu post type: nxr_megafooter
			add_action('init',array($this,'nxr_post_type'));
			
			// Init & save metaboxex for pages
			add_action( 'add_meta_boxes', array( $this, 'nxr_megafooter_metaboxes' ) );
			add_action( 'save_post', array( $this, 'nxr_save_megafooter_data' ) );
						
			// Remove Some metaboxes
			add_action( 'do_meta_boxes', array( $this, 'nxr_remove_thrdparty_meta_boxes' ) );
		}
		
		/**
		*	Load plugin textdomain.
		*	@since 1.0.0
		*/
		function nxr_megafooter_load_textdomain() {
		  load_plugin_textdomain( 'nxrmegafooter', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
		}
		
		
		/**
		*	Register the post type nxr_megafooter
		*	@since 1.0.0
		*/
		function nxr_post_type() {
			register_post_type( 'nxr_megafooter',
				array(
					'labels' => array(
						'name'               => esc_html__( 'Mega Footers', 'nxrmegafooter' ),
						'singular_name'      => esc_html__( 'MegaFooter', 'nxrmegafooter' ),
						'menu_name'          => esc_html__( 'MegaFooters', 'nxrmegafooter' ),
						'name_admin_bar'     => esc_html__( 'MegaFooters', 'nxrmegafooter' ),
						'add_new'            => esc_html__( 'Add New', 'info bar', 'nxrmegafooter' ),
						'add_new_item'       => esc_html__( 'Add New MegaFooter', 'nxrmegafooter' ),
						'new_item'           => esc_html__( 'New MegaFooter', 'nxrmegafooter' ),
						'edit_item'          => esc_html__( 'Edit MegaFooter', 'nxrmegafooter' ),
						'view_item'          => esc_html__( 'View MegaFooter', 'nxrmegafooter' ),
						'all_items'          => esc_html__( 'All MegaFooters', 'nxrmegafooter' ),
						'search_items'       => esc_html__( 'Search MegaFooters', 'nxrmegafooter' ),
						'not_found'          => esc_html__( 'No MegaFooter found.', 'nxrmegafooter' ),
						'not_found_in_trash' => esc_html__( 'No MegaFooter found in Trash.', 'nxrmegafooter' ),
					),
				'public'			=>	true,
				'menu_icon'		=>	'dashicons-editor-kitchensink',
				'has_archive'	=>	true,
				'rewrite'		=>	array('slug' => 'mega_footer'),
				'supports'		=>	array('title','editor')
				)
			);
		}
		
		
		/*
		*	Remove 3rd party metaboxes
		*	on this CPT
		*/
		function nxr_remove_thrdparty_meta_boxes() {
			remove_meta_box( 'mymetabox_revslider_0', 'nxr_megafooter', 'normal' );
			remove_meta_box( 'eg-meta-box', 'nxr_megafooter', 'normal' );
		}
		
		
		/**
		* Add nxr_megafooter metaboxes function for pages
		* @since 1.0.0
		* Doc: https://codex.wordpress.org/Function_Reference/add_meta_box
		*/	
		function nxr_megafooter_metaboxes() {
			$screens = array( 'page' ); // Available on pages only
			foreach ( $screens as $screen ) {
				add_meta_box(
					'nxr_megafooter_metabox',					// $id
					__( 'MegaFooter Settings', 'nxrmegafooter' ),		// $title
					array($this,'nxr_megafooter_custom_box'),	// $callback
					$screen,									// $screen
					'side',										// $context
					'low'										// $priority
				);
			}
		}
	
		function nxr_megafooter_custom_box($post) {
			// Add an nonce field so we can check for it later
			wp_nonce_field( 'nxr_megafooter_custom_box', 'nxr_megafooter_custom_box_nonce' );
	
			// Get metaboxes values from database
			$nxr_megafooterID	=	get_post_meta( $post->ID, '_nxr_megafooterID', true );	// nxr_megafooter unique ID
			
			// Construct the metaboxes and print out
			
			// What Popup to be displayed on this page?
			echo '<div class="settBlock" style="margin-bottom:15px"><label for="nxr_megafooterID" style="width:170px;display:inline-block;height:30px;">';
			   esc_html_e( "(Mega)Footer for this page", 'nxrmegafooter' );
			echo '</label> ';
				echo '<select name="nxr_megafooterID" id="nxr_megafooterID">';
				
				$args = array(
					'post_type'		=>	'nxr_megafooter',
					'posts_per_page'=>	'99'
				 );
				$megafooters_array = get_posts( $args );
				
				if( !empty($megafooters_array) ) {
					echo '<option value="no_footer" '.(!empty($nxr_megafooterID) && $nxr_megafooterID == 'no_footer' ? 'selected = "selected"' : '').'>'.__('No Footer', 'nxrmegafooter').'</option>';
					echo '<option value="minimal_footer" '.(!empty($nxr_megafooterID) && $nxr_megafooterID == 'minimal_footer' ? 'selected = "selected"' : '').'>'.__('Minimal Footer', 'nxrmegafooter').'</option>';
					echo '<option value="" '.(empty($nxr_megafooterID) ? 'selected = "selected"' : '').'>'.__('Default MegaFooter', 'nxrmegafooter').'</option>';
					
					foreach ( $megafooters_array as $megafooter ) {
						setup_postdata( $megafooter );
						echo '<option value="'.$megafooter->ID.'" '.($nxr_megafooterID == $megafooter->ID ? 'selected = "selected"' : '').'>'.$megafooter->post_title.'</option>';
					}
					wp_reset_postdata();
				} else {
					echo '<option value="no_footer" '.(!empty($nxr_megafooterID) && $nxr_megafooterID == 'no_footer' ? 'selected = "selected"' : '').'>'.__('No Footer', 'nxrmegafooter').'</option>';
					echo '<option value="minimal_footer" '.(!empty($nxr_megafooterID) && $nxr_megafooterID == 'minimal_footer' ? 'selected = "selected"' : '').'>'.__('Minimal Footer', 'nxrmegafooter').'</option>';
					echo '<option value="" '.(empty($nxr_megafooterID) || $nxr_megafooterID != 'no_footer' || $nxr_megafooterID != 'minimal_footer' ? 'selected = "selected"' : '').'>'.__('No MegaFooter Available', 'nxrmegafooter').'</option>';
				}
			echo '</select></div>';
		}
		
		
		function nxr_save_megafooter_data( $post_id ) {
			// Check if our nonce is set.
			if ( ! isset( $_POST['nxr_megafooter_custom_box_nonce'] ) ) {
				return $post_id;
			}
	
			$nonce = $_POST['nxr_megafooter_custom_box_nonce'];
	
			// Verify that the nonce is valid
			if ( ! wp_verify_nonce( $nonce, 'nxr_megafooter_custom_box' ) ) {
				return $post_id;
			}
	
			// If this is an autosave, our form has not been submitted, so we don't want to do anything
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				//return $post_id;
			}
	
			// Check the user's permissions.
			if ( 'page' == $_POST['post_type'] ) {
				if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
			} else {
				if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
			}
			
			// OK to save data
			// Sanitize user input
			$nxr_megafooterID			= sanitize_text_field( $_POST['nxr_megafooterID'] );	
			
			// Update the meta field in the database
			update_post_meta( $post_id, '_nxr_megafooterID',	 $nxr_megafooterID );
		}
	}
	/*
		All good, fire up the plugin :)
	*/
	new NXR_MEGAFOOTER;
}