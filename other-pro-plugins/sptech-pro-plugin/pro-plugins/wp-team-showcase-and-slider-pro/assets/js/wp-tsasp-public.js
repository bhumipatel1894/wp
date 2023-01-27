jQuery( document ).ready(function($) {

    // Initialize slick slider
    $( '.wp-tsasp-team-slider' ).each(function( index ) {

        var slider_id   = $(this).attr('id');
        var slider_conf = $.parseJSON( $(this).closest('.wp-tsasp-team-slider-wrp').find('.wp-tsasp-slider-conf').attr('data-conf') );

        if( typeof(slider_id) != 'undefined' && slider_id != '' ) {

            jQuery('#'+slider_id).slick({
                dots            : (slider_conf.dots) == "true" ? true : false,
                infinite        : (slider_conf.infinite) == "true" ? true : false,
                arrows          : (slider_conf.arrows) == "true" ? true : false,
                speed           : parseInt(slider_conf.speed),
                autoplay        : (slider_conf.autoplay) == "true" ? true : false,
                autoplaySpeed   : parseInt(slider_conf.autoplay_interval),
                slidesToShow    : parseInt(slider_conf.slides_column),
                slidesToScroll  : parseInt(slider_conf.slides_scroll),
                prevArrow       : '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="fa fa-angle-left"></i></button>',
                nextArrow       : '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="fa fa-angle-right"></i></button>',
                centerMode      : (slider_conf.centermode) == "true" ? true : false,
                rtl             : (slider_conf.rtl) == "true" ? true : false,
                mobileFirst     : (WpTsasp.is_mobile == 1) ? true : false,
                responsive      : [{
                    breakpoint: 1023,
                    settings: {
                        slidesToShow: (parseInt(slider_conf.slides_column) > 3) ? 3 : parseInt(slider_conf.slides_column),
                        slidesToScroll: 1
                    }
                },{
                    breakpoint: 767,
                    settings: {
                        slidesToShow: (parseInt(slider_conf.slides_column) > 2) ? 2 : parseInt(slider_conf.slides_column),
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 320,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                }
                }]
            });
        } // End if
    });

    // Popup Gallery
    $( '.wp-tsasp-popup' ).each(function( index ) {

        var wp_tsasp_id = $(this).attr('id');

        if( typeof(wp_tsasp_id) != 'undefined' && wp_tsasp_id != '' ) {

            var popup_conf = $.parseJSON( $(this).closest('.wp-tsasp-team-wrp').find('.wp-tsasp-popup-conf').attr('data-conf') );

            $('#'+wp_tsasp_id).magnificPopup({
                delegate    : 'a.wp-tsasp-popup-link',
                type        : 'inline',
                mainClass   : 'wp-tsasp-mfp-popup',
                gallery     : {
                                enabled : (popup_conf.popup_gallery) == "false" ? false : true,
                            },
            });
        }
    });

    // For older browser compatibility (Image Fallback)
    if( WpTsasp.is_old_browser == 1 ) {
        $( '.wp-tsasp-image-fit .wp-tsasp-team-grid, .wp-tsasp-image-fit .team-slider, .wp-tsasp-image-fit.wp-tsasp-popup-box .wp-tsasp-popup-header' ).each(function( index ) {
            var img_obj     = $(this).find('.wp-tsasp-team-avatar');

            if( typeof(img_obj) !== 'undefined' ) {
                var img_url = img_obj.attr('src');

                img_obj.closest('.wp-tsasp-team-avatar-bg').css({"background": "url("+img_url+") no-repeat top center", "background-size": "cover"});
                img_obj.hide();
            }
        });
    }
});