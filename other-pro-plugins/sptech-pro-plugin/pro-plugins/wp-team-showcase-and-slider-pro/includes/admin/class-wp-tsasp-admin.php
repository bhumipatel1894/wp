<?php
/**
 * Admin Class
 *
 * Handles the admin side functionality of plugin
 *
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wp_Tsasp_Admin {
	
	function __construct() {
		
		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'wp_tsasp_metabox') );

		// Action to save metabox
		add_action( 'save_post', array($this,'wp_tsasp_save_metabox_value') );

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'wp_tsasp_register_menu'), 10 );

		// Action to register plugin settings
		add_action ( 'admin_init', array($this,'wp_tsasp_register_settings') );

		// Action to add category dropdown
		add_action( 'restrict_manage_posts', array($this, 'wp_tsasp_add_post_filters'), 100 );

		// Filter to add row data
		add_filter( 'post_row_actions', array($this, 'wp_tsasp_add_post_row_data'), 10, 2 );

		// Filter for team showcase post columns
		add_filter( 'manage_edit-'.WP_TSASP_POST_TYPE.'_columns', array($this, 'wp_tsasp_manage_post_columns') );
		add_action( 'manage_'.WP_TSASP_POST_TYPE.'_posts_custom_column',  array($this, 'wp_tsasp_post_columns_data'), 10, 2 );

		// Filter for team showcase category columns
		add_filter( 'manage_edit-'.WP_TSASP_CAT.'_columns', array($this, 'wp_tsasp_manage_category_columns') );
		add_filter( 'manage_'.WP_TSASP_CAT.'_custom_column', array($this, 'wp_tsasp_category_data'), 10, 3 );

		// Action to add sorting link at Team Showcase listing page
		add_filter( 'views_edit-'.WP_TSASP_POST_TYPE, array($this, 'wp_tsasp_sorting_link') );

		// Action to add `Save Order` button
		add_action( 'restrict_manage_posts', array($this, 'wp_tsasp_restrict_manage_posts') );

		// Ajax call to update option
		add_action( 'wp_ajax_wp_tsasp_update_post_order', array($this, 'wp_tsasp_update_post_order'));
		add_action( 'wp_ajax_nopriv_wp_tsasp_update_post_order',array( $this, 'wp_tsasp_update_post_order'));

		// Filter to add plugin links
		add_filter( 'plugin_row_meta', array( $this, 'wp_tsasp_plugin_row_meta' ), 10, 2 );		
	}

	/**
	 * Team details settings metabox
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wp_tsasp_metabox() {
		add_meta_box( 'wp-tsas-team-details', __( 'Team Member Details', 'wp-team-showcase-and-slider' ), array($this, 'wp_tsasp_render_team_details') , WP_TSASP_POST_TYPE, 'normal', 'high' );
	}

	/**
	 * Team details settings metabox HTML
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wp_tsasp_render_team_details() {
		include_once( WP_TSASP_DIR .'/includes/admin/metabox/wp-tsasp-team-details-metabox.php');
	}

	/**
	 * Function register setings
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wp_tsasp_register_settings() {
		register_setting( 'wp_tsasp_plugin_options', 'wp_tsasp_options', array($this, 'wp_tsasp_validate_options') );
	}

	/**
	 * Validate Settings Options
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wp_tsasp_validate_options( $input ) {
		
		$input['custom_css'] = isset($input['custom_css']) ? wp_tsasp_slashes_deep($input['custom_css'], true) : '';
		
		$input = apply_filters( 'wp_tsasp_validate_settings', $input );

		return $input;
	}

	/**
	 * Add category dropdown to team showcase listing page
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wp_tsasp_add_post_filters() {
		
		global $typenow;
		
		if( $typenow == WP_TSASP_POST_TYPE ) {
			
			$dropdown_options = apply_filters('wp_tsasp_cat_filter_args', array(
					'show_option_none'  => __('All Categories', 'wp-team-showcase-and-slider'),
					'option_none_value' => '',
					'hide_empty' 		=> 1,
					'hierarchical' 		=> 1,
					'show_count' 		=> 0,
					'orderby' 			=> 'name',
					'name'				=> WP_TSASP_CAT,
					'taxonomy'			=> WP_TSASP_CAT,
					'selected' 			=> isset($_GET[WP_TSASP_CAT]) ? $_GET[WP_TSASP_CAT] : '',
					'value_field'		=> 'slug',
					'show_option_none'	=> __('All Categories', 'wp-team-showcase-and-slider'),
				));
			wp_dropdown_categories( $dropdown_options );
		}
	}
	
	/**
	 * Function to save metabox values
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wp_tsasp_save_metabox_value( $post_id ) {

		global $post_type;
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( $post_type !=  WP_TSASP_POST_TYPE ) )              				// Check if current post type is supported.
		{
		  return $post_id;
		}

		$prefix = WP_TSASP_META_PREFIX; // Taking metabox prefix

		// Taking variables
		$member_department 	= isset($_POST['_member_department']) 	? wp_tsasp_slashes_deep($_POST['_member_department']) 	: '';
		$member_designation = isset($_POST['_member_designation']) 	? wp_tsasp_slashes_deep($_POST['_member_designation']) 	: '';
		$member_skills 		= isset($_POST['_skills']) 				? wp_tsasp_slashes_deep($_POST['_skills']) 				: '';
		$member_experience 	= isset($_POST['_member_experience']) 	? wp_tsasp_slashes_deep($_POST['_member_experience']) 	: '';
		$social 			= isset($_POST[$prefix.'social']) 		? wp_tsasp_slashes_deep($_POST[$prefix.'social']) 		: array();
		$tab 				= isset($_POST[$prefix.'tab']) 			? wp_tsasp_slashes_deep($_POST[$prefix.'tab']) 			: '';

		// Updating meta
		update_post_meta($post_id, '_member_department', $member_department);
		update_post_meta($post_id, '_member_designation', $member_designation);
		update_post_meta($post_id, '_skills', $member_skills);
		update_post_meta($post_id, '_member_experience', $member_experience);
		update_post_meta($post_id, $prefix.'social', $social);
		update_post_meta($post_id, $prefix.'tab', $tab);
	}

	/**
	 * Function to register admin menus
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wp_tsasp_register_menu() {
		add_submenu_page( 'edit.php?post_type='.WP_TSASP_POST_TYPE, __('Settings', 'wp-team-showcase-and-slider'), __('Settings', 'wp-team-showcase-and-slider'), 'manage_options', 'wp-tsasp-settings', array($this, 'wp_tsasp_settings_page') );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wp_tsasp_settings_page() {
		include_once( WP_TSASP_DIR . '/includes/admin/settings/wp-tsasp-settings.php' );
	}

	/**
	 * Function to add custom quick links at post listing page
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.2.1
	 */
	function wp_tsasp_add_post_row_data( $actions, $post ) {
		
		if( $post->post_type == WP_TSASP_POST_TYPE ) {
			return array_merge( array( 'wp_tsasp_id' => 'ID: ' . $post->ID ), $actions );
		}
		return $actions;
	}

	/**
	 * Add extra column to team showcase post list
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wp_tsasp_manage_post_columns( $columns ) {

		$new_columns['wp_tsasp_image'] 	= __( 'Image', 'wp-team-showcase-and-slider' );
		$new_columns['wp_tsasp_order'] 	= __('Order', 'wp-team-showcase-and-slider');
		
		$columns = wp_tsasp_add_array( $columns, $new_columns, 2 );

		return $columns;
	}

	/**
	 * Add data to extra column to team showcase post list
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wp_tsasp_post_columns_data( $column_name, $post_id ) {
		
		global $post;

		switch ($column_name) {
			case 'wp_tsasp_image':
				
				echo get_the_post_thumbnail( $post_id, array(50, 50) );
				break;

			case 'wp_tsasp_order':

	        	$post_menu_order    = isset($post->menu_order) ? $post->menu_order : '';
	        	
		        echo $post_menu_order;
		        echo "<input type='hidden' value='{$post_id}' name='wp_tsasp_post[]' class='wp-tsasp-order' id='wp-tsasp-order-{$post_id}' />";
		        break;
		}
	}

	/**
	 * Add extra column to team showcase category
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wp_tsasp_manage_category_columns( $columns ) {

	    $new_columns['wp_tsasp_shortcode'] = __( 'Team Showcase Category Shortcode', 'wp-team-showcase-and-slider' );

		$columns = wp_tsasp_add_array( $columns, $new_columns, 2 );

		return $columns;
	}

	/**
	 * Add data to extra column to Team Showcase category
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wp_tsasp_category_data($ouput, $column_name, $tax_id) {

	    if( $column_name == 'wp_tsasp_shortcode' ){
			$ouput .= '[wp-team category="' . $tax_id. '"]<br/>';
			$ouput .= '[wp-team-slider category="' . $tax_id. '"]';
	    }

	    return $ouput;
	}

	/**
	 * Add 'Sort Team Members' link at Team Showcase listing page
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wp_tsasp_sorting_link( $views ) {
	    
	    global $post_type, $wp_query;

	    $class            = ( isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) ? 'current' : '';
	    $query_string     = remove_query_arg(array( 'orderby', 'order' ));
	    $query_string     = add_query_arg( 'orderby', urlencode('menu_order title'), $query_string );
	    $query_string     = add_query_arg( 'order', urlencode('ASC'), $query_string );
	    $views['byorder'] = '<a href="' . esc_url( $query_string ) . '" class="' . esc_attr( $class ) . '">' . __( 'Sort Team Members', 'wp-team-showcase-and-slider' ) . '</a>';

	    return $views;
	}

	/**
	 * Add Save button to Team Showcase listing page
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wp_tsasp_restrict_manage_posts() {

		global $typenow, $wp_query;

		if( $typenow == WP_TSASP_POST_TYPE && isset($wp_query->query['orderby']) && $wp_query->query['orderby'] == 'menu_order title' ) {

			$html  = '';
			$html .= "<span class='spinner wp-tsasp-spinner'></span>";
			$html .= "<input type='button' name='wp_tsasp_save_order' class='button button-secondary right wp-tsasp-save-order' id='wp-tsasp-save-order' value='".__('Save Sort Order', 'wp-team-showcase-and-slider')."' />";
			echo $html;
		}
	}

	/**
	 * Update Team Member order
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wp_tsasp_update_post_order() {

		// Taking some defaults
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'wp-team-showcase-and-slider');

		if( !empty($_POST['form_data']) ) {

			$form_data 		= parse_str($_POST['form_data'], $output_arr);
			$wp_tsasp_posts = !empty($output_arr['wp_tsasp_post']) ? $output_arr['wp_tsasp_post'] : '';

			if( !empty($wp_tsasp_posts) ) {

				$post_menu_order = 0;

				// Loop od ids
				foreach ($wp_tsasp_posts as $wp_tsasp_post_key => $wp_tsasp_post) {
					
					// Update post order
					$update_post = array(
						'ID'           => $wp_tsasp_post,
						'menu_order'   => $post_menu_order,
					);

					// Update the post into the database
					wp_update_post( $update_post );

					$post_menu_order++;
				}

				$result['success'] 	= 1;
				$result['msg'] 		= __('Team Member order saved successfully.', 'wp-team-showcase-and-slider');
			}
		}

		echo json_encode($result);
		exit;
	}

	/**
	 * Function to add extra link to plugins action link
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wp_tsasp_plugin_row_meta( $links, $file ) {
		
		if ( $file == WP_TSASP_PLUGIN_BASENAME ) {
			
			$row_meta = array(
				'docs'    => '<a href="' . esc_url('https://www.wponlinesupport.com/pro-plugin-document/document-wp-team-showcase-and-slider-pro') . '" title="' . esc_attr( __( 'View Documentation', 'wp-team-showcase-and-slider' ) ) . '" target="_blank">' . __( 'Docs', 'wp-team-showcase-and-slider' ) . '</a>',
				'support' => '<a href="' . esc_url('https://www.wponlinesupport.com/welcome-wp-online-support-forum/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'wp-team-showcase-and-slider' ) ) . '" target="_blank">' . __( 'Support', 'wp-team-showcase-and-slider' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}
}

$wp_tsasp_admin = new Wp_Tsasp_Admin();