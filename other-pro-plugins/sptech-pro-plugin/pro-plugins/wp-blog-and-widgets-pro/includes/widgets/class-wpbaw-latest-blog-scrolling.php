<?php
/**
 * Widget API: Latest Blog Scrolling Widget Class
 *
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wpbaw_pro_latest_blog_scrolling_widget() {
    register_widget( 'Wpbaw_Pro_Lbscw_Widget' );
}

// Action to register widget
add_action( 'widgets_init', 'wpbaw_pro_latest_blog_scrolling_widget' );

class Wpbaw_Pro_Lbscw_Widget extends WP_Widget {

    /**
     * Sets up a new widget instance.
     *
     * @package WP Blog and Widgets Pro
     * @since 1.0.0
     */
    function __construct() {
        
        $widget_ops = array('classname' => 'wpbaw-pro-lbscw', 'description' => __('Display Latest Blog items from the blog with vertical slider.', 'wp-blog-and-widgets') );
        parent::__construct( 'wpbaw-pro-lbscw', __('Latest Blog Scrolling Widget', 'wp-blog-and-widgets'), $widget_ops );
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
        $instance['show_thumb']     = !empty($new_instance['show_thumb']) ? 1 : 0;
        $instance['category']       = intval( $new_instance['category'] );
        $instance['height']         = intval( $new_instance['height'] );
        $instance['pause']          = intval( $new_instance['pause'] );
        $instance['speed']          = intval( $new_instance['speed'] );
        
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
            'show_thumb'     	=> 1,
            'category'         	=> 0,
            'height'          	=> 400,      
            'pause'  			=> 2000,                
            'speed'             => 500,
        );
		 
        $instance = wp_parse_args( (array) $instance, $defaults );
    ?>
    
        <!-- Title -->
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'wp-blog-and-widgets' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>

        <!-- Number of Items: -->
        <p>
            <label for="<?php echo $this->get_field_id('num_items'); ?>"><?php _e( 'Number of Items:', 'wp-blog-and-widgets' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="number" min="-1" value="<?php echo esc_attr($instance['num_items']); ?>" />
        </p>
      
        <!-- Display Date -->
        <p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox" value="1" <?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'wp-blog-and-widgets' ); ?></label>
        </p>

        <!-- Display Category -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'wp-blog-and-widgets' ); ?></label>
        </p>

        <!-- Show Thumb -->
		<p>
            <input id="<?php echo $this->get_field_id( 'show_thumb' ); ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_thumb'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_thumb' ); ?>"><?php _e( '<strong>Check this box to display Thumbnail in left side<br /></strong><em>By default display without Thumbnail </em>', 'wp-blog-and-widgets' ); ?></label>
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

        <!-- Height -->
		<p>
            <label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height:', 'wp-blog-and-widgets' ); ?></label>
            <input type="number" min="1" step="50" name="<?php echo $this->get_field_name( 'height' ); ?>"  value="<?php echo $instance['height']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" />
        </p>

        <!-- Pause -->
		<p>
            <label for="<?php echo $this->get_field_id( 'pause' ); ?>"><?php _e( 'Pause:', 'wp-blog-and-widgets' ); ?></label>
            <input type="number" min="0" step="500" name="<?php echo $this->get_field_name( 'pause' ); ?>"  value="<?php echo $instance['pause']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'pause' ); ?>" />
        </p>

        <!-- Speed -->
		<p>
            <label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed:', 'wp-blog-and-widgets' ); ?></label>
            <input type="number" min="0" step="100" name="<?php echo $this->get_field_name( 'speed' ); ?>"  value="<?php echo $instance['speed']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>" />
        </p>
    <?php
    }

    /**
    * Outputs the content for the current widget instance.
    *
    * @package WP Blog and Widgets Pro
    * @since 1.0.0
    */
    function widget($blog_args, $instance) {

        extract($blog_args, EXTR_SKIP);

        $title      = apply_filters( 'widget_title', isset($instance['title']) ? $instance['title'] : __( 'Latest Blog Slider Widget', 'wp-blog-and-widgets' ), $instance, $this->id_base );
        $num_items  = !empty($instance['num_items']) ? $instance['num_items'] : '5';

        $date                       = ( isset($instance['date']) && (1 == $instance['date']) ) ? "true" : "false";
        $show_category              = ( isset($instance['show_category']) && ($instance['show_category'] == 1) ) ? "true" : "false";
        $category                   = $instance['category'];
        $speed                      = $instance['speed'];
        $show_thumb                 = ( isset($instance['show_thumb']) && ($instance['show_thumb'] == 1) ) ? "true" : "false";
        $height                     = $instance['height'];
        $pause                      = $instance['pause'];
        
        // Slider configuration
        $slider_conf = compact( 'speed', 'height', 'pause' );
        
        // Taking some global
        global $post;

        // Taking some default variables
        $count          = 0;
        $postcount      = 0;
        $unique         = wpbaw_pro_get_unique();
        $default_img    = wpbaw_pro_get_option('default_img');

        // Enqueue required script
        wp_enqueue_script( 'wpos-vticker-jquery' );
        wp_enqueue_script( 'wpbaw-pro-public-script' );

        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

    ?>
            <div class="wpbaw-pro-blog-widget-wrp recent-blog-items">
                <div class="wpabw-pro-blogticker blogticker-jcarousellite" id="wpabw-pro-blogticker-<?php echo $unique; ?>">
                    <ul>

                        <?php
                        // WP Query
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
                                                                'taxonomy'  => 'blog-category',
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
                            $feat_image     = wpbaw_pro_get_post_featured_image( $post->ID, array(80,80) );
                            $feat_image     = ( $feat_image ) ? $feat_image : $default_img;
                            $post_link      = wpbaw_pro_get_post_link( $post->ID );
                            $terms          = get_the_terms( $post->ID, 'blog-category' );
                            $blog_links     = array();

                            if($terms) {
                                foreach ( $terms as $term ) {
                                    $term_link = get_term_link( $term );
                                    $blog_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                                }
                            }
                            $cate_name = join( " ", $blog_links );
                        ?>
                            
                            <li class="blog_li">

            					<?php if($show_thumb == 'true') { ?>					
            					
            					<div class="blog-list-content">
            						<div class="blog-left-img">
                                        <div class="blog-image-bg">
                                            <a  href="<?php echo $post_link; ?>" title="<?php the_title(); ?>">
                                                <?php if( !empty($feat_image) ) { ?>
                                                <img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
                                                <?php } ?>
                                            </a>
            							</div>
            						</div>

            						<div class="blog-right-content">
            							<?php if($show_category == 'true' && $cate_name !='') { ?>
                                            <div class="blog-categories">		
                                            <?php echo $cate_name; ?>		
                                            </div>
            								<?php } ?>

            							 <div class="blog-title">
            									<a href="<?php echo $post_link; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
            							</div>
            							<?php if($date == "true") { ?>
            							<div class="blog-date">		
            								<?php echo get_the_date(); ?>
            								</div>
            						<?php }?>
            								
            						</div>
            					</div>
            					 
            				    <?php } else { ?>
            					 
            					 
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
            	       <?php } ?>

            				</li>

                        <?php
                        endwhile;
                        endif;

                        wp_reset_query();
                    ?>
                </ul>

                </div>
                <div class="wpbaw-pro-slider-conf"><?php echo htmlspecialchars(json_encode($slider_conf)); ?></div>
            </div>

<?php
        echo $after_widget;
    }
}