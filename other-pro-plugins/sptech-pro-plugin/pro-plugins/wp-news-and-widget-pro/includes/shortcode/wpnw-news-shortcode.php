<?php
/**
 * `sp_news` Shortcode
 * 
 * @package WP News and Five Widgets Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wpnw_pro_get_news( $atts, $content = null ) {
	
	// Shortcode Parameters
	extract(shortcode_atts(array(
		'limit' 				=> '-1',
		'category' 				=> '',
		'include_cat_child'		=> 'true',
		'category_name' 		=> '',
		'design'	 			=> 'design-16',
		'grid' 					=> '1',
		'pagination' 			=> 'true',
		'pagination_type'		=> 'numeric',
		'show_date' 			=> 'true',
		'show_category_name'	=> 'true',
		'show_content' 			=> 'true',
		'show_full_content' 	=> 'false',
		'show_read_more' 		=> 'true',
		'content_words_limit' 	=> '20',
		'content_tail'			=> '...',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'link_target'			=> 'self',
		'posts'					=> array(),
		'exclude_post'			=> array(),
		'exclude_cat'			=> array(),
		'query_offset'			=> '',
		'image_height'			=> '',
		'read_more_text'		=> '',
	), $atts));
	
	$shortcode_designs 	= wpnw_sp_news_designs();
    $content_tail 		= html_entity_decode($content_tail);
    $posts_per_page		= (!empty($limit)) 		? $limit 					: '-1';
    $cat 				= (!empty($category))	? explode(',',$category) 	: '';
	$newscategory_name 	= ($category_name) 		? $category_name 			: '';
	$newdesign 			= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) 	: 'design-16';
	$newspagination 	= ($pagination == 'true')			? 'true'		: 'false';
	$pagination_type 	= ($pagination_type == 'prev-next')	? 'prev-next' 	: 'numeric';
	$gridcol 			= (!empty($grid))					? $grid 		: '1';
	$showDate 			= ( $show_date == 'true' ) 			? 'true' 		: 'false';
	$showCategory 		= ( $show_category_name == 'true' ) ? 'true' 		: 'false';
	$showContent 		= ( $show_content == 'true' ) 		? 'true' 		: 'false';
	$showFullContent 	= ( $show_full_content == 'true' ) 	? 'true' 		: 'false';
    $words_limit 		= !empty($content_words_limit) 		? $content_words_limit : '20';
	$showreadmore 		= ( $show_read_more == 'true' ) 	? 'true' 		: 'false';
	$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 		: 'DESC';
	$orderby 			= (!empty($orderby))				? $orderby		: 'date';
	$link_target 		= ($link_target == 'blank') 		? '_blank' 		: '_self';
	$posts 				= !empty($posts)					? explode(',', $posts) 			: array();
	$exclude_post 		= !empty($exclude_post)				? explode(',', $exclude_post) 	: array();
	$exclude_cat		= !empty($exclude_cat)				? explode(',', $exclude_cat) 	: array();
	$query_offset		= !empty($query_offset)				? $query_offset 				: null;
	$read_more_text 	= !empty($read_more_text) 			? $read_more_text 	: __('Read More', 'sp-news-and-widget');
	$image_height		= (empty($image_height) && ($newdesign == 'design-45' || $newdesign == 'design-46')) ? '500' : $image_height;
	$image_height 		= (!empty($image_height)) ? $image_height : '';
	$height_css 		= ($image_height) ? 'height:'.$image_height.'px;' : '';
	
	// Shortcode File
	$design_file_path 	= WPNW_PRO_DIR . '/templates/' . $newdesign . '.php';
	$design_file 		= (file_exists($design_file_path)) 	? $design_file_path : '';

	// Taking some globals
	global $paged, $post;
	
	// Taking some defaults
	$count 			= 0;
	$newscount 		= 0;
	$grid_count 	= 1;

	// Pagination Variable
	if(is_home() || is_front_page()) {
		$paged = get_query_var('page');
	} else {
		$paged = get_query_var('paged');
	}

	// Query Parameter
	$args = array (
		'post_type'     	 	=> WPNW_PRO_POST_TYPE,
		'post_status'			=> array( 'publish' ),
		'order'          		=> $order,
		'orderby'        		=> $orderby,
		'posts_per_page' 		=> $posts_per_page,
		'paged'          		=> $paged,
		'post__in'				=> $posts,
		'post__not_in'			=> $exclude_post,
		'ignore_sticky_posts'	=> true,
		'offset'				=> $query_offset,
	);
	
	// Category Parameter
	if( !empty($cat) ) {

		$args['tax_query'] = array(
								array(
									'taxonomy' 			=> WPNW_PRO_CAT,
									'field' 			=> 'term_id',
									'terms' 			=> $cat,
									'include_children'	=> $include_cat_child,
							));

	} else if( !empty($exclude_cat) ) {
		
		$args['tax_query'] = array(
									array(
										'taxonomy' 			=> WPNW_PRO_CAT,
										'field' 			=> 'term_id',
										'terms' 			=> $exclude_cat,
										'operator'			=> 'NOT IN',
										'include_children'	=> $include_cat_child,
								));
	}

	// WP Query
	$query 			= new WP_Query($args);
	$post_count 	= $query->post_count;

	ob_start();

	// If post is there
	if ( $query->have_posts() ) {
	?>

	<div class="sp_news_static <?php echo $newdesign; ?> wpnaw-grid-<?php echo $gridcol; ?> wpnaw-news-grid wpnaw-clearfix">

		<?php if ($newdesign == "design-28" || $newdesign == "design-29" || $newdesign == "design-31") { ?>
		<div class="news-block">		   
		<?php } ?>
		  	
			<?php if ($newdesign == "design-23") { ?>
			<div class="news-grid wpnews-medium-3 wpnews-columns">
				<div class="news-grid-content" style="<?php echo $height_css; ?>">
					<div class="latest-news">
						<div class="latest-news-inner">
							 <h1 class="news-title">
								<?php echo $newscategory_name; ?>
							</h1>
						</div>
					</div>
				</div>
			</div>
			<?php } else if ($newdesign != "design-23" && $newscategory_name !='') { ?>
			<h1 class="category-title-main">
				<?php echo $newscategory_name; ?>
			</h1>
			<?php } ?>

            <?php while ( $query->have_posts() ) : $query->the_post();
            	
            	$count++;
            	$news_links 			= array();
            	$css_class 				= '';
               	$terms 					= get_the_terms( $post->ID, WPNW_PRO_CAT );
               	$post_link 				= wpnw_pro_get_post_link( $post->ID );
				$post_featured_image 	= wpnw_get_post_featured_image( $post->ID, '', true );
                
				if($terms) {
					foreach ( $terms as $term ) {
						$term_link = get_term_link( $term );
						$news_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
					}
                }
                $cate_name = join( " ", $news_links );

                if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == ($count - 1) % $grid ) ) || 1 == $count ) { $css_class .= ' wpnw-first '; }
                if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == $count % $grid ) ) || $post_count == $count ) { $css_class .= ' wpnw-last '; }
              	
              	if( $design_file ) {
              		include( $design_file );
              	}
				
				$newscount++;
				$grid_count++;
            	endwhile;
           	?>
		<?php if ($newdesign == "design-28" || $newdesign == "design-29" || $newdesign == "design-31") { ?>
		</div>
		<?php } ?>
		
	</div>

	<?php if($newspagination == "true") { ?>
		<div class="news_pagination wpnaw-clearfix <?php echo $newdesign;?>">

			<?php if($pagination_type == "numeric") {

				echo wpnw_pro_pagination(array('paged' => $paged, 'total' => $query->max_num_pages));

			} else { ?>
				<div class="button-news-p"><?php next_posts_link( __('Next >>', 'sp-news-and-widget'), $query->max_num_pages ); ?></div>
				<div class="button-news-n"><?php previous_posts_link( __('<< Previous', 'sp-news-and-widget') ); ?> </div>
			<?php } ?>
		</div>
	<?php }

	} // End of have_post()

	wp_reset_query(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;			             
}

// 'sp_news' shortcode
add_shortcode('sp_news', 'wpnw_pro_get_news');