$(document).ready(function(){  
	$('.navbar-inner > ul > li').hover(function(){
		$(this).find('.sub-menu').stop(300).slideDown();
	},function(){
		$(this).find('.sub-menu').stop(300).slideUp();
	});
});

