document.addEventListener('DOMContentLoaded', function () {
    $('div.alert').not('.alert-important').delay(3000).fadeOut(1000);

    

    $('.image-margin').hide();

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();             
            reader.onload = function (e) {
                $('.selected-img').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#input_image").change(function(){
        $('.selected-img').addClass('custom-thumbnail');
        $('.image-margin').show();
        $('.show-image').show();
        readURL(this);
    });
});


