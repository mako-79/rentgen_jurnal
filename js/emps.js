$(document).ready(function(){
    
    var ac_config2 = {
        source:'emps.php',
        select: function(event, ui) { 
	    $('#id_emp').val(ui.item.value); 
        	event.preventDefault(); 
    	    $("#s_emp").val(ui.item.label); 
    	},    
        minLength:2
    };
    
    $("#s_emp").autocomplete(ac_config2);
    
});
