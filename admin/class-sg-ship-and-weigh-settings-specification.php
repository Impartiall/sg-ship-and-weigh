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
        'setting' => [
            'Setting',
            0,
            'int',
            'number',
            'absint',
        ],
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
            $settings_specification[$key] = self::get_setting_specification( ...$setting_blueprint );
        }

        return $settings_specification;
    }

    /**
     * Generate a labeled array of type, default,
     * and sanatizer for a given setting
     * 
     * @since 1.0.0
     * 
     * @param string $name Name of the setting to be displayed in HTML
     * @param mixed $default The default value for the setting
     * @param string $type The type of the setting
     * @param string $html_type The type for the corresponding HTML input
     * @param string sanatize_callback
     *     The callback with which to sanatize input to this setting
     * 
     * @return array
     */
    public static function get_setting_specification(
        string $name, $default, string $type,
        string $html_type, string $sanatize_callback
    ) {
        return array(
            'name' => __( $name, 'text-domain' ),
            'default' => $default,
            'type' => $type,
            'html_type' => $html_type,
            'sanatize_callback' => $sanatize_callback,
        );
    }
}
