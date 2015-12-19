@extends('layouts.master')
@section('head')
	<style>

		.features-four .f-block{
			padding: 0px;
		}
		


	</style>

	
@endsection
@section('content')
            <!-- Features starts -->
				<div class="features-four">
				{{  $template }}
				  <h3>Startup Resources</h3>
				  <p>Browse startups tools below, or search for something specific in the search bar.</p>

				  <br />

				  {{-- <div class="row"><div class="container"> --}}
				  	<?php $colors = ["b-blue", "b-purple", "b-orange", "b-red", "b-lblue", "b-green"]; 
				  	$count = 0;
				  	?>
				  	@foreach($topics as $topic)
				  		
					  	<div class="col-md-3 {{ $colors[$count] }}" style="min-height:90px;margin: 0px 0px;}}">
								<a href="{{ url("/topic/{$topic->slug}") }}"><h4 style="color:#FFFFFF">{!! $topic->name !!}</h4></a>
						  </div>
						  <div class="col-md-offset-1"></div>
						  <?php 
						  	if ($count < 5) {	$count++;	} 
						  	else 	{ $count = 0; }
						  ?>
				  	@endforeach
				  	{{-- </div> --}}
					{{-- <div class="col-md-4">
					  <div class="f-block b-red">
						<a href="#"><i class="fa fa-briefcase"></i></a>
						<a href="#"><h4>Vivamus vel ultricies eultrlit</h4></a>
						
					  </div>
					</div>

					<div class="col-md-4">
					  <div class="f-block b-purple">
						<a href="#"><i class="fa fa-music"></i></a>
						<a href="#"><h4>Morbi Acfelis Ecmauris</h4></a>
						
					  </div>
					</div>

					<div class="col-md-4">
					  <div class="f-block b-lblue">
						<a href="#"><i class="fa fa-camera"></i></a>
						<a href="#"><h4>Suspendisse Potenti Spahe</h4></a>
						
					  </div>
					</div> 
					<div class="col-md-4">
					  <div class="f-block b-green">
						<a href="#"><i class="fa fa-camera"></i></a>
						<a href="#"><h4>Suspendisse Potenti Spahe</h4></a>
						<p>Suspendisse potenti. Morbi ac felis nec mauris imperdiet fermentum. Vivamus vel ultricies elit.</p>
					  </div>
					</div>         
 --}}
				 {{--  </div> --}}
				</div>
				<!-- Features ends -->
@endsection