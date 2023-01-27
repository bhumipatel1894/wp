<div class="featured-content-main <?php echo $css_class; ?> <?php echo $grid_cls; ?>">
	<div class="box-after-main">

		<figure>
			
			<div class="featured-content-image">
				<?php if( $post_featured_image ) { ?>
					<img src="<?php echo $post_featured_image; ?>" alt="<?php _e('Post Image', 'wp-featured-content-and-slider'); ?>" />
				<?php } ?>
			</div><!-- end .featured-content-image -->

			<figcaption>
				<div class="wp-fcasp-title">
					<?php if($sliderurl != '') { ?>
					<a href="<?php echo $sliderurl; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
					<?php } else {
						the_title();
					} ?>
				</div>

				<?php if($display_read_more == 'true' && $sliderurl != '') { ?>
					<div class="featured-read-more">					
						<a class="readmore" href="<?php echo $sliderurl; ?>" target="<?php echo $link_target; ?>"><?php esc_html_e( $read_more_text ); ?></a>
					</div>
				<?php } ?>				
			</figcaption>

		</figure>

	</div><!-- end .box-after-main -->
</div><!-- end .featured-content-main -->