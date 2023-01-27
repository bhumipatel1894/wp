jQuery(document).ready(function($){
	// Submit form data via Ajax
    $("#gp_insert").on('submit', function(e)
	{
        e.preventDefault();
        $('#success_message').hide();

        var formData = new FormData();
		
		// get file field value using field id				
		var gp_post_title = $("#gp_post_title").val();
		var gp_post_type_val = $("#gp_post_type").val();
		var gp_post_type_name = $("#gp_post_type").find(':selected').data("name");
		var gp_post_descri = $("#gp_post_descri").val();
		var gp_post_excerpt = $("#gp_post_excerpt").val();
		var security = $("#security").val();
		
		file_data = $("#fi_file").prop('files')[0];
		formData.append('file', file_data);
		formData.append('action', 'upload_file');
		formData.append('gp_post_title', gp_post_title);
		formData.append('gp_post_type_val', gp_post_type_val);
		formData.append('gp_post_type_name', gp_post_type_name);
		formData.append('gp_post_descri', gp_post_descri);
		formData.append('gp_post_excerpt', gp_post_excerpt);
		formData.append('security', security);
		
		$.ajax({
			url: Wpgp.ajax_url,
			type: "POST",
			data:formData,cache: false,			
			processData: false, // Don’t process the files
			contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			success:function(response) {
				console.log(response);
			$('#success_message').show();	
			$('#success_message').fadeIn().html(response);
			

			setTimeout(function() {
					$('#success_message').fadeOut("slow");
					$('#success_message').hide();
				}, 2000 );
			
			$("#gp_insert").trigger("reset");
			
			},
		});
		
		return false;		
		
    });

    $(".change_status").click(function(){

    	var cpostid = $(this).data("pid"); 
    	var you = $(this);   
		
		var data = {
                        action : 'gp_post_public',  
                        pid : cpostid,
                    };
        $.post(Wpgp.ajax_url,data,function(response) {
        	console.log(response);
        	if(response == '2000' || response == 2000 ){
        		$('#pub_succ').show();
        		$('#pub_succ').fadeIn().html("post has been published");
        		you.parent().parent().remove();
        		setTimeout(function() {
					$('#pub_succ').fadeOut("slow");
				}, 2000 );
        	} else{

        	}
        });
    	//
    });

});