@extends('layouts.home')

@section('content')
    <section class="py-5" id="checkout">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4 text-medshop-primary">Checkout</h2>
            {{-- Cart items as table --}}
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Looping produk di keranjang --}}
                    @foreach ($cartItems as $cartItem)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img class="rounded"
                                        src="{{ asset('uploads/products/' . $cartItem->product_code . '/' . $cartItem->product_image) }}"
                                        alt="{{ $cartItem->product_name }}" width="100" />
                                    <div class="ms-3">
                                        <h5 class="fw-bolder">{{ $cartItem->product_name }}</h5>
                                        <p class="text-secondary">{{ $cartItem->product_code }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>Rp. {{ number_format($cartItem->price, 0, ',', '.') }}</td>
                            <td>{{ $cartItem->quantity }}</td>
                            <td>Rp. {{ number_format($cartItem->price * $cartItem->quantity, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Total price of all items on user's cart --}}
            <div class="text-end mt-5">
                <h5 class="fw-bolder">Total: Rp. {{ number_format($totalPrice, 0, ',', '.') }}</h5>
            </div>
            {{-- Checkout form --}}
            <form action="{{ url('/checkout') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="address_delivery" class="form-label">Alamat Pengiriman</label>
                    <textarea class="form-control" id="address_delivery" name="address_delivery" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="city_delivery" class="form-label">Kota Pengiriman</label>
                    <input type="text" class="form-control" id="city_delivery" name="city_delivery" required />
                </div>
                <div class="mb-3">
                    <label for="phone_number_delivery" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="phone_delivery" name="phone_number_delivery" required />
                </div>
                <div class="mb-3">
                    <label for="total" class="form-label">Total Price</label>
                    <input type="text" class="form-control" id="total" name="total" value="{{ $totalPrice }}"
                        readonly />
                </div>
                {{-- payment method radio button --}}
                <div class="mb-3">
                    <label for="payment_method" class="form-label">Metode Pembayaran</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check input" type="radio" name="payment_method" id="payment_method"
                            value="transfer" required />
                        <label class="form-check label" for="payment_method">Transfer</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check input" type="radio" name="payment_method" id="payment_method"
                            value="cod" required />
                        <label class="form-check label" for="payment_method">Cash on Delivery</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-medshop-primary">Checkout</button>
            </form>
    </section>
@endsection
