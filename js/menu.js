// JavaScript Document
$(document).ready(function() {
    $(".menu-mini").click(		
		function(){		
		$(".nav").slideToggle(300);
		return false;
	});
	$(".menu-mobile a").click(	
		function(){
		$(".menu-mobile").slideUp(100);
		
	});
});