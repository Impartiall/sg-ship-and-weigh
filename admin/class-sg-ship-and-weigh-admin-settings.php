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
     * Get saved settings
     * 
     * @since 1.0.0
     * 
     * @return array
     */
    public function get_settings() {
        $settings = get_option( $this->option_key, array() );

        return $settings;
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
        $old_settings = $this->get_settings();

        update_option( $this->option_key, array_merge( $old_settings, $settings ) );
    }
}