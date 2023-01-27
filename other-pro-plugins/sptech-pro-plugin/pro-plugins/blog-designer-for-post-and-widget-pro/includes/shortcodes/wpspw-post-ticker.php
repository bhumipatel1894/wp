<?php
/**
 * `wpspw_ticker` Shortcode
 * 
 * @package Blog Designer - Post and Widget Pro
 * @since 1.1
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wpspw_pro_get_post_ticker( $atts, $content = null ) {
	
	// Shortcode Parameters
	extract(shortcode_atts(array(
		'limit' 				=> '20',
		'ticker_title'			=> __('Latest Post', 'blog-designer-for-post-and-widget'),
		'theme_color'			=> '#2096cd',
		'heading_font_color'	=> '#fff',
		'font_color'			=> '#2096cd',
		'font_style'			=> 'normal',
		'ticker_effect'			=> 'slide-v',
		'autoplay'				=> 'true',
		'speed'					=> 3000,
		'category' 				=> '',
		'include_cat_child'		=> 'true',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'link_target'			=> 'self',
		'posts'					=> array(),
		'exclude_post'			=> array(),
		'exclude_cat'			=> array(),
		'query_offset'			=> '',
	), $atts));

	$limit				= (!empty($limit)) 		? $limit 					: '-1';
    $ticker_title		= !empty($ticker_title)	? $ticker_title				: '';
    $cat 				= (!empty($category))	? explode(',',$category) 	: '';
    $order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 		: 'DESC';
	$orderby 			= (!empty($orderby))				? $orderby		: 'date';
	$link_target 		= ($link_target == 'blank') 		? '_blank' 		: '_self';
	$posts 				= !empty($posts)					? explode(',', $posts) 			: array();
	$exclude_post 		= !empty($exclude_post)				? explode(',', $exclude_post) 	: array();
	$exclude_cat		= !empty($exclude_cat)				? explode(',', $exclude_cat) 	: array();
	$query_offset		= !empty($query_offset)				? $query_offset 				: null;
	$link_target 		= ($link_target == 'blank') 		? '_blank' 						: '_self';
	$theme_color		= !empty($theme_color)				? $theme_color					: '#2096cd';
	$font_color			= !empty($font_color)				? $font_color					: '#2096cd';
	$heading_font_color	= !empty($heading_font_color)		? $heading_font_color			: '#fff';
	$ticker_effect		= !empty($ticker_effect)			? $ticker_effect				: 'fade';
	$autoplay 			= ($autoplay == 'false')			? 'false'						: 'true';
	$speed 				= !empty($speed)					? $speed						: 3000;

	// Enqueue required script
	wp_enqueue_script( 'wpos-ticker-script' );
	wp_enqueue_script( 'wpspw-pro-public-script' );

	// Taking some globals
	global $post;

	// Taking some default
	$unique	= wpspw_pro_get_unique();

	// Ticker configuration
	$ticker_conf = compact('ticker_effect', 'autoplay', 'speed', 'font_style');

	// Query Parameter
	$args = array (
		'post_type'     	 	=> WPSPW_POST_TYPE,
		'post_status'			=> array( 'publish' ),
		'order'          		=> $order,
		'orderby'        		=> $orderby,
		'posts_per_page' 		=> $limit,
		'post__in'				=> $posts,
		'post__not_in'			=> $exclude_post,
		'ignore_sticky_posts'	=> true,
		'offset'				=> $query_offset,
	);
	
	// Category Parameter
	if( !empty($cat) ) {

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
	$query 			= new WP_Query($args);
	$post_count 	= $query->post_count;

	ob_start();

	// If post is there
	if ( $query->have_posts() ) {
?>
	
	<style type="text/css">
	#wpspw-ticker-<?php echo $unique; ?>{border-color:<?php echo $theme_color ?>;}
	#wpspw-ticker-<?php echo $unique; ?> >.wpspw-ticker-title{background:<?php echo $theme_color ?>;}
	#wpspw-ticker-<?php echo $unique; ?> >.wpspw-ticker-title>span{border-left-color:<?php echo $theme_color ?>;}
	#wpspw-ticker-<?php echo $unique; ?> >ul>li>a:hover, #wpspw-ticker-<?php echo $unique; ?>>ul>li>a{color:<?php echo $font_color; ?>;}
	#wpspw-ticker-<?php echo $unique; ?> > .wpspw-ticker-title > h2{color: <?php echo $heading_font_color; ?>}
	</style>

	<div class="wpspw-ticker-wrp" id="wpspw-ticker-<?php echo $unique; ?>">

    	<div class="wpos-ticker-title wpspw-ticker-title">
    		<?php if($ticker_title) { ?>
    		<div class="wpos-ticker-title-cnt"><?php echo $ticker_title; ?></div>
    		<?php } ?>
    		<span></span>
    	</div>

    	<ul class="wpspw-ticker-cnt">
    		
    		<?php while ( $query->have_posts() ) : $query->the_post();
    			$post_link = wpspw_pro_get_post_link( $post->ID );
    		?>
        	
        	<li class="wpspw-ticker-ele"><a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a></li>
            
            <?php endwhile; ?>

    	</ul>
        <div class="wpos-ticker-navi wpspw-ticker-navi">
        	<span></span>
            <span></span>
        </div>
        <div class="wpspw-pro-ticker-conf"><?php echo htmlspecialchars(json_encode($ticker_conf)); ?></div>
    </div>

<?php
	} // End of have_post()

	wp_reset_query(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// 'wpspw_ticker' shortcode
add_shortcode('wpspw_ticker', 'wpspw_pro_get_post_ticker');