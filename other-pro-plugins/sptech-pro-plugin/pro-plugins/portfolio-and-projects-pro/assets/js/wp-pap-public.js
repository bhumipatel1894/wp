jQuery(document).ready(function($){

	$( '.wppap-portfolio-inline' ).each(function( index ) {
		var thumb_id 	= $(this).attr('id');
		var thumb_conf 	= $.parseJSON( $(this).find('.wppap-thumb-conf').attr('data-conf'));

		$('#'+thumb_id).portfolio({
            cols        : parseInt(thumb_conf.main_grid),
            transition  : 'slideDown'
        });
	});

    // Inline method popup open
	$( "ul.wppap-portfolio-inline li a" ).on( "click", function() {
		var slick_id 		= $(this).closest('.wppap-main-wrapper').find('.wppap-content .wpapap-portfolio-img-slider').attr('id');
		var slider_conf 	= $.parseJSON( $(this).closest('.wppap-main-wrapper').find('.wppap-slider-wrapper .wppap-slider-conf').attr('data-conf') );

		wp_pap_init_slick_slider(slick_id, slider_conf);
	});

	// Popup Gallery
    $( '.wppap-portfolio-popup' ).each(function( index ) {

        var wp_pap_id = $(this).attr('id');

        if( typeof(wp_pap_id) != 'undefined' && wp_pap_id != '' ) {

            $('#'+wp_pap_id).magnificPopup({
                delegate    : 'a.wppap-popup-info-link',
                type        : 'inline',
                mainClass   : 'wp-pap-mfp-popup',
                gallery     : {
                                enabled: true,
                                preload: [0,0], // Will preload 0 - before current, and 1 after the current image
                            },
                callbacks   : {
                            change: function(item) {

                                var set_timeout;

                                set_timeout = setTimeout(function() {
                                    var popup_id = item.src;

                                    var slick_id    = $(popup_id).find('.wppap-popup-img-grp').attr('id');
                                    var slider_conf = $.parseJSON($(popup_id).find('.wppap-slider-conf').attr('data-conf'));

                                    wp_pap_init_slick_slider(slick_id, slider_conf);
                                }, 100);
                            },
                        }
            });
        }
    });

    // Open popup on reference link
    $(document).on('click', '.wppap-portfolio-popup .wppap-popup-ref-link', function(){
        $(this).closest('.wppap-portfolio-wrp').find('.wppap-thumbnail').click();
    });

    // Porfolio filter
    $( '.wppap-portfolio-filter' ).each(function( index ) {
       
       var filter_id = $(this).attr('id');
        
        if( typeof(filter_id) != 'undefined' && filter_id != '' ) {

            var filter_sel = $(this).parent().find('.wppap-filter').attr('id');

            $('#'+filter_sel).on( 'click', '.wppap-filtr-cat', function(e) {
                e.preventDefault();
                
                var filterValue = $( this ).attr('data-filter');
                var wrp_height  = $('#'+filter_id).outerHeight(true);

                $('#'+filter_id).css({'min-height' : wrp_height});
                $('#'+filter_id+' .wppap-portfolio-wrp').removeClass('wppap-portfolio-active');
                window.setTimeout(function(){
                    $('#'+filter_id+' '+filterValue).addClass('wppap-portfolio-active');
                    $('#'+filter_id).css({'min-height' : ''});
                }, 1);
            });
        }
    });

    $(document).on( 'click', '.wppap-filter .wppap-filtr-cat', function() {
        $(this).closest('.wppap-filter').find('.wppap-filtr-cat').removeClass('wppap-active-filtr');
        $(this).addClass('wppap-active-filtr');

        wppap_close_popup();
    });

    // Old browser compatibility
    if( WpPap.is_old_browser == 1 ) {
        $( '.wp-pap-image-fit .wppap-portfolio-wrp' ).each(function( index ) {
            var img_obj     = $(this).find('.wppap-portfolio-img');

            if( typeof(img_obj) !== 'undefined' ) {
                var img_url = img_obj.attr('src');

                img_obj.closest('.wppap-portfolio-bg').css({"background": "url("+img_url+") no-repeat top center", "background-size": "cover"});
                img_obj.hide();
            }
        });
    }

});

// Function to intialize slick slider
function wp_pap_init_slick_slider(slick_id, slider_conf) {

    if( typeof(slick_id) !== 'undefined' && slick_id != '' ) {
        if( jQuery('#'+slick_id ).hasClass('slick-initialized') ) {
            jQuery('#'+slick_id).slick('setPosition');
        } else {
            jQuery('#'+slick_id).slick({
                slidesToShow        : parseInt(slider_conf.slide_to_show),
                dots                : (slider_conf.dots) == 1               ? true : false,
                arrows              : (slider_conf.arrows) == 1             ? true : false,
                infinite            : (slider_conf.loop) == 1               ? true : false,
                speed               : parseInt(slider_conf.speed),
                autoplay            : (slider_conf.autoplay) == 1           ? true : false,
                autoplaySpeed       : parseInt(slider_conf.autoplayspeed),
                rtl                 : (slider_conf.rtl == 1)                ? true : false,
                mobileFirst         : (WpPap.is_mobile == 1)                ? true : false,
                fade                : (slider_conf.effect == "fade" && parseInt(slider_conf.slide_to_show) == 1) ? true : false,
                responsive          : [{
                    breakpoint: 1023,
                    settings: {
                        slidesToShow: (parseInt(slider_conf.slide_to_show) > 3) ? 3 : parseInt(slider_conf.slide_to_show),
                        slidesToScroll: 1
                    }
                },{
                    breakpoint: 767,
                    settings: {
                        slidesToShow: (parseInt(slider_conf.slide_to_show) > 2) ? 2 : parseInt(slider_conf.slide_to_show),
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 479,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false
                    }
                },
                {
                    breakpoint: 319,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false
                }
                }]
            });
        }
    }
}

// Close inline method popup
function wppap_close_popup() {
    jQuery('ul.wppap-thumbs li .wppap-active-arrow').remove();
    jQuery('.wppap-main-wrapper ul.wppap-thumbs li.wppap-content').slideUp(300, function(){
        jQuery(this).remove();
    });
}