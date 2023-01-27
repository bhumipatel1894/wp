jQuery(document).ready(function($){

	// Initialize slick slider
	$( '.wphtsp-slider-nav' ).each(function( index ) {

		var slider_nav_id   	= $(this).attr('id');
		var wphtsp_slider_id 	= $(this).attr('data-slider-nav-for');
		var slider_conf 		= $.parseJSON( $(this).closest('.wphtsp-slider-wrp').find('.wphtsp-slider-conf').attr('data-conf') );

		// For Navigation
		if( typeof(wphtsp_slider_id) != 'undefined' && wphtsp_slider_id != '' ) {
			nav_id = '.'+wphtsp_slider_id;
		}

		// For slider
		if( typeof(wphtsp_slider_id) != 'undefined' && wphtsp_slider_id != '' ) {

			jQuery('.'+wphtsp_slider_id).slick({
				dots			: (slider_conf.dots)	== "true"	? true : false,
				infinite		: true,
				arrows			: false,
				speed 			: parseInt(slider_conf.speed),
				autoplay 		: (slider_conf.autoplay)	== "true"	? true : false,
				fade 			: (slider_conf.fade)	== "true" 	? true : false,
				autoplaySpeed 	: parseInt(slider_conf.autoplayInterval),
				asNavFor 		: '#'+slider_nav_id,
				slidesToShow 	: 1,
				slidesToScroll 	: 1,
				adaptiveHeight	: (slider_conf.adaptiveheight)	== "false"	? false : true,
				fade 			: (slider_conf.fade)	== "true"	? true : false,
				mobileFirst    	: (wphtsPro.is_mobile	== 1)		? true : false,
				rtl             : (slider_conf.rtl		== "true")	? true : false,
				initialSlide	: parseInt(slider_conf.first_slide),
			});
		}

		// For Navigation
		if( typeof(slider_nav_id) != 'undefined' ) {
			
			jQuery('#'+slider_nav_id).slick({
				slidesToShow 	: parseInt(slider_conf.slidestoshow),
				slidesToScroll 	: 1,
				asNavFor 		: nav_id,
				arrows			: (slider_conf.arrows)	== "true"	? true : false,
				dots 			: false,
				speed 			: parseInt(slider_conf.speed),
				centerMode 		: (slider_conf.nav_centermode)	== "false"	? false : true,
				focusOnSelect 	: true,
				centerPadding 	: '10px',
				mobileFirst    	: (wphtsPro.is_mobile	== 1)	? true : false,
				rtl             : (slider_conf.rtl == "true")	? true : false,
				initialSlide	: parseInt(slider_conf.first_slide),
				responsive 		: [
				{
                    breakpoint: 1023,
                    settings: {
                        slidesToShow: (parseInt(slider_conf.slidestoshow) > 3) ? 3 : parseInt(slider_conf.slidestoshow),
                    }
                },{
                    breakpoint: 767,
                    settings: {
                        slidesToShow: (parseInt(slider_conf.slidestoshow) > 3) ? 3 : parseInt(slider_conf.slidestoshow),
                    }
                },
                {
                    breakpoint: 479,
                    settings: {
                        slidesToShow: 1,
                    }
                },
                {
                    breakpoint: 319,
                    settings: {
                        slidesToShow: 1,
                    }
                }
				]
			});
		}
	});

	//on scolling, show/animate timeline blocks when enter the viewport
	var timelineBlocks = $('.wphtsp-timeline-block');
	var offset = 0.8;
	$(window).on('scroll', function(){
		(!window.requestAnimationFrame) 
		? setTimeout(function(){ showBlocks(timelineBlocks, offset); }, 100)
		: window.requestAnimationFrame(function(){ showBlocks(timelineBlocks, offset); });
	});
});

function showBlocks(blocks, offset) {
	blocks.each(function(){
		var animation = jQuery(this).closest('.wphtsp-history-inner-wrp').attr('data-animation');
		( jQuery(this).offset().top <= jQuery(window).scrollTop()+jQuery(window).height()*offset && jQuery(this).find('.wphtsp-timeline-img, .wphtsp-timeline-content, .wphtsp-timeline-date').hasClass('wphtsp-is-hidden') ) && jQuery(this).find('.wphtsp-timeline-img, .wphtsp-timeline-content, .wphtsp-timeline-date').removeClass('wphtsp-is-hidden').addClass(animation);
	});
}