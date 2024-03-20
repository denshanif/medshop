@extends('adminlte::page')

@section('title', 'Produk | Medshop')

@section('content_header')
    <h1>Data Produk Medshop</h1>
@stop

@section('content')
    <p>Daftar produk yang digunakan dalam aplikasi.</p>
    <div class="card">
        <div class="card-header">
            <a href="{{ url('admin/products/create') }}" class="btn btn-primary">Tambah Produk</a>
        </div>
        <div class="card-body">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Produk (SKU)</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Min Stok</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th>Gambar Produk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->product_code }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->category_name }}</td>
                            <td>Rp. {{ number_format($product->product_price, 0, ',', '.') }}</td>
                            <td>{{ $product->product_stock }}</td>
                            <td>{{ $product->product_minimum_stock }}</td>
                            <td>{{ $product->unit_name }}</td>
                            <td>{{ $product->product_status }}</td>
                            <td><img src="{{ asset('uploads/products/' . $product->product_code . '/' . $product->product_image) }}"
                                    alt="{{ $product->product_name }}" width="100"></td>
                            <td>
                                <div class="d-flex flex-column">
                                    <a href="{{ url('admin/products/edit', $product->id) }}"
                                        class="btn btn-warning">Edit</a>
                                    <form action="{{ url('admin/products', $product->id) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        {{-- delete, use sweetalert2 --}}
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
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
