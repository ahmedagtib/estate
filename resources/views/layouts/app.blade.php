<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>{{$metatitle  ??  config('helper.metatitle') }}</title>
		<meta name="description" content="{{$metadescription ??  config('helper.metadescription') }}">
		<meta name="keywords" content="{{$metakeyword  ??  config('helper.metakeyword')  }}">
		<meta name="author" content="{{ config('helper.author') }}"> 
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<link rel="shortcut icon" href="/favicon.ico">
		@yield('meta')
		<link rel="stylesheet" href="{{asset('css/plugins.css')}}"/>
		<link rel="stylesheet" href="{{asset('css/nav.css')}}" />
        <link rel="stylesheet" href="{{asset('css/styles.css')}}"/>
		<link rel="stylesheet" href="{{asset('css/colors.css')}}" />
		<!--   
		<link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}" />
		-->
		<link rel="stylesheet" href="{{asset('css/toastr.min.css')}}" />

		@yield('style')
		@livewireStyles
		
		
</head>
<body class="{{ Request::routeIs('blog') ? 'blog-page purple-skin' : 'purple-skin' }}"> 
	<div id="preloader"><div class="preloader"><span></span><span></span></div></div>
		
    <div id="main-wrapper">
          <!-- Start Navigation -->
          @livewire('navbar')
          <!-- End Navigation -->
		  <div class="clearfix"></div>
           @yield('content')
         
         @include('layouts.footer')
    </div>

	<script src="{{asset('js/jquery.min.js')}}"></script>
	<script src="{{asset('js/popper.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<!--
	<script src="{{asset('js/rangeslider.js')}}"></script>
	<script src="{{asset('js/slider-bg.js')}}"></script>
	-->
	<script src="{{asset('js/aos.js')}}"></script>
	<script src="{{asset('js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('js/slick.js')}}"></script>
	
	<script src="{{asset('js/lightbox.js')}}"></script> 
	<script src="{{asset('js/imagesloaded.js')}}"></script>
	<script src="{{asset('js/isotope.min.js')}}"></script>
	<script src="{{asset('js/coreNavigation.js')}}"></script>
	<script src="{{asset('js/custom.js')}}"></script>
	<script src="{{asset('js/cl-switch.js')}}"></script>
	<script src="{{asset('js/toastr.min.js')}}"></script>
	<script>
	    var route      = "{{route('save.token')}}"; 
	    var csrf_token = "{{ csrf_token() }}"; 
	    var apiKey     =  "{{Config('helper.firebase_apiKey')}}";
        var authDomain =  "{{Config('helper.firebase_authDomain')}}";
        var projectId  =  "{{Config('helper.firebase_projectId')}}";
        var storageBucket = "{{Config('helper.firebase_storageBucket')}}";
        var messagingSenderId = "{{Config('helper.firebase_messagingSenderId')}}";
        var appId = "{{Config('helper.firebase_appId')}}";
        var vapidKey = "{{Config('helper.firebase_vapidKey')}}";
	</script>
	<script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-app.js"></script>
	<script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-messaging.js"></script>
	<script src="{{asset('index/index.js')}}"></script>
 	@yield('scripts')
	<script>
		@if(Session::has('message'))
		toastr.options =
		{
			"closeButton" : true,
			"progressBar" : true
		}
				toastr.success("{{ session('message') }}");
		@endif
	  
		@if(Session::has('error'))
		toastr.options =
		{
			"closeButton" : true,
			"progressBar" : true
		}
				toastr.error("{{ session('error') }}");
		@endif
	  
		@if(Session::has('info'))
		toastr.options =
		{
			"closeButton" : true,
			"progressBar" : true
		}
				toastr.info("{{ session('info') }}");
		@endif
	  
		@if(Session::has('warning'))
		toastr.options =
		{
			"closeButton" : true,
			"progressBar" : true
		}
				toastr.warning("{{ session('warning') }}");
		@endif
	  </script>
   
   @yield('script')

	@livewireScripts

	
	<a id="back2Top" class="top-scroll" title="Back to top" href="#" style="display: inline;"><i class="ti-arrow-up"></i></a>

</body>
</html>