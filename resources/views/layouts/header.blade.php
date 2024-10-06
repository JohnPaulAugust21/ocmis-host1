<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'OCMIS')</title>

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->

    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    <!-- Colors CSS -->
    <link rel="stylesheet" href="{{ asset('css/colors.css') }}">

    <!-- Swiper Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('css/swiper.carousel.css') }}">

{{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css">
<script src="https://cdn.datatables.net/buttons/3.0.0/css/buttons.dataTables.css"></script> --}}




    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>


    {{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}

    @yield('dt')

    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/charts.js') }}"></script>


    <!-- Site Metas -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
        integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon" />

    @vite(['resources/js/app.js'])

</head>

<body>

    <header>

        <nav class="navbar " style="width: 100svw">
            <div class="navbar-brand">
                <div class="image-container">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 113 105"
                        fill="none">
                        <path d="M0 0H113V105H0V0Z" fill="url(#paint0_linear_9_27)" />
                        <defs>
                            <linearGradient id="paint0_linear_9_27" x1="56.5" y1="0" x2="56.5"
                                y2="105" gradientUnits="userSpaceOnUse">
                                <stop stop-color="white" />
                                <stop offset="1" stop-color="white" stop-opacity="0" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 113 105"
                        fill="none">
                        <path d="M0 105H113V0H0V105Z" fill="url(#paint0_linear_9_28)" />
                        <defs>
                            <linearGradient id="paint0_linear_9_28" x1="56.5" y1="105" x2="56.5"
                                y2="0" gradientUnits="userSpaceOnUse">
                                <stop stop-color="white" />
                                <stop offset="1" stop-color="white" stop-opacity="0" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <a href="/index.php">
                        <img src="{{ asset('images/logo.png') }}" alt="Image Description" width="100" height="100">
                    </a>
                </div>
            </div>

            <button class="navbar-toggler" id="navbar-toggler">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <div class="navbar-menu" id="navbarMenu">
                <ul>
                    @auth


                        @if (Auth::user()->role === 'admin' || Auth::user()->role === 'Admin')
                            <li class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                                <a href="{{ route('users') }}">USERS
                                    @if (request()->is('admin/users*'))
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="4"
                                            viewBox="50 0 1 4" fill="none">
                                            <path d="M2151.5 2H2247.5M0 2H96" stroke="#FFF9C1" stroke-width="3" />
                                        </svg>
                                    @endif
                                </a>
                            </li>
                            <li class="{{ request()->is('admin/niches*') ? 'active' : '' }}">
                                <a href="{{ route('buildings') }}">NICHES
                                    @if (request()->is('admin/niches*'))
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="4"
                                            viewBox="50 0 1 4" fill="none">
                                            <path d="M2151.5 2H2247.5M0 2H96" stroke="#FFF9C1" stroke-width="3" />
                                        </svg>
                                    @endif
                                </a>
                            </li>
                            <li class="{{ request()->is('admin/services*') ? 'active' : '' }}">
                                <a href="{{ route('services') }}">SERVICES
                                    @if (request()->is('admin/services*'))
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="4"
                                            viewBox="50 0 1 4" fill="none">
                                            <path d="M2151.5 2H2247.5M0 2H96" stroke="#FFF9C1" stroke-width="3" />
                                        </svg>
                                    @endif
                                </a>
                            </li>
                            <li class="{{ request()->is('admin/shop*') ? 'active' : '' }}">
                                <a href="{{ route('shopCategories') }}">SHOP
                                    @if (request()->is('admin/shop*'))
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="4"
                                            viewBox="50 0 1 4" fill="none">
                                            <path d="M2151.5 2H2247.5M0 2H96" stroke="#FFF9C1" stroke-width="3" />
                                        </svg>
                                    @endif
                                </a>
                            </li>

                            <li class="{{ request()->is('admin/forecast*') ? 'active' : '' }}">
                                <a href="{{ route('forecast') }}">FORECAST
                                    @if (request()->is('admin/forecast*'))
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="4"
                                            viewBox="50 0 1 4" fill="none">
                                            <path d="M2151.5 2H2247.5M0 2H96" stroke="#FFF9C1" stroke-width="3" />
                                        </svg>
                                    @endif
                                </a>
                            </li>
                        @endif
                    @endauth
                    @auth
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#"
                                role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                v-pre>Dashboard -
                                {{ Auth::user()->firstname . Auth::user()->lastname }}
                            </a>


                            <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('adminSetting') }}">
                                    {{ __('Setting') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    @endauth
                    <div class="navbar-menu" id="navbarMenu">
                        <ul class="navbar-nav">

                            <li class="nav-item ">
                                <div class="nav-links">
         @guest
                                <a href="{{ route('login') }}" class="nav-link">LOGIN</a>
                                <a href="{{ route('register') }}" class="nav-link">REGISTER</a>
                            @endguest
                                </div>
                            </li>
                        </ul>
                    </div>
                </ul>
            </div>




        </nav>
    </header>
    @yield('content')

    <footer>
        <div class="footer-content">
            <a href="index.php"> OCMIS 2023 </a>
            <a href="../contactus/index.php">CONTACT US</a>
        </div>
    </footer>
    @stack('jss')
    <!-- Site JS -->
    <script src="{{ asset('js/script.js') }}"></script>

    <!-- Swiper Carousel JS -->
    <script src="{{ asset('js/swiper.carousel.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>

    <!-- Sticky JS -->

    <script src="{{ url('js/sticky.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
