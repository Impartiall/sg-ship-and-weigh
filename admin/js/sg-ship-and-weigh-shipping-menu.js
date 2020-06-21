let app = new Vue({
    el: '#root',
    data: {
        weight_type: 'pounds_and_ounces' // Or 'decimal_pounds'
    },
});

jQuery( $ => {
    $( '#recipient-name' ).select2({
        placeholder: 'Select or add a recipient',
        tags: true,
        ajax: {
            url: SHIP_AND_WEIGH.api.recipients_url,
            type: 'GET',
            beforeSend: xhr => {
                xhr.setRequestHeader( 'X-WP-Nonce', SHIP_AND_WEIGH.api.nonce );
            },
            delay: 250,
            processResults: data => {
                return {
                    results: data,
                };
            },
        },
    });
});