<!DOCTYPE html>
<html>
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="shortcut icon" href="{{ asset('/images/logo.png') }}">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
  <link href="{{ mix('/css/frontend.css') }}" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.4/jquery.fancybox.min.css">
  <!-- Linking style and js -->
  @vite(['resources/css/app.css', 'resources/js/frontend-app.js'])

  @yield('frontend-style')
  
</head>

<body> 
	
  @include('frontend.partials.navbar')

  <div class="container screen-sm">
   <div class="content">
    
    @yield('content')
    
    <div class="clearfix"> </div>

  </div>
</div>

@include('frontend.partials.footer')

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<script src="{{ mix('/js/frontend.js') }}"></script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.4/jquery.fancybox.pack.min.js"></script>


@yield('frontend-script')

<script type="text/javascript">
  $(function() {
   var menu_ul = $('.menu > li > ul'),
   menu_a  = $('.menu > li > a');
   menu_ul.hide();
   menu_a.click(function(e) {
     if(!$(this).hasClass('active')) {
       menu_a.removeClass('active');
       menu_ul.filter(':visible').slideUp('normal');
       $(this).addClass('active').next().stop(true,true).slideDown('normal');
     } else {
       $(this).removeClass('active');
       $(this).next().stop(true,true).slideUp('normal');
     }
   });
   
 });

  @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
      case 'success':
      toastr.success("{{ Session::get('message') }}");
      break;
      
      case 'info':
      toastr.info("{{ Session::get('message') }}");
      break;

      case 'warning':
      toastr.warning("{{ Session::get('message') }}");
      break;

      case 'error':
      toastr.error("{{ Session::get('message') }}");
      break;
    }
  @endif
  
</script>
</body>
</html>


