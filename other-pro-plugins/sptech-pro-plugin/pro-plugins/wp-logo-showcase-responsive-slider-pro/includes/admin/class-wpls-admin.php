<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpls_Admin {
	
	function __construct() {

		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'wpls_pro_post_sett_metabox'), 10, 2 );

		// Action to save metabox value
		add_action( 'save_post', array($this, 'wpls_pro_save_meta_box_data') );

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'wpls_pro_register_menu'), 9 );

		// Filter to add columns and data in logo showcase category table
		add_filter('manage_edit-'.WPLS_PRO_CAT.'_columns', array($this, 'wpls_pro_manage_category_columns'));
		add_filter('manage_'.WPLS_PRO_CAT.'_custom_column', array($this, 'wpls_pro_cat_columns_data'), 10, 3);

		// Action to register plugin settings
		add_action ( 'admin_init', array($this, 'wpls_pro_register_settings') );

		// Action to add custom column to Logo listing
		add_filter( 'manage_'.WPLS_PRO_POST_TYPE.'_posts_columns', array($this, 'wpls_pro_posts_columns') );

		// Action to add custom column data to Logo listing
		add_action('manage_'.WPLS_PRO_POST_TYPE.'_posts_custom_column', array($this, 'wpls_pro_post_columns_data'), 10, 2);
		
		// Action to add category filter dropdown
		add_action( 'restrict_manage_posts', array($this, 'wpls_pro_add_post_filters'), 50 );
		
		// Action to add sorting link at Logo listing page
		add_filter( 'views_edit-'.WPLS_PRO_POST_TYPE, array($this, 'wpls_pro_sorting_link') );
		
		// Action to add `Save Order` button
		add_action( 'restrict_manage_posts', array($this, 'wpls_pro_restrict_manage_posts') );
		
		// Ajax call to update option
		add_action( 'wp_ajax_wpls_pro_update_post_order', array($this, 'wpls_pro_update_post_order'));
		add_action( 'wp_ajax_nopriv_wpls_pro_update_post_order',array( $this, 'wpls_pro_update_post_order'));

		// Filter to add plugin links
		add_filter( 'plugin_row_meta', array( $this, 'wpls_pro_plugin_row_meta' ), 10, 2 );
		add_filter( 'plugin_action_links_' . WPLS_PRO_PLUGIN_BASENAME, array( $this, 'wpls_pro_plugin_action_links' ) );
	}

	/**
	 * Post Settings Metabox
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_post_sett_metabox( $post_type, $post ) {
		add_meta_box( 'wpls-pro-post-sett', __('WP Logo Showcase Responsive Slider Pro - Settings', 'logoshowcase'), array($this, 'wpls_pro_post_sett_mb_content'), WPLS_PRO_POST_TYPE, 'normal', 'high' );
	}

	/**
	 * Function to handle 'Add Link URL' metabox HTML
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_post_sett_mb_content( $post ) {
		include_once( WPLS_PRO_DIR .'/includes/admin/metabox/wpls-post-sett-metabox.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_save_meta_box_data( $post_id ){

		global $post_type;
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( $post_type !=  WPLS_PRO_POST_TYPE ) )              				// Check if current post type is supported.
		{
		  return $post_id;
		}

		$prefix = WPLS_META_PREFIX; // Taking metabox prefix

		// Taking data
		$logo_url 	= isset($_POST[$prefix.'logo_url']) 	? wpls_pro_slashes_deep( $_POST[$prefix.'logo_url'] ) 	: '';
		$logo_link 	= isset($_POST[$prefix.'logo_link']) ? wpls_pro_slashes_deep( $_POST[$prefix.'logo_link'] ) 	: '';

		// Updating Post Meta
		update_post_meta( $post_id, $prefix.'logo_url', $logo_url );
		update_post_meta( $post_id, 'wplss_slide_link', $logo_link );
	}

	/**
	 * Function to register admin menus
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_register_menu() {
		add_submenu_page( 'edit.php?post_type='.WPLS_PRO_POST_TYPE, __('Settings', 'logoshowcase'), __('Settings', 'logoshowcase'), 'manage_options', 'wpls-pro-settings', array($this, 'wpls_pro_settings_page') );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_settings_page() {
		include_once( WPLS_PRO_DIR . '/includes/admin/settings/wpls-settings.php' );
	}

	/**
	 * Function register setings
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_register_settings() {
		register_setting( 'wpls_pro_plugin_options', 'wpls_pro_options', array($this, 'wpls_pro_validate_options') );
	}

	/**
	 * Validate Settings Options
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_validate_options( $input ) {
		
		$input['tooltip_arrow']	= isset($input['tooltip_arrow']) 	? 1 : 0;
		$input['custom_css'] 	= isset($input['custom_css']) 		? wpls_pro_slashes_deep($input['custom_css'], true) : '';
		
		return $input;
	}

	/**
	 * Function to add category columns
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_manage_category_columns( $columns ){
		
		$new_columns['wpls_pro_shortcode'] = __( 'Logo Category Shortcode', 'logoshowcase' );
		
		$columns = wpls_pro_add_array( $columns, $new_columns, 2 );
		
		return $columns;
	}

	/**
	 * Function to add category columns data
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_cat_columns_data( $ouput, $column_name, $tax_id ) {
		
		if( $column_name == 'wpls_pro_shortcode' ){
			$ouput .= '[logoshowcase cat_id="' . $tax_id. '"] <br/>';
			$ouput .= '[logo_grid cat_id="' . $tax_id. '"] <br/>';
			$ouput .= '[logo_filter cat_id="' . $tax_id. '"]';
		}
		return $ouput;
	}

	/**
	 * Add custom column to Logo listing page
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_posts_columns( $columns ){

		$new_columns['wpls_pro_image'] 	= __( 'Image', 'logoshowcase' );
	    $new_columns['wpls_pro_order'] 	= __('Order', 'logoshowcase');

	    $columns = wpls_pro_add_array( $columns, $new_columns, 1, true );

	    return $columns;
	}

	/**
	 * Add custom column data to Logo listing page
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_post_columns_data( $column, $post_id ) {

	    global $post;

	    switch ($column) {

	    	case 'wpls_pro_image':
	    		$logo_image = wpls_pro_get_logo_image( $post_id, array(50, 50) );
	    		if( $logo_image ) {
	    			echo "<img src='{$logo_image}' class='wpls-logo-image' alt='' />";
	    		}
				break;

	    	case 'wpls_pro_order':

	    		$post_menu_order    = isset($post->menu_order) ? $post->menu_order : '';
	        
		        echo $post_menu_order;
		        echo "<input type='hidden' value='{$post_id}' name='wpls_pro_post[]' class='wpls-logo-order' id='wpls-logo-order-{$post_id}' />";
	    		break;
	    }
	}

	/**
	 * Add 'Sort Logo' link at Logo listing page
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_sorting_link( $views ) {
	    
	    global $post_type, $wp_query;

	    $class            = ( isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) ? 'current' : '';
	    $query_string     = remove_query_arg(array( 'orderby', 'order' ));
	    $query_string     = add_query_arg( 'orderby', urlencode('menu_order title'), $query_string );
	    $query_string     = add_query_arg( 'order', urlencode('ASC'), $query_string );
	    $views['byorder'] = '<a href="' . esc_url( $query_string ) . '" class="' . esc_attr( $class ) . '">' . __( 'Sort Logo', 'logoshowcase' ) . '</a>';

	    return $views;
	}

	/**
	 * Add category dropdown to Slider listing page
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_add_post_filters() {
		
		global $typenow;
		
		if( $typenow == WPLS_PRO_POST_TYPE ) {

			$wpls_pro_cat = isset($_GET[WPLS_PRO_CAT]) ? $_GET[WPLS_PRO_CAT] : '';

			$dropdown_options = apply_filters('wpls_pro_cat_filter_args', array(
					'show_option_all' 	=> __('All Categories', 'logoshowcase'),
					'hide_empty' 		=> 1,
					'hierarchical' 		=> 1,
					'show_count' 		=> 0,
					'orderby' 			=> 'name',
					'name'				=> WPLS_PRO_CAT,
					'taxonomy'			=> WPLS_PRO_CAT,
					'selected' 			=> $wpls_pro_cat,
					'value_field'		=> 'slug',
					'hide_if_empty'		=> true,
				));

			wp_dropdown_categories( $dropdown_options );
		}
	}

	/**
	 * Add Save button to Logo listing page
	 * 
	 * @package WP Logo Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_restrict_manage_posts(){

		global $typenow, $wp_query;

		if( $typenow == WPLS_PRO_POST_TYPE && isset($wp_query->query['orderby']) && $wp_query->query['orderby'] == 'menu_order title' ) {

			$html  = '';
			$html .= "<span class='spinner wpls-spinner'></span>";
			$html .= "<input type='button' name='wpls_save_order' class='button button-secondary right wpls-save-order' id='wpls-save-order' value='".__('Save Sort Order', 'logoshowcase')."' />";
			echo $html;
		}
	}

	/**
	 * Update Blog order
	 * 
	 * @package WP Logo Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_update_post_order() {

		// Taking some defaults
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'logoshowcase');

		if( !empty($_POST['form_data']) ) {

			$form_data 		= parse_str($_POST['form_data'], $output_arr);
			$wpls_posts 	= !empty($output_arr['wpls_pro_post']) ? $output_arr['wpls_pro_post'] : '';

			if( !empty($wpls_posts) ) {

				$post_menu_order = 0;

				// Loop od ids
				foreach ($wpls_posts as $wpls_post_key => $wpls_post) {
					
					// Update post order
					$update_post = array(
						'ID'           => $wpls_post,
						'menu_order'   => $post_menu_order,
					);

					// Update the post into the database
					wp_update_post( $update_post );

					$post_menu_order++;
				}

				$result['success'] 	= 1;
				$result['msg'] 		= __('Logo order saved successfully.', 'logoshowcase');
			}
		}
		echo json_encode($result);
		exit;
	}

	/**
	 * Function to add extra link to plugins action link
	 * 
	 * @package WP Logo Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_plugin_row_meta( $links, $file ) {
		
		if ( $file == WPLS_PRO_PLUGIN_BASENAME ) {
			
			$row_meta = array(
				'docs'    => '<a href="' . esc_url('https://www.wponlinesupport.com/pro-plugin-document/document-wp-logo-showcase-responsive-slider-pro') . '" title="' . esc_attr( __( 'View Documentation', 'logoshowcase' ) ) . '" target="_blank">' . __( 'Docs', 'logoshowcase' ) . '</a>',
				'support' => '<a href="' . esc_url('https://www.wponlinesupport.com/welcome-wp-online-support-forum/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'logoshowcase' ) ) . '" target="_blank">' . __( 'Support', 'logoshowcase' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}

	/**
	 * Function to add license plugins link
	 * 
	 * @package WP Logo Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_plugin_action_links( $links ) {

		$license_url = add_query_arg( array( 'post_type' => WPLS_PRO_POST_TYPE, 'page' => 'wpls-pro-license'), admin_url('edit.php') );
		
		$links['license'] = '<a href="' . esc_url($license_url) . '" title="' . esc_attr( __( 'Activate Plugin License', 'logoshowcase' ) ) . '">' . __( 'License', 'logoshowcase' ) . '</a>';
		
		return $links;
	}
}

$wpls_admin = new Wpls_Admin();