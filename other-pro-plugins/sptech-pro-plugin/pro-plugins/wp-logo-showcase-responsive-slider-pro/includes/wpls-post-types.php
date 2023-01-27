<?php
/**
 * Register Post type functionality
 *
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_register_post_types() {
	
	$wpls_logoshowcase_labels =  apply_filters( 'wpls_pro_post_labels', array(
									'name'                	=> __('Logo Showcase', 'logoshowcase'),
									'singular_name'       	=> __('Logo Showcase', 'logoshowcase'),
									'add_new'             	=> __('Add New', 'logoshowcase'),
									'add_new_item'        	=> __('Add New Logo Showcase', 'logoshowcase'),
									'edit_item'           	=> __('Edit Logo Showcase', 'logoshowcase'),
									'new_item'            	=> __('New Logo Showcase', 'logoshowcase'),
									'all_items'           	=> __('All Logo Showcase', 'logoshowcase'),
									'view_item'           	=> __('View Logo Showcase', 'logoshowcase'),
									'search_items'        	=> __('Search Logo Showcase', 'logoshowcase'),
									'not_found'           	=> __('No Logo Showcase found', 'logoshowcase'),
									'not_found_in_trash'  	=> __('No Logo Showcase found in Trash', 'logoshowcase'),
									'parent_item_colon'   	=> '',
									'menu_name'           	=> __('Logo Showcase', 'logoshowcase'),
									'featured_image'		=> __('Logo Image', 'logoshowcase'),
									'set_featured_image'	=> __('Set Logo Image', 'logoshowcase'),
									'remove_featured_image'	=> __('Remove logo image', 'logoshowcase'),
									'use_featured_image'	=> __('Use as logo image', 'logoshowcase'),
								));

	$wpls_logoshowcase_args = array(
									'labels' 				=> $wpls_logoshowcase_labels,
									'public' 				=> false,
									'menu_icon'   			=> 'dashicons-images-alt2',
									'show_ui' 				=> true,
									'show_in_menu' 			=> true,
									'query_var' 			=> false,
									'capability_type' 		=> 'post',
									'hierarchical' 			=> false,
									'supports' 				=> apply_filters('wpls_pro_post_supports', array('title', 'editor','page-attributes'))
								);

	// Register Logo Showcase post type
	register_post_type( WPLS_PRO_POST_TYPE, apply_filters( 'wpls_pro_post_type_args', $wpls_logoshowcase_args ) );
}

// Action to register post type
add_action('init', 'wpls_pro_register_post_types');

/**
 * Function to register taxonomy
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_register_taxonomies() {
	
    $cat_labels = apply_filters('wpls_pro_cat_labels', array(
        'name'              => __( 'Logo Category', 'logoshowcase' ),
        'singular_name'     => __( 'Lofo Category', 'logoshowcase' ),
        'search_items'      => __( 'Search Category', 'logoshowcase' ),
        'all_items'         => __( 'All Category', 'logoshowcase' ),
        'parent_item'       => __( 'Parent Category', 'logoshowcase' ),
        'parent_item_colon' => __( 'Parent Category:', 'logoshowcase' ),
        'edit_item'         => __( 'Edit Category', 'logoshowcase' ),
        'update_item'       => __( 'Update Category', 'logoshowcase' ),
        'add_new_item'      => __( 'Add New Category', 'logoshowcase' ),
        'new_item_name'     => __( 'New Category Name', 'logoshowcase' ),
        'menu_name'         => __( 'Logo Category', 'logoshowcase' ),
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
    
    // Register Logo Showcase category
    register_taxonomy( WPLS_PRO_CAT, array( WPLS_PRO_POST_TYPE ), $cat_args );
}

// Action to register taxonomy
add_action( 'init', 'wpls_pro_register_taxonomies');

/**
 * Function to update post messages
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_post_updated_messages( $messages ) {
	
	global $post, $post_ID;
	
	$messages[WPLS_PRO_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Logo Showcase updated.', 'logoshowcase' ) ),
		2 => __( 'Custom field updated.', 'logoshowcase' ),
		3 => __( 'Custom field deleted.', 'logoshowcase' ),
		4 => __( 'Logo Showcase updated.', 'logoshowcase' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Logo Showcase restored to revision from %s', 'logoshowcase' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Logo Showcase published.', 'logoshowcase' ) ),
		7 => __( 'Logo Showcase saved.', 'logoshowcase' ),
		8 => sprintf( __( 'Logo Showcase submitted.', 'logoshowcase' ) ),
		9 => sprintf( __( 'Logo Showcase scheduled for: <strong>%1$s</strong>.', 'logoshowcase' ),
		  date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ) ),
		10 => sprintf( __( 'Logo Showcase draft updated.', 'logoshowcase' ) ),
	);
	
	return $messages;
}

// Filter to update slider post message
add_filter( 'post_updated_messages', 'wpls_pro_post_updated_messages' );