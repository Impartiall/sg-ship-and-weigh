<?php
defined( 'abspath' ) or die( 'Direct access blocked.' );
/**
 * Handle reading and writing settings
 * 
 * @since 1.0.0
 */
class SG_Ship_And_Weigh_Admin_Settings {
    /**
     * Option key to save settings
     * 
     * @since 1.0.0
     * 
     * @var string
     */
    protected static $option_key = '_sg_ship_and_weigh_settings';
    /**
     * Default settings
     * 
     * @since 1.0.0
     * 
     * @var array
     */
    protected static $defaults = array(
        'industry' => 'lumber',
        'amount' => 42,
    );
    /**
     * Get saved settings
     * 
     * @since 1.0.0
     * 
     * @return array
     */
    public static function get_settings() {
        $saved = get_option( self::$option_key, array() );
        if ( ! is_array( $saved ) || empty( $saved )) {
            return self::$defaults;
        }
        return wp_parse_args( $saved, self::$defaults );
    }
    /**
     * Save settings
     * 
     * Array keys must be whitelisted (keys of self::$defaults)
     * 
     * @since 1.0.0
     * 
     * @param array $settings
     */
    public static function save_settings( array $settings ) {
        // Remove un-whitelisted indices before saving
        foreach ( $settings as $key => $setting ) {
            if ( ! array_key_exists( $setting, self::$defaults ) ) {
                unset( $settings[ $key ] );
            }
        }
        update_option( self::$option_key, $settings );
    }
}