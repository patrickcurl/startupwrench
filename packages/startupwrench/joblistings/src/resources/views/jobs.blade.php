<pre>
	<?php // var_dump($jobs) ?>
</pre>
@extends(Config::get('joblistings.layout'))
@section('style')
    .job-listing 
    {
        margin-bottom: 30px;
    }
    .job-listings {
        font-size: 13px;
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
    .job-meta {
        margin-top: 5px;
    }
    .job-meta .label {
        padding-top:10px;
    }

    .job-meta-location {
        margin-left:20px;
    }
    .job-categories{
        font-size: 13px;
        list-style: none;
        padding-left: 0px;
    }
@endsection
@section('content')
<div class="col-md-3">
<h4>Search Jobs</h4>
{!! Form::inline() !!}
{!! Form::text('search', $value=null)->placeholder('Search Jobs') !!}
{!! Form::close() !!}

<a href="{{ url('/go/resume-rabbit') }}" target="_top">
<img src="{{ asset('uploads/ads/resume-rabbit.gif') }}"  alt="Save 60 hours off your job search" border="0" class="img-responsive" /></a>
      <!-- Service title with tag -->
        <h6 class="bold grey">Need a proper resume?</h6>
        <h3>Resume Writing Service</h3>
        <p>Startups are about improving life for everyone, our resume writing service can help you land that perfect job.</p>
        <a href="#">Check out everything <i class="fa fa-angle-double-right"></i> </a>
        <hr>
<h4>Browse Jobs</h4>
<ul class="job-categories">
@foreach($categories as $cat)
    

    <li><a href="{{ url('/')}}{{ Config::get('joblistings.path') }}?search={{ rawurlencode($cat) }}">{{ $cat }} Jobs</a></li>
    
  
@endforeach
</ul>
</div>
<div class="col-md-9 job-listings">
 <h1>Job Listings</h1>
 @if(!$company)
 <p>Results for 
    @if($search)
    {{ $search }}
    @else
    Startup
    @endif
    jobs in 
    @if($location){{ $location }}
    @else
        Anywhere, USA
    @endif
 </p>
 @else
    Results for {{ $company }}
 @endif

@foreach($jobs->all() as $job)
    <div class="job-listing">
    	
        @if($job['name'])
        <div class="row">
            <div class="col-md-3">
                <img src="{{ url('/') }}/uploads/{{ $job['source'] }}.png" class="img-responsive"/>
            </div>
            <div class="col-md-9">
                <h3>
                    <a href="{{ $job['url'] }}">{{ $job['name'] }}</a>
                </h3>
            </div>
        </div>
        @endif
   		<p class="job-meta">
            
            @if($job['date'])
            <span class="label label-primary job-meta-date">
                <time itemprop="datePosted" content="{{ $job['isodate'] }}">{{  $job['date']  }}</time>
            </span>
            @endif
     		@if($job['location'])
                <span class="job-meta-location" itemprop="jobLocation" itemscope itemtype="http://schema.org/Place">
                    <a href="{{ url('jobs') }}/?location={{ rawurlencode($job['location']) }}"><span itemprop="name">{{ $job['location'] }}</span></a>
                </span>
            @endif
            @if($job['company'])
                | <span class="job-meta-company" itemProp="hiringOrganization" itemscope itemtype="http://schema.org/Organization">
                    <a href="{{ url('/')}}{{ Config::get('joblistings.path') }}?company={{ rawurlencode($job['company']) }}"><span itemprop="name">{{ $job['company'] }}</span></a>
                </span>
            @endif
            @if($job['description'])
            <p class="job-description">
                {{ $job['description'] }}
            </p>
            @endif
            
     	
     </div>
@endforeach 
@endsection