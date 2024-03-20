@extends('adminlte::page')

@section('title', 'Edit Kategori | Medshop')

@section('content_header')
    <h1>Edit Kategori Produk</h1>
@stop

@section('content')
    <p>Form untuk mengedit kategori produk yang digunakan dalam aplikasi.</p>
    <div class="card">
        <div class="card-body">
            <form action="{{ url('admin/categories', $category->id) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group row">
                    <label for="category_name" class="col-sm-2 col-form-label">Nama Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="category_name" name="category_name"
                            value="{{ $category->category_name }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="slug" name="slug"
                            value="{{ $category->slug }}" required>
                    </div>
                </div>
                <a href="{{ url('admin/categories') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@stop
