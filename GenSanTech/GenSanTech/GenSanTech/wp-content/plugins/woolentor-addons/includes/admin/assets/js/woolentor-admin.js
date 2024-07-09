;(function($){
"use strict";

    // Tab Menu
    function woolentor_admin_tabs( $tabmenus, $tabpane ){
        $tabmenus.on('click', 'a', function(e){
            e.preventDefault();
            var $this = $(this),
                $target = $this.attr('href');
            $this.addClass('wlactive').parent().siblings().children('a').removeClass('wlactive');
            $( $tabpane + $target ).addClass('wlactive').siblings().removeClass('wlactive');
        });
    }
    woolentor_admin_tabs( $(".woolentor-admin-tabs"), '.woolentor-admin-tab-pane' );

    // Check Save data wise
    WooLentorConditionField( admin_wllocalize_data.option_data['contenttype'], 'fakes', '.notification_fake' );
    WooLentorConditionField( admin_wllocalize_data.option_data['contenttype'], 'actual', '.notification_real' );
    WooLentorConditionField( admin_wllocalize_data.option_data['side_mini_cart'], 'on', '.side_mini_cart_field' );
    WooLentorConditionField( admin_wllocalize_data.option_data['enablecustomlayout'], 'on', '.depend_enable_custom_layout' );
    WooLentorConditionField( admin_wllocalize_data.option_data['enablerenamelabel'], 'on', '.depend_enable_rename_label' );
    WooLentorConditionField( admin_wllocalize_data.option_data['single_product_sticky_add_to_cart'], 'on', '.depend_single_product_sticky_add_to_cart' );

    // After On change
    WooLentorOnChangeField('.notification_content_type .radio', 'radio', '.notification_fake', 'fakes' );
    WooLentorOnChangeField('.notification_content_type .radio', 'radio', '.notification_real', 'actual' );
    WooLentorOnChangeField('.side_mini_cart .checkbox', 'radio', '.side_mini_cart_field', 'on' );
    WooLentorOnChangeField('.enablecustomlayout .checkbox', 'radio', '.depend_enable_custom_layout', 'on' );
    WooLentorOnChangeField('.enablerenamelabel .checkbox', 'radio', '.depend_enable_rename_label', 'on' );
    WooLentorOnChangeField('.single_product_sticky_add_to_cart .checkbox', 'radio', '.depend_single_product_sticky_add_to_cart', 'on' );

    function WooLentorOnChangeField( field, type = 'select', selector, condition_value ){
        $(field).on('change',function(){
            var change_value = '';
            if( type === 'radio' ){
                if( $(this).is(":checked") ){
                    change_value = $(this).val();
                }
            }else{
                change_value = $(this).val();
            }
            WooLentorConditionField( change_value, condition_value, selector );
        });
    }

    // Hide || Show
    function WooLentorConditionField( value, condition_value, selector ){
        if( value === condition_value ){
            $(selector).show();
        }else{
            $(selector).hide();
        }
    }
    
})(jQuery);