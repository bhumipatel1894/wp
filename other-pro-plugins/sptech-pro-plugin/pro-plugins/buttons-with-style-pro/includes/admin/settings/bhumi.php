<?php
/**
 * Settings Page
 *
 * @package Buttons With Style Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>
<div class="wrap bwswpos-settings">
<?php  
/*$screen = get_current_screen();

var_dump($screen);*/


if($_GET['page'] == 'Bhumi' ) {
	echo  '<h2>Hello Bhumi</h2>';
}
else if($_GET['page'] == 'Bhumi2' ) {
	echo  '<h2>Hello Kishan</h2>';
}
	
?>
	
</div>