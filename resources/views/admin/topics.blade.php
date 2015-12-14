@extends('laravel_dashboard::layout')
@section('title')
Admin Dashboard :: Manage Topics
@stop
@section('head')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@stop
@section('styles')

@stop
@section('content')
<div class="container-fluid" id="topics">
@foreach($topics as $t)

<div class="col-md-3 col-sm-5 col-xs-12">
          <div class="info-box bg-aqua" style="padding-left:10px">
           {{--  <div class="info-box-content"> --}}
              <span class="info-box-text"><a href="#" data-type="text" data-pk="{{ $t->id }}" data-url="/admin/topics" data-title="enter topic name" class="topic-name">{{ $t->name }}</a></span>
              <span class="info-box-number ">{{ $t->resources()->count() }}</span>

              
                  
            {{-- </div> --}}
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
@endforeach</div>
	

@stop
@section('footer-scripts')
<script>
	$(document).ready(function() {
		$.fn.editable.defaults.mode = 'inline';
		$.fn.editable.defaults.params = function (params) {
        params._token = "{{ csrf_token() }}";
        console.log(params);
        return params;
    };
    $('.topic-name').editable({
    	send: 'always',
    	success: function(response, data){
    		console.log(response.msg);
    	}
    });
    // $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    //             }
    //         });
	});
</script>
@stop