$(document).ready(function(){
		
	    $("input#add-user-btn").click(function(e){
	    
		var n_id = $("#n_id").val();
		var n_login = $("#n_login").val();
		var n_pass = $("#n_pass").val();
		var n_repass = $("#n_repass").val();
		var n_fio = $("#n_fio").val();
		var n_grid = $("#n_group_id").val();
		var n_bdt = $("#n_bdt").val();	
		var n_dop = $("#n_dop").val();
		var n_phone = $("#n_phone").val();		
		var ch_fio = /^[a-zA-Zа-яА-Я0-9\.\_\-\s]+$/;
		var ch_pass = /^[a-zA-Z0-9\-\_\!\]\,\.\:\'\"]+$/;
		//var ch_login = /^[0-9]+$/;
		var ch_login = /^[a-zA-Z0-9\-\_]+$/;
		//var suser = $("#suser").val();
		//suser = "suser="+suser;
		//var sgroup = $("#sgroup").val();
		//sgroup = "sgroup="+n_grid;
		//var slogin = $("#slogin").val();
		//slogin = "&slogin="+slogin;
		
		var error_1;
		var error_2;
		var error_3;
		
		// Запрещаем стандартное поведение для кнопки submit
		    e.preventDefault();
	    	
	    		if( $("#n_login").val().length > 3 && ch_login.test(n_login) ){
	    		    error_1 = 1;
	    		    $("#n_login").css({"border":"2px solid green"});
	    	        }else{
				error_1 = 2;
	    			$("#n_login").css({"border":"2px solid #cc0000"});
				$("#n_login").addClass('input_error');
				$("#n_login").attr({"placeholder":"Введите ваш логин"});
				$("#err_1").hide();
			}
		    	
			if( n_fio.length > 3 && ch_fio.test(n_fio)){
	        	    error_2 = 1;
	    		    $("#n_fio").css({"border":"2px solid green"});
		    	}else{
	        	    error_2 = 2;
	        	    $("#n_fio").css({"border":"2px solid #cc0000"});
	        	    $("#n_fio").addClass('input_error');
	        	    $("#n_fio").attr({"placeholder":"Введите Ф.И.О."});
			}
			
			if( $("#n_pass").val().length > 3 && ch_pass.test(n_pass) && $("#n_pass").val() == $("#n_repass").val()){
	        	    error_3 = 1;
	        	    $("#n_pass").css({"border":"2px solid green"});
		    	}else if( $("#n_pass").val().length > 0 ){

	        		if( $("#n_pass").val().length < 3){
	        		    error_3 = 2;
	        		    $("#n_pass").css({"border":"2px solid #cc0000"});
	        		    var ertxt2 = "<br><span style='font-size:8px;color:red;'>Длина пароля меньше 3х символов</span>";
				    $("#err_2").html(ertxt2);
	        		}else if(n_pass != n_repass){
	        		    error_3 = 2;
	        		    $("#n_pass").css({"border":"2px solid #cc0000"});
	        		    var ertxt2 = "<br><span style='font-size:8px;color:red;'>Пароли не совпадают</span>";
				    $("#err_3").html(ertxt2);
	        		}else if(!ch_pass.test(n_pass)){
	        		    error_3 = 2;
	        		    $("#n_pass").css({"border":"2px solid #cc0000"});
	        		    var ertxt2 = "<br><span style='font-size:8px;color:red;'>Допустимы только цифры, лат. буквы,символы -_</span>";
				    $("#err_2").html(ertxt2);
				}
				
	        	}else{
	        		    error_3 = 2;
	        		    $("#n_pass").css({"border":"2px solid #cc0000"});
	        		    $("#n_pass").addClass('input_error');
	        		    $("#n_pass").attr({"placeholder":"Введите пароль"});
	        		    $("#err_2").html();
			}

		    if( error_1 == 1 && error_3 == 1){
			    $.ajax({
        			type: "POST",  
            			url: "add-user.php",
            			data:"n_login="+n_login+"&n_group_id="+n_grid+"&n_pass="+n_pass+"&n_fio="+n_fio+"&n_phone="+n_phone+"&n_bdt="+n_bdt+"&n_dop="+n_dop,
            			success: function(response){
            				alert("Успешно добавлен!");
					document.location.href = "/master/list_users.php?";
				}
            			
            		//}).done( function(){  
            		  //  $('#add_modal_form').animate({opacity: 0, top: '45%'}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
	    		//	function(){ // пoсле aнимaции
	    		//	    $(this).css('display', 'none'); // делaем ему display: none;
	    		//	    $('#add_modal_overlay').fadeOut(400); // скрывaем пoдлoжку
	    		//	});    
	    		});
		    }else{
			return false;
		    }
    	    });  
});	
