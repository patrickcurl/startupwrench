@extends('layouts.master')
@section('content')

<div class="container">

  <h2>Contact Us</h2>
  <p class="big grey">Let me know what you think!</p>
  <hr>
            
  <div class="contact">
                        <div class="row">
                           <div class="col-md-12 col-sm-12">
                              <!-- Google maps -->
                              <div class="gmap">
                                 <!-- Google Maps. Replace the below iframe with your Google Maps embed code -->
                                 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3043.7789207864766!2d-111.69338168460824!3d40.28066097938125!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x874d9aecdf6a58ad%3A0x31a46dbf361deba1!2s175+E+900+S%2C+Orem%2C+UT+84058!5e0!3m2!1sen!2sus!4v1450207574308" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                              </div>
                              
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6 col-sm-6">
                              <div class="cwell">
                                 <!-- Contact form -->
                                    <h5>Contact Us</h5>
                                    <ul>
																	    @foreach($errors->all() as $error)
																	        <li>{{ $error }}</li>
																	    @endforeach
																	</ul>
                                    <div class="form">
                                      <!-- Contact form (not working)-->
                                     		{!! Form::standard($model = null, $formName = 'default') !!}

	                                     	{!! Form::group()->input('text', 'name', null)->placeholder("Name")->prepend(Fluent::icon(Fluent::FA_USER)) !!}	
                                          <!-- Name -->
                                        {!! Form::group()->input('email', 'email', null)->placeholder("Email Address")->prepend(Fluent::icon(Fluent::FA_ENVELOPE)) !!}	  
                                          
                                        {!! Form::group()->input('text', 'website', null)->placeholder("Website")->prepend(Fluent::icon(Fluent::FA_GLOBE)) !!}	  
                                        
                                        {!! Form::group()->textarea('message')->placeholder("Message") !!}	  
                                         
                                         {!! Recaptcha::render() !!}
           
                                          <!-- Buttons -->
                                          <div class="form-group">
                                             <!-- Buttons -->
                                             <div class="col-md-9 col-md-offset-3">
                                                <button type="submit" class="btn btn-default">Submit</button>
                                                <button type="reset" class="btn btn-default">Reset</button>
                                             </div>
                                          </div>
                                      </form>
                                    </div>
                                 </div>
                           </div>
                           <div class="col-md-6 col-sm-6">
                                 <div class="cwell">
                                    <!-- Address section -->
                                       <h5>Address</h5>
                                       <div class="address">
                                           <address>
                                              <!-- Company name -->
                                              <h6>StartupWrench</h6>
                                              <!-- Address -->
                                              175 E 900 S<br>
                                              Orem, UT 84058<br>
                                              <!-- Phone number -->
                                              
                                           </address>
                                            
                                           <address>
                                              <!-- Name -->
                                              <h6>Patrick Curl</h6>
                                              <!-- Email -->
                                              <a href="mailto:patrick@startupwrench.com">patrick@startupwrench.com</a><br />
                                              <a href="http://linkedin.com/in/patrickcurl">Linked In / Resume</a>
                                           </address>
                                           
                                       </div>
                                 </div>
                           </div>
                        </div>
                        
                     </div> 

  <div class="border"></div>

<!-- Product & links starts -->

<div class="prod">
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <div class="home-links">
          <div class="col-l">
            <h5>Downloads</h5>
            <ul>
              <li><a href="#">Linux 8</a></li>
              <li><a href="#">PlayStation</a></li>
              <li><a href="#">GTalk</a></li>
              <li><a href="#">Google Search</a></li>
              <li><a href="#">Linux Phone</a></li>
            </ul>
          </div>
          <div class="col-r">
            <h5>Support</h5>
            <ul>
              <li><a href="#">Linux Update</a></li>
              <li><a href="#">PlayStation</a></li>
              <li><a href="#">GTalk</a></li>
              <li><a href="#">Google Search</a></li>
              <li><a href="#">Linux Phone</a></li>
            </ul>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="col-md-8 col-sm-8"> 
        <div class="home-product">
          <div class="home-prod-img" id="s1" style="position: relative;">
              <img src="img/photos/s1.jpg" class="img-responsive" alt="" style="position: absolute; top: 0px; left: 0px; display: block; z-index: 3; opacity: 0.145924; width: 148px; height: 148px;">
              <img src="img/photos/s2.jpg" class="img-responsive" alt="" style="position: absolute; top: 0px; left: 0px; display: block; z-index: 4; opacity: 0.854076; width: 148px; height: 148px;">
              <img src="img/photos/s3.jpg" class="img-responsive" alt="" style="position: absolute; top: 0px; left: 0px; display: none; z-index: 3; opacity: 0; width: 148px; height: 148px;">
          </div>
          <h3>Canonical Linux 8</h3>
          <p>Aliquam ut feugiat ante. Curabitur justo aliquam. Maecenas turpis urna, eleifend et venenatis eget, ultricies quis urna. Aliquam ut feugiat ante. Curabitur justo aliquam. Aliquam ut feugiat ante. Curabitur justo aliquam. </p>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>

<!-- Product & links ends --> 

  </div>
@endsection