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

define( 'SG_SHIP_AND_WEIGH_PLUGIN_ROOT', plugin_dir_path( __FILE__ ) );

require_once SG_SHIP_AND_WEIGH_PLUGIN_ROOT
             . 'includes/admin/sg-ship-and-weigh-admin-functions.php';