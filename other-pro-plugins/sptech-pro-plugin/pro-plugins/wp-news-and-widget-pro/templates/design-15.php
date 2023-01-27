<div class="news-slides">  
	<div class="news-grid-content">
		<div class="news-overlay">

		<?php if(0 == $newscount % 2 ) { ?>
				
			<div class="news-image-bg withimage" style="<?php echo $height_css; ?>">
				
				<?php if( !empty($post_featured_image) ) { ?>
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
					<img src="<?php echo $post_featured_image; ?>" alt="<?php the_title(); ?>" />
				</a>
				<?php } ?>

				<?php if($showCategory == "true" && $cate_name !='') { ?>
				<div class="news-categories">
					<?php echo $cate_name; ?>
				</div>
				<?php } ?>

				<div class="news-content">
					<h2 class="news-title">
						<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
					</h2>

					<?php if($showDate == "true") { ?>
					<div class="news-date">
						<?php echo get_the_date(); ?>
					</div>
					<?php } ?>
				</div>

			</div>
			
		<?php } else { ?>

			<div class="news-short-content withoutimgblue" style="<?php echo $height_css; ?>">

				<?php if($showCategory == "true" && $cate_name !='') { ?>
					<div class="news-categories">	
					<?php echo $cate_name; ?>
					</div>
				<?php } ?>

				<div class="bottom-content">
					<h2 class="news-title">
						<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
					</h2>

					<?php if($showContent == "true") { ?>
					<div class="news-content">
						
						<div><?php echo wpnw_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>

						<?php if($showreadmore == 'true') { ?>
						<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" class="readmorebtn"><?php echo esc_html($read_more_text); ?></a>
						<?php } ?>

					</div>
					<?php } ?>

					<?php if($showDate == "true") {  ?>	
					<div class="news-date">		
					<?php echo get_the_date(); ?>
					</div>
					<?php } ?>
				</div>
			</div>
			
		<?php } ?>
		
		</div>
	</div>
</div>