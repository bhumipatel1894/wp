<?php $height_css = ($image_height) ? 'height:'.$image_height.'px;' : '';

if($newscount == "0") { ?>
	
	<div class="wpspw-medium-6 wpspw-columns wpspw-responsive-padding">
	
		<div class="wpspw-post-image-bg" style="<?php echo $height_css; ?>">
	
		<?php if( !empty($feat_image) ) { ?>
	
			<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
		<?php } ?>

		<div class="wpspw-post-fetured-content">
	
			<div class="wpspw-post-inner-content">
	
				<?php if($showCategory == "true") { ?>
	
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

				</div><!-- end .wpspw-post-inner-content -->
			</div><!-- end .wpspw-post-fetured-content -->
		</div><!-- end .wpspw-post-image-bg -->
	</div><!-- end .wpspw-medium-6 -->
<?php } else { 

	$medium_image = wpspw_pro_get_post_featured_image( $post->ID, 'medium' );
	
	$medium_image = ($medium_image) ? $medium_image : $default_img;

	?>
	
	<div class="wpspw-medium-6 wpspw-columns wpspw-flotRight">
		
		<div class="wpspw-post-right-block wpspw-medium-12 wpspw-columns">
		
			<div class="wpspw-medium-3 wpspw-columns">
		
				<div class="wpspw-post-image-bg" style="<?php echo $height_css; ?>">
		
					<?php if( !empty($medium_image) ) { ?>
						
						<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
						
							<img src="<?php echo $medium_image; ?>" alt="<?php the_title(); ?>" />
						</a>
					<?php } ?>
				</div><!-- end .wpspw-post-image-bg -->
			</div><!-- end .wpspw-medium-3 -->

			<div class="wpspw-medium-9 wpspw-columns">
		
				<?php if($showCategory == "true") { ?>
		
					<div class="wpspw-post-categories">	
			
						<?php echo $cate_name; ?>
					</div><!-- end .wpspw-post-categories -->
				<?php } ?>
				
				<h3 class="wpspw-post-title">
		
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
				</h3>

				<?php if($showDate == "true" || $showAuthor == 'true' || $show_comments =="true") { ?>
					<div class="wpspw-post-date">
						<?php if($showAuthor == 'true') { ?>
							<span class="wpspw-user-img"><img src="<?php echo WPSPW_PRO_URL; ?>assets/images/user.svg" alt=""> <?php the_author(); ?></span>
						<?php } ?>
						<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;' : '' ?>
						<?php if($showDate == "true") { ?>
							<span class="wpspw-time"> <img src="<?php echo WPSPW_PRO_URL; ?>assets/images/calendar.svg" alt=""> <?php echo get_the_date(); ?> </span>
						<?php } ?>
						<?php echo ($showAuthor == 'true' && $showDate == 'true' && $show_comments == 'true') ? '&nbsp;' : '' ?>
						<?php if(!empty($comments) && $show_comments == 'true') { ?>
							<span class="wpswp-post-comments">
								<img src="<?php echo WPSPW_PRO_URL; ?>assets/images/comment-bubble.svg" alt="" />
								<a href="<?php the_permalink(); ?>#comments"><?php echo $comments.' '.$reply;  ?></a>
							</span>
						<?php } ?>	
					</div><!-- end .wpspw-post-date -->
				<?php } ?>

				<?php if(!empty($tags) && $show_tags == 'true') { ?>

					<div class="wpswp-post-tags">
						
						<img src="<?php echo WPSPW_PRO_URL; ?>assets/images/price-tag.svg" alt="" />
						
						<?php echo $tags;  ?>
					</div><!-- end .wpswp-post-tags -->
				<?php } ?>
			</div><!-- end .wpspw-medium-9 -->
		</div><!-- end .wpspw-post-right-block -->
	</div><!-- end .wpspw-medium-6 -->
<?php } ?>