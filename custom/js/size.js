function editsizes(sizeId = null) {
	if(sizeId) {
		// remove hidden size id text
		$('#sizeId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-size-result').addClass('div-hide');
		// modal footer
		$('.editsizeFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedsize.php',
			type: 'post',
			data: {sizeId : sizeId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-size-result').removeClass('div-hide');
				// modal footer
				$('.editsizeFooter').removeClass('div-hide');

				// setting the size name value 
				$('#editsizeName').val(response.size);
				// setting the size status value
				// size id 
				$(".editsizeFooter").after('<input type="hidden" name="sizeId" id="sizeId" value="'+response.id+'" />');

				// update size form 
				$('#editsizeForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var sizeName = $('#editsizeName').val();

					if(sizeName == "") {
						$("#editsizeName").after('<p class="text-danger">size Name field is required</p>');
						$('#editsizeName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editsizeName").find('.text-danger').remove();
						// success out for form 
						$("#editsizeName").closest('.form-group').addClass('has-success');	  	
					}					

					if(sizeName) {
						var form = $(this);

						// submit btn
						$('#editsizeBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editsizeBtn').button('reset');

									// reload the manage member table 
									managesizeTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-size-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								} // /if
									
							}// /success
						});	 // /ajax												
					} // /if

					return false;
				}); // /update size form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit sizes function
