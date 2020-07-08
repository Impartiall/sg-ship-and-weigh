const DEBUG = SHIP_AND_WEIGH.debug;
const debug = {};
if ( DEBUG ) {
    debug.bold = 'font-weight: bold;';
}

jQuery($ => {
    $( '#tracking-url' ).attr( 'href', params.tracking_url );

    $( '#label-url' ).attr( 'href', params.label_url );

    $( '#refund' ).on( 'click', () => {
        $.ajax({
            method: 'POST',
            url: SHIP_AND_WEIGH.api.url.refund,
            beforeSend( xhr ) {
                xhr.setRequestHeader( 'X-WP-Nonce', SHIP_AND_WEIGH.api.nonce );
            },
            data: {
                id: shipment_id,
            },
            error( response ) {
                if ( DEBUG ) {
                    console.log( `%cAn error occurred while requesting a refund for shipment ${shipment_id}`, debug.bold );
                    console.log( response.message );
                }
            },
            success( response ) {
                if ( DEBUG ) {
                    console.log( `%cRefund successfully requested for shipment ${shipment_id}`, debug.bold );
                }
                $( '#feedback' ).text( 'Refund request submitted' );
            }
        });
    });
});