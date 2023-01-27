jQuery( document ).ready(function($) {

    // Initialize color box
	$('.wpcdt-color-box').wpColorPicker();
	
    // Date time picker
	$('.wpcdt-countdown-datepicker').datetimepicker({
		dateFormat: 'yy-mm-dd',
		timeFormat: 'HH:mm:ss',
	});
    
    $(".wpcdt-circle-slider").slider({
	    min: 0.0033333333333333335,
	    max: 0.13333333333333333,
	    step: 0.003333333,
	    slide: function (event, ui) {
	        $(this).parent().find(".wpcdt-number").val(ui.value);
	        
	        var value = $(this).slider("option","value");
        	$(this).find(".ui-slider-handle").text(value);
	    },
	    create: function(event, ui){
	        $(this).slider('value',$(this).parent().find(".wpcdt-number").val());
	    },
	    change: function() {
        var value = $(this).slider("option","value");
        $(this).find(".ui-slider-handle").text(value);
    	},
	});

	$(".wpcdt-background-slider").slider({
	    min: 0.1,
	    max: 3,
	    step: 0.1,
	    slide: function (event, ui) {
	        $(this).parent().find(".wpcdt-number").val(ui.value);

	        var value = $(this).slider("option","value");
        	$(this).find(".ui-slider-handle").text(value);
	    },
	    create: function(event, ui){
	        $(this).slider('value',$(this).parent().find(".wpcdt-number").val());
	    },
	    change: function() {
        var value = $(this).slider("option","value");
        $(this).find(".ui-slider-handle").text(value);
    	},
	});

    $(".wpcdt-circle-2-slider").slider({
        min: 1,
        max: 25,
        step: 1,
        slide: function (event, ui) {
            $(this).parent().find(".wpcdt-number").val(ui.value);
            
            var value = $(this).slider("option","value");
            $(this).find(".ui-slider-handle").text(value);
        },
        create: function(event, ui){
            $(this).slider('value',$(this).parent().find(".wpcdt-number").val());
        },
        change: function() {
        var value = $(this).slider("option","value");
        $(this).find(".ui-slider-handle").text(value);
        },
    });

    // On change of style
    $(document).on('change', ".wpcdt-design", function(data) {

        var style = $(this).val();
        
        $(".wpcdt-post-common").addClass("wpcdt-post-hide");
        $(".wpcdt-post-"+style).removeClass("wpcdt-post-hide");
        $(".wpcdt-post-"+style).show(300);
        $(".wpcdt-post-hide").hide();
    });

    // e-commerce integration
    $('.wpcdt-integrate-ecom #wpcdt-ecom').change(function(){
        if(this.checked) {
            $('.wpcdt-mb-tabs-wrp').fadeIn();
        } else {
            $('.wpcdt-mb-tabs-wrp').fadeOut();
        }
    });

    // Tab
	$( document ).on( "click", ".wpcdt-mb-nav a", function() {
		
        //  First remove class "active" from currently active tab
        $(".wpcdt-mb-nav").removeClass('wpcdt-active');
        	
        //  Now add class "active" to the selected/clicked tab
        $(this).parent('.wpcdt-mb-nav ').addClass("wpcdt-active");
        	
        //  Hide all tab content
        $(".wpcdt-tab-cnt").hide();
        
        //  Here we get the href value of the selected tab
        var selected_tab = $(this).attr("href");
        
        //  Show the selected tab content
        $(selected_tab).fadeIn();

        //  At the end, we add return false so that the click on the link is not executed
        return false;
    });
});