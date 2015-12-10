<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<!-- Title here -->
		<title>Metro Mania</title>
		<!-- Description, Keywords and Author -->
		<meta name="description" content="Your description">
		<meta name="keywords" content="Your,Keywords">
		<meta name="author" content="ResponsiveWebInc">
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		{!! Html::Style('css/app.css') !!}
		{!! Fluent::styles() !!}
		<style>
			.recent-additions {
				width: 150px;
			  white-space: nowrap;
			  overflow: hidden;
			  text-overflow: ellipsis;
			}

			header .logo h1 {
	    	font-size: 30px;
	    	line-height: 45px;
	    	margin-bottom: 5px;
			}

			form {
  margin: 0;
  padding: 0;
  border: 0;
  outline: 0;
  font-size: 100%;
  vertical-align: baseline;
  background: transparent;
  display: block;
  line-height: normal;
  color: #333;
}
.search_box {
  margin: 0px 0 0 0;
  padding: 0 0 0 0;
  position: relative;
  height: 45px;
}
#q {
  width: 200px;
  display: block;
  border: 1px solid #cfcfcf;
  color: #000;
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
  -webkit-appearance: none;
  padding: 10px 13px 10px 13px;
  line-height: 23px;
  float: left;
  font-size: 1em;
  background-color: white;
  -webkit-rtl-ordering: logical;
  -webkit-user-select: text;
  cursor: auto;
  margin: 0em;
  border-radius: 4px 0px 0px 4px;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-weight: 300;
}
::-webkit-input-placeholder { color: #9f9f9f; }
:-moz-placeholder { color: #9f9f9f; }
::-moz-placeholder { color: #9f9f9f;}
:-ms-input-placeholder {color: #9f9f9f;}

.search_box #q:focus {
  outline-width: 0px;
  border: 1px solid #999;
}
.search_box #q:hover {
  border: 1px solid #999;
}
.search_box_shadow {
  -webkit-box-shadow: 0px 0px 2px 0px #2E61E4;
    -moz-box-shadow: 0px 0px 2px 0px #2E61E4;
    box-shadow: 0px 0px 2px 0px #2E61E4;
}

.search_box .searchbutton {
  cursor: pointer;
  display: inline-block;
  padding: 0px;
  width: 56px;
  height: 43px;
  margin: 0px 0 0 -1px;
  border-top-right-radius: 4px;
  border-bottom-right-radius: 4px;
  background-color: #FFFFFF;
  border: 1px solid #2182CD;
  text-align: center;
  color: #5588AA;
}

[class^="icon-"], [class*=" icon-"] {
    display:inline-block;
    margin-top: 10px;
    vertical-align: middle;
}

.search_box .searchbutton:hover {
  background-color: white;
  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, white), color-stop(100%, #9ad9ff));
  background-image: -webkit-linear-gradient(top, white, #9ad9ff);
  background-image: linear-gradient(to bottom,white, #9ad9ff);
  box-shadow: inset 0 1px 0 #75C5E1
}
body {
  background-color: #ffffff;
}

.panel {
    width: 500px;
  margin-top: 10px;
  margin-left:auto;
  margin-right:auto;
    border: 1px solid #dddddd;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
          box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
}
.panel-heading {
  padding: 10px 15px;
  font-size: 1em;
  background-color: #00B3FF;
  border-bottom: 1px solid #dddddd;
  border-top-right-radius: 3px;
  border-top-left-radius: 3px;
}
.bg {
  background-color: #f3f3f3;
}
#hits {
  padding:5px 0px;
}
.hit {
  cursor: pointer;
  padding: 5px 15px;
}
.hit:hover {
  background-color: #e9f0ff;
}
.refined {
  font-weight: bold;
}
.excluded {
  text-decoration: line-through;
}
em {
  font-style: normal;
  font-weight: bold;
}
.grey {
  display: inline;
  color: #888;
}
body {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-weight: 300;
}

@media (max-width: 500px) {
  body {
    margin: 0px;
  }
  .panel {
    margin-top: 0px;
    width: 100%;
  }
  #q {
    width: -moz-calc(100% - 60px);
      width: -webkit-calc(100% - 60px);
      width: calc(100% - 60px);
  }
}
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
						<input type="text" class="form-control" id="q" placeholder="Type Something...">
					  </div>
					  <button type="submit" class="btn btn-default" id="searchSubmit">Search</button>
					</form>
				
			  </div>
			</div>
		  </div>
		</header>

		
		{{-- @include('layouts.nav') --}}
			{{-- <div class="col-md-12"> --}}
					<div id="searchContent" class="container hidden">
						<div class="row">
							<div class="container">
    						<ul id="pagination" class="pagination pull-left"></ul>
    					</div>
    				</div>
						<div class="row">
    					<div id="hits" class="col-md-7">
    		 			</div>
    					<div id="ads" class="col-md-4 pull-right">
    						<img src="http://placehold.it/350x150">
    					</div>
    				</div>
    				<div class="row">
    					<div class="container">
    						<ul id="pagination" class="pagination pull-left"></ul>
    					</div>
    				</div>
    			</div>
    		<div id="mainContent" class="container">
				@yield('content')
				</div>
			{{-- </div> --}}
			{{-- <div class="sidebar col-md-6">
				@yield('sidebar')
			</div> --}}
			@yield('footer')
			@include('layouts.footer')
			<!-- Footer -->
		 
			
			<script src="{{ asset('/js/vendor.js') }}"></script>
			
			<!--  Fluent::scripts() -->
			@include('layouts.scripts')
		</body>



















