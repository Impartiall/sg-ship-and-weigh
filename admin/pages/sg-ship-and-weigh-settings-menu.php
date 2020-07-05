<div id="root" class="wrap">
    <form id="settings-form">
        <ul>
            <li>
                <label for="name">Name / Company</label>
                <input type="text" name="name" id="sender-name" v-model="from_address.name">
            </li>
            <li>
                <label for="sender-street1">Address Line 1</label>
                <input type="text" name="sender-street1" id="sender-street1" v-model="from_address.street1">
                <a id="address-feedback">{{ address_feedback }}</a>
            </li>
            <li>
                <label for="sender-street2">Address Line 2</label>
                <input type="text" name="sender-street2" id="sender-street2" v-model="from_address.street2">
            </li>
            <li>
                <label for="sender-city">City</label>
                <input type="text" name="sender-city" id="sender-city" v-model="from_address.city">
            </li>
            <li>
                <label for="sender-state">State</label>
                <input type="text" name="sender-state" id="sender-state" v-model="from_address.state">
            </li>
            <li>
                <label for="sender-zip">Postal Code</label>
                <input type="text" name="sender-zip" id="sender-zip" v-model="from_address.zip">
            </li>
            <li>
                <label for="sender-country">Country</label>
                <select name="sender-country" id="sender-country">
                </select>
            </li>
            <li>
                <label>Default Weight Mode</label>

                <input type="radio" name="default-weight-mode" id="pounds-and-ounces" v-model="default_weight_mode" value="pounds-and-ounces">
                <label for="pounds-and-ounces" class="suffix-label">Pounds & Ounces</label>
    
                <input type="radio" name="default-weight-mode" id="decimal-pounds" v-model="default_weight_mode" value="decimal-pounds">
                <label for="decimal-pounds" class="suffix-label">Decimal Pounds</label>
            </li>
        </ul>

        <button type="submit" class="button button-primary">Submit</button>
    </form>
    <p>{{ feedback }}</p>
</div>