<?php
/**
 * Functions to interface with the easyPost API
 * 
 * @since 1.0.0
 */
defined( 'ABSPATH' ) or die( 'Direct access blocked.' );

class SG_Ship_And_Weigh_EasyPost_Functions {

    /**
     * Set up easyPost interface
     * 
     * @since 1.0.0
     * 
     * @param string $API_KEY easypost API key
     */
    public function __construct( string $API_KEY ) {
        \EasyPost\EasyPost::setApiKey( $API_KEY );
    }

    /**
     * Verify a shipping address
     * 
     * @since 1.0.0
     * 
     * @param array $address_params
     */
    public function verify_address( array $address_params ) {
        $address_params[ 'verify' ] = array( 'delivery', 'zip4' );
        return rest_ensure_response(
            \EasyPost\Address::create( $address_params )
        );
    }
}