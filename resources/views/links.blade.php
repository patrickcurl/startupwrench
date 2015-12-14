<ol>
@foreach($resources as $r)
	<li><a href="{{ $r->domain }}">{{ $r->name }}</a></li>
@endforeach
</ol>