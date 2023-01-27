<?php
/**
 * Widget API: Latest News List/Slider 2 Class
 *
 * @package WP News and Five Widgets Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wpnw_pro_latest_news_list_slider2_widget() {
    register_widget( 'Wpnw_Pro_Lnlsw2_Widget' );
}

// Action to register widget
add_action( 'widgets_init', 'wpnw_pro_latest_news_list_slider2_widget' );

class Wpnw_Pro_Lnlsw2_Widget extends WP_Widget {

    /**
    * Sets up a new widget instance.
    *
    * @package WP News and Five Widgets Pro
    * @since 1.0.0
    */
    function __construct() {

        $widget_ops = array('classname' => 'PRO_SP_News_thmb_Widget', 'description' => __('Display Latest News Items in list view OR in Slider.', 'sp-news-and-widget'));
        parent::__construct( 'pro_sp_news_thumb_widget', __('Latest News List/Slider 2', 'sp-news-and-widget'), $widget_ops );
    }

     /**
     * Handles updating settings for the current widget instance.
     *
     * @package WP News and Five Widgets Pro
     * @since 1.0.0
     */
    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['title']              = sanitize_text_field($new_instance['title']);
        $instance['num_items']          = $new_instance['num_items'];
        $instance['date']               = !empty($new_instance['date']) ? 1 : 0;
        $instance['active_slider']      = !empty($new_instance['active_slider']) ? 1 : 0;
        $instance['show_category']      = !empty($new_instance['show_category']) ? 1 : 0;
        $instance['category']           = $new_instance['category'];
        $instance['dots']               = $new_instance['dots'];
        $instance['autoplay']           = $new_instance['autoplay'];
        $instance['autoplayInterval']   = $new_instance['autoplayInterval'];
        $instance['speed']              = $new_instance['speed'];
        $instance['link_target']        = !empty($new_instance['link_target']) ? 1 : 0;
        $instance['query_offset']       = !empty($new_instance['query_offset']) ? $new_instance['query_offset'] : '';

        return $instance;
    }

    /**
     * Outputs the settings form for the widget.
     * 
     * @package WP News and Five Widgets Pro
     * @since 1.0.0
     */
    function form($instance) {  
        $defaults = array(
            'num_items'         => 5,
            'title'             => __( 'Latest News', 'sp-news-and-widget' ),
            'date'              => 1, 
            'show_category'     => 1,
            'category'          => 0,
            'active_slider'     => 0,
            'dots'              => "true",
            'autoplay'          => "true",      
            'autoplayInterval'  => 5000,                
            'speed'             => 500,
            'link_target'       => 0,
            'query_offset'      => '',
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults );
    ?>

    <!-- Title -->
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php esc_html_e( 'Title:', 'sp-news-and-widget' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
    </p>

    <!-- Category -->
    <p>
        <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'sp-news-and-widget' ); ?></label>
        <?php
            $dropdown_args = array(
                                'taxonomy'          => WPNW_PRO_CAT,
                                'class'             => 'widefat',
                                'show_option_all'   => __( 'All', 'sp-news-and-widget' ),
                                'id'                => $this->get_field_id( 'category' ),
                                'name'              => $this->get_field_name( 'category' ),
                                'selected'          => $instance['category']
                            );
            wp_dropdown_categories( $dropdown_args );
        ?>
    </p>

    <!-- Number of Items -->
    <p>
        <label for="<?php echo $this->get_field_id('num_items'); ?>"><?php esc_html_e( 'Number of Items:', 'sp-news-and-widget' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="number" value="<?php echo $instance['num_items']; ?>" min="-1" />
    </p>

    <!-- Query Offset -->
    <p>
        <label for="<?php echo $this->get_field_id('query_offset'); ?>"><?php esc_html_e( 'Query Offset:', 'sp-news-and-widget' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('query_offset'); ?>" name="<?php echo $this->get_field_name('query_offset'); ?>" type="number" value="<?php echo $instance['query_offset']; ?>" min="0" />
        <span class="description"><em><?php _e('Query `offset` parameter to exclude number of post. Leave empty for default.', 'sp-news-and-widget'); ?></em></span><br/>
        <span class="description"><em><?php _e('Note: This parameter will not work when Number of Items is set to -1.', 'sp-news-and-widget'); ?></em></span>
    </p>

    <!--  Display Date -->
    <p>
        <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox" value="1" <?php checked($instance['date'], 1); ?> />
        <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'sp-news-and-widget' ); ?></label>
    </p>

    <!-- Display Category -->
    <p>
        <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox" value="1" <?php checked($instance['show_category'], 1); ?> />
        <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'sp-news-and-widget' ); ?></label>
    </p>

    <!-- Open Link in a New Tab -->
    <p>
        <input id="<?php echo $this->get_field_id( 'link_target' ); ?>" name="<?php echo $this->get_field_name( 'link_target' ); ?>" type="checkbox" value="1" <?php checked( $instance['link_target'], 1 ); ?> />
        <label for="<?php echo $this->get_field_id( 'link_target' ); ?>"><?php _e( 'Open Link in a New Tab', 'sp-news-and-widget' ); ?></label>
    </p>

    <!-- Active Slider -->
    <p>
        <h3><?php esc_html_e( 'News Slider Setting:', 'sp-news-and-widget' ); ?></h3> 
        <hr />
        <input id="<?php echo $this->get_field_id( 'active_slider' ); ?>" name="<?php echo $this->get_field_name( 'active_slider' ); ?>" type="checkbox" value="1" <?php checked($instance['active_slider'], 1); ?> />
        <label for="<?php echo $this->get_field_id( 'active_slider' ); ?>"><b><?php _e( 'Check this box to Display News in Slider View.', 'sp-news-and-widget' ); ?></b></label>
        <span class="description"><em><?php _e('By default News Display in List View', 'sp-news-and-widget'); ?></em></span>
    </p>
        
    <!-- Widget Order: Select dots -->
    <p>
        <label for="<?php echo $this->get_field_id( 'dots' ); ?>"><?php _e( 'Dots:', 'sp-news-and-widget' ); ?></label>
        <select name="<?php echo $this->get_field_name( 'dots' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'dots' ); ?>">
            <option value="true" <?php selected( $instance['dots'], 'true' ); ?>><?php _e( 'True', 'sp-news-and-widget' ); ?></option>
            <option value="false" <?php selected( $instance['dots'], 'false' ); ?>><?php _e( 'False', 'sp-news-and-widget' ); ?></option>
        </select>
    </p>

    <!-- Widget Order: Select Auto play -->
    <p>
        <label for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e( 'Auto Play:', 'sp-news-and-widget' ); ?></label>
        <select name="<?php echo $this->get_field_name( 'autoplay' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplay' ); ?>">
            <option value="true" <?php selected( $instance['autoplay'], 'true' ); ?>><?php _e( 'True', 'sp-news-and-widget' ); ?></option>
            <option value="false" <?php selected( $instance['autoplay'], 'false' ); ?>><?php _e( 'False', 'sp-news-and-widget' ); ?></option>
        </select>
    </p>

    <!-- Widget ID:  AutoplayInterval -->
    <p>
        <label for="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>"><?php _e( 'Autoplay Interval:', 'sp-news-and-widget' ); ?></label>
        <input type="number" name="<?php echo $this->get_field_name( 'autoplayInterval' ); ?>"  value="<?php echo $instance['autoplayInterval']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>" min="0" step="500" />
    </p>

    <!-- Widget ID:  Speed -->
    <p>
        <label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed:', 'sp-news-and-widget' ); ?></label>
        <input type="number" name="<?php echo $this->get_field_name( 'speed' ); ?>"  value="<?php echo $instance['speed']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>" min="0" step="100" />
    </p>
    <?php
    }
    
     /**
    * Outputs the content for the current widget instance.
    *
    * @package WP News and Five Widgets Pro
    * @since 1.0.0
    */
    function widget($news_args, $instance) {

        extract($news_args, EXTR_SKIP);

        $title              = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : __( 'Latest News', 'sp-news-and-widget' ), $instance, $this->id_base );
        $num_items          = $instance['num_items'];
        $date               = ( isset($instance['date']) && ($instance['date'] == 1) ) ? "true" : "false";
        $show_category      = ( isset($instance['show_category']) && ($instance['show_category'] == 1) ) ? "true" : "false";
        $category           = $instance['category'];
        $query_offset       = isset($instance['query_offset'])  ? $instance['query_offset'] : '';
        $activeSlider       = ( isset($instance['active_slider']) && ($instance['active_slider'] == 1) ) ? "true" : "false";
        $autoplay           = $instance['autoplay'];
        $autoplay_interval  = $instance['autoplayInterval'];
        $speed              = $instance['speed'];
        $dots               = $instance['dots'];
        $link_target        = (isset($instance['link_target']) && $instance['link_target'] == 1) ? '_blank' : '_self';
        $slider_cls         = ($activeSlider == 'true') ? 'wpnw-has-slider' : '';
        $unique             = wpnw_pro_get_unique();

        // Slider configuration
        $slider_conf = compact( 'dots', 'speed', 'autoplay_interval', 'autoplay' );

        // Enqueue required script
        wp_enqueue_script( 'wpos-slick-jquery' );
        wp_enqueue_script( 'wpnw-pro-public-script' );

        // Taking some globals
        global $post;

        // WP Query Parameter
        $news_args = array(
                            'post_type'             => WPNW_PRO_POST_TYPE,
                            'post_status'           => array( 'publish' ),
                            'posts_per_page'        => $num_items,
                            'order'                 => 'DESC',
                            'ignore_sticky_posts'   => true,
                            'suppress_filters'      => true,
                            'offset'                => $query_offset,
                        );

        // Category Parameter
        if( !empty($category) ) {
            $news_args['tax_query'] = array(
                                        array(
                                            'taxonomy'  => WPNW_PRO_CAT,
                                            'field'     => 'term_id',
                                            'terms'     => $category
                                    ));
        }

        // WP Query
        $cust_loop = new WP_Query($news_args);

        // Start Widget Output
        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        // If Post is there
        if ( $cust_loop->have_posts() ) {
    ?>
        <div class="wpnw-pro-news-widget-wrp wpnaw-clearfix">
            <div class="wpnw-pro-news-slider-widget <?php echo $slider_cls; ?> sp_news_static design-w3 wpnaw-clearfix" id="wpnw-pro-news-slider-widget-<?php echo $unique; ?>">
                
                <?php while ($cust_loop->have_posts()) : $cust_loop->the_post();

                        $post_link              = wpnw_pro_get_post_link( $post->ID );
                        $post_featured_image    = wpnw_get_post_featured_image( $post->ID, array(80,80), true );
                        $terms                  = get_the_terms( $post->ID, WPNW_PRO_CAT );
                        $news_links             = array();

                        if($terms) {
                            foreach ( $terms as $term ) {
                                $term_link      = get_term_link( $term );
                                $news_links[]   = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                            }
                        }
                        $cate_name = join( " ", $news_links );
                ?>

                <div class="news-list">
                    <div class="news-list-content">

                        <div class="news-left-img">
                            <div class="news-image-bg">
                                <?php if( !empty($post_featured_image) ) { ?>
                                <a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
                                    <img src="<?php echo $post_featured_image; ?>" alt="<?php the_title(); ?>" />
                                </a>
                                <?php } ?>
                            </div><!-- end .news-image-bg -->
                        </div><!-- end .news-left-img -->

                        <div class="news-right-content">
                            <?php if($show_category == 'true' && $cate_name !='') { ?>
                                <div class="news-categories">
                                    <?php echo $cate_name; ?>
                                </div>
                            <?php } ?>

                            <div class="news-title">
                                <a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                            </div>

                            <?php if($date == "true") { ?>
                            <div class="news-date">     
                                <?php echo get_the_date(); ?>
                            </div>
                            <?php } ?>
                        </div><!-- end .news-right-content -->

                    </div><!-- end .news-list-content -->
                </div><!-- end .news-list -->

            <?php endwhile; ?>

        </div><!-- end .sp_news_static -->

        <?php if( $activeSlider == 'true' ) { ?>
        <div class="wpnw-pro-slider-conf"><?php echo htmlspecialchars(json_encode($slider_conf)); ?></div>
        <?php } ?>

    </div><!-- end .wpnw-pro-news-widget-wrp -->

    <?php } // End of have_post()

        wp_reset_query(); // Reset WP Query

        echo $after_widget;
    }
}