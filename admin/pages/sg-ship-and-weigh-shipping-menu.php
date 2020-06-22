<div id="root" class="wrap">
    <form id="shipping-form">
        <ul>
            <li>
                <label for="sender-address">Sender Info</label>
                <select name="sender-address" id="sender-address"></select>
            </li>
            <li>
                <label for="recipient-name">Recipient</label>
                <select name="recipient-name" id="recipient-name"></select>

                <button class="button button-secondary" id="add-recipient">Add to database</button>
            </li>
            <li>
                <label for="recipient-country">Recipient Country</label>
                <select name="recipient-country" id="recipient-country">
                    <option></option>
                </select>
            </li>
            <li>
                <label for="recipient-address">Recipient Address</label>
                <textarea name="recipient-address" id="recipient-address" v-model="recipient.address"></textarea>
            </li>
            <li>
                <label for="recipient-email">Recipient Email</label>
                <input type="email" name="recipient-email" id="recipient-email" v-model="recipient.email">
            </li>
            <li>
                <label>Weight Type</label>

                <input type="radio" name="weight-type" id="pounds-and-ounces" v-model="weight_type" value="pounds-and-ounces">
                <label for="pounds-and-ounces" class="suffix-label">Pounds & Ounces</label>
    
                <input type="radio" name="weight-type" id="decimal-pounds" v-model="weight_type" value="decimal-pounds">
                <label for="decimal-pounds" class="suffix-label">Decimal Pounds</label>
            </li>
            <li>
                <label>Weight</label>
                <div v-show="weight_type === 'pounds-and-ounces'">
                    <input type="number" name="weight" id="weight-pounds">
                    <label for="weight-pounds" class="suffix-label">lbs.</label>

                    <input type="number" name="weight" id="weight-ounces">
                    <label for="weight-ounces" class="suffix-label">oz.</label>
                </div>
                <div v-show="weight_type === 'decimal-pounds'">
                    <input type="number" name="weight" id="weight-decimal-pounds"></input>
                    <label for="weight-decimal-pounds" class="suffix-label">lbs.</label>
                </div>
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
</div>