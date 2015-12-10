<div class="social-links">
		  <div class="container">
			<div class="row">
			  <div class="col-md-12">
				<p class="big"><span>Follow Us On</span> 
				<a href="https://www.facebook.com/startupwrench/">
					<i class="fa fa-facebook"></i>Facebook
				</a> 
				<a href="http://twitter.com/startupwrench">
					<i class="fa fa-twitter"></i>Twitter
				</a> 
	{{-- 			<a href="#"><i class="fa fa-google-plus"></i>Google Plus</a> 
				<a href="#"><i class="fa fa-linkedin"></i>LinkedIn</a></p> --}}
			  </div>
			</div>    
		  </div>
		</div>
<footer>
		  <div class="container">
			<div class="row">

			  <div class="widgets">
				{{-- <div class="col-md-4">
				  <div class="fwidget">

					<div class="col-l">
					  <h6>Downlaods</h6>
					  <ul>
						<li><a href="#">Condimentum</a></li>
						<li><a href="#">Etiam at</a></li>
						<li><a href="#">Fusce vel</a></li>
						<li><a href="#">Vivamus</a></li>
						<li><a href="#">Pellentesque</a></li>
					  </ul>
					</div>

					<div class="col-r">
					  <h6>Support</h6>
					  <ul>
						<li><a href="#">Condimentum</a></li>
						<li><a href="#">Etiam at</a></li>
						<li><a href="#">Fusce vel</a></li>
						<li><a href="#">Vivamus</a></li>
						<li><a href="#">Pellentesque</a></li>
					  </ul>
					</div>

				  </div>
				</div> --}}

				{{-- <div class="col-md-4">
				  <div class="fwidget">
					<h6>Categories</h6>
					<ul>
					  <li><a href="#">Condimentum - Condimentum gravida</a></li>
					  <li><a href="#">Etiam at - Condimentum gravida</a></li>
					  <li><a href="#">Fusce vel - Condimentum gravida</a></li>
					  <li><a href="#">Vivamus - Condimentum gravida</a></li>
					  <li><a href="#">Pellentesque - Condimentum gravida</a></li>
					</ul>
				  </div>
				</div> --}}

				<div class="col-md-12">
				  <div class="fwidget">
					
					@if($latest)
						<h6>Recent Additions</h6>
						<ol class="list-group row">
							<?php $count = 1; ?>
							@foreach($latest as $resource)
							<li class="list-group-item col-xs-6 recent-additions"><a href='{{ url("/resources/{$resource->slug}") }}'>{{ $count }}. {{ $resource->name }}</a></li>
							<?php $count++; ?>
							@endforeach
						</ol>
					@endif
					{{-- <ul>
					  <li><a href="#">Sed eu leo orci, condimentum gravida metus</a></li>
					  <li><a href="#">Etiam at nulla ipsum, in rhoncus purus</a></li>
					  <li><a href="#">Fusce vel magna faucibus felis dapibus facilisis</a></li>
					  <li><a href="#">Vivamus scelerisque dui in massa</a></li>
					  <li><a href="#">Pellentesque eget adipiscing dui semper</a></li>
					</ul> --}}
				  </div>
				</div>
			  
			</div>
			<div class="row"> 
			  <div class="col-md-12">
				  <div class="copy">
					<h5><i class="fa fa-wrench"></i>Startup <span class="color" style="color: #1ba1e2;">Wrench</span></h5>
					<p>Copyright &copy; 
						<a href="{{ url('/') }}">StartupWrench</a> 
						- <a href="{{ url('/') }}">Home</a> 
						{{-- | <a href="aboutus.html">About Us</a> 
						| <a href="faq.html">FAQ</a> 
						| <a href="contactus.html">Contact Us</a></p> --}}
				  </div>
			  </div>
			</div>
		  <div class="clearfix"></div>
		  </div>
		</footer>