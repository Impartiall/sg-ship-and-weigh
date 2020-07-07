const DEBUG = SHIP_AND_WEIGH.debug;
const debug = {};
if ( DEBUG ) {
    debug.bold = 'font-weight: bold;';
}

const countries = [{"id":"AF","text":"Afghanistan"},{"id":"AX","text":"Aland Islands"},{"id":"AL","text":"Albania"},{"id":"DZ","text":"Algeria"},{"id":"AS","text":"American Samoa"},{"id":"AD","text":"Andorra"},{"id":"AO","text":"Angola"},{"id":"AI","text":"Anguilla"},{"id":"AQ","text":"Antarctica"},{"id":"AG","text":"Antigua And Barbuda"},{"id":"AR","text":"Argentina"},{"id":"AM","text":"Armenia"},{"id":"AW","text":"Aruba"},{"id":"AU","text":"Australia"},{"id":"AT","text":"Austria"},{"id":"AZ","text":"Azerbaijan"},{"id":"BS","text":"Bahamas"},{"id":"BH","text":"Bahrain"},{"id":"BD","text":"Bangladesh"},{"id":"BB","text":"Barbados"},{"id":"BY","text":"Belarus"},{"id":"BE","text":"Belgium"},{"id":"BZ","text":"Belize"},{"id":"BJ","text":"Benin"},{"id":"BM","text":"Bermuda"},{"id":"BT","text":"Bhutan"},{"id":"BO","text":"Bolivia"},{"id":"BA","text":"Bosnia And Herzegovina"},{"id":"BW","text":"Botswana"},{"id":"BV","text":"Bouvet Island"},{"id":"BR","text":"Brazil"},{"id":"IO","text":"British Indian Ocean Territory"},{"id":"BN","text":"Brunei Darussalam"},{"id":"BG","text":"Bulgaria"},{"id":"BF","text":"Burkina Faso"},{"id":"BI","text":"Burundi"},{"id":"KH","text":"Cambodia"},{"id":"CM","text":"Cameroon"},{"id":"CA","text":"Canada"},{"id":"CV","text":"Cape Verde"},{"id":"KY","text":"Cayman Islands"},{"id":"CF","text":"Central African Republic"},{"id":"TD","text":"Chad"},{"id":"CL","text":"Chile"},{"id":"CN","text":"China"},{"id":"CX","text":"Christmas Island"},{"id":"CC","text":"Cocos (Keeling) Islands"},{"id":"CO","text":"Colombia"},{"id":"KM","text":"Comoros"},{"id":"CG","text":"Congo"},{"id":"CD","text":"Congo, Democratic Republic"},{"id":"CK","text":"Cook Islands"},{"id":"CR","text":"Costa Rica"},{"id":"CI","text":"Cote D\"Ivoire"},{"id":"HR","text":"Croatia"},{"id":"CU","text":"Cuba"},{"id":"CY","text":"Cyprus"},{"id":"CZ","text":"Czech Republic"},{"id":"DK","text":"Denmark"},{"id":"DJ","text":"Djibouti"},{"id":"DM","text":"Dominica"},{"id":"DO","text":"Dominican Republic"},{"id":"EC","text":"Ecuador"},{"id":"EG","text":"Egypt"},{"id":"SV","text":"El Salvador"},{"id":"GQ","text":"Equatorial Guinea"},{"id":"ER","text":"Eritrea"},{"id":"EE","text":"Estonia"},{"id":"ET","text":"Ethiopia"},{"id":"FK","text":"Falkland Islands (Malvinas)"},{"id":"FO","text":"Faroe Islands"},{"id":"FJ","text":"Fiji"},{"id":"FI","text":"Finland"},{"id":"FR","text":"France"},{"id":"GF","text":"French Guiana"},{"id":"PF","text":"French Polynesia"},{"id":"TF","text":"French Southern Territories"},{"id":"GA","text":"Gabon"},{"id":"GM","text":"Gambia"},{"id":"GE","text":"Georgia"},{"id":"DE","text":"Germany"},{"id":"GH","text":"Ghana"},{"id":"GI","text":"Gibraltar"},{"id":"GR","text":"Greece"},{"id":"GL","text":"Greenland"},{"id":"GD","text":"Grenada"},{"id":"GP","text":"Guadeloupe"},{"id":"GU","text":"Guam"},{"id":"GT","text":"Guatemala"},{"id":"GG","text":"Guernsey"},{"id":"GN","text":"Guinea"},{"id":"GW","text":"Guinea-Bissau"},{"id":"GY","text":"Guyana"},{"id":"HT","text":"Haiti"},{"id":"HM","text":"Heard Island & Mcdonald Islands"},{"id":"VA","text":"Holy See (Vatican City State)"},{"id":"HN","text":"Honduras"},{"id":"HK","text":"Hong Kong"},{"id":"HU","text":"Hungary"},{"id":"IS","text":"Iceland"},{"id":"IN","text":"India"},{"id":"ID","text":"Indonesia"},{"id":"IR","text":"Iran, Islamic Republic Of"},{"id":"IQ","text":"Iraq"},{"id":"IE","text":"Ireland"},{"id":"IM","text":"Isle Of Man"},{"id":"IL","text":"Israel"},{"id":"IT","text":"Italy"},{"id":"JM","text":"Jamaica"},{"id":"JP","text":"Japan"},{"id":"JE","text":"Jersey"},{"id":"JO","text":"Jordan"},{"id":"KZ","text":"Kazakhstan"},{"id":"KE","text":"Kenya"},{"id":"KI","text":"Kiribati"},{"id":"KR","text":"Korea"},{"id":"KW","text":"Kuwait"},{"id":"KG","text":"Kyrgyzstan"},{"id":"LA","text":"Lao People\"s Democratic Republic"},{"id":"LV","text":"Latvia"},{"id":"LB","text":"Lebanon"},{"id":"LS","text":"Lesotho"},{"id":"LR","text":"Liberia"},{"id":"LY","text":"Libyan Arab Jamahiriya"},{"id":"LI","text":"Liechtenstein"},{"id":"LT","text":"Lithuania"},{"id":"LU","text":"Luxembourg"},{"id":"MO","text":"Macao"},{"id":"MK","text":"Macedonia"},{"id":"MG","text":"Madagascar"},{"id":"MW","text":"Malawi"},{"id":"MY","text":"Malaysia"},{"id":"MV","text":"Maldives"},{"id":"ML","text":"Mali"},{"id":"MT","text":"Malta"},{"id":"MH","text":"Marshall Islands"},{"id":"MQ","text":"Martinique"},{"id":"MR","text":"Mauritania"},{"id":"MU","text":"Mauritius"},{"id":"YT","text":"Mayotte"},{"id":"MX","text":"Mexico"},{"id":"FM","text":"Micronesia, Federated States Of"},{"id":"MD","text":"Moldova"},{"id":"MC","text":"Monaco"},{"id":"MN","text":"Mongolia"},{"id":"ME","text":"Montenegro"},{"id":"MS","text":"Montserrat"},{"id":"MA","text":"Morocco"},{"id":"MZ","text":"Mozambique"},{"id":"MM","text":"Myanmar"},{"id":"NA","text":"Namibia"},{"id":"NR","text":"Nauru"},{"id":"NP","text":"Nepal"},{"id":"NL","text":"Netherlands"},{"id":"AN","text":"Netherlands Antilles"},{"id":"NC","text":"New Caledonia"},{"id":"NZ","text":"New Zealand"},{"id":"NI","text":"Nicaragua"},{"id":"NE","text":"Niger"},{"id":"NG","text":"Nigeria"},{"id":"NU","text":"Niue"},{"id":"NF","text":"Norfolk Island"},{"id":"MP","text":"Northern Mariana Islands"},{"id":"NO","text":"Norway"},{"id":"OM","text":"Oman"},{"id":"PK","text":"Pakistan"},{"id":"PW","text":"Palau"},{"id":"PS","text":"Palestinian Territory, Occupied"},{"id":"PA","text":"Panama"},{"id":"PG","text":"Papua New Guinea"},{"id":"PY","text":"Paraguay"},{"id":"PE","text":"Peru"},{"id":"PH","text":"Philippines"},{"id":"PN","text":"Pitcairn"},{"id":"PL","text":"Poland"},{"id":"PT","text":"Portugal"},{"id":"PR","text":"Puerto Rico"},{"id":"QA","text":"Qatar"},{"id":"RE","text":"Reunion"},{"id":"RO","text":"Romania"},{"id":"RU","text":"Russian Federation"},{"id":"RW","text":"Rwanda"},{"id":"BL","text":"Saint Barthelemy"},{"id":"SH","text":"Saint Helena"},{"id":"KN","text":"Saint Kitts And Nevis"},{"id":"LC","text":"Saint Lucia"},{"id":"MF","text":"Saint Martin"},{"id":"PM","text":"Saint Pierre And Miquelon"},{"id":"VC","text":"Saint Vincent And Grenadines"},{"id":"WS","text":"Samoa"},{"id":"SM","text":"San Marino"},{"id":"ST","text":"Sao Tome And Principe"},{"id":"SA","text":"Saudi Arabia"},{"id":"SN","text":"Senegal"},{"id":"RS","text":"Serbia"},{"id":"SC","text":"Seychelles"},{"id":"SL","text":"Sierra Leone"},{"id":"SG","text":"Singapore"},{"id":"SK","text":"Slovakia"},{"id":"SI","text":"Slovenia"},{"id":"SB","text":"Solomon Islands"},{"id":"SO","text":"Somalia"},{"id":"ZA","text":"South Africa"},{"id":"GS","text":"South Georgia And Sandwich Isl."},{"id":"ES","text":"Spain"},{"id":"LK","text":"Sri Lanka"},{"id":"SD","text":"Sudan"},{"id":"SR","text":"Suriname"},{"id":"SJ","text":"Svalbard And Jan Mayen"},{"id":"SZ","text":"Swaziland"},{"id":"SE","text":"Sweden"},{"id":"CH","text":"Switzerland"},{"id":"SY","text":"Syrian Arab Republic"},{"id":"TW","text":"Taiwan"},{"id":"TJ","text":"Tajikistan"},{"id":"TZ","text":"Tanzania"},{"id":"TH","text":"Thailand"},{"id":"TL","text":"Timor-Leste"},{"id":"TG","text":"Togo"},{"id":"TK","text":"Tokelau"},{"id":"TO","text":"Tonga"},{"id":"TT","text":"Trinidad And Tobago"},{"id":"TN","text":"Tunisia"},{"id":"TR","text":"Turkey"},{"id":"TM","text":"Turkmenistan"},{"id":"TC","text":"Turks And Caicos Islands"},{"id":"TV","text":"Tuvalu"},{"id":"UG","text":"Uganda"},{"id":"UA","text":"Ukraine"},{"id":"AE","text":"United Arab Emirates"},{"id":"GB","text":"United Kingdom"},{"id":"US","text":"United States"},{"id":"UM","text":"United States Outlying Islands"},{"id":"UY","text":"Uruguay"},{"id":"UZ","text":"Uzbekistan"},{"id":"VU","text":"Vanuatu"},{"id":"VE","text":"Venezuela"},{"id":"VN","text":"Vietnam"},{"id":"VG","text":"Virgin Islands, British"},{"id":"VI","text":"Virgin Islands, U.S."},{"id":"WF","text":"Wallis And Futuna"},{"id":"EH","text":"Western Sahara"},{"id":"YE","text":"Yemen"},{"id":"ZM","text":"Zambia"},{"id":"ZW","text":"Zimbabwe"}];
const currencies = {"USD":"$","CAD":"CA$","EUR":"€","AED":"AED","AFN":"Af","ALL":"ALL","AMD":"AMD","ARS":"AR$","AUD":"AU$","AZN":"man.","BAM":"KM","BDT":"Tk","BGN":"BGN","BHD":"BD","BIF":"FBu","BND":"BN$","BOB":"Bs","BRL":"R$","BWP":"BWP","BYN":"Br","BZD":"BZ$","CDF":"CDF","CHF":"CHF","CLP":"CL$","CNY":"CN¥","COP":"CO$","CRC":"₡","CVE":"CV$","CZK":"Kč","DJF":"Fdj","DKK":"Dkr","DOP":"RD$","DZD":"DA","EEK":"Ekr","EGP":"EGP","ERN":"Nfk","ETB":"Br","GBP":"£","GEL":"GEL","GHS":"GH₵","GNF":"FG","GTQ":"GTQ","HKD":"HK$","HNL":"HNL","HRK":"kn","HUF":"Ft","IDR":"Rp","ILS":"₪","INR":"Rs","IQD":"IQD","IRR":"IRR","ISK":"Ikr","JMD":"J$","JOD":"JD","JPY":"¥","KES":"Ksh","KHR":"KHR","KMF":"CF","KRW":"₩","KWD":"KD","KZT":"KZT","LBP":"LB£","LKR":"SLRs","LTL":"Lt","LVL":"Ls","LYD":"LD","MAD":"MAD","MDL":"MDL","MGA":"MGA","MKD":"MKD","MMK":"MMK","MOP":"MOP$","MUR":"MURs","MXN":"MX$","MYR":"RM","MZN":"MTn","NAD":"N$","NGN":"₦","NIO":"C$","NOK":"Nkr","NPR":"NPRs","NZD":"NZ$","OMR":"OMR","PAB":"B/.","PEN":"S/.","PHP":"₱","PKR":"PKRs","PLN":"zł","PYG":"₲","QAR":"QR","RON":"RON","RSD":"din.","RUB":"RUB","RWF":"RWF","SAR":"SR","SDG":"SDG","SEK":"Skr","SGD":"S$","SOS":"Ssh","SYP":"SY£","THB":"฿","TND":"DT","TOP":"T$","TRY":"TL","TTD":"TT$","TWD":"NT$","TZS":"TSh","UAH":"₴","UGX":"USh","UYU":"$U","UZS":"UZS","VEF":"Bs.F.","VND":"₫","XAF":"FCFA","XOF":"CFA","YER":"YR","ZAR":"R","ZMK":"ZK","ZWL":"ZWL$"}

