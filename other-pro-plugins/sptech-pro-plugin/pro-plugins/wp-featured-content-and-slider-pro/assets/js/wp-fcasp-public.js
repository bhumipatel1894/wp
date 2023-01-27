jQuery( document ).ready(function($) {
	
	// Initialize slick slider
	$( '.wp-fcasp-content-slider' ).each(function( index ) {
		
		var slider_id 	= $(this).attr('id');
		var slider_conf = $.parseJSON( $(this).closest('.wp-fcasp-content-wrp').find('.wp-fcasp-slider-conf').text() );
		
		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
			
			jQuery('#'+slider_id).slick({
				dots 			: (slider_conf.slidedots) == "true" ? true : false,
				infinite		: (slider_conf.infinite) == "true" ? true : false,
				arrows			: (slider_conf.slidearrows) == "true" ? true : false,
				speed 			: parseInt(slider_conf.slidespeed),
				autoplay 		: (slider_conf.slideautoplay) == "true" ? true : false,
				autoplaySpeed 	: parseInt(slider_conf.slideautoplayInterval),
				slidesToShow 	: parseInt(slider_conf.slidesColumn),
				slidesToScroll 	: parseInt(slider_conf.slidesScroll),
				centerMode 		: (slider_conf.centermode) == "true" ? true : false,
				prevArrow 		: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="fa fa-angle-left"></i></button>',
      			nextArrow		: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="fa fa-angle-right"></i></button>',
				rtl 			: (slider_conf.rtl) == "true" ? true : false,
				mobileFirst		: WpFcasp.is_mobile == 1 ? true : false,
				responsive 		: [{
					      			breakpoint: 1023,
									    settings: {
									        slidesToShow: (parseInt(slider_conf.slidesColumn) > 3) ? 3 : parseInt(slider_conf.slidesColumn),
									        slidesToScroll: 1,
									    }
				    				},{
			      					breakpoint: 767,
										settings: {
											slidesToShow: (parseInt(slider_conf.slidesColumn) > 2) ? 2 : parseInt(slider_conf.slidesColumn),
											centerMode: false,
											slidesToScroll: 1
										}
			    					},
			    					{
			     					breakpoint: 479,
										settings: {
											slidesToShow: 1,
											slidesToScroll: 1,
											dots: false
										}
			    					},
			    					{
			     					breakpoint: 319,
										settings: {
											slidesToShow: 1,
											slidesToScroll: 1,
											dots: false
										}
			    					}]
			});
		} // End if
	});
});