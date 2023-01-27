<?php
/**
 * Shorecode File
 *
 * Handles the 'featured-cnt-icon' shortcode functionality of plugin
 *
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Shorecode 'featured-cnt-icon'
 *
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
function wp_fcasp_fc_icon_shortcode( $atts, $content ) {
	
	// Shortcode Parameters
	extract(shortcode_atts(array(
		'type'					=> 'grid',
		'limit' 				=> '15',
		'grid' 					=> '12',
		'cat_id' 				=> '',
		'post_type' 			=> WP_FCASP_POST_TYPE,
		'taxonomy' 				=> WP_FCASP_CAT,
		'design' 				=> 'design-1',
		'fa_icon_color' 		=> '#3ab0e2',
		'image_style' 			=> 'square',
		'display_read_more' 	=> 'true',
		'slides_column'     	=> '3',
		'slides_scroll'     	=> '1',
		'dots'     				=> 'true',
		'arrows'     			=> 'true',
		'autoplay'     			=> 'true',
		'autoplay_interval' 	=> '3000',
		'speed'             	=> '300',
		'content_words_limit' 	=> '50',
		'show_content' 			=> 'true',
		'orderby'				=> 'post_date',
		'order'					=> 'DESC',
		'content_tail'			=> '...',
		'read_more_text'		=> '',
		'posts'					=> array(),
		'exclude_post'			=> array(),
		'exclude_cat'			=> array(),
		'link_target'			=> 'self',
		'rtl'					=> '',
		'infinite'				=> 'true',
		'centermode'			=> 'false'
	), $atts));
	
	global $post;
	
	// Enqueue Required script
	wp_enqueue_script( 'wpos-slick-jquery' );
	wp_enqueue_script( 'wpos-modernizr' );
	wp_enqueue_script( 'wp-fcasp-public-js' );
	
	$unique 				= wp_fcasp_get_unique();
	$shortcode_designs 		= wp_fcasp_fc_cnt_icon_designs();

	$type 					= ($type == 'slider') 		? 'slider' 			: 'grid';
	$limit 					= (!empty($limit)) 			? $limit 			: '15';
	$grid 					= (!empty($grid)) 			? $grid 				: '12';
	$grid_clmn 				= wp_fcasp_column( $grid );
	$cat 					= (!empty($cat_id))			? explode(',',$cat_id) 	: '';
	$post_type 				= (!empty($post_type))		? $post_type 		: WP_FCASP_POST_TYPE;
	$taxonomy 				= (!empty($taxonomy))		? $taxonomy 		: WP_FCASP_CAT;
	$imagestyle 			= !empty($image_style)		? $image_style 		: 'square';
	$design 				= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) : 'design-1';
	$display_read_more 		= ($display_read_more == 'true') ? 'true' : 'false';
	$faIconcolor 			= (!empty($fa_icon_color))	? $fa_icon_color	: '#3ab0e2';
	$slidesColumn 			= (!empty($slides_column)) 	? $slides_column 	: '3';
	$slidesScroll 			= (!empty($slides_scroll)) 	? $slides_scroll 	: '1';
	$slidedots 				= ($dots == 'true')			? 'true'			: 'false';
	$slidearrows 			= ($arrows == 'true')		? 'true'			: 'false';
	$slideautoplay 			= ($autoplay == 'true')		? 'true'			: 'false';
	$slideautoplayInterval 	= (!empty($autoplay_interval)) 	? $autoplay_interval 	: '3000';
	$slidespeed 			= (!empty($speed)) 				? $speed 				: '300';
	$words_limit 			= (!empty($content_words_limit))? $content_words_limit 	: '50';
	$showContent 			= ($show_content == 'true')		? 'true'		: 'false';
	$orderby 				= (!empty($orderby)) 			? $orderby : 'post_date';
	$order 					= (strtolower($order) == 'asc') ? 'ASC' : 'DESC';
	$exclude_cat 			= !empty($exclude_cat)				? explode(',', $exclude_cat) 	: array();
	$exclude_post 			= !empty($exclude_post)				? explode(',', $exclude_post) 	: array();
	$posts 					= !empty($posts)					? explode(',', $posts) 			: array();
	$read_more_text 		= !empty($read_more_text) 			? $read_more_text : __('Read More', 'wp-featured-content-and-slider');
	$link_target 			= ($link_target == 'blank') ? '_blank' 	: '_self';
	$infinite 				= ($infinite == 'true')		? 'true'	: 'false';
	$centermode 			= ($centermode == 'true')	? 'true'	: 'false';
	$content_tail 			= html_entity_decode($content_tail);
	
	// For RTL
	if( empty($rtl) && is_rtl() ) {
		$rtl = 'true';
	} elseif ( $rtl == 'true' ) {
		$rtl = 'true';
	} else {
		$rtl = 'false';
	}

	$design_file_path 		= WP_FCASP_DIR . '/templates/' . $design . '.php';
	$design_file 			= (file_exists($design_file_path)) ? $design_file_path : '';	
	
	// Taking some variables according to type
	if( $type == 'slider' ) {
		
		// Slider configuration
		$slider_conf = compact('slidedots', 'slidearrows', 'slidespeed', 'slideautoplay', 'slideautoplayInterval', 'slidesColumn', 'slidesScroll', 'rtl', 'infinite', 'centermode');
		
		$grid_cls 			= '';
		$slider_clmn_cls	= 'slider-col-'.$slidesColumn;
		$centermode_cls 	= ($centermode == 'true') ? 'wp-fcasp-scenter' : '';
		$wrapper_cls 		= "wp-fcasp-content-slider wp-fcasp-content-slider-{$unique} featured-content-slider wp-fcasp-{$design} {$centermode_cls}";
		
	} else {
		$slider_clmn_cls	= '';
		$grid_cls 			= 'wp-fcasp-medium-'.$grid_clmn.' wp-fcasp-columns';
		$wrapper_cls 		= "featured-content-list wp-fcasp-{$design} wp-fcasp-clearfix";
	}
	
	// Taking some variables
	$count 		= 0;
	$grid_count = 1;
	$css_class 	= '';
	
	// Query argument
	$args = array ( 
		'post_type'      	=> $post_type,
		'orderby'        	=> $orderby,
		'order'          	=> $order,
		'posts_per_page' 	=> $limit,
		'post__not_in'		=> $exclude_post,
		'post__in'			=> $posts,
	);
	
	// Taxonomy query parameter
	if($cat != "" ) {

		$args['tax_query'] = array( 
									array(
											'taxonomy' 	=> $taxonomy,
											'field' 	=> 'id',
											'terms' 	=> $cat
								));

    } else if( !empty($exclude_cat) ) {
		
		$args['tax_query'] = array(
									array(
										'taxonomy' 	=> $taxonomy,
										'field' 	=> 'id',
										'terms' 	=> $exclude_cat,
										'operator'	=> 'NOT IN'
										));
	}
    
    // WP Query
    $query 		= new WP_Query($args);
	$post_count = $query->post_count;
	
	ob_start();

	// If query post is there
	if( $query->have_posts() ) {
	?>

	<div class="wp-fcasp-content-wrp wp-fcasp-clearfix">
		<div class="<?php echo $wrapper_cls; ?>" id="wp-fcasp-fc-cnt-<?php echo $unique; ?>">
		<?php while ($query->have_posts()) : $query->the_post();
				
				$count++;
				
				if( $type == 'grid' ) {
					$css_class =  ($grid_count == 1) 	? 'wp-fcasp-first' : '';
					$css_class .= ($grid_count == $grid || $post_count == $count) ? ' wp-fcasp-last ' : '';
				}

				// Taking some post meta
				$post_featured_image 	= wp_fcasp_get_post_featured_image( $post->ID, '', true );
				$sliderurl 				= get_post_meta( $post->ID, 'wpfcas_slide_link', true );
				$fc_icon 				= get_post_meta( $post->ID, 'wpfcas_slide_icon', true );
				$inr_warp_cls			= !empty($sliderurl) ? 'wp-fcasp-linkenable'  : '';

				// Design File
				if( $design_file ) {
					include( $design_file );
	          	}

	          	// Resetting grid count
	          	if( $grid_count == $grid ) {
	          		$grid_count = 0;
	          	}

	        	$grid_count++;

			endwhile;
		?>
		</div><!-- end .featured-content-list -->
		
		<?php if( $type == 'slider' ) { ?>
		<div class="wp-fcasp-slider-conf"><?php echo json_encode( $slider_conf ); ?></div>
		<?php } ?>

	</div><!-- end .wp-fcasp-content-wrp -->

<?php
	} // End of post check

	wp_reset_query(); // Reset query

	$content .= ob_get_clean();
	return $content;
}

// 'featured-content' shortcode
add_shortcode('featured-cnt-icon', 'wp_fcasp_fc_icon_shortcode');