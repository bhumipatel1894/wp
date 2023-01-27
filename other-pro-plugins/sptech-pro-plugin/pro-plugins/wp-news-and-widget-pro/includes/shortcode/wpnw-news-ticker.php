<?php
/**
 * `wpnw_news_ticker` Shortcode
 * 
 * @package WP News and Scrolling Widgets Pro
 * @since 2.0.2
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wpnw_pro_get_news_ticker( $atts, $content = null ) {
	
	// Shortcode Parameters
	extract(shortcode_atts(array(
		'limit' 				=> '20',
		'ticker_title'			=> __('Latest News', 'sp-news-and-widget'),
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
	wp_enqueue_script( 'wpnw-pro-public-script' );

	// Taking some globals
	global $post;

	// Taking some default
	$unique	= wpnw_pro_get_unique();

	// Ticker configuration
	$ticker_conf = compact('ticker_effect', 'autoplay', 'speed', 'font_style');

	// Query Parameter
	$args = array (
		'post_type'     	 	=> WPNW_PRO_POST_TYPE,
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
	
	<style type="text/css">
	#wpnw-ticker-<?php echo $unique; ?>{border-color:<?php echo $theme_color ?>;}
	#wpnw-ticker-<?php echo $unique; ?> >.wpnw-ticker-title{background:<?php echo $theme_color ?>;}
	#wpnw-ticker-<?php echo $unique; ?> >.wpnw-ticker-title>span{border-left-color:<?php echo $theme_color ?>;}
	#wpnw-ticker-<?php echo $unique; ?> >ul>li>a:hover, #wpnw-ticker-<?php echo $unique; ?>>ul>li>a{color:<?php echo $font_color; ?>;}
	#wpnw-ticker-<?php echo $unique; ?> > .wpnw-ticker-title > .wpos-ticker-title-cnt{color: <?php echo $heading_font_color; ?>}
	</style>

	<div class="wpnw-ticker-wrp" id="wpnw-ticker-<?php echo $unique; ?>">

    	<div class="wpos-ticker-title wpnw-ticker-title">
    		<?php if($ticker_title) { ?>
    		<div class="wpos-ticker-title-cnt"><?php echo $ticker_title; ?></div>
    		<?php } ?>
    		<span></span>
    	</div>

    	<ul class="wpnw-ticker-cnt">
    		
    		<?php while ( $query->have_posts() ) : $query->the_post();
    			$post_link = wpnw_pro_get_post_link( $post->ID );
    		?>
        	
        	<li class="wpnw-ticker-ele"><a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a></li>
            
            <?php endwhile; ?>

    	</ul>
        <div class="wpos-ticker-navi wpnw-ticker-navi">
        	<span></span>
            <span></span>
        </div>

        <div class="wpnw-pro-ticker-conf"><?php echo htmlspecialchars(json_encode($ticker_conf)); ?></div>
    </div>

<?php
	} // End of have_post()

	wp_reset_query(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// 'wpnw_news_ticker' shortcode
add_shortcode('wpnw_news_ticker', 'wpnw_pro_get_news_ticker');