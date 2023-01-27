<div class="featured-content-main <?php echo $css_class; ?> <?php echo $grid_cls; ?>">
	<div class="box-with-icon-left wp-fcasp-clearfix">
		
		<?php if($fc_icon != '') { echo '<i style="color:'.$faIconcolor.'" class="'.$fc_icon.' icon-big"></i>'; } ?>

		<div class="featured-content">
			
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

		</div><!-- end .featured-content -->

	</div><!-- end .box-with-icon-left -->
</div><!-- end .featured-content-main -->