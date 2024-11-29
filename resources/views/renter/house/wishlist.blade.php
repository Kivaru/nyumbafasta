
<!doctype html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="#">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://nyumbafasta.co.tz/assets/libraries/font-awesome/css/font-awesome.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="https://nyumbafasta.co.tz/libraries/jquery-bxslider/jquery.bxslider.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="https://nyumbafasta.co.tz/assets/libraries/flexslider/flexslider.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="https://nyumbafasta.co.tz/assets/css/realocation.css" media="screen, projection" id="css-main">
    <link rel="stylesheet" type="text/css" href="https://nyumbafasta.co.tz/assets/css/style.css" media="screen, projection" id="css-main">
    <link href="http://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


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

                @guest
                <ul class="header-bar-nav nav nav-register">

                <li><a href="{{ route('renter.cart') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger" style="background-color:#ff0000; border-radius: 50px; padding:2px;" >{{ $paidHousesCount }}</span></a></li>
                <li><a href="{{ route('renter.login') }}">Login</a></li>

                @if (Route::has('register'))
                <li><a href="{{ route('renter.register') }}">Register</a></li>
                @endif
                @else
                <ul class="header-bar-nav nav nav-register">
                <li><a href="{{ route('renter.cart') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger" style="background-color:#ff0000; border-radius: 50px; padding:2px;" >{{ $paidHousesCount }}</span></a></li>
                <li><a href="{{ route('renter.dashboard') }}">{{ Auth::user()->name }}</a></li>

                <li> <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a></li>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                            </li>
                </li>
                </ul>
                @endguest
        </div>
    </div>

        <div class="header-top">
            <div class="container">
                <div class="header-identity">
                    <a href="/" class="header-identity-target">
                        <span class="header-icon"><img style="width: 48px; height: 48px;" src="{{ asset('assets/img/new-logo.png') }}" alt=""></span>
                        <span style="margin-left:-35px;" class="header-title">NyumbaFasta  </span><!-- /.header-title -->
                        <span class="header-slogan">NYUMBA CHAAP <br> KIGANJANI</span><!-- /.header-slogan -->
                    </a><!-- /.header-identity-target-->
                </div><!-- /.header-identity -->





                <div class="header-actions pull-right">

                @guest
                <a href="{{ route('landlord.register') }}" class="btn btn-regular">Register as LandLord</a>
                <strong class="separator">or</strong>
                <a href="{{ route('landlord.login') }}" class="btn btn-primary"><i class="fa fa-plus"></i>Login To Submit Property</a>
                @if (Route::has('register'))
                @endif
                @else
                @if(Auth::user()->role_id == 2)
                <span style="font-size:15px" class="header-title">Welcome, {{Auth::user()->name}}</span>
                @elseif(Auth::user()->role_id == 3)
                <span style="font-size:15px" class="header-title">Welcome, {{Auth::user()->name}}</span>
                @endif
                @endguest
                </div><!-- /.header-actions -->



                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".header-navigation">
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
                    <div class ="col">

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
                    <li><a href="{{ route('renter.apartments') }}">Apartment</a></li>
                    <li><a href="{{ route('renter.standalonehouses') }}">Standalone</a></li>
                    <li><a href="{{ route('renter.sittingroomwithmasterbedrooms') }}">Sitting Room With Master Bedroom</a></li>
                    <li><a href="{{ route('renter.sittingroomwithbedrooms') }}">Sitting Room With Bedroom</a></li>
                    <li><a href="{{ route('renter.masterbedrooms') }}">Master Bedroom</a></li>
                    <li><a href="{{ route('renter.singlerooms') }}">Single Room</a></li>
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
    @if(Auth::user()->role_id == 2)
        <span style="font-size:15px" class="header-title">You have logged in as LandLord</span>
    @elseif(Auth::user()->role_id == 3)

    <div class="container">
        <div class="row">
            <ul class="header-nav nav nav-pills">
                <li><a href="{{ route('renter.cart') }}">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger" style="background-color:#ff0000; border-radius: 50px; padding:2px;" >{{ $paidHousesCount }}</span></a>
                </li>
                <li><a href="{{ route('renter.dashboard') }}">{{ Auth::user()->name }}</a></li>

                <li> <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a></li>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                            </li>
                </li>

                <li class="menuparent">
                    <a href="#">Properties</a>

                    <ul class="sub-menu">
                        <li><a href="{{ route('renter.apartments') }}">Apartment</a></li>
    <li><a href="{{ route('renter.standalonehouses') }}">Standalone</a></li>
    <li><a href="{{ route('renter.sittingroomwithmasterbedrooms') }}">Sitting Room With Master Bedroom</a></li>
    <li><a href="{{ route('renter.sittingroomwithbedrooms') }}">Sitting Room With Bedroom</a></li>
    <li><a href="{{ route('renter.masterbedrooms') }}">Master Bedroom</a></li>
    <li><a href="{{ route('renter.singlerooms') }}">Single Room</a></li>
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
                    <form method="GET" action="{{ route('search.by.id') }}" class="form-horizontal form-search">
                        <div class="form-group has-feedback no-margin">
                            <input name="searchById" type="text" class="form-control" placeholder="Search">

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
                    <div class="form-search-wrapper col-sm-3">
                    </div>
                </div>
            </div><!-- /.container -->
        </div><!-- /.header-navigation -->
    </div><!-- /.header-inner -->
