require('./bootstrap')
require('./custom')

window.mapboxgl = require('mapbox-gl')
mapboxgl.accessToken = 'pk.eyJ1Ijoidm9sZ2FpdGVhbSIsImEiOiJja3JkMzV5cDQ1ODVuMzFxcHhoOGx2YzNuIn0.7WyeOKIW_QCz6eJlJqiItA';
import MapboxGeocoder from '@mapbox/mapbox-gl-geocoder';

window.MapboxGeocoder = MapboxGeocoder;

document.addEventListener("DOMContentLoaded", function () {

    //Prevent closing from click inside dropdown
    document.querySelectorAll('.dropdown-menu').forEach(function (element) {
        element.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    });

    // make it as accordion for smaller screens
    if (window.innerWidth < 992) {
        // close all inner dropdowns when parent is closed
        document.querySelectorAll('.navbar .dropdown').forEach(function (everydropdown) {
            everydropdown.addEventListener('hidden.bs.dropdown', function () {
                // after dropdown is hidden, then find all submenus
                this.querySelectorAll('.megasubmenu').forEach(function (everysubmenu) {
                    // hide every submenu as well
                    everysubmenu.style.display = 'none';
                });
            })
        });

        document.querySelectorAll('.has-submenu a').forEach(function (element) {
            element.addEventListener('click', function (e) {
                let nextEl = this.nextElementSibling;
                if (nextEl && nextEl.classList.contains('megasubmenu')) {
                    // prevent opening link if link needs to open dropdown
                    e.preventDefault();
                    if (nextEl.style.display == 'block') {
                        nextEl.style.display = 'none';
                    } else {
                        nextEl.style.display = 'block';
                    }
                }
            });
        }) // end foreach
    }
    // end if innerWidth
});
// DOMContentLoaded  end

// // tooltip
// $(function () {
//     $('[data-bs-toggle="tooltip"]').tooltip();
// });


let s = document.querySelectorAll(".garjoo_product_gallery");
if (s.length)
    for (
        let e = function (r) {
                for (let n = s[r].querySelectorAll(".garjoo_image_thumblist-item:not(.video-item)"), o = s[r].querySelectorAll(".garjoo_product_preview-item"), e = s[r].querySelectorAll(".garjoo_image_thumblist-item.video-item"), t = 0; t < n.length; t++)
                    n[t].addEventListener("click", a);

                function a(e) {
                    e.preventDefault();
                    for (let t = 0; t < n.length; t++) o[t].classList.remove("active"), n[t].classList.remove("active");
                    this.classList.add("active"), s[r].querySelector(this.getAttribute("href")).classList.add("active");
                }

            },
            t = 0; t < s.length; t++
    )
        e(t);
for (let e = document.querySelectorAll(".garjoo_image_zoom"), t = 0; t < e.length; t++) new Drift(e[t], {paneContainer: e[t].parentElement.querySelector(".garjoo_product_image_zoom")});


