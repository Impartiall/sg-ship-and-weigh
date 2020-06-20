let app = new Vue({
    el: '#root',
    data: {
        weight_type: 'pounds_and_ounces' // Or 'decimal_pounds'
    },
});

jQuery( $ => {
    $( '#recipient-name' ).select2({
        tags: true,
        data: {
             "results": [
                {
                    "id": 1,
                    "text": 'option1',
                },
                {
                    "id": 2,
                    "text": 'option2'
                },
             ]
        },
    });
});