<?php
if($gridcol == '2') {
	$blogprogrid = "6";
} else if($gridcol == '3') {
	$blogprogrid = "4";
}  else if($gridcol == '4') {
	$blogprogrid = "3";
} else if ($gridcol == '1') {
	$blogprogrid = "12";
} else {
	$blogprogrid = "12";
}	
?>
<?php $height_css = ($image_height) ? 'height:'.$image_height.'px;' : '';?>
<?php if(0 == $newscount % 2 ) { ?>

	<div class="blog-grid wp-medium-<?php echo $blogprogrid; ?> wpcolumns <?php echo $css_class; ?>">
	<a class="link-overlay" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"></a>
		<div class="blog-grid-content">
		
			<div class="blog-image-bg" style="<?php echo $height_css; ?>">
				<?php if( !empty($feat_image) ) { ?>
				<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
				<?php } ?>

				<div class="image-overlay">
				 	<?php if($showCategory == "true" && $cate_name !='') { ?>
					<div class="blog-categories">	
						<?php echo $cate_name; ?>
					</div>
					<?php } ?>

					<h2 class="blog-title">
						<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
					</h2>
				</div>
			</div>
		
			<?php if($showDate == "true" || $showAuthor == 'true') { ?>
			<div class="blog-date">		
				<?php if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'wp-blog-and-widgets' ); ?> <?php the_author(); ?></span><?php } ?>
				<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
				<?php if($showDate == "true") { echo get_the_date(); } ?>
			</div>
			<?php } ?>

			<?php if($showContent == "true") { ?>
			<div class="blog-content">
			<?php  if($showFullContent == "false" ) { ?>
				
				<div><?php echo wpbaw_pro_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>

				<?php if($showreadmore == 'true') { ?>
					<a class="readmorebtn" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php esc_html_e($read_more_text); ?></a>
				<?php } 
			} else {
				the_content();
			} ?>
			</div>
			<?php } ?>

		</div>
	</div>

 <?php } else { ?>

 	<div class="blog-grid wp-medium-<?php echo $blogprogrid; ?> wpcolumns <?php echo $css_class; ?>">
 	<a class="link-overlay" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"></a>
		<div class="blog-grid-content" style="padding:15px 0 0 0;">	
			
			<?php if($showDate == "true" || $showAuthor == 'true') { ?>
			<div class="blog-date">		
				<?php if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'wp-blog-and-widgets' ); ?> <?php the_author(); ?></span><?php } ?>
				<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
				<?php if($showDate == "true") { echo get_the_date(); } ?>
			</div>
			<?php } ?>

			<?php if($showContent == "true") { ?>
				<div class="blog-content">
			<?php if($showFullContent == "false" ) { ?>
					
					<div><?php echo wpbaw_pro_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>

				<?php if($showreadmore == 'true') { ?>
					<a class="readmorebtn" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php esc_html_e($read_more_text); ?></a>
				<?php }
					} else {
						the_content();
					} ?>
				</div>
			<?php } ?>
		
			<div class="blog-image-bg" style="margin-bottom:0px;<?php echo $height_css; ?>">
				
				<?php if( !empty($feat_image) ) { ?>
				<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
				<?php } ?>

				<div class="image-overlay">
					<?php if($showCategory == "true" && $cate_name !='') { ?>
					<div class="blog-categories">	
						<?php echo $cate_name; ?>
					</div>
					<?php } ?>

					<h2 class="blog-title">
						<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
					</h2>
				</div>
			</div>

		</div>
	</div>

 <?php } ?>