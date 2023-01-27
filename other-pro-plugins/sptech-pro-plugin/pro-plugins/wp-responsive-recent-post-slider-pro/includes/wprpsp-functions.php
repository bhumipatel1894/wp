<?php
/**
 * Plugin generic functions file
 *
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to unique number value
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.2.5
 */
function wprpsp_get_unique() {
    static $unique = 0;
    $unique++;

    return $unique;
}

/**
 * Update default settings
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.2.7
 */
function wprpsp_default_settings() {
  
    global $wprpsp_options;

    $wprpsp_options = array(
        'default_img' => '',
        'custom_css'  => '',
        'post_types'  => array('post'),
    );

    $default_options = apply_filters('wprpsp_options_default_values', $wprpsp_options );

    // Update default options
    update_option( 'wprpsp_options', $default_options );

    // Overwrite global variable when option is update
    $wprpsp_options = wprpsp_get_settings();
}

/**
 * Get Settings From Option Page
 * 
 * Handles to return all settings value
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.2.6
 */
function wprpsp_get_settings() {
  
    $options    = get_option('wprpsp_options');
    $settings   = is_array($options)  ? $options : array();

    return $settings;
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.2.7
 */
function wprpsp_get_option( $key = '', $default = false ) {
    global $wprpsp_options;

    $value = ! empty( $wprpsp_options[ $key ] ) ? $wprpsp_options[ $key ] : $default;
    $value = apply_filters( 'wprpsp_get_option', $value, $key, $default );
    
    return apply_filters( 'wprpsp_get_option_' . $key, $value, $key, $default );
}

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.2.6
 */
function wprpsp_esc_attr($data) {
    return esc_attr( stripslashes($data) );
}

/**
 * Strip Slashes From Array
 *
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.2.6
 */
function wprpsp_slashes_deep($data = array(), $flag = false) {
  
    if($flag != true) {
        $data = wprpsp_nohtml_kses($data);
    }
    $data = stripslashes_deep($data);
    return $data;
}

/**
 * Strip Html Tags 
 * 
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.2.6
 */

function wprpsp_nohtml_kses($data = array()) {
  
  if ( is_array($data) ) {
    
    $data = array_map('wprpsp_nohtml_kses', $data);
    
  } elseif ( is_string( $data ) ) {
    $data = trim( $data );
    $data = wp_filter_nohtml_kses($data);
  }
  
  return $data;
}

/**
 * Function to add array after specific key
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.2.7
 */
function wprpsp_add_array(&$array, $value, $index, $from_last = false) {
    
    if( is_array($array) && is_array($value) ) {

        if( $from_last ) {
            $total_count    = count($array);
            $index          = (!empty($total_count) && ($total_count > $index)) ? ($total_count-$index): $index;
        }
        
        $split_arr  = array_splice($array, max(0, $index));
        $array      = array_merge( $array, $value, $split_arr);
    }
    
    return $array;
}

/**
 * Function to get post featured image
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.2.6
 */
function wprpsp_get_post_featured_image( $post_id = '', $size = 'full', $default_img = false ) {
    $size   = !empty($size) ? $size : 'full';
    $image  = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );

    if( !empty($image) ) {
        $image = isset($image[0]) ? $image[0] : '';
    }

    // Getting default image
    if( $default_img && empty($image) ) {
        $image = wprpsp_get_option( 'default_img' );
    }

    return $image;
}

/**
 * Function to get post excerpt
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.2.6
 */
function wprpsp_get_post_excerpt( $post_id = null, $content = '', $word_length = '55', $more = '...' ) {

    $has_excerpt  = false;
    $word_length  = !empty($word_length) ? $word_length : '55';

    // If post id is passed
    if( !empty($post_id) ) {
        if (has_excerpt($post_id)) {

          $has_excerpt  = true;
          $content    = get_the_excerpt();

        } else {
          $content = !empty($content) ? $content : get_the_content();
        }
    }

    if( !empty($content) && (!$has_excerpt) ) {
        $content = strip_shortcodes( $content ); // Strip shortcodes
        $content = wp_trim_words( $content, $word_length, $more );
    }

    return $content;
}

