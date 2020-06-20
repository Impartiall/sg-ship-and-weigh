let app = new Vue({
    el: '#root',
    data: {
        settings: SHIP_AND_WEIGH.settings_spec,
        feedback: '',
    }
});

jQuery( $ => {
    $.ajax({
        method: 'GET',
        url: SHIP_AND_WEIGH.api.url,
        beforeSend: ( xhr ) => {
            xhr.setRequestHeader( 'X-WP-Nonce', SHIP_AND_WEIGH.api.nonce );
        },
    }).then( response => {
            for ( let [ setting, setting_data ] of Object.entries( app.$data.settings ) ) {
                if ( response.hasOwnProperty( setting ) ) {
                    setting_data.value = response.setting;
                }
            }
    });

    $( '#settings-form' ).on( 'submit', e => {
        e.preventDefault();

        let data = {};
        for ( let [ setting, setting_data ] of Object.entries( app.$data.settings ) ) {
            data[setting] = setting_data.value;
        }
        console.log(data);

        $.ajax({
            method: 'POST',
            url: SHIP_AND_WEIGH.api.url,
            beforeSend: ( xhr ) => {
                xhr.setRequestHeader( 'X-WP-Nonce', SHIP_AND_WEIGH.api.nonce );
            },
            data: data,
            error: response => {
                app.$data.feedback = SHIP_AND_WEIGH.strings.error;
                if ( response.hasOwnProperty( 'message' ) ) {
                    app.$data.feedback = response.message;
                }
            },
        }).then( response => {
                app.$data.feedback = SHIP_AND_WEIGH.strings.saved;
        });
    });
});