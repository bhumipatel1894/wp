<?php
/**
 * Visual Composer Class
 *
 * Handles the visual composer shortcode functionality of plugin
 *
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wprpsp_Vc {
	
	function __construct() {

		// Action to add 'recent_post_slider' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wprpsp_integrate_post_slider_vc') );

		// Action to add 'recent_post_carousel' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wprpsp_integrate_post_carousel_vc') );
		
		// Action to add 'gridbox_post_slider' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wprpsp_integrate_post_gridbox_vc') );
	}

	/**
	 * Function to add 'recent_post_slider' shortcode in vc
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.0.0
	 */
	function wprpsp_integrate_post_slider_vc() {
		vc_map( array(
			'name' 			=> 'WPOS - '.__( 'Recent Post Slider', 'wp-responsive-recent-post-slider' ),
			'base' 			=> 'recent_post_slider',
			'icon' 			=> 'icon-wpb-wp',
			'class' 		=> '',
			'category' 		=> __( 'Content', 'wp-responsive-recent-post-slider'),
			'description' 	=> __( 'Display Post in a slider view.', 'wp-responsive-recent-post-slider' ),
			'params' 	=> array(
								// General settings
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Design', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'design',
									'value' 		=> array(
															__( 'Slider Design 1', 'wp-responsive-recent-post-slider' ) 	=> 'design-1',
															__( 'Slider Design 2', 'wp-responsive-recent-post-slider' ) 	=> 'design-2',
															__( 'Slider Design 3', 'wp-responsive-recent-post-slider' ) 	=> 'design-3',
															__( 'Slider Design 4', 'wp-responsive-recent-post-slider' ) 	=> 'design-4',
															__( 'Slider Design 5', 'wp-responsive-recent-post-slider' ) 	=> 'design-5',
															__( 'Slider Design 6', 'wp-responsive-recent-post-slider' ) 	=> 'design-6',
															__( 'Slider Design 7', 'wp-responsive-recent-post-slider' ) 	=> 'design-7',
															__( 'Slider Design 8', 'wp-responsive-recent-post-slider' ) 	=> 'design-8',
															__( 'Slider Design 9', 'wp-responsive-recent-post-slider' ) 	=> 'design-9',
															__( 'Slider Design 10', 'wp-responsive-recent-post-slider' ) 	=> 'design-10',
															__( 'Slider Design 11', 'wp-responsive-recent-post-slider' ) 	=> 'design-11',
															__( 'Slider Design 12', 'wp-responsive-recent-post-slider' ) 	=> 'design-12',
															__( 'Slider Design 13', 'wp-responsive-recent-post-slider' ) 	=> 'design-13',
															__( 'Slider Design 14', 'wp-responsive-recent-post-slider' ) 	=> 'design-14',
															__( 'Slider Design 15', 'wp-responsive-recent-post-slider' ) 	=> 'design-15',
															__( 'Slider Design 16', 'wp-responsive-recent-post-slider' ) 	=> 'design-16',
															__( 'Slider Design 17', 'wp-responsive-recent-post-slider' ) 	=> 'design-17',
															__( 'Slider Design 18', 'wp-responsive-recent-post-slider' ) 	=> 'design-18',
															__( 'Slider Design 19', 'wp-responsive-recent-post-slider' ) 	=> 'design-19',
															__( 'Slider Design 20', 'wp-responsive-recent-post-slider' ) 	=> 'design-20',
															__( 'Slider Design 21', 'wp-responsive-recent-post-slider' ) 	=> 'design-21',
															__( 'Slider Design 22', 'wp-responsive-recent-post-slider' ) 	=> 'design-22',
															__( 'Slider Design 23', 'wp-responsive-recent-post-slider' ) 	=> 'design-23',
															__( 'Slider Design 24', 'wp-responsive-recent-post-slider' ) 	=> 'design-24',
															__( 'Slider Design 25', 'wp-responsive-recent-post-slider' ) 	=> 'design-25',
														),
									'description' 	=> __( 'Choose slider design.', 'wp-responsive-recent-post-slider' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Date', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'show_date',
									'value' 		=> array(
															__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
															__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
														),
									'description' 	=> __( 'Display date.', 'wp-responsive-recent-post-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Category', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'show_category_name',
									'value' 		=> array(
															__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
															__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
														),
									'description' 	=> __( 'Display post category.', 'wp-responsive-recent-post-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Author', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'show_author',
									'value' 		=> array(
															__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
															__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
														),
									'description' 	=> __( 'Display post author.', 'wp-responsive-recent-post-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Post Content', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'show_content',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Display post content. Note : Some of the designs does not have post content.', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Words Limit', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'content_words_limit',
									'value' 		=> '25',
									'description' 	=> __( 'Control post content words limit.', 'wp-responsive-recent-post-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'show_content',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Read More Button', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'show_read_more',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) => 'false',
													),
									'description' 	=> __( 'Display read more button.', 'wp-responsive-recent-post-slider' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Read More Button Text', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'read_more_text',
									'value' 		=> 'Read More',
									'description' 	=> __( 'Enter read more button text.', 'wp-responsive-recent-post-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'show_read_more',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Tail', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'content_tail',
									'value' 		=> '...',
									'description' 	=> __( 'Display dots after the post content.', 'wp-responsive-recent-post-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'show_content',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Link Behaviour', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'link_target',
									'value' 		=> array(
														__( 'Same Window', 'wp-responsive-recent-post-slider' ) 	=> 'self',
														__( 'New Window', 'wp-responsive-recent-post-slider' ) 	=> 'blank',
													),
									'description' 	=> __( 'Choose link bahaviour.', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Image Size', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'image_size',
									'value' 		=> 'full',
									'description' 	=> __( 'Enter image size which is generated by WordPress. e.g thumbnail, medium, large, full', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Image Fit', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'image_fit',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Fill the image in a whole container without leaving white or gray space.', 'wp-responsive-recent-post-slider' )
								),

								// Data Settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Post Type', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'post_type',
									'value' 		=> 'post',
									'description' 	=> __( 'Enter registered post type name. You can find it on plugin setting page. Note: Be sure you have added valid post type name otherwise no result will be displayed.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Taxonomy', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'taxonomy',
									'value' 		=> 'category',
									'description' 	=> __( 'Enter registered taxonomy name. You can find it on plugin setting page. Note: Be sure you have added valid taxonomy name otherwise no result will be displayed.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Total items', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'limit',
									'value' 		=> 15,
									'description' 	=> __( 'Enter number of post to be displayed. Enter -1 to display all.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Order By', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'orderby',
									'value' 		=> array(
														__( 'Post Date', 'wp-responsive-recent-post-slider' ) 			=> 'date',
														__( 'Post ID', 'wp-responsive-recent-post-slider' ) 			=> 'ID',
														__( 'Post Author', 'wp-responsive-recent-post-slider' ) 		=> 'author',
														__( 'Post Title', 'wp-responsive-recent-post-slider' ) 			=> 'title',
														__( 'Post Slug', 'wp-responsive-recent-post-slider' )	 		=> 'name',
														__( 'Post Modified Date', 'wp-responsive-recent-post-slider' ) 	=> 'modified',
														__( 'Random', 'wp-responsive-recent-post-slider' ) 				=> 'rand',
														__( 'Menu Order', 'wp-responsive-recent-post-slider' ) 			=> 'menu_order',
													),
									'description' 	=> __( 'Select order type.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Sort order', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'order',
									'value' 		=> array(
														__( 'Descending', 'wp-responsive-recent-post-slider' ) 	=> 'desc',
														__( 'Ascending', 'wp-responsive-recent-post-slider' ) 	=> 'asc',
													),
									'description' 	=> __( 'Select sorting order.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Category', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'category',
									'value' 		=> '',
									'description' 	=> __( 'Enter post category id to display post categories wise.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Category', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'exclude_cat',
									'value' 		=> '',
									'description' 	=> __( 'Exclude post category. Works only if `Category` field is empty.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Include Category Children', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'include_cat_child',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) => 'false',
													),
									'description' 	=> __( 'Include category children or not.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Display Specific Post', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'posts',
									'value' 		=> '',
									'description' 	=> __( 'Display specific posts.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Post', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'hide_post',
									'value' 		=> '',
									'description' 	=> __( 'Enter post id which you do not want to display.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Sticky Posts', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'sticky_posts',
									'value' 		=> array(
														__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
													),
									'description' 	=> __( 'Display sticky posts or not.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
								),

								// Slider Settings
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Dots', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'dots',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) => 'false',
													),
									'description' 	=> __( 'Show dots indicators.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Arrows', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'arrows',
									'value' 		=> array(
															__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
															__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
														),
									'description' 	=> __( 'Show Prev - Next arrows.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Autoplay', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'autoplay',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable autoplay.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Autoplay Interval', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'autoplay_interval',
									'value' 		=> '3000',
									'description' 	=> __( 'Enter autoplay speed.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Speed', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'speed',
									'value' 		=> '300',
									'description' 	=> __( 'Enter slide speed.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Infinite', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'loop',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable infinite loop sliding.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Fade Effect', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'fade',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable fade effect.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Slider Height', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'slider_height',
									'value' 		=> '',
									'description' 	=> __( 'Enter slider height. Leave empty for default. e.g 500', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' ),
								),
							)
		));
	}

	/**
	 * Function to add 'recent_post_carousel' shortcode in vc
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.0.0
	 */
	function wprpsp_integrate_post_carousel_vc() {
		vc_map( array(
			'name' 			=> 'WPOS - '.__( 'Recent Post Carousel', 'wp-responsive-recent-post-slider' ),
			'base' 			=> 'recent_post_carousel',
			'icon' 			=> 'icon-wpb-wp',
			'class' 		=> '',
			'category' 		=> __( 'Content', 'wp-responsive-recent-post-slider'),
			'description' 	=> __( 'Display Post in a carousel view.', 'wp-responsive-recent-post-slider' ),
			'params' 	=> array(
								// General settings
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Design', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'design',
									'value' 		=> array(
															__( 'Carousel Design 1', 'wp-responsive-recent-post-slider' ) 	=> 'design-1',
															__( 'Carousel Design 2', 'wp-responsive-recent-post-slider' ) 	=> 'design-2',
															__( 'Carousel Design 3', 'wp-responsive-recent-post-slider' ) 	=> 'design-3',
															__( 'Carousel Design 4', 'wp-responsive-recent-post-slider' ) 	=> 'design-4',
															__( 'Carousel Design 5', 'wp-responsive-recent-post-slider' ) 	=> 'design-5',
															__( 'Carousel Design 6', 'wp-responsive-recent-post-slider' ) 	=> 'design-6',
															__( 'Carousel Design 7', 'wp-responsive-recent-post-slider' ) 	=> 'design-7',
															__( 'Carousel Design 8', 'wp-responsive-recent-post-slider' ) 	=> 'design-8',
															__( 'Carousel Design 9', 'wp-responsive-recent-post-slider' ) 	=> 'design-9',
															__( 'Carousel Design 10', 'wp-responsive-recent-post-slider' ) 	=> 'design-10',
															__( 'Carousel Design 11', 'wp-responsive-recent-post-slider' ) 	=> 'design-11',
															__( 'Carousel Design 12', 'wp-responsive-recent-post-slider' ) 	=> 'design-12',
															__( 'Carousel Design 13', 'wp-responsive-recent-post-slider' ) 	=> 'design-13',
															__( 'Carousel Design 14', 'wp-responsive-recent-post-slider' ) 	=> 'design-14',
															__( 'Carousel Design 15', 'wp-responsive-recent-post-slider' ) 	=> 'design-15',
															__( 'Carousel Design 16', 'wp-responsive-recent-post-slider' ) 	=> 'design-16',
															__( 'Carousel Design 17', 'wp-responsive-recent-post-slider' ) 	=> 'design-17',
															__( 'Carousel Design 18', 'wp-responsive-recent-post-slider' ) 	=> 'design-18',
															__( 'Carousel Design 19', 'wp-responsive-recent-post-slider' ) 	=> 'design-19',
															__( 'Carousel Design 20', 'wp-responsive-recent-post-slider' ) 	=> 'design-20',
															__( 'Carousel Design 21', 'wp-responsive-recent-post-slider' ) 	=> 'design-21',
															__( 'Carousel Design 22', 'wp-responsive-recent-post-slider' ) 	=> 'design-22',
															__( 'Carousel Design 23', 'wp-responsive-recent-post-slider' ) 	=> 'design-23',
															__( 'Carousel Design 24', 'wp-responsive-recent-post-slider' ) 	=> 'design-24',
															__( 'Carousel Design 25', 'wp-responsive-recent-post-slider' ) 	=> 'design-25',
															__( 'Carousel Design 26', 'wp-responsive-recent-post-slider' ) 	=> 'design-26',
															__( 'Carousel Design 27', 'wp-responsive-recent-post-slider' ) 	=> 'design-27',
															__( 'Carousel Design 28', 'wp-responsive-recent-post-slider' ) 	=> 'design-28',
															__( 'Carousel Design 29', 'wp-responsive-recent-post-slider' ) 	=> 'design-29',
															__( 'Carousel Design 30', 'wp-responsive-recent-post-slider' ) 	=> 'design-30',
														),
									'description' 	=> __( 'Choose slider design.', 'wp-responsive-recent-post-slider' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Date', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'show_date',
									'value' 		=> array(
															__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
															__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
														),
									'description' 	=> __( 'Display date.', 'wp-responsive-recent-post-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Category', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'show_category_name',
									'value' 		=> array(
															__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
															__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
														),
									'description' 	=> __( 'Display post category.', 'wp-responsive-recent-post-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Author', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'show_author',
									'value' 		=> array(
															__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
															__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
														),
									'description' 	=> __( 'Display post author.', 'wp-responsive-recent-post-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Post Content', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'show_content',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Display post content. Note : Some of the designs does not have post content.', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Words Limit', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'content_words_limit',
									'value' 		=> '25',
									'description' 	=> __( 'Control post content words limit.', 'wp-responsive-recent-post-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'show_content',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Read More Button', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'show_read_more',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) => 'false',
													),
									'description' 	=> __( 'Display read more button.', 'wp-responsive-recent-post-slider' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Read More Button Text', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'read_more_text',
									'value' 		=> 'Read More',
									'description' 	=> __( 'Enter read more button text.', 'wp-responsive-recent-post-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'show_read_more',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Tail', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'content_tail',
									'value' 		=> '...',
									'description' 	=> __( 'Display dots after the post content.', 'wp-responsive-recent-post-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'show_content',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Link Behaviour', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'link_target',
									'value' 		=> array(
														__( 'Same Window', 'wp-responsive-recent-post-slider' ) 	=> 'self',
														__( 'New Window', 'wp-responsive-recent-post-slider' ) 	=> 'blank',
													),
									'description' 	=> __( 'Choose link bahaviour.', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Image Size', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'image_size',
									'value' 		=> 'full',
									'description' 	=> __( 'Enter image size which is generated by WordPress. e.g thumbnail, medium, large, full', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Image Height', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'image_height',
									'value' 		=> '',
									'description' 	=> __( 'Enter image height in px for example 300 OR 350', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Image Fit', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'image_fit',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Fill the image in a whole container without leaving white or gray space.', 'wp-responsive-recent-post-slider' )
								),

								// Data Settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Post Type', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'post_type',
									'value' 		=> 'post',
									'description' 	=> __( 'Enter registered post type name. You can find it on plugin setting page. Note: Be sure you have added valid post type name otherwise no result will be displayed.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Taxonomy', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'taxonomy',
									'value' 		=> 'category',
									'description' 	=> __( 'Enter registered taxonomy name. You can find it on plugin setting page. Note: Be sure you have added valid taxonomy name otherwise no result will be displayed.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Total items', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'limit',
									'value' 		=> 15,
									'description' 	=> __( 'Enter number of post to be displayed. Enter -1 to display all.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Order By', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'orderby',
									'value' 		=> array(
														__( 'Post Date', 'wp-responsive-recent-post-slider' ) 			=> 'date',
														__( 'Post ID', 'wp-responsive-recent-post-slider' ) 			=> 'ID',
														__( 'Post Author', 'wp-responsive-recent-post-slider' ) 		=> 'author',
														__( 'Post Title', 'wp-responsive-recent-post-slider' ) 			=> 'title',
														__( 'Post Slug', 'wp-responsive-recent-post-slider' )	 		=> 'name',
														__( 'Post Modified Date', 'wp-responsive-recent-post-slider' ) 	=> 'modified',
														__( 'Random', 'wp-responsive-recent-post-slider' ) 				=> 'rand',
														__( 'Menu Order', 'wp-responsive-recent-post-slider' ) 			=> 'menu_order',
													),
									'description' 	=> __( 'Select order type.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Sort order', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'order',
									'value' 		=> array(
														__( 'Descending', 'wp-responsive-recent-post-slider' ) 	=> 'desc',
														__( 'Ascending', 'wp-responsive-recent-post-slider' ) 	=> 'asc',
													),
									'description' 	=> __( 'Select sorting order.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Category', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'category',
									'value' 		=> '',
									'description' 	=> __( 'Enter post category id to display post categories wise.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Category', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'exclude_cat',
									'value' 		=> '',
									'description' 	=> __( 'Exclude post category. Works only if `Category` field is empty.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Include Category Children', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'include_cat_child',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) => 'false',
													),
									'description' 	=> __( 'Include category children or not.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Display Specific Post', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'posts',
									'value' 		=> '',
									'description' 	=> __( 'Display specific posts.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Post', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'hide_post',
									'value' 		=> '',
									'description' 	=> __( 'Enter post id which you do not want to display.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Sticky Posts', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'sticky_posts',
									'value' 		=> array(
														__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
													),
									'description' 	=> __( 'Display sticky posts or not.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
								),

								// Slider Settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Slides Column', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'slides_to_show',
									'value' 		=> '2',
									'description' 	=> __( 'Enter number of column for carousel.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Slides to Scroll', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'slides_to_scroll',
									'value' 		=> '1',
									'description' 	=> __( 'Enter number of slide to scroll at a time.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Dots', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'dots',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) => 'false',
													),
									'description' 	=> __( 'Show dots indicators.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Arrows', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'arrows',
									'value' 		=> array(
															__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
															__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
														),
									'description' 	=> __( 'Show Prev - Next arrows.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Autoplay', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'autoplay',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable autoplay.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Autoplay Interval', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'autoplay_interval',
									'value' 		=> '3000',
									'description' 	=> __( 'Enter autoplay speed.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Speed', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'speed',
									'value' 		=> '300',
									'description' 	=> __( 'Enter slide speed.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Infinite', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'loop',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable infinite loop sliding.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' ),
								),
							)
		));
	}
	

	/**
	 * Function to add 'gridbox_post_slider' shortcode in vc
	 * 
	 * @package WP Responsive Recent Post Gridbox Slider Pro
	 * @since 1.0.0
	 */
	function wprpsp_integrate_post_gridbox_vc() {
		vc_map( array(
			'name' 			=> 'WPOS - '.__( 'Recent Post Gridbox Slider', 'wp-responsive-recent-post-slider' ),
			'base' 			=> 'gridbox_post_slider',
			'icon' 			=> 'icon-wpb-wp',
			'class' 		=> '',
			'category' 		=> __( 'Content', 'wp-responsive-recent-post-slider'),
			'description' 	=> __( 'Display Post in a gridbox slider view.', 'wp-responsive-recent-post-slider' ),
			'params' 	=> array(
								// General settings
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Design', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'design',
									'value' 		=> array(
															__( 'Gridbox Design 1', 'wp-responsive-recent-post-slider' ) 	=> 'design-1',
															__( 'Gridbox Design 2', 'wp-responsive-recent-post-slider' ) 	=> 'design-2',
															__( 'Gridbox Design 3', 'wp-responsive-recent-post-slider' ) 	=> 'design-3',
															__( 'Gridbox Design 4', 'wp-responsive-recent-post-slider' ) 	=> 'design-4',
															__( 'Gridbox Design 5', 'wp-responsive-recent-post-slider' ) 	=> 'design-5',
															__( 'Gridbox Design 6', 'wp-responsive-recent-post-slider' ) 	=> 'design-6',
															__( 'Gridbox Design 7', 'wp-responsive-recent-post-slider' ) 	=> 'design-7',
															__( 'Gridbox Design 8', 'wp-responsive-recent-post-slider' ) 	=> 'design-8',															
														),
									'description' 	=> __( 'Choose gridbox slider design.', 'wp-responsive-recent-post-slider' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Date', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'show_date',
									'value' 		=> array(
															__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
															__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
														),
									'description' 	=> __( 'Display date.', 'wp-responsive-recent-post-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Category', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'show_category_name',
									'value' 		=> array(
															__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
															__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
														),
									'description' 	=> __( 'Display post category.', 'wp-responsive-recent-post-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Author', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'show_author',
									'value' 		=> array(
															__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
															__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
														),
									'description' 	=> __( 'Display post author.', 'wp-responsive-recent-post-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Post Content', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'show_content',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Display post content. Note : Some of the designs does not have post content.', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Words Limit', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'content_words_limit',
									'value' 		=> '25',
									'description' 	=> __( 'Control post content words limit.', 'wp-responsive-recent-post-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'show_content',
														'value' 	=> array( 'true' ),
														),
								),							
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Tail', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'content_tail',
									'value' 		=> '...',
									'description' 	=> __( 'Display dots after the post content.', 'wp-responsive-recent-post-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'show_content',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Link Behaviour', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'link_target',
									'value' 		=> array(
														__( 'Same Window', 'wp-responsive-recent-post-slider' ) 	=> 'self',
														__( 'New Window', 'wp-responsive-recent-post-slider' ) 	=> 'blank',
													),
									'description' 	=> __( 'Choose link bahaviour.', 'wp-responsive-recent-post-slider' ),
								),								
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Image Height', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'image_height',
									'value' 		=> '',
									'description' 	=> __( 'Enter image height in px for example 300 OR 350', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Image Fit', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'image_fit',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Fill the image in a whole container without leaving white or gray space.', 'wp-responsive-recent-post-slider' )
								),

								// Data Settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Post Type', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'post_type',
									'value' 		=> 'post',
									'description' 	=> __( 'Enter registered post type name. You can find it on plugin setting page. Note: Be sure you have added valid post type name otherwise no result will be displayed.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Taxonomy', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'taxonomy',
									'value' 		=> 'category',
									'description' 	=> __( 'Enter registered taxonomy name. You can find it on plugin setting page. Note: Be sure you have added valid taxonomy name otherwise no result will be displayed.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Total items', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'limit',
									'value' 		=> 15,
									'description' 	=> __( 'Enter number of post to be displayed. Enter -1 to display all.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Order By', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'orderby',
									'value' 		=> array(
														__( 'Post Date', 'wp-responsive-recent-post-slider' ) 			=> 'date',
														__( 'Post ID', 'wp-responsive-recent-post-slider' ) 			=> 'ID',
														__( 'Post Author', 'wp-responsive-recent-post-slider' ) 		=> 'author',
														__( 'Post Title', 'wp-responsive-recent-post-slider' ) 			=> 'title',
														__( 'Post Slug', 'wp-responsive-recent-post-slider' )	 		=> 'name',
														__( 'Post Modified Date', 'wp-responsive-recent-post-slider' ) 	=> 'modified',
														__( 'Random', 'wp-responsive-recent-post-slider' ) 				=> 'rand',
														__( 'Menu Order', 'wp-responsive-recent-post-slider' ) 			=> 'menu_order',
													),
									'description' 	=> __( 'Select order type.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Sort order', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'order',
									'value' 		=> array(
														__( 'Descending', 'wp-responsive-recent-post-slider' ) 	=> 'desc',
														__( 'Ascending', 'wp-responsive-recent-post-slider' ) 	=> 'asc',
													),
									'description' 	=> __( 'Select sorting order.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Category', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'category',
									'value' 		=> '',
									'description' 	=> __( 'Enter post category id to display post categories wise.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Category', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'exclude_cat',
									'value' 		=> '',
									'description' 	=> __( 'Exclude post category. Works only if `Category` field is empty.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Include Category Children', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'include_cat_child',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) => 'false',
													),
									'description' 	=> __( 'Include category children or not.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Display Specific Post', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'posts',
									'value' 		=> '',
									'description' 	=> __( 'Display specific posts.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Post', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'hide_post',
									'value' 		=> '',
									'description' 	=> __( 'Enter post id which you do not want to display.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Sticky Posts', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'sticky_posts',
									'value' 		=> array(
														__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
													),
									'description' 	=> __( 'Display sticky posts or not.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-responsive-recent-post-slider' ),
								),

								// Slider Settings	
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Fade Effect', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'fade',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable fade effect.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' ),
								),	
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Dots', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'dots',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) => 'false',
													),
									'description' 	=> __( 'Show dots indicators.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Arrows', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'arrows',
									'value' 		=> array(
															__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
															__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
														),
									'description' 	=> __( 'Show Prev - Next arrows.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Autoplay', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'autoplay',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable autoplay.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Autoplay Interval', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'autoplay_interval',
									'value' 		=> '3000',
									'description' 	=> __( 'Enter autoplay speed.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Speed', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'speed',
									'value' 		=> '300',
									'description' 	=> __( 'Enter slide speed.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Infinite', 'wp-responsive-recent-post-slider' ),
									'param_name' 	=> 'loop',
									'value' 		=> array(
														__( 'True', 'wp-responsive-recent-post-slider' ) 	=> 'true',
														__( 'False', 'wp-responsive-recent-post-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable infinite loop sliding.', 'wp-responsive-recent-post-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-responsive-recent-post-slider' ),
								),
							)
		));
	}
}

$wprpsp_vc = new Wprpsp_Vc();