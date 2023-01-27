<div class="wppap-portfolio-content">

	<?php while ($query->have_posts()) : $query->the_post();

		$unique_thumb 			= wp_pap_pro_get_unique_thumbs();
		$gallery_imgs 			= get_post_meta( $post->ID, $prefix.'gallery_id', true );
		$arrows 				= get_post_meta( $post->ID, $prefix.'arrow_slider', true );
		$dots 					= get_post_meta( $post->ID, $prefix.'pagination_slider', true );
		$effect 				= get_post_meta( $post->ID, $prefix.'animation_slider', true );
		$slide_to_show 			= get_post_meta( $post->ID, $prefix.'slide_to_show_slider', true );
		$loop 					= get_post_meta( $post->ID, $prefix.'loop_slider', true );
		$autoplay 				= get_post_meta( $post->ID, $prefix.'autoplay_slider', true );
		$autoplayspeed			= get_post_meta( $post->ID, $prefix.'autoplayspeed_slider', true );
		$speed 					= get_post_meta( $post->ID, $prefix.'speed_slider', true );
		$project_url 			= wp_pap_pro_get_post_link($post->ID);
		$cat_links 				= array();
		$tag_links				= array();

		$terms 	= get_the_terms( $post->ID, WP_PAP_PRO_CAT );
		$tags 	= get_the_terms( $post->ID, WP_PAP_PRO_TAG );

		// Portfolio Category
		if( $terms ) {
			foreach ( $terms as $term ) {
				$cat_links[] = '<span>'.$term->name.'</span>';
			}
		}
		$cate_name = join( ", ", $cat_links );

		// Portfolio tag
		if($tags) {
			foreach ( $tags as $tag ) {
				$tag_links[] = '<span>'.$tag->name.'</span>';
			}
		}
		$tag_name = join( ", ", $tag_links );

		// Slider configuration
		$slider_conf = compact('dots', 'arrows', 'effect', 'slide_to_show', 'loop', 'autoplay', 'autoplayspeed', 'speed', 'rtl');
	?>

		<div class="wppap-popup-main-wrapper" id="wppap-popup-<?php echo $unique_thumb; ?>">

			<a href="javascript:void(0);" class="wp-pap-popup-close wp-pap-close-btn mfp-close" title="<?php _e('Close (Esc)', 'portfolio-and-projects'); ?>"></a><?php

			if( !empty($gallery_imgs) ) { ?>
				<div id="wppap-popup-slider-<?php echo $unique_thumb; ?>" class="wppap-popup-img-grp wppap-img-grp">
				<?php
					foreach ($gallery_imgs as $img_key => $img_data) {

						$gallery_img_src 	= wp_pap_pro_get_image_src($img_data, 'full');
						$img_alt_text 		= get_post_meta( $img_data, '_wp_attachment_image_alt', true );
						$img_title			= get_the_title($img_data);
				?>
						<div class="wppap-popup-img-slick">
							<img src="<?php echo $gallery_img_src; ?>" alt="<?php echo wp_pap_pro_esc_attr($img_alt_text); ?>" />
							<?php if ($img_title) { ?>
								<div class="wppap-popup-img-info"><?php echo $img_title; ?></div>
							<?php } ?>
						</div>
					<?php } // End of for each ?>
				</div>
				<div class="wppap-slider-conf" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
			<?php } ?>

			<div class="wppap-pop-other-content">

				<div class="wppap-popup-portfolio-title"><?php the_title(); ?></div>
				<div class="wppap-popup-portfolio-content"><?php the_content(); ?></div>

				<?php if(!empty($tag_name) || !empty($cate_name) || $project_url) { ?>
				<table class="wppap-portfolio-meta-tbl">
					<tbody>
						<?php if(!empty($cate_name)) { ?>
						<tr>
							<th><?php _e('Categories', 'portfolio-and-projects'); ?> :</th>
							<td>
								<div class="wppap-popup-cats">
									<?php echo $cate_name; ?>
								</div>
							</td>
						</tr>
						<?php } ?>

						<?php if(!empty($tag_name)) { ?>
						<tr>
							<th><?php _e('Skills', 'portfolio-and-projects'); ?> :</th>
							<td>
								<div class="wppap-popup-tags">
									<?php echo $tag_name; ?>
								</div>
							</td>
						</tr>
						<?php } ?>

						<?php if($project_url) { ?>
						<tr>
							<th><?php _e('URL', 'portfolio-and-projects'); ?> :</th>
							<td>
								<a href="<?php echo $project_url; ?>" class="wppap-project-url-btn" target="<?php echo $link_target; ?>"><?php _e('View Project', 'portfolio-and-projects') ?></a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php } ?>
			</div>
		</div>
	<?php endwhile; ?>
</div>