$(function () {
    $("#product-form").validate({
        ignore: ".ignore",
        rules: {
            title: {
                required: true,
                minlength: 2
            },
            price: {
                required: true,
                minlength: 2
            },
            category_id: {
                required: true,
            },
            city: {
                required: true,
            },
            address: {
                required: true,
            },
            description: {
                required: true,
            },
            'images[]': {
                required: true,
                extension: "png|jpg"
            },
            map_address: {
                required: true,
            },
            map_lng_lat: {
                required: true,
            },
            starts_on: {
                required:  function(element) {
                    return $(`input[name='rate']`).val() !== "";
                }
            },
            ends_on: {
                required:  function(element) {
                    return $(`input[name='rate']`).val() !== "";
                }
            },
        },
        // messages: {
        //     first_name: {
        //         required: 'Enter your first name.',
        //         minlength: 'First name must be of at least {0} characters.',
        //     },
        //     last_name: {
        //         required: 'Enter your last name.',
        //     }
        // },
        errorElement: "div",
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col-12').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    })
})
