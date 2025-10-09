import '../../node_modules/jquery/dist/jquery.js';
import '../../node_modules/bootstrap/dist/css/bootstrap.css';
import '../../node_modules/bootstrap/dist/js/bootstrap.bundle.js';
import '../../node_modules/jquery-validation/dist/jquery.validate.js';
import '../../node_modules/admin-lte/dist/css/adminlte.css';
import '../../node_modules/admin-lte/dist/js/adminlte.js';
import '../../node_modules/admin-lte/dist/js/adminlte.js';
import '../../node_modules/@fortawesome/fontawesome-free/css/fontawesome.css';
import '../../node_modules/font-awesome/css/font-awesome.css';
import '../../node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js';
import '../../node_modules/bootstrap-icons/font/bootstrap-icons.css';
import '../../node_modules/bootstrap-icons/font/bootstrap-icons.css';
import '../../node_modules/bootstrap-fileinput/js/fileinput.js';
import '../../node_modules/bootstrap-fileinput/css/fileinput.css';
import "../css/custom-backend.css";
import "../js/custom-backend.js";
import "../toggleSwitch/toggle-switch.css";
import "../../node_modules/select2/dist/js/select2.js";
import "../../node_modules/select2/dist/css/select2.css";
import "../../node_modules/select2-bootstrap-5-theme/dist/select2-bootstrap-5-theme.css";

//CK Editor
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.ckeditor').forEach(textarea => {
        ClassicEditor
            .create(textarea)
            .catch(error => {
                console.error(error);
            });
    });

    $('.select2').select2({
        width: '100%',
        theme: 'bootstrap-5'

    });
});


