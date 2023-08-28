<!DOCTYPE html>
<html lang="en">

<head>
    <title>Palcomtech X Iduka</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="landingpage/fonts/icomoon/style.css">

    <link rel="stylesheet" href="landingpage/css/bootstrap.min.css">
    <link rel="stylesheet" href="landingpage/css/jquery-ui.css">
    <link rel="stylesheet" href="landingpage/css/owl.carousel.min.css">
    <link rel="stylesheet" href="landingpage/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="landingpage/css/owl.theme.default.min.css">

    <link rel="stylesheet" href="landingpage/css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="landingpage/css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="landingpage/fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="landingpage/css/aos.css">
    <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="landingpage/css/style.css">
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>


        <div class="py-2 bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-9 d-none d-lg-block">
                        <a href="#" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> Have a questions?</a>
                        <a href="#" class="small mr-3"><span class="icon-phone2 mr-2"></span>(0711) 359089 </a>
                        <a href="mailto:info@palcomtech.ac.id" class="small mr-3"><span class="icon-envelope-o mr-2"></span> info@palcomtech.ac.id</a>
                        <a href="https://api.whatsapp.com/send?phone=+6281271788080" class="small mr-3"><span class="icon-whatsapp"></span> 081271788080</a>
                    </div>
                    <div class="col-lg-3 text-right">
                        <a href="{{route('login')}}" class="small mr-3"><span class="icon-unlock-alt"></span> Log In</a>
                        <a href="{{route('register')}}" class="small btn btn-primary px-4 py-2 rounded-0"><span class="icon-users"></span> Register</a>
                    </div>
                </div>
            </div>
        </div>
        <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

            <div class="container">
                <div class="d-flex align-items-center">
                    <div class="site-logo">
                        <a href="{{route('index')}}" class="d-block">
                            <img src="landingpage/images/Logo-1.jpg" alt="Image" class="img-fluid" height="70" width="55">
                        </a>
                    </div>
                    <div class="mr-auto">
                        <nav class="site-navigation position-relative text-right" role="navigation">
                            <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                                 <li class="{{ Request::route()->getName() == 'index' ? 'active' : '' }}">
                                    <a href="{{route('index')}}" class="nav-link text-left">Beranda</a>
                                </li>
                                <li class="{{ Request::route()->getName() == 'iduka' ? 'active' : '' }}">
                                    <a href="{{route('iduka')}}" class="nav-link text-left">Pengajuan IDUKA</a>
                                </li>
                                <li class="{{ Request::route()->getName() == 'intership' ? 'active' : '' }}">
                                    <a href="{{route('intership')}}" class="nav-link text-left">Program Intership</a>
                                </li>
                                {{-- <li class="{{ Request::route()->getName() == 'kontak' ? 'active' : '' }}">
                                    <a href="{{route('kontak')}}" class="nav-link text-left">Kontak Kami</a>
                                </li> --}}





                                {{-- <li class="has-children">
                                    <a href="about.html" class="nav-link text-left">About Us</a>
                                    <ul class="dropdown">
                                        <li><a href="teachers.html">Iduka Partner</a></li>
                                        <li><a href="about.html">About me</a></li>
                                    </ul>
                                </li> --}}
                                
                            </ul>
                            </ul>
                        </nav>

                    </div>
                    <div class="ml-auto">
                        <div class="social-wrap">
                            <a href="https://www.facebook.com/palcomtechpusat/"><span class="icon-facebook"></span></a>
                            <a href="https://www.instagram.com/palcomtech/"><span class="icon-instagram"></span></a>
                            <a href="https://www.youtube.com/c/PalComTechTVofficial"><span class="icon-youtube"></span></a>

                            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a>
                        </div>
                    </div>

                </div>
            </div>

        </header>

        @yield('content')

        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <p class="mb-4"><img src="landingpage/images/Logo-1.jpg" alt="Image" class="img-fluid" height="70" width="55"></p>
                        <p>Kerja sama Palcomtech dan Iduka</p>
                        <p><a href="https://palcomtech.ac.id">lebih lanjut</a></p>
                    </div>
                    <div class="col-lg-3">
                        <h3 class="footer-heading"><span>About Campus</span></h3>
                        <ul class="list-unstyled">
                            <li><a href="https://goo.gl/maps/SyB8ZqvgAEQEcmx58">Alamat</a></li>
                            Jl. Jend. Basuki Rahmat No. 05, Talang Aman, Kec. Kemuning, Kota Palembang, Sumatera Selatan
                            <p></p>
                            <li><a href="https://palcomtech.ac.id/">Open</a></li>

                            <li>Senin s/d Jumat : 8:00 – 16:00</li>
                            Sabtu: 8:00 – 12:00
                        </ul>
                    </div>
                    <div class="col-lg-3">
                        <h3 class="footer-heading"><span>Contact</span></h3>
                        <ul class="list-unstyled">
                            <li><a href="#">Email</a></li>
                            info@palcomtech.ac.id
                            <p></p>
                            <li><a href="">whatsapp</a></li>
                            081271788080
                            <p></p>
                            <li><a href="">No telepon</a></li>
                            (0711) 359089
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="copyright">
                            <p>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                &copy;<script>
                                    document.write(new Date().getFullYear());

                                </script> Institut Teknologi dan Bisnis PalComTech <i class="icon-heart" aria-hidden="true"></i> All rights reserved.
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- .site-wrap -->

    <!-- loader 
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#51be78"/></svg></div>
    -->

    <script src="landingpage/js/jquery-3.3.1.min.js"></script>
    <script src="landingpage/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="landingpage/js/jquery-ui.js"></script>
    <script src="landingpage/js/popper.min.js"></script>
    <script src="landingpage/js/bootstrap.min.js"></script>
    <script src="landingpage/js/owl.carousel.min.js"></script>
    <script src="landingpage/js/jquery.stellar.min.js"></script>
    <script src="landingpage/js/jquery.countdown.min.js"></script>
    <script src="landingpage/js/bootstrap-datepicker.min.js"></script>
    <script src="landingpage/js/jquery.easing.1.3.js"></script>
    <script src="landingpage/js/aos.js"></script>
    <script src="landingpage/js/jquery.fancybox.min.js"></script>
    <script src="landingpage/js/jquery.sticky.js"></script>
    <script src="landingpage/js/jquery.mb.YTPlayer.min.js"></script>
    <script src="landingpage/js/main.js"></script>

</body>

</html>
