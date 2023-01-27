jQuery(document).ready(function($) {

	// For Slider
	$( '.iscwp-gallery-slider' ).each(function( index ) {

		var slider_id   = $(this).attr('id');
		var slider_conf = $.parseJSON( $(this).closest('.iscwp-gallery-slider-wrp').find('.iscwp-gallery-slider-conf').attr('data-conf') );

		jQuery('#'+slider_id).slick({
			dots			: (slider_conf.dots) == "true" ? true : false,
			infinite		: (slider_conf.loop) == "true" ? true : false,
			arrows			: (slider_conf.arrows) == "true" ? true : false,
			speed			: parseInt(slider_conf.speed),
			autoplay		: (slider_conf.autoplay) == "true" ? true : false,
			autoplaySpeed	: parseInt(slider_conf.autoplay_interval),
			slidesToShow	: parseInt(slider_conf.slidestoshow),
			slidesToScroll	: parseInt(slider_conf.slidestoscroll),
			centerMode 		: (slider_conf.centermode) == "true" ? true : false,
			pauseOnFocus	: false,
			rtl             : (IscwPro.is_rtl == 1) ? true : false,
			//mobileFirst   : (IscwPro.is_mobile == 1) ? true : false,
			responsive 		: [{
				breakpoint 	: 1023,
				settings 	: {
					slidesToShow 	: (parseInt(slider_conf.slidestoshow) > 3) ? 3 : parseInt(slider_conf.slidestoshow),
					slidesToScroll 	: 1,
					dots 			: (slider_conf.dots) == "true" ? true : false,
				}
			},{
				breakpoint	: 767,
				settings	: {
					slidesToShow 	: (parseInt(slider_conf.slidestoshow) > 2) ? 2 : parseInt(slider_conf.slidestoshow),
					slidesToScroll 	: 1,
					dots 			: (slider_conf.dots) == "true" ? true : false,
					centerMode 		: false,
				}
			},
			{
				breakpoint	: 479,
				settings	: {
					slidesToShow 	: 1,
					slidesToScroll 	: 1,
					dots 			: false,
					centerMode 		: false,
				}
			},
			{
				breakpoint	: 319,
				settings	: {
					slidesToShow 	: 1,
					slidesToScroll 	: 1,
					dots 			: false,
					centerMode 		: false,
				}
			}]
		});
	});

	// Popup Gallery
	$( '.iscwp-popup-gallery' ).each(function( index ) {
		
		var gallery_id	= $(this).attr('id');
		
		if( typeof(gallery_id) !== 'undefined' && gallery_id != '' ) {

			var popup_conf = $.parseJSON($(this).closest('.iscwp-main-wrp').find('.wp-iscwp-popup-conf').attr('data-conf'));

			$('#'+gallery_id).magnificPopup({
				delegate: 'a.iscwp-img-link',
				type: 'inline',
				mainClass: 'iscwp-mfp-popup iscwp-mfp-zoom-in',
				tLoading: 'Loading image #%curr%...',
				fixedContentPos: true,
				removalDelay: 160,
				gallery: {
					enabled : (popup_conf.popup_gallery) == "true" ? true : false,
				},
			});
		}
	});

	// Old Browser detection
	if( IscwPro.is_old_browser == 1 ) {
        $( '.iscwp-image-fit .iscwp-cnt-wrp' ).each(function( index ) {
            var img_obj     = $(this).find('.iscwp-img');

            if( typeof(img_obj) !== 'undefined' ) {
                var img_url = img_obj.attr('src');

                img_obj.closest('.iscwp-img-wrp').css({"background": "url("+img_url+") no-repeat top center", "background-size": "cover"});
                img_obj.hide();
            }
        });
    }
});