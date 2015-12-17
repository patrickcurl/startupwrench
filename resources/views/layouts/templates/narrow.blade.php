<div id="mainContent" class="container">
  <div class="row">

    <div class="col-md-8">
      @yield('content')
    </div>
    <div class="col-md-4">
      {!! $sidebar_ads['inmotion'] !!}<br />
      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <!-- startupwrench-sidebar-top -->
      <ins class="adsbygoogle"
        style="display:inline-block;width:336px;height:280px"
          data-ad-client="ca-pub-4190828597999315"
          data-ad-slot="8479557582"></ins>
        <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
        <h4>Featured Resources</h4>
        @foreach($featured_resources as $featured_resource)
          <h4><a href="{{ $featured_resource->getUrl('internal') }}">{{ $featured_resource->name }}</a> | <a href="{{ $featured_resource->getUrl('out') }}"><i class="fa fa-external-link"></i></a></h4>
          <img src="{{ $featured_resource->getUrl('featured_image') }}" class="img-responsive"><br />
          
          
        @endforeach

  </div>
</div>