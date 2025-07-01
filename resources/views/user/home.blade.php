@extends('user.layouts.app')


@section('title', 'Home')
@section('content')
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
                                            <a href="index.html" class="item-anchor">{{ $book->title }}</a>
                                        </h5>
                                        <p>{{ $book->category->category }}</p>
                                        <div class="btn-left">
                                            <a href="#"
                                                class="btn-link fs-6 item-anchor text-decoration-none">Rating...</a>
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
            <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
                <h4 class="text-uppercase">Our New Arrivals</h4>
                <a href="#" class="btn-link">View All Products</a>
            </div>
            <div class="swiper product-swiper open-up" data-aos="zoom-out">
                <div class="swiper-wrapper d-flex">
                    @foreach ($allBook as $book)
                        <div class="swiper-slide">
                            <div class="product-item image-zoom-effect link-effect">
                                <div class="image-holder position-relative">
                                    <a href="#">
                                        <img src="{{ asset('storage/' . $book->image) }}" alt="categories"
                                            class="product-image img-fluid">
                                    </a>
                                    <a href="#" class="btn-icon btn-wishlist">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#heart"></use>
                                        </svg>
                                    </a>
                                    <div class="product-content">
                                        <h5 class="element-title text-uppercase fs-5 mt-3">
                                            <a href="#">{{ $book->title }}</a>
                                        </h5>
                                        <a href="#" class="text-decoration-none" data-after="Add to cart">
                                            <span>{{ $book->author }}</span>
                                        </a>
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


@endsection
