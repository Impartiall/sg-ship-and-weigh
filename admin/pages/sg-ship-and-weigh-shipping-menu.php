<div id="root" class="wrap">
    <form id="shipping-form">
        <ul>
            <li id="recipient-address">
                <li>
                    <label for="sender-address">Sender Info</label>
                    <select name="sender-address" id="sender-address"></select>
                </li>
                <li>
                    <label for="name">Name / Company</label>
                    <select name="name" id="recipient-name"></select>

                    <button class="button button-secondary" id="add-recipient">Add to database</button>
                </li>
                <li>
                    <label for="recipient-line-1">Address Line 1</label>
                    <input type="text" name="recipient-line-1" id="recipient-line-1" v-model="recipient.address.line_1">
                </li>
                <li>
                    <label for="recipient-line-2">Address Line 2</label>
                    <input type="text" name="recipient-line-2" id="recipient-line-2" v-model="recipient.address.line_2">
                </li>
                <li>
                    <label for="recipient-line-3">Address Line 3</label>
                    <input type="text" name="recipient-line-3" id="recipient-line-3" v-model="recipient.address.line_3">
                </li>
                <li>
                    <label for="recipient-country">Country</label>
                    <select name="recipient-country" id="recipient-country">
                    </select>
                </li>
                <li>
                    <label for="recipient-postal">Postal Code</label>
                    <input type="text" name="recipient-postal" id="recipient-postal" v-model="recipient.address.postal">
                </li>
                <li>
                    <label for="recipient-city-town">City / Town</label>
                    <input type="text" name="recipient-city-town" id="recipient-city-town" v-model="recipient.address.city_town">
                </li>
                <li>
                    <label for="recipient-state-province-county">State / Province / County</label>
                    <select name="recipient-state-province-county" id="recipient-state-province-county" v-model="recipient.address.city_town">
                    </select>
                </li>
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