/**
 * Function to unique number value
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.2.5
 */
function wprpsp_limit_words($string, $word_limit, $more = '...') {
    $string = wp_trim_words( $string, $word_limit, $more );
    return $string;
}

/**
 * Function to get old browser
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.3.1
 */
function wprpsp_old_browser() {
    global $is_IE, $is_safari, $is_edge;

    // Only for safari
    $safari_browser = wprpsp_check_browser_safari();

    if( $is_IE || $is_edge || ($is_safari && (isset($safari_browser['version']) && $safari_browser['version'] <= 7.1)) ) {
        return true;
    }
    return false;
}

/**
 * Determine if the browser is Safari or not (last updated 1.7)
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.3.1
 */
function wprpsp_check_browser_safari() {
    
    // Takinf some variables
    $browser    = array();
    $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "";

    if (stripos($user_agent, 'Safari') !== false && stripos($user_agent, 'iPhone') === false && stripos($user_agent, 'iPod') === false) {
        $aresult = explode('/', stristr($user_agent, 'Version'));
        if (isset($aresult[1])) {
            $aversion = explode(' ', $aresult[1]);
            $browser['version'] = ($aversion[0]);
        } else {
            $browser['version'] = '';
        }
        $browser['browser'] = 'safari';
    }
    return $browser;
}

/**
 * Function to get post external link or permalink
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.1.7
 */
function wprpsp_get_post_link( $post_id = '' ) {

    $post_link = '';

    if( !empty($post_id) ) {

        $prefix = WPRPSP_META_PREFIX;

        $post_link = get_post_meta( $post_id, $prefix.'more_link', true );

        if( empty($post_link) ) {
            $post_link = get_permalink( $post_id );  
        }
    }
    return $post_link;
}

/**
 * Function to get post types
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.3.3
 */
function wprpsp_get_post_types() {     
    
    $post_types = array();
    $args       = array('public' => true);
    $default_post_types = get_post_types($args,'name');

    $exclude_post = array('attachment', 'revision', 'nav_menu_item');

    foreach ($default_post_types as $post_type_key => $post_data) {
        if( !in_array( $post_type_key, $exclude_post) ) {
            $post_types[$post_type_key] = $post_data->label;
        }
    }

    return apply_filters('wprpsp_get_post_types', $post_types );  
}

/**
 * Function to get Taxonomies 
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.3.3
 */
function wprpsp_get_taxonomy_options($objects =array(), $selected_val = '') {

    $output = '';

    if( !empty( $objects ) && !is_wp_error( $objects ) ) {
        foreach($objects as $object => $taxonomy) {
            if( 'post_format' != $object && !empty($taxonomy->public) ) {
                $output .= '<option value="'. $object .'" '.selected($selected_val,$object).'>'. $taxonomy->label . ' - ('.$taxonomy->name.')</option>'; 
            }
        }
    } else {
        $output .= '<option value="">'.__('No taxonomies found', 'wp-responsive-recent-post-slider').'</option>';
    }
    return $output;
}

/**
 * Function to get Taxonomies List
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.3.3
 */
function wprpsp_get_taxonomy_list($post_type = '') {
    
    // Taking some variables
    $output         = array();
    $taxonomy_list  = '';

    if( $post_type ) {

        $taxonomy_objects = get_object_taxonomies( $post_type, 'object' );

        if( ! empty($taxonomy_objects) && !is_wp_error($taxonomy_objects) )  {
            foreach($taxonomy_objects as $object => $taxonomy) { 
                if( 'post_format' != $object && !empty($taxonomy->public) ) {
                    $output[] = $object;
                }
            }
        }
        $taxonomy_list = implode(', ', $output);
    }
    return $taxonomy_list;
}

/**
 * Function to get Taxonomies Terms 
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.3.3
 */
