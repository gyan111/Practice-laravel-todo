$(document).ready(function () {

	//validation of registrion form
	$('#registration_form').bootstrapValidator({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            firstname: {
                validators: {
                    notEmpty: {
                        message: 'The first name is required'
                    }
                }
            },
            lastname: {
                validators: {
                    notEmpty: {
                        message: 'The last name is required'
                    }
                }
            },
            username: {
                validators: {
                    notEmpty: {
                        message: 'The username is required'
                    },
                    stringLength: {
                        min: 5,
                        max: 30,
                        message: 'The username must be more than 6 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            country: {
                validators: {
                    notEmpty: {
                        message: 'The last name is required'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    },
                    different: {
                        field: 'username',
                        message: 'The password cannot be the same as username'
                    },
                    matches: {
                        field: 'password_confirmation',
                        message: 'The password must be the same as password confirmation'
                    }
                }
            }
        }
    });

	//validation of user update form
	$('#user_update_form').bootstrapValidator({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            firstname: {
                validators: {
                    notEmpty: {
                        message: 'The first name is required'
                    }
                }
            },
            lastname: {
                validators: {
                    notEmpty: {
                        message: 'The last name is required'
                    }
                }
            },
            username: {
                validators: {
                    notEmpty: {
                        message: 'The username is required'
                    },
                    stringLength: {
                        min: 5,
                        max: 30,
                        message: 'The username must be more than 6 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            country: {
                validators: {
                    notEmpty: {
                        message: 'The last name is required'
                    }
                }
            }
        }
    });

	//validation of project add and update form
	$('#project_form').bootstrapValidator({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'The first name is required'
                    }
                }
            }
        }
    });

    //validation of task add and update form
	$('#task_form').bootstrapValidator({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'The first name is required'
                    }
                }
            },
            project_id: {
                validators: {
                    notEmpty: {
                        message: 'The project is required'
                    }
                }
            },
            completed: {
                validators: {
                    notEmpty: {
                        message: 'The status is required'
                    }
                }
            }
        }
    });
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

	$('.dasboard_table_panel_body').hide();
	
	

	//$('.project_div').on('click', function (e) {
	$('.dashboard').on('click', '.project_div', function() {
  		var id = $(this).attr('id').replace(/\D/g,'');

  		
  		if(!$("#project_update_input_" + id).is(":visible"))
  		{
	  		if($("#table_body_" + id).is(":visible"))
	  		{
	  			$('.dasboard_table_panel_body').hide();
	  			$(".dynamic_tr").remove();
	  		}
	  		else
	  		{
	  			$('.dasboard_table_panel_body').hide();
	  			$(".dynamic_tr").remove();
	  			$("#table_body_" + id).show();
	  			$("#thead_" + id).hide();

	  			$.get("http://localhost/laravel-todo/projects/" + id, function(data) {
					$.each( data, function(i, task) {

						$("#thead_" + id).show();

						$('<tr>').attr('id', 'tr_' + task.id)
						.addClass("dynamic_tr")
						.appendTo('#tbody_' + task.project_id);

						$('<td>').attr('id', 'task_name_td_' + task.id)
						.appendTo('#tr_'+ task.id);

						$('<span>').attr('id', 'task_name_' + task.id)
						.html(task.name)
						.appendTo('#task_name_td_'+ task.id);

						$('<input>').addClass('form-control task_inputs')
						.attr('type', 'text', 'id')
						.attr('value', task.name)
						.attr('id', 'task_name_input_' + task.id)
						.appendTo('#task_name_td_'+ task.id);


						$('<td>').attr('id', 'task_description_td_' + task.id)
						.appendTo('#tr_'+ task.id);

						$('<span>').attr('id', 'task_description_' + task.id)
						.html(task.description)
						.appendTo('#task_description_td_'+ task.id);

						$('<input>').addClass('form-control task_inputs')
						.attr('type', 'text')
						.attr('value', task.description)
						.attr('id', 'task_description_input_' + task.id)
						.appendTo('#task_description_td_'+ task.id);


						$('<td>').attr('id', 'status_' + task.id)
						.appendTo('#tr_' + task.id);

						if (task.completed == 0)
						{
							status_class = "btn-default";
							icon_class = "fa-close";
						}else{
							status_class = "btn-success";
							icon_class = "fa-check";
						}
						$('<button>').addClass("btn btn-circle status_button " + status_class)
						.attr('id', 'status_button_' + task.id)
						.attr('project_id', 'status_button_' + task.project_id)
						.appendTo('#status_' + task.id);

						$('<i>').addClass("fa " + icon_class)
						.attr('id', 'icon_' + task.id)
						.appendTo('#status_button_' + task.id);

						$('<td>').attr('id', 'update_' + task.id)
						.appendTo('#tr_'+ task.id);

						$('<button>').addClass("btn btn-info update_task")
						.attr('id', 'update_task_button_' + task.id)
						.attr('project_id', 'update_task_button_project_id' + task.project_id)
						.html('Update')
						.appendTo('#update_' + task.id);

						$('<td>').attr('id', 'delete_' + task.id)
						.appendTo('#tr_'+ task.id);

						$('<button>').addClass("btn btn-danger delete_task")
						.attr('id', 'delete_task_button_' + task.id)
						.html('Delete')
						.appendTo('#delete_' + task.id);

						$('.task_inputs').hide();

					});	
				}, 'json');
	  		}

  		}
  		
	});


	$('.project_update_input_div').hide();

	$('.dashboard').on('click', '.update_project', function() {
		var id = $(this).attr('id').replace(/\D/g,'');

		if($('#update_project_button_' + id).html() == "Update")
		{

			$('.dasboard_table_panel_body').hide();
	  		$(".dynamic_tr").remove();

			$('#project_name_span_' + id).hide();
			$('#project_update_input_div_'+id).show();
			$('#project_update_input_' + id).val($('#project_name_span_'+id).text());
			$('#update_project_button_' + id).html('Save');
			$('#update_project_button_' + id).removeClass('btn-primary');
			$('#update_project_button_' + id).addClass('btn-warning');
			$('#delete_project_button_' + id).html('Cancel');
			$('#delete_project_button_' + id).removeClass('btn-danger');
			$('#delete_project_button_' + id).addClass('btn-inverse');
		}
		else
		{
			var name = $("#project_update_input_" + id).val();

			if (name != "") 
			{
				$.post("http://localhost/laravel-todo/projects/" + id, { 'name' :  name, 'description' : "", _method:"PATCH" }, function(data) {
					$('#project_name_span_'+id).text(name);
					$('#project_name_span_'+id).show();
					$('#project_update_input_div_'+id).hide();
					$('#update_project_button_' + id).html('Update');
					$('#update_project_button_' + id).addClass('btn-primary');
					$('#update_project_button_' + id).removeClass('btn-warning');
					$('#delete_project_button_' + id).html('Delete');
					$('#delete_project_button_' + id).addClass('btn-danger');
					$('#delete_project_button_' + id).removeClass('btn-inverse');
				});	
			}
			else
			{
				alert("Please Input Project Name");
			}
		}

	});

	//$('.delete_project').on('click', function (e) {
	$('.dashboard').on('click', '.delete_project', function() {
		var id = $(this).attr('id').replace(/\D/g,'');

		if($('#delete_project_button_' + id).html() == "Cancel")
		{
			$('#project_name_span_'+id).show();
			$('#project_update_input_div_'+id).hide();
			$('#update_project_button_' + id).html('Update');
			$('#update_project_button_' + id).addClass('btn-primary');
			$('#update_project_button_' + id).removeClass('btn-warning');
			$('#delete_project_button_' + id).html('Delete');
			$('#delete_project_button_' + id).addClass('btn-danger');
			$('#delete_project_button_' + id).removeClass('btn-inverse');
		}
		else
		{
			if (confirm("Are you sure?")) {
				
		  		$.post("http://localhost/laravel-todo/projects/" + id, { _method:"DELETE" }, function(data) {
					$("#project_main_div_" + id).remove();
				});	
		    }
    		return false;
		
		}

	});

	//add project dynamically

	$('.dashboard').on('click', '.add_project', function() {
		var name = $( "input" ).val();
		if (name != "") 
		{
			$.post("http://localhost/laravel-todo/projects", { 'name' :  name, 'description' : ""}, function(data) {
				$('<div class="panel panel-default" id="project_main_div_' + data + '">' + 
		            '<div class="panel-heading">' + 
		                '<div class="col-sm-8 project_div"  id="project_div_' + data + '">' + 
		                    '<div id="project_name_' + data + '">' + 
		                        '<span id="project_name_span_' + data + '">' + name + '</span>' + 
		                    '</div>' + 
		                    '<div class="project_update_input_div" id="project_update_input_div_' + data + '">' + 
		                        '<input class="form-control" id="project_update_input_' + data + '" type="text" name="name" placeholder="Project Name">' + 
		                    '</div>' + 
		                '</div>' + 
		                '<div class="cols-sm-3">' + 
		                    '<button class="btn btn-primary update_project" id="update_project_button_' + data + '">Update</button>' + 
		                    '<button class="btn btn-danger delete_project" id="delete_project_button_' + data + '">Delete</button>' + 
		                '</div>' + 
		            '</div>' + 
		            '<div class="dasboard_table_panel_body panel-body" id="table_body_' + data + '">' + 
		                '<div class="table-responsive">' + 
		                    '<table class="table table-hover" id="">' + 
		                        '<thead id="thead_' + data + '">' + 
		                            '<tr>' + 
		                                '<th>Task Name</th>' + 
		                                '<th>Description</th>' + 
		                                '<th>Status</th>' + 
		                                '<th>Update</th>' + 
		                                '<th>Delete</th>' + 
		                            '</tr>' + 
		                        '</thead>' + 
		                        '<tbody id="tbody_' + data + '">' + 
		                        '</tbody>' + 
		                    '</table>' + 
		                '</div>' + 
		                '<div id="add_task_div_' + data + '">' + 
		                    '<div class="col-sm-4">' + 
		                        '<input class="form-control" id="add_task_name_input_' + data +'" type="text" name="name" placeholder="Task Name">' + 
		                    '</div>' + 
		                    '<div class="col-sm-4">' + 
		                        '<input class="form-control" id="add_task_description_input_' + data + '" type="text" name="name" placeholder="Task Description">' + 
		                    '</div>' + 
		                    '<div class="cols-sm-3">' + 
		                        '<button class="btn btn-info add_task" id="add_task_button_' + data + '">Add Task</button>' + 
		                    '</div>' + 
		                '</div>' + 
		            '</div>' + 
		        '</div>').insertAfter( ".input_div" );
			$('.project_update_input_div').hide();
			$('.dasboard_table_panel_body').hide();
			$( "input" ).val("");

			});	
		}
		else
		{
			alert("Please Input Project Name");
		}
		
	});

	//add task dynamically	
	$('.dashboard').on('click', '.add_task', function() {

		var id = $(this).attr('id').replace(/\D/g,'');

		if($('#add_task_name_input_' + id).val() == "")
		{
			alert('Please Input Task Name');
		}else
		{
			var name = $('#add_task_name_input_' + id).val();
			var description = $('#add_task_description_input_' + id).val()
			$.post("http://localhost/laravel-todo/tasks", { 'name' :  name , 'description' : description, 'project_id' : id}, function(data) {
				
				$("#thead_" + id).show();

				$('#add_task_name_input_' + id).val("");
				$('#add_task_description_input_' + id).val("");

				$('<tr>').attr('id', 'tr_' + data)
				.addClass("dynamic_tr")
				.prependTo('#tbody_' + id);

				$('<td>').attr('id', 'task_name_td_' + data)
				.appendTo('#tr_'+ data);

				$('<span>').attr('id', 'task_name_' + data)
				.html(name)
				.appendTo('#task_name_td_'+ data);

				$('<input>').addClass('form-control task_inputs')
				.attr('type', 'text', 'id')
				.attr('value', name)
				.attr('id', 'task_name_input_' + data)
				.appendTo('#task_name_td_'+ data);

				$('<td>').attr('id', 'task_description_td_' + data)
				.appendTo('#tr_'+ data);

				$('<span>').attr('id', 'task_description_' + data)
				.html(description)
				.appendTo('#task_description_td_'+ data);

				$('<input>').addClass('form-control task_inputs')
				.attr('type', 'text')
				.attr('value', description)
				.attr('id', 'task_description_input_' + data)
				.appendTo('#task_description_td_'+ data);


				$('<td>').attr('id', 'status_' + data)
				.appendTo('#tr_' + data);

				$('<button>').addClass("btn btn-circle btn-default status_button")
				.attr('id', 'status_button_' + data)
				.attr('project_id', 'status_button_' + id)
				.appendTo('#status_' + data);

				$('<i>').addClass("fa fa-close")
				.attr('id', 'icon_' + data)
				.appendTo('#status_button_' + data);

				$('<td>').attr('id', 'update_' + data)
				.appendTo('#tr_'+ data);

				$('<button>').addClass("btn btn-info update_task")
				.attr('id', 'update_task_button_' + data)
				.attr('project_id', 'update_task_button_project_id' + id)
				.html('Update')
				.appendTo('#update_' + data);

				$('<td>').attr('id', 'delete_' + data)
				.appendTo('#tr_'+ data);

				$('<button>').addClass("btn btn-danger delete_task")
				.attr('id', 'delete_task_button_' + data)
				.html('Delete')
				.appendTo('#delete_' + data);

				$('.task_inputs').hide();
			});	
		}
		
	}); 

	//$('.delete_project').on('click', function (e) {
	$('.dashboard').on('click', '.delete_task', function() {
		var id = $(this).attr('id').replace(/\D/g,'');

		if($('#delete_task_button_' + id).html() == "Cancel")
		{
			$('#task_name_'+id).show();
			$('#task_description_'+id).show();
			$('#task_name_input_' + id).hide();
			$('#task_description_input_' + id).hide();
			$('#project_update_input_div_'+id).hide();
			$('#update_task_button_' + id).html('Update');
			$('#update_task_button_' + id).addClass('btn-primary');
			$('#update_task_button_' + id).removeClass('btn-warning');
			$('#delete_task_button_' + id).html('Delete');
			$('#delete_task_button_' + id).addClass('btn-danger');
			$('#delete_task_button_' + id).removeClass('btn-inverse');
		}
		else
		{
			if (confirm("Are you sure?")) {
				
		  		$.post("http://localhost/laravel-todo/tasks/" + id, { _method:"DELETE" }, function(data) {
					$("#tr_" + id).remove();
				});	
		    }
		}
		return false;

	});

	//task update operation
	$('.dashboard').on('click', '.update_task', function() {
		var id = $(this).attr('id').replace(/\D/g,'');
		var project_id = $(this).attr('project_id').replace(/\D/g,'');

		if($('#update_task_button_' + id).html() == "Update")
		{
			$('#task_name_' + id).hide();
			$('#task_description_' + id).hide();
			$('#task_name_input_' + id).show();
			$('#task_description_input_' + id).show();
			$('#update_task_button_' + id).html('Save');
			$('#update_task_button_' + id).removeClass('btn-primary');
			$('#update_task_button_' + id).addClass('btn-warning');
			$('#delete_task_button_' + id).html('Cancel');
			$('#delete_task_button_' + id).removeClass('btn-danger');
			$('#delete_task_button_' + id).addClass('btn-inverse');
		}
		else
		{
			var name = $("#task_name_input_" + id).val();
			var description = $("#task_description_input_" + id).val();

			if (name != "") 
			{
				$.post("http://localhost/laravel-todo/tasks/" + id, { 'name' :  name, 'description' : description, 'completed' : 0, 'project_id': project_id, _method:"PATCH" }, function(data) {
					$('#task_name_'+id).text(name);
					$('#task_description_'+id).text(description);
					$('#task_name_'+id).show();
					$('#task_description_'+id).show();
					$('#task_name_input_' + id).hide();
					$('#task_description_input_' + id).hide();
					$('#project_update_input_div_'+id).hide();
					$('#update_task_button_' + id).html('Update');
					$('#update_task_button_' + id).addClass('btn-primary');
					$('#update_task_button_' + id).removeClass('btn-warning');
					$('#delete_task_button_' + id).html('Delete');
					$('#delete_task_button_' + id).addClass('btn-danger');
					$('#delete_task_button_' + id).removeClass('btn-inverse');
				});	
			}
			else
			{
				alert("Please Input task Name");
			}
		}

	});

	//task status update operation
	$('.dashboard').on('click', '.status_button', function() {
		var id = $(this).attr('id').replace(/\D/g,'');
		var project_id = $(this).attr('project_id').replace(/\D/g,'');

		if($('#status_button_' + id).hasClass('btn-default'))
		{
			$('#status_button_' + id).removeClass('btn-default');
			$('#status_button_' + id).addClass('btn-success');
			$('#icon_' + id).removeClass('fa-close');
			$('#icon_' + id).addClass('fa-check');
			var completed = 1;
		}
		else
		{
			$('#status_button_' + id).addClass('btn-default');
			$('#status_button_' + id).removeClass('btn-success');
			$('#icon_' + id).addClass('fa-close');
			$('#icon_' + id).removeClass('fa-check');
			var completed = 0;
				
		}
		$.post("http://localhost/laravel-todo/task/status-update", {'id' : id, 'project_id' : project_id, 'completed': completed}, function(data) {

			$(".dynamic_tr").remove();
			$.get("http://localhost/laravel-todo/projects/" + project_id, function(data) {
				$.each( data, function(i, task) {

					$("#thead_" + id).show();

					$('<tr>').attr('id', 'tr_' + task.id)
					.addClass("dynamic_tr")
					.appendTo('#tbody_' + task.project_id);

					$('<td>').attr('id', 'task_name_td_' + task.id)
					.appendTo('#tr_'+ task.id);

					$('<span>').attr('id', 'task_name_' + task.id)
					.html(task.name)
					.appendTo('#task_name_td_'+ task.id);

					$('<input>').addClass('form-control task_inputs')
					.attr('type', 'text', 'id')
					.attr('value', task.name)
					.attr('id', 'task_name_input_' + task.id)
					.appendTo('#task_name_td_'+ task.id);


					$('<td>').attr('id', 'task_description_td_' + task.id)
					.appendTo('#tr_'+ task.id);

					$('<span>').attr('id', 'task_description_' + task.id)
					.html(task.description)
					.appendTo('#task_description_td_'+ task.id);

					$('<input>').addClass('form-control task_inputs')
					.attr('type', 'text')
					.attr('value', task.description)
					.attr('id', 'task_description_input_' + task.id)
					.appendTo('#task_description_td_'+ task.id);


					$('<td>').attr('id', 'status_' + task.id)
					.appendTo('#tr_' + task.id);

					if (task.completed == 0)
					{
						status_class = "btn-default";
						icon_class = "fa-close";
					}else{
						status_class = "btn-success";
						icon_class = "fa-check";
					}
					$('<button>').addClass("btn btn-circle status_button " + status_class)
					.attr('id', 'status_button_' + task.id)
					.attr('project_id', 'status_button_' + task.project_id)
					.appendTo('#status_' + task.id);

					$('<i>').addClass("fa " + icon_class)
					.attr('id', 'icon_' + task.id)
					.appendTo('#status_button_' + task.id);

					$('<td>').attr('id', 'update_' + task.id)
					.appendTo('#tr_'+ task.id);

					$('<button>').addClass("btn btn-info update_task")
					.attr('id', 'update_task_button_' + task.id)
					.attr('project_id', 'update_task_button_project_id' + task.project_id)
					.html('Update')
					.appendTo('#update_' + task.id);

					$('<td>').attr('id', 'delete_' + task.id)
					.appendTo('#tr_'+ task.id);

					$('<button>').addClass("btn btn-danger delete_task")
					.attr('id', 'delete_task_button_' + task.id)
					.html('Delete')
					.appendTo('#delete_' + task.id);

					$('.task_inputs').hide();

				});	
			}, 'json');

					
		});	

	});

});