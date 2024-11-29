<!doctype html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" type="text/css"
        href="https://nyumbafasta.co.tz/assets/libraries/font-awesome/css/font-awesome.css" media="screen, projection">
    <link rel="stylesheet" type="text/css"
        href="https://nyumbafasta.co.tz/assets/libraries/jquery-bxslider/jquery.bxslider.css"
        media="screen, projection">
    <link rel="stylesheet" type="text/css" href="https://nyumbafasta.co.tz/assets/libraries/flexslider/flexslider.css"
        media="screen, projection">
    <link rel="stylesheet" type="text/css" href="https://nyumbafasta.co.tz/assets/css/realocation.css"
        media="screen, projection" id="css-main">
    <link rel="stylesheet" type="text/css" href="https://nyumbafasta.co.tz/assets/css/style.css"
        media="screen, projection" id="css-main">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


    <link href="http://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet" type="text/css">

    <title>
        NyumbaFasta | Nyumba Chaap Kiganjani
    </title>
</head>

<body>


    <div id="wrapper">
        <div id="header-wrapper">
            <div id="header">
                <div id="header-inner">
                    <div class="header-bar">
                        <div class="container">
                            <div class="header-infobox">
                                <strong>E-mail:</strong> <a href="#">info@nyumbafasta.co.tz</a>
                            </div><!-- /.header-infobox-->

                            <div class="header-infobox">
                                <strong>Phone:</strong> 0752 579 773
                            </div><!-- /.header-infobox-->

                            @guest
                                <ul class="header-bar-nav nav nav-register">
                                    <li><a href="{{ route('renter.login') }}">Login</a></li>
                                    @if (Route::has('register'))
                                        <li><a href="{{ route('renter.register') }}">Register</a></li>
                                    @endif
                                @else
                                    <ul class="header-bar-nav nav nav-register">
                                        <li><a href="{{ route('renter.profile.show') }}">{{ Auth::user()->name }}</a>
                                        </li>

                                        <li> <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a></li>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>

                                        </li>
                                        </li>
                                    </ul>
                                @endguest
                        </div><!-- /.container -->
                    </div><!-- /.header-bar -->

                    <div class="header-top">
                        <div class="container">
                            <div class="header-identity">
                                <a href="/" class="header-identity-target">
                                    <span class="header-icon"><img style="width: 48px; height: 48px;"
                                            src="{{ asset('assets/img/new-logo.png') }}" alt=""></span>
                                    <span style="margin-left:-35px;" class="header-title">NyumbaFasta</span>
                                    <!-- /.header-title -->
                                    <span class="header-slogan">NYUMBA CHAAP<br> KIGANJANI</span>
                                    <!-- /.header-slogan -->
                                </a><!-- /.header-identity-target-->
                            </div><!-- /.header-identity -->

                            <div class="header-actions pull-right">
                                @guest
                                    <a href="{{ route('landlord.register') }}" class="btn btn-regular">Register as
                                        LandLord</a>
                                    <strong class="separator">or</strong>
                                    <a href="{{ route('landlord.login') }}" class="btn btn-primary"><i
                                            class="fa fa-plus"></i>Login To Submit Property</a>
                                    @if (Route::has('register'))
                                    @endif
                                @else
                                    @if (Auth::user()->role_id == 2)
                                        <span style="font-size:15px" class="header-title">Welcome,
                                            {{ Auth::user()->name }}</span>
                                    @elseif(Auth::user()->role_id == 3)
                                        <span style="font-size:15px" class="header-title">Welcome,
                                            {{ Auth::user()->name }}</span>
                                    @endif
                                @endguest
                            </div><!-- /.header-actions -->

                            <button class="navbar-toggle" type="button" data-toggle="collapse"
                                data-target=".header-navigation">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div><!-- /.container -->
                    </div><!-- .header-top -->

                    <div class="header-navigation">
                        <div class="container">
                            <div class="row">
                                <div class="col">

                                </div>

                                @guest
                                    <div class="container">
                                        <div class="row">
                                            <ul class="header-nav nav nav-pills">

                                                <li>
                                                    <a href="{{ route('renter.login') }}">Login</a>
                                                </li>

                                                <li>
                                                    <a href="{{ route('renter.register') }}">Register As Renter</a>
                                                </li>

                                                <li>
                                                    <a href="{{ route('landlord.register') }}">Register As Landlord</a>
                                                </li>

                                                <li>
                                                    <a href="{{ route('dalali.register') }}">Register As Dalali</a>
                                                </li>

                                                <li class="menuparent">
                                                    <a href="#">Properties</a>

                                                    <ul class="sub-menu">
                                                        <li><a href="{{ route('renter.apartments') }}">Apartment</a>
                                                        </li>
                                                        <li><a
                                                                href="{{ route('renter.standalonehouses') }}">Standalone</a>
                                                        </li>
                                                        <li><a href="{{ route('renter.sittingroomwithmasterbedrooms') }}">Sitting
                                                                Room With Master Bedroom</a></li>
                                                        <li><a href="{{ route('renter.sittingroomwithbedrooms') }}">Sitting
                                                                Room With Bedroom</a></li>
                                                        <li><a href="{{ route('renter.masterbedrooms') }}">Master
                                                                Bedroom</a></li>
                                                        <li><a href="{{ route('renter.singlerooms') }}">Single Room</a>
                                                        </li>
                                                    </ul>
                                                </li>

                                                <li>
                                                    <a href="{{ route('about.us') }}">About Us</a>
                                                </li>

                                                <li>
                                                    <a href="{{ route('contact.us') }}">Contact Us</a>
                                                </li>

                                                <li>
                                                    <a href="{{ route('faqs') }}">FAQ</a>
                                                </li>

                                            </ul><!-- /.header-nav -->
                                        </div>
                                    </div><!-- /.container -->

                                    @if (Route::has('register'))
                                    @endif
                                @else
                                    @if (Auth::user()->role_id == 2)
                                        <span style="font-size:15px" class="header-title">You have logged in as
                                            LandLord</span>
                                    @elseif(Auth::user()->role_id == 3)
                                        <div class="container">
                                            <div class="row">
                                                <ul class="header-nav nav nav-pills">
                                                    <li><a href="{{ route('renter.cart') }}">
                                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart
                                                            <span
                                                                class="badge badge-pill badge-danger">{{ $paidHousesCount }}</span></a>
                                                    </li>
                                                    <li><a href="{{ route('renter.wishlist') }}"><i class="fa fa-heart" aria-hidden="true"  ></i> Wishlist <span class="badge badge-pill badge-danger" style="background-color:#ff0000; border-radius: 50px; padding:2px;" >{{ $wishlistCount }}</span></a></li>
                                                    <li><a
                                                            href="{{ route('renter.dashboard') }}">{{ Auth::user()->name }}</a>
                                                    </li>

                                                    <li> <a class="dropdown-item" href="{{ route('logout') }}"
                                                            onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                                            {{ __('Logout') }}
                                                        </a></li>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                    </form>

                                                    </li>
                                                    </li>

                                                    <li class="menuparent">
                                                        <a href="#">Properties</a>

                                                        <ul class="sub-menu">
                                                            <li><a href="{{ route('renter.apartments') }}">Apartment</a>
                                                            </li>
                                                            <li><a
                                                                    href="{{ route('renter.standalonehouses') }}">Standalone</a>
                                                            </li>
                                                            <li><a
                                                                    href="{{ route('renter.sittingroomwithmasterbedrooms') }}">Sitting
                                                                    Room With Master Bedroom</a></li>
                                                            <li><a href="{{ route('renter.sittingroomwithbedrooms') }}">Sitting
                                                                    Room With Bedroom</a></li>
                                                            <li><a href="{{ route('renter.masterbedrooms') }}">Master
                                                                    Bedroom</a></li>
                                                            <li><a href="{{ route('renter.singlerooms') }}">Single
                                                                    Room</a></li>
                                                        </ul>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('about.us') }}">About Us</a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('contact.us') }}">Contact Us</a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('faqs') }}">FAQ</a>
                                                    </li>

                                                    <li>
                                                        <form method="GET" action="{{ route('general.search') }}"
                                                            class="form-horizontal form-search">
                                                            <div class="form-group has-feedback no-margin">
                                                                <input name="term" type="text" class="form-control"
                                                                    placeholder="Search(area, rent, house id)">

                                                                <span class="form-control-feedback">
                                                                    <i class="fa fa-search"></i>
                                                                </span><!-- /.form-control-feedback -->
                                                            </div><!-- /.form-group -->
                                                        </form>
                                                    </li>

                                                </ul><!-- /.header-nav -->
                                            </div>
                                        </div><!-- /.container -->
                                    @endif
                                @endguest
                                </ul><!-- /.header-nav -->
                            </div>
                        </div><!-- /.container -->
                    </div><!-- /.header-navigation -->
                </div><!-- /.header-inner -->
            </div><!-- /#header -->
        </div><!-- /#header-wrapper -->
        <div id="main-wrapper">
            <div id="main">
                <div id="main-inner">
                    <!-- <div id="map-property"> -->

                    <!-- </div> -->
                    <!-- /.map-property -->

                    <div id="images" class="container">
                        <div class="block-content-small-padding">
                            <!-- Took out class 'block-content'-->
                            <div class="block-content-inner">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <h2 class="property-detail-title">{{ $property->area->name }}</h2>
                                        <h3 class="property-detail-subtitle">{{ $property->address }}</strong></h3>

                                        <div class="property-detail-overview">
                                            <div class="property-detail-overview-inner clearfix">
                                                <div class="property-detail-overview-item col-sm-6 col-md-2 paddingx">
                                                    <strong>Price:</strong>
                                                    <span>Tsh {{ number_format($property->price) }}</span>
                                                </div><!-- /.property-detail-overview-item -->

                                                <div class="property-detail-overview-item col-sm-6 col-md-2 paddingx">
                                                    <strong>Property Type:</strong>
                                                    <span>{{ $property->property_type }}</span>
                                                </div><!-- /.property-detail-overview-item -->

                                                <div class="property-detail-overview-item col-sm-6 col-md-2 paddingx">
                                                    <strong>Property Size:</strong>
                                                    @if($property->sqm)
                                                    <span>{{ $property->sqm }} sqm</span>
                                                   @else
                                                    <span>Not Specified</span>
                                                    @endif
                                                </div><!-- /.property-detail-overview-item -->

                                                <div class="property-detail-overview-item col-sm-6 col-md-2 paddingx">
                                                    <strong>Property Region:</strong>
                                                    <span>{{ $property->region->name }}</span>
                                                </div><!-- /.property-detail-overview-item -->


                                                <div class="property-detail-overview-item col-sm-6 col-md-2 ">
                                                    <strong>Availability:</strong>
                                                    @if ($property->status === 1)
                                                        <span>For Sale</span>
                                                    @else
                                                        <span>Sold</span>
                                                    @endif
                                                </div><!-- /.property-detail-overview-item -->

                                                <div class="property-detail-overview-item col-sm-6 col-md-2 ">
                                                    <strong>Agent:</strong>
                                                    <span>{{ $agentName }}</span>
                                                </div><!-- /.property-detail-overview-item -->
                                            </div><!-- /.property-detail-overview-inner -->

                                        </div><!-- /.property-detail-overview -->



                                        <div class="flexslider">
                                            <ul class="slides">

                                        @foreach ($property->media as $image)
                                        <li data-thumb="{{ $image->getUrl() }}">
                                            <img src="{{ $image->getUrl() }}"
                                                alt="alt-image">
                                        </li>
                                        @endforeach

                                                {{-- @if ($property->images)
                                                    @foreach (json_decode($property->images) as $picture)
                                                        <li data-thumb="{{ asset('images/' . $picture) }}">
                                                            <img src="{{ asset('images/' . $picture) }}"
                                                                alt="">
                                                        </li>
                                                    @endforeach
                                                @else
                                                @endif --}}
                                            </ul>
                                            <!-- /.slides -->
                                        </div><!-- /.flexslider -->

                                        <hr>

                                        <h2 style="padding-right:20px; padding-left:20px" >Description</h2>

                                        <p style="font-size:15px; padding-right:20px; padding-left:20px">
                                            {{ $property->description }}
                                        </p>

                                        <p style="font-size:15px; padding-right:20px; padding-left:20px">
                                            If you are interested to buy this property, please contact us through Phone: 0752 579 773 or E-mail: info@nyumbafasta.co.tz
                                        </p>

                                        <hr>

                                    </div>

                                    <div class="col-sm-3 paddingx">
                                        <div class="sidebar">
                                            <div class="sidebar-inner">
                                                <div class="widget">
                                                    <h3 class="widget-title">Share On Social Networks</h3>

                                                    <ul class="social social-boxed">
                                                        {!! $shareButtons !!}
                                                    </ul><!-- /.social-->
                                                </div><!-- /.widget -->
                                        </div><!-- /.widget -->
                                        <div class="widget">
                                            <h3 class="widget-title">Recent Properties</h3>
                                            @foreach ($recentProperties->take(3) as $property)
                                                <div class="properties-small-list">
                                                    <div class="property-small clearfix">
                                                        <div
                                                            class="property-small-picture col-sm-12 col-md-4 paddingx">
                                                            <div class="property-small-picture-inner">
                                                                <a href="{{ route('renter.houses.details', $property->id) }}"
                                                                    class="property-small-picture-target">
                                                                    <img src="{{ $property->getFirstMediaUrl('featured_image', 'thumb') }}"
                                                                        alt="">
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="property-small-content col-sm-12 col-md-8 paddingx">
                                                            <h3 class="property-small-title"><a
                                                                    href="{{ route('renter.houses.details', $property->id) }}">{{ $property->area->name }}</a>
                                                            </h3><!-- /.property-small-title -->
                                                            <div class="property-small-price">Tsh
                                                                {{ number_format($property->price) }}</div>
                                                            <!-- /.property-small-price -->
                                                        </div><!-- /.property-small-content -->
                                                    </div><!-- /.property-small -->
                                                </div><!-- /.properties-small-list -->
                                            @endforeach
                                        </div><!-- /.widget -->
                                        <div class="widget">
                                            <h3 class="widget-title">Assigned Agent</h3>

                                            <div class="agent-small">
                                                <div class="agent-small-bottom">
                                                    <ul class="list-unstyled">


                                                        <li><i class="fa fa-user"></i>
                                                            {{ $agentName }}</li>

                                                    </ul>
                                                </div><!-- /.agent-small-bottom -->
                                            </div><!-- /.agent-small -->
                                        </div><!-- /.widget -->
                                    </div><!-- /.sidebar -->
                                </div>
                            </div><!-- /.row -->
                        </div><!-- /.block-content-inner -->
                    </div><!-- /.block-content -->
                </div><!-- /.container -->
            </div><!-- /#main-inner -->
        </div><!-- /#main -->
    </div><!-- /#main-wrapper -->
    <div id="footer-wrapper ">
        <div id="footer">
            <div id="footer-inner">
                <div class="footer-top">
                    <div class="container">
                        <div class="row">
                            <div class="widget col-sm-8">
                                <h2>Our Core Values</h2>

                                <div class="row">
                                    <div class="feature col-xs-12 col-sm-6 paddingx">
                                        <div class="feature-icon col-xs-2 col-sm-2 ">
                                            <div class="feature-icon-inner">
                                                <i class="fa fa-users"></i>
                                            </div><!-- /.feature-icon-inner -->
                                        </div><!-- /.feature-icon -->

                                        <div class="feature-content col-xs-10 col-sm-10">
                                            <h3 class="feature-title">Community</h3>

                                            <p class="feature-body">
                                                We put the people of our community first
                                            </p>
                                        </div><!-- /.feature-content -->
                                    </div><!-- /.feature -->


                                    <div class="feature col-xs-12 col-sm-6 paddingx">
                                        <div class="feature-icon col-xs-2 col-sm-2 ">
                                            <div class="feature-icon-inner">
                                                <i class="fa fa-thumbs-up"></i>
                                            </div><!-- /.feature-icon-inner -->
                                        </div><!-- /.feature-icon -->

                                        <div class="feature-content col-xs-10 col-sm-10">
                                            <h3 class="feature-title">Honesty</h3>

                                            <p class="feature-body">
                                                We personally inspect properties to ensure transparent and honest
                                                listings
                                            </p>
                                        </div><!-- /.feature-content -->
                                    </div><!-- /.feature -->

                                    <div class="feature col-xs-12 col-sm-6 paddingx">
                                        <div class="feature-icon col-xs-2 col-sm-2 ">
                                            <div class="feature-icon-inner">
                                                <i class="fa fa-globe"></i>
                                            </div><!-- /.feature-icon-inner -->
                                        </div><!-- /.feature-icon -->

                                        <div class="feature-content col-xs-10 col-sm-10">
                                            <h3 class="feature-title">Diversity</h3>

                                            <p class="feature-body">
                                                We are here for everyone no matter their background.
                                            </p>
                                        </div><!-- /.feature-content -->
                                    </div><!-- /.feature -->

                                    <div class="feature col-xs-12 col-sm-6 paddingx">
                                        <div class="feature-icon col-xs-2 col-sm-2 ">
                                            <div class="feature-icon-inner">
                                                <i class="fa fa-star"></i>
                                            </div><!-- /.feature-icon-inner -->
                                        </div><!-- /.feature-icon -->

                                        <div class="feature-content col-xs-10 col-sm-10">
                                            <h3 class="feature-title">Quality</h3>

                                            <p class="feature-body">
                                                We provide quality customer care. Need assistance? We are here to
                                                help!
                                            </p>
                                        </div><!-- /.feature-content -->
                                    </div><!-- /.feature -->

                                    <div class="feature col-xs-12 col-sm-6 paddingx">
                                        <div class="feature-icon col-xs-2 col-sm-2 ">
                                            <div class="feature-icon-inner">
                                                <i class="fa fa-trophy"></i>
                                            </div><!-- /.feature-icon-inner -->
                                        </div><!-- /.feature-icon -->

                                        <div class="feature-content col-xs-10 col-sm-10">
                                            <h3 class="feature-title">Pursuit of Excellence</h3>

                                            <p class="feature-body">
                                                We aim to be the best that we can be.
                                            </p>
                                        </div><!-- /.feature-content -->
                                    </div><!-- /.feature -->

                                    <div class="feature col-xs-12 col-sm-6 paddingx">
                                        <div class="feature-icon col-xs-2 col-sm-2 ">
                                            <div class="feature-icon-inner">
                                                <i class="fa fa-gavel"></i>
                                            </div><!-- /.feature-icon-inner -->
                                        </div><!-- /.feature-icon -->

                                        <div class="feature-content col-xs-10 col-sm-10">
                                            <h3 class="feature-title">Corporate Responsibility</h3>

                                            <p class="feature-body">
                                                We have a responsibility to the individuals and groups that our
                                                company affects.
                                            </p>
                                        </div><!-- /.feature-content -->
                                    </div><!-- /.feature -->
                                </div><!-- /.row -->
                            </div><!-- /.widget -->

                            <div class="widget col-sm-4">
                                <h2>More</h2>

                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading active">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion"
                                                    href="#collapseOne">
                                                    Easy to Use
                                                </a>
                                            </h4>
                                        </div><!-- /.panel-heading -->

                                        <div id="collapseOne" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                No hussle.
                                            </div><!-- /.panel-body -->
                                        </div><!-- /.panel-heading -->
                                    </div><!-- /.panel -->

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion"
                                                    href="#collapseTwo">
                                                    Property Management
                                                </a>
                                            </h4>
                                        </div><!-- /.panel-heading -->

                                        <div id="collapseTwo" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                We manage the properties you love.
                                            </div><!-- /.panel-body -->
                                        </div><!-- /.panel-collapse -->
                                    </div><!-- /.panel -->

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion"
                                                    href="#collapseThree">
                                                    Support
                                                </a>
                                            </h4>
                                        </div><!-- /.panel-heading -->

                                        <div id="collapseThree" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div><strong>Need Help? Contact us.</strong></div>
                                                <div><strong>Phone:</strong> 0752 579 773 </div>
                                                <div><strong>E-mail:</strong> <a
                                                        href="#">info@nyumbafasta.co.tz</a>
                                                </div>

                                            </div><!-- /.panel-body -->
                                        </div><!-- /.panel-collapse -->
                                    </div><!-- /.panel -->

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion"
                                                    href="#collapseFour">
                                                    FAQ
                                                </a>
                                            </h4>
                                        </div><!-- /.panel-heading -->

                                        <div id="collapseFour" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                Have questions? Check out some FAQs.
                                            </div><!-- /.panel-body -->
                                        </div><!-- /.panel-collapse -->
                                    </div><!-- /.panel -->
                                </div><!-- /.panel-group -->
                            </div><!-- /.widget-->
                        </div><!-- /.row -->

                        <hr>

                    </div><!-- /.container -->
                </div><!-- /.footer-top -->
                <div class="footer-bottom">
                    <div class="container">
                        <p class="center no-margin">
                            &copy; 2022 NyumbaFasta, All Right reserved
                        </p>

                        <div class="center">
                            <ul class="social">
                                <li><a href="https://www.facebook.com/profile.php?id=100080232432951"
                                        target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://www.twitter.com/nyumbafasta" target="_blank"><i
                                            class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.instagram.com/nyumbafasta/" target="_blank"><i
                                            class="fa fa-instagram"></i></a></li>
                            </ul><!-- /.social -->
                        </div><!-- /.center -->
                    </div><!-- /.container -->
                </div><!-- /.footer-bottom -->
            </div><!-- /#footer-inner -->
        </div><!-- /#footer -->
    </div><!-- /#footer-wrapper -->
    </div><!-- /#wrapper -->
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&amp;sensor=true"></script>

    {{-- local --}}
    <script src="https://nyumbafasta.co.tz/js/share.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/jquery.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/gmap3.infobox.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/gmap3.clusterer.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/map.js"></script>

    <script type="text/javascript"
        src="https://nyumbafasta.co.tz/assets/libraries/bootstrap-sass/vendor/assets/javascripts/bootstrap/transition.js">
    </script>
    <script type="text/javascript"
        src="https://nyumbafasta.co.tz/assets/libraries/bootstrap-sass/vendor/assets/javascripts/bootstrap/collapse.js">
    </script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/libraries/jquery-bxslider/jquery.bxslider.min.js">
    </script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/libraries/flexslider/jquery.flexslider.js">
    </script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/jquery.chained.min.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/realocation.js"></script>

    {{-- <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/jquery.js"></script> --}}
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/libraries/isotope/jquery.isotope.min.js"></script>


</body>

</html>