function wprpsp_get_terms_options($objects = array(), $selected_val = array()){
    $output = '';
    $selected_val = (array)$selected_val;

    if( !empty($objects) && !is_wp_error($objects) ) {
        foreach($objects as $object => $term) {
            $selected = '';
            if(in_array($term->term_id, $selected_val)) {
                $selected = ' selected = selected';
            }
            $output .= '<option value="'. $term->term_id .'" '.$selected.'>'. $term->name . '</option>'; 
        }
    }
    return $output;
}

/**
 * Function to get Taxonomies list 
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.3.3
 */
function wprpsp_get_category_list( $post_id = 0, $taxonomy = '' ) {
    $output = '';
    $terms  = get_the_terms( $post_id, $taxonomy );

    if( $terms && !is_wp_error($terms) && !empty($taxonomy) ) {
        $output .= '<ul class="post-categories wprpsp-post-categories">';
        foreach ( $terms as $term ) {
             $output .= '<li><a href="'.get_term_link($term).'" rel="'.$taxonomy.'"> '.$term->name.' </a></li>';
        }
        $output .= '</ul>';
    }
    return $output;
}

/**
 * Function to get `recent_post_slider` shortcode designs
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.1.6
 */
function wprpsp_recent_post_slider_designs() {
    $design_arr = array(
        'design-1'  => __('Design 1', 'wp-responsive-recent-post-slider'),
        'design-2'  => __('Design 2', 'wp-responsive-recent-post-slider'),
        'design-3'  => __('Design 3', 'wp-responsive-recent-post-slider'),
        'design-4'  => __('Design 4', 'wp-responsive-recent-post-slider'),
        'design-5'  => __('Design 5', 'wp-responsive-recent-post-slider'),
        'design-6'  => __('Design 6', 'wp-responsive-recent-post-slider'),
        'design-17' => __('Design 17', 'wp-responsive-recent-post-slider'),
        'design-18' => __('Design 18', 'wp-responsive-recent-post-slider'),
        'design-19' => __('Design 19', 'wp-responsive-recent-post-slider'),
        'design-20' => __('Design 20', 'wp-responsive-recent-post-slider'),
        'design-21' => __('Design 21', 'wp-responsive-recent-post-slider'),
        'design-23' => __('Design 23', 'wp-responsive-recent-post-slider'),
        'design-24' => __('Design 24', 'wp-responsive-recent-post-slider'),
        'design-27' => __('Design 27', 'wp-responsive-recent-post-slider'),
        'design-28' => __('Design 28', 'wp-responsive-recent-post-slider'),
        'design-29' => __('Design 29', 'wp-responsive-recent-post-slider'),
        'design-30' => __('Design 30', 'wp-responsive-recent-post-slider'),
    );
    return apply_filters('wprpsp_recent_post_designs', $design_arr );
}

/**
 * Function to get `recent_post_carousel` shortcode designs
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.1.7
 */
function wprpsp_recent_post_crousel_designs() {
    $design_arr = array(
        'design-7'  => __('Design 7', 'wp-responsive-recent-post-slider'),
        'design-8'  => __('Design 8', 'wp-responsive-recent-post-slider'),
        'design-9'  => __('Design 9', 'wp-responsive-recent-post-slider'),
        'design-10' => __('Design 10', 'wp-responsive-recent-post-slider'),
        'design-11' => __('Design 11', 'wp-responsive-recent-post-slider'),
        'design-12' => __('Design 12', 'wp-responsive-recent-post-slider'),
        'design-13' => __('Design 13', 'wp-responsive-recent-post-slider'),
        'design-14' => __('Design 14', 'wp-responsive-recent-post-slider'),
        'design-15' => __('Design 15', 'wp-responsive-recent-post-slider'),
        'design-16' => __('Design 16', 'wp-responsive-recent-post-slider'),
        'design-22' => __('Design 22', 'wp-responsive-recent-post-slider'),
        'design-25' => __('Design 25', 'wp-responsive-recent-post-slider'),
        'design-26' => __('Design 26', 'wp-responsive-recent-post-slider'),    
    );
    return apply_filters('wprpsp_recent_post_crousel_designs', $design_arr );
}