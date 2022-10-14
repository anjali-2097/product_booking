
$(document).ready(function(){
	$("#admin_login_form").validate({
		rules: {
			email: {
				required: true,
			},
			password: {
				required: true,
			}
		},
		messages: {
			email: {
				required: "Enter Your Email",
			},
			password: {
				required: "Enter Your Password",
			}
		},errorPlacement: function(error, element) 
		{
			error.appendTo( element.parents('.add_error') );
		}  
	});

	$(document).on('submit', '#admin_login_form', function(e) {
		e.preventDefault();

		var email = $('#email').val();
		var password = $('#password').val();
		// var remember = $('#remember').val();

		if( $("#admin_login_form").validate()){
			$.ajax({
				type: 'POST',
				url: base_url+"login_check", 
				data: {email:email,password:password},
				dataType: "json",
				success: function(data){
					if(data.success==1){
						window.location=base_url;
					}else{
						$.notify({
							wrapper: 'body',
							message: data.message,
							type: 'error',
							position: 3,
							dir: 'rtl',
							duration: 4000
						});
						return false;
					}
				}
			})
		}
	});

});

