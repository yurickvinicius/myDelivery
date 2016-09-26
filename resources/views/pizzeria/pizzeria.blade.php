<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">    
        <title>SpicyX | Home</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">

        <!-- Font awesome -->
        <link href="assets/css/font-awesome.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="assets/css/bootstrap.css" rel="stylesheet">   
        <!-- Slick slider -->
        <link rel="stylesheet" type="text/css" href="assets/css/slick.css">    
        <!-- Date Picker -->
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker.css">    
        <!-- Fancybox slider -->
        <link rel="stylesheet" href="assets/css/jquery.fancybox.css" type="text/css" media="screen" /> 
        <!-- Theme color -->
        <link id="switcher" href="assets/css/theme-color/default-theme.css" rel="stylesheet">     

        <!-- Main style sheet -->
        <link href="style.css" rel="stylesheet">    


        <!-- Google Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'>        
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Prata' rel='stylesheet' type='text/css'>


        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>  

        <!-- Pre Loader -->
        <div id="aa-preloader-area">
            <div class="mu-preloader">
                <img src="assets/img/preloader.gif" alt=" loader img">
            </div>
        </div>
        <!--START SCROLL TOP BUTTON -->
        <a class="scrollToTop" href="#">
            <i class="fa fa-angle-up"></i>
            <span>Top</span>
        </a>
        <!-- END SCROLL TOP BUTTON -->

        <!-- Start header section -->
        <header id="mu-header">  
            <nav class="navbar navbar-default mu-main-navbar" role="navigation">  
                <div class="container">
                    <div class="navbar-header">
                        <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- LOGO -->                                                        
                        <a class="navbar-brand" href="index.html"><img src="assets/img/logo.png" alt="Logo img"></a> 
                    </div>

                    <div id="navbar" class="navbar-collapse collapse">            
                        <ul id="top-menu" class="nav navbar-nav navbar-right mu-main-nav">
                            <li><a href="#mu-slider">HOME</a></li>                                 
                            <li><a href="#mu-restaurant-menu">MENU</a></li>                       
                            <li><a href="#mu-reservation">RESERVATION</a></li>                       
                            <li><a href="#mu-gallery">GALLERY</a></li>
                            <li><a href="#mu-chef">OUR TEAM</a></li>
                            <li><a href="#mu-contact">CONTACT</a></li> 
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="blog-archive.html">PAGE <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">                
                                    <li><a href="blog-archive.html">BLOG</a></li>
                                    <li><a href="blog-single.html">BLOG DETAILS</a></li>
                                    <li><a href="404.html">404 PAGE</a></li>                                            
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    @if(Auth::check())
                                        {{ Auth::user()->name }}
                                    @else
                                        Logar
                                    @endif

                                    <span class="caret"></span>
                                </a>
                                
                                <ul class="dropdown-menu" role="menu">                
                                    <li><a href="#">Logout</a></li>                                           
                                </ul>
                            </li>

                        </ul>                            
                    </div><!--/.nav-collapse -->       
                </div>          
            </nav> 
        </header>                

        <!-- Start slider  -->
        <section id="mu-slider">
            <div class="mu-slider-area"> 
                <!-- Top slider -->
                <div class="mu-top-slider">
                    <!-- Top slider single slide -->
                    <div class="mu-top-slider-single">
                        <img src="assets/img/slider/1.jpg" alt="img">
                        <!-- Top slider content -->
                        <div class="mu-top-slider-content">
                            <span class="mu-slider-small-title">Welcome</span>
                            <h2 class="mu-slider-title">TO THE SPICYX</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque voluptatem accusamus non quidem, deleniti optio.</p>           
                            <a href="{{ route('pizza.order') }}" class="mu-readmore-btn">PEÇA AQUI SUA PIZZA</a>
                        </div>
                        <!-- / Top slider content -->
                    </div>
                    <!-- / Top slider single slide -->    
                    <!-- Top slider single slide -->
                    <div class="mu-top-slider-single">
                        <img src="assets/img/slider/2.jpg" alt="img">
                        <!-- Top slider content -->
                        <div class="mu-top-slider-content">
                            <span class="mu-slider-small-title">The Real</span>
                            <h2 class="mu-slider-title">GREEN FOODS</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque voluptatem accusamus non quidem, deleniti optio.</p>           
                            <a href="{{ route('pizza.order') }}" class="mu-readmore-btn">PEÇA AQUI SUA PIZZA</a>
                        </div>
                        <!-- / Top slider content -->
                    </div>
                    <!-- / Top slider single slide -->   
                </div>
            </div>
        </section>
        <!-- End slider  -->

        <!-- End header section -->
        <a href="{{ url('auth/logoutTest') }}">Logout</a>
        |<a href="{{ url('auth/login') }}">Login</a>
        @include('template.partials._message_success')
        @yield('content')        

        <!-- Start Footer -->
        <footer id="mu-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mu-footer-area">
                            <div class="mu-footer-social">
                                <a href="#"><span class="fa fa-facebook"></span></a>
                                <a href="#"><span class="fa fa-twitter"></span></a>
                                <a href="#"><span class="fa fa-google-plus"></span></a>
                                <a href="#"><span class="fa fa-linkedin"></span></a>
                                <a href="#"><span class="fa fa-youtube"></span></a>
                            </div>
                            <div class="mu-footer-copyright">
                                <p>Designed by <a rel="nofollow" href="http://www.markups.io/">MarkUps.io</a></p>
                            </div>         
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->


        <!-- jQuery library -->
        <script src="assets/js/jquery.min.js"></script>  
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="assets/js/bootstrap.js"></script>   
        <!-- Slick slider -->
        <script type="text/javascript" src="assets/js/slick.js"></script>
        <!-- Counter -->
        <script type="text/javascript" src="assets/js/waypoints.js"></script>
        <script type="text/javascript" src="assets/js/jquery.counterup.js"></script>
        <!-- Date Picker -->
        <script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script> 
        <!-- Mixit slider -->
        <script type="text/javascript" src="assets/js/jquery.mixitup.js"></script>
        <!-- Add fancyBox -->        
        <script type="text/javascript" src="assets/js/jquery.fancybox.pack.js"></script>

        <!-- Custom js -->
        <script src="assets/js/custom.js"></script> 

        <script src="js/pizzeria.js"></script> 

    </body>
</html>