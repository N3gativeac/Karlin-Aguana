function physiotherapy_lite_menu_open_nav() {
	window.physiotherapy_lite_responsiveMenu=true;
	jQuery(".sidenav").addClass('show');
}
function physiotherapy_lite_menu_close_nav() {
	window.physiotherapy_lite_responsiveMenu=false;
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
	window.physiotherapy_lite_currentfocus=null;
  	physiotherapy_lite_checkfocusdElement();
	var physiotherapy_lite_body = document.querySelector('body');
	physiotherapy_lite_body.addEventListener('keyup', physiotherapy_lite_check_tab_press);
	var physiotherapy_lite_gotoHome = false;
	var physiotherapy_lite_gotoClose = false;
	window.physiotherapy_lite_responsiveMenu=false;
 	function physiotherapy_lite_checkfocusdElement(){
	 	if(window.physiotherapy_lite_currentfocus=document.activeElement.className){
		 	window.physiotherapy_lite_currentfocus=document.activeElement.className;
	 	}
 	}
 	function physiotherapy_lite_check_tab_press(e) {
		"use strict";
		e = e || event;
		var activeElement;

		if(window.innerWidth < 999){
		if (e.keyCode == 9) {
			if(window.physiotherapy_lite_responsiveMenu){
			if (!e.shiftKey) {
				if(physiotherapy_lite_gotoHome) {
					jQuery( ".main-menu ul:first li:first a:first-child" ).focus();
				}
			}
			if (jQuery("a.closebtn.mobile-menu").is(":focus")) {
				physiotherapy_lite_gotoHome = true;
			} else {
				physiotherapy_lite_gotoHome = false;
			}

		}else{

			if(window.physiotherapy_lite_currentfocus=="responsivetoggle"){
				jQuery( "" ).focus();
			}}}
		}
		if (e.shiftKey && e.keyCode == 9) {
		if(window.innerWidth < 999){
			if(window.physiotherapy_lite_currentfocus=="header-search"){
				jQuery(".responsivetoggle").focus();
			}else{
				if(window.physiotherapy_lite_responsiveMenu){
				if(physiotherapy_lite_gotoClose){
					jQuery("a.closebtn.mobile-menu").focus();
				}
				if (jQuery( ".main-menu ul:first li:first a:first-child" ).is(":focus")) {
					physiotherapy_lite_gotoClose = true;
				} else {
					physiotherapy_lite_gotoClose = false;
				}
			
			}else{

			if(window.physiotherapy_lite_responsiveMenu){
			}}}}
		}
	 	physiotherapy_lite_checkfocusdElement();
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

jQuery(document).ready(function () {
	  function physiotherapy_lite_search_loop_focus(element) {
	  var physiotherapy_lite_focus = element.find('select, input, textarea, button, a[href]');
	  var physiotherapy_lite_firstFocus = physiotherapy_lite_focus[0];  
	  var physiotherapy_lite_lastFocus = physiotherapy_lite_focus[physiotherapy_lite_focus.length - 1];
	  var KEYCODE_TAB = 9;

	  element.on('keydown', function physiotherapy_lite_search_loop_focus(e) {
	    var isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);

	    if (!isTabPressed) { 
	      return; 
	    }

	    if ( e.shiftKey ) /* shift + tab */ {
	      if (document.activeElement === physiotherapy_lite_firstFocus) {
	        physiotherapy_lite_lastFocus.focus();
	          e.preventDefault();
	        }
	      } else /* tab */ {
	      if (document.activeElement === physiotherapy_lite_lastFocus) {
	        physiotherapy_lite_firstFocus.focus();
	          e.preventDefault();
	        }
	      }
	  });
	}
	jQuery('.search-box span a').click(function(){
        jQuery(".serach_outer").slideDown(1000);
    	physiotherapy_lite_search_loop_focus(jQuery('.serach_outer'));
    });

    jQuery('.closepop a').click(function(){
        jQuery(".serach_outer").slideUp(1000);
    });
});