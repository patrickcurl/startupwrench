@extends('layouts.master')
@section('style')
.myinput {
  margin: 10px;
}
@endsection
@section('content')
<div class="lrform">
                     <h5>Register for New Account</h5>
                                  <div class="form">
                                      <!-- Register form (not working)-->
                                       <form class="form-horizontal" action="{{ url('/register') }}" method="post">
                                        @if (count($errors) > 0)
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                       {!! csrf_field() !!}
                                          <!-- Name -->
                                          <div class="input-group input-group-lg myinput">
                                            <span class="input-group-addon">
                                              <i class="fa fa-user"></i>
                                            </span>
                                            <input class="form-control" type="text" placeholder="Name" name="name">
                                          </div>
                                          <!-- Email -->
                                          <div class="input-group input-group-lg myinput">
                                            <span class="input-group-addon">
                                              <i class="fa fa-envelope"></i>
                                            </span>
                                            <input class="form-control" type="email" placeholder="Email address" name="email">
                                          </div>
                                          <div class="input-group input-group-lg myinput">
                                            <span class="input-group-addon">
                                              <i class="fa fa-key"></i>
                                            </span>
                                            <input class="form-control" type="password" placeholder="Password" name="password">
                                          </div>
                                          <div class="input-group input-group-lg myinput">
                                            <span class="input-group-addon">
                                              <i class="fa fa-check"></i>
                                            </span>
                                            <input class="form-control" type="password" placeholder="Password Confirmation" name="password_confirmation">
                                          </div>
    
                                       
                                          
                                          
                                          
                                          <!-- Buttons -->
                                          <div class="form-group">
                                             <!-- Buttons -->
											 <div class="col-md-5 col-md-offset-1"> 
												<button type="submit" class="btn">Register</button>
												<button type="reset" class="btn">Reset</button>

											</div>
                      <div class="col-md-5">
                        <a href="http://start.dev/facebook/authorize"><img src="http://start.dev/img/FBlogin.png" class="img-responsive"></a>
                        </div>
                                          </div>
                                      </form>
                                             Already have an Account? <a href="{{ url('/login') }}">Login</a>
                                    </div> 
                                  </div>

@endsection