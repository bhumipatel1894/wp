jQuery( document ).ready(function($) {
	
	$( document ).on( "click", ".wp-vgp-mb-nav a", function() {
		
        //  First remove class "active" from currently active tab
        $(".wp-vgp-mb-nav").removeClass('wp-vgp-active');
        	
        //  Now add class "active" to the selected/clicked tab
        $(this).parent('.wp-vgp-mb-nav ').addClass("wp-vgp-active");
        	
        //  Hide all tab content
        $(".wp-vgp-tab-cnt").hide();
        	
        //  Here we get the href value of the selected tab
        var selected_tab = $(this).attr("href");
        	
        //  Show the selected tab content
        $(selected_tab).show();

        // Pass selected tab
        $('.wp-vgp-selected-tab').val(selected_tab);

        //  At the end, we add return false so that the click on the link is not executed
        return false;
    });

    // Remain selected tab for user
    if( $('.wp-vgp-selected-tab').length > 0 ) {
        var sel_tab = $('.wp-vgp-selected-tab').val();

        if( typeof(sel_tab) !== 'undefined' && sel_tab != ''  ) {
            $('.wp-vgp-mb-nav [href="'+sel_tab+'"]').click();
        }
    }

    // Color Picker
    $('.wp-vgp-color-box').wpColorPicker();

    // Media Uploader
    $( document ).on( 'click', '.wp-vgp-image-upload', function() {
        
        var imgfield,showfield;
        imgfield = jQuery(this).prev('input').attr('id');
        showfield = jQuery(this).parents('td').find('.wp-vgp-img-view');
        
        if(typeof wp == "undefined" || WpVgpAdmin.new_ui != '1' ){ // Check for media uploader
            
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
    $( document ).on( 'click', '.wp-vgp-image-clear', function() {
        $(this).parent().find('.wp-vgp-img-upload-input').val('');
        $(this).parent().find('.wp-vgp-img-view').html('');
    });

    // Reset Settings
    $( document ).on( 'click', '.wp-vgp-reset-sett', function() {
        var ans;
        ans = confirm(WpVgpAdmin.reset_msg);

        if(ans) {
            return true;
        } else {
            return false;
        }
    });
});