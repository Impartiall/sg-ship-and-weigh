const DEBUG = SHIP_AND_WEIGH.debug;
const debug = {};
if ( DEBUG ) {
    debug.bold = 'font-weight: bold;';
}

jQuery($ => {
    $( '#tracking-url' ).attr( 'href', params.tracking_url );

    $( '#label-url' ).attr( 'href', params.label_url );

    $( '#refund' ).on( 'click', () => {
        if ( DEBUG ) {
            console.log( '%cRequesting refund', debug.bold );
        }

        $.ajax({
            method: 'POST',
            url: SHIP_AND_WEIGH.api.url.refund,
            beforeSend( xhr ) {
                xhr.setRequestHeader( 'X-WP-Nonce', SHIP_AND_WEIGH.api.nonce );
            },
            data: {
                id: params.id,
            },
            error( response ) {
                if ( DEBUG ) {
                    console.log( `%cAn error occurred while requesting a refund for shipment ${params.id}`, debug.bold );
                    console.log( response );
                }

                if ( response.responseJSON.data.code === "SHIPMENT.REFUND.UNAVAILABLE" ) {
                    $( '#feedback' ).text( response.responseJSON.data.message );
                } else {
                    $( '#feedback' ).text( 'The refund unexpectedly failed to submit.' );
                }
            },
            success( response ) {
                if ( DEBUG ) {
                    console.log( `%cRefund successfully requested for shipment ${params.id}`, debug.bold );
                }
                $( '#feedback' ).text( 'Refund request submitted' );
            }
        });
    });
});