/**
 * JustTables admin events.
 *
 * Handle all admin events and interactions of the plugin.
 *
 * @since 1.0.0
 */

;( function ( $ ) {
    'use strict';

    $( document ).ready( function () {

        /**
         * Handle change on columns group.
         *
         * @since 1.0.0
         */
        $( document.body ).on( 'change', '.jt-product-table-columns', function () {
            var thisColumnsGroup = $( this ),
                columns = thisColumnsGroup.find( '.csf-cloneable-item' );

            // Loop through columns.
            $.each( columns, function () {
                var thisColumn = $( this ),
                    columnId = thisColumn.find( '.csf-field.column-id input[data-depend-id="column-id"]' ).val(),
                    defaultHeading = thisColumn.find( '.default-heading input[data-depend-id="default-heading"]' ),
                    fixedHeading = thisColumn.find( '.fixed-heading input[data-depend-id="fixed-heading"]' ),
                    deletable = thisColumn.find( '.deletable input[data-depend-id="deletable"]' ),
                    deletableValue = deletable.val(),
                    activeSwitcher = thisColumn.find( '.active .csf--switcher' ),
                    headingInput = thisColumn.find( '.heading input[data-depend-id="heading"]' ),
                    customTypeField = thisColumn.find( '.csf-field.custom-type' ),
                    customkeywordField = thisColumn.find( '.csf-field.custom-keyword' ),
                    titleColumnAddElements = thisColumn.find( '.csf-field.title-add-elements' ),
                    actionColumnAddElements = thisColumn.find( '.csf-field.action-add-elements' ),
                    headingText = thisColumn.find( '.csf-cloneable-title .csf-cloneable-text' ),
                    headingTextValue = headingText.find( '.csf-cloneable-value' ),
                    headingRemoveButton = thisColumn.find( '.csf-cloneable-helper .csf-cloneable-remove' ),
                    headingCloneButton = thisColumn.find( '.csf-cloneable-helper .csf-cloneable-clone' );

                if ( activeSwitcher.hasClass( 'csf--active' ) ) {
                    thisColumn.addClass( 'column-active' );
                } else {
                    thisColumn.removeClass( 'column-active' );
                }

                headingInput.on( 'change keyup', function () {
                    var fixedHeadingValue = fixedHeading.val(),
                        headingInputValue = headingInput.val();

                    if ( '' !== headingInputValue ) {
                        headingTextValue.text( headingInputValue );
                        defaultHeading.val( headingInputValue );
                    } else {
                        headingTextValue.text( fixedHeadingValue );
                        defaultHeading.val( fixedHeadingValue );
                    }
                } );

                if ( 'title' !== columnId ) {
                    titleColumnAddElements.remove();
                }

                if ( 'action' !== columnId ) {
                    actionColumnAddElements.remove();
                }

                if ( 'false' === deletableValue ) {
                    headingRemoveButton.remove();
                    customTypeField.remove();
                    customkeywordField.remove();
                }

                headingCloneButton.remove();

                // Pro field detect.
                if ( 'check' === columnId ) {
                    thisColumn.addClass( 'pro-column' );
                }
            } );
        } );
        // Trigger columns group change.
        $( '.jt-product-table-columns' ).trigger( 'change' );

        /**
         * Handle collapse on designs group.
         *
         * @since 1.0.0
         */
        $( document.body ).on( 'click', '.jt-product-table-design .csf-accordion-title', function () {
            var thisTitle = $( this ),
                content = thisTitle.next( '.csf-accordion-content' ),
                accordionItem = thisTitle.closest( '.csf-accordion-item' ),
                accordionItemSiblings = accordionItem.siblings(),
                siblingsIcon = accordionItemSiblings.find( '.csf-accordion-icon' ),
                siblingsContent = accordionItemSiblings.find( '.csf-accordion-content' );

            if ( content.hasClass( 'csf-accordion-open' ) ) {
                siblingsIcon.addClass( 'fa-angle-right' );
                siblingsIcon.removeClass( 'fa-angle-down' );
                siblingsContent.removeClass( 'csf-accordion-open' );
            }
        } );

        /**
         * Handle border radius fields minor changes.
         *
         * @since 1.0.0
         */
        $( '.jt-product-table-border-radius .csf-input-number' ).each( function () {
            var thisInputField = $( this ),
                placeholder = thisInputField.attr( 'placeholder' );

            if ( 'top' === placeholder ) {
                thisInputField.attr( 'placeholder', 'top left' );
            } else if ( 'right' === placeholder ) {
                thisInputField.attr( 'placeholder', 'top right' );
            } else if ( 'bottom' === placeholder ) {
                thisInputField.attr( 'placeholder', 'bottom right' );
            } else if ( 'left' === placeholder ) {
                thisInputField.attr( 'placeholder', 'bottom left' );
            }
        } );

        /**
         * Handle pro field on click behaviour.
         *
         * @since 1.0.0
         */
        $( '.csf-field.pro-field,.csf-field.custom-width,.csf-field.title-add-elements,.csf-field.action-add-elements,.pro-column .csf-cloneable-content' ).click( function () {
            $( '#jtpt-pro-notice-dialog' ).dialog( {
                modal: true,
                minWidth: 500,
                buttons: {
                    Ok: function () {
                      $( this ).dialog( 'close' );
                    }
                }
            });
        });

    } );

} )( jQuery );