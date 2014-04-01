	$('#registration').validate({
		rules : {
			reg_username : {
				required : true,
				minlength : 5
			},
			email : {
				required : true,
				email : true
			},
			reg_password : {
				required : true,
				minlength : 5
			},
			confirm_password : {
				required : true,
				minlength : 5,
				equalTo : "#reg_password"
			},
		},
		messages : {
			reg_password : {
				required : "Please provide a password",
				minlength : "Your password must be at least 5 characters long!"
			},
			confirm_password : {
				required : "Please provide a password",
				minlength : "Your password must be at least 5 characters long",
				equalTo : "Please enter the same password as above"
			}
		},
		tooltip_options: {
			reg_username : { 
				placement : 'top'
			},
			email : { 
				placement : 'top'
			},
			reg_password : { 
				placement : 'top'
			},
			confirm_password : { 
				placement : 'top'
			}
		}
	});
	
	$('#login').validate({
		rules : {
			username : {
				required : true
			},
			password : {
				required : true
			}
		},
		messages : {
			username : {
				required : "Please enter your username"
			},
			password : {
				required : "Please provide a password"
			}
		},
		tooltip_options : {
			username : { 
				placement: 'top'
			},
			password : { 
				placement: 'top'
			}
		}
	});
	
	$('#addapi').validate({
		rules : {
			keyID : {
				required : true,
				minlength : 5,
				digits : true
			},
			vCode : {
				required : true,
			}
		},
		messages : {
			keyID : {
				required : "Enter your Key ID",
				minlength : "Not a valid Key ID",
				digits : "Not a valid Key ID"
			},
			vCode : {
				required : "Enter your Verification Code"
			}
		},
		tooltip_options : {
			keyID : { 
				placement: 'top'
			},
			vCode : { 
				placement: 'top'
			}
		}
	});