let data = {
    shipment: {
        from_address: {},
        to_address: {
            uuid: '',
            name: '',
            company: '',
            email: '',
            street1: '',
            street2: '',
            city: '',
            state: '',
            zip: '',
            country: '',
        },
        parcel: {
            weight: 0.0,
        },
        rate: {
            service: '',
            carrier: '',
            rate: '',
        },
        insurance: '',
    },
    pounds_and_ounces: {
        wholePounds: 0,
        remainderOunces: 0,
    },
    decimalPounds: 0,
    address_feedback: '',
    weight_mode: 'pounds_and_ounces',
    feedback: '',
};

jQuery.ajax({
    method: 'GET',
    url: SHIP_AND_WEIGH.api.url.settings,
    beforeSend( xhr ) {
        xhr.setRequestHeader( 'X-WP-Nonce', SHIP_AND_WEIGH.api.nonce );
    },
    error( response ) {
        if ( DEBUG ) {
            console.log( '%cAn error occured while retrieving settings', debug.bold );
            console.log( response.message );
        }
    },
    success( response ) {
        if ( DEBUG ) {
            console.log( '%cSuccesfully retrieved settings', debug.bold );
            console.log( response.message );
        };

        data.weight_mode = response.default_weight_mode;
        data.shipment.from_address = response.from_address;
    },
});

