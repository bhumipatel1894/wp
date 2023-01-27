<style type="text/css">
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock .ce-unit-wrap > span,
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock div.digits div.digits-inner div.flip-wrap div div.inn {color: <?php echo $textcolor; ?>;}
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock div.digits div.digits-inner div.flip-wrap div div.inn {color: <?php echo $digitcolor; ?>;}
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock div.digits div.digits-inner div.flip-wrap div div.inn, 
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock div.digits div.digits-inner div.flip-wrap div.up div.inn{background: <?php echo $verticalbackgroundcolor; ?>;}
</style>

<div class="wpcdt-clock">
	<?php if($is_days == 1){ ?>
		<div class="ce-unit-wrap">
			<div class="days"></div>
			<span class="ce-days-label"></span>
		</div>
	<?php } ?>
	
	<?php if($is_hours == 1){ ?>
		<div class="ce-unit-wrap">
			<div class="hours"></div>
			<span class="ce-hours-label"></span>
		</div>
	<?php } ?>
	
	<?php if($is_minutes == 1){ ?>
		<div class="ce-unit-wrap">
			<div class="minutes"></div>
			<span class="ce-minutes-label"></span>
		</div>
	<?php } ?>
	
	<?php if($is_seconds == 1){ ?>
		<div class="ce-unit-wrap">
			<div class="seconds"></div>
			<span class="ce-seconds-label"></span>
		</div>
	<?php } ?>
</div>