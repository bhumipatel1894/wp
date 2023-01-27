<?php
/**
 * Widget API: Latest Post List Slider Widget 2 Class
 *
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wprpsp_latest_post_list_slider2_widget() {
    register_widget( 'Wprpsp_Pro_Lplsw2_Widget' );
}

// Action to register widget
add_action( 'widgets_init', 'wprpsp_latest_post_list_slider2_widget' );

class Wprpsp_Pro_Lplsw2_Widget extends WP_Widget {

    var $defaults;

    /**
     * Sets up a new widget instance.
     * 
     * @package WP Responsive Recent Post Slider Pro
     * @since 1.0.0
     */
    function __construct() {
        $widget_ops = array('classname' => 'wprpsp-lplsw2', 'description' => __('Displayed Latest Post Items in a List view OR Slider view', 'wp-responsive-recent-post-slider') );
        parent::__construct( 'wprpsp_lplsw2', __('Latest Post List/Slider 2', 'wp-responsive-recent-post-slider'), $widget_ops );

        $this->defaults = array(
            'post_type'             => 'post',
            'taxonomy'              => 'category',
            'category'              => array(),
            'num_items'             => 5,
            'title'                 => '',
            'date'                  => 1, 
            'show_category'         => 1,
            'show_content'          => 0,            
            'active_slider'         => 0,
            'dots'                  => "true",
            'autoplay'              => "true",      
            'autoplayInterval'      => 5000,                
            'speed'                 => 500,
            'content_words_limit'   => 20,
            'content_tail'          => '...',
            'sticky_posts'          => 0,
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

        $instance['title']                  = sanitize_text_field($new_instance['title']);
        $instance['post_type']              = !empty($new_instance['post_type']) ? $new_instance['post_type'] : 'post';
        $instance['taxonomy']               = $new_instance['taxonomy'];
        $instance['category']               = $new_instance['category'];
        $instance['num_items']              = !empty($new_instance['num_items']) ? $new_instance['num_items'] : 5;
        $instance['date']                   = !empty($new_instance['date'])             ? 1 : 0;
        $instance['show_category']          = !empty($new_instance['show_category'])    ? 1 : 0;
        $instance['show_content']           = !empty($new_instance['show_content'])     ? 1 : 0;
        $instance['active_slider']          = !empty($new_instance['active_slider'])    ? 1 : 0;
        $instance['sticky_posts']           = !empty($new_instance['sticky_posts'])     ? 1 : 0;
        $instance['dots']                   = ($new_instance['dots'] == 'false') ? 'false' : 'true';
        $instance['autoplay']               = ($new_instance['autoplay'] == 'false') ? 'false' : 'true';
        $instance['autoplayInterval']       = intval( $new_instance['autoplayInterval'] );
        $instance['speed']                  = intval( $new_instance['speed'] );
        $instance['content_words_limit']    = !empty($new_instance['content_words_limit']) ? $new_instance['content_words_limit'] : 20;
        $instance['content_tail']           = $new_instance['content_tail'];

        return $instance;
    }

    /**
     * Outputs the settings form for the widget.
     *
     * @package WP Responsive Recent Post Slider Pro
     * @since 1.0.0
     */
    function form($instance) {

        $instance = wp_parse_args( (array) $instance, $this->defaults );
        

        // Getting Categories
        $category   = (array) $instance['category'];
        $post_types         = wprpsp_get_post_types();
        $support_post_types = wprpsp_get_option('post_types',array());
        $sel_post_type      = (!empty($instance['post_type']) && in_array($instance['post_type'], $support_post_types)) ? $instance['post_type']    : 'post';
        $sel_taxonomy       = (!empty($instance['post_type']) && in_array($instance['post_type'], $support_post_types)) ? $instance['taxonomy']     : 'category';
    ?>

        <!-- Title  -->
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
        
        <!-- Number of Items:  -->
        <p>
            <label for="<?php echo $this->get_field_id('num_items'); ?>"><?php _e( 'Number of Items', 'wp-responsive-recent-post-slider' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="number" value="<?php echo $instance['num_items']; ?>" min="-1" />
        </p>

        <!-- Display Date -->
    	<p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox" value="1" <?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'wp-responsive-recent-post-slider' ); ?></label>
        </p>

        <!-- Display Category -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'wp-responsive-recent-post-slider' ); ?></label>
        </p>

        <!-- Display Content -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_content' ); ?>" name="<?php echo $this->get_field_name( 'show_content' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_content'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_content' ); ?>"><?php _e( 'Display Content', 'wp-responsive-recent-post-slider' ); ?></label>
        </p>

        <!-- Display Sticky Post -->
        <p>
            <input id="<?php echo $this->get_field_id( 'sticky_posts' ); ?>" name="<?php echo $this->get_field_name( 'sticky_posts' ); ?>" type="checkbox" value="1" <?php checked( $instance['sticky_posts'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'sticky_posts' ); ?>"><?php _e( 'Display Sticky Posts', 'wp-responsive-recent-post-slider' ); ?></label>
        </p>

         <!-- Content Words Limit -->
        <p>
            <label for="<?php echo $this->get_field_id('content_words_limit'); ?>"><?php _e( 'Content Words Limit', 'wp-responsive-recent-post-slider' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('content_words_limit'); ?>" name="<?php echo $this->get_field_name('content_words_limit'); ?>" type="number" value="<?php echo $instance['content_words_limit']; ?>" min="0" step="5" />
            <span><em><?php _e('Enter number of content words to be displayed.'); ?></em></span>
        </p>

         <!-- Content Tail -->
        <p>
            <label for="<?php echo $this->get_field_id('content_tail'); ?>"><?php _e( 'Content Tail', 'wp-responsive-recent-post-slider' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('content_tail'); ?>" name="<?php echo $this->get_field_name('content_tail'); ?>" type="text" value="<?php echo esc_attr($instance['content_tail']); ?>" />
            <span><em><?php _e('Enter content tail.'); ?></em></span>
        </p>        
    	
        <!-- Active Slider -->
        <h3><?php _e( 'Post Slider Setting', 'wp-responsive-recent-post-slider' ); ?></h3>
        <hr/>
        <p>
            <input id="<?php echo $this->get_field_id( 'active_slider' ); ?>" name="<?php echo $this->get_field_name( 'active_slider' ); ?>" type="checkbox"<?php checked( $instance['active_slider'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'active_slider' ); ?>"><?php _e( 'Activate Slider', 'wp-responsive-recent-post-slider' ); ?></label><br/>
            <span><em><?php _e( 'Check this box to display post in slider View.', 'wp-responsive-recent-post-slider' ); ?></em></span>
        </p>
    		
    	<!-- Slider dots -->
        <p>
            <label for="<?php echo $this->get_field_id( 'dots' ); ?>"><?php _e( 'Dots', 'wp-responsive-recent-post-slider' ); ?>:</label>
            <select name="<?php echo $this->get_field_name( 'dots' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'dots' ); ?>">
                <option value="true" <?php selected( $instance['dots'], 'true' ); ?>><?php _e( 'True', 'wp-responsive-recent-post-slider' ); ?></option>
                <option value="false" <?php selected( $instance['dots'], 'false' ); ?>><?php _e( 'False', 'wp-responsive-recent-post-slider' ); ?></option>
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

        <!-- Slider AutoplayInterval -->
        <p>
            <label for="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>"><?php _e( 'Autoplay Interval', 'wp-responsive-recent-post-slider' ); ?>:</label>
            <input type="number" name="<?php echo $this->get_field_name( 'autoplayInterval' ); ?>"  value="<?php echo $instance['autoplayInterval']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>" min="0" step="500" />
        </p>

        <!-- Slider Speed -->
        <p>
            <label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed', 'wp-responsive-recent-post-slider' ); ?>:</label>
            <input type="number" name="<?php echo $this->get_field_name( 'speed' ); ?>"  value="<?php echo $instance['speed']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>" min="0" step="100" />
        </p>
<?php
    }

    /**
    * Outputs the content for the current widget instance.
    *
    * @package WP Responsive Recent Post Slider Pro
    * @since 1.0.0
    */
    function widget($widget_args, $instance) {

        $instance = wp_parse_args( (array) $instance, $this->defaults );
        extract($widget_args, EXTR_SKIP);

        $support_post_types     = wprpsp_get_option('post_types', array());

        $title                  = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : __( 'Latest Post List/Slider 1', 'wp-responsive-recent-post-slider' ), $instance, $this->id_base );
        $post_type              = (!empty($instance['post_type']) && in_array($instance['post_type'], $support_post_types)) ? $instance['post_type']    : 'post';
        $taxonomy               = (!empty($instance['post_type']) && in_array($instance['post_type'], $support_post_types)) ? $instance['taxonomy']     : 'category';
        $num_items              = $instance['num_items'];
        $date                   = $instance['date'];
        $show_category          = $instance['show_category'];
        $show_content           = $instance['show_content'];
        $category               = (!empty($instance['post_type']) && in_array($instance['post_type'], $support_post_types)) ? $instance['category'] : array();
        $active_slider          = $instance['active_slider'];
        $autoplay               = $instance['autoplay'];
        $autoplay_interval      = $instance['autoplayInterval'];
        $speed                  = $instance['speed'];
        $dots                   = $instance['dots'];
        $content_words_limit    = $instance['content_words_limit'];
        $content_tail           = $instance['content_tail'];
        $sticky_posts           = !empty($instance['sticky_posts']) ? 0 : 1;
        $widget_wrp_cls         = 'wprpsp-post-widget wprpsp-post-static wprpsp-design-w3';

        // Slider configuration
        $slider_conf = compact( 'dots', 'speed', 'autoplay_interval', 'autoplay' );

        // Taking some globals
        global $post;

        // Taking some variables
        $unique = wprpsp_get_unique();

        // Enqueus required script
        if( $active_slider ) {
            $widget_wrp_cls .= ' wprpsp-post-slider-widget'; // Slider class

            // Enqueus required script
            wp_enqueue_script( 'wpos-slick-jquery' );
            wp_enqueue_script( 'wprpsp-public-script' );
        }

        // WP Query Parameter
        $post_args = array(
                            'posts_per_page'          => $num_items,
                            'post_type'               => $post_type,
                            'post_status'             => array( 'publish' ),
                            'order'                   => 'DESC',                            
                            'ignore_sticky_posts'     => $sticky_posts,
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
        $cust_loop  = new WP_Query($post_args);

        // Start Widget Output
        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        // If post is there
        if ($cust_loop->have_posts()) :
    ?>
        <div class="wprpsp-post-widget-wrp wprpsp-clearfix">
            <div id="wprpsp-post-widget-<?php echo $unique; ?>" class="<?php echo $widget_wrp_cls; ?>">

    <?php
            while ($cust_loop->have_posts()) : $cust_loop->the_post();

                $feat_image     = wprpsp_get_post_featured_image( $post->ID, array(80,80), true );
                $post_link      = wprpsp_get_post_link( $post->ID );
                $cat_list       = wprpsp_get_category_list($post->ID, $taxonomy);
    ?>

    	    <div class="wprpsp-post-list-wrap wprpsp-post-slides">
    			<div class="wprpsp-post-list-cnt">

                    <?php if( !empty($feat_image) ) { ?>
                    <div class="wprpsp-post-left-img">
    			        <div class="wprpsp-post-image-wrap wprpsp-post-img-bg">
        				        <a href="<?php echo $post_link; ?>" title="<?php the_title(); ?>">                   		
                                    <img src="<?php echo $feat_image; ?>" alt="<?php _e( 'Post Image', 'wp-responsive-recent-post-slider') ?>" class="wprpsp-post-img" />
                                </a>
    				    </div>
    				</div>
                    <?php } ?>

    				<div class="wprpsp-post-right-cnt">

    				    <?php if($show_category && $cat_list) { ?>
                            <div class="wprpsp-post-cats-wrap"><?php echo $cat_list; ?></div>
                        <?php } ?>

        				<div class="wprpsp-post-title">
        					<a href="<?php echo $post_link; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        				</div>

                        <?php if( $show_content ) { ?>
                        <div class="wprpsp-post-desc">
                            <?php echo wprpsp_get_post_excerpt( $post->ID, get_the_content(), $content_words_limit, $content_tail ); ?>
                        </div>
                        <?php } ?>

        				<?php if( $date ) { ?>
            				<div class="wprpsp-post-date">
            					<?php echo get_the_date(); ?>
            				</div>
        			    <?php } ?>					
    				</div>
    			</div>
    	    </div>
            <?php endwhile; ?>
            </div>

            <?php if( $active_slider ) { ?>
            <div class="wprpsp-slider-conf" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
            <?php } ?>
        </div>

        <?php endif;

        wp_reset_query(); // Reset WP Query

        echo $after_widget;
    }
}