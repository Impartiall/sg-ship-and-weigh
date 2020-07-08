<div id="shipping-confirmation" class="wrap">
    <h1>Shipment Info</h1>


    <div class="info-link">
        <h2>Tracking</h2>
        <a id="tracking-url" target="_blank">Click to view<span class="dashicons dashicons-external"></span></a>
    </div>
    <div class="info-link">
        <h2>Postage Label</h2>
        <a id="label-url" target="_blank">Click to view<span class="dashicons dashicons-external"></span></a>
    </div>


    <button id="refund" class="button button-primary">Refund Shipment</button>

    <script>
        const params = <?php echo json_encode( $_GET, JSON_HEX_TAG | JSON_UNESCAPED_SLASHES ); ?>;
    </script>
</div>