    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">

        <title>{{ config('app.name') }}</title>


        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Favicon -->
        <link href="{{ asset('img/logo.png') }}" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        {{-- <link
            href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap"
            rel="stylesheet"> --}}

        <!-- Icon Font Stylesheet (CDN aman, tidak perlu asset) -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

        <!-- Bootstrap -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <style>
            .page-header {

                background:
                    linear-gradient(rgba(24, 29, 56, .7), rgba(24, 29, 56, .7)),

                    url('{{ $header && $header->image ? asset('uploads/header/' . $header->image) : asset('img/about1.jpg') }}');

                background-position: center center;
                background-repeat: no-repeat;
                background-size: cover;

                height: 450px;
            }
        </style>
    </head>

    <body>
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        @include('layout.navbar')
        <!-- Navbar End -->


        @yield('content')

        <footer class="container-fluid footer-bg text-light mt-5 py-5">

            <div class="row gx-5 gy-4 px-5 align-items-start mx-0">

                <!-- LOGO + CONTACT -->
                <div class="col-lg-5 col-md-12">

                    <div class="d-flex align-items-start">

                        <!-- Logo -->
                        <img src="{{ asset('img/logo-kkp.png') }}" alt="Logo AKKP" class="footer-logo-large">

                        <!-- Contact -->
                        <div class="ms-4">

                            <h4 class="footer-title">
                                Kontak Kami
                            </h4>

                            <p class="footer-text">
                                <i class="fa fa-map-marker-alt me-2"></i>
                                Jalan Soekarno Hatta, Matahora, Wakatobi
                            </p>

                            <p class="footer-text">
                                <i class="fa fa-phone-alt me-2"></i>
                                +62 xxx xxxx xxxx
                            </p>

                            <p class="footer-text">
                                <i class="fa fa-envelope me-2"></i>
                                akkpwakatobi@kkp.go.id
                            </p>

                        </div>

                    </div>

                </div>


                <!-- MENU WEBSITE -->
                <div class="col-lg-3 col-md-6">

                    <h4 class="footer-title">
                        Menu Website
                    </h4>

                    <ul class="footer-links list-unstyled">

                        <li>
                            <a href="{{ route('home.index') }}">
                                Beranda
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('about.index') }}">
                                Profil
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('berita.index') }}">
                                Berita
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('video.user') }}">
                                Video
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('contact') }}">
                                Kontak
                            </a>
                        </li>

                    </ul>

                </div>


                <!-- LOKASI -->
                <div class="col-lg-4 col-md-6">

                    <h4 class="footer-title">
                        Lokasi Kampus
                    </h4>

                    <div class="footer-map-wrapper">

                        <iframe src="https://www.google.com/maps?q=AKKP%20Wakatobi&output=embed" loading="lazy">
                        </iframe>

                    </div>

                </div>

            </div>


            <!-- COPYRIGHT -->
            <div class="border-top border-secondary mt-5 pt-4 text-center small">

                © {{ date('Y') }}
                <strong>AKKP Wakatobi</strong>. All Rights Reserved

            </div>

        </footer>




        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

        <a href="https://www.lapor.go.id" class="lapor-float" target="_blank">
            <img src="{{ asset('img/lapor.jpg') }}" alt="LAPOR!">
        </a>

        <a href="/akkp-hebat" class="akkp-float-img" target="_blank">
            <img src="{{ asset('img/AKKP-HEBAT.png') }}" alt="AKKP Hebat">
        </a>


        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

        <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
        <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Template Javascript -->
        <script src="{{ asset('js/main.js') }}"></script>


        <script>
            $(document).ready(function() {
                $(".header-carousel").owlCarousel({
                    autoplay: true,
                    smartSpeed: 1500,
                    items: 1,
                    loop: true,
                    dots: true,
                    nav: false
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $(".testimonial-carousel").owlCarousel({
                    autoplay: true,
                    smartSpeed: 1000,
                    center: true,
                    dots: true,
                    loop: true,
                    margin: 30,
                    responsive: {
                        0: {
                            items: 1
                        },
                        768: {
                            items: 2
                        },
                        992: {
                            items: 3
                        }
                    }
                });
            });
        </script>

        <script>
            const backToTop = document.querySelector(".back-to-top");

            window.addEventListener("scroll", () => {
                if (window.scrollY > 200) {
                    backToTop.classList.add("show");
                } else {
                    backToTop.classList.remove("show");
                }
            });

            backToTop.addEventListener("click", function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: "smooth"
                });
            });
        </script>

        <script>
            const currentLocation = window.location.pathname;
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentLocation) {
                    link.classList.add('active');
                }
            });

            (function($) {
                "use strict";

                // Spinner
                var spinner = function() {
                    setTimeout(function() {
                        if ($('#spinner').length > 0) {
                            $('#spinner').removeClass('show');
                        }
                    }, 1);
                };
                spinner();

            })(jQuery);
        </script>

    </body>

    </html>
