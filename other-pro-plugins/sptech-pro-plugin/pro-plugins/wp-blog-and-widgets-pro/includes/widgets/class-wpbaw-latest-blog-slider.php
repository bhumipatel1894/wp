<?php
/**
 * Widget API: Latest Blog Slider Widget Class
 *
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wpbaw_pro_latest_blog_slider_widget() {
    register_widget( 'Wpbaw_Pro_Lbsw_Widget' );
}

// Action to register widget
add_action( 'widgets_init', 'wpbaw_pro_latest_blog_slider_widget' );

/**
 * Latest Blog Slider Widget Class
 *
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */
class Wpbaw_Pro_Lbsw_Widget extends WP_Widget {

    /**
     * Sets up a new widget instance.
     *
     * @package WP Blog and Widgets Pro
     * @since 1.0.0
     */
    function __construct() {

        $widget_ops     = array( 'classname' => 'wpbaw-pro-lbsw', 'description' => __( "Display Latest Blog Items with slider.", 'wp-blog-and-widgets' ) );
        parent::__construct('wpbaw_pro_lbsw', __('Latest Blog Slider Widget', 'wp-blog-and-widgets'), $widget_ops);
    }

    /**
     * Handles updating settings for the current widget instance.
     *
     * @package WP Blog and Widgets Pro
     * @since 1.0.0
     */
    function update($new_instance, $old_instance) {
        
        $instance = $old_instance;

        $instance['title']              = sanitize_text_field( $new_instance['title'] );
        $instance['num_items']          = !empty($new_instance['num_items']) ? $new_instance['num_items'] : 5;
        $instance['date']               = !empty($new_instance['date']) ? 1 : 0;
        $instance['show_category']      = !empty($new_instance['show_category']) ? 1 : 0;
        $instance['category']           = intval( $new_instance['category'] ); 
        $instance['arrows']             = $new_instance['arrows'];
        $instance['autoplay']           = $new_instance['autoplay'];
        $instance['autoplayInterval']   = (!empty($new_instance['autoplayInterval'])) ? $new_instance['autoplayInterval'] : 5000;
        $instance['speed']              = (!empty($new_instance['speed'])) ? $new_instance['speed'] : 500;

        return $instance;
    }

    /**
     * Outputs the settings form for the widget.
     *
     * @package WP Blog and Widgets Pro
     * @since 1.0.0
     */
    function form( $instance ) {
        
        $defaults = array(
                'num_items'         => 5,
                'title'             => '',
                'date'              => 1, 
                'show_category'     => 1,
                'category'          => 0,
                'arrows'            => "true",
                'autoplay'          => "true",      
                'autoplayInterval'  => 5000,                
                'speed'             => 500,
                'num_items'         => 5,
            );
        $instance = wp_parse_args( (array) $instance, $defaults );
    ?>
    
        <!-- Title -->
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'wp-blog-and-widgets' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>

        <!-- Number of Items -->
        <p>
            <label for="<?php echo $this->get_field_id('num_items'); ?>"><?php _e( 'Number of Items:', 'wp-blog-and-widgets' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="number" min="-1" value="<?php echo esc_attr($instance['num_items']); ?>" />
        </p>

        <!-- Category -->
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'wp-blog-and-widgets' ); ?></label>
            <?php
            $dropdown_args = array( 
                                    'taxonomy'          => WPBAW_PRO_CAT,
                                    'class'             => 'widefat',
                                    'show_option_all'   => __( 'All', 'wp-blog-and-widgets' ),
                                    'id'                => $this->get_field_id( 'category' ),
                                    'name'              => $this->get_field_name( 'category' ),
                                    'selected'          => $instance['category']
                                );
            wp_dropdown_categories( $dropdown_args );
            ?>
        </p>
        
        <!-- Arrows -->
        <p>
            <label for="<?php echo $this->get_field_id( 'arrows' ); ?>"><?php _e( 'Arrows:', 'wp-blog-and-widgets' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'arrows' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'arrows' ); ?>">
                <option value="true" <?php selected( $instance['arrows'], 'true' ); ?>><?php _e( 'True', 'wp-blog-and-widgets' ); ?></option>
                <option value="false" <?php selected( $instance['arrows'], 'false' ); ?>><?php _e( 'False', 'wp-blog-and-widgets' ); ?></option>
            </select>
        </p>

        <!-- Auto Play -->
        <p>
            <label for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e( 'Auto Play:', 'wp-blog-and-widgets' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'autoplay' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplay' ); ?>">
                <option value="true" <?php selected( $instance['autoplay'], 'true' ); ?>><?php _e( 'True', 'wp-blog-and-widgets' ); ?></option>
                <option value="false" <?php selected( $instance['autoplay'], 'false' ); ?>><?php _e( 'False', 'wp-blog-and-widgets' ); ?></option>
            </select>
        </p>

        <!-- Autoplay Interval -->
        <p>
            <label for="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>"><?php _e( 'Autoplay Interval:', 'wp-blog-and-widgets' ); ?></label>
            <input type="number" min="0" step="500" name="<?php echo $this->get_field_name( 'autoplayInterval' ); ?>"  value="<?php echo $instance['autoplayInterval']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>" />
        </p>

        <!-- Speed -->
        <p>
            <label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed:', 'wp-blog-and-widgets' ); ?></label>
            <input type="number" min="0" step="100" name="<?php echo $this->get_field_name( 'speed' ); ?>"  value="<?php echo $instance['speed']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>" />
        </p>

        <!-- Display Date -->
        <p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox" value="1" <?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'wp-blog-and-widgets' ); ?></label>
        </p>

        <!--  Display Category -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'wp-blog-and-widgets' ); ?></label>
        </p>

    <?php }

