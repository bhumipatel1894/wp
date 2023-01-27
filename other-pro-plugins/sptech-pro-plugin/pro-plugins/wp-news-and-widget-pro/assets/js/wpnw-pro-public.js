jQuery( document ).ready(function($) {

	// Initialize slick slider
    $( '.wpnaw-news-slider' ).each(function( index ) {

        var slider_id   = $(this).attr('id');
        var slider_conf = $.parseJSON( $(this).closest('.wpnw-pro-news-slider-wrp').find('.wpnw-pro-slider-conf').text() );
        
        if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
            
            if(slider_conf.newdesign == 'design-1' || slider_conf.newdesign == 'design-2' || slider_conf.newdesign == 'design-3' || slider_conf.newdesign == 'design-4' || slider_conf.newdesign == 'design-5' || slider_conf.newdesign == 'design-38' || slider_conf.newdesign == 'design-40' || slider_conf.newdesign == 'design-41' || slider_conf.newdesign == 'design-42' ){ 
                slidestoshow = 1; 
            } else{
                slidestoshow = parseInt(slider_conf.slides_column);
                
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
                },{
                    breakpoint: 479,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: false
                    }
                },{
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
                infinite        : (slider_conf.loop) == "true" ? true : false,
                arrows          : (slider_conf.arrows) == "true" ? true : false,
                speed           : parseInt(slider_conf.speed),
                autoplay        : (slider_conf.autoplay) == "true" ? true : false,
                autoplaySpeed   : parseInt(slider_conf.autoplay_interval),
                slidesToShow    : slidestoshow,
                slidesToScroll  : parseInt(slider_conf.slides_scroll),
                centerMode      : (slider_conf.centermode) == "true" ? true : false,
                rtl             : (slider_conf.rtl) == "true" ? true : false,
                mobileFirst     : (WpnwPro.is_mobile == 1) ? true : false,
                responsive      : slider_res
            });
        } // End if
    });

    // Initialize slick slider for widget
    $( '.wpnw-pro-news-slider-widget' ).each(function( index ) {
        
        var slider_id   = $(this).attr('id');
        var slider_conf = $.parseJSON( $(this).closest('.wpnw-pro-news-widget-wrp').find('.wpnw-pro-slider-conf').text() );
        
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
                rtl             : (WpnwPro.is_rtl == 1) ? true : false,
            });
        }
    });

    // Initialize news vertical ticker
    $( '.wpnw-pro-newsticker' ).each(function( index ) {
        var slider_id   = $(this).attr('id');
        var slider_conf = $.parseJSON( $(this).parent('.wpnw-pro-news-widget-wrp').find('.wpnw-pro-slider-conf').text() );
        
        if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
            
            jQuery('#'+slider_id).vTicker({
                speed     : parseInt(slider_conf.speed),
                height    : parseInt(slider_conf.height),
                padding   : 5,
                pause     : parseInt(slider_conf.pause)
            });
        }
    });

    // Initialize news ticker
    $(window).bind("load", function() {
        $( '.wpnw-ticker-wrp' ).each(function( index ) {
            
            var ticker_id   = $(this).attr('id');
            var ticker_conf = $.parseJSON( $(this).find('.wpnw-pro-ticker-conf').text() );

            if( typeof(ticker_id) != 'undefined' && ticker_id != '' && ticker_conf != 'undefined' ) {
                $("#"+ticker_id).wposTicker({
                    effect      : ticker_conf.ticker_effect,
                    autoplay    : (ticker_conf.autoplay == 'false') ? false : true,
                    timer       : parseInt(ticker_conf.speed),
                    border      : true,
                    fontstyle   : ticker_conf.font_style,
                });
            }
        });
    });
});