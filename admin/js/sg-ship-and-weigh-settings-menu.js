const DEBUG = SHIP_AND_WEIGH.debug;
const debug = {};
if ( DEBUG ) {
    debug.bold = 'font-weight: bold;';
}

let data = {
    sender: {
        name: '',
        address: {
            street1: '',
            street2: '',
            city: '',
            state: '',
            zip: '',
            country: '',
        },
        address_feedback: '',
    },
    settings: SHIP_AND_WEIGH.settings_spec,
    feedback: '',
};

const defaultAddress = JSON.parse( JSON.stringify( data.sender.address ) );

const verifyAddress = () => {
    let requestData = {
        name: data.sender.name,
        ...data.sender.address,
    }

    if ( DEBUG ) {
        console.log( '%cVerifying address', debug.bold );
        console.log( requestData );
    }

    jQuery.ajax({
        method: 'GET',
        url: SHIP_AND_WEIGH.api.url.address_verification,
        beforeSend: xhr => {
            xhr.setRequestHeader( 'X-WP-Nonce', SHIP_AND_WEIGH.api.nonce );
        },
        data: requestData,
        error: response => {
            if ( DEBUG ) {
                console.log( '%cAn error ocurred while verifying recipeint address: ', debug.bold );
                console.log( response );
            }
        },
        success: response => {
            if ( DEBUG ) {
                console.log( '%cSuccesfully verified address', debug.bold );
                console.log( response );
            }

            updateAddressFeedback( response );
        }
    });
};

const updateAddressFeedback = address => {
    if ( address.verifications.delivery.success ) {
        for ( [ field, value ] of Object.entries( data.sender.address ) ) {
            // Only display suggestion if current address does not match
            if ( value !== address[ field ] ) {
                data.sender.address_feedback = formatAddressAsReadable( address );

                $feedback = jQuery( '#address-feedback' );
                $feedback.off( 'click' );
                $feedback.on( 'click', () => {
                    data.sender.address_feedback = '';
                    setSenderAddress( address );
                });
            }
        }

    } else {
        data.sender.address_feedback = address.verifications.delivery.errors[ 0 ].message;
    }
};

const formatAddressAsReadable = ({ street1, street2, city, state, zip, country }) => {
    return `${ street1 }, ${ street2 ? street2 + ', ' : '' } ${ city }, ${ state }, ${ zip }, ${ country }`;
}

const setSenderAddress = address => {
    // Default address to its original state
    for ( [ key, value ] of Object.entries( defaultAddress ) ) {
        data.sender.address[ key ] = address[ key ] || value;
    }
};

jQuery( $ => {
    let app = new Vue({
        el: '#root',
        data: data,
        watch: {
            sender: {
                deep: true,
                handler() {
                    verifyAddress();
                },
            },
        },
    });

    $.ajax({
        method: 'GET',
        url: SHIP_AND_WEIGH.api.url.settings,
        beforeSend: xhr => {
            xhr.setRequestHeader( 'X-WP-Nonce', SHIP_AND_WEIGH.api.nonce );
        },
    }).then( response => {
            for ( let [ setting, setting_data ] of Object.entries( data.settings ) ) {
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
            url: SHIP_AND_WEIGH.api.url.settings,
            beforeSend: xhr => {
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