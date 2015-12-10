@extends('layouts.master')
@section('content')
 {!! Form::horizontal($resource)->errors($errors) !!}
 {!! Form::group()->text('name')->label('Business Name')->value($resource->name) !!} 
 {!! Form::group()->text('email')->label('Contact Email')->value($resource->email) !!} 
 {!! Form::group()->text('website')->label('Website')->value($resource->website) !!} 
 {!! Form::group()->text('logo_file_name')->label('Logo Url')->value($resource->logo_file_name) !!} 
 {!! Form::group()->text('title')->label('Title')->value($resource->title) !!}
 {!! Form::group()->editor('description')->label('Description')->value($resource->description) !!}
 {!! Form::group()->editor('excerpt')->label('Excerpt')->value($resource->excerpt) !!}
 {!! Form::group()->checkboxes('topics', $topics, $checked = $resource->selectedTopics())->inline(true) !!}  
 {!! Form::submit('submit', 'Edit Resource', $value = null) !!}
 {!! Form::close() !!}
 @endsection

     
 


  