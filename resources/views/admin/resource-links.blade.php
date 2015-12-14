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
 @include('admin.ajax.resource-links')
@stop
@section('footer-scripts')
  @include('admin.ajax.links-footer')
@stop
