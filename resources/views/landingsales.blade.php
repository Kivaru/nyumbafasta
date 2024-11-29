
<!doctype html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/x-icon" href="landing/assets/favicon.ico" />
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://nyumbafasta.co.tz/assets/libraries/font-awesome/css/font-awesome.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="https://nyumbafasta.co.tz/assets/libraries/jquery-bxslider/jquery.bxslider.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="https://nyumbafasta.co.tz/assets/libraries/flexslider/flexslider.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="https://nyumbafasta.co.tz/assets/css/realocation.css" media="screen, projection" id="css-main">
    <link rel="stylesheet" type="text/css" href="https://nyumbafasta.co.tz/assets/css/style.css" media="screen, projection" id="css-main">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-T20NRBCSNT"></script>
    <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());
                gtag('config', 'G-T20NRBCSNT');
    </script>

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

                <li><a href="{{ route('renter.cart') }}"><i class="fa fa-shopping-cart" aria-hidden="true"  ></i> Cart <span class="badge badge-pill badge-danger" style="background-color:#ff0000; border-radius: 50px; padding:2px;" >{{ $paidHousesCount }}</span></a></li>
                <li><a href="{{ route('renter.wishlist') }}"><i class="fa fa-heart" aria-hidden="true"  ></i> Wishlist </a></li>
                <li><a href="{{ route('renter.login') }}">Login</a></li>
                @if (Route::has('register'))
                <li><a href="{{ route('renter.register') }}">Register</a></li>
                @endif
                @else
                <ul class="header-bar-nav nav nav-register">
                <li  style="background-color:#ff0000; border-radius: 50px;"><a href="{{ route('renter.cart') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ $paidHousesCount }}</span></a></li>
                <li  style="background-color:#ff0000; border-radius: 50px;"><a href="{{ route('renter.wishlist') }}"><i class="fa fa-heart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ $wishlistCount }}</span></a></li>
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
                        <span class="header-icon"><img style="width: 48px; height: 48px; margin-left:-14px;margin-bottom:-40px" src="{{ asset('assets/img/new-logo.png') }}" alt=""></span>
                        <span class="header-title">NyumbaFasta  </span><!-- /.header-title -->
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
                    <span style="font-size:8px; color:#eb8000;" class="header-title">Menu</span>
                    <span style="margin-top: -6px" class="icon-bar"></span>
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
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ $paidHousesCount }}</span></a>
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
                    <form method="GET" action="{{ route('general.search') }}" class="form-horizontal form-search">
                        <div class="form-group has-feedback no-margin">
                            <input name="term" type="text" class="form-control" placeholder="Search(area, rent, house id)">

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

                            <!-- SLOGAN -->
<div class="block-content background-primary background-map block-content-small-padding fullwidth">
    <div class="block-content-inner">
        <h2 class="no-margin center caps">
        "Nyumba Chaap Kiganjani" -
            <br>Finding a home has never been easier </h2>
    </div><!-- /.block-content-iner -->
</div><!-- /.block-content-->

<h2 class="center">Featured Properties</h2>

@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif

{{--
<div class="properties-items">
<div class="row"> --}}

<body class="antialiased bg-gray-200 text-gray-900 font-sans p-6">
    <div class="container mx-auto">
      <div class="flex flex-wrap -mx-4">
        @foreach($properties as $property)
        <div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/4 p-4 shadow-xl">
          <a href="{{ route('renter.property.details', $property->id).'#images' }}" class="c-card block bg-white rounded-lg overflow-hidden">
            <div class="p-4">
                <center><h4 style="color: black" class="mt-2 mb-2  font-bold"> {{$property->area->name}}</h4></center>
                <center><p style="color: black" class="text-sm">{{$property->address}}</p></center>
                <strong><div style="display: flex;justify-content: center; color:black" class="mt-3 flex items-center">
                  <span class="text-sm font-semibold">Tsh</span>&nbsp;<span class="font-bold text-xl">{{number_format($property->price)}}</strong>
                </div>
              </div>
          <div style="height: 300px" class="relative pb-48 overflow-hidden">
            <img style="border-radius: 12px;" class="absolute inset-0 h-full w-full object-cover" src="{{ $property->getFirstMediaUrl('featured_image', 'thumb') }}" alt="">
            @if($property->status == 1)
             <div style="padding-left: 80px; color:white; font-size: 16px" class="ribbon bg-orange-500 text-sm whitespace-no-wrap px-4">For Sale</div>
            @else
            <div style="padding-left: 66px; color:black; font-size: 16px; background-color:#cecece" class="ribbon text-sm whitespace-no-wrap px-4">Sold</div>
            @endif
          </div>

          <div class="p-4 border-t border-b text-xs text-gray-700">
            <span class="flex items-center mb-1">

                <div class="flex justify-between items-center">
                    <p style="font-size: 16px; white-space: nowrap; padding-top:25px">Property Type : {{$property->property_type}}</p>

                    <!-- /.col-sm-3 -->

            </span>
          </div>
        </a>
        </div>
      </div>
      @endforeach
    </div>
  </body>

  <div class="text-center">
    {{ $properties->links() }}
</div>


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
                                <li><a href="https://twitter.com/nyumbafasta" target="_blank"><i class="fa fa-twitter"></i></a></li>
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
                console.log(district);
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

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=true"></script>

<script src="https://nyumbafasta.co.tz/js/share.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/jquery.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/gmap3.infobox.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/gmap3.clusterer.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/map.js"></script>

    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/libraries/bootstrap-sass/vendor/assets/javascripts/bootstrap/transition.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/libraries/bootstrap-sass/vendor/assets/javascripts/bootstrap/collapse.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/libraries/jquery-bxslider/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/libraries/flexslider/jquery.flexslider.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/jquery.chained.min.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/realocation.js"></script>

    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/jquery.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/libraries/isotope/jquery.isotope.min.js"></script>


</body>
</html>
