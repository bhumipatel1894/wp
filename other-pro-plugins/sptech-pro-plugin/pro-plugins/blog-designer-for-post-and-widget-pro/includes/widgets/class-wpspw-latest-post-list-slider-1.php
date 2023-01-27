<?php
/**
* Widget Class
*
* Latest Post List/Slider 1
*
* @package Blog Designer - Post and Widget Pro
* @since 1.0.0
*/

function wpspw_pro_latest_post_list_slider_widget() {
    register_widget( 'Wpspw_Pro_Lplsw_Widget' );
}

// Action to register widget
add_action( 'widgets_init', 'wpspw_pro_latest_post_list_slider_widget' );

class Wpspw_Pro_Lplsw_Widget extends WP_Widget {
    
    function __construct() {
        $widget_ops = array( 'classname' => 'wpspw_pro_post_list_widget', 'description' => __('Display Latest WP Post in a list view OR in a Slider view.', 'blog-designer-for-post-and-widget') );
        parent::__construct( 'wpspw_pro_post_list_widget', __('Latest WP Post List/Slider 1', 'blog-designer-for-post-and-widget'), $widget_ops);
    }
    
    /**
    * Handles updating settings for the current widget instance.
    *
    * @package Blog Designer - Post and Widget Pro
    * @since 1.0.0
    */
    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['title']              = sanitize_text_field($new_instance['title']);
        $instance['num_items']          = !empty($new_instance['num_items']) ? $new_instance['num_items'] : 5;
        $instance['date']               = !empty($new_instance['date']) ? 1 : 0;
        $instance['active_slider']      = !empty($new_instance['active_slider']) ? 1 : 0;
        $instance['show_category']      = !empty($new_instance['show_category']) ? 1 : 0;
        $instance['category']           = $new_instance['category'];
        $instance['dots']               = $new_instance['dots'];
        $instance['autoplay']           = $new_instance['autoplay'];
        $instance['autoplayInterval']   = $new_instance['autoplayInterval'];
        $instance['speed']              = $new_instance['speed'];
        $instance['link_target']        = !empty($new_instance['link_target'])  ? 1 : 0;
        $instance['query_offset']       = !empty($new_instance['query_offset']) ? $new_instance['query_offset'] : '';
        