</div><!-- /#header -->
</div><!-- /#header-wrapper -->
<div id="main-wrapper">
    <div id="main">
        <div id="main-inner">



            <div class="container">           <!-- ISOTOPE GRID -->
<div class="block-content block-content-small-padding">
<div class="block-content-inner">


<!-- <ul class="properties-filter">
    <li class="selected"><a href="#" data-filter="*"><span>All</span></a></li>
    <li><a href="#" data-filter=".property-featured"><span>Standalone</span></a></li>
    <li><a href="#" data-filter=".property-rent"><span>Sitting & Master Bedroom</span></a></li>
    <li><a href="#" data-filter=".property-sale"><span>Master Bedroom</span></a></li>
</ul> -->
<!-- /.property-filter -->
<h2 class="center">My Wishlist Houses</h2>
{{--
<div class="properties-items">
<div class="row"> --}}

<h3 style="color: #ff0000" class="center">{{$message}}</h3>

<body class="antialiased bg-gray-200 text-gray-900 font-sans p-6">
    <div class="container mx-auto">
      <div class="flex flex-wrap -mx-4">
        @if($myWishlist)
        @foreach($myWishlist as $house)
        <div style="" class="w-full sm:w-1/2 md:w-1/2 xl:w-1/4 p-4 shadow-xl">
          <a href="{{ route('renter.houses.details', $house->house_id) }}" class="c-card block bg-white shadow-md hover:shadow-xl rounded-lg ">
          <div style="height: 300px" class="relative pb-48 overflow-hidden">
            <img style="border-radius: 12px;" class="absolute inset-0 h-full w-full object-cover" src="{{ $house->getFirstMediaUrl('featured_image', 'thumb') }}" alt="">
            @if($house->status == 1)
             <div style="padding-left: 80px; color:white; font-size: 16px" class="ribbon bg-orange-500 text-sm whitespace-no-wrap px-4">Available</div>
            @else
            <div style="padding-left: 66px; color:black; font-size: 16px; background-color:#cecece" class="ribbon text-sm whitespace-no-wrap px-4">Not Available</div>
            @endif
          </div>
          <div class="p-4">
            @foreach($paidWishlist as $pWishlist)
            @foreach($paidHouses as $pHouse)
            @if($pHouse->house_id == $pWishlist->house_id)
            @if($pWishlist->payment_status === "COMPLETED")
            <center><h4 style="color: black" class="mt-2 mb-2  font-bold">Name: {{$pHouse->user->name}}</h4></center>
            @else
            <center><h4 style="color: black" class="mt-2 mb-2  font-bold">Name: Pay To View</h4></center>
            @endif
            @endif
            @endforeach
            @endforeach
            @foreach($paidWishlist as $pWishlist)
            @foreach($paidHouses as $pHouse)
            @if($pHouse->house_id == $pWishlist->house_id)
            @if($pWishlist->payment_status === "COMPLETED")
            <center> <a href="tel:{{$pHouse->user->contact}}"> <h4 id="number" style="color: black;" class="mt-2 mb-2  font-bold"><i style="color: gray; margin-right: 5px" class="fa fa-phone"></i> {{$pHouse->user->contact}}</a><button style="padding-left: 10px; font-size:12px" onclick="copyNumber('number')">Copy Number</button></h4></center>
            @else
            <center> <h4 style="color: black" class="mt-2 mb-2  font-bold"><i style="color: gray; margin-right: 5px" class="fa fa-phone"></i> Name: Pay To View</h4></center>
            @endif
            @endif
            @endforeach
            @endforeach
            <center><p style="color: black" class="text-sm"> <i style="color: gray; margin-right: 5px" class="fa fa-map-marker"></i> {{$house->address}}</p></center>
            <strong><div style="display: flex;justify-content: center; color:black" class="mt-3 flex items-center">
              <span class="text-sm font-semibold">Tsh</span>&nbsp;<span class="font-bold text-xl">{{number_format($house->rent)}}</span>&nbsp;<span class="text-sm font-semibold">per month</span></strong>
        </div>
          </div>
          <div class="p-4 border-t border-b text-xs text-gray-700">
            <span class="flex items-center mb-1">
                <div class="grid grid-cols-4 gap-4">
                    @if($house->tiles === "Yes")
                    <div class="property-box-meta-item col-xs-3 col-sm-3">
                        <strong>Tiles</strong><i class="fa fa-check ok"></i>
                    </div>
                    @else
                    <div class="property-box-meta-item col-xs-3 col-sm-3">
                        <strong>Tiles</strong><i class="fa fa-times"></i>
                    </div>
                    @endif
                    <!-- /.col-sm-3 -->

                    @if($house->gypsum === "Yes")
                    <div class="property-box-meta-item col-xs-3 col-sm-3">
                        <strong>Gypsum</strong><i class="fa fa-check ok"></i>
                    </div>
                    @else
                    <div class="property-box-meta-item col-xs-3 col-sm-3">
                        <strong>Gypsum</strong><i class="fa fa-times"></i>
                    </div>
                    @endif
                    <!-- /.col-sm-3 -->

                    @if($house->kitchen === "Yes")
                    <div class="property-box-meta-item col-xs-3 col-sm-3">
                        <strong>Kitchen</strong><i class="fa fa-check ok"></i>
                    </div>
                    @else
                    <div class="property-box-meta-item col-xs-3 col-sm-3">
                        <strong>Kitchen</strong><i class="fa fa-times"></i>
                    </div>
                    @endif
                    <!-- /.col-sm-3 -->

                    @if($house->fence === "Yes")
                    <div class="property-box-meta-item col-xs-3 col-sm-3">
                        <strong>Fence</strong><i class="fa fa-check ok"></i>
                    </div>
                    @else
                    <div class="property-box-meta-item col-xs-3 col-sm-3">
                        <strong>Fence</strong><i class="fa fa-times"></i>
                    </div>
                    @endif
                    <!-- /.col-sm-3 -->
                </div>
            </span>
          </div>
          <div class="p-4 border-t border-b text-xs text-gray-700">


                    <div class="property-box-meta-item col-xs-3 col-sm-3">
                    <p style="font-size: 16px; white-space: nowrap;">Luku : {{$house->luku}}</p>
                    </div>

                    @foreach($paidWishlist as $pWishlist)
                    @foreach($paidHouses as $pHouse)
                    @if($pHouse->house_id == $pWishlist->house_id)
                    @if($pWishlist->payment_status === "COMPLETED")

                        <p style="font-size: 16px; white-space: nowrap; color:#ed8936">Status : PAID</p>
                        @else
                        <a style="width: 100px; font-size: 16px; margin-left:40px" href="{{ route('renter.payhouses.details', $house->id).'#payment' }}" class="text-white bg-orange-500 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">Get Info</a>

                        <a style="width: 50px; font-size: 16px;" href="{{ route('renter.delete.wishlist', $house->wishlist_id) }}" class="text-white bg-orange-500 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800"><i class="fa fa-trash"></i></a>

                        @endif
                        @endif
                        @endforeach
                        @endforeach
                    <!-- /.col-sm-3 -->



          </div>
        </a>
        </div>
        @endforeach
        @else
        <h2 class="center">No Wishlist Houses</h2>
        @endif
      </div>
    </div>
  </body>


