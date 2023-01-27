<?php
/**
 * Widget API: Instagram Slider Widget Class
 *
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function iscwp_pro_insta_slider_widgets() {
    register_widget( 'Iscwp_Pro_Insta_Slider_Widget' );
}

// Action to register widget
add_action( 'widgets_init', 'iscwp_pro_insta_slider_widgets' );

class Iscwp_Pro_Insta_Slider_Widget extends WP_Widget {

    /**
     * Sets up a new widget instance.
     *
     * @package Instagram Slider and Carousel Plus Widget Pro
     * @since 1.0
     */
    function __construct() {
        $widget_ops = array('classname' => 'iscwp-insta-widget iscwp-clearfix', 'description' => __('Display Instagram pictures in slider view.', 'instagram-slider-and-carousel-plus-widget') );
        parent::__construct( 'iscwp_insta_slider', __('WPOS - Instagram Slider', 'instagram-slider-and-carousel-plus-widget'), $widget_ops );

        $this->defaults = array(
            'title'                             => '',
            'username'                          => '',
            'instagram_link_text'               => __('View On Instagram','instagram-slider-and-carousel-plus-widget'),
            'design'                            => 'design-1',
            'limit'                             => '10',
            'offset'                            => '',
            'gallery_height'                    => '',
            'slidestoshow'                      => '1',
            'slidestoscroll'                    => '1',
            'autoplay_interval'                 => '3000',
            'speed'                             => '300',
            'image_fit'                         => 0,
            'link_target'                       => 'self',
            'popup_user_avatar'                 => 1,
            'popup_insta_link'                  => 1,
            'popup_gallery'                     => 1,
            'show_caption'                      => 1,
            'popup'                             => 1,
            'show_likes_count'                  => 1,
            'show_comments_count'               => 1,
            'show_comments'                     => 1,
            'loop'                              => 1,
            'dots'                              => 0,
            'arrows'                            => 1,
            'autoplay'                          => 1,
            'centermode'                        => 0,
        );
    }

    /**
     * Handles updating settings for the current widget instance.
     *
     * @package Instagram Slider and Carousel Plus Widget Pro
     * @since 1.0
     */
    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['title']                          = sanitize_text_field($new_instance['title']);
        $instance['username']                       = !empty($new_instance['username'])             ? trim($new_instance['username'])       : '';
        $instance['instagram_link_text']            = !empty($new_instance['instagram_link_text'])  ? $new_instance['instagram_link_text']  : __('View On Instagram','instagram-slider-and-carousel-plus-widget');
        $instance['design']                         = !empty($new_instance['design'])               ? $new_instance['design']               : 'design-1';
        $instance['limit']                          = (is_numeric($new_instance['limit']) && $new_instance['limit'] >= 0)   ? $new_instance['limit']    : 10;
        $instance['offset']                         = (is_numeric($new_instance['offset']) && $new_instance['offset'] >= 0) ? $new_instance['offset']   : '';        
        $instance['gallery_height']                 = !empty($new_instance['gallery_height'])       ? $new_instance['gallery_height']       : '';
        $instance['slidestoshow']                   = !empty($new_instance['slidestoshow'])         ? $new_instance['slidestoshow']         : '1';
        $instance['slidestoscroll']                 = !empty($new_instance['slidestoscroll'])       ? $new_instance['slidestoscroll']       : '1';
        $instance['autoplay_interval']              = !empty($new_instance['autoplay_interval'])    ? $new_instance['autoplay_interval']    : '3000';
        $instance['speed']                          = !empty($new_instance['speed'])                ? $new_instance['speed']                : '300';
        $instance['link_target']                    = ($new_instance['link_target'] == 'self')      ? 'self' : 'blank';
        $instance['popup_insta_link']               = isset($new_instance['popup_insta_link'])      ? 1 : 0;
        $instance['popup_user_avatar']              = isset($new_instance['popup_user_avatar'])     ? 1 : 0;
        $instance['autoplay']                       = isset($new_instance['autoplay'])              ? 1 : 0;
        $instance['arrows']                         = isset($new_instance['arrows'])                ? 1 : 0;
        $instance['dots']                           = isset($new_instance['dots'])                  ? 1 : 0;
        $instance['loop']                           = isset($new_instance['loop'])                  ? 1 : 0;
        $instance['centermode']                     = isset($new_instance['centermode'])            ? 1 : 0;
        $instance['popup']                          = isset($new_instance['popup'])                 ? 1 : 0;
        $instance['popup_gallery']                  = isset($new_instance['popup_gallery'])         ? 1 : 0;
        $instance['show_caption']                   = isset($new_instance['show_caption'])          ? 1 : 0;
        $instance['show_likes_count']               = isset($new_instance['show_likes_count'])      ? 1 : 0;
        $instance['show_comments_count']            = isset($new_instance['show_comments_count'])   ? 1 : 0;
        $instance['show_comments']                  = isset($new_instance['show_comments'])         ? 1 : 0;
        $instance['image_fit']                      = isset($new_instance['image_fit'])             ? 1 : 0;
        
        return $instance;
    }

    /**
     * Outputs the settings form for the widget.
     *
     * @package Instagram Slider and Carousel Plus Widget Pro
     * @since 1.0
     */
    function form($instance) {

        $instance   = wp_parse_args( (array) $instance, $this->defaults );
        $designs    = iscwp_pro_designs();
    ?>

        <!-- Title -->
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'instagram-slider-and-carousel-plus-widget' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>

        <!-- Username -->
        <p>
            <label for="<?php echo $this->get_field_id('username'); ?>"><?php _e( 'Username', 'instagram-slider-and-carousel-plus-widget' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo esc_attr($instance['username']); ?>" />
            <span><em><?php _e( 'Enter instagram username. e.g instagram', 'instagram-slider-and-carousel-plus-widget' ); ?></em></span>
        </p>

        <!-- Select design -->
        <p>
            <label for="<?php echo $this->get_field_id( 'design' ); ?>"><?php _e( 'Design', 'instagram-slider-and-carousel-plus-widget' ); ?>:</label>
            <select name="<?php echo $this->get_field_name( 'design' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'design' ); ?>">
                    <?php if( !empty($designs) ) {
                    foreach ($designs as $key => $design) {  ?>
                        <option value="<?php echo $key; ?>"  <?php selected( $instance['design'], $key ); ?>><?php echo $design ?></option>
                    <?php } 
                    } ?>
            </select>
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

        <!-- gallery height -->
        <p>
            <label for="<?php echo $this->get_field_id('gallery_height'); ?>"><?php _e( 'Gallery Height', 'instagram-slider-and-carousel-plus-widget' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('gallery_height'); ?>" name="<?php echo $this->get_field_name('gallery_height'); ?>" type="number" value="<?php echo $instance['gallery_height']; ?>" min="1" step="50" />
        </p>

        <!-- Select instagram link text -->
        <p>
            <label for="<?php echo $this->get_field_id('instagram_link_text'); ?>"><?php _e( 'Instagram Redirect Link Text:', 'instagram-slider-and-carousel-plus-widget' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('instagram_link_text'); ?>" name="<?php echo $this->get_field_name('instagram_link_text'); ?>" type="text" value="<?php echo esc_attr($instance['instagram_link_text']); ?>" />
        </p>

        <!-- Select link_target -->
        <p>
            <label for="<?php echo $this->get_field_id( 'link_target' ); ?>"><?php _e( 'Link Behaviour', 'instagram-slider-and-carousel-plus-widget' ); ?>:</label>
            <select name="<?php echo $this->get_field_name( 'link_target' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'link_target' ); ?>">
                <option value="self" <?php selected( $instance['link_target'], 'self' ); ?>><?php _e( 'Open link in a same tab', 'instagram-slider-and-carousel-plus-widget' ); ?></option>
                <option value="blank" <?php selected( $instance['link_target'], 'blank' ); ?>><?php _e( 'Open link in a new tab', 'instagram-slider-and-carousel-plus-widget' ); ?></option>
            </select>
        </p>

        <!-- Number of slidestoshow -->
        <p>
            <label for="<?php echo $this->get_field_id('slidestoshow'); ?>"><?php _e( 'Number of Slides', 'instagram-slider-and-carousel-plus-widget' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('slidestoshow'); ?>" name="<?php echo $this->get_field_name('slidestoshow'); ?>" type="number" value="<?php echo $instance['slidestoshow']; ?>" min="1" />
        </p>

        <!-- Number of slidestoscroll -->
        <p>
            <label for="<?php echo $this->get_field_id('slidestoscroll'); ?>"><?php _e( 'Number of Slides to Scroll', 'instagram-slider-and-carousel-plus-widget' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('slidestoscroll'); ?>" name="<?php echo $this->get_field_name('slidestoscroll'); ?>" type="number" value="<?php echo $instance['slidestoscroll']; ?>" min="1" />
        </p>

        <!-- autoplay_interval -->
        <p>
            <label for="<?php echo $this->get_field_id('autoplay_interval'); ?>"><?php _e( 'Autoplay Interval', 'instagram-slider-and-carousel-plus-widget' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('autoplay_interval'); ?>" name="<?php echo $this->get_field_name('autoplay_interval'); ?>" type="number" value="<?php echo $instance['autoplay_interval']; ?>" min="1" step="500" />
        </p>

        <!-- speed -->
        <p>
            <label for="<?php echo $this->get_field_id('speed'); ?>"><?php _e( 'Slider Speed', 'instagram-slider-and-carousel-plus-widget' ); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>" type="number" value="<?php echo $instance['speed']; ?>" min="1" step="50" />
        </p>

        <!-- Select autoplay -->
        <p>
            <input id="<?php echo $this->get_field_id( 'autoplay' ); ?>" name="<?php echo $this->get_field_name( 'autoplay' ); ?>" type="checkbox" value="1" <?php checked( $instance['autoplay'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e( 'Autoplay', 'instagram-slider-and-carousel-plus-widget' ); ?></label><br/>
            <span><em><?php _e( 'Check this box to run slider automatically.', 'instagram-slider-and-carousel-plus-widget' ); ?></em></span>
        </p>

        <!-- Select arrows -->
        <p>
            <input id="<?php echo $this->get_field_id( 'arrows' ); ?>" name="<?php echo $this->get_field_name( 'arrows' ); ?>" type="checkbox" value="1" <?php checked( $instance['arrows'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'arrows' ); ?>"><?php _e( 'Arrows', 'instagram-slider-and-carousel-plus-widget' ); ?></label><br/>
            <span><em><?php _e( 'Check this box to enable slider arrow.', 'instagram-slider-and-carousel-plus-widget' ); ?></em></span>
        </p>
        
        <!-- Select dots -->
        <p>
            <input id="<?php echo $this->get_field_id( 'dots' ); ?>" name="<?php echo $this->get_field_name( 'dots' ); ?>" type="checkbox" value="1" <?php checked( $instance['dots'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'dots' ); ?>"><?php _e( 'Dots', 'instagram-slider-and-carousel-plus-widget' ); ?></label><br/>
            <span><em><?php _e( 'Check this box to enable slider pagination dots.', 'instagram-slider-and-carousel-plus-widget' ); ?></em></span>
        </p>

        <!-- Select loop -->
        <p>
            <input id="<?php echo $this->get_field_id( 'loop' ); ?>" name="<?php echo $this->get_field_name( 'loop' ); ?>" type="checkbox" value="1" <?php checked( $instance['loop'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'loop' ); ?>"><?php _e( 'Loop', 'instagram-slider-and-carousel-plus-widget' ); ?></label><br/>
            <span><em><?php _e( 'Check this box to run slider continuously.', 'instagram-slider-and-carousel-plus-widget' ); ?></em></span>
        </p>

        <!-- Select centermode -->
        <p>
            <input id="<?php echo $this->get_field_id( 'centermode' ); ?>" name="<?php echo $this->get_field_name( 'centermode' ); ?>" type="checkbox" value="1" <?php checked( $instance['centermode'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'centermode' ); ?>"><?php _e( 'Centermode', 'instagram-slider-and-carousel-plus-widget' ); ?></label><br/>
            <span><em><?php _e( 'Check this box to enable slider centermode effect.', 'instagram-slider-and-carousel-plus-widget' ); ?></em></span>
        </p>

        <!-- Select popup user avatar -->
        <p>
            <input id="<?php echo $this->get_field_id( 'popup_user_avatar' ); ?>" name="<?php echo $this->get_field_name( 'popup_user_avatar' ); ?>" type="checkbox" value="1" <?php checked( $instance['popup_user_avatar'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'popup_user_avatar' ); ?>"><?php _e( 'Display User Avatar in Popup', 'instagram-slider-and-carousel-plus-widget' ); ?></label>
        </p>

        <!-- Select show instagram link -->
        <p>
            <input id="<?php echo $this->get_field_id( 'popup_insta_link' ); ?>" name="<?php echo $this->get_field_name( 'popup_insta_link' ); ?>" type="checkbox" value="1" <?php checked( $instance['popup_insta_link'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'popup_insta_link' ); ?>"><?php _e( 'Display Instagram Link in Popup', 'instagram-slider-and-carousel-plus-widget' ); ?></label>
        </p>

        <!-- Select popup -->
        <p>
            <input id="<?php echo $this->get_field_id( 'popup' ); ?>" name="<?php echo $this->get_field_name( 'popup' ); ?>" type="checkbox" value="1" <?php checked( $instance['popup'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'popup' ); ?>"><?php _e( 'Popup', 'instagram-slider-and-carousel-plus-widget' ); ?></label>
        </p>

        <!-- Select popup_gallery -->
        <p>
            <input id="<?php echo $this->get_field_id( 'popup_gallery' ); ?>" name="<?php echo $this->get_field_name( 'popup_gallery' ); ?>" type="checkbox" value="1" <?php checked( $instance['popup_gallery'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'popup_gallery' ); ?>"><?php _e( 'Popup Gallery', 'instagram-slider-and-carousel-plus-widget' ); ?></label>
        </p>


        <!-- Select show_caption -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_caption' ); ?>" name="<?php echo $this->get_field_name( 'show_caption' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_caption'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_caption' ); ?>"><?php _e( 'Show Image Caption', 'instagram-slider-and-carousel-plus-widget' ); ?></label>
        </p>

        <!-- Select show_likes_count -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_likes_count' ); ?>" name="<?php echo $this->get_field_name( 'show_likes_count' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_likes_count'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_likes_count' ); ?>"><?php _e( 'Show Likes Count', 'instagram-slider-and-carousel-plus-widget' ); ?></label>
        </p>

        <!-- Select show_comments_count -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_comments_count' ); ?>" name="<?php echo $this->get_field_name( 'show_comments_count' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_comments_count'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_comments_count' ); ?>"><?php _e( 'Show Comments Count', 'instagram-slider-and-carousel-plus-widget' ); ?></label>
        </p>

        <!-- Select show_comments -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_comments' ); ?>" name="<?php echo $this->get_field_name( 'show_comments' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_comments'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_comments' ); ?>"><?php _e( 'Show Comments in Popup', 'instagram-slider-and-carousel-plus-widget' ); ?></label>
        </p>

        <!-- Image fit true false -->
        <p>
            <input id="<?php echo $this->get_field_id( 'image_fit' ); ?>" name="<?php echo $this->get_field_name( 'image_fit' ); ?>" type="checkbox" <?php checked( $instance['image_fit'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'image_fit' ); ?>"><?php _e( 'Image Fit', 'instagram-slider-and-carousel-plus-widget' ); ?></label><br/>
            <span><em><?php _e( 'Check this box to fill image in a whole div.', 'instagram-slider-and-carousel-plus-widget' ); ?></em></span>
        </p>
<?php
    }

    /**
    * Outputs the content for the current widget instance.
    *
    * @package Instagram Slider and Carousel Plus Widget Pro
    * @since 1.0
    */
    function widget( $insta_grid_args, $instance ) {

        $instance = wp_parse_args( (array) $instance, $this->defaults );
        extract($insta_grid_args, EXTR_SKIP);

        $title                          = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : __( 'Instagram Grid', 'instagram-slider-and-carousel-plus-widget' ), $instance, $this->id_base );
        $username                       = $instance['username'];
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
        $show_comments                  = ( isset($instance['show_comments']) && ($instance['show_comments'] == 1) ) ? "true" : "false";
        $slidestoshow                   = $instance['slidestoshow'];
        $slidestoscroll                 = $instance['slidestoscroll'];
        $loop                           = ( $instance['loop'] == 1 ) ? "true" : "false";
        $dots                           = ( $instance['dots'] == 1 ) ? "true" : "false";
        $arrows                         = ( $instance['arrows'] == 1 ) ? "true" : "false";
        $autoplay                       = ( $instance['autoplay'] == 1 ) ? "true" : "false";
        $autoplay_interval              = $instance['autoplay_interval'];
        $speed                          = $instance['speed'];
        $centermode                     = ( isset($instance['centermode']) && ($instance['centermode'] == 1) ) ? "true" : "false";
        $height_css                     = !empty($gallery_height)           ? "height:{$gallery_height}px;"     : '';
        $image_fit                      = $instance['image_fit'];
        $old_browser                    = iscwp_pro_old_browser();

        // If no username is passed then return
        if( empty($username) ) {
            return;
        }

        // Enqueue required script
        if( $popup ) {
            wp_enqueue_script('wpos-magnific-script');

            $popup_conf = compact( 'popup_gallery' );
        }
        wp_enqueue_script('wpos-slick-jquery');
        wp_enqueue_script('iscwp-pro-public-js');

        // Design file
        $design_file_path   = ISCWP_PRO_DIR . '/templates/' . $design . '.php';
        $design_file        = (file_exists($design_file_path)) ? $design_file_path : '';

        // Taking some variables
        $popup_html             = '';
        $count                  = 1;    
        $unique                 = iscwp_pro_get_unique();

        $wrpper_cls         = "iscwp-cnt-wrp";
        $main_wrpper_cls    = "iscwp-instagram-slider-widget iscwp-gallery-slider iscwp-{$design}";
        $main_wrpper_cls    .= ($popup)                 ? ' iscwp-popup-gallery'    : '';
        $main_wrpper_cls    .= ($old_browser)           ? ' iscwp-old-browser'      : '';
        $main_wrpper_cls    .= ($image_fit)             ? ' iscwp-image-fit'        : '';
        $main_wrpper_cls    .= ($centermode == 'true')  ? ' iscwp-center-mode '     : '';

        $instagram_link         = '';
        $instagram_data         = iscwp_pro_get_user_media($username,$limit);
        $instagram_link_main    = 'https://www.instagram.com/';

        // User details
        $userdata = array(
                'username'          =>  (!empty($instagram_data['iscwp_user_data']['username']))            ? $instagram_data['iscwp_user_data']['username']        : '',
                'full_name'         =>  (!empty($instagram_data['iscwp_user_data']['full_name']))           ? $instagram_data['iscwp_user_data']['full_name']       : '',
                'profile_picture'   =>  (!empty($instagram_data['iscwp_user_data']['profile_pic_url']) )    ? $instagram_data['iscwp_user_data']['profile_pic_url'] : '',
            );

        // Slider configuration
        $slider_conf = compact('slidestoshow', 'slidestoscroll', 'loop', 'dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed', 'centermode');

        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        if(!empty($instagram_data)) { ?>

            <div class="iscwp-gallery-slider-wrp iscwp-main-wrp iscwp-clearfix">
                <div class="<?php echo $main_wrpper_cls; ?>" id="iscwp-gallery-<?php echo $unique; ?>">

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
                    } ?>
                </div>
                <div class="iscwp-gallery-slider-conf iscwp-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>

                <?php if( $popup ) { ?>
                <div class="wp-iscwp-popup-conf" data-conf="<?php echo htmlspecialchars(json_encode($popup_conf)); ?>"></div>
                <?php } ?>
            </div>
<?php
        }

        echo $popup_html; // Printing popup html

        echo $after_widget;
    }
}