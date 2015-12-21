<!DOCTYPE html>
<html lang="en"
			xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://ogp.me/ns/fb#"
      >
	<head>
	<meta property="og:title" content="StartupWrench :: Tools and resources for startups, as well as job listings, and more." />
	<meta property="og:image" content="{{ asset('/uploads/startupwrench-screenshot.png') }}" />
	<meta property="og:url" content="http://startupwrench.com/">
  <meta property="fb:app_id" content="{{ env('FB_CLIENT_ID') }}"/>
		<meta charset="utf-8">
		<!-- Title here -->
		<title>StartupWrench :: The Tools You Need To Succeed</title>
		<!-- Description, Keywords and Author -->
		<meta name="description" content="StartupWrench is a curated list of tools, resources, etc for startups.">
		<meta name="keywords" content="startups, startup tools, startup resources">
		<meta name="author" content="Patrick Curl">
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Oswald|Cabin|Signika|Quicksand|Rubik|Cutive|Baumans' rel='stylesheet' type='text/css'>
		{!! Html::Style('css/app.css') !!}
		{!! Fluent::styles() !!}
		
    <style>
      @include('layouts.partials.styles')
     @section('style')
      @show
    </style>
		@yield('head')
	</head>
	<body>

		<!-- Header Starts -->
		<header>
		  <div class="container">
			<div class="row">
			  <div class="col-md-4 col-sm-4">
				<div class="logo">
				  <h1><a href="{{ url('/') }}"><i class="fa fa-wrench"></i>Startup <span class="color">Wrench</span></a></h1>
				  <div class="hmeta">#1 curated list of startup tools and resources!</div>
				</div>
			  </div>
			  <div class="col-md-5 col-md-offset-3 col-sm-6 col-sm-offset-2">
				
					<form class="form-inline" role="form">
					  <div class="form-group">
						<input type="text" class="form-control" id="s" placeholder="Type Something...">
					  </div>
					  <button type="submit" class="btn btn-default" id="searchSubmit">Search</button>
					</form>
				
			  </div>
			</div>
		  </div>
		</header>

		
		@include('layouts.partials.nav')
    @section('content-top')
    @show
    @if(Session::has('message'))
    <div class="alert alert-info">
      {{Session::get('message')}}
    </div>
    @endif
		@if(Session::has('flash_notification.message'))
    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {{ Session::get('flash_notification.message') }}
    </div>
    @endif
    @include('layouts.partials.search')

    @if(isset($template) && $template)
    	@if($template == "wide")
      	@include("layouts.templates.wide")
      @elseif($template == "resource")
      	@include("layouts.templates.resource")
      @else
      	@include("layouts.templates.narrow")
      @endif
    @else
      @include("layouts.templates.narrow")
    @endif
    	     
			<a href="{{ url('/resource') }}/new" class="btn btn-primary" id="fixedbutton" >Add Resource</a>
			{{--  @yield('footer') --}}
			@include('layouts.partials.footer')
			<!-- Footer -->
		 	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-71554377-1', 'auto');
  ga('send', 'pageview');

</script>
			{!! Fluent::scripts() !!}
			<script src="{{ asset('/js/vendor.js') }}"></script>

			@include('layouts.partials.scripts')
			@section('custom_scripts')
			@show
		</body>



















