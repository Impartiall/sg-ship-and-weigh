<?php
/**
 * Handle reading and writing settings
 * 
 * @since 1.0.0
 */
defined( 'ABSPATH' ) or die( 'Direct access blocked.' );

class SG_Ship_And_Weigh_Admin_Settings {

    /**
     * Option key to save settings
     * 
     * @since 1.0.0
     * 
     * @var string
     */
    protected $option_key = '_sg_ship_and_weigh_settings';

    /**
     * Default settings
     * 
     * @since 1.0.0
     * 
     * @var array
     */
    protected array $defaults;

    /**
     * Specification for allowed settings and their defaults,
     * types, and sanatize callbacks
     * 
     * @since 1.0.0
     * 
     * @var array
     */
    protected array $settings_spec;

    /**
     * SG_Ship_And_Weigh_Admin_API constructor
     * 
     * @since 1.0.0
     * 
     * @param array $settings_spec Specification of plugin settings
     */
    public function __construct( array $settings_spec ) {
        $this->settings_spec = $settings_spec;

        $this->set_defaults();
    }

    /**
     * Modify the defaults attribute according to the specification
     * 
     * @since 1.0.0
     * 
     * @param array $settings_spec Specification of plugin settings
     */
    public function set_defaults() {
        foreach ( $this->settings_spec as $key => $values ) {
            $this->defaults[ $key ] = $values[ 'default' ];
        }
    }

    /**
     * Get saved settings
     * 
     * @since 1.0.0
     * 
     * @return array
     */
    public function get_settings() {
        $saved = get_option( $this->option_key, array() );
        if ( ! is_array( $saved ) || empty( $saved )) {
            return $this->defaults;
        }
        // Merge settings with defaults
        return wp_parse_args( $saved, $this->defaults );
    }

    /**
     * Save settings
     * 
     * Array keys must be whitelisted (keys of $this->defaults)
     * 
     * @since 1.0.0
     * 
     * @param array $settings
     */
    public function save_settings( array $settings ) {
        // Remove un-whitelisted indices before saving
        foreach ( $settings as $key => $setting ) {
            if ( ! array_key_exists( $setting, $this->defaults ) ) {
                unset( $settings[ $key ] );
            }
        }
        update_option( $this->option_key, $settings );
    }
}