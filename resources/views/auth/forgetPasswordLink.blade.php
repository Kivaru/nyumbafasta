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

    <link href="http://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <style type="text/css">
        .eyespan {
            float: right;
            margin-right: 6px;
            margin-top: -20px;
            position: relative;
            z-index: 2;
            color: black;
        }
    </style>

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

                            <ul class="header-bar-nav nav nav-register">
                                <li><a href="{{ route('renter.cart') }}"><i class="fa fa-shopping-cart"
                                            aria-hidden="true"></i> Cart <span
                                            class="badge badge-pill badge-danger"></span></a></li>
                                <li><a href="{{ route('renter.login') }}">Login</a></li>
                                <li><a href="{{ route('renter.register') }}">Register</a></li>
                                <!-- <li><a href="renew-password.html">Renew Password</a></li> -->
                            </ul>
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
                            </div><!-- /.header-identity -->

                            <div class="header-actions pull-right">
                                <a href="{{ route('landlord.register') }}" class="btn btn-regular">Register as
                                    LandLord</a> <strong class="separator">or</strong> <a
                                    href="{{ route('landlord.login') }}" class="btn btn-primary"><i
                                        class="fa fa-plus"></i>Login To Submit Property</a>
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
                                <ul class="header-nav nav nav-pills">
                                    <li>
                                        <a href="/">Home</a>
                                    </li>

                                    <li class="menuparent">
                                        <a href="#">Property Types</a>

                                        <ul class="sub-menu">
                                            <li><a href="{{ route('renter.apartments') }}">Apartment</a></li>
                                            <li><a href="{{ route('renter.standalonehouses') }}">Standalone</a></li>
                                            <li><a href="{{ route('renter.sittingroomwithmasterbedrooms') }}">Sitting
                                                    Room With Master Bedroom</a></li>
                                            <li><a href="{{ route('renter.sittingroomwithbedrooms') }}">Sitting Room
                                                    With Bedroom</a></li>
                                            <li><a href="{{ route('renter.masterbedrooms') }}">Master Bedroom</a></li>
                                            <li><a href="{{ route('renter.singlerooms') }}">Single Room</a></li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="{{ route('about.us') }}">About Us</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('contact.us') }}">Contact</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('faqs') }}">FAQ</a>
                                    </li>
                                </ul><!-- /.header-nav -->
                                <div class="form-search-wrapper col-sm-3">
                                    <form method="post" action="?" class="form-horizontal form-search">
                                        <div class="form-group has-feedback no-margin">
                                            <input type="text" class="form-control" placeholder="Search">

                                            <span class="form-control-feedback">
                                                <i class="fa fa-search"></i>
                                            </span><!-- /.form-control-feedback -->
                                        </div><!-- /.form-group -->
                                    </form>
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
                    <div class="container">
                        <div class="block-content block-content-small-padding">
                            <div class="block-content-inner">
                                <div class="row">
                                    <div class="col-sm-4 col-sm-offset-4">
                                        <h2 class="center">Reset Password</h2>

                                        @if (Session::has('message'))
                                            <div class="alert alert-success" role="alert">
                                                {{ Session::get('message') }}
                                            </div>
                                        @endif

                                        <div class="box">
                                            <form action="{{ route('reset.password.post') }}" method="POST">
                                                @csrf
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif

                                                <input type="hidden" name="token" value="{{ $token }}">

                                                <div class="form-group">
                                                    <label>E-Mail Address</label>
                                                    <input name="email" value="{{ old('email') }}"
                                                        type="email" class="form-control"
                                                        placeholder="Enter your E-Mail Address">
                                                </div><!-- /.form-group -->


                                                <div class="form-group">
                                                    <label>{{ __('Password') }}</label>
                                                    <input placeholder="Enter Your Password" id="password"
                                                        type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" required autocomplete="new-password" id="password">

                                                        <i class="far fa-eye eyespan" id="togglePassword"
                                                        style="cursor: pointer;"></i>

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div><!-- /.form-group -->

                                                <div class="form-group">
                                                    <label>{{ __('Confirm Password') }}</label>
                                                    <input placeholder="Repeat Your Password" id="password-confirm"
                                                        type="password" class="form-control"
                                                        name="password_confirmation" required
                                                        autocomplete="new-password" id="password">

                                                        <i class="far fa-eye eyespan" id="togglePassword"
                                                        style="cursor: pointer;"></i>
                                                </div><!-- /.form-group -->

                                                <div class="form-group">
                                                    <input type="submit" value="Reset Password"
                                                        class="btn btn-primary btn-inversed btn-block">
                                                </div>
                                                <!-- /.form-group -->
                                            </form>
                                        </div><!-- /.box -->
                                    </div>
                                </div><!-- /.row -->
                            </div><!-- /.block-content-inner -->
                        </div><!-- /.block-content -->
                    </div><!-- /.container -->
                </div><!-- /#main-inner -->
            </div><!-- /#main -->
        </div><!-- /#main-wrapper -->

        <div id="footer-wrapper">
            <div id="footer">
                <div id="footer-inner">

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

    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function () {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle('fa-eye-slash');
        });

        // prevent form submit
        const form = document.querySelector("form");
        form.addEventListener('submit', function (e) {
            e.preventDefault();
        });
    </script>

    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&amp;sensor=true"></script>
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

    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/js/jquery.js"></script>
    <script type="text/javascript" src="https://nyumbafasta.co.tz/assets/libraries/isotope/jquery.isotope.min.js"></script>

</body>

</html>
