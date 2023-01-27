<div class="wphtsp-timeline-block">

    <div class="wphtsp-timeline-content <?php if($i != 1 && $animation != 'no-animation'){ echo 'wphtsp-is-hidden'; } ?>">
        <div class="wphtsp-timeline-img-wrapper">
            <div class="wphtsp-timeline-img">
                <?php if(!empty($feat_image)) { ?>
                <?php if( $link ) { ?>
                <a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><img src="<?php echo $feat_image; ?>" alt="" /></a>
                <?php } else { ?>
                <img src="<?php echo $feat_image; ?>" alt="" />
                <?php } ?>
                <?php } ?>
            </div>
        </div>

        <div class="wphtsp-post-details" <?php echo $background_style; ?>>

            <?php if( $show_title ) { ?>
            <h2 class="wphtsp-content-title">
                <?php if( $link ) { ?>
                <a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" <?php echo $font_style; ?>><?php the_title(); ?></a>
                <?php } else { ?>
                <span <?php echo $font_style; ?>><?php the_title(); ?></span>
                <?php } ?>
            </h2>
            <?php } ?>

            <?php if ($show_date == 'true') { ?>
            <div class="wphtsp-post-date" <?php echo $font_style; ?>><i class="fa fa-calendar"></i> <?php echo get_the_date($date_format); ?></div>
            <?php } ?>

            <?php if($showContent == "true") { ?>
            <div class="wphtsp-content">
                <?php  if($showFullContent == "false" ) { ?>        
                <div class="wphtsp-content-wraper" <?php echo $font_style; ?>><?php echo wphts_pro_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>
                <?php } else { ?>
                <div class="wphtsp-fullcontent" <?php echo $font_style; ?>><?php the_content(); ?></div>
                <?php } ?>
            </div>
            <?php } ?>

            <?php if($showreadmore == 'true') { ?>    
            <a class="wphtsp-read-more" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" <?php echo $font_style; ?>><?php echo esc_html($read_more_text); ?></a>
            <?php } ?>
        </div>
    </div>

    <div class="wphtsp-timeline-date <?php if($i != 1 && $animation != 'no-animation') { echo 'wphtsp-is-hidden'; } if(!empty($tl_cust_icon)){echo "wphtsp-custom-icon";} ?>">
        <div class="wphtsp-date">
            <div class="wphtsp-icon-wrp">
                <?php if( $link ) { ?>
                <a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php echo $display_icon; ?></a>
                <?php } else {
                echo $display_icon;
                } ?>
            </div>
        </div>
    </div>
</div>