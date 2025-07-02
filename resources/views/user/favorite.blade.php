@extends('user.layouts.app')

@section('title', 'Book-Galery-Images')

@section('content')
    <section id="new-arrival" class="new-arrival product-carousel py-5 position-relative overflow-hidden">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-center align-items-center mt-5 mb-3">
                <h2 class="section-title text-center mt-4" data-aos="fade-up">Your Favorite Books</h2>
                <div id="bookContainer" class="row row-cols-1 row-cols-md-3 g-4 mt-3"></div>
            </div>
            <div id="newArrivalSection" class="swiper product-swiper open-up" data-aos="zoom-out">
                <div class="swiper-wrapper d-flex">
                    @foreach ($favorites as $favorite)
                        <div class="swiper-slide">
                            <div class="product-item image-zoom-effect link-effect">
                                <div class="image-holder position-relative">
                                    <a href="#">
                                        <img src="{{ asset('storage/' . $favorite->book->image) }}" alt="categories"
                                            class="product-image img-fluid">
                                    </a>
                                    <a href="#" class="btn-icon btn-wishlist toggle-favorite"
                                        data-book-id="{{ $favorite->book->id }}"
                                        data-favorited="{{ auth()->check() &&$favorite->book->favorites()->where('user_id', auth()->id())->exists()? 'yes': 'no' }}">

                                        <img src="{{ asset('assets/icons/heart.svg') }}" alt="Favorite"
                                            class="icon-heart-outline {{ auth()->check() &&$favorite->book->favorites()->where('user_id', auth()->id())->exists()? 'd-none': '' }}"
                                            width="24">

                                        <img src="{{ asset('assets/icons/heart-filled.svg') }}" alt="Favorited"
                                            class="icon-heart-filled {{ auth()->check() &&$favorite->book->favorites()->where('user_id', auth()->id())->exists()? '': 'd-none' }}"
                                            width="24">
                                    </a>


                                    <div class="product-content">
                                        <h5 class="element-title text-uppercase fs-5 mt-3">
                                            <a href="#">{{ $favorite->book->title }}</a>
                                        </h5>
                                        @guest
                                            <a href="#" class="text-decoration-none" data-after="Rating..."
                                                onclick="alert('Silahkan Login Terlebih Dahulu')">
                                                <span>{{ $favorite->book->author }}</span>
                                            </a>
                                        @endguest
                                        @auth
                                            <a href="#" class="text-decoration-none" data-after="Rating...">
                                                <span>{{ $favorite->book->author }}</span>
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
                    } else if (response.status === 'removed') {
                        button.data('favorited', 'no');
                        heartOutline.removeClass('d-none');
                        heartFilled.addClass('d-none');
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
@endsection
