<div class="featured-content-main <?php echo $css_class; ?> <?php echo $grid_cls; ?>">

	<?php if( $fc_icon ) { ?>
    <div class="featured-content-image"> 
		<div class="fa-icon">
			<?php if($sliderurl != '') { ?>
				
				<a href="<?php echo $sliderurl; ?>" target="<?php echo $link_target; ?>"><?php echo '<i style="color:'.$faIconcolor.'" class="'.$fc_icon.'"></i>'; ?></a>

			<?php } else { ?>

				<?php echo '<i style="color:'.$faIconcolor.'" class="'.$fc_icon.'"></i>'; ?>
				
			<?php } ?>
		</div><!-- end .fa-icon -->
	</div><!-- end .featured-content-image -->
	<?php } ?>

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
	
</div><!-- end .featured-content-main -->