jQuery( document ).ready(function($) {

	// Logo Slider
	$( '.wpls-logo-slider' ).each(function( index ) {
		
		var slider_id   = $(this).attr('id');
		var logo_conf 	= $.parseJSON( $(this).closest('.wpls-logo-showcase-slider-wrp').find('.wpls-logo-showacse-slider-conf').text() );
		
		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
			jQuery('#'+slider_id).slick({

				centerMode			: (logo_conf.center_mode) == "true" ? true : false,
				dots				: (logo_conf.dots) == "true" ? true : false,
				arrows				: (logo_conf.arrows) == "true" ? true : false,
				infinite			: (logo_conf.loop) == "true" ? true : false,
				speed				: parseInt(logo_conf.speed),
				autoplay			: (logo_conf.autoplay) == "true" ? true : false,
				slidesToShow		: parseInt(logo_conf.slides_column),
				slidesToScroll		: parseInt(logo_conf.slides_scroll),
				autoplaySpeed		: parseInt(logo_conf.autoplay_interval),
				rtl             	: (logo_conf.rtl) == "true" ? true : false,
				cssEase				: (logo_conf.ticker) == "true" ? "linear" : "ease",
				mobileFirst    		: (WplsPro.is_mobile == 1) ? true : false,
				responsive: [{
					breakpoint: 1023,
					settings: {
						slidesToShow	: (parseInt(logo_conf.slides_column) > 3) ? 3 : parseInt(logo_conf.slides_column),
						slidesToScroll	: 1
					}
				},{
					breakpoint: 640,
					settings: {
						slidesToShow	: (parseInt(logo_conf.slides_column) > 2) ? 2 : parseInt(logo_conf.slides_column),
						slidesToScroll	: 1
					}
				},{
					breakpoint: 479,
					settings: {
						slidesToShow	: 1,
						slidesToScroll	: 1
					}
				},{
					breakpoint: 319,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}]
			});
		}
	});

	// Logo Showcase widget
	$( '.wpls-logo-widget-slider' ).each(function( index ) {
		var slider_id   = $(this).attr('id');
		var logo_conf 	= $.parseJSON( $(this).closest('.wpls-logo-widget-slider-wrp').find('.wpls-logo-showacse-slider-conf').text() );
		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
			jQuery('#'+slider_id).slick({
				centerMode			: (logo_conf.center_mode) == "true" ? true : false,
				dots				: (logo_conf.dots) == "true" ? true : false,
				arrows				: (logo_conf.arrows) == "true" ? true : false,
				infinite			: (logo_conf.loop) == "true" ? true : false,
				speed				: parseInt(logo_conf.speed),
				autoplay			: (logo_conf.autoplay) == "true" ? true : false,
				slidesToShow		: parseInt(logo_conf.slides_column),
				slidesToScroll		: parseInt(logo_conf.slides_scroll),
				autoplaySpeed		: parseInt(logo_conf.autoplay_interval),
				rtl             	: (WplsPro.is_rtl == 1) ? true : false,
				cssEase				: (logo_conf.ticker) == "true" ? "linear" : "ease",
			});
		}
	});
	
	// For logo animation
	$( '.wpls-logo-showcase' ).each(function( index ) {
		
		var anim_cls = $(this).attr('data-animation');

		if( typeof(anim_cls) != 'undefined' && anim_cls !='' ) {

			var anim_cls = 'animated' +' '+ anim_cls;

			$(this).find('.wpls-logo-cnt').hover(function() {
				jQuery(this).addClass(anim_cls).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',function(){
					jQuery(this).removeClass(anim_cls);
				});
			});

			$( ".wpls-logo-cnt" ).mouseleave(function() {
				$(this).removeClass(anim_cls);
			});
		}
	});

	// Logo Showcase Tooltip
	if( $('.wpls-tooltip').length > 0) {
		$('.wpls-tooltip').tooltipster({
			theme 		: 'tooltipster-'+WplsPro.tooltip_theme,
			animation 	: WplsPro.tooltip_animation,
			delay 		: parseInt(WplsPro.tooltip_delay),
			trigger 	: WplsPro.tooltip_behavior,
			arrow 		: (WplsPro.tooltip_arrow) == 1 ? true : false,
			distance 	: (parseInt(WplsPro.tooltip_distance)) == "" ? '1' : parseInt(WplsPro.tooltip_distance),
			maxWidth 	: parseInt(WplsPro.tooltip_maxwidth),
			minWidth 	: parseInt(WplsPro.tooltip_minwidth),
		});
	}
	
	// Logo Showcase Filter
	if( $('.wpls-filtr-container').length > 0) {
		jQuery('.wpls-filtr-container').filterizr({
			selector 	: '.wpls-filtr-container',
			layout 		: 'sameWidth',
		});
		
		$(document).on('click', '.wpls-filter li', function(){
			$('.wpls-filtr-cat').removeClass('wpls-active-filtr');
			$(this).addClass('wpls-active-filtr');
		});
	}
});