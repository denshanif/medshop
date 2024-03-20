@extends('adminlte::page')

@section('title', 'Category | Medshop')

@section('content_header')
    <h1>Category (Kategori) Produk</h1>
@stop

@section('content')
    <p>Daftar kategori produk yang digunakan dalam aplikasi.</p>
    <div class="card">
        <div class="card-header">
            <a href="{{ url('admin/categories/create') }}" class="btn btn-primary">Tambah Kategori</a>
        </div>
        <div class="card-body">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Slug</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                <a href="{{ url('admin/categories/edit', $category->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ url('admin/categories', $category->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    {{-- delete, use sweetalert2 --}}
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
