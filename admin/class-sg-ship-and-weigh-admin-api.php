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
     * Instance of the SG_Ship_And_Weigh_Shipping_Settings class
     * 
     * @since 1.0.0
     * 
     * @var SG_Ship_And_Weigh_Admin_Settings
     */
    protected SG_Ship_And_Weigh_Shipping_Settings $shippingObject;

    /**
     * SG_Ship_And_Weigh_Admin_API constructor
     * 
     * @since 1.0.0
     * 
     * @param array $settings_spec Specification of plugin settings
     */
    public function __construct( array $settings_spec ) {
        $this->settings_spec = $settings_spec;
        $this->settingsObject = new SG_Ship_And_Weigh_Admin_Settings( $settings_spec );
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
                    'args' => $this->get_settings_post_args(),
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
                        'name' => array(
                            'type' => 'string',
                            'required' => true,
                            'sanatize_callback' => 'sanatize_text_field',
                        ),
                        'email' => array(
                            'type' => 'string',
                            'required' => true,
                            'sanatize_callback' => 'sanatize_email',
                        ),
                        'country' => array(
                            'type' => 'string',
                            'required' => true,
                            'sanatize_callback' => 'sanatize_text_field',
                        ),
                        'address' => array(
                            'type' => 'string',
                            'required' => true,
                            'sanatize_callback' => 'sanatize_textarea_field',
                        ),
                    ),
                    'permissions_callback' => array( $this, 'permissions' ),
                ),
            );
            register_rest_route( 'sg-ship-and-weigh-api/v1', '/recipients',
                array(
                    'methods' => 'GET',
                    'callback' => array( $this, 'get_recipients' ),
                    'args' => array(),
                    'permissions_callback' => array( $this, 'permisssions' ),
                ),
            );
    }

    /**
     * Return POST argument array based on specification
     * 
     * @since 1.0.0
     * 
     * @return array
     */
    public function get_settings_post_args() {
        $post_args = array();
        foreach ( $this->settings_spec as $key => $values ) {
            $array[ $key ] = array(
                'type' => $values[ 'type' ],
                'required' => false,
                'sanatize_callback' => $values[ 'sanatize_callback' ],
            );
        }

        return $post_args;
    }

    /**
     * Return an array of settings to be passed to save_settings
     * from a POST request
     * 
     * @since 1.0.0
     * 
     * @param WP_REST_Request $request
     * 
     * @return array
     */
    public function get_settings_from_post( WP_REST_Request $request ) {
        $settings = array();
        foreach ( array_keys( $this->settings_spec ) as $key ) {
            $settings[ $key ] = $request->get_param( $key );
        }

        return $settings;
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
        $settings = $this->get_settings_from_post( $request );

        $this->settingsObject->save_settings( $settings );
        return rest_ensure_response(
            $this->settingsObject->get_settings()
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
        $recipient = $request->get_params();

        error_log( print_r( $recipient, true ) );
    }

    /**
     * Get recipients
     * 
     * @since 1.0.0
     * 
     * @param WP_REST_Request $request
     */
    public function get_recipients( WP_REST_Request $request ) {
        // Format recipients object for Select2
        $recipients = array();
        foreach ( $this->shippingObject->get_recipients() as $i => $values ) {
            $recipients[ $i ] = array(
                'id' => $values[ 'name' ],
                'text' => $values[ 'name' ],
                'email' => $values[ 'email' ],
                'country' => $values[ 'country' ],
                'address' => $values[ 'address' ],
            );
        }
        return rest_ensure_response(
            $recipients
        );
    }
}