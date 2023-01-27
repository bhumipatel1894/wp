<div class="wpsisac-slick-image-slide">
	
	<div class="wpsisac-slide-wrap" <?php echo $slider_height_css; ?>>
		<?php if( $slider_img ) { ?>
			<img class="wpsisac-slider-img" src="<?php echo $slider_img ?>" title="<?php _e('Slider Image', 'wp-slick-slider-and-image-carousel'); ?>" alt="<?php _e('Slider Image', 'wp-slick-slider-and-image-carousel'); ?>" />
	<?php } ?>
	</div>

	<div class="wpsisac-slider-content">

		<div class="wpsisac-slide-title">
			<?php the_title(); ?>
		</div>
		
		<?php if($showContent == 'true') { ?>
			<div class="wpsisac-slider-short-content">
				<?php the_content(); ?>
			</div>
	 	<?php } ?>

	 	<?php if( !empty($read_more_url) && $show_read_more) { ?>
				<div class="wpsisac-readmore"><a href="<?php echo esc_url($read_more_url); ?>" class="wpsisac-slider-readmore" target="<?php echo $link_target; ?>"><?php esc_html_e( $read_more_text ); ?></a></div><?php
			} ?>
		 	
	</div>
		<?php
			if( !empty($read_more_url) ) { ?>
				<a class="wpsisac-slick-slider-link" href="<?php echo esc_url($read_more_url); ?>" target="<?php echo $link_target; ?>"></a><?php
			} ?>
</div>