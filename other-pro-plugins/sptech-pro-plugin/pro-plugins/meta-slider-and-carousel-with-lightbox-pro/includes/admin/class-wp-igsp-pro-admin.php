<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wp_Igsp_Pro_Admin {

	function __construct() {
		
		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'wp_igsp_pro_post_sett_metabox') );

		// Action to save metabox
		add_action( 'save_post', array($this, 'wp_igsp_pro_save_metabox_value') );

		// Action to register plugin settings
		add_action ( 'admin_init', array($this,'wp_igsp_pro_register_settings') );

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'wp_igsp_pro_register_menu') );

		// Action to add custom column to Gallery listing
		add_filter( 'manage_'.WP_IGSP_PRO_POST_TYPE.'_posts_columns', array($this, 'wp_igsp_pro_posts_columns') );

		// Action to add custom column data to Gallery listing
		add_action('manage_'.WP_IGSP_PRO_POST_TYPE.'_posts_custom_column', array($this, 'wp_igsp_pro_post_columns_data'), 10, 2);

		// Filter to add row data
		add_filter( 'post_row_actions', array($this, 'wp_igsp_pro_add_post_row_data'), 10, 2 );

		// Action to add Attachment Popup HTML
		add_action( 'admin_footer', array($this,'wp_igsp_pro_image_update_popup_html') );

		// Ajax call to update option
		add_action( 'wp_ajax_wp_igsp_pro_get_attachment_edit_form', array($this, 'wp_igsp_pro_get_attachment_edit_form'));
		add_action( 'wp_ajax_nopriv_wp_igsp_pro_get_attachment_edit_form',array( $this, 'wp_igsp_pro_get_attachment_edit_form'));
		
		// Ajax call to update attachment data
		add_action( 'wp_ajax_wp_igsp_pro_save_attachment_data', array($this, 'wp_igsp_pro_save_attachment_data'));
		add_action( 'wp_ajax_nopriv_wp_igsp_pro_save_attachment_data',array( $this, 'wp_igsp_pro_save_attachment_data'));

		// Filter to add plugin links
		add_filter( 'plugin_row_meta', array( $this, 'wp_igsp_pro_plugin_row_meta' ), 10, 2 );
	}

	/**
	 * Post Settings Metabox
	 * 
	 * @package Meta slider and carousel with lightbox Pro
	 * @since 1.0.0
	 */
	function wp_igsp_pro_post_sett_metabox() {
		
		// Getting all post types
		$all_post_types = wp_igsp_pro_get_post_types();
		
		add_meta_box( 'wp-igsp-post-sett', __( 'Meta slider and carousel with lightbox Pro - Settings', 'meta-slider-and-carousel-with-lightbox' ), array($this, 'wp_igsp_pro_post_sett_mb_content'), $all_post_types, 'normal', 'high' );
	}
	
	/**
	 * Post Settings Metabox HTML
	 * 
	 * @package Meta slider and carousel with lightbox Pro
	 * @since 1.0.0
	 */
	function wp_igsp_pro_post_sett_mb_content() {
		include_once( WP_IGSP_PRO_DIR .'/includes/admin/metabox/wp-igsp-sett-metabox.php');
	}
	
	/**
	 * Function to save metabox values
	 * 
	 * @package Meta slider and carousel with lightbox Pro
	 * @since 1.0.0
	 */
	function wp_igsp_pro_save_metabox_value( $post_id ) {

		global $post_type;
		
		$registered_posts = wp_igsp_pro_get_post_types(); // Getting registered post types

		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( !current_user_can('edit_post', $post_id) )              			// Check if user can edit the post.
		|| ( !in_array($post_type, $registered_posts) ) )             			// Check if user can edit the post.
		{
		  return $post_id;
		}

		$prefix = WP_IGSP_PRO_META_PREFIX; // Taking metabox prefix
		
		// Taking variables
		$gallery_imgs = isset($_POST['wp_igsp_img']) ? wp_igsp_pro_slashes_deep($_POST['wp_igsp_img']) : '';
		
		update_post_meta($post_id, '_vdw_gallery_id', $gallery_imgs);
	}

	/**
	 * Function register setings
	 * 
	 * @package Meta slider and carousel with lightbox Pro
	 * @since 1.0.0
	 */
	function wp_igsp_pro_register_settings() {
		register_setting( 'wp_igsp_pro_plugin_options', 'wp_igsp_pro_options', array($this, 'wp_igsp_pro_validate_options') );
	}
	
	/**
	 * Validate Settings Options
	 * 
	 * @package Meta slider and carousel with lightbox Pro
	 * @since 1.0.0
	 */
	function wp_igsp_pro_validate_options( $input ) {
		
		$input['custom_css'] = isset($input['custom_css']) 	? wp_igsp_pro_slashes_deep($input['custom_css'], true) 	: '';
		
		return $input;
	}
	
	/**
	 * Function to register admin menus
	 * 
	 * @package Meta slider and carousel with lightbox Pro
	 * @since 1.0.0
	 */
	function wp_igsp_pro_register_menu() {
		add_submenu_page( 'edit.php?post_type='.WP_IGSP_PRO_POST_TYPE, __('Settings', 'meta-slider-and-carousel-with-lightbox'), __('Settings', 'meta-slider-and-carousel-with-lightbox'), 'manage_options', 'wp-igsp-pro-settings', array($this, 'wp_igsp_pro_settings_page') );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @package Meta slider and carousel with lightbox Pro
	 * @since 1.0.0
	 */
	function wp_igsp_pro_settings_page() {
		include_once( WP_IGSP_PRO_DIR . '/includes/admin/settings/wp-igsp-settings.php' );
	}

	/**
	 * Add custom column to Post listing page
	 * 
	 * @package Meta slider and carousel with lightbox Pro
	 * @since 1.0.0
	 */
	function wp_igsp_pro_posts_columns( $columns ) {

	    $new_columns['wp_igsp_shortcode'] 	= __('Shortcode', 'meta-slider-and-carousel-with-lightbox');
	    $new_columns['wp_igsp_photos'] 		= __('Number of Photos', 'meta-slider-and-carousel-with-lightbox');

	    $columns = wp_igsp_pro_add_array( $columns, $new_columns, 1, true );

	    return $columns;
	}

	/**
	 * Add custom column data to Post listing page
	 * 
	 * @package Meta slider and carousel with lightbox Pro
	 * @since 1.0.0
	 */
	function wp_igsp_pro_post_columns_data( $column, $post_id ) {

		global $post;

		// Taking some variables
		$prefix = WP_IGSP_PRO_META_PREFIX;

	    switch ($column) {
	    	case 'wp_igsp_shortcode':
	    		
	    		echo '<div class="wp-igsp-shortcode-preview">[meta_gallery_slider id="'.$post_id.'"]</div> <br/>';
	    		echo '<div class="wp-igsp-shortcode-preview">[meta_gallery_carousel id="'.$post_id.'"]</div>';
	    		echo '<div class="wp-igsp-shortcode-preview">[meta_gallery_variable id="'.$post_id.'"]</div>';
	    		break;

	    	case 'wp_igsp_photos':
	    		$total_photos = get_post_meta($post_id, '_vdw_gallery_id', true);
	    		echo !empty($total_photos) ? count($total_photos) : '--';
	    		break;
		}
	}

	/**
	 * Function to add custom quick links at post listing page
	 * 
	 * @package Meta slider and carousel with lightbox Pro
	 * @since 1.0.0
	 */
	function wp_igsp_pro_add_post_row_data( $actions, $post ) {
		
		if( $post->post_type == WP_IGSP_PRO_POST_TYPE ) {
			return array_merge( array( 'wp_igsp_id' => 'ID: ' . $post->ID ), $actions );
		}
		
		return $actions;
	}

	/**
	 * Image data popup HTML
	 * 
	 * @package Meta slider and carousel with lightbox Pro
	 * @since 1.0.0
	 */
	function wp_igsp_pro_image_update_popup_html() {

		global $post_type;

		$registered_posts = wp_igsp_pro_get_post_types(); // Getting registered post types

		if( in_array($post_type, $registered_posts) ) {
			include_once( WP_IGSP_PRO_DIR .'/includes/admin/settings/wp-igsp-img-popup.php');
		}
	}

	/**
	 * Get attachment edit form
	 * 
	 * @package Meta slider and carousel with lightbox Pro
	 * @since 1.0.0
	 */
	function wp_igsp_pro_get_attachment_edit_form() {

		// Taking some defaults
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'meta-slider-and-carousel-with-lightbox');
		$attachment_id 		= !empty($_POST['attachment_id']) ? trim($_POST['attachment_id']) : '';

		if( !empty($attachment_id) ) {
			$attachment_post = get_post( $_POST['attachment_id'] );

			if( !empty($attachment_post) ) {
				
				ob_start();

				// Popup Data File
				include( WP_IGSP_PRO_DIR . '/includes/admin/settings/wp-igsp-img-popup-data.php' );

				$attachment_data = ob_get_clean();

				$result['success'] 	= 1;
				$result['msg'] 		= __('Attachment Found.', 'meta-slider-and-carousel-with-lightbox');
				$result['data']		= $attachment_data;
			}
		}

		echo json_encode($result);
		exit;
	}

	/**
	 * Get attachment edit form
	 * 
	 * @package Meta slider and carousel with lightbox Pro
	 * @since 1.0.0
	 */
	function wp_igsp_pro_save_attachment_data() {

		$prefix 			= WP_IGSP_PRO_META_PREFIX;
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'meta-slider-and-carousel-with-lightbox');
		$attachment_id 		= !empty($_POST['attachment_id']) ? trim($_POST['attachment_id']) : '';
		$form_data 			= parse_str($_POST['form_data'], $form_data_arr);

		if( !empty($attachment_id) && !empty($form_data_arr) ) {

			// Getting attachment post
			$wp_igsp_attachment_post = get_post( $attachment_id );

			// If post type is attachment
			if( isset($wp_igsp_attachment_post->post_type) && $wp_igsp_attachment_post->post_type == 'attachment' ) {
				$post_args = array(
									'ID'			=> $attachment_id,
									'post_title'	=> !empty($form_data_arr['wp_igsp_attachment_title']) ? $form_data_arr['wp_igsp_attachment_title'] : $wp_igsp_attachment_post->post_name,
									'post_content'	=> $form_data_arr['wp_igsp_attachment_desc'],
									'post_excerpt'	=> $form_data_arr['wp_igsp_attachment_caption'],
								);
				$update = wp_update_post( $post_args, $wp_error );

				if( !is_wp_error( $update ) ) {
					
					update_post_meta( $attachment_id, '_wp_attachment_image_alt', wp_igsp_pro_slashes_deep($form_data_arr['wp_igsp_attachment_alt']) );
					
					$result['success'] 	= 1;
					$result['msg'] 		= __('Your changes saved successfully.', 'meta-slider-and-carousel-with-lightbox');
				}
			}
		}
		echo json_encode($result);
		exit;
	}

	/**
	 * Function to unique number value
	 * 
	 * @package Meta slider and carousel with lightbox Pro
	 * @since 1.0.0
	 */
	function wp_igsp_pro_plugin_row_meta( $links, $file ) {
		
		if ( $file == WP_IGSP_PRO_PLUGIN_BASENAME ) {
			
			$row_meta = array(
				'docs'    => '<a href="' . esc_url('https://www.wponlinesupport.com/pro-plugin-document/document-meta-slider-carousel-lightbox-pro/') . '" title="' . esc_attr( __( 'View Documentation', 'meta-slider-and-carousel-with-lightbox' ) ) . '" target="_blank">' . __( 'Docs', 'meta-slider-and-carousel-with-lightbox' ) . '</a>',
				'support' => '<a href="' . esc_url('https://www.wponlinesupport.com/welcome-wp-online-support-forum/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'meta-slider-and-carousel-with-lightbox' ) ) . '" target="_blank">' . __( 'Support', 'meta-slider-and-carousel-with-lightbox' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}
}

$wp_igsp_pro_admin = new Wp_Igsp_Pro_Admin();