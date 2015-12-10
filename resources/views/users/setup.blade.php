@extends('layouts.master')
@section('content')
{!! Form::horizontal($user)->errors($errors) !!}
	{!! Form::group()->text('email')->label('Email')->value($user->email) !!}
	{!! Form::group()->password('password')->label('Password') !!}
  {!! Form::group()->password('password_confirmation')->label('Password confirmation') !!}
  
	{!! Form::submit('submit', 'Complete Setup', $value = null) !!}
{!! Form::close() !!}
@endsection