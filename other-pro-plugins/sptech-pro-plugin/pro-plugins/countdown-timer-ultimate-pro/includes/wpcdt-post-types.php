<?php
/**
 * Register Post type functionality
 *
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */
function wpcdt_pro_register_post_type() {

	$wpcdt_pro_post_lbls = apply_filters( 'wpcdt_timer_post_labels', array(
								'name'                 	=> __('Countdown Timer Ultimate Pro', 'countdown-timer-ultimate'),
								'singular_name'        	=> __('Countdown Timer Ultimate Pro', 'countdown-timer-ultimate'),
								'add_new'              	=> __('Add Timer', 'countdown-timer-ultimate'),
								'add_new_item'         	=> __('Add New Timer', 'countdown-timer-ultimate'),
								'edit_item'            	=> __('Edit Timer', 'countdown-timer-ultimate'),
								'new_item'             	=> __('New Timer', 'countdown-timer-ultimate'),
								'view_item'            	=> __('View Timer', 'countdown-timer-ultimate'),
								'search_items'         	=> __('Search Timer', 'countdown-timer-ultimate'),
								'not_found'            	=> __('No Timer Found', 'countdown-timer-ultimate'),
								'not_found_in_trash'   	=> __('No Timer Found in Trash', 'countdown-timer-ultimate'),
								'parent_item_colon'    	=> '',
								'menu_name'           	=> __('Countdown Timer Ultimate Pro', 'countdown-timer-ultimate'),
								'featured_image'		=> __('Timer Background Image', 'countdown-timer-ultimate'),
								'set_featured_image'	=> __('Set Timer Background Image', 'countdown-timer-ultimate'),
								'remove_featured_image'	=> __('Remove Timer Background Image', 'countdown-timer-ultimate'),
								'use_featured_image'	=> __('Use as Timer Background Image', 'countdown-timer-ultimate'),
							));

	$wpcdt_pro_slider_args = array(
		'labels'				=> $wpcdt_pro_post_lbls,
		'public'              	=> false,
		'show_ui'             	=> true,
		'query_var'           	=> false,
		'rewrite'             	=> false,
		'capability_type'     	=> 'post',
		'hierarchical'        	=> false,
		'menu_icon'				=> 'dashicons-clock',
		'supports'            	=> apply_filters('wpcdt_timer_post_supports', array('title','thumbnail','editor')),
	);

	// Register slick slider post type
	register_post_type( WPCDT_PRO_POST_TYPE, apply_filters( 'wpcdt_pro_registered_post_type_args', $wpcdt_pro_slider_args ) );
}

// Action to register plugin post type
add_action('init', 'wpcdt_pro_register_post_type');

/**
 * Function to update post message for team showcase
 * 
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */
function wpcdt_pro_post_updated_messages( $messages ) {
	
	global $post, $post_ID;
	
	$messages[WPCDT_PRO_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Timer updated.', 'countdown-timer-ultimate' ) ),
		2 => __( 'Custom field updated.', 'countdown-timer-ultimate' ),
		3 => __( 'Custom field deleted.', 'countdown-timer-ultimate' ),
		4 => __( 'Timer updated.', 'countdown-timer-ultimate' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Timer restored to revision from %s', 'countdown-timer-ultimate' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Timer published.', 'countdown-timer-ultimate' ) ),
		7 => __( 'Timer saved.', 'countdown-timer-ultimate' ),
		8 => sprintf( __( 'Timer submitted.', 'countdown-timer-ultimate' ) ),
		9 => sprintf( __( 'Timer scheduled for: <strong>%1$s</strong>.', 'countdown-timer-ultimate' ),
		  date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ) ),
		10 => sprintf( __( 'Timer draft updated.', 'countdown-timer-ultimate' ) ),
	);
	
	return $messages;
}

// Filter to update slider post message
add_filter( 'post_updated_messages', 'wpcdt_pro_post_updated_messages' );