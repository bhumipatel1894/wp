jQuery(document).ready(function($) {

	// Add row for group button
	$(document).on('click', '.bwsp-add-row', function() {

		cls_ele 	= $(this).closest('.bwsp-group-button-sett');
		clone_ele	= $(this).closest('.bwsp-group-btn-row').clone();

		// Retrieve the highest current key
		var key = highest = -1;
		cls_ele.find( 'tr.bwsp-group-btn-row' ).each(function() {
			var current = $(this).data( 'key' );
			alert(current);
			if( parseInt( current ) > highest ) {
				highest = current;
			}
		});
		key = highest += 1;

		clone_ele.attr( 'data-key', key );
		clone_ele.find( 'td input, td select, textarea' ).val( '' );

		clone_ele.find( 'input, select, textarea' ).each(function() {
				var name = $( this ).attr( 'name' );
				var id   = $( this ).attr( 'id' );

				if( name ) {
					name = name.replace( /\[(\d+)\]/, '[' + parseInt( key ) + ']');
					$( this ).attr( 'name', name );
				}

				$( this ).attr( 'data-key', key );

				if( typeof id != 'undefined' ) {
					id = id.replace( /(\d+)/, parseInt( key ) );
					$( this ).attr( 'id', id );
				}
			});
		clone_ele.appendTo('.bwsp-group-button-sett');// Clone and insert
	});

	// Delete row
	$(document).on('click', '.bwsp-del-row', function() { 
		var msg 		= $(this).attr('data-msg');
		var num_of_row 	= $('.bwsp-group-button-sett .bwsp-group-btn-row').length;

		if(num_of_row == 1) {
			alert(BwspAdmin.sry_msg);
			return false;
		} else {
			$(this).closest('tr.bwsp-group-btn-row').remove();
		}
	});

	// On change of button type
	$(document).on('change', '.bwsp-post-sett-tbl .bwsp-btn-type', function() { 
		var selected_button = $(this).val();

		if(selected_button == 'button') {
			$( ".bwsp-group-button-sett" ).hide();
			$( ".bwsp-simple-button-sett" ).fadeIn();
		}

		if(selected_button =='button_group') {
			$('.bwsp-simple-button-sett').hide();
			$('.bwsp-group-button-sett').fadeIn();
		}
	});
});