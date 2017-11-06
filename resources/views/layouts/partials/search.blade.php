@section('style')

@endsection
<div id="searchContent" class="container hidden">
	  {{-- @include('layouts.partials.pagination') --}}
		<div class="row">
  		<div id="hits" class="col-md-8">
  		</div>
  		<div class="col-md-4">
        {!! $sidebar_ads['inmotion'] or '' !!}<br />
        @include('ads.adsense300')
        @if(!empty($featured_resources))
        @foreach($featured_resources as $featured_resource)
          <h4>
            <a href="{{ $featured_resource->getUrl('internal') }}">{{ $featured_resource->name }}</a> |
            <a href="{{ $featured_resource->getUrl('out') }}"><i class="fa fa-external-link"></i></a>
          </h4>
          <img src="{{ $featured_resource->getUrl('featured_image') }}" class="img-responsive"><br />
        @endforeach
        @endif
      </div>
    </div>
    @include('layouts.partials.pagination')
    @include('layouts.partials.footer');
    </div>

</div>
