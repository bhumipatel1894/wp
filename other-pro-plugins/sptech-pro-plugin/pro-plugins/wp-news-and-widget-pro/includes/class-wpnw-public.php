<?php
/**
 * Public Class
 * 
 * Handles the front side functionality of plugin
 * 
 * @package WP News and Five Widgets Pro
 * @since 1.1.5
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpnw_Pro_Public {
	
	function __construct() {

		// Filter to set tag in query
		add_filter( 'pre_get_posts', array($this, 'wpnw_pro_news_display_tags') );
	}
	
	/**
	 * Set `post_tag` to main query.
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.0.0
	 */
	function wpnw_pro_news_display_tags( $query ) {

		if( is_tag() && $query->is_main_query() ) {
			$post_types = array( 'post', 'news' );
			$query->set( 'post_type', $post_types );
		}
	}

}

$wpnw_pro_public = new Wpnw_Pro_Public();