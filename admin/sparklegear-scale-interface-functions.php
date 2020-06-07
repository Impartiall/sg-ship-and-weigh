<?php
/**
 * Add a menu link and page to the admin control panel
*/

add_action( 'admin_menu', 'sparklegear_scale_interface_add_acp_page' );

/**
 * Register menu link to the admin control panel
 * 
 * @since   1.0.0
 */

function sparklegear_scale_interface_add_acp_page() {
    add_menu_page(
        'Sparklegear Scale Interface',
        'Scale Interface',
        'manage_options',
        'scale-interface',
        'sparklegear_scale_interface_get_admin_page_contents'
    );
}

/**
 * Fill menu page from the file 'pages/sparklegear-scale-interface-acp-page.php'
 * 
 * @since   1.0.0
 */

function sparklegear_scale_interface_get_admin_page_contents() {
    /**
     * Echo page payload and run any php in the file
     */
    include(
        SPARKLEGEAR_SCALE_INTERFACE_PLUGIN_ROOT
        . 'pages/sparklegear-scale-interface-acp-page.php'
    );
}