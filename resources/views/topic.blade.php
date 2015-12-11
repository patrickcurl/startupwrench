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
	
	<h1>{{ $topic->name }}</h1>
	<div class="col-md-7">
	@foreach($topic->resources as $resource)
		<div class="row clearfix">
			<div class="col-md-3">
				<a href="{{ url('/resource/' . $resource->slug) }}"><img src="{{ asset('uploads/logos/' . $resource->logo) }}" class="img-thumbnail img-responsive" /></a>
			</div>
			<div class="col-md-9">
				<h1>{{ $resource->name }}</h1>
				<p>{{ $resource->description }}</p>
				<div class="row">
				<div class="col-md-5">
					<a href="{{ url('/resource/' . $resource->slug) }}"><i class="fa fa-arrow-circle-right"></i> Read More</a></div>
				<div class="col-md-5">
					<a href="{{ $resource->domain }}" class="resource-link"><i class="fa fa-link"></i> {{ $resource->name }}</a>
				</div>
			</div>
		</div>
	@endforeach
	</div>
	<div class="col-md-3 pull-right"><img src="http://placehold.it/350x150"></div>
	
@endsection
{{-- @section('sidebar')
	<div class="col-md-6 pull-right"><img src="http://placehold.it/350x150"></div>
	
@endsection --}}