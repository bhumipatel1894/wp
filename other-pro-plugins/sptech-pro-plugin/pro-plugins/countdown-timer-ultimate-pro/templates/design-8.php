<style type="text/css">	
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock .ce-days, 
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock .ce-hours, 
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock .ce-minutes, 
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock .ce-seconds{color: <?php echo $digitcolor; ?>;}
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock{color: <?php echo $textcolor; ?>;}
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock .ce-flip-wrap .ce-flip-front,
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock .ce-flip-wrap .ce-flip-back{background: <?php echo $horizontalbackgroundcolor; ?>;}
</style>

<div class="wpcdt-clock">
	<?php if($is_days == 1){ ?>
		<div class="ce-col">
			<div class="ce-days">
				<div class="ce-flip-wrap">
					<div class="ce-flip-front"></div>
					<div class="ce-flip-back"></div>
				</div>
			</div>
			<span class="ce-days-label"></span>
		</div>
	<?php } ?>
	
	<?php if($is_hours == 1){ ?>
		<div class="ce-col">
			<div class="ce-hours">
				<div class="ce-flip-wrap">
					<div class="ce-flip-front"></div>
					<div class="ce-flip-back"></div>
				</div>
			</div>
			<span class="ce-hours-label"></span>
		</div>
	<?php } ?>
	
	<?php if($is_minutes == 1){ ?>
		<div class="ce-col">
			<div class="ce-minutes">
				<div class="ce-flip-wrap">
					<div class="ce-flip-front"></div>
					<div class="ce-flip-back"></div>
				</div>
			</div>
			<span class="ce-minutes-label"></span>
		</div>
	<?php } ?>
	
	<?php if($is_seconds == 1){ ?>
		<div class="ce-col">
			<div class="ce-seconds">
				<div class="ce-flip-wrap">
					<div class="ce-flip-front"></div>
					<div class="ce-flip-back"></div>
				</div>
			</div>
			<span class="ce-seconds-label"></span>
		</div>
	<?php } ?>
</div>