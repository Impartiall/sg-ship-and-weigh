<div id="root" class="wrap">
    <form id="shipping-form">
        <ul>
            <li>
                <label for="sender-address">From</label>
                <p name="sender-address" id="sender-address">{{ from_address_string }}</p>
            </li>
            <span id="recipient-address">
                <li>
                    <label for="name">Name / Company</label>
                    <select name="name" id="recipient-name"></select>

                    <button class="button button-secondary" id="add-recipient">Save</button>
                </li>
                <li>
                    <label for="recipient-street1">Address Line 1</label>
                    <input type="text" name="recipient-street1" id="recipient-street1" v-model="shipment.to_address.street1">
                    <a id="address-feedback">{{ address_feedback }}</a>
                </li>
                <li>
                    <label for="recipient-street2">Address Line 2</label>
                    <input type="text" name="recipient-street2" id="recipient-street2" v-model="shipment.to_address.street2">
                </li>
                <li>
                    <label for="recipient-city">City</label>
                    <input type="text" name="recipient-city" id="recipient-city" v-model="shipment.to_address.city">
                </li>
                <li>
                    <label for="recipient-state">State</label>
                    <input type="text" name="recipient-state" id="recipient-state" v-model="shipment.to_address.state">
                </li>
                <li>
                    <label for="recipient-zip">Postal Code</label>
                    <input type="text" name="recipient-zip" id="recipient-zip" v-model="shipment.to_address.zip">
                </li>
                <li>
                    <label for="recipient-country">Country</label>
                    <select name="recipient-country" id="recipient-country">
                    </select>
                </li>
            </span>
            <li>
                <label for="email">Email</label>
                <input type="email" name="email" id="recipient-email" v-model="shipment.to_address.email">
            </li>
            <li>
                <label>Weight Mode</label>

                <input type="radio" name="weight-mode" id="pounds-and-ounces" v-model="weight_mode" value="pounds-and-ounces">
                <label for="pounds-and-ounces" class="suffix-label">Pounds & Ounces</label>
    
                <input type="radio" name="weight-mode" id="decimal-pounds" v-model="weight_mode" value="decimal-pounds">
                <label for="decimal-pounds" class="suffix-label">Decimal Pounds</label>
            </li>
            <li id="weight">
                <label>Weight</label>
                <span v-show="weight_mode === 'pounds-and-ounces'">
                    <input type="text" name="weight" id="weight-pounds" v-model="pounds_and_ounces.wholePounds">
                    <label for="weight-pounds" class="suffix-label">lbs.</label>

                    <input type="text" name="weight" id="weight-ounces" v-model="pounds_and_ounces.remainderOunces">
                    <label for="weight-ounces" class="suffix-label">oz.</label>
                </span>
                <span v-show="weight_mode === 'decimal-pounds'">
                    <input type="text" name="weight" id="weight-decimal-pounds" v-model="decimalPounds"></input>
                    <label for="weight-decimal-pounds" class="suffix-label">lbs.</label>
                </span>
                <span id="weigh-options">
                    <button class="button" id="weigh-button">Weigh</button>
                    <input type="checkbox" name="weigh-live" id="weigh-live">
                    <label class="suffix-label" for="weigh-live">Live update</label>
                </span>
            </li>
            <li>
                <label for="insurance">Insurance</label>
                <input type="text" name="insurance" id="insurance" v-model="shipment.insurance">
            </li>
            <li>
                <label for="rate">Service / Carrier / Rate</label>
                <select name="rate" id="rate"></select>
            </li>
        </ul>
        <button id="form-submit" type="submit" class="button button-primary">Submit</button>
    </form>
    <p>{{ feedback }}</p>
</div>