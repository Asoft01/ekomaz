<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	@if (!empty($meta_title))
	<title>{{ $meta_title }}</title>
	@else
	<title>Laravel E-Commerce Website designed by A-Soft</title>
	@endif

	@if(!empty($meta_description))
	<meta name="description" content="{{ $meta_description }}">
	@else
	<meta name="description" content="This is the E-Commerce Website Designed from Scratch">
	@endif

	@if(!empty($meta_keywords))
		<meta name="keywords" content="{{ $meta_keywords }}">
	@else
		<meta name="keywords" content="buy product, get discounts">
	@endif
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}"/>

	@if(parse_url(url('/'), PHP_URL_SCHEME) == 'HTTPS')
        <link rel="stylesheet" href="{{ secure_asset('css/front_css/front.min.css') }}" media="screen">
        <link rel="stylesheet" href="{{ secure_asset('css/front_css/base.css') }}" media="screen">
        <link rel="stylesheet" href="{{ secure_asset('css/front_css/front-responsive.min.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('css/front_css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ secure_asset('js/front_js/js/google-code-prettify/prettify.css') }}">
        <link rel="shortcut icon" href="{{ secure_asset('images/front_images/ico/favicon.ico') }}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ secure_asset('images/front_images/ico/apple-touch-icon-144-precomposed.png') }}">
        <link rel="apple-touch-icon-precomposed"  sizes="72x72" href="{{ secure_asset('images/front_images/ico/apple-touch-icon-72-precomposed.png') }}">
        <link rel="apple-touch-icon-precomposed" href="{{ secure_asset('images/front_images/ico/apple-touch-icon-57-precomposed.png') }}">

    @else
		<!-- Front style -->
		<link id="callCss" rel="stylesheet" href="{{ url('css/front_css/front.min.css') }}" media="screen"/>
		<link href="{{ url('css/front_css/base.css') }}" rel="stylesheet" media="screen"/>
		<!-- Front style responsive -->
		<link href="{{ url('css/front_css/front-responsive.min.css') }}" rel="stylesheet"/>
		<link href="{{ url('css/front_css/font-awesome.css') }}" rel="stylesheet" type="text/css">
		<!-- Google-code-prettify -->
		<link href="{{ url('js/front_js/js/google-code-prettify/prettify.css') }}" rel="stylesheet"/>
		<!-- fav and touch icons -->
		<link rel="shortcut icon" href="{{asset('images/front_images/ico/favicon.ico') }}">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('images/front_images/ico/apple-touch-icon-144-precomposed.png') }}">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('images/front_images/ico/apple-touch-icon-114-precomposed.png') }}">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('images/front_images/ico/apple-touch-icon-72-precomposed.png') }}">
		<link rel="apple-touch-icon-precomposed" href="{{asset('images/front_images/ico/apple-touch-icon-57-precomposed.png') }}">
		
    @endif

	<style type="text/css" id="enject"></style>
	<style>
		form.cmxform label.error, label.error{
			/*remove the next line when you have trouble in IE6 with labels in list*/
			color: red;
			font-style: italic;
		}
	</style>
</head>
<body>

@include('layouts.front_layout.front_header')
<!-- Header End====================================================================== -->
@include('front.banners.home_page_banners');
<div id="mainBody">
	<div class="container">
		<div class="row">
            <!-- Sidebar ================================================== -->
            @include('layouts.front_layout.front_sidebar')
			
			<!-- Sidebar end=============================================== -->
			@yield('content')
		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
@include('layouts.front_layout.front_footer')

<!-- Placed at the end of the document so the pages load faster ============================================= -->

@if(parse_url(url('/'), PHP_URL_SCHEME) == 'HTTPS')
        <script src="{{ secure_asset('js/front_js/jquery.js') }}"></script>
        <script src="{{ secure_asset('js/front_js/jquery.validate.js') }}"></script>
        <script src="{{ secure_asset('js/front_js/front.min.js') }}"></script>
        <script src="{{ secure_asset('js/front_js/google-code-prettify/prettify.js') }}"></script>
		
        <script src="{{ secure_asset('js/front_js/front.js') }}"></script>
        <script src="{{ secure_asset('js/front_js/front_script.js') }}"></script>
        <script src="{{ secure_asset('js/front_js/jquery.lightbox-0.5.js') }}"></script>	

    @else
		<script src="{{ url('js/front_js/jquery.js') }}" type="text/javascript"></script>
		<script src="{{ url('js/front_js/jquery.validate.js') }}" type="text/javascript"></script>
		<script src="{{ url('js/front_js/front.min.js') }}" type="text/javascript"></script>
		<script src="{{ url('js/front_js/google-code-prettify/prettify.js') }}"></script>
		
		<script src="{{ url('js/front_js/front.js') }}"></script>
		<script src="{{ url('js/front_js/front_script.js') }}"></script>
		<script src="{{ url('js/front_js/jquery.lightbox-0.5.js') }}"></script>
    @endif 

</body>
</html>