<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

add_action( 'widgets_init', 'wpls_pro_logo_slider_widget' );

/**
 * Register logo showcase slider widget
 *
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_logo_slider_widget() {
	register_widget( 'Wpls_Pro_Logo_Slider' );
}

/**
 * Wpls_Pro_Logo_Slider Widget Class.
 *
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
class Wpls_Pro_Logo_Slider extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {

		// Widget settings
		$widget_ops = array( 'classname' => 'wpls-pro-logo-slider', 'description' => __( 'Display logos in a slider in a sidebar.', 'logoshowcase' ) );

		// Create the widget
		WP_Widget::__construct( 'wpls-pro-logo-slider', __( 'Logo Showcase - Slider View', 'logoshowcase' ), $widget_ops );
	}

	/**
	 * Updates the widget control options
	 *
	 * @package WP Logo Showcase Responsive Slider Pro
 	 * @since 1.0.0
	 */
	function update( $new_instance, $old_instance ) {
		
        $instance = $old_instance;
		
		// Set the instance to the new instance
		$instance = $new_instance;
		
		// Input fields
		$instance['title']				= strip_tags( $new_instance['title'] );
		$instance['design'] 			= !empty($new_instance['design']) ? $new_instance['design'] : 'wpls-design-1';
		$instance['image_size'] 		= !empty($new_instance['image_size']) ? $new_instance['image_size'] : 'original';
		$instance['cat_id'] 			= $new_instance['cat_id'];
		$instance['include_cat_child'] 	= isset($new_instance['include_cat_child']) ? 1 : 0;
		$instance['limit'] 				= ( empty($new_instance['limit']) || ($new_instance['limit'] < -1) ) ? 5 : $new_instance['limit'];
		$instance['order']              = ($new_instance['order'] == 'asc') ? 'asc' : 'desc';
        $instance['orderby']            = $new_instance['orderby'];
		$instance['link_target'] 		= $new_instance['link_target'];
		$instance['animation'] 			= $new_instance['animation'];
		$instance['show_title'] 		= isset($new_instance['show_title']) 	? 1 : 0;
		$instance['tooltip'] 			= isset($new_instance['tooltip'])		? 1 : 0;
		$instance['words_limit'] 		= !empty($new_instance['words_limit']) ? $new_instance['words_limit'] : 55;
		$instance['content_tail']		= $new_instance['content_tail'];
		$instance['posts']              = $new_instance['posts'];
        $instance['exclude_posts']      = $new_instance['exclude_posts'];
        $instance['exclude_cat']      	= !empty($new_instance['exclude_cat']) ? $new_instance['exclude_cat'] : '';
		$instance['slides_column'] 		= ($new_instance['slides_column'] > 0) ? $new_instance['slides_column'] : '1';
		$instance['slides_scroll'] 		= ($new_instance['slides_scroll'] > 0) ? $new_instance['slides_scroll'] : '1';
		$instance['dots'] 				= $new_instance['dots'];
		$instance['arrows'] 			= $new_instance['arrows'];
		$instance['autoplay'] 			= $new_instance['autoplay'];
		$instance['center_mode'] 		= $new_instance['center_mode'];
		$instance['autoplay_interval']	= $new_instance['autoplay_interval'];
		$instance['loop']				= $new_instance['loop'];
		$instance['speed']				= $new_instance['speed'];
		$instance['ticker'] 			= isset($new_instance['ticker'])		? 1 : 0;
		
        return $instance;
    }

    /**
	 * Displays the widget form in widget area
	 *
	 * @package WP Logo Showcase Responsive Slider Pro
 	 * @since 1.0.0
	 */
	function form( $instance ) {
		
		$defaults = array( 
							'title' 			=> '',
							'limit' 			=> 5,
							'cat_id' 			=> '',
							'include_cat_child'	=> 1,
							'order'             => 'desc',
           					'orderby'           => 'date',
							'link_target' 		=> '',
							'show_title' 		=> 0,
							'tooltip'			=> 0,
							'image_size' 		=> 'original',
							'design'			=> 'design-1',
							'animation'			=> '',
							'words_limit'		=> 55,
							'content_tail'		=> '...',
							'posts'             => '',
            				'exclude_posts'     => '',
            				'exclude_cat'		=> array(),
							'slides_column' 	=> '1',
							'slides_scroll' 	=> '1',
							'dots' 				=> 'true',
							'arrows' 			=> 'true',
							'autoplay' 			=> 'true',
							'autoplay_interval' => '3000',
							'speed' 			=> '600',
							'center_mode' 		=> 'false',
							'loop' 				=> 'true',
							'ticker'			=> 0,
						);
        $instance 			= wp_parse_args( (array) $instance, $defaults );
        $designs_arr 		= wpls_pro_logo_designs();
        $wpls_animations 	= wpls_pro_animations();
        $img_sizes 			= wpls_img_sizes();
        $cat_id 			= !empty($instance['cat_id']) 		? $instance['cat_id'] 		: array();
        $exclude_cat 		= !empty($instance['exclude_cat']) 	? $instance['exclude_cat'] 	: array();
        
        // Getting Categories
        $cat_args = array(
						'taxonomy' 			=> WPLS_PRO_CAT,
						'fields'			=> 'id=>name',
					);
        $wpls_cats = get_categories( $cat_args );
        ?>
		
		<!-- Title Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'logoshowcase'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>

		<!-- Design Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'design' ); ?>"><?php _e( 'Design', 'logoshowcase'); ?>:</label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'design' ); ?>" name="<?php echo $this->get_field_name( 'design' ); ?>">
				<?php if( !empty($designs_arr) ) {
						foreach ($designs_arr as $design_key => $design_data) {
							$design_val = isset($design_data['file']) ? $design_data['file'] : '';
							$design_name = isset($design_data['name']) ? $design_data['name'] : __('Design', 'logoshowcase');
				?>
							<option value="<?php echo $design_key; ?>" <?php selected( $instance['design'], $design_key ); ?> ><?php echo $design_name; ?></option>	
				<?php	}
					}
				?>
			</select>
		</p>

		<!-- Image Size Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'image_size' ); ?>"><?php _e( 'Image Size:', 'logoshowcase'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'image_size' ); ?>" name="<?php echo $this->get_field_name( 'image_size' ); ?>">
				<?php if( !empty($img_sizes) ) { 
						foreach ($img_sizes as $img_key => $img_val) { ?>
							<option value="<?php echo $img_key; ?>" <?php selected( $instance['image_size'], $img_key ); ?> ><?php echo $img_val; ?></option>	
				<?php	}
					}
				?>
			</select>
		</p>

		<!-- Link Target Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link_target' ); ?>"><?php _e( 'Link Target:', 'logoshowcase'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'link_target' ); ?>" name="<?php echo $this->get_field_name( 'link_target' ); ?>">
				<option value=""><?php _e('Open in Same Window', 'logoshowcase') ?></option>
				<option value="blank" <?php selected( $instance['link_target'], 'blank' ); ?> ><?php _e('Open in New Window', 'logoshowcase') ?></option>
			</select>
		</p>

		<!-- Animation Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'animation' ); ?>"><?php _e( 'Animation Effect:', 'logoshowcase'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'animation' ); ?>" name="<?php echo $this->get_field_name( 'animation' ); ?>">
				<option value=""><?php _e('Select Animation Effect', 'logoshowcase'); ?></option>	
				<?php if( !empty($wpls_animations) ) {
						foreach ($wpls_animations as $anim_key => $anim_name) {
				?>
							<option value="<?php echo $anim_key; ?>" <?php selected( $instance['animation'], $anim_key ); ?> ><?php echo $anim_name; ?></option>
				<?php	}
					}
				?>
			</select>
		</p>

		<!-- Show Title Field -->
		<p>
			<input type="checkbox" value="1" id="<?php echo $this->get_field_id( 'show_title' ); ?>" name="<?php echo $this->get_field_name( 'show_title' ); ?>" <?php checked( $instance['show_title'], 1 ); ?>>
			<label for="<?php echo $this->get_field_id( 'show_title' ); ?>"><?php _e( 'Show Title', 'logoshowcase'); ?></label>
		</p>

		<!-- Show Tooltip -->
		<p>
			<input type="checkbox" value="1" id="<?php echo $this->get_field_id( 'tooltip' ); ?>" name="<?php echo $this->get_field_name( 'tooltip' ); ?>" <?php checked( $instance['tooltip'], 1 ); ?>>
			<label for="<?php echo $this->get_field_id( 'tooltip' ); ?>"><?php _e( 'Show Tooltip', 'logoshowcase'); ?></label>
		</p>

		<!-- Category Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'cat_id' ); ?>"><?php _e( 'Category:', 'logoshowcase'); ?></label>
			<select name="<?php echo $this->get_field_name( 'cat_id[]' ) ?>" id="<?php echo $this->get_field_id( 'cat_id' ); ?>" class="widefat" multiple="multiple">
			<?php
                if( !is_wp_error($wpls_cats) && !empty($wpls_cats) ) {
					foreach ($wpls_cats as $category_id => $cat_name) { ?>
                		<option value="<?php echo $category_id; ?>" <?php selected( in_array($category_id, $cat_id), 1 ); ?>><?php echo $cat_name; ?></option>
           	<?php 	}
            	}
            ?>
            </select>
		</p>

		<!-- Include Category Child -->
		<p>
			<input type="checkbox" value="1" id="<?php echo $this->get_field_id( 'include_cat_child' ); ?>" name="<?php echo $this->get_field_name( 'include_cat_child' ); ?>" <?php checked( $instance['include_cat_child'], 1 ); ?>>
			<label for="<?php echo $this->get_field_id( 'include_cat_child' ); ?>"><?php _e( 'Include Category Child', 'logoshowcase'); ?></label><br/>
			<span><em><?php _e('Check this box if you want to display child category post if parent category is selected.', 'logoshowcase'); ?></em></span>
		</p>

		<!-- Number of Items Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Number of Items:', 'logoshowcase'); ?></label> 
			<input class="widefat" min="-1" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="number" value="<?php echo $instance['limit']; ?>" />
		</p>

		<!-- Order By -->
        <p>
            <label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Order By:', 'logoshowcase' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'orderby' ); ?>">
                <option value="date" <?php selected( $instance['orderby'], 'date' ); ?>><?php _e( 'Post Date', 'logoshowcase' ); ?></option>
                <option value="modified" <?php selected( $instance['orderby'], 'modified' ); ?>><?php _e( 'Post Updated Date', 'logoshowcase' ); ?></option>
                <option value="ID" <?php selected( $instance['orderby'], 'ID' ); ?>><?php _e( 'Post Id', 'logoshowcase' ); ?></option>
                <option value="title" <?php selected( $instance['orderby'], 'title' ); ?>><?php _e( 'Post Title', 'logoshowcase' ); ?></option>
                <option value="rand" <?php selected( $instance['orderby'], 'rand' ); ?>><?php _e( 'Random', 'logoshowcase' ); ?></option>
                <option value="menu_order" <?php selected( $instance['orderby'], 'menu_order' ); ?>><?php _e( 'Menu Order (Sort Order)', 'logoshowcase' ); ?></option>
            </select>
        </p>

        <!-- Order -->
        <p>
            <label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'Order:', 'logoshowcase' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'order' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>">
                <option value="asc" <?php selected( $instance['order'], 'asc' ); ?>><?php _e( 'Ascending', 'logoshowcase' ); ?></option>
                <option value="desc" <?php selected( $instance['order'], 'desc' ); ?>><?php _e( 'Descending', 'logoshowcase' ); ?></option>
            </select>
        </p>

        <!-- Content Word Limit Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'words_limit' ); ?>"><?php _e( 'Content Words Limit:', 'logoshowcase'); ?></label> 
			<input class="widefat" min="1" id="<?php echo $this->get_field_id( 'words_limit' ); ?>" name="<?php echo $this->get_field_name( 'words_limit' ); ?>" type="number" value="<?php echo $instance['words_limit']; ?>" />
			<span><em><?php _e('Note: This parameter will work with design 4 only.', 'logoshowcase'); ?></em></span>
		</p>

		<!-- Content Tail Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'content_tail' ); ?>"><?php _e( 'Content Tail:', 'logoshowcase'); ?></label> 
			<input class="widefat" min="1" id="<?php echo $this->get_field_id( 'content_tail' ); ?>" name="<?php echo $this->get_field_name( 'content_tail' ); ?>" type="text" value="<?php echo $instance['content_tail']; ?>" />
			<span><em><?php _e('Note: This parameter will work with design 4 only.', 'logoshowcase'); ?></em></span>
		</p>

		<!-- Display Specific Posts -->    
        <p>
            <label for="<?php echo $this->get_field_id('posts'); ?>"><?php _e( 'Display Specific Post:', 'logoshowcase' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" type="text" value="<?php echo esc_attr($instance['posts']); ?>" />
            <span><em><?php _e('Enter Post id which you want to display. You can enter multiple ids with comma seperated.', 'logoshowcase'); ?></em></span>
        </p>

        <!-- Exclude Posts -->    
        <p>
            <label for="<?php echo $this->get_field_id('exclude_posts'); ?>"><?php _e( 'Exclude Posts:', 'logoshowcase' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('exclude_posts'); ?>" name="<?php echo $this->get_field_name('exclude_posts'); ?>" type="text" value="<?php echo esc_attr($instance['exclude_posts']); ?>" />
            <span><em><?php _e('Enter Post id which you do not want to display. You can enter multiple ids with comma seperated.', 'logoshowcase'); ?></em></span>
        </p>

        <!-- Exclude Category Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'exclude_cat' ); ?>"><?php _e( 'Exclude Category:', 'logoshowcase'); ?></label>
			<select name="<?php echo $this->get_field_name( 'exclude_cat[]' ) ?>" id="<?php echo $this->get_field_id( 'exclude_cat' ); ?>" class="widefat" multiple="multiple">
			<?php
                if( !is_wp_error($wpls_cats) && !empty($wpls_cats) ) {
					foreach ($wpls_cats as $category_id => $cat_name) { ?>
                		<option value="<?php echo $category_id; ?>" <?php selected( in_array($category_id, $exclude_cat), 1 ); ?>><?php echo $cat_name; ?></option>
           	<?php 	}
            	}
            ?>
            </select>
            <span><em><?php _e('Exclude category logos.', 'logoshowcase'); ?></em></span>
		</p>

		<h3><?php _e('Logo Slider Setting', 'logoshowcase'); ?></h3>

		<!-- Slides Column Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'slides_column' ); ?>"><?php _e( 'Slides Column:', 'logoshowcase'); ?></label>
			<input class="widefat" min="1" id="<?php echo $this->get_field_id( 'slides_column' ); ?>" name="<?php echo $this->get_field_name( 'slides_column' ); ?>" type="number" value="<?php echo $instance['slides_column']; ?>" />
			<span><em><?php _e('Number of slides column.', 'logoshowcase'); ?></em></span>
		</p>

		<!-- Slides Scroll Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'slides_scroll' ); ?>"><?php _e( 'Slides Scroll:', 'logoshowcase'); ?></label>
			<input class="widefat" min="1" id="<?php echo $this->get_field_id( 'slides_scroll' ); ?>" name="<?php echo $this->get_field_name( 'slides_scroll' ); ?>" type="number" value="<?php echo $instance['slides_scroll']; ?>" />
			<span><em><?php _e('Number of slides to scroll at a time.', 'logoshowcase'); ?></em></span>
		</p>

		<!-- Dots Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'dots' ); ?>"><?php _e( 'Dots:', 'logoshowcase'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'dots' ); ?>" name="<?php echo $this->get_field_name( 'dots' ); ?>">
				<option value="true" <?php selected( $instance['dots'], 'true' ); ?>><?php _e('True', 'logoshowcase') ?></option>
				<option value="false" <?php selected( $instance['dots'], 'false' ); ?>><?php _e('False', 'logoshowcase') ?></option>
			</select>
			<span><em><?php _e('Enable slider pagination dots.', 'logoshowcase'); ?></em></span>
		</p>

		<!-- Arrows Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'arrows' ); ?>"><?php _e( 'Arrows:', 'logoshowcase'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'arrows' ); ?>" name="<?php echo $this->get_field_name( 'arrows' ); ?>">
				<option value="true" <?php selected( $instance['arrows'], 'true' ); ?>><?php _e('True', 'logoshowcase') ?></option>
				<option value="false" <?php selected( $instance['arrows'], 'false' ); ?>><?php _e('False', 'logoshowcase') ?></option>
			</select>
			<span><em><?php _e('Enable slider navigation arrow.', 'logoshowcase'); ?></em></span>
		</p>

		<!-- Autoplay Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e( 'Autoplay:', 'logoshowcase'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'autoplay' ); ?>" name="<?php echo $this->get_field_name( 'autoplay' ); ?>">
				<option value="true" <?php selected( $instance['autoplay'], 'true' ); ?>><?php _e('True', 'logoshowcase') ?></option>
				<option value="false" <?php selected( $instance['autoplay'], 'false' ); ?>><?php _e('False', 'logoshowcase') ?></option>
			</select>
			<span><em><?php _e('Enable slider autoplay.', 'logoshowcase'); ?></em></span>
		</p>

		<!-- Loop Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'loop' ); ?>"><?php _e( 'Loop:', 'logoshowcase'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'loop' ); ?>" name="<?php echo $this->get_field_name( 'loop' ); ?>">
				<option value="true" <?php selected( $instance['loop'], 'true' ); ?>><?php _e('True', 'logoshowcase') ?></option>
				<option value="false" <?php selected( $instance['loop'], 'false' ); ?>><?php _e('False', 'logoshowcase') ?></option>
			</select>
			<span><em><?php _e('Runs the slider contineously.', 'logoshowcase'); ?></em></span>
		</p>

		<!-- Center Mode Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'center_mode' ); ?>"><?php _e( 'Center Mode:', 'logoshowcase'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'center_mode' ); ?>" name="<?php echo $this->get_field_name( 'center_mode' ); ?>">
				<option value="true" <?php selected( $instance['center_mode'], 'true' ); ?>><?php _e('True', 'logoshowcase') ?></option>
				<option value="false" <?php selected( $instance['center_mode'], 'false' ); ?>><?php _e('False', 'logoshowcase') ?></option>
			</select>
			<span><em><?php _e('Enable center mode. Note: Works well with odd number of Slides Column and Slides Scroll is set to 1.', 'logoshowcase'); ?></em></span>
		</p>

		<!-- Autoplay Interval Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'autoplay_interval' ); ?>"><?php _e( 'Autoplay Interval:', 'logoshowcase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'autoplay_interval' ); ?>" name="<?php echo $this->get_field_name( 'autoplay_interval' ); ?>" type="text" value="<?php echo $instance['autoplay_interval']; ?>" />
			<span><em><?php _e('Slider slides interval time.', 'logoshowcase'); ?></em></span>
		</p>

		<!-- Speed Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed:', 'logoshowcase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>" name="<?php echo $this->get_field_name( 'speed' ); ?>" type="text" value="<?php echo $instance['speed']; ?>" />
			<span><em><?php _e('Slider speed.', 'logoshowcase'); ?></em></span>
		</p>

		<!-- Show Tooltip -->
		<p>
			<input type="checkbox" value="1" id="<?php echo $this->get_field_id( 'ticker' ); ?>" name="<?php echo $this->get_field_name( 'ticker' ); ?>" <?php checked( $instance['ticker'], 1 ); ?>>
			<label for="<?php echo $this->get_field_id( 'ticker' ); ?>"><?php _e( 'Enable Ticker Mode', 'logoshowcase'); ?></label><br/>
			<span><em><?php _e('Runs the slider contineously.', 'logoshowcase'); ?></em></span><br/>
			<span><em><?php _e('Note: When you enable ticker mode Autoplay, Slides Scroll and Autoplay Interval are set to default.', 'logoshowcase'); ?></em></span>
		</p>