        return $instance;
    }

    /**
    * Outputs the settings form for the widget.
    *
    * @package Blog Designer - Post and Widget Pro
    * @since 1.0.0
    */
    function form($instance) {
        $defaults = array(
            'num_items'         => 5,
            'title'             => __( 'Latest Posts', 'blog-designer-for-post-and-widget' ),
            'date'              => 0,
            'show_category'     => 0,
            'category'          => 0,
            'active_slider'     => 0,
            'dots'              => 'true',
            'autoplay'          => 'true',
            'autoplayInterval'  => 5000,
            'speed'             => 500,
            'link_target'       => 0,
            'query_offset'      => '',
        );

        $instance = wp_parse_args( (array) $instance, $defaults );
    ?>
        <!-- Title -->
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'blog-designer-for-post-and-widget' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>

        <!-- Category -->
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'blog-designer-for-post-and-widget' ); ?></label>
            <?php
                $dropdown_args = array(
                                        'taxonomy'          => WPSPW_CAT,
                                        'class'             => 'widefat',
                                        'show_option_all'   => __( 'All', 'blog-designer-for-post-and-widget' ),
                                        'id'                => $this->get_field_id( 'category' ),
                                        'name'              => $this->get_field_name( 'category' ),
                                        'selected'          => $instance['category']
                                );
                wp_dropdown_categories( $dropdown_args );
            ?>
        </p>
        
        <!-- Number of Items -->
        <p>
            <label for="<?php echo $this->get_field_id('num_items'); ?>"><?php esc_html_e( 'Number of Items:', 'blog-designer-for-post-and-widget' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="number" value="<?php echo $instance['num_items']; ?>" min="-1" />
        </p>

        <!-- Query Offset -->
        <p>
            <label for="<?php echo $this->get_field_id('query_offset'); ?>"><?php esc_html_e( 'Query Offset:', 'blog-designer-for-post-and-widget' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('query_offset'); ?>" name="<?php echo $this->get_field_name('query_offset'); ?>" type="number" value="<?php echo $instance['query_offset']; ?>" min="0" />
            <span class="description"><em><?php _e('Query `offset` parameter to exclude number of post. Leave empty for default.', 'blog-designer-for-post-and-widget'); ?></em></span><br/>
            <span class="description"><em><?php _e('Note: This parameter will not work when Number of Items is set to -1.', 'blog-designer-for-post-and-widget'); ?></em></span>
        </p>
        
        <!--  Display Date -->
        <p>
            <input type="checkbox" value="1" id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" <?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'blog-designer-for-post-and-widget' ); ?></label>
        </p>

        <!-- Display Category -->
        <p>
            <input type="checkbox" value="1" id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" <?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'blog-designer-for-post-and-widget' ); ?></label>
        </p>

        <!-- Open Link in a New Tab -->
        <p>
            <input type="checkbox" value="1" id="<?php echo $this->get_field_id( 'link_target' ); ?>" name="<?php echo $this->get_field_name( 'link_target' ); ?>" <?php checked($instance['link_target'], 1); ?> />
            <label for="<?php echo $this->get_field_id( 'link_target' ); ?>"><?php _e( 'Open Link in a New Tab', 'blog-designer-for-post-and-widget' ); ?></label>
        </p>

        <!-- Active Slider -->
        <p>
            <h3><?php esc_html_e( 'Post Slider Setting:', 'blog-designer-for-post-and-widget' ); ?></h3> 
            <hr />
            <input type="checkbox" value="1" id="<?php echo $this->get_field_id( 'active_slider' ); ?>" name="<?php echo $this->get_field_name( 'active_slider' ); ?>" <?php checked($instance['active_slider'], 1); ?> />
            <label for="<?php echo $this->get_field_id( 'active_slider' ); ?>"><?php _e( 'Check this box to Display Post in Slider View.', 'blog-designer-for-post-and-widget' ); ?></label> <br />
            <span class="description"><em><?php _e('By default Post Display in List View', 'blog-designer-for-post-and-widget'); ?></em></span>
        </p>
        
        <!-- Widget Order: Select dots -->
        <p>
            <label for="<?php echo $this->get_field_id( 'dots' ); ?>"><?php _e( 'Dots:', 'blog-designer-for-post-and-widget' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'dots' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'dots' ); ?>">
                <option value="true" <?php selected( $instance['dots'], 'true' ); ?>><?php _e( 'True', 'blog-designer-for-post-and-widget' ); ?></option>
                <option value="false" <?php selected( $instance['dots'], 'false' ); ?>><?php _e( 'False', 'blog-designer-for-post-and-widget' ); ?></option>
            </select>
        </p>

        <!-- Widget Order: Select Auto play -->
        <p>
            <label for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e( 'Auto Play:', 'blog-designer-for-post-and-widget' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'autoplay' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplay' ); ?>">
                <option value="true" <?php selected( $instance['autoplay'], 'true' ); ?>><?php _e( 'True', 'blog-designer-for-post-and-widget' ); ?></option>
                <option value="false" <?php selected( $instance['autoplay'], 'false' ); ?>><?php _e( 'False', 'blog-designer-for-post-and-widget' ); ?></option>
            </select>
        </p>

        <!-- Widget ID: AutoplayInterval -->
        <p>
            <label for="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>"><?php _e( 'Autoplay Interval:', 'blog-designer-for-post-and-widget' ); ?></label>
            <input type="number" name="<?php echo $this->get_field_name( 'autoplayInterval' ); ?>"  value="<?php echo $instance['autoplayInterval']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>" min="0" step="500" />
        </p>
        
        <!-- Widget ID: Speed -->
        <p>
            <label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed:', 'blog-designer-for-post-and-widget' ); ?></label>
            <input type="number" name="<?php echo $this->get_field_name( 'speed' ); ?>"  value="<?php echo $instance['speed']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>" min="0" step="100" />
        </p>    
    <?php
    }

    /**
    * Outputs the content for the current widget instance.
    *
    * @package Blog Designer - Post and Widget Pro
    * @since 1.0.0
    */
    function widget($args, $instance) {

        extract($args, EXTR_SKIP);
        
        $title              = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : __( 'Latest Posts', 'blog-designer-for-post-and-widget' ), $instance, $this->id_base );
        $num_items          = $instance['num_items'];
        $date               = ( isset($instance['date']) && ($instance['date'] == 1) ) ? "true" : "false";
        $show_category      = ( isset($instance['show_category']) && ($instance['show_category'] == 1) ) ? "true" : "false";
        $category           = $instance['category'];
        $activeSlider       = ( isset($instance['active_slider']) && ($instance['active_slider'] == 1) ) ? "true" : "false";
        $autoplay           = $instance['autoplay'];
        $autoplay_interval  = $instance['autoplayInterval'];
        $speed              = $instance['speed'];
        $dots               = $instance['dots'];
        $link_target        = (isset($instance['link_target']) && $instance['link_target'] == 1) ? '_blank' : '_self';
        $query_offset       = isset($instance['query_offset'])  ? $instance['query_offset']     : '';
        $slider_cls         = ($activeSlider == 'true')         ? 'wpspw-has-slider'            : '';
        $unique             = wpspw_pro_get_unique();

        // Slider configuration
        $slider_conf = compact( 'dots', 'speed', 'autoplay_interval', 'autoplay' );

        // Enqueue required script
        wp_enqueue_script( 'wpos-slick-jquery' );
        wp_enqueue_script( 'wpspw-pro-public-script' );

        // Taking some globals
        global $post;

        // WP Query Parameter
        $post_args = array(
                    'post_type'             => WPSPW_POST_TYPE,
                    'post_status'           => array( 'publish' ),
                    'posts_per_page'        => $num_items,
                    'order'                 => 'DESC',
                    'ignore_sticky_posts'   => true,
                    'suppress_filters'      => true,
                    'offset'                => $query_offset,
                );

        // Category Parameter
        if( !empty($category) ) {
            $post_args['tax_query'] = array(
                                        array(
                                            'taxonomy'  => WPSPW_CAT,
                                            'field'     => 'term_id',
                                            'terms'     => $category
                                    ));
        }

        // WP Query
        $cust_loop  = new WP_Query($post_args);

        // Start Widget Output
        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        // If Post is there
        if ($cust_loop->have_posts()) {
    ?>
        
        <div class="wpspw-pro-widget-wrp wpspw-clearfix">
            <div class="<?php echo $slider_cls; ?> sp_wpspwpost_static wpspw-design-w2" id="wpspw-pro-widget-<?php echo $unique; ?>">

                <?php while ($cust_loop->have_posts()) : $cust_loop->the_post();
                    
                    $post_links     = array();
                    $feat_image     = wpspw_pro_get_post_featured_image( $post->ID, 'medium', true );
                    $post_link      = wpspw_pro_get_post_link( $post->ID );
                    $terms          = get_the_terms( $post->ID, WPSPW_CAT );
                    
                    if($terms) {
                        foreach ( $terms as $term ) {
                            $term_link = get_term_link( $term );
                            $post_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                        }
                    }
                    $cate_name = join( " ", $post_links );
                ?>

                <div class="wpspw-post-grid">
                    <div class="wpspw-post-image-bg">
                        <a  href="<?php echo $post_link; ?>" title="<?php the_title(); ?>" target="<?php echo $link_target; ?>">
                            <?php if( !empty($feat_image) ) { ?>
                                <img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
                            <?php } ?>
                        </a>

                        <?php if($show_category == 'true') {
                            if($cate_name !='') { ?>
                                <div class="wpspw-post-categories">
                                    <?php echo $cate_name; ?>
                                </div>
                            <?php }
                        } ?>
                    </div>

                    <div class="wpspw-post-grid-content">
                        <div class="wpspwpost-content">
                            <div class="wpspw-post-title">
                                <a href="<?php echo $post_link; ?>" title="<?php the_title(); ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
                            </div>
                            <?php if($date == "true") { ?>
                                <div class="wpspw-post-date">
                                    <?php echo get_the_date(); ?>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>

                <?php endwhile; ?>
            </div>
            
            <?php if( $activeSlider == 'true' ) { ?>
                <div class="wpspw-pro-slider-conf"><?php echo htmlspecialchars(json_encode($slider_conf)); ?></div>
            <?php } ?>
        </div>

    <?php } // End of have_post()

        wp_reset_query(); // Reset WP Query

        echo $after_widget;
    }
}