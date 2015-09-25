

var func = function () {


			var result = "";
			$.ajax({
			type: 'POST',
			url: 'inc/getJson.php',
			success: function (data) {
                            if(data == "" || data == false) {
                                alert("error");
                                return false;
                            }
                           
						$.each($.parseJSON(data), function (key, value) {
                                                    result += '<div class="comments" id="' +value.id + '"><div class="comment dialog"><i class="fa fa-user">&nbsp;' + value.login + '</i><p>' + value.text + '</p><small><i class="fa fa-calendar-o"></i>&nbsp;' + value.time + '</small></div></div>';
			  
								
						});
                        $('#wrapper-mess').empty().append(result);
		}
	});


};

$(document).ready(function () {
    func();
		setInterval(func, 2000);
	$('#button-send').click(function () {
		var text = $('.text-area').val();
			if(text === "") {
				alert("Fill up the text-area");
				return false;
		}      

		$.ajax({
		        type: "POST",
		        data: {message : text },
		        url: "inc/insertData.php",
		        success: function (data) {
		                                
		                                if(data === 0) 
		                                    {
		                                      $('.alert-danger').fadeIn('slow').fadeOut('slow');
		                                      return false;
                            }
		                                    else {
                                                        
                                                $('.text-area').val(''); 
		                                        $('.alert-success').fadeIn('slow').fadeOut('slow');
		                                        func();
		                                    }

		                                }

		        });
		

	});	

//LOGGING

$('#sign-button').click(function (){

			
			var login = $('#inputEmail').val();
			var password = $('#inputPassword').val();
			if(login == "" || password == "") {
				$('.alert-error').html('Missing data: login & password').fadeIn(300);
				return false;
			} else {
				$.ajax({
					type: "POST",
					data: {login: login,
							password: password
						},
					url: "inc/login.php",
					success: function (data) {
								if(data == 0 || data === '') {
									$(".alert-error").html('Not Matched!').fadeIn(300).fadeOut(2000);
									return false;
								} else  {
									$(".alert-success").fadeIn('slow').fadeOut('slow');
									
									
									setTimeout('location.reload()', 5000);
									
								}

					}
				});
			}
	});

});


