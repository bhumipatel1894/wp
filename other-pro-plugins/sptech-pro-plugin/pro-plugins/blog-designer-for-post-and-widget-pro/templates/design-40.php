<?php 
$dynamic_height = ($grid_count == 1) ? $image_height : ($image_height/2);
$height_css = ($dynamic_height) ? 'height:'.$dynamic_height.'px;' : '';
if( $grid_count == 1 ) { ?>
	<div class="wpspw-grid-slider-wrp">
<?php } ?>
	
	<div class="wpspw-post-slides wpspw-clr-<?php echo $grid_count; ?> wpspw-medium-4 wpspw-columns">
		<a class="wpspw-link-overlay" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"></a>
		<div class="wpspw-post-grid-content">
			<div class="wpspw-post-overlay">
				<div class="wpspw-post-image-bg" style="<?php echo $height_css; ?>">
					<?php if( !empty($feat_image) ) { ?>
						<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
					<?php } ?>
				</div><!-- end .wpspw-post-image-bg -->
				<div class="wpspw-post-short-content">
					<?php if($showCategory == "true" && $cate_name !='') { ?>
						<div class="wpspw-post-categories">
							<?php echo $cate_name; ?>
						</div><!-- end .wpspw-post-categories -->
					<?php } ?>
					<div class="wpspw-bottom-content">
						<h2 class="wpspw-post-title">
							<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
						</h2>
						<?php if($showDate == "true" || $showAuthor == 'true' || $show_comments =="true") { ?>
							<div class="wpspw-post-date">
								<?php if($showAuthor == 'true') { ?>
									<span class="wpspw-user-img"><img src="<?php echo WPSPW_PRO_URL; ?>assets/images/user-white.svg" alt=""> <?php the_author(); ?></span>
								<?php } ?>
								<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;' : '' ?>
								<?php if($showDate == "true") { ?>
									<span class="wpspw-time"> <img src="<?php echo WPSPW_PRO_URL; ?>assets/images/calendar-white.svg" alt=""> <?php echo get_the_date(); ?> </span>
								<?php } ?>
								<?php echo ($showAuthor == 'true' && $showDate == 'true' && $show_comments == 'true') ? '&nbsp;' : '' ?>
								<?php if(!empty($comments) && $show_comments == 'true') { ?>
									<span class="wpswp-post-comments">
										<img src="<?php echo WPSPW_PRO_URL; ?>assets/images/comment-bubble-white.svg" alt="" />
										<a href="<?php the_permalink(); ?>#comments"><?php echo $comments.' '.$reply;  ?></a>
									</span>
								<?php } ?>	
							</div><!-- end .wpspw-post-date -->
						<?php } ?>
						<?php if(!empty($tags) && $show_tags == 'true') { ?>
							<div class="wpswp-post-tags">
								<img src="<?php echo WPSPW_PRO_URL; ?>assets/images/price-tag-white.svg" alt="" />
								<?php echo $tags;  ?>
							</div><!-- end .wpswp-post-tags -->
						<?php } ?>
					</div><!-- end .wpspw-bottom-content -->
				</div><!-- end .wpspw-post-short-content -->
			</div><!-- end .wpspw-post-overlay -->
		</div><!-- end .wpspw-post-grid-content -->
	</div><!-- end .wpspw-post-slides -->
	<?php
	if( $grid_count == 5 || ( $post_count == $count ) ) {
	$grid_count = 0;
	?>
</div><!-- end .wpspw-grid-slider-wrp -->
<?php } ?>