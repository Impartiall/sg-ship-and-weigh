<div class="wrap">
    <form id="apex-form">
        <div>
            <label for="industry">
                <?php esc_html_e( 'Industry', 'text-domain' ); ?>
            </label>
            <input id="industry" type="text" />
        </div>
        <div>
            <label for="amount">
                <?php esc_html_e( 'Amount', 'text-domain' ); ?>
            </label>
            <input id="amount" type="number" min="0" max="100" />
        </div>
        <?php submit_button( __( 'Save', 'text-domain' ) ); ?>
    </form>
</div>