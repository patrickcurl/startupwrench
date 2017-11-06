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

				<div class="col-md-12">
				  <div class="fwidget">

					@if(!empty($latest))
						<h6>Recent Additions</h6>
						<ol class="list-group row">
							<?php $count = 1;?>

							@foreach($latest as $resource)
							<li class="list-group-item col-xs-6 recent-additions"><a href='{{ url("/resources/{$resource->slug}") }}'>{{ $count }}. {{ $resource->name }}</a></li>
							<?php $count++;?>
							@endforeach

						</ol>
					@endif
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
				  </div>
			  </div>
			</div>
		  <div class="clearfix"></div>
		  </div>
		</footer>