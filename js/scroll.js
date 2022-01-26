$(document).ready(function(){
    document.onscroll = function (event) {
	var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
	//console.log(scrollTop);
	if(scrollTop > 70) {
	    $('#top_block_main').removeClass('main-navbar');
	    $('#top_block_main').addClass('main-navbar2');
            //el = document.getElementsByClassName('main-navbar')[0];
            //el.className = 'main-navbar2';
            //lel = document.getElementsByClassName('main-logo')[0];
            //lel.className = 'main-logo2';
        }else{
    	    $('#top_block_main').removeClass('main-navbar2');
    	    $('#top_block_main').addClass('main-navbar');
        }
    }
});
