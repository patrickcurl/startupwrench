<!-- Navigation bar starts -->

		<div class="navbar bs-docs-nav" role="banner">
		  <div class="container">
		   <div class="navbar-header">
			 <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
				 <span class="sr-only">Toggle navigation</span>
				 <span class="icon-bar"></span>
				 <span class="icon-bar"></span>
				 <span class="icon-bar"></span>
			 </button>
		   </div>
		   
			  <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
				<ul class="nav navbar-nav">
					  <li><a href="{{ url('/') }}">Home </a></li> 
				  <!-- Refer Bootstrap navbar doc -->
				  <li><a href="{{ url('/about-us') }}">About us</a></li>
				  <li><a href="{{ url('/blog') }}">Blog</a></li>
				  <li><a href="{{ url('/mvp-for-3k') }}">MVP for 3K</a></li>
				  <li><a href="{{ url('/jobs') }}">Startup Jobs</a></li>
				  <li><a href="{{ url('/contact-us') }}">Contact</a></li>
				  <li><a href="{{ url('/privacy') }}">Privacy Policy</a></li>
				</ul>
			  </nav>
			 </div>
		  </div>

			<!-- Navigation bar ends -->