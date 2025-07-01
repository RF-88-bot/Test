@extends('layouts.main')

@section('title', 'Book-Category')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-primary"><i class="fas fa-book me-2"></i>Daftar Kategori Buku</h1>

        <!-- Filter Kategori -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-8">
                <a class="btn btn-primary btn-sm mb-2" href="#" data-bs-toggle="modal"
                    data-bs-target="#tambahDataModal">
                    Tambah Data
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <form action="{{ route('admin.categories') }}">
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
                            <th scope="col">Nama Kategory</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Dibuat</th>
                            <th scope="col">Diubah</th>
                            <th scope="col">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $category->category }}
                                </td>
                                <td>
                                    {{ Str::limit($category->description, 20) }}
                                </td>
                                <td>
                                    {{ $category->created_at->diffForHumans() }}
                                </td>
                                <td>
                                    {{ $category->updated_at->diffForHumans() }}
                                </td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm edit-category-btn"
                                        data-bs-toggle="modal" data-bs-target="#editDataModal" data-id="{{ $category->id }}"
                                        data-category="{{ $category->category }}"
                                        data-description="{{ $category->description }}">
                                        <i class="ti ti-pencil"></i>
                                    </a>

                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post"
                                        class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm border-0"
                                            onclick="return confirm('Hapus Data Kategory ? ')">
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
        {{-- {{ $books->links() }} --}}
    </div>


    {{-- Modal Tambah Data --}}
    <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataLabel">Tambah Kategori Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <input type="text" class="form-control @error('category') is-invalid @enderror"
                                id="category" name="category" value="{{ old('category') }}">
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="4" placeholder="Tulis deskripsi untuk kategori buku...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar (SVG)</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                                name="image" accept=".svg">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Tambah --}}
    @if ($errors->any())
        <script>
            window.addEventListener('load', function() {
                var myModal = new bootstrap.Modal(document.getElementById('tambahDataModal'));
                myModal.show();
            });
        </script>
    @endif


    {{-- Modal Edit Data --}}
    <div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_edit_modal" value="true">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDataLabel">Edit Kategori Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>

                    <div class="modal-body">

                        {{-- Hidden input untuk ID kategori (jika perlu) --}}
                        <input type="hidden" id="edit-id">

                        <div class="mb-3">
                            <label for="edit-category" class="form-label">Kategori</label>
                            <input type="text" class="form-control @error('category') is-invalid @enderror"
                                id="edit-category" name="category" value="{{ old('category') }}">
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="edit-description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="edit-description" name="description"
                                rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="edit-image" class="form-label">Ganti Gambar (SVG)</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file"
                                id="edit-image" name="image" accept=".svg">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- edit --}}
    @if ($errors->any() && old('_edit_modal') === 'true')
        <script>
            window.addEventListener('load', function() {
                var myModal = new bootstrap.Modal(document.getElementById('editDataModal'));
                myModal.show();
            });
        </script>
    @endif
    <script>
        const updateBaseRoute = "{{ route('admin.categories.update', ['id' => '__ID__']) }}";

        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-category-btn');
            const form = document.getElementById('editCategoryForm');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const category = this.dataset.category;
                    const description = this.dataset.description;

                    const updateUrl = updateBaseRoute.replace('__ID__', id);
                    form.action = updateUrl;

                    document.getElementById('edit-category').value = category;
                    document.getElementById('edit-description').value = description;
                });
            });
        });
    </script>


@endsection
