jQuery(document).ready(function($) {
    
    var now     = new Date();

    $( '.wpcdt-countdown-timer-circle' ).each(function( index ) {
        
        var date_id   = $(this).attr('id');
        var date_id   = date_id+ ' .wpcdt-clock';
        var date_conf = $.parseJSON( $(this).closest('.wpcdt-countdown-wrp').find('.wpcdt-date-conf').attr('data-conf'));

        var diff      = new Date(date_conf.count_date);
        var reg       = getdifference(diff);
        var total     = reg.total_seconds;

        $('#'+date_id).TimeCircles({

            'animation': (date_conf.animation) != ''                    ? date_conf.animation               : 'smooth',
            'bg_width': (date_conf.backgroundwidth) != ''               ? date_conf.backgroundwidth         : 1.2,
            'fg_width': (date_conf.circlewidth) != ''                   ? date_conf.circlewidth             : 0.1,
            'circle_bg_color': (date_conf.backgroundcolor) != ''        ? date_conf.backgroundcolor         : '#313332',
            'time': {
                'Days': {
                    'text': (date_conf.days_text) != ''                 ? date_conf.days_text               : 'Days',
                    'color': (date_conf.daysbackgroundcolor) != ''      ? date_conf.daysbackgroundcolor     : '#e3be32',
                    'show': (date_conf.is_days == 1)                    ? true : false,
                },
                'Hours': {
                    'text': (date_conf.hours_text) != ''                ? date_conf.hours_text              : 'Hours',
                    'color': (date_conf.hoursbackgroundcolor) != ''     ? date_conf.hoursbackgroundcolor    : '#36b0e3',
                    'show': (date_conf.is_hours == 1)                   ? true : false,
                },
                'Minutes': {
                    'text': (date_conf.minutes_text) != ''              ? date_conf.minutes_text            : 'Minutes',
                    'color': (date_conf.minutesbackgroundcolor) != ''   ? date_conf.minutesbackgroundcolor  : '#75bf44',
                    'show': (date_conf.is_minutes == 1)                 ? true : false,
                },
                'Seconds': {
                    'text': (date_conf.seconds_text) != ''              ? date_conf.seconds_text            : 'Seconds',
                    'color': (date_conf.secondsbackgroundcolor) != ''   ? date_conf.secondsbackgroundcolor  : '#66c5af',
                    'show': (date_conf.is_seconds == 1)                 ? true : false,
                }
            }
        });

        $('#'+date_id).TimeCircles().addListener(countdownComplete);
        
        function countdownComplete(unit, value, total){
            if(total<=0){
                $('#'+date_id).hide(500);
                $('#'+date_id).parent().find('.ce-oncomplete').show(500);
            }
        }

        $(window).resize(function(){
         $('#'+date_id).TimeCircles().rebuild(); 
        });
    });

    $( '.wpcdt-countdown-timer-design-1' ).each(function( index ) {

        var date_id   = $(this).attr('id');
        var date_id   = date_id+ ' .wpcdt-clock';
        var date_conf = $.parseJSON( $(this).closest('.wpcdt-countdown-wrp').find('.wpcdt-date-conf').attr('data-conf'));
        var diff      = new Date(date_conf.count_date);
        var reg       = getdifference(diff);

        $('#'+date_id).countEverest({
            day             : now.getDate()+(reg.days),
            month           : now.getMonth()+1,
            year            : now.getFullYear()+0,
            hour            : now.getHours()+(reg.hours),
            minute          : now.getMinutes()+(reg.minutes),
            second          : now.getSeconds()+(reg.seconds),
            timeZone        : (date_conf.timezone)    != '' ? parseFloat(date_conf.timezone) : parseFloat(WpCdtPro.timezone),
            daysLabel       : (date_conf.days_text)    != '' ? date_conf.days_text    : 'Days',
            hoursLabel      : (date_conf.hours_text)   != '' ? date_conf.hours_text   : 'Hours',
            minutesLabel    : (date_conf.minutes_text) != '' ? date_conf.minutes_text : 'Minutes',
            secondsLabel    : (date_conf.seconds_text) != '' ? date_conf.seconds_text : 'Seconds',
            onComplete: function() {
                $('#'+date_id).hide(500);
                $('#'+date_id).parent().find('.ce-oncomplete').show(500);
            }
        });

        //Fallback for Internet Explorer
        if (navigator.userAgent.indexOf('MSIE') !== -1 || navigator.appVersion.indexOf('Trident/') > 0) {
            $('html').addClass('ce-ie');
        }
    });

    $( '.wpcdt-countdown-timer-design-2' ).each(function( index ) {
        
        firstCalculation = true;
        var date_id      = $(this).attr('id');
        var date_id      = date_id+ ' .wpcdt-clock';
        var date_conf    = $.parseJSON( $(this).closest('.wpcdt-countdown-wrp').find('.wpcdt-date-conf').attr('data-conf'));
        var diff         = new Date(date_conf.count_date);
        var reg          = getdifference(diff);
        var $countdown   = $('#'+date_id);

        $('#'+date_id).countEverest({
            day             : now.getDate()+(reg.days),
            month           : now.getMonth()+1,
            year            : now.getFullYear()+0,
            hour            : now.getHours()+(reg.hours),
            minute          : now.getMinutes()+(reg.minutes),
            second          : now.getSeconds()+(reg.seconds),
            timeZone        : (date_conf.timezone)    != '' ? parseFloat(date_conf.timezone) : parseFloat(WpCdtPro.timezone),
            daysLabel       : (date_conf.days_text)    != '' ? date_conf.days_text    : 'Days',
            hoursLabel      : (date_conf.hours_text)   != '' ? date_conf.hours_text   : 'Hours',
            minutesLabel    : (date_conf.minutes_text) != '' ? date_conf.minutes_text : 'Minutes',
            secondsLabel    : (date_conf.seconds_text) != '' ? date_conf.seconds_text : 'Seconds',
            onComplete: function() {
                $('#'+date_id).hide(500);
                $('#'+date_id).parent().find('.ce-oncomplete').show(500);
            },
            afterCalculation: function() {
                var plugin = this,
                    units = {
                        days: this.days,
                        hours: this.hours,
                        minutes: this.minutes,
                        seconds: this.seconds
                    },
                    //max values per unit
                    maxValues = {
                        hours: '23',
                        minutes: '59',
                        seconds: '59'
                    },
                    actClass = 'active',
                    befClass = 'before';

                //build necessary elements
                if (firstCalculation == true) {
                    firstCalculation = false;

                    //build necessary markup
                    $countdown.find('.ce-unit-wrap div').each(function () {
                        var $this = $(this),
                            className = $this.attr('class'),
                            value = units[className],
                            sub = '',
                            dig = '';

                        //build markup per unit digit
                        for(var x = 0; x < 10; x++) {
                            sub += [
                                '<div class="digits-inner">',
                                    '<div class="flip-wrap">',
                                        '<div class="up">',
                                            '<div class="shadow"></div>',
                                            '<div class="inn">' + x + '</div>',
                                        '</div>',
                                        '<div class="down">',
                                            '<div class="shadow"></div>',
                                            '<div class="inn">' + x + '</div>',
                                        '</div>',
                                    '</div>',
                                '</div>'
                            ].join('');
                        }

                        //build markup for number
                        for (var i = 0; i < value.length; i++) {
                            dig += '<div class="digits">' + sub + '</div>';
                        }
                        $this.append(dig);
                    });
                }

                //iterate through units
                $.each(units, function(unit) {
                    var digitCount = $countdown.find('.' + unit + ' .digits').length,
                        maxValueUnit = maxValues[unit],
                        maxValueDigit,
                        value = plugin.strPad(this, digitCount, '0');

                    //iterate through digits of an unit
                    for (var i = value.length - 1; i >= 0; i--) {
                        var $digitsWrap = $countdown.find('.' + unit + ' .digits:eq(' + (i) + ')'),
                            $digits = $digitsWrap.find('div.digits-inner');

                        //use defined max value for digit or simply 9
                        if (maxValueUnit) {
                            maxValueDigit = (maxValueUnit[i] == 0) ? 9 : maxValueUnit[i];
                        } else {
                            maxValueDigit = 9;
                        }

                        //which numbers get the active and before class
                        var activeIndex = parseInt(value[i]),
                            beforeIndex = (activeIndex == maxValueDigit) ? 0 : activeIndex + 1;

                        //check if value change is needed
                        if ($digits.eq(beforeIndex).hasClass(actClass)) {
                            $digits.parent().addClass('play');
                        }

                        //remove all classes
                        $digits
                            .removeClass(actClass)
                            .removeClass(befClass);

                        //set classes
                        $digits.eq(activeIndex).addClass(actClass);
                        $digits.eq(beforeIndex).addClass(befClass);
                    }
                });
            }
        });
    });

    $( '.wpcdt-countdown-timer-design-3' ).each(function( index ) {
        
        var date_id      = $(this).attr('id');
        var date_id      = date_id+ ' .wpcdt-clock';
        var date_conf    = $.parseJSON( $(this).closest('.wpcdt-countdown-wrp').find('.wpcdt-date-conf').attr('data-conf'));
        var diff         = new Date(date_conf.count_date);
        var reg          = getdifference(diff);
        
        $("#"+date_id).countEverest({
            day             : now.getDate()+(reg.days),
            month           : now.getMonth()+1,
            year            : now.getFullYear()+0,
            hour            : now.getHours()+(reg.hours),
            minute          : now.getMinutes()+(reg.minutes),
            second          : now.getSeconds()+(reg.seconds),
            timeZone        : (date_conf.timezone)    != '' ? parseFloat(date_conf.timezone) : parseFloat(WpCdtPro.timezone),
            daysLabel       : (date_conf.days_text)    != '' ? date_conf.days_text    : 'Days',
            hoursLabel      : (date_conf.hours_text)   != '' ? date_conf.hours_text   : 'Hours',
            minutesLabel    : (date_conf.minutes_text) != '' ? date_conf.minutes_text : 'Minutes',
            secondsLabel    : (date_conf.seconds_text) != '' ? date_conf.seconds_text : 'Seconds',
            onComplete: function() {
                $('#'+date_id).hide(500);
                $('#'+date_id).parent().find('.ce-oncomplete').show(500);
            },
            onChange: function() {
                drawCircle(document.getElementById('ce-days'), this.days, 365, date_conf.circle2backgroundcolor, date_conf.circle2daysbackgroundcolor, date_conf.circle2width);
                drawCircle(document.getElementById('ce-hours'), this.hours, 24, date_conf.circle2backgroundcolor, date_conf.cieclr2hoursbackgroundcolor, date_conf.circle2width);
                drawCircle(document.getElementById('ce-minutes'), this.minutes, 60, date_conf.circle2backgroundcolor, date_conf.circle2minutesbackgroundcolor, date_conf.circle2width);
                drawCircle(document.getElementById('ce-seconds'), this.seconds, 60, date_conf.circle2backgroundcolor, date_conf.circle2secondsbackgroundcolor, date_conf.circle2width);
            }
        });
    });

    $( '.wpcdt-countdown-timer-design-4' ).each(function( index ) {

        var date_id      = $(this).attr('id');
        var date_id      = date_id+ ' .wpcdt-clock';
        var date_conf    = $.parseJSON( $(this).closest('.wpcdt-countdown-wrp').find('.wpcdt-date-conf').attr('data-conf'));
        var diff         = new Date(date_conf.count_date);
        var reg          = getdifference(diff);


        var $example = $("#"+date_id),
        $ceDays = $example.find('.ce-days'),
        $ceHours = $example.find('.ce-hours'),
        $ceMinutes = $example.find('.ce-minutes'),
        $ceSeconds = $example.find('.ce-seconds'),
        $daysFill = $('.ce-bar-days').find('.ce-fill'),
        $hoursFill = $('.ce-bar-hours').find('.ce-fill'),
        $minutesFill = $('.ce-bar-minutes').find('.ce-fill'),
        $secondsFill = $('.ce-bar-seconds').find('.ce-fill');

        $("#"+date_id).countEverest({
            day             : now.getDate()+(reg.days),
            month           : now.getMonth()+1,
            year            : now.getFullYear()+0,
            hour            : now.getHours()+(reg.hours),
            minute          : now.getMinutes()+(reg.minutes),
            second          : now.getSeconds()+(reg.seconds),
            timeZone        : (date_conf.timezone)    != '' ? parseFloat(date_conf.timezone) : parseFloat(WpCdtPro.timezone),
            daysLabel       : (date_conf.days_text)    != '' ? date_conf.days_text    : 'Days',
            hoursLabel      : (date_conf.hours_text)   != '' ? date_conf.hours_text   : 'Hours',
            minutesLabel    : (date_conf.minutes_text) != '' ? date_conf.minutes_text : 'Minutes',
            secondsLabel    : (date_conf.seconds_text) != '' ? date_conf.seconds_text : 'Seconds',
            onComplete: function() {
                $('#'+date_id).hide(500);
                $('#'+date_id).parent().find('.ce-oncomplete').show(500);
            },
            onChange: function() {
                setBar($daysFill, this.days, 365);
                setBar($hoursFill, this.hours, 24);
                setBar($minutesFill, this.minutes, 60);
                setBar($secondsFill, this.seconds, 60);
            }
        });
    });

    $( '.wpcdt-countdown-timer-design-5' ).each(function( index ) {

        var date_id      = $(this).attr('id');
        var date_id      = date_id+ ' .wpcdt-clock';
        var date_conf    = $.parseJSON( $(this).closest('.wpcdt-countdown-wrp').find('.wpcdt-date-conf').attr('data-conf'));
        var diff         = new Date(date_conf.count_date);
        var reg          = getdifference(diff);

        var $example = $("#"+date_id),
        $ceMinutes = $example.find('.ce-minutes'),
        $ceSeconds = $example.find('.ce-seconds');

        $("#"+date_id).countEverest({
            day             : now.getDate()+(reg.days),
            month           : now.getMonth()+1,
            year            : now.getFullYear()+0,
            hour            : now.getHours()+(reg.hours),
            minute          : now.getMinutes()+(reg.minutes),
            second          : now.getSeconds()+(reg.seconds),
            timeZone        : (date_conf.timezone)    != '' ? parseFloat(date_conf.timezone) : parseFloat(WpCdtPro.timezone),
            daysLabel       : (date_conf.days_text)    != '' ? date_conf.days_text    : 'Days',
            hoursLabel      : (date_conf.hours_text)   != '' ? date_conf.hours_text   : 'Hours',
            minutesLabel    : (date_conf.minutes_text) != '' ? date_conf.minutes_text : 'Minutes',
            secondsLabel    : (date_conf.seconds_text) != '' ? date_conf.seconds_text : 'Seconds',
            onComplete: function() {
                $('#'+date_id).hide(500);
                $('#'+date_id).parent().find('.ce-oncomplete').show(500);
            },
        });
    });

    $( '.wpcdt-countdown-timer-design-6' ).each(function( index ) {

        
        var date_id      = $(this).attr('id');
        var date_id      = date_id+ ' .wpcdt-clock';
        var date_conf    = $.parseJSON( $(this).closest('.wpcdt-countdown-wrp').find('.wpcdt-date-conf').attr('data-conf'));
        var diff         = new Date(date_conf.count_date);
        var reg          = getdifference(diff);

        $("#"+date_id).countEverest({
            day             : now.getDate()+(reg.days),
            month           : now.getMonth()+1,
            year            : now.getFullYear()+0,
            hour            : now.getHours()+(reg.hours),
            minute          : now.getMinutes()+(reg.minutes),
            second          : now.getSeconds()+(reg.seconds),
            timeZone        : (date_conf.timezone)    != '' ? parseFloat(date_conf.timezone) : parseFloat(WpCdtPro.timezone),
            daysLabel       : (date_conf.days_text)    != '' ? date_conf.days_text    : 'Days',
            hoursLabel      : (date_conf.hours_text)   != '' ? date_conf.hours_text   : 'Hours',
            minutesLabel    : (date_conf.minutes_text) != '' ? date_conf.minutes_text : 'Minutes',
            secondsLabel    : (date_conf.seconds_text) != '' ? date_conf.seconds_text : 'Seconds',
            onComplete: function() {
                $('#'+date_id).hide(500);
                $('#'+date_id).parent().find('.ce-oncomplete').show(500);
            },
        });
    });

    $( '.wpcdt-countdown-timer-design-7' ).each(function( index ) {


        var date_id      = $(this).attr('id');
        var date_id      = date_id+ ' .wpcdt-clock';
        var date_conf    = $.parseJSON( $(this).closest('.wpcdt-countdown-wrp').find('.wpcdt-date-conf').attr('data-conf'));
        var diff         = new Date(date_conf.count_date);
        var reg          = getdifference(diff);

        var $example = $("#"+date_id),
        $ceHours = $example.find('.ce-hours'),
        $ceMinutes = $example.find('.ce-minutes');

        $("#"+date_id).countEverest({
            day             : now.getDate()+(reg.days),
            month           : now.getMonth()+1,
            year            : now.getFullYear()+0,
            hour            : now.getHours()+(reg.hours),
            minute          : now.getMinutes()+(reg.minutes),
            second          : now.getSeconds()+(reg.seconds),
            timeZone        : (date_conf.timezone)    != '' ? parseFloat(date_conf.timezone) : parseFloat(WpCdtPro.timezone),
            daysLabel       : (date_conf.days_text)    != '' ? date_conf.days_text    : 'Days',
            hoursLabel      : (date_conf.hours_text)   != '' ? date_conf.hours_text   : 'Hours',
            minutesLabel    : (date_conf.minutes_text) != '' ? date_conf.minutes_text : 'Minutes',
            secondsLabel    : (date_conf.seconds_text) != '' ? date_conf.seconds_text : 'Seconds',
            onComplete: function() {
                $('#'+date_id).hide(500);
                $('#'+date_id).parent().find('.ce-oncomplete').show(500);
            },
        });
    });

    $( '.wpcdt-countdown-timer-design-8' ).each(function( index ) {

        var date_id      = $(this).attr('id');
        var date_id      = date_id+ ' .wpcdt-clock';
        var date_conf    = $.parseJSON( $(this).closest('.wpcdt-countdown-wrp').find('.wpcdt-date-conf').attr('data-conf'));
        var diff         = new Date(date_conf.count_date);
        var reg          = getdifference(diff);

        $example = $("#"+date_id),
        $ceDays = $example.find('.ce-days'),
        $ceHours = $example.find('.ce-hours'),
        $ceMinutes = $example.find('.ce-minutes'),
        $ceSeconds = $example.find('.ce-seconds');

        $("#"+date_id).countEverest({
            day             : now.getDate()+(reg.days),
            month           : now.getMonth()+1,
            year            : now.getFullYear()+0,
            hour            : now.getHours()+(reg.hours),
            minute          : now.getMinutes()+(reg.minutes),
            second          : now.getSeconds()+(reg.seconds),
            timeZone        : (date_conf.timezone)    != '' ? parseFloat(date_conf.timezone) : parseFloat(WpCdtPro.timezone),
            daysLabel       : (date_conf.days_text)    != '' ? date_conf.days_text    : 'Days',
            hoursLabel      : (date_conf.hours_text)   != '' ? date_conf.hours_text   : 'Hours',
            minutesLabel    : (date_conf.minutes_text) != '' ? date_conf.minutes_text : 'Minutes',
            secondsLabel    : (date_conf.seconds_text) != '' ? date_conf.seconds_text : 'Seconds',
            daysWrapper     : '.ce-days .ce-flip-back',
            hoursWrapper    : '.ce-hours .ce-flip-back',
            minutesWrapper  : '.ce-minutes .ce-flip-back',
            secondsWrapper  : '.ce-seconds .ce-flip-back',
            wrapDigits      : false,
            onComplete: function() {
                $('#'+date_id).hide(500);
                $('#'+date_id).parent().find('.ce-oncomplete').show(500);
            },
            onChange: function() {
                countEverestAnimate($('.wpcdt-clock .ce-col>div'), this);
            }
        });

        function countEverestAnimate($el, data) {
            $el.each( function(index) {
                var $this = $(this),
                    $flipFront = $this.find('.ce-flip-front'),
                    $flipBack = $this.find('.ce-flip-back'),
                    field = $flipBack.text(),
                    fieldOld = $this.attr('data-old');
                if (typeof fieldOld === 'undefined') {
                    $this.attr('data-old', field);
                }
                if (field != fieldOld) {
                    $this.addClass('ce-animate');
                    window.setTimeout(function() {
                        $flipFront.text(field);
                        $this
                            .removeClass('ce-animate')
                            .attr('data-old', field);
                    }, 800);
                }
            });
        }

        //Fallback for Internet Explorer
        if (navigator.userAgent.indexOf('MSIE') !== -1 || navigator.appVersion.indexOf('Trident/') > 0) {
            $('html').addClass('internet-explorer');
        }
    });

    $( '.wpcdt-countdown-timer-design-9' ).each(function( index ) {

        var date_id      = $(this).attr('id');
        var date_id      = date_id+ ' .wpcdt-clock';
        var date_conf    = $.parseJSON( $(this).closest('.wpcdt-countdown-wrp').find('.wpcdt-date-conf').attr('data-conf'));
        var diff         = new Date(date_conf.count_date);
        var reg          = getdifference(diff);

        var $example = $("#"+date_id),
            $ceHours = $example.find('.ce-days'),
            $ceHours = $example.find('.ce-hours'),
            $ceMinutes = $example.find('.ce-minutes'),
            $ceSeconds = $example.find('.ce-seconds');

        $("#"+date_id).countEverest({
            day             : now.getDate()+(reg.days),
            month           : now.getMonth()+1,
            year            : now.getFullYear()+0,
            hour            : now.getHours()+(reg.hours),
            minute          : now.getMinutes()+(reg.minutes),
            second          : now.getSeconds()+(reg.seconds),
            timeZone        : (date_conf.timezone)    != '' ? parseFloat(date_conf.timezone) : parseFloat(WpCdtPro.timezone),
            daysLabel       : (date_conf.days_text)    != '' ? date_conf.days_text    : 'Days',
            hoursLabel      : (date_conf.hours_text)   != '' ? date_conf.hours_text   : 'Hours',
            minutesLabel    : (date_conf.minutes_text) != '' ? date_conf.minutes_text : 'Minutes',
            secondsLabel    : (date_conf.seconds_text) != '' ? date_conf.seconds_text : 'Seconds',
            onComplete: function() {
                $('#'+date_id).hide(500);
                $('#'+date_id).parent().find('.ce-oncomplete').show(500);
            },
            onChange: function() {
                countEverestAnimate( $("#"+date_id).find('.ce-digits span') );
            }
        });

        function countEverestAnimate($el) {
            $el.each( function(index) {
                var $this = $(this),
                    fieldText = $this.text(),
                    fieldData = $this.attr('data-value'),
                    fieldOld = $this.attr('data-old');

                if (typeof fieldOld === 'undefined') {
                    $this.attr('data-old', fieldText);
                }

                if (fieldText != fieldData) {
                    
                    $this
                        .attr('data-value', fieldText)
                        .attr('data-old', fieldData)
                        .addClass('ce-animate');

                    window.setTimeout(function() {
                        $this
                            .removeClass('ce-animate')
                            .attr('data-old', fieldText);
                    }, 300);
                }
            });
        }
    });

    $( '.wpcdt-countdown-timer-design-10' ).each(function( index ) {

        var date_id      = $(this).attr('id');
        var date_id      = date_id+ ' .wpcdt-clock';
        var date_conf    = $.parseJSON( $(this).closest('.wpcdt-countdown-wrp').find('.wpcdt-date-conf').attr('data-conf'));
        var diff         = new Date(date_conf.count_date);
        var reg          = getdifference(diff);

        $("#"+date_id).countEverest({
            day             : now.getDate()+(reg.days),
            month           : now.getMonth()+1,
            year            : now.getFullYear()+0,
            hour            : now.getHours()+(reg.hours),
            minute          : now.getMinutes()+(reg.minutes),
            second          : now.getSeconds()+(reg.seconds),
            timeZone        : (date_conf.timezone)    != '' ? parseFloat(date_conf.timezone) : parseFloat(WpCdtPro.timezone),
            daysLabel       : (date_conf.days_text)    != '' ? date_conf.days_text    : 'Days',
            hoursLabel      : (date_conf.hours_text)   != '' ? date_conf.hours_text   : 'Hours',
            minutesLabel    : (date_conf.minutes_text) != '' ? date_conf.minutes_text : 'Minutes',
            secondsLabel    : (date_conf.seconds_text) != '' ? date_conf.seconds_text : 'Seconds',
            onComplete: function() {
                $('#'+date_id).hide(500);
                $('#'+date_id).parent().find('.ce-oncomplete').show(500);
            },
        });
    });

    $( '.wpcdt-countdown-timer-design-11' ).each(function( index ) {

        var date_id      = $(this).attr('id');
        var date_id      = date_id+ ' .wpcdt-clock';
        var date_conf    = $.parseJSON( $(this).closest('.wpcdt-countdown-wrp').find('.wpcdt-date-conf').attr('data-conf'));
        var diff         = new Date(date_conf.count_date);
        var reg          = getdifference(diff);

        $('#'+date_id).countEverest({
            day             : now.getDate()+(reg.days),
            month           : now.getMonth()+1,
            year            : now.getFullYear()+0,
            hour            : now.getHours()+(reg.hours),
            minute          : now.getMinutes()+(reg.minutes),
            second          : now.getSeconds()+(reg.seconds),
            timeZone        : (date_conf.timezone)    != '' ? parseFloat(date_conf.timezone) : parseFloat(WpCdtPro.timezone),
            daysLabel       : (date_conf.days_text)    != '' ? date_conf.days_text    : 'Days',
            hoursLabel      : (date_conf.hours_text)   != '' ? date_conf.hours_text   : 'Hours',
            minutesLabel    : (date_conf.minutes_text) != '' ? date_conf.minutes_text : 'Minutes',
            secondsLabel    : (date_conf.seconds_text) != '' ? date_conf.seconds_text : 'Seconds',
            onComplete: function() {
                $('.ce-duration').hide();
                $('#'+date_id +' .ce-oncomplete').addClass('shake');
            }
        });
    });

    $( '.wpcdt-countdown-timer-design-12' ).each(function( index ) {

        var date_id      = $(this).attr('id');
        var date_id      = date_id+ ' .wpcdt-clock';
        var date_conf    = $.parseJSON( $(this).closest('.wpcdt-countdown-wrp').find('.wpcdt-date-conf').attr('data-conf'));
        var diff         = new Date(date_conf.count_date);
        var reg          = getdifference(diff);
        
        $("#"+date_id).countEverest({
            day             : now.getDate()+(reg.days),
            month           : now.getMonth()+1,
            year            : now.getFullYear()+0,
            hour            : now.getHours()+(reg.hours),
            minute          : now.getMinutes()+(reg.minutes),
            second          : now.getSeconds()+(reg.seconds),
            timeZone        : (date_conf.timezone)    != '' ? parseFloat(date_conf.timezone) : parseFloat(WpCdtPro.timezone),
            daysLabel       : (date_conf.days_text)    != '' ? date_conf.days_text    : 'Days',
            hoursLabel      : (date_conf.hours_text)   != '' ? date_conf.hours_text   : 'Hours',
            minutesLabel    : (date_conf.minutes_text) != '' ? date_conf.minutes_text : 'Minutes',
            secondsLabel    : (date_conf.seconds_text) != '' ? date_conf.seconds_text : 'Seconds',
            onComplete: function() {
                $('#'+date_id).hide(500);
                $('#'+date_id +'#'+date_id +' .ce-oncomplete').show(500);
            }
        });
    });
});

