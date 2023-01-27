<?php
/**
 * Visual Composer Class
 *
 * Handles the visual composer shortcode functionality of plugin
 *
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpls_Vc {
	
	function __construct() {

		// Action to add 'recent_post_slider' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wpls_pro_integrate_logo_grid_vc') );

		// Action to add 'logoshowcase' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wpls_pro_integrate_logo_slider_vc') );

		// Action to add 'logo_filter' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wpls_pro_integrate_logo_filter_vc') );
	}

	/**
	 * Function to add 'logo_grid' shortcode in vc
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_integrate_logo_grid_vc() {
		vc_map( array(
			'name' 			=> __( 'WPOS - Logo Showcase Grid', 'logoshowcase' ),
			'base' 			=> 'logo_grid',
			'icon' 			=> 'icon-wpb-wp',
			'class' 		=> '',
			'category' 		=> __( 'Content', 'logoshowcase'),
			'description' 	=> __( 'Display logo in a grid view.', 'logoshowcase' ),
			'params' 	=> array(
								// General settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Title', 'logoshowcase' ),
									'param_name' 	=> 'cat_name',
									'value' 		=> '',
									'description' 	=> __( 'Display title above logo showcase.', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Design', 'logoshowcase' ),
									'param_name' 	=> 'design',
									'value' 		=> array(
															__( 'Grid Design 1', 'logoshowcase' ) 	=> 'design-1',
															__( 'Grid Design 2', 'logoshowcase' ) 	=> 'design-2',
															__( 'Grid Design 3', 'logoshowcase' ) 	=> 'design-3',
															__( 'Grid Design 4', 'logoshowcase' ) 	=> 'design-4',
															__( 'Grid Design 5', 'logoshowcase' ) 	=> 'design-5',
															__( 'Grid Design 6', 'logoshowcase' ) 	=> 'design-6',
															__( 'Grid Design 7', 'logoshowcase' ) 	=> 'design-7',
															__( 'Grid Design 8', 'logoshowcase' ) 	=> 'design-8',
															__( 'Grid Design 9', 'logoshowcase' ) 	=> 'design-9',
															__( 'Grid Design 10', 'logoshowcase' ) 	=> 'design-10',
															__( 'Grid Design 11', 'logoshowcase' ) 	=> 'design-11',
															__( 'Grid Design 12', 'logoshowcase' ) 	=> 'design-12',
															__( 'Grid Design 13', 'logoshowcase' ) 	=> 'design-13',
															__( 'Grid Design 14', 'logoshowcase' ) 	=> 'design-14',
															__( 'Grid Design 15', 'logoshowcase' ) 	=> 'design-15',
															__( 'Grid Design 16', 'logoshowcase' ) 	=> 'design-16',
														),
									'description' 	=> __( 'Choose grid design.', 'logoshowcase' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Image Size', 'logoshowcase' ),
									'param_name' 	=> 'image_size',
									'value' 		=> array(
															__( 'Original', 'logoshowcase' ) 		=> '',
															__( 'Large', 'logoshowcase' ) 			=> 'large',
															__( 'Medium', 'logoshowcase' ) 			=> 'medium',
															__( 'Thumbnail', 'logoshowcase' ) 		=> 'thumbnail',
														),
									'description' 	=> __( 'Choose logo image size.', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Animation Effect', 'logoshowcase' ),
									'param_name' 	=> 'animation',
									'value' 		=> array(
															'Select Animation Effect' 	=> '',
															'Flash' 			=> 'flash',
															'Pulse'				=> 'pulse',
															'Rubber Band' 		=> 'rubberBand',
															'Head Shake'		=> 'headShake',
															'Swing'				=> 'swing',
															'Tada'				=> 'tada',
															'Wobble'			=> 'wobble',
															'Jello'				=> 'jello',
															'Bounce In'			=> 'bounceIn',
															'Fade In'			=> 'fadeIn',
															'Fade Out'			=> 'fadeOut',
															'Light Speed Out'	=> 'lightSpeedOut',
															'Rotate In'			=> 'rotateIn',
														),
									'description' 	=> __( 'Choose logo animation effect.', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Logo Columns Grid', 'logoshowcase' ),
									'param_name' 	=> 'grid',
									'value' 		=> '4',
									'description' 	=> __( 'Control logo columns. Maximum grid is up to 12.', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Link Behaviour', 'logoshowcase' ),
									'param_name' 	=> 'link_target',
									'value' 		=> array(
														__( 'Same Window', 'logoshowcase' ) => 'self',
														__( 'New Window', 'logoshowcase' ) 	=> 'blank',
													),
									'description' 	=> __( 'Choose link bahaviour.', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Title', 'logoshowcase' ),
									'param_name' 	=> 'show_title',
									'value' 		=> array(
															__( 'True', 'logoshowcase' ) 	=> 'true',
															__( 'False', 'logoshowcase' ) 	=> 'false',
														),
									'description' 	=> __( 'Display logo with title.', 'logoshowcase' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Tooltip', 'logoshowcase' ),
									'param_name' 	=> 'tooltip',
									'value' 		=> array(
															__( 'False', 'logoshowcase' ) 	=> 'false',
															__( 'True', 'logoshowcase' ) 	=> 'true',
														),
									'description' 	=> __( 'Display tooltip.', 'logoshowcase' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Words Limit', 'logoshowcase' ),
									'param_name' 	=> 'content_words_limit',
									'value' 		=> '25',
									'description' 	=> __( 'Control post content words limit.', 'logoshowcase' ),
									'dependency' 	=> array(
														'element' 	=> 'design',
														'value' 	=> array( 'design-4' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Tail', 'logoshowcase' ),
									'param_name' 	=> 'content_tail',
									'value' 		=> '...',
									'description' 	=> __( 'Display dots after the post content.', 'logoshowcase' ),
									'dependency' 	=> array(
														'element' 	=> 'design',
														'value' 	=> array( 'design-4' ),
														),
								),

								// Data Settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Total items', 'logoshowcase' ),
									'param_name' 	=> 'limit',
									'value' 		=> 15,
									'description' 	=> __( 'Enter number of logo to be displayed. Enter -1 to display all.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Order By', 'logoshowcase' ),
									'param_name' 	=> 'orderby',
									'value' 		=> array(
														__( 'Post Date', 'logoshowcase' ) 			=> 'date',
														__( 'Post ID', 'logoshowcase' ) 			=> 'ID',
														__( 'Post Author', 'logoshowcase' ) 		=> 'author',
														__( 'Post Title', 'logoshowcase' ) 			=> 'title',
														__( 'Post Modified Date', 'logoshowcase' ) 	=> 'modified',
														__( 'Random', 'logoshowcase' ) 				=> 'rand',
														__( 'Menu Order', 'logoshowcase' ) 			=> 'menu_order',
													),
									'description' 	=> __( 'Select order type.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Sort order', 'logoshowcase' ),
									'param_name' 	=> 'order',
									'value' 		=> array(
														__( 'Descending', 'logoshowcase' ) 	=> 'desc',
														__( 'Ascending', 'logoshowcase' ) 	=> 'asc',
													),
									'description' 	=> __( 'Select sorting order.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Category', 'logoshowcase' ),
									'param_name' 	=> 'cat_id',
									'value' 		=> '',
									'description' 	=> __( 'Enter logo category id to display logo categories wise.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Category', 'logoshowcase' ),
									'param_name' 	=> 'exclude_cat',
									'value' 		=> '',
									'description' 	=> __( 'Exclude logo category. Works only if `Category` field is empty.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Include Category Children', 'logoshowcase' ),
									'param_name' 	=> 'include_cat_child',
									'value' 		=> array(
														__( 'True', 'logoshowcase' ) 	=> 'true',
														__( 'False', 'logoshowcase' ) => 'false',
													),
									'description' 	=> __( 'Include category children or not.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Display Specific Post', 'logoshowcase' ),
									'param_name' 	=> 'posts',
									'value' 		=> '',
									'description' 	=> __( 'Display specific posts.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Post', 'logoshowcase' ),
									'param_name' 	=> 'exclude_post',
									'value' 		=> '',
									'description' 	=> __( 'Enter post id which you do not want to display.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' ),
								),
							)
		));
	}

	/**
	 * Function to add 'recent_post_carousel' shortcode in vc
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_integrate_logo_slider_vc() {
		vc_map( array(
			'name' 			=> __( 'WPOS - Logo Showcase Slider', 'logoshowcase' ),
			'base' 			=> 'logoshowcase',
			'icon' 			=> 'icon-wpb-wp',
			'class' 		=> '',
			'category' 		=> __( 'Content', 'logoshowcase'),
			'description' 	=> __( 'Display logo in a slider view.', 'logoshowcase' ),
			'params' 	=> array(
								// General settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Title', 'logoshowcase' ),
									'param_name' 	=> 'cat_name',
									'value' 		=> '',
									'description' 	=> __( 'Display title above logo showcase.', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Design', 'logoshowcase' ),
									'param_name' 	=> 'design',
									'value' 		=> array(
															__( 'Slider Design 1', 'logoshowcase' ) 	=> 'design-1',
															__( 'Slider Design 2', 'logoshowcase' ) 	=> 'design-2',
															__( 'Slider Design 3', 'logoshowcase' ) 	=> 'design-3',
															__( 'Slider Design 4', 'logoshowcase' ) 	=> 'design-4',
															__( 'Slider Design 5', 'logoshowcase' ) 	=> 'design-5',
															__( 'Slider Design 6', 'logoshowcase' ) 	=> 'design-6',
															__( 'Slider Design 7', 'logoshowcase' ) 	=> 'design-7',
															__( 'Slider Design 8', 'logoshowcase' ) 	=> 'design-8',
															__( 'Slider Design 9', 'logoshowcase' ) 	=> 'design-9',
															__( 'Slider Design 10', 'logoshowcase' ) 	=> 'design-10',
															__( 'Slider Design 11', 'logoshowcase' ) 	=> 'design-11',
															__( 'Slider Design 12', 'logoshowcase' ) 	=> 'design-12',
															__( 'Slider Design 13', 'logoshowcase' ) 	=> 'design-13',
															__( 'Slider Design 14', 'logoshowcase' ) 	=> 'design-14',
															__( 'Slider Design 15', 'logoshowcase' ) 	=> 'design-15',
															__( 'Slider Design 16', 'logoshowcase' ) 	=> 'design-16',
														),
									'description' 	=> __( 'Choose grid design.', 'logoshowcase' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Image Size', 'logoshowcase' ),
									'param_name' 	=> 'image_size',
									'value' 		=> array(
															__( 'Original', 'logoshowcase' ) 		=> '',
															__( 'Large', 'logoshowcase' ) 			=> 'large',
															__( 'Medium', 'logoshowcase' ) 			=> 'medium',
															__( 'Thumbnail', 'logoshowcase' ) 		=> 'thumbnail',
														),
									'description' 	=> __( 'Choose logo image size.', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Animation Effect', 'logoshowcase' ),
									'param_name' 	=> 'animation',
									'value' 		=> array(
															'Select Animation Effect' 	=> '',
															'Flash' 			=> 'flash',
															'Pulse'				=> 'pulse',
															'Rubber Band' 		=> 'rubberBand',
															'Head Shake'		=> 'headShake',
															'Swing'				=> 'swing',
															'Tada'				=> 'tada',
															'Wobble'			=> 'wobble',
															'Jello'				=> 'jello',
															'Bounce In'			=> 'bounceIn',
															'Fade In'			=> 'fadeIn',
															'Fade Out'			=> 'fadeOut',
															'Light Speed Out'	=> 'lightSpeedOut',
															'Rotate In'			=> 'rotateIn',
														),
									'description' 	=> __( 'Choose logo animation effect.', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Link Behaviour', 'logoshowcase' ),
									'param_name' 	=> 'link_target',
									'value' 		=> array(
														__( 'Same Window', 'logoshowcase' ) => 'self',
														__( 'New Window', 'logoshowcase' ) 	=> 'blank',
													),
									'description' 	=> __( 'Choose link bahaviour.', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Title', 'logoshowcase' ),
									'param_name' 	=> 'show_title',
									'value' 		=> array(
															__( 'True', 'logoshowcase' ) 	=> 'true',
															__( 'False', 'logoshowcase' ) 	=> 'false',
														),
									'description' 	=> __( 'Display logo with title.', 'logoshowcase' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Tooltip', 'logoshowcase' ),
									'param_name' 	=> 'tooltip',
									'value' 		=> array(
															__( 'True', 'logoshowcase' ) 	=> 'true',
															__( 'False', 'logoshowcase' ) 	=> 'false',
														),
									'description' 	=> __( 'Display tooltip.', 'logoshowcase' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Words Limit', 'logoshowcase' ),
									'param_name' 	=> 'content_words_limit',
									'value' 		=> '25',
									'description' 	=> __( 'Control post content words limit.', 'logoshowcase' ),
									'dependency' 	=> array(
														'element' 	=> 'design',
														'value' 	=> array( 'design-4' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Tail', 'logoshowcase' ),
									'param_name' 	=> 'content_tail',
									'value' 		=> '...',
									'description' 	=> __( 'Display dots after the post content.', 'logoshowcase' ),
									'dependency' 	=> array(
														'element' 	=> 'design',
														'value' 	=> array( 'design-4' ),
														),
								),

								// Data Settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Total items', 'logoshowcase' ),
									'param_name' 	=> 'limit',
									'value' 		=> 15,
									'description' 	=> __( 'Enter number of logo to be displayed. Enter -1 to display all.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Order By', 'logoshowcase' ),
									'param_name' 	=> 'orderby',
									'value' 		=> array(
														__( 'Post Date', 'logoshowcase' ) 			=> 'date',
														__( 'Post ID', 'logoshowcase' ) 			=> 'ID',
														__( 'Post Author', 'logoshowcase' ) 		=> 'author',
														__( 'Post Title', 'logoshowcase' ) 			=> 'title',
														__( 'Post Modified Date', 'logoshowcase' ) 	=> 'modified',
														__( 'Random', 'logoshowcase' ) 				=> 'rand',
														__( 'Menu Order', 'logoshowcase' ) 			=> 'menu_order',
													),
									'description' 	=> __( 'Select order type.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Sort order', 'logoshowcase' ),
									'param_name' 	=> 'order',
									'value' 		=> array(
														__( 'Descending', 'logoshowcase' ) 	=> 'desc',
														__( 'Ascending', 'logoshowcase' ) 	=> 'asc',
													),
									'description' 	=> __( 'Select sorting order.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Category', 'logoshowcase' ),
									'param_name' 	=> 'cat_id',
									'value' 		=> '',
									'description' 	=> __( 'Enter logo category id to display logo categories wise.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Category', 'logoshowcase' ),
									'param_name' 	=> 'exclude_cat',
									'value' 		=> '',
									'description' 	=> __( 'Exclude logo category. Works only if `Category` field is empty.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Include Category Children', 'logoshowcase' ),
									'param_name' 	=> 'include_cat_child',
									'value' 		=> array(
														__( 'True', 'logoshowcase' ) 	=> 'true',
														__( 'False', 'logoshowcase' ) => 'false',
													),
									'description' 	=> __( 'Include category children or not.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Display Specific Post', 'logoshowcase' ),
									'param_name' 	=> 'posts',
									'value' 		=> '',
									'description' 	=> __( 'Display specific posts.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Post', 'logoshowcase' ),
									'param_name' 	=> 'exclude_post',
									'value' 		=> '',
									'description' 	=> __( 'Enter post id which you do not want to display.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' ),
								),

								// Slider Settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Slides Column', 'logoshowcase' ),
									'param_name' 	=> 'slides_column',
									'value' 		=> '4',
									'description' 	=> __( 'Enter number of column for slider.', 'logoshowcase' ),
									'group' 		=> __( 'Slider Settings', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Slides Column', 'logoshowcase' ),
									'param_name' 	=> 'slides_scroll',
									'value' 		=> '1',
									'description' 	=> __( 'Enter number of slide to scroll at a time.', 'logoshowcase' ),
									'group' 		=> __( 'Slider Settings', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Dots', 'logoshowcase' ),
									'param_name' 	=> 'dots',
									'value' 		=> array(
														__( 'True', 'logoshowcase' ) 	=> 'true',
														__( 'False', 'logoshowcase' ) => 'false',
													),
									'description' 	=> __( 'Show pagination dots.', 'logoshowcase' ),
									'group' 		=> __( 'Slider Settings', 'logoshowcase' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Arrows', 'logoshowcase' ),
									'param_name' 	=> 'arrows',
									'value' 		=> array(
															__( 'True', 'logoshowcase' ) 	=> 'true',
															__( 'False', 'logoshowcase' ) 	=> 'false',
														),
									'description' 	=> __( 'Show Prev - Next arrows.', 'logoshowcase' ),
									'group' 		=> __( 'Slider Settings', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Autoplay', 'logoshowcase' ),
									'param_name' 	=> 'autoplay',
									'value' 		=> array(
														__( 'True', 'logoshowcase' ) 	=> 'true',
														__( 'False', 'logoshowcase' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable autoplay.', 'logoshowcase' ),
									'group' 		=> __( 'Slider Settings', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Autoplay Interval', 'logoshowcase' ),
									'param_name' 	=> 'autoplay_interval',
									'value' 		=> '3000',
									'description' 	=> __( 'Enter autoplay speed.', 'logoshowcase' ),
									'group' 		=> __( 'Slider Settings', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Speed', 'logoshowcase' ),
									'param_name' 	=> 'speed',
									'value' 		=> '600',
									'description' 	=> __( 'Enter slide speed.', 'logoshowcase' ),
									'group' 		=> __( 'Slider Settings', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Center Mode', 'logoshowcase' ),
									'param_name' 	=> 'center_mode',
									'value' 		=> array(
														__( 'True', 'logoshowcase' ) 	=> 'true',
														__( 'False', 'logoshowcase' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable center mode for slider. Note: Works well with odd number of Slides Column and Slides Scroll is set to 1.', 'logoshowcase' ),
									'group' 		=> __( 'Slider Settings', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Infinite', 'logoshowcase' ),
									'param_name' 	=> 'loop',
									'value' 		=> array(
														__( 'True', 'logoshowcase' ) 	=> 'true',
														__( 'False', 'logoshowcase' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable infinite loop sliding.', 'logoshowcase' ),
									'group' 		=> __( 'Slider Settings', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Ticker Mode', 'logoshowcase' ),
									'param_name' 	=> 'ticker',
									'value' 		=> array(
														__( 'True', 'logoshowcase' ) 	=> 'true',
														__( 'False', 'logoshowcase' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable ticker mode for slider. Note: When you enable ticker mode Autoplay, Slides Scroll and Autoplay Interval are set to default.', 'logoshowcase' ),
									'group' 		=> __( 'Slider Settings', 'logoshowcase' ),
								),
							)
		));
	}

	/**
	 * Function to add 'logo_filter' shortcode in vc
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_integrate_logo_filter_vc() {
		vc_map( array(
			'name' 			=> __( 'WPOS - Logo Showcase Filter', 'logoshowcase' ),
			'base' 			=> 'logo_filter',
			'icon' 			=> 'icon-wpb-wp',
			'class' 		=> '',
			'category' 		=> __( 'Content', 'logoshowcase'),
			'description' 	=> __( 'Display logo showcase filter view.', 'logoshowcase' ),
			'params' 	=> array(
								// General settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Title', 'logoshowcase' ),
									'param_name' 	=> 'cat_name',
									'value' 		=> '',
									'description' 	=> __( 'Display title above logo showcase.', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Design', 'logoshowcase' ),
									'param_name' 	=> 'design',
									'value' 		=> array(
															__( 'Filter Design 1', 'logoshowcase' ) 	=> 'design-1',
															__( 'Filter Design 2', 'logoshowcase' ) 	=> 'design-2',
															__( 'Filter Design 3', 'logoshowcase' ) 	=> 'design-3',
															__( 'Filter Design 4', 'logoshowcase' ) 	=> 'design-4',
															__( 'Filter Design 5', 'logoshowcase' ) 	=> 'design-5',
															__( 'Filter Design 6', 'logoshowcase' ) 	=> 'design-6',
															__( 'Filter Design 7', 'logoshowcase' ) 	=> 'design-7',
															__( 'Filter Design 8', 'logoshowcase' ) 	=> 'design-8',
															__( 'Filter Design 9', 'logoshowcase' ) 	=> 'design-9',
															__( 'Filter Design 10', 'logoshowcase' ) 	=> 'design-10',
															__( 'Filter Design 11', 'logoshowcase' ) 	=> 'design-11',
															__( 'Filter Design 12', 'logoshowcase' ) 	=> 'design-12',
															__( 'Filter Design 13', 'logoshowcase' ) 	=> 'design-13',
															__( 'Filter Design 14', 'logoshowcase' ) 	=> 'design-14',
															__( 'Filter Design 15', 'logoshowcase' ) 	=> 'design-15',
															__( 'Filter Design 16', 'logoshowcase' ) 	=> 'design-16',
														),
									'description' 	=> __( 'Choose design.', 'logoshowcase' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Image Size', 'logoshowcase' ),
									'param_name' 	=> 'image_size',
									'value' 		=> array(
															__( 'Original', 'logoshowcase' ) 		=> '',
															__( 'Large', 'logoshowcase' ) 			=> 'large',
															__( 'Medium', 'logoshowcase' ) 			=> 'medium',
															__( 'Thumbnail', 'logoshowcase' ) 		=> 'thumbnail',
														),
									'description' 	=> __( 'Choose logo image size.', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Logo Columns Grid', 'logoshowcase' ),
									'param_name' 	=> 'grid',
									'value' 		=> '4',
									'description' 	=> __( 'Control logo columns. Maximum grid is up to 12.', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Link Behaviour', 'logoshowcase' ),
									'param_name' 	=> 'link_target',
									'value' 		=> array(
														__( 'Same Window', 'logoshowcase' ) => 'self',
														__( 'New Window', 'logoshowcase' ) 	=> 'blank',
													),
									'description' 	=> __( 'Choose link bahaviour.', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Title', 'logoshowcase' ),
									'param_name' 	=> 'show_title',
									'value' 		=> array(
															__( 'True', 'logoshowcase' ) 	=> 'true',
															__( 'False', 'logoshowcase' ) 	=> 'false',
														),
									'description' 	=> __( 'Display logo with title.', 'logoshowcase' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Tooltip', 'logoshowcase' ),
									'param_name' 	=> 'tooltip',
									'value' 		=> array(
															__( 'True', 'logoshowcase' ) 	=> 'true',
															__( 'False', 'logoshowcase' ) 	=> 'false',
														),
									'description' 	=> __( 'Display tooltip.', 'logoshowcase' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Words Limit', 'logoshowcase' ),
									'param_name' 	=> 'content_words_limit',
									'value' 		=> '25',
									'description' 	=> __( 'Control post content words limit.', 'logoshowcase' ),
									'dependency' 	=> array(
														'element' 	=> 'design',
														'value' 	=> array( 'design-4' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Tail', 'logoshowcase' ),
									'param_name' 	=> 'content_tail',
									'value' 		=> '...',
									'description' 	=> __( 'Display dots after the post content.', 'logoshowcase' ),
									'dependency' 	=> array(
														'element' 	=> 'design',
														'value' 	=> array( 'design-4' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'All Category Filter Text', 'logoshowcase' ),
									'param_name' 	=> 'all_filter_text',
									'value' 		=> __('All', 'logoshowcase'),
									'description' 	=> __( 'Control all category filter text.', 'logoshowcase' ),
								),

								// Data Settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Total items', 'logoshowcase' ),
									'param_name' 	=> 'limit',
									'value' 		=> 20,
									'description' 	=> __( 'Enter number of logo to be displayed. Enter -1 to display all.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Post Order By', 'logoshowcase' ),
									'param_name' 	=> 'orderby',
									'value' 		=> array(
														__( 'Post Date', 'logoshowcase' ) 			=> 'date',
														__( 'Post ID', 'logoshowcase' ) 			=> 'ID',
														__( 'Post Author', 'logoshowcase' ) 		=> 'author',
														__( 'Post Title', 'logoshowcase' ) 			=> 'title',
														__( 'Post Modified Date', 'logoshowcase' ) 	=> 'modified',
														__( 'Random', 'logoshowcase' ) 				=> 'rand',
														__( 'Menu Order', 'logoshowcase' ) 			=> 'menu_order',
													),
									'description' 	=> __( 'Select order type.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Post Sort order', 'logoshowcase' ),
									'param_name' 	=> 'order',
									'value' 		=> array(
														__( 'Descending', 'logoshowcase' ) 	=> 'desc',
														__( 'Ascending', 'logoshowcase' ) 	=> 'asc',
													),
									'description' 	=> __( 'Select sorting order.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Category Order By', 'logoshowcase' ),
									'param_name' 	=> 'cat_orderby',
									'value' 		=> array(
														__( 'Category Name', 'logoshowcase' ) 	=> 'name',
														__( 'Category ID', 'logoshowcase' ) 	=> 'term_id',
														__( 'Count', 'logoshowcase' ) 			=> 'count',
													),
									'description' 	=> __( 'Select category order type.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Category Sort order', 'logoshowcase' ),
									'param_name' 	=> 'cat_order',
									'value' 		=> array(
														__( 'Ascending', 'logoshowcase' ) 	=> 'asc',
														__( 'Descending', 'logoshowcase' ) 	=> 'desc',
													),
									'description' 	=> __( 'Select category sorting order.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Category', 'logoshowcase' ),
									'param_name' 	=> 'cat_id',
									'value' 		=> '',
									'description' 	=> __( 'Enter logo category id to display only specific categories.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Category', 'logoshowcase' ),
									'param_name' 	=> 'exclude_cat',
									'value' 		=> '',
									'description' 	=> __( 'Exclude logo category which you do not want to display.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Include Category Children', 'logoshowcase' ),
									'param_name' 	=> 'include_cat_child',
									'value' 		=> array(
														__( 'True', 'logoshowcase' ) 	=> 'true',
														__( 'False', 'logoshowcase' ) => 'false',
													),
									'description' 	=> __( 'Include category children or not.', 'logoshowcase' ),
									'group' 		=> __( 'Data Settings', 'logoshowcase' ),
								),
							)
		));
	}
}

$wpls_vc = new Wpls_Vc();