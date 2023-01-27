<?php 
if($gridcol == '2') {
	$post_grid = "6";
} else if($gridcol == '3') {
	$post_grid = "4";
}  else if($gridcol == '4') {
	$post_grid = "3";
} else if ($gridcol == '1') {
	$post_grid = "12";
} else {
	$post_grid = "12";
}
$height_css = ($image_height) ? 'height:'.$image_height.'px;' : '';
?>
<div class="wpspw-post-grid wpspw-medium-<?php echo $post_grid; ?> wpspw-columns <?php echo $css_class; ?>">
	<a class="wpspw-link-overlay" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"></a>
	<div class="wpspw-post-overlay">
		<div class="wpspw-post-image-bg" style="<?php echo $height_css; ?>">
			<?php if( !empty($feat_image) ) { ?>
				<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
			<?php } ?>
		</div>
		<div class="wpspw-post-grid-content">
			<div class="wpspw-post-content">
				<?php if($showCategory == "true" && $cate_name !='') { ?>
					<div class="wpspw-post-categories">
						<?php echo $cate_name; ?>
					</div><!-- end .wpspw-post-categories -->
				<?php } ?>
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
			</div><!-- end .wpspw-post-content -->
		</div><!-- end .wpspw-post-grid-content -->
	</div><!-- end .wpspw-post-overlay -->
</div><!-- end .wpspw-post-grid -->