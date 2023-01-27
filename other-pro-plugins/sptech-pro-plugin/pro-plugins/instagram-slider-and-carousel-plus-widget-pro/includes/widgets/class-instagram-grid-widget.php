<?php
/**
 * Widget API: Instagram Grid Widget Class
 *
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function iscwp_pro_insta_grid_widgets() {
    register_widget( 'Iscwp_Pro_Insta_Grid_Widget' );
}

// Action to register widget
add_action( 'widgets_init', 'iscwp_pro_insta_grid_widgets' );

class Iscwp_Pro_Insta_Grid_Widget extends WP_Widget {

    /**
     * Sets up a new widget instance.
     *
     * @package Instagram Slider and Carousel Plus Widget Pro
     * @since 1.0.0
     */
    function __construct() {
        $widget_ops = array('classname' => 'iscwp-insta-widget iscwp-clearfix', 'description' => __('Display Instagram pictures in grid view.', 'instagram-slider-and-carousel-plus-widget') );
        parent::__construct( 'iscwp_pro_insta_grid', __('WPOS - Instagram Grid', 'instagram-slider-and-carousel-plus-widget'), $widget_ops );

        $this->defaults = array(
            'title'                         => '',
            'username'                      => '',
            'grid'                          => '1',
            'popup_user_avatar'             => 1,
            'popup_gallery'                 => 1,
            'popup_insta_link'              => 1,
            'instagram_link_text'           => __('View On Instagram','instagram-slider-and-carousel-plus-widget'),
            'design'                        => 'design-1',
            'limit'                         => '10',
            'offset'                        => '',
            'link_target'                   => 'self',
            'gallery_height'                => '',
            'show_caption'                  => 1,
            'popup'                         => 1,
            'show_likes_count'              => 1,
            'show_comments_count'           => 1,
            'show_comments'                 => 1,
            'image_fit'                     => 0,
        );
    }

    /**
     * Handles updating settings for the current widget instance.
     *
     * @package Instagram Slider and Carousel Plus Widget Pro
     * @since 1.0.0
     */
    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['title']                          = sanitize_text_field($new_instance['title']);
        $instance['username']                       = !empty($new_instance['username']) ? trim($new_instance['username']) : '';
        $instance['grid']                           = (!empty($new_instance['grid']) && $new_instance['grid'] <= 12) ? $new_instance['grid'] : '1';
        $instance['popup_user_avatar']              = isset($new_instance['popup_user_avatar']) ? 1 : 0;
        $instance['image_fit']                      = isset($new_instance['image_fit'])         ? 1 : 0;
        $instance['popup_gallery']                  = isset($new_instance['popup_gallery'])     ? 1 : 0;
        $instance['popup_insta_link']               = isset($new_instance['popup_insta_link'])  ? 1 : 0;
        $instance['instagram_link_text']            = !empty($new_instance['instagram_link_text']) ? $new_instance['instagram_link_text'] : __('View On Instagram','instagram-slider-and-carousel-plus-widget');
        $instance['design']                         = !empty($new_instance['design']) ? $new_instance['design'] : 'design-1';
        $instance['limit']                          = (is_numeric($new_instance['limit']) && $new_instance['limit'] >= 0)   ? $new_instance['limit'] : 10;
        $instance['offset']                         = (is_numeric($new_instance['offset']) && $new_instance['offset'] >= 0) ? $new_instance['offset'] : '';
        $instance['link_target']                    = ($new_instance['link_target'] == 'self') ? 'self' : 'blank';
        $instance['gallery_height']                 = ($new_instance['gallery_height'] > 0) ? $new_instance['gallery_height'] : '';
        $instance['show_caption']                   = $new_instance['show_caption'];
        $instance['popup']                          = $new_instance['popup'];
        $instance['show_likes_count']               = $new_instance['show_likes_count'];
        $instance['show_comments_count']            = $new_instance['show_comments_count'];
        $instance['show_comments']                  = $new_instance['show_comments'];

        return $instance;
    }

    /**
     * Outputs the settings form for the widget.
     *
     * @package Instagram Slider and Carousel Plus Widget Pro
     * @since 1.0.0
     */
    function form($instance) {

        $instance   = wp_parse_args( (array) $instance, $this->defaults );
        $designs    = iscwp_pro_designs();
?>

        <!-- Title -->
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'instagram-slider-and-carousel-plus-widget' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo iscwp_pro_esc_attr($instance['title']); ?>" />
        </p>

        <!-- Username -->
        <p>
            <label for="<?php echo $this->get_field_id('username'); ?>"><?php _e( 'Username', 'instagram-slider-and-carousel-plus-widget' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo iscwp_pro_esc_attr($instance['username']); ?>" />
            <span><em><?php _e( 'Enter instagram username. e.g instagram', 'instagram-slider-and-carousel-plus-widget' ); ?></em></span>
        </p>

        <!-- Select design -->
        <p>
            <label for="<?php echo $this->get_field_id( 'design' ); ?>"><?php _e( 'Design', 'instagram-slider-and-carousel-plus-widget' ); ?>:</label>
            <select name="<?php echo $this->get_field_name( 'design' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'design' ); ?>">
                    <?php if( !empty($designs) ) {
                    foreach ($designs as $key => $design) {  ?>
                        <option value="<?php echo $key; ?>" <?php selected( $instance['design'], $key ); ?>><?php echo $design ?></option>
                    <?php } 
                    } ?>
            </select>
        </p>

        <!-- Number of Grid -->
        <p>
            <label for="<?php echo $this->get_field_id('grid'); ?>"><?php _e( 'Grid', 'instagram-slider-and-carousel-plus-widget' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('grid'); ?>" name="<?php echo $this->get_field_name('grid'); ?>" type="number" value="<?php echo $instance['grid']; ?>" min="1" max="12" />
        </p>

        <!-- Number of Items -->
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e( 'Number of Photos', 'instagram-slider-and-carousel-plus-widget' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" min="1" />
        </p>

        <!-- Design of Offset -->
        <p>
            <label for="<?php echo $this->get_field_id('offset'); ?>"><?php _e( 'Design Offset', 'instagram-slider-and-carousel-plus-widget' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('offset'); ?>" name="<?php echo $this->get_field_name('offset'); ?>" type="number" value="<?php echo $instance['offset']; ?>" min="0" />
            <span><em><?php _e( 'Enter offset value. The space around the image.', 'instagram-slider-and-carousel-plus-widget' ); ?></em></span>
        </p>

        <!-- Number of gallery height -->
        <p>
            <label for="<?php echo $this->get_field_id('gallery_height'); ?>"><?php _e( 'Gallery Height', 'instagram-slider-and-carousel-plus-widget' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('gallery_height'); ?>" name="<?php echo $this->get_field_name('gallery_height'); ?>" type="number" value="<?php echo $instance['gallery_height']; ?>" min="1" step="50" />
        </p>

        <!-- Select instagram link text -->
        <p>
            <label for="<?php echo $this->get_field_id('instagram_link_text'); ?>"><?php _e( 'Instagram Redirect Link Text', 'instagram-slider-and-carousel-plus-widget' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('instagram_link_text'); ?>" name="<?php echo $this->get_field_name('instagram_link_text'); ?>" type="text" value="<?php echo iscwp_pro_esc_attr($instance['instagram_link_text']); ?>" />
        </p>

        <!-- Select link target -->
        <p>
            <label for="<?php echo $this->get_field_id( 'link_target' ); ?>"><?php _e( 'Link Behaviour', 'instagram-slider-and-carousel-plus-widget' ); ?>:</label>
            <select name="<?php echo $this->get_field_name( 'link_target' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'link_target' ); ?>">
                <option value="self" <?php selected( $instance['link_target'], 'self' ); ?>><?php _e( 'Open link in a same tab', 'instagram-slider-and-carousel-plus-widget' ); ?></option>
                <option value="blank" <?php selected( $instance['link_target'], 'blank' ); ?>><?php _e( 'Open link in a new tab', 'instagram-slider-and-carousel-plus-widget' ); ?></option>
            </select>
        </p>

        <!-- Select popup -->
        <p>
            <input id="<?php echo $this->get_field_id( 'popup' ); ?>" name="<?php echo $this->get_field_name( 'popup' ); ?>" type="checkbox" value="1" <?php checked( $instance['popup'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'popup' ); ?>"><?php _e( 'Popup', 'instagram-slider-and-carousel-plus-widget' ); ?></label><br/>
            <span><em><?php _e( 'Check this box to enable popup.', 'instagram-slider-and-carousel-plus-widget' ); ?></em></span>
        </p>

        <!-- Select popup gallery -->
        <p>
            <input id="<?php echo $this->get_field_id( 'popup_gallery' ); ?>" name="<?php echo $this->get_field_name( 'popup_gallery' ); ?>" type="checkbox" value="1" <?php checked( $instance['popup_gallery'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'popup_gallery' ); ?>"><?php _e( 'Popup Gallery', 'instagram-slider-and-carousel-plus-widget' ); ?></label><br/>
            <span><em><?php _e( 'Check this box to enable Prev/Next gallery mode for popup.', 'instagram-slider-and-carousel-plus-widget' ); ?></em></span>
        </p>

        <!-- Select show user avatar -->
        <p>
            <input id="<?php echo $this->get_field_id( 'popup_user_avatar' ); ?>" name="<?php echo $this->get_field_name( 'popup_user_avatar' ); ?>" type="checkbox" value="1" <?php checked( $instance['popup_user_avatar'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'popup_user_avatar' ); ?>"><?php _e( 'Display User Avatar in Popup', 'instagram-slider-and-carousel-plus-widget' ); ?></label>
        </p>

        <!-- Select show instagram link -->
        <p>
            <input id="<?php echo $this->get_field_id( 'popup_insta_link' ); ?>" name="<?php echo $this->get_field_name( 'popup_insta_link' ); ?>" type="checkbox" value="1" <?php checked( $instance['popup_insta_link'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'popup_insta_link' ); ?>"><?php _e( 'Display Instagram Link in Popup', 'instagram-slider-and-carousel-plus-widget' ); ?></label>
        </p>

        <!-- Select show caption -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_caption' ); ?>" name="<?php echo $this->get_field_name( 'show_caption' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_caption'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_caption' ); ?>"><?php _e( 'Show Image Caption', 'instagram-slider-and-carousel-plus-widget' ); ?></label>
        </p>

        <!-- Select show likes count -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_likes_count' ); ?>" name="<?php echo $this->get_field_name( 'show_likes_count' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_likes_count'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_likes_count' ); ?>"><?php _e( 'Show Likes Count', 'instagram-slider-and-carousel-plus-widget' ); ?></label>
        </p>

        <!-- Select show comments count -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_comments_count' ); ?>" name="<?php echo $this->get_field_name( 'show_comments_count' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_comments_count'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_comments_count' ); ?>"><?php _e( 'Show Comments Count', 'instagram-slider-and-carousel-plus-widget' ); ?></label>
        </p>

        <!-- Select show comment -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_comments' ); ?>" name="<?php echo $this->get_field_name( 'show_comments' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_comments'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_comments' ); ?>"><?php _e( 'Show Comments in Popup', 'instagram-slider-and-carousel-plus-widget' ); ?></label>
        </p>

        <!-- Image Fit -->
        <p>
            <input id="<?php echo $this->get_field_id( 'image_fit' ); ?>" name="<?php echo $this->get_field_name( 'image_fit' ); ?>" type="checkbox" value="1" <?php checked( $instance['image_fit'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'image_fit' ); ?>"><?php _e( 'Image Fit', 'instagram-slider-and-carousel-plus-widget' ); ?></label><br/>
            <span><em><?php _e( 'Check this box to fill image in a whole div.', 'instagram-slider-and-carousel-plus-widget' ); ?></em></span>
        </p>
<?php
    }

    /**
    * Outputs the content for the current widget instance.
    *
    * @package Instagram Slider and Carousel Plus Widget Pro
    * @since 1.0.0
    */
    function widget( $insta_grid_args, $instance ) {

        $instance = wp_parse_args( (array) $instance, $this->defaults );
        extract($insta_grid_args, EXTR_SKIP);

        $title                          = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : __( 'Instagram Grid', 'instagram-slider-and-carousel-plus-widget' ), $instance, $this->id_base );
        $username                       = $instance['username'];
        $grid                           = $instance['grid'];
        $instagram_link_text            = $instance['instagram_link_text'];
        $popup_user_avatar              = $instance['popup_user_avatar'];
        $popup_insta_link               = $instance['popup_insta_link'];
        $popup                          = $instance['popup'];
        $popup_gallery                  = ( isset($instance['popup_gallery']) && ($instance['popup_gallery'] == 1) ) ? "true" : "false";
        $design                         = $instance['design'];
        $limit                          = $instance['limit'];
        $offset_css                     = ($instance['offset'] != '') ? "padding:{$instance['offset']}px;" : '';
        $link_target                    = ($instance['link_target'] == 'self') ? '_self' : '_blank';
        $gallery_height                 = $instance['gallery_height'];
        $show_caption                   = ( isset($instance['show_caption']) && ($instance['show_caption'] == 1) ) ? "true" : "false";
        $show_likes_count               = ( isset($instance['show_likes_count']) && ($instance['show_likes_count'] == 1) ) ? "true" : "false";
        $show_comments_count            = ( isset($instance['show_comments_count']) && ($instance['show_comments_count'] == 1) ) ? "true" : "false";
        $show_comments                  = ($instance['show_comments'] == 1) ? "true" : "false";
        $height_css                     = !empty($gallery_height)           ? "height:{$gallery_height}px;"     : '';
        $image_fit                      = $instance['image_fit'];
        $old_browser                    = iscwp_pro_old_browser();

        // If no username is passed then return
        if( empty($username) ) {
            return;
        }

        // Design file
        $design_file_path   = ISCWP_PRO_DIR . '/templates/' . $design . '.php';
        $design_file        = (file_exists($design_file_path)) ? $design_file_path : '';

        // Popup Configuration
        $popup_conf = compact( 'popup_gallery' );

        // Enqueue required script
        if( $popup ) {
            wp_enqueue_script('wpos-magnific-script');
        }
        if( $popup || ($image_fit && $old_browser) ) {
            wp_enqueue_script('iscwp-pro-public-js');
        }

        // Taking some variables
        $popup_html          = '';
        $loop_count          = 1;
        $count               = 1;
        $unique              = iscwp_pro_get_unique();

        $main_wrpper_cls    = "iscwp-instagram-grid-widget iscwp-gallery-grid iscwp-grid-{$grid} iscwp-{$design} iscwp-clearfix";
        $main_wrpper_cls    .= ($popup)                 ? ' iscwp-popup-gallery'    : '';
        $main_wrpper_cls    .= ($old_browser)           ? ' iscwp-old-browser'      : '';
        $main_wrpper_cls    .= ($image_fit)             ? ' iscwp-image-fit'        : '';

        $instagram_link      = '';
        $instagram_link_main = 'https://www.instagram.com/';
        $instagram_data      = iscwp_pro_get_user_media($username,$limit);

        // User details
        $userdata = array(
                'username'          =>  (!empty($instagram_data['iscwp_user_data']['username']))            ? $instagram_data['iscwp_user_data']['username']        : '',
                'full_name'         =>  (!empty($instagram_data['iscwp_user_data']['full_name']))           ? $instagram_data['iscwp_user_data']['full_name']       : '',
                'profile_picture'   =>  (!empty($instagram_data['iscwp_user_data']['profile_pic_url']) )    ? $instagram_data['iscwp_user_data']['profile_pic_url'] : '',
            );

        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        if(!empty($instagram_data)) { ?>
            
            <div class="iscwp-main-wrp iscwp-clearfix">
                <div class="<?php echo $main_wrpper_cls; ?>" id="iscwp-gallery-<?php echo $unique; ?>">                
                    <div class="iscwp-outer-wrap">

                        <?php foreach ($instagram_data['items'] as $iscwp_key => $iscwp_data) {

                            $iscwp_data         = iscwp_pro_image_data($iscwp_data);
                            $comment_data       = $iscwp_data['comment_data'];
                            $gallery_img_src    = $iscwp_data['img_src'];
                            $data_type          = $iscwp_data['data_type'];
                            $iscwp_likes        = $iscwp_data['iscwp_likes'];
                            $iscwp_comments     = $iscwp_data['iscwp_comments'];
                            $instagram_link     = $iscwp_data['instagram_link'];
                            $img_caption        = $iscwp_data['img_caption'];
                            $location           = $iscwp_data['location_name'];
                            $iscwp_link_value   = ($popup) ? 'javascript:void(0);' : $instagram_link;

                            $wrpper_cls         = "iscwp-cnt-wrp iscwp-col-{$grid} iscwp-columns";
                            $wrpper_cls         .= ($loop_count == 1) ? " iscwp-first" : '';

                            if( $design_file ) {
                                include( $design_file );
                            }

                            // Creating Popup HTML
                            if( $popup ) {
                                ob_start();
                                include( ISCWP_PRO_DIR . '/templates/popup/design-1.php' );
                                $popup_html .= ob_get_clean();
                            }
                            
                            if($limit == $count) {
                                break;
                            }

                            $count++;
                            $loop_count++; // Increment loop count for grid
                            
                            // Reset loop count
                            if( $loop_count == $grid ) {
                                $loop_count = 0;
                            }
                        } ?>
                    </div><?php
                    
                    if( $popup ) { ?>
                        <div class="wp-iscwp-popup-conf" data-conf="<?php echo htmlspecialchars(json_encode($popup_conf)); ?>"></div>
                    <?php } ?>
                </div>
            </div>
<?php
        }
        echo $popup_html; // Printing popup html

        echo $after_widget;
    }
}