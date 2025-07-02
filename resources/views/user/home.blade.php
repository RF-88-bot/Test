@extends('user.layouts.app')


@section('title', 'Home')
@section('content')
    <style>
        .btn-wishlist.favorited svg use {
            fill: red;
            transition: fill 0.3s ease;
        }
    </style>
    <section id="billboard" class="bg-light py-5">
        <div class="container">
            <div class="row justify-content-center">
                <h1 class="section-title text-center mt-4" data-aos="fade-up">New Books</h1>
                <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="300">
                    <p>Temukan Buku Favorite Anda</p>
                </div>
            </div>

            {{-- Tampilkan 3 Buku Terbaru --}}
            <div class="row">
                <div class="swiper main-swiper py-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="swiper-wrapper d-flex border-animation-left">
                        @foreach ($latestBooks as $book)
                            <div class="swiper-slide">
                                <div class="banner-item image-zoom-effect">
                                    <div class="image-holder">
                                        <a href="#">
                                            @if ($book->image)
                                                <img src="{{ asset('storage/' . $book->image) }}" alt="product"
                                                    class="img-fluid">
                                            @else
                                                <img src="{{ asset('assets/images/logos/book_image.png') }}" alt="product"
                                                    class="img-fluid">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="banner-content py-4">
                                        <h5 class="element-title text-uppercase">
                                            <a href="#" class="item-anchor">{{ $book->title }}</a>
                                        </h5>
                                        <p>{{ $book->category->category }}</p>
                                        <div class="btn-left">
                                            @guest
                                                <a class="btn-link fs-6 item-anchor text-decoration-none" href="#"
                                                    onclick="alert('Silahkan Login Terlebih Dahulu')">Rating...</a>
                                            @endguest
                                            @auth
                                                <a href="#"
                                                    class="btn-link fs-6 item-anchor text-decoration-none">Rating...</a>
                                            @endauth

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="icon-arrow icon-arrow-left">
                    <svg width="50" height="50" viewBox="0 0 24 24">
                        <use xlink:href="{{ asset('assets/icons/icons.svg#arrow-left') }}"></use>
                    </svg>
                </div>
                <div class="icon-arrow icon-arrow-right">
                    <svg width="50" height="50" viewBox="0 0 24 24">
                        <use xlink:href="{{ asset('assets/icons/icons.svg#arrow-right') }}"></use>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <section class="features py-5">
        <div class="container">
            <div class="row">
                @foreach ($categories as $category)
                    @php $delay = $loop->index * 300; @endphp
                    <div class="col-md-3 text-center mb-4" data-aos="fade-in" data-aos-delay="{{ $delay }}">
                        <div class="py-4 px-2  h-100">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="Icon {{ $category->category }}"
                                width="64">
                            <h4 class="element-title text-capitalize my-3">{{ $category->category }}</h4>
                            <p>{{ Str::limit($category->description, 20) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="new-arrival" class="new-arrival product-carousel py-5 position-relative overflow-hidden">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-center align-items-center mt-5 mb-3">
                <h2 class="text-uppercase">
                    <button id="loadAllBooks" class="btn btn-link">ALL
                        BOOKS</button>
                </h2>
                <div id="bookContainer" class="row row-cols-1 row-cols-md-3 g-4 mt-3"></div>
            </div>
            <div id="newArrivalSection" class="swiper product-swiper open-up" data-aos="zoom-out">
                <div class="swiper-wrapper d-flex">
                    @foreach ($allBook as $book)
                        <div class="swiper-slide">
                            <div class="product-item image-zoom-effect link-effect">
                                <div class="image-holder position-relative">
                                    <a href="#">
                                        <img src="{{ asset('storage/' . $book->image) }}" alt="categories"
                                            class="product-image img-fluid">
                                    </a>
                                    <a href="#" class="btn-icon btn-wishlist toggle-favorite"
                                        data-book-id="{{ $book->id }}"
                                        data-favorited="{{ auth()->check() &&$book->favorites()->where('user_id', auth()->id())->exists()? 'yes': 'no' }}">

                                        <img src="{{ asset('assets/icons/heart.svg') }}" alt="Favorite"
                                            class="icon-heart-outline {{ auth()->check() &&$book->favorites()->where('user_id', auth()->id())->exists()? 'd-none': '' }}"
                                            width="24">

                                        <img src="{{ asset('assets/icons/heart-filled.svg') }}" alt="Favorited"
                                            class="icon-heart-filled {{ auth()->check() &&$book->favorites()->where('user_id', auth()->id())->exists()? '': 'd-none' }}"
                                            width="24">
                                    </a>

                                    <div class="product-content">
                                        <h5 class="element-title text-uppercase fs-5 mt-3">
                                            <a href="#">{{ $book->title }}</a>
                                        </h5>
                                        @guest
                                            <a href="#" class="text-decoration-none" data-after="Rating..."
                                                onclick="alert('Silahkan Login Terlebih Dahulu')">
                                                <span>{{ $book->author }}</span>
                                            </a>
                                        @endguest
                                        @auth
                                            <a href="#" class="text-decoration-none" data-after="Rating...">
                                                <span>{{ $book->author }}</span>
                                            </a>
                                        @endauth

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>

            <div class="icon-arrow icon-arrow-left">
                <svg width="50" height="50" viewBox="0 0 24 24">
                    <use xlink:href="#arrow-left"></use>
                </svg>
            </div>
            <div class="icon-arrow icon-arrow-right">
                <svg width="50" height="50" viewBox="0 0 24 24">
                    <use xlink:href="#arrow-right"></use>
                </svg>
            </div>
        </div>
    </section>


    <section class="testimonials py-5 bg-light">
        <div class="section-header text-center mt-5">
            <h3 class="section-title">BACA INI BAIK-BAIK</h3>
        </div>
        <div class="swiper testimonial-swiper overflow-hidden my-5">
            <div class="swiper-wrapper d-flex">
                @php
                    $testimonials = [
                        [
                            'text' => '“Selesaikan tugas besar dulu, baru buka TikTok atau push rank! 🤦‍♂️”',
                            'author' => 'R.F',
                        ],
                        [
                            'text' =>
                                '“Tugas ngoding belum selesai, jangan buru-buru nge-rank atau nge-scroll Medsos. Tugas Prioritas, Bro!😵‍💫💻',
                            'author' => 'R.F',
                        ],
                        [
                            'text' => '“Karena developer keren itu nggak cuma talk, tapi juga execute 💻🚀',
                            'author' => 'R.F',
                        ],
                        [
                            'text' =>
                                '“Karena yang Keren itu bukan bilang nanti di kerjakan, tapi ini sudah jadi, tinggal submit! ✨',
                            'author' => 'Pailo Ni Bos, Tampleng dong',
                        ],
                    ];
                @endphp

                @foreach ($testimonials as $item)
                    <div class="swiper-slide">
                        <div class="testimonial-item text-center">
                            <blockquote>
                                <p>{{ $item['text'] }}</p>
                                <div class="review-title text-uppercase">{{ $item['author'] }}</div>
                            </blockquote>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="testimonial-swiper-pagination d-flex justify-content-center mb-5"></div>
    </section>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let isShowingAllBooks = false; // awalnya false = sedang tampil swiper

        $('#loadAllBooks').on('click', function() {
            if (!isShowingAllBooks) {
                // MODE PERTAMA: Tampilkan semua buku via AJAX
                $.ajax({
                    url: '{{ route('books.ajax') }}',
                    type: 'GET',
                    success: function(response) {
                        $('#newArrivalSection').hide();
                        $('#bookContainer').html('');

                        const imageBase = '{{ asset('storage') }}';
                        response.forEach(book => {
                            $('#bookContainer').append(`
                            <div class="col open-up" data-aos="zoom-out">
                                <div class="product-item image-zoom-effect link-effect">
                                    <div class="image-holder position-relative">
                                        <a href="#">
                                            <img src="${imageBase}/${book.image}" alt="categories" class="product-image img-fluid">
                                        </a>
                                        <a href="#" class="btn-icon btn-wishlist">
                                            <svg width="24" height="24" viewBox="0 0 24 24">
                                                <use xlink:href="#heart"></use>
                                            </svg>
                                        </a>
                                        <div class="product-content">
                                            <h5 class="element-title text-uppercase fs-5 mt-3">
                                                <a href="#">${book.title}</a>
                                            </h5>
                                            <a href="#" class="text-decoration-none" data-after="Add to cart">
                                                <span>${book.author}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);
                        });

                        isShowingAllBooks = true; // ubah status ke "menampilkan ajax"
                        $('#loadAllBooks').text('SHOW SLIDER');
                    },
                    error: function() {
                        alert('Gagal memuat data buku.');
                    }
                });
            } else {
                // MODE KEDUA: Kembali ke swiper
                $('#bookContainer').html('');
                $('#newArrivalSection').show();

                isShowingAllBooks = false; // ubah status ke "menampilkan swiper"
                $('#loadAllBooks').text('ALL BOOKS');
            }
        });
    </script>

    <script>
        $(document).on('click', '.toggle-favorite', function(e) {
            e.preventDefault();

            const button = $(this);
            const bookId = button.data('book-id');

            $.ajax({
                url: '{{ route('user.favorite.toggle') }}',
                method: 'POST',
                data: {
                    book_id: bookId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    const heartOutline = button.find('.icon-heart-outline');
                    const heartFilled = button.find('.icon-heart-filled');

                    if (response.status === 'added') {
                        button.data('favorited', 'yes');
                        heartOutline.addClass('d-none');
                        heartFilled.removeClass('d-none');
                        showToast("📚 Buku berhasil ditambahkan ke favoritmu. Nikmati bacaanmu!");
                    } else if (response.status === 'removed') {
                        button.data('favorited', 'no');
                        heartOutline.removeClass('d-none');
                        heartFilled.addClass('d-none');
                        showToast("💔 Buku telah dihapus dari favorit. Mungkin nanti ketemu lagi!");
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        alert('Silakan login untuk menambahkan ke favorit.');
                    } else {
                        alert('Terjadi kesalahan saat memproses favorit.');
                    }
                }
            });
        });
    </script>

    <script>
        function showToast(message) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: message,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        }
    </script>



@endsection
