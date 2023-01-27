<?php
/**
 * Register Post type functionality
 *
 * @package WP News and Five Widgets Pro
 * @since 1.1.6
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @package WP News and Five Widgets Pro
 * @since 1.0.0
 */
function wpnw_pro_register_post_type() {

  	// 'News' post type
	$news_labels = array(
		'name'                 	=> __('News', 'sp-news-and-widget'),
		'singular_name'        	=> __('News', 'sp-news-and-widget'),
		'add_new'              	=> __('Add News Item', 'sp-news-and-widget'),
		'add_new_item'         	=> __('Add New News Item', 'sp-news-and-widget'),
		'edit_item'            	=> __('Edit News Item', 'sp-news-and-widget'),
		'new_item'             	=> __('New News Item', 'sp-news-and-widget'),
		'view_item'            	=> __('View News Item', 'sp-news-and-widget'),
		'search_items'         	=> __('Search  News Items', 'sp-news-and-widget'),
		'not_found'            	=> __('No News Items found', 'sp-news-and-widget'),
		'not_found_in_trash'   	=> __('No  News Items found in Trash', 'sp-news-and-widget'),
		'menu_name'            	=> __('News Pro', 'sp-news-and-widget'),
		'set_featured_image'	=> __( 'Set News Image', 'sp-news-and-widget' ),
		'featured_image'		=> __( 'News Image', 'sp-news-and-widget' ),
		'remove_featured_image'	=> __( 'Remove News Image', 'sp-news-and-widget' ),
		'use_featured_image'	=> __( 'Use as News image', 'sp-news-and-widget' ),
	);

	$news_args = array(
		'labels'              => $news_labels,
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_menu'        => true, 
		'query_var'           => true,
		'rewrite'             => array( 
										'slug'       => apply_filters('wpnw_pro_news_post_slug', 'news'),
										'with_front' => false
									),
		'capability_type'   => 'post',
		'has_archive'       => true,
		'hierarchical'      => false,
		'menu_position'     => 5,
		'menu_icon'         => 'dashicons-feedback',
		'supports'          => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'page-attributes', 'publicize'),
		'taxonomies'        => array('post_tag')
	);

	// Register news post type
    register_post_type( WPNW_PRO_POST_TYPE, apply_filters('wpnw_pro_register_post_type_news', $news_args) );
}

// Action to register plugin post type
add_action('init', 'wpnw_pro_register_post_type');

/**
 * Function to register taxonomy
 * 
 * @package WP News and Five Widgets Pro
 * @since 1.1.6
 */
function wpnw_pro_register_taxonomies() {

    $labels = array(
        'name'              => __( 'Category', 'sp-news-and-widget' ),
        'singular_name'     => __( 'Category', 'sp-news-and-widget' ),
        'search_items'      => __( 'Search Category', 'sp-news-and-widget' ),
        'all_items'         => __( 'All Category', 'sp-news-and-widget' ),
        'parent_item'       => __( 'Parent Category', 'sp-news-and-widget' ),
        'parent_item_colon' => __( 'Parent Category:', 'sp-news-and-widget' ),
        'edit_item'         => __( 'Edit Category', 'sp-news-and-widget' ),
        'update_item'       => __( 'Update Category', 'sp-news-and-widget' ),
        'add_new_item'      => __( 'Add New Category', 'sp-news-and-widget' ),
        'new_item_name'     => __( 'New Category Name', 'sp-news-and-widget' ),
        'menu_name'         => __( 'News Category', 'sp-news-and-widget' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => apply_filters('wpnw_pro_news_cat_slug', 'news-category'), ),
    );

    // Register 'news-category' taxonomies
    register_taxonomy( WPNW_PRO_CAT, array( WPNW_PRO_POST_TYPE ), apply_filters('wpnw_pro_register_category_news', $args) );
}

// Action to register plugin taxonomies
add_action( 'init', 'wpnw_pro_register_taxonomies');

/**
 * Function to update post message for news post type
 * 
 * @package WP News and Five Widgets Pro
 * @since 1.1.8
 */
function wpnw_pro_post_updated_messages( $messages ) {

	global $post, $post_ID;

	$messages[WPNW_PRO_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'News updated. <a href="%s">View News</a>', 'sp-news-and-widget' ), esc_url( get_permalink( $post_ID ) ) ),
		2 => __( 'Custom field updated.', 'sp-news-and-widget' ),
		3 => __( 'Custom field deleted.', 'sp-news-and-widget' ),
		4 => __( 'News updated.', 'sp-news-and-widget' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'News restored to revision from %s', 'sp-news-and-widget' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'News published. <a href="%s">View News</a>', 'sp-news-and-widget' ), esc_url( get_permalink( $post_ID ) ) ),
		7 => __( 'News saved.', 'sp-news-and-widget' ),
		8 => sprintf( __( 'News submitted. <a target="_blank" href="%s">Preview News</a>', 'sp-news-and-widget' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
		9 => sprintf( __( 'News scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview News</a>', 'sp-news-and-widget' ),
		  date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
		10 => sprintf( __( 'News draft updated. <a target="_blank" href="%s">Preview News</a>', 'sp-news-and-widget' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
	);

	return $messages;
}

// Filter to update news post message
add_filter( 'post_updated_messages', 'wpnw_pro_post_updated_messages' );