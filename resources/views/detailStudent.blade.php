@extends('layouts.main')

@section('title', 'Detail Student')

@section('content')
    <a href="/student" class="btn btn-secondary mb-3">← Kembali</a>
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Detail Mahasiswa</h4>
        </div>
        <div class="card-body">
            <p><strong>Nama : </strong> {{ $mhs['nama'] }}</p>
            <p><strong>NIM : </strong> {{ $mhs['nim'] }}</p>
            <p><strong>Kelas : </strong> {{ $mhs['kelas'] }}</p>
            <p><strong>Jurusan : </strong> {{ $mhs['jurusan'] }}</p>
        </div>
    </div>
@endsection
