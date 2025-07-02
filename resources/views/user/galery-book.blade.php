@extends('user.layouts.app')

@section('title', 'Book-Galery-Images')

@section('content')
    <style>
        .image-zoom-effect {
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .image-zoom-effect img {
            transition: transform 0.3s ease;
        }

        .image-zoom-effect:hover img {
            transform: scale(1.1);
        }
    </style>
    <section id="billboard" class="bg-light py-5">
        <div class="container">
            <div class="row justify-content-center">
                <h1 class="section-title text-center mt-4" data-aos="fade-up">Gambar Buku</h1>
                <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="300">
                    <p>Temukan Buku Favorite Anda</p>
                </div>
            </div>



            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 py-4 border-animation-left" data-aos="fade-up"
                data-aos-delay="600">
                @foreach ($bookImages as $images)
                    <div class="col">
                        <div class="banner-item image-zoom-effect">
                            <div class="image-holder">
                                <a href="#">
                                    @if ($images->image)
                                        <img src="{{ asset('storage/' . $images->image) }}" alt="product"
                                            class="img-fluid">
                                    @else
                                        <img src="{{ asset('assets/images/logos/book_image.png') }}" alt="product"
                                            class="img-fluid">
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
@endsection
