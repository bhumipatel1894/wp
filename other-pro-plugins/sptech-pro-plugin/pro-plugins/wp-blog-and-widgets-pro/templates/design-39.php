<div class="blog-slides">
<a class="link-overlay" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"></a>  
	<div class="blog-grid-content">
		<div class="blog-overlay">
<?php $height_css = ($image_height) ? 'height:'.$image_height.'px;' : '';?>
			<div class="blog-image-bg" style="<?php echo $height_css; ?>">
				<?php if( !empty($feat_image) ) { ?>
				<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
				<?php } ?>

			</div>

			<div class="blog-short-content">
				<div class="bottom-content">

				<?php if($showCategory == "true" && $cate_name !='') { ?>
				<div class="blog-categories">	
					<?php echo $cate_name; ?>
				</div>
				<?php } ?>

				 <h2 class="blog-title">
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
				</h2>

				<?php if($showDate == "true" || $showAuthor == 'true') { ?>
				<div class="blog-date">		
					<?php if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'wp-blog-and-widgets' ); ?> <?php the_author(); ?></span><?php } ?>
					<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
					<?php if($showDate == "true") { echo get_the_date(); } ?>
				</div>
				<?php } ?>

				</div>
			</div>

		</div>
	</div>
</div>