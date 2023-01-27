<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpspw_Pro_Admin {
	
	function __construct() {
		
		// Action to add post type support
		add_action( 'init', array($this, 'wpspw_pro_support_for_post') );

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'wpspw_pro_register_menu'), 9 );

		// Action to register plugin settings
		add_action( 'admin_init', array($this, 'wpspw_pro_register_settings') );

		// Filter for post category columns
		add_filter('manage_edit-category_columns', array($this, 'wpspw_pro_manage_category_columns'));

		add_filter('manage_'.WPSPW_CAT.'_custom_column', array($this, 'wpspw_pro_cat_columns_data'), 10, 3);

		// Action to add custom column to Post listing
		add_filter( 'manage_'.WPSPW_POST_TYPE.'_posts_columns', array($this, 'wpspw_pro_posts_columns') );

		// Action to add custom column data to Post listing
		add_action('manage_'.WPSPW_POST_TYPE.'_posts_custom_column', array($this, 'wpspw_pro_post_columns_data'), 10, 2);

		// Action to add sorting link at Post listing page
		add_filter( 'views_edit-'.WPSPW_POST_TYPE, array($this, 'wpspw_pro_sorting_link') );

		// Action to add `Save Order` button
		add_action( 'restrict_manage_posts', array($this, 'wpspw_pro_restrict_manage_posts') );

		// Ajax call to update option
		add_action( 'wp_ajax_wpspw_pro_update_post_order', array($this, 'wpspw_pro_update_post_order'));
		add_action( 'wp_ajax_nopriv_wpspw_pro_update_post_order',array( $this, 'wpspw_pro_update_post_order'));

		// Filter to add plugin links
		add_filter( 'plugin_row_meta', array( $this, 'wpspw_pro_plugin_row_meta' ), 10, 2 );
		add_filter( 'plugin_action_links_' . WPSPW_PRO_PLUGIN_BASENAME, array( $this, 'wpspw_pro_plugin_action_links' ) );
	}

	/**
	 * Function to add support for custom post type support
	 * 
	 * @package Blog Designer - Post and Widget Pro
	 * @since 1.0.0
	 */
	function wpspw_pro_support_for_post() {
		add_post_type_support( WPSPW_POST_TYPE, 'page-attributes' );
	}

	/**
	 * Function to register admin menus
	 * 
	 * @package Blog Designer - Post and Widget Pro
	 * @since 1.0.0
	 */
	function wpspw_pro_register_menu() {
		add_submenu_page( 'edit.php', __('Blog Designer Settings', 'blog-designer-for-post-and-widget'), __('Blog Designer Setting', 'blog-designer-for-post-and-widget'), 'manage_options', 'wpspw-pro-settings', array($this, 'wpspw_pro_settings_page') );
	}
	
	/**
	 * Function to handle the setting page html
	 * 
	 * @package Blog Designer - Post and Widget Pro
	 * @since 1.0.0
	 */
	function wpspw_pro_settings_page() {
		include_once( WPSPW_PRO_DIR . '/includes/admin/settings/wpspw-settings.php' );
	}

	/**
	 * Function register setings
	 * 
	 * @package Blog Designer - Post and Widget Pro
	 * @since 1.0.0
	 */
	function wpspw_pro_register_settings() {
		register_setting( 'wpspw_pro_plugin_options', 'wpspw_pro_options', array($this, 'wpspw_pro_validate_options') );
	}  // (option group name in detting_field, option name to save, callback fun)

	/**
	 * Validate Settings Options
	 * 
	 * @package Blog Designer - Post and Widget Pro
	 * @since 1.0.0
	 */
	function wpspw_pro_validate_options($input) {
		
		$input['default_img'] 	= isset($input['default_img']) 	? wpspw_slashes_deep($input['default_img']) 		: '';
		$input['custom_css'] 	= isset($input['custom_css']) 	? wpspw_slashes_deep($input['custom_css'], true) 	: '';
		
		return $input;
	}

	/**
	 * Admin Class
	 *
	 * Add extra column to post category
	 *
	 * @package Blog Designer - Post and Widget Pro
	 * @since 1.0.0
	*/
	function wpspw_pro_manage_category_columns($columns) {

		$new_columns['wpspw_pro_shortcode'] = __( 'Post Category Shortcode', 'blog-designer-for-post-and-widget' );
		
		$columns = wpspw_pro_add_array( $columns, $new_columns, 2 );
		
		return $columns;
	}

	/**
	 * Admin Class
	 *
	 * Add data to extra column to post category
	 *
	 * @package Blog Designer - Post and Widget Pro
	 * @since 1.0.0
	*/
	function wpspw_pro_cat_columns_data($ouput, $column_name, $tax_id) {
		
		switch ($column_name) {
			case 'wpspw_pro_shortcode':
				echo '[wpspw_post category="' . $tax_id. '"]<br />';
				echo '[wpspw_recent_post category="' . $tax_id. '"]<br />';
				echo '[wpspw_recent_post_slider category="' . $tax_id. '"]<br />';
				break;
		}
		return $ouput;
	}

	/**
	 * Add custom column to Post listing page
	 * 
	 * @package Blog Designer - Post and Widget Pro
	 * @since 1.0.0
	 */
	function wpspw_pro_posts_columns( $columns ){

	    $new_columns['wpspw_pro_order'] = __('Order', 'blog-designer-for-post-and-widget');

	    $columns = wpspw_pro_add_array( $columns, $new_columns, 2, true );

	    return $columns;
	}

	/**
	 * Add custom column data to Post listing page
	 * 
	 * @package Blog Designer - Post and Widget Pro
	 * @since 1.0.0
	 */
	function wpspw_pro_post_columns_data( $column, $data ) {

	    global $post;

	    if( $column == 'wpspw_pro_order' ){
	        $post_id            = isset($post->ID) ? $post->ID : '';
	        $post_menu_order    = isset($post->menu_order) ? $post->menu_order : '';
	        
	        echo $post_menu_order;
	        echo "<input type='text' value='{$post_id}' name='wpspw_pro_post[]' class='wpspw-post-order' id='wpspw-post-order-{$post_id}' />";
	    }
	}

	/**
	 * Add 'Sort Post' link at Post listing page
	 * 
	 * @package Blog Designer - Post and Widget Pro
	 * @since 1.0.0
	 */
	function wpspw_pro_sorting_link( $views ) {
	    
	    global $post_type, $wp_query;

	    $class            = ( isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) ? 'current' : '';
	    $query_string     = remove_query_arg(array( 'orderby', 'order' ));
	    $query_string     = add_query_arg( 'orderby', urlencode('menu_order title'), $query_string );
	    $query_string     = add_query_arg( 'order', urlencode('ASC'), $query_string );
	    $views['byorder'] = '<a href="' . esc_url( $query_string ) . '" class="' . esc_attr( $class ) . '">' . __( 'Sort Post', 'blog-designer-for-post-and-widget' ) . '</a>';

	    return $views;
	}

	/**
	 * Add Save button to Post listing page
	 * 
	 * @package Blog Designer - Post and Widget Pro
	 * @since 1.0.0
	 */
	function wpspw_pro_restrict_manage_posts(){

		global $typenow, $wp_query;

		if( $typenow == WPSPW_POST_TYPE && isset($wp_query->query['orderby']) && $wp_query->query['orderby'] == 'menu_order title' ) {

			$html  = '';
			$html .= "<span class='spinner wpspw-spinner'></span>";
			$html .= "<input type='button' name='wpspw_save_order' class='button button-secondary right wpspw-save-order' id='wpspw-save-order' value='".__('Save Sort Order', 'blog-designer-for-post-and-widget')."' />";
			echo $html;
		}
	}

	/**
	 * Update Post order
	 * 
	 * @package Blog Designer - Post and Widget Pro
	 * @since 1.0.0
	 */
	function wpspw_pro_update_post_order() {

		// Taking some defaults
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'blog-designer-for-post-and-widget');

		if( !empty($_POST['form_data']) ) {

			$form_data 		= parse_str($_POST['form_data'], $output_arr);
			$wpspw_posts 	= !empty($output_arr['wpspw_pro_post']) ? $output_arr['wpspw_pro_post'] : '';

			if( !empty($wpspw_posts) ) {

				$post_menu_order = 0;

				// Loop od ids
				foreach ($wpspw_posts as $wpspw_post_key => $wpspw_post) {
					
					// Update post order
					$update_post = array(
						'ID'           => $wpspw_post,
						'menu_order'   => $post_menu_order,
					);

					// Update the post into the database
					wp_update_post( $update_post );

					$post_menu_order++;
				}

				$result['success'] 	= 1;
				$result['msg'] 		= __('Post order saves successfully.', 'blog-designer-for-post-and-widget');
			}
		}

		echo json_encode($result);
		exit;
	}

	/**
	 * Function to unique number value
	 * 
	 * @package Blog Designer - Post and Widget Pro
	 * @since 1.0.0
	 */
	function wpspw_pro_plugin_row_meta( $links, $file ) {
		
		if ( $file == WPSPW_PRO_PLUGIN_BASENAME ) {
			
			$row_meta = array(
				'docs'    => '<a href="' . esc_url('https://www.wponlinesupport.com/pro-plugin-document/document-wpspw-post-and-widgets-pro/') . '" title="' . esc_attr( __( 'View Documentation', 'blog-designer-for-post-and-widget' ) ) . '" target="_blank">' . __( 'Docs', 'blog-designer-for-post-and-widget' ) . '</a>',
				'support' => '<a href="' . esc_url('https://www.wponlinesupport.com/welcome-wp-online-support-forum/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'blog-designer-for-post-and-widget' ) ) . '" target="_blank">' . __( 'Support', 'blog-designer-for-post-and-widget' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}

	/**
	 * Function to add extra plugins link
	 * 
	 * @package Blog Designer - Post and Widget Pro
	 * @since 1.0.0
	 */
	function wpspw_pro_plugin_action_links( $links ) {
		
		$license_url = add_query_arg( array('page' => 'wpspw-pro-license'), admin_url('edit.php') );
		
		$links['license'] = '<a href="' . esc_url($license_url) . '" title="' . esc_attr( __( 'Activate Plugin License', 'blog-designer-for-post-and-widget' ) ) . '">' . __( 'License', 'blog-designer-for-post-and-widget' ) . '</a>';
		
		return $links;
	}
}

$wpspw_pro_admin = new Wpspw_Pro_Admin();