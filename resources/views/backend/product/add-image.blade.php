@extends('layouts.backend')

@section('title')
    Product
@endsection

@section('content')
    <div class="container-fluid">
        <!--begin::Col-->
        <div class="col-md-11">
            <!--begin::Quick Example-->
            <div class="card card-primary card-outline mb-4">
              <!--begin::Header-->
                <div class="card-header">
                    <div class="card-title">
                        Manage Images <span style="font-size: 15px; color: red;">(Do not forget to press upload button after selecting a photo)</span>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('products.index') }}" class="btn btn-success">Back to Listing</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="file-loading">
                            <input id="multiple_input_image"
                                   type="file"
                                   name="product_image"
                                   multiple
                                   class="file"
                                   accept="image/*">
                        </div>
                    </div>
                </div>
                <!--begin::Footer-->
                <div class="card-footer">
                    <a href="{{ route('products.index') }}" class="btn btn-success">Finish</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('backend-script')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            let productId = {{ $product->id }};
            let productImagesUrls = {!! json_encode($productImagesUrls) !!}; // array of image URLs
            let productImagesInformations = {!! json_encode($productImagesInformations) !!}; // array of configs

            $("#multiple_input_image").fileinput({
                theme: "fa",
                uploadUrl: "{{ route('products.saveImages', $product->id) }}",
                uploadAsync: true, // upload individually
                uploadExtraData: {_token: "{{ csrf_token() }}"},
                deleteExtraData: {_token: "{{ csrf_token() }}"},
                allowedFileExtensions: ["jpg", "jpeg", "png", "gif"],
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
