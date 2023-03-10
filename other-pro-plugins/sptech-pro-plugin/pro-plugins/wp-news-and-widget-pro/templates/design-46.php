<?php 

$dynamic_height = ($grid_count == 1) ? $image_height : ($image_height/2);
$height_css = ($dynamic_height) ? 'height:'.$dynamic_height.'px;' : '';
$dynamic_class = ($grid_count == 1) ? 'wpnews-medium-8' : 'wpnews-medium-4'; ?>

	<div class="news-slides wpnaw-clr-<?php echo $grid_count; ?> <?php echo $dynamic_class; ?> wpnews-columns">
	<a class="link-overlay" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"></a>
		<div class="news-grid-content">
			<div class="news-overlay">

				<div class="news-image-bg" style="<?php echo $height_css; ?>">
					<?php if( !empty($post_featured_image) ) { ?>
					<img src="<?php echo $post_featured_image; ?>" alt="<?php the_title(); ?>" />
					<?php } ?>
				</div>

				<div class="news-short-content">
				<?php if($showCategory == "true") { ?>
					<div class="news-categories">	
						<?php echo $cate_name; ?>
					</div>
					<?php } ?>
					<div class="bottom-content">

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

<?php
	if( $grid_count == 3 || ( $post_count == $count ) ) {
		$grid_count = 0;
 } ?>