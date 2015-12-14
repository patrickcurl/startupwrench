@extends('laravel_dashboard::layout')
@section('title')
Admin Dashboard :: Manage Resources
@stop
@section('head')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@stop
@section('styles')

@stop
@section('content')
@include('admin.ajax.resources')
@stop
@section('footer-scripts')
<script>
	$(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getResources(page);
            }
        }
    });


	$(document).ready(function() {
		$(document).on('click', '.pagination a', function (e) {
            getResources($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
		$.fn.editable.defaults.mode = 'inline';
		$.fn.editable.defaults.params = function (params) {
        params._token = "{{ csrf_token() }}";
        console.log(params);
        return params;
    };
    $('.resource-item').editable({
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

	function getResources(page) {
        $.ajax({
            url : '?page=' + page,
            dataType: 'json',
        }).done(function (data) {
        	console.log(data);
            $('.resources').html(data);
            location.hash = page;
        }).fail(function () {
            alert('Resources could not be loaded.');
        });
    }
</script>
@stop