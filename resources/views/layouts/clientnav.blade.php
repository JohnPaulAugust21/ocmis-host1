<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title', 'OCMIS | Welcome')</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/shop.js') }}"></script>
    <script src="{{ asset('js/service.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/swiper.carousel.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
        integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand text-light fs-4" href="{{ route('home') }}">OCMIS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link fs-5 @if (request()->is('home*')) fw-bold active fs-4 @endif text-light"
                            href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 @if (request()->is('niche*')) fw-bold active fs-4 @endif text-light"
                            href="{{ route('tranNiche') }}">Niches</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 @if (request()->is('service*')) fw-bold active fs-4 @endif text-light"
                            href="{{ route('tranService') }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 @if (request()->is('shop/product*')) fw-bold active fs-4 @endif text-light"
                            href="{{ route('tranShop') }}">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 @if (request()->is('memorial*')) fw-bold active fs-4 @endif text-light"
                            href="{{ route('memorials') }}">Memorials</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link fs-5 @if (request()->is('me/transaction*')) fw-bold active fs-4 @endif text-light"
                                href="{{ route('myRequests') }}">My Transactions</a>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link fs-5 @if (request()->is('about*')) fw-bold active fs-4 @endif text-light"
                            href="{{ route('aboutUs') }}">About us</a>
                    </li>

                </ul>
                <ul class="navbar-nav ms-auto">
                    @auth
                        @if (Auth::user()->role === 'admin' || Auth::user()->role === 'Admin')
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('users') }}">Go to Dashboard </a>
                            </li>
                        @endif
                    @endauth
                    <li class="nav-item px-3">
                        <button class="btn btn-outline-light " data-bs-toggle="modal"
                            data-bs-target="#shoppingCartModal">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-light text-dark ms-1 rounded-pill" id="cartItemCount">0</span>
                        </button>
                    </li>
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('userSetting') }}">
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
                    @endguest
                </ul>
            </div>
        </div>
        </div>
    </nav>


    @yield('content')
    {{-- //// Cartt ///// --}}
    <div class="modal fade" id="shoppingCartModal" tabindex="-1" aria-labelledby="shoppingCartModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shoppingCartModalLabel">Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="cartItemsContainer">
                        <i class="fa fa-times-circle-o fa-3x openCloseCart" aria-hidden="true"></i>
                        <div id="cartItems" class="row justify-content-center text-center">

                        </div>
                        <div class="mb-3">
                            <label class="form-label">PAYMENT TYPE</label>
                            <div class="form-check">
                                <input type="radio" id="fullPayment" name="paymenttype" value="fullpayment"
                                    class="form-check-input" checked>
                                <label for="fullPayment" class="form-check-label">Full</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="installment" name="paymenttype" value="installment"
                                    class="form-check-input">
                                <label for="installment" class="form-check-label">Installment</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <span class="fw-bold" id="cartTotal"></span>
                            <form id="checkoutForm">
                                <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}">
                                @if (auth()->check())
                                    <button type="button" class="btn btn-primary" id="checkout">Checkout</button>
                                @else
                                    <button type="button" class="btn btn-primary" id="loginbtn"
                                        onclick="window.location='{{ route('login') }}'">Login First</button>
                                @endif

                            </form>

                            <button id="cartclosebtn" type="button" class="btn btn-danger"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Cart --}}


    {{-- Receipt --}}
    <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invoiceModalLabel">Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="content">
                            <div class="main text-center">
                                <div class="content-wrap">
                                    <div class="content-block">
                                        <h2>Receipt</h2>
                                    </div>
                                    <div class="content-block">
                                        <table class="table">
                                            <tr class="text-start">
                                                <td>
                                                    <span id="customerName">Anna Smith</span>
                                                    <br>
                                                    <span id="invoiceNo">Invoice #12345</span>
                                                    <br>
                                                    <span id="date">June 01 2015</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table id="receipItemsTable" class="table">
                                                        <thead>
                                                            <tr class="table-active">
                                                                <td class="text-center">Item</td>
                                                                <td class="text-center">Price</td>
                                                                <td class="text-center">Qty</td>
                                                                <td class="text-center">Subtotal</td>
                                                            </tr>
                                                            <thead>
                                                            <tbody id="receipItemsTableBody">

                                                        <tbody>
                                                        <tfoot>
                                                            <tr class="table-active">
                                                                <td class="text-center fw-bolder">Total</td>
                                                                <td class="text-center fw-bold" colspan="2"></td>
                                                                <td id="totalPrice" class="text-center fw-bold">₱36.00
                                                                </td>
                                                            </tr>
                                                            <tfoot>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="content-block">
                                        OCMIS 2023
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Receipt --}}
    <footer class="py-5 bg-dark-2 ">
        <div class="container ">
            <p class="m-0 text-center text-white">OCMIS</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    @stack('js')
    <script src="{{ url('js/sticky.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
