<?php
/**
 * Widget API: Latest News Slider Widget Class
 *
 * @package WP News and Five Widgets Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wpnw_pro_latest_news_scrolling_widget() {
    register_widget( 'Wpnw_Pro_Lnscw_Widget' );
}

// Action to register widget
add_action( 'widgets_init', 'wpnw_pro_latest_news_scrolling_widget' );

class Wpnw_Pro_Lnscw_Widget extends WP_Widget {
	
    /**
     * Sets up a new widget instance.
     *
     * @package WP News and Five Widgets Pro
     * @since 1.0.0
     */
    function __construct() {
		
        $widget_ops = array('classname' => 'wpnw-pro-lnscw', 'description' => __('Display Latest News Items from the News in a sidebar.', 'sp-news-and-widget'));
        parent::__construct('wpnw-pro-lnscw', __('Latest News Scrolling Widget', 'sp-news-and-widget'), $widget_ops);
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
     * @package WP Blog and Widgets Pro
     * @since 1.0.0
     */
    function form($instance) {
        $defaults = array(
            'num_items'         => 5,
            'title'             => __( 'Latest News', 'sp-news-and-widget' ),
            'date'              => 1, 
            'show_category'     => 1,
            'show_thumb'     	=> 1,
            'category'         	=> 0,
            'height'          	=> 400,      
            'pause'  			=> 2000,                
            'speed'             => 500,
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

        <!-- Display Category -->
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'news' ); ?></label>
            <?php
                $dropdown_args = array(
                                        'taxonomy'          => WPNW_PRO_CAT,
                                        'class'             => 'widefat',
                                        'show_option_all'   => __( 'All', 'sp-news-and-widget' ),
                                        'id'                => $this->get_field_id( 'category' ),
                                        'name'              => $this->get_field_name( 'category' ),
                                        'selected'          => $instance['category'],
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

        <!-- Display Date -->
        <p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox" value="1" <?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'sp-news-and-widget' ); ?></label>
        </p>

        <!-- Display Category -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'sp-news-and-widget' ); ?></label>
        </p>

        <!-- Show Thumb -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_thumb' ); ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_thumb'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_thumb' ); ?>"><?php _e( 'Display Thumbnail in left side', 'sp-news-and-widget' ); ?></label>
        </p>

        <!-- Open Link in a New Tab -->
        <p>
            <input id="<?php echo $this->get_field_id( 'link_target' ); ?>" name="<?php echo $this->get_field_name( 'link_target' ); ?>" type="checkbox"<?php checked( $instance['link_target'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'link_target' ); ?>"><?php _e( 'Open Link in a New Tab', 'sp-news-and-widget' ); ?></label>
        </p>

        <!-- Height -->
		<p>
            <label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height:', 'sp-news-and-widget' ); ?></label>
            <input type="number" name="<?php echo $this->get_field_name( 'height' ); ?>"  value="<?php echo $instance['height']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" min="1" step="100" />
        </p>

        <!-- Pause -->
		<p>
            <label for="<?php echo $this->get_field_id( 'pause' ); ?>"><?php _e( 'Pause:', 'sp-news-and-widget' ); ?></label>
            <input type="number" name="<?php echo $this->get_field_name( 'pause' ); ?>"  value="<?php echo $instance['pause']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'pause' ); ?>" min="1" step="500" />
        </p>

        <!-- Speed -->
		<p>
            <label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed:', 'sp-news-and-widget' ); ?></label>
            <input type="number" name="<?php echo $this->get_field_name( 'speed' ); ?>"  value="<?php echo $instance['speed']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>" min="1" step="100" />
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

        $title          = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : __( 'Latest News', 'sp-news-and-widget' ), $instance, $this->id_base );
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
        $unique         = wpnw_pro_get_unique();

        // Slider configuration
        $slider_conf = compact( 'speed', 'height', 'pause' );
        
        // Enqueue required script
        wp_enqueue_script( 'wpos-vticker-jquery' );
        wp_enqueue_script( 'wpnw-pro-public-script' );

        // Taking some global
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
        if ( $cust_loop->have_posts() ) {
    ?>      
        
        <div class="wpnw-pro-news-widget-wrp recent-news-items">
            <div class="wpnw-pro-newsticker newsticker-jcarousellite" id="wpnw-pro-newsticker-<?php echo $unique; ?>">
                <ul>

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

                    <li class="news_li">

					<?php if($show_thumb == 'true') { ?>
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
							<?php if($show_category == 'true' && $cate_name != '') { ?>
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
					 
				    <?php } else {
					 
					if($show_category == 'true' && $cate_name !='') { ?>
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
                    <?php } ?>

					</li>

                <?php endwhile; ?>

                </ul>
	            </div>
                <div class="wpnw-pro-slider-conf"><?php echo htmlspecialchars(json_encode($slider_conf)); ?></div>
            </div><!-- end .recent-news-items -->
            
<?php
        } // End of have_post()
        
        wp_reset_query(); // Reset WP Query

        echo $after_widget;
    }
}