jQuery( document ).ready(function($) {

	if( WpspwProAdmin.new_ui == 1 ){
    	
    	$('.wpspw-color-box').wpColorPicker();

    } else {

    	var inputcolor = jQuery('.wpspw-color-box-farbtastic').prev('input').val();
		jQuery('.wpspw-color-box-farbtastic').prev('input').css('background-color',inputcolor);
		jQuery('.wpspw-color-box-farbtastic').click(function(e) {
			colorPicker = jQuery(this).next('div');
			input = jQuery(this).prev('input');
			jQuery.farbtastic(jQuery(colorPicker), function(a) { jQuery(input).val(a).css('background', a); });
			colorPicker.show();
			e.preventDefault();
			jQuery(document).mousedown( function() { jQuery(colorPicker).hide(); });
		});
    }

	// Media Uploader
	$( document ).on( 'click', '.wpspw-pro-image-upload', function() {
		
		var imgfield,showfield;
		imgfield = jQuery(this).prev('input').attr('id');
		showfield = jQuery(this).parents('td').find('.wpspw-pro-img-view');
    	 
		if(typeof wp == "undefined" || WpspwProAdmin.new_ui != '1' ){// check for media uploader
			
			tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
	    	
			window.original_send_to_editor = window.send_to_editor;
			window.send_to_editor = function(html) {
				
				if(imgfield) {
					
					var mediaurl = $('img',html).attr('src');
					$('#'+imgfield).val(mediaurl);
					showfield.html('<img src="'+mediaurl+'" />');
					tb_remove();
					imgfield = '';
					
				} else {
					window.original_send_to_editor(html);
				}
			};
	    	return false;
			
		      
		} else {
			
			var file_frame;
			
			//new media uploader
			var button = jQuery(this);
		
			// If the media frame already exists, reopen it.
			if ( file_frame ) {
				file_frame.open();
			  return;
			}
	
			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				frame: 'post',
				state: 'insert',
				title: button.data( 'uploader-title' ),
				button: {
					text: button.data( 'uploader-button-text' ),
				},
				multiple: false  // Set to true to allow multiple files to be selected
			});
	
			file_frame.on( 'menu:render:default', function(view) {
		        // Store our views in an object.
		        var views = {};
	
		        // Unset default menu items
		        view.unset('library-separator');
		        view.unset('gallery');
		        view.unset('featured-image');
		        view.unset('embed');
	
		        // Initialize the views in our view object.
		        view.set(views);
		    });
	
			// When an image is selected, run a callback.
			file_frame.on( 'insert', function() {
	
				// Get selected size from media uploader
				var selected_size = $('.attachment-display-settings .size').val();
				
				var selection = file_frame.state().get('selection');
				selection.each( function( attachment, index ) {
					attachment = attachment.toJSON();
					
					// Selected attachment url from media uploader
					var attachment_url = attachment.sizes[selected_size].url;
					
					if(index == 0){
						// place first attachment in field
						$('#'+imgfield).val(attachment_url);
						showfield.html('<img src="'+attachment_url+'" />');
						
					} else{
						$('#'+imgfield).val(attachment_url);
						showfield.html('<img src="'+attachment_url+'" />');
					}
				});
			});
	
			// Finally, open the modal
			file_frame.open();
		}
	});
	
	// Clear Media
	$( document ).on( 'click', '.wpspw-pro-image-clear', function() {
		$(this).parent().find('.wpspw-pro-img-upload-input').val('');
		$(this).parent().find('.wpspw-pro-img-view').html('');
	});
	
	// Reset settings
    $( document ).on( 'click', '.wpspw-reset-sett', function() {
		
		var ans;
		ans = confirm(WpspwProAdmin.reset_msg);

		if(ans) {
			return true;
		} else {
			return false;
		}
	});
});