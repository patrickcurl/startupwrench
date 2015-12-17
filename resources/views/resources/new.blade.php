@extends('layouts.master')
@section('content')
{!! Form::horizontal($resource, $formName = 'default')->errors($errors) !!}
 {!! Form::group()->text('name')->label('Business Name') !!} 
 {!! Form::group()->text('representation')->label('Elevator Pitch / Tagline') !!} 
 {!! Form::group()->text('domain')->label('Website URL') !!}
 {!! Form::group()->text('logo')->label('Logo URL') !!} 
 {!! Form::group()->textarea('description')->label('Description') !!}
 {!! Form::group()->editor('content')->label('Styled Content') !!}
 {!! Form::group()->text('facebook')->label('Facebook URL') !!}
 {!! Form::group()->text('twitter')->label('Twitter URL') !!}
 {!! Form::group()->checkboxes('topics', $topics)->inline(true) !!}  
 {!! Form::submit('submit', 'Add Resource', $value = null) !!}
 {!! Form::close() !!}

@endsection
@section('scripts')
	@parent
	test
@endsection
test