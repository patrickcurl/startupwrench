@extends('layouts.master')
@section('head')
<style>
	.sidebar{
			background: #FFFFFF;
			border:none;
			padding-right:10px;
		}

	/*.resource-link{
		max-width: 240px;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}*/
</style>

@endsection
@section('content')
<div class="content service-three">
<div class="container">

  <h2>Startup Jobs</h2>
  <p class="big grey">Looking to get in on the ground floor of the next google? Look no further!</p>
  <hr>
  <div class="row">
  	<div class="col-md-12">
  		
  			<a href="http://coder.camp/patrickcurl?source=swjobs"><h6 class="bold orange text-center">Bump up your pay! Junior Devs earn $90k first year. 
  			<br />Learn Programming In 9 Weeks!</h6></a>
  		
  	</div>
  </div>
  <div class="row">

     <div class="col-md-2 col-sm-2">
      <h6 class="grey bold">Popular Searches</h6>
      <ul>
      	<li><a href="{{ url('/jobs?search=Accounting') }}">Accounting Jobs</a></li>
        <li><a href="{{ url('/jobs?search=Developer') }}">Developer Jobs</a></li>
        <li><a href="{{ url('/jobs?search=Engineer') }}">Engineering Jobs</a></li>
        <li><a href="{{ url('/jobs?search=Game%20Developer') }}">Game Developer Jobs</a></li>
        <li><a href="{{ url('/jobs?search=IT') }}">IT Jobs</a></li>
        <li><a href="{{ url('/jobs?search=Networking') }}">Network Admin Jobs</a></li>
        <li><a href="{{ url('/jobs?search=Startup') }}">Startup Jobs</a></li>
        <li><a href="{{ url('/jobs?search=Technology') }}">Technology Jobs</a></li>
        <li><a href="{{ url('/jobs?search=Tech%20Support') }}">Tech support Jobs</a></li>

      </ul>

     </div>

     <div class="col-md-7 col-sm-7">

        
     
     {{-- @foreach($jobs->all() as $job) --}}
     		{{-- <div class="service-content">
     			<div class="col-md-8">
     				<h5><a href="{{ $job->url }}">{{ $job->company }}</a></h5>
     			</div>
     			<div class="col-md-4">
     				<h6 class="bold">{{ $job->location }}</h6>
     			</div>
     			<div class="clearfix"></div>
     			<div class="col-md-12">
     				<p>{{ $job->description }}</p>
     			</div>
     		</div> --}}
     {{-- @endforeach --}}

        
        <!-- Service #4 -->
        <h3>Coming soon</h3>
       {{--  <div class="service-icon purple">
          <i class="fa fa-user"></i>
        </div>

        <div class="service-content">
          <h5><a href="">Top Notch Support</h5>
          <p>Aenean sodales augue ac lacus hendrerit sed rhoncus erat hendrerit. Vivamus vel ultricies elit.</p>
        </div> --}}
        
        <br>


        <div class="clearfix"></div>

     </div>
     <div class="col-md-3 col-sm-3">
     <a href="{{ url('/go/resume-rabbit') }}" target="_top">
<img src="{{ asset('uploads/ads/resume-rabbit.gif') }}"  alt="Save 60 hours off your job search" border="0" class="img-responsive" /></a>
      <!-- Service title with tag -->
        <h6 class="bold grey">Need a proper resume?</h6>
        <h3>Resume Writing Service</h3>
        <p>Startups are about improving life for everyone, our resume writing service can help you land that perfect job.</p>
        <a href="#">Check out everything <i class="fa fa-angle-double-right"></i> </a>
        <hr>
     </div>
     

  </div>
<pre><?php print_r($jobs->all()); ?></pre>
<div class="border"></div>

<!-- Services Ends -->




</div></div>
@endsection