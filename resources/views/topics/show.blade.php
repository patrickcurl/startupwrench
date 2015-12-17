@extends('layouts.master')
@section('head')
<style>
	.sidebar{
			background: #FFFFFF;
			border:none;
			padding-right:10px;
		}
	h1 {
		/*margin: 0px;*/
	}

	
	/*.resource-link{
		max-width: 240px;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}*/
</style>

@endsection
@section('content-top')
	<div class="content-top">
		<div class="container">
			<h1 style="margin-left: 10px;">{{ $topic->name }}</h1>
		</div>
	</div>
@endsection
@section('content')
	
	
{{-- 	<div class="col-md-7"> --}}
	@foreach($topic->resources as $resource)
		<div class="row clearfix">
			<div class="col-md-4">
				<a href="{{ url('/resource/' . $resource->slug) }}"><img src="{{ asset('uploads/logos/' . $resource->logo) }}" class="img-thumbnail img-responsive" /></a>
				<div class="clearfix" style="padding-top:10px;"></div>
				<div class="well" style="padding:5px;">
					<a href="{{ url('/out') }}/{{ $resource->slug }}" class="resource-link"><i class="fa fa-link"></i> Website</a>
					@if($resource->twitter)
					<br /><a href="{{ $resource->twitter }}" class="resource-link"><i class="fa fa-twitter"></i> Twitter</a>
					@endif
					@if($resource->facebook)
					<br /><a href="{{ $resource->facebook }}" class="resource-link"><i class="fa fa-facebook"></i> Facebook</a>
					@endif
					<br />
					@if($resource->clicks)
					Hits: {{ $resource->clicks }}
					@endif
				</div>
			</div>
			<div class="col-md-8">
				<h1 style="margin:0;"><a href="{{ url('/resource/' . $resource->slug) }}">{{ $resource->name }}</a></h1>
				<a href="{{ url('/resource/' . $resource->slug) }}"><img src="{{ asset('uploads/sites/' . $resource->featured_image) }}" class="img-responsive" /></a>
				
				<p>{{ $resource->description }}
				<br /><br /><a href="{{ url('/resource/' . $resource->slug) }}"><h4><i class="fa fa-arrow-circle-right"></i> Read More</a></h4></p>

				
			</div>
		</div>
	@endforeach
	{{-- </div> --}}
	

@endsection
{{-- @section('sidebar')
	<div class="col-md-6 pull-right"><img src="http://placehold.it/350x150"></div>
	
@endsection --}}
