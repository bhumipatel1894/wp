<?php
	$featured_medium_image = wpbaw_pro_get_post_featured_image( $post->ID, 'medium' );
?>
<div class="blog-grid wp-medium-12 wpcolumns <?php echo $css_class; ?>">
	
	<div class="wp-medium-4 wpcolumns">

		<?php if($showDate == "true" || $showAuthor == 'true') { ?>
		<div class="blog-date">		
			<?php if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'wp-blog-and-widgets' ); ?> <?php the_author(); ?></span><?php } ?>
			<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
			<?php if($showDate == "true") { echo get_the_date(); } ?>
		</div>
		<?php }  ?>

	 	<h2 class="blog-title">
			<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
		</h2>
		
		<?php if($showCategory == "true" && $cate_name !='') { ?>
		<div class="blog-categories">	
			<?php echo $cate_name; ?>
		</div>
		<?php } ?>

	</div>
	
	<div class="wp-medium-8 wpcolumns">

		<?php if ( has_post_thumbnail() ) { ?>
		<?php $height_css = ($image_height) ? 'height:'.$image_height.'px;' : '';?>
		<div class="blog-image-bg" style="<?php echo $height_css; ?>">
			<?php if( !empty($featured_medium_image) ) { ?>
			<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
				<img src="<?php echo $featured_medium_image; ?>" alt="<?php the_title(); ?>" />
			</a>
			<?php } ?>
		</div>
		<?php } ?>

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

	</div>

</div>