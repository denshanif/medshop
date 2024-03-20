@extends('adminlte::page')

@section('title', 'Detail Order | Medshop')

@section('content_header')
    <h1>Detail Order</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="fw-bolder mb-4">Detail Order</h5>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nama User:</strong> {{ $order->name }}</p>
                    <p><strong>Tanggal Order:</strong> {{ date('d-m-Y', strtotime($order->created_at)) }}</p>
                    <p><strong>Alamat Pengiriman:</strong> {{ $order->address_delivery }}</p>
                    <p><strong>Kota Pengiriman:</strong> {{ $order->city_delivery }}</p>
                    <p><strong>No. Telp:</strong> {{ $order->phone_number_delivery }}</p>
                    <p><strong>Total Harga:</strong> Rp. {{ number_format($order->total, 0, ',', '.') }}</p>
                    <p><strong>Harga Setelah Pajak:</strong> Rp.
                        {{ number_format($order->total + $order->total * 0.11, 0, ',', '.') }}</p>
                    <p><strong>Status:</strong> {{ $order->status }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bolder mb-4">Produk yang Dibeli</h5>
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
                            @foreach ($orderDetails as $orderDetail)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img class="rounded"
                                                src="{{ asset('uploads/products/' . $orderDetail->product_code . '/' . $orderDetail->product_image) }}"
                                                alt="{{ $orderDetail->product_name }}" width="100" />
                                            <div class="ms-3">
                                                <h5 class="fw-bolder">{{ $orderDetail->product_name }}</h5>
                                                <p class="text-secondary">{{ $orderDetail->product_code }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Rp. {{ number_format($orderDetail->price, 0, ',', '.') }}</td>
                                    <td>{{ $orderDetail->quantity }}</td>
                                    <td>Rp. {{ number_format($orderDetail->subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <a href="{{ url('admin/orders') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
@endsection
