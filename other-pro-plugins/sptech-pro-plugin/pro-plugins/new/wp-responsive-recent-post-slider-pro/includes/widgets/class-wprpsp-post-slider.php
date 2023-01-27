<?php
/**
 * Widget API: Latest Post List Slider Widget 2 Class
 *
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wprpsp_latest_post_slider_widget() {
    register_widget( 'Wprpsp_Lsw_Widget' );
}

// Action to register widget
add_action( 'widgets_init', 'wprpsp_latest_post_slider_widget' );

class Wprpsp_Lsw_Widget extends WP_Widget {

    var $defaults;

    /**
     * Sets up a new widget instance.
     * 
     * @package WP Responsive Recent Post Slider Pro
     * @since 1.0.0
     */
    function __construct() {		
        $widget_ops = array('classname' => 'wprpsp-lsw', 'description' => __('Displayed Latest Post Items with slider', 'wp-responsive-recent-post-slider') );
        parent::__construct( 'wprpsp_lsw', __('Latest Post Slider Widget', 'wp-responsive-recent-post-slider'), $widget_ops );

        $this->defaults = array(
            'post_type'         => 'post',
            'taxonomy'          => 'category',
            'category'          => array(),
            'num_items'         => 5,
            'title'             => '',
            'date'              => 1, 
            'show_category'     => 1,            
            'sticky_posts'      => 0,
            'order'             => 'desc',
            'orderby'           => 'date',
            'posts'             => '',
            'exclude_posts'     => '',
            'arrows'            => "true",
            'autoplay'          => "true",      
            'autoplayInterval'  => 3000,                
            'speed'             => 300,
            'image_size'        => 'large',
            'image_fit'         => 1,
        );
    }

    /**
     * Handles updating settings for the current widget instance.
     *
     * @package WP Responsive Recent Post Slider Pro
     * @since 1.0.0
     */
    function update($new_instance, $old_instance) {
        
        $instance = $old_instance;
        
        $instance['title']              = sanitize_text_field($new_instance['title']);
        $instance['post_type']          = !empty($new_instance['post_type']) ? $new_instance['post_type'] : 'post';
        $instance['taxonomy']           = $new_instance['taxonomy'];
        $instance['category']           = $new_instance['category'];
        $instance['num_items']          = !empty($new_instance['num_items']) ? $new_instance['num_items'] : 5;
        $instance['date']               = !empty($new_instance['date'])          ? 1 : 0;
        $instance['show_category']      = !empty($new_instance['show_category']) ? 1 : 0;
        $instance['sticky_posts']       = !empty($new_instance['sticky_posts'])  ? 1 : 0;
        $instance['image_fit']          = !empty($new_instance['image_fit'])     ? 1 : 0;        
        $instance['order']              = ($new_instance['order'] == 'asc') ? 'asc' : 'desc';
        $instance['orderby']            = $new_instance['orderby'];
        $instance['posts']              = $new_instance['posts'];
        $instance['exclude_posts']      = $new_instance['exclude_posts'];
        $instance['arrows']             = ($new_instance['arrows'] == 'false') ? 'false' : 'true';
        $instance['autoplay']           = ($new_instance['autoplay'] == 'false') ? 'false' : 'true';
        $instance['autoplayInterval']   = intval( $new_instance['autoplayInterval'] );
        $instance['speed']              = intval( $new_instance['speed'] );
        $instance['image_size']         = $new_instance['image_size'];

        return $instance;
    }

    /**
     * Outputs the settings form for the widget.
     *
     * @package WP Responsive Recent Post Slider Pro
     * @since 1.0.0
     */
    function form($instance) {
        $instance   = wp_parse_args( (array) $instance, $this->defaults );
        
        $category           = (array) $instance['category'];
        $post_types         = wprpsp_get_post_types();
        $support_post_types = wprpsp_get_option('post_types',array());
        $sel_post_type      = (!empty($instance['post_type']) && in_array($instance['post_type'], $support_post_types)) ? $instance['post_type']    : 'post';
        $sel_taxonomy       = (!empty($instance['post_type']) && in_array($instance['post_type'], $support_post_types)) ? $instance['taxonomy']     : 'category';
    ?>

        <!-- Title -->    
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'wp-responsive-recent-post-slider' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>

        <!-- Post type  -->
        <p>
            <label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e( 'Post Type', 'wp-responsive-recent-post-slider' ); ?>:</label>
            <select class="widefat wprpsp-reg-post-types" id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>" >
                <?php
                if( !empty($post_types) ) {
                    foreach ($post_types as $post_key => $post_value) {
                        if(in_array($post_key, $support_post_types)) {
                            echo '<option value="'.$post_key.'" '.selected($post_key, $instance['post_type']).'>'.$post_value.'</option>';
                        }
                    }
                }
                ?>
            </select>
        </p>

        <!-- Taxonomy  -->
        <p>
            <label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e( 'Texonomy', 'wp-responsive-recent-post-slider' ); ?>:</label>
            <select class="widefat wprpsp-reg-taxonomy" id="<?php echo $this->get_field_id('taxonomy'); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>">
                <?php 
                $taxonomy_objects   = get_object_taxonomies( $sel_post_type, 'object' );
                $taxonomy           = wprpsp_get_taxonomy_options($taxonomy_objects, $sel_taxonomy);
                echo $taxonomy;
                ?>
            </select>
        </p>

        <!-- Category -->
        <p>
            <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e( 'Category', 'wp-responsive-recent-post-slider' ); ?>:</label>
            <select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category[]'); ?>" class="widefat wprpsp-terms" multiple="multiple">
                <?php
                $taxonomy_objects   = get_terms(array('taxonomy' => $sel_taxonomy));
                $terms              = wprpsp_get_terms_options($taxonomy_objects, $instance['category']);
                echo $terms;
                ?>
            </select>
        </p>

        <!-- Number of Items  -->
        <p>
            <label for="<?php echo $this->get_field_id('num_items'); ?>"><?php _e( 'Number of Items', 'wp-responsive-recent-post-slider' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="number" value="<?php echo $instance['num_items']; ?>" min="-1" />
        </p>        

        <!-- Order By -->
        <p>
            <label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Order By', 'wp-responsive-recent-post-slider' ); ?>:</label>
            <select name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'orderby' ); ?>">
                <option value="date" <?php selected( $instance['orderby'], 'date' ); ?>><?php _e( 'Post Date', 'wp-responsive-recent-post-slider' ); ?></option>
                <option value="modified" <?php selected( $instance['orderby'], 'modified' ); ?>><?php _e( 'Post Updated Date', 'wp-responsive-recent-post-slider' ); ?></option>
                <option value="ID" <?php selected( $instance['orderby'], 'ID' ); ?>><?php _e( 'Post Id', 'wp-responsive-recent-post-slider' ); ?></option>
                <option value="title" <?php selected( $instance['orderby'], 'title' ); ?>><?php _e( 'Post Title', 'wp-responsive-recent-post-slider' ); ?></option>
                <option value="name" <?php selected( $instance['orderby'], 'name' ); ?>><?php _e( 'Post URL Slug', 'wp-responsive-recent-post-slider' ); ?></option>
                <option value="comment_count" <?php selected( $instance['orderby'], 'comment_count' ); ?>><?php _e( 'Post Comment Count', 'wp-responsive-recent-post-slider' ); ?></option>
                <option value="rand" <?php selected( $instance['orderby'], 'rand' ); ?>><?php _e( 'Random', 'wp-responsive-recent-post-slider' ); ?></option>
                <option value="menu_order" <?php selected( $instance['orderby'], 'menu_order' ); ?>><?php _e( 'Menu Order (Sort Order)', 'wp-responsive-recent-post-slider' ); ?></option>
            </select>
        </p>

        <!-- Order -->
        <p>
            <label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'Order', 'wp-responsive-recent-post-slider' ); ?>:</label>
            <select name="<?php echo $this->get_field_name( 'order' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>">
                <option value="asc" <?php selected( $instance['order'], 'asc' ); ?>><?php _e( 'Ascending', 'wp-responsive-recent-post-slider' ); ?></option>
                <option value="desc" <?php selected( $instance['order'], 'desc' ); ?>><?php _e( 'Descending', 'wp-responsive-recent-post-slider' ); ?></option>
            </select>
        </p>

        <!-- Display Specific Posts -->    
        <p>
            <label for="<?php echo $this->get_field_id('posts'); ?>"><?php _e( 'Display Specific Posts', 'wp-responsive-recent-post-slider' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" type="text" value="<?php echo esc_attr($instance['posts']); ?>" />
            <span><em><?php _e('Enter Post id which you want to display. You can enter multiple ids with comma seperated.', 'wp-responsive-recent-post-slider'); ?></em></span>
        </p>

        <!-- Exclude Posts -->    
        <p>
            <label for="<?php echo $this->get_field_id('exclude_posts'); ?>"><?php _e( 'Exclude Posts', 'wp-responsive-recent-post-slider' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('exclude_posts'); ?>" name="<?php echo $this->get_field_name('exclude_posts'); ?>" type="text" value="<?php echo esc_attr($instance['exclude_posts']); ?>" />
            <span><em><?php _e('Enter Post id which you do not want to display. You can enter multiple ids with comma seperated.', 'wp-responsive-recent-post-slider'); ?></em></span>
        </p>

        <!-- Image Size Field -->
        <p>
            <label for="<?php echo $this->get_field_id('image_size'); ?>"><?php _e( 'Image Size', 'wp-responsive-recent-post-slider' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('image_size'); ?>" name="<?php echo $this->get_field_name('image_size'); ?>" type="text" value="<?php echo wprpsp_esc_attr($instance['image_size']); ?>" />
            <span><em><?php _e('Enter WordPress registered image size e.g. thumbnail, medium, large or full.', 'wp-responsive-recent-post-slider'); ?></em></span>
        </p>

        <!-- Display Date -->
        <p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox" value="1" <?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'wp-responsive-recent-post-slider' ); ?></label>
        </p>

        <!-- Display Category -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox"<?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'wp-responsive-recent-post-slider' ); ?></label>
        </p>

        <!-- Display Sticky Post -->
        <p>
            <input id="<?php echo $this->get_field_id( 'sticky_posts' ); ?>" name="<?php echo $this->get_field_name( 'sticky_posts' ); ?>" type="checkbox" value="1" <?php checked( $instance['sticky_posts'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'sticky_posts' ); ?>"><?php _e( 'Display Sticky Posts', 'wp-responsive-recent-post-slider' ); ?></label>
        </p>

        <!-- Image Fit -->
        <p>
            <input id="<?php echo $this->get_field_id( 'image_fit' ); ?>" name="<?php echo $this->get_field_name( 'image_fit' ); ?>" type="checkbox" value="1" <?php checked( $instance['image_fit'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'image_fit' ); ?>"><?php _e( 'Image Fit', 'wp-responsive-recent-post-slider' ); ?></label><br/>
            <span><em><?php _e( 'Check this box to fill image in a whole div.', 'wp-responsive-recent-post-slider' ); ?></em></span>
        </p>

        <!-- Slider Arrows -->
        <p>
            <label for="<?php echo $this->get_field_id( 'arrows' ); ?>"><?php _e( 'Arrows', 'wp-responsive-recent-post-slider' ); ?>:</label>
            <select name="<?php echo $this->get_field_name( 'arrows' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'arrows' ); ?>">
                <option value="true" <?php selected( $instance['arrows'], 'true' ); ?>><?php _e( 'True', 'wp-responsive-recent-post-slider' ); ?></option>
                <option value="false" <?php selected( $instance['arrows'], 'false' ); ?>><?php _e( 'False', 'wp-responsive-recent-post-slider' ); ?></option>
            </select>
        </p>

        <!-- Slider Auto play -->
        <p>
            <label for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e( 'Auto Play', 'wp-responsive-recent-post-slider' ); ?>:</label>
            <select name="<?php echo $this->get_field_name( 'autoplay' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplay' ); ?>">
                <option value="true" <?php selected( $instance['autoplay'], 'true' ); ?>><?php _e( 'True', 'wp-responsive-recent-post-slider' ); ?></option>
                <option value="false" <?php selected( $instance['autoplay'], 'false' ); ?>><?php _e( 'False', 'wp-responsive-recent-post-slider' ); ?></option>
            </select>
        </p>

        <!-- Slider  AutoplayInterval -->
        <p>
            <label for="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>"><?php _e( 'Autoplay Interval', 'wp-responsive-recent-post-slider' ); ?>:</label>
            <input type="text" name="<?php echo $this->get_field_name( 'autoplayInterval' ); ?>"  value="<?php echo $instance['autoplayInterval']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>" />
        </p>

        <!-- Slider Speed -->
        <p>
            <label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed', 'wp-responsive-recent-post-slider' ); ?>:</label>
            <input type="text" name="<?php echo $this->get_field_name( 'speed' ); ?>"  value="<?php echo $instance['speed']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>" />
        </p>
<?php
    }

    /**
    * Outputs the content for the current widget instance.
    *
    * @package WP Responsive Recent Post Slider Pro
    * @since 1.0.0
    */
    function widget($post_args, $instance) {

        $instance = wp_parse_args( (array) $instance, $this->defaults );
        extract($post_args, EXTR_SKIP);

        $support_post_types     = wprpsp_get_option('post_types', array());

        $title              = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : __( 'Latest Post Slider Widget', 'wp-responsive-recent-post-slider' ), $instance, $this->id_base );
        $post_type              = (!empty($instance['post_type']) && in_array($instance['post_type'], $support_post_types)) ? $instance['post_type']    : 'post';
        $taxonomy               = (!empty($instance['post_type']) && in_array($instance['post_type'], $support_post_types)) ? $instance['taxonomy']     : 'category';
        $num_items          = $instance['num_items'];
        $date               = $instance['date'];
        $show_category      = $instance['show_category'];
        $category           = (!empty($instance['post_type']) && in_array($instance['post_type'], $support_post_types)) ? $instance['category'] : array();
        $order              = $instance['order'];
        $orderby            = $instance['orderby'];        
        $arrows             = $instance['arrows'];
        $autoplay           = $instance['autoplay'];
        $autoplay_interval  = $instance['autoplayInterval'];
        $speed              = $instance['speed'];
        $image_size         = $instance['image_size'];
        $image_fit          = $instance['image_fit'];
        $sticky_posts       = !empty($instance['sticky_posts']) ? 0 : 1;
        $posts              = !empty($instance['posts']) ? explode(',', trim($instance['posts'])) : array();
        $exclude_posts      = !empty($instance['exclude_posts']) ? explode(',', trim($instance['exclude_posts'])) : array();
        $old_browser        = wprpsp_old_browser();

        $widget_wrp_cls         = 'wprpsp-post-widget wprpsp-post-slider-widget wprpsp-recent-post-slider wprpsp-design-w1';
        $widget_wrp_cls         .= ($image_fit)     ? ' wprpsp-image-fit'   : '';
        $widget_wrp_cls         .= ($old_browser)   ? ' wprpsp-old-browser' : '';

        // Slider configuration
        $slider_conf = compact( 'speed', 'autoplay_interval', 'autoplay', 'arrows' );

        // Taking some globals
        global $post;

        // Taking some variables
        $unique = wprpsp_get_unique();

        // Enqueus required script
        wp_enqueue_script( 'wpos-slick-jquery' );
        wp_enqueue_script( 'wprpsp-public-script' );

        // WP Query Parameter
        $post_args = array(
                        'posts_per_page'        => $num_items,
                        'post_type'             => $post_type,
                        'post_status'           => array( 'publish' ),
                        'order'                 => $order,
                        'orderby'               => $orderby,
                        'post__in'              => $posts,
                        'post__not_in'          => $exclude_posts,                        
                        'ignore_sticky_posts'   => $sticky_posts,
                    );

        if( !empty($category) ) {
            $post_args['tax_query'] = array(
                                        array(
                                                'taxonomy'          => $taxonomy,
                                                'field'             => 'term_id',
                                                'terms'             => $category,
                                    ));
        }

        // WP Query
        $cust_loop = new WP_Query($post_args);

        // Start Widget Output
        echo $before_widget;
        
        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        // If post is there
        if ($cust_loop->have_posts()) :
    ?>

        <div class="wprpsp-post-widget-wrp wprpsp-clearfix">
            <div id="wprpsp-recent-post-slider-<?php echo $unique; ?>" class="<?php echo $widget_wrp_cls; ?>">

            <?php
                while ($cust_loop->have_posts()) : $cust_loop->the_post();
                    
                    $feat_image     = wprpsp_get_post_featured_image( $post->ID, $image_size, true );
                    $post_link      = wprpsp_get_post_link( $post->ID );
                    $cat_list       = wprpsp_get_category_list($post->ID, $taxonomy);
            ?>

            <div class="post-slides wprpsp-post-slides">  
                <div class="wprpsp-post-grid-cnt">
                    <div class="wprpsp-post-overlay">
                        <div class="wprpsp-post-image-wrap wprpsp-post-img-bg">
                            <?php if( !empty($feat_image) ) { ?>
                                <img src="<?php echo $feat_image; ?>" alt="<?php _e( 'Post Image', 'wp-responsive-recent-post-slider') ?>" class="wprpsp-post-img" />
                            <?php } ?>
                        </div>

                        <div class="wprpsp-post-short-cnt">
                            <a class="wprpsp-post-link" href="<?php echo $post_link; ?>"></a>
                            
                            <?php if($show_category && $cat_list) { ?>
                                <div class="wprpsp-post-cats-wrap"><?php echo $cat_list; ?></div>
                            <?php } ?>

                            <h2 class="wprpsp-post-title">
                                <a href="<?php echo $post_link; ?>"><?php the_title(); ?></a>
                            </h2>

                            <?php if( $date ) { ?>
                                <div class="wprpsp-post-date">
                                    <?php echo get_the_date(); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php endwhile; ?>

            </div>
            <div class="wprpsp-slider-conf" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
        </div>

    <?php
        endif; // end have_posts()

        wp_reset_query(); // Reset WP Query

        echo $after_widget;
    }
}