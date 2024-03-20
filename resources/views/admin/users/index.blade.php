@extends('adminlte::page')

@section('title', 'Manajemen User | Medshop')

@section('content_header')
    <h1>Data User Medshop</h1>
@stop

@section('content')
    <p>Daftar user yang digunakan dalam aplikasi.</p>
    <div class="card">
        <div class="card-body">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                        <th>No. Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ date('d-m-Y', strtotime($user->date_of_birth)) }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->city }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <a href="{{ url('admin/users/edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                    @if ($user->id != Auth::user()->id)
                                        <form action="{{ url('admin/users', $user->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            {{-- delete, use sweetalert2 --}}
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
            </table>
        </div>
    </div>
@stop
