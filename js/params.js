$(function(){
	$("#allchecked").click(function() {
               var checked_status = this.checked;
               $("input[name=did]").each(function() {
                     this.checked = checked_status;
               });
        });

});	
