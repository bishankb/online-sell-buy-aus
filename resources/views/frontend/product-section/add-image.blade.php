@extends('layouts.frontend')

@section('content')
    <div class="card sell-product-panel">
        <div class="card-header text-center">
            <h3><i class="fa fa-shopping-cart" style="margin-right: 12px;"></i>Manage Images</h3>
        </div>
        <div class="card-body">
            <h5><strong>Note: </strong>Manage your images <span style="font-size: 13px;">(Do not forget to press upload button after selecting a photo)</span></h5>
            <div class="form-group">
                <div class="file-loading">
                    <input id="multiple_input_image" type="file" name="product_image" multiple class="file" data-overwrite-initial="false" accept="image/*">
                </div>
            </div>
        </div>
        <div class="card-footer" style="background: #fff;">
            <a href="{{ route('frontend.home') }}" class="btn btn-success save-btn">Finish
                <i class="fa fa-check"></i>
            </a>
        </div>
    </div>
@endsection

@section('frontend-script')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            let productId = {{ $product->id }};
            let productImagesUrls = {!! json_encode($productImagesUrls) !!}; // array of image URLs
            let productImagesInformations = {!! json_encode($productImagesInformations) !!}; // array of configs

            $("#multiple_input_image").fileinput({
                theme: "fa",
                uploadUrl: "{{ route('product-section.saveImages', $product->id) }}",
                uploadAsync: true, // upload individually
                uploadExtraData: {_token: "{{ csrf_token() }}"},
                deleteExtraData: {_token: "{{ csrf_token() }}"},
                allowedFileExtensions: ["jpg", "jpeg", "png", "gif", "heic"],
                overwriteInitial: false,
                showUpload: false,
                showRemove: false,
                browseOnZoneClick: true,
                maxFileSize: 10240,
                initialPreview: productImagesUrls,
                initialPreviewConfig: productImagesInformations,
                initialPreviewAsData: true,
                fileActionSettings: {
                    showUpload: true,
                    showRemove: true,
                    showZoom: true,
                    showDrag: false
                }
            });

            $("#multiple_input_image").on("filepredelete", function(jqXHR) {
                var abort = true;
                if (confirm("Are you sure you want to delete this image?")) {
                    abort = false;
                }
                return abort;
            });
        });
    </script>
@endsection
