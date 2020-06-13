<?php
defined( 'abspath' ) or die( 'Direct access blocked.' );
/**
 * Setup REST API
 * 
 * @since 1.0.0
 */
class SG_Ship_And_Weigh_Admin_API {
    /**
     * Add routes
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
                            'sanitize_callback' => 'sanatize_text_field'
                        ),
                        'amount' => array(
                            'type' => int,
                            'required' => false,
                            'sanatize_callback' => 'absint'
                        )
                    ),
                    'permissions_callback' => array( $this, 'permissions' )
                )
            );
            register_rest_route( 'sg-ship-and-weigh-api/v1', '/settings',
                array(
                    'methods' => 'GET',
                    'callback' => array( $this, 'get_settings' ),
                    'args' => array(),
                    'permissions_callback' => array( $this, 'permissions' )
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
            'amount' => $request->get_param( 'amount' )
        );
        SG_Ship_And_Weigh_Admin_Settings::save_settings( $settings );
        return rest_ensure_response(
            SG_Ship_And_Weigh_Admin_Settings::get_settings()
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
            SG_Ship_And_Weigh_Admin_Settings::get_settings()
        );
    }
}