const defaultAddress = JSON.parse( JSON.stringify( data.shipment.to_address ) );

const updateAddressFeedback = address => {
    if ( address.verifications.delivery.success ) {
        for ( [ field, value ] of Object.entries( data.shipment.to_address ) ) {

            // Only display suggestion if current address does not match
            // BUG: Sugestion shows up once again after using it
            if ( value !== address[ field ] ) {
                data.address_feedback = addressToString( address );

                $feedback = jQuery( '#address-feedback' );
                $feedback.off( 'click' );
                $feedback.on( 'click', () => {
                    data.address_feedback = '';
                    data.shipment.to_address = address;
                });
            }
        }

    } else {
        data.address_feedback = address.verifications.delivery.errors[ 0 ].message;
    }
};

const addressToString = ({ name, street1, street2, city, state, zip, country }, showName = false) => {
    let address = `${ showName && name ? name + ', ' : '' }`;
    if ( street1 ) {
        address += street1;
    }
    for ( field of [ street2, city, state, zip, country ] ) {
        if ( field ) {
            address += ', ' + field;
        }
    }

    return address;
}

const rateToElement = ({ carrier, service, rate, currency, delivery_days, delivery_date_guaranteed }) => {
    let $rate = jQuery(`<div class="rate"></div>`);
    let $rateInfo = jQuery(`<div>
        <span class="service">${ service }</span> - <span class="carrier">${ carrier }</span> <span class="rate">${ currencies[ currency ] } ${ rate }</span>
    </div>`);
    let $rateDelivery = jQuery(`<div class="delivery">
        <span>${delivery_days}-Day Delivery</span> <span>${ delivery_date_guaranteed ? 'Guaranteed' : '' }</span>
    </div>`);

    $rate.append( $rateInfo );

    if ( delivery_days ) {
        $rate.append( $rateDelivery );
    }

    return $rate;
}

