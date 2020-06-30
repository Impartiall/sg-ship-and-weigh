<div id="root" class="wrap">
    <form id="shipping-form">
        <ul>
            <li>
                <label for="sender-address">Sender Info</label>
                <select name="sender-address" id="sender-address"></select>
            </li>
            <span id="recipient-address">
                <li>
                    <label for="name">Name / Company</label>
                    <select name="name" id="recipient-name"></select>

                    <button class="button button-secondary" id="add-recipient">Add to database</button>
                </li>
                <li>
                    <label for="recipient-street1">Address Line 1</label>
                    <input type="text" name="recipient-street1" id="recipient-street1" v-model="recipient.address.street1">
                </li>
                <li>
                    <label for="recipient-street2">Address Line 2</label>
                    <input type="text" name="recipient-street2" id="recipient-street2" v-model="recipient.address.street2">
                </li>
                <li>
                    <label for="recipient-country">Country / Territory</label>
                    <select name="recipient-country" id="recipient-country">
                    </select>
                </li>
                <li>
                    <label for="recipient-zip">Postal Code</label>
                    <input type="text" name="recipient-zip" id="recipient-zip" v-model="recipient.address.zip">
                </li>
                <li>
                    <label for="recipient-city">City / Town</label>
                    <input type="text" name="recipient-city" id="recipient-city" v-model="recipient.address.city">
                </li>
                <li>
                    <label for="recipient-state">State / Province / County</label>
                    <select name="recipient-state" id="recipient-state" v-model="recipient.address.state">
                    </select>
                </li>
            </span>
            <li>
                <label for="email">Email</label>
                <input type="email" name="email" id="recipient-email" v-model="recipient.email">
            </li>
            <li>
                <label>Weight Type</label>

                <input type="radio" name="weight-type" id="pounds-and-ounces" v-model="weight_type" value="pounds-and-ounces">
                <label for="pounds-and-ounces" class="suffix-label">Pounds & Ounces</label>
    
                <input type="radio" name="weight-type" id="decimal-pounds" v-model="weight_type" value="decimal-pounds">
                <label for="decimal-pounds" class="suffix-label">Decimal Pounds</label>
            </li>
            <li id="weight">
                <label>Weight</label>
                <span v-show="weight_type === 'pounds-and-ounces'">
                    <input type="number" name="weight" id="weight-pounds">
                    <label for="weight-pounds" class="suffix-label">lbs.</label>

                    <input type="number" name="weight" id="weight-ounces">
                    <label for="weight-ounces" class="suffix-label">oz.</label>
                </span>
                <span v-show="weight_type === 'decimal-pounds'">
                    <input type="number" name="weight" id="weight-decimal-pounds"></input>
                    <label for="weight-decimal-pounds" class="suffix-label">lbs.</label>
                </span>
                <span id="weigh-options">
                    <button class="button" id="weigh-button">Weigh</button>
                    <input type="checkbox" name="weigh-live" id="weigh-live">
                    <label class="suffix-label" for="weigh-live">Live update</label>
                </span>
            </li>
            <li>
                <label for="service">Service</label>
                <select name="service" id="service"></select>
            </li>
            <li>
                <label for="insurance">Insurance</label>
                <select name="insurance" id="insurance"></select>
            </li>
            <li>
                <label for="tracking">Tracking</label>
                <select name="tracking" id="tracking"></select>
            </li>
            <li>
                <label for="carrier">Carrier</label>
                <select name="carrier" id="carrier"></select>
            </li>
        </ul>
        <button type="submit" class="button button-primary">Submit</button>
    </form>
    <p>{{ feedback }}</p>
</div>