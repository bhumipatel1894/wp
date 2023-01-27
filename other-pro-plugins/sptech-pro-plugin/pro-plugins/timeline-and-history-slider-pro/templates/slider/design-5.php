<div id="wphtsp-slider-nav-<?php echo $unique; ?>" class="wphtsp-slider-nav wphtsp-slick-slider" <?php echo $slider_as_nav_for; ?>>
	<?php while ( $query->have_posts() ) : $query->the_post();  ?>
		<div class="wphtsp-slider-nav-title">
			<div class="wphtsp-title"><?php echo the_title(); ?></div>
			<div class="wphtsp-main-title"><button></button></div>
		</div>
	<?php endwhile; ?>
</div>

<div class="wphtsp-slider-for-<?php echo $unique; ?> wphtsp-slider-for wphtsp-slick-slider">
	<?php while ( $query->have_posts() ) : $query->the_post();
		$feat_image = wphtsp_get_post_featured_image( $post->ID, $image_size, true );
		$post_link 	= wphtsp_get_post_link( $post->ID );
	?>
		<div class="wphtsp-slider-nav-content">
			<div class="wphtsp-slider-nav-wrapper <?php echo 'wphtsp-img-'.$image_position; ?>" <?php echo $background_style; ?>>
				<?php if($image_position == 'bottom') { ?>
					<div class="wphtsp-content-wrapper">		

						<?php if( $show_title ) { ?>
						<h2 class="wphtsp-content-title">
							<?php if( $link ) { ?>
							<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" <?php echo $font_style; ?>><?php the_title(); ?></a>
							<?php } else { ?>
							<span <?php echo $font_style; ?>><?php the_title(); ?></span>
							<?php } ?>
						</h2>
						<?php } ?>

						<?php if ($show_date == 'true'){ ?>
							<div class="wphtsp-post-date"><span <?php echo $font_style; ?>><i class="fa fa-calendar" aria-hidden="true"></i><?php echo get_the_date($date_format); ?></span></div>
						<?php }
						if($showContent == "true") {  ?>	
							<div class="wphtsp-content">
								<?php  if($showFullContent == "false" ) { ?>
									<div class="wphtsp-tl-content" <?php echo $font_style; ?>><?php echo wphts_pro_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>		
									<?php if($showreadmore == 'true') { ?>
										<a class="readmorebtn" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" <?php echo $font_style; ?>><?php echo esc_html($read_more_text); ?></a>
									<?php }
								} else { ?>
									<div class="wphtsp-tl-content wphtsp-fullcontent" <?php echo $font_style; ?>><?php the_content(); ?></div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
					<div class="wphtsp-feature-img">
						<?php if(!empty($feat_image)) { ?>
							<?php if( $link ) { ?>
							<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><img src="<?php echo $feat_image; ?>" alt="" /></a>
							<?php } else { ?>
							<img src="<?php echo $feat_image; ?>" alt="" />
							<?php } ?>
						<?php } ?>
					</div>
				<?php } else { ?>
					<div class="wphtsp-feature-img">
						<?php if(!empty($feat_image)) { ?>
							<?php if( $link ) { ?>
							<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><img src="<?php echo $feat_image; ?>" alt="" /></a>
							<?php } else { ?>
							<img src="<?php echo $feat_image; ?>" alt="" />
							<?php } ?>
						<?php } ?>
					</div>
					<div class="wphtsp-content-wrapper <?php if(empty($feat_image)) { echo 'wphtsp-no-image';} ?>">
						<?php if( $show_title ) { ?>
						<h2 class="wphtsp-content-title">
							<?php if( $link ) { ?>
							<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" <?php echo $font_style; ?>><?php the_title(); ?></a>
							<?php } else { ?>
							<span <?php echo $font_style; ?>><?php the_title(); ?></span>
							<?php } ?>
						</h2>
						<?php } ?>

						<?php if ($show_date == 'true'){ ?>
							<div class="wphtsp-post-date"><span <?php echo $font_style; ?>><i class="fa fa-calendar" aria-hidden="true"></i><?php echo get_the_date($date_format); ?></span></div>
						<?php }
						if($showContent == "true") {  ?>
							<div class="wphtsp-content">
								<?php  if($showFullContent == "false" ) { ?>
									<div class="wphtsp-tl-content" <?php echo $font_style; ?>><?php echo wphts_pro_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>
									<?php if($showreadmore == 'true') { ?>
										<a class="readmorebtn" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" <?php echo $font_style; ?>><?php echo esc_html($read_more_text); ?></a>
									<?php }
								} else { ?>
									<div class="wphtsp-tl-content wphtsp-fullcontent" <?php echo $font_style; ?>><?php the_content(); ?></div>
							<?php } ?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	<?php endwhile; ?>
</div>