<?php
/**
 * 'wpspw_recent_post' Shortcode
 * 
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to handle the `wpspw_recent_post` shortcode
 * 
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0.0
 */
function wpspw_pro_get_recent_post( $atts, $content = null ) {
   	
   	// Shortcode Parameters
	extract(shortcode_atts(array(
		'limit' 				=> '20',
		'category' 				=> '',
		'include_cat_child'		=> 'true',
		'category_name' 		=> '',
		'grid' 					=> '1',
		'design' 				=> 'design-16',
		'show_author'			=> 'true',
		'show_full_content' 	=> 'false',
		'show_date' 			=> 'true',
		'show_category_name' 	=> 'true',
		'show_content' 			=> 'true',
		'content_words_limit' 	=> '20',
		'show_read_more' 		=> 'true',
		'content_tail'			=> '...',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'link_target'			=> 'self',
		'image_height'			=> '',
		'read_more_text'		=> __('Read More', 'blog-designer-for-post-and-widget'),
		'exclude_cat'			=> array(),
		'exclude_post'			=> array(),
		'posts'					=> array(),
		'query_offset'			=> '',
		'show_tags'				=> 'false',
		'show_comments'			=> 'false',
		), $atts));
	
	$shortcode_designs 	= wpspw_pro_recent_post_designs();
	$content_tail 		= html_entity_decode($content_tail);
	$posts_per_page 	= !empty($limit) 						? $limit 						: '20';
	$gridcol			= !empty($grid) 						? $grid 						: '3';
	$cat 				= (!empty($category))					? explode(',',$category)	 	: '';
	$include_cat_child	= ( $include_cat_child == 'false' ) 	? false 						: true;
	$category_name 		= !empty($category_name) 				? $category_name 				: '';
	$design 			= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) 	: 'design-16';
	$showFullContent 	= ( $show_full_content == 'true' )		? 'true' 						: 'false';
	$showDate 			= ( $show_date == 'false' ) 			? 'false'						: 'true';
	$showCategory 		= ( $show_category_name == 'false' )	? 'false' 						: 'true';
	$showContent 		= ( $show_content == 'false' ) 			? 'false' 						: 'true';
	$words_limit 		= !empty( $content_words_limit ) 		? $content_words_limit	 		: 20;
	$showAuthor 		= ($show_author == 'false')				? 'false'						: 'true';
	$showreadmore 		= ( $show_read_more == 'false' )		? 'false' 						: 'true';
	$order 				= ( strtolower($order) == 'asc' ) 		? 'ASC' 						: 'DESC';
	$orderby 			= !empty($orderby) 						? $orderby 						: 'post_date';
	$link_target 		= ($link_target == 'blank') 			? '_blank' 						: '_self';
	$image_height		= (empty($image_height) && ($design == 'design-40' || $design == 'design-41' || $design == 'design-49' || $design == 'design-50')) ? '500' : $image_height;
	$image_height 		= (!empty($image_height))				? $image_height 				: '';
	$read_more_text 	= !empty($read_more_text) 				? $read_more_text 				: __('Read More', 'blog-designer-for-post-and-widget');
	$exclude_cat 		= !empty($exclude_cat)					? explode(',', $exclude_cat) 	: array();
	$exclude_post 		= !empty($exclude_post)					? explode(',', $exclude_post) 	: array();
	$posts 				= !empty($posts)						? explode(',', $posts) 			: array();
	$query_offset		= !empty($query_offset)					? $query_offset 				: null;
	$show_tags 			= ( $show_tags == 'false' ) 			? 'false'						: 'true';
	$show_comments 		= ( $show_comments == 'false' ) 		? 'false'						: 'true';
	
	// Shortcode file
	$post_design_file_path 	= WPSPW_PRO_DIR . '/templates/' . $design . '.php';
	$design_file 			= (file_exists($post_design_file_path)) ? $post_design_file_path : '';

	// Taking some globals
	global $post;

	// Taking some variables
	$count 			= 0;
	$grid_count 	= 1;
	$newscount 		= 0;
	$default_img	= wpspw_pro_get_option('default_img');

	// WP Query Parameters
	$args = array ( 
					'post_type'      		=> WPSPW_POST_TYPE,
					'post_status' 			=> array('publish'),
					'orderby'        		=> $orderby,
					'order'          		=> $order,
					'posts_per_page' 		=> $posts_per_page,
					'post__in'		 		=> $posts,
					'post__not_in'	 		=> $exclude_post,
					'ignore_sticky_posts'	=> true,
					'offset'				=> $query_offset,
				);

	// Category Parameter
	if($cat != "") {

		$args['tax_query'] = array(
								array(
									'taxonomy' 			=> WPSPW_CAT,
									'field' 			=> 'term_id',
									'terms' 			=> $cat,
									'include_children'	=> $include_cat_child,
									));

	} else if( !empty($exclude_cat) ) {

		$args['tax_query'] = array(
								array(
									'taxonomy' 			=> WPSPW_CAT,
									'field' 			=> 'term_id',
									'terms' 			=> $exclude_cat,
									'operator'			=> 'NOT IN',
									'include_children'	=> $include_cat_child,
								));
	}

	// WP Query
	$query 		= new WP_Query($args);
	$post_count = $query->post_count;

	ob_start();

	// If post is there
	if ( $query->have_posts() ) {
?>

	<div class="sp_wpspwpost_static <?php echo 'wpspw-'.$design; ?> wpspw-grid-<?php echo $gridcol; ?> wpspw-clearfix">

		<?php if ($design == "design-28" || $design == "design-29" || $design == "design-31")     { ?>
		<div class="wpspwpost-block">
		<?php }

		if ($design == "design-23") { ?>
			<div class="wpspw-post-grid wpspw-medium-3 wpspw-columns">
				<div class="wpspw-post-grid-content">
					<div class="latest-wpspw-post">
						<div class="latest-wpspw-post-inner">
							<h1 class="wpspw-post-title">
								<?php echo $category_name; ?>
							</h1>
						</div>
					</div>
				</div>
			</div>
			<?php } else if ($design != "design-23" && $category_name != '') { ?>
				<h1 class="category-title-main">
					<?php echo $category_name; ?>
				</h1>
			<?php }

			while ( $query->have_posts() ) : $query->the_post();

				$count++;
				$cat_links 	= array();
				$css_class 		= '';
				$feat_image 	= wpspw_pro_get_post_featured_image( $post->ID, 'full', true );
				$post_link 		= wpspw_pro_get_post_link( $post->ID );
				$terms 			= get_the_terms( $post->ID, WPSPW_CAT );
				$tags 			= get_the_tag_list(' ',', ');
				$comments 		= get_comments_number( $post->ID );
				$reply			= ($comments <= 1) ? __('Reply', 'blog-designer-for-post-and-widget') : __('Replies', 'blog-designer-for-post-and-widget');

				if($terms) {
					foreach ( $terms as $term ) {
						$term_link = get_term_link( $term );
						$cat_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
					}
				}
				$cate_name = join( " ", $cat_links );
				
				if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == ($count - 1) % $grid ) ) || 1 == $count ) { $css_class .= ' first'; }
				if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == $count % $grid ) ) || $post_count == $count ) { $css_class .= ' last'; }

			 	// Include shortcode html file
				if( $design_file ) {
					include( $design_file );
				}
				
				$newscount++;
				$grid_count++;
				
			endwhile; ?>

			<?php if ($design == "design-28" || $design == "design-29" || $design == "design-31")     { ?>
			</div>
			<?php } ?>
	</div>

<?php
	} // End of have_post()
	
	wp_reset_query(); // Reset WP Query
	
    $content .= ob_get_clean();
    return $content;
}

// 'wpspw_recent_post' Shortcode
add_shortcode('wpspw_recent_post', 'wpspw_pro_get_recent_post');