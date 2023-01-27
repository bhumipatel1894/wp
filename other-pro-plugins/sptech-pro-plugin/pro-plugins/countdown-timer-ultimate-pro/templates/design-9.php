<style type="text/css">
#wpcdt-datecount-<?php echo $unique; ?> .ce-col i{color:<?php echo $modernseparatorcolor ?>;}
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock{color: <?php echo $textcolor; ?>;}
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock .ce-digits{color: <?php echo $digitcolor; ?>;}
</style>

<div class="wpcdt-clock">
	<?php if($is_days == 1){ ?>
		<div class="ce-col">
			<span class="ce-digits ce-days"></span> <i>:</i>
			<span class="ce-days-label"></span>
		</div>
	<?php } ?>
	
	<?php if($is_hours == 1){ ?>
	<div class="ce-col">
		<span class="ce-digits ce-hours"></span> <i>:</i>
		<span class="ce-hours-label"></span>
	</div>
	<?php } ?>
	
	<?php if($is_minutes == 1){ ?>
	<div class="ce-col">
		<span class="ce-digits ce-minutes"></span> <i>:</i>
		<span class="ce-minutes-label"></span>
	</div>
	<?php } ?>

	<?php if($is_seconds == 1){ ?>
	<div class="ce-col">
		<span class="ce-digits ce-seconds"></span>
		<span class="ce-seconds-label"></span>
	</div>
	<?php } ?>
</div>