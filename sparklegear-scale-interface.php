<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              author-uri
 * @since             1.0.0
 * @package           Sparklegear_Scale_Interface
 *
 * @wordpress-plugin
 * Plugin Name:       Sparklegear Scale Interface
 * Plugin URI:        https://github.com/Impartiall/sparklegear-scale-interface
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Jesse Looney
 * Author URI:        author-uri
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sparklegear-scale-interface
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SPARKLEGEAR_SCALE_INTERFACE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sparklegear-scale-interface-activator.php
 */
function activate_sparklegear_scale_interface() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sparklegear-scale-interface-activator.php';
	Sparklegear_Scale_Interface_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sparklegear-scale-interface-deactivator.php
 */
function deactivate_sparklegear_scale_interface() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sparklegear-scale-interface-deactivator.php';
	Sparklegear_Scale_Interface_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_sparklegear_scale_interface' );
register_deactivation_hook( __FILE__, 'deactivate_sparklegear_scale_interface' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sparklegear-scale-interface.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sparklegear_scale_interface() {

	$plugin = new Sparklegear_Scale_Interface();
	$plugin->run();

}
run_sparklegear_scale_interface();
