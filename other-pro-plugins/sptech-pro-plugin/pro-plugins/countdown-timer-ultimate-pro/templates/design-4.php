<style type="text/css">
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock span{color: <?php echo $textcolor; ?>;}
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock span.wpcdt-color span{color: <?php echo $digitcolor; ?>;}
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock .ce-bar{background: <?php echo $barbackgroundcolor; ?>;}
#wpcdt-datecount-<?php echo $unique; ?> .wpcdt-clock .ce-fill{background: <?php echo $barfillcolor; ?>;}
</style>
	
<div class="ce-clearfix wpcdt-clock">
	<div class="ce-info ce-clearfix">
		<?php if($is_days == 1){ ?>
			<div class="ce-bar ce-bar-days"><div class="ce-fill"></div></div> 
			<span class="ce-days wpcdt-color"></span> <span class="ce-days-label"></span>
		<?php } ?>

		<?php if($is_hours == 1){ ?>
			<div class="ce-bar ce-bar-hours"><div class="ce-fill"></div></div> 
			<span class="ce-hours wpcdt-color"></span> <span class="ce-hours-label"></span>
		<?php } ?>
		
		<?php if($is_minutes == 1){ ?>
			<div class="ce-bar ce-bar-minutes"><div class="ce-fill"></div></div> 
			<span class="ce-minutes wpcdt-color"></span> <span class="ce-minutes-label"></span>
		<?php } ?>
		
		<?php if($is_seconds == 1){ ?>
			<div class="ce-bar ce-bar-seconds"><div class="ce-fill"></div></div> 
			<span class="ce-seconds wpcdt-color"></span> <span class="ce-seconds-label"></span>
		<?php } ?>
	</div>
</div>