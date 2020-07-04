<?php
/**
 * Handle client side easyPost proxy API calls
 * 
 * @since 1.0.0
 */
defined( 'ABSPATH' ) or die( 'Direct access blocked.' );

class SG_Ship_And_Weigh_EasyPost_API {

    /**
     * Specification of verification args
     * 
     * @since 1.0.0
     */
    protected array $verification_args_spec = array(
        'street1',
        'street2',
        'city',
        'state',
        'zip',
        'country',
        'name',
        'company',
    );

    /**
     * Instance of the SG_Ship_And_Weigh_EasyPost class
     * 
     * @since 1.0.0
     * 
     * @var SG_Ship_And_Weigh_EasyPost_Functions
     */
    protected SG_Ship_And_Weigh_EasyPost_Functions $easypostFunctions;

    /**
     * SG_Ship_And_Weigh_Admin_API constructor
     * 
     * @since 1.0.0
     * 
     * @param string $API_KEY EasyPost API key
     */
    public function __construct( string $API_KEY ) {
        $this->easypostFunctions = new SG_Ship_And_Weigh_EasyPost_Functions( $API_KEY );
    }

    /**
     * Add API routes
     * 
     * @since 1.0.0
     */
    public function add_routes() {
        register_rest_route( 'sg-ship-and-weigh-api/v1', '/easypost/verify-address',
            array(
                'methods' => 'GET',
                'callback' => array( $this, 'verify_address' ),
                'args' => $this->get_verification_args(),
                'permissions_callback' => array( $this, 'permissions' ),
            ),
        );
        register_rest_route( 'sg-ship-and-weigh-api/v1', '/easypost/rates',
            array(
                'methods' => 'GET',
                'callback' => array( $this, 'get_rates' ),
                'args' => array(
                    'shipment' => array(
                        'type' => 'array[]',
                        'required' => true,
                        'sanatize_callback' => function ( $shipment ) {
                            return array_map(
                                function ( $field ) {
                                    return array_map( 'esc_attr', $field );
                                },
                                $address
                            );
                        }
                    ),
                ),
                'permissions_callback' => array( $this, 'permissions' ),
            ),
        );
    }

    /**
     * Check the user permission level
     * 
     * @since 1.0.0
     */
    public function permissions() {
        return current_user_can( 'manage_options' );
    }

    /**
     * Verify a shipping address and suggest changes
     * 
     * @since 1.0.0
     * 
     * @param WP_REST_Request $request
     */
    public function verify_address( WP_REST_Request $request ) {
        $address = $request->get_params();

        return rest_ensure_response(
            $this->easypostFunctions->verify_address( $address )
        );
    }

    /**
     * Generate an array of REST API arg specifications
     * 
     * @since 1.0.0
     */
    public function get_verification_args() {
        $verification_args = array();
        foreach ( $this->verification_args_spec as $arg ) {
            $verification_args[ $arg ] = array(
                'type' => 'string',
                'required' => 'false',
                'sanatize_callback' => 'sanatize_text_field',
            );
        }

        return $verification_args;
    }

    /**
     * Get an array of shipment rates
     * 
     * @since 1.0.0
     * 
     * @param WP_REST_Request $request
     */
    public function get_rates( WP_REST_Request $request ) {
        $shipment = $request->get_param( 'shipment' );

        if ( $shipment[ 'parcel' ][ 'weight' ] <= 0 ) {
            return rest_ensure_response(
                new WP_Error( '400', 'Invalid parcel weight. Parcel weight must be positive.' )
            );
        }

        return rest_ensure_response(
            $this->easypostFunctions->get_rates( $shipment )
        );
    }
}