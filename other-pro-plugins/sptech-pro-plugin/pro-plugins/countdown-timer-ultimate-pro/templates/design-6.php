<style type="text/css">
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock{color: <?php echo $textcolor; ?>;}
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock .wpcdt-color{color: <?php echo $digitcolor; ?>;}
</style>

<div class="wpcdt-clock">
	<?php if($is_days == 1){ ?>
		<div class="ce-col">
			<span class="ce-days wpcdt-color"></span> <span class="ce-days-label"></span>
		</div>
	<?php } ?>
	
	<?php if($is_hours == 1){ ?>
		<div class="ce-col">
			<span class="ce-hours wpcdt-color"></span> <span class="ce-hours-label"></span>
		</div>
	<?php } ?>
	
	<?php if($is_minutes == 1){ ?>
		<div class="ce-col">
			<span class="ce-minutes wpcdt-color"></span> <span class="ce-minutes-label"></span>
		</div>
	<?php } ?>
	
	<?php if($is_seconds == 1){ ?>
		<div class="ce-col">
			<span class="ce-seconds wpcdt-color"></span> <span class="ce-seconds-label"></span>
		</div>
	<?php } ?>
</div>