<pre>
	<?php // var_dump($jobs) ?>
</pre>
@extends(Config::get('joblistings.layout'))
@section('style')
    .job-listing 
    {
        margin-bottom: 30px;
    }
    .job-readmore {
      vertical-align: middle;
    }
    .job-readmore .btn {
      line-height: 52px;
      padding: 0 30px;
    }
    img.job-source {
      max-width: 54px;
      height: auto;
      border: 1px solid #2c3e50;
      border-radius: 4px;
    }
@endsection
@section('content')

<div class="col-md-8">
 <h1>Job Listings</h1>
 <p>Results for jobs for professionals</p>

@foreach($jobs as $job)
    <div class="job-listing">
    	<h2><a href="{{ $job->url }}">{{ $job->company }}</a></h2>
   		<p class="job-meta">
            
            <span class="label label-primary job-meta-date">
                <time itemprop="datePosted" content="">{{  $job->date  }}</time>
            </span>
     		
            <span class="job-meta-location" itemprop="jobLocation" itemscope itemtype="http://schema.org/Place">
                <span itemprop="name">{{ $job->location }}</span>
            </span>
            <span class="job-meta-company" itemProp="hiringOrganization" itemscope itemtype="http://schema.org/Organization">
                <span itemprop="name">{{ $job->company }}</span>
            </span>
            <p class="job-description">
                {{ $job->description }}
            </p>
            <p class="job-view">
                <a href="{{ $job->url }}" class="btn btn-primary">View job</a>
            </p>

     	
     </div>
@endforeach 
@endsection