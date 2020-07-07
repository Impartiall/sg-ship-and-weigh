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
            error_log( print_r( json_decode( $shipment )->rates, true ) );
        }

        return json_decode( $shipment )->rates;
    }

    /**
     * Buy a shipment
     * 
     * @since 1.0.0
     * 
     * @param array $shipment_args
     */
    public function buy_shipment( array $shipment_args ) {
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

        $rate = $this->get_rate( $shipment_args[ 'rate' ], $shipment );
        if ( null === $rate ) {
            return new WP_Error( '500', 'Rate unavailable' );
        }

        $shipment->buy(
            array(
                'rate' => $rate,
                'insurance' => $shipment_args[ 'insurance' ],
            )
        );

        if ( WP_DEBUG ) {
            error_log( 'Shipment purchased:' );
            error_log( print_r( $shipment, true ) );
        }
    }

    /**
     * Find a shipping rate by carrier, service, and price
     * 
     * @since 1.0.0
     * 
     * @param array $rate_args Array of attributes for the desired rate
     * @param \EasyPost\Shipment $shipment Shipment object to search
     */
    protected function get_rate( array $rate_args, \EastPost\Shipment $shipment ) {
        foreach ( $shipment->rates as $rate ) {
            if ( $rate->carrier === $rate_args[ 'carrier' ]
                && $rate->service === $rate_args[ 'service' ]
                && $rate->currency === $rate_args[ 'currency' ]
                && $rate->rate === $rate_args[ 'rate' ]
            ) {
                return $rate;
            }
        }

        return null;
    }
}