<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wphts_Pro_Admin {
	
	function __construct() {

		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'wphts_pro_add_metabox') );

		// Action to save metabox
		add_action( 'save_post', array($this,'wphts_pro_save_metabox_value') );

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'wphts_pro_register_menu'), 9 );

		// Action to register plugin settings
		add_action ( 'admin_init', array($this, 'wphts_pro_register_settings') );

		// Action to add category dropdown
		add_action( 'restrict_manage_posts', array($this, 'wphts_pro_add_post_filters'), 50 );

		// Manage Category Shortcode Columns
		add_filter('manage_edit-'.WPHTSP_PRO_CAT.'_columns', array($this,'wphts_pro_timeline_cat_columns'));
		add_filter('manage_'.WPHTSP_PRO_CAT.'_custom_column', array($this,'wphts_pro_timeline_cat_columns_data'), 10, 3);

		// Action to add sorting link at Timeline listing page
		add_filter( 'views_edit-'.WPHTSP_PRO_POST_TYPE, array($this, 'wphts_pro_sorting_link') );

		// Filter to add row data
		add_filter( 'post_row_actions', array($this, 'wphts_pro_add_post_row_data'), 10, 2 );

		// Action to add custom column to Timeline listing
		add_filter( 'manage_'.WPHTSP_PRO_POST_TYPE.'_posts_columns', array($this, 'wphts_pro_posts_columns') );

		// Action to add custom column data to testimonial listing
		add_action('manage_'.WPHTSP_PRO_POST_TYPE.'_posts_custom_column', array($this, 'wphts_pro_post_columns_data'), 10, 2);

		// Action to add `Save Order` button
		add_action( 'restrict_manage_posts', array($this, 'wphts_pro_restrict_manage_posts') );

		// Action to add `Post Type` support
		add_action( 'init', array($this, 'wphts_pro_add_post_type_support') );

		// Ajax call to update option
		add_action( 'wp_ajax_wphts_pro_update_post_order', array($this, 'wphts_pro_update_post_order'));
		add_action( 'wp_ajax_nopriv_wphts_pro_update_post_order',array( $this, 'wphts_pro_update_post_order'));

		// Filter to add plugin links
		add_filter( 'plugin_row_meta', array( $this, 'wphts_pro_plugin_row_meta' ), 10, 2 );		
	}

	/**
	 * Timeline Post Settings Metabox
	 * 
	 * @package WP History and Timeline Slider Pro
	 * @since 1.0.0
	 */
	function wphts_pro_add_metabox() {
		// Post settings metabox
		add_meta_box( 'wp-fcasp-post-sett', __( 'Timeline and History Slider Pro - Settings', 'timeline-and-history-slider' ), array($this, 'wphts_pro_sett_mb_cnt'), array(WPHTSP_PRO_POST_TYPE,'post'), 'normal', 'high' );
	}

	/**
	 * Featured Content Post Settings Metabox HTML
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wphts_pro_sett_mb_cnt() {
		include_once( WPHTSP_PRO_DIR .'/includes/admin/metabox/wphtsp-post-sett-metabox.php');
	}

	/**
	 * Function to register admin menus
	 * 
	 * @package WP History and Timeline Slider Pro
	 * @since 1.0.0
	 */
	function wphts_pro_register_menu() {
		add_submenu_page( 'edit.php?post_type='.WPHTSP_PRO_POST_TYPE, __('Settings', 'timeline-and-history-slider'), __('Settings', 'timeline-and-history-slider'), 'manage_options', 'wphts-pro-settings', array($this, 'wphts_pro_settings_page') );
	}

	/**
	 * Function to save metabox values
	 * 
	 * @package WP History and Timeline Slider Pro
	 * @since 1.0.0
	 */
	function wphts_pro_save_metabox_value( $post_id ) {

		global $post_type;
		$supported_posts = wphtsp_supported_post_types();
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( !in_array($post_type, $supported_posts) ) )              			// Check if current post type is supported.
		{
		  return $post_id;
		}
		
		$prefix = WPHTSP_META_PREFIX; // Taking metabox prefix
		
		// Taking variables
		$custom_icon 	= isset($_POST[$prefix.'custom_icon']) 		? wphtsp_slashes_deep($_POST[$prefix.'custom_icon']) 	: '';
		$featured_icon 	= isset($_POST[$prefix.'timeline_icon']) 	? wphtsp_slashes_deep($_POST[$prefix.'timeline_icon']) 	: '';
		$read_more_link = isset($_POST[$prefix.'timeline_link']) 	? wphtsp_slashes_deep($_POST[$prefix.'timeline_link']) 	: '';

		update_post_meta($post_id, $prefix.'custom_icon', $custom_icon);
		update_post_meta($post_id, $prefix.'timeline_icon', $featured_icon);
		update_post_meta($post_id, $prefix.'timeline_link', $read_more_link);
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @package WP History and Timeline Slider Pro
	 * @since 1.0.0
	 */
	function wphts_pro_settings_page() {
		include_once( WPHTSP_PRO_DIR . '/includes/admin/settings/wphtsp-settings.php' );
	}

	/**
	 * Function register setings
	 * 
	 * @package WP History and Timeline Slider Pro
	 * @since 1.0.0
	 */
	function wphts_pro_register_settings() {
		register_setting( 'wphtsp_pro_plugin_options', 'wphts_pro_options', array($this, 'wphts_pro_validate_options') );
	}

	/**
	 * Validate Settings Options
	 * 
	 * @package WP History and Timeline Slider Pro
	 * @since 1.0.0
	 */
	function wphts_pro_validate_options( $input ) {
		
		$input['default_img'] 	= isset($input['default_img']) ? wphtsp_slashes_deep($input['default_img']) 		: '';
		$input['custom_css'] 	= isset($input['custom_css']) ? wphtsp_slashes_deep($input['custom_css'], true) 	: '';
		
		return $input;
	}
	
	/**
	 * Add category dropdown to testimonial listing page
	 * 
	 * @package WP History and Timeline Slider Pro
	 * @since 1.0.0
	 */
	function wphts_pro_add_post_filters() {

		global $typenow;
		
		if( $typenow == WPHTSP_PRO_POST_TYPE ) {

			$dropdown_options = apply_filters('wphtsp_cat_filter_args', array(
					'show_option_none'  => __('All Categories', 'timeline-and-history-slider'),
					'option_none_value' => '',
					'hide_empty' 		=> 1,
					'hierarchical' 		=> 1,
					'show_count' 		=> 0,
					'orderby' 			=> 'name',
					'name'				=> WPHTSP_PRO_CAT,
					'taxonomy'			=> WPHTSP_PRO_CAT,
					'selected' 			=> isset($_GET[WPHTSP_PRO_CAT]) ? $_GET[WPHTSP_PRO_CAT] : '',
					'value_field'		=> 'slug'
				));

			wp_dropdown_categories( $dropdown_options );
		}
	}

	/**
	 * Add extra column to testimonial category
	 * 
	 * @package WP History and Timeline Slider Pro
	 * @since 1.0.0
	 */
	function wphts_pro_timeline_cat_columns( $columns ) {

    	$new_columns['wphtsp_shortcode'] = __( 'Timeline Category Shortcode', 'timeline-and-history-slider' );

		$columns = wphts_pro_add_array( $columns, $new_columns, 2 );

		return $columns;
	}

	/**
	 * Add data to extra column to testimonial category
	 * 
	 * @package WP History and Timeline Slider Pro
	 * @since 1.0.0
	 */
	function wphts_pro_timeline_cat_columns_data($ouput, $column_name, $tax_id) {
	   
	   if( $column_name == 'wphtsp_shortcode' ){
			$ouput .= '[th-slider category="' . $tax_id. '"]<br/>';
			$ouput .= '[th-history category="' . $tax_id. '"]';
	    }
		
	    return $ouput;
	}

	/**
	 * Add 'Sort Tiemline' link at Timeline listing page
	 * 
	 * @package WP History and Timeline Slider Pro
	 * @since 1.0.0
	 */
	function wphts_pro_sorting_link( $views ) {

		global $wp_query;

		$class            = ( isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) ? 'current' : '';
		$query_string     = remove_query_arg(array( 'orderby', 'order' ));
		$query_string     = add_query_arg( 'orderby', urlencode('menu_order title'), $query_string );
		$query_string     = add_query_arg( 'order', urlencode('ASC'), $query_string );
		$views['byorder'] = '<a href="' . esc_url( $query_string ) . '" class="' . esc_attr( $class ) . '">' . __( 'Sort Tiemline', 'timeline-and-history-slider' ) . '</a>';

		return $views;
	}

	/**
	 * Function to add custom quick links at post listing page
	 * 
	 * @package WP History and Timeline Slider Pro
	 * @since 1.0.0
	 */
	function wphts_pro_add_post_row_data( $actions, $post ) {
		
		if( $post->post_type == WPHTSP_PRO_POST_TYPE ) {
			return array_merge( array( 'wphts_pro_id' => 'ID: ' . $post->ID ), $actions );
		}
		return $actions;
	}

	/**
	 * Add custom column to Testimonial listing page
	 * 
	 * @package WP History and Timeline Slider Pro
	 * @since 1.0.0
	 */
	function wphts_pro_posts_columns( $columns ){

		$new_columns['wphts_pro_order'] 	= __('Order', 'timeline-and-history-slider');

		$columns = wphts_pro_add_array( $columns, $new_columns, 3 );

		return $columns;
	}

	/**
	 * Add custom column data to Testimonial listing page
	 * 
	 * @package WP History and Timeline Slider Pro
	 * @since 1.0.0
	 */
	function wphts_pro_post_columns_data( $column, $post_id ) {

		global $post;

		if( $column == 'wphts_pro_order' ) {

			$post_menu_order = isset($post->menu_order) ? $post->menu_order : '';
			
			echo $post_menu_order;
			echo "<input type='hidden' value='{$post_id}' name='wphts_pro_post[]' class='wphts-testimonial-order' id='wphts-testimonial-order-{$post_id}' />";
		}
	}

	/**
	 * Add Save button to Timeline listing page
	 * 
	 * @package WP History and Timeline Slider Pro
	 * @since 1.0.0
	 */
	function wphts_pro_restrict_manage_posts(){

		global $typenow, $wp_query;

		if( $typenow == WPHTSP_PRO_POST_TYPE && isset($wp_query->query['orderby']) && $wp_query->query['orderby'] == 'menu_order title' ) {

			$html  = '';
			$html .= "<span class='spinner wphts-spinner'></span>";
			$html .= "<input type='button' name='wphts_save_order' class='button button-secondary right wphts-save-order' id='wphts-save-order' value='".__('Save Sort Order', 'timeline-and-history-slider')."' />";
			echo $html;
		}
	}

	/**
	 * Function to add post type support
	 * 
	 * @package WP History and Timeline Slider Pro
	 * @since 1.0.4
	 */
	function wphts_pro_add_post_type_support() {
		add_post_type_support( 'post', 'page-attributes' );
	}

	/**
	 * Update Testimonials order
	 * 
	 * @package WP History and Timeline Slider Pro
	 * @since 1.0.0
	 */
	function wphts_pro_update_post_order() {
		// Taking some defaults
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'timeline-and-history-slider');

		if( !empty($_POST['form_data']) ) {

			$form_data 		= parse_str($_POST['form_data'], $output_arr);
			$wphts_posts 	= !empty($output_arr['wphts_pro_post']) ? $output_arr['wphts_pro_post'] : '';

			if( !empty($wphts_posts) ) {

				$post_menu_order = 0;

				// Loop od ids
				foreach ($wphts_posts as $wpbab_post_key => $wphts_post) {
					
					// Update post order
					$update_post = array(
						'ID'           => $wphts_post,
						'menu_order'   => $post_menu_order,
						);

					// Update the post into the database
					wp_update_post( $update_post );

					$post_menu_order++;
				}

				$result['success'] 	= 1;
				$result['msg'] 		= __('Timeline order saved successfully.', 'timeline-and-history-slider');
			}
		}

		echo json_encode($result);
		exit;
	}

	/**
	 * Function to unique number value
	 * 
	 * @package WP History and Timeline Slider Pro
	 * @since 1.0.0
	 */
	function wphts_pro_plugin_row_meta( $links, $file ) {
		
		if ( $file == WPHTSP_PRO_PLUGIN_BASENAME ) {
			$row_meta = array(
				'docs'    => '<a href="' . esc_url('https://www.wponlinesupport.com/pro-plugin-document/document-timeline-history-silder-pro/') . '" title="' . esc_attr( __( 'View Documentation', 'timeline-and-history-slider' ) ) . '" target="_blank">' . __( 'Docs', 'timeline-and-history-slider' ) . '</a>',
				'support' => '<a href="' . esc_url('https://www.wponlinesupport.com/welcome-wp-online-support-forum/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'timeline-and-history-slider' ) ) . '" target="_blank">' . __( 'Support', 'timeline-and-history-slider' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}
}

$wphts_pro_admin = new Wphts_Pro_Admin();