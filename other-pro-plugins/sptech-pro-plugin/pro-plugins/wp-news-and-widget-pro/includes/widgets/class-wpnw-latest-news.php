<?php
/**
 * Widget API: Latest News Widget Class
 *
 * @package WP News and Five Widgets Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wpnw_pro_latest_news_widgets() {
    register_widget( 'Wpnw_Pro_Lnw_Widget' );
}

// Action to register widget
add_action( 'widgets_init', 'wpnw_pro_latest_news_widgets' );

class Wpnw_Pro_Lnw_Widget extends WP_Widget {

    /**
     * Sets up a new widget instance.
     *
     * @package WP News and Five Widgets Pro
     * @since 1.0.0
     */
    function __construct() {
		
        $widget_ops = array('classname' => 'wpnw-pro-lnw', 'description' => __('Display Latest News Items from the News  in a sidebar.', 'sp-news-and-widget'));
        parent::__construct( 'pro_sp_news_widget', __('Latest News Widget', 'sp-news-and-widget'), $widget_ops );
    }

    /**
     * Handles updating settings for the current widget instance.
     *
     * @package WP News and Five Widgets Pro
     * @since 1.0.0
     */
    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['title']          = sanitize_text_field($new_instance['title']);
        $instance['num_items']      = $new_instance['num_items'];
        $instance['date']           = !empty($new_instance['date']) ? 1 : 0;
        $instance['show_category']  = !empty($new_instance['show_category']) ? 1 : 0;
        $instance['category']       = intval( $new_instance['category'] );
        $instance['link_target']    = !empty($new_instance['link_target']) ? 1 : 0;
        $instance['query_offset']   = !empty($new_instance['query_offset']) ? $new_instance['query_offset'] : '';
        
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
            'link_target'       => 0,
            'query_offset'      => '',
        );
		
        $instance = wp_parse_args( (array) $instance, $defaults );
    ?>

    <!-- Title -->
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'sp-news-and-widget' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
    </p>

    <!-- Number of Items -->
    <p>
        <label for="<?php echo $this->get_field_id('num_items'); ?>"><?php esc_html_e( 'Number of Items:', 'sp-news-and-widget' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="number" value="<?php echo $instance['num_items']; ?>" min="-1" />
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

    <!-- Query Offset -->
    <p>
        <label for="<?php echo $this->get_field_id('query_offset'); ?>"><?php esc_html_e( 'Query Offset:', 'sp-news-and-widget' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('query_offset'); ?>" name="<?php echo $this->get_field_name('query_offset'); ?>" type="number" value="<?php echo $instance['query_offset']; ?>" min="0" />
        <span class="description"><em><?php _e('Query `offset` parameter to exclude number of post. Leave empty for default.', 'sp-news-and-widget'); ?></em></span><br/>
        <span class="description"><em><?php _e('Note: This parameter will not work when Number of Items is set to -1.', 'sp-news-and-widget'); ?></em></span>
    </p>

    <!-- Display Date -->
    <p>
        <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox" value="1" <?php checked($instance['date'], 1); ?> />
        <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'sp-news-and-widget' ); ?></label>
    </p>

    <!-- Display Category -->
    <p>
        <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox" value="1" <?php checked($instance['show_category'], 1); ?> />
        <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'sp-news-and-widget' ); ?></label>
    </p>

    <!-- Link Target -->
    <p>
        <input id="<?php echo $this->get_field_id( 'link_target' ); ?>" name="<?php echo $this->get_field_name( 'link_target' ); ?>" type="checkbox"<?php checked( $instance['link_target'], 1 ); ?> />
        <label for="<?php echo $this->get_field_id( 'link_target' ); ?>"><?php _e( 'Open Link in a New Tab', 'sp-news-and-widget' ); ?></label>
    </p>

<?php
    }

    /**
     * Outputs the settings form for the widget.
     *
     * @package WP News and Five Widgets Pro
     * @since 1.0.0
     */
    function widget($news_args, $instance) {

        extract($news_args, EXTR_SKIP);

        $title          = apply_filters( 'widget_title', isset($instance['title']) ? $instance['title'] : __( 'Latest News', 'sp-news-and-widget' ), $instance, $this->id_base );
        $num_items      = $instance['num_items'];
        $date           = ( isset($instance['date']) && ($instance['date'] == 1) ) ? "true" : "false";
        $show_category  = ( isset($instance['show_category']) && ($instance['show_category'] == 1) ) ? "true" : "false";
        $category       = $instance['category'];
        $query_offset   = isset($instance['query_offset'])  ? $instance['query_offset'] : '';
        $link_target    = (isset($instance['link_target']) && $instance['link_target'] == 1) ? '_blank' : '_self';

        // Taking some globals
        global $post;

        // WP Query Parameter
        $news_args = array(
                            'post_type'             => WPNW_PRO_POST_TYPE,
                            'post_status'           => array( 'publish' ),
                            'posts_per_page'        => $num_items,
                            'order'                 => 'DESC',
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
        if ($cust_loop->have_posts()) {
    ?>
        <div class="recent-news-items">
            <ul>

            <?php while ($cust_loop->have_posts()) : $cust_loop->the_post();

                    $post_link      = wpnw_pro_get_post_link( $post->ID );
                    $terms          = get_the_terms( $post->ID, WPNW_PRO_CAT );
                    $news_links     = array();

                    if($terms) {
                        foreach ( $terms as $term ) {
                            $term_link      = get_term_link( $term );
                            $news_links[]   = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                        }
                    }
                    $cate_name = join( " ", $news_links );
            ?>
                <li class="news_li">
					<?php if($show_category == 'true' && $cate_name !='') { ?>
                        <div class="news-categories">
                            <?php echo $cate_name; ?>
                        </div>
					<?php } ?>

                    <div class="news-title">
                        <a class="post-title" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                    </div>

					<?php if($date == "true") { ?>
						<div class="news-date"><?php echo get_the_date(); ?></div>
					<?php } ?>
                </li><!-- end .news_li -->

            <?php endwhile; ?>

            </ul>
        </div><!-- end .recent-news-items -->

    <?php } // End of have_post()

        wp_reset_query(); // Reset WP Query

        echo $after_widget;
    }
}