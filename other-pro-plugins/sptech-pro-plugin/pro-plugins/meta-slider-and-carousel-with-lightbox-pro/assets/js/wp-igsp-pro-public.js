jQuery(document).ready(function($){

	// Initialize Slider
	$( '.msacwl-slider' ).each(function( index ) {
		
		var slider_id   	= $(this).attr('id');
		var nav_id 			= null;
		var slider_nav_id 	= $(this).attr('data-slider-nav-for');
		var slider_conf 	= $.parseJSON( $(this).parent('.msacwl-slider-wrap').find('.msacwl-slider-conf').text());

		// For Navigation
		if( typeof(slider_nav_id) != 'undefined' && slider_nav_id != '' ) {
			nav_id = '.'+slider_nav_id;
		}
		
		jQuery('#'+slider_id+' .msacwl-gallery-slider').slick({
			dots			: (slider_conf.dots) == "true" ? true : false,
			infinite		: (slider_conf.loop) == "true" ? true : false,
			arrows			: (slider_conf.arrows) == "true" ? true : false,
			speed			: parseInt(slider_conf.speed),
			autoplay		: (slider_conf.autoplay) == "true" ? true : false,
			autoplaySpeed	: parseInt(slider_conf.autoplay_speed),
			rtl             : (WpIsgp.is_rtl) == "true" ? true : false,
			mobileFirst    	: (WpIsgp.is_mobile == 1) ? true : false,
			asNavFor		: nav_id,
		});

		// For Navigation
		if( typeof(slider_nav_id) != 'undefined' ) {
			jQuery('.'+slider_nav_id).slick({
				slidesToShow 	: parseInt(slider_conf.nav_slide_column),
				slidesToScroll 	: 1,
				asNavFor 		: '#'+slider_id+' .msacwl-gallery-slider',
				dots 			: false,
				arrows 			: true,
				centerMode 		: true,
				focusOnSelect 	: true,
				rtl 			: (WpIsgp.is_rtl) == "true" ? true : false,
				mobileFirst    	: (WpIsgp.is_mobile == 1) ? true : false,
				infinite 		: true,
				responsive 		: [
				{
					breakpoint 	: 768,
					settings 	: {
						slidesToShow 	: (parseInt(slider_conf.nav_slide_column) > 5) ? 5 : parseInt(slider_conf.nav_slide_column),
						slidesToScroll 	: 1,
						infinite 		: true,
						dots 			: false,
						centerMode 		: true,
					}
				},
				{
					breakpoint 	: 640,
					settings   	: {
						slidesToShow 	: (parseInt(slider_conf.nav_slide_column) > 3) ? 3 : parseInt(slider_conf.nav_slide_column),
						slidesToScroll 	: 1,
						centerMode 		: true,
					}
				},
				{
					breakpoint	: 480,
					settings	: {
						slidesToShow 	: (parseInt(slider_conf.nav_slide_column) > 3) ? 3 : parseInt(slider_conf.nav_slide_column),
						slidesToScroll 	: 1,
						vertical 		: false,
						dots 			: false,
						centerMode 		: true,
					}
				},
				{
					breakpoint: 319,
					settings: {
						slidesToShow: (parseInt(slider_conf.nav_slide_column) > 2) ? 2 : parseInt(slider_conf.nav_slide_column),
						slidesToScroll: 1,
						dots: false,
						centerMode :false,
					}
				}]
			});
		}
	});
	
	// Initialize Carousel
	$( '.msacwl-carousel' ).each(function( index ) {
		
		var slider_id   = $(this).attr('id');
		var slider_conf = $.parseJSON( $(this).parent('.msacwl-carousel-wrap').find('.msacwl-carousel-conf').text());
		
		jQuery('#'+slider_id+' .msacwl-gallery-carousel').slick({
			dots			: (slider_conf.dots) == "true" ? true : false,
			infinite		: (slider_conf.loop) == "true" ? true : false,
			arrows			: (slider_conf.arrows) == "true" ? true : false,
			speed			: parseInt(slider_conf.speed),
			autoplay		: (slider_conf.autoplay) == "false" ? false : true,
			autoplaySpeed	: parseInt(slider_conf.autoplay_speed),
			slidesToShow	: parseInt(slider_conf.slide_to_show),
			slidesToScroll	: parseInt(slider_conf.slide_to_scroll),
			centerMode 		: (slider_conf.centermode) == "true" ? true : false,
			rtl             : (WpIsgp.is_rtl) == "true" ? true : false,
			mobileFirst    	: (WpIsgp.is_mobile == 1) ? true : false,
			responsive: [{
				breakpoint: 1023,
				settings: {
					slidesToShow: (parseInt(slider_conf.slide_to_show) > 3) ? 3 : parseInt(slider_conf.slide_to_show),
					slidesToScroll: 1,
				}
			},{
				breakpoint: 767,	  			
				settings: {
					slidesToShow: (parseInt(slider_conf.slide_to_show) > 2) ? 2 : parseInt(slider_conf.slide_to_show),
					slidesToScroll: 1
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					dots: false,
					centerMode :false,
				}
			},
			{
				breakpoint: 319,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					dots: false,
					centerMode :false,
				}
			}]
		});
	});

	// For Variable width
	$( '.msacwl-variable' ).each(function( index ) {
		
		var slider_id   	= $(this).attr('id');
		var nav_id 			= null;
		var slider_nav_id 	= $(this).attr('data-slider-nav-for');
		var slider_conf 	= $.parseJSON( $(this).closest('.msacwl-variable-wrap').find('.msacwl-variable-conf').text());

		// For Navigation
		if( typeof(slider_nav_id) != 'undefined' && slider_nav_id != '' ) {
			nav_id = '.'+slider_nav_id;
		}

		jQuery('#'+slider_id+' .msacwl-gallery-variable').slick({
			dots			: (slider_conf.dots) == "true" ? true : false,
			infinite		: (slider_conf.loop) == "true" ? true : false,
			arrows			: (slider_conf.arrows) == "true" ? true : false,
			speed			: parseInt(slider_conf.speed),
			autoplay		: (slider_conf.autoplay) == "true" ? true : false,
			autoplaySpeed	: parseInt(slider_conf.autoplay_speed),
			slidesToShow	: 1,
			slidesToScroll	: 1,
			centerMode 		: true,
			rtl             : (WpIsgp.is_rtl) == "true" ? true : false,
			mobileFirst    	: (WpIsgp.is_mobile == 1) ? true : false,
			variableWidth 	: false,
			asNavFor		: nav_id,
			responsive 		: [{
				breakpoint 	: 1023,
				settings 	: {
					infinite 		: (slider_conf.loop) == "true" ? true : false,
					dots 			: (slider_conf.dots) == "true" ? true : false,
				}
			},{
				breakpoint 	: 766,	  			
				settings	: {
					infinite 		: (slider_conf.loop) == "true" ? true : false,
					dots 			: (slider_conf.dots) == "true" ? true : false,
				}
			},
			{
				breakpoint 	: 479,
				settings 	: {
					dots 			: false,
					centerMode 		: false,
					infinite 		: (slider_conf.loop) == "true" ? true : false,
				}
			},
			{
				breakpoint	: 319,
				settings	: {
					dots			: false,
					centerMode 		: false,
					infinite 		: (slider_conf.loop) == "true" ? true : false,
				}
			}]
		});

		// For Navigation
		if( typeof(slider_nav_id) != 'undefined' ) {
			jQuery('.'+slider_nav_id).slick({
				slidesToShow 	: parseInt(slider_conf.nav_slide_column),
				slidesToScroll 	: 1,
				asNavFor 		: '#'+slider_id+' .msacwl-gallery-variable',
				dots 			: false,
				arrows 			: true,
				centerMode 		: true,
				focusOnSelect 	: true,
				rtl 			: (WpIsgp.is_rtl) == "true" ? true : false,
				mobileFirst    	: (WpIsgp.is_mobile == 1) ? true : false,
				infinite 		: (slider_conf.loop) == "true" ? true : false,
				responsive 		: [
				{
					breakpoint 	: 768,
					settings 	: {
						slidesToShow 	: (parseInt(slider_conf.nav_slide_column) > 5) ? 5 : parseInt(slider_conf.nav_slide_column),
						slidesToScroll 	: 1,
						infinite 		: true,
						dots 			: false,
						centerMode 		: true,
					}
				},
				{
					breakpoint 	: 640,
					settings   	: {
						slidesToShow 	: (parseInt(slider_conf.nav_slide_column) > 3) ? 3 : parseInt(slider_conf.nav_slide_column),
						slidesToScroll 	: 1,
						centerMode 		: true,
					}
				},
				{
					breakpoint	: 480,
					settings	: {
						slidesToShow 	: (parseInt(slider_conf.nav_slide_column) > 3) ? 3 : parseInt(slider_conf.nav_slide_column),
						slidesToScroll 	: 1,
						vertical 		: false,
						dots 			: false,
						centerMode 		: true,
					}
				},
				{
					breakpoint: 319,
					settings: {
						slidesToShow: (parseInt(slider_conf.nav_slide_column) > 2) ? 2 : parseInt(slider_conf.nav_slide_column),
						slidesToScroll: 1,
						dots: false,
						centerMode :false,
					}
				}]
			});
		}
	});


	// Magnific Popup
	$( '.msacwl-slider-popup' ).each(function( index ) {

		var popup_id = $(this).attr('id');
		
		if( typeof('popup_id') !== 'undefined' && popup_id != '' ) {

			var total_item	= $('#'+popup_id+' .msacwl-slide:not(.slick-cloned) a').length;

			$('#'+popup_id).magnificPopup({
			
				delegate: '.slick-slide a',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				mainClass: 'mfp-with-zoom mfp-img-mobile msacwl-mfp-popup',
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1], // Will preload 0 - before current, and 1 after the current image
					tCounter: '<span class="mfp-counter">%curr% of %total%</span>' // markup of counter
				},
				image: {
					titleSrc: function(item) {
						return item.el.closest('.msacwl-img-wrap').find('.msacwl-img').attr('title');
					}
				},
				zoom: {
					enabled: false,
					duration: 300, // don't foget to change the duration also in CSS
					opener: function(element) {
						return element.closest('.msacwl-img-wrap').find('.msacwl-img');
					}
				},
				callbacks: {
					markupParse: function(template, values, item) {
						var current_indx 	= item.el.closest('.msacwl-slide').attr('data-item-index');
						values.counter 		= current_indx+' of '+total_item;
					}
				},
			});
		}
	});
});