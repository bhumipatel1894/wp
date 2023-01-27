<?php
/**
 * Plugin generic functions file
 *
 * @package Woo Product Slider and Carousel with category
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wcpscwc_Pro_Admin {

    function __construct() {

        // Filter to add extra column in gallery `category` table
        add_filter( 'manage_edit-'.WCPSCWC_PRODUCT_CAT.'_columns', array($this, 'wcpscwc_pro_manage_category_columns') );
        add_filter( 'manage_'.WCPSCWC_PRODUCT_CAT.'_custom_column', array($this, 'wcpscwc_pro_category_data'), 10, 3 );
        
        // Filter to add plugin links
        add_filter( 'plugin_row_meta', array( $this, 'wcpscwc_pro_plugin_row_meta' ), 10, 2 );        
    }

    /**
     * Add extra column to news category
     * 
     * @package Woo Product Slider and Carousel with category
     * @since 1.0.0
     */
    function wcpscwc_pro_manage_category_columns($columns) {

        $new_columns['wcpscwc_id']          = __( 'Category ID', 'woo-product-slider-and-carousel-with-category' );
        //$new_columns['wcpscwc_shortcode'] = __( 'Category Shortcode', 'woo-product-slider-and-carousel-with-category' );
        
        $columns = wcpscwc_pro_add_array( $columns, $new_columns, 1 );
        
        return $columns;
    }

    /**
     * Add data to extra column to news category
     * 
     * @package Woo Product Slider and Carousel with category
     * @since 1.0.0
     */
    function wcpscwc_pro_category_data($ouput, $column_name, $tax_id) {
        
        switch ($column_name) {
            case 'wcpscwc_id':
                $ouput .= $tax_id;
                break;
                
            case 'wcpscwc_shortcode':
                $ouput .= '[wcpscwc_bestselling_pdt_slider category="' . $tax_id. '"]<br/>';
                $ouput .= '[wcpscwc_feat_pdt_slider category="' . $tax_id. '"]<br/>';
                $ouput .= '[wcpscwc_pdt_slider category="' . $tax_id. '"]';
                break;
        }
        
        return $ouput;
    }

    /**
     * Function to unique number value
     * 
     * @package Woo Product Slider and Carousel with category
     * @since 1.0.0
     */
    function wcpscwc_pro_plugin_row_meta( $links, $file ) {
        
        if ( $file == WCPSCWC_PLUGIN_BASENAME ) {
            
            $row_meta = array(
                'docs'    => '<a href="' . esc_url('https://www.wponlinesupport.com/pro-plugin-document/woo-product-slider-carousel-category-pro/') . '" title="' . esc_attr( __( 'View Documentation', 'woo-product-slider-and-carousel-with-category' ) ) . '" target="_blank">' . __( 'Docs', 'woo-product-slider-and-carousel-with-category' ) . '</a>',
                'support' => '<a href="' . esc_url('https://www.wponlinesupport.com/welcome-wp-online-support-forum/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'woo-product-slider-and-carousel-with-category' ) ) . '" target="_blank">' . __( 'Support', 'woo-product-slider-and-carousel-with-category' ) . '</a>',
            );
            return array_merge( $links, $row_meta );
        }
        return (array) $links;
    }
}

$wcpscwc_pro_admin = new Wcpscwc_Pro_Admin();