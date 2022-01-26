$(document).ready(function(){
		
	    $("#add-pat").click(function(e){
	    
		var n_id = $("#n_id").val();
		var n_fname = $("#n_fname").val();
		var n_name = $("#n_name").val();
		var n_bdt = $("#n_bdt").val();	
		var n_phone = $("#n_phone").val();		
		var ch_fname = /^[a-zA-Zа-яА-Я\s]+$/;
		var ch_name = /^[a-zA-Zа-яА-Я\s]+$/;
		//var ch_fname = /^[a-zA-Zа-яА-Я\s]+$/;
		var error_1;
		var error_2;
		var error_3;
		
		// Запрещаем стандартное поведение для кнопки submit
		    e.preventDefault();
	    	    	
			if( n_fname.length > 3 && ch_fname.test(n_fname)){
	        	    error_1 = 1;
	    		    $("#n_fname").css({"border":"2px solid green"});
		    	}else{
	        	    error_1 = 2;
	        	    $("#n_fname").css({"border":"2px solid #cc0000"});
	        	    $("#n_fname").addClass('input_error');
	        	    $("#n_fname").attr({"placeholder":"Введите Фамилию"});
			}
			
			if( n_name.length > 3 && ch_name.test(n_name)){
	        	    error_1 = 1;
	    		    $("#n_name").css({"border":"2px solid green"});
		    	}else{
	        	    error_1 = 2;
	        	    $("#n_name").css({"border":"2px solid #cc0000"});
	        	    $("#n_name").addClass('input_error');
	        	    $("#n_name").attr({"placeholder":"Введите Имя"});
			}
			
			if( n_bdt != ''){
	        	    error_1 = 1;
	    		    $("#n_bdt").css({"border":"2px solid green"});
		    	}else{
	        	    error_1 = 2;
	        	    $("#n_bdt").css({"border":"2px solid #cc0000"});
	        	    $("#n_bdt").addClass('input_error');
	        	    $("#n_bdt").attr({"placeholder":"Введите дату рождения"});
			}
			
		    if( error_1 == 1 && error_3 == 1){
			    $.ajax({
        			type: "POST",  
            			url: "add-pat.php",
            			//data:"n_login="+n_login+"&n_pass="+n_pass+"&n_fio="+n_fio+"&n_email="+n_email+"&n_gid="+n_gid,
            			data:"n_fname="+n_fname+"&n_name="+n_name+"&n_phone="+n_phone+"&n_bdt="+n_bdt,
            			success: function(response){
            				alert("Успешно добавлен!");
					//document.location.href = "/jurnal/jurnal.php?";
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
