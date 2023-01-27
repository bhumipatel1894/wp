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

<div class="news-grid wpnews-medium-<?php echo $newsprogrid; ?> wpnews-columns <?php echo $css_class; ?>">
	<div class="news-list-content">

		<div class="wpnews-medium-5 wpnews-columns">
			<div class="news-image-bg" style="<?php echo $height_css; ?>">
				<?php if ( $post_featured_image ) { ?>
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
					<img src="<?php echo $post_featured_image; ?>" alt="<?php the_title(); ?>" />
				</a>
				<?php } ?>
			</div>
		</div>

		<div class="wpnews-medium-7 wpnews-columns">
			<div class="news-content-all">
			<h2 class="news-title">
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
			</h2>

			<?php if($showCategory == "true") { ?>
			<div class="news-categories">	
				<?php echo $cate_name; ?>
			</div>
			<?php } ?>

			<?php if($showDate == "true") { ?>	
			<div class="news-date">
				<?php if($showDate == "true") { echo get_the_date(); } ?>
			</div>
			<?php } ?>
			
			<?php if($showContent == "true") { ?>
			<div class="news-content">
			<?php  if($showFullContent == "false" ) { ?>
				
				<div><?php echo wpnw_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>
				
				<?php if($showreadmore == 'true') { ?>
					<a class="readmorebtn" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php echo esc_html( $read_more_text ); ?></a>
				<?php } 
				 } else { 
					the_content();
				} ?>
			</div>
			<?php } ?>
			
			</div>		
		</div>
		
	</div>
</div>