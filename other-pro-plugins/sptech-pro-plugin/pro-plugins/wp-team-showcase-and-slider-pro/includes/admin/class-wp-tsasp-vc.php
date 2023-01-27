<?php
/**
 * Visual Composer Class
 *
 * Handles the visual composer shortcode functionality of plugin
 *
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wptsasp_Vc {
	
	function __construct() {
		
		// Action to add 'wp-team' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wptsasp_pro_integrate_team_grid_vc') );
		
		// Action to add 'wp-team-slider' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wptsasp_pro_integrate_team_slider_vc') );
	}

	/**
	 * Function to add 'wp-team' shortcode in vc
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wptsasp_pro_integrate_team_grid_vc() {
		vc_map( 
			array(
				'name' 			=> __( 'WPOS - Team Grid', 'wp-team-showcase-and-slider' ),
				'base' 			=> 'wp-team',
				'icon' 			=> 'icon-wpb-wp',
				'class' 		=> '',
				'category' 		=> __( 'Content', 'wp-team-showcase-and-slider'),
				'description' 	=> __( 'Display Team in grid view.', 'wp-team-showcase-and-slider' ),
				'params' 		=> array(
					// General settings
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Design', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'design',
						'value' 		=> array(
												__( 'Grid Design 1', 'wp-team-showcase-and-slider' ) 	=> 'design-1',
												__( 'Grid Design 2', 'wp-team-showcase-and-slider' ) 	=> 'design-2',
												__( 'Grid Design 3', 'wp-team-showcase-and-slider' ) 	=> 'design-3',
												__( 'Grid Design 4', 'wp-team-showcase-and-slider' ) 	=> 'design-4',
												__( 'Grid Design 5', 'wp-team-showcase-and-slider' ) 	=> 'design-5',
												__( 'Grid Design 6', 'wp-team-showcase-and-slider' ) 	=> 'design-6',
												__( 'Grid Design 7', 'wp-team-showcase-and-slider' ) 	=> 'design-7',
												__( 'Grid Design 8', 'wp-team-showcase-and-slider' ) 	=> 'design-8',
												__( 'Grid Design 9', 'wp-team-showcase-and-slider' ) 	=> 'design-9',
												__( 'Grid Design 10', 'wp-team-showcase-and-slider' ) 	=> 'design-10',
												__( 'Grid Design 11', 'wp-team-showcase-and-slider' ) 	=> 'design-11',
												__( 'Grid Design 12', 'wp-team-showcase-and-slider' ) 	=> 'design-12',
												__( 'Grid Design 13', 'wp-team-showcase-and-slider' ) 	=> 'design-13',
												__( 'Grid Design 14', 'wp-team-showcase-and-slider' ) 	=> 'design-14',
												__( 'Grid Design 15', 'wp-team-showcase-and-slider' ) 	=> 'design-15',
												__( 'Grid Design 16', 'wp-team-showcase-and-slider' ) 	=> 'design-16',
												__( 'Grid Design 17', 'wp-team-showcase-and-slider' ) 	=> 'design-17',
												__( 'Grid Design 18', 'wp-team-showcase-and-slider' ) 	=> 'design-18',
												__( 'Grid Design 19', 'wp-team-showcase-and-slider' ) 	=> 'design-19',
												__( 'Grid Design 20', 'wp-team-showcase-and-slider' ) 	=> 'design-20',
												__( 'Grid Design 21', 'wp-team-showcase-and-slider' ) 	=> 'design-21',
												__( 'Grid Design 22', 'wp-team-showcase-and-slider' ) 	=> 'design-22',
												__( 'Grid Design 23', 'wp-team-showcase-and-slider' ) 	=> 'design-23',
												__( 'Grid Design 24', 'wp-team-showcase-and-slider' ) 	=> 'design-24',
												__( 'Grid Design 25', 'wp-team-showcase-and-slider' ) 	=> 'design-25',							
											),
						'description' 	=> __( 'Choose grid design.', 'wp-team-showcase-and-slider' ),
						'admin_label' 	=> true,
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Grid', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'grid',
						'value' 		=> array(
											__( 'Grid 1', 'wp-team-showcase-and-slider' ) => '1',
											__( 'Grid 2', 'wp-team-showcase-and-slider' ) => '2',
											__( 'Grid 3', 'wp-team-showcase-and-slider' ) => '3',
											__( 'Grid 4', 'wp-team-showcase-and-slider' ) => '4',											
										),
						'std'			=> 2,
						'description' 	=> __( 'Choose number of columns for team member.', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Description', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'show_content',
						'value' 		=> array(
											__( 'True', 'wp-team-showcase-and-slider' ) 	=> 'true',
											__( 'False', 'wp-team-showcase-and-slider' ) 	=> 'false',
							),
						'description' 	=> __( 'Display team member description.', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Full Description', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'show_full_content',
						'value' 		=> array(
												__( 'False', 'wp-team-showcase-and-slider' ) 	=> 'false',
												__( 'True', 'wp-team-showcase-and-slider' ) 	=> 'true',
											),
						'description' 	=> __( 'Display full description.', 'wp-team-showcase-and-slider' ),	
						'dependency' 	=> array(
											'element' 	=> 'show_content',
											'value' 	=> array( 'true' ),
										),					
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Description Words limit', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'words_limit',
						'value' 		=> 40,
						'description' 	=> __( 'Enter words limit for description.', 'wp-team-showcase-and-slider' ),
						'dependency' 	=> array(
												'element' 	=> 'show_full_content',
												'value' 	=> array( 'false' ),
											),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Content Tail', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'content_tail',
						'value' 		=> '...',
						'description' 	=> __( 'Display dots after the post content as continue reading.', 'wp-team-showcase-and-slider' ),
						'dependency' 	=> array(
											'element' 	=> 'show_full_content',
											'value' 	=> array( 'false' ),
										),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Offset (Distance between two team column)', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'offset',
						'value' 		=> '',
						'description' 	=> __( 'Distance between two team column. Leave empty for default. e.g 5 OR 0.', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Social Icons limit', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'social_limit',
						'value' 		=> '6',
						'description' 	=> __( 'Limit the number of social icons to display. Note:In popup all social icon will be displayed.', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Image fill', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'image_fit',
						'value' 		=> array(
											__( 'True', 'wp-team-showcase-and-slider' ) 	=> 'true',
											__( 'False', 'wp-team-showcase-and-slider' ) 	=> 'false',
							),
						'description' 	=> __( 'the image will fill the height and width of its box.set true to fill the image in container when you set false you need to upload appropriate size image.', 'wp-team-showcase-and-slider' ),
					),

					// Popup Settings
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Popup', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'popup',
						'value' 		=> array(
											__( 'True', 'wp-team-showcase-and-slider' ) 	=> 'true',
											__( 'False', 'wp-team-showcase-and-slider' ) 	=> 'false',
										),
						'description' 	=> __( "Enable popup. Display member's more information in a popup.", 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Popup Settings', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Popup Design', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'popup_design',
						'value' 		=> array(
											__( 'Popup Design 1 - Vertical', 'wp-team-showcase-and-slider' ) 	=> 'design-1',
											__( 'Popup Design 2 - Horizontal', 'wp-team-showcase-and-slider' ) 	=> 'design-2',
										),
						'description' 	=> __( 'Choose design for team popup.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Popup Settings', 'wp-team-showcase-and-slider' ),
						'admin_label' 	=> true,
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Popup Theme', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'popup_theme',
						'value' 		=> array(
												__( 'Dark Theme', 'wp-team-showcase-and-slider' ) 	=> 'dark',
												__( 'Light Theme', 'wp-team-showcase-and-slider' ) 	=> 'light',
											),
						'description' 	=> __( 'Choose popup design theme for popup.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Popup Settings', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Popup Gallery', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'popup_gallery',
						'value' 		=> array(
											__( 'True', 'wp-team-showcase-and-slider' ) 	=> 'true',
											__( 'False', 'wp-team-showcase-and-slider' ) 	=> 'false',
										),
						'description' 	=> __( 'Enable popup gallery view. User can navigate team members without closing the popup.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Popup Settings', 'wp-team-showcase-and-slider' ),
					),

					// Data Settings
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Total Items', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'limit',
						'value' 		=> 15,
						'description' 	=> __( 'Enter number of post to be displayed. Enter -1 to display all.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Data Settings', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Post Order By', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'orderby',
						'value' 		=> array(
												__( 'Post Date', 'wp-team-showcase-and-slider' ) 				=> 'date',
												__( 'Post ID', 'wp-team-showcase-and-slider' ) 					=> 'ID',
												__( 'Post Author', 'wp-team-showcase-and-slider' ) 				=> 'author',
												__( 'Post Title', 'wp-team-showcase-and-slider' ) 				=> 'title',
												__( 'Post Modified Date', 'wp-team-showcase-and-slider' ) 		=> 'modified',
												__( 'Random', 'wp-team-showcase-and-slider' ) 					=> 'rand',
												__( 'Menu Order (Sort Order)', 'wp-team-showcase-and-slider' ) 	=> 'menu_order',
												),
						'description' 	=> __( 'Select order type.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Data Settings', 'wp-team-showcase-and-slider' )
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Order', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'order',
						'value' 		=> array(
												__( 'Descending', 'wp-team-showcase-and-slider' ) 	=> 'desc',
												__( 'Ascending', 'wp-team-showcase-and-slider' ) 	=> 'asc',
											),
						'description' 	=> __( 'Select sort order.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Data Settings', 'wp-team-showcase-and-slider' )
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Category', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'category',
						'value' 		=> '',
						'description' 	=> sprintf(__( 'Enter category id to display categories wise. You can pass multiple ids with comma seperated. You can find id at listing <a href="%1$s" target="_blank">page</a>.', 'wp-team-showcase-and-slider' ), add_query_arg(array('taxonomy' => WP_TSASP_CAT, 'post_type' => WP_TSASP_POST_TYPE), 'edit-tags.php')),
						'group' 		=> __( 'Data Settings', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Include Children Category', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'include_cat_child',
						'value' 		=> array(
												__( 'True', 'wp-team-showcase-and-slider' ) 	=> 'true',
												__( 'False', 'wp-team-showcase-and-slider' ) 	=> 'false',
											),
						'description' 	=> __( 'If you are using parent category then whether to display child category team member or not.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Data Settings', 'wp-team-showcase-and-slider' )
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Exclude Category', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'exclude_cat',
						'value' 		=> '',						
						'description' 	=> sprintf(__( 'Exclude post category. Works only if `Category` field is empty. You can pass multiple ids with comma seperated. You can find id at listing <a href="%1$s" target="_blank">page</a>.', 'wp-team-showcase-and-slider' ), add_query_arg(array('taxonomy' => WP_TSASP_CAT, 'post_type' => WP_TSASP_POST_TYPE ), 'edit-tags.php')),
						'group' 		=> __( 'Data Settings', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Display Specific Posts', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'posts',
						'value' 		=> '',
						'description' 	=> sprintf(__('Enter id of the post which you want to display. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'wp-team-showcase-and-slider' ), add_query_arg( array('post_type' => WP_TSASP_POST_TYPE), 'edit.php')),
						'group' 		=> __( 'Data Settings', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Exclude Post', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'exclude_post',
						'value' 		=> '',
						'description' 	=> sprintf(__('Enter id of the post which you do not want to display. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'wp-team-showcase-and-slider' ), add_query_arg( array( 'post_type' => WP_TSASP_POST_TYPE ), 'edit.php')),
						'group' 		=> __( 'Data Settings', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Pagination', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'pagination',
						'value' 		=> array(
												__( 'False', 'wp-team-showcase-and-slider' ) => 'false',
												__( 'True', 'wp-team-showcase-and-slider' ) 	=> 'true',
											),
						'description' 	=> __( 'Display Pagination for Team Post', 'wp-team-showcase-and-slider' ),
						'dependency' 	=> array(
												'element' 				=> 'limit',
												'value_not_equal_to' 	=> array( '-1' ),
											),
						'group' 		=> __( 'Data Settings', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Pagination Type', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'pagination_type',
						'value' 		=> array(
												__( 'Numeric Pagination', 'wp-team-showcase-and-slider' ) 			=> 'numeric',
												__( 'Previous - Next Pagination', 'wp-team-showcase-and-slider' ) 	=> 'prev-next',
											),
						'description' 	=> __( 'Display Pagination for Team Post', 'wp-team-showcase-and-slider' ),
						'dependency' 	=> array(
												'element' 	=> 'pagination',
												'value' 	=> array( 'true' ),
											),
						'group' 		=> __( 'Data Settings', 'wp-team-showcase-and-slider' ),
					),
				),
			)
		);
	}

	/**
	 * Function to add 'wp-team-slider' shortcode in vc
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */

	function wptsasp_pro_integrate_team_slider_vc() {
		vc_map( 
			array(
				'name' 			=> __( 'WPOS - Team Slider', 'wp-team-showcase-and-slider' ),
				'base' 			=> 'wp-team-slider',
				'icon' 			=> 'icon-wpb-wp',
				'class' 		=> '',
				'category' 		=> __( 'Content', 'wp-team-showcase-and-slider'),
				'description' 	=> __( 'Display Team in slider view.', 'wp-team-showcase-and-slider' ),
				'params' 	=> array(
					// General settings
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Design', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'design',
						'value' 		=> array(
													__( 'Slider Design 1', 'wp-team-showcase-and-slider' ) 	=> 'design-1',
													__( 'Slider Design 2', 'wp-team-showcase-and-slider' ) 	=> 'design-2',
													__( 'Slider Design 3', 'wp-team-showcase-and-slider' ) 	=> 'design-3',
													__( 'Slider Design 4', 'wp-team-showcase-and-slider' ) 	=> 'design-4',
													__( 'Slider Design 5', 'wp-team-showcase-and-slider' ) 	=> 'design-5',
													__( 'Slider Design 6', 'wp-team-showcase-and-slider' ) 	=> 'design-6',
													__( 'Slider Design 7', 'wp-team-showcase-and-slider' ) 	=> 'design-7',
													__( 'Slider Design 8', 'wp-team-showcase-and-slider' ) 	=> 'design-8',
													__( 'Slider Design 9', 'wp-team-showcase-and-slider' ) 	=> 'design-9',
													__( 'Slider Design 10', 'wp-team-showcase-and-slider' ) => 'design-10',
													__( 'Slider Design 11', 'wp-team-showcase-and-slider' ) => 'design-11',
													__( 'Slider Design 12', 'wp-team-showcase-and-slider' ) => 'design-12',
													__( 'Slider Design 13', 'wp-team-showcase-and-slider' ) => 'design-13',
													__( 'Slider Design 14', 'wp-team-showcase-and-slider' ) => 'design-14',
													__( 'Slider Design 15', 'wp-team-showcase-and-slider' ) => 'design-15',
													__( 'Slider Design 16', 'wp-team-showcase-and-slider' ) => 'design-16',
													__( 'Slider Design 17', 'wp-team-showcase-and-slider' ) => 'design-17',
													__( 'Slider Design 18', 'wp-team-showcase-and-slider' ) => 'design-18',
													__( 'Slider Design 19', 'wp-team-showcase-and-slider' )	=> 'design-19',
													__( 'Slider Design 20', 'wp-team-showcase-and-slider' )	=> 'design-20',
													__( 'Slider Design 21', 'wp-team-showcase-and-slider' )	=> 'design-21',
													__( 'Slider Design 22', 'wp-team-showcase-and-slider' )	=> 'design-22',
													__( 'Slider Design 23', 'wp-team-showcase-and-slider' )	=> 'design-23',
													__( 'Slider Design 24', 'wp-team-showcase-and-slider' )	=> 'design-24',
													__( 'Slider Design 25', 'wp-team-showcase-and-slider' )	=> 'design-25',
											),
						'description' 	=> __( 'Choose slider design.', 'wp-team-showcase-and-slider' ),
						'admin_label' 	=> true,
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Description', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'show_content',
						'value' 		=> array(
											__( 'True', 'wp-team-showcase-and-slider' ) 	=> 'true',
											__( 'False', 'wp-team-showcase-and-slider' ) 	=> 'false',
							),
						'description' 	=> __( 'Display team member description.', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Full Description', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'show_full_content',
						'value' 		=> array(
											__( 'False', 'wp-team-showcase-and-slider' ) 	=> 'false',
											__( 'True', 'wp-team-showcase-and-slider' ) 	=> 'true',
							),
						'description' 	=> __( 'Display full description.', 'wp-team-showcase-and-slider' ),
						'dependency' 	=> array(
											'element' 	=> 'show_content',
											'value' 	=> array( 'true' ),
										),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Enter Words limit', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'words_limit',
						'value' 		=> 40,
						'description' 	=> __( 'Enter words limit for description.', 'wp-team-showcase-and-slider' ),
						'dependency' 	=> array(
										'element' 	=> 'show_full_content',
										'value' 	=> array( 'false' ),
										),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Content Tail', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'content_tail',
						'value' 		=> '...',
						'description' 	=> __( 'Display dots after the post content as continue reading.', 'wp-team-showcase-and-slider' ),
						'dependency' 	=> array(
										'element' 	=> 'show_full_content',
										'value' 	=> array( 'false' ),
										),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Social Icons limit', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'social_limit',
						'value' 		=> '6',
						'description' 	=> __( 'Limit the number of social icons to display. Note:In popup all social icon will be displayed.', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Image fill', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'image_fit',
						'value' 		=> array(
											__( 'True', 'wp-team-showcase-and-slider' ) 	=> 'true',
											__( 'False', 'wp-team-showcase-and-slider' ) 	=> 'false',
							),
						'description' 	=> __( 'the image will fill the height and width of its box.set true to fill the image in container when you set false you need to upload appropriate size image.', 'wp-team-showcase-and-slider' ),
					),

					// Popup Settings
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Popup', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'popup',
						'value' 		=> array(
											__( 'True', 'wp-team-showcase-and-slider' ) 	=> 'true',
											__( 'False', 'wp-team-showcase-and-slider' ) 	=> 'false',
										),
						'description' 	=> __( "Enable popup. Display member's more information in a popup.", 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Popup Settings', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Popup Design', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'popup_design',
						'value' 		=> array(
											__( 'Popup Design 1 - Vertical', 'wp-team-showcase-and-slider' ) 	=> 'design-1',
											__( 'Popup Design 2 - Horizontal', 'wp-team-showcase-and-slider' ) 	=> 'design-2',
										),
						'description' 	=> __( 'Choose design for team popup.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Popup Settings', 'wp-team-showcase-and-slider' ),
						'admin_label' 	=> true,
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Popup Theme', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'popup_theme',
						'value' 		=> array(
											__( 'Dark Theme', 'wp-team-showcase-and-slider' ) 	=> 'dark',
											__( 'Light Theme', 'wp-team-showcase-and-slider' ) 	=> 'light',
										),
						'description' 	=> __( 'Choose popup design theme for popup.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Popup Settings', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Popup Gallery', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'popup_gallery',
						'value' 		=> array(
											__( 'True', 'wp-team-showcase-and-slider' ) 	=> 'true',
											__( 'False', 'wp-team-showcase-and-slider' ) 	=> 'false',
										),
						'description' 	=> __( 'Enable popup gallery view. User can navigate team members without closing the popup.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Popup Settings', 'wp-team-showcase-and-slider' ),
					),

					//Slider Setting
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Dots', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'dots',
						'value' 		=> array(
											__( 'True', 'wp-team-showcase-and-slider' )  	=> 'true',
											__( 'False', 'wp-team-showcase-and-slider' ) 	=> 'false',
							),
						'description' 	=> __( 'Show pagination dots.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Slider Settings', 'wp-team-showcase-and-slider' )
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Arrows', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'arrows',
						'value' 		=> array(
											__( 'True', 'wp-team-showcase-and-slider' )  	=> 'true',
											__( 'False', 'wp-team-showcase-and-slider' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Prev - Next arrows.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Slider Settings', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Slide To Show', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'slides_column',
						'value' 		=> '3',
						'description' 	=> __( 'Enter number for Slide to show at a time.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Slider Settings', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Slide To Scroll', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'slides_scroll',
						'value' 		=> '1',
						'description' 	=> __( 'Enter number to scroll slider at a time.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Slider Settings', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Autoplay', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'autoplay',
						'value' 		=> array(
											__( 'True', 'wp-team-showcase-and-slider' ) 	=> 'true',
											__( 'False', 'wp-team-showcase-and-slider' ) 	=> 'false',
							),
						'description' 	=> __( 'Enable autoplay.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Slider Settings', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Autoplay Interval', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'autoplay_interval',
						'value' 		=> '3000',
						'description' 	=> __( 'Enter autoplay speed.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Slider Settings', 'wp-team-showcase-and-slider' ),
						'dependency' 	=> array(
											'element' 	=> 'autoplay',
											'value' 	=> array( 'true' ),
											),
					),					
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Speed', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'speed',
						'value' 		=> '500',
						'description' 	=> __( 'Enter slide speed.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Slider Settings', 'wp-team-showcase-and-slider' ),
						'dependency' 	=> array(
											'element' 	=> 'autoplay',
											'value' 	=> array( 'true' ),
											),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Center Mode', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'centermode',
						'value' 		=> array(
											__( 'False', 'wp-team-showcase-and-slider' ) 	=> 'false',
											__( 'True', 'wp-team-showcase-and-slider' ) 	=> 'true',
										),
						'description' 	=> __( 'Enable slider center mode effect.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Slider Settings', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Infinite', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'infinite',
						'value' 		=> array(
											__( 'True', 'wp-team-showcase-and-slider' ) 	=> 'true',
											__( 'False', 'wp-team-showcase-and-slider' ) 	=> 'false',											
										),
						'description' 	=> __( 'Enable infinite loop for continuous sliding.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Slider Settings', 'wp-team-showcase-and-slider' ),
					),
					
					// Data Setting
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Total Items', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'limit',
						'value' 		=> 15,
						'description' 	=> __( 'Enter number of post to be displayed. Enter -1 to display all.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Data Settings', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Post Order By', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'orderby',
						'value' 		=> array(
												__( 'Post Date', 'wp-team-showcase-and-slider' ) 				=> 'date',
												__( 'Post ID', 'wp-team-showcase-and-slider' ) 				=> 'ID',
												__( 'Post Author', 'wp-team-showcase-and-slider' ) 			=> 'author',
												__( 'Post Title', 'wp-team-showcase-and-slider' ) 			=> 'title',
												__( 'Post Modified Date', 'wp-team-showcase-and-slider' ) 	=> 'modified',
												__( 'Random', 'wp-team-showcase-and-slider' ) 				=> 'rand',
												__( 'Menu Order (Sort Order)', 'wp-team-showcase-and-slider' ) 			=> 'menu_order',
											),
						'description' 	=> __( 'Select order type.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Data Settings', 'wp-team-showcase-and-slider' )
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Order', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'order',
						'value' 		=> array(
												__( 'Descending', 'wp-team-showcase-and-slider' ) 	=> 'desc',
												__( 'Ascending', 'wp-team-showcase-and-slider' ) 	=> 'asc',
											),
						'description' 	=> __( 'Select sort order.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Data Settings', 'wp-team-showcase-and-slider' )
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Category', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'category',
						'value' 		=> '',
						'description' 	=> sprintf(__( 'Enter category id to display categories wise. You can pass multiple ids with comma seperated. You can find id at listing <a href="%1$s" target="_blank">page</a>.', 'wp-team-showcase-and-slider' ), add_query_arg(array('taxonomy' => WP_TSASP_CAT, 'post_type' => WP_TSASP_POST_TYPE), 'edit-tags.php')),
						'group' 		=> __( 'Data Settings', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Include Children Category', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'include_cat_child',
						'value' 		=> array(
												__( 'True', 'wp-team-showcase-and-slider' ) 	=> 'true',
												__( 'False', 'wp-team-showcase-and-slider' ) 	=> 'false',
											),
						'description' 	=> __( 'If you are using parent category then whether to display child category team member or not.', 'wp-team-showcase-and-slider' ),
						'group' 		=> __( 'Data Settings', 'wp-team-showcase-and-slider' )
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Exclude Category', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'exclude_cat',
						'value' 		=> '',
						'description' 	=> sprintf(__( 'Exclude post category. Works only if `Category` field is empty. You can pass multiple ids with comma seperated. You can find id at listing <a href="%1$s" target="_blank">page</a>.', 'wp-team-showcase-and-slider' ), add_query_arg(array('taxonomy' => WP_TSASP_CAT, 'post_type' => WP_TSASP_POST_TYPE), 'edit-tags.php')),
						'group' 		=> __( 'Data Settings', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Display Specific Post', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'posts',
						'value' 		=> '',
						'description' 	=> sprintf(__('Enter id of the post which you want to display. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'wp-team-showcase-and-slider' ), add_query_arg(array('post_type' => WP_TSASP_POST_TYPE), 'edit.php')),
						'group' 		=> __( 'Data Settings', 'wp-team-showcase-and-slider' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Exclude Post', 'wp-team-showcase-and-slider' ),
						'param_name' 	=> 'exclude_post',
						'value' 		=> '',
						'description' 	=> sprintf(__('Enter id of the post which you do not want to display. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'wp-team-showcase-and-slider' ), add_query_arg(array('post_type' => WP_TSASP_POST_TYPE), 'edit.php')),
						'group' 		=> __( 'Data Settings', 'wp-team-showcase-and-slider' ),
					),					
				),
			)
		);
	}

}

$wptsasp_vc = new Wptsasp_Vc();