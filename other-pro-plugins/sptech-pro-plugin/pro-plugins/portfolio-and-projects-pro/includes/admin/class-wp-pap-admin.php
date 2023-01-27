<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Portfolio and Projects Pro
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wp_Pap_Pro_Admin {

	function __construct() {
		
		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'wp_pap_pro_post_sett_metabox') );

		// Action to save metabox
		add_action( 'save_post', array($this, 'wp_pap_pro_save_metabox_value') );

		// Action to add custom column to Gallery listing
		add_filter( 'manage_'.WP_PAP_PRO_POST_TYPE.'_posts_columns', array($this, 'wp_pap_pro_posts_columns') );

		// Action to add custom column data to Gallery listing
		add_action('manage_'.WP_PAP_PRO_POST_TYPE.'_posts_custom_column', array($this, 'wp_pap_pro_post_columns_data'), 10, 2);

		// Action to add Attachment Popup HTML
		add_action( 'admin_footer', array($this,'wp_pap_pro_image_update_popup_html') );

		// Ajax call to update option
		add_action( 'wp_ajax_wp_pap_pro_get_attachment_edit_form', array($this, 'wp_pap_pro_get_attachment_edit_form'));
		add_action( 'wp_ajax_nopriv_wp_pap_pro_get_attachment_edit_form',array( $this, 'wp_pap_pro_get_attachment_edit_form'));

		// Ajax call to update attachment data
		add_action( 'wp_ajax_wp_pap_pro_save_attachment_data', array($this, 'wp_pap_pro_save_attachment_data'));
		add_action( 'wp_ajax_nopriv_wp_pap_pro_save_attachment_data',array( $this, 'wp_pap_pro_save_attachment_data'));

		// Filter to add extra column in portfolio `category` table
		add_filter( 'manage_edit-'.WP_PAP_PRO_CAT.'_columns', array($this, 'wp_pap_pro_manage_category_columns') );
		add_filter( 'manage_'.WP_PAP_PRO_CAT.'_custom_column', array($this, 'wp_pap_pro_category_data'), 10, 3 );

		// Action to add sorting link at Slider listing page
		add_filter( 'views_edit-'.WP_PAP_PRO_POST_TYPE, array($this, 'wp_pap_pro_sorting_link') );

		// Filter to add row data
		add_filter( 'post_row_actions', array($this, 'wp_pap_pro_add_post_row_data'), 10, 2 );

		// Action to add `Save Order` button
		add_action( 'restrict_manage_posts', array($this, 'wp_pap_pro_restrict_manage_posts') );

		// Ajax call to update option
		add_action( 'wp_ajax_wp_pap_pro_update_post_order', array($this, 'wp_pap_pro_update_post_order'));
		add_action( 'wp_ajax_nopriv_wp_pap_pro_update_post_order',array( $this, 'wp_pap_pro_update_post_order'));

		// Action to add category filter dropdown
		add_action( 'restrict_manage_posts', array($this, 'wp_pap_pro_add_post_filters'), 50 );

		// Filter to add plugin links
		add_filter( 'plugin_row_meta', array( $this, 'wp_pap_pro_plugin_row_meta' ), 10, 2 );
	}

	/**
	 * Post Settings Metabox
	 * 
	 * @package Portfolio and Projects Pro
	 * @since 1.0
	 */
	function wp_pap_pro_post_sett_metabox() {
		add_meta_box( 'wp-pap-post-sett', __('Portfolio and Projects Pro - Settings', 'portfolio-and-projects'), array($this, 'wp_pap_post_sett_mb_content'), array(WP_PAP_PRO_POST_TYPE), 'normal', 'high' );
	}

	/**
	 * Post Settings Metabox HTML
	 * 
	 * @package Portfolio and Projects Pro
	 * @since 1.0
	 */
	function wp_pap_post_sett_mb_content() {
		include_once( WP_PAP_PRO_DIR .'/includes/admin/metabox/wp-pap-sett-metabox.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @package Portfolio and Projects Pro
	 * @since 1.0
	 */
	function wp_pap_pro_save_metabox_value( $post_id ) {

		global $post_type;

		$registered_posts = array(WP_PAP_PRO_POST_TYPE); // Getting registered post types

		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( !current_user_can('edit_post', $post_id) )              			// Check if user can edit the post.
		|| ( !in_array($post_type, $registered_posts) ) )             			// Check if user can edit the post.
		{
		  return $post_id;
		}

		$prefix = WP_PAP_PRO_META_PREFIX; // Taking metabox prefix

		// Taking variables
		$gallery_imgs 	= isset($_POST['wp_pap_img']) 						  ? wp_pap_pro_slashes_deep($_POST['wp_pap_img']) : '';

		// Getting Slider Variables
		$arrow_slider 		  = isset($_POST[$prefix.'arrow_slider']) 		  	? 1 	: 0;
		$pagination_slider 	  = isset($_POST[$prefix.'pagination_slider']) 	 	? 1 	: 0;
		$autoplay_slider 	  = isset($_POST[$prefix.'autoplay_slider']) 	  	? 1 	: 0;
		$loop_slider 		  = isset($_POST[$prefix.'loop_slider']) 		  	? 1 	: 0;
		$animation_slider 	  = isset($_POST[$prefix.'animation_slider']) 	  	? wp_pap_pro_slashes_deep($_POST[$prefix.'animation_slider']) 		: '';
		$slide_to_show_slider = !empty($_POST[$prefix.'slide_to_show_slider'])	? wp_pap_pro_slashes_deep($_POST[$prefix.'slide_to_show_slider']) 	: 1;
		$autoplayspeed_slider = !empty($_POST[$prefix.'autoplayspeed_slider']) 	? wp_pap_pro_slashes_deep($_POST[$prefix.'autoplayspeed_slider']) 	: 3000;
		$speed_slider 		  = isset($_POST[$prefix.'speed_slider']) 		  	? wp_pap_pro_slashes_deep($_POST[$prefix.'speed_slider']) 			: '';
		$project_link 		  = isset($_POST[$prefix.'project_url']) 		  	? wp_pap_pro_slashes_deep($_POST[$prefix.'project_url']) 			: '';

		update_post_meta($post_id, $prefix.'gallery_id', $gallery_imgs);
		update_post_meta($post_id, $prefix.'project_url', $project_link);

		// Updating Slider settings
 		update_post_meta($post_id, $prefix.'arrow_slider', $arrow_slider);
 		update_post_meta($post_id, $prefix.'pagination_slider', $pagination_slider);
 		update_post_meta($post_id, $prefix.'animation_slider', $animation_slider);
 		update_post_meta($post_id, $prefix.'slide_to_show_slider', $slide_to_show_slider);
 		update_post_meta($post_id, $prefix.'loop_slider', $loop_slider);
 		update_post_meta($post_id, $prefix.'autoplay_slider', $autoplay_slider);
 		update_post_meta($post_id, $prefix.'autoplayspeed_slider', $autoplayspeed_slider);
 		update_post_meta($post_id, $prefix.'speed_slider', $speed_slider);
	}

	/**
	 * Add custom column to Post listing page
	 * 
	 * @package Portfolio and Projects Pro
	 * @since 1.0
	 */
	function wp_pap_pro_posts_columns( $columns ) {

	    $new_columns['wp_pap_photos'] 		= __('Number of Photos', 'portfolio-and-projects');
	    $new_columns['wp_pap_pro_order'] 	= __('Order', 'portfolio-and-projects');

	    $columns = wp_pap_pro_add_array( $columns, $new_columns, 1, true );

	    return $columns;
	}

	/**
	 * Add custom column data to Post listing page
	 * 
	 * @package Portfolio and Projects Pro
	 * @since 1.0
	 */
	function wp_pap_pro_post_columns_data( $column, $post_id ) {

		global $post, $wp_query;

		// Taking some variables
		$prefix = WP_PAP_PRO_META_PREFIX;

	    switch ($column) {
	    	case 'wp_pap_photos':
	    		$total_photos = get_post_meta($post_id, $prefix.'gallery_id', true);
	    		echo !empty($total_photos) ? count($total_photos) : '--';
	    		break;

	    	case 'wp_pap_pro_order':
		        $post_menu_order = isset($post->menu_order) ? $post->menu_order : '';

		        echo $post_menu_order;
		        if( isset($wp_query->query['orderby']) && $wp_query->query['orderby'] == 'menu_order title' ) {
		        	echo "<input type='hidden' value='{$post_id}' name='wp_pap_pro_post[]' class='wp-pap-post-order' id='wp-pap-post-order-{$post_id}' />";
		    	}
		        break;
		}
	}

	/**
	 * Image data popup HTML
	 * 
	 * @package Portfolio and Projects Pro
	 * @since 1.0
	 */
	function wp_pap_pro_image_update_popup_html() {

		global $post_type;

		$registered_posts = array(WP_PAP_PRO_POST_TYPE); // Getting registered post types

		if( in_array($post_type, $registered_posts) ) {
			include_once( WP_PAP_PRO_DIR .'/includes/admin/settings/wp-pap-img-popup.php');
		}
	}

	/**
	 * Get attachment edit form
	 * 
	 * @package Portfolio and Projects Pro
	 * @since 1.0
	 */
	function wp_pap_pro_get_attachment_edit_form() {

		// Taking some defaults
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'portfolio-and-projects');
		$attachment_id 		= !empty($_POST['attachment_id']) ? trim($_POST['attachment_id']) : '';

		if( !empty($attachment_id) ) {
			$attachment_post = get_post( $_POST['attachment_id'] );

			if( !empty($attachment_post) ) {
				
				ob_start();

				// Popup Data File
				include( WP_PAP_PRO_DIR . '/includes/admin/settings/wp-pap-img-popup-data.php' );

				$attachment_data = ob_get_clean();

				$result['success'] 	= 1;
				$result['msg'] 		= __('Attachment Found.', 'portfolio-and-projects');
				$result['data']		= $attachment_data;
			}
		}

		echo json_encode($result);
		exit;
	}

	/**
	 * Get attachment edit form
	 * 
	 * @package Portfolio and Projects Pro
	 * @since 1.0
	 */
	function wp_pap_pro_save_attachment_data() {

		$prefix 			= WP_PAP_PRO_META_PREFIX;
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'portfolio-and-projects');
		$attachment_id 		= !empty($_POST['attachment_id']) ? trim($_POST['attachment_id']) : '';
		$form_data 			= parse_str($_POST['form_data'], $form_data_arr);

		if( !empty($attachment_id) && !empty($form_data_arr) ) {

			// Getting attachment post
			$wp_pap_attachment_post = get_post( $attachment_id );

			// If post type is attachment
			if( isset($wp_pap_attachment_post->post_type) && $wp_pap_attachment_post->post_type == 'attachment' ) {
				$post_args = array(
									'ID'			=> $attachment_id,
									'post_title'	=> !empty($form_data_arr['wp_pap_attachment_title']) ? $form_data_arr['wp_pap_attachment_title'] : $wp_pap_attachment_post->post_name,
								);
				$update = wp_update_post( $post_args, $wp_error );

				if( !is_wp_error( $update ) ) {

					update_post_meta( $attachment_id, '_wp_attachment_image_alt', wp_pap_pro_slashes_deep($form_data_arr['wp_pap_attachment_alt']) );

					$result['success'] 	= 1;
					$result['msg'] 		= __('Your changes saved successfully.', 'portfolio-and-projects');
				}
			}
		}
		echo json_encode($result);
		exit;
	}

	/**
	 * Add extra column to news category
	 * 
	 * @package Portfolio and Projects Pro
	 * @since 1.0
	 */
	function wp_pap_pro_manage_category_columns($columns) {

		$new_columns['wp_pap_pro_shortcode'] = __( 'Category Shortcode', 'portfolio-and-projects' );

		$columns = wp_pap_pro_add_array( $columns, $new_columns, 2 );

		return $columns;
	}

	/**
	 * Add data to extra column to news category
	 * 
	 * @package Portfolio and Projects Pro
	 * @since 1.0
	 */
	function wp_pap_pro_category_data($ouput, $column_name, $tax_id) {
		
		if( $column_name == 'wp_pap_pro_shortcode' ) {
			$ouput .= '[pap_portfolio category="' . $tax_id. '"]<br/>';
	    }

	    return $ouput;
	}

	/**
	 * Add 'Sort Slides' link at Slider listing page
	 * 
	 * @package Portfolio and Projects Pro
	 * @since 1.0
	 */
	function wp_pap_pro_sorting_link( $views ) {

	    global $post_type, $wp_query;

	    $class            = ( isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) ? 'current' : '';
	    $query_string     = remove_query_arg(array( 'orderby', 'order' ));
	    $query_string     = add_query_arg( 'orderby', urlencode('menu_order title'), $query_string );
	    $query_string     = add_query_arg( 'order', urlencode('ASC'), $query_string );
	    $views['byorder'] = '<a href="' . esc_url( $query_string ) . '" class="' . esc_attr( $class ) . '">' . __( 'Sort Portfolio', 'portfolio-and-projects' ) . '</a>';

	    return $views;
	}

	/**
	 * Function to add custom quick links at post listing page
	 * 
	 * @package Portfolio and Projects Pro
	 * @since 1.0
	 */
	function wp_pap_pro_add_post_row_data( $actions, $post ) {
		
		if( $post->post_type == WP_PAP_PRO_POST_TYPE ) {
			return array_merge( array( 'wp_pap_pro_id' => 'ID: ' . $post->ID ), $actions );
		}
		return $actions;
	}

	/**
	 * Add Save button to Slider listing page
	 * 
	 * @package Portfolio and Projects Pro
	 * @since 1.0
	 */
	function wp_pap_pro_restrict_manage_posts() {

		global $typenow, $wp_query;

		if( $typenow == WP_PAP_PRO_POST_TYPE && isset($wp_query->query['orderby']) && $wp_query->query['orderby'] == 'menu_order title' ) {

			$html  = '';
			$html .= "<span class='spinner wp-pap-spinner'></span>";
			$html .= "<input type='button' name='wp_pap_pro_save_order' class='button button-secondary right wp-pap-save-order' id='wp-pap-save-order' value='".__('Save Sort Order', 'portfolio-and-projects')."' />";
			echo $html;
		}
	}

	/**
	 * Update Slider order
	 * 
	 * @package Portfolio and Projects Pro
	 * @since 1.0
	 */
	function wp_pap_pro_update_post_order() {

		// Taking some defaults
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'portfolio-and-projects');

		if( !empty($_POST['form_data']) ) {
			
			$form_data 			= parse_str($_POST['form_data'], $output_arr);
			$wp_pap_pro_posts 	= !empty($output_arr['wp_pap_pro_post']) ? $output_arr['wp_pap_pro_post'] : '';
			
			if( !empty($wp_pap_pro_posts) ) {

				$post_menu_order = 0;

				// Loop od ids
				foreach ($wp_pap_pro_posts as $wp_pap_pro_post_key => $wp_pap_pro_post) {
					
					// Update post order
					$update_post = array(
						'ID'           => $wp_pap_pro_post,
						'menu_order'   => $post_menu_order,
					);

					// Update the post into the database
					wp_update_post( $update_post );

					$post_menu_order++;
				}

				$result['success'] 	= 1;
				$result['msg'] 		= __('Portfolio order saved successfully.', 'portfolio-and-projects');
			}
		}

		echo json_encode($result);
		exit;
	}

	/**
	 * Add category dropdown to Slider listing page
	 * 
	 * @package Portfolio and Projects Pro
	 * @since 1.0
	 */
	function wp_pap_pro_add_post_filters() {
		
		global $typenow;
		
		if( $typenow == WP_PAP_PRO_POST_TYPE ) {

			$wp_pap_pro_cat = isset($_GET[WP_PAP_PRO_CAT]) ? $_GET[WP_PAP_PRO_CAT] : '';

			$dropdown_options = apply_filters('wp_pap_pro_cat_filter_args', array(
					'show_option_none'  => __('All Categories', 'portfolio-and-projects'),
					'option_none_value' => '',
					'hide_empty' 		=> 1,
					'hierarchical' 		=> 1,
					'show_count' 		=> 0,
					'orderby' 			=> 'name',
					'name'				=> WP_PAP_PRO_CAT,
					'taxonomy'			=> WP_PAP_PRO_CAT,
					'selected' 			=> $wp_pap_pro_cat,
					'value_field'		=> 'slug',
				));
			wp_dropdown_categories( $dropdown_options );
		}
	}

	/**
	 * Function to unique number value
	 * 
	 * @package Portfolio and Projects Pro
	 * @since 1.0
	 */
	function wp_pap_pro_plugin_row_meta( $links, $file ) {
		
		if ( $file == WP_PAP_PRO_PLUGIN_BASENAME ) {
			
			$row_meta = array(
				'docs'    => '<a href="' . esc_url('https://www.wponlinesupport.com/pro-plugin-document/document-portfolios-projects-pro/') . '" title="' . esc_attr( __( 'View Documentation', 'portfolio-and-projects' ) ) . '" target="_blank">' . __( 'Docs', 'portfolio-and-projects' ) . '</a>',
				'support' => '<a href="' . esc_url('http://forum.wponlinesupport.com') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'portfolio-and-projects' ) ) . '" target="_blank">' . __( 'Support', 'portfolio-and-projects' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}
}

$wp_pap_pro_admin = new Wp_Pap_Pro_Admin();