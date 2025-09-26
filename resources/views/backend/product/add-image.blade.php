@extends('layouts.backend')

@section('title')
    Product
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Manage Images <span style="font-size: 15px; color: red;">(Do not forget to press upload button after selecting a photo)</span></h3>
                        <div class="pull-right">
                            <a href="{{ route('products.index') }}" class="btn btn-success">Back to Listing</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="file-loading">
                                <input id="multiple_input_image" type="file" name="product_image" multiple class="file" data-overwrite-initial="false" accept="image/*">
                            </div>
                        </div>
                        <div class="box-footer">    
                            <a href="{{ route('products.index') }}" class="btn btn-success">Finish</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('backend-script')
    <script type="text/javascript">

        var productImagesUrls = {!! json_encode($productImagesUrls) !!};
        var productImagesInformations = {!! json_encode($productImagesInformations) !!};

        $("#multiple_input_image").fileinput({
            theme: 'fa',
            uploadUrl: "{{route('products.saveImages', $productId)}}",
            autoOrientImage: true,
            uploadAsync: false,
            uploadExtraData: function() {
                return {
                    _token: $("input[name='_token']").val(),
                };
            },
            allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
            overwriteInitial: false,
            maxFileSize:10240,
            slugCallback: function (filename) {
                return filename.replace('(', '_').replace(']', '_');
            },
            'showUpload': false,
            'showRemove': false,
            fileActionSettings: {
                showDrag: false
            },
            initialPreview:  productImagesUrls,
            initialPreviewConfig: productImagesInformations,
            initialPreviewAsData: true,
            deleteExtraData: {_token: $("[name='_token']").val()}
        })

        $("#multiple_input_image").on("filepredelete", function(jqXHR) {
            var abort = true;
            if (confirm("Are you sure you want to delete this image?")) {
                abort = false;
            }
            return abort;
        });
    </script>
@endsection
