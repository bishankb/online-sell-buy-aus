<!DOCTYPE html>
<html>
<head>
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="{{ asset('favicon1.png') }}">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css">
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
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>


@yield('frontend-script')

<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function () {
    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @elseif (session('error'))
        toastr.error("{{ session('error') }}");
    @elseif (session('info'))
        toastr.info("{{ session('info') }}");
    @elseif (session('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif  
  });

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

</script>
</body>
</html>


