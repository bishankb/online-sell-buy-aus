@extends('layouts.backend')

@section('title')
  User
@endsection

@section('content')
    <div class="container-fluid">
        <!--begin::Col-->
        <div class="col-md-11">
            <!--begin::Quick Example-->
            <div class="card card-primary card-outline mb-4">
              <!--begin::Header-->
                <div class="card-header">
                    <div class="card-title">Edit User</div>
                    <div class="pull-right">
                        <a href="{{ route('users.index') }}" class="btn btn-success">Back to Listing</a>
                    </div>
                </div>
                <!--end::Header-->
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" id="basic-info-li">
                            <a class="nav-link active" data-bs-toggle="tab" href="#basic-info">Basic Information</a>
                        </li>
                        <li class="nav-item" id="profile-li">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile">Profile</a>
                        </li>
                        @if(Auth::user()->id == $user->id || Auth::user()->hasRole('admin'))
                            <li class="nav-item" id="change-password-li">
                                <a class="nav-link" id="change-password-tab" data-bs-toggle="tab" href="#change-password">Change Password</a>
                            </li>
                        @endif
                    </ul>
                    <div class="tab-content" style="margin-top: 10px;">
                        <div id="basic-info" class="container tab-pane active">
                            <form method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PATCH')
                                @include('backend.user._editForm')
                            </form>
                        </div>

                        <div id="profile" class="container tab-pane fade">
                            <form method="POST" action="{{ route('users.editProfile', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                                 @include('backend.user._editProfileForm')
                            </form>
                        </div>
                        @if(Auth::user()->id == $user->id || Auth::user()->hasRole('admin'))
                            <div id="change-password" class="container tab-pane fade">
                                <form method="POST" action="{{ route('users.changePassword', $user->id) }}">
                                @csrf
                                @method('PATCH')
                                     @include('backend.user._changePasswordForm')
                               </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('backend-script')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var tabLinks = document.querySelectorAll('.nav-link[data-bs-toggle="tab"]');

            tabLinks.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    var tabId = this.getAttribute('href'); // e.g., "#home-tab-pane"
                    window.location.hash = tabId; // Updates the URL with the tab's ID
                });
            });
            window.savedImage = $('.selected-img').attr('src');
        });
        
        function removeImage()
        {
            if (confirm('Are you sure you want to delete the image?')) {
                $('#input_image').val('');
                $('.image-margin').hide();
            }
        }
        
        

        function deleteImage(userId)
        {
            // Set CSRF token for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        
            this.selectedImage = $('.selected-img').attr('src');
            if (confirm('Are you sure you want to delete the image?')) {
                if(window.savedImage == this.selectedImage) {
                     $.ajax({
                        type     : "POST",
                        url      : `/admin/users/delete-image/${userId}`,
                        success: function(response){
                            if (response.success) {
                                $('#input_image').val('');
                                $('.show-image').hide();
                            }
                        },
                        error: function(data){
                            alert("There was some internal error while updating the status.");
                        },
                    });                    
                } else {
                    $('#input_image').val('');
                    $('.show-image').hide();
                }
            }
        }
    </script> 
@endsection
