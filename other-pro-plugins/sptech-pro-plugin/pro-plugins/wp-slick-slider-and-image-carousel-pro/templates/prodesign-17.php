<?php if( $slider_img ) { ?>	
	<div class="wpsisac-slick-image-slide">
		<div class="wpsisac-img-wrap" <?php echo $slider_height_css; ?>><?php
			if( !empty($read_more_url) ) { ?>
				<a href="<?php echo $read_more_url; ?>" target="<?php echo $link_target; ?>"><?php
				} ?>

				<img class="wpsisac-slider-img" src="<?php echo $slider_img; ?>" alt="<?php _e('Slider Carousel Image', 'wp-slick-slider-and-image-carousel'); ?>" /><?php

				if( !empty($read_more_url) ) { ?>
				</a><?php
			} ?>
		</div>
	</div><?php
} ?>