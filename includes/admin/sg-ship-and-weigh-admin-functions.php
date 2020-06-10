<?php
/**
 * Add a menu link and page to the admin control panel
*/

add_action( 'admin_menu', 'sg_ship_and_weigh_add_acp_page' );

/**
 * Register menu link to the admin control panel
 * 
 * @since   1.0.0
 */

function sg_ship_and_weigh_add_acp_page() {
    add_menu_page(
        'Ship and Weigh',
        'Ship and Weigh',
        'manage_options',
        'ship-and-weigh',
        'sg_ship_and_weigh_get_admin_page_contents'
    );
}

/**
 * Fill menu page from the file 'pages/sg-ship-and-weigh-acp-page.php'
 * 
 * @since   1.0.0
 */

function sg_ship_and_weigh_get_admin_page_contents() {
    /**
     * Echo page payload and run any php in the file
     */
    include(
        SG_SHIP_AND_WEIGH_PLUGIN_ROOT
        . 'includes/pages/sg-ship-and-weigh-acp-page.php'
    );
}