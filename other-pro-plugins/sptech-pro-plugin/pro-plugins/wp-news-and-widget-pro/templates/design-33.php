<div class="news-slides">
	<div class="news-grid-content">

		<div class="news-image-bg" style="<?php echo $height_css; ?>">
			<?php if(!empty($post_featured_image)) { ?>
			<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
				<img src="<?php echo $post_featured_image; ?>" alt="<?php _e('Post Image', 'sp-news-and-widget'); ?>" />
			</a>
			<?php } ?>
		</div>

		<div class="news-inner-content">
			
			<?php if($showCategory == "true" && $cate_name !='') { ?>
			<div class="news-categories">	
				<?php echo $cate_name; ?>
			</div>
			<?php } ?>

			<h2 class="news-title">
				<?php 
					if($slides_column == '3') {
						$excerpttitle = get_the_title();
				?>
				
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php echo pro_title_limit_newswords($excerpttitle,13); ?>..</a>
				
				<?php } else { ?>
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
				<?php } ?>
			</h2>

			<?php if($showDate == "true") { ?>
			<div class="news-date">		
				<?php echo get_the_date(); ?>
			</div>
			<?php } ?>

			<?php if($showContent == "true") { ?>
			<div class="news-content">
				
				<div><?php echo wpnw_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>

				<?php if($showreadmore == 'true') { ?>
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" class="readmorebtn"><?php echo esc_html($read_more_text); ?></a>
				<?php } ?>
			</div>
			<?php } ?>

		</div>
		
	</div>
</div>