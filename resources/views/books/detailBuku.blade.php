@extends('layouts.main')

@section('title', 'Detail Buku')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0"><i class="fas fa-info-circle me-2"></i>Detail Buku</h2>
                    </div>

                    <div class="card-body">
                        @if ($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" class="img-fluid mt-2">
                        @else
                            <img src="{{ asset('assets/images/logos/book_image.png') }}" class="img-fluid mt-2">
                        @endif

                        <h1 class="display-6 text-primary mb-4">{{ $book->title }}</h1>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-user-pen fs-4 text-secondary me-3"></i>
                                    <div>
                                        <h5 class="mb-0 text-muted">Penulis</h5>
                                        <p class="lead mb-0">{{ $book->author }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-calendar fs-4 text-secondary me-3"></i>
                                    <div>
                                        <h5 class="mb-0 text-muted">Tahun Terbit</h5>
                                        <p class="lead mb-0">{{ $book->year }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-tag fs-4 text-secondary me-3"></i>
                                    <div>
                                        <h5 class="mb-0 text-muted">Kategori</h5>
                                        <span class="badge bg-info text-dark fs-6">{{ $book->category }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-building fs-4 text-secondary me-3"></i>
                                    <div>
                                        <h5 class="mb-0 text-muted">Penerbit</h5>
                                        <p class="lead mb-0">{{ $book->publisher }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light">
                        <a href="{{ route('admin.books') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Buku
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
