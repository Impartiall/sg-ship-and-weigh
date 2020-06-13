<?php
/**
 * @link              author-uri
 * @since             1.0.0
 * @package           SparkleGear_Ship_and_Weigh
 *
 * @wordpress-plugin
 * Plugin Name:       SparkleGear Ship and Weigh
 * Plugin URI:        https://github.com/SparkleGear/sg-ship-and-weigh
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Jesse Looney
 * Author URI:        author-uri
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sg-ship-and-weigh
 * Domain Path:       /languages
 */
add_action( 'init', function() {
                        // or plugin_dir_url (?)
    $admin_assets_root = plugin_dir_path( __FILE__ ) . "admin";

    require_once( $admin_assets_root .
        '/class-sg-ship-and-weigh-admin-api.php'
    );

    // Setup menu
    if( is_admin() ) {
        require_once( $admin_assets_root .
            '/class-sg-ship-and-weigh-admin-menu.php'
        );
        require_once( $admin_assets_root .
            '/class-sg-ship-and-weigh-admin-settings.php'
        );

        new SG_Ship_And_Weigh_Admin_Menu( $admin_assets_root );
    }
});

add_action( 'rest_api_init', function() {
    (new SG_Ship_And_Weigh_Admin_API())->add_routes();
});