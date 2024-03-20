@extends('adminlte::page')

@section('title', 'Manajemen Order | Medshop')

@section('content_header')
    <h1>Data Order Medshop</h1>
@stop

@section('content')
    <p>Daftar order yang digunakan dalam aplikasi.</p>
    <div class="card">
        <div class="card-body">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Tanggal Order</th>
                        <th>Alamat Pengiriman</th>
                        <th>Kota Pengiriman</th>
                        <th>No. Telp</th>
                        <th>Total Harga</th>
                        <th>Harga Setelah Pajak</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                            <td>{{ $order->address_delivery }}</td>
                            <td>{{ $order->city_delivery }}</td>
                            <td>{{ $order->phone_number_delivery }}</td>
                            <td>Rp. {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($order->total + $order->total * 0.11, 0, ',', '.') }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <a href="{{ url('admin/orders', $order->id) }}" class="btn btn-info">Detail</a>
                                    <form action="{{ url('admin/orders', $order->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        {{-- delete, use sweetalert2 --}}
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus order ini?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
