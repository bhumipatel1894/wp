<?php
/**
 * Visual Composer Class
 *
 * Handles the visual composer shortcode functionality of plugin
 *
 * @package WP News and Five Widgets Pro
 * @since 1.1.5
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpnw_Vc {
	
	function __construct() {

		// Action to add 'sp_news' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wpnw_integrate_news_post_grid_vc') );

		// Action to add 'sp_news_slider' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wpnw_integrate_news_post_slider_vc') );

		// Action to add 'wpnw_news_ticker' shortcode in vc
		add_action( 'vc_before_init', array($this, 'wpnw_integrate_news_post_ticker_vc') );
	}

	/**
	 * Function to add 'sp_news' shortcode in vc
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.1.5
	 */
	function wpnw_integrate_news_post_grid_vc() {
		vc_map( array(
			'name' 			=> __( 'WPOS - News Grid', 'sp-news-and-widget' ),
			'base' 			=> 'sp_news',
			'icon' 			=> 'icon-wpb-wp',
			'class' 		=> '',
			'category' 		=> __( 'Content', 'sp-news-and-widget'),
			'description' 	=> __( 'Display News post in grid view.', 'sp-news-and-widget' ),
			'params' 	=> array(
								// General settings
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Design', 'sp-news-and-widget' ),
									'param_name' 	=> 'design',
									'value' 		=> array(
															__( 'News Grid Design 16', 'sp-news-and-widget' ) 	=> 'design-16',
															__( 'News Grid Design 17', 'sp-news-and-widget' ) 	=> 'design-17',
															__( 'News Grid Design 18', 'sp-news-and-widget' ) 	=> 'design-18',
															__( 'News Grid Design 19', 'sp-news-and-widget' ) 	=> 'design-19',
															__( 'News Grid Design 20', 'sp-news-and-widget' ) 	=> 'design-20',
															__( 'News Grid Design 21', 'sp-news-and-widget' ) 	=> 'design-21',
															__( 'News Grid Design 22', 'sp-news-and-widget' ) 	=> 'design-22',
															__( 'News Grid Design 23', 'sp-news-and-widget' ) 	=> 'design-23',
															__( 'News Grid Design 24', 'sp-news-and-widget' ) 	=> 'design-24',
															__( 'News Grid Design 25', 'sp-news-and-widget' ) 	=> 'design-25',
															__( 'News Grid Design 26', 'sp-news-and-widget' ) 	=> 'design-26',
															__( 'News Grid Design 27', 'sp-news-and-widget' ) 	=> 'design-27',
															__( 'News Grid Design 28', 'sp-news-and-widget' ) 	=> 'design-28',
															__( 'News Grid Design 29', 'sp-news-and-widget' ) 	=> 'design-29',
															__( 'News Grid Design 30', 'sp-news-and-widget' ) 	=> 'design-30',
															__( 'News Grid Design 31', 'sp-news-and-widget' ) 	=> 'design-31',
															__( 'News Grid Design 34', 'sp-news-and-widget' ) 	=> 'design-34',
															__( 'News Grid Design 35', 'sp-news-and-widget' ) 	=> 'design-35',
															__( 'News Grid Design 36', 'sp-news-and-widget' ) 	=> 'design-36',
															__( 'News Grid Design 37', 'sp-news-and-widget' ) 	=> 'design-37',
															__( 'News Grid Design 44', 'sp-news-and-widget' ) 	=> 'design-44',
															__( 'News Grid Design 48', 'sp-news-and-widget' ) 	=> 'design-48',
															__( 'News Grid Design 49', 'sp-news-and-widget' ) 	=> 'design-49',
															__( 'News Grid Design 50', 'sp-news-and-widget' ) 	=> 'design-50',
														),
									'description' 	=> __( 'Choose news grid design.', 'sp-news-and-widget' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Grid', 'sp-news-and-widget' ),
									'param_name' 	=> 'grid',
									'value' 		=> array(
															__( 'Grid 1', 'sp-news-and-widget' ) => '1',
															__( 'Grid 2', 'sp-news-and-widget' ) => '2',
															__( 'Grid 3', 'sp-news-and-widget' ) => '3',
															__( 'Grid 4', 'sp-news-and-widget' ) => '4',
														),
									'description' 	=> __( 'Choose number of column for news.', 'sp-news-and-widget' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'News Heading', 'sp-news-and-widget' ),
									'param_name' 	=> 'category_name',
									'value' 		=> '',
									'description' 	=> __( 'Enter heading for news.', 'sp-news-and-widget' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Date', 'sp-news-and-widget' ),
									'param_name' 	=> 'show_date',
									'value' 		=> array(
															__( 'True', 'sp-news-and-widget' ) 	=> 'true',
															__( 'False', 'sp-news-and-widget' ) => 'false',
														),
									'description' 	=> __( 'Display news date.', 'sp-news-and-widget' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Category', 'sp-news-and-widget' ),
									'param_name' 	=> 'show_category_name',
									'value' 		=> array(
															__( 'True', 'sp-news-and-widget' ) 	=> 'true',
															__( 'False', 'sp-news-and-widget' ) => 'false',
														),
									'description' 	=> __( 'Display news category.', 'sp-news-and-widget' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Post Content', 'sp-news-and-widget' ),
									'param_name' 	=> 'show_content',
									'value' 		=> array(
														__( 'True', 'sp-news-and-widget' ) 	=> 'true',
														__( 'False', 'sp-news-and-widget' ) => 'false',
													),
									'description' 	=> __( 'Display news post content.', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Post Full Content', 'sp-news-and-widget' ),
									'param_name' 	=> 'show_full_content',
									'value' 		=> array(
														__( 'False', 'sp-news-and-widget' ) => 'false',
														__( 'True', 'sp-news-and-widget' ) 	=> 'true',
													),
									'description' 	=> __( 'Display news post full content.', 'sp-news-and-widget' ),
									'dependency' 	=> array(
														'element' 	=> 'show_content',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Words Limit', 'sp-news-and-widget' ),
									'param_name' 	=> 'content_words_limit',
									'value' 		=> '20',
									'description' 	=> __( 'Control News post content words limit.', 'sp-news-and-widget' ),
									'dependency' 	=> array(
														'element' 	=> 'show_full_content',
														'value' 	=> array( 'false' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Tail', 'sp-news-and-widget' ),
									'param_name' 	=> 'content_tail',
									'value' 		=> '...',
									'description' 	=> __( 'Display dots after the post content as continue reading.', 'sp-news-and-widget' ),
									'dependency' 	=> array(
														'element' 	=> 'show_full_content',
														'value' 	=> array( 'false' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Read More Button', 'sp-news-and-widget' ),
									'param_name' 	=> 'show_read_more',
									'value' 		=> array(
														__( 'True', 'sp-news-and-widget' ) 	=> 'true',
														__( 'False', 'sp-news-and-widget' ) => 'false',
													),
									'description' 	=> __( 'Display read more button.', 'sp-news-and-widget' ),
									'dependency' 	=> array(
														'element' 	=> 'show_content',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Read More Button Text', 'sp-news-and-widget' ),
									'param_name' 	=> 'read_more_text',
									'value' 		=> 'Read More',
									'description' 	=> __( 'Enter read more button text.', 'sp-news-and-widget' ),
									'dependency' 	=> array(
														'element' 	=> 'show_read_more',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Link Behaviour', 'sp-news-and-widget' ),
									'param_name' 	=> 'link_target',
									'value' 		=> array(
														__( 'Same Window', 'sp-news-and-widget' ) 	=> 'self',
														__( 'New Window', 'sp-news-and-widget' ) 	=> 'blank',
													),
									'description' 	=> __( 'Choose link behaviour whether to open in a new tab or not.', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'News Box Height', 'sp-news-and-widget' ),
									'param_name' 	=> 'image_height',
									'value' 		=> '',
									'description' 	=> __( 'Control height of the news. You can enter any numeric number. e.g 500. Leave empty for default height.', 'sp-news-and-widget' ),
								),

								// Data Settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Total items', 'sp-news-and-widget' ),
									'param_name' 	=> 'limit',
									'value' 		=> 15,
									'description' 	=> __( 'Enter number of post to be displayed. Enter -1 to display all.', 'sp-news-and-widget' ),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Order By', 'sp-news-and-widget' ),
									'param_name' 	=> 'orderby',
									'value' 		=> array(
														__( 'Post Date', 'sp-news-and-widget' ) 			=> 'date',
														__( 'Post Modified Date', 'sp-news-and-widget' ) 	=> 'modified',
														__( 'Post Title', 'sp-news-and-widget' ) 			=> 'title',
														__( 'Post Slug', 'sp-news-and-widget' )	 			=> 'name',
														__( 'Post ID', 'sp-news-and-widget' ) 				=> 'ID',
														__( 'Random', 'sp-news-and-widget' ) 				=> 'rand',
														__( 'Menu Order (Sort Order)', 'sp-news-and-widget' ) 	=> 'menu_order',
														__( 'Comment Count', 'sp-news-and-widget' ) 			=> 'comment_count',
													),
									'description' 	=> __( 'Select order type.', 'sp-news-and-widget' ),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Sort order', 'sp-news-and-widget' ),
									'param_name' 	=> 'order',
									'value' 		=> array(
														__( 'Descending', 'sp-news-and-widget' ) 	=> 'desc',
														__( 'Ascending', 'sp-news-and-widget' ) 	=> 'asc',
													),
									'description' 	=> __( 'Select sorting order.', 'sp-news-and-widget' ),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' )
								),								
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Category', 'sp-news-and-widget' ),
									'param_name' 	=> 'category',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Enter post category id to display post categories wise. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'sp-news-and-widget' ), add_query_arg( array( 'taxonomy' => WPNW_PRO_CAT, 'post_type' => WPNW_PRO_POST_TYPE ), 'edit-tags.php' )),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Include Category Children', 'sp-news-and-widget' ),
									'param_name' 	=> 'include_cat_child',
									'value' 		=> array(
														__( 'True', 'sp-news-and-widget' ) 	=> 'true',
														__( 'False', 'sp-news-and-widget' ) => 'false',
													),
									'description' 	=> __( 'Include category children or not. If you choose parent category then whether to display child category post.', 'sp-news-and-widget' ),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Category', 'sp-news-and-widget' ),
									'param_name' 	=> 'exclude_cat',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Exclude post category. Works only if `Category` field is empty. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'sp-news-and-widget' ), add_query_arg( array( 'taxonomy' => WPNW_PRO_CAT, 'post_type' => WPNW_PRO_POST_TYPE ), 'edit-tags.php' )),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Display Specific Post', 'sp-news-and-widget' ),
									'param_name' 	=> 'posts',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Enter id of the post. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'sp-news-and-widget' ), add_query_arg( array( 'post_type' => WPNW_PRO_POST_TYPE ), 'edit.php' )),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Post', 'sp-news-and-widget' ),
									'param_name' 	=> 'exclude_post',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Enter id of post which you do not want to display. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'sp-news-and-widget' ), add_query_arg( array( 'post_type' => WPNW_PRO_POST_TYPE ), 'edit.php' )),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Pagination', 'sp-news-and-widget' ),
									'param_name' 	=> 'pagination',
									'value' 		=> array(
													__( 'True', 'sp-news-and-widget' ) 	=> 'true',
													__( 'False', 'sp-news-and-widget' ) => 'false',
												),
									'description' 	=> __( 'Display Pagination for News Post', 'sp-news-and-widget' ),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Pagination Type', 'sp-news-and-widget' ),
									'param_name' 	=> 'pagination_type',
									'value' 		=> array(
													__( 'Numeric Pagination', 'sp-news-and-widget' ) 			=> 'numeric',
													__( 'Previous - Next Pagination', 'sp-news-and-widget' ) 	=> 'prev-next',
												),
									'description' 	=> __( 'Display Pagination for News Post', 'sp-news-and-widget' ),
									'dependency' 	=> array(
														'element' 	=> 'pagination',
														'value' 	=> array( 'true' ),
														),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Query Offset', 'sp-news-and-widget' ),
									'param_name' 	=> 'query_offset',
									'value' 		=> '',
									'description' 	=> __( 'Exclude some news post from starting. e.g if you pass 5 then it will skip first five post. Note: Do not use limit="-1" and pagination="true" with this.', 'sp-news-and-widget' ),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
							)
		));
	}

	/**
	 * Function to add 'sp_news_slider' shortcode in vc
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.1.5
	 */
	function wpnw_integrate_news_post_slider_vc() {
		vc_map( array(
			'name' 			=> __( 'WPOS - News Slider', 'sp-news-and-widget' ),
			'base' 			=> 'sp_news_slider',
			'icon' 			=> 'icon-wpb-wp',
			'class' 		=> '',
			'category' 		=> __( 'Content', 'sp-news-and-widget'),
			'description' 	=> __( 'Display News post in a slider view.', 'sp-news-and-widget' ),
			'params' 	=> array(
								// General settings
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Design', 'sp-news-and-widget' ),
									'param_name' 	=> 'design',
									'value' 		=> array(
															__( 'News Slider Design 1', 'sp-news-and-widget' )  => 'design-1',
															__( 'News Slider Design 2', 'sp-news-and-widget' )  => 'design-2',
															__( 'News Slider Design 3', 'sp-news-and-widget' )  => 'design-3',
															__( 'News Slider Design 4', 'sp-news-and-widget' )  => 'design-4',
															__( 'News Slider Design 5', 'sp-news-and-widget' )  => 'design-5',
															__( 'News Slider Design 6', 'sp-news-and-widget' )  => 'design-6',
															__( 'News Slider Design 7', 'sp-news-and-widget' )  => 'design-7',
															__( 'News Slider Design 8', 'sp-news-and-widget' )  => 'design-8',
															__( 'News Slider Design 9', 'sp-news-and-widget' )  => 'design-9',
															__( 'News Slider Design 10', 'sp-news-and-widget' ) => 'design-10',
															__( 'News Slider Design 11', 'sp-news-and-widget' ) => 'design-11',
															__( 'News Slider Design 12', 'sp-news-and-widget' ) => 'design-12',
															__( 'News Slider Design 13', 'sp-news-and-widget' ) => 'design-13',
															__( 'News Slider Design 14', 'sp-news-and-widget' ) => 'design-14',
															__( 'News Slider Design 15', 'sp-news-and-widget' ) => 'design-15',
															__( 'News Slider Design 32', 'sp-news-and-widget' ) => 'design-32',
															__( 'News Slider Design 33', 'sp-news-and-widget' ) => 'design-33',
															__( 'News Slider Design 38', 'sp-news-and-widget' ) => 'design-38',
															__( 'News Slider Design 39', 'sp-news-and-widget' ) => 'design-39',
															__( 'News Slider Design 43', 'sp-news-and-widget' ) => 'design-43',
														),
									'description' 	=> __( 'Choose News Slider design.', 'sp-news-and-widget' ),
									'std'			=>'design-8',
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Date', 'sp-news-and-widget' ),
									'param_name' 	=> 'show_date',
									'value' 		=> array(
															__( 'True', 'sp-news-and-widget' ) 	=> 'true',
															__( 'False', 'sp-news-and-widget' ) => 'false',
														),
									'description' 	=> __( 'Display News date.', 'sp-news-and-widget' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Show Category', 'sp-news-and-widget' ),
									'param_name' 	=> 'show_category_name',
									'value' 		=> array(
															__( 'True', 'sp-news-and-widget' ) 	=> 'true',
															__( 'False', 'sp-news-and-widget' ) => 'false',
														),
									'description' 	=> __( 'Display News category.', 'sp-news-and-widget' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'News Heading', 'sp-news-and-widget' ),
									'param_name' 	=> 'category_name',
									'value' 		=> '',
									'description' 	=> __( 'Enter heading for news.', 'sp-news-and-widget' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Post Content', 'sp-news-and-widget' ),
									'param_name' 	=> 'show_content',
									'value' 		=> array(
														__( 'True', 'sp-news-and-widget' ) 	=> 'true',
														__( 'False', 'sp-news-and-widget' ) 	=> 'false',
													),
									'description' 	=> __( 'Display News post content.', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Words Limit', 'sp-news-and-widget' ),
									'param_name' 	=> 'content_words_limit',
									'value' 		=> '20',
									'description' 	=> __( 'Control News post content words limit.', 'sp-news-and-widget' ),
									'dependency' 	=> array(
														'element' 	=> 'show_content',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Content Tail', 'sp-news-and-widget' ),
									'param_name' 	=> 'content_tail',
									'value' 		=> '...',
									'description' 	=> __( 'Display dots after the post content.', 'sp-news-and-widget' ),
									'dependency' 	=> array(
														'element' 	=> 'show_content',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Display Read More Button', 'sp-news-and-widget' ),
									'param_name' 	=> 'show_read_more',
									'value' 		=> array(
														__( 'True', 'sp-news-and-widget' ) 	=> 'true',
														__( 'False', 'sp-news-and-widget' ) => 'false',
													),
									'description' 	=> __( 'Display read more button.', 'sp-news-and-widget' ),
									'dependency' 	=> array(
														'element' 	=> 'show_content',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Read More Button Text', 'sp-news-and-widget' ),
									'param_name' 	=> 'read_more_text',
									'value' 		=> 'Read More',
									'description' 	=> __( 'Enter read more button text.', 'sp-news-and-widget' ),
									'dependency' 	=> array(
														'element' 	=> 'show_read_more',
														'value' 	=> array( 'true' ),
														),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Link Behaviour', 'sp-news-and-widget' ),
									'param_name' 	=> 'link_target',
									'value' 		=> array(
														__( 'Same Window', 'sp-news-and-widget' ) 	=> 'self',
														__( 'New Window', 'sp-news-and-widget' ) 	=> 'blank',
													),
									'description' 	=> __( 'Choose link bahaviour to open news post in same window or new window.', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Slider Height', 'sp-news-and-widget' ),
									'param_name' 	=> 'image_height',
									'value' 		=> '',
									'description' 	=> __( 'Enter news slider height. e.g. 500. Leave empty for default height.', 'sp-news-and-widget' ),
								),

								// Data Settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Total items', 'sp-news-and-widget' ),
									'param_name' 	=> 'limit',
									'value' 		=> 15,
									'description' 	=> __( 'Enter number of post to be displayed. Enter -1 to display all.', 'sp-news-and-widget' ),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Sort order', 'sp-news-and-widget' ),
									'param_name' 	=> 'order',
									'value' 		=> array(
														__( 'Descending', 'sp-news-and-widget' ) 	=> 'desc',
														__( 'Ascending', 'sp-news-and-widget' ) 	=> 'asc',
													),
									'description' 	=> __( 'Select sorting order.', 'sp-news-and-widget' ),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Order By', 'sp-news-and-widget' ),
									'param_name' 	=> 'orderby',
									'value' 		=> array(
														__( 'Post Date', 'sp-news-and-widget' ) 				=> 'date',
														__( 'Post ID', 'sp-news-and-widget' ) 					=> 'ID',
														__( 'Post Author', 'sp-news-and-widget' ) 				=> 'author',
														__( 'Post Title', 'sp-news-and-widget' ) 				=> 'title',
														__( 'Post Slug', 'sp-news-and-widget' )	 				=> 'name',
														__( 'Post Modified Date', 'sp-news-and-widget' ) 		=> 'modified',
														__( 'Menu Order (Sort Order)', 'sp-news-and-widget' ) 	=> 'menu_order',
														__( 'Random', 'sp-news-and-widget' ) 					=> 'rand',
													),
									'description' 	=> __( 'Select order type.', 'sp-news-and-widget' ),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Category', 'sp-news-and-widget' ),
									'param_name' 	=> 'category',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Enter post category id to display post categories wise. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'sp-news-and-widget' ), add_query_arg( array( 'taxonomy' => WPNW_PRO_CAT, 'post_type' => WPNW_PRO_POST_TYPE ), 'edit-tags.php' )),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Include Category Children', 'sp-news-and-widget' ),
									'param_name' 	=> 'include_cat_child',
									'value' 		=> array(
														__( 'True', 'sp-news-and-widget' ) 	=> 'true',
														__( 'False', 'sp-news-and-widget' ) => 'false',
													),
									'description' 	=> __( 'Include category children or not. If you choose parent category then whether to display child category post.', 'sp-news-and-widget' ),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Category', 'sp-news-and-widget' ),
									'param_name' 	=> 'exclude_cat',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Exclude post category. Works only if `Category` field is empty. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'sp-news-and-widget' ), add_query_arg( array( 'taxonomy' => WPNW_PRO_CAT, 'post_type' => WPNW_PRO_POST_TYPE ), 'edit-tags.php' )),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Display Specific Post', 'sp-news-and-widget' ),
									'param_name' 	=> 'posts',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Enter id of the post. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'sp-news-and-widget' ), add_query_arg( array( 'post_type' => WPNW_PRO_POST_TYPE ), 'edit.php' )),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Post', 'sp-news-and-widget' ),
									'param_name' 	=> 'exclude_post',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Enter id of post which you do not want to display. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'sp-news-and-widget' ), add_query_arg( array( 'post_type' => WPNW_PRO_POST_TYPE ), 'edit.php' )),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Query Offset', 'sp-news-and-widget' ),
									'param_name' 	=> 'query_offset',
									'value' 		=> '',
									'description' 	=> __( 'Exclude some news post from starting. e.g if you pass 5 then it will skip first five post. Note: Do not use limit="-1" and pagination="true" with this.', 'sp-news-and-widget' ),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),

								// Slider Settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Slides Column', 'sp-news-and-widget' ),
									'param_name' 	=> 'slides_column',
									'value' 		=> 4,
									'description' 	=> __( 'Enter number of column for slider.', 'sp-news-and-widget' ),
									'dependency'	=> array(
											'element'				=> 'design',
											'value_not_equal_to'	=> array( 'design-1', 'design-2', 'design-3', 'design-4', 'design-5', 'design-38', 'design-40', 'design-41', 'design-42' ),
											),
									'group' 		=> __( 'Slider Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Slides Scroll', 'sp-news-and-widget' ),
									'param_name' 	=> 'slides_scroll',
									'value' 		=> '1',
									'description' 	=> __( 'Enter number of slides to scroll at a time.', 'sp-news-and-widget' ),
									'group' 		=> __( 'Slider Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Dots', 'sp-news-and-widget' ),
									'param_name' 	=> 'dots',
									'value' 		=> array(
														__( 'True', 'sp-news-and-widget' ) 	=> 'true',
														__( 'False', 'sp-news-and-widget' ) => 'false',
													),
									'description' 	=> __( 'Show dots indicators.', 'sp-news-and-widget' ),
									'group' 		=> __( 'Slider Settings', 'sp-news-and-widget' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Arrows', 'sp-news-and-widget' ),
									'param_name' 	=> 'arrows',
									'value' 		=> array(
															__( 'True', 'sp-news-and-widget' ) 	=> 'true',
															__( 'False', 'sp-news-and-widget' ) => 'false',
														),
									'description' 	=> __( 'Show Prev - Next arrows.', 'sp-news-and-widget' ),
									'group' 		=> __( 'Slider Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Autoplay', 'sp-news-and-widget' ),
									'param_name' 	=> 'autoplay',
									'value' 		=> array(
														__( 'True', 'sp-news-and-widget' ) 	=> 'true',
														__( 'False', 'sp-news-and-widget' ) => 'false',
													),
									'description' 	=> __( 'Enable autoplay.', 'sp-news-and-widget' ),
									'group' 		=> __( 'Slider Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Autoplay Interval', 'sp-news-and-widget' ),
									'param_name' 	=> 'autoplay_interval',
									'value' 		=> '2000',
									'description' 	=> __( 'Enter autoplay speed.', 'sp-news-and-widget' ),
									'dependency' 	=> array(
														'element' 	=> 'autoplay',
														'value' 	=> array( 'true' ),
														),
									'group' 		=> __( 'Slider Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Speed', 'sp-news-and-widget' ),
									'param_name' 	=> 'speed',
									'value' 		=> '300',
									'description' 	=> __( 'Enter slide speed.', 'sp-news-and-widget' ),
									'dependency' 	=> array(
														'element' 	=> 'autoplay',
														'value' 	=> array( 'true' ),
														),
									'group' 		=> __( 'Slider Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Infinite', 'sp-news-and-widget' ),
									'param_name' 	=> 'loop',
									'value' 		=> array(
														__( 'True', 'sp-news-and-widget' ) 	=> 'true',
														__( 'False', 'sp-news-and-widget' ) => 'false',
													),
									'description' 	=> __( 'Enable infinite loop sliding.', 'sp-news-and-widget' ),
									'group' 		=> __( 'Slider Settings', 'sp-news-and-widget' ),
								),
							)
		));
	}

	/**
	 * Function to add 'wpnw_news_ticker' shortcode in vc
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.1.5
	 */
	function wpnw_integrate_news_post_ticker_vc() {
		vc_map( array(
			'name' 			=> __( 'WPOS - News Ticker', 'sp-news-and-widget' ),
			'base' 			=> 'wpnw_news_ticker',
			'icon' 			=> 'icon-wpb-wp',
			'class' 		=> '',
			'category' 		=> __( 'Content', 'sp-news-and-widget'),
			'description' 	=> __( 'Display News ticker.', 'sp-news-and-widget' ),
			'params' 	=> array(
								// General settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Ticker Title', 'sp-news-and-widget' ),
									'param_name' 	=> 'ticker_title',
									'value' 		=> 'Latest News',
									'description' 	=> __( 'Title for the Ticker.', 'sp-news-and-widget' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'colorpicker',
									'class' 		=> '',
									'heading' 		=> __( 'Theme Color', 'sp-news-and-widget' ),
									'param_name' 	=> 'theme_color',
									'value' 		=> '#2096cd',
									'description' 	=> __( 'Set Ticker theme color.', 'sp-news-and-widget' )
								),
								array(
									'type' 			=> 'colorpicker',
									'class' 		=> '',
									'heading' 		=> __( 'Ticker Heading Color', 'sp-news-and-widget' ),
									'param_name' 	=> 'heading_font_color',
									'value' 		=> '#fff',
									'description' 	=> __( 'Set Ticker Heading Font Color.', 'sp-news-and-widget' )
								),
								array(
									'type' 			=> 'colorpicker',
									'class' 		=> '',
									'heading' 		=> __( 'Font Color', 'sp-news-and-widget' ),
									'param_name' 	=> 'font_color',
									'value' 		=> '#2096cd',
									'description' 	=> __( 'Set Ticker Text Font Color.', 'sp-news-and-widget' ),

								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Font Style', 'sp-news-and-widget' ),
									'param_name' 	=> 'font_style',
									'value' 		=> array(
														__( 'Normal', 'sp-news-and-widget' ) 		=> 'normal',
														__( 'Bold', 'sp-news-and-widget' ) 			=> 'bold',
														__( 'Italic', 'sp-news-and-widget' ) 		=> 'italic',
														__( 'Bold Italic', 'sp-news-and-widget' ) 	=> 'bold-italic',
													),
									'description' 	=> __( 'Set Font Style of the Post.', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Ticker Effect', 'sp-news-and-widget' ),
									'param_name' 	=> 'ticker_effect',
									'value' 		=> array(
														__( 'Verticle Ticker Effect', 'sp-news-and-widget' ) 	=> 'slide-v',
														__( 'Horizontal Ticker Effect', 'sp-news-and-widget' ) 	=> 'slide-h',
														__( 'Fade Ticker Effect', 'sp-news-and-widget' ) 		=> 'fade',

													),
									'description' 	=> __( 'Set the ticker effect. e.g. Vertical, Horizontal, Fade', 'sp-news-and-widget' ),
									'admin_label' 	=> true,
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Link Behaviour', 'sp-news-and-widget' ),
									'param_name' 	=> 'link_target',
									'value' 		=> array(
														__( 'Same Window', 'sp-news-and-widget' ) 	=> 'self',
														__( 'New Window', 'sp-news-and-widget' ) 	=> 'blank',
													),
									'description' 	=> __( 'Choose link bahaviour to open news ticker post in same window or new window.', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Autoplay', 'sp-news-and-widget' ),
									'param_name' 	=> 'autoplay',
									'value' 		=> array(
														__( 'True', 'sp-news-and-widget' ) 	=> 'true',
														__( 'False', 'sp-news-and-widget' ) => 'false',
													),
									'description' 	=> __( 'Autoplay ticker.', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Speed', 'sp-news-and-widget' ),
									'param_name' 	=> 'speed',
									'value' 		=> '3000',
									'description' 	=> __( 'Speed of the ticker.', 'sp-news-and-widget' ),
									'dependency' 	=> array(
														'element' 	=> 'autoplay',
														'value' 	=> array( 'true' ),
														),
								),

								// Data Settings
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Total Ticker items', 'sp-news-and-widget' ),
									'param_name' 	=> 'limit',
									'value' 		=> 20,
									'description' 	=> __( 'Enter number of post to be displayed. Enter -1 to display all.', 'sp-news-and-widget' ),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Order By', 'sp-news-and-widget' ),
									'param_name' 	=> 'orderby',
									'value' 		=> array(
														__( 'Post Date', 'sp-news-and-widget' ) 			=> 'date',
														__( 'Post Modified Date', 'sp-news-and-widget' ) 	=> 'modified',
														__( 'Post Title', 'sp-news-and-widget' ) 			=> 'title',
														__( 'Post Slug', 'sp-news-and-widget' )	 			=> 'name',
														__( 'Post ID', 'sp-news-and-widget' ) 				=> 'ID',
														__( 'Random', 'sp-news-and-widget' ) 				=> 'rand',
														__( 'Menu Order (Sort Order)', 'sp-news-and-widget' ) 	=> 'menu_order',
														__( 'Comment Count', 'sp-news-and-widget' ) 			=> 'comment_count',
													),
									'description' 	=> __( 'Select order type.', 'sp-news-and-widget' ),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' )
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Sort order', 'sp-news-and-widget' ),
									'param_name' 	=> 'order',
									'value' 		=> array(
														__( 'Descending', 'sp-news-and-widget' ) 	=> 'desc',
														__( 'Ascending', 'sp-news-and-widget' ) 	=> 'asc',
													),
									'description' 	=> __( 'Select sorting order.', 'sp-news-and-widget' ),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' )
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Category', 'sp-news-and-widget' ),
									'param_name' 	=> 'category',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Enter post category id to display post categories wise. You can pass multiple ids with comma seperated. You can find id at listing <a href="%1$s" target="_blank">page</a>.', 'sp-news-and-widget' ), add_query_arg( array( 'taxonomy' => WPNW_PRO_CAT, 'post_type' => WPNW_PRO_POST_TYPE ), 'edit-tags.php' )),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Include Category Children', 'sp-news-and-widget' ),
									'param_name' 	=> 'include_cat_child',
									'value' 		=> array(
														__( 'True', 'sp-news-and-widget' ) 	=> 'true',
														__( 'False', 'sp-news-and-widget' ) => 'false',
													),
									'description' 	=> __( 'Include category children or not. If you choose parent category then whether to display child category post.', 'sp-news-and-widget' ),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Category', 'sp-news-and-widget' ),
									'param_name' 	=> 'exclude_cat',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Exclude post category. You can pass multiple ids with comma seperated. Works only if `Category` field is empty. You can find id at listing <a href="%1$s" target="_blank">page</a>.', 'sp-news-and-widget' ), add_query_arg( array( 'taxonomy' => WPNW_PRO_CAT, 'post_type' => WPNW_PRO_POST_TYPE ), 'edit-tags.php' )),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Display Specific Post', 'sp-news-and-widget' ),
									'param_name' 	=> 'posts',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Enter id of the post. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'sp-news-and-widget' ), add_query_arg( array( 'post_type' => WPNW_PRO_POST_TYPE ), 'edit.php' )),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Exclude Specific Post', 'sp-news-and-widget' ),
									'param_name' 	=> 'exclude_post',
									'value' 		=> '',
									'description' 	=> sprintf(__( 'Enter id of post which you do not want to display. You can find id at listing <a href="%1$s" target="_blank">page</a>. You can pass multiple ids with comma seperated.', 'sp-news-and-widget' ), add_query_arg( array( 'post_type' => WPNW_PRO_POST_TYPE ), 'edit.php' )),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Query Offset', 'sp-news-and-widget' ),
									'param_name' 	=> 'query_offset',
									'value' 		=> '',
									'description' 	=> __( 'Exclude some news post from starting. e.g if you pass 5 then it will skip first five post. Note: Do not use limit="-1" and pagination="true" with this.', 'sp-news-and-widget' ),
									'group' 		=> __( 'Data Settings', 'sp-news-and-widget' ),
								),
							)
		));
	}
}

$wpnw_vc = new Wpnw_Vc();