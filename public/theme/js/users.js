var Users = function () {
    var $form = null;
    var bindElement1 = function () {
        $form = $('#form-add-user');
        $form.formValidation({
            framework: 'bootstrap',
            icon: {
//            valid: 'glyphicon glyphicon-ok',
//            invalid: 'glyphicon glyphicon-remove',
//            validating: 'glyphicon glyphicon-refresh'
            },
            err: {
                container: 'tooltip'
            },
            fields: {
                first_name: {
                    validators: {
                        notEmpty: {
                            message: 'The first name is required'
                        },
                        blank: {}
                    }
                },
                last_name: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required'
                        },
                        blank: {}
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email/username is required'
                        },
                        blank: {}
                    }
                },
                'role[]': {
                    validators: {
                        choice: {
                            min: 1,
                            message: 'Please choose one role'
                        },
                        blank: {}
                    }
                }
            }
        });
                $form.find('input[name="role[]"]')
                // Init icheck elements
                
                // Called when the radios/checkboxes are changed
                .on('ifChanged', function (e) {
                    // Get the field name
                    var field = $(this).attr('name');
                    $form.formValidation('revalidateField', field);
                })
                .end();
        if (typeof window.form_errors !== 'undefined') {
            $.each(window.form_errors, function (field, message) {
                $form.data('formValidation').updateMessage(field, 'blank', message[0])
                        .updateStatus(field, 'INVALID', 'blank');
            });
        }
    };
    var bindElement = function() {
        $("#email").keyup(function()
	{
		var name = $(this).val();
		if(name.length > 0)
		{
			$("#userResult").html('<i class="fa fa-refresh"></i>');
			/*$.post("/wrf/user/check.php", $("#wrf").serialize())
				.done(function(data){
				$("#userResult").html(data);
			});*/
                var post_data = {};
                post_data.email = name,post_data.id = $(this).data('id');
			$.ajax({
				type : 'POST',
				url  : capp.base_url+'/user/check',
				data : post_data,
				success : function(data)
				{
					$("#userResult").html(data);
				}
			});
			return false;
		}
		else
		{
			$("#userResult").html('<i class=""></i>');
		}
	});
    }
    return {
        init: function () {
            bindElement();
        }
    };
}();

