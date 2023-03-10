<?php
$dynamic_height = ($grid_count == 1) ? $image_height : ($image_height/2);
$height_css 	= ($dynamic_height) ? 'height:'.$dynamic_height.'px;' : '';
$dynamic_class 	= ($grid_count == 1) ? 'wp-medium-8' : 'wp-medium-4';
?>

<div class="blog-slides wpbaw-clr-<?php echo $grid_count; ?> <?php echo $dynamic_class; ?> wpcolumns">
	<a class="link-overlay" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"></a>
		<div class="blog-grid-content">
			<div class="blog-overlay">

				<div class="blog-image-bg" style="<?php echo $height_css; ?>">
					<?php if( !empty($feat_image) ) { ?>
					<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
					<?php } ?>
				</div>

				<div class="blog-short-content">
				<?php if($showCategory == "true" && $cate_name !='') { ?>
					<div class="blog-categories">	
						<?php echo $cate_name; ?>
					</div>
					<?php } ?>
					<div class="bottom-content">

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

<?php
	if( $grid_count == 3 || ( $post_count == $count ) ) {
		$grid_count = 0;
 } ?>