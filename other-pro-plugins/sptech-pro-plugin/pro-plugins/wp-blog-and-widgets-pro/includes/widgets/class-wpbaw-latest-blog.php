<?php
/**
 * Widget API: Latest Blog Widget Class
 *
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wpbaw_pro_latest_blog_widgets() {
    register_widget( 'Wpbaw_Pro_Lbw_Widget' );
}

// Action to register widget
add_action( 'widgets_init', 'wpbaw_pro_latest_blog_widgets' );

class Wpbaw_Pro_Lbw_Widget extends WP_Widget {

    /**
     * Sets up a new widget instance.
     *
     * @package WP Blog and Widgets Pro
     * @since 1.0.0
     */
    function __construct() {
        $widget_ops = array('classname' => 'wpbaw-pro-lbw', 'description' => __('Display Latest Blog Items from the Blog in a sidebar.', 'wp-blog-and-widgets') );
        parent::__construct( 'wpbaw_pro_lbw', __('Latest Blog Widget', 'wp-blog-and-widgets'), $widget_ops );
    }

    /**
     * Handles updating settings for the current widget instance.
     *
     * @package WP Blog and Widgets Pro
     * @since 1.0.0
     */
    function update($new_instance, $old_instance) {
        
        $instance = $old_instance;

        $instance['title']          = sanitize_text_field($new_instance['title']);
        $instance['num_items']      = !empty($new_instance['num_items']) ? $new_instance['num_items'] : 5;
        $instance['date']           = !empty($new_instance['date']) ? 1 : 0;
        $instance['show_category']  = !empty($new_instance['show_category']) ? 1 : 0;
        $instance['category']       = intval( $new_instance['category'] );
        
        return $instance;
    }

    /**
     * Outputs the settings form for the widget.
     *
     * @package WP Blog and Widgets Pro
     * @since 1.0.0
     */
    function form($instance) {

        $defaults = array(
            'num_items'         => 5,
            'title'             => '',
            "date"              => 1, 
            'show_category'     => 1,
            'category'          => 0,
        );

        $instance   = wp_parse_args( (array) $instance, $defaults );
    ?>

        <!-- Title -->
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'wp-blog-and-widgets' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>
        
        <!-- Number of Items -->
        <p>
            <label for="<?php echo $this->get_field_id('num_items'); ?>"><?php _e( 'Number of Items:', 'wp-blog-and-widgets' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="number" value="<?php echo $instance['num_items']; ?>" min="-1" />
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

    <?php
    }

    /**
     * Outputs the settings form for the widget.
     *
     * @package WP Blog and Widgets Pro
     * @since 1.0.0
     */
    function widget( $news_args, $instance ) {

        extract($news_args, EXTR_SKIP);

        $current_post_name = get_query_var('name');
        
        $title          = apply_filters( 'widget_title', isset($instance['title']) ? $instance['title'] : __( 'Latest Blog Widget', 'wp-blog-and-widgets' ), $instance, $this->id_base );
        $num_items      = $instance['num_items'];
        $date           = ( isset($instance['date']) && ($instance['date'] == 1) ) ? "true" : "false";
        $show_category  = ( isset($instance['show_category']) && ($instance['show_category'] == 1) ) ? "true" : "false";
        $category       = $instance['category'];

        // Taking some globals
        global $post;

        // Taking some variables
        $postcount  = 0;
        $count      = 0;

        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }
    ?>

        <div class="wpbaw-pro-blog-widget-wrp wpbaw-clearfix">
            <div class="recent-blog-items">
                <ul>
    <?php
            // WP Query Parameter
            $blog_args = array(
                                'suppress_filters'  => true,
                                'posts_per_page'    => $num_items,
                                'post_type'         => 'blog_post',
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
            $cust_loop = new WP_Query($blog_args);
            $post_count = $cust_loop->post_count;
           
            if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post();
                    
                    $postcount++;
                    $count++;
                    $post_link  = wpbaw_pro_get_post_link( $post->ID );
                    $terms      = get_the_terms( $post->ID, 'blog-category' );
                    $blog_links = array();

                    if($terms) {
                        foreach ( $terms as $term ) {
                            $term_link      = get_term_link( $term );
                            $blog_links[]   = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                        }
                    }
                    $cate_name = join( " ", $blog_links );
    ?>

                    <li class="blog_li">
					   <?php if($show_category == 'true' && $cate_name !='') { ?>
					   <div class="blog-categories">
							<?php echo $cate_name; ?>		
						</div>
					   <?php } ?>

                        <div class="blog-title">
                            <a href="<?php echo $post_link; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                        </div>
					
                        <?php if($date == "true") { ?>
						<div class="blog-date"><?php echo get_the_date(); ?></div>
                        <?php } ?>
                    </li>

    <?php
                    endwhile;
                    endif;

                    wp_reset_query(); // Reset WP Query
    ?>
                </ul>
            </div>
        </div>
<?php
        echo $after_widget;
    }
}