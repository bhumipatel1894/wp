<?php
$fcasp_cnt_cls = ($fc_icon || has_post_thumbnail()) ? 'wp-fcasp-medium-9' : 'wp-fcasp-medium-12';
?>
<div class="featured-content-main <?php echo $css_class; ?> <?php echo $grid_cls; ?>">
	<div class="featured-wraper">
		<?php if( $fc_icon || has_post_thumbnail() ) { ?>
			<div class="featured-content-image wp-fcasp-medium-3 wp-fcasp-columns text-center <?php echo $imagestyle; ?>">
				<?php if($sliderurl != '') { ?>			
					<a href="<?php echo $sliderurl; ?>" target="<?php echo $link_target; ?>"><?php if($fc_icon != '') { echo '<i style="color:'.$faIconcolor.'" class="fcasp-effect '.$fc_icon.'"></i>'; } else { the_post_thumbnail(array(100,100)); } ?></a>
				<?php } else { ?>
					<?php if($fc_icon != '') { echo '<i style="color:'.$faIconcolor.'" class="fcasp-effect '.$fc_icon.'"></i>'; } else { the_post_thumbnail(array(100,100)); } ?>	
				<?php } ?>
			</div><!-- end .featured-content-image -->
		<?php } ?>
		<div class="<?php echo $fcasp_cnt_cls; ?> wp-fcasp-columns text-center-only-small">
			<div class="wp-fcasp-title">
				<?php if($sliderurl != '') { ?>
					<a href="<?php echo $sliderurl; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
				<?php } else {
					the_title();
				} ?>
			</div>

			<?php $fcontent = wp_fcasp_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?>

			<?php if($show_content == "true" && !empty($fcontent)) { ?>
				<div class="featured_short_content">
					<div class="sub-content">
						<?php echo $fcontent; ?>
					</div>
				</div><!-- end .featured_short_content -->
			<?php } ?>
			<?php if($display_read_more == 'true' && $sliderurl != '') { ?>
				<div class="featured-read-more text-left text-center-only-small">					
					<a href="<?php echo $sliderurl; ?>" target="<?php echo $link_target; ?>"><?php esc_html_e( $read_more_text ); ?></a>
				</div>
			<?php } ?>
		</div><!-- end .featured-content -->
	</div><!-- end .featured-wraper -->
</div><!-- end .featured-content-main -->