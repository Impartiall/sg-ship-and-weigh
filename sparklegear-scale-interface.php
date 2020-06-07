<?php

/**
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

define( 'SPARKLEGEAR_SCALE_INTERFACE_PLUGIN_ROOT', plugin_dir_path( __FILE__ ) );

require_once SPARKLEGEAR_SCALE_INTERFACE_PLUGIN_ROOT
             . 'admin/sparklegear-scale-interface-functions.php';