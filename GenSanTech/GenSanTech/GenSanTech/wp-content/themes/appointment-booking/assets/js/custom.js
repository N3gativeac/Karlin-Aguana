function appointment_booking_menu_open_nav() {
	window.appointment_booking_responsiveMenu=true;
	jQuery(".sidenav").addClass('show');
}
function appointment_booking_menu_close_nav() {
	window.appointment_booking_responsiveMenu=false;
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
	window.appointment_booking_currentfocus=null;
  	appointment_booking_checkfocusdElement();
	var appointment_booking_body = document.querySelector('body');
	appointment_booking_body.addEventListener('keyup', appointment_booking_check_tab_press);
	var appointment_booking_gotoHome = false;
	var appointment_booking_gotoClose = false;
	window.appointment_booking_responsiveMenu=false;
 	function appointment_booking_checkfocusdElement(){
	 	if(window.appointment_booking_currentfocus=document.activeElement.className){
		 	window.appointment_booking_currentfocus=document.activeElement.className;
	 	}
 	}
 	function appointment_booking_check_tab_press(e) {
		"use strict";
		// pick passed event or global event object if passed one is empty
		e = e || event;
		var activeElement;

		if(window.innerWidth < 999){
		if (e.keyCode == 9) {
			if(window.appointment_booking_responsiveMenu){
			if (!e.shiftKey) {
				if(appointment_booking_gotoHome) {
					jQuery( ".main-menu ul:first li:first a:first-child" ).focus();
				}
			}
			if (jQuery("a.closebtn.mobile-menu").is(":focus")) {
				appointment_booking_gotoHome = true;
			} else {
				appointment_booking_gotoHome = false;
			}

		}else{

			if(window.appointment_booking_currentfocus=="responsivetoggle"){
				jQuery( "" ).focus();
			}}}
		}
		if (e.shiftKey && e.keyCode == 9) {
		if(window.innerWidth < 999){
			if(window.appointment_booking_currentfocus=="header-search"){
				jQuery(".responsivetoggle").focus();
			}else{
				if(window.appointment_booking_responsiveMenu){
				if(appointment_booking_gotoClose){
					jQuery("a.closebtn.mobile-menu").focus();
				}
				if (jQuery( ".main-menu ul:first li:first a:first-child" ).is(":focus")) {
					appointment_booking_gotoClose = true;
				} else {
					appointment_booking_gotoClose = false;
				}
			
			}else{

			if(window.appointment_booking_responsiveMenu){
			}}}}
		}
	 	appointment_booking_checkfocusdElement();
	}
});

jQuery('document').ready(function($){
	jQuery(window).load(function() {
	    jQuery("#status").fadeOut();
	    jQuery("#preloader").delay(1000).fadeOut("slow");
	})
});

jQuery(document).ready(function(){
	jQuery(".product-cat").hide();
    jQuery("button.product-btn").click(function(){
        jQuery(".product-cat").toggle();
    });
});

jQuery(document).ready(function () {
	jQuery(window).scroll(function () {
	    if (jQuery(this).scrollTop() > 100) {
	        jQuery('.scrollup i').fadeIn();
	    } else {
	        jQuery('.scrollup i').fadeOut();
	    }
	});
	jQuery('.scrollup').click(function () {
	    jQuery("html, body").animate({
	        scrollTop: 0
	    }, 600);
	    return false;
	});
});

jQuery(document).ready(function () {
	  function appointment_booking_search_loop_focus(element) {
	  var appointment_booking_focus = element.find('select, input, textarea, button, a[href]');
	  var appointment_booking_firstFocus = appointment_booking_focus[0];  
	  var appointment_booking_lastFocus = appointment_booking_focus[appointment_booking_focus.length - 1];
	  var KEYCODE_TAB = 9;

	  element.on('keydown', function appointment_booking_search_loop_focus(e) {
	    var isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);

	    if (!isTabPressed) { 
	      return; 
	    }

	    if ( e.shiftKey ) /* shift + tab */ {
	      if (document.activeElement === appointment_booking_firstFocus) {
	        appointment_booking_lastFocus.focus();
	          e.preventDefault();
	        }
	      } else /* tab */ {
	      if (document.activeElement === appointment_booking_lastFocus) {
	        appointment_booking_firstFocus.focus();
	          e.preventDefault();
	        }
	      }
	  });
	}
	jQuery('.search-box span a').click(function(){
        jQuery(".serach_outer").slideDown(1000);
    	appointment_booking_search_loop_focus(jQuery('.serach_outer'));
    });

    jQuery('.closepop a').click(function(){
        jQuery(".serach_outer").slideUp(1000);
    });
});