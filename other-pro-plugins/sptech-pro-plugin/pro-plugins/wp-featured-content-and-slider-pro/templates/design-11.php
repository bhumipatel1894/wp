<div class="featured-content-main <?php echo $css_class; ?> <?php echo $grid_cls; ?>">
	<div class="featured-content-image-box"> 
		
		<?php if( $post_featured_image ) { ?>
		<img src="<?php echo $post_featured_image; ?>" alt="<?php _e('Post Image', 'wp-featured-content-and-slider'); ?>" />
		<?php } ?>
		
		<div class="featured-content">
		<?php $fcontent = wp_fcasp_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?>
			<?php if($show_content == "true" && !empty($fcontent)) { ?>
				<div class="featured_short_content">
					<div class="sub-content">
						<?php echo $fcontent; ?>
					</div>
				</div><!-- end .featured_short_content -->
			<?php } ?>

			<div class="overlay2">
				<div class="wp-fcasp-title"><?php the_title(); ?></div>
			</div>
			
			<a href="<?php echo $sliderurl; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>

		</div><!-- end .featured-content -->	
					
	</div><!-- end .featured-content-image-box -->
</div><!-- end .featured-content-main -->