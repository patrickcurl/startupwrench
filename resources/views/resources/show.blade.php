@extends('layouts.master')
@section('style')
.crop-height {
  /* max-width: 1200px; /* img src width (if known) */
  max-height: 320px;
  overflow: hidden; 
}

img.scale {
  /* corrects inline gap in enclosing div */
  display: block;
  max-width: 100%;
  /* just in case, to force correct aspect ratio */
  height: auto !important;
  width: auto\9; /* ie8+9 */
  /* lt ie8 */
  -ms-interpolation-mode: bicubic; 
}
.content br {
  margin-bottom: 5px;
}
@endsection
@section('featured_image')
<div class="col-md-12">
  <div class="row">
    <div class="col-md-2">
      <img src="{{ $resource->getUrl('logo') }}" class="img-responsive img-thumbnail">
      <br>
      <div class="text-center" style="width:100%;border: 2px solid #FF9800;margin:3px;padding:3px;">
        <a href="{{ $resource->getUrl('out') }}" style="padding-right: 3px;"><i class="fa fa-link fa-2x"></i></a>
        @if($resource->twitter)
          <a href="{{ $resource->getUrl('twitter') }}" style="padding-left: 3px; padding-right: 3px;"><i class="fa fa-twitter fa-2x"></i></a>
        @endif
        @if($resource->facebook)
          <a href="{{ $resource->getUrl('facebook') }}" style="padding-left: 3px; padding-right: 3px;"><i class="fa fa-facebook fa-2x"></i></a>
        @endif
        </div>
    </div>
    <div class="col-md-8">
      <div class="page-header">
        <h1>{{ $resource->name }}</h1><small>{{ $resource->description }}</small>
      </div>
    </div>
    <div class="col-md-2">
    <a href="{{ $resource->getUrl('out') }}"><i class="fa fa-link"></i></a>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="crop-height well">
        <img src="{{ $resource->getUrl('featured_image') }}" class="scale img-square" />
      </div>
    </div>
    <div class="col-md-4">
      @include('ads.adsense300')
      </div>
  </div>
</div>  
@endsection
@section('content')
{{-- <div class="content projects">
  <div class="container"> --}}
  
  {{-- 	<div class="col-md-8"> --}}
      <div class="content">{!! $resource->content !!} </div>
      @if($resource->previous())
        <a href="{{ $resource->previous()->getUrl('internal') }}" class="btn btn-primary">Previous:  {{ $resource->previous()->name }}</button>
      @endif
      @if($resource->next())
        <a href="{{ $resource->next()->getUrl('internal') }}" class="btn btn-primary pull-right">Next: {{ $resource->next()->name }}</button>
      @endif
      {{-- 
      <div class="col-md-3">
        
        @if($resource->twitter)
          <i class="fa fa-twitter fa-2x"></i>
        @endif
        @if($resource->facebook)
          <i class="fa fa-facebook fa-2x"></i>
        @endif
        <a href="{{ $resource->getUrl('out') }}">
          <i class="fa fa-external-link fa-2x"></i>
        </a>
        
 --}}

      {{-- </div>
      
      
  	</div> --}}
  	
  	
  		
  

@endsection
@section('custom_scripts')
  
@endsection