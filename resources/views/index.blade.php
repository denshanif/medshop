@extends('layouts.home')

@section('content')
    <!-- Header-->
    <header class="py-5 header-bg"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.527),rgba(0, 0, 0, 0.5)), url(assets/background.jpg);">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Beli Alat Kesehatan dengan Mudah</h1>
                <p class="lead fw-normal text-white mb-0">Terlengkap hanya di Medshop</p>
                {{-- CTA button --}}
                <a href="#shop" class="btn btn-lg btn-outline-light mt-4">Belanja Sekarang</a>
            </div>
        </div>
    </header>
    <!-- Section Produk Terbaru-->
    <section class="py-5" id="shop">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4 text-medshop-primary">Produk Terbaru</h2>
            {{-- Search bar --}}
            <form action="{{ url('/?search=') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari produk" name="search" />
                    <button class="btn btn-medshop-primary" type="submit">Cari</button>
                </div>
            </form>
            {{-- Filter by category --}}
            <div class="d-flex justify-content-between">
                <div class="dropdown">
                    <button class="btn btn-medshop-primary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Kategori
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ url('/') }}">Semua</a></li>
                        @foreach ($categories as $category)
                            <li><a class="dropdown-item"
                                    href="{{ url('/?category=' . $category->category_name) }}">{{ $category->category_name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                {{-- Sort by --}}
                <div class="dropdown">
                    <button class="btn btn-medshop-primary dropdown-toggle" type="button" id="dropdownMenuButton2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Urutkan
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                        <li><a class="dropdown-item" href="{{ url('/?sort=asc') }}">Harga Terendah</a></li>
                        <li><a class="dropdown-item" href="{{ url('/?sort=desc') }}">Harga Tertinggi</a></li>
                    </ul>
                </div>
            </div>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" id="product-list">
                {{-- Looping produk terbaru --}}
                @foreach ($products as $product)
                    <div class="col mb-5">
                        <div class="card h-100">
                            {{-- Image --}}
                            <img class="card-img-top"
                                src="{{ asset('uploads/products/' . $product->product_code . '/' . $product->product_image) }}"
                                alt="{{ $product->product_name }}" />
                            <div class="card-body p-4">
                                {{-- Title --}}
                                <div class="text-center">
                                    <h5 class="fw-bolder">{{ $product->product_name }}</h5>
                                    {{-- Price --}}
                                    <span class="text-medshop-primary">Rp.
                                        {{ number_format($product->product_price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    {{-- Detail button --}}
                                    <a class="btn btn-medshop-primary" href="{{ url('product', $product->id) }}">Lihat
                                        Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
