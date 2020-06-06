<?php
/**
 * Add a menu link and page to the admin control panel
*/

add_action( 'admin_menu', 'sparklegear_scale_interface_add_acp_page' );

/**
 * Add menu link and page to the admin control panel
 * 
 * @since   1.0.0
 */

function sparklegear_scale_interface_add_acp_page() {
    add_menu_page(
        'Sparklegear Scale Interface',
        'Scale Interface',
        'manage_options',
        'pages/sparklegear-scale-interface-acp-page.php'
    );
}
