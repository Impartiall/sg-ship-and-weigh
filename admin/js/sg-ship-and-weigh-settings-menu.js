let app = new Vue( {
    el: '#root',
    data: {
        settings: SHIP_AND_WEIGH.settings_spec
    }
} );

jQuery( $ => {
    $.ajax( {
        method: 'GET',
        url: SHIP_AND_WEIGH.api.url,
        beforeSend: ( xhr ) => {
            xhr.setRequestHeader( 'X-WP-Nonce', SHIP_AND_WEIGH.api.nonce );
        },
    } ).then( ( response ) => {
        for ( let [setting, setting_data] of Object.entries(app.$data.settings) ) {
            if ( response.hasOwnProperty( setting ) ) {
                setting_data.value = response.setting;
            }
        }
    } )
} );