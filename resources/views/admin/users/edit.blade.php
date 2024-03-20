@extends('adminlte::page')

@section('title', 'Edit Data User | Medshop')

@section('content_header')
    <h1>Edit Data User</h1>
@stop

@section('content')
    <p>Form untuk mengedit data user yang digunakan dalam aplikasi.</p>
    <div class="card">
        <div class="card-body">
            <form action="{{ url('admin/users', $user->id) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nama User</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                            required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username"
                            value="{{ $user->username }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                            required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="role" name="role" required>
                            <option value="">Pilih Role</option>
                            <option value="admin" @if ($user->role == 'admin') selected @endif>Admin</option>
                            <option value="user" @if ($user->role == 'user') selected @endif>User</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date_of_birth" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                            value="{{ $user->date_of_birth }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ $user->address }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="city" class="col-sm-2 col-form-label">Kota</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="city" name="city" value="{{ $user->city }}"
                            required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone_number" class="col-sm-2 col-form-label">No. Telp</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                            value="{{ $user->phone_number }}" required>
                    </div>
                </div>
                <a href="{{ url('admin/users') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@stop
