localStorage.clear();

//
// Open a modal form
//
$(document).on('click', 'a[data-toggle="modal"]', function(e) 
{
	var target_modal = '#modal';
	var remote_content = e.currentTarget.href;
	var modal = $(target_modal);
	
	var modalDialog = $(target_modal + ' .modal-dialog');
	modalDialog.addClass($(e.currentTarget).data('size'));
	
	var modalBody = $(target_modal + ' .modal-content');
	
	modal.off('show.bs.modal');
	modal.on('show.bs.modal', function () 
	{
		modalBody.load(remote_content);
	}).modal();
	return false;
});

//
// Cliking on a modal-link inside a modal form
// Loads remote content
//
$(document).on('click', '.modal-link', function(e) 
{	
	var target_modal = '#modal';
	var remote_content = e.currentTarget.href;
	var modal = $(target_modal);
	var modalBody = $(target_modal + ' .modal-content');
	modalBody.html('<div class="progress"><div class="progress-bar progress-bar-striped active"></div></div>');
	modal.off('show.bs.modal');
	modal.on('show.bs.modal', function () 
	{
		modalBody.load(remote_content);
	}).modal();
	return false;
});

//
// Process and submit a modal form
//
$(document).on('submit', '#modal-form', function(e)
{
	e.preventDefault();

	$('.input-group').removeClass('has-error has-feedback');
	$('.form-control-feedback').remove();
	$('.text-danger').remove();

	$.ajax(
	{
		url: $('#modal-form').attr('action'), 
		type: 'POST', 
		data: $("#modal-form").serialize(),
		success: function( response ) 
		{
			console.log(response);
			if (response == 1)
			{
				$('#modal').modal('hide');
				location.reload();
			}
			else if (response.action == 'load')
			{
				var target_modal = '#modal';
				var remote_content = e.currentTarget.href;
				var modal = $(target_modal);
				var modalBody = $(target_modal + ' .modal-content');
				modalBody.html('<div class="progress"><div class="progress-bar progress-bar-striped active"></div></div>');
				modal.off('show.bs.modal');
				modal.on('show.bs.modal', function(){
					modalBody.load(response.url);
				}).modal();
			}
			else if (response.action == 'redirect')
			{
				window.location = response.url;
			}
			else
			{
				alert("Oops, looks like something went wrong!");
			}
		},
		error: function( response )
		{
			var errors = response.responseJSON; //this will get the errors response data.
			console.log(errors);
			$.each( errors , function( key, value ) {
				$('input[name=' + key + ']').parent().addClass('has-error has-feedback');
				$('input[name=' + key + ']').parent().append('<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>');
				$('input[name=' + key + ']').parent().after('<p class="help-block text-danger">'+value+'</p>');
			});
		}
	});
});

//
// Cleanup the modal form on close
//
$(document).on('hidden.bs.modal', '#modal', function () 
{ 
	$('#modal').removeData('bs.modal'); 
	$('#modal .modal-content').html('<div class="progress"><div class="progress-bar progress-bar-striped active"></div></div>'); 
	$('#modal .modal-dialog').removeClass('modal-sm');
	$('#modal .modal-dialog').removeClass('modal-lg');
});
