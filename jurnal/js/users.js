$(document).ready(function(){
    var ac_config = {
        source:'users.php',
        select: function(event, ui) { 
	    $('#id_user').val(ui.item.value); 
        	event.preventDefault(); 
    	    $("#s_user").val(ui.item.label); 
    	},    
        minLength:2
    };
    $("#s_user").autocomplete(ac_config);
    
    
});
