@extends('adminlte::page')

@section('title', 'Unit | Medshop')

@section('content_header')
    <h1>Unit (Satuan)</h1>
@stop

@section('content')
    <p>Daftar unit (satuan) yang digunakan dalam aplikasi.</p>
    <div class="card">
        <div class="card-header">
            <a href="{{ url('admin/units/create') }}" class="btn btn-primary">Tambah Unit</a>
        </div>
        <div class="card-body">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Unit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($units as $unit)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $unit->unit_name }}</td>
                            <td>
                                <a href="{{ url('admin/units/edit', $unit->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ url('admin/units', $unit->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    {{-- delete, use sweetalert2 --}}
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus unit ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