jQuery( $ => {
    let app = new Vue({
        el: '#root',
        data: data,
        watch: {
            'shipment.to_address.country'( country ) {
                recipientCountryControl.setValue( country );
            },
            'shipment.to_address': {
                deep: true,
                handler() {
                    verifyAddress();
                },
            },
            // Continuously update parcel weight
            decimalPounds( pounds ) {
                this.shipment.parcel.weight = parseFloat( pounds ) * 16;
            },
            // Continuously update decimal pounds
            pounds_and_ounces: {
                deep: true,
                handler( weight ) {
                    this.decimalPounds = (
                        parseInt( weight.wholePounds )
                        + parseFloat( weight.remainderOunces) / 16
                    ).toFixed( 6 );
                },
            },
            // Update pounds and ounces on mode switch
            weight_mode( mode ) {
                // If mode is switched to pounds-and-ounces
                if ( mode === "pounds-and-ounces" ) {
                    this.pounds_and_ounces.wholePounds = Math.floor( parseFloat( this.decimalPounds ) );

                    totalOunces = parseFloat( this.decimalPounds ) * 16;
                    this.pounds_and_ounces.remainderOunces = ( totalOunces % 16 ).toFixed( 2 );
                }
            },
            'shipment.to_address': {
                deep: true,
                handler() {
                    // Reload rates when form updates
                    rateControl.load(getRates);
                },
            },
            'shipment.parcel': {
                deep: true,
                handler() {
                    // Reload rates when form updates
                    rateControl.load(getRates);
                },
            },
        },
        computed: {
            from_address_string() {
                return addressToString( this.shipment.from_address, showName = true );
            },
        },
    });

    const recipientNameLoad = ( query, callback ) => {
        recipientNameControl.clearOptions();
        
        if ( DEBUG ) {
            console.log( '%cGetting options for #recipient-name', debug.bold );
        }
        
        $.ajax({
            method: 'GET',
            url: SHIP_AND_WEIGH.api.url.recipients,
            beforeSend( xhr ) {
                xhr.setRequestHeader( 'X-WP-Nonce', SHIP_AND_WEIGH.api.nonce );
            },
            error( response ) {
                callback();

                // TODO: display feedback

                if ( DEBUG ) {
                    console.log( '%cAn error occured while getting options for #recipient-name', debug.bold );
                    console.log( response.message );
                }
            },
            success( data ) {
                callback( data );

                // TODO: display feedback

                if ( DEBUG ) {
                    console.log( '%cOptions retrieved successfully for #recipient-name', debug.bold );
                    console.table( data );
                }
            },
        });
    }
    const recipientNameReload = () => {
        recipientNameControl.clearOptions();
        recipientNameControl.load( ( callback ) => {
            recipientNameLoad( null, callback );
        });
    }

    let $recipientNameSelect = $( '#recipient-name' ).selectize({
        preload: true,
        create: true,
        persist: false,
        labelField: 'name',
        valueField: 'uuid',
        searchField: 'name',
        render: {
            item( item, escape ) {
                let $option = $(`<div>
                    <span class="label">${ escape( item.name.toLowerCase() ) }</span>
                </div>`);
                let $description = $(
                    `<span class="value">${ escape( addressToString( item ) ) }</span>`
                );

                if ( item.uuid ) {

                    $option.append( $description );
                }

                return $option;
            },
            option( item, escape ) {
                let $option = $(`<div>
                    <span class="label">${ escape( item.name.toLowerCase() ) }</span>
                </div>`);
                let $description = $(
                    `<span class="value">${ escape( addressToString( item ) ) }</span>`
                );
                let $removeButton = $(
                    `<span class="deleteButton dashicons dashicons-no"></span>`
                );

                if ( item.uuid ) {
                    $removeButton.on( 'mousedown', e => {
                        e.stopPropagation();

                        removeRecipient( item.uuid ).then( recipientNameReload );
                    });

                    $option.append( $description );
                    $option.append( $removeButton );
                }

                return $option;
            },
        },
        create( input, callback ) {
            callback({ uuid: "", name: input });
        },
        load: recipientNameLoad,
        onChange( value ) {
            let recipient = recipientNameControl.options[ value ];
            if ( DEBUG ) {
                console.log( '%c#recipient-name selected:', debug.bold );
                console.log( recipient );
            }

            if ( recipient ) {
                data.shipment.to_address = recipient;
            }

            if ( DEBUG ) {
                console.log( '%cSet recipient data', debug.bold );
                console.log( data.shipment.to_address );
            }
        },
    });
    let recipientNameControl = $recipientNameSelect[ 0 ].selectize;

    let $recipientCountrySelect = $( '#recipient-country' ).selectize({
        labelField: 'text',
        valueField: 'id',
        searchField: [ 'text' ],
        options: countries,
        render: {
            item( item, escape ) {
                return `<div>
                    <span class="label">${ escape( item.text ) }</span>
                </div>`;
            },
            option( item, escape ) {
                return `<div>
                    <span class="label">${ escape( item.text ) }</span>
                </div>`;
            },
        },
        onChange( value ) {
            data.shipment.to_address.country = value;

            if ( DEBUG ) {
                console.log( `%cSet recipient country to '${ value }'`, debug.bold );
                console.log( data.shipment.to_address );
            }
        }
    });
    let recipientCountryControl = $recipientCountrySelect[ 0 ].selectize;

    let $rateSelect = $( '#rate' ).selectize({
        valueField: 'rate',
        searchField: [ 'service', 'carrier' ],
        render: {
            item( item, escape ) {
                return rateToElement( item );
            },
            option( item, escape ) {
                return rateToElement( item );
            },
        },
        score( search ) {
            let score = this.getScoreFunction( search );
            let maxRate = Math.max( ...Object.keys( rateControl.options ) );
            return ( item ) => {
                isMatch = score( item ) > 0
                if ( !isMatch ) return 0;
                return maxRate - parseFloat( item.rate );
            };
        },
        onChange( value ) {
            data.shipment.rate = rateControl.options[ value ];

            if ( DEBUG ) {
                console.log( `%cSet shipment rate to '${ value }'`, debug.bold );
                console.log( data.shipment.rate );
            }
        },
        onLoad() {
            let minRate = Math.min( ...Object.keys( rateControl.options ) );
            rateControl.setValue( minRate );
        },
    });
    let rateControl = $rateSelect[ 0 ].selectize;

    const getRates = callback => {
        if ( DEBUG ) {
            console.log( '%cGetting rates', debug.bold );
            console.log( data.shipment );
        }
    
        jQuery.ajax({
            method: 'GET',
            url: SHIP_AND_WEIGH.api.url.rates,
            beforeSend( xhr ) {
                xhr.setRequestHeader( 'X-WP-Nonce', SHIP_AND_WEIGH.api.nonce );
            },
            data: {
                shipment: data.shipment,
            },
            error( response ) {
                if ( DEBUG ) {
                    console.log( '%cAn error occurred while retrieving shipment rates', debug.bold );
                    console.log( response.responseJSON );
                }
                
                callback();
            },
            success( response ) {
                if ( DEBUG ) {
                    console.log( '%cSuccessfully loaded rates:', debug.bold );
                    console.log( response );
                }

                rateControl.clearOptions();
                callback( response );
            },
        });
    };

    $( '#add-recipient' ).on( 'click', e => {
        e.preventDefault();

        // Remove old recipient if new one has a uuid
        if ( data.shipment.to_address.uuid ) {
            removeRecipient( uuid );
        }

        addRecipient( data.shipment.to_address ).then( recipientNameReload );
    });

    $( '#shipping-form' ).on( 'submit', e => {
        e.preventDefault();

        $.ajax({
            method: 'POST',
            url: SHIP_AND_WEIGH.api.url.buy_shipment,
            beforeSend( xhr ) {
                xhr.setRequestHeader( 'X-WP-Nonce', SHIP_AND_WEIGH.api.nonce );
            },
            data: {
                from_address: data.shipment.from_address,
                to_address: data.shipment.to_address,
                parcel: data.shipment.parcel,
                rate: data.shipment.rate,
                insurance: data.shipment.insurance,
            },
            error( response ) {
                if ( DEBUG ) {
                    console.log( '%cAn error occurred while submitting the form', debug.bold );
                    console.log( response.message );
                }
            },
            success( response ) {
                if ( DEBUG ) {
                    console.log( 'Redirecting...' );
                }

                window.location.href = SHIP_AND_WEIGH.shipping_confirmation_url
                                     + '&x=5';
            },
        });
    });
});