</div>
<!-- /.block-content-inner -->
</div><!-- /.block-content -->
<!-- CAROUSEL -->
<div class="block-content background-secondary background-map fullwidth">
<div class="block-content-inner">
<ul class="bxslider clearfix">
</ul>
</div><!-- /.block-content-inner -->
</div><!-- /.block-content -->                <!-- STATISTICS -->
<div class="block-content block-content-small-padding">
    <div class="block-content-inner">
        <div class="center">
            <h2 class="color-primary">Over 1,000 Properties In Our Directory</h2>
        </div><!-- /.center -->

        <div style="border-radius: 12px;" class="row">
            <div class="col-sm-2 col-sm-offset-2">
                <div class="block-stats background-dots background-primary color-white">
                    <strong>1000+</strong>
                    <span>Houses</span>
                </div><!-- /.block-stats -->
            </div>
            <div class="col-sm-2">
                <div class="block-stats background-dots background-primary color-white">
                    <strong>10+</strong>
                    <span>Agents</span>
                </div><!-- /.block-stats -->
            </div>
            <div class="col-sm-2">
                <div class="block-stats background-dots background-primary color-white">
                    <strong>90+</strong>
                    <span>Areas</span>
                </div><!-- /.block-stats -->
            </div>
            <div class="col-sm-2">
                <div class="block-stats background-dots background-primary color-white">
                    <strong>50+</strong>
                    <span>Apartments</span>
                </div><!-- /.block-stats -->
            </div>
        </div><!-- /.row -->
    </div><!-- /.block-content-inner -->