<?php
    }

	/**
	 * Outputs the content of the widget
	 *
	 * @package WP Logo Showcase Responsive Slider Pro
 	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		
		extract( $args );
		
		$title          	= apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : __( 'Logo Showcase Slider', 'logoshowcase' ), $instance, $this->id_base );
		$cat_name			= $instance['title'];
		$cat_id				= $instance['cat_id'];
		$include_cat_child 	= ($instance['include_cat_child'] == 1) ? true : false;
		$limit				= $instance['limit'];
		$design 			= $instance['design'];
		$link_target 		= $instance['link_target'];
		$image_size 		= $instance['image_size'];
		$show_title 		= !empty($instance['show_title']) 	? 'true' : 'false';
		$animation 			= !empty($instance['animation']) 	? $instance['animation'] 	: '';
		$animation_cls 		= empty($animation) 				? 'has-no-animation' 		: '';
		$tooltip 			= $instance['tooltip'];
		$tooltip_cls 		= ($instance['tooltip'] == 1) 		? 'wpls-tooltip'			: '';
		$order              = $instance['order'];
        $orderby            = $instance['orderby'];
		$words_limit 		= $instance['words_limit'];
		$content_tail 		= html_entity_decode($instance['content_tail']);
		$posts              = !empty($instance['posts']) ? explode(',', trim($instance['posts'])) : array();
        $exclude_posts      = !empty($instance['exclude_posts']) ? explode(',', trim($instance['exclude_posts'])) : array();
		$exclude_cat 		= $instance['exclude_cat'];
		$slides_column		= $instance['slides_column'];
		$slides_scroll		= $instance['slides_scroll'];
		$dots				= $instance['dots'];
		$arrows				= $instance['arrows'];
		$autoplay			= $instance['autoplay'];
		$speed				= $instance['speed'];
		$center_mode		= $instance['center_mode'];
		$loop				= $instance['loop'];
		$autoplay_interval	= $instance['autoplay_interval'];
		$ticker 			= ($instance['ticker'] == 1) ? 'true' : 'false';

		// Little tweak for ticker mode
		if( $ticker	== 'true' ) {
			$autoplay 			= 'true';
			$slides_scroll 		= 1;
			$autoplay_interval 	= 0;
		}

		// Enqueus required script
		wp_enqueue_script( 'wpos-slick-jquery' );
		wp_enqueue_script( 'wpls-pro-public-js' );
		if($tooltip) {
			wp_enqueue_script( 'wpos-tooltip-js' );
		}

		// Widget file
		$design_file 		= wpls_pro_get_design( $design, 'grid', 'design-1' );
		$design_file_path 	= WPLS_PRO_DIR . '/templates/' . $design_file . '.php';
		$design_file_path 	= (file_exists($design_file_path)) ? $design_file_path : '';

		// Taking some globals
		global $post;

		// Taking some variables
		$unique			= wpls_pro_get_unique();
		$cnt_wrp_cls 	= "{$tooltip_cls}";
		$center_mode_cls 	= ($center_mode == 'true') ? 'wpls-center-mode' : '';

		// Slider variable
		$logo_conf = compact('slides_column', 'slides_scroll', 'dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed', 'center_mode', 'loop', 'ticker');

		// WP Query Parameters
		$query_args = array(
								'post_type' 			=> WPLS_PRO_POST_TYPE,
								'posts_per_page'		=> $limit,
								'post_status' 			=> array( 'publish' ),
								'order'          		=> $order,
								'orderby'        		=> $orderby,
								'post__in'				=> $posts,
								'post__not_in'			=> $exclude_posts,
								'ignore_sticky_posts'	=> true,
							);

		// If category is passed
		if( !empty($cat_id) ) {

			$query_args['tax_query'] = array( 
											array(
													'taxonomy' 			=> WPLS_PRO_CAT, 
													'field' 			=> 'term_id',
													'terms' 			=> $cat_id,
													'include_children'	=> $include_cat_child,
										));

		} else if( !empty($exclude_cat) ) {

			$query_args['tax_query'] = array(
											array(
												'taxonomy' 			=> WPLS_PRO_CAT,
												'field' 			=> 'term_id',
												'terms' 			=> $exclude_cat,
												'operator'			=> 'NOT IN',
												'include_children'	=> $include_cat_child,
											));
		}

		// WP Query
		$logo_query = new WP_Query($query_args);
		$post_count = $logo_query->post_count;

		// Start Widget Output
		echo $before_widget;

		if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        // If Posts is there
		if( $logo_query->have_posts() ) { ?>

		<div class="wpls-logo-widget-slider-wrp">
			<div class="wpls-logo-showcase logo_showcase wpls-logo-widget-slider wpls-<?php echo $design.' '.$animation_cls .' '.$center_mode_cls; ?>" id="wpls-logo-showcase-slider-<?php echo $unique; ?>" data-animation="<?php echo $animation; ?>">

	<?php 	while ($logo_query->have_posts()) : $logo_query->the_post();

				$feat_image = wpls_pro_get_logo_image($post->ID, $image_size);
				$logourl 	= get_post_meta( $post->ID, 'wplss_slide_link', true );

				// Include shortcode html file
				if( $design_file_path ) {
					include( $design_file_path );
				}

		 	endwhile;
	?>

			</div><!-- end .wpls-logo-grid -->
			<div class="wpls-logo-showacse-slider-conf"><?php echo json_encode( $logo_conf ); ?></div>
		</div><!-- end .wpls-logo-showcase-slider-wrp -->

	<?php
		} // End of have_post()

		echo $after_widget;
	}
}