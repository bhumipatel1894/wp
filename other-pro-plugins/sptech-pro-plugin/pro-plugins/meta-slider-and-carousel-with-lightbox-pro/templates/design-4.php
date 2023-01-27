<div class="msacwl-slide" data-item-index="<?php echo $count; ?>">
	
	<div class="msacwl-img-wrap" <?php echo $slider_height_css; ?>>
		<?php if( $popup ) { ?>
		<a class="msacwl-img-link" href="<?php echo $gallery_img_src; ?>"></a>
		<?php } ?>
		<img class="msacwl-img" src="<?php echo $gallery_img_src ?>" title="<?php echo wp_igsp_pro_esc_attr($post_meta_data->post_title); ?>" alt="<?php echo wp_igsp_pro_esc_attr($image_alt_text); ?>" />
	</div>
	
	<?php if($show_title == 'true' || $show_caption == 'true') { ?>
	
		<div class="msacwl-gallery-container">
	
			<?php if($show_title == 'true') { ?>
				<div class="msacwl-image-title"><?php echo $post_meta_data->post_title; ?></div>
			<?php }
	
		 	if($show_caption == 'true' && $image_caption != '') { ?>
				<div class="msacwl-image-caption"><?php echo $image_caption; ?></div>
		 	<?php }
	
		 	if($show_description == 'true' && $image_content != '') { ?>
				<div class="msacwl-image-desc">
					<?php 
						echo $image_content;
					?>
				</div>
		 	<?php } ?>
		</div>
	<?php } ?>
</div>