</div><!-- /.block-content -->                <!-- HEXS -->
<div class="block-content fullwidth background-primary background-map clearfix">
    <div class="block-content-inner row">
        <div class="hex-wrapper col-sm-4 paddingx center ">
            <div class="clearfix">
                <div class="hex col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 paddingx">
                    <div class="hex-inner">
                        <img src="assets/img/hex.png" alt="" class="hex-image">

                        <div class="hex-content">
                            <i class="fa fa-group"></i>
                        </div><!-- /.hex-content -->
                    </div><!-- /.hex-inner -->
                </div><!-- /.hex -->
            </div><!-- /.clearfix -->

            <h3>15 000+ Satisfied Users</h3>
        </div>

        <div class="hex-wrapper col-sm-4 center paddingx">
            <div class="clearfix">
                <div class="hex col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 paddingx">
                    <div class="hex-inner">
                        <img src="assets/img/hex.png" alt="" class="hex-image">

                        <div class="hex-content">
                            <i class="fa fa-search"></i>
                        </div><!-- /.hex-content -->
                    </div><!-- /.hex-inner -->
                </div><!-- /.hex -->
            </div><!-- /.clearfix -->

            <h3>Smart Property Search</h3>
        </div>

        <div class="hex-wrapper col-sm-4 center paddingx">
            <div class="clearfix">
                <div class="hex col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 paddingx" >
                    <div class="hex-inner">
                        <img src="assets/img/hex.png" alt="" class="hex-image">

                        <div class="hex-content">
                            <i class="fa fa-compass"></i>
                        </div><!-- /.hex-content -->
                    </div><!-- /.hex-inner -->
                </div><!-- /.hex -->
            </div><!-- /.clearfix -->

            <h3>We Are Here To Help You</h3>
        </div>
    </div><!-- /.block-content-inner -->
