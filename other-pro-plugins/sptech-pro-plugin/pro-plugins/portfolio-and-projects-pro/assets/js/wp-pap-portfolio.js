// Utility
if (typeof Object.create !== 'function') {
    Object.create = function(obj) {
        function F() {};
        F.prototype = obj;
        return new F();
    };
}

(function($, window, document, undefined) {

    var Portfolio = {
        init: function(options, elem) {
            var self = this;

            self.$elem = $(elem);
            self.$thumnail = $(elem).find('.wppap-thumbnail');

            // Options
            self.options = $.extend({}, $.fn.portfolio.options, options || {});

            // Set columns width
            //self.setColWidth();

            // On click
            self.$thumnail.click(function(ev) {
                ev.preventDefault();
                self.showContent($(this));
                return false;
            });
        },
        setColWidth: function() {
            var self = this;

            if ($(window).width() > 970) {
                var colWidth = ((100 / self.options.cols));
                self.$elem.find('li').css('width', colWidth + '%');
            }
        },
        getContentPos: function(clicked) {
            var self = this,
                thumbnails = self.$elem.find('.wppap-thumbnail:visible'),
                contentPos = null;

            for (var i = 0; i <= thumbnails.length; i++) {
                // Get href
                var href = clicked.attr('data-mfp-src') ? clicked.attr('data-mfp-src') : clicked.attr('href');
                var thumbnails_href = $(thumbnails[i]).attr('data-mfp-src') ? $(thumbnails[i]).attr('data-mfp-src') : $(thumbnails[i]).attr('href');

                if (href == thumbnails_href) {
                    // If its not the last thumb
                    if (i !== (thumbnails.length - 1)) {

                        var cols = self.options.cols;
                        if ($(window).width() <= 1200 && $(window).width() > 1025) cols = 3;
                        else if ($(window).width() <= 1024 && $(window).width() > 641) cols = 2;
                        else if ($(window).width() <= 640) cols = 1;

                        // thumb position
                        var thumbPos = i + 1;
                        // If there's no reminder
                        var contentPos = 0;
                        if (thumbPos % cols !== 0)
                            contentPos = (cols - (thumbPos % cols)) + thumbPos;
                        else // If we have a reminder
                            contentPos = thumbPos;

                        // Clean & Validate (This fixes weird bug when there's only 2 thumbs)
                        if (contentPos > thumbnails.length) {
                            contentPos = thumbnails.length;
                        }
                    } else {
                        contentPos = i + 1;
                    }
                }
            }

            return contentPos;
        },
        showContent: function(thumbnail) {

            var $href = thumbnail.attr('data-mfp-src') ? thumbnail.attr('data-mfp-src') : thumbnail.attr('href'),
                self = this,
                contentPos = self.getContentPos(thumbnail);

            // Remove existing stuff first
            self.$elem.closest('.wppap-li-inner-wrap').find('.wppap-active-arrow').remove();
            self.$elem.find('li.wppap-content').slideUp(300).remove();

            // Add active arrow
            thumbnail.closest('.wppap-li-inner-wrap').append('<span class="wppap-active-arrow"></span>');

            // Add content
            var $portfolioContent = $($href);
            var html = '<li class="wppap-content"><span class="wppap-close">&times;</span>' + $portfolioContent.html() + '</li>';

            self.$elem.find('li:visible:eq(' + (contentPos - 1) + ')').after(html);

            // Animate
            //self.$elem.find('li')[self.options.transition](500);
            self.$elem.find('.wppap-content')[self.options.transition](500);
            $('html, body').animate({
                scrollTop: self.$elem.find('li.wppap-content').offset().top -150
            }, 700);

            // Close content
            self.$elem.find('.wppap-close').click(function(){
                self.$elem.find('.wppap-active-arrow').remove();
                self.$elem.find('li.wppap-content').slideUp(300, function(){
                    $(this).remove();
                });
            });
        }
    };

    $.fn.portfolio = function(options) {
        return this.each(function(){
            var portfolio = Object.create(Portfolio);
            portfolio.init(options, this);
        });
    };

    // Default options
    $.fn.portfolio.options = {
        cols: 3,
        transition: 'slideDown'
    };

    // Close Popup on esc
    $(document).keypress(function(e) {
        if (e.keyCode == 27) {
           wppap_close_popup();
        }
    });

    // Open popup on reference link
    $(document).on('click', '.wppap-portfolio-inline .wppap-popup-ref-link', function(){
        $(this).closest('.wppap-portfolio-wrp').find('.wppap-thumbnail').click();
    });

})(jQuery, window, document);