    /**
    * Outputs the content for the current widget instance.
    *
    * @package WP Blog and Widgets Pro
    * @since 1.0.0
    */
    function widget( $blog_args, $instance ) {

        extract($blog_args, EXTR_SKIP);

        $title              = apply_filters( 'widget_title', isset($instance['title']) ? $instance['title'] : __( 'Latest Blog Slider Widget', 'wp-blog-and-widgets' ), $instance, $this->id_base );
        $num_items          = $instance['num_items'];
        $date               = ( isset($instance['date']) && ($instance['date'] == 1) ) ? "true" : "false";
        $show_category      = ( isset($instance['show_category']) && ($instance['show_category'] == 1) ) ? "true" : "false";
        $category           = $instance['category'];
        $arrows             = $instance['arrows'];
        $autoplay           = $instance['autoplay'];
        $autoplay_interval  = $instance['autoplayInterval'];
        $speed              = $instance['speed'];
        
        // Slider configuration
        $slider_conf = compact( 'speed', 'autoplay_interval', 'autoplay', 'arrows' );
        
        // Taking some global
        global $post;

        // Taking some default variables
        $postcount      = 0;
        $count          = 0;
        $unique         = wpbaw_pro_get_unique();
        $default_img    = wpbaw_pro_get_option('default_img');

        // Enqueue required script
        wp_enqueue_script( 'wpos-slick-jquery' );
        wp_enqueue_script( 'wpbaw-pro-public-script' );

        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }
    ?>

    <div class="wpbaw-pro-blog-widget-wrp">
        <div class="wpbaw-pro-blog-slider-widget sp_blog_slider design-w1" id="wpbaw-pro-blog-widget-<?php echo $unique; ?>">
        
        <?php
            // WP Query Parameter
            $blog_args = array( 
                            'suppress_filters'  => true,
                            'posts_per_page'    => $num_items,
                            'post_type'         => WPBAW_PRO_POST_TYPE,
                            'order'             => 'DESC'
                        );

            // Category Parameter
            if($category != 0) {
                $blog_args['tax_query'] = array(
                                                array(
                                                        'taxonomy'  => WPBAW_PRO_CAT,
                                                        'field'     => 'id',
                                                        'terms'     => $category
                                                    ));
            }

            // WP Query
            $cust_loop  = new WP_Query($blog_args);
            $post_count = $cust_loop->post_count;
            
            if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post();
                    
                    $count++;
                    $postcount++;
                    $blog_links     = array();
                    $feat_image     = wpbaw_pro_get_post_featured_image( $post->ID );
                    $feat_image     = ( $feat_image ) ? $feat_image : $default_img;
                    $post_link      = wpbaw_pro_get_post_link( $post->ID );
                    $terms          = get_the_terms( $post->ID, WPBAW_PRO_CAT );
                    
                    if($terms) {
                        foreach ( $terms as $term ) {
                            $term_link      = get_term_link( $term );
                            $blog_links[]   = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                        }
                    }
                    $cate_name = join( " ", $blog_links );
    ?>
					
                <div class="blog-slides">  
                    <div class="blog-grid-content">
						<div class="blog-overlay">

							<div class="blog-image-bg">
                                <?php if( !empty($feat_image) ) { ?>
                                <img src="<?php echo $feat_image; ?>" alt="<?php _e( 'Post Image', 'wp-blog-and-widgets') ?>" />
                                <?php } ?>
								
                                <?php if($show_category == 'true' && $cate_name !='') { ?>
                                <div class="blog-categories">		
                                    <?php echo $cate_name; ?>		
                                </div>
								<?php } ?>
							</div>

							<div class="blog-short-content">
                                <h2 class="blog-title">
                                    <a href="<?php echo $post_link; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                </h2>

                                <?php if($date == "true") { ?>
                                <div class="blog-date">		
								    <?php echo get_the_date(); ?>
								</div>
                                <?php } ?>
							</div>

						</div>
				    </div>
                </div>
				
            <?php
            endwhile;
            endif;
            
            wp_reset_query();
    ?>
            </div>
            <div class="wpbaw-pro-slider-conf"><?php echo htmlspecialchars(json_encode($slider_conf)); ?></div>
        </div>

<?php
        echo $after_widget;
    }
}