/****Function to get difference between two dates****/

function getdifference(t){
    
    material                  = [];
    material['days']          = 0;
    material['hours']         = 0;
    material['minutes']       = 0;
    material['seconds']       = 0;
    material['total_seconds'] = 0;
    
    var now = new Date();
    
    if(t > now){
        
        // get total seconds between the times
        var delta = Math.abs(t - now) / 1000;

        // calculate (and subtract) whole days
        var days = Math.floor(delta / 86400);
        delta -= days * 86400;
        material['days']= days;

        // calculate (and subtract) whole hours
        var hours = Math.floor(delta / 3600) % 24;
        delta -= hours * 3600;
        material['hours']= hours;

        // calculate (and subtract) whole minutes
        var minutes = Math.floor(delta / 60) % 60;
        delta -= minutes * 60;
        material['minutes']= minutes;

        // what's left is seconds
        var seconds = delta % 60;
        material['seconds']= seconds;

        var total_seconds = (t.getTime() - now.getTime()) / 1000;
        material['total_seconds'] = total_seconds;

        return material;
    }

    return material;
}
/********************/


/*****Design-3 functions*******/

function deg(v) {
    return (Math.PI/180) * v - (Math.PI/2);
}

function drawCircle(canvas, value, max, bg_color, fill_color, circle_width) {
    var circle = canvas.getContext('2d');
    
    circle.clearRect(0, 0, canvas.width, canvas.height);
    circle.lineWidth = circle_width;

    circle.beginPath();
    circle.arc(
            canvas.width / 2, 
            canvas.height / 2, 
            canvas.width / 2 - circle.lineWidth, 
            deg(0), 
            deg(360 / max * (max - value)), 
            false);
    circle.strokeStyle = bg_color;
    circle.stroke();

    circle.beginPath();
    circle.arc(
            canvas.width / 2, 
            canvas.height / 2, 
            canvas.width / 2 - circle.lineWidth, 
            deg(0), 
            deg(360 / max * (max - value)), 
            true);
    circle.strokeStyle = fill_color;
    circle.stroke();
}

/*****Design-3 functions end*******/

/*****Design-4 functions*******/

function setBar($el, value, max) {
    barWidth = 100 -(100/max * value);
    $el.width( barWidth + '%' );
}

/*****Design-4 functions end*******/