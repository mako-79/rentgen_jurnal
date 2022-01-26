$(document).ready(function(){
	
	var items;
	var blob = null;

        document.getElementById('pasteArea').onpaste = function (event) {
 	 // use event.originalEvent.clipboard for newer chrome versions
 	 items = (event.clipboardData  || event.originalEvent.clipboardData).items;
 	 console.log(JSON.stringify(items)); // will give you the mime types
 	 // find pasted image among pasted items
 	 


	for (var i = 0; i < items.length; i++) {
 	   if (items[i].type.indexOf("image") === 0) {
 	     blob = items[i].getAsFile();
		//alert("blob"+blob);
 	   }
 	 }

 	 // load image if there is a pasted image
 	 if (blob !== null) {
 		   var reader = new FileReader();
 		   reader.onload = function(event) {
 		     console.log(event.target.result); // data url!
 		     document.getElementById("pastedImage").src = event.target.result;
 		   };
 		   reader.readAsDataURL(blob);
 		 }
	}	

	    ////////////////  Дом.задания добавляем задание		
	    $("input#add-task-btn").click(function(e){
		var n_pat;
                if($("#new_pat").prop("checked")){ n_pat=1;}else{ n_pat=2;}

	        var n_id = $("#n_id").val();

		var n_id_user;

		if(n_pat==1){
			n_id_user = $("#id_nuser").val();
		}else{
                        n_id_user = $("#id_user").val();
		}

		var n_id_emp = $("#id_emp").val();

		var n_pr = $("#n_proc").val();
		var n_doza = $("#n_doza").val();
		var n_doppre = $("#n_dop").val();
			
		var n_fname = $("#n_fname").val();
		var n_name = $("#n_name").val();
		var n_sname = $("#n_sname").val();
		var n_bdt = $("#n_bdt").val();	
		var n_phone = $("#n_phone").val();		
		
		var n_dop = encodeURIComponent(n_doppre);
		var n_dt = $("#n_dt").val();

			var ch_fname = /^[a-zA-Zа-яА-Я\s]+$/;
			var ch_name = /^[a-zA-Zа-яА-Я\s]+$/;

		var error_1;
		var error_2;
		var error_3;
		
		// Запрещаем стандартное поведение для кнопки submit
		    e.preventDefault();

		if(n_pat==1){
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
	        	    error_2 = 1;
	    		    $("#n_name").css({"border":"2px solid green"});
		    	}else{
	        	    error_2 = 2;
	        	    $("#n_name").css({"border":"2px solid #cc0000"});
	        	    $("#n_name").addClass('input_error');
	        	    $("#n_name").attr({"placeholder":"Введите Имя"});
			}
			
			if( n_bdt != ''){
	        	    error_3 = 1;
	    		    $("#n_bdt").css({"border":"2px solid green"});
		    	}else{
	        	    error_3 = 2;
	        	    $("#n_bdt").css({"border":"2px solid #cc0000"});
	        	    $("#n_bdt").addClass('input_error');
	        	    $("#n_bdt").attr({"placeholder":"Введите дату рождения"});
			}
		}else	
	    	    if( n_id_user > 0){
	        	    error_1 = 1;
	    		    $(".n_name").css({"border":"2px solid green"});
		    }else{
	        	    error_1 = 2;
	        	    $(".n_name").css({"border":"2px solid #cc0000"});
	        	    $(".n_name").addClass('input_error');
	        	    $(".n_name").attr({"placeholder":"Введите ФИО"});
		    }
	
		    if( n_id_emp > 0){
	        	    error_2 = 1;
	    		    $(".n_emp").css({"border":"2px solid green"});
		    }else{
	        	    error_2 = 2;
	        	    $(".n_emp").css({"border":"2px solid #cc0000"});
	        	    $(".n_emp").addClass('input_error');
	        	    $(".n_emp").attr({"placeholder":"Введите ФИО"});
		}			
		/////////////////////////////////////////////////////////////////////////////
		if( (n_pat==1 && error_1 == 1 && error_2 == 1 && error_3 == 1) || (n_pat!=1 && error_1 == 1 && error_2 == 1)){
			    $.ajax({
        			type: "POST",
            			url: "add-pat.php",
				dataType: 'html',
            			data:{
					n_fname:n_fname,n_name:n_name,n_sname:n_sname,n_bdt:n_bdt,n_phone:n_phone
				},
			success: function(response){
            				//alert('Успешно!'+response);
            				$("#page-preloader").css({"display":"none"});
            				//document.location.href = "/jurnal/jurnal.php";
            		}

		     }).done( function(){  

			    $.ajax({
        			type: "POST",
            			url: "add-task.php",
				dataType: 'html',
            			data:{
					n_dop:n_dop,
					n_dt:n_dt,
					n_user_id:n_id_user,
					n_emp_id:n_id_emp,
					n_pr:n_pr,
					n_doza:n_doza
					//cnt_ph:cnt_ph
				},	
            			success: function(response){
            				//alert('Успешно!');
            				$("#page-preloader").css({"display":"none"});
            				//document.location.href = "/jurnal/jurnal.php";
            			}
		    	    }).done( function(){  

			            var file = blob;//items[i].getAsFile();
				    fdata = new FormData();
				    var n_dt = $("#n_dt").val();
				    
				    fdata.append('files', file);
                                  	    fdata.append('n_id', n_id);
                                    	    fdata.append('n_user_id', n_id_user);
					    fdata.append('n_dt', n_dt);
			         		$.ajax({
        						    type: "POST",
			            			    url: "add-task-n.php",
							    data: fdata,
							    contentType: false,
				    			    processData: false,
				    			    cache:false,
							    xhr: function(){
				    			        var xhr = $.ajaxSettings.xhr();
							            xhr.upload.addEventListener('progress', function(evt){
						    	    	    if(evt.lengthComputable) {
						    			var percentComplete = Math.ceil(evt.loaded / evt.total * 100);
						    			progressBar.val(percentComplete).text('Загружено ' + percentComplete + '%');
						    		    }
								    	}, false);
								    	return xhr;
							    },
			            			    success: function(response){
            							alert('Успешно!'+response);
			            				$("#page-preloader").css({"display":"block"});
							    }
            		
		            			}).done( function(){  
            						document.location.href = "/jurnal/jurnal.php";
			   		    	});
					//}
				   });
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
			//alert("Удаление выполнено");
			$("#page-preloader").css({"display":"none"});	
            	    }  
    		}).done(function(){
	    		$("#td-"+val).css({"display":"none"});
    		});
    	    });
    });
  //////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
});	
