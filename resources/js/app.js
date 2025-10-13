//Core dependencies (jQuery first)
import $ from 'jquery';
window.$ = window.jQuery = $;

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

// CKEditor
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

//Bootstrap FileInput
import 'bootstrap-fileinput/css/fileinput.css';
import 'bootstrap-fileinput/js/fileinput.js';

//Custom Backend Assets
import "../css/custom-backend.css";
import "../js/custom-backend.js";
import "../toggleSwitch/toggle-switch.css";

//CK Editor
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.ckeditor').forEach(textarea => {
        ClassicEditor
            .create(textarea)
            .catch(error => {
                console.error(error);
            });
    });

    const triggerTabList = [].slice.call(document.querySelectorAll('#myTab a'));
    
    // Activate tab from URL hash on page load
    const hash = window.location.hash;
    if (hash) {
        const triggerEl = document.querySelector(`#myTab a[href="${hash}"]`);
        if (triggerEl) {
            const tab = new bootstrap.Tab(triggerEl);
            tab.show();
        }
    }

    // Update URL hash when tab is clicked
    triggerTabList.forEach(triggerEl => {
        triggerEl.addEventListener('shown.bs.tab', event => {
            history.replaceState(null, null, event.target.getAttribute('href'));
        });
    });
});


