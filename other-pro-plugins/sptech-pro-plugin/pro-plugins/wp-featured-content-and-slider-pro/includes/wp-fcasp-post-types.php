<?php
/**
 * Register Post type functionality
 *
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
function wp_fcasp_register_post_type() {

	$wp_fcasp_labels =  apply_filters( 'wp_fcasp_post_type_labels', array(
										'name'                => __('Featured Content', 'wp-featured-content-and-slider'),
										'singular_name'       => __('Featured Content', 'wp-featured-content-and-slider'),
										'add_new'             => __('Add Featured Content', 'wp-featured-content-and-slider'),
										'add_new_item'        => __('Add Featured Content', 'wp-featured-content-and-slider'),
										'edit_item'           => __('Edit Featured Content', 'wp-featured-content-and-slider'),
										'new_item'            => __('New Featured Content', 'wp-featured-content-and-slider'),
										'all_items'           => __('All Featured Content', 'wp-featured-content-and-slider'),
										'view_item'           => __('View Featured Content', 'wp-featured-content-and-slider'),
										'search_items'        => __('Search Featured Content', 'wp-featured-content-and-slider'),
										'not_found'           => __('No Featured Content found', 'wp-featured-content-and-slider'),
										'not_found_in_trash'  => __('No Featured Content found in trash', 'wp-featured-content-and-slider'),
										'parent_item_colon'   => '',
										'menu_name'           => __('Featured Content Pro', 'wp-featured-content-and-slider'),
									));

	$wp_fcasp_args = array(
		'labels' 				=> $wp_fcasp_labels,
		'public' 				=> false,
		'show_ui' 				=> true,
		'query_var' 			=> true,
		'capability_type' 		=> 'post',
		'hierarchical' 			=> false,
		'menu_icon'   			=> 'dashicons-star-filled',
		'rewrite' 				=> false,
		'supports' 				=> apply_filters('wp_fcasp_post_supports', array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'))
	);

	// Register featured content post type
	register_post_type( WP_FCASP_POST_TYPE, apply_filters('wp_fcasp_post_type_args', $wp_fcasp_args) );
}

// Action to register post type
add_action('init', 'wp_fcasp_register_post_type');

/**
 * Function to register taxonomy
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
function wp_fcasp_register_taxonomies() {

    $wp_fcasp_cat_labels = apply_filters( 'wp_fcasp_cat_labels', array(
								'name'              => __( 'Category', 'wp-featured-content-and-slider' ),
								'singular_name'     => __( 'Category', 'wp-featured-content-and-slider' ),
								'search_items'      => __( 'Search Category', 'wp-featured-content-and-slider' ),
								'all_items'         => __( 'All Category', 'wp-featured-content-and-slider' ),
								'parent_item'       => __( 'Parent Category', 'wp-featured-content-and-slider' ),
								'parent_item_colon' => __( 'Parent Category:', 'wp-featured-content-and-slider' ),
								'edit_item'         => __( 'Edit Category', 'wp-featured-content-and-slider' ),
								'update_item'       => __( 'Update Category', 'wp-featured-content-and-slider' ),
								'add_new_item'      => __( 'Add New Category', 'wp-featured-content-and-slider' ),
								'new_item_name'     => __( 'New Category Name', 'wp-featured-content-and-slider' ),
								'menu_name'         => __( 'Category', 'wp-featured-content-and-slider' ),
			    			));

    $wp_fcasp_cat_args = array(
    	'public'			=> false,
        'hierarchical'      => true,
        'labels'            => $wp_fcasp_cat_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => false,
    );
    
    // Register featured content category
    register_taxonomy( WP_FCASP_CAT, array( WP_FCASP_POST_TYPE ), apply_filters('wp_fcasp_cat_args', $wp_fcasp_cat_args) );
}

// Action to register taxonomies
add_action( 'init', 'wp_fcasp_register_taxonomies');

/**
 * Function to update post message for team showcase
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
function wp_fcasp_post_updated_messages( $messages ) {
	
	global $post, $post_ID;
	
	$messages[WP_FCASP_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Featured Content updated.', 'wp-featured-content-and-slider' ) ),
		2 => __( 'Custom field updated.', 'wp-featured-content-and-slider' ),
		3 => __( 'Custom field deleted.', 'wp-featured-content-and-slider' ),
		4 => __( 'Featured Content updated.', 'wp-featured-content-and-slider' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Featured Content restored to revision from %s', 'wp-featured-content-and-slider' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Featured Content published.', 'wp-featured-content-and-slider' ) ),
		7 => __( 'Featured Content saved.', 'wp-featured-content-and-slider' ),
		8 => sprintf( __( 'Featured Content submitted.', 'wp-featured-content-and-slider' ) ),
		9 => sprintf( __( 'Featured Content scheduled for: <strong>%1$s</strong>.', 'wp-featured-content-and-slider' ),
		  date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ) ),
		10 => sprintf( __( 'Featured Content draft updated.', 'wp-featured-content-and-slider' ) ),
	);
	
	return $messages;
}

// Filter to update slider post message
add_filter( 'post_updated_messages', 'wp_fcasp_post_updated_messages' );