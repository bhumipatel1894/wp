<?php
/**
 * Visual Composer Class
 *
 * Handles the visual composer shortcode functionality of plugin
 *
 * @package WP Blog and Widgets Pro
 * @since 2.0.3
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpbaw_Vc {
	
	function __construct() {
		
		// Action to add 'blog' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wpbaw_pro_integrate_blog_grid_vc') );

		// Action to add 'recent_blog_post' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wpbaw_pro_integrate_recent_blog_grid_vc') );
		
		// Action to add 'recent_blog_post_slider' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wpbaw_pro_integrate_blog_slider_vc') );
	}

	/**
	 * Function to add 'blog' shortcode in vc
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 2.0.3
	 */
	function wpbaw_pro_integrate_blog_grid_vc() {
		vc_map(
			array(
				'name' 			=> __( 'WPOS - Blog Grid', 'wp-blog-and-widgets' ),
				'base' 			=> 'blog',
				'icon' 			=> 'icon-wpb-wp',
				'class' 		=> '',
				'category' 		=> __( 'Content', 'wp-blog-and-widgets'),
				'description' 	=> __( 'Display blog grid.', 'wp-blog-and-widgets' ),
				'params' 		=> array(
					// General settings
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Design', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'design',
						'value' 		=> array(
							__( 'Grid Design 16', 'wp-blog-and-widgets' ) 	=> 'design-16',
							__( 'Grid Design 17', 'wp-blog-and-widgets' ) 	=> 'design-17',
							__( 'Grid Design 18', 'wp-blog-and-widgets' ) 	=> 'design-18',
							__( 'Grid Design 19', 'wp-blog-and-widgets' ) 	=> 'design-19',
							__( 'Grid Design 20', 'wp-blog-and-widgets' ) 	=> 'design-20',
							__( 'Grid Design 21', 'wp-blog-and-widgets' ) 	=> 'design-21',
							__( 'Grid Design 22', 'wp-blog-and-widgets' ) 	=> 'design-22',
							__( 'Grid Design 24', 'wp-blog-and-widgets' ) 	=> 'design-24',
							__( 'Grid Design 25', 'wp-blog-and-widgets' ) 	=> 'design-25',
							__( 'Grid Design 26', 'wp-blog-and-widgets' ) 	=> 'design-26',
							__( 'Grid Design 27', 'wp-blog-and-widgets' ) 	=> 'design-27',
							__( 'Grid Design 30', 'wp-blog-and-widgets' ) 	=> 'design-30',
							__( 'Grid Design 34', 'wp-blog-and-widgets' ) 	=> 'design-34',
							__( 'Grid Design 35', 'wp-blog-and-widgets' ) 	=> 'design-35',
							__( 'Grid Design 36', 'wp-blog-and-widgets' ) 	=> 'design-36',
							__( 'Grid Design 37', 'wp-blog-and-widgets' ) 	=> 'design-37',
							__( 'Grid Design 42', 'wp-blog-and-widgets' ) 	=> 'design-42',
							__( 'Grid Design 44', 'wp-blog-and-widgets' ) 	=> 'design-44',
							__( 'Grid Design 45', 'wp-blog-and-widgets' ) 	=> 'design-45',
							__( 'Grid Design 48', 'wp-blog-and-widgets' ) 	=> 'design-48',
							),
						'description' 	=> __( 'Choose blog grid design.', 'wp-blog-and-widgets' ),
						'admin_label' 	=> true,
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Grid', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'grid',
						'value' 		=> array(
											__( 'Grid 1', 'wp-blog-and-widgets' ) => '1',
											__( 'Grid 2', 'wp-blog-and-widgets' ) => '2',
											__( 'Grid 3', 'wp-blog-and-widgets' ) => '3',
											__( 'Grid 4', 'wp-blog-and-widgets' ) => '4',											
										),
						'description' 	=> __( 'Choose number of grid for blog to display.', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Author', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'show_author',
						'value' 		=> array(
												__( 'True', 'wp-blog-and-widgets' ) 	=> 'true',
												__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
												),
						'description' 	=> __( 'Display blog author.', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Date', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'show_date',
						'value' 		=> array(
												__( 'True', 'wp-blog-and-widgets' ) 	=> 'true',
												__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
												),
						'description' 	=> __( 'Display blog date.', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Show Category', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'show_category_name',
						'value' 		=> array(
												__( 'True', 'wp-blog-and-widgets' ) 	=> 'true',
												__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
												),
						'description' 	=> __( 'Display category name.', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Content', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'show_content',
						'value' 		=> array(
												__( 'True', 'wp-blog-and-widgets' ) 	=> 'true',
												__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
												),
						'description' 	=> __( 'Display blog content.', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Full Content', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'show_full_content',
						'value' 		=> array(
												__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
												__( 'True', 'wp-blog-and-widgets' ) 	=> 'true',
												),
						'description' 	=> __( 'Display full blog content.', 'wp-blog-and-widgets' ),	
						'dependency' 	=> array(
											'element' 	=> 'show_content',
											'value' 	=> array( 'true' ),
											),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Content Word Limit', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'content_words_limit',
						'value' 		=> '20',
						'description' 	=> __( 'Enter blog content word limit.', 'wp-blog-and-widgets' ),
						'dependency' 	=> array(
										'element' 	=> 'show_full_content',
										'value' 	=> array( 'false' ),
										),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Content Tail', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'content_tail',
						'value' 		=> '...',
						'description' 	=> __( 'Display dots after the post content as continue reading.', 'wp-blog-and-widgets' ),
						'dependency' 	=> array(
											'element' 	=> 'show_full_content',
											'value' 	=> array( 'false' ),
											),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Read More', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'show_read_more',
						'value' 		=> array(
											__( 'True', 'wp-blog-and-widgets' ) 	=> 'true',
											__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
											),
						'description' 	=> __( 'Display read more button.', 'wp-blog-and-widgets' ),
						'dependency' 	=> array(
											'element' 	=> 'show_content',
											'value' 	=> array( 'true' ),
											),	
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Read More Text', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'read_more_text',
						'value' 		=> '',
						'description' 	=> __( 'Enter read more button text.', 'wp-blog-and-widgets' ),
						'dependency' 	=> array(
											'element' 	=> 'show_read_more',
											'value' 	=> array( 'true' ),
											),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Pagination', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'pagination',
						'value' 		=> array(
												__( 'True', 'wp-blog-and-widgets' ) 	=> 'true',
												__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
												),
						'description' 	=> __( 'Enable pagination.', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Pagination Type', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'pagination_type',
						'value' 		=> array(
												__( 'Numeric', 'wp-blog-and-widgets' ) 		=> 'numeric',
												__( 'Next-Prev', 'wp-blog-and-widgets' ) 	=> 'prev-next',
												),
						'description' 	=> __( 'Choose pagination type.', 'wp-blog-and-widgets' ),
						'dependency' 	=> array(
											'element' 	=> 'pagination',
											'value' 	=> array( 'true' ),
											),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Link Behavior', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'link_target',
						'value' 		=> array(
											__( 'Self', 'wp-blog-and-widgets' ) 	=> 'self',
											__( 'blank', 'wp-blog-and-widgets' ) 	=> 'blank',
											),
						'description' 	=> __( 'Choose link behaviour whether to open in a new tab or not.', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Image Height', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'image_height',
						'value' 		=> '',
						'description' 	=> __( 'Control height of the blog. You can enter any numeric number. e.g 500. Leave empty for default height.', 'wp-blog-and-widgets' ),
					),					

					// Data Settings
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Total Items', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'limit',
						'value' 		=> 20,
						'description' 	=> __( 'Enter number of post to be displayed. Enter -1 to display all.', 'wp-blog-and-widgets' ),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Post Order By', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'orderby',
						'value' 		=> array(
												__( 'Post Date', 'wp-blog-and-widgets' ) 				=> 'date',
												__( 'Post ID', 'wp-blog-and-widgets' ) 					=> 'ID',
												__( 'Post Author', 'wp-blog-and-widgets' ) 				=> 'author',
												__( 'Post Title', 'wp-blog-and-widgets' ) 				=> 'title',
												__( 'Post Modified Date', 'wp-blog-and-widgets' ) 		=> 'modified',
												__( 'Random', 'wp-blog-and-widgets' ) 					=> 'rand',
												__( 'Menu Order (Sort Order)', 'wp-blog-and-widgets' ) 	=> 'menu_order',
												),
						'description' 	=> __( 'Select order type.', 'wp-blog-and-widgets' ),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' )
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Order', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'order',
						'value' 		=> array(
												__( 'Descending', 'wp-blog-and-widgets' ) 	=> 'desc',
												__( 'Ascending', 'wp-blog-and-widgets' ) 	=> 'asc',
											),
						'description' 	=> __( 'Select sorting order.', 'wp-blog-and-widgets' ),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' )
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Category', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'category',
						'value' 		=> '',
						'description' 	=> sprintf(__( 'Enter category id to display Posts categories wise. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'wp-blog-and-widgets' ), add_query_arg( array( 'taxonomy' => WPBAW_PRO_CAT, 'post_type' => WPBAW_PRO_POST_TYPE ), 'edit-tags.php' )),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Exclude Category', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'exclude_cat',
						'value' 		=> '',
						'description' 	=> sprintf(__( 'Exclude post category. Works only if `Category` field is empty. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'wp-blog-and-widgets' ), add_query_arg( array( 'taxonomy' => WPBAW_PRO_CAT, 'post_type' => WPBAW_PRO_POST_TYPE ), 'edit-tags.php' )),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Display Specific Posts', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'posts',
						'value' 		=> '',
						'description' 	=> sprintf(__( 'Enter id of the post which you want to display. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'wp-blog-and-widgets' ), add_query_arg( array( 'post_type' => WPBAW_PRO_POST_TYPE ), 'edit.php' )),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Exclude Post', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'exclude_post',
						'value' 		=> '',
						'description' 	=> sprintf(__( 'Enter id of the post which you do not want to display. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'wp-blog-and-widgets' ), add_query_arg( array( 'post_type' => WPBAW_PRO_POST_TYPE ), 'edit.php' )),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Query Offset', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'query_offset',
						'value' 		=> '',
						'description' 	=> __( 'Exclude some blog post from starting. e.g if you pass 5 then it will skip first five post. Note: Do not use limit="-1" and pagination="true" with this.', 'wp-blog-and-widgets' ),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' ),
					),
				),
			)
		);
	}

	/**
	 * Function to add 'recent_blog_post' shortcode in vc
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 2.0.3
	 */
	function wpbaw_pro_integrate_recent_blog_grid_vc() {
		vc_map( 
			array(
				'name' 			=> __( 'WPOS - Recent Blog Grid', 'wp-blog-and-widgets' ),
				'base' 			=> 'recent_blog_post',
				'icon' 			=> 'icon-wpb-wp',
				'class' 		=> '',
				'category' 		=> __( 'Content', 'wp-blog-and-widgets'),
				'description' 	=> __( 'Display recent blog grid.', 'wp-blog-and-widgets' ),
				'params' 		=> array(

					// General settings
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Design', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'design',
						'value' 		=> array(
							__( 'Recent Design 16', 'wp-blog-and-widgets' ) => 'design-16',
							__( 'Recent Design 17', 'wp-blog-and-widgets' ) => 'design-17',
							__( 'Recent Design 18', 'wp-blog-and-widgets' ) => 'design-18',
							__( 'Recent Design 19', 'wp-blog-and-widgets' ) => 'design-19',
							__( 'Recent Design 20', 'wp-blog-and-widgets' ) => 'design-20',
							__( 'Recent Design 21', 'wp-blog-and-widgets' )	=> 'design-21',
							__( 'Recent Design 22', 'wp-blog-and-widgets' )	=> 'design-22',
							__( 'Recent Design 23', 'wp-blog-and-widgets' ) => 'design-23',
							__( 'Recent Design 25', 'wp-blog-and-widgets' ) => 'design-25',
							__( 'Recent Design 26', 'wp-blog-and-widgets' ) => 'design-26',
							__( 'Recent Design 27', 'wp-blog-and-widgets' ) => 'design-27',
							__( 'Recent Design 28', 'wp-blog-and-widgets' ) => 'design-28',
							__( 'Recent Design 29', 'wp-blog-and-widgets' ) => 'design-29',
							__( 'Recent Design 31', 'wp-blog-and-widgets' ) => 'design-31',
							__( 'Recent Design 34', 'wp-blog-and-widgets' ) => 'design-34',
							__( 'Recent Design 35', 'wp-blog-and-widgets' ) => 'design-35',
							__( 'Recent Design 37', 'wp-blog-and-widgets' ) => 'design-37',
							__( 'Recent Design 42', 'wp-blog-and-widgets' ) => 'design-42',
							__( 'Recent Design 44', 'wp-blog-and-widgets' ) => 'design-44',
							__( 'Recent Design 45', 'wp-blog-and-widgets' ) => 'design-45',
							__( 'Recent Design 47', 'wp-blog-and-widgets' ) => 'design-47',
							__( 'Recent Design 48', 'wp-blog-and-widgets' ) => 'design-48',
							__( 'Recent Design 49', 'wp-blog-and-widgets' ) => 'design-49',
							__( 'Recent Design 50', 'wp-blog-and-widgets' ) => 'design-50',
							),
						'description' 	=> __( 'Choose blog grid design.', 'wp-blog-and-widgets' ),
						'admin_label' 	=> true,
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Grid', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'grid',
						'value' 		=> array(
											__( 'Grid 1', 'wp-blog-and-widgets' ) => '1',
											__( 'Grid 2', 'wp-blog-and-widgets' ) => '2',
											__( 'Grid 3', 'wp-blog-and-widgets' ) => '3',
											__( 'Grid 4', 'wp-blog-and-widgets' ) => '4',											
										),
						'std'			=> 1,
						'description' 	=> __( 'Choose number of grid for post to display.', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Blog Heading', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'category_name',
						'value' 		=> '',
						'description' 	=> __( 'Enter blog heading.', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Author', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'show_author',
						'value' 		=> array(
												__( 'True', 'wp-blog-and-widgets' ) 	=> 'true',
												__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
											),
						'description' 	=> __( 'Display blog author.', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Date', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'show_date',
						'value' 		=> array(
												__( 'True', 'wp-blog-and-widgets' ) 	=> 'true',
												__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
											),
						'description' 	=> __( 'Display blog date.', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Show Category Name', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'show_category_name',
						'value' 		=> array(
												__( 'True', 'wp-blog-and-widgets' ) 	=> 'true',
												__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
											),
						'description' 	=> __( 'Display category name.', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Content', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'show_content',
						'value' 		=> array(
												__( 'True', 'wp-blog-and-widgets' ) 	=> 'true',
												__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
											),
						'description' 	=> __( 'Display blog content.', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Full Content', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'show_full_content',
						'value' 		=> array(
												__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
												__( 'True', 'wp-blog-and-widgets' ) 	=> 'true',
											),
						'description' 	=> __( 'Display full blog content.', 'wp-blog-and-widgets' ),
						'dependency' 	=> array(
												'element' 	=> 'show_content',
												'value' 	=> array( 'true' ),
												),
					),
					array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> __( 'Content Word Limit', 'wp-blog-and-widgets' ),
					'param_name' 	=> 'content_words_limit',
					'value' 		=> '20',
					'description' 	=> __( 'Enter blog content word limit.', 'wp-blog-and-widgets' ),
					'dependency' 	=> array(
										'element' 	=> 'show_full_content',
										'value' 	=> array( 'false' ),
										),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Content Tail', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'content_tail',
						'value' 		=> '...',
						'description' 	=> __( 'Display dots after the post content as continue reading.', 'wp-blog-and-widgets' ),
						'dependency' 	=> array(
											'element' 	=> 'show_full_content',
											'value' 	=> array( 'false' ),
											),
					),	
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Read More', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'show_read_more',
						'value' 		=> array(
												__( 'True', 'wp-blog-and-widgets' ) 	=> 'true',
												__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
											),
						'description' 	=> __( 'Display read more button.', 'wp-blog-and-widgets' ),
						'dependency' 	=> array(
											'element' 	=> 'show_content',
											'value' 	=> array( 'true' ),
											),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Read More Text', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'read_more_text',
						'value' 		=> '',
						'description' 	=> __( 'Enter read more button text.', 'wp-blog-and-widgets' ),
						'dependency' 	=> array(
											'element' 	=> 'show_read_more',
											'value' 	=> array( 'true' ),
											),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Link Behavior', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'link_target',
						'value' 		=> array(
												__( 'Self', 'wp-blog-and-widgets' ) 	=> 'self',
												__( 'blank', 'wp-blog-and-widgets' ) 	=> 'blank',
											),
						'description' 	=> __( 'Choose link behaviour whether to open in a new tab or not.', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Image Height', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'image_height',
						'value' 		=> '',
						'description' 	=> __( 'Control height of the blog. You can enter any numeric number. e.g 500. Leave empty for default height.', 'wp-blog-and-widgets' ),
					),

					// Data Settings
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Total Items', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'limit',
						'value' 		=> 20,
						'description' 	=> __( 'Enter number to be display post at a time. Enter -1 to display all.', 'wp-blog-and-widgets' ),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Post Order By', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'orderby',
						'value' 		=> array(
												__( 'Post Date', 'wp-blog-and-widgets' ) 				=> 'date',
												__( 'Post ID', 'wp-blog-and-widgets' ) 					=> 'ID',
												__( 'Post Author', 'wp-blog-and-widgets' ) 				=> 'author',
												__( 'Post Title', 'wp-blog-and-widgets' ) 				=> 'title',
												__( 'Post Modified Date', 'wp-blog-and-widgets' ) 		=> 'modified',
												__( 'Random', 'wp-blog-and-widgets' ) 					=> 'rand',
												__( 'Menu Order (Sort Order)', 'wp-blog-and-widgets' ) 	=> 'menu_order',
												),
						'description' 	=> __( 'Select order type.', 'wp-blog-and-widgets' ),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' )
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Order', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'order',
						'value' 		=> array(
												__( 'Descending', 'wp-blog-and-widgets' ) 	=> 'desc',
												__( 'Ascending', 'wp-blog-and-widgets' ) 	=> 'asc',
											),
						'description' 	=> __( 'Post Order.', 'wp-blog-and-widgets' ),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' )
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Category', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'category',
						'value' 		=> '',
						'description' 	=> sprintf(__( 'Enter category id to display Posts categories wise. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'wp-blog-and-widgets' ), add_query_arg( array( 'taxonomy' => WPBAW_PRO_CAT, 'post_type' => WPBAW_PRO_POST_TYPE ), 'edit-tags.php' )),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Exclude Category', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'exclude_cat',
						'value' 		=> '',
						'description' 	=> sprintf(__( 'Exclude post category. Works only if `Category` field is empty. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'wp-blog-and-widgets' ), add_query_arg( array( 'taxonomy' => WPBAW_PRO_CAT, 'post_type' => WPBAW_PRO_POST_TYPE ), 'edit-tags.php' )),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Display Specific Posts', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'posts',
						'value' 		=> '',
						'description' 	=> sprintf(__( 'Enter id of the post which you want to display. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'wp-blog-and-widgets' ), add_query_arg( array( 'post_type' => WPBAW_PRO_POST_TYPE ), 'edit.php' )),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Exclude Post', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'exclude_post',
						'value' 		=> '',
						'description' 	=> sprintf(__( 'Enter id of the post which you do not want to display. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'wp-blog-and-widgets' ), add_query_arg( array( 'post_type' => WPBAW_PRO_POST_TYPE ), 'edit.php' )),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' ),
						),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Query Offset', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'query_offset',
						'value' 		=> '',
						'description' 	=> __( 'Exclude some blog post from starting. e.g if you pass 5 then it will skip first five post. Note: Do not use limit="-1" and pagination="true" with this.', 'wp-blog-and-widgets' ),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' ),
					),
				),
			)
		);
	}

	/**
	 * Function to add 'recent_blog_post_slider' shortcode in vc
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 2.0.3
	 */
	function wpbaw_pro_integrate_blog_slider_vc() {
		vc_map( 
			array(
				'name' 			=> __( 'WPOS - Blog Slider', 'wp-blog-and-widgets' ),
				'base' 			=> 'recent_blog_post_slider',
				'icon' 			=> 'icon-wpb-wp',
				'class' 		=> '',
				'category' 		=> __( 'Content', 'wp-blog-and-widgets'),
				'description' 	=> __( 'Display blog slider.', 'wp-blog-and-widgets' ),
				'params' 	=> array(
					// General settings
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Design', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'design',
						'value' 		=> array(							
							__( 'Slider Design 1', 'wp-blog-and-widgets' ) 	=> 'design-1',
							__( 'Slider Design 2', 'wp-blog-and-widgets' ) 	=> 'design-2',
							__( 'Slider Design 3', 'wp-blog-and-widgets' ) 	=> 'design-3',
							__( 'Slider Design 4', 'wp-blog-and-widgets' ) 	=> 'design-4',
							__( 'Slider Design 5', 'wp-blog-and-widgets' ) 	=> 'design-5',
							__( 'Slider Design 6', 'wp-blog-and-widgets' ) 	=> 'design-6',
							__( 'Slider Design 7', 'wp-blog-and-widgets' ) 	=> 'design-7',
							__( 'Slider Design 8', 'wp-blog-and-widgets' ) 	=> 'design-8',
							__( 'Slider Design 9', 'wp-blog-and-widgets' ) 	=> 'design-9',
							__( 'Slider Design 10', 'wp-blog-and-widgets' ) => 'design-10',
							__( 'Slider Design 11', 'wp-blog-and-widgets' ) => 'design-11',
							__( 'Slider Design 12', 'wp-blog-and-widgets' ) => 'design-12',
							__( 'Slider Design 13', 'wp-blog-and-widgets' ) => 'design-13',
							__( 'Slider Design 14', 'wp-blog-and-widgets' ) => 'design-14',
							__( 'Slider Design 15', 'wp-blog-and-widgets' ) => 'design-15',
							__( 'Slider Design 32', 'wp-blog-and-widgets' ) => 'design-32',
							__( 'Slider Design 33', 'wp-blog-and-widgets' ) => 'design-33',
							__( 'Slider Design 38', 'wp-blog-and-widgets' ) => 'design-38',
							__( 'Slider Design 39', 'wp-blog-and-widgets' )	=> 'design-39',
							__( 'Slider Design 40', 'wp-blog-and-widgets' )	=> 'design-40',
							__( 'Slider Design 41', 'wp-blog-and-widgets' )	=> 'design-41',
							__( 'Slider Design 43', 'wp-blog-and-widgets' )	=> 'design-43',
							__( 'Slider Design 46', 'wp-blog-and-widgets' )	=> 'design-46',
							),
						'description' 	=> __( 'Choose blog slider design.', 'wp-blog-and-widgets' ),
						'std'  			=> 'design-8',
						'admin_label' 	=> true,						
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Author', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'show_author',
						'value' 		=> array(
												__( 'True', 'wp-blog-and-widgets' ) 	=> 'true',
												__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
											),
						'description' 	=> __( 'Display blog author.', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Date', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'show_date',
						'value' 		=> array(
												__( 'True', 'wp-blog-and-widgets' ) 	=> 'true',
												__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
											),
						'description' 	=> __( 'Display blog date.', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Show Category Name', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'show_category_name',
						'value' 		=> array(
												__( 'True', 'wp-blog-and-widgets' ) 	=> 'true',
												__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
											),
						'description' 	=> __( 'Display category name.', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Content', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'show_content',
						'value' 		=> array(
											__( 'True', 'wp-blog-and-widgets' ) 	=> 'true',
											__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
							),
						'description' 	=> __( 'Display blog content.', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Full Content', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'show_full_content',
						'value' 		=> array(
												__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
												__( 'True', 'wp-blog-and-widgets' ) 	=> 'true',
											),
						'description' 	=> __( 'Display full blog content.', 'wp-blog-and-widgets' ),
						'dependency' 	=> array(
											'element' 	=> 'show_content',
											'value' 	=> array( 'true' ),
											),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Content Word Limit', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'content_words_limit',
						'value' 		=> '20',
						'description' 	=> __( 'Enter blog content word limit.', 'wp-blog-and-widgets' ),
						'dependency' 	=> array(
											'element' 	=> 'show_full_content',
											'value' 	=> array( 'false' ),
											),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Content Tail', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'content_tail',
						'value' 		=> '...',
						'description' 	=> __( 'Display dots after the post content as continue reading.', 'wp-blog-and-widgets' ),
						'dependency' 	=> array(
											'element' 	=> 'show_full_content',
											'value' 	=> array( 'false' ),
											),
						),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Read More', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'show_read_more',
						'value' 		=> array(
											__( 'True', 'wp-blog-and-widgets' ) 	=> 'true',
											__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
							),
						'description' 	=> __( 'Display read more button.', 'wp-blog-and-widgets' ),
						'dependency' 	=> array(
											'element' 	=> 'show_content',
											'value' 	=> array( 'true' ),
											),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Read More Text', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'read_more_text',
						'value' 		=> '',
						'description' 	=> __( 'Enter read more button text.', 'wp-blog-and-widgets' ),
						'dependency' 	=> array(
											'element' 	=> 'show_read_more',
											'value' 	=> array( 'true' ),
											),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Link Behavior', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'link_target',
						'value' 		=> array(
											__( 'Self', 'wp-blog-and-widgets' ) 	=> 'self',
											__( 'blank', 'wp-blog-and-widgets' ) 	=> 'blank',
							),
						'description' 	=> __( 'Choose link behaviour whether to open in a new tab or not.', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Image Height', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'image_height',
						'value' 		=> '',
						'description' 	=> __( 'Control height of the blog. You can enter any numeric number. e.g 500. Leave empty for default height.', 'wp-blog-and-widgets' ),
					),
					
					// Data Setting
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Total items', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'limit',
						'value' 		=> 20,
						'description' 	=> __( 'Enter number of post to be displayed. Enter -1 to display all.', 'wp-blog-and-widgets' ),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Post Order By', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'orderby',
						'value' 		=> array(
												__( 'Post Date', 'wp-blog-and-widgets' ) 				=> 'date',
												__( 'Post ID', 'wp-blog-and-widgets' ) 					=> 'ID',
												__( 'Post Author', 'wp-blog-and-widgets' ) 				=> 'author',
												__( 'Post Title', 'wp-blog-and-widgets' ) 				=> 'title',
												__( 'Post Modified Date', 'wp-blog-and-widgets' ) 		=> 'modified',
												__( 'Random', 'wp-blog-and-widgets' ) 					=> 'rand',
												__( 'Menu Order (Sort Order)', 'wp-blog-and-widgets' ) 	=> 'menu_order',
											),
						'description' 	=> __( 'Select order type.', 'wp-blog-and-widgets' ),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' )
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Order', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'order',
						'value' 		=> array(
												__( 'Descending', 'wp-blog-and-widgets' ) => 'desc',
												__( 'Ascending', 'wp-blog-and-widgets' )  => 'asc',
											),
						'description' 	=> __( 'Select sorting order.', 'wp-blog-and-widgets' ),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' )
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Category', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'category',
						'value' 		=> '',
						'description' 	=> sprintf(__( 'Enter category id to display blog categories wise. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'wp-blog-and-widgets' ), add_query_arg( array( 'taxonomy' => WPBAW_PRO_CAT, 'post_type' => WPBAW_PRO_POST_TYPE ), 'edit-tags.php' )),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Exclude Category', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'exclude_cat',
						'value' 		=> '',
						'description' 	=> sprintf(__( 'Exclude post category. Works only if `Category` field is empty. You can pass multiple ids with comma seperated. You can find id at listing <a href="%1$s" target="_blank">page</a>.', 'wp-blog-and-widgets' ), add_query_arg( array( 'taxonomy' => WPBAW_PRO_CAT, 'post_type' => WPBAW_PRO_POST_TYPE ), 'edit-tags.php' )),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Display Specific Post', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'posts',
						'value' 		=> '',
						'description' 	=> sprintf(__( 'Enter id of the post which you want to display. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'wp-blog-and-widgets' ), add_query_arg( array( 'post_type' => WPBAW_PRO_POST_TYPE ), 'edit.php' )),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Exclude Post', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'exclude_post',
						'value' 		=> '',
						'description' 	=> sprintf(__( 'Enter id of the post which you do not want to display. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'wp-blog-and-widgets' ), add_query_arg( array( 'post_type' => WPBAW_PRO_POST_TYPE ), 'edit.php' )),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Query Offset', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'query_offset',
						'value' 		=> '',
						'description' 	=> __( 'Exclude some blog post from starting. e.g if you pass 5 then it will skip first five post. Note: Do not use limit="-1" and pagination="true" with this.', 'wp-blog-and-widgets' ),
						'group' 		=> __( 'Data Settings', 'wp-blog-and-widgets' ),
					),

					// Slider Setting
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Slide To Show', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'slides_column',
						'value' 		=> '3',
						'description' 	=> __( 'Enter number of column for slider.', 'wp-blog-and-widgets' ),
						'group' 		=> __( 'Slider Settings', 'wp-blog-and-widgets' ),
						'dependency'	=> array(
											'element'				=> 'design',
											'value_not_equal_to'	=> array( 'design-1', 'design-2', 'design-3', 'design-4', 'design-5', 'design-38', 'design-40', 'design-41', 'design-46' ),
											),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Slide To Scroll', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'slides_scroll',
						'value' 		=> '1',
						'description' 	=> __( 'Enter number of slides to scroll at a time.', 'wp-blog-and-widgets' ),
						'group' 		=> __( 'Slider Settings', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Dots', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'dots',
						'value' 		=> array(
												__( 'True', 'wp-blog-and-widgets' )  	=> 'true',
												__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
											),
						'description' 	=> __( 'Show dots indicators.', 'wp-blog-and-widgets' ),
						'group' 		=> __( 'Slider Settings', 'wp-blog-and-widgets' )
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Arrows', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'arrows',
						'value' 		=> array(
												__( 'True', 'wp-blog-and-widgets' )  	=> 'true',
												__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
											),
						'description' 	=> __( 'Show Prev - Next arrows.', 'wp-blog-and-widgets' ),
						'group' 		=> __( 'Slider Settings', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Autoplay', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'autoplay',
						'value' 		=> array(
												__( 'True', 'wp-blog-and-widgets' ) 	=> 'true',
												__( 'False', 'wp-blog-and-widgets' ) 	=> 'false',
											),
						'description' 	=> __( 'Enable slider autoplay.', 'wp-blog-and-widgets' ),
						'group' 		=> __( 'Slider Settings', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Speed', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'speed',
						'value' 		=> '300',
						'description' 	=> __( 'Enter slider speed.', 'wp-blog-and-widgets' ),
						'group' 		=> __( 'Slider Settings', 'wp-blog-and-widgets' ),
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> __( 'Autoplay Interval', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'autoplay_interval',
						'value' 		=> 2000,
						'description' 	=> __( 'Enter autoplay speed.', 'wp-blog-and-widgets' ),
						'group' 		=> __( 'Slider Settings', 'wp-blog-and-widgets' ),
						'dependency' 	=> array(
							'element' 	=> 'autoplay',
							'value' 	=> array( 'true' ),
						),
					),
					array(
						'type' 			=> 'dropdown',
						'class' 		=> '',
						'heading' 		=> __( 'Loop', 'wp-blog-and-widgets' ),
						'param_name' 	=> 'loop',
						'value' 		=> array(
												__( 'True', 'wp-blog-and-widgets' ) 	=> 'true',
												__( 'False', 'wp-blog-and-widgets' )	=> 'false',
											),
						'description' 	=> __( 'Enable infinite loop sliding.', 'wp-blog-and-widgets' ),
						'group' 		=> __( 'Slider Settings', 'wp-blog-and-widgets' ),
					),
				),
			)
		);
	}

}

$wpbaw_vc = new Wpbaw_Vc();