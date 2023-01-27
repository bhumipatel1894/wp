<?php
/**
 * Visual Composer Class
 *
 * Handles the visual composer shortcode functionality of plugin
 *
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpspw_Vc {
	
	function __construct() {
		
		// Action to add 'wpspw_post' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wpspw_pro_integrate_grid_vc') );

		// Action to add 'wpspw_recent_post' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wpspw_pro_integrate_recent_grid_vc') );
		
		// Action to add 'wpspw_recent_post_slider' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wpspw_pro_integrate_slider_vc') );
	}

	/**
	 * Function to add 'wpspw_post' shortcode in vc
	 * 
	 * @package Blog Designer - Post and Widget Pro
	 * @since 1.0.0
	 */
	function wpspw_pro_integrate_grid_vc() {
		vc_map( 
			array(
				'name' 			=> __( 'WPOS - Post Grid', 'blog-designer-for-post-and-widget' ),
				'base' 			=> 'wpspw_post',
				'icon' 			=> 'icon-wpb-wp',
				'class' 		=> '',
				'category' 		=> __( 'Content', 'blog-designer-for-post-and-widget'),
				'description' 	=> __( 'Display post grid.', 'blog-designer-for-post-and-widget' ),
				'params' 		=> array(
					// General settings
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Design', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'design',
						'value' 		=> array(
							__( 'Grid Design 16', 'blog-designer-for-post-and-widget' ) 	=> 'design-16',
							__( 'Grid Design 17', 'blog-designer-for-post-and-widget' ) 	=> 'design-17',
							__( 'Grid Design 18', 'blog-designer-for-post-and-widget' ) 	=> 'design-18',
							__( 'Grid Design 19', 'blog-designer-for-post-and-widget' ) 	=> 'design-19',
							__( 'Grid Design 20', 'blog-designer-for-post-and-widget' ) 	=> 'design-20',
							__( 'Grid Design 21', 'blog-designer-for-post-and-widget' ) 	=> 'design-21',
							__( 'Grid Design 22', 'blog-designer-for-post-and-widget' ) 	=> 'design-22',
							__( 'Grid Design 23', 'blog-designer-for-post-and-widget' ) 	=> 'design-23',
							__( 'Grid Design 24', 'blog-designer-for-post-and-widget' ) 	=> 'design-24',
							__( 'Grid Design 25', 'blog-designer-for-post-and-widget' ) 	=> 'design-25',
							__( 'Grid Design 26', 'blog-designer-for-post-and-widget' ) 	=> 'design-26',
							__( 'Grid Design 27', 'blog-designer-for-post-and-widget' ) 	=> 'design-27',
							__( 'Grid Design 30', 'blog-designer-for-post-and-widget' ) 	=> 'design-30',
							__( 'Grid Design 34', 'blog-designer-for-post-and-widget' ) 	=> 'design-34',
							__( 'Grid Design 35', 'blog-designer-for-post-and-widget' ) 	=> 'design-35',
							__( 'Grid Design 36', 'blog-designer-for-post-and-widget' ) 	=> 'design-36',
							__( 'Grid Design 37', 'blog-designer-for-post-and-widget' ) 	=> 'design-37',
							__( 'Grid Design 42', 'blog-designer-for-post-and-widget' ) 	=> 'design-42',
							__( 'Grid Design 44', 'blog-designer-for-post-and-widget' ) 	=> 'design-44',
							__( 'Grid Design 45', 'blog-designer-for-post-and-widget' ) 	=> 'design-45',
							__( 'Grid Design 48', 'blog-designer-for-post-and-widget' ) 	=> 'design-48',
							),
						'description' 	=> __( 'Choose grid design.', 'blog-designer-for-post-and-widget' ),
						'admin_label' 	=> true,
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Author', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_author',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Author.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Date', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_date',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Date.', 'blog-designer-for-post-and-widget' ),
						),

					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Content', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_content',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Content.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Full Content', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_full_content',
						'value' 		=> array(
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							),
						'description' 	=> __( 'Show Full Content.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Content Word Limit', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'content_words_limit',
						'value' 		=> '20',
						'description' 	=> __( 'Enter Content Word Limit', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Read More', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_read_more',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Read More.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Pagination', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'pagination',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Pagination.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Pagination Type', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'pagination_type',
						'value' 		=> array(
							__( 'Numeric', 'blog-designer-for-post-and-widget' ) 		=> 'numeric',
							__( 'Next-Prev', 'blog-designer-for-post-and-widget' ) 	=> 'prev-next',
							),
						'description' 	=> __( 'Pagination Type', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Tags', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_tags',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Tags.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Comments', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_comments',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Comments.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Link Behavior', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'link_target',
						'value' 		=> array(
							__( 'Self', 'blog-designer-for-post-and-widget' ) 		=> 'self',
							__( 'blank', 'blog-designer-for-post-and-widget' ) 	=> '_blank',
							),
						'description' 	=> __( 'Link Target.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Content Tail', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'content_tail',
						'value' 		=> '...',
						'description' 	=> __( 'Enter Content Tail to display', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Image Height', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'image_height',
						'value' 		=> '',
						'description' 	=> __( 'Enter Image Height', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Read More Text', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'read_more_text',
						'value' 		=> '',
						'description' 	=> __( 'Enter Read More Text', 'blog-designer-for-post-and-widget' ),
						),

				// Data Settings
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Total Items', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'limit',
						'value' 		=> 20,
						'description' 	=> __( 'Enter number to be displayed. Enter -1 to display all.', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Grid', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'grid',
						'value' 		=> 1,
						'description' 	=> __( 'Enter number to be displayed post per row.', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
						),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Post Order By', 'blog-designer-for-post-and-widget' ),
					'param_name' 	=> 'orderby',
					'value' 		=> array(
											__( 'Post Date', 'blog-designer-for-post-and-widget' ) 			=> 'date',
											__( 'Post ID', 'blog-designer-for-post-and-widget' ) 				=> 'ID',
											__( 'Post Author', 'blog-designer-for-post-and-widget' ) 			=> 'author',
											__( 'Post Title', 'blog-designer-for-post-and-widget' ) 			=> 'title',
											__( 'Post Modified Date', 'blog-designer-for-post-and-widget' ) 	=> 'modified',
											__( 'Random', 'blog-designer-for-post-and-widget' ) 				=> 'rand',
											__( 'Menu Order', 'blog-designer-for-post-and-widget' ) 			=> 'menu_order',
											),
					'description' 	=> __( 'Select order type.', 'blog-designer-for-post-and-widget' ),
					'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' )
					),
				array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Order', 'blog-designer-for-post-and-widget' ),
					'param_name' 	=> 'order',
					'value' 		=> array(
											__( 'Descending', 'blog-designer-for-post-and-widget' ) 	=> 'desc',
											__( 'Ascending', 'blog-designer-for-post-and-widget' ) 	=> 'asc',
										),
					'description' 	=> __( 'Post Order.', 'blog-designer-for-post-and-widget' ),
					'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' )
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Category', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'category',
						'value' 		=> '',
						'description' 	=> __( 'Enter category id to display Posts categories wise.', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Show Category Name', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_category_name',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Category Name.', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Category Name', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'category_name',
						'value' 		=> '',
						'description' 	=> __( 'Category Name.', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
						),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Exclude Category', 'blog-designer-for-post-and-widget' ),
					'param_name' 	=> 'exclude_cat',
					'value' 		=> '',
					'description' 	=> __( 'Exclude post category. Works only if `Category` field is empty.', 'blog-designer-for-post-and-widget' ),
					'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
					),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Display Specific Posts', 'blog-designer-for-post-and-widget' ),
					'param_name' 	=> 'posts',
					'value' 		=> '',
					'description' 	=> __( 'Enter post id which you only want to display.', 'blog-designer-for-post-and-widget' ),
					'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
					),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Exclude Post', 'blog-designer-for-post-and-widget' ),
					'param_name' 	=> 'exclude_post',
					'value' 		=> '',
					'description' 	=> __( 'Enter post id which you do not want to display.', 'blog-designer-for-post-and-widget' ),
					'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
					),
				),
			)
		);
	}


	/**
	 * Function to add 'wpspw_recent_post' shortcode in vc
	 * 
	 * @package Blog Designer - Post and Widget Pro
	 * @since 1.0.0
	 */
	function wpspw_pro_integrate_recent_grid_vc() {
		vc_map( 
			array(
				'name' 			=> __( 'WPOS - Recent Post Grid', 'blog-designer-for-post-and-widget' ),
				'base' 			=> 'wpspw_recent_post',
				'icon' 			=> 'icon-wpb-wp',
				'class' 		=> '',
				'category' 		=> __( 'Content', 'blog-designer-for-post-and-widget'),
				'description' 	=> __( 'Display recent post grid.', 'blog-designer-for-post-and-widget' ),
				'params' 		=> array(

				// General settings
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Design', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'design',
						'value' 		=> array(
							__( 'Recent Design 16', 'blog-designer-for-post-and-widget' ) 	=> 'design-16',
							__( 'Recent Design 17', 'blog-designer-for-post-and-widget' ) 	=> 'design-17',
							__( 'Recent Design 18', 'blog-designer-for-post-and-widget' ) 	=> 'design-18',
							__( 'Recent Design 19', 'blog-designer-for-post-and-widget' ) 	=> 'design-19',
							__( 'Recent Design 20', 'blog-designer-for-post-and-widget' ) 	=> 'design-20',
							__( 'Recent Design 21', 'blog-designer-for-post-and-widget' ) 	=> 'design-21',
							__( 'Recent Design 22', 'blog-designer-for-post-and-widget' ) 	=> 'design-22',
							__( 'Recent Design 23', 'blog-designer-for-post-and-widget' ) 	=> 'design-23',
							__( 'Recent Design 25', 'blog-designer-for-post-and-widget' ) 	=> 'design-25',
							__( 'Recent Design 26', 'blog-designer-for-post-and-widget' ) 	=> 'design-26',
							__( 'Recent Design 27', 'blog-designer-for-post-and-widget' ) 	=> 'design-27',
							__( 'Recent Design 28', 'blog-designer-for-post-and-widget' ) 	=> 'design-28',
							__( 'Recent Design 29', 'blog-designer-for-post-and-widget' ) 	=> 'design-29',
							__( 'Recent Design 31', 'blog-designer-for-post-and-widget' ) 	=> 'design-31',
							__( 'Recent Design 34', 'blog-designer-for-post-and-widget' ) 	=> 'design-34',
							__( 'Recent Design 35', 'blog-designer-for-post-and-widget' ) 	=> 'design-35',
							__( 'Recent Design 37', 'blog-designer-for-post-and-widget' ) 	=> 'design-37',
							__( 'Recent Design 42', 'blog-designer-for-post-and-widget' ) 	=> 'design-42',
							__( 'Recent Design 44', 'blog-designer-for-post-and-widget' ) 	=> 'design-44',
							__( 'Recent Design 45', 'blog-designer-for-post-and-widget' ) 	=> 'design-45',
							__( 'Recent Design 47', 'blog-designer-for-post-and-widget' ) 	=> 'design-47',
							__( 'Recent Design 48', 'blog-designer-for-post-and-widget' ) 	=> 'design-48',
							__( 'Recent Design 49', 'blog-designer-for-post-and-widget' ) 	=> 'design-49',
							__( 'Recent Design 50', 'blog-designer-for-post-and-widget' ) 	=> 'design-50',
							),
						'description' 	=> __( 'Choose recent grid design.', 'blog-designer-for-post-and-widget' ),
						'admin_label' 	=> true,
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Author', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_author',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Author.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Date', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_date',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Date.', 'blog-designer-for-post-and-widget' ),
						),

					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Content', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_content',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Content.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Full Content', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_full_content',
						'value' 		=> array(
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							),
						'description' 	=> __( 'Show Full Content.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Read More', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_read_more',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Read More.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Content Word Limit', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'content_words_limit',
						'value' 		=> '20',
						'description' 	=> __( 'Enter Content Word Limit', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Content Tail', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'content_tail',
						'value' 		=> '...',
						'description' 	=> __( 'Enter Content Tail to display', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Tags', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_tags',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Tags.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Comments', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_comments',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Comments.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Link Behavior', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'link_target',
						'value' 		=> array(
							__( 'Self', 'blog-designer-for-post-and-widget' ) 		=> 'self',
							__( 'blank', 'blog-designer-for-post-and-widget' ) 	=> '_blank',
							),
						'description' 	=> __( 'Link Target.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Read More Text', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_read_more',
						'value' 		=> '',
						'description' 	=> __( 'Enter Read More Text', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Image Height', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'image_height',
						'value' 		=> '',
						'description' 	=> __( 'Enter Image Height', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Read More Text', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'read_more_text',
						'value' 		=> '',
						'description' 	=> __( 'Enter Read More Text', 'blog-designer-for-post-and-widget' ),
						),

			// Data Settings
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Total Items', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'limit',
						'value' 		=> 20,
						'description' 	=> __( 'Enter number to be displayed. Enter -1 to display all.', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Grid', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'grid',
						'value' 		=> 1,
						'description' 	=> __( 'Enter number to be displayed post per row.', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
						),
					array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Post Order By', 'blog-designer-for-post-and-widget' ),
					'param_name' 	=> 'orderby',
					'value' 		=> array(
											__( 'Post Date', 'blog-designer-for-post-and-widget' ) 			=> 'date',
											__( 'Post ID', 'blog-designer-for-post-and-widget' ) 				=> 'ID',
											__( 'Post Author', 'blog-designer-for-post-and-widget' ) 			=> 'author',
											__( 'Post Title', 'blog-designer-for-post-and-widget' ) 			=> 'title',
											__( 'Post Modified Date', 'blog-designer-for-post-and-widget' ) 	=> 'modified',
											__( 'Random', 'blog-designer-for-post-and-widget' ) 				=> 'rand',
											__( 'Menu Order', 'blog-designer-for-post-and-widget' ) 			=> 'menu_order',
											),
					'description' 	=> __( 'Select order type.', 'blog-designer-for-post-and-widget' ),
					'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' )
					),
					array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Order', 'blog-designer-for-post-and-widget' ),
					'param_name' 	=> 'order',
					'value' 		=> array(
											__( 'Descending', 'blog-designer-for-post-and-widget' ) 	=> 'desc',
											__( 'Ascending', 'blog-designer-for-post-and-widget' ) 	=> 'asc',
										),
					'description' 	=> __( 'Post Order.', 'blog-designer-for-post-and-widget' ),
					'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' )
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Category', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'category',
						'value' 		=> '',
						'description' 	=> __( 'Enter category id to display Posts categories wise.', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Show Category Name', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_category_name',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Category Name.', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Category Name', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'category_name',
						'value' 		=> '',
						'description' 	=> __( 'Category Name.', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
						),
					array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Exclude Category', 'blog-designer-for-post-and-widget' ),
					'param_name' 	=> 'exclude_cat',
					'value' 		=> '',
					'description' 	=> __( 'Exclude Post category. Works only if `Category` field is empty.', 'blog-designer-for-post-and-widget' ),
					'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
					),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Display Specific Posts', 'blog-designer-for-post-and-widget' ),
					'param_name' 	=> 'posts',
					'value' 		=> '',
					'description' 	=> __( 'Enter post id which you only want to display.', 'blog-designer-for-post-and-widget' ),
					'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
					),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Exclude Post', 'blog-designer-for-post-and-widget' ),
					'param_name' 	=> 'exclude_post',
					'value' 		=> '',
					'description' 	=> __( 'Enter post id which you do not want to display.', 'blog-designer-for-post-and-widget' ),
					'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
					),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Query Offset', 'blog-designer-for-post-and-widget' ),
					'param_name' 	=> 'query_offset',
					'value' 		=> null,
					'description' 	=> __( 'Enter number of post that you want to skip', 'blog-designer-for-post-and-widget' ),
					'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
					),
				),
			)
		);
	}



	/**
	 * Function to add 'wpspw_recent_post_slider' shortcode in vc
	 * 
	 * @package Blog Designer - Post and Widget Pro
	 * @since 1.0.0
	 */

	function wpspw_pro_integrate_slider_vc() {
		vc_map( 
			array(
				'name' 			=> __( 'WPOS - Post Slider', 'blog-designer-for-post-and-widget' ),
				'base' 			=> 'wpspw_recent_post_slider',
				'icon' 			=> 'icon-wpb-wp',
				'class' 		=> '',
				'category' 		=> __( 'Content', 'blog-designer-for-post-and-widget'),
				'description' 	=> __( 'Display Post slider.', 'blog-designer-for-post-and-widget' ),
				'params' 	=> array(
			// General settings
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Design', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'design',
						'value' 		=> array(
							__( 'Slider Design 1', 'blog-designer-for-post-and-widget' ) 	=> 'design-1',
							__( 'Slider Design 2', 'blog-designer-for-post-and-widget' ) 	=> 'design-2',
							__( 'Slider Design 3', 'blog-designer-for-post-and-widget' ) 	=> 'design-3',
							__( 'Slider Design 4', 'blog-designer-for-post-and-widget' ) 	=> 'design-4',
							__( 'Slider Design 5', 'blog-designer-for-post-and-widget' ) 	=> 'design-5',
							__( 'Slider Design 6', 'blog-designer-for-post-and-widget' ) 	=> 'design-6',
							__( 'Slider Design 7', 'blog-designer-for-post-and-widget' ) 	=> 'design-7',
							__( 'Slider Design 8', 'blog-designer-for-post-and-widget' ) 	=> 'design-8',
							__( 'Slider Design 9', 'blog-designer-for-post-and-widget' ) 	=> 'design-9',
							__( 'Slider Design 10', 'blog-designer-for-post-and-widget' ) 	=> 'design-10',
							__( 'Slider Design 11', 'blog-designer-for-post-and-widget' ) 	=> 'design-11',
							__( 'Slider Design 12', 'blog-designer-for-post-and-widget' ) 	=> 'design-12',
							__( 'Slider Design 13', 'blog-designer-for-post-and-widget' ) 	=> 'design-13',
							__( 'Slider Design 14', 'blog-designer-for-post-and-widget' ) 	=> 'design-14',
							__( 'Slider Design 15', 'blog-designer-for-post-and-widget' ) 	=> 'design-15',
							__( 'Slider Design 32', 'blog-designer-for-post-and-widget' ) 	=> 'design-32',
							__( 'Slider Design 33', 'blog-designer-for-post-and-widget' ) 	=> 'design-33',
							__( 'Slider Design 38', 'blog-designer-for-post-and-widget' ) 	=> 'design-38',
							__( 'Slider Design 39', 'blog-designer-for-post-and-widget' )	=> 'design-39',
							__( 'Slider Design 40', 'blog-designer-for-post-and-widget' )	=> 'design-40',
							__( 'Slider Design 41', 'blog-designer-for-post-and-widget' )	=> 'design-41',
							__( 'Slider Design 43', 'blog-designer-for-post-and-widget' )	=> 'design-43',
							__( 'Slider Design 46', 'blog-designer-for-post-and-widget' )	=> 'design-46',
							),
						'description' 	=> __( 'Choose Slider design.', 'blog-designer-for-post-and-widget' ),
						'admin_label' 	=> true,
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Author', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_author',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Author.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Date', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_date',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Date.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Content', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_content',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Content.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Full Content', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_full_content',
						'value' 		=> array(
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							),
						'description' 	=> __( 'Show Full Content.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Read More', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_read_more',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Read More.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Content Word Limit', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'content_words_limit',
						'value' 		=> '20',
						'description' 	=> __( 'Enter Content Word Limit', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Content Tail', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'content_tail',
						'value' 		=> '...',
						'description' 	=> __( 'Enter Content Tail to display', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Tags', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_tags',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Tags.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Comments', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_comments',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Comments.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Link Behavior', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'link_target',
						'value' 		=> array(
							__( 'Self', 'blog-designer-for-post-and-widget' ) 		=> 'self',
							__( 'blank', 'blog-designer-for-post-and-widget' ) 	=> '_blank',
							),
						'description' 	=> __( 'Link Target.', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Image Height', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'image_height',
						'value' 		=> '',
						'description' 	=> __( 'Enter Image Height', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Read More Text', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'read_more_text',
						'value' 		=> '',
						'description' 	=> __( 'Enter Read More Text', 'blog-designer-for-post-and-widget' ),
					),
				// Date Setting
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Total items', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'limit',
						'value' 		=> 20,
						'description' 	=> __( 'Enter number to be displayed. Enter -1 to display all.', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
						),
					array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Post Order By', 'blog-designer-for-post-and-widget' ),
					'param_name' 	=> 'orderby',
					'value' 		=> array(
											__( 'Post Date', 'blog-designer-for-post-and-widget' ) 			=> 'date',
											__( 'Post ID', 'blog-designer-for-post-and-widget' ) 				=> 'ID',
											__( 'Post Author', 'blog-designer-for-post-and-widget' ) 			=> 'author',
											__( 'Post Title', 'blog-designer-for-post-and-widget' ) 			=> 'title',
											__( 'Post Modified Date', 'blog-designer-for-post-and-widget' ) 	=> 'modified',
											__( 'Random', 'blog-designer-for-post-and-widget' ) 				=> 'rand',
											__( 'Menu Order', 'blog-designer-for-post-and-widget' ) 			=> 'menu_order',
											),
					'description' 	=> __( 'Select order type.', 'blog-designer-for-post-and-widget' ),
					'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' )
					),
					array(
					'type' 			=> 'dropdown',
					'class' 		=> '',
					'heading' 		=> __( 'Order', 'blog-designer-for-post-and-widget' ),
					'param_name' 	=> 'order',
					'value' 		=> array(
											__( 'Descending', 'blog-designer-for-post-and-widget' ) 	=> 'desc',
											__( 'Ascending', 'blog-designer-for-post-and-widget' ) 	=> 'asc',
										),
					'description' 	=> __( 'Post Order.', 'blog-designer-for-post-and-widget' ),
					'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' )
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Category', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'category',
						'value' 		=> '',
						'description' 	=> __( 'Enter category id to display Posts categories wise.', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Category Name', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'show_category_name',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 		=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) 	=> 'false',
							),
						'description' 	=> __( 'Show Category Name or Not', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
						),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Exclude Category', 'blog-designer-for-post-and-widget' ),
					'param_name' 	=> 'exclude_cat',
					'value' 		=> '',
					'description' 	=> __( 'Exclude slides category. Works only if `Category` field is empty.', 'blog-designer-for-post-and-widget' ),
					'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
					),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Display Specific Post', 'blog-designer-for-post-and-widget' ),
					'param_name' 	=> 'posts',
					'value' 		=> '',
					'description' 	=> __( 'Enter post id which you only want to display.', 'blog-designer-for-post-and-widget' ),
					'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
					),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Exclude Post', 'blog-designer-for-post-and-widget' ),
					'param_name' 	=> 'exclude_post',
					'value' 		=> '',
					'description' 	=> __( 'Enter post id which you do not want to display.', 'blog-designer-for-post-and-widget' ),
					'group' 		=> __( 'Data Settings', 'blog-designer-for-post-and-widget' ),
					),

					//Slider Setting
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Dots', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'dots',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 	=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) => 'false',
							),
						'description' 	=> __( 'Show pagination dots.', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Slider Settings', 'blog-designer-for-post-and-widget' )
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Arrows', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'arrows',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 	=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) => 'false',
							),
						'description' 	=> __( 'Show Prev - Next arrows.', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Slider Settings', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Slide To Show', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'slides_column',
						'value' 		=> '3',
						'description' 	=> __( 'Enter Slide to show.', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Slider Settings', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Slide To Scroll', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'slides_scroll',
						'value' 		=> '1',
						'description' 	=> __( 'Enter slide to scroll.', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Slider Settings', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Autoplay', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'autoplay',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 	=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) => 'false',
							),
						'description' 	=> __( 'Enable autoplay.', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Slider Settings', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Loop', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'loop',
						'value' 		=> array(
							__( 'True', 'blog-designer-for-post-and-widget' ) 	=> 'true',
							__( 'False', 'blog-designer-for-post-and-widget' ) => 'false',
							),
						'description' 	=> __( 'Enable loop.', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Slider Settings', 'blog-designer-for-post-and-widget' ),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Autoplay Interval', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'autoplay_interval',
						'value' 		=> '2000',
						'description' 	=> __( 'Enter autoplay speed.', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Slider Settings', 'blog-designer-for-post-and-widget' ),
						'dependency' 	=> array(
							'element' 	=> 'autoplay',
							'value' 	=> array( 'true' ),
							),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Speed', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'speed',
						'value' 		=> '300',
						'description' 	=> __( 'Enter slide speed.', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Slider Settings', 'blog-designer-for-post-and-widget' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'RTL', 'blog-designer-for-post-and-widget' ),
						'param_name' 	=> 'rtl',
						'value' 		=> array(
							__( 'False', 'blog-designer-for-post-and-widget' ) => 'false',
							__( 'True', 'blog-designer-for-post-and-widget' ) 	=> 'true',
							),
						'description' 	=> __( 'RTL', 'blog-designer-for-post-and-widget' ),
						'group' 		=> __( 'Slider Settings', 'blog-designer-for-post-and-widget' ),
					),	
				),
			)
		);
	}
}

$wpspw_vc = new Wpspw_Vc();