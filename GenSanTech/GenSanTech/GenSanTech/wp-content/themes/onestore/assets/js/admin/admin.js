/**
 * Admin page javascript
 */
(function( $ ) {
	'use strict';

	var $window = $( window ),
	    $document = $( document ),
	    $body = $( 'body' );
	
	$(function() {

		/**
		 * Admin Fields
		 */

		// Upload control
		$body.on( 'click', '.onestore-admin-upload-control-button', function( e ) {
			e.preventDefault();

			var $button = $( this ),
			    $control = $button.closest( '.onestore-admin-upload-control' ),
			    $input = $control.find( 'input' ),
			    frame = $control.data( 'wpmedia' );

			// Check if media lirbrary frame is already declared.
			if ( frame ) {
				frame.open();
				return;
			}

			// Declare media library frame.
			var frameOptions = {
				title: $control.attr( 'data-title' ),
				button: {
					text: $control.attr( 'data-button' ),
				},
				multiple: false,
			};

			if ( '' !== $control.attr( 'data-library' ) ) {
				frameOptions.library = {
					type: $control.attr( 'data-library' ).split( ',' ),
				};
			}

			frame = wp.media.frames.file_frame = wp.media( frameOptions );

			// Handle Choose button
			frame.on( 'select', function() {
				var file = frame.state().get( 'selection' ).first().toJSON();
				$input.val( file.url );
			});

			frame.open();

			$control.data( 'wpmedia', frame );
		});

		if ( $.fn.select2 ) {
			$( '.onestore-admin-multiselect-control' ).select2();
		}

		// Color control
		if ( $.fn.wpColorPicker ) {
			$( '.onestore-admin-color-control' ).find( 'input' ).wpColorPicker();
		}

		// Dependency fields
		$body.on( 'change', '.onestore-admin-dependent-field', function() {
			var $select = $( this ),
			    $settings = $( '[data-dependency="' + $select.attr( 'name' ) + '"]' ),
			    value = this.value;

			$settings.hide();
			$settings.each(function() {
				var $setting = $( this ),
				    requirements = $setting.attr( 'data-value' ).split( ',' ),
				    found;

				found = -1 < requirements.indexOf( value ) ? true : false;

				switch ( $setting.attr( 'data-operator' ) ) {
					case '!=':
						if ( ! found ) $setting.show();
						break;

					default:
						if ( found ) $setting.show();
						break;
				}
			});
		});
		$( '.onestore-admin-dependent-field' ).trigger( 'change' );

		/**
		 * Metabox tabs
		 */

		$( '.onestore-admin-metabox' ).each(function() {
			var $metabox = $( this ),
			    $navigation = $metabox.find( '.onestore-admin-metabox-nav' ),
			    $panels = $metabox.find( '.onestore-admin-metabox-panels' );

			$navigation.on( 'click', '.onestore-admin-metabox-nav-item a', function( e ) {
				e.preventDefault();

				var $link = $( this ),
				    $target = $panels.children( $link.attr( 'href' ) );

				if ( $target && ! $target.hasClass( 'active' ) ) {
					$navigation.children( '.onestore-admin-metabox-nav-item.active' ).removeClass( 'active' );
					$link.parent( '.onestore-admin-metabox-nav-item' ).addClass( 'active' );

					$panels.children( '.onestore-admin-metabox-panel.active' ).removeClass( 'active' );
					$target.addClass( 'active' );
				}
			});

			$metabox.trigger( 'onestore-admin-metabox.ready', this );
		});

		/**
		 * Rating notice close button
		 */

		$( '.onestore-rating-notice' ).on( 'click', '.onestore-rating-notice-close', function( e ) {
			var $link = $( this ),
			    $notice = $link.closest( '.onestore-rating-notice' ),
			    repeat = $link.attr( 'data-onestore-rating-notice-repeat' );

			// Run AJAX to set data after closing the notice.
			$.ajax({
				method: 'POST',
				dataType: 'JSON',
				url: ajaxurl,
				data: {
					action: 'onestore_rating_notice_close',
					repeat_after: repeat,
				},
			});

			// Always remove the notice on current page.
			$notice.remove();
		});

		/**
		 * Install "OneStore Sites Import" plugin.
		 */

		$( '.onestore-admin-install-sites-import-plugin-button' ).on( 'click', function( e ) {
			var $button = $( this );

			$button.prop( 'disabled', 'disabled' );
			$button.addClass( 'disabled' );
			$button.html( OneStoreAdminData.strings.installing );

			return $.ajax({
				method: 'POST',
				dataType: 'JSON',
				url: ajaxurl + '?do=onestore_install_sites_import_plugin',
				cache: false,
				data: {
					action: 'onestore_install_sites_import_plugin',
					plugin_slug: 'onestore-sites-import',
					_ajax_nonce: OneStoreAdminData.ajax_nonce,
				},
			})
			.done(function( response, status, XHR ) {
				if ( response.success ) {
					$button.html( OneStoreAdminData.strings.redirecting_to_demo_list );

					window.location = OneStoreAdminData.sitesImportPageURL;
				} else {
					alert( OneStoreAdminData.strings.error_installing_plugin );
				}
			});
		});
	});
	
})( jQuery );