const verifyAddress = () => {
    if ( DEBUG ) {
        console.log( '%cVerifying address', debug.bold );
        console.log( data.shipment.to_address );
    }

    jQuery.ajax({
        method: 'GET',
        url: SHIP_AND_WEIGH.api.url.address_verification,
        beforeSend( xhr ) {
            xhr.setRequestHeader( 'X-WP-Nonce', SHIP_AND_WEIGH.api.nonce );
        },
        data: {
            'address': data.shipment.to_address
        },
        error( response ) {
            if ( DEBUG ) {
                console.log( '%cAn error ocurred while verifying recipeint address: ', debug.bold );
                console.log( response );
            }
        },
        success( response ) {
            if ( DEBUG ) {
                console.log( '%cSuccesfully verified address', debug.bold );
                console.log( response );
            }

            updateAddressFeedback( response );
        }
    });
};

const addRecipient = recipient => {
    let address = {
        ...recipient,
        uuid: uuidv4(),
    };

    if ( DEBUG ) {
        console.log( '%cAdding recipient', debug.bold );
        console.log( data );
    }

    return jQuery.ajax({
        method: 'POST',
        url: SHIP_AND_WEIGH.api.url.recipients,
        beforeSend( xhr ) {
            xhr.setRequestHeader( 'X-WP-Nonce', SHIP_AND_WEIGH.api.nonce );
        },
        data: {
            to_address: address,
        },
        error( response ) {
            // TODO: display feedback

            if ( DEBUG ) {
                console.log( `%cAn error occured while adding recipient with uuid ${ uuid }`, debug.bold );
                console.log( response.message );
            }

            return Promise.resolve();
        },
        success( response ) {
            // TODO: display feedback

            if ( DEBUG ) {
                console.log( '%cRecipient added successfully', debug.bold );
            }

            return Promise.resolve();
        }
    });
}

const removeRecipient = uuid => {
    if ( DEBUG ) {
        console.log( `%cRemoving recipient ${ uuid }`, debug.bold );
    }

    return jQuery.ajax({
        method: 'DELETE',
        url: SHIP_AND_WEIGH.api.url.recipients,
        beforeSend( xhr ) {
            xhr.setRequestHeader( 'X-WP-Nonce', SHIP_AND_WEIGH.api.nonce );
        },
        data: {
            uuid: uuid,
        },
        error( response ) {
            // TODO: display message

            if ( DEBUG ) {
                console.log( `%cAn error occured while removing recipient with uuid ${ uuid }`, debug.bold );
                console.log( response.message );
            }

            return Promise.resolve();
        },
        success( response ) {
            // TODO: display feedback

            // Update dropdown

            if ( DEBUG ) {
                console.log( '%cRecipient removed successfully', debug.bold );
            }

            return Promise.resolve();
        }
    });
};