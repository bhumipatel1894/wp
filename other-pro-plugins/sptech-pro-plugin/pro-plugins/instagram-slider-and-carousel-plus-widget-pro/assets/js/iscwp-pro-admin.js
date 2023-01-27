jQuery(document).ready(function($) {

	$(document).on('click', '.iscwp-crl-cache', function() {

		var current_obj = $(this);
		var user_name = current_obj.attr('data-user');

		$('.iscwp-msg-wrap').remove();
		current_obj.attr('disabled','disabled');
		current_obj.parent().find('.spinner').css('visibility', 'visible');

		var data = {
            action  		: 'iscwp_pro_clear_cache',
            user_name   	: user_name,
        };

        $.post(ajaxurl,data,function(response) {

        	var result = jQuery.parseJSON(response);

        	if( result.success == 1 ) {
				current_obj.closest('tr.iscwp-user').fadeOut(300, function(){
					$(this).remove();

					var tr_cnt = current_obj.closest('table').find('tr.iscwp-user').length;
					if( tr_cnt <= 0 ) {
						$('.iscwp-cache-empty').fadeIn();
					}
				});

				$('body').append('<div class="iscwp-msg-wrap">'+result.msg+'</div>');
			} else{

				$('body').append('<div class="iscwp-msg-wrap iscwp-msg-err">'+result.msg+'</div>');
			}

			$('.iscwp-msg-wrap').animate({bottom: '80px'}, 400);
			current_obj.removeAttr('disabled','disabled');
			current_obj.parent().find('.spinner').css('visibility', 'hidden');

			setTimeout(function() {
				$(".iscwp-msg-wrap").fadeOut("normal", function() {
					$(this).remove();
			    });
			}, 2000);
        });
	});

	// Flush all cache
	$(document).on('click', '.iscwp-crl-all-cache', function() {

		var current_obj = $(this);

		current_obj.attr('disabled','disabled');
		current_obj.closest('#general').find('#iscwp-cache-user table tr input').attr('disabled','disabled');

		var data = {
            action  : 'iscwp_pro_clear_all_cache',
        };

        $.post(ajaxurl,data,function(response) {

        	var result = jQuery.parseJSON(response);

        	if( result.success == 1 ) {

        		$('body').append('<div class="iscwp-msg-wrap">'+result.msg+'</div>');
				current_obj.closest('table').find('tr.iscwp-user').fadeOut(300, function(){
					$(this).remove();
				});

				$('.iscwp-cache-empty').fadeIn();
			} else{
				$('body').append('<div class="iscwp-msg-wrap iscwp-msg-err">'+result.msg+'</div>');
			}

			$('.iscwp-msg-wrap').animate({bottom: '80px'}, 400);
			current_obj.removeAttr('disabled','disabled');
			current_obj.parent().find('.spinner').css('visibility', 'hidden');

			setTimeout(function() {
				$(".iscwp-msg-wrap").fadeOut("normal", function() {
					$(this).remove();
			    });
			}, 2000);
        });
	});
});