// registration
// $(`input[name='role']`).change(function () {
//     if ($(this).val() === 'seller') {
//         $('#business').toggleClass('d-none')
//     } else {
//         $('#business').toggleClass('d-none')
//     }
//     $(`label[for='role-seller']`).toggleClass('active');
//     $(`label[for='role-buyer']`).toggleClass('active');
// });

window.checkIfCustomerAcceptedPolices = function () {
    let submit = document.getElementById('customer_submit');
    let policy = document.getElementById('customer_policy');
    let terms = document.getElementById('customer_terms');

    console.log(policy)
    submit.disabled = !(policy.checked && terms.checked);
}

window.checkIfBusinessAcceptedPolices = function () {
    let submit = document.getElementById('business_submit');
    let policy = document.getElementById('business_policy');
    let terms = document.getElementById('business_terms');

    submit.disabled = !(policy.checked && terms.checked);
}
// end of registration

// verify email
$('#verify-email-btn').click(function (e) {

    if ($("#email").valid()) {
        let email = $('input[id="email"]').val();

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '/api/send-otp',
            type: 'POST',
            dataType: 'json',
            data: {
                'email': email
            },
            success: function (response) {

            },
            error: function (error) {

            }
        });
    }
});
// end of verify email

// verify email otp
$('#submit-btn').click(function (e) {
    e.preventDefault();
    verifyEmailOTP($(this).parents('form:first'))
});

function verifyEmailOTP(form) {
    let email = $('input[id="email"]').val();
    let otp = $('input[id="otp"]').val();

    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '/api/verify-otp',
        type: 'POST',
        dataType: 'json',
        data: {
            'email': email,
            'otp': otp,
        },
        success: function (response) {
            form.submit();
        },
        error: function (error) {
alert('Invalid OTP')
        }
    });
}

// end of verify email otp


$(function() {

    $(document).on({
        mouseover: function(event) {
            $(this).find('.far').addClass('star-over');
            $(this).prevAll().find('.far').addClass('star-over');
        },
        mouseleave: function(event) {
            $(this).find('.far').removeClass('star-over');
            $(this).prevAll().find('.far').removeClass('star-over');
        }
    }, '.rate');


    $(document).on('click', '.rate', function() {
        if ( !$(this).find('.star').hasClass('rate-active') ) {
            console.log($(this).siblings().find('.star'))
            $(this).siblings().find('.star').addClass('far').removeClass('fas rate-active');
            $(this).find('.star').addClass('rate-active fas').removeClass('far star-over');
            $(this).prevAll().find('.star').addClass('fas').removeClass('far star-over');
        } else {

        }
    });

});

$('#testForm').on('submit',function(e){
    e.preventDefault();
    console.log('her')
    var formData=$(this).serialize();
    var fullUrl = window.location.href;
    var finalUrl = fullUrl+"&"+formData;
    window.location.href = finalUrl;

})

// product
$(".new_arrival").owlCarousel({
    loop: true,
    autoplay: true,
    margin: 50,
    smartSpeed: 600,
    nav: false,
    dots: true,
    responsive: {
        0: {
            items: 1,
        },
        800: {
            items: 2,
        },
        1000: {
            items: 6,
        },
    },
});

// Mens fashion
$(".mens_fashion").owlCarousel({
    loop: true,
    autoplay: true,
    margin: 50,
    smartSpeed: 600,
    nav: false,
    dots: true,
    responsive: {
        0: {
            items: 1,
        },
        800: {
            items: 2,
        },
        1000: {
            items: 6,
        },
    },
});


var s = document.querySelectorAll(".garjoo_product_gallery");
if (s.length)
    for (
        var e = function(r) {
                for (var n = s[r].querySelectorAll(".garjoo_image_thumblist-item:not(.video-item)"), o = s[r].querySelectorAll(".garjoo_product_preview-item"), e = s[r].querySelectorAll(".garjoo_image_thumblist-item.video-item"), t = 0; t < n.length; t++)
                    n[t].addEventListener("click", a);

                function a(e) {
                    e.preventDefault();
                    for (var t = 0; t < n.length; t++) o[t].classList.remove("active"), n[t].classList.remove("active");
                    this.classList.add("active"), s[r].querySelector(this.getAttribute("href")).classList.add("active");
                }

            },
            t = 0; t < s.length; t++
    )
        e(t);
for (var e = document.querySelectorAll(".garjoo_image_zoom"), t = 0; t < e.length; t++) new Drift(e[t], { paneContainer: e[t].parentElement.querySelector(".garjoo_product_image_zoom") });
// allproducts owlCarousel
$('.relatedproducts').owlCarousel({
    loop: true,
    autoplay: true,
    margin: 20,
    smartSpeed: 600,
    nav: false,
    dots: true,
    responsive: {
        0: {
            items: 1
        },
        800: {
            items: 2
        },
        1000: {
            items: 6
        }
    }
});

// allproducts owlCarousel
$('.serv_inner').owlCarousel({
    loop: true,
    autoplay: true,
    margin: 20,
    smartSpeed: 600,
    nav: false,
    dots: true,
    responsive: {
        0: {
            items: 1
        },
        800: {
            items: 2
        },
        1000: {
            items: 6
        }
    }
});

// allproducts owlCarousel
$('.accomodationcarousel').owlCarousel({
    loop: true,
    autoplay: true,
    margin: 20,
    smartSpeed: 600,
    nav: false,
    dots: false,
    responsive: {
        0: {
            items: 1
        },
        800: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
});
$(document).ready(function() {
    $('a.nav-link.dropdown-toggle').click(function() {
        location.href = this.href;
    });
});

//mobile menu
$(document).ready(function() {

    $(".hs-menubar").hsMenu();

});


// list and grid view
$(document).ready(function() {
    $('#list').click(function(event) {
        event.preventDefault();
        $('#products .myitem').addClass('list-group-myitem');
    });
    $('#grid').click(function(event) {
        event.preventDefault();
        $('#products .myitem').removeClass('list-group-myitem');
        $('#products .myitem').addClass('grid-group-myitem');
    });
});
