<?php
/**
* Widget Class : Latest Post Scrolling Widget
*
* @package Blog Designer - Post and Widget Pro
* @since 1.0.0
*/


function wpspw_pro_post_scroll_widget() {
  register_widget( 'Wpspw_Pro_Post_scrolling_Widget' );
}

// Action to register widget
add_action( 'widgets_init', 'wpspw_pro_post_scroll_widget' );

class Wpspw_Pro_Post_scrolling_Widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'wpspw_pro_post_scrolling_widget', 'description' => __('Display Latest WP Post in a sidebar with vertical slider.', 'blog-designer-for-post-and-widget') );
        parent::__construct( 'wpspw_pro_post_scrolling_widget', __('Latest WP Post Scrolling Widget', 'blog-designer-for-post-and-widget'), $widget_ops);
    }

    /**
     * Handles updating settings for the current widget instance.
     *
     * @package Blog Designer - Post and Widget Pro
     * @since 1.0.0
    */
    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['title']          = sanitize_text_field($new_instance['title']);
        $instance['num_items']      = $new_instance['num_items'];
        $instance['date']           = !empty($new_instance['date']) ? 1 : 0;
        $instance['show_category']  = !empty($new_instance['show_category']) ? 1 : 0;
        $instance['show_thumb']     = !empty($new_instance['show_thumb']) ? 1 : 0;
        $instance['category']       = $new_instance['category'];
        $instance['height']         = $new_instance['height'];
        $instance['pause']          = $new_instance['pause'];
        $instance['speed']          = $new_instance['speed'];
        $instance['link_target']    = !empty($new_instance['link_target']) ? 1 : 0;
        $instance['query_offset']   = !empty($new_instance['query_offset']) ? $new_instance['query_offset'] : '';
        
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
            'date'              => 1, 
            'show_category'     => 1,
            'show_thumb'        => 1,
            'category'          => 0,
            'height'            => 400,      
            'pause'             => 2000,                
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

        <!-- Display Category -->
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'blog-designer-for-post-and-widget' ); ?></label>
            <?php
                $dropdown_args = array(
                                        'taxonomy'          => WPSPW_CAT,
                                        'class'             => 'widefat',
                                        'show_option_all'   => __( 'All', 'blog-designer-for-post-and-widget' ),
                                        'id'                => $this->get_field_id( 'category' ),
                                        'name'              => $this->get_field_name( 'category' ),
                                        'selected'          => $instance['category'],
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

        <!-- Display Date -->
        <p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox" value="1" <?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'blog-designer-for-post-and-widget' ); ?></label>
        </p>

        <!-- Display Category -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'blog-designer-for-post-and-widget' ); ?></label>
        </p>

        <!-- Show Thumb -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_thumb' ); ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_thumb'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_thumb' ); ?>"><?php _e( 'Display Thumbnail in left side', 'blog-designer-for-post-and-widget' ); ?></label>
        </p>

        <!-- Open Link in a New Tab -->
        <p>
            <input id="<?php echo $this->get_field_id( 'link_target' ); ?>" name="<?php echo $this->get_field_name( 'link_target' ); ?>" type="checkbox"<?php checked( $instance['link_target'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'link_target' ); ?>"><?php _e( 'Open Link in a New Tab', 'blog-designer-for-post-and-widget' ); ?></label>
        </p>

        <!-- Height -->
        <p>
            <label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height:', 'blog-designer-for-post-and-widget' ); ?></label>
            <input type="number" name="<?php echo $this->get_field_name( 'height' ); ?>"  value="<?php echo $instance['height']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" min="1" step="100" />
        </p>

        <!-- Pause -->
        <p>
            <label for="<?php echo $this->get_field_id( 'pause' ); ?>"><?php _e( 'Pause:', 'blog-designer-for-post-and-widget' ); ?></label>
            <input type="number" name="<?php echo $this->get_field_name( 'pause' ); ?>"  value="<?php echo $instance['pause']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'pause' ); ?>" min="1" step="500" />
        </p>

        <!-- Speed -->
        <p>
            <label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed:', 'blog-designer-for-post-and-widget' ); ?></label>
            <input type="number" name="<?php echo $this->get_field_name( 'speed' ); ?>"  value="<?php echo $instance['speed']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>" min="1" step="100" />
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

        $title          = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : __( 'Latest Posts', 'blog-designer-for-post-and-widget' ), $instance, $this->id_base );
        $num_items      = $instance['num_items'];
        $date           = ( isset($instance['date']) && ($instance['date'] == 1) ) ? "true" : "false";
        $show_category  = ( isset($instance['show_category']) && ($instance['show_category'] == 1) ) ? "true" : "false";
        $show_thumb     = ( isset($instance['show_thumb']) && ($instance['show_thumb'] == 1) ) ? "true" : "false";
        $query_offset   = isset($instance['query_offset'])  ? $instance['query_offset'] : '';
        $category       = $instance['category'];
        $height         = $instance['height'];
        $pause          = $instance['pause'];
        $speed          = $instance['speed'];
        $link_target    = (isset($instance['link_target']) && $instance['link_target'] == 1) ? '_blank' : '_self';
        $unique         = wpspw_pro_get_unique();

        // Slider configuration
        $slider_conf = compact( 'speed', 'height', 'pause' );

        // Enqueue required script
        wp_enqueue_script( 'wpos-slick-jquery' );
        wp_enqueue_script( 'wpos-vticker-jquery' );
        wp_enqueue_script( 'wpspw-pro-public-script' );

        // Taking some global
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
        $cust_loop = new WP_Query($post_args);

        // Start Widget Output
        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        // If Post is there
        if ($cust_loop->have_posts()) {
    ?>

    <div class="wpspw-pro-widget-wrp recent-post-items">
        <div class="recent-wpspwpost-items">
            <div class="post-ticker-jcarousellite" id="wpspw-pro-post-ticker-<?php echo $unique; ?>">
                <ul>
                    <?php while ($cust_loop->have_posts()) : $cust_loop->the_post();
                        
                        $cat_links      = array();
                        $feat_image     = wpspw_pro_get_post_featured_image( $post->ID, array(80,80), true );
                        $post_link      = wpspw_pro_get_post_link( $post->ID );
                        $terms          = get_the_terms( $post->ID, WPSPW_CAT );
                        
                        if($terms) {
                          foreach ( $terms as $term ) {
                                $term_link      = get_term_link( $term );
                                $cat_links[]    = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                            }
                        }
                        $cate_name = join( " ", $cat_links );
                    ?>

                    <li class="wpspw-post_li">
                    <?php if($show_thumb == 'true') { ?>
                    
                        <div class="wpspw-post-list-content">
                            <div class="wpspw-post-left-img">
                                <div class="wpspw-post-image-bg">
                                    <a  href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
                                        <?php if( !empty($feat_image) ) { ?>
                                            <img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
                                        <?php } ?>
                                    </a>
                                </div>
                            </div>

                            <div class="wpspw-post-right-content">
                                <?php if($show_category == 'true' && $cate_name !='') { ?>
                                <div class="wpspw-post-categories">	
                                    <?php echo $cate_name; ?>
                                </div>
                                <?php } ?>
                                
                                <div class="wpspw-post-title">
                                    <a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
                                </div>

                                <?php if($date == "true") { ?>
                                <div class="wpspw-post-date">
                                    <?php echo get_the_date(); ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>

                    <?php } else { ?>

                        <?php if($show_category == 'true' && $cate_name !='') { ?>
                        <div class="wpspw-post-categories">
                            <?php echo $cate_name; ?>
                        </div>
                        <?php } ?>
                        
                        <div class="wpspw-post-title"> 
                            <a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
                        </div>

                        <?php if($date == "true") { ?>
                        <div class="wpspw-post-date"><?php echo get_the_date(); ?></div>
                        <?php } ?>

                    <?php } ?>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
        <div class="wpspw-pro-slider-conf"><?php echo htmlspecialchars(json_encode($slider_conf)); ?></div>
    </div>

    <?php } // End of have_post()

        wp_reset_query(); // Reset WP Query

        echo $after_widget;
    }
}