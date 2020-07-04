<?php
/**
 * Handle adding, retriving, and deleting of remembered shipping info
 * 
 * @since 1.0.0
 */
defined( 'ABSPATH' ) or die( 'Direct access blocked.' );

class SG_Ship_And_Weigh_Shipping_Settings {

    /**
     * Generic option key to be suffixed for each setting
     * 
     * @since 1.0.0
     * 
     * @var string
     */
    protected string $option_key = '_sg_ship_and_weigh_';

    /**
     * Get an array of recipients and their addresses from the database
     * 
     * @since 1.0.0
     * 
     * @return array
     */
    public function get_recipients() {
        $recipients = get_option( $this->option_key . 'recipients', array() );
        return $recipients;
    }

    /**
     * Add a recipient and associated data to the database
     * 
     * @since 1.0.0
     * 
     * @param array $recipient Recipient data to be added to the database
     */
    public function add_recipient( array $recipient ) {
        $recipients = $this->get_recipients();

        if ( ! ( array_key_exists( 'uuid', $recipient ) ) ) {
            return new WP_Error( '400', 'Recipient must have a UUID' );
        }

        $recipients[] = $recipient;
        update_option( $this->option_key . 'recipients', $recipients );
    }

    /**
     * Remove a recipient by id
     * 
     * @since 1.0.0
     * 
     * @param string $uuid The uuid of the recipient to be removed
     */
    public function remove_recipient( string $uuid ) {
        $recipients = $this->get_recipients();

        foreach ( $recipients as $key => $values ) {
            if ( $values[ 'uuid' ] === $uuid ) {
                unset( $recipients[ $key ] );
            }
        }

        update_option( $this->option_key . 'recipients', $recipients );
    }
}