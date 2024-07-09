<?php
/**
 * JustTables Installer.
 *
 * @since 1.0.5
 */

namespace JustTables;

/**
 * Installer class.
 */
class Installer {

	/**
     * Installer constructor.
     *
     * @since 1.0.5
     */
    public function __construct() {
        $this->installer_init();
    }

    /**
     * Initialize installer.
     *
     * @since 1.0.5
     */
    public function installer_init() {
        $this->store_installed_time();
        $this->deactivate_pro_addition();
    }

    /**
     * Store installed time.
     *
     * @since 1.0.5
     */
    public function store_installed_time() {
        $installed = get_option( 'just_tables_installed' );

        if ( ! $installed ) {
            update_option( 'just_tables_installed', time() );
        }
    }

    /**
     * Deactivate pro addition.
     *
     * @since 1.0.5
     */
    public function deactivate_pro_addition() {
        if ( is_plugin_active( 'just-tables-pro/just-tables-pro.php' ) ) {
            add_action( 'update_option_active_plugins', function() {
                deactivate_plugins( 'just-tables-pro/just-tables-pro.php' );
            } );
        }
    }

}