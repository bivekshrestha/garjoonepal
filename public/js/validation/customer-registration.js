$(function () {
    $("#customer-registration-form").validate({
        rules: {
            first_name: {
                required: true,
                minlength: 2
            },
            last_name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                required: true,
                equalTo: '#customer_password'
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
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    })
})
