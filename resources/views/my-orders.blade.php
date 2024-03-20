@extends('layouts.home')

@section('content')
    <section class="py-5" id="my-orders">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4 text-medshop-primary">Pesanan Saya</h2>
            {{-- Grouping by order_id --}}
            @foreach ($groupedOrders as $order)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="fw-bolder mb-0">Pesanan ID: {{ $order[0]->id }}</h5>
                        {{-- cetak invoice --}}
                        <a href="{{ url('invoice', $order[0]->id) }}" class="btn btn-primary">Cetak Invoice</a>
                        {{-- cancel order --}}
                        @if ($order[0]->status == 'Pending')
                            <form action="{{ url('cancel-order', $order[0]->id) }}" method="post" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">Batalkan
                                    Pesanan</button>
                            </form>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->product_name }}</td>
                                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="fw-bolder mb-0">Total Harga</p>
                                <p class="fw-bolder mb-0">Status</p>
                            </div>
                            <div>
                                @php
                                    $totalPrice = 0;
                                    foreach ($order as $item) {
                                        $totalPrice += $item->price * $item->quantity;
                                    }
                                @endphp
                                <p class="fw-bolder mb-0">Rp {{ number_format($totalPrice, 0, ',', '.') }}</p>
                                <p class="fw-bolder mb-0">{{ $order[0]->status }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
