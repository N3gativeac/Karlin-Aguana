( function($) {

	'use strict';

	jQuery(window).on('elementor/frontend/init', function() {

		/* Shortcode Element */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/shortcode.default', function() {
			wcpscwc_product_slider_init();
		});

		/* Text Editor Element */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/text-editor.default', function() {
			wcpscwc_product_slider_init();
		});

		/* Tabs Element */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/tabs.default', function($scope) {

			/* Tweak for slick slider */
			$scope.find('.wcpscwc-product-slider').each(function( index ) {

				var slider_id	= $(this).attr('id');
				var slider_conf = $.parseJSON( $(this).closest('.wcpscwc-product-slider-wrap').find('.wcpscwc-slider-conf').attr('data-conf'));
				var slider_cls	= slider_conf.slider_cls ? slider_conf.slider_cls : 'products';

				$('#'+slider_id+' .'+slider_cls).css({'visibility': 'hidden', 'opacity': 0});

				wcpscwc_product_slider_init();

				setTimeout(function() {

					/* Tweak for slick slider */
					if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
						$('#'+slider_id+' .'+slider_cls).slick( 'setPosition' );
						$('#'+slider_id+' .'+slider_cls).css({'visibility': 'visible', 'opacity': 1});
					}
				}, 550);
			});
		});

		/* Accordion Element */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/accordion.default', function($scope) {

			/* Tweak for slick slider */
			$scope.find('.wcpscwc-product-slider').each(function( index ) {

				var slider_id	= $(this).attr('id');
				var slider_conf = $.parseJSON( $(this).closest('.wcpscwc-product-slider-wrap').find('.wcpscwc-slider-conf').attr('data-conf'));
				var slider_cls	= slider_conf.slider_cls ? slider_conf.slider_cls : 'products';
				$('#'+slider_id+' .'+slider_cls).css({'visibility': 'hidden', 'opacity': 0});

				wcpscwc_product_slider_init();

				setTimeout(function() {

					/* Tweak for slick slider */
					if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
						$('#'+slider_id+' .'+slider_cls).slick( 'setPosition' );
						$('#'+slider_id+' .'+slider_cls).css({'visibility': 'visible', 'opacity': 1});
					}
				}, 300);
			});
		});

		/* Toggle Element */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/toggle.default', function($scope) {

			/* Tweak for slick slider */
			$scope.find('.wcpscwc-product-slider').each(function( index ) {

				var slider_id = $(this).attr('id');
				var slider_conf = $.parseJSON( $(this).closest('.wcpscwc-product-slider-wrap').find('.wcpscwc-slider-conf').attr('data-conf'));
				var slider_cls	= slider_conf.slider_cls ? slider_conf.slider_cls : 'products';
				$('#'+slider_id+' .'+slider_cls).css({'visibility': 'hidden', 'opacity': 0});

				wcpscwc_product_slider_init();

				setTimeout(function() {

					/* Tweak for slick slider */
					if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
						$('#'+slider_id+' .'+slider_cls).slick( 'setPosition' );
						$('#'+slider_id+' .'+slider_cls).css({'visibility': 'visible', 'opacity': 1});
					}
				}, 300);
			});
		});
	});
})(jQuery);