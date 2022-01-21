$(function () {
    $("#switch-account-form").validate({
        rules: {
        
            company_name: {
                required: true
            },
            company_email: {
                required: true
            },
            company_number: {
                required: true
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
            element.closest('.form-floating').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    })
})
