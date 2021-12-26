function editGenders(genderId = null) {
	if(genderId) {
		// remove hidden gender id text
		$('#genderId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-gender-result').addClass('div-hide');
		// modal footer
		$('.editGenderFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedGender.php',
			type: 'post',
			data: {genderId : genderId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-gender-result').removeClass('div-hide');
				// modal footer
				$('.editGenderFooter').removeClass('div-hide');

				// setting the gender name value 
				$('#editGenderName').val(response.gender);
				// setting the gender status value
				// gender id 
				$(".editGenderFooter").after('<input type="hidden" name="genderId" id="genderId" value="'+response.id+'" />');

				// update gender form 
				$('#editGenderForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var genderName = $('#editGenderName').val();

					if(genderName == "") {
						$("#editGenderName").after('<p class="text-danger">gender Name field is required</p>');
						$('#editGenderName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editGenderName").find('.text-danger').remove();
						// success out for form 
						$("#editGenderName").closest('.form-group').addClass('has-success');	  	
					}					

					if(genderName) {
						var form = $(this);

						// submit btn
						$('#editGenderBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editGenderBtn').button('reset');

									// reload the manage member table 
									manageGenderTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-gender-messages').html('<div class="alert alert-success">'+
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
				}); // /update gender form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit genders function
