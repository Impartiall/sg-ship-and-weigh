<div id="root" class="wrap">
    <form>
        <ul>
            <li v-for="(setting_data, setting) in settings">
                <label :for="setting">{{ setting_data.name }}</label>
                <input :type="setting_data.html_type" :value="setting_data.value">
            </li>
            <li>
                <label for="x"> Test</label>
                <input type="text">
            </li>
            <li>
                <label for="y">test area</label>
                <textarea name="y" id="" cols="30" rows="10"></textarea>
            </li>
        </ul>
        <button type="submit" class="button button-primary">Submit</button>
    </form>
</div>