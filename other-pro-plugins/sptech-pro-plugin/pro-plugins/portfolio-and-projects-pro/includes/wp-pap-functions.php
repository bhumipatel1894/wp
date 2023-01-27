<?php
/**
 * Plugin generic functions file
 *
 * @package Portfolio and Projects Pro
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_esc_attr($data) {
    return esc_attr( stripslashes($data) );
}

/**
 * Strip Slashes From Array
 *
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_slashes_deep($data = array(), $flag = false) {
  
    if($flag != true) {
        $data = wp_pap_pro_nohtml_kses($data);
    }
    $data = stripslashes_deep($data);
    return $data;
}

/**
 * Strip Html Tags 
 * 
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */

function wp_pap_pro_nohtml_kses($data = array()) {
  
    if ( is_array($data) ) {

        $data = array_map('wp_pap_pro_nohtml_kses', $data);

    } elseif ( is_string( $data ) ) {
        $data = trim( $data );
        $data = wp_filter_nohtml_kses($data);
    }
  
    return $data;
}

/**
 * Function to unique number value
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_get_unique() {
	
    static $unique = 0;
	$unique++;

	return $unique;
}

/**
 * Function to unique number value
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_get_unique_thumbs() {
    
    static $unique1 = 0;
    $unique1++;

    return $unique1;
}

/**
 * Function to unique number value
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_get_unique_main_thumb() {
    
    static $unique2 = 0;
    $unique2++;

    return $unique2;
}

/**
 * Function to add array after specific key
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_add_array(&$array, $value, $index, $from_last = false) {
    
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
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_get_image_src( $post_id = '', $size = 'full' ) {

    $size   = !empty($size) ? $size : 'full';
    $image  = wp_get_attachment_image_src( $post_id, $size );

    if( !empty($image) ) {
        $image = isset($image[0]) ? $image[0] : '';
    }

    return $image;
}

/**
 * Function to get post external link or permalink
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_get_post_link( $post_id = '' ) {

    $post_link = '';

    if( !empty($post_id) ) {

        $prefix = WP_PAP_PRO_META_PREFIX;

        $post_link = get_post_meta( $post_id, $prefix.'project_url', true );
    }
    
    return $post_link;
}

/**
 * Function to get grid column based on grid
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_grid_column( $grid = '' ) {
    
    if($grid == '2') {
        $grid_clmn = '6';
    } else if($grid == '3') {
        $grid_clmn = '4';
    }  else if($grid == '4') {
        $grid_clmn = '3';
    } else if ($grid == '1') {
        $grid_clmn = '12';
    } else {
        $grid_clmn = '4';
    }
    return $grid_clmn;
}

/**
 * Pagination function for grid
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_pagination($args = array()){

    $big = 999999999; // need an unlikely integer

    $paging = apply_filters('wp_pap_pro_paging_args', array(
                    'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format'    => '?paged=%#%',
                    'current'   => max( 1, $args['paged'] ),
                    'total'     => $args['total'],
                    'prev_next' => true,
                    'prev_text' => '&laquo; '.__('Previous', 'portfolio-and-projects'),
                    'next_text' => __('Next', 'portfolio-and-projects').' &raquo;',
                ));
    
    return paginate_links($paging);
}

/**
 * Function to get portfolio popup style
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_popup_style() {

    $popup_style = array(
        'inline'    => __('Inline Style', 'portfolio-and-projects'),
        'popup'     => __('Popup Style', 'portfolio-and-projects'),
    );
    return apply_filters('wp_pap_pro_popup_style', $popup_style );
}

/**
 * Function to get old browser
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_old_browser() {
    global $is_IE, $is_safari, $is_edge;

    // Only for safari
    $safari_browser = wp_pap_pro_check_browser_safari();

    if( $is_IE || $is_edge || ($is_safari && (isset($safari_browser['version']) && $safari_browser['version'] <= 7.1)) ) {
        return true;
    }
    return false;
}

/**
 * Determine if the browser is Safari or not (last updated 1.7)
 *
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_check_browser_safari() {
    
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
 * Function to get `pap_portfolio` shortcode designs
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_slider_designs() {
    $design_arr = array(
        'design-1'   => __('Design 1', 'portfolio-and-projects'),
        'design-2'   => __('Design 2', 'portfolio-and-projects'),
        'design-3'   => __('Design 3', 'portfolio-and-projects'),
        'design-4'   => __('Design 4', 'portfolio-and-projects'),
        'design-5'   => __('Design 5', 'portfolio-and-projects'),
        'design-6'   => __('Design 6', 'portfolio-and-projects'),
        'design-7'   => __('Design 7', 'portfolio-and-projects'),
        'design-8'   => __('Design 8', 'portfolio-and-projects'),
        'design-9'   => __('Design 9', 'portfolio-and-projects'),
        'design-10'  => __('Design 10', 'portfolio-and-projects'),
        'design-11'  => __('Design 11', 'portfolio-and-projects'),
        'design-12'  => __('Design 12', 'portfolio-and-projects'),
        'design-13'  => __('Design 13', 'portfolio-and-projects'),
        'design-14'  => __('Design 14', 'portfolio-and-projects'),
        'design-15'  => __('Design 15', 'portfolio-and-projects'),
    );
    return apply_filters('wp_pap_pro_slider_designs', $design_arr );
}