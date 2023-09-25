<!DOCTYPE html>
<html lang="en">

<head>
    <title>Palcomtech X Iduka</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="{{url('')}}/landingpage/fonts/icomoon/style.css">

    <link rel="stylesheet" href="{{url('')}}/landingpage/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('')}}/landingpage/css/jquery-ui.css">
    <link rel="stylesheet" href="{{url('')}}/landingpage/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{url('')}}/landingpage/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{url('')}}/landingpage/css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="{{url('')}}/landingpage/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="{{url('')}}/landingpage/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="{{url('')}}/landingpage/css/aos.css">
    <script src="{{url('')}}/landingpage/js/jquery-3.3.1.min.js"></script>
    <script src="{{url('')}}/landingpage/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="{{url('')}}/landingpage/css/style.css">

    <style>
        /* Tampilan awal menu pada layar besar */
        .main-menu {
            display: block;
        }

        /* Sembunyikan menu pada layar kecil */
        @media (max-width: 767px) {
            .main-menu {
                display: none;
            }
            .menu-toggle {
                display: block;
            }
        }

        /* Tampilkan menu saat kelas 'active' ditambahkan */
        .main-menu.active {
            display: block;
        }
        .active-page {
    
    color: white; /* Warna teks putih */
}
    </style>
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
                        <a href="#" class="small mr-3"><span class="icon-phone2 mr-2"></span>(0711) 359089</a>
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
                            <img src="{{url('')}}/landingpage/images/Logo-1.jpg" alt="Image" class="img-fluid" height="70" width="55">
                        </a>
                    </div>
                    <div class="mr-auto">
                        <nav class="menu-toggle" role="navigation">
                            <ul class="site-menu main-menu js-clone-nav mr-auto d-lg-block">
                                <li class="{{ Request::route()->getName() == 'index' ? 'active' : '' }}">
                                    <a href="{{route('index')}}" class="nav-link text-left">Beranda</a>
                                </li>
                                <li class="{{ Request::route()->getName() == 'iduka' ? 'active' : '' }}">
                                    <a href="{{route('iduka')}}" class="nav-link text-left">Pengajuan IDUKA</a>
                                </li>
                                <li class="{{ Request::route()->getName() == 'intership' ? 'active' : '' }}">
                                    <a href="{{route('intership')}}" class="nav-link text-left">Program Intership</a>
                                </li>
                                <li class="{{ Request::route()->getName() == 'berita' ? 'active' : '' }}">
                                    <a href="{{route('berita')}}" class="nav-link text-left">Berita</a>
                                </li>
                                <li class="{{ Request::route()->getName() == 'project' ? 'active' : '' }}">
                                    <a href="{{route('project')}}" class="nav-link text-left">Project</a>
                                </li>
                                <li class="{{ Request::route()->getName() == 'event' ? 'active' : '' }}">
                                    <a href="{{route('event')}}" class="nav-link text-left">Event</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="ml-auto">
                        <div class="social-wrap">
                            <a href="https://www.facebook.com/palcomtechpusat/"><span class="icon-facebook"></span></a>
                            <a href="https://www.instagram.com/palcomtech/"><span class="icon-instagram"></span></a>
                            <a href="https://www.youtube.com/c/PalComTechTVofficial"><span class="icon-youtube"></span></a>
                            <a class="menu-toggle" aria-label="Toggle Menu">
                                <span class="icon-menu h3"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        @if(Session::has('success'))
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'Berhasil !'
                    , text: '{{ Session::get('success') }}'
                    , icon: 'success'
                    , confirmButtonText: 'Tutup'
                })
            });

        </script>
        @php
        Session::forget('success');
        @endphp
        @endif

        @if(Session::has('error'))
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'Gagal !'
                    , text: '{{ Session::get('error') }}'
                    , icon: 'error'
                    , confirmButtonText: 'Tutup'
                })
            });

        </script>
        @php
        Session::forget('error');
        @endphp
        @endif

        @yield('content')

        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <p class="mb-4"><img src="{{url('')}}/landingpage/images/Logo-1.jpg" alt="Image" class="img-fluid" height="70" width="55"></p>
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
                                &copy;<script>
                                    document.write(new Date().getFullYear());
                                </script> Institut Teknologi dan Bisnis PalComTech <i class="icon-heart" aria-hidden="true"></i> All rights reserved.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- .site-wrap -->

    <script src="{{url('')}}/landingpage/js/jquery-ui.js"></script>
    <script src="{{url('')}}/landingpage/js/popper.min.js"></script>
    <script src="{{url('')}}/landingpage/js/bootstrap.min.js"></script>
    <script src="{{url('')}}/landingpage/js/owl.carousel.min.js"></script>
    <script src="{{url('')}}/landingpage/js/jquery.stellar.min.js"></script>
    <script src="{{url('')}}/landingpage/js/jquery.countdown.min.js"></script>
    <script src="{{url('')}}/landingpage/js/bootstrap-datepicker.min.js"></script>
    <script src="{{url('')}}/landingpage/js/jquery.easing.1.3.js"></script>
    <script src="{{url('')}}/landingpage/js/aos.js"></script>
    <script src="{{url('')}}/landingpage/js/jquery.fancybox.min.js"></script>
    <script src="{{url('')}}/landingpage/js/jquery.sticky.js"></script>
    <script src="{{url('')}}/landingpage/js/jquery.mb.YTPlayer.min.js"></script>
    <script src="{{url('')}}/landingpage/js/main.js"></script>
    <script>
        // Tambahkan JavaScript berikut untuk mengaktifkan menu toggle
        $(document).ready(function() {
            $(".menu-toggle").click(function() {
                $(".main-menu").toggleClass("active");
            });
        });

    </script>
</body>

