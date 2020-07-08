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

            },
            success( response ) {
                $( '#feedback' ).text( 'Refund request submitted' );
            }
        });
    });
});