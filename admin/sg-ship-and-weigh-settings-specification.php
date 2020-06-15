<?php
/**
 * Generate a labeled list of settings from a simple blueprint
 * 
 * @since 1.0.0
 */
defined( 'ABSPATH' ) or die( 'Direct access blocked.' );

class SG_Ship_And_Weigh_Settings_Specification {

    /**
     * Settings specification blueprint used to generate settings specification
     * 
     * @since 1.0.0
     * 
     * @var array
     */
    protected static array $settings_blueprint = array(
        'key' => ['value'],
    );

    /**
     * Generate a labeled array of settings types, defaults,
     * and sanitizers from the $settings_blueprint
     * 
     * @since 1.0.0
     * 
     * @return array
     */
    public static function get_settings_specification() {
        $settings_specification = array();
        foreach ( self::$settings_blueprint as $key => $setting_blueprint ) {
            $settings_specification[$key] = self::get_setting_specification($settings_blueprint);
        }

        return $settings_specification;
    }

    /**
     * Generate a labeled array of type, default,
     * and sanatizer for a given setting
     * 
     * @since 1.0.0
     * 
     * @param string $type The type of the setting
     * @param mixed $default The default value for the setting
     * @param string sanatize_callback
     *     The callback with which to sanatize input to this setting
     * 
     * @return array
     */
    public static function get_setting_specification( string $type, mixed $default, string $sanatize_callback ) {
        return array(
            'type' => $type,
            'default' => $default,
            'sanatize_callback' => $sanatize_callback,
        );
    }
}
