<?php $height_css = ($image_height) ? 'height:'.$image_height.'px;' : '';?>
<div class="wpspw-post-slides">
	
	<div class="wpspw-post-grid-content">
	
		<div class="wpspw-post-image-bg" style="<?php echo $height_css; ?>">
		
			<?php if( !empty($feat_image) ) { ?>
			
				<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
			
			<?php } ?>
		</div><!-- end .wpspw-post-image-bg  -->

		<div class="wpspw-post-detail-wrap">
		
			<?php if($showCategory == "true") { ?>
			
				<div class="wpspw-post-categories">

					<?php echo $cate_name; ?>
				</div><!-- end .wpspw-post-categories -->
			<?php } ?>

			<h2 class="wpspw-post-title">
			
				<a href="<?php echo $post_link; ?>"><?php the_title(); ?></a>
			</h2>

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
					
			<div class="wpspw-post-content">
				
				<div>
						
					<?php echo wpspw_pro_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?>
				</div>
				<?php
				if($showreadmore == 'true') { ?>
					
					<a class="wpspw-readmorebtn" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php echo esc_html($read_more_text); ?></a>
				<?php } ?>
			</div><!-- end .wpspw-post-content  -->
		</div><!-- end .wpspw-post-inner-content -->
	</div><!--  -->
</div><!-- end .wpspw-post-slides -->