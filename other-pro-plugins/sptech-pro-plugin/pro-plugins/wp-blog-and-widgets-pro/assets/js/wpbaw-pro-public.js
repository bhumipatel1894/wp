jQuery( document ).ready(function($) {
	
    // Initialize slick slider
    $( '.wpbaw-pro-blog-slider' ).each(function( index ) {

        var slider_id   = $(this).attr('id');
        var slider_conf = $.parseJSON( $(this).parent('.wpbaw-pro-blog-slider-wrp').find('.wpbaw-pro-slider-conf').text() );

        if( typeof(slider_id) != 'undefined' && slider_id != '' ) {

            if(slider_conf.blogdesign == 'design-1' || slider_conf.blogdesign == 'design-2' || slider_conf.blogdesign == 'design-3' || slider_conf.blogdesign == 'design-4' || slider_conf.blogdesign == 'design-5' || slider_conf.blogdesign == 'design-38' || slider_conf.blogdesign == 'design-40' || slider_conf.blogdesign == 'design-41' || slider_conf.blogdesign == 'design-46' ){ 
                
                var slider_res  = null;
                var slidestoshow = 1;
                var slides_to_scroll = 1;

            } else {
                
                var slidestoshow = parseInt(slider_conf.slides_column);
                var slides_to_scroll = parseInt(slider_conf.slides_scroll);

                // Slider responsive breakpoints
                var slider_res = [{
                    breakpoint: 1023,
                    settings: {
                        slidesToShow: (slidestoshow > 3) ? 3 : slidestoshow,
                        slidesToScroll: 1,
                    }
                },{
                    breakpoint: 767,
                    settings: {
                        slidesToShow: (slidestoshow > 2) ? 2 : slidestoshow,
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
            }

            jQuery('#'+slider_id).slick({
                dots            : (slider_conf.dots) == "true" ? true : false,
                infinite        : (slider_conf.infinite) == "true" ? true : false,
                arrows          : (slider_conf.arrows) == "true" ? true : false,
                speed           : parseInt(slider_conf.speed),
                autoplay        : (slider_conf.autoplay) == "true" ? true : false,
                autoplaySpeed   : parseInt(slider_conf.autoplay_interval),
                slidesToShow    : slidestoshow,
                slidesToScroll  : slides_to_scroll,
                centerMode      : (slider_conf.centermode) == "true" ? true : false,
                rtl             : (slider_conf.rtl) == "true" ? true : false,
                mobileFirst     : (WpbawPro.is_mobile == 1) ? true : false,
                responsive      : slider_res
            });
        } // End if
    });

    // Initialize slick slider for widget
    $( '.wpbaw-pro-blog-slider-widget' ).each(function( index ) {
        
        var slider_id   = $(this).attr('id');
        var slider_conf = $.parseJSON( $(this).parent('.wpbaw-pro-blog-widget-wrp').find('.wpbaw-pro-slider-conf').text() );
        
        if( typeof(slider_id) != 'undefined' && slider_id != '' && slider_conf != null ) {
            
            jQuery('#'+slider_id).slick({
                dots            : (slider_conf.dots) == "true" ? true : false,
                infinite        : true,
                speed           : parseInt(slider_conf.speed),
                arrows          : (slider_conf.arrows) == "true" ? true : false,
                autoplay        : (slider_conf.autoplay) == "true" ? true : false,
                autoplaySpeed   : parseInt(slider_conf.autoplay_interval),
                slidesToShow    : 1,
                slidesToScroll  : 1,
                rtl             : (WpbawPro.is_rtl == 1) ? true : false,
            });
        }
    });

    // Initialize blog ticker
    $( '.wpabw-pro-blogticker' ).each(function( index ) {

        var slider_id   = $(this).attr('id');
        var slider_conf = $.parseJSON( $(this).parent('.wpbaw-pro-blog-widget-wrp').find('.wpbaw-pro-slider-conf').text() );

        if( typeof(slider_id) != 'undefined' && slider_id != '' ) {

            jQuery('#'+slider_id).vTicker({
                speed     : parseInt(slider_conf.speed),
                height    : parseInt(slider_conf.height),
                padding   : 5,
                pause     : parseInt(slider_conf.pause)
            });
        }
    });
});