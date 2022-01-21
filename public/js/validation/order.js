$(function () {
    $("#order-form").validate({
        rules: {
            receiver_name: {
                required: true,
                minlength: 2
            },
            receiver_number: {
                required: true,
                minlength: 2
            },
            receiver_email: {
                required: true,
                email: true
            },
            otp: {
                required: true,
            },
            shipping_address: {
                required: true,
            },
            shipping_area: {
                required: true,
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
