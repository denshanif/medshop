@extends('adminlte::page')

@section('title', 'Edit Unit | Medshop')

@section('content_header')
    <h1>Edit Unit (Satuan)</h1>
@stop

@section('content')
    <p>Form untuk mengedit unit (satuan) yang digunakan dalam aplikasi.</p>
    <div class="card">
        <div class="card-body">
            <form action="{{ url('admin/units', $unit->id) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group row">
                    <label for="unit_name" class="col-sm-2 col-form-label">Nama Unit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="unit_name" name="unit_name"
                            value="{{ $unit->unit_name }}" required>
                    </div>
                </div>
                <a href="{{ url('admin/units') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@stop
