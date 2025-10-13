//Bootstrap
import 'bootstrap/dist/css/bootstrap.css';
import * as bootstrap from 'bootstrap';

//jQuery Validation
import 'jquery-validation/dist/jquery.validate.min.js';

//AdminLTE
import 'admin-lte/dist/css/adminlte.css';
import 'admin-lte/dist/js/adminlte.js';

//FontAwesome
import '@fortawesome/fontawesome-free/css/fontawesome.css';
import 'font-awesome/css/font-awesome.css';
import 'bootstrap-icons/font/bootstrap-icons.css';

//Toastr
import 'toastr/build/toastr.min.css';
import toastr from 'toastr';
window.toastr = toastr;
toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: 'toast-top-right',
};

// CKEditor
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

//Custom Backend Assets
import "../css/custom-backend.css";
import "../js/custom-backend.js";

//Toggle Switch
import "../toggleSwitch/toggle-switch.css";

//Custom Frontend Assets
import "../frontend-template/css/style.css";
import "../frontend-template/css/custom.css";
import "../frontend-template/js/custom.js";

//CK Editor
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.ckeditor').forEach(textarea => {
        ClassicEditor
            .create(textarea)
            .catch(error => {
                console.error(error);
            });
    });

    //Featured Product Flexisel
    $("#featuredProductSlider").flexisel({
        visibleItems: 4,
        itemsToScroll: 2,
        animationSpeed: 800,
        infinite: true,
        navigationTargetSelector: null,
        autoPlay: {
            enable: true,
            interval: 3000,
            pauseOnHover: true
        },
        responsiveBreakpoints: {
            portrait: { 
                changePoint:480,
                visibleItems: 1,
                itemsToScroll: 1
            },
            landscape: { 
                changePoint:640,
                visibleItems: 2,
                itemsToScroll: 2
            },
            tablet: { 
                changePoint:821,
                visibleItems: 3,
                itemsToScroll: 3
            }
        },
    });

    //Related Product Flexisel
    $("#relatedProductSlider").flexisel({
        visibleItems: 4,
        itemsToScroll: 2,
        animationSpeed: 800,
        infinite: true,
        navigationTargetSelector: null,
        autoPlay: {
            enable: true,
            interval: 3000,
            pauseOnHover: true
        },
        responsiveBreakpoints: { 
            portrait: { 
                changePoint:480,
                visibleItems: 1,
                itemsToScroll: 1
            }, 
            landscape: { 
                changePoint:640,
                visibleItems: 2,
                itemsToScroll: 2
            },
            tablet: { 
                changePoint:821,
                visibleItems: 3,
                itemsToScroll: 3
            }
        },
    });
});




