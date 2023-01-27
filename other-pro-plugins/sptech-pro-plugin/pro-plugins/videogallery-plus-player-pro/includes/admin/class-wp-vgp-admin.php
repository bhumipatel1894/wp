<?php
/**
 * Admin Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wp_Vgp_Admin {
	
	function __construct() {
		
		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'wp_vgp_register_menu'), 9 );

		// Action to register plugin settings
		add_action ( 'admin_init', array($this, 'wp_vgp_register_settings') );

		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'wp_vgp_post_sett_metabox') );

		// Action to save metabox
		add_action( 'save_post', array($this, 'wp_vgp_save_meta_box_data') );

		// Filter to add columns and data in video category table
		add_filter('manage_edit-'.WP_VGP_CAT.'_columns', array($this, 'wp_vgp_manage_category_columns'));
		add_filter('manage_'.WP_VGP_CAT.'_custom_column', array($this, 'wp_vgp_cat_columns_data'), 10, 3);

		// Filter to add row data
		add_filter( 'post_row_actions', array($this, 'wp_vgp_add_post_row_data'), 10, 2 );

		// Action to add custom column to video listing
		add_filter( 'manage_'.WP_VGP_POST_TYPE.'_posts_columns', array($this, 'wp_vgp_posts_columns') );

		// Action to add custom column data to video listing
		add_action('manage_'.WP_VGP_POST_TYPE.'_posts_custom_column', array($this, 'wp_vgp_post_columns_data'), 10, 2);

		// Action to add category filter dropdown
		add_action( 'restrict_manage_posts', array($this, 'wp_vgp_add_post_filters'), 50 );

		// Action to add sorting link at video listing page
		add_filter( 'views_edit-'.WP_VGP_POST_TYPE, array($this, 'wp_vgp_sorting_link') );

		// Action to add `Save Order` button
		add_action( 'restrict_manage_posts', array($this, 'wp_vgp_restrict_manage_posts') );

		// Ajax call to update post order
		add_action( 'wp_ajax_wp_vgp_update_post_order', array($this, 'wp_vgp_update_post_order'));
		add_action( 'wp_ajax_nopriv_wp_vgp_update_post_order',array( $this, 'wp_vgp_update_post_order'));

		// Filter to add plugin links
		add_filter( 'plugin_row_meta', array( $this, 'wp_vgp_plugin_row_meta' ), 10, 2 );
	}
	
	/**
	 * Function to register admin menus
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_register_menu() {
		add_submenu_page( 'edit.php?post_type='.WP_VGP_POST_TYPE, __('Settings', 'html5-videogallery-plus-player'), __('Settings', 'html5-videogallery-plus-player'), 'manage_options', 'wp-vgp-settings', array($this, 'wp_vgp_settings_page') );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_settings_page() {
		include_once( WP_VGP_DIR . '/includes/admin/settings/wp-vgp-settings.php' );
	}

	/**
	 * Function register setings
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_register_settings() {
		register_setting( 'wp_vgp_plugin_options', 'wp_vgp_options', array($this, 'wp_vgp_validate_options') );
	}

	/**
	 * Validate Settings Options
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_validate_options( $input ) {
		
		$input['default_img']			= isset($input['default_img'])	? wp_vgp_slashes_deep($input['default_img']) 		: '';
		$input['custom_css'] 			= isset($input['custom_css']) 	? wp_vgp_slashes_deep($input['custom_css'], true) 	: '';
		$input['yt_autoplay']			= !empty($input['yt_autoplay'])			? 1 : 0;
		$input['yt_hide_controls']		= !empty($input['yt_hide_controls'])	? 1 : 0;
		$input['yt_hide_fullscreen']	= !empty($input['yt_hide_fullscreen'])	? 1 : 0;
		$input['yt_hide_related']		= !empty($input['yt_hide_related'])		? 1 : 0;
		$input['yt_hide_showinfo']		= !empty($input['yt_hide_showinfo'])	? 1 : 0;
		$input['yt_subtitles']			= !empty($input['yt_subtitles'])		? 1 : 0;
		$input['vm_autoplay']			= !empty($input['vm_autoplay'])			? 1 : 0;
		$input['vm_loop']				= !empty($input['vm_loop'])				? 1 : 0;
		$input['vm_hide_title']			= !empty($input['vm_hide_title'])		? 1 : 0;
		$input['vm_hide_author']		= !empty($input['vm_hide_author'])		? 1 : 0;
		$input['dly_autoplay']			= !empty($input['dly_autoplay'])		? 1 : 0;
		$input['dly_hide_controls']		= !empty($input['dly_hide_controls'])	? 1 : 0;
		$input['dly_hide_showinfo']		= !empty($input['dly_hide_showinfo'])	? 1 : 0;
		$input['dly_hide_logo']			= !empty($input['dly_hide_logo'])		? 1 : 0;
		$input['dly_hide_sharing']		= !empty($input['dly_hide_sharing'])	? 1 : 0;
		$input['dly_hide_related']		= !empty($input['dly_hide_related'])	? 1 : 0;
		$input['jwp_enable']			= !empty($input['jwp_enable'])			? 1 : 0;
		$input['jwp_licence_key']		= !empty($input['jwp_licence_key'])		? wp_vgp_slashes_deep($input['jwp_licence_key']) : '';
		
		return $input;
	}

	/**
	 * video Post Settings Metabox
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_post_sett_metabox() {
		add_meta_box( 'wp-vgp-post-sett', __( 'Video gallery and Player Pro - Files/Links', 'html5-videogallery-plus-player' ), array($this, 'wp_vgp_post_sett_mb_content'), WP_VGP_POST_TYPE, 'normal', 'high' );
	}

	/**
	 * Function to handle 'Add Link URL' metabox HTML
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_post_sett_mb_content( $post ) {
		include_once( WP_VGP_DIR .'/includes/admin/metabox/wp-vgp-post-sett-metabox.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_save_meta_box_data( $post_id ) {

		global $post_type;
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( $post_type !=  WP_VGP_POST_TYPE ) )              					// Check if current post type is supported.
		{
		  return $post_id;
		}
		
		$prefix = WP_VGP_META_PREFIX; // Taking metabox prefix
		
		// Taking variables
		$poster_img = isset($_POST[$prefix.'poster_img']) 	? wp_vgp_slashes_deep($_POST[$prefix.'poster_img']) : '';
		$video_mp4 	= isset($_POST[$prefix.'video_mp4']) 	? wp_vgp_slashes_deep($_POST[$prefix.'video_mp4']) 	: '';
		$video_wbbm = isset($_POST[$prefix.'video_wbbm']) 	? wp_vgp_slashes_deep($_POST[$prefix.'video_wbbm']) : '';
		$video_ogg 	= isset($_POST[$prefix.'video_ogg'])	? wp_vgp_slashes_deep($_POST[$prefix.'video_ogg']) 	: '';
		$video_yt 	= isset($_POST[$prefix.'video_yt']) 	? wp_vgp_slashes_deep($_POST[$prefix.'video_yt']) 	: '';
		$video_vm 	= isset($_POST[$prefix.'video_vm']) 	? wp_vgp_slashes_deep($_POST[$prefix.'video_vm']) 	: '';
		$video_dly 	= isset($_POST[$prefix.'video_dly']) 	? wp_vgp_slashes_deep($_POST[$prefix.'video_dly']) 	: '';
		$video_oth 	= isset($_POST[$prefix.'video_oth']) 	? wp_vgp_slashes_deep($_POST[$prefix.'video_oth']) 	: '';
		$tab 		= isset($_POST[$prefix.'tab']) 			? wp_vgp_slashes_deep($_POST[$prefix.'tab']) 		: '';

		update_post_meta($post_id, $prefix.'poster_img', $poster_img);
		update_post_meta($post_id, $prefix.'video_mp4', $video_mp4);
		update_post_meta($post_id, $prefix.'video_wbbm', $video_wbbm);
		update_post_meta($post_id, $prefix.'video_ogg', $video_ogg);
		update_post_meta($post_id, $prefix.'video_yt', $video_yt);
		update_post_meta($post_id, $prefix.'video_vm', $video_vm);
		update_post_meta($post_id, $prefix.'video_dly', $video_dly);
		update_post_meta($post_id, $prefix.'video_oth', $video_oth);
		update_post_meta($post_id, $prefix.'tab', $tab);
	}

	/**
	 * Function to add category columns
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_manage_category_columns( $columns ){
		
		$new_columns['wp_vgp_shortcode'] = __( 'Video Category Shortcode', 'html5-videogallery-plus-player' );
		
		$columns = wp_vgp_add_array( $columns, $new_columns, 2 );
		
		return $columns;
	}

	/**
	 * Function to add category columns data
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_cat_columns_data( $ouput, $column_name, $tax_id ) {
		
		if( $column_name == 'wp_vgp_shortcode' ){
			$ouput .= '[video_gallery category="' . $tax_id. '"] <br/>';
			$ouput .= '[video_gallery_slider category="' . $tax_id. '"]';
		}
		return $ouput;
	}

	/**
	 * Function to add custom quick links at post listing page
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.2
	 */
	function wp_vgp_add_post_row_data( $actions, $post ) {
		
		if( $post->post_type == WP_VGP_POST_TYPE ) {
			return array_merge( array( 'wp_vgp_id' => 'ID: ' . $post->ID ), $actions );
		}
		
		return $actions;
	}

	/**
	 * Add custom column to video listing page
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_posts_columns( $columns ) {

	    $new_columns['wp_vgp_order'] = __('Order', 'html5-videogallery-plus-player');

	    $columns = wp_vgp_add_array( $columns, $new_columns, 1, true );

	    return $columns;
	}

	/**
	 * Add custom column data to video listing page
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_post_columns_data( $column, $post_id ) {

	    global $post;

	    switch ($column) {

	    	case 'wp_vgp_order':
	    		
	    		$post_menu_order = isset($post->menu_order) ? $post->menu_order : '';
	        	
		        echo $post_menu_order;
		        echo "<input type='hidden' value='{$post_id}' name='wp_vgp_post[]' class='wp-vgp-order' id='wp-vgp-order-{$post_id}' />";
	    		break;
	    }
	}

	/**
	 * Add category dropdown to video listing page
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_add_post_filters() {
		
		global $typenow;
		
		if( $typenow == WP_VGP_POST_TYPE ) {

			$wp_vgp_cat = isset($_GET[WP_VGP_CAT]) ? $_GET[WP_VGP_CAT] : '';

			$dropdown_options = apply_filters('wp_vgp_cat_filter_args', array(
					'show_option_none' 	=> __('All Categories', 'html5-videogallery-plus-player'),
					'option_none_value' => '',
					'hide_empty' 		=> 1,
					'hierarchical' 		=> 1,
					'show_count' 		=> 0,
					'orderby' 			=> 'name',
					'name'				=> WP_VGP_CAT,
					'taxonomy'			=> WP_VGP_CAT,
					'selected' 			=> $wp_vgp_cat,
					'value_field'		=> 'slug',
				));
			wp_dropdown_categories( $dropdown_options );
		}
	}

	/**
	 * Add 'Sort Video' link at video listing page
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_sorting_link( $views ) {
	    
	    global $wp_query;

	    $class            = ( isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) ? 'current' : '';
	    $query_string     = remove_query_arg(array( 'orderby', 'order' ));
	    $query_string     = add_query_arg( 'orderby', urlencode('menu_order title'), $query_string );
	    $query_string     = add_query_arg( 'order', urlencode('ASC'), $query_string );
	    $views['byorder'] = '<a href="' . esc_url( $query_string ) . '" class="' . esc_attr( $class ) . '">' . __( 'Sort Video', 'html5-videogallery-plus-player' ) . '</a>';

	    return $views;
	}

	/**
	 * Add Save button to video listing page
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_restrict_manage_posts() {

		global $typenow, $wp_query;

		if( $typenow == WP_VGP_POST_TYPE && isset($wp_query->query['orderby']) && $wp_query->query['orderby'] == 'menu_order title' ) {
			$html  = '';
			$html .= "<span class='spinner wp-vgp-spinner'></span>";
			$html .= "<input type='button' name='wp_vgp_save_order' class='button button-secondary right wp-vgp-save-order' id='wp-vgp-save-order' value='".__('Save Sort Order', 'html5-videogallery-plus-player')."' />";
			echo $html;
		}
	}

	/**
	 * Update Blog order
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_update_post_order() {

		// Taking some defaults
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'html5-videogallery-plus-player');

		if( !empty($_POST['form_data']) ) {

			$form_data 		= parse_str($_POST['form_data'], $output_arr);
			$wp_vgp_posts 	= !empty($output_arr['wp_vgp_post']) ? $output_arr['wp_vgp_post'] : '';

			if( !empty($wp_vgp_posts) ) {

				$post_menu_order = 0;

				// Loop od ids
				foreach ($wp_vgp_posts as $wp_vgp_post_key => $wp_vgp_post) {
					
					// Update post order
					$update_post = array(
						'ID'           => $wp_vgp_post,
						'menu_order'   => $post_menu_order,
					);

					// Update the post into the database
					wp_update_post( $update_post );

					$post_menu_order++;
				}

				$result['success'] 	= 1;
				$result['msg'] 		= __('Video order saved successfully.', 'html5-videogallery-plus-player');
			}
		}
		echo json_encode($result);
		exit;
	}

	/**
	 * Function to add extra link to plugins action link
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_plugin_row_meta( $links, $file ) {
		
		if ( $file == WP_VGP_PLUGIN_BASENAME ) {
			
			$row_meta = array(
				'docs'    => '<a href="' . esc_url('https://www.wponlinesupport.com/pro-plugin-document/document-video-gallery-player-pro/') . '" title="' . esc_attr( __( 'View Documentation', 'html5-videogallery-plus-player' ) ) . '" target="_blank">' . __( 'Docs', 'html5-videogallery-plus-player' ) . '</a>',
				'support' => '<a href="' . esc_url('https://www.wponlinesupport.com/welcome-wp-online-support-forum/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'html5-videogallery-plus-player' ) ) . '" target="_blank">' . __( 'Support', 'html5-videogallery-plus-player' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}
}

$wp_vgp_admin = new Wp_Vgp_Admin();