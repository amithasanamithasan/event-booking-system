<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta information -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"><!-- Mobile Specific Metas -->
    
    <!-- Title -->
    <title>Event Planners Searching Site - @yield('title')</title>
    
    <!-- favicon icon -->
    <link rel="shortcut icon" href="{{ asset('frontend/images/Favicon.ico') }}">
    <!-- CSS Stylesheet -->
    <link href="{{ asset('frontend/css/bootstrap.css') }}" rel="stylesheet"><!-- bootstrap css -->
    <link href="{{ asset('frontend/css/owl.carousel.css') }}" rel="stylesheet"><!-- carousel Slider -->
    <link href="{{ asset('frontend/css/styles.css') }}" rel="stylesheet" /><!-- font css --> 
    <link href="{{ asset('frontend/css/datepicker.css') }}" rel="stylesheet" /><!-- Date picker css -->
    <link href="{{ asset('frontend/css/loader.css') }}" rel="stylesheet"><!-- Loader Box css -->
    <link href="{{ asset('frontend/css/docs.css') }}" rel="stylesheet"><!--  template structure css -->
    
    <!-- Used Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Domine:400,700%7COpen+Sans:300,300i,400,400i,600,600i,700,700i%7CRoboto:400,500" rel="stylesheet"> 

</head>
    
<body>
    <div class="page">
      <div id="loader-wrapper">
        <div id="loader"><img src="{{ asset('frontend/images/loader.gif') }}" alt=""></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
      </div>
        <header id="header">
            <div class="quck-link">
                <div class="container">
                    <div class="mail"><a href="MailTo:info@eventplanning.com"><span class="icon icon-envelope"></span>info@eventplanning.com</a></div>
                    <div class="right-link">
                        <ul>
                          <!-- Authentication Links -->
                          @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Sign in') }}</a>
                            </li>
                            @if (Route::has('register'))
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                              </li>
                            @endif
                          @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.dashboard') }}">{{ __('My Account') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  {{ Auth::user()->name }} <span class="caret"></span>
                              </a>

                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                              </div>
                            </li>
                          @endguest

                          </ul>
                    </div>
                </div>    
            </div>
            <nav id="nav-main">
                <div class="container">
                    <div class="navbar navbar-inverse">
                        <div class="navbar-header">
                            <a href="/" class="navbar-brand"><img src="{{ asset('frontend/images/logo.png') }}" alt=""></a>
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon1-barMenu"></span>
                                <span class="icon1-barMenu"></span>
                                <span class="icon1-barMenu"></span>
                            </button>
                            
                        </div>
                        <div class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li class="@if(Route::current()->getName() == 'home') active @endif"><a href="{{route('home')}}">Home</a></li>
                                <li class="single-col ">
                                  <a>Search <span class="icon icon-arrow-down"></span></a>
                                  <ul>
                                    @foreach(App\Category::where(['parent_id'=>0])->orderBy('id', 'desc')->get() as $category)
                                        <li><a href="/services?service_id=<?php print $category->id; ?>">{{ $category->name }}</a></li>
                                    @endforeach
                                    </ul>
                                </li>
                                <li class="@if(Route::current()->getName() == 'blog') active @endif"><a href="{{route('blog')}}">Blog</a></li>
                                <li class="@if(Route::current()->getName() == 'about-us') active @endif"><a href="{{route('about-us')}}">About Us</a></li>

                                <li><a href="user">Advertise</a></li>
                            </ul>
                                
                            </ul>
                            <div class="search-box">
                                <div class="search-icon"><span class="icon icon-search"></span></div>
                                <div class="search-view">
                                    <div class="input-box">
                                        <form>
                                            <input type="text" placeholder="Search here">
                                            <input type="submit" value="" >
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        
        <!-- main-content-start -->
        @yield('content')
        <!-- main-content-end -->

        <footer id="footer">
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-md-4">
                            <h5>About us</h5>
                            <div class="contact-slide">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-md-4">
                            <div class="footer-contact">
                                <h5>Contact us</h5>
                                <div class="contact-slide">
                                    <div class="icon icon-location-1"></div>
                                    <p>74 West Main Street, Oyster Bay, Berlin, 10963 - Germany </p>
                                </div>
                                <div class="contact-slide">
                                    <div class="icon icon-phone"></div>
                                    <p>516-482-2181 ext 101</p>
                                </div>
                               
                                <div class="contact-slide">
                                    <div class="icon icon-message"></div>
                                    <a href="MailTo:info@eventplanning.com">info@eventplanning.com</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-md-4">
                            <div class="contact-form">
                                <h5>Connect with us</h5>
                                <div class="sosal-midiya">
                                    <ul>
                                        <li><a href="#"><span class="icon icon-facebook"></span></a></li>
                                        <li><a href="#"><span class="icon icon-twitter"></span></a></li>
                                        <li><a href="#"><span class="icon icon-linkedin"></span></a></li>
                                        <li><a href="#"><span class="icon icon-skype"></span></a></li>
                                        <li><a href="#"><span class="icon icon-google-plus"></span></a></li>
                                        <li><a href="#"><span class="icon icon-play"></span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <p>Copyright &copy; <span></span> - Event Planners Searching Site | All Rights Reserved</p>
                </div>
            </div>
        </footer>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script type="text/javascript" src="{{ asset('frontend/js/jquery-1.12.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/owl.carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.selectbox-0.2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.form-validator.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/placeholder.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/coustem.js') }}"></script>
</body>

</html>

