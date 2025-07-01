@extends('layouts.main')

@section('title', 'Edit Buku')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Edit Buku {{ $book->title }}</h2>

        <form action="{{ route('admin.book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Judul Buku</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title', $book->title) }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Penulis</label>
                <input type="text" name="author" class="form-control @error('author') is-invalid @enderror"
                    value="{{ old('author', $book->author) }}">
                @error('author')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->category }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label class="form-label">Tahun Terbit</label>
                <input type="text" name="year" class="form-control @error('year') is-invalid @enderror"
                    value="{{ old('year', $book->year) }}">
                @error('year')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Penerbit</label>
                <input type="text" name="publisher" class="form-control @error('publisher') is-invalid @enderror"
                    value="{{ old('publisher', $book->publisher) }}">
                @error('publisher')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Gambar</label>
                    <input class="form-control" type="file" id="image" name="image">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.books') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
