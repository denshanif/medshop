@extends('layouts.home')

@section('content')
    <!-- Product section-->
    <section class="py-5" id="product-detail">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0"
                        src="{{ asset('uploads/products/' . $product->product_code . '/' . $product->product_image) }}"
                        alt="{{ $product->product_name }}" /></div>
                <div class="col-md-6">
                    <div class="small mb-1">{{ $product->product_code }}</div>
                    <h1 class="display-5 fw-bolder">{{ $product->product_name }}</h1>
                    <div class="fs-5 mb-5">
                        <span>Rp. {{ number_format($product->product_price, 0, ',', '.') }}</span>
                    </div>
                    <p class="lead">
                        @if ($product->product_description)
                            {{ $product->product_description }}
                        @else
                            Deskripsi produk belum tersedia.
                        @endif
                    </p>
                    <div class="d-flex">
                        <form action="{{ url('/cart') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-medshop-primary">
                                <i class="bi bi-cart
                                        fill me-1"></i>
                                Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related items section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Produk Terkait</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                {{-- Looping produk terkait --}}
                @foreach ($relatedProducts as $relatedProduct)
                    <div class="col mb-5">
                        <div class="card h-100">
                            {{-- Image --}}
                            <img class="card-img-top"
                                src="{{ asset('uploads/products/' . $relatedProduct->product_code . '/' . $relatedProduct->product_image) }}"
                                alt="{{ $relatedProduct->product_name }}" />
                            <div class="card-body p-4">
                                {{-- Title --}}
                                <div class="text-center">
                                    <h5 class="fw-bolder">{{ $relatedProduct->product_name }}</h5>
                                    {{-- Price --}}
                                    <span class="text-medshop-primary">Rp.
                                        {{ number_format($relatedProduct->product_price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-medshop-primary"
                                        href="{{ url('/product/' . $relatedProduct->product_code) }}">Lihat
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
