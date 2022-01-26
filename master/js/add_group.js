$(document).ready(function(){
		
	    $("input#add-group-btn").click(function(e){
	    
		var n_id = $("#n_id").val();
		var n_name = $("#n_name").val();
		var n_lvl = $("#n_level").val();
		var ch_name = /^[a-zA-Zа-яА-Я0-9\,\.\_\-\s]+$/;
		//var ch_pass = /^[a-zA-Z0-9\-\_]+$/;
		//var ch_login = /^[0-9]+$/;
		//var ch_login = /^[a-zA-Z0-9\-\_]+$/;
		var str = "<tr id='td-"+n_id+"'><td>"+n_id+"</td><td>"+n_name+"</td><td><img width=20 id="+n_id+" class=edit-click src='/images/edit.png'><span id='tdd-"+n_id+"'></span></td><td><input type=checkbox id=did class=checkbox value='"+n_id+"'></td></tr>";
		var error_1;
		var error_2;
		var error_3;
		
		// Запрещаем стандартное поведение для кнопки submit
		    e.preventDefault();
	    	
			if( n_name.length > 3 && ch_name.test(n_name)){
	        	    error_2 = 1;
	    		    $("#n_name").css({"border":"2px solid green"});
		    	}else{
	        	    error_2 = 2;
	        	    $("#n_name").css({"border":"2px solid #cc0000"});
	        	    $("#n_name").addClass('input_error');
	        	    $("#n_name").attr({"placeholder":"Введите наименование"});
			}
			

		    if( error_2 == 1){
			    $.ajax({
        			type: "POST",
            			url: "add-group.php",
            			data:"n_name="+n_name+"&n_level="+n_lvl,
				success: function(response){
            				alert('Успешно добавлен!');
            				$("#page-preloader").css({"display":"block"});
					$("#ListGroups").append(str);
					document.location.href = "/master/list_groups.php";
					$("#page-preloader").css({"display":"none"});
            			}
            		}).done( function(){  
            		    $('#add_modal_form').animate({opacity: 0, top: '45%'}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
	    			function(){ // пoсле aнимaции
	    			    $(this).css('display', 'none'); // делaем ему display: none;
	    			    $('#add_modal_overlay').fadeOut(400); // скрывaем пoдлoжку
	    			});
	    		});
		    }else{
			return false;
		    }
    	    });  
});	
