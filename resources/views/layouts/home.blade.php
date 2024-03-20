<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Medshop | Toko Alat Kesehatan Terlengkap di Surabaya</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    {{-- Custom CSS --}}
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid px-4 px-lg-5">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('assets/logo.png') }}" alt="Medshop Logo" width="100">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#shop">Shop</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Kategori
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ url('/') }}">Semua</a></li>
                            @foreach ($categories as $category)
                                <li><a class="dropdown-item"
                                        href="{{ url('/?category=' . $category->category_name) }}">{{ $category->category_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                @if (Auth::check())
                    {{-- My Orders --}}
                    @if ($hasOrder)
                        <a href="{{ url('my-orders') }}" class="btn btn-medshop-primary mb-2 mb-lg-0 me-lg-2">My
                            Orders</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="btn btn-medshop-primary mb-2 mb-lg-0 me-lg-2" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Logout
                        </a>
                    </form>
                    <a href="{{ url('cart') }}" class="btn btn-outline-medshop-secondary mb-2 mb-lg-0 me-lg-2">Cart
                        {{-- cart count --}}
                        <span class="badge bg-dark text-white ms-1 rounded-pill">
                            {{ $cartCount ?? 0 }}
                        </span>
                    </a>
                @else
                    <form class="d-flex flex-lg-row flex-column">
                        <a href="{{ route('login') }}" class="btn btn-medshop-primary mb-2 mb-lg-0 me-lg-2">Login</a>
                        <a href="{{ route('register') }}"
                            class="btn btn-outline-medshop-primary mb-2 mb-lg-0 me-lg-2">Register</a>
                        <button class="btn btn-outline-medshop-secondary" type="submit">
                            <i class="bi bi-cart-fill me-1"></i>
                            Cart
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </nav>

    <!-- Content -->
    @yield('content')

    <!-- Footer-->
    <footer class="py-5 bg-medshop-primary">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy;
                {{ \Carbon\Carbon::now()->format('Y') }} Medshop | Toko Alat Kesehatan Terlengkap di Surabaya</p>
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('js/scripts.js') }}"></script>

    {{-- Custom JS --}}
    <script>
        // Add active class to the current button (highlight it)
        var header = document.getElementById("navbarSupportedContent");
        var btns = header.getElementsByClassName("nav-link");
        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
                var current = document.getElementsByClassName("active");
                if (current.length > 0) {
                    current[0].className = current[0].className.replace(" active", "");
                }
                this.className += " active";
            });
        }
    </script>
</body>

</html>
