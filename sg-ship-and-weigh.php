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
defined( 'ABSPATH' ) or die( 'Direct access blocked.' );

/**
 * Handle plugin inludes, actions, and activation
 * 
 * @since 1.0.0
 */
class SG_Ship_And_Weigh {

    /**
     * Filepath of the admin directory
     * 
     * @since 1.0.0
     * 
     * @var string
     */
    protected string $admin_root_path;

    /**
     * Site URL of the admin directory
     * 
     * @since 1.0.0
     * 
     * @var string
     */
    protected string $admin_root_url;

    public function __construct() {
        $this->admin_root_path = plugin_dir_path( __FILE__ ) . 'admin/';
        $this->admin_root_url = plugin_dir_url( __FILE__ ) . 'admin/';

        $this->includes();
        $this->init_hooks();
    }

    protected function includes() {
        require_once( $this->admin_root_path
            . '/class-sg-ship-and-weigh-admin-api.php'
        );
        require_once( $this->admin_root_path
            . '/class-sg-ship-and-weigh-admin-menu.php'
        );
        require_once( $this->admin_root_path
            . '/class-sg-ship-and-weigh-admin-settings.php'
        );
    }

    protected function init_hooks() {
        add_action( 'init', array( $this, 'init' ) );
        add_action( 'rest_api_init', array( $this, 'init_api' ) );
    }

    public function init() {
        new SG_Ship_And_Weigh_Admin_Menu( $this->admin_root_url, $this->admin_root_path );
    }

    public function init_api() {
        ( new SG_Ship_And_Weigh_Admin_API() )->add_routes();
    }

    public function activate() {
        flush_rewrite_rules();
    }

    public function deactivate() {
        flush_rewrite_rules();
    }
}

if ( class_exists( 'SG_Ship_And_Weigh' ) ) {
    $sgShipAndWeigh = new SG_Ship_and_Weigh();
}

register_activation_hook( __FILE__, array( $sgShipAndWeigh, 'activate' ) );

register_deactivation_hook( __FILE__, array( $sgShipAndWeigh, 'deactivate' ) );