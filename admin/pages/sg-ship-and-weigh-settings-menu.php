<div id="root" class="wrap">
    <form>
        <ul>
            <li>
                <label for="name">Name / Company</label>
                <input type="text" name="name" id="sender-name" v-model="sender.name">
            </li>
            <li>
                <label for="sender-street1">Address Line 1</label>
                <input type="text" name="sender-street1" id="sender-street1" v-model="sender.address.street1">
                <a id="address-feedback">{{ sender.address_feedback }}</a>
            </li>
            <li>
                <label for="sender-street2">Address Line 2</label>
                <input type="text" name="sender-street2" id="sender-street2" v-model="sender.address.street2">
            </li>
            <li>
                <label for="sender-city">City</label>
                <input type="text" name="sender-city" id="sender-city" v-model="sender.address.city">
            </li>
            <li>
                <label for="sender-state">State</label>
                <input type="text" name="sender-state" id="sender-state" v-model="sender.address.state">
            </li>
            <li>
                <label for="sender-zip">Postal Code</label>
                <input type="text" name="sender-zip" id="sender-zip" v-model="sender.address.zip">
            </li>
            <li>
                <label for="sender-country">Country</label>
                <select name="sender-country" id="sender-country">
                </select>
            </li>
        </ul>
    </form>
    <form id="settings-form">
        <ul>
            <li v-for="(setting_data, setting) in settings">
                <label :for="setting">{{ setting_data.name }}</label>
                <input :type="setting_data.html_type" v-model="setting_data.value" :name="setting" :id="setting">
            </li>
        </ul>
        <button type="submit" class="button button-primary">Submit</button>
    </form>
    <p>{{ feedback }}</p>
</div>