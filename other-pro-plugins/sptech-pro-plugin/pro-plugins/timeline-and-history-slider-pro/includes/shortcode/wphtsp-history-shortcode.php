<?php
/**
 * 'th-slider' Shortcode
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


function wphtsp_pro_vertical_history( $atts, $content = null ){
	
	// Shortcode Parameter
	extract(shortcode_atts(array(
		'limit'    				=> '-1',
		'category' 				=> '',
		'include_cat_child'		=> 'true',
		'design' 				=> 'design-1',
		'orderby' 				=> 'date',
		'order' 				=> 'DESC',
		'show_title'			=> 'true',
		'show_full_content' 	=> 'false',
		'show_content' 			=> 'true',
		'show_date'				=> 'true',
		'content_words_limit' 	=> '70',
		'show_read_more' 		=> 'true',
		'content_tail'			=> '...',
		'link'					=> 'true',
		'link_target'			=> 'self',
		'read_more_text'		=> '',
		'posts'					=> array(),
		'exclude_post'			=> array(),
		'exclude_cat'			=> array(),
		'animation' 			=> 'no-animation',
		'post_type'				=> WPHTSP_PRO_POST_TYPE,
		'fa_icon_color' 		=> '',
		'background_color'		=> '',
		'font_color'			=> '',
		'image_size'			=> '',
	), $atts));

	$supportedposts		= wphtsp_supported_post_types();
	$shortcode_designs 	= wphtsp_history_designs();
	$supportedpostcat 	= wphtsp_supported_post_types_category();
	$content_tail 		= html_entity_decode($content_tail);
	$posts_per_page 	= !empty($limit) 						? $limit 						: '-1';
	$cat 				= (!empty($category))					? explode(',',$category)		: '';
	$include_cat_child 	= ( $include_cat_child == 'false' ) 	? 'false' 						: 'true';
	$historydesign 		= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) 	: 'design-1';
	$orderby 			= !empty($orderby) 						? $orderby 						: 'date';
	$order 				= ( strtolower($order) == 'asc' ) 		? 'ASC' 						: 'DESC';
	$show_title			= ( $show_title == 'false' ) 			? 0 							: 1;
	$showFullContent 	= ( $show_full_content == 'true' ) 		? 'true' 						: 'false';
	$showContent 		= ( $show_content == 'false' ) 			? 'false' 						: 'true';
	$show_date 			= ( $show_date == 'false' ) 			? 'false' 						: 'true';
	$words_limit 		= !empty($content_words_limit) 			? $content_words_limit 			: 20;
	$showreadmore 		= ( $show_read_more == 'false' ) 		? 'false' 						: 'true';
	$link 				= ( $link == 'false' )					? 0 							: 1;
	$link_target 		= ($link_target == 'blank') 			? '_blank' 						: '_self';
	$read_more_text 	= !empty($read_more_text) 				? $read_more_text 				: __('Read More', 'timeline-and-history-slider');
	$posts 				= !empty($posts)						? explode(',', $posts) 			: array();
	$exclude_post 		= !empty($exclude_post)					? explode(',', $exclude_post) 	: array();
	$exclude_cat 		= !empty($exclude_cat)					? explode(',', $exclude_cat) 	: array();
	$animation 			= !empty($animation) 					? $animation 					: 'no-animation';
	$post_type 			= ($post_type && (array_key_exists(trim($post_type), $supportedposts))) ? trim($post_type) 	: WPHTSP_PRO_POST_TYPE;
	$background_color 	= !empty($background_color) 			? $background_color 			: '';
	$font_color 		= !empty($font_color) 					? $font_color 					: '';
	$post_type_cat 		= ($post_type && (array_key_exists(trim($post_type), $supportedpostcat))) ? $supportedpostcat[$post_type] 	: WPHTSP_PRO_CAT;
	$unique 			= wphtsp_get_unique();

	// Shortcode file
	$historydesign_file_path 	= WPHTSP_PRO_DIR . '/templates/history/' . $historydesign . '.php';
	$design_file 				= (file_exists($historydesign_file_path)) ? $historydesign_file_path : '';

	// Taking some global
	global $post;

	// WP Query Parameter
	$args = array ( 
		'post_type'      	=> $post_type, 
		'order'          	=> $order,
		'orderby'        	=> $orderby,
		'posts_per_page' 	=> $posts_per_page,
		'post__not_in'		=> $exclude_post,
		'post__in'			=> $posts,
	);

	// Category Parameter
	if($cat != '') {

		$args['tax_query'] = array(
								array(
									'taxonomy' 			=> $post_type_cat,
									'field' 			=> 'term_id',
									'terms' 			=> $cat,
									'include_children'	=> $include_cat_child,
							));

	} elseif( !empty($exclude_cat) ) {

		$args['tax_query'] = array(
								array(
									'taxonomy' 			=> $post_type_cat,
									'field' 			=> 'term_id',
									'terms' 			=> $exclude_cat,
									'operator'			=> 'NOT IN',
									'include_children'	=> $include_cat_child,
							));
	}

	// WP Query
	$query 			= new WP_Query($args);
	$date_format	= wphts_pro_get_option('date_format');

	// Taking some variables
	$i 					= 1;
	$background_style	= !empty($background_color) 	? 'style="background:'.$background_color.'"' 	: '';
	$font_style			= !empty($font_color) 			? 'style="color:'.$font_color.'"' 				: '';

	// Enqueue required script
	if( $animation != 'no-animation' ) {
		wp_enqueue_script( 'wphts-pro-public-script' );
	}

	ob_start();	

	if ( $query->have_posts() ) : ?>
		
		<div class="wphtsp-history-wrp wphtsp-clearfix">
			<div id="<?php echo 'wphtsp-history-'.$historydesign; ?>" class="wphtsp-history-inner-wrp <?php echo 'wphtsp-history-'.$historydesign; ?> wphtsp-clearfix" data-animation="<?php echo $animation; ?>">
				<div class="wphtsp-timeline">
 
				  <?php while ( $query->have_posts() ) : $query->the_post();
				 
					    $feat_image 	= wphtsp_get_post_featured_image( $post->ID, $image_size, true );
					    $post_link  	= wphtsp_get_post_link( $post->ID );
					    $tl_cust_icon	= get_post_meta( $post->ID, WPHTSP_META_PREFIX.'custom_icon', true );
						$tl_icon 		= wphtsp_timeline_format_icon( $post->ID );

						// Conditions for post icons
						if( !empty($tl_cust_icon) ) {
							$display_icon = '<img class="wphtsp-cust-icon" src="'.$tl_cust_icon.'" alt="" />';
						} elseif ( !empty($tl_icon) ) {
							$display_icon ='<i style="color:'.$fa_icon_color.'" class="'.$tl_icon.'"></i>';
						}

						// Include shortcode html file
						if( $design_file ) {
							include( $design_file );
						}

						$i++;
					endwhile; ?>
				</div>
			</div>
		</div>
		<?php
	endif; // end if

	wp_reset_query(); // Reset WP Query
	
	$content .= ob_get_clean();
	return $content;
}

// 'th-history' shortcode
add_shortcode('th-history', 'wphtsp_pro_vertical_history');