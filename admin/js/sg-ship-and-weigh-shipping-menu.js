let app = new Vue({
    el: '#root',
    data: {
        weight_type: 'pounds_and_ounces' // Or 'decimal_pounds'
    },
});

jQuery( $ => {
    $( '#recipient-name' ).select2({
        placeholder: 'Select or add a recipient',
        tags: true,
    });
});