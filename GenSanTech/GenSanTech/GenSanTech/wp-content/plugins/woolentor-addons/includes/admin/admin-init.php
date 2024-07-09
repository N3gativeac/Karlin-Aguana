<?php

if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly

class Woolentor_Admin_Setting{

    public function __construct(){
        add_action('admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
        $this->woolentor_admin_settings_page();
    }

    /*
    *  Setting Page
    */
    public function woolentor_admin_settings_page() {
        require_once('include/class.settings-api.php');
        require_once('include/template-library.php');
        require_once('include/class.extension-manager.php');
        if( is_plugin_active('woolentor-addons-pro/woolentor_addons_pro.php') ){
            require_once WOOLENTOR_ADDONS_PL_PATH_PRO.'includes/admin/admin-setting.php';
        }else{
            require_once('include/admin-setting.php');
        }
    }

    /*
    *  Enqueue admin scripts
    */
    public function enqueue_scripts( $hook ){

        if( $hook === 'woolentor_page_woolentor' or $hook === 'woolentor_page_woolentor_templates' ){

            wp_enqueue_style( 'simple-line-icons-wl' );

            wp_enqueue_style(
                'fonticonpicker',
                WOOLENTOR_ADDONS_PL_URL . 'assets/lib/iconpicker/css/jquery.fonticonpicker.min.css', 
                array(),
                WOOLENTOR_VERSION 
            );

            wp_enqueue_style(
                'fonticonpicker-bootstrap',
                WOOLENTOR_ADDONS_PL_URL . 'assets/lib/iconpicker/css/jquery.fonticonpicker.bootstrap.min.css', 
                array(),
                WOOLENTOR_VERSION 
            );

            wp_enqueue_style( 'woolentor-admin' );
            // wp core styles
            wp_enqueue_style( 'wp-jquery-ui-dialog' );

            // wp core scripts
            wp_enqueue_script( 'jquery-ui-dialog' );

            wp_enqueue_script( 
                'fonticonpicker', 
                WOOLENTOR_ADDONS_PL_URL . 'assets/lib/iconpicker/js/jquery.fonticonpicker.min.js', 
                array( 'jquery' ), 
                WOOLENTOR_VERSION, 
                TRUE
            );

            wp_enqueue_script( 'woolentor-admin-main' );

            wp_localize_script( 
                'woolentor-admin-main', 
                'woolentor_fields', 
                [
                    'iconset' => Woolentor_Icon_List::icon_sets(),
                ]
            );

        }

    }

}

new Woolentor_Admin_Setting();