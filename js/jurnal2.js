jQuery(function(){
	
	var items;
	var blob = null;
	var blob2 = [];
	var im=0;
	 

        document.getElementById('pasteArea2').onpaste = function (event) {
 	 	// use event.originalEvent.clipboard for newer chrome versions
 	 	items = (event.clipboardData  || event.originalEvent.clipboardData).items;
 	 
 	 //alert(JSON.stringify(items)); // will give you the mime types
 	 // find pasted image among pasted items
 	 for (var i = 0; i < items.length; i++) {
	   
	   //alert(items[i].type.indexOf("image")+" "+im);

 	   if (items[i].type.indexOf("image") >= 0) {
		im=1*im+1;
 	        blob = items[i].getAsFile();
 	        blob2.push(blob);
		//alert("blob"+blob['src']);
 	 	 // load image if there is a pasted image
 	 	if (blob !== null) {
 		   var reader = new FileReader();
 		   	reader.onload = function(event) {
 		    	//alert(event.target.result); // data url!
 		     		document.getElementById("pastedImage2-"+im).src = event.target.result;
 		   	};
 		  	 reader.readAsDataURL(blob);
 		}
	  }	
        }
 }


	///////////////////////////////////////////////////////////////////////////////////////////////////////
    $(".save-task-btn").each(function(){
	var eid;

	$(this).click(function(e){
		e.preventDefault(); // выключaем стaндaртную рoль элементa
		eid = $(this).attr("id");
		var pr = $("#proc").val();
		var doza = $("#doza").val();
		var ph = $("#ph").val();
                var id_user = $("#id_user2").val();
		var doppre = $("#dop").val();
                var dop = encodeURIComponent(doppre);
                var regdt = $("#regdt").val();

          if(eid>0){
	
		 $.ajax({
        		type: "POST",
            		url: "save-task.php",
            		data:{
				task_id:eid,
				regdt:regdt,
				user_id:id_user,
				//emp_id:id_emp,
				proc:pr,
				doza:doza,
				ph:ph,
				dop:dop
				
			},
			success: function(response){  
			    $("#page-preloader").css({"display":"none"});
                	    //alert("СОХРАНЕНО УСПЕШНО!");
				if(blob2.length == 0){
			    		document.location.href = "/jurnal/jurnal.php";
				}
            		}
            	    }).done(function(){
            	    
            	    
        	for (var i = 0; i < blob2.length; i++) {
 	  		var upfile = blob2[i];
			var formData = new FormData();
			 
			formData.append('files', upfile);
                                  
			formData.append('task_id', eid);

			var id_user = $("#id_user2").val();
			var id_ph = $("#id_ph").val();
			var regdt = $("#regdt").val();

			var ind = i+Number(ph);

			formData.append('user_id', id_user);
			formData.append('img_id', ind);
			formData.append('regdt', regdt);

            		$.ajax({
        			    type: "POST",
            			    url: "save-task-n.php",
				    data: formData,
				    contentType: false,
	    			    processData: false,
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
            				 document.location.href = "/jurnal/jurnal.php";
					//
            			    }
            		
            			}).done( function(){ 
						 
				//	$("#page-preloader").css({"display":"block"});
            				 document.location.href = "/jurnal/jurnal.php";
            	    			/* Зaкрытие мoдaльнoгo oкнa, тут делaем тo же сaмoе нo в oбрaтнoм пoрядке */
				});
			
		    }
				
			});
			//
		}	//}else{
			//    return false;
			//}
    	    }); 
	 
	});  
/////////////////////////////////////////////////////////////////////////////////////////////////
    $('.del_ph').each(function(){
	var eid;

	$(this).click(function(e){
	    e.preventDefault(); // выключaем стaндaртную рoль элементa
	    eid = $(this).attr("id");

    		$.ajax({
        	    type: "POST",
            	    url: "del-ph.php",
            	    data: 'did=' + eid,
        	    beforeSend:function(){
            	    $("#page-preloader").css({"display":"block"});
            	    },
            	    success: function(response){  
			alert("Удаление выполнено");
			$("#page-preloader").css({"display":"none"});	
            	    }  
    		}).done(function(){
	    		$("#img"+eid).css({"display":"none"});
	    		 document.location.href = "/jurnal/jurnal.php";
    		});
    	    });
    });	
/////////////////////////////////////////////////////////////////////////////////////////////////
});	
