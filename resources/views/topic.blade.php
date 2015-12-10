@extends('layouts.master')
@section('head')
<style>
	.sidebar{
			background: #FFFFFF;
			border:none;
			padding-right:10px;
		}
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
				<p><a href="{{ url('/resource/' . $resource->slug) }}"><i class="fa fa-arrow-circle-right"></i> Read More</a></p>
			</div>
		</div>
	@endforeach
	</div>
	<div class="col-md-3 pull-right"><img src="http://placehold.it/350x150"></div>
	
@endsection
{{-- @section('sidebar')
	<div class="col-md-6 pull-right"><img src="http://placehold.it/350x150"></div>
	
@endsection --}}