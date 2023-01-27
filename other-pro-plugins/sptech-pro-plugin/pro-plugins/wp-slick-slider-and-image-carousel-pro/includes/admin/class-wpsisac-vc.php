<?php
/**
 * Visual Composer Class
 *
 * Handles the visual composer shortcode functionality of plugin
 *
 * @package WP Slick Slider And Image Carousel Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpsisac_Vc {
	
	function __construct() {

		// Action to add 'slick-slider' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wpsisac_pro_integrate_slider_vc') );

		// Action to add 'slick-carousel-slider' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wpsisac_pro_integrate_carousel_vc') );

		// Action to add 'slick-variable-slider' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wpsisac_pro_integrate_variable_vc') );
	}

	/**
	 * Function to add 'slick-slider' shortcode in vc
	 * 
	 * @package WP Slick Slider And Image Carousel Pro
	 * @since 1.0.0
	 */
	function wpsisac_pro_integrate_slider_vc() {
		vc_map( array(
			'name' 			=> __( 'WPOS - Slick Slider', 'wp-slick-slider-and-image-carousel' ),
			'base' 			=> 'slick-slider',
			'icon' 			=> 'icon-wpb-wp',
			'class' 		=> '',
			'category' 		=> __( 'Content', 'wp-slick-slider-and-image-carousel'),
			'description' 	=> __( 'Display slick slider.', 'wp-slick-slider-and-image-carousel' ),
			'params' 		=> array(
				// General settings
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Design', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'design',
					'value' 		=> array(
											__( 'Slider Design 1', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-1',
											__( 'Slider Design 2', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-2',
											__( 'Slider Design 3', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-3',
											__( 'Slider Design 4', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-4',
											__( 'Slider Design 5', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-5',
											__( 'Slider Design 6', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-6',
											__( 'Slider Design 7', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-7',
											__( 'Slider Design 8', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-8',
											__( 'Slider Design 9', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-9',
											__( 'Slider Design 10', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-10',
											__( 'Slider Design 17', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-17',
											__( 'Slider Design 18', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-18',
											__( 'Slider Design 19', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-19',
											__( 'Slider Design 20', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-20',
											__( 'Slider Design 21', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-21',
											__( 'Slider Design 22', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-22',
											__( 'Slider Design 23', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-23',
											__( 'Slider Design 24', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-24',
											__( 'Slider Design 25', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-25',
											__( 'Slider Design 26', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-26',
											__( 'Slider Design 27', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-27',
											__( 'Slider Design 28', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-28',
											__( 'Slider Design 29', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-29',
											__( 'Slider Design 30', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-30',
										),
					'description' 	=> __( 'Choose slider design.', 'wp-slick-slider-and-image-carousel' ),
					'admin_label' 	=> true,
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Show Content', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'show_content',
					'value' 		=> array(
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
											__( 'False', 'wp-slick-slider-and-image-carousel' ) => 'false',
										),
					'description' 	=> __( 'Show slides content or not.', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Link Behaviour', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'link_target',
					'value' 		=> array(
											__( 'Same Window', 'wp-slick-slider-and-image-carousel' ) => 'self',
											__( 'New Window', 'wp-slick-slider-and-image-carousel' ) 	=> 'blank',
										),
					'description' 	=> __( 'Choose link bahaviour.', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Show Read More', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'show_read_more',
					'value' 		=> array(
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
											__( 'False', 'wp-slick-slider-and-image-carousel' ) => 'false',
										),
					'description' 	=> __( 'Display Read More button or not.', 'wp-slick-slider-and-image-carousel' )
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Read More Text', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'read_more_text',
					'value' 		=> 'Read More',
					'description' 	=> __( 'Control read more text.', 'wp-slick-slider-and-image-carousel' ),
					'dependency' 	=> array(
											'element' 	=> 'show_read_more',
											'value' 	=> array( 'true' ),
										),
					),

				// Data Settings
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Total items', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'limit',
					'value' 		=> 15,
					'description' 	=> __( 'Enter number of slides to be displayed. Enter -1 to display all.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Post Order By', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'orderby',
					'value' 		=> array(
											__( 'Post Date', 'wp-slick-slider-and-image-carousel' ) 			=> 'date',
											__( 'Post ID', 'wp-slick-slider-and-image-carousel' ) 				=> 'ID',
											__( 'Post Author', 'wp-slick-slider-and-image-carousel' ) 			=> 'author',
											__( 'Post Title', 'wp-slick-slider-and-image-carousel' ) 			=> 'title',
											__( 'Post Modified Date', 'wp-slick-slider-and-image-carousel' ) 	=> 'modified',
											__( 'Random', 'wp-slick-slider-and-image-carousel' ) 				=> 'rand',
											__( 'Menu Order', 'wp-slick-slider-and-image-carousel' ) 			=> 'menu_order',
											),
					'description' 	=> __( 'Select order type.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' )
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Order', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'order',
					'value' 		=> array(
											__( 'Descending', 'wp-slick-slider-and-image-carousel' ) 	=> 'desc',
											__( 'Ascending', 'wp-slick-slider-and-image-carousel' ) 	=> 'asc',
										),
					'description' 	=> __( 'Post Order.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' )
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Category', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'category',
					'value' 		=> '',
					'description' 	=> __( 'Enter category id to display silder categories wise.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Include Category Children', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'include_cat_child',
					'value' 		=> array(
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
											__( 'False', 'wp-slick-slider-and-image-carousel' ) => 'false',
										),
					'description' 	=> __( 'Include category children or not.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Display Specific Post', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'posts',
					'value' 		=> '',
					'description' 	=> __( 'Display specific posts.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Exclude Post', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'exclude_post',
					'value' 		=> '',
					'description' 	=> __( 'Enter comma seperated post id which you do not want to display.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Exclude Category', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'exclude_cat',
					'value' 		=> '',
					'description' 	=> __( 'Enter comma seperated slider category which you do not want to display. Works only if `Category` field is empty.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' ),
				),

				// Slider Setting
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Dots', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'dots',
					'value' 		=> array(
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
											__( 'False', 'wp-slick-slider-and-image-carousel' ) => 'false',
										),
					'description' 	=> __( 'Show slider pagination dots.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' )
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Slider Dots Design', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'dots_design',
					'value' 		=> array(
											__( 'Dots Design 1', 'wp-slick-slider-and-image-carousel' ) => 'design-1',
											__( 'Dots Design 2', 'wp-slick-slider-and-image-carousel' ) => 'design-2',
											__( 'Dots Design 3', 'wp-slick-slider-and-image-carousel' ) => 'design-3',
											__( 'Dots Design 4', 'wp-slick-slider-and-image-carousel' ) => 'design-4',
											__( 'Dots Design 5', 'wp-slick-slider-and-image-carousel' ) => 'design-5',
											__( 'Dots Design 6', 'wp-slick-slider-and-image-carousel' ) => 'design-6',
											__( 'Dots Design 7', 'wp-slick-slider-and-image-carousel' ) => 'design-7',
											__( 'Dots Design 8', 'wp-slick-slider-and-image-carousel' )	=> 'design-8',
											__( 'Dots Design 9', 'wp-slick-slider-and-image-carousel' ) => 'design-9',
											__( 'Dots Design 10', 'wp-slick-slider-and-image-carousel' ) => 'design-10',
											__( 'Dots Design 11', 'wp-slick-slider-and-image-carousel' ) => 'design-11',
											__( 'Dots Design 12', 'wp-slick-slider-and-image-carousel' ) => 'design-12',
										),
					'description' 	=> __( 'Choose slider dots design.', 'wp-slick-slider-and-image-carousel' ),
					'dependency' 	=> array(
											'element' 	=> 'dots',
											'value' 	=> array( 'true' ),
										),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
					'admin_label' 	=> true,
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Arrows', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'arrows',
					'value' 		=> array(
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
											__( 'False', 'wp-slick-slider-and-image-carousel' ) 	=> 'false',
										),
					'description' 	=> __( 'Show Prev - Next arrows.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Slider Arrows Design', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'arrow_design',
					'value' 		=> array(
											__( 'Arrows Design 1', 'wp-slick-slider-and-image-carousel' ) 	=> 'design-1',
											__( 'Arrows Design 2', 'wp-slick-slider-and-image-carousel' ) 	=> 'design-2',
											__( 'Arrows Design 3', 'wp-slick-slider-and-image-carousel' ) 	=> 'design-3',
											__( 'Arrows Design 4', 'wp-slick-slider-and-image-carousel' ) 	=> 'design-4',
											__( 'Arrows Design 5', 'wp-slick-slider-and-image-carousel' ) 	=> 'design-5',
											__( 'Arrows Design 6', 'wp-slick-slider-and-image-carousel' ) 	=> 'design-6',
											__( 'Arrows Design 7', 'wp-slick-slider-and-image-carousel' ) 	=> 'design-7',
											__( 'Arrows Design 8', 'wp-slick-slider-and-image-carousel' )	=> 'design-8',
										),
					'description' 	=> __( 'Choose slider arrows design.', 'wp-slick-slider-and-image-carousel' ),
					'dependency' 	=> array(
											'element' 	=> 'arrows',
											'value' 	=> array( 'true' ),
										),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
					'admin_label' 	=> true,
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Autoplay', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'autoplay',
					'value' 		=> array(
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
											__( 'False', 'wp-slick-slider-and-image-carousel' ) 	=> 'false',
										),
					'description' 	=> __( 'Enable autoplay.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Loop', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'loop',
					'value' 		=> array(
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
											__( 'False', 'wp-slick-slider-and-image-carousel' ) 	=> 'false',
										),
					'description' 	=> __( 'Enable loop.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Autoplay Interval', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'autoplay_interval',
					'value' 		=> '3000',
					'description' 	=> __( 'Enter autoplay speed.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
					'dependency' 	=> array(
											'element' 	=> 'autoplay',
											'value' 	=> array( 'true' ),
										),
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Speed', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'speed',
					'value' 		=> '300',
					'description' 	=> __( 'Enter slider speed.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Fade', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'fade',
					'value' 		=> array(
											__( 'False', 'wp-slick-slider-and-image-carousel' ) => 'false',
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
										),
					'description' 	=> __( 'Enable fade effect instead of slide effect.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Slider Height', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'sliderheight',
					'value' 		=> '',
					'description' 	=> __( 'Enter slider height. Leave empty for default height.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Slider Navigation Columns', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'slider_nav_column',
					'value' 		=> '3',
					'description' 	=> __( 'Enter slider navigation columns.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
					),
				)
		));
	}

	/**
	 * Function to add 'slick-carousel-slider' shortcode in vc
	 * 
	 * @package WP Slick Slider And Image Carousel Pro
	 * @since 1.0.0
	 */
	function wpsisac_pro_integrate_carousel_vc() {
		vc_map( array(
			'name' 			=> __( 'WPOS - Slick Carousel', 'wp-slick-slider-and-image-carousel' ),
			'base' 			=> 'slick-carousel-slider',
			'icon' 			=> 'icon-wpb-wp',
			'class' 		=> '',
			'category' 		=> __( 'Content', 'wp-slick-slider-and-image-carousel'),
			'description' 	=> __( 'Display slick carousel slider.', 'wp-slick-slider-and-image-carousel' ),
			'params' 	=> array(
				// General settings
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Design', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'design',
					'value' 		=> array(
											__( 'Carousel Design 11', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-11',
											__( 'Carousel Design 12', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-12',
											__( 'Carousel Design 13', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-13',
											__( 'Carousel Design 14', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-14',
											__( 'Carousel Design 15', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-15',
											__( 'Carousel Design 16', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-16',
											__( 'Carousel Design 17', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-17',
											__( 'Carousel Design 18', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-18',
											__( 'Carousel Design 19', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-19',
											__( 'Carousel Design 20', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-20',
											__( 'Carousel Design 21', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-21',
											__( 'Carousel Design 22', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-22',
											__( 'Carousel Design 23', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-23',
											__( 'Carousel Design 24', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-24',
											__( 'Carousel Design 25', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-25',
											__( 'Carousel Design 26', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-26',
											__( 'Carousel Design 27', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-27',
											__( 'Carousel Design 28', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-28',
											__( 'Carousel Design 29', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-29',
											__( 'Carousel Design 30', 'wp-slick-slider-and-image-carousel' ) 	=> 'prodesign-30',
										),
					'description' 	=> __( 'Choose carousel slider design.', 'wp-slick-slider-and-image-carousel' ),
					'admin_label' 	=> true,
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Show Content', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'show_content',
					'value' 		=> array(
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
											__( 'False', 'wp-slick-slider-and-image-carousel' ) => 'false',
											),
					'description' 	=> __( 'Show slides content or not.', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Image Size', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'image_size',
					'value' 		=> array(
											__( 'Large', 'wp-slick-slider-and-image-carousel' ) 	=> 'large',
											__( 'Original', 'wp-slick-slider-and-image-carousel' ) 	=> '',
											__( 'Medium', 'wp-slick-slider-and-image-carousel' ) 	=> 'medium',
											__( 'Thumbnail', 'wp-slick-slider-and-image-carousel' ) => 'thumbnail',
										),
					'description' 	=> __( 'Choose slider image size.', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Link Behaviour', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'link_target',
					'value' 		=> array(
											__( 'Same Window', 'wp-slick-slider-and-image-carousel' ) 	=> 'self',
											__( 'New Window', 'wp-slick-slider-and-image-carousel' ) 	=> 'blank',
										),
					'description' 	=> __( 'Choose link bahaviour.', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Show Read More', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'show_read_more',
					'value' 		=> array(
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
											__( 'False', 'wp-slick-slider-and-image-carousel' ) => 'false',
										),
					'description' 	=> __( 'Display silder with title.', 'wp-slick-slider-and-image-carousel' )
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Read More Text', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'read_more_text',
					'value' 		=> 'Read More',
					'description' 	=> __( 'Control read more text.', 'wp-slick-slider-and-image-carousel' ),
					'dependency' 	=> array(
						'element' 	=> 'show_read_more',
						'value' 	=> array( 'true' ),
						),
				),

				// Data Settings
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Total items', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'limit',
					'value' 		=> 15,
					'description' 	=> __( 'Enter number slides to be displayed. Enter -1 to display all.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Post Order By', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'orderby',
					'value' 		=> array(
											__( 'Post Date', 'wp-slick-slider-and-image-carousel' ) 			=> 'date',
											__( 'Post ID', 'wp-slick-slider-and-image-carousel' ) 				=> 'ID',
											__( 'Post Author', 'wp-slick-slider-and-image-carousel' ) 			=> 'author',
											__( 'Post Title', 'wp-slick-slider-and-image-carousel' ) 			=> 'title',
											__( 'Post Modified Date', 'wp-slick-slider-and-image-carousel' ) 	=> 'modified',
											__( 'Random', 'wp-slick-slider-and-image-carousel' ) 				=> 'rand',
											__( 'Menu Order', 'wp-slick-slider-and-image-carousel' ) 			=> 'menu_order',
											),
					'description' 	=> __( 'Select order type.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' )
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Order', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'order',
					'value' 		=> array(
											__( 'Descending', 'wp-slick-slider-and-image-carousel' ) 	=> 'desc',
											__( 'Ascending', 'wp-slick-slider-and-image-carousel' )		=> 'asc',
										),
					'description' 	=> __( 'Post Order.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' )
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Category', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'category',
					'value' 		=> '',
					'description' 	=> __( 'Enter category id to display Sildes categories wise.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Include Category Children', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'include_cat_child',
					'value' 		=> array(
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
											__( 'False', 'wp-slick-slider-and-image-carousel' ) => 'false',
											),
					'description' 	=> __( 'Include category children or not.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Display Specific Post', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'posts',
					'value' 		=> '',
					'description' 	=> __( 'Display specific posts.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Exclude Post', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'exclude_post',
					'value' 		=> '',
					'description' 	=> __( 'Enter post id which you do not want to display.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Exclude Category', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'exclude_cat',
					'value' 		=> '',
					'description' 	=> __( 'Exclude slides category. Works only if `Category` field is empty.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' ),
				),

				// Slider Setting
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Dots', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'dots',
					'value' 		=> array(
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
											__( 'False', 'wp-slick-slider-and-image-carousel' ) => 'false',
										),
					'description' 	=> __( 'Show pagination dots.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' )
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Slider Dots Design', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'dots_design',
					'value' 		=> array(
											__( 'Dots Design 1', 'wp-slick-slider-and-image-carousel' ) => 'design-1',
											__( 'Dots Design 2', 'wp-slick-slider-and-image-carousel' ) => 'design-2',
											__( 'Dots Design 3', 'wp-slick-slider-and-image-carousel' ) => 'design-3',
											__( 'Dots Design 4', 'wp-slick-slider-and-image-carousel' ) => 'design-4',
											__( 'Dots Design 5', 'wp-slick-slider-and-image-carousel' ) => 'design-5',
											__( 'Dots Design 6', 'wp-slick-slider-and-image-carousel' ) => 'design-6',
											__( 'Dots Design 7', 'wp-slick-slider-and-image-carousel' ) => 'design-7',
											__( 'Dots Design 8', 'wp-slick-slider-and-image-carousel' )	=> 'design-8',
											__( 'Dots Design 9', 'wp-slick-slider-and-image-carousel' ) => 'design-9',
											__( 'Dots Design 10', 'wp-slick-slider-and-image-carousel' ) => 'design-10',
											__( 'Dots Design 11', 'wp-slick-slider-and-image-carousel' ) => 'design-11',
											__( 'Dots Design 12', 'wp-slick-slider-and-image-carousel' ) => 'design-12',
										),
					'description' 	=> __( 'Choose slider dots design.', 'wp-slick-slider-and-image-carousel' ),
					'dependency' 	=> array(
											'element' 	=> 'dots',
											'value' 	=> array( 'true' ),
										),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
					'admin_label' 	=> true,
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Arrows', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'arrows',
					'value' 		=> array(
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
											__( 'False', 'wp-slick-slider-and-image-carousel' ) => 'false',
										),
					'description' 	=> __( 'Show Prev - Next arrows.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Slider Arrows Design', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'arrow_design',
					'value' 		=> array(
											__( 'Arrows Design 1', 'wp-slick-slider-and-image-carousel' ) 	=> 'design-1',
											__( 'Arrows Design 2', 'wp-slick-slider-and-image-carousel' ) 	=> 'design-2',
											__( 'Arrows Design 3', 'wp-slick-slider-and-image-carousel' ) 	=> 'design-3',
											__( 'Arrows Design 4', 'wp-slick-slider-and-image-carousel' ) 	=> 'design-4',
											__( 'Arrows Design 5', 'wp-slick-slider-and-image-carousel' ) 	=> 'design-5',
											__( 'Arrows Design 6', 'wp-slick-slider-and-image-carousel' ) 	=> 'design-6',
											__( 'Arrows Design 7', 'wp-slick-slider-and-image-carousel' ) 	=> 'design-7',
											__( 'Arrows Design 8', 'wp-slick-slider-and-image-carousel' )	=> 'design-8',
										),
					'description' 	=> __( 'Choose slider arrows design.', 'wp-slick-slider-and-image-carousel' ),
					'dependency' 	=> array(
											'element' 	=> 'arrows',
											'value' 	=> array( 'true' ),
										),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
					'admin_label' 	=> true,
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Slide To Show', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'slidestoshow',
					'value' 		=> '3',
					'description' 	=> __( 'Enter Slide to show.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Slide To Scroll', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'slidestoscroll',
					'value' 		=> '1',
					'description' 	=> __( 'Enter slide to scroll.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Autoplay', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'autoplay',
					'value' 		=> array(
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
											__( 'False', 'wp-slick-slider-and-image-carousel' ) => 'false',
										),
					'description' 	=> __( 'Enable autoplay.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Loop', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'loop',
					'value' 		=> array(
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
											__( 'False', 'wp-slick-slider-and-image-carousel' ) => 'false',
										),
					'description' 	=> __( 'Enable loop.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Autoplay Interval', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'autoplay_interval',
					'value' 		=> '3000',
					'description' 	=> __( 'Enter autoplay speed.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Speed', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'speed',
					'value' 		=> '300',
					'description' 	=> __( 'Enter slide speed.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Centermode', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'centermode',
					'value' 		=> array(
											__( 'False', 'wp-slick-slider-and-image-carousel' ) => 'false',
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
										),
					'description' 	=> __( 'Enable centermode.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Slider Height', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'sliderheight',
					'value' 		=> '',
					'description' 	=> __( 'Enter slider height.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
					),
				)
		));
	}

	/**
	 * Function to add 'slick-variable-slider' shortcode in vc
	 * 
	 * @package WP Slick Slider And Image Carousel Pro
	 * @since 1.2.5
	 */
	function wpsisac_pro_integrate_variable_vc() {
		vc_map( array(
			'name' 			=> __( 'WPOS - Slick Variable', 'wp-slick-slider-and-image-carousel' ),
			'base' 			=> 'slick-variable-slider',
			'icon' 			=> 'icon-wpb-wp',
			'class' 		=> '',
			'category' 		=> __( 'Content', 'wp-slick-slider-and-image-carousel'),
			'description' 	=> __( 'Display slick slider variable width.', 'wp-slick-slider-and-image-carousel' ),
			'params' 	=> array(
				// General settings
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Design', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'design',
					'value' 		=> array(
											__( 'Variable Slider Design 11', 'wp-slick-slider-and-image-carousel' ) => 'prodesign-11',
											__( 'Variable Slider Design 12', 'wp-slick-slider-and-image-carousel' ) => 'prodesign-12',
											__( 'Variable Slider Design 13', 'wp-slick-slider-and-image-carousel' ) => 'prodesign-13',
											__( 'Variable Slider Design 14', 'wp-slick-slider-and-image-carousel' ) => 'prodesign-14',
											__( 'Variable Slider Design 15', 'wp-slick-slider-and-image-carousel' ) => 'prodesign-15',
											__( 'Variable Slider Design 16', 'wp-slick-slider-and-image-carousel' ) => 'prodesign-16',
											__( 'Variable Slider Design 17', 'wp-slick-slider-and-image-carousel' ) => 'prodesign-17',
											__( 'Variable Slider Design 18', 'wp-slick-slider-and-image-carousel' )	=> 'prodesign-18',
											__( 'Variable Slider Design 19', 'wp-slick-slider-and-image-carousel' ) => 'prodesign-19',
											__( 'Variable Slider Design 20', 'wp-slick-slider-and-image-carousel' ) => 'prodesign-20',
											__( 'Variable Slider Design 21', 'wp-slick-slider-and-image-carousel' ) => 'prodesign-21',
											__( 'Variable Slider Design 22', 'wp-slick-slider-and-image-carousel' ) => 'prodesign-22',
											__( 'Variable Slider Design 23', 'wp-slick-slider-and-image-carousel' ) => 'prodesign-23',
											__( 'Variable Slider Design 24', 'wp-slick-slider-and-image-carousel' ) => 'prodesign-24',
											__( 'Variable Slider Design 25', 'wp-slick-slider-and-image-carousel' ) => 'prodesign-25',
											__( 'Variable Slider Design 26', 'wp-slick-slider-and-image-carousel' ) => 'prodesign-26',
											__( 'Variable Slider Design 27', 'wp-slick-slider-and-image-carousel' )	=> 'prodesign-27',
											__( 'Variable Slider Design 28', 'wp-slick-slider-and-image-carousel' ) => 'prodesign-28',
											__( 'Variable Slider Design 29', 'wp-slick-slider-and-image-carousel' ) => 'prodesign-29',
											__( 'Variable Slider Design 30', 'wp-slick-slider-and-image-carousel' ) => 'prodesign-30',
											__( 'Variable Slider Design 31', 'wp-slick-slider-and-image-carousel' ) => 'prodesign-31',
											__( 'Variable Slider Design 32', 'wp-slick-slider-and-image-carousel' ) => 'prodesign-32',
											__( 'Variable Slider Design 33', 'wp-slick-slider-and-image-carousel' ) => 'prodesign-33',
										),
					'std'			=> 'prodesign-13',
					'description' 	=> __( 'Choose variable slider design.', 'wp-slick-slider-and-image-carousel' ),
					'admin_label' 	=> true,
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Show Content', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'show_content',
					'value' 		=> array(
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
											__( 'False', 'wp-slick-slider-and-image-carousel' ) => 'false',
										),
					'description' 	=> __( 'Show slides content or not.', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Image Size', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'image_size',
					'value' 		=> array(
											__( 'Large', 'wp-slick-slider-and-image-carousel' ) 		=> 'large',
											__( 'Original', 'wp-slick-slider-and-image-carousel' ) 		=> '',
											__( 'Medium', 'wp-slick-slider-and-image-carousel' ) 		=> 'medium',
											__( 'Thumbnail', 'wp-slick-slider-and-image-carousel' ) 	=> 'thumbnail',
										),
					'description' 	=> __( 'Choose slider image size.', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Link Behaviour', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'link_target',
					'value' 		=> array(
											__( 'Same Window', 'wp-slick-slider-and-image-carousel' ) 	=> 'self',
											__( 'New Window', 'wp-slick-slider-and-image-carousel' ) 	=> 'blank',
										),
					'description' 	=> __( 'Choose link bahaviour.', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Show Read More', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'show_read_more',
					'value' 		=> array(
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
											__( 'False', 'wp-slick-slider-and-image-carousel' ) 	=> 'false',
										),
					'description' 	=> __( 'Display slider with title.', 'wp-slick-slider-and-image-carousel' )
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Read More Text', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'read_more_text',
					'value' 		=> 'Read More',
					'description' 	=> __( 'Control read more text.', 'wp-slick-slider-and-image-carousel' ),
					'dependency' 	=> array(
											'element' 	=> 'show_read_more',
											'value' 	=> array( 'true' ),
										),
				),

				// Data Setting
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Total items', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'limit',
					'value' 		=> 15,
					'description' 	=> __( 'Enter number to be displayed. Enter -1 to display all.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Post Order By', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'orderby',
					'value' 		=> array(
											__( 'Post Date', 'wp-slick-slider-and-image-carousel' ) 			=> 'date',
											__( 'Post ID', 'wp-slick-slider-and-image-carousel' ) 				=> 'ID',
											__( 'Post Author', 'wp-slick-slider-and-image-carousel' ) 			=> 'author',
											__( 'Post Title', 'wp-slick-slider-and-image-carousel' ) 			=> 'title',
											__( 'Post Modified Date', 'wp-slick-slider-and-image-carousel' ) 	=> 'modified',
											__( 'Random', 'wp-slick-slider-and-image-carousel' ) 				=> 'rand',
											__( 'Menu Order', 'wp-slick-slider-and-image-carousel' ) 			=> 'menu_order',
										),
					'description' 	=> __( 'Select order type.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' )
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Order', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'order',
					'value' 		=> array(
											__( 'Descending', 'wp-slick-slider-and-image-carousel' ) 	=> 'desc',
											__( 'Ascending', 'wp-slick-slider-and-image-carousel' ) 	=> 'asc',
										),
					'description' 	=> __( 'Post Order.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' )
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Category', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'category',
					'value' 		=> '',
					'description' 	=> __( 'Enter category id to display Sildes categories wise.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Include Category Children', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'include_cat_child',
					'value' 		=> array(
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
											__( 'False', 'wp-slick-slider-and-image-carousel' ) => 'false',
										),
					'description' 	=> __( 'Include category children or not.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Display Specific Post', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'posts',
					'value' 		=> '',
					'description' 	=> __( 'Display specific posts.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Exclude Post', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'exclude_post',
					'value' 		=> '',
					'description' 	=> __( 'Enter comma seperated post id which you do not want to display.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Exclude Category', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'exclude_cat',
					'value' 		=> '',
					'description' 	=> __( 'Enter comma seperated slider category which you do not want to display. Works only if `Category` field is empty.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Data Settings', 'wp-slick-slider-and-image-carousel' ),
				),

				// Slide Settings
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Dots', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'dots',
					'value' 		=> array(
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
											__( 'False', 'wp-slick-slider-and-image-carousel' ) => 'false',
										),
					'description' 	=> __( 'Show slider pagination dots.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' )
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Slider Dots Design', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'dots_design',
					'value' 		=> array(
											__( 'Dots Design 1', 'wp-slick-slider-and-image-carousel' ) => 'design-1',
											__( 'Dots Design 2', 'wp-slick-slider-and-image-carousel' ) => 'design-2',
											__( 'Dots Design 3', 'wp-slick-slider-and-image-carousel' ) => 'design-3',
											__( 'Dots Design 4', 'wp-slick-slider-and-image-carousel' ) => 'design-4',
											__( 'Dots Design 5', 'wp-slick-slider-and-image-carousel' ) => 'design-5',
											__( 'Dots Design 6', 'wp-slick-slider-and-image-carousel' ) => 'design-6',
											__( 'Dots Design 7', 'wp-slick-slider-and-image-carousel' ) => 'design-7',
											__( 'Dots Design 8', 'wp-slick-slider-and-image-carousel' )	=> 'design-8',
											__( 'Dots Design 9', 'wp-slick-slider-and-image-carousel' ) => 'design-9',
											__( 'Dots Design 10', 'wp-slick-slider-and-image-carousel' ) => 'design-10',
											__( 'Dots Design 11', 'wp-slick-slider-and-image-carousel' ) => 'design-11',
											__( 'Dots Design 12', 'wp-slick-slider-and-image-carousel' ) => 'design-12',
										),
					'description' 	=> __( 'Choose slider dots design.', 'wp-slick-slider-and-image-carousel' ),
					'dependency' 	=> array(
											'element' 	=> 'dots',
											'value' 	=> array( 'true' ),
										),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
					'admin_label' 	=> true,
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Arrows', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'arrows',
					'value' 		=> array(
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
											__( 'False', 'wp-slick-slider-and-image-carousel' ) => 'false',
										),
					'description' 	=> __( 'Show Prev - Next arrows.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Slider Arrows Design', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'arrow_design',
					'value' 		=> array(
											__( 'Arrows Design 1', 'wp-slick-slider-and-image-carousel' ) 	=> 'design-1',
											__( 'Arrows Design 2', 'wp-slick-slider-and-image-carousel' ) 	=> 'design-2',
											__( 'Arrows Design 3', 'wp-slick-slider-and-image-carousel' ) 	=> 'design-3',
											__( 'Arrows Design 4', 'wp-slick-slider-and-image-carousel' ) 	=> 'design-4',
											__( 'Arrows Design 5', 'wp-slick-slider-and-image-carousel' ) 	=> 'design-5',
											__( 'Arrows Design 6', 'wp-slick-slider-and-image-carousel' ) 	=> 'design-6',
											__( 'Arrows Design 7', 'wp-slick-slider-and-image-carousel' ) 	=> 'design-7',
											__( 'Arrows Design 8', 'wp-slick-slider-and-image-carousel' )	=> 'design-8',
										),
					'description' 	=> __( 'Choose slider arrows design.', 'wp-slick-slider-and-image-carousel' ),
					'dependency' 	=> array(
											'element' 	=> 'arrows',
											'value' 	=> array( 'true' ),
										),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
					'admin_label' 	=> true,
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Autoplay', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'autoplay',
					'value' 		=> array(
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
											__( 'False', 'wp-slick-slider-and-image-carousel' ) => 'false',
										),
					'description' 	=> __( 'Enable autoplay.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Loop', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'loop',
					'value' 		=> array(
											__( 'True', 'wp-slick-slider-and-image-carousel' ) 	=> 'true',
											__( 'False', 'wp-slick-slider-and-image-carousel' ) => 'false',
										),
					'description' 	=> __( 'Enable loop.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Autoplay Interval', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'autoplay_interval',
					'value' 		=> '3000',
					'description' 	=> __( 'Enter autoplay speed.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Speed', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'speed',
					'value' 		=> '300',
					'description' 	=> __( 'Enter slide speed.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Center Slide Width', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'center_width',
					'value' 		=> '80%',
					'description' 	=> __( 'Enter center slide width. Leave empty for default width. e.g 80% or 500px', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Slider Height', 'wp-slick-slider-and-image-carousel' ),
					'param_name' 	=> 'sliderheight',
					'value' 		=> '',
					'description' 	=> __( 'Enter slider height.', 'wp-slick-slider-and-image-carousel' ),
					'group' 		=> __( 'Slider Settings', 'wp-slick-slider-and-image-carousel' ),
					),
				)
		));
	}
}

$wpsisac_vc = new Wpsisac_Vc();