<?php
/**
 * Widget API: WPOS WooCommerce Products Grid/Slider Widget
 *
 * @package Woo Product Slider and Carousel with category Pro
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wpscwcp_woo_product_slider_widget() {
    register_widget( 'Wpscwcp_Product_Slider_Widget' );
}

// Action to register widget
add_action( 'widgets_init', 'wpscwcp_woo_product_slider_widget' );

class Wpscwcp_Product_Slider_Widget extends WP_Widget {

    var $defaults;

	/**
    * Sets up a new widget instance.
    *
    * @package Woo Product Slider and Carousel with category Pro
    * @since 1.0.0
    */
    function __construct() {

        $widget_ops = array('classname' => 'wpscwcp-woo-pdt-slider-widget', 'description' => __('Display WooCommerce Products in Grid/Slider.', 'woo-product-slider-and-carousel-with-category'));
        parent::__construct( 'wpscwcp_woo_product_slider_widget', __('WPOS - WC Products Widget', 'woo-product-slider-and-carousel-with-category'), $widget_ops );

        $this->defaults = array(
            'title'             => __( 'Products', 'woo-product-slider-and-carousel-with-category' ),
            'cat'               => 0,
            'design'            => 'design-1',
            'default_slider_cls'=> 'products',
            'grid'              => 1,
            'limit'             => 5,
            'active_slider'     => 1,
            'slide_to_show'     => 1,
            'slide_to_scroll'   => 1, 
            'autoplay'          => 'true',
            'autoplay_speed'    => 5000,
            'speed'             => 500,
            'arrows'            => 'true',
            'dots'              => 'true',
            'loop'              => 'loop',
            'centermode'        => 'false',
            'adaptiveheight'    => 'false',
            'show_category'     => 1,
            'show_rating'       => 1,
            'show_sale'         => 1,
            'link_target'       => 0,
            'show_desc'         => 0,
        );
    }
	
	/**
     * Handles updating settings for the current widget instance.
     *
     * @package Woo Product Slider and Carousel with category Pro
     * @since 1.0.0
     */
    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['title']              = sanitize_text_field($new_instance['title']);
        $instance['cat']                = $new_instance['cat'];
        $instance['design']             = $new_instance['design'];
		$instance['default_slider_cls']	= $new_instance['default_slider_cls'];
		$instance['grid']               = $new_instance['grid'];
		$instance['limit']				= !empty($new_instance['limit']) ? $new_instance['limit'] : 5;
		$instance['slide_to_show']      = intval( $new_instance['slide_to_show'] );
        $instance['slide_to_scroll']    = intval( $new_instance['slide_to_scroll'] );
		$instance['autoplay']			= $new_instance['autoplay'];
		$instance['autoplay_speed']		= $new_instance['autoplay_speed'];
		$instance['speed']				= $new_instance['speed'];
		$instance['arrows']				= $new_instance['arrows'];
		$instance['dots']				= $new_instance['dots'];
        $instance['loop']               = $new_instance['loop'];
        $instance['centermode']         = $new_instance['centermode'];
        $instance['adaptiveheight']     = $new_instance['adaptiveheight'];
        $instance['active_slider']      = !empty($new_instance['active_slider'])    ? 1 : 0;
		$instance['show_category']      = !empty($new_instance['show_category'])    ? 1 : 0;
        $instance['show_rating']        = !empty($new_instance['show_rating'])      ? 1 : 0;
        $instance['show_sale']          = !empty($new_instance['show_sale'])        ? 1 : 0;
        $instance['link_target']        = !empty($new_instance['link_target'])      ? 1 : 0;
        $instance['show_desc']          = !empty($new_instance['show_desc'])        ? 1 : 0;
        
        return $instance;
    }

    /**
    * Outputs the settings form for the widget.
    * 
    * @package Woo Product Slider and Carousel with category Pro
    * @since 1.0.0
    */
    function form($instance) {
        $instance           = wp_parse_args( (array) $instance, $this->defaults );
        $wpscwcp_designs 	= wcpscwc_products_designs();
        unset( $wpscwcp_designs['default'] );
	?>

	    <!-- Title -->
	    <p>
	        <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'woo-product-slider-and-carousel-with-category' ); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
	    </p>

	    <!-- Category -->
	    <p>
	        <label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e( 'Category:', 'news' ); ?></label>
	        <?php
	            $dropdown_args = array(
	                'taxonomy'          => WCPSCWC_PRODUCT_CAT,
	                'class'             => 'widefat',
	                'show_option_all'   => __( 'All', 'woo-product-slider-and-carousel-with-category' ),
	                'id'                => $this->get_field_id( 'cat' ),
	                'name'              => $this->get_field_name( 'cat' ),
	                'selected'          => $instance['cat']
	            );
	            wp_dropdown_categories( $dropdown_args );
	        ?>
	    </p>

	    <!-- Grid -->
        <p>
            <label for="<?php echo $this->get_field_id('grid'); ?>"><?php esc_html_e( 'Number of Grid:', 'woo-product-slider-and-carousel-with-category' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('grid'); ?>" name="<?php echo $this->get_field_name('grid'); ?>" type="number" value="<?php echo $instance['grid']; ?>" min="1" max="4"/>
        </p>

	    <!-- Design -->
	    <p>
	        <label for="<?php echo $this->get_field_id( 'design' ); ?>"><?php _e( 'Design:', 'woo-product-slider-and-carousel-with-category' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'design' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'design' ); ?>">
		        <?php if( !empty($wpscwcp_designs) ) {
	                foreach ( $wpscwcp_designs as $k => $v ) { ?>
	                    <option value="<?php echo $k; ?>"<?php selected( $instance['design'], $k ); ?>><?php echo $v; ?></option>
	        		<?php }
	            } ?>
            </select>
	    </p>

        <?php /*
        <!-- Default Design Products class -->
        <p>
            <label for="<?php echo $this->get_field_id( 'default_slider_cls' ); ?>"><?php _e( 'Product Class:', 'woo-product-slider-and-carousel-with-category' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('default_slider_cls'); ?>" name="<?php echo $this->get_field_name('default_slider_cls'); ?>" type="text" value="<?php echo $instance['default_slider_cls']; ?>" />
        </p>
        */ ?>

	    <!-- Number of Items -->
	    <p>
	        <label for="<?php echo $this->get_field_id('limit'); ?>"><?php esc_html_e( 'Number of Items:', 'woo-product-slider-and-carousel-with-category' ); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" min="-1" />
	    </p>

	    <!-- Display Category -->
        <p>
            <input type="checkbox" value="1" id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" <?php checked($instance['show_category'], 1); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'woo-product-slider-and-carousel-with-category' ); ?></label> <br />
        </p>

        <!-- Display Rating -->
        <p>
            <input type="checkbox" value="1" id="<?php echo $this->get_field_id( 'show_rating' ); ?>" name="<?php echo $this->get_field_name( 'show_rating' ); ?>" <?php checked($instance['show_rating'], 1); ?> />
            <label for="<?php echo $this->get_field_id( 'show_rating' ); ?>"><?php _e( 'Display Rating', 'woo-product-slider-and-carousel-with-category' ); ?></label> <br />
        </p>

        <!-- Display Sale -->
        <p>
            <input type="checkbox" value="1" id="<?php echo $this->get_field_id( 'show_sale' ); ?>" name="<?php echo $this->get_field_name( 'show_sale' ); ?>" <?php checked($instance['show_sale'], 1); ?> />
            <label for="<?php echo $this->get_field_id( 'show_sale' ); ?>"><?php _e( 'Display Sale Flash', 'woo-product-slider-and-carousel-with-category' ); ?></label> <br />
        </p>

        <!-- Display Description -->
        <p>
            <input type="checkbox" value="1" id="<?php echo $this->get_field_id( 'show_desc' ); ?>" name="<?php echo $this->get_field_name( 'show_desc' ); ?>" <?php checked($instance['show_desc'], 1); ?> />
            <label for="<?php echo $this->get_field_id( 'show_desc' ); ?>"><?php _e( 'Display Product Description', 'woo-product-slider-and-carousel-with-category' ); ?></label> <br />
        </p>

        <!-- Link Target -->
        <p>
            <input type="checkbox" value="1" id="<?php echo $this->get_field_id( 'link_target' ); ?>" name="<?php echo $this->get_field_name( 'link_target' ); ?>" <?php checked($instance['link_target'], 1); ?> />
            <label for="<?php echo $this->get_field_id( 'link_target' ); ?>"><?php _e( 'Open Product in a new tab', 'woo-product-slider-and-carousel-with-category' ); ?></label> <br />
        </p>

	    <!-- Active Slider -->
        <p>
            <h3><?php esc_html_e( 'Product Slider Setting:', 'woo-product-slider-and-carousel-with-category' ); ?></h3> 
            <hr />
            <input type="checkbox" value="1" id="<?php echo $this->get_field_id( 'active_slider' ); ?>" name="<?php echo $this->get_field_name( 'active_slider' ); ?>" <?php checked($instance['active_slider'], 1); ?> />
            <label for="<?php echo $this->get_field_id( 'active_slider' ); ?>"><?php _e( 'Check this box to Display Products in Slider View.', 'woo-product-slider-and-carousel-with-category' ); ?></label> <br />
        </p>

	    <!-- Slides Column -->
        <p>
            <label for="<?php echo $this->get_field_id( 'slide_to_show' ); ?>"><?php _e( 'Slides Column:', 'woo-product-slider-and-carousel-with-category' ); ?></label>
            <input type="number" name="<?php echo $this->get_field_name( 'slide_to_show' ); ?>"  value="<?php echo $instance['slide_to_show']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'slide_to_show' ); ?>" min="1" />
        </p>

        <!-- Slides to Scroll -->
        <p>
            <label for="<?php echo $this->get_field_id( 'slide_to_scroll' ); ?>"><?php _e( 'Slides to Scroll:', 'woo-product-slider-and-carousel-with-category' ); ?></label>
            <input type="number" name="<?php echo $this->get_field_name( 'slide_to_scroll' ); ?>"  value="<?php echo $instance['slide_to_scroll']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'slide_to_scroll' ); ?>" min="1" />
        </p>

	    <!-- Auto play -->
	    <p>
	        <label for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e( 'Auto Play:', 'woo-product-slider-and-carousel-with-category' ); ?></label>
	        <select name="<?php echo $this->get_field_name( 'autoplay' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplay' ); ?>">
	            <option value="true" <?php selected( $instance['autoplay'], 'true' ); ?>><?php _e( 'True', 'woo-product-slider-and-carousel-with-category' ); ?></option>
	            <option value="false" <?php selected( $instance['autoplay'], 'false' ); ?>><?php _e( 'False', 'woo-product-slider-and-carousel-with-category' ); ?></option>
	        </select>
	    </p>

        <!-- Widget Loop: Select Loop -->
        <p>
            <label for="<?php echo $this->get_field_id( 'loop' ); ?>"><?php _e( 'Loop:', 'woo-product-slider-and-carousel-with-category' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'loop' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'loop' ); ?>">
                <option value="true" <?php selected( $instance['loop'], 'true' ); ?>><?php _e( 'True', 'woo-product-slider-and-carousel-with-category' ); ?></option>
                <option value="false" <?php selected( $instance['loop'], 'false' ); ?>><?php _e( 'False', 'woo-product-slider-and-carousel-with-category' ); ?></option>
            </select>
        </p>

        <!-- Widget Loop: Select Centermode -->
        <p>
            <label for="<?php echo $this->get_field_id( 'centermode' ); ?>"><?php _e( 'Center Mode:', 'woo-product-slider-and-carousel-with-category' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'centermode' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'centermode' ); ?>">
                <option value="false" <?php selected( $instance['centermode'], 'false' ); ?>><?php _e( 'False', 'woo-product-slider-and-carousel-with-category' ); ?></option>
                <option value="true" <?php selected( $instance['centermode'], 'true' ); ?>><?php _e( 'True', 'woo-product-slider-and-carousel-with-category' ); ?></option>
            </select>
        </p>

        <!-- Widget Loop: Select AdaptiveHeight -->
        <p>
            <label for="<?php echo $this->get_field_id( 'adaptiveheight' ); ?>"><?php _e( 'Adaptive Height:', 'woo-product-slider-and-carousel-with-category' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'adaptiveheight' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'adaptiveheight' ); ?>">
                <option value="false" <?php selected( $instance['adaptiveheight'], 'false' ); ?>><?php _e( 'False', 'woo-product-slider-and-carousel-with-category' ); ?></option>
                <option value="true" <?php selected( $instance['adaptiveheight'], 'true' ); ?>><?php _e( 'True', 'woo-product-slider-and-carousel-with-category' ); ?></option>                
            </select>
        </p>
        
	    <!-- Autoplay Interval -->
	    <p>
	        <label for="<?php echo $this->get_field_id( 'autoplay_speed' ); ?>"><?php _e( 'Autoplay Interval:', 'woo-product-slider-and-carousel-with-category' ); ?></label>
	        <input type="number" name="<?php echo $this->get_field_name( 'autoplay_speed' ); ?>"  value="<?php echo $instance['autoplay_speed']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplay_speed' ); ?>" min="0" step="500" />
	    </p>

	     <!-- Speed -->
	    <p>
	        <label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Slider Speed:', 'woo-product-slider-and-carousel-with-category' ); ?></label>
	        <input type="number" name="<?php echo $this->get_field_name( 'speed' ); ?>"  value="<?php echo $instance['speed']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>" min="0" step="500" />
	    </p>
        
	    <!-- Arrows -->
	    <p>
	        <label for="<?php echo $this->get_field_id( 'arrows' ); ?>"><?php _e( 'Arrows:', 'woo-product-slider-and-carousel-with-category' ); ?></label>
	        <select name="<?php echo $this->get_field_name( 'arrows' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'arrows' ); ?>">
	            <option value="true" <?php selected( $instance['arrows'], 'true' ); ?>><?php _e( 'True', 'woo-product-slider-and-carousel-with-category' ); ?></option>
	            <option value="false" <?php selected( $instance['arrows'], 'false' ); ?>><?php _e( 'False', 'woo-product-slider-and-carousel-with-category' ); ?></option>
	        </select>
	    </p>

	    <!-- Dots -->
	    <p>
	        <label for="<?php echo $this->get_field_id( 'dots' ); ?>"><?php _e( 'Dots:', 'woo-product-slider-and-carousel-with-category' ); ?></label>
	        <select name="<?php echo $this->get_field_name( 'dots' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'dots' ); ?>">
	            <option value="true" <?php selected( $instance['dots'], 'true' ); ?>><?php _e( 'True', 'woo-product-slider-and-carousel-with-category' ); ?></option>
	            <option value="false" <?php selected( $instance['dots'], 'false' ); ?>><?php _e( 'False', 'woo-product-slider-and-carousel-with-category' ); ?></option>
	        </select>
	    </p>

	<?php }

	/**
    * Outputs the content for the current widget instance.
    *
    * @package WP News and Five Widgets Pro
    * @since 1.0.0
    */
    function widget($news_args, $instance) {

        global $post, $woocommerce_loop;

        $instance = wp_parse_args( (array) $instance, $this->defaults );
        extract($news_args, EXTR_SKIP);

        $title              = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : __( 'Products', 'woo-product-slider-and-carousel-with-category' ), $instance, $this->id_base );
        $cat                = $instance['cat'];
        $design             = $instance['design'];
        $default_slider_cls = $instance['default_slider_cls'];
        $grid               = $instance['grid'];
        $limit              = $instance['limit'];
        $active_slider      = $instance['active_slider'];
        $slide_to_show      = $instance['slide_to_show'];
        $slide_to_scroll    = $instance['slide_to_scroll'];
        $autoplay           = $instance['autoplay'];
        $autoplay_speed     = $instance['autoplay_speed'];
        $speed              = $instance['speed'];
        $arrows             = $instance['arrows'];
        $dots               = $instance['dots'];
        $loop               = $instance['loop'];
        $centermode         = $instance['centermode'];
        $adaptiveheight     = $instance['adaptiveheight'];
        $show_category      = $instance['show_category'];
        $show_rating        = $instance['show_rating'];
        $show_sale          = $instance['show_sale'];
        $link_target        = ($instance['link_target'] == '1') ? '_blank'  : '_self';
        $show_desc          = $instance['show_desc'];
        $slider_cls         = ($active_slider) ? 'wcpscwc-product-slider' : 'wcpscwc-product-grid';
        $grid_clmn          = wcpscwc_pro_column($grid);
        $default_slider_cls = !empty($default_slider_cls) ? $default_slider_cls : 'products';

        if($design == 'default') {
            $slider_cls = ($active_slider) ? 'wcpscwc-product-slider-default' : 'wcpscwc-product-default-grid';
        }

        // Slider configuration
        $slider_conf = compact('slide_to_show', 'slide_to_scroll', 'autoplay', 'autoplay_speed', 'speed', 'arrows', 'dots', 'loop', 'centermode', 'adaptiveheight', 'default_slider_cls');
        
        // Taking some variables
        $unique 	        = wcpscwc_pro_get_unique();
        $grid_count         = 1;
        $css_class          = '';
        $grid_cls           = 'wcpscwc-medium-'.$grid_clmn.' wcpscwc-column';
        $centermode_cls     = ( $centermode == 'true' && $active_slider ) ? 'wcpscwc-center-mode' : '';
        $slide_to_show_cls  = ( $active_slider ) ? 'wcpscwc-slide-show-'.$slide_to_show : '';

        // Enqueue required script
        if( $active_slider ) {
            wp_enqueue_script( 'wpos-slick-jquery' );
            wp_enqueue_script( 'wcpscwc-public-jquery' );
        }

		// WP Query Parameters
		$args = array(
			'post_type' 			=> WCPSCWC_PRODUCT_POST_TYPE,
			'post_status' 			=> array( 'publish' ),
			'posts_per_page'		=> $limit,
            'ignore_sticky_posts'   => true,
		);

		// Category Parameter
		if(!empty($cat)) {
			$args['tax_query'] = array(
					array( 
						'taxonomy' 	=> WCPSCWC_PRODUCT_CAT,
						'field' 	=> 'term_id',
						'terms' 	=> $cat
				));
		}

		// WP Query
		$products = new WP_Query( $args );

		// Start Widget Output
        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

		if ( $products->have_posts() ) :
            if($design == 'default') {
        ?>
            <div class="wcpscwc-product-slider-default-wrap wcps-<?php echo $design; ?> ">
                <div class="woocommerce <?php echo $slider_cls;?>" id="wcpscwc-product-slider-<?php echo $unique; ?>">
            <?php
                    woocommerce_product_loop_start();

                    while ( $products->have_posts() ) : $products->the_post(); 
                        if( wcpscwc_wc_version('3.0') ) {
                            wc_get_template_part( 'content', 'product' );
                        } else {
                            woocommerce_get_template_part( 'content', 'product' );
                        }
                    endwhile; // end of the loop.

                    woocommerce_product_loop_end(); 
            ?>
            <?php 
                if( $active_slider ) { ?>
                    <div class="wcpscwc-slider-conf" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
                <?php } ?>
                    </div>
                </div>
            <?php
            } else { ?>  
			<div class="wcpscwc-product-slider-wrap wcpscwc-<?php echo $design.' '.$centermode_cls.' '.$slide_to_show_cls; ?> wcpscwc-clearfix">
                <div class="wcpscwc-woocommerce <?php echo $slider_cls; ?>" id="wcpscwc-product-slider-<?php echo $unique; ?>">

					<?php while ( $products->have_posts() ) : $products->the_post();

						global $product;

                        // Check older version compatibility
                        if( wcpscwc_wc_version('3.0') ) {
                            $product_id     = $product->get_id();
                            $average_rating = $product->get_average_rating();
                            $product_rating = wc_get_rating_html( $average_rating);
                            $product_type   = $product->get_type();
                        } else {
                            $product_id     = $product->id;
                            $product_rating = $product->get_rating_html();
                            $product_type   = $product->product_type;
                        }

						if( !$active_slider ) {
                            $css_class = ($grid_count == 1) ? 'wcpscwc-first' : '';
                        }
						
						// Taking some variables
                        $post_image = wcpscwc_pro_get_post_image( $product_id, 'full', true );

                        // Getting product category list
                        $product_cats = get_the_term_list( $product_id, 'product_cat', '<span>', ', ', '</span>' );
                        
                        // Woo Commerce button class
						$class = implode( ' ', 
							array_filter(
								array(
									'button',
									'product_type_' . $product_type,
									$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
									$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : ''
								) 
							) 
						);

						include(WCPSCWC_DIR.'/templates/'.$design.'.php');

						// Resetting grid count
                        if( $grid_count == $grid ) {
                            $grid_count = 0;
                        }

                        $grid_count++;
					
					endwhile; // end of the loop. ?>
				</div>

				<?php if( $active_slider ) { ?>
				<div class="wcpscwc-slider-conf" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
				<?php } ?>
			</div>
        <?php } ?>
		<?php endif;

		wp_reset_query(); // Reset WP Query

        echo $after_widget;
    }
}