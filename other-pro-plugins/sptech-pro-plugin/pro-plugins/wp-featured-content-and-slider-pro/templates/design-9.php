<div class="featured-content-main <?php echo $css_class .' '. $grid_cls .' '. $slider_clmn_cls; ?>">
	<div class="featured-content-position">
		
		
		<div class="featured-content-image-bg"> 
		<?php if( $post_featured_image ) { ?>
			<img src="<?php echo $post_featured_image; ?>" alt="<?php _e('Post Image', 'wp-featured-content-and-slider'); ?>" />
		<?php } ?>
		</div>
		
		<div class="featured-content-overlay">
			
			<?php if( $fc_icon ) { ?>
			<div class="featured-content-image <?php echo $imagestyle; ?>"> 
				<?php if($sliderurl != '') { ?>
				<a href="<?php echo $sliderurl; ?>" target="<?php echo $link_target; ?>"><?php if($fc_icon != '') { echo '<i style="color:'.$faIconcolor.'" class="'.$fc_icon.'"></i>';  } ?>		</a>
				<?php } else {								
					if($fc_icon != '') { echo '<i style="color:'.$faIconcolor.'" class="'.$fc_icon.'"></i>'; } ?>
				<?php } ?>
			</div><!-- end .featured-content-image -->
			<?php } ?>
			
			<div class="wp-fcasp-title">
			<?php if($sliderurl != '') { ?>
				<a href="<?php echo $sliderurl; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
				<?php } else {
					the_title();
				} ?>
			</div>

			<?php $fcontent= wp_fcasp_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail );?>

			<?php if($show_content == "true" && !empty($fcontent)) { ?>
				<div class="featured_short_content">
					<div class="sub-content">
						<?php echo $fcontent; ?>
					</div>
				</div><!-- end .featured_short_content -->
			<?php } ?>

			<?php if($display_read_more == 'true' && $sliderurl != '') { ?>
				<div class="featured-read-more">					
					<a href="<?php echo $sliderurl; ?>" target="<?php echo $link_target; ?>"><?php esc_html_e( $read_more_text ); ?></a>
				</div>
			<?php } ?>

		</div><!-- end .featured-content-overlay -->

	</div><!-- end .featured-content-position -->
</div><!-- end .featured-content-main -->