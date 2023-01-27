<div class="news-slides">
<a class="link-overlay" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"></a>  
	<div class="news-grid-content">
		<div class="news-overlay">

			<div class="news-image-bg" style="<?php echo $height_css; ?>">
				<?php if( !empty($post_featured_image) ) { ?>
				<img src="<?php echo $post_featured_image; ?>" alt="<?php the_title(); ?>" />
				<?php } ?>
			</div>

			<div class="news-short-content">
				<div class="bottom-content">

				<?php if($showCategory == "true") { ?>
				<div class="news-categories">	
					<?php echo $cate_name; ?>
				</div>
				<?php } ?>

				 <h2 class="news-title">
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
				</h2>

				<?php if($showDate == "true") { ?>
				<div class="news-date">
					<?php if($showDate == "true") { echo get_the_date(); } ?>
				</div>
				<?php } ?>

				</div>
			</div>

		</div>
	</div>
</div>