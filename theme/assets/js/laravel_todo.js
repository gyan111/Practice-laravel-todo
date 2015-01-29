$(document).ready(function () {
	$('.edit_image').click(function() {
		var ajax_url = this.href;
		
		$('#image_modal').modal({
			remote: ajax_url 
		});
		
		return false;
	});
	
	$('#image_modal').on('hidden.bs.modal', function (e) {
  		$(this).removeData('bs.modal');
	});

	$('#image_modal').on('loaded.bs.modal', function update_image() {

		$('#update_image').ajaxForm(function () {
			// $.post($('#update_image').attr('action'), $('#update_image').serialize(), function(data) {
				$('#image_modal .modal-content').html(data);
				
				if ($('#image_uploaded_successfully').length > 0) {
					setTimeout(function(){$('#image_modal').modal('hide');}, 1500);
				} else {
					update_image();
				}
			//});
			return false;
		}); 
	});

	$('.project_div').on('click', function (e) {
  		var id = $(this).attr('id').replace(/\D/g,'');

  		$.post("http://localhost/laravel-todo/projects/tasks", { 'id' : id }, function(data) {
				//alert('hi');
				// $.each(data, function(index, value) {
				// 	$('#invoice_read_status_' + value).removeClass('label-danger').addClass('label-warning').html('sent');
				// });
				
		 	}, 'json');
	});
});