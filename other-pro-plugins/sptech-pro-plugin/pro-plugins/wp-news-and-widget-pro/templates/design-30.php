<?php
if($gridcol == '2') {
	$newsprogrid = "6";
} else if($gridcol == '3') {
	$newsprogrid = "4";
}  else if($gridcol == '4') {
	$newsprogrid = "3";
} else if ($gridcol == '1') {
	$newsprogrid = "12";
} else {
	$newsprogrid = "12";
}
?>

<?php if(0 == $newscount % 2 ) { ?>

	<div class="news-grid wpnews-medium-<?php echo $newsprogrid; ?> wpnews-columns <?php echo $css_class; ?>">
		<div class="news-grid-content">
			
			<div class="news-image-bg" style="<?php echo $height_css; ?>">

				<?php if(!empty($post_featured_image)) { ?>
				<img src="<?php echo $post_featured_image; ?>" alt="<?php _e('Post Image', 'sp-news-and-widget'); ?>" />
				<?php } ?>
				
				<div class="image-overlay">

				 	<?php if($showCategory == "true") { ?>
					<div class="news-categories">	
						<?php echo $cate_name; ?>
					</div>
					<?php } ?>

					<h2 class="news-title">
						<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
					</h2>
				</div>
			</div>
			
			<?php if($showDate == "true") { ?>
			<div class="news-date">
				<?php echo get_the_date(); ?>
			</div>
			<?php } ?>

			<?php if($showContent == "true") { ?>
			<div class="news-content">				
				<?php  if($showFullContent == "false" ) { ?>
					
					<div><?php echo wpnw_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>

					<?php if($showreadmore == 'true') { ?>
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" class="readmorebtn"><?php echo esc_html($read_more_text); ?></a>
					<?php }

				} else {
					the_content();
				} ?>
			</div>
			<?php } ?>

		</div>
	</div>

 <?php } else { ?>

 	<div class="news-grid wpnews-medium-<?php echo $newsprogrid; ?> wpnews-columns <?php echo $css_class; ?>">
		<div class="news-grid-content" style="padding:15px 0 0 0;">	
			
			<?php if($showDate == "true") {  ?>	
			<div class="news-date">		
				<?php echo get_the_date(); ?>
			</div>
			<?php } ?>

			<?php if($showContent == "true") { ?>
			<div class="news-content">				
				<?php  if($showFullContent == "false" ) { ?>
					
					<div><?php echo wpnw_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>

				<?php if($showreadmore == 'true') { ?>
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" class="readmorebtn"><?php echo esc_html($read_more_text); ?></a>
				<?php }
				} else {
					the_content();
				} ?>
			</div>
			<?php } ?>
				
			<div class="news-image-bg" style="<?php echo $height_css; ?> margin-bottom:0px;">
				
				<?php if(!empty($post_featured_image)) { ?>
				<img src="<?php echo $post_featured_image; ?>" alt="<?php _e('Post Image', 'sp-news-and-widget'); ?>" />
				<?php } ?>
			 	
			 	<div class="image-overlay">
				 	<?php if($showCategory == "true") { ?>
					<div class="news-categories">	
						<?php echo $cate_name; ?>
					</div>
					<?php } ?>
							 	
				 	<h2 class="news-title">
						<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
					</h2>

				</div>
			</div>
			
		</div>
	</div>

<?php } ?>