<pre>
	<?php var_dump($jobs) ?>
</pre>

@foreach($indeed as $job)
    <div class="service-content">
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
     </div>
@endforeach 