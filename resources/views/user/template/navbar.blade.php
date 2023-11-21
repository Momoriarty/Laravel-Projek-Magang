<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Arsha Bootstrap Template - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ '' }}assets/user/img/favicon.png" rel="icon">
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

    <!-- =======================================================
  * Template Name: Arsha
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body style="background-color: #001F3F">

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="{{ '/' }}">Arsha</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="{{ '/' }}" class="logo me-auto"><img src="{{ '' }}assets/user/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    @if (isset($navbar))
                        <li><a class="nav-link scrollto active" href="{{ '/' }}">Home</a></li>
                        <li><a class="nav-link scrollto" href="{{ '/code' }}">Code</a></li>
                    @else
                        <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                        <li><a class="nav-link scrollto" href="{{ '/code' }}">Code</a></li>
                        <li><a class="nav-link scrollto" href="#about">About</a></li>
                        <li><a class="nav-link scrollto" href="#services">Services</a></li>
                        <li><a class="nav-link   scrollto" href="#galery">Galery</a></li>
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
                                <a class="dropdown-item" href="{{ '/setting' }}" style="color: white;">Settings</a>
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

    @yield('user/content')

    
