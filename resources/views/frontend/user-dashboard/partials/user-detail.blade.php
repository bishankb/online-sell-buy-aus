<div class="col-xs-12 text-center">
    <div class="img-input-wrap">
         @if(isset( Auth::user()->profile->image->filename))
            <img src="/storage/media/user/{{ Auth::user()->id }}/{{ Auth::user()->profile->image->filename }}" alt="User Image" class="profile-user-img">
          @else
            <img src="{{asset('frontend-template/img/no-image.jpg')}}" alt="User Image" class="profile-user-img">
          @endif
    </div>
</div>
<div class="col-xs-12 text-center">
    <h4 class="profile-username">
        {{ Auth::user()->name }}
    </h4>

    <h4 class="text-muted" style="font-size: 13px;">
        {{ Auth::user()->email }}
    
    </h4>
</div>