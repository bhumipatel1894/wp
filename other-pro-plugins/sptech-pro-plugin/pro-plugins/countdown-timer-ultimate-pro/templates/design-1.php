<style type="text/css">
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock{color: <?php echo $textcolor; ?>;}
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock .ce-digits span{border: 2px solid <?php echo $roundedcirclecolor ?>;color: <?php echo $digitcolor; ?>;}
</style>

<div class="ce-countdown ce-clearfix wpcdt-clock">
	<?php if($is_days == 1) { ?>
		<div class="ce-col">
			<div class="ce-digits ce-days"></div>
			<span class="ce-days-label"></span>
		</div>
	<?php } ?>
	
	<?php if($is_hours == 1) { ?>
		<div class="ce-col">
			<div class="ce-digits ce-hours"></div>
			<span class="ce-hours-label"></span>
		</div>
	<?php } ?>
	
	<?php if($is_minutes == 1) { ?>
		<div class="ce-col">
			<div class="ce-digits ce-minutes"></div>
			<span class="ce-minutes-label"></span>
		</div>
	<?php } ?>
	
	<?php if($is_seconds == 1) { ?>
		<div class="ce-col">
			<div class="ce-digits ce-seconds"></div>
			<span class="ce-seconds-label"></span>
		</div>
	<?php } ?>
</div>