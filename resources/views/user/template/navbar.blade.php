<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ ucwords(config('app.settings.nama')) }}</title>

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ config('app.settings.favicon') }}" type="image/x-icon">
    <link href="{{ '' }}assets/user/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS File('')-->
    <link href="{{ asset('') }}assets/user/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/user/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/user/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/user/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/user/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/user/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/user/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main C(('')) File -->
    <link href="{{ asset('') }}assets/user/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- =======================================================
  * Template Name: Arsha
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
    .portfolio-img {
        position: relative;
        overflow: hidden;
        height: 0;
        padding-top: 56.25%;
        border: 1px solid black;
    }

    .background-img {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-size: cover;
        background-position: center;
        filter: blur(10px);
        -webkit-filter: blur(10px);
    }

    .img-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .img-overlay img {
        max-width: 100%;
        max-height: 100%;
        border: 2px solid black;
    }
</style>

<body style="background-color: #001F3F">

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="{{ '/' }}">{{ ucwords(config('app.settings.nama')) }}</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="{{ '/' }}" class="logo me-auto"><img src="{{ '' }}assets/user/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    @if (isset($navbar))
                        <li><a class="nav-link scrollto" href="{{ '/' }}">Home</a></li>
                        <li><a class="nav-link scrollto {{ $_GET['id'] ?? 'active' }}"
                                href="{{ '/code' }}">Code</a></li>
                    @else
                        <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                        <li><a class="nav-link scrollto" href="{{ '/code' }}">Code</a></li>
                        <li><a class="nav-link scrollto" href="#about">About</a></li>
                        <li><a class="nav-link scrollto" href="#galery">Galery</a></li>
                        <li><a class="nav-link scrollto" href="#team">Team</a></li>
                    @endif



                    @if (Auth::check())
                        <div class="dropdown">
                            <button class="getstarted scrollto" style="background-color: black" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fas fa-user"></i>
                            </button>
                            <div class="dropdown-menu" style="background-color: rgb(21, 148, 160); padding: 10px;"
                                aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ '/profile' }}" style="color: white;">Profile</a>
                                <div class="dropdown-divider" style="background-color: white;"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="getstarted scrollto"
                                        style="color: black; padding: 5px 10px; border: none; cursor: pointer;">Logout</button>
                                </form>
                            </div>

                        </div>
                    @else
                        <li><a class="getstarted scrollto" href="{{ '/auth' }}">Login / Register</a></li>
                    @endif




                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    @if (session('session') || $errors->any())
        <div class="toast-container position-fixed top-0 start-0 mt-5 p-3" style="z-index: 11">
            @if (session('session'))
                <div class="toast align-items-center text-white bg-{{ session('session_type') }} shadow-lg rounded-3"
                    role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000" style="width: 400px;">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('session') }}
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="toast align-items-center text-white bg-danger shadow-lg rounded-3" role="alert"
                    aria-live="assertive" aria-atomic="true" data-delay="4000" style="width: 400px;">
                    <div class="d-flex">
                        <div class="toast-body">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize the toasts
                var toasts = document.querySelectorAll('.toast');
                toasts.forEach(function(toastElement) {
                    var toast = new bootstrap.Toast(toastElement);
                    toast.show();
                });
            });
        </script>
    @endif




    @yield('user/content')

    @include('user/template/footer')
