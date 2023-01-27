<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wp_Fcasp_Admin {
	
	function __construct() {

		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'wp_fcasp_add_metabox') );

		// Action to save metabox
		add_action( 'save_post', array($this,'wp_fcasp_save_metabox_value') );

		// Action to register plugin settings
		add_action ( 'admin_init', array($this, 'wp_fcasp_register_settings') );

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'wp_fcasp_register_menu'), 9 );

		// Filter for featured content category columns
		add_filter( 'manage_edit-'.WP_FCASP_CAT.'_columns', array($this, 'wp_fcasp_manage_category_columns') );
		add_filter( 'manage_'.WP_FCASP_CAT.'_custom_column', array($this, 'wp_fcasp_category_data'), 10, 3 );

		// Action to add sorting link at Featured Content listing page
		add_filter( 'views_edit-'.WP_FCASP_POST_TYPE, array($this, 'wp_fcasp_sorting_link') );

		// Action to add custom column to Featured Content listing
		add_filter( 'manage_'.WP_FCASP_POST_TYPE.'_posts_columns', array($this, 'wp_fcasp_posts_columns') );

		// Action to add custom column data to Featured Content listing
		add_action('manage_'.WP_FCASP_POST_TYPE.'_posts_custom_column', array($this, 'wp_fcasp_post_columns_data'), 10, 2);

		// Action to add category dropdown
		add_action( 'restrict_manage_posts', array($this, 'wp_fcasp_add_post_filters'), 100 );

		// Action to add `Save Order` button
		add_action( 'restrict_manage_posts', array($this, 'wp_fcasp_restrict_manage_posts') );

		// Ajax call to update option
		add_action( 'wp_ajax_wp_fcasp_update_post_order', array($this, 'wp_fcasp_update_post_order'));
		add_action( 'wp_ajax_nopriv_wp_fcasp_update_post_order',array( $this, 'wp_fcasp_update_post_order'));

		// Filter to add plugin links
		add_filter( 'plugin_row_meta', array( $this, 'wp_fcasp_plugin_row_meta' ), 10, 2 );
		add_filter( 'plugin_action_links_' . WP_FCASP_PLUGIN_BASENAME, array( $this, 'wp_fcasp_plugin_action_links' ) );
	}

	/**
	 * Featured Content Post Settings Metabox
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_add_metabox() {
		
		// Post settings metabox
		add_meta_box( 'wp-fcasp-post-sett', __( 'Featured Content Settings', 'wp-featured-content-and-slider' ), array($this, 'wp_fcasp_sett_mb_cnt'), WP_FCASP_POST_TYPE, 'normal', 'high' );
	}

	/**
	 * Featured Content Post Settings Metabox HTML
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_sett_mb_cnt() {
		include_once( WP_FCASP_DIR .'/includes/admin/metabox/wp-fcasp-post-sett-metabox.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_save_metabox_value( $post_id ) {

		global $post_type;
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( $post_type !=  WP_FCASP_POST_TYPE ) )              				// Check if current post type is supported.
		{
		  return $post_id;
		}
		
		$prefix = WP_FCASP_META_PREFIX; // Taking metabox prefix
		
		// Taking variables
		$featured_icon 	= isset($_POST['wpfcas_slide_icon']) ? wp_fcasp_slashes_deep($_POST['wpfcas_slide_icon']) : '';
		$read_more_link = isset($_POST['wpfcas_slide_link']) ? wp_fcasp_slashes_deep($_POST['wpfcas_slide_link']) : '';
		
		update_post_meta($post_id, 'wpfcas_slide_icon', $featured_icon);
		update_post_meta($post_id, 'wpfcas_slide_link', $read_more_link);
	}

	/**
	 * Function register setings
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_register_settings() {
		register_setting( 'wp_fcasp_plugin_options', 'wp_fcasp_options', array($this, 'wp_fcasp_validate_options') );
	}

	/**
	 * Validate Settings Options
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_validate_options( $input ) {
		
		$input['default_img'] 	= isset($input['default_img']) 	? wp_fcasp_slashes_deep($input['default_img']) 		: '';
		$input['custom_css'] 	= isset($input['custom_css']) 	? wp_fcasp_slashes_deep($input['custom_css'], true) : '';
		
		// Filter to validate options
		$input = apply_filters('wp_fcasp_validate_options', $input );

		return $input;
	}

	/**
	 * Function to register admin menus
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_register_menu() {
		add_submenu_page( 'edit.php?post_type='.WP_FCASP_POST_TYPE, __('Settings', 'wp-featured-content-and-slider'), __('Settings', 'wp-featured-content-and-slider'), 'manage_options', 'wp-fcasp-settings', array($this, 'wp_fcasp_settings_page') );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_settings_page() {
		include_once( WP_FCASP_DIR . '/includes/admin/settings/wp-fcasp-settings.php' );
	}

	/**
	 * Add extra column to featured content category
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_manage_category_columns( $columns ) {

	    $new_columns['wp_fcasp_shortcode'] = __( 'Category Shortcode', 'wp-featured-content-and-slider' );

		$columns = wp_fcasp_add_array( $columns, $new_columns, 2 );

		return $columns;
	}
	
	/**
	 * Add data to extra column to featured content category
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_category_data($ouput, $column_name, $tax_id) {
		
	    if( $column_name == 'wp_fcasp_shortcode' ) {
			$ouput .= '[featured-cnt-icon cat_id="' . $tax_id. '"]<br />';
			$ouput .= '[featured-cnt-img cat_id="' . $tax_id. '"]<br />';
			$ouput .= '[featured-cnt-icon-img cat_id="' . $tax_id. '"]';
	    }

	    return $ouput;
	}

	/**
	 * Add 'Sort Featured Content' link at Blog listing page
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_sorting_link( $views ) {
	    
	    global $post_type, $wp_query;
	    
	    $class            = ( isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) ? 'current' : '';
	    $query_string     = remove_query_arg(array( 'orderby', 'order' ));
	    $query_string     = add_query_arg( 'orderby', urlencode('menu_order title'), $query_string );
	    $query_string     = add_query_arg( 'order', urlencode('ASC'), $query_string );
	    $views['byorder'] = '<a href="' . esc_url( $query_string ) . '" class="' . esc_attr( $class ) . '">' . __( 'Sort Featured Content', 'wp-featured-content-and-slider' ) . '</a>';

	    return $views;
	}

	/**
	 * Add custom column to Featured Content listing page
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_posts_columns( $columns ) {

	    $new_columns['wp_fcasp_order'] = __('Order', 'wp-featured-content-and-slider');

	    $columns = wp_fcasp_add_array( $columns, $new_columns, 3 );

	    return $columns;
	}

	/**
	 * Add custom column data to Featured Content listing page
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_post_columns_data( $column, $data ) {

	    global $post;

	    if( $column == 'wp_fcasp_order' ){
	        $post_id            = isset($post->ID) ? $post->ID : '';
	        $post_menu_order    = isset($post->menu_order) ? $post->menu_order : '';
	        
	        echo $post_menu_order;
	        echo "<input type='hidden' value='{$post_id}' name='wp_fcasp_post[]' class='wp-fcasp-blog-order' id='wp-fcasp-order-{$post_id}' />";
	    }
	}

	/**
	 * Add category dropdown to Featured Content listing page
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_add_post_filters() {
		
		global $typenow;
		
		if( $typenow == WP_FCASP_POST_TYPE ) {

			$wp_fcasp_cat = isset($_GET[WP_FCASP_CAT]) ? $_GET[WP_FCASP_CAT] : '';

			$dropdown_options = apply_filters('wp_fcasp_cat_filter_args', array(
					'show_option_all' 	=> __('All Categories', 'wp-featured-content-and-slider'),
					'hide_empty' 		=> 1,
					'hierarchical' 		=> 1,
					'show_count' 		=> 0,
					'orderby' 			=> 'name',
					'name'				=> WP_FCASP_CAT,
					'taxonomy'			=> WP_FCASP_CAT,
					'selected' 			=> $wp_fcasp_cat,
					'value_field'		=> 'slug'
				));

			wp_dropdown_categories( $dropdown_options );
		}
	}

	/**
	 * Add Save button to Featured Content listing page
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_restrict_manage_posts() {

		global $typenow, $wp_query;

		if( $typenow == WP_FCASP_POST_TYPE && isset($wp_query->query['orderby']) && $wp_query->query['orderby'] == 'menu_order title' ) {

			$html  = '';
			$html .= "<span class='spinner wp-fcasp-spinner'></span>";
			$html .= "<input type='button' name='wp_fcasp_save_order' class='button button-secondary right wp-fcasp-save-order' id='wp-fcasp-save-order' value='".__('Save Sort Order', 'wp-featured-content-and-slider')."' />";
			echo $html;
		}
	}

	/**
	 * Update Blog order
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_update_post_order() {

		// Taking some defaults
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'wp-featured-content-and-slider');

		if( !empty($_POST['form_data']) ) {

			$form_data 		= parse_str($_POST['form_data'], $output_arr);
			$wp_fcasp_posts = !empty($output_arr['wp_fcasp_post']) ? $output_arr['wp_fcasp_post'] : '';

			if( !empty($wp_fcasp_posts) ) {

				$post_menu_order = 0;

				// Loop od ids
				foreach ($wp_fcasp_posts as $wp_fcasp_post_key => $wp_fcasp_post) {
					
					// Update post order
					$update_post = array(
						'ID'           => $wp_fcasp_post,
						'menu_order'   => $post_menu_order,
					);

					// Update the post into the database
					wp_update_post( $update_post );

					$post_menu_order++;
				}

				$result['success'] 	= 1;
				$result['msg'] 		= __('Featured Content order saved successfully.', 'wp-featured-content-and-slider');
			}
		}

		echo json_encode($result);
		exit;
	}

	/**
	 * Function to unique number value
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_plugin_row_meta( $links, $file ) {
		
		if ( $file == WP_FCASP_PLUGIN_BASENAME ) {
			
			$row_meta = array(
				'docs'    => '<a href="' . esc_url('https://www.wponlinesupport.com/pro-plugin-document/document-wp-featured-content-and-slider-pro/') . '" title="' . esc_attr( __( 'View Documentation', 'wp-featured-content-and-slider' ) ) . '" target="_blank">' . __( 'Docs', 'wp-featured-content-and-slider' ) . '</a>',
				'support' => '<a href="' . esc_url('https://www.wponlinesupport.com/welcome-wp-online-support-forum/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'wp-featured-content-and-slider' ) ) . '" target="_blank">' . __( 'Support', 'wp-featured-content-and-slider' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}

	/**
	 * Function to add extra plugins link
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_plugin_action_links( $links ) {
		
		$license_url = add_query_arg( array( 'post_type' => WP_FCASP_POST_TYPE, 'page' => 'wp-fcasp-license'), admin_url('edit.php') );
		
		$links['license'] = '<a href="' . esc_url($license_url) . '" title="' . esc_attr( __( 'Activate Plugin License', 'wp-featured-content-and-slider' ) ) . '">' . __( 'License', 'wp-featured-content-and-slider' ) . '</a>';
		
		return $links;
	}
}

$wp_fcasp_admin = new Wp_Fcasp_Admin();