@extends('layouts.master')
@section('content')
 {!! Form::horizontal($resource, $formName = 'default')->errors($errors) !!}
 {!! Form::group()->text('name')->label('Business Name') !!} 
 {!! Form::group()->text('email')->label('Contact Email') !!} 
 {!! Form::group()->text('website')->label('Website') !!} 
 {!! Form::group()->text('logo')->label('Logo Url') !!} 
 {{-- {!! Form::group()->file('featured_image')->label('Featured Image') !!} --}}
 {!! Form::group()->text('title')->label('Title') !!}
 {!! Form::group()->editor('description')->label('Description') !!}
 {!! Form::group()->editor('excerpt')->label('Excerpt') !!}
 {!! Form::group()->checkboxes('topics', $topics)->inline(true) !!}  
 {!! Form::submit('submit', 'Add Resource', $value = null) !!}
 {!! Form::close() !!}
{{--  {!! Form::model(new App\Resource, ['route' => ['admin.resource.create', $resource->slug], 'class'=>'']) !!} --}}
     
 


  
@endsection