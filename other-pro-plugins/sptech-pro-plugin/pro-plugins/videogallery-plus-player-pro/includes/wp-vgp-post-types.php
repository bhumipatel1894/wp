<?php
/**
 * Register Post type functionality
 *
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_register_post_types() {

	$wp_vgp_labels =  apply_filters( 'wp_vgp_post_labels', array(
		'name'                	=> __('Video Gallery', 'html5-videogallery-plus-player'),
		'singular_name'       	=> __('Video Gallery', 'html5-videogallery-plus-player'),
		'add_new'             	=> __('Add New', 'html5-videogallery-plus-player'),
		'add_new_item'        	=> __('Add New Video', 'html5-videogallery-plus-player'),
		'edit_item'           	=> __('Edit Video', 'html5-videogallery-plus-player'),
		'new_item'            	=> __('New Video', 'html5-videogallery-plus-player'),
		'all_items'           	=> __('All Video', 'html5-videogallery-plus-player'),
		'view_item'           	=> __('View Video Gallery', 'html5-videogallery-plus-player'),
		'search_items'        	=> __('Search Video', 'html5-videogallery-plus-player'),
		'not_found'           	=> __('No Video Gallery found', 'html5-videogallery-plus-player'),
		'not_found_in_trash'  	=> __('No Video Gallery found in Trash', 'html5-videogallery-plus-player'),
		'parent_item_colon'   	=> '',
		'featured_image'		=> __('Video Poster Image', 'html5-videogallery-plus-player'),
		'set_featured_image'	=> __('Set Video Poster Image', 'html5-videogallery-plus-player'),
		'remove_featured_image'	=> __('Remove Video Poster Image', 'html5-videogallery-plus-player'),
		'use_featured_image'	=> __('Use as Video Poster Image', 'html5-videogallery-plus-player'),
		'menu_name'           	=> __('Video Gallery Pro', 'html5-videogallery-plus-player'),
	));

	$videogallery_args = array(
		'labels' 				=> $wp_vgp_labels,
		'public' 				=> false,
		'publicly_queryable'	=> false,
		'show_ui' 				=> true,
		'show_in_menu' 			=> true,
		'query_var' 			=> false,
		'capability_type' 		=> 'post',
		'has_archive' 			=> false,
		'menu_icon'   			=> 'dashicons-format-video',
		'hierarchical' 			=> false,
		'supports' 				=> apply_filters('wp_vgp_post_supports', array('title', 'editor', 'thumbnail', 'page-attributes')),
	);

	// Register Video Gallery post type
	register_post_type( WP_VGP_POST_TYPE, apply_filters( 'wp_vgp_post_type_args', $videogallery_args ) );
}

// Action to register post type
add_action('init', 'wp_vgp_register_post_types');

/**
 * Function to register taxonomy
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_register_taxonomies() {

    $cat_labels = apply_filters('wp_vgp_cat_labels', array(
        'name'              => __( 'Category', 'html5-videogallery-plus-player' ),
        'singular_name'     => __( 'Category', 'html5-videogallery-plus-player' ),
        'search_items'      => __( 'Search Category', 'html5-videogallery-plus-player' ),
        'all_items'         => __( 'All Category', 'html5-videogallery-plus-player' ),
        'parent_item'       => __( 'Parent Category', 'html5-videogallery-plus-player' ),
        'parent_item_colon' => __( 'Parent Category:', 'html5-videogallery-plus-player' ),
        'edit_item'         => __( 'Edit Category', 'html5-videogallery-plus-player' ),
        'update_item'       => __( 'Update Category', 'html5-videogallery-plus-player' ),
        'add_new_item'      => __( 'Add New Category', 'html5-videogallery-plus-player' ),
        'new_item_name'     => __( 'New Category Name', 'html5-videogallery-plus-player' ),
        'menu_name'         => __( 'Video Category', 'html5-videogallery-plus-player' ),
    ));

    $cat_args = array(
    	'public'			=> false,
        'hierarchical'      => true,
        'labels'            => $cat_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => false,
    );

    // Register Video Gallery category
    register_taxonomy( WP_VGP_CAT, array( WP_VGP_POST_TYPE ), apply_filters('wp_vgp_cat_args', $cat_args) );
}

// Action to register taxonomy
add_action( 'init', 'wp_vgp_register_taxonomies');

/**
 * Function to update post messages
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_post_updated_messages( $messages ) {
	
	global $post, $post_ID;
	
	$messages[WP_VGP_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Video updated.', 'html5-videogallery-plus-player' ) ),
		2 => __( 'Custom field updated.', 'html5-videogallery-plus-player' ),
		3 => __( 'Custom field deleted.', 'html5-videogallery-plus-player' ),
		4 => __( 'Video updated.', 'html5-videogallery-plus-player' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Video restored to revision from %s', 'html5-videogallery-plus-player' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Video published.', 'html5-videogallery-plus-player' ) ),
		7 => __( 'Video saved.', 'html5-videogallery-plus-player' ),
		8 => sprintf( __( 'Video submitted.', 'html5-videogallery-plus-player' ) ),
		9 => sprintf( __( 'Video scheduled for: <strong>%1$s</strong>.', 'html5-videogallery-plus-player' ),
		  date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ) ),
		10 => sprintf( __( 'Video draft updated.', 'html5-videogallery-plus-player' ) ),
	);
	
	return $messages;
}

// Filter to update slider post message
add_filter( 'post_updated_messages', 'wp_vgp_post_updated_messages' );