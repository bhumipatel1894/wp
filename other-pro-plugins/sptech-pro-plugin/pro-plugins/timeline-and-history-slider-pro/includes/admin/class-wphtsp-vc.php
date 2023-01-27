<?php
/**
 * Visual Composer Class
 *
 * Handles the visual composer shortcode functionality of plugin
 *
 * @package WP History and Timeline Slider Pro
 * @since 1.0.4
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class wphtsp_vc {
	
	function __construct() {

		// Action to add 'th-slider' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wphtsp_integrate_history_slider_vc') );

		// Action to add 'th-history' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wphtsp_integrate_vertical_history_vc') );
	}

	/**
	 * Function to add 'th-slider' shortcode in vc
	 * 
	 * @package WP History and Timeline Slider Pro
	 * @since 1.0.4
	 */
	function wphtsp_integrate_history_slider_vc() {
		vc_map( array(
			'name' 			=> __( 'WPOS - Timeline and History Slider', 'timeline-and-history-slider' ),
			'base' 			=> 'th-slider',
			'icon' 			=> 'icon-wpb-wp',
			'class' 		=> '',
			'category' 		=> __( 'Content', 'timeline-and-history-slider'),
			'description' 	=> __( 'Display post in a horizontal slider view.', 'timeline-and-history-slider' ),
			'params' 	=> array(
								// General settings
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Design', 'timeline-and-history-slider' ),
									'param_name' 	=> 'design',
									'value' 		=> array(
															__( 'History Slider Design 1', 'timeline-and-history-slider' ) 	=> 'design-1',
															__( 'History Slider Design 2', 'timeline-and-history-slider' ) 	=> 'design-2',
															__( 'History Slider Design 3', 'timeline-and-history-slider' ) 	=> 'design-3',
															__( 'History Slider Design 4', 'timeline-and-history-slider' ) 	=> 'design-4',
															__( 'History Slider Design 5', 'timeline-and-history-slider' ) 	=> 'design-5',
															__( 'History Slider Design 6', 'timeline-and-history-slider' ) 	=> 'design-6',
														),
									'description' 	=> __( 'Choose History Slider Design.', 'timeline-and-history-slider' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Title', 'timeline-and-history-slider' ),
									'param_name' 	=> 'show_title',
									'value' 		=> array(
														__( 'True', 'timeline-and-history-slider' ) 	=> 'true',
														__( 'False', 'timeline-and-history-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Display post title.', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Date', 'timeline-and-history-slider' ),
									'param_name' 	=> 'show_date',
									'value' 		=> array(
															__( 'True', 'timeline-and-history-slider' ) 	=> 'true',
															__( 'False', 'timeline-and-history-slider' ) 	=> 'false',
														),
									'description' 	=> __( 'Display post date.', 'timeline-and-history-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Post Content', 'timeline-and-history-slider' ),
									'param_name' 	=> 'show_content',
									'value' 		=> array(
														__( 'True', 'timeline-and-history-slider' ) 	=> 'true',
														__( 'False', 'timeline-and-history-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Display post content.', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Post Full Content', 'timeline-and-history-slider' ),
									'param_name' 	=> 'show_full_content',
									'value' 		=> array(
														__( 'False', 'timeline-and-history-slider' ) 	=> 'false',
														__( 'True', 'timeline-and-history-slider' ) 	=> 'true',
													),
									'description' 	=> __( 'Display post full content.', 'timeline-and-history-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'show_content',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Words Limit', 'timeline-and-history-slider' ),
									'param_name' 	=> 'content_words_limit',
									'value' 		=> '70',
									'description' 	=> __( 'Control post content words limit.', 'timeline-and-history-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'show_full_content',
														'value' 	=> array( 'false' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Tail', 'timeline-and-history-slider' ),
									'param_name' 	=> 'content_tail',
									'value' 		=> '...',
									'description' 	=> __('Display dots after the post content as continue reading.', 'timeline-and-history-slider'),
									'dependency' 	=> array(
														'element' 	=> 'show_full_content',
														'value' 	=> array( 'false' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Read More Button', 'timeline-and-history-slider' ),
									'param_name' 	=> 'show_read_more',
									'value' 		=> array(
														__( 'True', 'timeline-and-history-slider' ) 	=> 'true',
														__( 'False', 'timeline-and-history-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Display read more button.', 'timeline-and-history-slider' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Read More Button Text', 'timeline-and-history-slider' ),
									'param_name' 	=> 'read_more_text',
									'value' 		=> __('Read More', 'timeline-and-history-slider'),
									'description' 	=> __( 'Enter read more button text.', 'timeline-and-history-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'show_read_more',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Link', 'timeline-and-history-slider' ),
									'param_name' 	=> 'link',
									'value' 		=> array(
														__( 'True', 'timeline-and-history-slider' ) 	=> 'true',
														__( 'False', 'timeline-and-history-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable post link to title, icon and feature image.', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Link Behaviour', 'timeline-and-history-slider' ),
									'param_name' 	=> 'link_target',
									'value' 		=> array(
														__( 'Same Window', 'timeline-and-history-slider' ) 	=> 'self',
														__( 'New Window', 'timeline-and-history-slider' ) 	=> 'blank',
													),
									'description' 	=> __( 'Choose link bahaviour.', 'timeline-and-history-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'link',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Image Size', 'timeline-and-history-slider' ),
									'param_name' 	=> 'image_size',
									'value' 		=> 'full',
									'description' 	=> __( 'Entered WordPress registered image size. e.g thumbnail, medium, large OR full', 'timeline-and-history-slider' ),
								),

								// Design Settings
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Image Position', 'timeline-and-history-slider' ),
									'param_name' 	=> 'image_position',
									'value' 		=> array(
														__( 'Left', 'timeline-and-history-slider' ) 	=> 'left',
														__( 'Right', 'timeline-and-history-slider' ) 	=> 'right',
														__( 'Top', 'timeline-and-history-slider' ) 		=> 'top',
														__( 'Bottom', 'timeline-and-history-slider' ) 	=> 'bottom',
													),
									'description' 	=> __( 'Set feature image position.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Design Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'colorpicker',
									'class' 		=> '',
									'heading' 		=> __( 'Background Color', 'timeline-and-history-slider' ),
									'param_name' 	=> 'background_color',
									'value' 		=> '',
									'description' 	=> __( 'Set post background color.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Design Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'colorpicker',
									'class' 		=> '',
									'heading' 		=> __( 'Font Color', 'timeline-and-history-slider' ),
									'param_name' 	=> 'font_color',
									'value' 		=> '',
									'description' 	=> __( 'Set font color.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Design Settings', 'timeline-and-history-slider' ),
								),

								// Data Settings
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Post Type', 'timeline-and-history-slider' ),
									'param_name' 	=> 'post_type',
									'value' 		=> array(
															__( 'Select Post Type', 'timeline-and-history-slider' ) 				=> '',
															__( 'Post (WordPress Default Post)', 'timeline-and-history-slider' ) 	=> 'post',
														),
									'description' 	=> __( 'Select post type. Leave empty to work with `timeline` post.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Data Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Total items', 'timeline-and-history-slider' ),
									'param_name' 	=> 'limit',
									'value' 		=> -1,
									'description' 	=> __( 'Enter number of post to be displayed. Enter -1 to display all.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Data Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Order By', 'timeline-and-history-slider' ),
									'param_name' 	=> 'orderby',
									'value' 		=> array(
														__( 'Post Date', 'timeline-and-history-slider' ) 			=> 'date',
														__( 'Post ID', 'timeline-and-history-slider' ) 				=> 'ID',
														__( 'Post Author', 'timeline-and-history-slider' ) 			=> 'author',
														__( 'Post Title', 'timeline-and-history-slider' ) 			=> 'title',
														__( 'Post Slug', 'timeline-and-history-slider' )	 		=> 'name',
														__( 'Post Modified Date', 'timeline-and-history-slider' ) 	=> 'modified',
														__( 'Random', 'timeline-and-history-slider' ) 				=> 'rand',
														__( 'Menu Order', 'timeline-and-history-slider' ) 			=> 'menu_order',
													),
									'description' 	=> __( 'Select order type.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Data Settings', 'timeline-and-history-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Sort order', 'timeline-and-history-slider' ),
									'param_name' 	=> 'order',
									'value' 		=> array(
														__( 'Descending', 'timeline-and-history-slider' ) 	=> 'desc',
														__( 'Ascending', 'timeline-and-history-slider' ) 	=> 'asc',
													),
									'description' 	=> __( 'Select sorting order.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Data Settings', 'timeline-and-history-slider' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Category', 'timeline-and-history-slider' ),
									'param_name' 	=> 'category',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Enter post category id to display categories wise. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can enter multiple ids with comma seperated.', 'timeline-and-history-slider'), add_query_arg(array('taxonomy' => WPHTSP_PRO_CAT, 'post_type' => WPHTSP_PRO_POST_TYPE), 'edit-tags.php')),
									'group' 		=> __( 'Data Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Category', 'timeline-and-history-slider' ),
									'param_name' 	=> 'exclude_cat',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Exclude post category. Works only if `Category` field is empty. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can enter multiple ids with comma seperated.', 'timeline-and-history-slider'), add_query_arg(array('taxonomy' => WPHTSP_PRO_CAT, 'post_type' => WPHTSP_PRO_POST_TYPE), 'edit-tags.php')),
									'group' 		=> __( 'Data Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Include Category Children', 'timeline-and-history-slider' ),
									'param_name' 	=> 'include_cat_child',
									'value' 		=> array(
														__( 'True', 'timeline-and-history-slider' ) 	=> 'true',
														__( 'False', 'timeline-and-history-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Include category children or not.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Data Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Posts', 'timeline-and-history-slider' ),
									'param_name' 	=> 'posts',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Display specific posts. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can enter multiple ids with comma seperated.', 'timeline-and-history-slider'), add_query_arg(array('post_type' => WPHTSP_PRO_POST_TYPE), 'edit.php')),
									'group' 		=> __( 'Data Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Post', 'timeline-and-history-slider' ),
									'param_name' 	=> 'exclude_post',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Enter post id which you do not want to display. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can enter multiple ids with comma seperated.', 'timeline-and-history-slider'), add_query_arg(array('post_type' => WPHTSP_PRO_POST_TYPE), 'edit.php')),
									'group' 		=> __( 'Data Settings', 'timeline-and-history-slider' ),
								),

								// Slider Settings
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Dots', 'timeline-and-history-slider' ),
									'param_name' 	=> 'dots',
									'value' 		=> array(
															__( 'True', 'timeline-and-history-slider' ) 	=> 'true',
															__( 'False', 'timeline-and-history-slider' ) => 'false',
													),
									'description' 	=> __( 'Show slider dots indicators.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Slider Settings', 'timeline-and-history-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Arrows', 'timeline-and-history-slider' ),
									'param_name' 	=> 'arrows',
									'value' 		=> array(
															__( 'True', 'timeline-and-history-slider' ) 	=> 'true',
															__( 'False', 'timeline-and-history-slider' ) 	=> 'false',
														),
									'description' 	=> __( 'Show slider Prev - Next arrows.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Slider Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Autoplay', 'timeline-and-history-slider' ),
									'param_name' 	=> 'autoplay',
									'value' 		=> array(
															__( 'True', 'timeline-and-history-slider' ) 	=> 'true',
															__( 'False', 'timeline-and-history-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable slider autoplay.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Slider Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Autoplay Interval', 'timeline-and-history-slider' ),
									'param_name' 	=> 'autoplay_interval',
									'value' 		=> '3000',
									'description' 	=> __( 'Enter slider autoplay speed.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Slider Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Speed', 'timeline-and-history-slider' ),
									'param_name' 	=> 'speed',
									'value' 		=> '300',
									'description' 	=> __( 'Enter slide speed.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Slider Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Number of Slides', 'timeline-and-history-slider' ),
									'param_name' 	=> 'slidestoshow',
									'value' 		=> '3',
									'description' 	=> __( 'Enter number of slide columns.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Slider Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Slider First Slide', 'timeline-and-history-slider' ),
									'param_name' 	=> 'first_slide',
									'value' 		=> '0',
									'description' 	=> __( 'Enter number of slide that you want to display first. Slider will initialize from that slide.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Slider Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Slider Fade Effect', 'timeline-and-history-slider' ),
									'param_name' 	=> 'fade',
									'value' 		=> array(
															__( 'False', 'timeline-and-history-slider' ) 	=> 'false',
															__( 'True', 'timeline-and-history-slider' ) 	=> 'true',
															),
									'description' 	=> __( 'Enable slider fade effect.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Slider Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Slider Adaptive Height', 'timeline-and-history-slider' ),
									'param_name' 	=> 'adaptiveheight',
									'value' 		=> array(
															__( 'True', 'timeline-and-history-slider' ) 	=> 'true',
															__( 'False', 'timeline-and-history-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Auto slider height. `False` will set default slider height.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Slider Settings', 'timeline-and-history-slider' ),
								),
							)
		));
	}

	/**
	 * Function to add 'th-history' shortcode in vc
	 * 
	 * @package WP History and Timeline Slider Pro
	 * @since 1.0.4
	 */
	function wphtsp_integrate_vertical_history_vc() {
		vc_map( array(
			'name' 			=> __( 'WPOS - Timeline and History Vertical', 'timeline-and-history-slider' ),
			'base' 			=> 'th-history',
			'icon' 			=> 'icon-wpb-wp',
			'class' 		=> '',
			'category' 		=> __( 'Content', 'timeline-and-history-slider'),
			'description' 	=> __( 'Display post in a vertical history view.', 'timeline-and-history-slider' ),
			'params' 	=> array(
								// General settings
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Design', 'timeline-and-history-slider' ),
									'param_name' 	=> 'design',
									'value' 		=> array(
															__( 'History Vertical Design 1', 'timeline-and-history-slider' ) 	=> 'design-1',
															__( 'History Vertical Design 2', 'timeline-and-history-slider' ) 	=> 'design-2',
															__( 'History Vertical Design 3', 'timeline-and-history-slider' ) 	=> 'design-3',
															__( 'History Vertical Design 4', 'timeline-and-history-slider' ) 	=> 'design-4',
															__( 'History Vertical Design 5', 'timeline-and-history-slider' ) 	=> 'design-5',
															__( 'History Vertical Design 6', 'timeline-and-history-slider' ) 	=> 'design-6',
															__( 'History Vertical Design 7', 'timeline-and-history-slider' ) 	=> 'design-7',
														),
									'description' 	=> __( 'Choose timeline history vertical design.', 'timeline-and-history-slider' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Title', 'timeline-and-history-slider' ),
									'param_name' 	=> 'show_title',
									'value' 		=> array(
														__( 'True', 'timeline-and-history-slider' ) 	=> 'true',
														__( 'False', 'timeline-and-history-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Display post title.', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Date', 'timeline-and-history-slider' ),
									'param_name' 	=> 'show_date',
									'value' 		=> array(
															__( 'True', 'timeline-and-history-slider' ) 	=> 'true',
															__( 'False', 'timeline-and-history-slider' ) 	=> 'false',
														),
									'description' 	=> __( 'Display post date.', 'timeline-and-history-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Post Content', 'timeline-and-history-slider' ),
									'param_name' 	=> 'show_content',
									'value' 		=> array(
															__( 'True', 'timeline-and-history-slider' ) 	=> 'true',
															__( 'False', 'timeline-and-history-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Display post content.', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Post Full Content', 'timeline-and-history-slider' ),
									'param_name' 	=> 'show_full_content',
									'value' 		=> array(
															__( 'False', 'timeline-and-history-slider' ) 	=> 'false',
															__( 'True', 'timeline-and-history-slider' ) 	=> 'true',
													),
									'description' 	=> __( 'Display post Full Content.', 'timeline-and-history-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'show_content',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Words Limit', 'timeline-and-history-slider' ),
									'param_name' 	=> 'content_words_limit',
									'value' 		=> '70',
									'description' 	=> __( 'Control post content words limit.', 'timeline-and-history-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'show_full_content',
														'value' 	=> array( 'false' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Tail', 'timeline-and-history-slider' ),
									'param_name' 	=> 'content_tail',
									'value' 		=> '...',
									'description' 	=> __('Display dots after the post content as continue reading.', 'timeline-and-history-slider'),
									'dependency' 	=> array(
															'element' 	=> 'show_full_content',
															'value' 	=> array( 'false' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Read More Button', 'timeline-and-history-slider' ),
									'param_name' 	=> 'show_read_more',
									'value' 		=> array(
														__( 'True', 'timeline-and-history-slider' ) 	=> 'true',
														__( 'False', 'timeline-and-history-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Display read more button.', 'timeline-and-history-slider' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Read More Button Text', 'timeline-and-history-slider' ),
									'param_name' 	=> 'read_more_text',
									'value' 		=> __('Read More', 'timeline-and-history-slider'),
									'description' 	=> __( 'Enter read more button text.', 'timeline-and-history-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'show_read_more',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Link', 'timeline-and-history-slider' ),
									'param_name' 	=> 'link',
									'value' 		=> array(
														__( 'True', 'timeline-and-history-slider' ) 	=> 'true',
														__( 'False', 'timeline-and-history-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable post link to title, icon and feature image.', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Link Behaviour', 'timeline-and-history-slider' ),
									'param_name' 	=> 'link_target',
									'value' 		=> array(
															__( 'Same Window', 'timeline-and-history-slider' ) 	=> 'self',
															__( 'New Window', 'timeline-and-history-slider' ) 	=> 'blank',
													),
									'description' 	=> __( 'Choose link bahaviour.', 'timeline-and-history-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'link',
														'value' 	=> array( 'true' ),
													),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Image Size', 'timeline-and-history-slider' ),
									'param_name' 	=> 'image_size',
									'value' 		=> 'full',
									'description' 	=> __( 'Entered WordPress registered image size. e.g thumbnail, medium, large OR full', 'timeline-and-history-slider' ),
								),

								// Design Settings
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Animation', 'timeline-and-history-slider' ),
									'param_name' 	=> 'animation',
									'value' 		=> array(
															__( 'Select Animation', 'timeline-and-history-slider' ) => 'no-animation',
															__( 'BounceIn', 'timeline-and-history-slider' ) 		=> 'bounce-in',
															__( 'BounceInUp', 'timeline-and-history-slider' ) 		=> 'bounceInUp',
															__( 'BounceInDown', 'timeline-and-history-slider' )		=> 'bounceInDown',
															__( 'FadeInDown', 'timeline-and-history-slider' ) 		=> 'fadeInDown',
															__( 'FadeInUp', 'timeline-and-history-slider' ) 		=> 'fadeInUp',
															__( 'FlipInX', 'timeline-and-history-slider' ) 			=> 'flipInX',
															__( 'FlipInY', 'timeline-and-history-slider' ) 			=> 'flipInY',
															__( 'ZoomIn', 'timeline-and-history-slider' ) 			=> 'zoomIn',
														),
									'description' 	=> __( 'Choose animation.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Design Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'colorpicker',
									'class' 		=> '',
									'heading' 		=> __( 'Background Color', 'timeline-and-history-slider' ),
									'param_name' 	=> 'background_color',
									'value' 		=> '',
									'description' 	=> __( 'Select post background color.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Design Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'colorpicker',
									'class' 		=> '',
									'heading' 		=> __( 'Font Color', 'timeline-and-history-slider' ),
									'param_name' 	=> 'font_color',
									'value' 		=> '',
									'description' 	=> __( 'Set font color.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Design Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'colorpicker',
									'class' 		=> '',
									'heading' 		=> __( 'Fa Icon Color', 'timeline-and-history-slider' ),
									'param_name' 	=> 'fa_icon_color',
									'value' 		=> '',
									'description' 	=> __( 'Set fa icon color.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Design Settings', 'timeline-and-history-slider' ),
								),

								// Data Settings
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Post Type', 'timeline-and-history-slider' ),
									'param_name' 	=> 'post_type',
									'value' 		=> array(
															__( 'Select Post Type', 'timeline-and-history-slider' ) 				=> '',
															__( 'Post (WordPress Default Post)', 'timeline-and-history-slider' ) 	=> 'post',
														),
									'description' 	=> __( 'Select post type. Leave empty to work with `timeline` post.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Data Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Total items', 'timeline-and-history-slider' ),
									'param_name' 	=> 'limit',
									'value' 		=> '-1',
									'description' 	=> __( 'Enter number of post to be displayed. Enter -1 to display all.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Data Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Order By', 'timeline-and-history-slider' ),
									'param_name' 	=> 'orderby',
									'value' 		=> array(
															__( 'Post Date', 'timeline-and-history-slider' ) 			=> 'date',
															__( 'Post ID', 'timeline-and-history-slider' ) 				=> 'ID',
															__( 'Post Author', 'timeline-and-history-slider' ) 			=> 'author',
															__( 'Post Title', 'timeline-and-history-slider' ) 			=> 'title',
															__( 'Post Slug', 'timeline-and-history-slider' )	 		=> 'name',
															__( 'Post Modified Date', 'timeline-and-history-slider' ) 	=> 'modified',
															__( 'Random', 'timeline-and-history-slider' ) 				=> 'rand',
															__( 'Menu Order', 'timeline-and-history-slider' ) 			=> 'menu_order',
													),
									'description' 	=> __( 'Select order type.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Data Settings', 'timeline-and-history-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Sort order', 'timeline-and-history-slider' ),
									'param_name' 	=> 'order',
									'value' 		=> array(
															__( 'Descending', 'timeline-and-history-slider' ) 	=> 'desc',
															__( 'Ascending', 'timeline-and-history-slider' ) 	=> 'asc',
													),
									'description' 	=> __( 'Select sorting order.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Data Settings', 'timeline-and-history-slider' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Category', 'timeline-and-history-slider' ),
									'param_name' 	=> 'category',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Enter post category id to display categories wise. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can enter multiple ids with comma seperated.', 'timeline-and-history-slider'), add_query_arg(array('taxonomy' => WPHTSP_PRO_CAT, 'post_type' => WPHTSP_PRO_POST_TYPE), 'edit-tags.php')),
									'group' 		=> __( 'Data Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Category', 'timeline-and-history-slider' ),
									'param_name' 	=> 'exclude_cat',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Exclude post category. Works only if `Category` field is empty. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can enter multiple ids with comma seperated.', 'timeline-and-history-slider'), add_query_arg(array('taxonomy' => WPHTSP_PRO_CAT, 'post_type' => WPHTSP_PRO_POST_TYPE), 'edit-tags.php')),
									'group' 		=> __( 'Data Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Include Category Children', 'timeline-and-history-slider' ),
									'param_name' 	=> 'include_cat_child',
									'value' 		=> array(
															__( 'True', 'timeline-and-history-slider' ) 	=> 'true',
															__( 'False', 'timeline-and-history-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Include category children or not.', 'timeline-and-history-slider' ),
									'group' 		=> __( 'Data Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Display Specific Post', 'timeline-and-history-slider' ),
									'param_name' 	=> 'posts',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Display specific posts. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can enter multiple ids with comma seperated.', 'timeline-and-history-slider'), add_query_arg(array('post_type' => WPHTSP_PRO_POST_TYPE), 'edit.php')),
									'group' 		=> __( 'Data Settings', 'timeline-and-history-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Post', 'timeline-and-history-slider' ),
									'param_name' 	=> 'exclude_post',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Enter post id which you do not want to display. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can enter multiple ids with comma seperated.', 'timeline-and-history-slider'), add_query_arg(array('post_type' => WPHTSP_PRO_POST_TYPE), 'edit.php')),
									'group' 		=> __( 'Data Settings', 'timeline-and-history-slider' ),
								),
							)
		));
	}
}

$wphtsp_vc = new wphtsp_vc();