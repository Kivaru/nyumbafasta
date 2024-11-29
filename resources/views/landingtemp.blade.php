<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Nyumbafasta | Landing Page</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="landing/assets/favicon.ico" />
    <!-- Bootstrap Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic"
        rel="stylesheet" type="text/css" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="landing/css/styles.css" rel="stylesheet" />






    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-T20NRBCSNT"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-T20NRBCSNT');
    </script>

</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
            <span class="header-icon"><img style="width: 48px; height: 48px;margin-bottom:-10px"
                    src="{{ asset('assets/img/new-logo.png') }}" alt=""></span>
            <a style="padding-left:-80px" class="navbar-brand" href="#page-top">Nyumbafasta</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('houses.rent.welcome') }}">{{ __('home.property-rent') }}</a></li>
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('houses.sale.welcome') }}">{{ __('home.sale') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about.us') }}">{{ __('home.about') }}</a>
                    </li>
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('contact.us') }}">{{ __('home.contact_us') }}</a></li>
                </ul>
                <div>
                </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100" style="margin-top:50px;">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    {{-- <h1 class="text-white font-weight-bold">{{__('home.welcome')}}</h1> --}}
                    <br>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <a class="btn btn-primary btn-xl"
                        href="{{ route('houses.rent.welcome') }}">{{ __('home.property-rent') }}</a>
                    <hr class="divider" />
                    <a class="btn btn-primary btn-xl" href="{{ route('houses.sale.welcome') }}">{{ __('home.sale') }}
                    </a>
                    <hr class="divider" />
                    <a class="btn btn-primary btn-xl"
                        href="{{ route('landlord.register') }}">{{ __('home.land_lord_register') }}
                    </a>

                    <div style="margin-top:50px;">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Change Language
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" method="lang/{lang}">
                            <li><a class="dropdown-item" href="{{ route('lang.switch', 'sw') }}"><img src='/img/tz.png'
                                        height='20' width='20'>Swahili</a></li>
                            <li><a class="dropdown-item" href="{{ route('lang.switch', 'en') }}"><img class='email'
                                        src='/img/eng.png' height='20' width='20'>English</a></li>

                        </ul>

                    </div>

                    <!-- Footer-->

                </div>



            </div>

        </div>

    </header>

    <footer class="bg-light py-5">
        <div class="container px-4 px-lg-5">
            <div class="small text-center text-muted">Copyright &copy; 2023 - Nyumbafasta By Valleypay</div>
        </div>
    </footer>







    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->
    <script src="landing/js/scripts.js"></script>

    <!--Start of Tawk.to Script-->
    {{-- <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/6502ea2ab1aaa13b7a76d360/1ha9m5dpg';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script> --}}
    <!--End of Tawk.to Script-->




    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>
