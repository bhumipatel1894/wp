jQuery(document).ready(function($){

	$( '.wp-vgp-video-gallery-slider' ).each(function( index ) {

		var slider_id   = $(this).attr('id');
		var slider_conf = $.parseJSON( $(this).closest('.wp-vgp-video-slider-wrap').find('.wp-vgp-slider-conf').attr('data-conf') );

		jQuery('#'+slider_id).slick({
			infinite		: (slider_conf.loop) == "true" ? true : false,
			dots			: false,
			pauseOnFocus	: false,
			arrows			: (slider_conf.arrows) == "true" ? true : false,
			speed			: parseInt(slider_conf.speed),
			autoplay		: (slider_conf.autoplay) == "true" ? true : false,
			autoplaySpeed	: parseInt(slider_conf.autoplay_speed),
			slidesToShow	: parseInt(slider_conf.slide_to_show),
			slidesToScroll	: parseInt(slider_conf.slide_to_scroll),
			centerMode      : (slider_conf.center_mode) == "true" ? true : false,
			rtl             : (slider_conf.rtl) == "true" ? true : false,
			responsive: [{
				breakpoint: 1023,
				settings: {
					slidesToShow: (parseInt(slider_conf.slide_to_show) > 3) ? 3 : (parseInt(slider_conf.slide_to_show)),
					slidesToScroll: 1,
					dots: false
				}
			},{

				breakpoint: 767,
				settings: {
					slidesToShow: (parseInt(slider_conf.slide_to_show) > 2) ? 2 : (parseInt(slider_conf.slide_to_show)),
					slidesToScroll: 1,
					centerMode: false,
					dots: false
				}
			},
			{
				breakpoint: 479,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					dots: false,
					centerMode:false
				}
			},
			{
				breakpoint: 319,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					dots: false,
					centerMode:false
				}
			}]
		});
		
		// Initialize magnific on video slider
		var pupup_id   = $(this).attr('id');
		var pupup_conf = $.parseJSON( $(this).closest('.wp-vgp-video-slider-wrap').find('.wp-vgp-popup-conf').attr('data-conf'));	

		jQuery('#'+slider_id+ ' .wp-vgp-popup-modal').magnificPopup({
		  	type: 'inline',
		  	mainClass: 'wp-vgp-mfp-popup wp-vgp-mfp-zoom-in',
		  	removalDelay: 160,
		  	gallery: {
			  enabled: (pupup_conf.gallery_enable == "true") ? true : false,
			},
			preloader: false,
			fixedContentPos: (pupup_conf.popup_fix == "true") ? true : false,
			callbacks: {
				beforeOpen: function() {

					// Pause slick slider
					if( slider_conf.autoplay == 'true' ) {
						$('#'+slider_id).slick('slickPause');
					}
				},
				change: function() {

					// Removing the source so video can not be load if autoplay
					$('.wp-vgp-popup-wrp .wpos-iframe-video-opened').each(function( index ) {
						$(this).attr('src', 'about:blank');
						$(this).removeClass('wpos-iframe-video-opened');
					});

					wp_vgp_refresh_html5_video();

					var frame_obj 			= this.content.find('.wpos-iframe-video');
					var frame_orginal_src 	= frame_obj.attr('data_src');
					
					if( typeof(frame_orginal_src) != 'undefined' ) {
						frame_obj.addClass('wpos-iframe-video-opened');
						frame_obj.attr('src', frame_orginal_src);
					}
				},
				close: function() {

					var frame_obj = this.content.find('.wpos-iframe-video');
					frame_obj.attr('src', 'about:blank');
					frame_obj.removeClass('wpos-iframe-video-opened');

					wp_vgp_refresh_html5_video();

					// Play slick slider
					if( slider_conf.autoplay == 'true' ) {
						$('#'+slider_id).slick('slickPlay');
					}
				}
			}
		});
	});

	// Initialize magnific on video grid
	$( '.wp-vgp-video-grid-wrp' ).each(function( index ) {
		var pupup_id   = $(this).attr('id');
		var pupup_conf = $.parseJSON( $(this).find('.wp-vgp-popup-conf').attr('data-conf') );	

		jQuery('#'+pupup_id+ ' .wp-vgp-popup-modal').magnificPopup({		
			type: 'inline',
			mainClass: 'wp-vgp-mfp-popup wp-vgp-mfp-zoom-in',
			removalDelay: 160,
			gallery: {
				enabled: (pupup_conf.gallery_enable) == "true" ? true : 0,
			},
			preloader: false,
			fixedContentPos: (pupup_conf.popup_fix) == "true" ? true : 0,
			callbacks: {
				change: function(item) {
						// Removing the source so video can not be load if autoplay
						$('.wp-vgp-popup-wrp .wpos-iframe-video-opened').each(function( index ) {
							$(this).attr('src', 'about:blank');
							$(this).removeClass('wpos-iframe-video-opened');
						});

						wp_vgp_refresh_html5_video();

						var frame_obj 			= this.content.find('.wpos-iframe-video');
						var frame_orginal_src 	= frame_obj.attr('data_src');

						if( typeof(frame_orginal_src) != 'undefined' ) {
							frame_obj.addClass('wpos-iframe-video-opened');
							frame_obj.attr('src', frame_orginal_src);
						}
					},
				close: function() {
					var frame_obj = this.content.find('.wpos-iframe-video');
					frame_obj.attr('src', 'about:blank');
					frame_obj.removeClass('wpos-iframe-video-opened');

					wp_vgp_refresh_html5_video();
				}
			}
		});
	});

	// Intialize JW Player
	if(Wpvgp.jwp_enable && Wpvgp.jwp_lc_key != '') {

		jwplayer.key = Wpvgp.jwp_lc_key;

		$('.wp-vgp-jwplayer-list').each(function( index ) {

			var jwplayer_id = $(this).attr('id');
			var file 		= $(this).attr('data-file');
			var image 		= $(this).attr('data-image');

			if( typeof(jwplayer_id) != 'undefined' && jwplayer_id != '' ) {
				jwplayer(jwplayer_id).setup({
					"file" 	: file,
					"image" : image,
				});
			}
		});
	}
});

// Function to pause HTML5 video
function wp_vgp_refresh_html5_video() {
	jQuery('.wp-vgp-popup-wrp .wp-vgp-video-frame').each(function( index ) {
		if (!jQuery(this).get(0).paused) {
			jQuery(this).get(0).pause();
		}
	});
}