<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       author-uri
 * @since      1.0.0
 *
 * @package    Sparklegear_Scale_Interface
 * @subpackage Sparklegear_Scale_Interface/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Sparklegear_Scale_Interface
 * @subpackage Sparklegear_Scale_Interface/includes
 * @author     Jesse Looney <jmlooney64@gmail.com>
 */
class Sparklegear_Scale_Interface_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'sparklegear-scale-interface',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
