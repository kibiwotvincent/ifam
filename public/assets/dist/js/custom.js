$(function () {
	$('form.ajax').submit(function (e) {
		e.preventDefault();
		let id = $(this).attr('id');
		ajaxPost('#'+id);
	});
	
	$('form.ajax-upload').submit(function (e) {
		e.preventDefault();
		let id = $(this).attr('id');
		let formName = '#'+id;
		
		let csrfToken = $('form'+formName+' input[name="_token"]').val();
		
		let formData = new FormData();
		if($('#profile-photo')[0].files.length !== 0 ) {
			//append only if input has file
			let profilePhoto = $('#profile-photo')[0].files[0];
			formData.append('profile_photo', profilePhoto);
		}
		
        formData.append('_token', csrfToken);
		
		ajaxPost(formName, formData);
	});

	function ajaxPost(formName, formData = null)
	{
		commandButton = formName+"_submit";
		commandButtonText = $(commandButton).html();
		
		let setUp = 
		{
			type: "POST",
			url: $(formName).attr("action"),
			dataType: "json",
			beforeSend: function(){
				$(commandButton).attr("disabled","disabled");
				$(formName+"_feedback").addClass("d-none");
				$(formName+"_submit").html(commandButtonText+" <i class=\"fa fa-spin fa-spinner\"></i>");
				resetFormStyle(formName);
			},
			complete: function(){
				$(commandButton).removeAttr("disabled").html(commandButtonText);
				return;
			},
			success: function(response) {
				let message = "<div class=\"alert alert-success role=\"alert\">"+response.message+"</div>";
				$(formName+"_feedback").html(message).removeClass("d-none");
				
				let redirectUrl = $('form'+formName+' input[name="_redirect"]').val();
				if(typeof redirectUrl !== 'undefined' && redirectUrl != "")
				{
					window.location = redirectUrl;
				}
			},
			error: function(response) {
				
				let jsonResponse = response.responseJSON;
				
				if(typeof jsonResponse.message !== 'undefined') {
					let message = "<div class=\"alert alert-danger role=\"alert\">"+jsonResponse.message+"</div>";
					$(formName+"_feedback").html(message).removeClass("d-none");
				}
				
				let statusCode = response.status;
				if(statusCode == 422) {
					/*validation errors*/
					let errors = jsonResponse.errors;
					
					let keysArray = Object.keys(errors);
					
					for(let key of keysArray) {
						updateFormStyle(formName, key, errors);
					};
					return;
				}
				
				if(statusCode == 419) {
					/*refresh page if csrf is invalid (forcing new csrf)*/
					if(jsonResponse.message == "CSRF token mismatch.")
					{
						window.location.reload(true);
					}
				}
				
			}
		};
		
		if(formData == null) {
			setUp.data = $(formName).serialize();
		}
		else {
			setUp.data = formData;
			setUp.contentType = false;
            setUp.processData = false;
		}
		
		$.ajax(setUp);
	}
	
	function updateFormStyle(formName, field, errors) {
		/*add is-invalid class to invalid inputs*/
		$('form'+formName+' input[type="text"], input[type="number"], textarea').each(function(i) {
			if(field == $(this).attr('name')) {
				$(this).addClass('is-invalid');
			}
		});
		
		/*add error messages below each invalid input*/
		$('form'+formName+' .error').each(function(i) {
			if(field == $(this).attr('for')) {
				$(this).addClass('text-danger');
				$(this).removeClass('d-none').html(errors[field][0]);
			}
		});
	}
	
	function resetFormStyle(formName) {
		$('form'+formName+' input[type="text"], input[type="number"], textarea').each(function(i) {
			$(this).removeClass('is-invalid');
		});
		
		$('form'+formName+' .error').each(function(i) {
			$(this).addClass('d-none').html("");
		});
	}

});