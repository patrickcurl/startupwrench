@extends('layouts.master')

@section('content')
<div class="content projects">
  <div class="container">
  	<h2>{{ $resource->name }}</h2>
  	<p class="big grey">{{ $resource->representation }}
  	
  	<div class="col-md-6 col-sm-12">
  		<img src="{{ url('uploads/sites/' . $resource->featured_image_filename) }}" class="img-responsive" />	
  	</div>
  	<div class="col-md-4 col-sm-4">
  	Test 123
  	</div>
  </div>

@endsection