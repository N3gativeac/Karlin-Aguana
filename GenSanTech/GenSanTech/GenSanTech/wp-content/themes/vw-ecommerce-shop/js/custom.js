function vw_ecommerce_shop_menu_open_nav() {
	window.vw_ecommerce_shop_responsiveMenu=true;
	jQuery(".sidenav").addClass('show');
}
function vw_ecommerce_shop_menu_close_nav() {
	window.vw_ecommerce_shop_responsiveMenu=false;
 	jQuery(".sidenav").removeClass('show');
}

jQuery(function($){
 	"use strict";
   	jQuery('.main-menu > ul').superfish({
		delay:       500,
		animation:   {opacity:'show',height:'show'},  
		speed:       'fast'
   	});
});

jQuery(document).ready(function () {
	window.vw_ecommerce_shop_currentfocus=null;
  	vw_ecommerce_shop_checkfocusdElement();
	var vw_ecommerce_shop_body = document.querySelector('body');
	vw_ecommerce_shop_body.addEventListener('keyup', vw_ecommerce_shop_check_tab_press);
	var vw_ecommerce_shop_gotoHome = false;
	var vw_ecommerce_shop_gotoClose = false;
	window.vw_ecommerce_shop_responsiveMenu=false;
 	function vw_ecommerce_shop_checkfocusdElement(){
	 	if(window.vw_ecommerce_shop_currentfocus=document.activeElement.className){
		 	window.vw_ecommerce_shop_currentfocus=document.activeElement.className;
	 	}
 	}
 	function vw_ecommerce_shop_check_tab_press(e) {
		"use strict";
		// pick passed event or global event object if passed one is empty
		e = e || event;
		var activeElement;

		if(window.innerWidth < 999){
		if (e.keyCode == 9) {
			if(window.vw_ecommerce_shop_responsiveMenu){
			if (!e.shiftKey) {
				if(vw_ecommerce_shop_gotoHome) {
					jQuery( ".main-menu ul:first li:first a:first-child" ).focus();
				}
			}
			if (jQuery("a.closebtn.mobile-menu").is(":focus")) {
				vw_ecommerce_shop_gotoHome = true;
			} else {
				vw_ecommerce_shop_gotoHome = false;
			}

		}else{

			if(window.vw_ecommerce_shop_currentfocus=="responsivetoggle"){
				jQuery( "" ).focus();
			}}}
		}
		if (e.shiftKey && e.keyCode == 9) {
		if(window.innerWidth < 999){
			if(window.vw_ecommerce_shop_currentfocus=="header-search"){
				jQuery(".responsivetoggle").focus();
			}else{
				if(window.vw_ecommerce_shop_responsiveMenu){
				if(vw_ecommerce_shop_gotoClose){
					jQuery("a.closebtn.mobile-menu").focus();
				}
				if (jQuery( ".main-menu ul:first li:first a:first-child" ).is(":focus")) {
					vw_ecommerce_shop_gotoClose = true;
				} else {
					vw_ecommerce_shop_gotoClose = false;
				}
			
			}else{

			if(window.vw_ecommerce_shop_responsiveMenu){
			}}}}
		}
	 	vw_ecommerce_shop_checkfocusdElement();
	}
});

(function( $ ) {

	jQuery(window).load(function() {
	    jQuery("#status").fadeOut();
	    jQuery("#preloader").delay(1000).fadeOut("slow");
	})

	$(window).scroll(function(){
		var sticky = $('.header-sticky'),
		scroll = $(window).scrollTop();

		if (scroll >= 100) sticky.addClass('header-fixed');
		else sticky.removeClass('header-fixed');
	});

	$(document).ready(function () {
		$(window).scroll(function () {
		    if ($(this).scrollTop() > 100) {
		        $('.scrollup i').fadeIn();
		    } else {
		        $('.scrollup i').fadeOut();
		    }
		});

		$('.scrollup i').click(function () {
		    $("html, body").animate({
		        scrollTop: 0
		    }, 600);
		    return false;
		});
	});

})( jQuery );