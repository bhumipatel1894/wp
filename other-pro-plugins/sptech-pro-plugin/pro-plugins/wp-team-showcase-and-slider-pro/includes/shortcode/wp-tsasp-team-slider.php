<?php
/**
 * Shortcode File
 *
 * Handles the 'wp-team-slider' shortcode of plugin
 *
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * 'wp-team-slider' shortcode
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_team_showcase_slider( $atts, $content = null ) {

    // Shortcode Parameter
	extract(shortcode_atts(array(
		'limit' 			=> '15',
		'category' 			=> '',
		'include_cat_child'	=> true,
		'design' 			=> 'design-1',
		'show_content'		=> 'true',
		'slides_column' 	=> '3',
		'slides_scroll' 	=> '1',
		'dots' 				=> 'true',
		'arrows' 			=> 'true',
		'autoplay' 			=> 'true',
		'autoplay_interval' => '3000',
		'speed' 			=> '500',
		'infinite'			=> 'true',
		'centermode'		=> 'false',
		'popup' 			=> 'true',
		'popup_design'		=> 'design-1',
		'popup_theme'		=> 'dark',
		'popup_gallery'		=> 'true',
		'show_full_content'	=> 'false',
		'words_limit' 		=> 40,
		'content_tail' 		=> '...',
		'social_limit'		=> '6',
		'image_fit'			=> 'true',
		'order'				=> 'DESC',
		'orderby'			=> 'date',
		'posts'				=> array(),
		'exclude_post'		=> array(),
		'exclude_cat'		=> array(),
		'rtl'				=> '',
		), $atts));
	
	$unique				= wp_tsasp_get_unique();
	$shortcode_designs 	= wp_tsasp_slider_designs();
	$content_tail 		= html_entity_decode($content_tail);
	$limit 				= !empty($limit) 					? $limit 			: 15;
	$category 			= (!empty($category))				? explode(',',$category) : '';
	$design 			= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) 	: 'design-1';
	$show_content 		= ( $show_content == 'false' ) 		? 'false' : 'true';
	$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 			: 'DESC';
	$orderby 			= (!empty($orderby))				? $orderby			: 'date';
	$popup 				= ( $popup == 'false' ) 			? 'false' 			: 'true';
	$popup_design 		= !empty($popup_design) 			? $popup_design 	: 'design-1';
	$popup_theme		= ($popup_theme == 'light')			? 'wptsas-light'	: 'wptsas-dark';
	$popup_gallery		= ($popup_gallery == 'true')		? 'true'			: 'false';
	$posts 				= !empty($posts)					? explode(',', $posts) 			: array();
	$exclude_post 		= !empty($exclude_post)				? explode(',', $exclude_post) 	: array();
	$exclude_cat		= !empty($exclude_cat)				? explode(',', $exclude_cat) 	: array();
	$slides_column 		= !empty($slides_column) 			? $slides_column 	: 3;
	$slides_scroll 		= !empty($slides_scroll) 			? $slides_scroll 	: 1;
	$autoplay 			= ($autoplay == 'false') 			? 'false' 			: 'true';
	$dots 				= ($dots == 'false') 				? 'false' 			: 'true';
	$arrows 			= ($arrows == 'false') 				? 'false' 			: 'true';
	$autoplay_interval 	= !empty($autoplay_interval) 		? $autoplay_interval: '3000';
	$speed 				= !empty($speed) 					? $speed 			: '500';		
	$infinite 			= ($infinite == 'true')				? 'true'			: 'false';
	$show_full_content 	= ( $show_full_content == 'true' ) 	? 'true' 			: 'false';
	$words_limit 		= !empty($words_limit) 				? $words_limit 		: 40;
	$image_fit			= ($image_fit == 'false')			? 0 : 1;

	// Shortcode file
	$design_file_path 	= WP_TSASP_DIR . '/templates/' . $design . '.php';
	$design_file 		= (file_exists($design_file_path)) ? $design_file_path 	: '';

	// Enqueus required script
	if( $popup == 'true' ) {
		wp_enqueue_script('wpos-magnific-script');
	}
	wp_enqueue_script( 'wpos-slick-jquery' );
	wp_enqueue_script( 'wp-tsasp-public-js' );

	// For RTL
	if( empty($rtl) && is_rtl() ) {
		$rtl = 'true';
	} elseif ( $rtl == 'true' ) {
		$rtl = 'true';
	} else {
		$rtl = 'false';
	}

	// Taking some globals
	global $post;

	// Taking some variables
	$popup_html 	= '';
	$style_offset	= '';
	$old_browser	= wp_tsasp_old_browser();

	// Class variables
	$class 				= '';
	$wrpper_cls			= '';
	$wrpper_cls 		.= ($popup == 'true') 	? ' wp-tsasp-popup' 		: '';
	$wrpper_cls			.= ($old_browser) 		? ' wp-tsasp-old-browser' 	: '';
	$wrpper_cls			.= ($image_fit) 		? ' wp-tsasp-image-fit' 	: '';

	$popup_cls			= $popup_theme;
	$popup_cls			.= ($image_fit) 			? ' wp-tsasp-image-fit' 	: '';
	$popup_cls			.= ($old_browser) 			? ' wp-tsasp-old-browser' 	: '';

	// Query Parameter
	$args = array (
		'post_type'      	=> WP_TSASP_POST_TYPE,
		'orderby'        	=> $orderby,
		'order'         	=> $order,
		'posts_per_page'	=> $limit,
		'post_status'		=> array( 'publish' ),
		'post__not_in'		=> $exclude_post,
		'post__in'			=> $posts,
	);

	// Category Parameter
	if( !empty($category) ) {

		$args['tax_query'] = array(
								array(
									'taxonomy' 			=> WP_TSASP_CAT,
									'field' 			=> 'term_id',
									'terms' 			=> $category,
									'include_children'	=> $include_cat_child,
							));

	} else if( !empty($exclude_cat) ) {
		
		$args['tax_query'] = array(
									array(
										'taxonomy' 			=> WP_TSASP_CAT,
										'field' 			=> 'term_id',
										'terms' 			=> $exclude_cat,
										'operator'			=> 'NOT IN',
										'include_children'	=> $include_cat_child,
								));
	}

	// WP Query
	$query 			= new WP_Query($args);
	$post_count 	= $query->post_count;

	// Slider configuration and taken care of centermode
	$slides_column 		= (!empty($slides_column) && $slides_column <= $post_count) ? $slides_column : $post_count;
	$centermode			= ($centermode == 'true' && $slides_column % 2 != 0 && $slides_column != $post_count) ? 'true' : 'false';
	$wrpper_cls			.= ($centermode == "true") ? ' wp-tsasp-scenter' : '';

	// Slider and Popup configuration
	$slider_conf 	= compact('slides_column', 'slides_scroll', 'dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed', 'rtl', 'infinite', 'centermode');
	$popup_conf 	= compact( 'popup_gallery' );

	ob_start();

	// If post is there
	if ( $query->have_posts() ) { ?>
		
		<div class="wp-tsasp-team-wrp wp-tsasp-team-slider-wrp wptsasp-clearfix">
			<div class="wp-tsasp-team-slider wp-tsasp-teamshowcase-slider wp-tsasp-<?php echo $design.' '.$wrpper_cls; ?>" id="wp-tsasp-team-slider-<?php echo $unique; ?>" ><?php				
				
				while ( $query->have_posts() ) : $query->the_post();

					// Taking some member details
	              	$teamfeat_image 	= wp_get_attachment_url( get_post_thumbnail_id() );
	              	$member_designation = get_post_meta($post->ID, '_member_designation', true);
	              	$member_department 	= get_post_meta($post->ID, '_member_department', true); 
	              	$skills 			= get_post_meta($post->ID, '_skills', true);
	              	$member_experience 	= get_post_meta($post->ID, '_member_experience', true); 

	              	$facebook_link 		= get_post_meta($post->ID, '_facebook_link', true);
	              	$google_link 		= get_post_meta($post->ID, '_google_link', true); 
	              	$likdin_link 		= get_post_meta($post->ID, '_likdin_link', true);
	              	$twitter_link 		= get_post_meta($post->ID, '_twitter_link', true);

	              	$popup_id 	= wp_tsasp_get_unique(); // Creating popup unique id
	              	$css_class 	= 'team-slider';
	              	$css_class	.= empty($teamfeat_image) ? ' no-team-img' : '';

					// Including file
	              	if( $design_file ) {
	              		include( $design_file );
	              	}

					// Creating Popup HTML
	              	if( $popup == 'true' ) {
	              		ob_start();
	              		include( WP_TSASP_DIR . '/templates/popup/'.$popup_design.'.php' );
	              		$popup_html .= ob_get_clean();
	              	}

	              	endwhile;
	            ?>
	        </div>
	        <div class="wp-tsasp-slider-conf" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
	        
	        <?php if($popup == 'true') { ?>
	        <div class="wp-tsasp-popup-conf" data-conf="<?php echo htmlspecialchars(json_encode($popup_conf)); ?>"></div>
	        <?php } ?>
	    </div>

		<?php echo $popup_html; // Printing popup html

	} // End of have posts

	wp_reset_query(); // Reset WP Query
	
	$content .= ob_get_clean();
	return $content;
}

// 'wp-team-slider' shortcode
add_shortcode( 'wp-team-slider', 'wp_tsasp_team_showcase_slider' );