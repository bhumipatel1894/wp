<div class="wpsisac-slick-image-slide">
	<div class="wpsisac-wpsisac-warp">
		
		<div class="wpsisac-img-wrap" <?php echo $slider_height_css; ?>><?php
			if( $slider_img ) { ?>
				<img class="wpsisac-slider-img" src="<?php echo $slider_img; ?>" alt="<?php _e('Slider Carousel Image', 'wp-slick-slider-and-image-carousel'); ?>" /><?php
			} ?>
		</div>
		
		<div class="wpsisac-slider-content">
			
			<h4 class="wpsisac-slide-title"><?php the_title(); ?></h4><?php
			if($showContent == "true" ) { ?>
				<div class="wpsisac-slider-short-content"><?php
					the_content(); ?>			
				</div><?php
			}
			if( !empty($read_more_url) && $show_read_more) { ?>
				<div class="wpsisac-readmore"><a href="<?php echo esc_url($read_more_url); ?>" class="wpsisac-slider-readmore" target="<?php echo $link_target; ?>"><?php esc_html_e( $read_more_text ); ?></a></div><?php
			} ?>
		</div>
		
	</div><?php
	
	if( !empty($read_more_url) ) { ?>
		<a class="wpsisac-slick-slider-link" href="<?php echo esc_url($read_more_url); ?>" target="<?php echo $link_target; ?>"></a><?php
	} ?>
</div>