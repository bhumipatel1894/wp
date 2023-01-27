<?php
/**
 * Handles Post Setting metabox HTML
 *
 * @package Buttons With Style Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

// Taking some variables
$prefix 				= BWSPOS_PRO_META_PREFIX; // Metabox prefix
$choice_butons 			= bwsp_button_type();
$button_type 			= bwsp_btn_style_type();
$button_class 			= bwsp_clr_class();
$button_style 			= bwsp_btn_style_cls();
$button_size 			= bwsp_btn_sizes();
$button_icon_class 		= bwsp_btn_icon_class();
$button_icon_size 		= bwsp_btn_icon_size();
$single_button_style 	= $group_button_style = '';

// Getting saved values
$choice_button_type 	= get_post_meta( $post->ID, $prefix.'choice_button_type', true );
$button_style_type 		= get_post_meta( $post->ID, $prefix.'button_type', true );
$btn_clr_cls 			= get_post_meta( $post->ID, $prefix.'button_class', true );
$btn_style_type 		= get_post_meta( $post->ID, $prefix.'button_style', true );
$btn_size 				= get_post_meta( $post->ID, $prefix.'button_size', true );
$btn_icon_size 			= get_post_meta( $post->ID, $prefix.'button_icon_size', true );
$button_link_target 	= get_post_meta( $post->ID, $prefix.'button_link_target', true );
$simple_btn_name 		= get_post_meta( $post->ID, $prefix.'button_name', true );
$simple_btn_link 		= get_post_meta( $post->ID, $prefix.'button_link', true );
$simple_btn_icon_cls 	= get_post_meta( $post->ID, $prefix.'button_icon_class', true );
$grp_btn_data 			= get_post_meta( $post->ID, $prefix.'grp_btn_data', true );
$grp_btn_data			= !empty($grp_btn_data) ? $grp_btn_data : array('0' => '');

if($choice_button_type == 'button' || $choice_button_type == '') {
	$single_button_style = 'style = "display:table"';
	$group_button_style = 'style = "display:none"';
} else {
	$group_button_style = 'style = "display:table"';
	$single_button_style = 'style = "display:none"';
}
?>

<table class="form-table bwsp-post-sett-tbl">
	<tbody>
		<!-- Button Type -->
		<tr valign="top">
			<th scope="row">
				<label for="bwsp-btn-type"><?php _e('Button Type', 'buttons-with-style'); ?></label>
			</th>
			<td>
				<select name="<?php echo $prefix; ?>choice_button_type" id="bwsp-btn-type" class="bwsp-select-box bwsp-btn-type">
				<?php
				if( !empty($choice_butons) ) {
					foreach ($choice_butons as $btn_key => $btn_val) {
							echo '<option value="'.$btn_key.'" '.selected($choice_button_type, $btn_key).'>'.$btn_val.'</option>';
						}
					}
				?>
				</select><br/>
				<span class="description"><?php _e('Select button type.', 'buttons-with-style'); ?></span>
			</td>
		</tr>

		<!-- Simple button settings -->
		<tr valign="top">
			<td colspan="2" class="bwsp-no-padding">
				<table class="form-table bwsp-simple-button-sett" <?php echo $single_button_style;?>>
					<tbody>
						<tr>
							<th colspan="2">
								<div class="bwsp-sett-title"><?php _e('Simple Button Settings', 'buttons-with-style'); ?></div>
							</th>
						</tr>
						<tr>
							<th><label for="bwsp-simple-btn-name"><?php echo __('Button Text','buttons-with-style');?></label></th>
							<td>
								<input type="text" name="<?php echo $prefix;?>button_name" value="<?php echo bwsp_esc_attr($simple_btn_name); ?>" class="regular-text bwsp-simple-btn-name" id="bwsp-simple-btn-name" /><br/>
								<span class="description"><?php _e('Enter button text like. eg. My Button', 'buttons-with-style'); ?></span>
							</td>
						</tr>
						<tr>
							<th><label for="bwsp-simple-btn-link"><?php echo __('Button Link','buttons-with-style');?></label></th>
							<td>
								<input type="text" name="<?php echo $prefix;?>button_link" value="<?php echo bwsp_esc_attr($simple_btn_link); ?>" class="regular-text bwsp-simple-btn-link" id="bwsp-simple-btn-link" /><br/>
								<span class="description"><?php _e('Enter button link. eg. http://wponlinesupport.com.', 'buttons-with-style'); ?></span>
							</td>
						</tr>
						<tr>
							<th><label for="bwsp-simple-btn-cls"><?php echo __('Button Icon','buttons-with-style');?></label></th>
							<td>
								<input type="text" name="<?php echo $prefix;?>button_icon_class" value="<?php echo bwsp_esc_attr($simple_btn_icon_cls); ?>" class="regular-text bwsp-simple-btn-cls" id="bwsp-simple-btn-cls" /><br/>
								<span class="description"><?php _e('e.g. star, For more', 'buttons-with-style'); ?> <a href="http://zurb.com/playground/foundation-icon-fonts-3" target="_blank"><?php _e('Click Here', 'buttons-with-style');?></a></span>
							</td>
						</tr>
					</tbody>
				</table>

				<table class="form-table bwsp-group-button-sett" <?php echo $group_button_style;?>>
					<tr>
						<th colspan="4">
							<div class="bwsp-sett-title"><?php _e('Group Button Settings', 'buttons-with-style'); ?></div>
						</th>
					</tr>
					<tr>
						<th><?php _e('Button Text', 'buttons-with-style');?></th>
						<th><?php _e('Button Link', 'buttons-with-style');?></th>
						<th><?php _e('Font Icon', 'buttons-with-style');?></th>
						<th class="bwsp-act-head"><?php _e('Action', 'buttons-with-style');?></th>
					</tr>
					<?php if(!empty($grp_btn_data)) {
						foreach ($grp_btn_data as $grp_key => $grp_val) {

							$btn_name = isset($grp_val['name']) 	? $grp_val['name'] 		: '';
							$btn_link = isset($grp_val['link']) 	? $grp_val['link'] 		: '';
							$icon_cls = isset($grp_val['icon_cls']) ? $grp_val['icon_cls'] 	: '';
					?>

						<tr valign="top" class="bwsp-group-btn-row" data-key="<?php echo $grp_key; ?>">2w
							<td>							
								<input type="text" name="<?php echo $prefix;?>grp_btn_data[<?php echo $grp_key; ?>][name]" value="<?php echo $btn_name; ?>" class="large-text" placeholder="<?php _e('Button Text', 'buttons-with-style'); ?>" /><br/>
								<span class="description"><?php _e('Enter button text like. eg. My Button', 'buttons-with-style'); ?></span>
							</td>
							<td>
								<input type="text" name="<?php echo $prefix;?>grp_btn_data[<?php echo $grp_key; ?>][link]" value="<?php echo $btn_link; ?>" class="large-text" placeholder="<?php _e('Button Link', 'buttons-with-style'); ?>" /><br/>
								<span class="description"><?php _e('eg. http://wponlinesupport.com.', 'buttons-with-style'); ?></span>
							</td>
							<td>
								<input type="text" name="<?php echo $prefix;?>grp_btn_data[<?php echo $grp_key; ?>][icon_cls]" value="<?php echo $icon_cls; ?>" class="large-text" placeholder="<?php _e('Icon Class', 'buttons-with-style'); ?>" /><br/>
								<span class="description"><?php _e('e.g. star, For more', 'buttons-with-style'); ?> <a href="http://zurb.com/playground/foundation-icon-fonts-3" target="_blank"><?php _e('Click Here','buttons-with-style'); ?></a></span>
							</td>
							<td>	
								<span class="bwsp-action-btn bwsp-add-row" title="<?php _e('Add', 'buttons-with-style'); ?>"><i class="dashicons dashicons-plus-alt"></i></span>						
								<span class="bwsp-action-btn bwsp-del-row" title="<?php _e('Delete', 'buttons-with-style'); ?>"><i class="dashicons dashicons-trash"></i></span>
							</td>
						</tr>
					<?php
						} // End of foreach
					} // End if
					?>
				</table><!-- end .bwsp-group-button-sett -->
			</td>
		</tr>
	</tbody>
</table><!-- end .bwsp-post-sett-tbl -->

<table class="form-table bwsp-post-sett-tbl">
	<tbody>
		<tr>
			<th colspan="4">
				<div class="bwsp-sett-title"><?php _e('Button Settings', 'buttons-with-style'); ?></div>
			</th>
		</tr>
		<tr valign="top">
			<th scope="row">
				<label for="bwsp-btn-style-type"><?php _e('Button Type', 'buttons-with-style'); ?></label>
			</th>
			<td class="row-meta">
				<select name="<?php echo $prefix;?>button_type" class="bwsp-select-box bwsp-btn-style-type" id="bwsp-btn-style-type">
					<?php
					if( !empty($button_type) ) {
						foreach ($button_type as $key => $value) {
							echo '<option value="'.$key.'" '.selected($button_style_type,$key).'>'.$value.'</option>';
						}
					}
					?>
				</select><br/>
				<span class="description"><?php _e('Select button type.', 'buttons-with-style'); ?></span>
			</td>			
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="bwsp-btn-clr-class"><?php _e('Button Color Class', 'buttons-with-style'); ?></label>
			</th>
			<td class="row-meta">			
				<select name="<?php echo $prefix;?>button_class" class="bwsp-select-box bwsp-btn-clr-class" id="bwsp-btn-clr-class">
					<?php
					if( !empty($button_class) ) {
						foreach ($button_class as $key => $value) {
							echo '<option value="'.$key.'" '.selected($btn_clr_cls,$key).'>'.$value.'</option>';
						}
					}
					?>
				</select><br/>
				<span class="description"><?php _e('Select button color.', 'buttons-with-style'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="bwsp-btn-style-cls"><?php _e('Button Style', 'buttons-with-style'); ?></label>
			</th>
			<td class="row-meta">			
				<select name="<?php echo $prefix;?>button_style" id="bwsp-btn-style-cls" class="bwsp-select-box bwsp-btn-style-cls">
					<?php
					if( !empty($button_style) ) {
						foreach ($button_style as $key => $value) {
							echo '<option value="'.$key.'" '.selected($btn_style_type,$key).'>'.$value.'</option>';
						}
					}
					?>
				</select><br/>
				<span class="description"><?php _e('Select button style.', 'buttons-with-style'); ?></span>
			</td>			
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="bwsp-btn-size"><?php _e('Button Size', 'buttons-with-style'); ?></label>
			</th>
			<td class="row-meta">			
				<select name="<?php echo $prefix;?>button_size" id="bwsp-btn-size" class="bwsp-select-box bwsp-btn-size">
					<?php
					if( !empty($button_size) ) {
						foreach ($button_size as $key => $value) {
							echo '<option value="'.$key.'" '.selected($btn_size,$key).'>'.$value.'</option>';
						}
					}
					?>
				</select><br/>
				<span class="description"><?php _e('Select button size.', 'buttons-with-style'); ?></span>
			</td>			
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="bwsp-btn-icon-size"><?php _e('Button Icon Size', 'buttons-with-style'); ?></label>
			</th>
			<td class="row-meta">			
				<select name="<?php echo $prefix;?>button_icon_size" id="bwsp-btn-icon-size" class="bwsp-select-box bwsp-btn-icon-size">
					<?php
					if( $button_icon_size ) {
						foreach ($button_icon_size as $key => $value) {
							echo '<option value="'.$key.'" '.selected($btn_icon_size,$key).'>'.$value.'</option>';
						}
					}
					?>
				</select><br/>
				<span class="description"><?php _e('Select button icon size.', 'buttons-with-style'); ?></span>
			</td>			
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="bwsp-btn-link-target"><?php _e('Button Target', 'buttons-with-style'); ?></label>
			</th>
			<td class="row-meta">			
				<select name="<?php echo $prefix;?>button_link_target" id="bwsp-btn-link-target" class="bwsp-select-box bwsp-btn-link-target">
					<option value="_self" <?php selected($button_link_target, $key); ?>><?php _e('Same Tab', 'buttons-with-style'); ?></option>
					<option value="_blank" <?php selected($button_link_target, $key); ?>><?php _e('New Tab', 'buttons-with-style'); ?></option>
				</select><br/>
				<span class="description"><?php _e('Select link behaviour.', 'buttons-with-style'); ?></span>
			</td>			
		</tr>

	</tbody>
</table><!-- end .bwsp-post-sett-tbl -->