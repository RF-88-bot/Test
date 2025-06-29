@extends('layouts.main')

@section('title', 'Students')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-center">Data Mahasiswa</h2>
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswa as $mhs)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ url('/student/' . $mhs['nim']) }}">{{ $mhs['nama'] }}</a></td>
                                <td>{{ $mhs['nim'] }}</td>
                                <td>{{ $mhs['kelas'] }}</td>
                                <td>{{ $mhs['jurusan'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
