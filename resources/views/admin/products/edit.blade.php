@extends('adminlte::page')

@section('title', 'Edit Produk | Medshop')

@section('content_header')
    <h1>Edit Produk Medshop</h1>
@stop

@section('content')
    <p>Form untuk mengedit produk yang digunakan dalam aplikasi.</p>
    <div class="card">
        <div class="card-body">
            <form action="{{ url('admin/products', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group row">
                    <label for="product_name" class="col-sm-2 col-form-label">Nama Produk</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="product_name" name="product_name"
                            value="{{ $product->product_name }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="product_code" class="col-sm-2 col-form-label">Kode Produk (SKU)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="product_code" name="product_code"
                            value="{{ $product->product_code }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category_id" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if ($category->id == $product->category_id) selected @endif>
                                    {{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="product_price" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <span class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" class="form-control" id="product_price" name="product_price"
                                value="{{ $product->product_price }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="product_stock" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="product_stock" name="product_stock"
                            value="{{ $product->product_stock }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="product_minimum_stock" class="col-sm-2 col-form-label">Min Stok</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="product_minimum_stock" name="product_minimum_stock"
                            value="{{ $product->product_minimum_stock }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="unit_id" class="col-sm-2 col-form-label">Unit</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="unit_id" name="unit_id" required>
                            <option value="">Pilih Unit</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}" @if ($unit->id == $product->unit_id) selected @endif>
                                    {{ $unit->unit_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="product_status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="product_status" name="product_status" required>
                            <option value="">Pilih Status</option>
                            <option value="active" @if ($product->product_status == 'active') selected @endif>Aktif</option>
                            <option value="inactive" @if ($product->product_status == 'inactive') selected @endif>Non-Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="product_description" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="product_description" name="product_description" required>{{ $product->product_description }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="product_image" class="col-sm-2 col-form-label">Gambar Produk</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="product_image" name="product_image" required
                            accept="image/png, image/jpeg, image/jpg, image/webp">
                        <img src="{{ asset('uploads/products/' . $product->product_code . '/' . $product->product_image) }}"
                            alt="{{ $product->product_name }}" width="100">
                    </div>
                </div>
                <a href="{{ url('admin/products') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@stop
