<?php
/**
 * Visual Composer Class
 *
 * Handles the visual composer shortcode functionality of plugin
 *
 * @package Video gallery and Player Pro
 * @since 1.1.8
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpvgp_Vc {
	
	function __construct() {

		// Action to add 'video_gallery' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wp_vgp_integrate_video_grid_vc') );

		// Action to add 'video_gallery_slider' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wp_vgp_integrate_video_slider_vc') );		
	}

	/**
	 * Function to add 'video_gallery' shortcode in vc
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_integrate_video_grid_vc() {
		vc_map( array(
			'name' 			=> __( 'WPOS - Video Grid', 'html5-videogallery-plus-player' ),
			'base' 			=> 'video_gallery',
			'icon' 			=> 'icon-wpb-wp',
			'class' 		=> '',
			'category' 		=> __( 'Content', 'html5-videogallery-plus-player'),
			'description' 	=> __( 'Display Video in Grid view.', 'html5-videogallery-plus-player' ),
			'params' 		=> array(
								// General settings
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Design', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'design',
									'value' 		=> array(
															__( 'Video Grid Design 1', 'html5-videogallery-plus-player' ) => 'design-1',
															__( 'Video Grid Design 2', 'html5-videogallery-plus-player' ) => 'design-2',
															__( 'Video Grid Design 3', 'html5-videogallery-plus-player' ) => 'design-3',
															__( 'Video Grid Design 4', 'html5-videogallery-plus-player' ) => 'design-4',
															__( 'Video Grid Design 5', 'html5-videogallery-plus-player' ) => 'design-5',
															__( 'Video Grid Design 6', 'html5-videogallery-plus-player' ) => 'design-6',
															__( 'Video Grid Design 7', 'html5-videogallery-plus-player' ) => 'design-7',
															__( 'Video Grid Design 8', 'html5-videogallery-plus-player' ) => 'design-8',
															__( 'Video Grid Design 9', 'html5-videogallery-plus-player' ) => 'design-9',
															__( 'Video Grid Design 10', 'html5-videogallery-plus-player' ) => 'design-10',
															__( 'Video Grid Design 11', 'html5-videogallery-plus-player' ) => 'design-11',
															__( 'Video Grid Design 12', 'html5-videogallery-plus-player' ) => 'design-12',
															__( 'Video Grid Design 13', 'html5-videogallery-plus-player' ) => 'design-13',
															__( 'Video Grid Design 14', 'html5-videogallery-plus-player' ) => 'design-14',
															__( 'Video Grid Design 15', 'html5-videogallery-plus-player' ) => 'design-15',
															__( 'Video Grid Design 16', 'html5-videogallery-plus-player' ) => 'design-16',
															__( 'Video Grid Design 17', 'html5-videogallery-plus-player' ) => 'design-17',
															__( 'Video Grid Design 18', 'html5-videogallery-plus-player' ) => 'design-18',
															__( 'Video Grid Design 19', 'html5-videogallery-plus-player' ) => 'design-19',
														),
									'description' 	=> __( 'Select Video Grid design.', 'html5-videogallery-plus-player' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Title', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'show_title',
									'value' 		=> array(
															__( 'True', 'html5-videogallery-plus-player' ) 	=> 'true',
															__( 'False', 'html5-videogallery-plus-player' ) => 'false',
														),
									'description' 	=> __( 'Display Video Title.', 'html5-videogallery-plus-player' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Content', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'show_content',
									'value' 		=> array(
															__( 'True', 'html5-videogallery-plus-player' ) 	=> 'true',
															__( 'False', 'html5-videogallery-plus-player' ) => 'false',
														),
									'description' 	=> __( 'Display Video Content.', 'html5-videogallery-plus-player' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Number of Columns', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'grid',
									'value' 		=> array(
															__( 'Grid 1', 'html5-videogallery-plus-player' ) => '1',
															__( 'Grid 2', 'html5-videogallery-plus-player' ) => '2',
															__( 'Grid 3', 'html5-videogallery-plus-player' ) => '3',
															__( 'Grid 4', 'html5-videogallery-plus-player' ) => '4',
														),
									'std' 			=> '3',
									'description' 	=> __( 'Select number of column for grid view.', 'html5-videogallery-plus-player' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Popup Fix', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'popup_fix',
									'value' 		=> array(
														__( 'True', 'html5-videogallery-plus-player' ) 	=> 'true',
														__( 'False', 'html5-videogallery-plus-player' ) => 'false',
													),
									'description' 	=> __( 'Set popup fix or scroll with the screen.', 'html5-videogallery-plus-player' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Gallery Enable', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'gallery_enable',
									'value' 		=> array(
														__( 'True', 'html5-videogallery-plus-player' ) 	=> 'true',
														__( 'False', 'html5-videogallery-plus-player' ) => 'false',
													),
									'description' 	=> __( 'Enable navigation arrows on video popup as gallery view.', 'html5-videogallery-plus-player' ),
								),

								// Data Settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Total Items', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'limit',
									'value' 		=> 20,
									'description' 	=> __( 'Enter number of Videos to be displayed. Enter -1 to display all.', 'html5-videogallery-plus-player' ),
									'group' 		=> __( 'Data Settings', 'html5-videogallery-plus-player' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Pagination', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'pagination',
									'value' 		=> array(
															__( 'False', 'html5-videogallery-plus-player' ) => 'false',
															__( 'True', 'html5-videogallery-plus-player' ) 	=> 'true',
														),
									'description' 	=> __( 'Display Pagination for News Post', 'html5-videogallery-plus-player' ),
									'dependency' 	=> array(
															'element' 				=> 'limit',
															'value_not_equal_to' 	=> array( '-1' ),
														),
									'group' 		=> __( 'Data Settings', 'html5-videogallery-plus-player' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Pagination Type', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'pagination_type',
									'value' 		=> array(
															__( 'Numeric Pagination', 'html5-videogallery-plus-player' ) 			=> 'numeric',
															__( 'Previous - Next Pagination', 'html5-videogallery-plus-player' ) 	=> 'prev-next',
														),
									'description' 	=> __( 'Display Pagination for News Post', 'html5-videogallery-plus-player' ),
									'dependency' 	=> array(
															'element' 	=> 'pagination',
															'value' 	=> array( 'true' ),
														),
									'group' 		=> __( 'Data Settings', 'html5-videogallery-plus-player' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Sort Order', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'order',
									'value' 		=> array(
															__( 'Descending', 'html5-videogallery-plus-player' ) 	=> 'desc',
															__( 'Ascending', 'html5-videogallery-plus-player' ) 	=> 'asc',
														),
									'description' 	=> __( 'Set the video order.', 'html5-videogallery-plus-player' ),
									'group' 		=> __( 'Data Settings', 'html5-videogallery-plus-player' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Order By', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'orderby',
									'value' 		=> array(
															__( 'Video Date', 'html5-videogallery-plus-player' ) 			=> 'date',
															__( 'Video ID', 'html5-videogallery-plus-player' ) 				=> 'ID',
															__( 'Video Title', 'html5-videogallery-plus-player' ) 			=> 'title',
															__( 'Video Modified Date', 'html5-videogallery-plus-player' ) 	=> 'modified',
															__( 'Random', 'html5-videogallery-plus-player' ) 				=> 'rand',
															__( 'Menu Order', 'html5-videogallery-plus-player' ) 			=> 'menu_order',
														),
									'description' 	=> __( 'Set the video sort by.', 'html5-videogallery-plus-player' ),
									'group' 		=> __( 'Data Settings', 'html5-videogallery-plus-player' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Display Specific Video', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'post',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Display only specific video posts. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple post id by comma separated.', 'html5-videogallery-plus-player' ), add_query_arg( array('post_type' => WP_VGP_POST_TYPE ), 'edit.php')),
									'group' 		=> __( 'Data Settings', 'html5-videogallery-plus-player' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Specific Video', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'exclude_post',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Exclude specific video posts. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple post id by comma separated.', 'html5-videogallery-plus-player' ), add_query_arg(array('post_type' => WP_VGP_POST_TYPE), 'edit.php')),
									'group' 		=> __( 'Data Settings', 'html5-videogallery-plus-player' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Category', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'category',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Enter Video category id to display Videos category wise. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can enter multiple ids with comma seperated.', 'html5-videogallery-plus-player' ), add_query_arg(array('taxonomy' => WP_VGP_CAT, 'post_type' => WP_VGP_POST_TYPE), 'edit-tags.php')),
									'group' 		=> __( 'Data Settings', 'html5-videogallery-plus-player' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Specific Category Video', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'exclude_cat',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Exclude post category. Works only if `Category` field is empty. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can enter multiple ids with comma seperated.', 'html5-videogallery-plus-player' ), add_query_arg(array('taxonomy' => WP_VGP_CAT, 'post_type' => WP_VGP_POST_TYPE), 'edit-tags.php')),
									'group' 		=> __( 'Data Settings', 'html5-videogallery-plus-player' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Include Category Children', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'include_cat_child',
									'value' 		=> array(
														__( 'True', 'html5-videogallery-plus-player' ) 	=> 'true',
														__( 'False', 'html5-videogallery-plus-player' ) => 'false',
													),
									'description' 	=> __( 'Include category children or not. When you choose parent category then display child category post or not.', 'html5-videogallery-plus-player' ),
									'group' 		=> __( 'Data Settings', 'html5-videogallery-plus-player' )
								),
							)
		));
	}

	/**
	 * Function to add 'video_gallery_slider' shortcode in vc
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_integrate_video_slider_vc() {
		vc_map( array(
			'name' 			=> __( 'WPOS - Video Slider', 'html5-videogallery-plus-player' ),
			'base' 			=> 'video_gallery_slider',
			'icon' 			=> 'icon-wpb-wp',
			'class' 		=> '',
			'category' 		=> __( 'Content', 'html5-videogallery-plus-player'),
			'description' 	=> __( 'Display Video in Slider view.', 'html5-videogallery-plus-player' ),
			'params' 	=> array(
								// General settings
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Design', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'design',
									'value' 		=> array(
															__( 'Video Slider Design 1', 'html5-videogallery-plus-player' ) 	=> 'design-1',
															__( 'Video Slider Design 2', 'html5-videogallery-plus-player' ) 	=> 'design-2',
															__( 'Video Slider Design 3', 'html5-videogallery-plus-player' ) 	=> 'design-3',
															__( 'Video Slider Design 4', 'html5-videogallery-plus-player' ) 	=> 'design-4',
															__( 'Video Slider Design 5', 'html5-videogallery-plus-player' ) 	=> 'design-5',
															__( 'Video Slider Design 6', 'html5-videogallery-plus-player' ) 	=> 'design-6',
															__( 'Video Slider Design 7', 'html5-videogallery-plus-player' ) 	=> 'design-7',
															__( 'Video Slider Design 8', 'html5-videogallery-plus-player' ) 	=> 'design-8',
															__( 'Video Slider Design 9', 'html5-videogallery-plus-player' ) 	=> 'design-9',
															__( 'Video Slider Design 10', 'html5-videogallery-plus-player' ) 	=> 'design-10',
															__( 'Video Slider Design 11', 'html5-videogallery-plus-player' ) 	=> 'design-11',
															__( 'Video Slider Design 12', 'html5-videogallery-plus-player' ) 	=> 'design-12',
															__( 'Video Slider Design 13', 'html5-videogallery-plus-player' ) 	=> 'design-13',
															__( 'Video Slider Design 14', 'html5-videogallery-plus-player' ) 	=> 'design-14',
															__( 'Video Slider Design 15', 'html5-videogallery-plus-player' ) 	=> 'design-15',
															__( 'Video Slider Design 16', 'html5-videogallery-plus-player' ) 	=> 'design-16',
															__( 'Video Slider Design 17', 'html5-videogallery-plus-player' ) 	=> 'design-17',
															__( 'Video Slider Design 18', 'html5-videogallery-plus-player' ) 	=> 'design-18',
															__( 'Video Slider Design 19', 'html5-videogallery-plus-player' ) 	=> 'design-19',
														),
									'description' 	=> __( 'Choose Video slider design.', 'html5-videogallery-plus-player' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Title', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'show_title',
									'value' 		=> array(
															__( 'True', 'html5-videogallery-plus-player' ) 	=> 'true',
															__( 'False', 'html5-videogallery-plus-player' ) 	=> 'false',
														),
									'description' 	=> __( 'Display video title.', 'html5-videogallery-plus-player' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Content', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'show_content',
									'value' 		=> array(
															__( 'False', 'html5-videogallery-plus-player' ) => 'false',	
															__( 'True', 'html5-videogallery-plus-player' ) 	=> 'true',
														),
									'description' 	=> __( 'Display video content.', 'html5-videogallery-plus-player' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Popup Fix', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'popup_fix',
									'value' 		=> array(
														__( 'True', 'html5-videogallery-plus-player' ) 	=> 'true',
														__( 'False', 'html5-videogallery-plus-player' ) => 'false',
													),
									'description' 	=> __( 'Set popup fix or scroll with the screen.', 'html5-videogallery-plus-player' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Gallery Enable', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'gallery_enable',
									'value' 		=> array(
														__( 'True', 'html5-videogallery-plus-player' ) 	=> 'true',
														__( 'False', 'html5-videogallery-plus-player' ) => 'false',
													),
									'description' 	=> __( 'Enable navigation arrows on video popup as gallery view.', 'html5-videogallery-plus-player' ),
								),

								// Data Settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Total Items', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'limit',
									'value' 		=> 20,
									'description' 	=> __( 'Enter number of Videos to be displayed. Enter -1 to display all.', 'html5-videogallery-plus-player' ),
									'group' 		=> __( 'Data Settings', 'html5-videogallery-plus-player' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Sort order', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'order',
									'value' 		=> array(
														__( 'Descending', 'html5-videogallery-plus-player' ) 	=> 'desc',
														__( 'Ascending', 'html5-videogallery-plus-player' ) 	=> 'asc',
													),
									'description' 	=> __( 'Set the video order.', 'html5-videogallery-plus-player' ),
									'group' 		=> __( 'Data Settings', 'html5-videogallery-plus-player' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Order By', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'orderby',
									'value' 		=> array(
														__( 'Video Date', 'html5-videogallery-plus-player' ) 			=> 'date',
														__( 'Video ID', 'html5-videogallery-plus-player' ) 				=> 'id',
														__( 'Video Title', 'html5-videogallery-plus-player' ) 			=> 'title',
														__( 'Video Modified Date', 'html5-videogallery-plus-player' ) 	=> 'modified',
														__( 'Random', 'html5-videogallery-plus-player' ) 				=> 'rand',
														__( 'Menu Order', 'html5-videogallery-plus-player' ) 			=> 'menu_order',
													),
									'description' 	=> __( 'Set the video sort by.', 'html5-videogallery-plus-player' ),
									'group' 		=> __( 'Data Settings', 'html5-videogallery-plus-player' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Display Specific Video', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'post',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Display only specific video posts. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple post id by comma separated.', 'html5-videogallery-plus-player' ), add_query_arg( array('post_type' => WP_VGP_POST_TYPE ), 'edit.php')),
									'group' 		=> __( 'Data Settings', 'html5-videogallery-plus-player' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Specific Video', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'exclude_post',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Exclude specific video posts. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple post id by comma separated.', 'html5-videogallery-plus-player' ), add_query_arg(array('post_type' => WP_VGP_POST_TYPE), 'edit.php')),
									'group' 		=> __( 'Data Settings', 'html5-videogallery-plus-player' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Category', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'category',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Enter Video category id to display Videos category wise. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can enter multiple ids with comma seperated.', 'html5-videogallery-plus-player' ), add_query_arg(array('taxonomy' => WP_VGP_CAT, 'post_type' => WP_VGP_POST_TYPE), 'edit-tags.php')),
									'group' 		=> __( 'Data Settings', 'html5-videogallery-plus-player' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Specific Category Video', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'exclude_cat',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Exclude post category. Works only if `Category` field is empty. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can enter multiple ids with comma seperated.', 'html5-videogallery-plus-player' ), add_query_arg(array('taxonomy' => WP_VGP_CAT, 'post_type' => WP_VGP_POST_TYPE), 'edit-tags.php')),
									'group' 		=> __( 'Data Settings', 'html5-videogallery-plus-player' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Include Category Children', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'include_cat_child',
									'value' 		=> array(
														__( 'True', 'html5-videogallery-plus-player' ) 	=> 'true',
														__( 'False', 'html5-videogallery-plus-player' ) => 'false',
													),
									'description' 	=> __( 'Include category children or not. When you choose parent category then display child category post or not.', 'html5-videogallery-plus-player' ),
									'group' 		=> __( 'Data Settings', 'html5-videogallery-plus-player' )
								),


								// Slider Settings								 
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Slider Slides Column', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'slide_to_show',
									'value' 		=> '3',
									'description' 	=> __( 'Enter number of column for slider.', 'html5-videogallery-plus-player' ),
									'group' 		=> __( 'Slider Settings', 'html5-videogallery-plus-player' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Slides Scroll', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'slide_to_scroll',
									'value' 		=> '1',
									'description' 	=> __( 'Enter number of slides to scroll at a time.', 'html5-videogallery-plus-player' ),
									'group' 		=> __( 'Slider Settings', 'html5-videogallery-plus-player' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Autoplay', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'autoplay',
									'value' 		=> array(
														__( 'True', 'html5-videogallery-plus-player' ) 	=> 'true',
														__( 'False', 'html5-videogallery-plus-player' ) => 'false',
													),
									'description' 	=> __( 'Enable autoplay.', 'html5-videogallery-plus-player' ),
									'group' 		=> __( 'Slider Settings', 'html5-videogallery-plus-player' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Autoplay Interval', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'autoplay_interval',
									'value' 		=> 3000,
									'description' 	=> __( 'Enter autoplay speed.', 'html5-videogallery-plus-player' ),
									'group' 		=> __( 'Slider Settings', 'html5-videogallery-plus-player' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Speed', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'speed',
									'value' 		=> 300,
									'description' 	=> __( 'Control slider speed.', 'html5-videogallery-plus-player' ),
									'group' 		=> __( 'Slider Settings', 'html5-videogallery-plus-player' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Slider Arrows', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'arrows',
									'value' 		=> array(
															__( 'True', 'html5-videogallery-plus-player' ) 	=> 'true',
															__( 'False', 'html5-videogallery-plus-player' ) 	=> 'false',
														),
									'description' 	=> __( 'Show Prev - Next arrows.', 'html5-videogallery-plus-player' ),
									'group' 		=> __( 'Slider Settings', 'html5-videogallery-plus-player' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Infinite Loop', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'loop',
									'value' 		=> array(
														__( 'True', 'html5-videogallery-plus-player' ) 	=> 'true',
														__( 'False', 'html5-videogallery-plus-player' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable infinite loop sliding for contineous sliding.', 'html5-videogallery-plus-player' ),
									'group' 		=> __( 'Slider Settings', 'html5-videogallery-plus-player' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Center Mode', 'html5-videogallery-plus-player' ),
									'param_name' 	=> 'center_mode',
									'value' 		=> array(
														__( 'False', 'html5-videogallery-plus-player' ) => 'false',
														__( 'True', 'html5-videogallery-plus-player' ) 	=> 'true',
													),
									'description' 	=> __( 'Enable Slider center mode effect.  Note : For better, use it with odd number of `Slider Slides Column`', 'html5-videogallery-plus-player' ),
									'group' 		=> __( 'Slider Settings', 'html5-videogallery-plus-player' ),
								),
							)
		));
	}

}

$wpvgp_vc = new Wpvgp_Vc();