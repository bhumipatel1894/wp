<style type="text/css">
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock, 
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock .ce-label{color: <?php echo $textcolor; ?>;}
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock .ce-digit {color: <?php echo $digitcolor; ?>;}
</style>

<div class="wpcdt-clock">
	<?php if($is_days == 1) { ?>
		<div class="ce-circle">
			<canvas id="ce-days" width="408" height="408"></canvas>
			<div class="ce-circle__values">
				<span class="ce-digit ce-days"></span>
				<span class="ce-label ce-days-label"></span>
			</div>
		</div>
	<?php } ?>
	
	<?php if($is_hours == 1) { ?>
		<div class="ce-circle">
			<canvas id="ce-hours" width="408" height="408"></canvas>
			<div class="ce-circle__values">
				<span class="ce-digit ce-hours"></span>
				<span class="ce-label ce-hours-label"></span>
			</div>
		</div>
	<?php } ?>
	
	<?php if($is_minutes == 1) { ?>
		<div class="ce-circle">
			<canvas id="ce-minutes" width="408" height="408"></canvas>
			<div class="ce-circle__values">
				<span class="ce-digit ce-minutes"></span>
				<span class="ce-label ce-minutes-label"></span>
			</div>
		</div>
	<?php } ?>
	
	<?php if($is_seconds == 1) { ?>
		<div class="ce-circle">
			<canvas id="ce-seconds" width="408" height="408"></canvas>
			<div class="ce-circle__values">
				<span class="ce-digit ce-seconds"></span>
				<span class="ce-label ce-seconds-label"></span>
			</div>
		</div>
	<?php } ?>
</div>