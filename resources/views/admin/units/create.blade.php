@extends('adminlte::page')

@section('title', 'Tambah Unit | Medshop')

@section('content_header')
    <h1>Tambah Unit (Satuan)</h1>
@stop

@section('content')
    <p>Form untuk menambahkan unit (satuan) yang digunakan dalam aplikasi.</p>
    <div class="card">
        <div class="card-body">
            <form action="{{ url('admin/units') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="unit_name">Nama Unit</label>
                    <input type="text" class="form-control" id="unit_name" name="unit_name" required>
                </div>
                <a href="{{ url('admin/units') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@stop
