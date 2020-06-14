<?php
/**
 * Setup REST API
 * 
 * @since 1.0.0
 */
defined( 'ABSPATH' ) or die( 'Direct access blocked.' );

class SG_Ship_And_Weigh_Admin_API {

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
     * Instance of the SG_Ship_And_Weigh_Admin_Settings class
     * 
     * @since 1.0.0
     * 
     * @var SG_Ship_And_Weigh_Admin_Settings
     */
    protected SG_Ship_And_Weigh_Admin_Settings $settingsObject;

    /**
     * SG_Ship_And_Weigh_Admin_API constructor
     * 
     * @since 1.0.0
     * 
     * @param array $settings_spec Specification of plugin settings
     */
    public function __construct( $settings_spec ) {
        $this->settings_spec = settings_spec;
        $this->settingsObject = new SG_Ship_And_Weigh_Admin_Settings( $settings_spec );
    }

    /**
     * Add API routes
     * 
     * @since 1.0.0
     */
    public function add_routes() {
            register_rest_route( 'sg-ship-and-weigh-api/v1', '/settings',
                array(
                    'methods' => 'POST',
                    'callback' => array( $this, 'update_settings' ),
                    /**
                     * @TODO factor out settings which exist in three places
                     * to one database entry (from here and admin-settings)
                     */
                    'args' => array(
                        'industry' => array(
                            'type' => 'string',
                            'required' => false,
                            'sanitize_callback' => 'sanatize_text_field',
                        ),
                        'amount' => array(
                            'type' => int,
                            'required' => false,
                            'sanatize_callback' => 'absint',
                        ),
                    ),
                    'permissions_callback' => array( $this, 'permissions' )
                )
            );
            register_rest_route( 'sg-ship-and-weigh-api/v1', '/settings',
                array(
                    'methods' => 'GET',
                    'callback' => array( $this, 'get_settings' ),
                    'args' => array(),
                    'permissions_callback' => array( $this, 'permissions' ),
                )
            );
    }

    /**
     * Check request permissions
     * 
     * @since 1.0.0
     * 
     * @return bool
     */
    public function permissions() {
        return current_user_can( 'manage_options' );
    }

    /**
     * Update settings via API
     * 
     * @since 1.0.0
     * 
     * @param WP_REST_Request $request
     */
    public function update_settings( WP_REST_Request $request ) {
        $settings = array(
            'industry' => $request->get_param( 'industry' ),
            'amount' => $request->get_param( 'amount' ),
        );
        $this->settingsObject->save_settings( $settings );
        return rest_ensure_response(
            $this->settingsObject->get_settings()
        )->set_status( 201 );
    }

    /**
     * Get settings via API
     * 
     * @since 1.0.0
     * 
     * @param WP_REST_Request $request
     */
    public function get_settings( WP_REST_Request $request ) {
        return rest_ensure_response(
            $this->settingsObject->get_settings()
        );
    }
}