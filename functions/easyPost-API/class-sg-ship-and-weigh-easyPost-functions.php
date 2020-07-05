<?php
/**
 * Functions to interface with the easyPost API
 * 
 * @since 1.0.0
 */
defined( 'ABSPATH' ) or die( 'Direct access blocked.' );

/**
 * Helper getter class for EasyPost Address objects
 */
// class EasyPost_Address extends \EasyPost\Address {

// }

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
        $address = \EasyPost\Address::create( $address_params );

        if ( WP_DEBUG ) {
            error_log( 'Verifications:' );
            error_log( print_r( json_decode( $address ), true ) );
        }

        return json_decode( $address );
    }

    /**
     * Rate a shipment
     * 
     * @since 1.0.0
     * 
     * @param array $shipment_args
     */
    public function get_rates( array $shipment_args ) {
        $from_address = \EasyPost\Address::create( $shipment_args[ 'from_address' ] );
        $to_address = \EasyPost\Address::create( $shipment_args[ 'to_address' ] );
        $parcel = \EasyPost\Parcel::create( $shipment_args[ 'parcel' ] );

        $shipment = \EasyPost\Shipment::create(
            array(
                'from_address' => $from_address,
                'to_address' => $to_address,
                'parcel' => $parcel,
            )
        );

        if ( WP_DEBUG ) {
            error_log( 'Rates:' );
            error_log( print_r( $shipment->rates, true ) );
        }

        return $shipment->rates;
    }
}