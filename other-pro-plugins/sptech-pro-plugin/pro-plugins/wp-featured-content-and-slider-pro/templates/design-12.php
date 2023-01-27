<div class="featured-content-main <?php echo $css_class; ?> <?php echo $grid_cls; ?>">
	<div class="box-after-main">
		<figure>
			<div class="featured-content-image">
				<?php if($sliderurl != '' && $post_featured_image !='') { ?>
					<a href="<?php echo $sliderurl; ?>" target="<?php echo $link_target; ?>"><img src="<?php echo $post_featured_image; ?>" alt="<?php _e('Post Image', 'wp-featured-content-and-slider'); ?>" /></a>
					<?php } else if($post_featured_image !='') { ?>
						<img src="<?php echo $post_featured_image; ?>" alt="<?php _e('Post Image', 'wp-featured-content-and-slider'); ?>" />
						<?php } ?>
					</div><!-- end .featured-content-image -->
					<figcaption>
						<div class="wp-fcasp-title">
							<?php if($sliderurl != '') { ?>
								<a href="<?php echo $sliderurl; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
								<?php } else {
									the_title(); } ?>
								</div><!-- end .wp-fcasp-title -->

								<?php $fcontent= wp_fcasp_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail );?>

								<?php if($show_content == "true" && $grid=="1" && !empty($fcontent)) { ?>
									<div class="featured_short_content">
										<div class="sub-content">
											<?php echo $fcontent; ?>
										</div>
									</div><!-- end .featured_short_content -->
									<?php } ?>

									<?php if($display_read_more == 'true' && $sliderurl != '') { ?>
										<div class="featured-read-more">					
											<a class="readmore" href="<?php echo $sliderurl; ?>" target="<?php echo $link_target; ?>"><?php esc_html_e( $read_more_text ); ?></a>
										</div><!-- end .featured-read-more -->
										<?php } ?>
									</figcaption>
								</figure>
							</div><!-- end .box-after-main -->
</div><!-- end .featured-content-main -->