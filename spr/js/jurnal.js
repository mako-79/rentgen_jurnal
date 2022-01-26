$(document).ready(function(){
	    ////////////////  Дом.задания добавляем задание		
	    $("input#add-task-btn").click(function(e){
		var n_id = $("#n_id").val();
		
		var n_name = $("#n_name").val();
		var n_cat_id = $("#n_cat_id").val();
		var n_uet=0;
		if(n_cat_id==2 || n_cat_id==3 || n_cat_id==325){
			n_uet = $("#n_uet").val();
		}
		var n_doppre = $("#n_dop").val();
		
		var n_dop = encodeURIComponent(n_doppre);
	
		var error_1;
		var error_2;
		var error_3;
		
		// Запрещаем стандартное поведение для кнопки submit
		    e.preventDefault();
	    	    if( n_name != ''){
	        	    error_2 = 1;
	    		    $(".n_name").css({"border":"2px solid green"});
		    }else{
	        	    error_2 = 2;
	        	    $(".n_name").css({"border":"2px solid #cc0000"});
	        	    $(".n_name").addClass('input_error');
	        	    $(".n_name").attr({"placeholder":"Введите название"});
		    }
	
		/////////////////////////////////////////////////////////////////////////////
		    if( error_2 == 1){
			
			    $.ajax({
        			type: "POST",
            			url: "/spr/add-task.php",
				dataType: 'html',
            			data:{
					n_dop:n_dop,
					n_name:n_name,
					n_cat_id:n_cat_id,
					n_uet:n_uet
				},	
            			success: function(response){
            				alert('Успешно!');
            				document.location.href = "/spr/jurnal.php?cat_id="+n_cat_id;
            			}
		    	    }).done( function(){  
            			//document.location.href = "/spr/jurnal.php";
            			    $('#add_modal_form').animate({opacity: 0, top: '45%'}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
	    				function(){ // пoсле aнимaции
	    				    $(this).css('display', 'none'); // делaем ему display: none;
	    				    $('#add_modal_overlay').fadeOut(400); // скрывaем пoдлoжку
	    			    });
	    			    $("#page-preloader").css({"display":"none"});
	    		    });
		    }else{
			return false;
		    }
    	    });  
///////////////////////////////////////////////////////////////////////
	$('#del-task-btn').click(function(){
	    
	    var checkValues = $('.checkbox:checked').map(
		function(){
	            return $(this).val();
	    }).get();
	    	
		    
	    $.each( checkValues, function( i, val ){
	    	$.ajax({
        	    type: "POST",
            	    url: "del-task.php",
            	    data: 'did=' + val,
        	    beforeSend:function(){
            	    $("#page-preloader").css({"display":"block"});
            	    },
            	    success: function(response){  
			alert("Удаление выполнено");
			$("#page-preloader").css({"display":"none"});	
            	    }  
    		}).done(function(){
	    		$("#td-"+val).css({"display":"none"});
    		});
    	    });
    });
  //////////////////////////////////////////////////////////////////////////////////////////////////
		$('#give-hometask-btn').click(function(){
	    
	    var checkValues = $('.checkbox:checked').map(
		function(){
	            return $(this).val();
	    }).get();
            	
		var stask = $("#stask").val();
		var stema = $("#stema").val();
		var sgroup = $("#sgroup").val();

	    $.each( checkValues, function( i, e ){

	        var ugrid = $("#group_id"+e).val();
		var uid = $("#tuser_id"+e).val();
		var enbl = $("#enbl"+e).val();
		var single = $("#singl"+e).val();
		var str;

		if(single==1){
			str = "user_id="+uid+"&did=" + e;
		}else{
                        str = "group_id="+ugrid+"&did=" + e;
		}
                //if(enbl < 2){
		   $.ajax({
        	    	type: "POST",
            	    	url: "give-home-task.php",
            	    	data: ""+str,
        	    	beforeSend:function(){
            	    		$("#page-preloader").css({"display":"block"});
            	    	},
            	    	success: function(response){  
				//alert("Выполнено!");
				//document.location.href = "/online-training/tasks/list_tasks.php";
            	    	}  
    		}).done(function(){
			$("#page-preloader").css({"display":"none"});	
    			$("#td-"+e).addClass("given");
			//for(i in this.form.elements) this.form.elements[i].checked = ''";
			$("#td-"+e+" input:checkbox").removeAttr("checked");
		});
		//}else{
		//	alert('Уже выдано!'+enbl+"."+ugrid);
		//}
    	    });
		alert("Выполнено!");
    });
//////////////////////////////////////////////////////////////////////////////////////////////////////
    $(".copy-task-btn").each(function(){
	var eid;

	$(this).click(function(e){
		e.preventDefault(); // выключaем стaндaртную рoль элементa
                for ( instance in CKEDITOR.instances ) {
		        CKEDITOR.instances[instance].updateElement();
		}
		eid = $(this).attr("id");
	
		var doppre = $("#dop"+eid).val();
                var dop = encodeURIComponent(doppre);
		var sel_users = new Array();
        	$("input[name='sel_users"+eid+"[]']:checked" ).each( function() {
                	sel_users.push( $( this ).val() );
        	} );

		$.ajax({
        		type: "POST",
            		url: "save-dublhome.php",
            		data:{
				dop:dop,
				single:single,
				user_id:sel_users	
			},
			success: function(response){  
                	    alert("СДУБЛИРОВАНО УСПЕШНО!"+response);
				document.location.href = "/spr/jurnal.php";
            		}
            	    }).done(function(){
            	    /* Зaкрытие мoдaльнoгo oкнa, тут делaем тo же сaмoе нo в oбрaтнoм пoрядке */
			$("#e_modal_close,#e_modal_reject, #e_modal_overlay"+eid).click( function(){ // лoвим клик пo крестику или пoдлoжке
			    $("#e_modal_form"+eid).animate({opacity: 0, top: '45%'}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
				function(){ // пoсле aнимaции
				    $(this).css('display', 'none'); // делaем ему display: none;
				    $('#e_modal_overlay'+eid).fadeOut(400); // скрывaем пoдлoжку
				    }
				);
			    });
		    });
		   });  
	});  
	///////////////////////////////////////////////////////////////////////////////////////////////////////
	    $(".save-task-btn").each(function(){
	var eid;

	$(this).click(function(e){
		e.preventDefault(); // выключaем стaндaртную рoль элементa
		eid = $(this).attr("id");
		var nname = $("#nname").val();
		var cat_id = $("#cat_id").val();
                var uet=0;
		if(cat_id==2 || cat_id==3 || cat_id==325){
			uet = $("#uet").val();
		}
		var doppre = $("#dop").val();
                var dop = encodeURIComponent(doppre);

	    $.ajax({
        		type: "POST",
            		url: "/spr/save-task.php",
            		data:{
				task_id:eid,
				name:nname,
				dop:dop,
				uet:uet,
				cat_id:cat_id
			},
			success: function(response){  
                	    alert("СОХРАНЕНО УСПЕШНО!");
				document.location.href = "/spr/jurnal.php?cat_id="+cat_id;
            		}
            	    //}).done(function(){
		    });
			//}else{
			//    return false;
			//}
    	    });  
	});  
/////////////////////////////////////////////////////////////////////////////////////////////////
});	
