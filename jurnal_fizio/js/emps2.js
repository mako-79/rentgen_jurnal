$(document).ready(function(){
    ////////////////////////////////////////
    var ac_config3 = {
        source:'/jurnal_fizio/emps2.php',
        select: function(event, ui) { 
	    $('#id_emp2').val(ui.item.value); 
        	event.preventDefault(); 
    	    $("#s_emp2").val(ui.item.label); 
    	},    
        minLength:2
    };
    
    $("#s_emp2").autocomplete(ac_config3);


    
});
