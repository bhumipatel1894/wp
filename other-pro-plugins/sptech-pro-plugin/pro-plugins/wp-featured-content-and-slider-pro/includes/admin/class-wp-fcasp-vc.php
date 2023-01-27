<?php
/**
 * Visual Composer Class
 *
 * Handles the visual composer shortcode functionality of plugin
 *
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wp_Fcasp_Vc {
	
	function __construct() {

		// Action to add 'featured-cnt-img' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wp_fcasp_integrate_fc_img_vc') );

		// Action to add 'featured-cnt-icon' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wp_fcasp_integrate_fc_icon_vc') );

		// Action to add 'featured-cnt-icon-img' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wp_fcasp_integrate_fc_icon_img_vc') );
	}
	
	/**
	 * Function to add 'featured-cnt-img' shortcode in vc
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_integrate_fc_img_vc() {
		vc_map( array(
			'name' 			=> __( 'WPOS - FC With Image', 'wp-featured-content-and-slider' ),
			'base' 			=> 'featured-cnt-img',
			'icon' 			=> 'icon-wpb-wp',
			'class' 		=> '',
			'category' 		=> __( 'Content', 'wp-featured-content-and-slider'),
			'description' 	=> __( 'Display featured content with image.', 'wp-featured-content-and-slider' ),
			'params' 	=> array(
								// General settings
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Type', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'type',
									'value' 		=> array(
														__( 'Grid', 'wp-featured-content-and-slider' ) 		=> 'grid',
														__( 'Slider', 'wp-featured-content-and-slider' ) 	=> 'slider',
													),
									'description' 	=> __( 'Display featured content in a grid or slider.', 'wp-featured-content-and-slider' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Design', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'design',
									'value' 		=> array(
															__( 'FC Image Design 1', 'wp-featured-content-and-slider' ) 	=> 'design-10',
															__( 'FC Image Design 2', 'wp-featured-content-and-slider' ) 	=> 'design-11',
															__( 'FC Image Design 3', 'wp-featured-content-and-slider' ) 	=> 'design-12',
															__( 'FC Image Design 4', 'wp-featured-content-and-slider' ) 	=> 'design-13',
															__( 'FC Image Design 5', 'wp-featured-content-and-slider' ) 	=> 'design-14',
															__( 'FC Image Design 6', 'wp-featured-content-and-slider' ) 	=> 'design-15',
															__( 'FC Image Design 7', 'wp-featured-content-and-slider' ) 	=> 'design-16',
															__( 'FC Image Design 8', 'wp-featured-content-and-slider' ) 	=> 'design-17',
															__( 'FC Image Design 9', 'wp-featured-content-and-slider' ) 	=> 'design-18',
															__( 'FC Image Design 10', 'wp-featured-content-and-slider' ) 	=> 'design-19',
														),
									'description' 	=> __( 'Display featured content in a grid or slider. Note: Design 4 and Design 6 will not work with slider.', 'wp-featured-content-and-slider' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Grid Elements Per Row', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'grid',
									'value' 		=> array(
															__( 'One Column', 'wp-featured-content-and-slider' ) 	=> '1',
															__( 'Two Column', 'wp-featured-content-and-slider' ) 	=> '2',
															__( 'Third Column', 'wp-featured-content-and-slider' ) 	=> '3',
															__( 'Four Column', 'wp-featured-content-and-slider' ) 	=> '4',
														),
									'std'			=> '2',
									'dependency' 	=> array(
															'element' 	=> 'type',
															'value' 	=> array( 'grid' ),
														),
									'description' 	=> __( 'Select number of grid elements per row.', 'wp-featured-content-and-slider' )
								),
								array(
									'type' 			=> 'colorpicker',
									'class' 		=> '',
									'heading' 		=> __( 'Icon Color', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'fa_icon_color',
									'value' 		=> '#3ab0e2',
									'description' 	=> __( 'Choose font icon color.', 'wp-featured-content-and-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Read More Button', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'display_read_more',
									'value' 		=> array(
														__( 'True', 'wp-featured-content-and-slider' ) 	=> 'true',
														__( 'False', 'wp-featured-content-and-slider' ) => 'false',
													),
									'description' 	=> __( 'Display read more button.', 'wp-featured-content-and-slider' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Read More Button Text', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'read_more_text',
									'value' 		=> 'Read More',
									'description' 	=> __( 'Enter read more button text.', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'display_read_more',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Post Content', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'show_content',
									'value' 		=> array(
														__( 'True', 'wp-featured-content-and-slider' ) 	=> 'true',
														__( 'False', 'wp-featured-content-and-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Show featured content post content.', 'wp-featured-content-and-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Words Limit', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'content_words_limit',
									'value' 		=> '25',
									'description' 	=> __( 'Control featured post content words limit.', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'show_content',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Tail', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'content_tail',
									'value' 		=> '...',
									'description' 	=> __( 'Display dots after the post content.', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'show_content',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Link Behaviour', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'link_target',
									'value' 		=> array(
														__( 'Same Window', 'wp-featured-content-and-slider' ) 	=> 'self',
														__( 'New Window', 'wp-featured-content-and-slider' ) 	=> 'blank',
													),
									'description' 	=> __( 'Choose link bahaviour.', 'wp-featured-content-and-slider' ),
								),

								// Data Settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Total items', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'limit',
									'value' 		=> 15,
									'description' 	=> __( 'Enter number of featured content post to be displayed. Enter -1 to display all.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-featured-content-and-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Order By', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'orderby',
									'value' 		=> array(
														__( 'Post Date', 'wp-featured-content-and-slider' ) 	=> 'date',
														__( 'Post ID', 'wp-featured-content-and-slider' ) 		=> 'ID',
														__( 'Post Author', 'wp-featured-content-and-slider' ) 	=> 'author',
														__( 'Post Title', 'wp-featured-content-and-slider' ) 	=> 'title',
														__( 'Post Slug', 'wp-featured-content-and-slider' )	 	=> 'name',
														__( 'Post Modified Date', 'wp-featured-content-and-slider' ) => 'modified',
														__( 'Random', 'wp-featured-content-and-slider' ) 		=> 'rand',
														__( 'Menu Order', 'wp-featured-content-and-slider' ) 	=> 'menu_order',
													),
									'description' 	=> __( 'Select order type.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-featured-content-and-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Sort order', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'order',
									'value' 		=> array(
														__( 'Descending', 'wp-featured-content-and-slider' ) 	=> 'desc',
														__( 'Ascending', 'wp-featured-content-and-slider' ) 	=> 'asc',
													),
									'description' 	=> __( 'Select sorting order.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-featured-content-and-slider' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Category', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'cat_id',
									'value' 		=> '',
									'description' 	=> __( 'Enter featured content category id to display featured post categories wise.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-featured-content-and-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Category', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'exclude_cat',
									'value' 		=> '',
									'description' 	=> __( 'Exclude featured content post category. Works only if `Category` field is empty.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-featured-content-and-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Display Specific Post', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'posts',
									'value' 		=> '',
									'description' 	=> __( 'Display specific featured content posts.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-featured-content-and-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Post', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'exclude_post',
									'value' 		=> '',
									'description' 	=> __( 'Enter featured content post id which you do not want to display.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-featured-content-and-slider' ),
								),

								// Slider Settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Slider Column', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'slides_column',
									'value' 		=> '3',
									'description' 	=> __( 'Enter slider column.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Slides to Scroll', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'slides_scroll',
									'value' 		=> '1',
									'description' 	=> __( 'Enter number of slides to scroll.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Dots', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'dots',
									'value' 		=> array(
														__( 'True', 'wp-featured-content-and-slider' ) 	=> 'true',
														__( 'False', 'wp-featured-content-and-slider' ) => 'false',
													),
									'description' 	=> __( 'Show dots indicators.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Arrows', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'arrows',
									'value' 		=> array(
														__( 'True', 'wp-featured-content-and-slider' ) 	=> 'true',
														__( 'False', 'wp-featured-content-and-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Show Prev - Next arrows.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Autoplay', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'autoplay',
									'value' 		=> array(
														__( 'True', 'wp-featured-content-and-slider' ) 	=> 'true',
														__( 'False', 'wp-featured-content-and-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable autoplay.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Autoplay Interval', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'autoplay_interval',
									'value' 		=> '3000',
									'description' 	=> __( 'Enter autoplay speed.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Speed', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'speed',
									'value' 		=> '300',
									'description' 	=> __( 'Enter slide speed.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Infinite', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'infinite',
									'value' 		=> array(
														__( 'True', 'wp-featured-content-and-slider' ) 	=> 'true',
														__( 'False', 'wp-featured-content-and-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable infinite loop sliding.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Center Mode', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'centermode',
									'value' 		=> array(
														__( 'True', 'wp-featured-content-and-slider' ) 	=> 'true',
														__( 'False', 'wp-featured-content-and-slider' ) 	=> 'false',
													),
									'std'         	=> 'false',
									'description' 	=> __( 'Enable centered view with partial prev/next slides. Use with odd numbered `Slides to Scroll` and `Slider Column` counts.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								)
							)
		));
	}

	/**
	 * Function to add 'featured-cnt-icon' shortcode in vc
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_integrate_fc_icon_vc() {
		vc_map( array(
			'name' 			=> __( 'WPOS - FC With Icon', 'wp-featured-content-and-slider' ),
			'base' 			=> 'featured-cnt-icon',
			'icon' 			=> 'icon-wpb-wp',
			'class' 		=> '',
			'category' 		=> __( 'Content', 'wp-featured-content-and-slider'),
			'description' 	=> __( 'Display featured content with font awesome icon.', 'wp-featured-content-and-slider' ),
			'params' 	=> array(
								// General settings
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Type', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'type',
									'value' 		=> array(
														__( 'Grid', 'wp-featured-content-and-slider' ) 		=> 'grid',
														__( 'Slider', 'wp-featured-content-and-slider' ) 	=> 'slider',
													),
									'description' 	=> __( 'Display featured content in a grid or slider.', 'wp-featured-content-and-slider' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Design', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'design',
									'value' 		=> array(
															__( 'FC Icon Design 1', 'wp-featured-content-and-slider' ) 	=> 'design-1',
															__( 'FC Icon Design 2', 'wp-featured-content-and-slider' ) 	=> 'design-2',
															__( 'FC Icon Design 3', 'wp-featured-content-and-slider' ) 	=> 'design-3',
															__( 'FC Icon Design 4', 'wp-featured-content-and-slider' ) 	=> 'design-4',
															__( 'FC Icon Design 5', 'wp-featured-content-and-slider' ) 	=> 'design-5',
															__( 'FC Icon Design 6', 'wp-featured-content-and-slider' ) 	=> 'design-6',
															__( 'FC Icon Design 7', 'wp-featured-content-and-slider' ) 	=> 'design-7',
															__( 'FC Icon Design 8', 'wp-featured-content-and-slider' ) 	=> 'design-22',
															__( 'FC Icon Design 9', 'wp-featured-content-and-slider' ) 	=> 'design-23',
															__( 'FC Icon Design 10', 'wp-featured-content-and-slider' ) 	=> 'design-26',
															__( 'FC Icon Design 11', 'wp-featured-content-and-slider' ) 	=> 'design-27',
															__( 'FC Icon Design 12', 'wp-featured-content-and-slider' ) 	=> 'design-28',
															__( 'FC Icon Design 13', 'wp-featured-content-and-slider' ) 	=> 'design-29',
															__( 'FC Icon Design 14', 'wp-featured-content-and-slider' ) 	=> 'design-30',
															__( 'FC Icon Design 15', 'wp-featured-content-and-slider' ) 	=> 'design-32',
															__( 'FC Icon Design 16', 'wp-featured-content-and-slider' ) 	=> 'design-33',
															__( 'FC Icon Design 17', 'wp-featured-content-and-slider' ) 	=> 'design-35',
														),
									'description' 	=> __( 'Display featured content in a grid or slider.', 'wp-featured-content-and-slider' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Grid Elements Per Row', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'grid',
									'value' 		=> array(
															__( 'One Column', 'wp-featured-content-and-slider' ) 	=> '1',
															__( 'Two Column', 'wp-featured-content-and-slider' ) 	=> '2',
															__( 'Third Column', 'wp-featured-content-and-slider' ) 	=> '3',
															__( 'Four Column', 'wp-featured-content-and-slider' ) 	=> '4',
														),
									'std'			=> '2',
									'dependency' 	=> array(
															'element' 	=> 'type',
															'value' 	=> array( 'grid' ),
														),
									'description' 	=> __( 'Select number of grid elements per row.', 'wp-featured-content-and-slider' )
								),
								array(
									'type' 			=> 'colorpicker',
									'class' 		=> '',
									'heading' 		=> __( 'Icon Color', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'fa_icon_color',
									'value' 		=> '#3ab0e2',
									'description' 	=> __( 'Choose font icon color.', 'wp-featured-content-and-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Read More Button', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'display_read_more',
									'value' 		=> array(
														__( 'True', 'wp-featured-content-and-slider' ) 	=> 'true',
														__( 'False', 'wp-featured-content-and-slider' ) => 'false',
													),
									'description' 	=> __( 'Display read more button.', 'wp-featured-content-and-slider' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Read More Button Text', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'read_more_text',
									'value' 		=> 'Read More',
									'description' 	=> __( 'Enter read more button text.', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'display_read_more',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Post Content', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'show_content',
									'value' 		=> array(
														__( 'True', 'wp-featured-content-and-slider' ) 	=> 'true',
														__( 'False', 'wp-featured-content-and-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Show featured content post content.', 'wp-featured-content-and-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Words Limit', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'content_words_limit',
									'value' 		=> '25',
									'description' 	=> __( 'Control featured post content words limit.', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'show_content',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Tail', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'content_tail',
									'value' 		=> '...',
									'description' 	=> __( 'Display dots after the post content.', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'show_content',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Link Behaviour', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'link_target',
									'value' 		=> array(
														__( 'Same Window', 'wp-featured-content-and-slider' ) 	=> 'self',
														__( 'New Window', 'wp-featured-content-and-slider' ) 	=> 'blank',
													),
									'description' 	=> __( 'Choose link bahaviour.', 'wp-featured-content-and-slider' ),
								),

								// Data Settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Total items', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'limit',
									'value' 		=> 15,
									'description' 	=> __( 'Enter number of featured content post to be displayed. Enter -1 to display all.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-featured-content-and-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Order By', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'orderby',
									'value' 		=> array(
														__( 'Post Date', 'wp-featured-content-and-slider' ) 	=> 'date',
														__( 'Post ID', 'wp-featured-content-and-slider' ) 		=> 'ID',
														__( 'Post Author', 'wp-featured-content-and-slider' ) 	=> 'author',
														__( 'Post Title', 'wp-featured-content-and-slider' ) 	=> 'title',
														__( 'Post Slug', 'wp-featured-content-and-slider' )	 	=> 'name',
														__( 'Post Modified Date', 'wp-featured-content-and-slider' ) => 'modified',
														__( 'Random', 'wp-featured-content-and-slider' ) 		=> 'rand',
														__( 'Menu Order', 'wp-featured-content-and-slider' ) 	=> 'menu_order',
													),
									'description' 	=> __( 'Select order type.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-featured-content-and-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Sort order', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'order',
									'value' 		=> array(
														__( 'Descending', 'wp-featured-content-and-slider' ) 	=> 'desc',
														__( 'Ascending', 'wp-featured-content-and-slider' ) 	=> 'asc',
													),
									'description' 	=> __( 'Select sorting order.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-featured-content-and-slider' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Category', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'cat_id',
									'value' 		=> '',
									'description' 	=> __( 'Enter featured content category id to display featured post categories wise.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-featured-content-and-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Category', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'exclude_cat',
									'value' 		=> '',
									'description' 	=> __( 'Exclude featured content post category. Works only if `Category` field is empty.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-featured-content-and-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Display Specific Post', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'posts',
									'value' 		=> '',
									'description' 	=> __( 'Display specific featured content posts.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-featured-content-and-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Post', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'exclude_post',
									'value' 		=> '',
									'description' 	=> __( 'Enter featured content post id which you do not want to display.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-featured-content-and-slider' ),
								),

								// Slider Settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Slider Column', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'slides_column',
									'value' 		=> '3',
									'description' 	=> __( 'Enter slider column.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Slides to Scroll', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'slides_scroll',
									'value' 		=> '1',
									'description' 	=> __( 'Enter number of slides to scroll.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Dots', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'dots',
									'value' 		=> array(
														__( 'True', 'wp-featured-content-and-slider' ) 	=> 'true',
														__( 'False', 'wp-featured-content-and-slider' ) => 'false',
													),
									'description' 	=> __( 'Show dots indicators.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Arrows', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'arrows',
									'value' 		=> array(
														__( 'True', 'wp-featured-content-and-slider' ) 	=> 'true',
														__( 'False', 'wp-featured-content-and-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Show Prev - Next arrows.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Autoplay', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'autoplay',
									'value' 		=> array(
														__( 'True', 'wp-featured-content-and-slider' ) 	=> 'true',
														__( 'False', 'wp-featured-content-and-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable autoplay.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Autoplay Interval', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'autoplay_interval',
									'value' 		=> '3000',
									'description' 	=> __( 'Enter autoplay speed.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Speed', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'speed',
									'value' 		=> '300',
									'description' 	=> __( 'Enter slide speed.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Infinite', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'infinite',
									'value' 		=> array(
														__( 'True', 'wp-featured-content-and-slider' ) 	=> 'true',
														__( 'False', 'wp-featured-content-and-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable infinite loop sliding.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Center Mode', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'centermode',
									'value' 		=> array(
														__( 'True', 'wp-featured-content-and-slider' ) 	=> 'true',
														__( 'False', 'wp-featured-content-and-slider' ) 	=> 'false',
													),
									'std'         	=> 'false',
									'description' 	=> __( 'Enable centered view with partial prev/next slides. Use with odd numbered `Slides to Scroll` and `Slider Column` counts.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								)
							)
		));
	}

	/**
	 * Function to add 'featured-cnt-icon-img' shortcode in vc
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_integrate_fc_icon_img_vc() {
		vc_map( array(
			'name' 			=> __( 'WPOS - FC With Icon & Image', 'wp-featured-content-and-slider' ),
			'base' 			=> 'featured-cnt-icon-img',
			'icon' 			=> 'icon-wpb-wp',
			'class' 		=> '',
			'category' 		=> __( 'Content', 'wp-featured-content-and-slider'),
			'description' 	=> __( 'Display featured content with icon and image.', 'wp-featured-content-and-slider' ),
			'params' 	=> array(
								// General settings
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Type', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'type',
									'value' 		=> array(
														__( 'Grid', 'wp-featured-content-and-slider' ) 		=> 'grid',
														__( 'Slider', 'wp-featured-content-and-slider' ) 	=> 'slider',
													),
									'description' 	=> __( 'Display featured content in a grid or slider.', 'wp-featured-content-and-slider' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Design', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'design',
									'value' 		=> array(
															__( 'FC Icon & Design - 1', 'wp-featured-content-and-slider' ) 	=> 'design-8',
															__( 'FC Icon & Design - 2', 'wp-featured-content-and-slider' ) 	=> 'design-9',
															__( 'FC Icon & Design - 3', 'wp-featured-content-and-slider' ) 	=> 'design-20',
															__( 'FC Icon & Design - 4', 'wp-featured-content-and-slider' ) 	=> 'design-21',
															__( 'FC Icon & Design - 5', 'wp-featured-content-and-slider' ) 	=> 'design-24',
															__( 'FC Icon & Design - 6', 'wp-featured-content-and-slider' ) 	=> 'design-25',
															__( 'FC Icon & Design - 7', 'wp-featured-content-and-slider' ) 	=> 'design-31',
															__( 'FC Icon & Design - 8', 'wp-featured-content-and-slider' ) 	=> 'design-34',
														),
									'description' 	=> __( 'Display featured content in a grid or slider.', 'wp-featured-content-and-slider' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Grid Elements Per Row', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'grid',
									'value' 		=> array(
															__( 'One Column', 'wp-featured-content-and-slider' ) 	=> '1',
															__( 'Two Column', 'wp-featured-content-and-slider' ) 	=> '2',
															__( 'Third Column', 'wp-featured-content-and-slider' ) 	=> '3',
															__( 'Four Column', 'wp-featured-content-and-slider' ) 	=> '4',
														),
									'std'			=> '2',
									'dependency' 	=> array(
															'element' 	=> 'type',
															'value' 	=> array( 'grid' ),
														),
									'description' 	=> __( 'Select number of grid elements per row.', 'wp-featured-content-and-slider' )
								),
								array(
									'type' 			=> 'colorpicker',
									'class' 		=> '',
									'heading' 		=> __( 'Icon Color', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'fa_icon_color',
									'value' 		=> '#3ab0e2',
									'description' 	=> __( 'Choose font icon color.', 'wp-featured-content-and-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Read More Button', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'display_read_more',
									'value' 		=> array(
														__( 'True', 'wp-featured-content-and-slider' ) 	=> 'true',
														__( 'False', 'wp-featured-content-and-slider' ) => 'false',
													),
									'description' 	=> __( 'Display read more button.', 'wp-featured-content-and-slider' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Read More Button Text', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'read_more_text',
									'value' 		=> 'Read More',
									'description' 	=> __( 'Enter read more button text.', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'display_read_more',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Post Content', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'show_content',
									'value' 		=> array(
														__( 'True', 'wp-featured-content-and-slider' ) 	=> 'true',
														__( 'False', 'wp-featured-content-and-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Show featured content post content.', 'wp-featured-content-and-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Words Limit', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'content_words_limit',
									'value' 		=> '25',
									'description' 	=> __( 'Control featured post content words limit.', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'show_content',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Tail', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'content_tail',
									'value' 		=> '...',
									'description' 	=> __( 'Display dots after the post content.', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'show_content',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Link Behaviour', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'link_target',
									'value' 		=> array(
														__( 'Same Window', 'wp-featured-content-and-slider' ) 	=> 'self',
														__( 'New Window', 'wp-featured-content-and-slider' ) 	=> 'blank',
													),
									'description' 	=> __( 'Choose link bahaviour.', 'wp-featured-content-and-slider' ),
								),

								// Data Settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Total items', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'limit',
									'value' 		=> 15,
									'description' 	=> __( 'Enter number of featured content post to be displayed. Enter -1 to display all.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-featured-content-and-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Order By', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'orderby',
									'value' 		=> array(
														__( 'Post Date', 'wp-featured-content-and-slider' ) 	=> 'date',
														__( 'Post ID', 'wp-featured-content-and-slider' ) 		=> 'ID',
														__( 'Post Author', 'wp-featured-content-and-slider' ) 	=> 'author',
														__( 'Post Title', 'wp-featured-content-and-slider' ) 	=> 'title',
														__( 'Post Slug', 'wp-featured-content-and-slider' )	 	=> 'name',
														__( 'Post Modified Date', 'wp-featured-content-and-slider' ) => 'modified',
														__( 'Random', 'wp-featured-content-and-slider' ) 		=> 'rand',
														__( 'Menu Order', 'wp-featured-content-and-slider' ) 	=> 'menu_order',
													),
									'description' 	=> __( 'Select order type.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-featured-content-and-slider' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Sort order', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'order',
									'value' 		=> array(
														__( 'Descending', 'wp-featured-content-and-slider' ) 	=> 'desc',
														__( 'Ascending', 'wp-featured-content-and-slider' ) 	=> 'asc',
													),
									'description' 	=> __( 'Select sorting order.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-featured-content-and-slider' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Category', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'cat_id',
									'value' 		=> '',
									'description' 	=> __( 'Enter featured content category id to display featured post categories wise.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-featured-content-and-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Category', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'exclude_cat',
									'value' 		=> '',
									'description' 	=> __( 'Exclude featured content post category. Works only if `Category` field is empty.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-featured-content-and-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Display Specific Post', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'posts',
									'value' 		=> '',
									'description' 	=> __( 'Display specific featured content posts.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-featured-content-and-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Post', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'exclude_post',
									'value' 		=> '',
									'description' 	=> __( 'Enter featured content post id which you do not want to display.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Data Settings', 'wp-featured-content-and-slider' ),
								),

								// Slider Settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Slider Column', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'slides_column',
									'value' 		=> '3',
									'description' 	=> __( 'Enter slider column.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Slides to Scroll', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'slides_scroll',
									'value' 		=> '1',
									'description' 	=> __( 'Enter number of slides to scroll.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Dots', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'dots',
									'value' 		=> array(
														__( 'True', 'wp-featured-content-and-slider' ) 	=> 'true',
														__( 'False', 'wp-featured-content-and-slider' ) => 'false',
													),
									'description' 	=> __( 'Show dots indicators.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Arrows', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'arrows',
									'value' 		=> array(
														__( 'True', 'wp-featured-content-and-slider' ) 	=> 'true',
														__( 'False', 'wp-featured-content-and-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Show Prev - Next arrows.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Autoplay', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'autoplay',
									'value' 		=> array(
														__( 'True', 'wp-featured-content-and-slider' ) 	=> 'true',
														__( 'False', 'wp-featured-content-and-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable autoplay.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Autoplay Interval', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'autoplay_interval',
									'value' 		=> '3000',
									'description' 	=> __( 'Enter autoplay speed.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Speed', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'speed',
									'value' 		=> '300',
									'description' 	=> __( 'Enter slide speed.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Infinite', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'infinite',
									'value' 		=> array(
														__( 'True', 'wp-featured-content-and-slider' ) 	=> 'true',
														__( 'False', 'wp-featured-content-and-slider' ) 	=> 'false',
													),
									'description' 	=> __( 'Enable infinite loop sliding.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								),array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Center Mode', 'wp-featured-content-and-slider' ),
									'param_name' 	=> 'centermode',
									'value' 		=> array(
														__( 'True', 'wp-featured-content-and-slider' ) 	=> 'true',
														__( 'False', 'wp-featured-content-and-slider' ) 	=> 'false',
													),
									'std'         	=> 'false',
									'description' 	=> __( 'Enable centered view with partial prev/next slides. Use with odd numbered `Slides to Scroll` and `Slider Column` counts.', 'wp-featured-content-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'wp-featured-content-and-slider' ),
									'dependency' 	=> array(
														'element' 	=> 'type',
														'value' 	=> array( 'slider' ),
														),
								)
							)
		));
	}
}

$wp_fcasp_vc = new Wp_Fcasp_Vc();