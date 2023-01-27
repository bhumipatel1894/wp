<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wprpsp_Admin {
	
	function __construct() {
		
		// Action to add post type support
		add_action( 'init', array($this, 'wprpsp_add_post_type_support') );

		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'wprpsp_post_sett_metabox') );

		// Action to save metabox
		add_action( 'save_post', array($this, 'wprpsp_save_metabox_value') );

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'wprpsp_register_menu'), 9 );
		
		// Action to register plugin settings
		add_action ( 'admin_init', array($this, 'wprpsp_register_settings') );

		// Filter to add extra column in post `category` table
		add_filter( 'manage_edit-'.WPRPSP_CAT.'_columns', array($this, 'wprpsp_manage_category_columns') );
		add_filter( 'manage_'.WPRPSP_CAT.'_custom_column', array($this, 'wprpsp_post_category_data'), 10, 3 );

		// Action to add custom column to Post listing
		add_filter( 'manage_'.WPRPSP_POST_TYPE.'_posts_columns', array($this, 'wprpsp_posts_columns') );

		// Action to add custom column data to News listing
		add_action('manage_'.WPRPSP_POST_TYPE.'_posts_custom_column', array($this, 'wprpsp_pro_post_columns_data'), 10, 2);

		// Action to add sorting link at Post listing page
		add_filter( 'views_edit-'.WPRPSP_POST_TYPE, array($this, 'wprpsp_sorting_link') );

		// Action to add `Save Order` button
		add_action( 'restrict_manage_posts', array($this, 'wprpsp_restrict_manage_posts') );

		// Ajax call to update option
		add_action( 'wp_ajax_wprpsp_update_post_order', array($this, 'wprpsp_update_post_order'));
		add_action( 'wp_ajax_nopriv_wprpsp_update_post_order',array( $this, 'wprpsp_update_post_order'));

		// Ajax call to get texonomy
		add_action( 'wp_ajax_wprpsp_get_post_taxonomy', array($this, 'wprpsp_get_post_taxonomy'));
		
		// Ajax call to get texonomy terms
		add_action( 'wp_ajax_wprpsp_get_taxonomy_terms', array($this, 'wprpsp_get_taxonomy_terms'));

		// Filter to add plugin links
		add_filter( 'plugin_row_meta', array( $this, 'wprpsp_plugin_row_meta' ), 10, 2 );
	}

	/**
	 * Function to register admin menus
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.2.7
	 */
	function wprpsp_add_post_type_support() {
		add_post_type_support( WPRPSP_POST_TYPE, 'page-attributes' );
	}

	/**
	 * Post Settings Metabox
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.2.7
	 */
	function wprpsp_post_sett_metabox() {
		$supported_post_types = wprpsp_get_option('post_types',array());
		add_meta_box( 'wprpsp-post-sett', __( 'WP Responsive Recent Post Slider Pro - Settings', 'wp-responsive-recent-post-slider' ), array($this, 'wprpsp_post_sett_mb_content'), $supported_post_types, 'normal', 'default' );
	}

	/**
	 * Post Settings Metabox HTML
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.2.7
	 */
	function wprpsp_post_sett_mb_content() {
		include_once( WPRPSP_DIR .'/includes/admin/metabox/wprpsp-post-sett-metabox.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.2.7
	 */
	function wprpsp_save_metabox_value( $post_id ) {

		global $post_type;

		$supported_post_type = wprpsp_get_option('post_types',array());

		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( !(in_array($post_type, $supported_post_type)) ) )              	// Check if current post type is supported.
		{
		  return $post_id;
		}

		$prefix = WPRPSP_META_PREFIX; // Taking metabox prefix

		// Taking variables
		$read_more_link = isset($_POST[$prefix.'more_link']) ? wprpsp_slashes_deep(trim($_POST[$prefix.'more_link'])) : '';

		update_post_meta($post_id, $prefix.'more_link', $read_more_link);
	}

	/**
	 * Function to register admin menus
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.2.7
	 */
	function wprpsp_register_menu() {
		add_submenu_page( 'edit.php', __('Settings', 'wp-responsive-recent-post-slider'), __('Settings', 'wp-responsive-recent-post-slider'), 'manage_options', 'wprpsp-settings', array($this, 'wprpsp_settings_page') );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.2.7
	 */
	function wprpsp_settings_page() {
		include_once( WPRPSP_DIR . '/includes/admin/settings/wprpsp-settings.php' );
	}

	/**
	 * Function register setings
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.0.0
	 */
	function wprpsp_register_settings() {
		register_setting( 'wprpsp_plugin_options', 'wprpsp_options', array($this, 'wprpsp_validate_options') );
	}

	/**
	 * Validate Settings Options
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.0.0
	 */
	function wprpsp_validate_options( $input ) {

		$input['default_img'] 	= isset($input['default_img']) 	? wprpsp_slashes_deep($input['default_img']) 		: '';
		$input['custom_css'] 	= isset($input['custom_css']) 	? wprpsp_slashes_deep($input['custom_css'], true) 	: '';
		$input['post_types']	= isset($input['post_types'])	? $input['post_types'] : array();

		// Pass default post type
		if( !in_array('post', $input['post_types']) ) {
			$input['post_types'][] = 'post';
		}

		return $input;
	}
	
	/**
	 * Add extra column to news category
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.0.0
	 */
	function wprpsp_manage_category_columns($columns) {

		$new_columns['wprpsp_shortcode'] = __( 'Category Shortcode', 'wp-responsive-recent-post-slider' );

		$columns = wprpsp_add_array( $columns, $new_columns, 2 );

		return $columns;
	}

	/**
	 * Add data to extra column to news category
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.0.0
	 */
	function wprpsp_post_category_data($ouput, $column_name, $tax_id) {
		
		if( $column_name == 'wprpsp_shortcode' ) {
			$ouput .= '[recent_post_slider category="' . $tax_id. '"]<br/>';
			$ouput .= '[recent_post_carousel category="' . $tax_id. '"]';
	    }
		
	    return $ouput;
	}

	/**
	 * Add custom column to Post listing page
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.2.7
	 */
	function wprpsp_posts_columns( $columns ){

	    $new_columns['wpos_post_order'] = __('Order', 'wp-responsive-recent-post-slider');

	    $columns = wprpsp_add_array( $columns, $new_columns, 2, true );

	    return $columns;
	}

	/**
	 * Add custom column data to Post listing page
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.0.0
	 */
	function wprpsp_pro_post_columns_data( $column, $data ) {

	    global $post;

	    if( $column == 'wpos_post_order' ) {
	        $post_id            = isset($post->ID) ? $post->ID : '';
	        $post_menu_order    = isset($post->menu_order) ? $post->menu_order : '';
	        
	        echo $post_menu_order;
	        echo "<input type='hidden' value='{$post_id}' name='wprpsp_pro_post[]' class='wprpsp-post-order' id='wprpsp-post-order-{$post_id}' />";
	    }
	}

	/**
	 * Add 'Sort Post' link at Post listing page
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.2.7
	 */
	function wprpsp_sorting_link( $views ) {
	    
	    global $post_type, $wp_query;

	    $class            = ( isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) ? 'current' : '';
	    $query_string     = remove_query_arg(array( 'orderby', 'order' ));
	    $query_string     = add_query_arg( 'orderby', urlencode('menu_order title'), $query_string );
	    $query_string     = add_query_arg( 'order', urlencode('ASC'), $query_string );
	    $views['byorder'] = '<a href="' . esc_url( $query_string ) . '" class="' . esc_attr( $class ) . '">' . __( 'Sort Post', 'wp-responsive-recent-post-slider' ) . '</a>';

	    return $views;
	}

	/**
	 * Add Save button to Post listing page
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.0.0
	 */
	function wprpsp_restrict_manage_posts(){
		
		global $typenow, $wp_query;

		if( $typenow == WPRPSP_POST_TYPE && isset($wp_query->query['orderby']) && $wp_query->query['orderby'] == 'menu_order title' ) {

			$html  = '';
			$html .= "<span class='spinner wprpsp-spinner'></span>";
			$html .= "<input type='button' name='wprpsp_save_order' class='button button-secondary right wprpsp-save-order' id='wprpsp-save-order' value='".__('Save Sort Order', 'wp-responsive-recent-post-slider')."' />";
			echo $html;
		}
	}

	/**
	 * Update Post order
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.0.0
	 */
	function wprpsp_update_post_order() {

		// Taking some defaults
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'wp-responsive-recent-post-slider');

		if( !empty($_POST['form_data']) ) {

			$form_data 		= parse_str($_POST['form_data'], $output_arr);
			$wprpsp_posts 	= !empty($output_arr['wprpsp_pro_post']) ? $output_arr['wprpsp_pro_post'] : '';

			if( !empty($wprpsp_posts) ) {

				$post_menu_order = 0;

				// Loop od ids
				foreach ($wprpsp_posts as $wprpsp_post_key => $wprpsp_post) {
					
					// Update post order
					$update_post = array(
						'ID'           => $wprpsp_post,
						'menu_order'   => $post_menu_order,
					);

					// Update the post into the database
					wp_update_post( $update_post );

					$post_menu_order++;
				}

				$result['success'] 	= 1;
				$result['msg'] 		= __('Post order saved successfully.', 'wp-responsive-recent-post-slider');
			}
		}

		echo json_encode($result);
		exit;
	}

	/**
	 * Get post taxonomy
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.3.3
	 */
	function wprpsp_get_post_taxonomy()	{

		$reg_taxonomy 			= array();
   		$taxonomy_objects 		= '';
   		$terms_objects 			= '';
		$post_type 				= $_POST['post_type'];

		if( !empty($post_type) ) {

			$taxonomy_objects = get_object_taxonomies( $post_type, 'object' );

			if( !empty($taxonomy_objects) ) {

				// Getting only visible taxonomy
		        foreach($taxonomy_objects as $tax_object => $tax_data) {
		            if( 'post_format' != $tax_object && !empty($tax_data->public) ) {
		                $reg_taxonomy[]	= $tax_object;
		            }
		        }

				$taxonomy 			= current($reg_taxonomy);
				$terms_objects 		= get_terms(array('taxonomy' => $taxonomy));

				$response['terms'] 	= wprpsp_get_terms_options($terms_objects);
			}
		}

   		$response['taxonomy'] = wprpsp_get_taxonomy_options($taxonomy_objects);

   		echo json_encode($response);
		die();
	}

	/**
	 * Get taxonomy terms
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.3.3
	 */
	function wprpsp_get_taxonomy_terms() {

		$response = array();
		$taxonomy = !empty($_POST['taxonomy']) ? $_POST['taxonomy'] : '';

		if( !empty($taxonomy) ) {
			$terms_objects = get_terms(array('taxonomy' => $taxonomy));

			if( $terms_objects && !is_wp_error($terms_objects) ) {
				$response['terms'] = wprpsp_get_terms_options($terms_objects);
			}
   		}

   		echo json_encode($response);
		die();
	}

	/**
	 * Function to unique number value
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.0.0
	 */
	function wprpsp_plugin_row_meta( $links, $file ) {
		
		if ( $file == WPRPSP_PLUGIN_BASENAME ) {
			
			$row_meta = array(
				'docs'    => '<a href="' . esc_url('https://www.wponlinesupport.com/pro-plugin-document/document-wp-responsive-recent-post-slider-pro') . '" title="' . esc_attr( __( 'View Documentation', 'wp-responsive-recent-post-slider' ) ) . '" target="_blank">' . __( 'Docs', 'wp-responsive-recent-post-slider' ) . '</a>',
				'support' => '<a href="' . esc_url('https://www.wponlinesupport.com/welcome-wp-online-support-forum/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'wp-responsive-recent-post-slider' ) ) . '" target="_blank">' . __( 'Support', 'wp-responsive-recent-post-slider' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}
}

$wprpsp_admin = new Wprpsp_Admin();