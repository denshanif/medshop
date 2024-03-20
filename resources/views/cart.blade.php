@extends('layouts.home')

@section('content')
    <!-- Section Produk Terbaru-->
    <section class="py-5" id="cart">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4 text-medshop-primary">Keranjang Belanja</h2>
            {{-- Cart items --}}
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" id="product-list">
                {{-- Looping produk di keranjang --}}
                @foreach ($cartItems as $cartItem)
                    <div class="col mb-5">
                        <div class="card h-100">
                            {{-- Image --}}
                            <img class="card-img-top"
                                src="{{ asset('uploads/products/' . $cartItem->product_code . '/' . $cartItem->product_image) }}"
                                alt="{{ $cartItem->product_name }}" />
                            <div class="card-body p-4">
                                {{-- Title --}}
                                <div class="text-center">
                                    <h5 class="fw-bolder">{{ $cartItem->product_name }}</h5>
                                    {{-- Price --}}
                                    <span class="text-medshop-primary">Rp.
                                        {{ number_format($cartItem->price, 0, ',', '.') }}</span>
                                    {{-- Quantity --}}
                                    <p class="text-secondary">Jumlah: {{ $cartItem->quantity }}</p>
                                    {{-- Remove from cart --}}
                                    <form action="{{ url('/cart/' . $cartItem->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-medshop-primary">
                                            <i class="bi bi-trash-fill me-1"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- Total price of all items on user's cart --}}
            <div class="text-end mt-5">
                <h5 class="fw-bolder">Total: Rp. {{ number_format($totalPrice, 0, ',', '.') }}</h5>
            </div>

            {{-- Checkout button --}}
            <div class="text-end mt-5">
                <a href="{{ url('/checkout') }}" class="btn btn-medshop-primary">Checkout</a>
            </div>
        </div>
    </section>
@endsection
