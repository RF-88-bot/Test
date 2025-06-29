@extends('layouts.main')

@section('title', 'Books')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-primary"><i class="fas fa-book me-2"></i>Daftar Buku</h1>

        <!-- Filter Kategori -->
        <div class="mb-4 card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.books') }}" method="GET">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label class="col-form-label"><i class="ti ti-filter"></i>Filter Kategori:</label>
                        </div>
                        <div class="col-md-4">
                            <select name="category" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}"
                                        {{ request('category') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-8">
                <a class="btn btn-primary btn-sm mb-2" href="{{ route('admin.book.create') }}">Tambah Data</a>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <form action="{{ route('admin.books') }}">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" placeholder="Pencarian..." name="search"
                            value="{{ request('search') }}" autocomplete="off">
                        <button class="btn btn-success btn-sm" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Buku -->
        <div class="table-responsive card shadow">
            <div class="card-body p-0">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Judul Buku</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Dibuat</th>
                            <th scope="col">Diubah</th>
                            <th scope="col">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $index => $book)
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($book->image)
                                        <img src="{{ asset('storage/' . $book->image) }}" class="img-fluid mt-2"
                                            height="50px" width="50px">
                                    @else
                                        <img src="{{ asset('assets/images/logos/book_image.png') }}" class="img-fluid mt-2"
                                            height="50px" width="50px">
                                    @endif
                                </td>
                                <td>
                                    {{ $book->title }}
                                </td>
                                <td>
                                    {{ $book->author }}
                                </td>
                                <td>
                                    {{ $book->category }}
                                </td>
                                <td>
                                    {{ $book->created_at->diffForHumans() }}
                                </td>
                                <td>
                                    {{ $book->updated_at->diffForHumans() }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.book.show', $book->id) }}" class="btn btn-info btn-sm">
                                        <i class="ti ti-eye-check"></i>
                                    </a>
                                    <a href="{{ route('admin.book.edit', $book->id) }}" class="btn btn-warning btn-sm">
                                        <i class="ti ti-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.book.destroy', $book->id) }}" method="post"
                                        class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm border-0"
                                            onclick="return confirm('Hapus Data Buku ? ')">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        {{ $books->links() }}
    </div>

@endsection
