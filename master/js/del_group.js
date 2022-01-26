$(document).ready(function(){
	$('#del-group-btn').click(function(){
	    
	    var checkValues = $('.checkbox:checked').map(
		function(){
	            return $(this).val();
	    }).get();
	        
	    $.each( checkValues, function( i, val ){
	    	$.ajax({
        	    type: "POST",
            	    url: "del-group.php",
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
});	
