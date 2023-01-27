jQuery( document ).ready(function($) {
	
	$( document ).on( "click", ".wp-tsasp-mb-nav a", function() {
		
        //  First remove class "active" from currently active tab
        $(".wp-tsasp-mb-nav").removeClass('wp-tsasp-active');
        	
        //  Now add class "active" to the selected/clicked tab
        $(this).parent('.wp-tsasp-mb-nav ').addClass("wp-tsasp-active");
        	
        //  Hide all tab content
        $(".wp-tsasp-tab-cnt").hide();
        	
        //  Here we get the href value of the selected tab
        var selected_tab = $(this).attr("href");
        	
        //  Show the selected tab content
        $(selected_tab).show();

        // Pass selected tab
        $('.wp-tsasp-selected-tab').val(selected_tab);

        //  At the end, we add return false so that the click on the link is not executed
        return false;
    });

    // Remain selected tab for user
    if( $('.wp-tsasp-selected-tab').length > 0 ) {
        var sel_tab = $('.wp-tsasp-selected-tab').val();

        if( typeof(sel_tab) !== 'undefined' && sel_tab != ''  ) {
            $('.wp-tsasp-mb-nav [href="'+sel_tab+'"]').click();
        }
    }
	
    // Drag and Drop Social Services
    $( '.wp-tsasp-sdetails-tbl' ).sortable({
        items   : '.wp-tsasp-social-row',
        handle  : ".wp-tsasp-sdrag",
        cursor  : 'move',
        axis    : 'y',
        containment         : '.wp-tsasp-sdetails',
        scrollSensitivity   : 40,
        placeholder         : "wp-tsasp-state-highlight",
        helper: function( event, ui ) {
            return ui;
        },
        start: function( event, ui ) {
        },
        stop: function( event, ui ) {
        },
        update: function( event, ui ) {
        }
    });

});