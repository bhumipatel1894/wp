<?php
/**
 * 'wpcdt-countdown' Shortcode
 * 
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wpcdt_pro_countdown_timer( $atts, $content = null ) {
	
	// Shortcode Parameter
	extract(shortcode_atts(array(
		'id' 		=> '',
		'timezone' 	=> '',
	), $atts));

	$id = !empty($id) ? $id : '';	

	// Simply return if id is not there
	if( empty($id) ) {
		return $content;
	}

	// Enqueue required script
	wp_enqueue_script( 'wpcdt-countereverest-js' );
	wp_enqueue_script( 'wpcdt-timecircle-js' );
	wp_enqueue_script( 'wpcdt-public-js' );

	// Taking some variables
	$unique = wpcdt_pro_get_unique();
	$prefix = WPCDT_PRO_META_PREFIX;

	// Getting general Meta
	$shortcode_designs 		= wpcdt_pro_designs();
	$count_date 			= get_post_meta($id, $prefix.'timer_date', true);
	$style 					= get_post_meta($id, $prefix.'design_style', true);
	$background_pref 		= get_post_meta($id, $prefix.'background_pref', true );
	$completion_text 		= get_post_meta($id, $prefix.'completion_text', true );
	$show_title 			= get_post_meta($id, $prefix.'show_title', true );
	$show_title 			= ($show_title == 'false') ? 'false' : 'true' ;
	$design 				= ($style && (array_key_exists(trim($style), $shortcode_designs))) ? trim($style) : 'design-1';
	$status 				= get_post_status( $id );
	
	// Shortcode file
	$design_file_path 		= WPCDT_PRO_DIR . '/templates/' . $design . '.php';
	$design_file 			= (file_exists($design_file_path)) ? $design_file_path : '';

	// Check if Integrate with E-commerce
	$is_ecommerce 			= get_post_meta( $id, $prefix.'is_ecommerce', true );
	
	// Getting WooCommerce meta
	$woo_exist 				= (class_exists( 'WooCommerce' )) ? 1 : 0;
	$woo_coupons_dropdown 	= get_post_meta( $id, $prefix.'woo_coupons_dropdown', true );
	$woo_expiry_date 		= get_post_meta( $woo_coupons_dropdown, 'expiry_date', true );

	// Getting EDD meta
	$edd_exist 				= (class_exists( 'Easy_Digital_Downloads' )) ? 1 : 0;
	$edd_coupons_dropdown 	= get_post_meta( $id, $prefix.'edd_coupons_dropdown', true );
	$edd_expiry_date 		= get_post_meta( $edd_coupons_dropdown, '_edd_discount_expiration', true );

	// Getting Common variables
	$textcolor				= get_post_meta($id, $prefix.'timertext_color', true);
	$digitcolor 			= get_post_meta($id, $prefix.'timerdigit_color', true );
	$is_days				= get_post_meta($id, $prefix.'is_timerdays', true);
	$is_hours				= get_post_meta($id, $prefix.'is_timerhours', true);
	$is_minutes				= get_post_meta($id, $prefix.'is_timerminutes', true);
	$is_seconds				= get_post_meta($id, $prefix.'is_timerseconds', true);
	$days_text 				= get_post_meta($id, $prefix.'timer_day_text', true);
	$hours_text 			= get_post_meta($id, $prefix.'timer_hour_text', true);
	$minutes_text 			= get_post_meta($id, $prefix.'timer_minute_text', true);
	$seconds_text 			= get_post_meta($id, $prefix.'timer_second_text', true);

	// Getting Circle 1 Variables
	$animation				= get_post_meta($id, $prefix.'timercircle_animation', true);
	$circlewidth			= get_post_meta($id, $prefix.'timercircle_width', true);
	$backgroundwidth		= get_post_meta($id, $prefix.'timerbackground_width', true);
	$backgroundcolor		= get_post_meta($id, $prefix.'timerbackground_color', true);
	$daysbackgroundcolor	= get_post_meta($id, $prefix.'timerdaysbackground_color', true);
	$hoursbackgroundcolor	= get_post_meta($id, $prefix.'timerhoursbackground_color', true);
	$minutesbackgroundcolor	= get_post_meta($id, $prefix.'timerminutesbackground_color', true);
	$secondsbackgroundcolor	= get_post_meta($id, $prefix.'timersecondsbackground_color', true);
	$width 					= get_post_meta($id, $prefix.'timer_width', true);

	// Circle 2 options
	$circle2width 					= get_post_meta($id, $prefix.'timercircle2_width', true );
	$circle2backgroundcolor 		= get_post_meta($id, $prefix.'timer2background_color', true );
	$circle2daysbackgroundcolor		= get_post_meta($id, $prefix.'timer2daysbackground_color', true );
	$cieclr2hoursbackgroundcolor	= get_post_meta($id, $prefix.'timer2hoursbackground_color', true );
	$circle2minutesbackgroundcolor	= get_post_meta($id, $prefix.'timer2minutesbackground_color', true );
	$circle2secondsbackgroundcolor	= get_post_meta($id, $prefix.'timer2secondsbackground_color', true );

	// Vertical options
	$verticalbackgroundcolor 		= get_post_meta($id, $prefix.'verticalbackground_color', true );

	// Horizontal options
	$horizontalbackgroundcolor 		= get_post_meta($id, $prefix.'horizontalbackground_color', true );

	// Rounded Clock options
	$roundedcirclecolor 			= get_post_meta($id, $prefix.'round_circle_color', true );

	// Bar Clock options
	$barbackgroundcolor 			= get_post_meta($id, $prefix.'bar_background_color', true );
	$barfillcolor 					= get_post_meta($id, $prefix.'bar_fill_color', true );

	// Night Clock options
	$nightseparatorcolor 			= get_post_meta($id, $prefix.'night_separator_color', true );

	// Modern Clock options
	$modernseparatorcolor 			= get_post_meta($id, $prefix.'modern_separator_color', true );

	// Shadow Shadow options
	$shadow1color 					= get_post_meta($id, $prefix.'shadow1_color', true );
	$shadow2color 					= get_post_meta($id, $prefix.'shadow2_color', true );

	if( $woo_exist == 1 && $is_ecommerce == 1 && !empty($woo_expiry_date) ) {
		$count_date = date("Y-m-d H:i:s", strtotime($woo_expiry_date) + 86399 );
	} elseif( $edd_exist == 1 && $is_ecommerce == 1 && !empty($edd_expiry_date) ) {
		$count_date = date("Y-m-d H:i:s", strtotime($edd_expiry_date) );
	} else {
		$count_date = $count_date;
	}
	// Creating compitible date according to UTF GMT time zone formate for older browwser
	$count_date = date('F d, Y H:i:s', strtotime($count_date));
	
	// Compacting Variables
	$date_conf 	= compact('count_date','days_text','hours_text','minutes_text','seconds_text','animation', 'circlewidth', 'backgroundwidth', 'backgroundcolor', 'is_days', 'daysbackgroundcolor', 'is_hours', 'hoursbackgroundcolor', 'is_minutes', 'minutesbackgroundcolor', 'is_seconds', 'secondsbackgroundcolor', 'circle2width', 'circle2backgroundcolor', 'circle2daysbackgroundcolor', 'cieclr2hoursbackgroundcolor', 'circle2minutesbackgroundcolor', 'circle2secondsbackgroundcolor', 'timezone');

	ob_start();

	if ( !empty($count_date) && $status == 'publish'  ) {
		
		$feat_img 	= wpcdt_pro_get_post_featured_image($id,'full',false); 
		$feat_style =  (!empty($feat_img)) ? "style='background:".$background_pref." url(".$feat_img.") no-repeat top center;background-size: cover;'" : 'style="background:'.$background_pref.';"';
	?>
		<div class="wpcdt-countdown-wrp wpcdt-clearfix" <?php echo $feat_style; ?>>		
			<div id="wpcdt-datecount-<?php echo $unique; ?>" class="wpcdt-countdown-timer-<?php echo $design ; ?>">

				<?php if($show_title == 'true'){ ?>
					<div class="wpcdt-timer-title">
						<?php echo get_the_title($id); ?>
					</div>
				<?php } ?>
				
				<div class="wpcdt-timer-description">
					<?php setup_postdata( $id ); 
					echo wpautop(get_the_content($id));
					wp_reset_postdata(); ?>
				</div>
				
				<?php
					// Include shortcode html file
					if( $design_file ) {
						include( $design_file );
					}
				?>
				<div class="ce-oncomplete">
					<?php echo $completion_text; ?>
				</div>
				<div class="wpcdt-date-conf" data-conf="<?php echo htmlspecialchars(json_encode($date_conf)); ?>"></div>
			</div>
		</div>
		
		<?php $content .= ob_get_clean();
		
		return $content;
	}
}

// 'wpcdt-countdown' shortcode
add_shortcode('wpcdt-countdown', 'wpcdt_pro_countdown_timer');