</div><!-- /.block-content -->            </div><!-- /.container -->
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
                        We personally inspect properties to ensure transparent and honest listings
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
                        We provide quality customer care. Need assistance? We are here to help!
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
                         We have a responsibility to the individuals and groups that our company affects.
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
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Easy To Use
                        </a>
                    </h4>
                </div><!-- /.panel-heading -->

                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        Yes, no hussle.
                    </div><!-- /.panel-body -->
                </div><!-- /.panel-heading -->
            </div><!-- /.panel -->

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
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
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            Support
                        </a>
                    </h4>
                </div><!-- /.panel-heading -->

                <div id="collapseThree" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div><strong>Need Help? Contact us.</strong></div>
                        <div><strong>Phone:</strong> 0752 579 773 </div>
                        <div><strong>E-mail:</strong> <a href="#">info@nyumbafasta.co.tz</a></div>

                    </div><!-- /.panel-body -->
                </div><!-- /.panel-collapse -->
            </div><!-- /.panel -->

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
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
                        &copy; 2022 NyumbaFasta, All Rights reserved.
                        </p>

                        <div class="center">
                            <ul class="social">
                                <li><a href="https://www.facebook.com/profile.php?id=100080232432951" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://www.twitter.com/nyumbafasta" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.instagram.com/nyumbafasta/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            </ul><!-- /.social -->
                        </div><!-- /.center -->
                    </div><!-- /.container -->
                </div><!-- /.footer-bottom -->
            </div><!-- /#footer-inner -->
        </div><!-- /#footer -->
    </div><!-- /#footer-wrapper -->
</div><!-- /#wrapper -->

<script type="text/javascript">

    $(document).ready(function () {
            $('#region').on('change',function(e){
            console.log(e);
            var region_id = e.target.value;
            console.log(region_id);
            //ajax
            $.get('ajax/district?region_id='+ region_id,function(data){
                //success data
               console.log(data);
                var district =  $('#district').empty();
                $('#district').append('<option value="Choose">Select District</option>');
                $.each(data,function(create,districtObj){
                    var option = $('<option/>', {id:create, value:districtObj});
                    district.append('<option value ="'+create+'">'+districtObj+'</option>');
                });
            });
        });
    });

</script>
<style>
  .ribbon {
    top: 0;
    right: 0;
    width: 237px;
    height: 25px;
    margin-left: -67px;
    margin-top: 33px;
    -ms-transform: rotate(45deg);
    -webkit-transform: rotate(345deg);
    transform: rotate(321deg);
}
</style>

<script type="text/javascript">

    $(document).ready(function () {
            $('#district').on('change',function(e){
            console.log(e);
            var district_id = e.target.value;
            console.log(district_id);
            //ajax
            $.get('ajax/area?area_id='+ district_id,function(data){
                //success data
               console.log(district_id);
                var area =  $('#area').empty();
                $.each(data,function(create,areaObj){
                    var option = $('<option/>', {id:create, value:areaObj});
                    area.append('<option value ="'+areaObj+'">'+areaObj+'</option>');
                });
            });
        });
    });

</script>

<script type="text/javascript">

    function copyNumber(id) {
    var text = document.getElementById(id).innerText;
    var newText = text.replace('Copy Number','');
    var elem = document.createElement("textarea");
    document.body.appendChild(elem);
    elem.value = newText;
    elem.select();
    document.execCommand("copy");
    document.body.removeChild(elem);
    }

</script>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&amp;sensor=true"></script>

<script src="https://nyumbafasta.co.tz/js/share.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/jquery.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/gmap3.infobox.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/gmap3.clusterer.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/map.js"></script>

    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/libraries/bootstrap-sass/vendor/assets/javascripts/bootstrap/transition.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/libraries/bootstrap-sass/vendor/assets/javascripts/bootstrap/collapse.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/libraries/jquery-bxslider/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/libraries/flexslider/jquery.flexslider.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/jquery.chained.min.js')}}"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/realocation.js"></script>

    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/jquery.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/libraries/isotope/jquery.isotope.min.js"></script>

</body>
</html>
