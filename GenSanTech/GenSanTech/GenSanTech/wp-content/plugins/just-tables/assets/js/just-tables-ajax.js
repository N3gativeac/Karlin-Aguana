/**
 * JustTables frontend ajax events.
 *
 * Handle all frontend ajax events and interactions of the plugin.
 *
 * @since 1.0.0
 */

/* global jtpt_ajax_object, tb_show, tb_remove */
;( function ( $ ) {
    'use strict';

    $( document ).ready( function () {

        if ( 'undefined' === typeof jtpt_ajax_object ) {
            return false;
        }

        /**
         * Handle ajax woocommerce notices.
         *
         * @since 1.0.0
         *
         * @return {undefined}
         */
        function jtptWooCommerceNotices() {
            var noticeBoard = $( '.jtpt-notices' ),
                tableWrapper = noticeBoard.closest( '.jtpt-product-table-wrapper' );

            var data = {
                action: 'jtpt_ajax_woocommerce_notices',
            };

            $.ajax( {
                type: 'POST',
                url: jtpt_ajax_object.ajax_url,
                data: data,
                beforeSend: function(){
                    tableWrapper.addClass( 'jtpt-loading' );
                },
                success: function( response ) {
                    if ( ! response ) {
                        return;
                    }

                    tb_remove();

                    noticeBoard.html( response );

                    tb_show( '', '#TB_inline?&inlineId=jtpt-notices-popup' );

                    tableWrapper.removeClass( 'jtpt-loading' );
                },
                error: function() {
                    tableWrapper.removeClass( 'jtpt-loading' );
                },
            } );
        }

        /**
         * Handle ajax wrong quantity notice.
         *
         * @since 1.0.0
         *
         * @return {boolean|undefined}
         */
        $( document.body ).on( 'click', '.jtpt-wrong-quantity', function ( e ) {
            e.preventDefault();

            var thisButton = $( this ),
                productId = thisButton.attr( 'data-jtpt-product-id' ),
                quantity = thisButton.attr( 'data-jtpt-quantity' ),
                variationId = thisButton.attr( 'data-jtpt-variation-id' ),
                variation = thisButton.attr( 'data-jtpt-variation' ),
                tableWrapper = thisButton.closest( '.jtpt-product-table-wrapper' ),
                product = tableWrapper.find( '.jtpt-body-row-' + productId ),
                maxQuantity = product.attr( 'data-jtpt-max-qty' ),
                noticeBoard = $( '.jtpt-notices' );

            productId = parseFloat( productId );
            productId = productId.toFixed(0);
            productId = Math.abs( productId );

            quantity = parseFloat( quantity );
            maxQuantity = parseFloat( maxQuantity );

            if ( isNaN( productId ) || 0 === productId ) {
                return true;
            }

            if ( '' !== variation ) {
                variation = JSON.parse( variation );
            }

            if ( isNaN( quantity ) ) {
                quantity = 0;
            }

            if ( isNaN( maxQuantity ) ) {
                maxQuantity = -1;
            }

            var data = {
                action: 'jtpt_ajax_wrong_quantity_notice',
                product_id: productId,
                quantity: quantity,
                variation_id: variationId,
                variation: variation,
                max_quantity: maxQuantity,
            };

            $.ajax( {
                type: 'POST',
                url: jtpt_ajax_object.ajax_url,
                data: data,
                beforeSend: function(){
                    tableWrapper.addClass( 'jtpt-loading' );
                },
                success: function( response ) {
                    if ( ! response ) {
                        return;
                    }

                    tb_remove();

                    noticeBoard.html( response );

                    tb_show( '', '#TB_inline?&inlineId=jtpt-notices-popup' );

                    tableWrapper.removeClass( 'jtpt-loading' );
                },
                error: function() {
                    tableWrapper.removeClass( 'jtpt-loading' );
                },
            } );
        } );

        /**
         * Handle ajax variation selection needed notice.
         *
         * @since 1.0.0
         *
         * @return {boolean|undefined}
         */
        $( document.body ).on( 'click', '.jtpt-variation-selection-needed', function ( e ) {
            e.preventDefault();

            var thisButton = $( this ),
                productId = thisButton.attr( 'data-jtpt-product-id' ),
                tableWrapper = thisButton.closest( '.jtpt-product-table-wrapper' ),
                noticeBoard = $( '.jtpt-notices' );

            productId = parseFloat( productId );
            productId = productId.toFixed(0);
            productId = Math.abs( productId );

            if ( isNaN( productId ) || 0 === productId ) {
                return true;
            }

            var data = {
                action: 'jtpt_ajax_variation_selection_needed_notice',
                product_id: productId,
            };

            $.ajax( {
                type: 'POST',
                url: jtpt_ajax_object.ajax_url,
                data: data,
                beforeSend: function(){
                    tableWrapper.addClass( 'jtpt-loading' );
                },
                success: function( response ) {
                    if ( ! response ) {
                        return;
                    }

                    tb_remove();

                    noticeBoard.html( response );

                    tb_show( '', '#TB_inline?&inlineId=jtpt-notices-popup' );

                    tableWrapper.removeClass( 'jtpt-loading' );
                },
                error: function() {
                    tableWrapper.removeClass( 'jtpt-loading' );
                },
            } );
        } );

        /**
         * Handle ajax disable checkbox notice.
         *
         * @since 1.0.0
         *
         * @return {boolean|undefined}
         */
        $( document.body ).on( 'click', '.jtpt-check-checkbox.disabled', function ( e ) {
            e.preventDefault();

            var checkbox = $( this ),
                productId = checkbox.attr( 'data-jtpt-product-id' ),
                productType = checkbox.attr( 'data-jtpt-product-type' ),
                tableWrapper = checkbox.closest( '.jtpt-product-table-wrapper' ),
                noticeBoard = $( '.jtpt-notices' );

            productId = parseFloat( productId );
            productId = productId.toFixed(0);
            productId = Math.abs( productId );

            if ( isNaN( productId ) || 0 === productId ) {
                return true;
            }

            var data = {
                action: 'jtpt_ajax_disable_checkbox_notice',
                product_type: productType,
                product_id: productId,
            };

            $.ajax( {
                type: 'POST',
                url: jtpt_ajax_object.ajax_url,
                data: data,
                beforeSend: function(){
                    tableWrapper.addClass( 'jtpt-loading' );
                },
                success: function( response ) {
                    if ( ! response ) {
                        return;
                    }

                    tb_remove();

                    noticeBoard.html( response );

                    tb_show( '', '#TB_inline?&inlineId=jtpt-notices-popup' );

                    tableWrapper.removeClass( 'jtpt-loading' );
                },
                error: function() {
                    tableWrapper.removeClass( 'jtpt-loading' );
                },
            } );
        } );

        /**
         * Handle ajax product selection needed notice.
         *
         * @since 1.0.0
         *
         * @return {boolean|undefined}
         */
        $( document.body ).on( 'click', '.jtpt-products-selection-needed', function ( e ) {
            e.preventDefault();

            var thisButton = $( this ),
                selectedProductsCount = thisButton.attr( 'data-jtpt-selected-products-count' ),
                tableWrapper = thisButton.closest( '.jtpt-product-table-wrapper' ),
                noticeBoard = $( '.jtpt-notices' );

            selectedProductsCount = parseFloat( selectedProductsCount );

            if ( ! isNaN( selectedProductsCount ) && 0 < selectedProductsCount ) {
                return true;
            }

            var data = {
                action: 'jtpt_ajax_products_selection_needed_notice',
                product_count: selectedProductsCount,
            };

            $.ajax( {
                type: 'POST',
                url: jtpt_ajax_object.ajax_url,
                data: data,
                beforeSend: function(){
                    tableWrapper.addClass( 'jtpt-loading' );
                },
                success: function( response ) {
                    if ( ! response ) {
                        return;
                    }

                    tb_remove();

                    noticeBoard.html( response );

                    tb_show( '', '#TB_inline?&inlineId=jtpt-notices-popup' );

                    tableWrapper.removeClass( 'jtpt-loading' );
                },
                error: function() {
                    tableWrapper.removeClass( 'jtpt-loading' );
                },
            } );
        } );

        /**
         * Handle ajax add to cart action.
         *
         * @since 1.0.0
         *
         * @return {boolean|undefined}
         */
        $( document.body ).on( 'click', '.jtpt-ajax-add-to-cart', function ( e ) {
            e.preventDefault();

            var thisButton = $( this ),
                productId = thisButton.attr( 'data-jtpt-product-id' ),
                quantity = thisButton.attr( 'data-jtpt-quantity' ),
                variationId = thisButton.attr( 'data-jtpt-variation-id' ),
                variation = thisButton.attr( 'data-jtpt-variation' ),
                tableWrapper = thisButton.closest( '.jtpt-product-table-wrapper' );

            productId = parseFloat( productId );
            productId = productId.toFixed(0);
            productId = Math.abs( productId );

            if ( isNaN( productId ) || 0 === productId ) {
                return true;
            }

            if ( '' !== variation ) {
                variation = JSON.parse( variation );
            }

            var data = {
                action: 'jtpt_ajax_woocommerce_add_to_cart',
                product_id: productId,
                quantity: quantity,
                variation_id: variationId,
                variation: variation,
            };

            $( document.body ).trigger( 'adding_to_cart', [ thisButton, data ] );

            $.ajax( {
                type: 'POST',
                url: jtpt_ajax_object.ajax_url.toString().replace( '%%endpoint%%', 'add_to_cart' ),
                data: data,
                beforeSend: function(){
                    tableWrapper.addClass( 'jtpt-loading' );
                },
                success: function ( response ) {
                    if ( ! response ) {
                        return;
                    }

                    jtptWooCommerceNotices();

                    // Trigger event to refresh other areas.
                    $( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, thisButton ] );

                    tableWrapper.removeClass( 'jtpt-loading' );
                },
                error: function() {
                    tableWrapper.removeClass( 'jtpt-loading' );
                },
                dataType: 'json'
            } );
        } );

        /**
         * Handle ajax multiple add to cart action.
         *
         * @since 1.0.0
         *
         * @return {boolean|undefined}
         */
        $( document.body ).on( 'click', '.jtpt-multiple-ajax-add-to-cart', function ( e ) {
            e.preventDefault();

            var thisButton = $( this ),
                selectedProducts = thisButton.attr( 'data-jtpt-selected-products' ),
                tableWrapper = thisButton.closest( '.jtpt-product-table-wrapper' );

            if ( ! selectedProducts || ( '' === selectedProducts ) ) {
                return true;
            }

            if ( '' !== selectedProducts ) {
                selectedProducts = JSON.parse( selectedProducts );
            }

            var data = {
                action: 'jtpt_ajax_woocommerce_multiple_add_to_cart',
                selected_products: selectedProducts,
            };

            $( document.body ).trigger( 'adding_to_cart', [ thisButton, data ] );

            $.ajax( {
                type: 'POST',
                url: jtpt_ajax_object.ajax_url.toString().replace( '%%endpoint%%', 'add_to_cart' ),
                data: data,
                beforeSend: function(){
                    tableWrapper.addClass( 'jtpt-loading' );
                },
                success: function ( response ) {
                    if ( ! response ) {
                        return;
                    }

                    thisButton.removeClass( 'disabled' );

                    jtptWooCommerceNotices();

                    // Trigger event to refresh other areas.
                    $( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, thisButton ] );

                    tableWrapper.removeClass( 'jtpt-loading' );
                },
                error: function() {
                    tableWrapper.removeClass( 'jtpt-loading' );
                },
                dataType: 'json'
            } );
        } );

    } );

} )( jQuery );