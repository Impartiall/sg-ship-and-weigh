<?php
/**
 * Setup REST API
 * 
 * @since 1.0.0
 */
defined( 'ABSPATH' ) or die( 'Direct access blocked.' );

class SG_Ship_And_Weigh_Admin_API {

    /**
     * Instance of the SG_Ship_And_Weigh_Admin_Settings class
     * 
     * @since 1.0.0
     * 
     * @var SG_Ship_And_Weigh_Admin_Settings
     */
    protected SG_Ship_And_Weigh_Admin_Settings $settingsObject;

    /**
     * Instance of the SG_Ship_And_Weigh_Shipping_Settings class
     * 
     * @since 1.0.0
     * 
     * @var SG_Ship_And_Weigh_Shipping_Settings
     */
    protected SG_Ship_And_Weigh_Shipping_Settings $shippingObject;

    /**
     * SG_Ship_And_Weigh_Admin_API constructor
     * 
     * @since 1.0.0
     * 
     */
    public function __construct() {
        $this->settingsObject = new SG_Ship_And_Weigh_Admin_Settings();
        $this->shippingObject = new SG_Ship_And_Weigh_Shipping_Settings();
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
                    'args' => array(
                        'from_address' => array(
                            'type' => 'string[]',
                            'required' => false,
                            'sanatize_callback' => function ( $address ) {
                                return array_map( 'esc_attr', $address );
                            },
                        ),
                        'default_weight_mode' => array(
                            'type' => 'string',
                            'required' => false,
                            'sanatize_callback' => 'sanatize_text_field',
                        ),
                        'easypost_api_key' => array(
                            'type' => 'string',
                            'required' => false,
                            'sanatize_callback' => 'sanatize_text_field',
                        ),
                    ),
                    'permissions_callback' => array( $this, 'permissions' )
                ),
            );
            register_rest_route( 'sg-ship-and-weigh-api/v1', '/settings',
                array(
                    'methods' => 'GET',
                    'callback' => array( $this, 'get_settings' ),
                    'args' => array(),
                    'permissions_callback' => array( $this, 'permissions' ),
                ),
            );

            register_rest_route( 'sg-ship-and-weigh-api/v1', '/recipients',
                array(
                    'methods' => 'POST',
                    'callback' => array( $this, 'add_recipient' ),
                    'args' => array(
                        'to_address' => array(
                            'type' => 'string[]',
                            'required' => true,
                            'sanatize_callback' => function ( $address ) {
                                return array_map( 'esc_attr', $address );
                            },
                        ),
                    ),
                    'permissions_callback' => array( $this, 'permissions' ),
                ),
            );
            register_rest_route( 'sg-ship-and-weigh-api/v1', '/recipients',
                array(
                    'methods' => 'DELETE',
                    'callback' => array( $this, 'remove_recipient' ),
                    'args' => array(
                        'uuid' => array(
                            'type' => 'string',
                            'required' => true,
                            'sanatize_callback' => 'sanatize_text_field',
                        ),
                    ),
                ),
            );
            register_rest_route( 'sg-ship-and-weigh-api/v1', '/recipients',
                array(
                    'methods' => 'GET',
                    'callback' => array( $this, 'get_recipients' ),
                    'permissions_callback' => array( $this, 'permisssions' ),
                ),
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
     * Update settings
     * 
     * @since 1.0.0
     * 
     * @param WP_REST_Request $request
     */
    public function update_settings( WP_REST_Request $request ) {
        $settings = $request->get_params();

        return rest_ensure_response(
            $this->settingsObject->save_settings( $settings )
        )->set_status( 201 );
    }

    /**
     * Get settings
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

    /**
     * Add a recipient
     * 
     * @since 1.0.0
     * 
     * @param WP_REST_Request $request
     */
    public function add_recipient( WP_REST_Request $request ) {
        $recipient = $request->get_param( 'to_address' );

        if ( WP_DEBUG ) {
            error_log( 'SG Ship and Weigh: Adding recipient' );
            error_log( print_r( $recipient, true ) );
        }

        return rest_ensure_response(
            $this->shippingObject->add_recipient( $recipient )
        );
    }

    /**
     * Get recipients
     * 
     * @since 1.0.0
     * 
     * @param WP_REST_Request $request
     */
    public function get_recipients( WP_REST_Request $request ) {
        return rest_ensure_response(
            $this->shippingObject->get_recipients()
        );
    }

    /**
     * Remove a recipient by UUID
     * 
     * @since 1.0.0
     * 
     * @param WP_REST_Request $request
     */
    public function remove_recipient( WP_REST_Request $request ) {
        $uuid = $request->get_param( 'uuid' );

        return rest_ensure_response(
            $this->shippingObject->remove_recipient( $uuid )
        );
    }
}