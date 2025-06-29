@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-primary"><i class="fas fa-book me-2"></i>Daftar Buku</h1>

        <!-- Filter Kategori -->
        <div class="mb-4 card shadow-sm">
            <div class="card-body">
                <form action="{{ route('books.index') }}" method="GET">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label class="col-form-label"><i class="fas fa-filter me-2"></i>Filter Kategori:</label>
                        </div>
                        <div class="col-md-4">
                            <select name="category" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Buku -->
        <div class="card shadow">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th class="col-1">#</th>
                            <th class="col-8">Judul Buku</th>
                            <th class="col-3">Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $index => $book)
                            <tr class="align-middle">
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a href="{{ route('books.show', $book['id']) }}"
                                        class="text-decoration-none text-dark fw-bold">
                                        <i class="fas fa-book-open me-2 text-secondary"></i>
                                        {{ $book['title'] }}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge rounded-pill bg-info text-dark">
                                        {{ $book['category'] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
