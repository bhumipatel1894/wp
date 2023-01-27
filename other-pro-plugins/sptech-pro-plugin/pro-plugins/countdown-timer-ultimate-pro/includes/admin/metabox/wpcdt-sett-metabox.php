<?php
/**
 * Handles Countdown Timer Setting metabox HTML
 *
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

$prefix = WPCDT_PRO_META_PREFIX; // Metabox prefix

// Getting Genaral options
$wpcdt_pro_designs				= wpcdt_pro_designs();
$date 							= get_post_meta( $post->ID, $prefix.'timer_date', true );
$date 							= ($date != '') ? $date : current_time('Y-m-d H:m:s');

$style 							= get_post_meta( $post->ID, $prefix.'design_style', true );

$show_title 					= get_post_meta( $post->ID, $prefix.'show_title', true );
$completion_text 				= get_post_meta( $post->ID, $prefix.'completion_text', true );

$background_pref 				= get_post_meta( $post->ID, $prefix.'background_pref', true );
$background_pref 				= ($background_pref != '') ? $background_pref : '#72502f';

$textcolor 						= get_post_meta( $post->ID, $prefix.'timertext_color', true );
$textcolor 						= ($textcolor != '') ? $textcolor : '#fff';

$digitcolor 					= get_post_meta( $post->ID, $prefix.'timerdigit_color', true );
$digitcolor 					= ($digitcolor != '') ? $digitcolor : '#ff9900';

$is_days 						= get_post_meta( $post->ID, $prefix.'is_timerdays', true );
$is_days 						= ($is_days != '') ? $is_days : 1;

$is_hours 						= get_post_meta( $post->ID, $prefix.'is_timerhours', true );
$is_hours 						= ($is_hours != '') ? $is_hours : 1;

$is_minutes 					= get_post_meta( $post->ID, $prefix.'is_timerminutes', true );
$is_minutes 					= ($is_minutes != '') ? $is_minutes : 1;

$is_seconds 					= get_post_meta( $post->ID, $prefix.'is_timerseconds', true );
$is_seconds 					= ($is_seconds != '') ? $is_seconds : 1;

$timer_day_text 				= get_post_meta( $post->ID, $prefix.'timer_day_text', true );
$timer_day_text 				= ($timer_day_text != '') ? $timer_day_text : 'Days';

$timer_hour_text 				= get_post_meta( $post->ID, $prefix.'timer_hour_text', true );
$timer_hour_text 				= ($timer_hour_text != '') ? $timer_hour_text : 'Hours';

$timer_minute_text 				= get_post_meta( $post->ID, $prefix.'timer_minute_text', true );
$timer_minute_text 				= ($timer_minute_text != '') ? $timer_minute_text : 'Minutes';

$timer_second_text 				= get_post_meta( $post->ID, $prefix.'timer_second_text', true );
$timer_second_text 				= ($timer_second_text != '') ? $timer_second_text : 'Seconds';


// Circle options
$animation 						= get_post_meta( $post->ID, $prefix.'timercircle_animation', true );

$circlewidth 					= get_post_meta( $post->ID, $prefix.'timercircle_width', true );
$circlewidth 					= ($circlewidth != '') ? $circlewidth : 0.1;

$backgroundwidth 				= get_post_meta( $post->ID, $prefix.'timerbackground_width', true );
$backgroundwidth 				= ($backgroundwidth != '') ? $backgroundwidth : 1.2;

$backgroundcolor 				= get_post_meta( $post->ID, $prefix.'timerbackground_color', true );
$backgroundcolor 				= ($backgroundcolor != '') ? $backgroundcolor : '#313332';

$daysbackgroundcolor			= get_post_meta( $post->ID, $prefix.'timerdaysbackground_color', true );
$daysbackgroundcolor 			= ($daysbackgroundcolor != '') ? $daysbackgroundcolor : '#e3be32';

$hoursbackgroundcolor			= get_post_meta( $post->ID, $prefix.'timerhoursbackground_color', true );
$hoursbackgroundcolor 			= ($hoursbackgroundcolor != '') ? $hoursbackgroundcolor : '#36b0e3';

$minutesbackgroundcolor			= get_post_meta( $post->ID, $prefix.'timerminutesbackground_color', true );
$minutesbackgroundcolor 		= ($minutesbackgroundcolor != '') ? $minutesbackgroundcolor : '#75bf44';

$secondsbackgroundcolor			= get_post_meta( $post->ID, $prefix.'timersecondsbackground_color', true );
$secondsbackgroundcolor 		= ($secondsbackgroundcolor != '') ? $secondsbackgroundcolor : '#66c5af';

$timer_width 					= get_post_meta( $post->ID, $prefix.'timer_width', true );
$timer_width 					= ($timer_width != '') ? $timer_width : '500';

// Circle2 options
$circle2width 					= get_post_meta( $post->ID, $prefix.'timercircle2_width', true );
$circle2width 					= ($circle2width != '') ? $circle2width : 1;

$circle2backgroundcolor 		= get_post_meta( $post->ID, $prefix.'timer2background_color', true );
$circle2backgroundcolor 		= ($circle2backgroundcolor != '') ? $circle2backgroundcolor : '#ff9900';

$circle2daysbackgroundcolor		= get_post_meta( $post->ID, $prefix.'timer2daysbackground_color', true );
$circle2daysbackgroundcolor 	= ($circle2daysbackgroundcolor != '') ? $circle2daysbackgroundcolor : '#fff';

$cieclr2hoursbackgroundcolor	= get_post_meta( $post->ID, $prefix.'timer2hoursbackground_color', true );
$cieclr2hoursbackgroundcolor 	= ($cieclr2hoursbackgroundcolor != '') ? $cieclr2hoursbackgroundcolor : '#fff';

$circle2minutesbackgroundcolor	= get_post_meta( $post->ID, $prefix.'timer2minutesbackground_color', true );
$circle2minutesbackgroundcolor 	= ($circle2minutesbackgroundcolor != '') ? $circle2minutesbackgroundcolor : '#fff';

$circle2secondsbackgroundcolor	= get_post_meta( $post->ID, $prefix.'timer2secondsbackground_color', true );
$circle2secondsbackgroundcolor 	= ($circle2secondsbackgroundcolor != '') ? $circle2secondsbackgroundcolor : '#fff';

// Vertical options
$verticalbackgroundcolor 		= get_post_meta( $post->ID, $prefix.'verticalbackground_color', true );
$verticalbackgroundcolor 		= ($verticalbackgroundcolor != '') ? $verticalbackgroundcolor : '#ffffff';

// Horizontal options
$horizontalbackgroundcolor 		= get_post_meta( $post->ID, $prefix.'horizontalbackground_color', true );
$horizontalbackgroundcolor 		= ($horizontalbackgroundcolor != '') ? $horizontalbackgroundcolor : '#ffffff';

// Rounded Clock options
$roundedcirclecolor 			= get_post_meta( $post->ID, $prefix.'round_circle_color', true );
$roundedcirclecolor 			= ($roundedcirclecolor != '') ? $roundedcirclecolor : '#ffffff';

// Bar Clock options
$barbackgroundcolor 			= get_post_meta( $post->ID, $prefix.'bar_background_color', true );
$barbackgroundcolor 			= ($barbackgroundcolor != '') ? $barbackgroundcolor : '#ffffff';

$barfillcolor 					= get_post_meta( $post->ID, $prefix.'bar_fill_color', true );
$barfillcolor 					= ($barfillcolor != '') ? $barfillcolor : '#ff9900';

// Night Clock options
$nightseparatorcolor 			= get_post_meta( $post->ID, $prefix.'night_separator_color', true );
$nightseparatorcolor 			= ($nightseparatorcolor != '') ? $nightseparatorcolor : '#ffffff';

// Modern Clock options
$modernseparatorcolor 			= get_post_meta( $post->ID, $prefix.'modern_separator_color', true );
$modernseparatorcolor 			= ($modernseparatorcolor != '') ? $modernseparatorcolor : '#ffffff';

// Shadow Shadow options
$shadow1color 					= get_post_meta( $post->ID, $prefix.'shadow1_color', true );
$shadow1color 					= ($shadow1color != '') ? $shadow1color : '#a19513';

$shadow2color 					= get_post_meta( $post->ID, $prefix.'shadow2_color', true );
$shadow2color 					= ($shadow2color != '') ? $shadow2color : '#969696';
?>

<!-- Time & Date options starts -->
<table class="form-table wpcdt-choose-design wpcdt-post-sett-table">
	
	<tr valign="top">
		<th scope="row">
			<label for="wpcdt-design"><?php _e('Choose Style', 'countdown-timer-ultimate'); ?></label>
		</th>
		<td>
			<select name="<?php echo $prefix; ?>design_style" class="wpcdt-design" id="wpcdt-design">
				<?php
				if( !empty($wpcdt_pro_designs) ) {
					foreach ($wpcdt_pro_designs as $clock_design_key => $clock_design_val) {
				?>
						<option value="<?php echo $clock_design_key; ?>" <?php selected( $style, $clock_design_key); ?>><?php echo $clock_design_val; ?></option>
				<?php
					}
				}
				?>
			</select><br/>
			<span class="description"><?php _e('Select countdown timer style.', 'countdown-timer-ultimate'); ?></span>
		</td>
	</tr>

	<tr valign="top">
		<th scope="row">
			<label for="wpcdt-countdown-time-date"><?php _e('Expiry Date & Time', 'countdown-timer-ultimate'); ?></label>
		</th>
		<td>
			<input type="text" name="<?php echo $prefix; ?>timer_date" value="<?php echo wpcdt_pro_escape_attr($date); ?>" class="regular-text wpcdt-countdown-time-date wpcdt-countdown-datepicker" id="wpcdt-countdown-time-date" /><br/>
			<span class="description"><?php _e('Select timer expiry Date and Time.', 'countdown-timer-ultimate'); ?></span>
		</td>
	</tr>

	<tr valign="top">
		<th scope="row">
			<label for="wpcdt-countdown-timer"><?php _e('Timer Background Color', 'countdown-timer-ultimate'); ?></label>
		</th>
		<td>
			<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>background_pref" value="<?php echo wpcdt_pro_escape_attr($background_pref); ?>"><br/>
			<span class="description"><?php _e('Set countdown timer background color.', 'countdown-timer-ultimate'); ?></span><br/>			
		</td>
	</tr>
</table>
<hr>
<!-- Time & Date options end -->

<!-- Circle clock options starts -->
<div class="wpcdt-post-circle wpcdt-post-hide wpcdt-post-common" style="<?php if($style == 'circle' || $style == '' ){ echo 'display:block';  }else{ echo 'display:none'; } ?>">
	
	<h3><?php _e('Circle Clock Settings', 'countdown-timer-ultimate'); ?></h3>

	<table class="form-table wpcdt-post-sett-table">
		<tbody>
			<tr valign="top">
				<th scope="row">
					<label><?php _e('Choose Animation', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<select name="<?php echo $prefix; ?>timercircle_animation" class="wpcdt-select-box wpcdt-timer-animation" id="wpcdt-timer-animation">
						<option value="smooth" <?php selected( $animation, 'smooth'); ?>><?php _e('Smooth', 'countdown-timer-ultimate'); ?></option>
						<option value="ticks" <?php selected( $animation, 'ticks'); ?>><?php _e('Ticks', 'countdown-timer-ultimate'); ?></option>
					</select><br/>
					<span class="description"><?php _e('Select circle animation style.', 'countdown-timer-ultimate'); ?></span>
				</td>
			</tr>

			<tr valign="top">
				
				<th scope="row">
					<label><?php _e('Circle Width (Foreground)', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<input type="hidden" class="wpcdt-number" min="0.0033333333333333335" max="0.13333333333333333" step="0.003333333" name="<?php echo $prefix; ?>timercircle_width" value="<?php echo wpcdt_pro_escape_attr($circlewidth); ?>">
					<div class="wpcdt-circle-slider"></div>
					<span class="description"><?php _e('Adjust circle width.', 'countdown-timer-ultimate'); ?></span>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">
					<label for="wpcdt-countdown-timer"><?php _e('Background Width', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<input type="hidden" class="wpcdt-number" min="0.1" max="3" step="0.1" name="<?php echo $prefix; ?>timerbackground_width" value="<?php echo wpcdt_pro_escape_attr($backgroundwidth); ?>">
					<div class="wpcdt-background-slider"></div>
					<span class="description"><?php _e('Adjust circle background width.', 'countdown-timer-ultimate'); ?></span>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">
					<label for="wpcdt-timer-width"><?php _e('Countdown Timer Width', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<input type="number" min="1" name="<?php echo $prefix; ?>timer_width" value="<?php echo wpcdt_pro_escape_attr($timer_width); ?>" class="small-text wpcdt-timer-width" id="wpcdt-timer-width" /> <?php _e('Px', 'countdown-timer-ultimate'); ?><br/>
					<span class="description"><?php _e('Enter countdown timer width.', 'countdown-timer-ultimate'); ?></span>
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="wpcdt-countdown-timer"><?php _e('Background Color', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>timerbackground_color" value="<?php echo wpcdt_pro_escape_attr($backgroundcolor); ?>"><br/>
					<span class="description"><?php _e('Please select background color.', 'countdown-timer-ultimate'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="wpcdt-countdown-timer"><?php _e('Foreground Colors', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<table>
						<tr>
							<td>
								<label for="wpcdt-countdown-timer"><?php _e('Days', 'countdown-timer-ultimate'); ?></label><br/>
								<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>timerdaysbackground_color" value="<?php echo wpcdt_pro_escape_attr($daysbackgroundcolor); ?>"><br/>
								<span class="description"><?php _e('Select Day circle color.', 'countdown-timer-ultimate'); ?></span>
							</td>
							<td>
								<label for="wpcdt-countdown-timer"><?php _e('Hours', 'countdown-timer-ultimate'); ?></label><br/>
								<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>timerhoursbackground_color" value="<?php echo wpcdt_pro_escape_attr($hoursbackgroundcolor); ?>"><br/>
								<span class="description"><?php _e('Select Hours circle color.', 'countdown-timer-ultimate'); ?></span>
							</td>
						</tr>

						<tr>
							<td>
								<label for="wpcdt-countdown-timer"><?php _e('Minutes', 'countdown-timer-ultimate'); ?></label><br/>
								<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>timerminutesbackground_color" value="<?php echo wpcdt_pro_escape_attr($minutesbackgroundcolor); ?>"><br/>
								<span class="description"><?php _e('Select Minute circle color.', 'countdown-timer-ultimate'); ?></span>
							</td>
							<td>
								<label for="wpcdt-countdown-timer"><?php _e('Seconds', 'countdown-timer-ultimate'); ?></label><br/>
								<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>timersecondsbackground_color" value="<?php echo wpcdt_pro_escape_attr($secondsbackgroundcolor); ?>"><br/>
								<span class="description"><?php _e('Select Second circle color.', 'countdown-timer-ultimate'); ?></span>
							</td>
						</tr>
					</table><!-- End of inner table -->
				</td>
			</tr>
		</tbody>
	</table>
	<hr>
</div>
<!-- Circle clock options ends -->

<!-- Circle 2 options -->
<div class="wpcdt-post-design-3 wpcdt-post-hide wpcdt-post-common" style="<?php if($style == 'design-3'){ echo 'display:block';  }else{ echo 'display:none'; } ?>">
	
	<h3><?php _e('Circle Style 2 Clock Settings', 'countdown-timer-ultimate'); ?></h3>

	<table class="form-table wpcdt-post-sett-table">
		<tbody>

			<tr valign="top">
				<th scope="row">
					<label><?php _e('Circle Width', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<input type="hidden" class="wpcdt-number" min="1" max="25" step="1" name="<?php echo $prefix; ?>timercircle2_width" value="<?php echo wpcdt_pro_escape_attr($circle2width); ?>">
					<div class="wpcdt-circle-2-slider"></div>
					<span class="description"><?php _e('Adjust circle width.', 'countdown-timer-ultimate'); ?></span>
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label><?php _e('Background Color', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>timer2background_color" value="<?php echo wpcdt_pro_escape_attr($circle2backgroundcolor); ?>"><br/>
					<span class="description"><?php _e('Select background color.', 'countdown-timer-ultimate'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label><?php _e('Foreground Colors', 'countdown-timer-ultimate'); ?></label>
				</th>
				
				<td>
					<table>	
						<tr>
							<td>
								<label><?php _e('Days', 'countdown-timer-ultimate'); ?></label><br/>
								<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>timer2daysbackground_color" value="<?php echo wpcdt_pro_escape_attr($circle2daysbackgroundcolor); ?>"><br/>
								<span class="description"><?php _e('Select Day circle color.', 'countdown-timer-ultimate'); ?></span>
							</td>
							
							<td>
								<label><?php _e('Hours', 'countdown-timer-ultimate'); ?></label><br/>
								<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>timer2hoursbackground_color" value="<?php echo wpcdt_pro_escape_attr($cieclr2hoursbackgroundcolor); ?>"><br/>
								<span class="description"><?php _e('Select Hours color.', 'countdown-timer-ultimate'); ?></span>
							</td>
						</tr>

						<tr>
							<td>
								<label><?php _e('Minutes', 'countdown-timer-ultimate'); ?></label><br/>
								<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>timer2minutesbackground_color" value="<?php echo wpcdt_pro_escape_attr($circle2minutesbackgroundcolor); ?>"><br/>
								<span class="description"><?php _e('Select Minute circle color.', 'countdown-timer-ultimate'); ?></span>
							</td>
							<td>
								<label><?php _e('Seconds', 'countdown-timer-ultimate'); ?></label><br/>
								<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>timer2secondsbackground_color" value="<?php echo wpcdt_pro_escape_attr($circle2secondsbackgroundcolor); ?>"><br/>
								<span class="description"><?php _e('Please select second circle color.', 'countdown-timer-ultimate'); ?></span>
							</td>
						</tr>
					</table><!-- End of inner table -->
				</td>
			</tr>
		</tbody>
	</table>
	<hr>
</div>
<!-- Circle 2 options end -->

<!-- Vertical clock options starts -->
<div class="wpcdt-post-design-2 wpcdt-post-hide wpcdt-post-common" style="<?php if($style == 'design-2'){ echo 'display:block';  }else{ echo 'display:none'; } ?>">
	
	<h3><?php _e('Vertical Clock Settings', 'countdown-timer-ultimate'); ?></h3>
	<table class="form-table wpcdt-post-sett-table">
		<tbody>
			<tr>
				<th scope="row">
					<label for="wpcdt-countdown-timer"><?php _e('Flip Background Color', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>verticalbackground_color" value="<?php echo wpcdt_pro_escape_attr($verticalbackgroundcolor); ?>"><br/>
					<span class="description"><?php _e('Select flip background color.', 'countdown-timer-ultimate'); ?></span>
				</td>
			</tr>
		</tbody>
	</table>
	<hr>
</div>
<!-- Vertical clock options starts -->

<!-- Horizontal Clock options starts -->
<div class="wpcdt-post-design-8 wpcdt-post-hide wpcdt-post-common" style="<?php if($style == 'design-8'){ echo 'display:block';  }else{ echo 'display:none'; } ?>">
	
	<h3><?php _e('Horizontal Clock Settings', 'countdown-timer-ultimate'); ?></h3>

	<table class="form-table wpcdt-post-sett-table">
		<tbody>

			<tr>
				<th scope="row">
					<label><?php _e('Flip Background Color', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>horizontalbackground_color" value="<?php echo wpcdt_pro_escape_attr($horizontalbackgroundcolor); ?>"><br/>
					<span class="description"><?php _e('Select flip background color.', 'countdown-timer-ultimate'); ?></span>
				</td>
			</tr>
		</tbody>
	</table>
	<hr>
</div>
<!-- Horizontal Clock options ends -->

<!-- Rounded Clock options -->
<div class="wpcdt-post-design-1 wpcdt-post-hide wpcdt-post-common" style="<?php if($style == 'design-1'){ echo 'display:block';  }else{ echo 'display:none'; } ?>">
	
	<h3><?php _e('Rounded Clock Settings', 'countdown-timer-ultimate'); ?></h3>

	<table class="form-table wpcdt-post-sett-table">
		<tbody>
			<tr>
				<th scope="row">
					<label for="wpcdt-countdown-timer"><?php _e('Circle Border Color', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>round_circle_color" value="<?php echo wpcdt_pro_escape_attr($roundedcirclecolor); ?>"><br/>
					<span class="description"><?php _e('Select circle border color.', 'countdown-timer-ultimate'); ?></span>
				</td>
			</tr>
		</tbody>
	</table>
	<hr>
</div>
<!-- Rounded Clock options end -->

<!-- Bars clock options starts -->
<div class="wpcdt-post-design-4 wpcdt-post-hide wpcdt-post-common" style="<?php if($style == 'design-4'){ echo 'display:block';  }else{ echo 'display:none'; } ?>">
	
	<h3><?php _e('Bars Clock Settings', 'countdown-timer-ultimate'); ?></h3>
	<table class="form-table wpcdt-post-sett-table">
		<tbody>
			<tr>
				<th scope="row">
					<label for="wpcdt-countdown-timer"><?php _e('Bar Background Color', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>bar_background_color" value="<?php echo wpcdt_pro_escape_attr($barbackgroundcolor); ?>"><br/>
					<span class="description"><?php _e('Select bar background color.', 'countdown-timer-ultimate'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="wpcdt-countdown-timer"><?php _e('Bar Fill Color', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>bar_fill_color" value="<?php echo wpcdt_pro_escape_attr($barfillcolor); ?>"><br/>
					<span class="description"><?php _e('Select bar fill color.', 'countdown-timer-ultimate'); ?></span>
				</td>
			</tr>
		</tbody>
	</table>
	<hr>
</div>
<!-- Bars clock options ends -->

<!-- Night clock options starts -->
<div class="wpcdt-post-design-5 wpcdt-post-hide wpcdt-post-common" style="<?php if($style == 'design-5'){ echo 'display:block';  }else{ echo 'display:none'; } ?>">
	
	<h3><?php _e('Night Clock Settings', 'countdown-timer-ultimate'); ?></h3>

	<table class="form-table wpcdt-post-sett-table">
		<tbody>

			<tr>
				<th scope="row">
					<label for="wpcdt-countdown-timer"><?php _e('Clock Separator Color', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>night_separator_color" value="<?php echo wpcdt_pro_escape_attr($nightseparatorcolor); ?>"><br/>
					<span class="description"><?php _e('Select clock separator color.', 'countdown-timer-ultimate'); ?></span>
				</td>
			</tr>
		</tbody>
	</table>
	<hr>
</div>
<!-- Night clock options ends -->

<!-- Modern Clock options starts -->
<div class="wpcdt-post-design-9 wpcdt-post-hide wpcdt-post-common" style="<?php if($style == 'design-9'){ echo 'display:block';  }else{ echo 'display:none'; } ?>">
	
	<h3><?php _e('Modern Clock Settings', 'countdown-timer-ultimate'); ?></h3>
	<table class="form-table wpcdt-post-sett-table">
		<tbody>
			<tr>
				<th scope="row">
					<label><?php _e('Separator Color', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>modern_separator_color" value="<?php echo wpcdt_pro_escape_attr($modernseparatorcolor); ?>"><br/>
					<span class="description"><?php _e('Select clock separator color.', 'countdown-timer-ultimate'); ?></span>
				</td>
			</tr>
		</tbody>
	</table>
	<hr>
</div>
<!-- Modern Clock options ends -->

<!-- Shadow Clock options starts -->
<div class="wpcdt-post-design-11 wpcdt-post-hide wpcdt-post-common" style="<?php if($style == 'design-11'){ echo 'display:block';  }else{ echo 'display:none'; } ?>">
	
	<h3><?php _e('Shadow Clock Settings', 'countdown-timer-ultimate'); ?></h3>
	<table class="form-table wpcdt-post-sett-table">
		<tbody>
			<tr>
				<th scope="row">
					<label for="wpcdt-countdown-timer"><?php _e('Shadow 1 Color', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>shadow2_color" value="<?php echo wpcdt_pro_escape_attr($shadow2color); ?>"><br/>
					<span class="description"><?php _e('Select clock shadow 1 color.', 'countdown-timer-ultimate'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="wpcdt-countdown-timer"><?php _e('Shadow 2 Color', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>shadow1_color" value="<?php echo wpcdt_pro_escape_attr($shadow1color); ?>"><br/>
					<span class="description"><?php _e('Select clock shadow 2 color.', 'countdown-timer-ultimate'); ?></span>
				</td>
			</tr>
		</tbody>
	</table>
	<hr>
</div>
<!-- Shadow Clock options end -->

<!-- General options -->
<div class="wpcdt-post-general-sett">

	<h3><?php _e('General Settings', 'countdown-timer-ultimate'); ?></h3>

	<table class="form-table wpcdt-post-sett-table">
		<tbody>
			<tr valign="top">
				<th scope="row">
					<label for="wpcdt-timer-title"><?php _e('Show Timer Title', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<select name="<?php echo $prefix; ?>show_title" class="wpcdt-select-box wpcdt-timer-title" id="wpcdt-timer-title">
						<option value="true" <?php selected( $show_title, 'true'); ?>><?php _e('Yes', 'countdown-timer-ultimate'); ?></option>
						<option value="false" <?php selected( $show_title, 'false'); ?>><?php _e('No', 'countdown-timer-ultimate'); ?></option>
					</select><br/>
					<span class="description"><?php _e('Show Timer title or not.', 'countdown-timer-ultimate'); ?></span>
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label><?php _e('Timer Label Text Color', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>timertext_color" value="<?php echo wpcdt_pro_escape_attr($textcolor); ?>"><br/>
					<span class="description"><?php _e('Select timer label color like Hours, Minutes and etc.', 'countdown-timer-ultimate'); ?></span>
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="wpcdt-countdown-timer"><?php _e('Timer Digit Text Color', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<input type="text" class="wpcdt-color-box" name="<?php echo $prefix; ?>timerdigit_color" value="<?php echo wpcdt_pro_escape_attr($digitcolor); ?>"><br/>
					<span class="description"><?php _e('Select timer clock digit color.', 'countdown-timer-ultimate'); ?></span>
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label><?php _e('Timer Clock Options', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<table>
						<tr>
							<td>
								<input type="checkbox" name="<?php echo $prefix; ?>is_timerdays" value="1" class="wpcdt-check-box wpcdt-timer-days" id="wpcdt-timer-days" <?php checked($is_days,1); ?>/>
								<label for="wpcdt-timer-days"><?php _e('Days', 'countdown-timer-ultimate'); ?></label><br/>
								<input type="text" name="<?php echo $prefix; ?>timer_day_text" value="<?php echo wpcdt_pro_escape_attr($timer_day_text); ?>" class="medium-text wpcdt-countdown-day-text" id="wpcdt-countdown-day-text"><br/>
								<span class="description"><?php _e('Check this box to enable Days in timer and add your desired text.', 'countdown-timer-ultimate'); ?></span>
							</td>					
							<td>
								<input type="checkbox" name="<?php echo $prefix; ?>is_timerhours" value="1" class="wpcdt-check-box wpcdt-timer-hours" id="wpcdt-timer-hours" <?php checked($is_hours, 1); ?> />
								<label for="wpcdt-countdown-timer"><?php _e('Hours', 'countdown-timer-ultimate'); ?></label><br/>
								<input type="text" id="wpcdt-countdown-hour-text" class="medium-text wpcdt-countdown-hour-text" name="<?php echo $prefix; ?>timer_hour_text" value="<?php echo wpcdt_pro_escape_attr($timer_hour_text); ?>" /><br/>
								<span class="description"><?php _e('Check this box to enable Hours in timer and add your desired text.') ?></span>
							</td>
						</tr>
						<tr>
							<td>
								<input type="checkbox" name="<?php echo $prefix; ?>is_timerminutes" value="1" class="wpcdt-check-box wpcdt-timer-minutes" id="wpcdt-timer-minutes" <?php checked($is_minutes, 1); ?> />
								<label for="wpcdt-timer-minutes"><?php _e('Minutes', 'countdown-timer-ultimate'); ?></label><br/>
								<input type="text" name="<?php echo $prefix; ?>timer_minute_text" value="<?php echo wpcdt_pro_escape_attr($timer_minute_text); ?>" id="wpcdt-countdown-minutes-text" class="medium-text wpcdt-countdown-minutes-text" /><br/>
								<span class="description"><?php _e('Check this box to enable Minutes in timer and add your desired text.', 'countdown-timer-ultimate'); ?></span>
							</td>
							<td>
								<input type="checkbox" name="<?php echo $prefix; ?>is_timerseconds" value="1" class="wpcdt-check-box wpcdt-timer-second" id="wpcdt-timer-second" <?php checked($is_seconds, 1); ?> />
								<label for="wpcdt-timer-second"><?php _e('Seconds', 'countdown-timer-ultimate'); ?></label><br/>
								<input type="text" id="wpcdt-countdown-seconds-text" class="medium-text wpcdt-countdown-seconds-text" name="<?php echo $prefix; ?>timer_second_text" value="<?php echo wpcdt_pro_escape_attr($timer_second_text); ?>" /><br/>
								<span class="description"><?php _e('Check this box to enable Seconds in timer and add your desired text.', 'countdown-timer-ultimate'); ?></span>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="wpcdt-timer-completion-text"><?php _e('Completion Text', 'countdown-timer-ultimate'); ?></label>
				</th>
				<td>
					<textarea name="<?php echo $prefix; ?>completion_text" class="large-text wpcdt-timer-completion-text" id="wpcdt-timer-completion-text" rows="5"><?php echo wpcdt_pro_escape_attr($completion_text); ?></textarea><br/>
					<span class="description"><?php _e('Enter completion text which will be shown after the timer is completed.', 'countdown-timer-ultimate'); ?></span>
				</td>
			</tr>
		</tbody>
	</table><!-- end .wpcdt-post-sett-table -->
</div>
<!-- General options end -->