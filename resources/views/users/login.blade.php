@extends('layouts.master')
@section('content')
<div class="col-md-8">
<div class="register">
  <div class="row">
    <div class="lrform">
      <h5>Login to your Account</h5>
      <div class="form">
        <ul>
				    @foreach($errors->all() as $error)
				        <li>{{ $error }}</li>
				    @endforeach
				</ul>
        <!-- Login form (not working)-->
        <form class="form-horizontal" action="{{ url('/login') }}" method="post">
         @if (count($errors) > 0)
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          @endif
         {!! csrf_field() !!}
        <div class="input-group input-group-lg myinput">
          <span class="input-group-addon">
            <i class="fa fa-envelope"></i>
          </span>
          <input class="form-control" type="email" placeholder="Email address" name="email">
        </div>
        <!-- Password -->
        <div class="input-group input-group-lg myinput">
          <span class="input-group-addon">
            <i class="fa fa-key"></i>
          </span>
          <input class="form-control" type="password" placeholder="Password" name="password">
        </div>
        <div class="form-group">
           <div class="col-md-9 col-md-offset-3">
              <label  class="checkbox-inline">
              <input type="checkbox" name="remember"> Remember me
              </label>
           </div>
        </div>                                                                               
        <!-- Buttons -->
        <div class="form-group">
                     <!-- Buttons -->
						 <div class="col-md-5 col-md-offset-1">
							<button type="submit" class="btn btn-default">Login</button>
							<button type="reset" class="btn btn-default">Reset</button>
							</div>
							<div class="col-md-5">
							<a href="{{ url('/facebook/authorize') }}"><img src="{{ url('/img/FBlogin.png') }}" class="img-responsive"></a>
							</div>
						</div>
        </div>
        </form>
        Don't have Account? <a href="{{ url('/register') }}">Register</a>
      </div> 
    </div>
  </div>
  </div>
  <div class="col-md-4">
    @include('ads.adsense300')
    </div>
@endsection