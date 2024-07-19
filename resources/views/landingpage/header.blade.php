<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rumah | Yatim</title>

    <link href="{{url('landingpage/images/logo.png')}}" rel="shortcut icon">

    <!-- CSS FILES -->
    <link href="{{ asset ('landingpage/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset ('landingpage/css/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset ('landingpage/css/templatemo-kind-heart-charity.css') }}" rel="stylesheet">
    <!--

TemplateMo 581 Kind Heart Charity

https://templatemo.com/tm-581-kind-heart-charity

-->

</head>

<body id="section_1">

    <header class="site-header">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-12 d-flex flex-wrap">
                    <p class="d-flex me-4 mb-0">
                        <i class="bi-geo-alt me-2"></i>
                        Ciriung, Cibinong, Kab.Bogor
                    </p>

                    <p class="d-flex mb-0">
                        <i class="bi-envelope me-2"></i>

                        <a href="khairulummah@gmail.com">
                           khairulummah@gmail.com
                        </a>
                    </p>
                </div>

                <div class="col-lg-3 col-12 ms-auto d-lg-block">
                    <ul class="social-icon">
                    @guest
                        @if (Route::has('login'))
                        <li class="social-icon-item">
                            <a class="social-icon-link bi-login" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="social-icon-item">
                        <a href="{{ route('logout') }}" class="social-icon-link bi-login" title="Logout" 
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                    </ul>
                </div>

            </div>
        </div>
    </header>
