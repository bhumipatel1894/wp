<div class="featured-content-main <?php echo $css_class .' '. $grid_cls .' '. $slider_clmn_cls; ?>">
	<div class="featured-content-position">
		
		<div class="featured-content-image-bg">
			<?php if( $post_featured_image ) { ?>
			<img src="<?php echo $post_featured_image; ?>" alt="<?php _e('Featured Image', 'wp-featured-content-and-slider') ?>" />
			<?php } ?>
		</div>

		<div class="featured-content-overlay">
			<div class="wp-fcasp-skewy">
				
				<div class="wp-fcasp-fa-content">
				<?php if( $fc_icon) { ?>
				<div class="featured-content-image <?php echo $imagestyle; ?>">
				<div class="wp-fcasp-bg">
				<?php if($sliderurl != '') { ?>
					
					<a href="<?php echo $sliderurl; ?>" target="<?php echo $link_target; ?>"><?php if($fc_icon != '') { echo '<i style="color:'.$faIconcolor.'" class="'.$fc_icon.'"></i>'; } ?></a>

				<?php } else { ?>

					<?php if($fc_icon != '') { echo '<i style="color:'.$faIconcolor.'" class="'.$fc_icon.'"></i>'; } ?>	
					
				<?php } ?>
				</div><!-- end .wp-fcasp-bg -->
				</div><!-- end .featured-content-image -->
				<?php } ?>
				</div><!-- end .wp-fcasp-fa-content-->
			

			<div class="wp-fcasp-title">
			<?php if($sliderurl != '') { ?>
				<a href="<?php echo $sliderurl; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
				<?php } else {
					the_title();
				} ?>
			</div>

			<?php if($display_read_more == 'true' && $sliderurl != '') { ?>
				<div class="featured-read-more">					
					<a href="<?php echo $sliderurl; ?>" target="<?php echo $link_target; ?>"><?php esc_html_e( $read_more_text ); ?></a>
				</div>
			<?php } ?>
			</div><!-- end .wp-fcasp-skewy-->
		</div><!-- end .featured-content-overlay -->

	</div><!-- end .featured-content-position -->
</div><!-- end .featured-content-main -->