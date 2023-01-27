<?php

/**
 * Register Post type functionality
 *
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */

function wphtsp_register_post_type() {
    
    $wphtsp_labels = array(
        'name'                 => __('Timeline Slider', 'timeline-and-history-slider'),
        'singular_name'        => __('Timeline Slider', 'timeline-and-history-slider'),
        'add_new'              => __('Add Timeline', 'timeline-and-history-slider'),
        'add_new_item'         => __('Add New slide', 'timeline-and-history-slider'),
        'edit_item'            => __('Edit', 'timeline-and-history-slider'),
        'new_item'             => __('New', 'timeline-and-history-slider'),
        'view_item'            => __('View', 'timeline-and-history-slider'),
        'search_items'         => __('Search', 'timeline-and-history-slider'),
        'not_found'            =>  __('NoItems found', 'timeline-and-history-slider'),
        'not_found_in_trash'   => __('No Items found in Trash', 'timeline-and-history-slider'), 
        'parent_item_colon'    => '',  
    	'menu_name'            => __( 'Timeline Slider Pro', 'admin menu', 'timeline-and-history-slider' )
    );

    $wphtsp_args = array(
        'labels'              => $wphtsp_labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'show_ui'             => true,
        'show_in_menu'        => true, 
        'query_var'           => true,
        'rewrite'             => array( 
        							'slug'       => apply_filters('wphtsp_post_slug','timeline_slider_post'),
        							'with_front' => false
    							),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 8,
    	'menu_icon'           => 'dashicons-editor-ul',
        'supports'            => apply_filters('wphtsp_post_supports', array('title', 'editor', 'thumbnail', 'page-attributes', 'post-formats')),
    );

    // Register post type
    register_post_type( WPHTSP_PRO_POST_TYPE, apply_filters('wphtsp_register_post_type_history', $wphtsp_args) );
}

// Action to register plugin post type
add_action('init', 'wphtsp_register_post_type');

function wphtsp_register_taxonomies() {
    
    $labels = array(
        'name'              => __( 'Category', 'timeline-and-history-slider' ),
        'singular_name'     => __( 'Category', 'timeline-and-history-slider' ),
        'search_items'      => __( 'Search Category', 'timeline-and-history-slider' ),
        'all_items'         => __( 'All Category', 'timeline-and-history-slider' ),
        'parent_item'       => __( 'Parent Category', 'timeline-and-history-slider' ),
        'parent_item_colon' => __( 'Parent Category' , 'timeline-and-history-slider' ),
        'edit_item'         => __( 'Edit Category', 'timeline-and-history-slider' ),
        'update_item'       => __( 'Update Category', 'timeline-and-history-slider' ),
        'add_new_item'      => __( 'Add New Category', 'timeline-and-history-slider' ),
        'new_item_name'     => __( 'New Category Name', 'timeline-and-history-slider' ),
        'menu_name'         => __( 'Timeline Category', 'timeline-and-history-slider' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => apply_filters('wpostahs-slider-category',WPHTSP_PRO_CAT) ),
    );

    register_taxonomy( WPHTSP_PRO_CAT, array( 'timeline_slider_post' ), apply_filters('wphtsp_register_cat', $args) );
}

/* Register Taxonomy */
add_action( 'init', 'wphtsp_register_taxonomies');


/**
 * Function to update post message for timeline post type
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function wphts_pro_post_updated_messages( $messages ) {

    global $post, $post_ID;

    $messages[WPHTSP_PRO_POST_TYPE] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => sprintf( __( 'Timeline updated. <a href="%s">View Timeline</a>', 'timeline-and-history-slider' ), esc_url( get_permalink( $post_ID ) ) ),
        2 => __( 'Custom field updated.', 'timeline-and-history-slider' ),
        3 => __( 'Custom field deleted.', 'timeline-and-history-slider' ),
        4 => __( 'Timeline updated.', 'timeline-and-history-slider' ),
        5 => isset( $_GET['revision'] ) ? sprintf( __( 'Timeline restored to revision from %s', 'timeline-and-history-slider' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __( 'Timeline published. <a href="%s">View Timeline</a>', 'timeline-and-history-slider' ), esc_url( get_permalink( $post_ID ) ) ),
        7 => __( 'Timeline saved.', 'timeline-and-history-slider' ),
        8 => sprintf( __( 'Timeline submitted. <a target="_blank" href="%s">Preview Timeline</a>', 'timeline-and-history-slider' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
        9 => sprintf( __( 'Timeline scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Timeline</a>', 'timeline-and-history-slider' ),
          date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
        10 => sprintf( __( 'Timeline draft updated. <a target="_blank" href="%s">Preview Timeline</a>', 'timeline-and-history-slider' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
    );

    return $messages;
}

// Filter to update news post message
add_filter( 'post_updated_messages', 'wphts_pro_post_updated_messages' );